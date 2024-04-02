<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" >
  <meta http-equiv="X-UA-Compatible" content="IE=edge" >
  <meta name="viewport" content="width=device-width, initial-scale=1" >

  <meta name="author" content="Daniel Biondolillo and Param Patel" >
  <meta
    name="description"
    content="This software allows you to manage your liquor business better"
  >
  <meta name="keywords" content="Liquor Store management software" >

  <title>Inventory</title>

  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  >
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="inventory.css" >
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
            <a class="nav-link" href="index.html">Index</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Inventory</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Order</a>
          </li>
        </ul>
        <a class="navbar-brand" href="#">PourPro</a>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="#">Our Story</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">@PourPro</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Profile</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!--Title-->
  <div class="title mt-5 mb-4">
    <h1 class="display-4">Inventory</h1>
  </div>

  <!--Main Container-->
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <!--Product Inventory Table-->
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Product Name</th>
                <th scope="col">Serial Number</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Inventory Status</th>
                <th scope="col">Quantity</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Product A</td>
                <td>SN123</td>
                <td>$10.00</td>
                <td class="low">Low</td>
                <td>5</td>
                <td>
                  <div class="btn-group" role="group">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                      Order
                    </button>
                    <button type="button" class="btn btn-info" onclick="redirectToDetail()">View</button>
                    <button type="button" class="btn btn-primary">Edit</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>Product B</td>
                <td>SN456</td>
                <td>$15.00</td>
                <td class="good">Good</td>
                <td>20</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          Order
                        </button>
                        <button type="button" class="btn btn-info" onclick="redirectToDetail()">View</button>
                        <button type="button" class="btn btn-primary">Edit</button>
                        <button type="button" class="btn btn-danger">Delete</button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Product C</td>
                <td>SN789</td>
                <td>$20.00</td>
                <td class="pending">Order Pending</td>
                <td>0</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          Order
                        </button>
                        <button type="button" class="btn btn-info" onclick="redirectToDetail()">View</button>
                        <button type="button" class="btn btn-primary">Edit</button>
                        <button type="button" class="btn btn-danger">Delete</button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>Product D</td>
                <td>SN879</td>
                <td>$20.00</td>
                <td class="pending">Okay</td>
                <td>0</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          Order
                        </button>
                        <button type="button" class="btn btn-info" onclick="redirectToDetail()">View</button>
                        <button type="button" class="btn btn-primary">Edit</button>
                        <button type="button" class="btn btn-danger">Delete</button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>5</td>
                <td>Product E</td>
                <td>SN135</td>
                <td>$25.00</td>
                <td class="good">Good</td>
                <td>10</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          Order
                        </button>
                        <button type="button" class="btn btn-info" onclick="redirectToDetail()">View</button>
                        <button type="button" class="btn btn-primary">Edit</button>
                        <button type="button" class="btn btn-danger">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!--Example Modal Taken From Bootstrap5.3 Documentation @https://getbootstrap.com/docs/5.3/components/modal/-->
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Order Creation Modal</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            This modal dialogue will be used to create and place orders
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Exit</button>
            <button type="button" class="btn btn-primary">Complete</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Footer-->
  <footer class="footer">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
  <script>
    function redirectToDetail() {
      window.location.href = "detail.html";
    }
  </script>
</body>

</html>