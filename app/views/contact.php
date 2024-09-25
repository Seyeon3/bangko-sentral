<?php $this->loadView("components/head", $data); ?>

<body>

  <?php $this->loadView("components/top-navbar", $data); ?>
  <div class="container d-flex flex-column align-items-center p-3">
    <div class="card w-100" style="max-width:400px;">
      <div class="card-body p-3">
        <div class="text-center">
          <h3>Contact</h3>
        </div>
        <?php if (!empty($data['contact_form_success_message'])) : ?>
          <div id="alertPlaceholder">
            <div class="alert alert-success" role="alert">
              <div>
                <i class="bi bi-check-circle me-3"></i>
                <span><?= $data['contact_form_success_message'] ?></span>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <?php if (!empty($data['contact_form_errors_messages'])) : ?>
          <div id="alertPlaceholder">
            <div class="alert alert-danger" role="alert">
              <ul class="mb-0">
                <?php foreach ($data['contact_form_errors_messages'] as $message): ?>
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
              class="form-control <?=$data['input_full_name_red_border']?>"
              id="full_name"
              name="full_name"
              placeholder=""
              value="<?=$data['input_full_name_value']?>"
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
              value="<?=$data['input_email_value']?>"
              required>
            <label for="email" class="form-label">Email Address</label>
          </div>
          <div class="mb-3 form-floating">
            <input
              type="text"
              class="form-control <?=$data['input_subject_red_border']?>"
              id="subject"
              name="subject"
              placeholder=""
              value="<?=$data['input_subject_value']?>"
              required>
            <label for="subject" class="form-label">Subject</label>
          </div>
          <div class="mb-3 form-floating">
            <textarea
              class="form-control <?=$data['input_message_red_border']?>"
              id="message"
              name="message"
              rows="4"
              placeholder=""
              required><?=$data['input_message_value']?></textarea>
            <label for="message" class="form-label">Message</label>
          </div>
          <div
            class="mb-3 d-flex justify-content-center border rounded p-3 <?=$data['checkbox_recaptcha_red_border']?>"
            style="background-image: url('assets/img/bg_for_recaptcha.png');">
            <div class="g-recaptcha" data-sitekey="6Lfs0k0qAAAAAChTLR023tGAFt1yvkSaOrkudjfy"></div>
          </div>
          <button type="submit" class="btn btn-primary btn-lg w-100">Send Message</button>
        </form>

      </div>
    </div>
  </div>

  <?php $this->loadView("components/scripts"); ?>

</body>

</html>