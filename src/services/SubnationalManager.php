<?php

namespace Drupal\dmpa_subnational_api\services;

use Drupal\Core\Database\Driver\mysql\Connection;
use Drupal\Core\Entity\EntityTypeManagerInterface;

/**
 * Class SubnationalManager.
 */
class SubnationalManager implements SubnationalManagerInterface {

  /**
   * Drupal\Core\Database\Driver\mysql\Connection definition.
   *
   * @var \Drupal\Core\Database\Driver\mysql\Connection
   */
  protected $database;

  /**
   * Constructs a new SubnationalManager object.
   */
  public function __construct(Connection $database) {
    $this->database = $database;
  }

  public function getSubnationals($country) {

    $query = $this->database->select('taxonomy_term_field_data', 'd');
    $query->innerJoin('taxonomy_term_hierarchy', 'h', 'h.tid = d.tid');
    $query->innerJoin('taxonomy_term__field_country', 'c', 'c.entity_id = d.tid');
    $query->fields('h', ['tid', 'parent'])
      ->fields('d', ['name'])
      ->fields('c', ['field_country_target_id']);

    $query->condition('d.vid', 'subnational_level')
      ->condition('c.field_country_target_id', $country);

    $results = $query->execute()->fetchAll();

    $subnationals = [];
    foreach ($results as $result) {

      if ($result->parent == 0) {
        $subnationals[$result->tid] = $result->name;
      }
      else {
        $subnationals[$result->tid] = '- ' . $result->name;
      }
    }
    return $subnationals;
  }
}
