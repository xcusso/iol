<?php

namespace Drupal\iol_object;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Object entity.
 *
 * @see \Drupal\iol_object\Entity\Object.
 */
class ObjectAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\iol_object\Entity\ObjectInterface $entity */
    $is_owner = $entity->getOwnerId() === $account->id();

    switch ($operation) {
      case 'view':
        if ($is_owner) {
          return AccessResult::allowedIfHasPermission($account, 'view own objects entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view any objects entities');

      case 'update':
        if ($is_owner) {
           return AccessResult::allowedIfHasPermission($account, 'edit own objects entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'edit any objects entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete objects entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add objects entities');
  }

}