<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <meta name="viewport" content="width=device-width, initial-scale=1" >

    <meta name="author" content="Param Patel and Daniel Biondolillo" >
    <meta
      name="description"
      content="This software allows you to manage your liquor business better"
    >
    <meta name="keywords" content="Liquor Store management software" >

    <title>Login</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/common.css" >
  </head>
  <body>
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg" style="border-bottom: 2px solid #673ab7;">
      <div class="container">
        <a class="navbar-brand" href="#">
          <i class="fas fa-cocktail" style="font-size: 1.5rem;"></i>
          PourPro
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="?command=signup">Sign Up</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <div class="container content">
      <!-- Title -->
      <div class="row mb-4 d-flex justify-content-center">
        <!-- Title -->
        <div class="col title text-center">
          <h1>Login</h1>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <!-- Sign In Form -->
          <?php if (!empty($_SESSION['email'])): ?>
            <div class="alert alert-info">
              <?= htmlspecialchars($message) ?>
            </div>
          <?php endif; ?>
          
          <div class="form">
            <form method="post" action="?command=logindb">
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Enter Email" name="email" required>
              </div>

              <div class="form-group mt-3">
                <input type="password" class="form-control" placeholder="Password" name="passwd" required>
              </div>

              <button type="submit" class="btn btn-primary mt-3" style="background-color: #00848a;">
                Sign In
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!--Footer-->
    <!-- Footer -->
    <nav class="footer navbar navbar-expand-lg navbar-dark bg-light shadow-lg" style="border-top: 2px solid #673ab7;">
      <div class="container">
        <!-- Content and layout -->
        <div class="row w-100 d-flex align-items-center">
          
          <!-- Left Section: Branding and Copyright -->
          <div class="col-md-3 d-flex flex-column">
            <a href="/" class="navbar-brand"><strong>PourPro</strong></a>
            <span class="text-muted">&copy; 2024 PourPro. All rights reserved.</span>
          </div>

          <!-- Middle Section: Company Links -->
          <div class="col-md-3">
            <h6 class="text-uppercase">Company</h6>
            <ul class="navbar-nav flex-column">
              <li class="nav-item"><a href="#" class="nav-link text-muted">About</a></li>
              <li class="nav-item"><a href="#" class="nav-link text-muted">Careers</a></li>
              <li class="nav-item"><a href="#" class="nav-link text-muted">Newsroom</a></li>
            </ul>
          </div>

          <!-- Middle Section: Product Categories -->
          <div class="col-md-3">
            <h6 class="text-uppercase">Categories</h6>
            <ul class="navbar-nav flex-column">
              <li class="nav-item"><a href="#" class="nav-link text-muted">Whiskey</a></li>
              <li class="nav-item"><a href="#" class="nav-link text-muted">Vodka</a></li>
              <li class="nav-item"><a href="#" class="nav-link text-muted">Gin</a></li>
            </ul>
          </div>

          <!-- Right Section: Social Media Links -->
          <div class="col-md-3">
            <h6 class="text-uppercase">Social</h6>
            <ul class="navbar-nav flex-column">
              <li class="nav-item"><a href="#" class="nav-link text-muted">Twitter</a></li>
              <li class="nav-item"><a href="#" class="nav-link text-muted">Instagram</a></li>
              <li class="nav-item"><a href="#" class="nav-link text-muted">Threads</a></li>
            </ul>
          </div>

        </div>
      </div>
    </nav>
  </div>
</body>
</html>
