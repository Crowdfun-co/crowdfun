<?php if ($view_mode === "teaser") : ?>
  <article class="campaign-teaser">
    <div class="featured-image">
      <div class="vote">
        <label class="action">
          <?php print flag_create_link('vote', $node->nid); ?>
        </label>
        <span class="count">
          <?php print flag_get_flag('vote')->get_count($node->nid); ?>
        </span>
      </div>
      <?php print render($content["field_featured_image"]); ?>
      <div class="backers">
        <label>Backers</label>
        <span>
          <?php print ( !empty($variables["contributions"]) ) ? count($variables["contributions"]) : "0"; ?>
        </span>
      </div>
    </div>
    <div class="goal">
      <label><?php print t("goal"); ?></label>
      <span>&euro; <?php print number_format($node->field_goal[LANGUAGE_NONE][0]["value"], 2, ",", "."); ?></span>
    </div>
    <div class="info">
      <h2 class="title">
        <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
      </h2>
      <div class="author">
        <?php print $variables["submitted"]; ?>
      </div>
      <div class="description">
        <?php print $node->body[LANGUAGE_NONE][0]["summary"]; ?>
      </div>
      <div class="location">
        <?php print render($content["field_location"]); ?>
      </div>
    </div>
    <div class="progress">
      <span class="value">&euro; <?php print number_format($variables["funded"],2,",","."); ?> <?php print t("funded"); ?></span>
      <div class="fill" style="width: <?php print $variables["funded"] / $node->field_goal[LANGUAGE_NONE][0]["value"] * 100; ?>%;"></div>
    </div>
  </article>
<?php endif; ?>

<?php if ($view_mode === "full") : ?>
  <article class="campaign-full">
    <section class="campaign-teaser">

      <div class="featured-image">
        <div class="vote">
          <label class="action">
            <?php print flag_create_link('vote', $node->nid); ?>
          </label>
          <span class="count">
            <?php print flag_get_flag('vote')->get_count($node->nid); ?>
          </span>
        </div>
        <?php print render($content["field_featured_image"]); ?>
        <div class="backers">
          <label>Backers</label>
          <span>
            <?php print ( !empty($variables["contributions"]) ) ? count($variables["contributions"]) : "0"; ?>
          </span>
        </div>
      </div>
      <div class="goal">
        <label><?php print t("goal"); ?></label>
        <span>&euro; <?php print number_format($node->field_goal[LANGUAGE_NONE][0]["value"], 2, ",", "."); ?></span>
      </div>
      <div class="info">
        <h2 class="title">
          <?php print $title; ?>
        </h2>
        <div class="author">
          <?php print $variables["submitted"]; ?>
        </div>
        <div class="description">
          <?php print $node->body[LANGUAGE_NONE][0]["summary"]; ?>
        </div>
        <div class="location">
          <?php print render($content["field_location"]); ?>
        </div>
      </div>
      <div class="progress">
        <span class="value">&euro; <?php print number_format($variables["funded"],2,",","."); ?> <?php print t("funded"); ?></span>
      <div class="fill" style="width: <?php print $variables["funded"] / $node->field_goal[LANGUAGE_NONE][0]["value"] * 100; ?>%;"></div>
        <div class="contribution"></div>
      </div>
    </section>

    <?php if ( !user_is_logged_in() ) : ?>
    <section class="promotional">
      <h1>Join us to help this campaign succeed</h1>
      <p>Sign up with your favorite social network and join the madness</p>
      <ul class="promotional-menu">
        <li><a href="/user/register">Sign up</a></li>
        <li><a href="/user/login">Log in</a></li>
      </ul>
    </section>
    <?php endif; ?>

    <?php if ( user_is_logged_in() ) : ?>
    <section class="promotional">
      <h1>Help this campaign succeed!</h1>
      <p>Or crowdfund your own things from birthday present to charity.</p>
      <?php global $base_url; ?>
      <ul class="promotional-menu">
        <li><a class="fb_share" href="https://www.facebook.com/dialog/share?app_id=878156298919129&display=popup&href=<?php print htmlentities( $base_url . "/" . $variables["alias"] ); ?>&redirect_uri=<?php print htmlentities( $base_url . "/" . $variables["alias"] ); ?>" target="_blank">Share this campaign</a></li>
        <li><a href="/node/add/campaign">Create a campaign</a></li>
      </ul>
    </section>
    <?php endif; ?>

    <section class="campaign-links">
      <div class="container">
        <ul class="campaign-menu">
          <li><a href="#campaign" class="active">Campaign</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#backers">Backers</a></li>
          <li><a href="#comments">Idea's &amp; Comments</a></li>
        </ul>
      </div>
    </section>

    <section id="campaign" class="campaign-surface section">

      <div id="checkout" class="modal-overlay">
        <div id="payment-method-wrapper">
        </div>
      </div>

      <?php if ( !$variables["logged_in"] ) : ?>
      <div id="popover">
        <div class="content">
          <a href="" class="close">close</a>
          <div class="user-picture">
            <img src="<?php print _create_user_picture_url(0); ?>" alt="" />
          </div>
          <div class="profile">
              <div class="name">
                <h2>Hello!</h2>
              </div>
              <div class="summary">
                <p>Anoymous user</p>
              </div>
            <div class="message">
              <p>This could be your contribution!</p>
            </div>
            <div class="info">
              <span class="amount">0</span>
              <span class="value"> &euro; <span>0</span></span>
            </div>
          </div>
        </div>
          <div class="actions">
            <a href="/user/login" class="form-submit button">Log in to contribute!</a>
          </div>
      </div>
      <?php endif; ?>

      <?php if ( $variables["logged_in"] ) : ?>
      <div id="popover">
        <div class="content">
          <a href="" class="close">close</a>
          <div class="user-picture">
            <img src="<?php print $variables['user_picture']; ?>" alt="" />
          </div>
          <div class="profile">
            <div class="name">
              <h2><?php print $variables["user"]->realname ?></h2>
            </div>
            <?php if ( !empty($variables["user"]->summary) ) : ?>
              <div class="summary">
                <p><?php print $variables["user"]->summary[LANGUAGE_NONE][0]["value"]; ?></p>
              </div>
            <?php endif; ?>
            <div class="message">
              <p>This could be your contribution!</p>
            </div>
            <div class="info">
              <span class="amount">0</span>
              <span class="value"> &euro; <span>0</span></span>
            </div>
          </div>
        </div>
        <div class="actions">
          <button class="form-submit buy-now">Buy now!</button>
        </div>
      </div>
      <?php endif; ?>

      <?php foreach ($variables["contributions"] as $contribution) : ?>
      <div class="infobox" data-nid="<?php print $contribution->nid; ?>">
        <div class="content">
          <a href="" class="close">close</a>
          <div class="user-picture">
            <img src="<?php print $contribution->user->picture_url; ?>" alt="" />
          </div>
          <div class="profile">
            <div class="name">
              <h2><?php print $contribution->user->realname; ?></h2>
            </div>
            <?php if ($contribution->user->field_summary) : ?>
            <div class="summary"><p><?php print $contribution->user->field_summary[LANGUAGE_NONE][0]["value"]; ?></p></div>
            <?php else : ?>
              <div class="summary"><p></p></div>
            <?php endif; ?>

            <?php if ($contribution->user->field_summary) : ?>
            <div class="message">
              <p><?php print $contribution->field_comment[LANGUAGE_NONE][0]["value"]; ?></p>
            </div>
            <?php else : ?>
              <div class="message"><p></p></div>
            <?php endif; ?>

            <div class="info">
              <span class="amount">0</span>
              <span class="value"> &euro; <span>0</span></span>
            </div>
          </div>
        </div>
        <div class="actions">
          <?php
          $user_path = drupal_get_path_alias("user/" . $contribution->user->uid);
          ?>
          <a href="<?php print $user_path; ?>" class="form-submit user-view">View user</a>
        </div>
      </div>
    <?php endforeach; ?>

      <table id="surface" style="min-height:500px;">
        <?php print render($content["surface"]); ?>
      </table>

      <aside class="campaign-perks">
        <?php if ( isset($variables["perks"]) ) : ?>
        <?php foreach ($variables["perks"] as $key => $perk) : ?>
        <div class="perk" data-nid="<?php print $perk->nid; ?>">

          <?php if (!empty($perk->field_featured_image)) :
            $perk_image_uri = $perk->field_featured_image[LANGUAGE_NONE][0]["uri"];
            $perk_image_path = image_style_url("featured_image", $perk_image_uri);
          ?>
          <div class="image">
            <img src="<?php print $perk_image_path; ?>" alt="" />
          </div>
          <?php endif; ?>

          <div class="price">&euro; <?php print number_format($perk->field_cost_per_perk[LANGUAGE_NONE][0]["value"], 2, ",", "."); ?></div>
          <div class="content">
            <h3 class="title"><?php print $perk->title ?></h3>
            <div class="author">
              by <span class="username"><?php print $perk->name; ?></span>
            </div>

            <?php if ( isset($perk->body[LANGUAGE_NONE][0]["value"]) ) : ?>
            <p><?php print $perk->body[LANGUAGE_NONE][0]["value"]; ?></p>
            <?php endif; ?>
            <?php
              $amount_of_perks = $perk->field_amount_of_perks[LANGUAGE_NONE][0]["value"];
              $stock = $perk->field_stock[LANGUAGE_NONE][0]["value"];
            ?>
            <?php if ( user_is_logged_in() ) : ?>
            <input value="0" class="quantity" type="number" name="quantity" min="0" max="<?php print $stock; ?>">
            <button class="form-submit buy-now">Buy</button>
            <?php endif; ?>

          </div>
          <div class="progress">
            <span class="value"><?php print $stock . "/" . $amount_of_perks; ?></span>
            <?php
            $progress = $stock / $amount_of_perks * 100;
            ?>
            <div class="fill" style="width: <?php print $progress; ?>%;"></div>
          </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>

        <a href="#comments" class="perk add">
          <?php print t("I have an idea for new perk!"); ?>
        </a>

      </aside>
    </section>

    <section id="about" class="campaign-about section">
      <div class="container">
        <?php print $node->body[LANGUAGE_NONE][0]["value"]; ?>
      </div>
    </section>

    <section id="backers" class="campaign-backers section">
      <div class="container">
        <?php if ( isset($variables["contributions"]) ) : ?>
        <?php foreach ($variables["contributions"] as $contribution) : ?>
        <div class="tile">
          <div class="user-image">
            <img src="<?php print $contribution->user->picture_url; ?>" alt="" />
          </div>
          <div class="user-info">
            <h3><?php print $contribution->user->realname; ?></h3>

            <?php if ($contribution->user->field_summary) : ?>
            <div class="summary"><p><?php print $contribution->user->field_summary[LANGUAGE_NONE][0]["value"]; ?></p></div>
            <?php else : ?>
              <div class="summary"><p></p></div>
            <?php endif; ?>

            <?php if ($contribution->user->field_summary) : ?>
            <div class="comment">
              <p><?php print $contribution->field_comment[LANGUAGE_NONE][0]["value"]; ?></p>
            </div>
            <?php else : ?>
              <div class="comment"><p></p></div>
            <?php endif; ?>

            <div class="created"><p><?php print format_interval((time() - $contribution->created) , 2) . t(" ago"); ?></p></div>
          </div>
          <div class="perks">
            <?php foreach ($contribution->perks as $perk) : ?>
            <div class="perk">
              <label><?php print $perk["aop"]; ?></label>
              <span><?php print $perk["title"]; ?></span>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </section>

    <section id="comments" class="campaign-comments section">
      <div class="container">
        <?php
          print drupal_render($content["comments"]);
        ?>
      </div>
    </section>
  </article>
<?php endif; ?>
