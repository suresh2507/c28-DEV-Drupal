<?php
/**
 * @file
 * Contains \Drupal\siteinfo_overwrite\Routing\RouteSubscriber.
 */

namespace Drupal\siteinfo_overwrite\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    /*
     * { check the Site information router}
     */
    if ($route = $collection->get('system.site_information_settings')) {
      $route->setDefault('_form', '\Drupal\siteinfo_overwrite\Form\UpdateSiteInfoForm');
    }

  }
}
