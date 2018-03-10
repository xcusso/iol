<?php

namespace Drupal\iol_object\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Object entities.
 *
 * @ingroup iol
 */
interface ObjectInterface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Object name.
   *
   * @return string
   *   Name of the Object.
   */
  public function getName();

  /**
   * Sets the Object name.
   *
   * @param string $name
   *   The Object name.
   *
   * @return \Drupal\iol_object\Entity\ObjectInterface
   *   The called Object entity.
   */
  public function setName($name);

  /**
   * Gets the Object creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Object.
   */
  public function getCreatedTime();

  /**
   * Sets the Object creation timestamp.
   *
   * @param int $timestamp
   *   The Object creation timestamp.
   *
   * @return \Drupal\iol_object\Entity\ObjectInterface
   *   The called Object entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Object published status indicator.
   *
   * Unpublished Object are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Object is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Object.
   *
   * @param bool $published
   *   TRUE to set this Object to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\iol_object\Entity\ObjectInterface
   *   The called Object entity.
   */
  public function setPublished($published);

  /**
   * Gets the Object revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Object revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\iol_object\Entity\ObjectInterface
   *   The called Object entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Object revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Object revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\iol_object\Entity\ObjectInterface
   *   The called Object entity.
   */
  public function setRevisionUserId($uid);

}
