<?php

namespace Drupal\iol_object\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Object type entity.
 *
 * @ConfigEntityType(
 *   id = "object_type",
 *   label = @Translation("Object type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\iol_object\ObjectTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\iol_object\Form\ObjectTypeForm",
 *       "edit" = "Drupal\iol_object\Form\ObjectTypeForm",
 *       "delete" = "Drupal\iol_object\Form\ObjectTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\iol_object\ObjectTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "object_type",
 *   admin_permission = "administer iol",
 *   bundle_of = "object",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/iol/config/object_type/{object_type}",
 *     "add-form" = "/admin/iol/config/object_type/add",
 *     "edit-form" = "/admin/iol/config/object_type/{object_type}/edit",
 *     "delete-form" = "/admin/iol/config/object_type/{object_type}/delete",
 *     "collection" = "/admin/iol/config/object_type"
 *   }
 * )
 */
class ObjectType extends ConfigEntityBundleBase implements ObjectTypeInterface {

  /**
   * The Object type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Object type label.
   *
   * @var string
   */
  protected $label;

}
