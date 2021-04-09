<?php

namespace Drupal\axelerant_coding_test\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Routing\CurrentRouteMatch;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Access\AccessResult;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Returns json data for dynamic node id which is passed in URL.
 */
class GetJsonRepresentation extends ControllerBase {

  protected $route_match;
  protected $entity_type_manager;
  protected $configFactory;

  /**
   * {@inheritdoc}
   */
  public function __construct(CurrentRouteMatch $route_match, EntityTypeManagerInterface $entity_type_manager, ConfigFactoryInterface $config_factory) {
    $this->routeMatch = $route_match;
    $this->entityTypeManager = $entity_type_manager;
    $this->configFactory = $config_factory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('current_route_match'),
      $container->get('entity_type.manager'),
      $container->get('config.factory')
    );
  }

  /**
   * Prints Json response for page node.
   */
  public function printJsonRespnse() {
    $node_id = $this->routeMatch->getParameter('node_id');
    $node_load_value = $this->entityTypeManager->getStorage('node')->load($node_id);
    $simple_node_value = [
      'nid' => $node_load_value->nid->value,
      'title' => $node_load_value->title->value,
      'body' => $node_load_value->body->value,
    ];
    return new JsonResponse($simple_node_value);
  }

  /**
   * Access checking is done based on api key value and node id.
   */
  public function access() {
    $site_api_key = $this->routeMatch->getParameter('site_api_key');
    $node_id = $this->routeMatch->getParameter('node_id');
    $values = [
      'type' => 'page',
      'nid' => $node_id,
    ];
    // Get the node data.
    $node_load = $this->entityTypeManager->getStorage('node')->loadByProperties($values);
    $config_site_api_key = $this->configFactory->getEditable('axelerant_coding_test.settings')->get('siteapikey');
    if ($config_site_api_key != $site_api_key || empty($node_load) || $config_site_api_key == "No API Key yet") {
      return AccessResult::forbidden();
    }
    return AccessResult::allowed();
  }

}
