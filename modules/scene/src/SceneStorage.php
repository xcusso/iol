<?php

namespace Drupal\iol_scene;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\iol_scene\Entity\SceneInterface;

/**
 * Defines the storage handler class for Scene entities.
 *
 * This extends the base storage class, adding required special handling for
 * Scene entities.
 *
 * @ingroup iol
 */
class SceneStorage extends SqlContentEntityStorage implements SceneStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(SceneInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {scene_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {scene_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(SceneInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {scene_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('scene_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
