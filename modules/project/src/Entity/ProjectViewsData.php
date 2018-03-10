<?php

namespace Drupal\iol_project\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Project entities.
 */
class ProjectViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
