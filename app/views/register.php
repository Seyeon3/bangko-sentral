<?php $this->loadView ("components/head", $data); ?>

<body>


  <?php $this->loadView("components/top-navbar", $data); ?>
  <div class="container d-flex flex-column align-items-center p-3">
    <div class="card w-100" style="max-width:400px;">
      <div class="card-body shadow p-3">
        <div class="text-center">
          <h3>Register</h3>
          <p>Create your account to get started!</p>
        </div>
        <?php if (!empty($data['register_form_success_message'])) : ?>
          <div id="alertPlaceholder">
            <div class="alert alert-success" role="alert">
              <div>
                <i class="bi bi-check-circle me-3"></i>
                <span><?= $data['register_form_success_message'] ?></span>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <?php if (!empty($data['register_form_errors_messages'])) : ?>
          <div id="alertPlaceholder">
            <div class="alert alert-danger" role="alert">
              <ul class="mb-0">
                <?php foreach ($data['register_form_errors_messages'] as $message): ?>
                  <li class="text-break"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        <?php endif; ?>

        <form action="register/create" method="POST">
          <div class="mb-3 form-floating">
            <input
              type="text"
              class="form-control <?= $data['input_full_name_red_border'] ?>"
              id="full_name"
              name="full_name"
              placeholder=""
              value="<?= $data['input_full_name_value'] ?>"
              required>
            <label for="name" class="form-label">Full Name</label>
          </div>
          <div class="mb-3 form-floating">
            <input
              type="text"
              class="form-control <?= $data['input_username_red_border'] ?>"
              id="username"
              name="username"
              placeholder=""
              value="<?= $data['input_username_value'] ?>"
              required>
            <label for="username" class="form-label">Username</label>
          </div>
          <div class="mb-3 form-floating">
            <input
              type="password"
              class="form-control <?= $data['input_password_red_border'] ?>"
              id="password"
              name="password"
              placeholder=""
              value=""
              required>
            <label for="password" class="form-label">Password</label>
          </div>
          <div
            class="mb-3 d-flex justify-content-center border rounded p-3 <?= $data['checkbox_recaptcha_red_border'] ?>"
            style="background-image: url('assets/img/bg_for_recaptcha.png');">
            <div class="g-recaptcha" data-sitekey="6Lc3n1IqAAAAAEwfoua5p8G_DAE2EzkcTdGJ4EW-"></div>
          </div>
          <button type="submit" class="btn btn-primary btn-lg w-100">Register</button>
        </form>

      </div>
    </div>
  </div>

  <?php $this->loadView("components/scripts"); ?>

</body>

