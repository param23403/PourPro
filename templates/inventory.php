<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="author" content="Daniel Biondolillo and Param Patel">
  <meta name="description" content="This software allows you to manage your liquor business better">
  <meta name="keywords" content="Liquor Store management software">

  <title>Inventory</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="inventory.css">
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
            <a class="nav-link" href="?command=dashboard">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?command=inventory">Inventory</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?command=order">Order</a>
          </li>
        </ul>
        <strong class="navbar-brand">PourPro</strong>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="#">@PourPro</a>
          </li>
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

  <!--Title-->
  <div class="title mt-5 mb-4">
    <h1 class="display-4">Inventory</h1>
  </div>

  <!--Main Container-->
  <div class="container-fluid">
    <div class="row">
      <div class="col d-flex justify-content-end m-2">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          Add Product to Inventory
        </button>
      </div>
      <div class="row">
        <div class="col">
          <!--Product Inventory Table-->
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Product Name</th>
                  <th scope="col">Category</th>
                  <th scope="col">Brand</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Supply Price</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $noOfProducts = count($_SESSION['products']);
                for ($i = 0; $i < $noOfProducts; $i++) : ?>
                  <tr>
                    <td><?php echo $_SESSION["products"][$i]["product_id"]?></td>
                    <td><?php echo $_SESSION["products"][$i]["product_name"]?></td>
                    <td><?php echo $_SESSION["products"][$i]["category"]?></td>
                    <td><?php echo $_SESSION["products"][$i]["brand"]?></td>
                    <td><?php echo $_SESSION["products"][$i]["quantity_available"]?></td>
                    <td><?php echo $_SESSION["products"][$i]["supply_price"]?></td>

                    <td>
                      <div class="d-flex justify-content-evenly">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orderModal">Order</button>
                        <button type="button" class="btn btn-primary" onclick="redirectToDetail()">View</button>
                        <button type="button" class="btn btn-warning">Edit</button>
                        <button type="button" class="btn btn-danger">Delete</button>
                      </div>
                    </td>
                  </tr>

                  <!-- Modal -->
                  <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="orderModalLabel">Order Product</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="?command=orderProduct">
                          <div class="modal-body">
                            <!-- Product Information -->
                            <div class="mb-3">
                              <label class="form-label">Product Name</label>
                              <input type="text" class="form-control" readonly value="<?php echo $_SESSION["products"][$i]["product_name"] ?>">
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Category</label>
                              <input type="text" class="form-control" readonly value="<?php echo $_SESSION["products"][$i]["category"] ?> ">
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Brand</label>
                              <input type="text" class="form-control" readonly value="<?php echo $_SESSION["products"][$i]["brand"] ?> ">
                            </div>
                            <!-- Quantity Input -->
                            <div class="mb-3">
                              <label class="form-label" for="quantityInput">Quantity</label>
                              <input type="number" class="form-control" id="quantityInput" name="quantity" placeholder="Enter quantity">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary">Order</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                <?php endfor; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!--Order Modal-->
      


      <!--Example Modal Taken From Bootstrap5.3 Documentation @https://getbootstrap.com/docs/5.3/components/modal/-->
      <!-- Add Product to Inventory Modal -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Product to Inventory</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="?command=addProduct">

                <div class="card-body">
                  <!--Product Name -->
                  <div class="form-group mb-4">
                    <label class="form-label" for="id_product_name">Product Name</label>
                    <input type="text" id="id_product_name" class="form-control" name="product_name" 
                      value="<?php echo isset($_SESSION["old_input"]["product_name"]) ? $_SESSION["old_input"]["product_name"] : ''; ?>"
                    >
                    <?php if(isset($_SESSION["errors"]["product_name"])) { ?>
                      <span class="text-danger"><?php echo $_SESSION["errors"]["product_name"]; ?></span>
                    <?php } ?>
                  </div>

                  <!--Category-->
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group mb-4">
                        <label class="form-label" for="id_brand">Brand</label>
                        <input type="text" id="id_brand" class="form-control" name="brand" 
                          value="<?php echo isset($_SESSION["old_input"]["brand"]) ? $_SESSION["old_input"]["brand"] : ''; ?>"
                        >
                      </div>
                      <?php if(isset($_SESSION["errors"]["brand"])) { ?>
                        <span class="text-danger"><?php echo $_SESSION["errors"]["brand"]; ?></span>
                      <?php } ?>
                    </div>

                    <!--Quantity Field-->
                    <div class="col-md-4">
                      <div class="form-group mb-4">
                        <label class="form-label" for="id_volume">Volume (mL)</label>
                        <input type="number" id="id_volume" class="form-control" name="volume" 
                          value="<?php echo isset($_SESSION["old_input"]["volume"]) ? $_SESSION["old_input"]["volume"] : ''; ?>"
                        >
                        <?php if(isset($_SESSION["errors"]["volume"])) { ?>
                          <span class="text-danger"><?php echo $_SESSION["errors"]["volume"]; ?></span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>

                  <!--Category-->
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group mb-4">
                        <label class="form-label" for="id_category">Category</label>
                        <select id="id_category" class="form-control" name="category" 
                          value="<?php echo isset($_SESSION["old_input"]["category"]) ? $_SESSION["old_input"]["category"] : ''; ?>">
                            <option value="">Select a category</option>
                            <option value="Beer">Beer</option>
                            <option value="Whiskey">Whiskey</option>
                            <option value="Vodka">Vodka</option>
                        </select>
                        <?php if(isset($_SESSION["errors"]["category"])) { ?>
                          <span class="text-danger"><?php echo $_SESSION["errors"]["category"]; ?></span>
                        <?php } ?>
                      </div>
                    </div>

                    <!--Quantity Field-->
                    <div class="col-md-4">
                      <div class="form-group mb-4">
                        <label class="form-label" for="id_quantity">Quantity</label>
                        <input type="number" id="id_quantity" class="form-control" name="quantity_available" 
                          value="<?php echo isset($_SESSION["old_input"]["quantity_available"]) ? $_SESSION["old_input"]["quantity_available"] : ''; ?>"
                        >
                        <?php if(isset($_SESSION["errors"]["quantity_available"])) { ?>
                          <span class="text-danger"><?php echo $_SESSION["errors"]["quantity_available"]; ?></span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>


                  <div class="form-group mb-4">
                    <label class="form-label" for="id_unit_price">Unit Price</label>
                    <input type="text" id="id_unit_price" class="form-control" name="unit_price" 
                      value="<?php echo isset($_SESSION["old_input"]["unit_price"]) ? $_SESSION["old_input"]["unit_price"] : ''; ?>"
                    >
                    <?php if(isset($_SESSION["errors"]["unit_price"])) { ?>
                        <span class="text-danger"><?php echo $_SESSION["errors"]["unit_price"]; ?></span>
                    <?php } ?>
                  </div>

                  <!-- Field-->
                  <div class="form-group mb-4">
                    <label class="form-label" for="id_supply_price">Supply Price</label>
                    <input type="text" id="id_supply_price" class="form-control" name="supply_price" 
                      value="<?php echo isset($_SESSION["old_input"]["supply_price"]) ? $_SESSION["old_input"]["supply_price"] : ''; ?>"
                    >
                    <?php if(isset($_SESSION["errors"]["supply_price"])) { ?>
                        <span class="text-danger"><?php echo $_SESSION["errors"]["supply_price"]; ?></span>
                    <?php } ?>
                  </div>


                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Complete</button>
                  </div>
                </div>
              </form>

            </div>


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
          <strong class="navbar-brand">Admin</strong>
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

<!--Script to display order modal on page reload if session errors exist-->
<script>
  <?php if(isset($_SESSION["errors"]) && !empty($_SESSION["errors"])) { ?>
      var orderModal = new bootstrap.Modal(document.getElementById('staticBackdrop'), {
          backdrop: 'static',
          keyboard: false
      });
      orderModal.show();
  <?php } ?>
</script>

</body>

</html>