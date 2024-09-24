<?php $this->loadView("components/head", $data); ?>

<body>

  <?php $this->loadView("components/top-navbar", $data); ?>
  <div class="container d-flex flex-column align-items-center p-3">
    <div class="card w-100" style="max-width:400px;">
      <div class="card-body p-3">
        <div class="text-center">
          <h3>Login</h3>
        </div>
        <?php if (isset($_SESSION['login_form_errors_messages']) && is_array($_SESSION['login_form_errors_messages']) && !empty($_SESSION['login_form_errors_messages'])): ?>
          <div id="alertPlaceholder">
            <div class="alert alert-danger" role="alert">
              <ul class="mb-0">
                <?php foreach ($_SESSION['login_form_errors_messages'] as $message): ?>
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
              class="form-control <?= (isset($_SESSION['login_form_errors_messages']) && is_array($_SESSION['login_form_errors_messages']) && (in_array("Username is required.", $_SESSION['login_form_errors_messages']) || in_array("Username is invalid.", $_SESSION['login_form_errors_messages']))) ? 'is-invalid' : ''; ?>"
              placeholder=""
              value="<?= $_SESSION['input_username'] ?? '' ?>"
              name="username"
              required>

            <label for="inputUsername">Username</label>
          </div>
          <div class="form-floating mb-3">
            <input
              id="inputPassword"
              type="password"
              class="form-control <?= (isset($_SESSION['login_form_errors_messages']) && is_array($_SESSION['login_form_errors_messages']) && (in_array("Password is required.", $_SESSION['login_form_errors_messages']) || in_array("Password is invalid.", $_SESSION['login_form_errors_messages']))) ? 'is-invalid' : ''; ?>"
              placeholder=""
              name="password"
              required>
            <label for="inputPassword">Password</label>
          </div>

          <div
            class="mb-3 d-flex justify-content-center border rounded py-3 <?= (isset($_SESSION['login_form_errors_messages']) && is_array($_SESSION['login_form_errors_messages']) && in_array("reCAPTCHA verification failed. Please try again.", $_SESSION['login_form_errors_messages'])) ? 'border-danger' : ''; ?>"
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

  <?php unset($_SESSION['login_form_errors_messages']); ?>
  <?php unset($_SESSION['input_username']); ?>
  <?php $this->loadView("components/scripts"); ?>
</body>

</html>