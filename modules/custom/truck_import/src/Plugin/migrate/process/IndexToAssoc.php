<?php

namespace Drupal\truck_import\Plugin\migrate\process;

use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\Row;
use Drupal\Component\Utility\UrlHelper;

/**
 * Provides a 'IndexToAssoc' migrate process plugin.
 *
 * @MigrateProcessPlugin(
 *  id = "index_to_assoc"
 * )
 */
class IndexToAssoc extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    $keys = $this->configuration['keys'];
    $result = [];
    foreach($keys as $index => $key) {
      $result[$key] = $value[$index];
    }
    return $result;
  }
}
