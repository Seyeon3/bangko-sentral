<?php $this->loadView("components/head", $data); ?>

<body>

  <?php $this->loadView("components/top-navbar", $data); ?>
  <div class="container d-flex flex-column align-items-center p-3">
    <div class="card" style="width:400px;">
      <div class="card-body p-3">
        <div class="text-center">
          <h3>Contact</h3>
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
        <form>
          <div class="mb-3 form-floating">
            <input type="text" class="form-control" id="name" placeholder="" required>
            <label for="name" class="form-label">Full Name</label>
          </div>
          <div class="mb-3 form-floating">
            <input type="email" class="form-control" id="email" placeholder="" required>
            <label for="email" class="form-label">Email Address</label>
          </div>
          <div class="mb-3 form-floating">
            <input type="text" class="form-control" id="subject" placeholder="" required>
            <label for="subject" class="form-label">Subject</label>
          </div>
          <div class="mb-3 form-floating">
            <textarea class="form-control" id="message" rows="4" placeholder="" required></textarea>
            <label for="message" class="form-label">Message</label>
          </div>
          <div class="mb-3 d-flex justify-content-center border rounded p-3" style="background-image: url('assets/img/bg_for_recaptcha.png');">
            <div class="g-recaptcha" data-sitekey="6Lfs0k0qAAAAAChTLR023tGAFt1yvkSaOrkudjfy"></div>
          </div>
          <button type="submit" class="btn btn-primary btn-lg w-100">Send Message</button>
        </form>

      </div>
    </div>
  </div>

  <?php unset($_SESSION['login_form_errors_messages']); ?>
  <?php unset($_SESSION['input_username']); ?>
  <?php $this->loadView("components/scripts"); ?>

</body>

</html>