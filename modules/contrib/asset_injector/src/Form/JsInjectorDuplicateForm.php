<?php

namespace Drupal\asset_injector\Form;

use Drupal\Core\Form\FormStateInterface;

/**
 * Class JsInjectorDuplicateForm.
 *
 * @package Drupal\asset_injector\Form
 */
class JsInjectorDuplicateForm extends JsInjectorForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $entity = $this->entity->createDuplicate();
    $entity->label = $this->t('Duplicate of @label', array('@label' => $this->entity->label()));
    $this->entity = $entity;
    return parent::form($form, $form_state);
  }

}
