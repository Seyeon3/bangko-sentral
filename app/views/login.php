<?php $this->loadView("components/head", $data); ?>

<body>

  <?php $this->loadView("components/top-navbar", $data); ?>
  <div class="container d-flex flex-column align-items-center p-3">
    <div class="card w-100" style="max-width:400px;">
      <div class="card-body p-3">
        <div class="text-center">
          <h3>Login</h3>
        </div>
        <?php if (!empty($data['login_form_errors_messages'])) : ?>
          <div id="alertPlaceholder">
            <div class="alert alert-danger" role="alert">
              <ul class="mb-0">
                <?php foreach ($data['login_form_errors_messages'] as $message): ?>
                  <li class="text-break"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        <?php endif; ?>
        <form action="login/authenticate" method="POST">

          <div class="form-floating mb-3">
            <input
              id="inputUsername"
              type="text"
              class="form-control <?=$data['input_username_red_border']?>"
              placeholder=""
              value="<?=$data['input_username_value']?>"
              name="username"
              required>

            <label for="inputUsername">Username</label>
          </div>
          <div class="form-floating mb-3">
            <input
              id="inputPassword"
              type="password"
              class="form-control <?=$data['input_password_red_border']?>"
              placeholder=""
              name="password"
              required>
            <label for="inputPassword">Password</label>
          </div>

          <div
            class="mb-3 d-flex justify-content-center border rounded py-3 <?=$data['checkbox_recaptcha_red_border']?>"
            style="background-image: url('assets/img/bg_for_recaptcha.png');">
            <div class="g-recaptcha" data-sitekey="6Lfs0k0qAAAAAChTLR023tGAFt1yvkSaOrkudjfy"></div>
          </div>

          <div>
            <button id="buttonLogin" type="submit" class="btn btn-primary btn-lg w-100">
              <span class="button-text">Login</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <?php $this->loadView("components/scripts"); ?>
</body>

</html>