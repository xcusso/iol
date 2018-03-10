<?php

namespace Drupal\iol_object;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\iol_object\Entity\ObjectInterface;

/**
 * Defines the storage handler class for Object entities.
 *
 * This extends the base storage class, adding required special handling for
 * Object entities.
 *
 * @ingroup iol
 */
class ObjectStorage extends SqlContentEntityStorage implements ObjectStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(ObjectInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {object_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {object_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(ObjectInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {object_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('object_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
