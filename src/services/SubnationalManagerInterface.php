<?php

namespace Drupal\dmpa_subnational_api\services;

/**
 * Interface SubnationalManagerInterface.
 */
interface SubnationalManagerInterface {

  public function getSubnationals($country);
}
