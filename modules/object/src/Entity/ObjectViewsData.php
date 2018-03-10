<?php

namespace Drupal\iol_object\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Object entities.
 */
class ObjectViewsData extends EntityViewsData {

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
