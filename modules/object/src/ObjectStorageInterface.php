<?php

namespace Drupal\iol_object;

use Drupal\Core\Entity\ContentEntityStorageInterface;
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
interface ObjectStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Object revision IDs for a specific Object.
   *
   * @param \Drupal\iol_object\Entity\ObjectInterface $entity
   *   The Object entity.
   *
   * @return int[]
   *   Object revision IDs (in ascending order).
   */
  public function revisionIds(ObjectInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Object author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Object revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\iol_object\Entity\ObjectInterface $entity
   *   The Object entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(ObjectInterface $entity);

  /**
   * Unsets the language for all Object with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
