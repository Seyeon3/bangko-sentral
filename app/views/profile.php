<?php $this->loadView("components/head", $data); ?>

<body>
  <div class="container">
    <nav class="d-flex justify-content-center align-items-center border rounded my-3" style="height:100px;">
      <h1>Profile</h1>
    </nav>
    <div class="mb-3">
      <div class="input-group row g-0">
        <span class="input-group-text col-6">Username</span>
        <input disabled type="text" class="form-control col-6 bg-white" value="<?=$_SESSION['username']?>">
      </div>
    </div>
    <a href="logout" class="btn btn-danger">Logout</a>
  </div>
</body>

</html>