<?php $this->loadView("components/head", $data); ?>

<body>
  <div class="d-flex flex-row">
    <aside class="border" style="width: 333px; height:100vh;">

      <ul class="nav d-flex flex-column border-bottom">
        <li class="nav-item" style="height:60px;">
          <a class="nav-link d-flex align-items-center h-100">
            <img src="logo.png" alt="Logo" width="30" height="30" class="ms-2 me-3">
            <span>Admin Panel</span>
          </a>
        </li>
      </ul>

      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link text-secondary active" href="#"><i class="bi bi-speedometer2 m-3 fs-5"></i>Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-secondary" href="#"><i class="bi bi-people m-3 fs-5"></i>Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-secondary" href=""><i class="bi bi-person-circle m-3 fs-5"></i><?= $_SESSION['full_name'] ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger" href="logout"><i class="bi bi-box-arrow-left m-3 fs-5"></i>Logout</a>
        </li>
      </ul>
    </aside>

    <div class="container-fluid">
      <main class="p-4">
        <h4 class="mb-4">Dashboard</h4>
        <div class="card">
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

      </main>
    </div>
  </div>


  <?php $this->loadView("components/scripts"); ?>
</body>

</html>