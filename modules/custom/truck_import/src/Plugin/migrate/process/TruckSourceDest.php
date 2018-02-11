<?php

namespace Drupal\truck_import\Plugin\migrate\process;

use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\MigrateSkipProcessException;
use Drupal\migrate\Row;
use Drupal\Component\Utility\UrlHelper;

/**
 * Provides a 'TruckSourceDest' migrate process plugin.
 *
 * @MigrateProcessPlugin(
 *  id = "truck_source_dest"
 * )
 */
class TruckSourceDest extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    if (empty($value)) {
      // Skip this item if there's no URL.
      throw new MigrateSkipProcessException();
    }
    // parse the source URL
    $url = UrlHelper::parse($value);
    // and get the 'id' query parameter from it.
    $id = $url['query']['id'];
    // then build the destination path from it
    $prefix = $this->configuration['dest_prefix'] ?: '';
    $suffix = $this->configuration['dest_suffix'] ?: '';
    $dest = $prefix . $id . $suffix;

    return [$value, $dest];
  }
}
