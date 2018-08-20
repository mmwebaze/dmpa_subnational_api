<?php

namespace Drupal\dmpa_subnational_api\services;

/**
 * Interface SubnationalManagerInterface.
 */
interface SubnationalManagerInterface {

  /**
   * Processes list of subnational levels based on the countryId. This id is a
   * taxonomy term id
   *
   * @param $countryId
   *
   * @return array mixed
   *
   * An array sub-national levels associated with the country selected
   */
  public function getSubnationals($countryId);
}
