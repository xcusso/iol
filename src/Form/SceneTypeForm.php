<?php

namespace Drupal\iol\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SceneTypeForm.
 */
class SceneTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $scene_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $scene_type->label(),
      '#description' => $this->t("Label for the Scene type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $scene_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\iol\Entity\SceneType::load',
      ],
      '#disabled' => !$scene_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $scene_type = $this->entity;
    $status = $scene_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Scene type.', [
          '%label' => $scene_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Scene type.', [
          '%label' => $scene_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($scene_type->toUrl('collection'));
  }

}
