<?php

namespace Drupal\iol;

use Drupal\Core\Entity\ContentEntityStorageInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\iol\Entity\SceneInterface;

/**
 * Defines the storage handler class for Scene entities.
 *
 * This extends the base storage class, adding required special handling for
 * Scene entities.
 *
 * @ingroup iol
 */
interface SceneStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Scene revision IDs for a specific Scene.
   *
   * @param \Drupal\iol\Entity\SceneInterface $entity
   *   The Scene entity.
   *
   * @return int[]
   *   Scene revision IDs (in ascending order).
   */
  public function revisionIds(SceneInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Scene author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Scene revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\iol\Entity\SceneInterface $entity
   *   The Scene entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(SceneInterface $entity);

  /**
   * Unsets the language for all Scene with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
