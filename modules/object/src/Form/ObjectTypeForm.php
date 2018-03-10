<?php

namespace Drupal\iol_object\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ObjectTypeForm.
 */
class ObjectTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $object_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $object_type->label(),
      '#description' => $this->t("Label for the Object type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $object_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\iol_object\Entity\ObjectType::load',
      ],
      '#disabled' => !$object_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $object_type = $this->entity;
    $status = $object_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Object type.', [
          '%label' => $object_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Object type.', [
          '%label' => $object_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($object_type->toUrl('collection'));
  }

}
