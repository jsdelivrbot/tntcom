<?php
namespace Drupal\truck_import\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Routing\TrustedRedirectResponse;
use Drupal\Core\Url;

class TruckNotFound extends ControllerBase {
  /**
   * Controller for sending /trucks/* to /trucks
   */
  public function notFound($title) {
    $config = $this->config('truck_import.settings');
    $path = Url::fromRoute('<current>')->getInternalPath();
    \Drupal::logger('truck_import')->notice('Redirecting path: %path', ['%path' => $path]);
    // To modify, run ... drush cset truck_import.settings redirect_status_code 301
    $status_code = $config->get('redirect_status_code'); // 302=temporary, 301=permanent
    // To modify, run ... drush cset truck_import.settings redirect_path '/node'
    $redirect_path = $config->get('redirect_path'); // defaults to '/trucks'
    return new TrustedRedirectResponse($redirect_path, $status_code);
  } 
}
