<?php

$form_token = get_session_token('su_setup_form');
$form_action = 'su_setup';
$fsb_name = 'Create Superuser';
$fsb_class = 'btn btn-primary btn-rounded'; ?>

<div class="body-content nice-scroll">
  <div class="centered-layout-container">
    <div class="bg-dark-default">
      <div>
        <div class="install-form-base">
          <div>

            <?php attach_view('/setup/templates/header/title.php', false); ?>

            <div class="cyz-fb-title">
              <div class="title-block bg-secondary">
                <p>
                  <span class="cyz-ico cyz-ico-person"></span>
                  <span>Create Superuser</span>
                </p>
              </div>
            </div>

            <div class="cyz-fb-body">
              <div>
                <p>Below you should enter superuser credentials. You must create strong password and remember it and also save your password somewhere safe. Incase you lose the password then you need to manually reset it, by editing your superuser config file.</p>
                <form class="text-left" method="post" action="<?php echo get_home_url().'?setup=su'; ?>">
                  <div class="form-group">
                    <label for="su-username">Superuser name</label>
                    <input type="text" class="form-control" name="su-username" id="su-username" aria-describedby="su-username-help" placeholder="Enter Username" required>
                    <small id="su-username-help" class="form-text text-muted">	Username can only contains alpha numeric characters including dash and underscore.</small>
                  </div>

                  <div class="form-group">
                    <label for="su-password">Superuser Password</label>
                    <input type="password" class="form-control" name="su-password" id="su-password" aria-describedby="su-password-help" placeholder="Enter Password" required>
                    <small id="su-password-help" class="form-text text-muted">	Enter superuser password. Must contain at least 8 characters.</small>
                  </div>

                  <div class="form-group">
                    <label for="su-confirm-password">Confirm Superuser Password</label>
                    <input type="password" class="form-control" name="su-confirm-password" id="su-confirm-password" aria-describedby="su-confirm-password-help" placeholder="Confirm Password">
                    <small id="su-confirm-password-help" class="form-text text-muted">Confirm superuser password.</small>
                  </div>

                  <p class="text-center">
                    <?php echo we_safe_submit($form_token, $form_action, $fsb_name, $fsb_class); ?>
                  </p>
                </form>
              </div>
            </div>

            <div class="cyz-fb-footer">
              <div class="py-1">
                <a class="link" href="#">cyzer.io</a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
