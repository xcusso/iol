<?php

namespace Drupal\iol\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\iol\Entity\SceneInterface;

/**
 * Class SceneController.
 *
 *  Returns responses for Scene routes.
 */
class SceneController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Scene  revision.
   *
   * @param int $scene_revision
   *   The Scene  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($scene_revision) {
    $scene = $this->entityManager()->getStorage('scene')->loadRevision($scene_revision);
    $view_builder = $this->entityManager()->getViewBuilder('scene');

    return $view_builder->view($scene);
  }

  /**
   * Page title callback for a Scene  revision.
   *
   * @param int $scene_revision
   *   The Scene  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($scene_revision) {
    $scene = $this->entityManager()->getStorage('scene')->loadRevision($scene_revision);
    return $this->t('Revision of %title from %date', ['%title' => $scene->label(), '%date' => format_date($scene->getRevisionCreationTime())]);
  }

  /**
   * Generates an overview table of older revisions of a Scene .
   *
   * @param \Drupal\iol\Entity\SceneInterface $scene
   *   A Scene  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(SceneInterface $scene) {
    $account = $this->currentUser();
    $langcode = $scene->language()->getId();
    $langname = $scene->language()->getName();
    $languages = $scene->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $scene_storage = $this->entityManager()->getStorage('scene');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $scene->label()]) : $this->t('Revisions for %title', ['%title' => $scene->label()]);
    $header = [$this->t('Revision'), $this->t('Operations')];

    $revert_permission = (($account->hasPermission("revert all scene revisions") || $account->hasPermission('administer iol')));
    $delete_permission = (($account->hasPermission("delete all scene revisions") || $account->hasPermission('administer iol')));

    $rows = [];

    $vids = $scene_storage->revisionIds($scene);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\iol\SceneInterface $revision */
      $revision = $scene_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $scene->getRevisionId()) {
          $link = $this->l($date, new Url('entity.scene.revision', ['scene' => $scene->id(), 'scene_revision' => $vid]));
        }
        else {
          $link = $scene->link($date);
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
              Url::fromRoute('entity.scene.translation_revert', ['scene' => $scene->id(), 'scene_revision' => $vid, 'langcode' => $langcode]) :
              Url::fromRoute('entity.scene.revision_revert', ['scene' => $scene->id(), 'scene_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.scene.revision_delete', ['scene' => $scene->id(), 'scene_revision' => $vid]),
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

    $build['scene_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
