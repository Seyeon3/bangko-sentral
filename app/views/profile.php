<?php $this->loadView("components/head", $data); ?>

<body>
  <div class="container">
    <div class="d-flex">
      <!-- Sidebar -->
      <div class="sidebar p-3">
        <h4 class="text-center">Dashboard</h4>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Settings</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Logout</a>
          </li>
        </ul>
      </div>

      <!-- Main Content -->
      <div class="content flex-grow-1">
        <div class="container">
          <h1>Welcome to Your Dashboard</h1>
          <div class="row mt-4">
            <div class="col-md-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Card 1</h5>
                  <p class="card-text">Some quick example text to build on the card title.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Card 2</h5>
                  <p class="card-text">Some quick example text to build on the card title.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Card 3</h5>
                  <p class="card-text">Some quick example text to build on the card title.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <a href="logout" class="btn btn-danger">Logout</a>
</body>

</html>