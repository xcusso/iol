<?php

/**
 * @file
 * Contains object.page.inc.
 *
 * Page callback for Object entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Object templates.
 *
 * Default template: object.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_object(array &$variables) {
  // Fetch Object Entity Object.
  $object = $variables['elements']['#object'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
