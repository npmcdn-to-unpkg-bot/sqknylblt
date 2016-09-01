<?php
/**
 * @file
 * nyl_core.features.menu_links.inc
 */

/**
 * Implements hook_menu_default_menu_links().
 */
function nyl_core_menu_default_menu_links() {
  $menu_links = array();

  // Exported menu link: menu-footer_-accessibility:<front>.
  $menu_links['menu-footer_-accessibility:<front>'] = array(
    'menu_name' => 'menu-footer',
    'link_path' => '<front>',
    'router_path' => '',
    'link_title' => ' Accessibility',
    'options' => array(
      'attributes' => array(),
      'identifier' => 'menu-footer_-accessibility:<front>',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 1,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 1,
  );
  // Exported menu link: menu-footer_agencies:<front>.
  $menu_links['menu-footer_agencies:<front>'] = array(
    'menu_name' => 'menu-footer',
    'link_path' => '<front>',
    'router_path' => '',
    'link_title' => 'Agencies',
    'options' => array(
      'attributes' => array(),
      'identifier' => 'menu-footer_agencies:<front>',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 1,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 1,
  );
  // Exported menu link: menu-footer_app-directory:<front>.
  $menu_links['menu-footer_app-directory:<front>'] = array(
    'menu_name' => 'menu-footer',
    'link_path' => '<front>',
    'router_path' => '',
    'link_title' => 'App Directory',
    'options' => array(
      'attributes' => array(),
      'identifier' => 'menu-footer_app-directory:<front>',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 1,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 1,
  );
  // Exported menu link: menu-footer_counties:<front>.
  $menu_links['menu-footer_counties:<front>'] = array(
    'menu_name' => 'menu-footer',
    'link_path' => '<front>',
    'router_path' => '',
    'link_title' => 'Counties',
    'options' => array(
      'attributes' => array(),
      'identifier' => 'menu-footer_counties:<front>',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 1,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 1,
  );
  // Exported menu link: menu-footer_disclaimer:<front>.
  $menu_links['menu-footer_disclaimer:<front>'] = array(
    'menu_name' => 'menu-footer',
    'link_path' => '<front>',
    'router_path' => '',
    'link_title' => 'Disclaimer',
    'options' => array(
      'attributes' => array(),
      'identifier' => 'menu-footer_disclaimer:<front>',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 1,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 1,
  );
  // Exported menu link: menu-footer_events:<front>.
  $menu_links['menu-footer_events:<front>'] = array(
    'menu_name' => 'menu-footer',
    'link_path' => '<front>',
    'router_path' => '',
    'link_title' => 'Events',
    'options' => array(
      'attributes' => array(),
      'identifier' => 'menu-footer_events:<front>',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 1,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 1,
  );
  // Exported menu link: menu-footer_privacy-policy:<front>.
  $menu_links['menu-footer_privacy-policy:<front>'] = array(
    'menu_name' => 'menu-footer',
    'link_path' => '<front>',
    'router_path' => '',
    'link_title' => 'Privacy Policy',
    'options' => array(
      'attributes' => array(),
      'identifier' => 'menu-footer_privacy-policy:<front>',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 1,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 1,
  );
  // Exported menu link: menu-footer_programs:<front>.
  $menu_links['menu-footer_programs:<front>'] = array(
    'menu_name' => 'menu-footer',
    'link_path' => '<front>',
    'router_path' => '',
    'link_title' => 'Programs',
    'options' => array(
      'attributes' => array(),
      'identifier' => 'menu-footer_programs:<front>',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 1,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 1,
  );
  // Exported menu link: menu-footer_services:<front>.
  $menu_links['menu-footer_services:<front>'] = array(
    'menu_name' => 'menu-footer',
    'link_path' => '<front>',
    'router_path' => '',
    'link_title' => 'Services',
    'options' => array(
      'attributes' => array(),
      'identifier' => 'menu-footer_services:<front>',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 1,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 1,
  );
  // Exported menu link: menu-footer_site-map:<front>.
  $menu_links['menu-footer_site-map:<front>'] = array(
    'menu_name' => 'menu-footer',
    'link_path' => '<front>',
    'router_path' => '',
    'link_title' => 'Site Map',
    'options' => array(
      'attributes' => array(),
      'identifier' => 'menu-footer_site-map:<front>',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 1,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 1,
  );
  // Exported menu link: menu-nys_government:http://www.ny.gov/services.
  $menu_links['menu-nys_government:http://www.ny.gov/services'] = array(
    'menu_name' => 'menu-nys',
    'link_path' => 'http://www.ny.gov/services',
    'router_path' => '',
    'link_title' => 'Government',
    'options' => array(
      'attributes' => array(),
      'identifier' => 'menu-nys_government:http://www.ny.gov/services',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 1,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -48,
    'customized' => 1,
  );
  // Exported menu link: menu-nys_local:http://www.ny.gov/services.
  $menu_links['menu-nys_local:http://www.ny.gov/services'] = array(
    'menu_name' => 'menu-nys',
    'link_path' => 'http://www.ny.gov/services',
    'router_path' => '',
    'link_title' => 'Local',
    'options' => array(
      'attributes' => array(),
      'identifier' => 'menu-nys_local:http://www.ny.gov/services',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 1,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -47,
    'customized' => 1,
  );
  // Exported menu link: menu-nys_news:http://governor.ny.gov/news.
  $menu_links['menu-nys_news:http://governor.ny.gov/news'] = array(
    'menu_name' => 'menu-nys',
    'link_path' => 'http://governor.ny.gov/news',
    'router_path' => '',
    'link_title' => 'News',
    'options' => array(
      'attributes' => array(),
      'identifier' => 'menu-nys_news:http://governor.ny.gov/news',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 1,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -49,
    'customized' => 1,
  );
  // Exported menu link: menu-nys_services:http://www.ny.gov/services.
  $menu_links['menu-nys_services:http://www.ny.gov/services'] = array(
    'menu_name' => 'menu-nys',
    'link_path' => 'http://www.ny.gov/services',
    'router_path' => '',
    'link_title' => 'Services',
    'options' => array(
      'attributes' => array(),
      'identifier' => 'menu-nys_services:http://www.ny.gov/services',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 1,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -50,
    'customized' => 1,
  );
  // Exported menu link: menu-nys_translate:<front>.
  $menu_links['menu-nys_translate:<front>'] = array(
    'menu_name' => 'menu-nys',
    'link_path' => '<front>',
    'router_path' => '',
    'link_title' => 'Translate',
    'options' => array(
      'attributes' => array(
        'class' => array(
          0 => 'translate',
          1 => 'hidden-xs',
        ),
      ),
      'item_attributes' => array(
        'id' => '',
        'class' => '',
        'style' => '',
      ),
      'identifier' => 'menu-nys_translate:<front>',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 1,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 1,
  );

  // Translatables
  // Included for use with string extractors like potx.
  t(' Accessibility');
  t('Agencies');
  t('App Directory');
  t('Counties');
  t('Disclaimer');
  t('Events');
  t('Government');
  t('Local');
  t('News');
  t('Privacy Policy');
  t('Programs');
  t('Services');
  t('Site Map');
  t('Translate');

  return $menu_links;
}
