<?php

namespace Drupal\asset_injector\Entity;

/**
 * Defines the Js Injector entity.
 *
 * @ConfigEntityType(
 *   id = "js_injector",
 *   label = @Translation("Js Injector"),
 *   handlers = {
 *     "list_builder" = "Drupal\asset_injector\AssetInjectorListBuilder",
 *     "form" = {
 *       "add" = "Drupal\asset_injector\Form\JsInjectorForm",
 *       "edit" = "Drupal\asset_injector\Form\JsInjectorForm",
 *       "delete" = "Drupal\asset_injector\Form\AssetInjectorDeleteForm",
 *       "enable" = "Drupal\asset_injector\Form\AssetInjectorEnableForm",
 *       "disable" = "Drupal\asset_injector\Form\AssetInjectorDisableForm",
 *       "duplicate" = "Drupal\asset_injector\Form\JsInjectorDuplicateForm",
 *     }
 *   },
 *   config_prefix = "js_injector",
 *   admin_permission = "administer js assets injector",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/config/development/asset-injector/js/{js_injector}",
 *     "edit-form" = "/admin/config/development/asset-injector/js/{js_injector}/edit",
 *     "delete-form" = "/admin/config/development/asset-injector/js/{js_injector}/delete",
 *     "enable" = "/admin/config/development/asset-injector/js/{js_injector}/enable",
 *     "disable" = "/admin/config/development/asset-injector/js/{js_injector}/disable",
 *     "collection" = "/admin/structure/visibility_group"
 *   }
 * )
 */
class JsInjector extends AssetInjectorBase {
  /**
   * Extension of the asset.
   *
   * @var string
   */
  public $extension = 'js';

  /**
   * Preprocess css before adding.
   *
   * @var bool
   */
  public $preprocess;

  /**
   * Extension of the asset.
   *
   * @var string
   */
  public $jquery;

  /**
   * Overrides parent::getLibrary().
   */
  public function getLibrary() {
    $url = parse_url(file_create_url($this->buildUri("asset_injector/$this->id.js")));
    $url['path'] = str_replace(base_path(), '/', $url['path']);
    $libraries["js/$this->id"] = [
      'js' => [
        $url['path'] => [
          'preprocess' => is_null($this->preprocess) ? FALSE : $this->preprocess,
        ],
      ],
    ];

    if ($this->jquery) {
      $libraries["js/$this->id"]['dependencies'] = ['core/jquery'];
    }
    return $libraries;
  }

}
