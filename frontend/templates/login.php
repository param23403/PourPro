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
    <link rel="stylesheet" href="css/authentication.css" >
  </head>
  <body>
    <!--Navbar-->
    <nav class="navbar bg-light rounded-5">
      <div class="container">
        <div class="navbar-brand mb-0 h1">PourPro</div>
        <ul class="navbar-nav"><li class="nav-item"><a action="?command=signup">Sign Up</a></li></ul>
      </div>
    </nav>
    <!--Title-->
    <div class="title">
      <b>Login</b>
    </div>
    <!--Sign In Form-->
    <?php if(!empty($_SESSION['email'])){$message;}?>
    <div class="form">
      <form method="post" action="?command=logindb">
        <div class="form-group">
          <!-- <label for="exampleInputEmail1" class="text">Email address</label> -->
          <input
            type="email"
            class="form-control"
            id="exampleInputEmail1"
            placeholder="Enter Email"
            name="email"
          >
        </div>
        <br>
        <div class="form-group">
          <!-- <label for="exampleInputPassword1" class="text">Password</label> -->
          <input
            type="password"
            class="form-control"
            id="exampleInputPassword1"
            placeholder="Password"
            name="passwd"
          >
        </div>
        <br >
        
        <button
          type="submit"
          class="btn btn-primary"
          style="background-color: #00848a"
        >
          Sign In
        </button>
      </form>
    </div>
    <!--Footer-->
    <footer class="footer mt-auto py-3 bg-light">
      <div class="container">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5">
              <div class="col mb-3">
                  <a href="/" class="d-flex align-items-center mb-3 link-dark text-decoration-none">
                      <b>PourPro</b>
                  </a>
                  <p class="text-muted">&copy; 2024 PourPro</p>
              </div>

              <div class="col mb-3"></div>

              <div class="col mb-3">
                  <h1>Company</h1>
                  <ul class="nav flex-column">
                      <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                      <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Careers</a></li>
                      <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Newsroom</a></li>
                  </ul>
              </div>

              <div class="col mb-3">
                  <h1>Categories</h1>
                  <ul class="nav flex-column">
                      <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Whiskey</a></li>
                      <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Vodka</a></li>
                      <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Gin</a></li>
                  </ul>
              </div>

              <div class="col mb-3">
                  <h1>Social</h1>
                  <ul class="nav flex-column">
                      <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Twitter</a></li>
                      <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Instagram</a></li>
                      <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Threads</a></li>
                  </ul>
              </div>
          </div>
      </div>
  </footer>
</body>
</html>
