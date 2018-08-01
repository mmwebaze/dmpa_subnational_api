<?php

namespace Drupal\dmpa_subnational_api\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\dmpa_subnational_api\services\SubnationalManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class SubnationalController extends ControllerBase {

  /**
   * @var \Drupal\dmpa_subnational_api\services\SubnationalManagerInterface
   */
  protected $subnationalManager;

  public function __construct(SubnationalManagerInterface $subnationalManager){
    $this->subnationalManager = $subnationalManager;
  }
  /**
   * api/subnationals/{countryId} end point
   */
  public function getSubnationalLevel( Request $request ){
    $country = $request->attributes->get('countryId');
    $subs = $this->subnationalManager->getSubnationals($country);

    return new JsonResponse(  $subs );
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('dmpa_subnational_api.manager')
    );
  }
}