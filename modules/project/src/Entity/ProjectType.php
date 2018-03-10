<?php

namespace Drupal\iol_project\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Project type entity.
 *
 * @ConfigEntityType(
 *   id = "project_type",
 *   label = @Translation("Project type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\iol_project\ProjectTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\iol_project\Form\ProjectTypeForm",
 *       "edit" = "Drupal\iol_project\Form\ProjectTypeForm",
 *       "delete" = "Drupal\iol_project\Form\ProjectTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\iol_project\ProjectTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "project_type",
 *   admin_permission = "administer iol",
 *   bundle_of = "project",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/iol/config/project_type/{project_type}",
 *     "add-form" = "/admin/iol/config/project_type/add",
 *     "edit-form" = "/admin/iol/config/project_type/{project_type}/edit",
 *     "delete-form" = "/admin/iol/config/project_type/{project_type}/delete",
 *     "collection" = "/admin/iol/config/project_type"
 *   }
 * )
 */
class ProjectType extends ConfigEntityBundleBase implements ProjectTypeInterface {

  /**
   * The Project type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Project type label.
   *
   * @var string
   */
  protected $label;

}
