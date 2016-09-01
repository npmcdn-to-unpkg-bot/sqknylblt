<?php

function nyl_api_admin() {
  $form = array();

  $options = array(
    'https://app.mrmclient.com/nyl/v1',
    'https://staging.nylgames.mrmdigital.com/nyl/v1',
    'https://api.playnylottry.ney/yl/v1',
  );
  $form['nyl_api_server_url'] = array(
    '#type' => 'select',
    '#title' => t('NYLottery API Server URL'),
    '#options' => drupal_map_assoc($options),
    '#default_value' => variable_get('nyl_api_server_url'),
    '#description' => t("In Production, this values is defined by settings.php"),
    '#required' => TRUE,
  );
  $form['nyl_api_client_id'] = array(
    '#type' => 'textfield',
    '#title' => t('Client Id'),
    '#default_value' => variable_get('nyl_api_client_id'),
    '#description' => t("Self-generated UUID version 4: (xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx) where x is any hexadecimal digit and y is one of 8, 9, a, or b."),
    '#size' => 255,
    '#maxlength' => 255,
    '#required' => TRUE,
  );
  $form['nyl_api_client_secret'] = array(
    '#type' => 'textfield',
    '#title' => t('Client Secret'),
    '#default_value' => variable_get('nyl_api_client_secret'),
    '#description' => t("Access Token for use in TC01_3"),
    '#size' => 255,
    '#maxlength' => 255,
    '#required' => TRUE,
  );
  $form['nyl_api_username'] = array(
    '#type' => 'textfield',
    '#title' => t('Username / eMail'),
    '#default_value' => variable_get('nyl_api_username'),
    '#description' => t("The Client ID from 'Create new User' [TC01_4]"),
    '#size' => 255,
    '#maxlength' => 255,
    '#required' => TRUE,
  );
  $form['nyl_api_password'] = array(
    '#type' => 'textfield',
    '#title' => t('Password'),
    '#default_value' => variable_get('nyl_api_password'),
    '#description' => t("The Client Secret from 'Create new User' [TC01_4]."),
    '#size' => 255,
    '#maxlength' => 255,
    '#required' => TRUE,
  );
  $form['nyl_api_cache_expire_min'] = array(
    '#type' => 'select',
    '#title' => t('Cache Expire Minimum, to be nice.'),
    '#options' => array_combine(range(60, 3600, 60), range(1, 60)),
    '#default_value' => (int) variable_get('nyl_api_cache_expire_min', NYL_API_CACHE_EXPIRE_MIN),
    '#description' => t("In Production, this values is defined by settings.php"),
    '#field_suffix' => t('minutes'),
    '#required' => TRUE,
    '#required' => TRUE,
  );
  return system_settings_form($form);
}



/**
 * $oauth2_config = array(
    'token_endpoint' => variable_get('nyl_api_server_url') . '/auth/token',
    'auth_flow' => 'user-password',
    'client_id' => 'a4b7226f-1141-4592-b9aa-18f0310f7a02',
    'client_secret' => '59adf4ae-3a31-4a7e-97d2-cf54bd4a9773',
    'username' => 'william.choy@squeaky.com',
    'password' => 'abcd1234'
  );
 *
 */