<?php

/**
 * @file
 * Contains \Drupal\siteinfo_overwrite\EventSubscriber\PageRedirectSubscriber
 */
 
namespace Drupal\siteinfo_overwrite\EventSubscriber;
 
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
 
class PageRedirectSubscriber implements EventSubscriberInterface {
 
  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    // This announces which events you want to subscribe to.
    // We only need the request event for this example.  Pass
    // this an array of method names
    return([
      KernelEvents::REQUEST => [
        ['redirectPageContentTypeNode'],
      ]
    ]);
  }
 
  /**
   * Redirect requests for page_content_type node detail pages to node/123.
   *
   * @param GetResponseEvent $event
   * @return void
   */
  public function redirectPageContentTypeNode(GetResponseEvent $event) {
     
    $node = \Drupal::routeMatch()->getParameter('node');
    if (isset($node)) {
      $nodeType = $node->getType();
      $nodeId = $node->id();
      $siteApi = \Drupal::config('system.site')->get('siteapikey');

      // Only redirect a certain content type, Only redirect a certain content type, 
      if ($nodeType !== 'page' && empty($nodeId) && empty($siteApi)) {
        $response = new RedirectResponse('system/403');
        $event->setResponse($response);
      }      
    }
  }
 
}