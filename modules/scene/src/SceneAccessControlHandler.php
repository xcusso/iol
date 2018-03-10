<?php

namespace Drupal\iol_scene;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Scene entity.
 *
 * @see \Drupal\iol_scene\Entity\Scene.
 */
class SceneAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\iol_scene\Entity\SceneInterface $entity */
    $is_owner = $entity->getOwnerId() === $account->id();

    switch ($operation) {
      case 'view':
        if ($is_owner) {
          return AccessResult::allowedIfHasPermission($account, 'view own scenes entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view any scenes entities');

      case 'update':
        if ($is_owner) {
           return AccessResult::allowedIfHasPermission($account, 'edit own scenes entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'edit any scenes entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete scenes entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add scenes entities');
  }

}
