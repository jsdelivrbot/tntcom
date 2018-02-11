<?php

namespace Drupal\asset_injector\Entity;

use Drupal;
use Drupal\asset_injector\AssetInjectorInterface;
use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\Component\Utility\Unicode;

/**
 * Class AssetInjectorBase: Base asset injector class.
 *
 * @package Drupal\asset_injector\AssetInjectorBase.
 */
class AssetInjectorBase extends ConfigEntityBase implements AssetInjectorInterface {

  /**
   * Extension of the asset. Override in entity.
   *
   * @var string
   */
  public $extension = NULL;

  /**
   * The Asset Injector ID.
   *
   * @var string
   */
  public $id;

  /**
   * The Js Injector label.
   *
   * @var string
   */
  public $label;

  /**
   * The code of the asset.
   *
   * @var string
   */
  public $code;

  /**
   * Themes to apply.
   *
   * @var array
   */
  public $themes;

  /**
   * Whitelist/blacklist pages.
   *
   * @var bool
   */
  public $visibility;

  /**
   * Pages to whitelist/blacklist.
   *
   * @var string
   */
  public $pages;

  /**
   * Node type to apply asset.
   *
   * @var string
   */
  public $nodeType;

  /**
   * Checks if the theme & page settings are appropriate for the given page.
   *
   * @return bool
   *   If the asset is enabled & applicable to current page.
   */
  public function isActive() {
    if (!$this->status()) {
      return FALSE;
    }

    $theme = Drupal::theme()->getActiveTheme()->getName();

    if (empty($this->themes) || in_array($theme, $this->themes)) {
      if (!empty($this->nodeType)) {
        $node = Drupal::routeMatch()->getParameter('node');
        if (is_object($node) && $node->getType() == $this->nodeType) {
          return TRUE;
        }
        else {
          return FALSE;
        }
      }

      $pages = rtrim($this->pages);
      if (empty($pages)) {
        return TRUE;
      }

      $path = Drupal::service('path.current')->getPath();
      $path_alias = Unicode::strtolower(Drupal::service('path.alias_manager')
        ->getAliasByPath($path));
      $page_match = Drupal::service('path.matcher')
        ->matchPath($path_alias, $pages) || (($path != $path_alias) && Drupal::service('path.matcher')
          ->matchPath($path, $pages));

      // When $rule->visibility has a value of 0, the asset is
      // added on all pages except those listed in $rule->pages.
      // When set to 1, it is added only on those pages listed in $rule->pages.
      if (!($this->visibility xor $page_match)) {
        return TRUE;
      }
    }
    return FALSE;
  }

  /**
   * Get the assets' file name.
   *
   * @return bool|string
   *   File name or false if no file provided.
   */
  public function getFile() {
    if ($this->extension) {
      return $this->buildUri("asset_injector/$this->id.$this->extension");
    }
    return FALSE;
  }

  /**
   * Gets the library array used in library_info_build.
   *
   * @return array
   *   Library array for the rule.
   */
  public function getLibrary() {
    return array();
  }

  /**
   * Creates the asset file.
   *
   * @param bool $replace
   *   Replace the file if it exists.
   */
  public function createFile($replace = FALSE) {
    if ($replace || !file_exists($this->getFile())) {
      $directory = $this->buildUri('asset_injector');
      file_prepare_directory($directory, FILE_CREATE_DIRECTORY | FILE_MODIFY_PERMISSIONS);
      file_unmanaged_save_data($this->code, $this->getFile(), FILE_EXISTS_REPLACE);
    }
  }

  /**
   * Constructs a URI to Drupal's public files location given a relative path.
   */
  protected function buildUri($path) {
    $uri = 'public://' . $path;
    return file_stream_wrapper_uri_normalize($uri);
  }

  /**
   * Deletes the asset file if it exists.
   */
  public function deleteFile() {
    if ($file = $this->getFile()) {
      file_unmanaged_delete_recursive($file);
    }
  }

  /**
   * Get the attachment portion for page modifications.
   *
   * @return bool|string
   *   Attachment string for use in page attachments.
   *
   * @see asset_injector_page_attachments()
   */
  public function getAttachment() {
    if ($this->extension) {
      return "asset_injector/$this->extension/$this->id";
    }
    return FALSE;
  }

}
