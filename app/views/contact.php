<?php $this->loadView("components/head", $data); ?>

<body>

  <?php $this->loadView("components/top-navbar", $data); ?>
  <div class="container d-flex flex-column align-items-center p-3">
    <div class="card w-100" style="max-width:400px;">
      <div class="card-body p-3">
        <div class="text-center">
          <h3>Contact</h3>
        </div>
        <?php if (isset($_SESSION['contact_form_success_message']) && !empty($_SESSION['contact_form_success_message'])): ?>
          <div id="alertPlaceholder">
            <div class="alert alert-success" role="alert">
              <div>
                <i class="bi bi-check-circle me-3"></i>
                <span><?= $_SESSION['contact_form_success_message'] ?></span>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['contact_form_errors_messages']) && is_array($_SESSION['contact_form_errors_messages']) && !empty($_SESSION['contact_form_errors_messages'])): ?>
          <div id="alertPlaceholder">
            <div class="alert alert-danger" role="alert">
              <ul class="mb-0">
                <?php foreach ($_SESSION['contact_form_errors_messages'] as $message): ?>
                  <li class="text-break"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        <?php endif; ?>

        <form action="contact/send" method="POST">
          <div class="mb-3 form-floating">
            <input
              type="text"
              class="form-control <?= (isset($_SESSION['contact_form_errors_messages']) && is_array($_SESSION['contact_form_errors_messages']) && (in_array("Full Name must be greater than 3 characters and less than 20 characters.", $_SESSION['contact_form_errors_messages']))) ? 'is-invalid' : ''; ?>"
              id="full_name"
              name="full_name"
              placeholder=""
              value="<?= $_SESSION['input_full_name'] ?? '' ?>"
              required>
            <label for="name" class="form-label">Full Name</label>
          </div>
          <div class="mb-3 form-floating">
            <input
              type="email"
              class="form-control"
              id="email"
              name="email"
              placeholder=""
              value="<?= $_SESSION['input_email'] ?? '' ?>"
              required>
            <label for="email" class="form-label">Email Address</label>
          </div>
          <div class="mb-3 form-floating">
            <input
              type="text"
              class="form-control <?= (isset($_SESSION['contact_form_errors_messages']) && is_array($_SESSION['contact_form_errors_messages']) && (in_array("Subject must be between 3 and 100 characters.", $_SESSION['contact_form_errors_messages']))) ? 'is-invalid' : ''; ?>"
              id="subject"
              name="subject"
              placeholder=""
              value="<?= $_SESSION['input_subject'] ?? '' ?>"
              required>
            <label for="subject" class="form-label">Subject</label>
          </div>
          <div class="mb-3 form-floating">
            <textarea
              class="form-control <?= (isset($_SESSION['contact_form_errors_messages']) && is_array($_SESSION['contact_form_errors_messages']) && (in_array("Message must be between 3 and 255 characters.", $_SESSION['contact_form_errors_messages']))) ? 'is-invalid' : ''; ?>"
              id="message"
              name="message"
              rows="4"
              placeholder=""
              required><?= $_SESSION['input_message'] ?? '' ?></textarea>
            <label for="message" class="form-label">Message</label>
          </div>
          <div
            class="mb-3 d-flex justify-content-center border rounded p-3  <?= (isset($_SESSION['contact_form_errors_messages']) && is_array($_SESSION['contact_form_errors_messages']) && in_array("reCAPTCHA verification failed. Please try again.", $_SESSION['contact_form_errors_messages'])) ? 'border-danger' : ''; ?>"
            style="background-image: url('assets/img/bg_for_recaptcha.png');">
            <div class="g-recaptcha" data-sitekey="6Lfs0k0qAAAAAChTLR023tGAFt1yvkSaOrkudjfy"></div>
          </div>
          <button type="submit" class="btn btn-primary btn-lg w-100">Send Message</button>
        </form>

      </div>
    </div>
  </div>

  <?php unset($_SESSION['contact_form_errors_messages']); ?>
  <?php unset($_SESSION['input_full_name']); ?>
  <?php unset($_SESSION['input_email']); ?>
  <?php unset($_SESSION['input_subject']); ?>
  <?php unset($_SESSION['input_message']); ?>
  <?php unset($_SESSION['contact_form_success_message']); ?>
  <?php $this->loadView("components/scripts"); ?>

</body>

</html>