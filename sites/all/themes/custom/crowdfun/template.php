<?php

/**
 * Removes breadcrumb from crowdfun theme.
 */
function crowdfun_breadcrumb($breadcrumb) {
  return FALSE;
}

/**
 * Sets the user menu and does some profile data manipulation
 */

function crowdfun_preprocess_user_profile(&$variables) {
	global $user;
	$account = $variables['elements']['#account'];
	$variables['user_profile']['realname']['#markup'] = $account->realname;

	if ($account->uid == $user->uid) {
    $menu = menu_navigation_links('user-menu');
		$variables['user_profile']['user_actions'] = theme('links__user_menu', array('links' => $menu));
  }

  field_attach_preprocess('user', $account, $variables['elements'], $variables);
}
