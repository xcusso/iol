<?php

namespace Drupal\iol_project;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Project entity.
 *
 * @see \Drupal\iol_project\Entity\Project.
 */
class ProjectAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\iol_project\Entity\ProjectInterface $entity */
    $is_owner = $entity->getOwnerId() === $account->id();

    switch ($operation) {
      case 'view':
        if ($is_owner) {
          return AccessResult::allowedIfHasPermission($account, 'view own projects entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view any projects entities');

      case 'update':
        if ($is_owner) {
           return AccessResult::allowedIfHasPermission($account, 'edit own projects entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'edit any projects entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete projects entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add projects entities');
  }

}