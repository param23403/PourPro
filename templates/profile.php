<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1" >

    <meta name="author" content="Daniel Biondolillo and Param Patel" >
    <meta
      name="description"
      content="This software allows you to manage your liquor business better"
    >
    <meta name="keywords" content="Liquor Store management software" >

    <title>Profile</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    >
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="detail.css">

</head>
<body>
  <!--Navbar-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light rounded-5">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="?command=inventory">Index</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?command=inventory">Inventory</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?command=inventory">Order</a>
          </li>
        </ul>
        <a class="navbar-brand" href="#">PourPro</a>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="#">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?command=logout">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="title">
        <b>Profile</b>
        <p><?php echo "Name: "; echo $_SESSION["name"]; ?></p>
        <p><?php echo "Email: "; echo $_SESSION["email"]; ?></p>
        <p><?php echo "Type: "; echo $_SESSION["type"]; ?></p>
    </div>

  <!--Footer-->
  <footer class="footer">
      <div class="container">
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <span class="copyright">&copy; 2024 PourPro. All rights reserved.</span>
            </li>
          </ul>
          <a class="navbar-brand" href="#">Admin</a>
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="#">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Inventory</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Order</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </footer>
</body>
</html>