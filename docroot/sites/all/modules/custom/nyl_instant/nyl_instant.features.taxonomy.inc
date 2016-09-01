<?php
/**
 * @file
 * nyl_instant.features.taxonomy.inc
 */

/**
 * Implements hook_taxonomy_default_vocabularies().
 */
function nyl_instant_taxonomy_default_vocabularies() {
  return array(
    'instant_game_categories' => array(
      'name' => 'Instant Game Terms',
      'machine_name' => 'instant_game_categories',
      'description' => 'Tag for Instant Games on Ways-to-Play',
      'hierarchy' => 0,
      'module' => 'taxonomy',
      'weight' => 0,
      'rdf_mapping' => array(
        'rdftype' => array(
          0 => 'skos:ConceptScheme',
        ),
        'name' => array(
          'predicates' => array(
            0 => 'dc:title',
          ),
        ),
        'description' => array(
          'predicates' => array(
            0 => 'rdfs:comment',
          ),
        ),
      ),
    ),
  );
}
