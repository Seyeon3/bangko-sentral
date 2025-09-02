<?php $this->loadView("components/head", $data); ?>

<body class="position-relative">

  <?php $this->loadView("components/top-navbar", $data); ?>
  <div class="container d-flex flex-column align-items-center p-3">
    <div class="card w-100" style="max-width:400px;">
      <div class="card-body p-3">
        <div class="text-center">
          <h3>Forgot Password</h3>
          <p>We'll send an OTP to reset your password.</p>
        </div>

        <!-- Error Message Display -->
        <?php if (!empty($data['forgot_password_form_errors_messages'])) : ?>
          <div id="alertPlaceholder">
            <div class="alert alert-danger" role="alert">
              <ul class="mb-0">
                <?php foreach ($data['forgot_password_form_errors_messages'] as $message): ?>
                  <li class="text-break"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        <?php endif; ?>

        <!-- Success Message Display -->
        <?php if (isset($_SESSION['send_email_success'])): ?>
          <div id="alertPlaceholder">
            <div class="alert alert-success" role="alert">
              <?= htmlspecialchars($_SESSION['send_email_success'], ENT_QUOTES, 'UTF-8'); ?>
              <?php unset($_SESSION['send_email_success']); // Clear the success message after displaying ?>
            </div>
          </div>
        <?php endif; ?>

        <form action="<?= PAGE ?>forgotpassword/send_email" method="POST">
          <div class="form-floating mb-3">
            <input
              id="inputEmail"
              type="email"
              class="form-control <?= !empty($data['form_errors']) ? 'is-invalid' : '' ?>"
              placeholder="name@example.com"
              value="<?= htmlspecialchars($data['input_email'], ENT_QUOTES, 'UTF-8') ?>"
              name="email"
              required>
            <label for="inputEmail">Email Address</label>
          </div>

          <!-- reCAPTCHA Section -->
          <div
            class="mb-3 d-flex justify-content-center border rounded p-3 <?= !empty($data['checkbox_recaptcha_red_border']) ? htmlspecialchars($data['checkbox_recaptcha_red_border'], ENT_QUOTES, 'UTF-8') : ''; ?>"
            style="background-image: url('assets/img/bg_for_recaptcha.png');">
            <div class="g-recaptcha" data-sitekey="6Lc3n1IqAAAAAEwfoua5p8G_DAE2EzkcTdGJ4EW-"></div>
          </div>

          <div>
            <button id="buttonResetPassword" type="submit" class="btn btn-primary btn-lg w-100">
              <span class="button-text">Send OTP</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php $this->loadView("components/scripts"); ?>

</body>
</html>
