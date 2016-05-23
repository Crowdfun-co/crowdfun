<?php

/**
 * @file
 * Omega theme implementation to present all user profile data.
 *
 * This template is used when viewing a registered member's profile page,
 * e.g., example.com/user/123. 123 being the users ID.
 *
 * Use render($user_profile) to print all profile items, or print a subset
 * such as render($user_profile['user_picture']). Always call
 * render($user_profile) at the end in order to print all remaining items. If
 * the item is a category, it will contain all its profile items. By default,
 * $user_profile['member_for'] is provided, which contains data on the user's
 * history. Other data can be included by modules. $user_profile['user_picture']
 * is available for showing the account picture.
 *
 * Available variables:
 *   - $user_profile: An array of profile items. Use render() to print them.
 *   - Field variables: for each field instance attached to the user a
 *     corresponding variable is defined; e.g., $account->field_example has a
 *     variable $field_example defined. When needing to access a field's raw
 *     values, developers/themers are strongly encouraged to use these
 *     variables. Otherwise they will have to explicitly specify the desired
 *     field language, e.g. $account->field_example['en'], thus overriding any
 *     language negotiation rule that was previously applied.
 *
 * @see template_preprocess_user_profile()
 */
?>
<section<?php print $attributes; ?>>
  <div class="container">
    <div class="user__profile">
    	<div class="user__picture">
        <?php print render($user_profile['user_picture']); ?>
    	</div>
    	<div class="user__info">
    		<div class="user__name">
    			<h2><?php print render($user_profile['realname']); ?></h2>
    		</div>
    		<div class="user__summary">
    			<?php print render($user_profile['field_summary']); ?>
    		</div>
        <div class="user__tags">
          <ul class="links">
            <li><?php print render($user_profile['field_city']); ?></li>
            <li><?php print render($user_profile['field_country']); ?></li>
          </ul>
        </div>
        <div class="user__twitter">

        </div>
        <div class="user__website">

        </div>
    	</div>
  	</div>
  	<div class="user__actions">
      <?php print render($user_profile['user_actions']); ?>
  	</div>
  </div>
</section>
<section class="user-links">
  <div class="container">
    <ul class="user-menu">
      <li><a href="#liked" class="active">Liked</a></li>
      <li><a href="#backed">Backed</a></li>
      <li><a href="#started">Started</a></li>
      <li><a href="#comments">Idea's &amp; Comments</a></li>
    </ul>
  </div>
</section>
