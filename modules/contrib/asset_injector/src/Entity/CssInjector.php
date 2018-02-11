<?php

namespace Drupal\asset_injector\Entity;

/**
 * Defines the Css Injector entity.
 *
 * @ConfigEntityType(
 *   id = "css_injector",
 *   label = @Translation("Css Injector"),
 *   handlers = {
 *     "list_builder" = "Drupal\asset_injector\AssetInjectorListBuilder",
 *     "form" = {
 *       "add" = "Drupal\asset_injector\Form\CssInjectorForm",
 *       "edit" = "Drupal\asset_injector\Form\CssInjectorForm",
 *       "delete" = "Drupal\asset_injector\Form\AssetInjectorDeleteForm",
 *       "enable" = "Drupal\asset_injector\Form\AssetInjectorEnableForm",
 *       "disable" = "Drupal\asset_injector\Form\AssetInjectorDisableForm",
 *       "duplicate" = "Drupal\asset_injector\Form\CssInjectorDuplicateForm",
 *     },
 *   },
 *   config_prefix = "css_injector",
 *   admin_permission = "administer css assets injector",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/config/development/asset-injector/css/{css_injector}",
 *     "edit-form" = "/admin/config/development/asset-injector/css/{css_injector}/edit",
 *     "delete-form" = "/admin/config/development/asset-injector/css/{css_injector}/delete",
 *     "enable" = "/admin/config/development/asset-injector/css/{css_injector}/enable",
 *     "disable" = "/admin/config/development/asset-injector/css/{css_injector}/disable",
 *     "collection" = "/admin/structure/visibility_group"
 *   }
 * )
 */
class CssInjector extends AssetInjectorBase {
  /**
   * Themes to apply.
   *
   * @var array
   */
  public $themes;

  /**
   * Media selector.
   *
   * @var string
   */
  public $media;

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
  public $extension = 'css';

  /**
   * Overrides parent::getLibrary().
   */
  public function getLibrary() {
    $url = parse_url(file_create_url($this->buildUri("asset_injector/$this->id.css")));
    $url['path'] = str_replace(base_path(), '/', $url['path']);
    $libraries["css/$this->id"] = [
      'css' => [
        'theme' => [
          $url['path'] => [
            'weight' => 0,
            'preprocess' => is_null($this->preprocess) ? FALSE : $this->preprocess,
            'media' => $this->media,
          ],
        ],
      ],
    ];
    return $libraries;
  }

}
