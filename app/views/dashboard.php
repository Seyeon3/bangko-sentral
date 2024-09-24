<?php $this->loadView("components/head", $data); ?>

<body>
  <div class="d-flex flex-row">
    <?php $this->loadView("components/admin-panel-aside-nav-left", $data); ?>

    <div class="container-fluid" style="height:100vh; overflow:auto;">
      <main class="p-4">
        <h4 class="mb-4">Dashboard</h4>
        <div class="card mb-4">
          <div class="card-body">
            <h4 class="card-title">Login Attempts</h4>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">User ID</th>
                  <th scope="col">Username</th>
                  <th scope="col">IP Address</th>
                  <th scope="col">Login Time</th>
                  <th scope="col">Attempt</th>
                </tr>
              </thead>
              <tbody>
                <?php if (isset($data['login_attempts_table'])): ?>
                  <?php foreach ($data['login_attempts_table'] as $row): ?>
                    <tr>
                      <th scope="row"><?php echo htmlspecialchars($row->login_attempt_id); ?></th>
                      <td><?php echo htmlspecialchars($row->user_id); ?></td>
                      <td><?php echo htmlspecialchars($row->username); ?></td>
                      <td><?php echo htmlspecialchars($row->ip_address != '::1' ? $row->ip_address : '127.0.0.1'); ?></td>
                      <td><?php echo datePrettierWithTime(htmlspecialchars($row->timestamp)); ?></td>
                      <td><?php echo $row->success ? '<span class="badge text-bg-success">Success</span>' : '<span class="badge text-bg-danger">Failed</span>'; ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="4" class="text-center">No login attempts found.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card mb-4">
          <div class="card-body">
            <h4 class="card-title">Messages</h4>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Subject</th>
                  <th scope="col">Message</th>
                  <th scope="col">Sent Date</th>
                </tr>
              </thead>
              <tbody>
                <?php if (isset($data['contact_messages_table'])): ?>
                  <?php foreach ($data['contact_messages_table'] as $row): ?>
                    <tr>
                      <th scope="row"><?php echo htmlspecialchars($row->contact_message_id); ?></th>
                      <td><?php echo htmlspecialchars($row->full_name); ?></td>
                      <td><?php echo htmlspecialchars($row->email); ?></td>
                      <td><?php echo htmlspecialchars($row->subject); ?></td>
                      <td><?php echo htmlspecialchars($row->message); ?></td>
                      <td><?php echo datePrettierWithTime(htmlspecialchars($row->created_at)); ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="4" class="text-center">No login attempts found.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>

      </main>
    </div>
  </div>


  <?php $this->loadView("components/scripts"); ?>
</body>

</html>