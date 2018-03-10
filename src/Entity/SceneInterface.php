<?php

namespace Drupal\iol\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Scene entities.
 *
 * @ingroup iol
 */
interface SceneInterface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Scene name.
   *
   * @return string
   *   Name of the Scene.
   */
  public function getName();

  /**
   * Sets the Scene name.
   *
   * @param string $name
   *   The Scene name.
   *
   * @return \Drupal\iol\Entity\SceneInterface
   *   The called Scene entity.
   */
  public function setName($name);

  /**
   * Gets the Scene creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Scene.
   */
  public function getCreatedTime();

  /**
   * Sets the Scene creation timestamp.
   *
   * @param int $timestamp
   *   The Scene creation timestamp.
   *
   * @return \Drupal\iol\Entity\SceneInterface
   *   The called Scene entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Scene published status indicator.
   *
   * Unpublished Scene are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Scene is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Scene.
   *
   * @param bool $published
   *   TRUE to set this Scene to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\iol\Entity\SceneInterface
   *   The called Scene entity.
   */
  public function setPublished($published);

  /**
   * Gets the Scene revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Scene revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\iol\Entity\SceneInterface
   *   The called Scene entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Scene revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Scene revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\iol\Entity\SceneInterface
   *   The called Scene entity.
   */
  public function setRevisionUserId($uid);

}
