<?php

namespace Drupal\iol\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\iol\Entity\ObjectInterface;

/**
 * Class ObjectController.
 *
 *  Returns responses for Object routes.
 */
class ObjectController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Object  revision.
   *
   * @param int $object_revision
   *   The Object  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($object_revision) {
    $object = $this->entityManager()->getStorage('object')->loadRevision($object_revision);
    $view_builder = $this->entityManager()->getViewBuilder('object');

    return $view_builder->view($object);
  }

  /**
   * Page title callback for a Object  revision.
   *
   * @param int $object_revision
   *   The Object  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($object_revision) {
    $object = $this->entityManager()->getStorage('object')->loadRevision($object_revision);
    return $this->t('Revision of %title from %date', ['%title' => $object->label(), '%date' => format_date($object->getRevisionCreationTime())]);
  }

  /**
   * Generates an overview table of older revisions of a Object .
   *
   * @param \Drupal\iol\Entity\ObjectInterface $object
   *   A Object  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(ObjectInterface $object) {
    $account = $this->currentUser();
    $langcode = $object->language()->getId();
    $langname = $object->language()->getName();
    $languages = $object->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $object_storage = $this->entityManager()->getStorage('object');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $object->label()]) : $this->t('Revisions for %title', ['%title' => $object->label()]);
    $header = [$this->t('Revision'), $this->t('Operations')];

    $revert_permission = (($account->hasPermission("revert all object revisions") || $account->hasPermission('administer iol')));
    $delete_permission = (($account->hasPermission("delete all object revisions") || $account->hasPermission('administer iol')));

    $rows = [];

    $vids = $object_storage->revisionIds($object);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\iol\ObjectInterface $revision */
      $revision = $object_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $object->getRevisionId()) {
          $link = $this->l($date, new Url('entity.object.revision', ['object' => $object->id(), 'object_revision' => $vid]));
        }
        else {
          $link = $object->link($date);
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}<p class="revision-log">{{ message }}</p>{% endif %}',
            '#context' => [
              'date' => $link,
              'username' => \Drupal::service('renderer')->renderPlain($username),
              'message' => ['#markup' => $revision->getRevisionLogMessage(), '#allowed_tags' => Xss::getHtmlTagList()],
            ],
          ],
        ];
        $row[] = $column;

        if ($latest_revision) {
          $row[] = [
            'data' => [
              '#prefix' => '<em>',
              '#markup' => $this->t('Current revision'),
              '#suffix' => '</em>',
            ],
          ];
          foreach ($row as &$current) {
            $current['class'] = ['revision-current'];
          }
          $latest_revision = FALSE;
        }
        else {
          $links = [];
          if ($revert_permission) {
            $links['revert'] = [
              'title' => $this->t('Revert'),
              'url' => $has_translations ?
              Url::fromRoute('entity.object.translation_revert', ['object' => $object->id(), 'object_revision' => $vid, 'langcode' => $langcode]) :
              Url::fromRoute('entity.object.revision_revert', ['object' => $object->id(), 'object_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.object.revision_delete', ['object' => $object->id(), 'object_revision' => $vid]),
            ];
          }

          $row[] = [
            'data' => [
              '#type' => 'operations',
              '#links' => $links,
            ],
          ];
        }

        $rows[] = $row;
      }
    }

    $build['object_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
