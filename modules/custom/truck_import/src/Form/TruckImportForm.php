<?php

namespace Drupal\truck_import\Form;

use Drupal\Core\Url;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\migrate\Plugin\MigrationInterface;
use Drupal\migrate_tools\MigrateExecutable;
use Drupal\migrate\MigrateMessage;

/**
 * Class TruckImportForm.
 */
class TruckImportForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'truck_import_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['help'] = [
      '#type' => 'item',
      '#title' => $this->t('Read this'),
      '#description' => $this->t('This form allows you to upload a CSV file containing truck inventory data (that was exported from truckpaper.com) and import each row of that CSV file as a Truck node along with associated images.'),
    ];
    $form['rollback'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Remove previous?'),
      '#description' => $this->t('Should we remove previously imported Truck content? Uncheck this if you want to only add content instead of replacing existing.'),
      '#default_value' => TRUE,
    ];
    $form['csv_file'] = [
      '#type' => 'file',
      '#title' => $this->t('CSV File'),
      '#description' => $this->t('Upload CSV file containing truck inventory data that was exported from truckpaper.com. Leaving this empty while running the import will delete all existing truck inventory content.'),
      '#multiple' => FALSE,
      '#upload_validators' => [
        'file_validate_extensions' => ['csv'],
      ],
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Import'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // parent::submitForm($form, $form_state);
    /** @var $csv_file \Drupal\file\FileInterface */
    $validators = [
      'file_validate_extensions' => ['csv'],
    ];
    $dest_dir = 'public://import';
    file_prepare_directory($dest_dir, FILE_CREATE_DIRECTORY | FILE_MODIFY_PERMISSIONS);
    $csv_file = file_save_upload('csv_file', $validators, $dest_dir, 0, FILE_EXISTS_REPLACE);
    $options = [];
    if($csv_file) {
      $options['source']['path'] = $csv_file->getFileUri();
    }
    /* @var MigrationInterface */
    $migration = \Drupal::service('plugin.manager.migration')->createInstance('trucks', $options);
    if(!$migration) {
      drupal_set_message($this->t('Import migration not found.'), 'error');
      return;
    }
    /** @var $executable Drupal\migrate\MigrateExecutable */
    $executable = new MigrateExecutable($migration, new MigrateMessage());
    if($form_state->getValue('rollback')) {
      if($executable->rollback() !== MigrationInterface::RESULT_COMPLETED) {
        drupal_set_message($this->t('Rollback failed. See logs.'), 'error');
        return;
      } else {
      $this->deleteUnusedFiles();
        drupal_set_message($this->t('Removed previously imported content.'));
      }
    }
    $executable = new MigrateExecutable($migration, new MigrateMessage());
    if($csv_file) {
      if($executable->import() !== MigrationInterface::RESULT_COMPLETED) {
        drupal_set_message($this->t('Import failed. See logs.'), 'error');
        return;
      } else {
        drupal_set_message($this->t('Processed %numitems items (%created created, %updated updated, %failures failed, %ignored ignored)', ['%numitems' => $executable->getProcessedCount(),'%created' => $executable->getCreatedCount(), '%updated' => $executable->getUpdatedCount(), '%failures' => $executable->getFailedCount(), '%ignored' => $executable->getIgnoredCount()]));

        $url = Url::fromRoute('system.admin_content')->toString();
        drupal_set_message($this->t('Browse <a href=":url">new content</a>', [':url' => $url]));
      }
    }
    // success
  }

  private function deleteUnusedFiles() {
    $result = db_query("SELECT fm.*
      FROM {file_managed} AS fm
      LEFT OUTER JOIN {file_usage} AS fu ON ( fm.fid = fu.fid )
      LEFT OUTER JOIN {node} AS n ON ( fu.id = n.nid )
      WHERE (fu.type = 'node' OR fu.type IS NULL) AND n.nid IS NULL
      AND fm.uri LIKE 'public://images-truck/%'
      ORDER BY `fm`.`fid`  DESC");
    //Delete file & database entry
    foreach ($result as $delta => $record) {
      file_delete($record->fid);
    }
  }
}
