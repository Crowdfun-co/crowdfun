<?php
/**
 * @file
 * crowdfun.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function crowdfun_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_views_api().
 */
function crowdfun_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_flag_default_flags().
 */
function crowdfun_flag_default_flags() {
  $flags = array();
  // Exported flag: "Vote".
  $flags['vote'] = array(
    'entity_type' => 'node',
    'title' => 'Vote',
    'global' => 0,
    'types' => array(
      0 => 'campaign',
    ),
    'flag_short' => 'up_vote',
    'flag_long' => '',
    'flag_message' => '',
    'unflag_short' => 'down_vote',
    'unflag_long' => '',
    'unflag_message' => '',
    'unflag_denied_text' => '',
    'link_type' => 'normal',
    'weight' => 0,
    'show_in_links' => array(
      'full' => 'full',
      'teaser' => 'teaser',
      'rss' => 0,
      'search_index' => 0,
      'search_result' => 0,
      'diff_standard' => 0,
      'token' => 0,
    ),
    'show_as_field' => 1,
    'show_on_form' => 0,
    'access_author' => '',
    'show_contextual_link' => FALSE,
    'i18n' => 0,
    'module' => 'crowdfun',
    'locked' => array(
      0 => 'name',
    ),
    'api_version' => 3,
  );
  return $flags;

}

/**
 * Implements hook_image_default_styles().
 */
function crowdfun_image_default_styles() {
  $styles = array();

  // Exported image style: featured_image.
  $styles['featured_image'] = array(
    'label' => 'Featured image (300x200)',
    'effects' => array(
      6 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 300,
          'height' => 200,
        ),
        'weight' => 1,
      ),
    ),
  );

  // Exported image style: surface_image.
  $styles['surface_image'] = array(
    'label' => 'Surface image (890xauto)',
    'effects' => array(
      4 => array(
        'name' => 'image_scale',
        'data' => array(
          'width' => 890,
          'height' => '',
          'upscale' => 1,
        ),
        'weight' => 1,
      ),
    ),
  );

  // Exported image style: user_picture.
  $styles['user_picture'] = array(
    'label' => 'User picture (100x100)',
    'effects' => array(
      2 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 100,
          'height' => 100,
        ),
        'weight' => 2,
      ),
    ),
  );

  return $styles;
}

/**
 * Implements hook_node_info().
 */
function crowdfun_node_info() {
  $items = array(
    'campaign' => array(
      'name' => t('Campaign'),
      'base' => 'node_content',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'contribution' => array(
      'name' => t('Contribution'),
      'base' => 'node_content',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'page' => array(
      'name' => t('Page'),
      'base' => 'node_content',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'perk' => array(
      'name' => t('Perk'),
      'base' => 'node_content',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}

/**
 * Implements hook_default_payment_method().
 */
function crowdfun_default_payment_method() {
  $items = array();
  $items['online_payment'] = entity_import('payment_method', '{
    "controller_data" : { "mollie_id" : "test_Dj8V2puy5bVJ5WjQfM7PhJAzZHhMYH" },
    "enabled" : true,
    "name" : "online_payment",
    "title_specific" : "Online payment",
    "title_generic" : "Online payment",
    "uid" : 1,
    "controller_class_name" : "MolliePaymentMethodController"
  }');
  $items['cash'] = entity_import('payment_method', '{
    "controller_data" : {
      "message" : "You and the campaign moderator will handle payment yourselves. Please complete your transaction with the validation e-mail that has been sent. ",
      "status" : "payment_status_success",
      "text_format" : "plain_text"
    },
    "enabled" : true,
    "name" : "cash",
    "title_specific" : "Cash",
    "title_generic" : "Cash",
    "uid" : 1,
    "controller_class_name" : "PaymentMethodBasicController"
  }');
  return $items;
}
