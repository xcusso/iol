<?php

namespace Drupal\iol;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Scene entity.
 *
 * @see \Drupal\iol\Entity\Scene.
 */
class SceneAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\iol\Entity\SceneInterface $entity */
    $is_owner = $entity->getOwnerId() === $account->id();

    switch ($operation) {
      case 'view':
        if ($is_owner) {
          return AccessResult::allowedIfHasPermission($account, 'view own iol entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view any iol entities');

      case 'update':
        if ($is_owner) {
          return AccessResult::allowedIfHasPermission($account, 'edit own iol entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'edit own iol entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete iol entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add iol entities');
  }

}
