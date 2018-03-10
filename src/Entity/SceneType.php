<?php

namespace Drupal\iol\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Scene type entity.
 *
 * @ConfigEntityType(
 *   id = "scene_type",
 *   label = @Translation("Scene type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\iol\SceneTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\iol\Form\SceneTypeForm",
 *       "edit" = "Drupal\iol\Form\SceneTypeForm",
 *       "delete" = "Drupal\iol\Form\SceneTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\iol\SceneTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "scene_type",
 *   admin_permission = "administer iol",
 *   bundle_of = "scene",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/iol/config/scene_type/{scene_type}",
 *     "add-form" = "/admin/iol/config/scene_type/add",
 *     "edit-form" = "/admin/iol/config/scene_type/{scene_type}/edit",
 *     "delete-form" = "/admin/iol/config/scene_type/{scene_type}/delete",
 *     "collection" = "/admin/iol/config/scene_type"
 *   }
 * )
 */
class SceneType extends ConfigEntityBundleBase implements SceneTypeInterface {

  /**
   * The Scene type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Scene type label.
   *
   * @var string
   */
  protected $label;

}
