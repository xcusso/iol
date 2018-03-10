<?php

/**
 * @file
 * Contains scene.page.inc.
 *
 * Page callback for Scene entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Scene templates.
 *
 * Default template: scene.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_scene(array &$variables) {
  // Fetch Scene Entity Object.
  $scene = $variables['elements']['#scene'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
