<?php
/**
 * @file
 * nyl_county_report.feeds_importer_default.inc
 */

/**
 * Implements hook_feeds_importer_default().
 */
function nyl_county_report_feeds_importer_default() {
  $export = array();

  $feeds_importer = new stdClass();
  $feeds_importer->disabled = FALSE; /* Edit this to true to make a default feeds_importer disabled initially */
  $feeds_importer->api_version = 1;
  $feeds_importer->id = 'county_reports';
  $feeds_importer->config = array(
    'name' => 'County Reports',
    'description' => 'Upload County Report CSV for Benefitting New Yorkers',
    'fetcher' => array(
      'plugin_key' => 'FeedsFileFetcher',
      'config' => array(
        'allowed_extensions' => 'txt csv tsv xml opml',
        'direct' => 0,
        'directory' => 'public://feeds',
        'allowed_schemes' => array(
          'public' => 'public',
        ),
      ),
    ),
    'parser' => array(
      'plugin_key' => 'FeedsCSVParser',
      'config' => array(
        'delimiter' => 'TAB',
        'encoding' => 'UTF-8',
        'no_headers' => 0,
      ),
    ),
    'processor' => array(
      'plugin_key' => 'FeedsFieldCollectionProcessor',
      'config' => array(
        'field_name' => 'field_county_report',
        'host_entity_type' => 'node',
        'is_field' => 1,
        'guid_field_name' => 'field_report_year',
        'identifier_field_name' => 'field_county_name',
        'mappings' => array(
          0 => array(
            'source' => 'Year',
            'target' => 'host_entity_guid',
            'unique' => FALSE,
            'language' => 'und',
          ),
          1 => array(
            'source' => 'Name',
            'target' => 'field_county_name',
            'unique' => FALSE,
            'language' => 'und',
          ),
          2 => array(
            'source' => 'School Distribution ($)',
            'target' => 'field_report_dollar_1',
            'unique' => FALSE,
            'language' => 'und',
          ),
          3 => array(
            'source' => 'School Cumulative Distribution ($)',
            'target' => 'field_report_dollar_2',
            'unique' => FALSE,
            'language' => 'und',
          ),
        ),
        'insert_new' => '1',
        'update_existing' => '2',
        'update_non_existent' => 'delete',
        'input_format' => 'plain_text',
        'skip_hash_check' => 1,
        'bundle' => 'field_county_report',
        'language' => 'und',
      ),
    ),
    'content_type' => 'nyl_county_report',
    'update' => 0,
    'import_period' => '-1',
    'expire_period' => 3600,
    'import_on_create' => 1,
    'process_in_background' => 0,
  );
  $export['county_reports'] = $feeds_importer;

  return $export;
}
