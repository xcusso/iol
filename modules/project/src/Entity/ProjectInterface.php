<?php

namespace Drupal\iol_project\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Project entities.
 *
 * @ingroup iol
 */
interface ProjectInterface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Project name.
   *
   * @return string
   *   Name of the Project.
   */
  public function getName();

  /**
   * Sets the Project name.
   *
   * @param string $name
   *   The Project name.
   *
   * @return \Drupal\iol_project\Entity\ProjectInterface
   *   The called Project entity.
   */
  public function setName($name);

  /**
   * Gets the Project creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Project.
   */
  public function getCreatedTime();

  /**
   * Sets the Project creation timestamp.
   *
   * @param int $timestamp
   *   The Project creation timestamp.
   *
   * @return \Drupal\iol_project\Entity\ProjectInterface
   *   The called Project entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Project published status indicator.
   *
   * Unpublished Project are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Project is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Project.
   *
   * @param bool $published
   *   TRUE to set this Project to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\iol_project\Entity\ProjectInterface
   *   The called Project entity.
   */
  public function setPublished($published);

  /**
   * Gets the Project revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Project revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\iol_project\Entity\ProjectInterface
   *   The called Project entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Project revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Project revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\iol_project\Entity\ProjectInterface
   *   The called Project entity.
   */
  public function setRevisionUserId($uid);

}
