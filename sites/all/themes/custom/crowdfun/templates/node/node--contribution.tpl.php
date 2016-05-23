<section class="promotional">
  <h1>Thank you for contributing!</h1>
  <p>Share your contribution and let others know about this campaign.</p>
  <?php global $base_url; ?>
  <ul class="promotional-menu">
    <li><a class="fb_share" href="https://www.facebook.com/dialog/share?app_id=878156298919129&display=popup&href=<?php print htmlentities( $base_url . "/" . $variables["alias"] ); ?>&redirect_uri=<?php print htmlentities( $base_url . "/" . $variables["alias"] ); ?>" target="_blank">Share this campaign</a></li>
    <li><a href="/node/add/campaign">Create a campaign</a></li>
  </ul>
</section>

<section>
  <div class="container">
    <div class="tile">
      <div class="user-image">
        <img src="<?php print $variables['user']->picture_url; ?>" alt="" />
      </div>
      <div class="user-info">
        <h3><?php print $variables['name']; ?></h3>

        <?php if ($variables['user']->field_summary) : ?>
        <div class="summary"><p><?php print $variables['user']->field_summary[LANGUAGE_NONE][0]["value"]; ?></p></div>
        <?php else : ?>
          <div class="summary"><p></p></div>
        <?php endif; ?>

        <?php if ($variables['user']->field_summary) : ?>
        <div class="comment">
          <p><?php print $variables['field_comment'][0]["value"]; ?></p>
        </div>
        <?php else : ?>
          <div class="comment"><p></p></div>
        <?php endif; ?>

        <div class="created"><p><?php print format_interval((time() - $variables['created']) , 2) . t(" ago"); ?></p></div>
      </div>
      <div class="perks">
        <?php foreach ($variables['perks'] as $perk) : ?>
        <div class="perk">
          <label><?php print $perk["aop"]; ?></label>
          <span><?php print $perk["title"]; ?></span>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</secion>
