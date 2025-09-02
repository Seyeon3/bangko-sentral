<?php $this->loadView("components/head", $data); ?>

<body>

 
  <div class="container d-flex flex-column align-items-center p-3">
    <div class="card w-100" style="max-width:400px;">
      <div class="card-body shadow p-3">
        <div class="text-center">
          <h3>Change Password</h3>
          <p>Enter your new password</p>
        </div>
        <?php if (!empty($_SESSION['changepassword_form_errors'])) : ?>
          <div id="alertPlaceholder">
            <div class="alert alert-danger" role="alert">
              <ul class="mb-0">
                <?php foreach ($_SESSION['changepassword_form_errors'] as $message): ?>
                  <li class="text-break"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
          <?php unset($_SESSION['changepassword_form_errors']); ?>
        <?php endif; ?>
        
        <?php if (!empty($_SESSION['changepassword_success'])) : ?>
          <div class="alert alert-success" role="alert">
            <?= htmlspecialchars($_SESSION['changepassword_success'], ENT_QUOTES, 'UTF-8') ?>
            <?php unset($_SESSION['changepassword_success']); ?>
          </div>
        <?php endif; ?>

        <form action="../../changepassword/change/<?=$data['key']?>" method="POST">
          <input type="hidden" name="user_id" value="<?=$data['user_id']?>">
          <div class="form-floating mb-3">
            <input
              readonly
              type="text"
              class="form-control"
              value="<?=$data['email']?>">
            <label>Your Email</label>
          </div>
          <div class="form-floating mb-3">
            <input
              readonly
              type="text"
              class="form-control"
              value="<?=$data['username']?>">
            <label>Your Username</label>
          </div>
          <div class="form-floating mb-3">
            <input
              id="inputNewPassword"
              type="password"
              class="form-control"
              placeholder="New Password"
              name="new_password"
              required>
            <label for="inputNewPassword">New Password</label>
          </div>
          <div class="form-floating mb-3">
            <input
              id="inputConfirmPassword"
              type="password"
              class="form-control"
              placeholder="Confirm Password"
              name="confirm_password"
              required>
            <label for="inputConfirmPassword">Confirm Password</label>
          </div>
          <div>
            <button id="buttonChangePassword" type="submit" class="btn btn-primary btn-lg w-100">
              <span class="button-text">Change Password</span>
            </button>
          </div>
        </form>
      </div> <!-- card end -->
    </div>
  </div>

  <?php $this->loadView("components/scripts"); ?>
</body>

</html>
