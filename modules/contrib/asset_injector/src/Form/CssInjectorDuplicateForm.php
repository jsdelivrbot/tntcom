<?php

namespace Drupal\asset_injector\Form;

use Drupal\Core\Form\FormStateInterface;

/**
 * Class CssInjectorDuplicateForm.
 *
 * @package Drupal\asset_injector\Form
 */
class CssInjectorDuplicateForm extends CssInjectorForm {

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
