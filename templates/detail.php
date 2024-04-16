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

    <title>Product Detail</title>

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
            <a class="nav-link" href="?command=#">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?command=inventory">Inventory</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Order</a>
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

  <!--Title-->
  <div class="title">
      <h1 class="display-4"><?php echo $_SESSION["product_details"]["product_name"] ?> Detail</h1>
  </div>
  <!--Main Container-->
  <div class="container-fluid">
    <!--Product Container-->
    <div class="row product-container d-flex">
        <div class="col-md-6 d-flex align-items-end">
          <div class="card">
            <div class="img-container">
                <img src="https://exceldashboardschool.com/wp-content/uploads/2013/10/sales-forecast-chart.png" class="product-img" alt="Sales Chart">
            </div>
            <div class="card-body">
              <h2 class="card-title"><?php echo $_SESSION["product_details"]["product_name"] ?> Sales Analytics</h2>
            </div>
          </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <img src="https://media.istockphoto.com/id/940975334/photo/crate-full-of-beer-bottles-isolated-on-white-background.jpg?s=612x612&w=0&k=20&c=gf32SnHpdTiyj8rfyot_z1QFcylLIt3HHy_0RZ2K9Zw=" class="card-img-top product-img" alt="Product Image">
                <div class="card-body">
                    <h2 class="card-title"><?php echo $_SESSION["product_details"]["product_name"] ?> - $24.99</h2>
                </div>
            </div>
        </div>
    </div>

    <!--Product Table Row Detail-->
    <div class="row mt-4">
        <div class="col-md-12">
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
                        <tr>
                            <td><?php echo $_SESSION["product_details"]["product_id"]?></td>
                            <td><?php echo $_SESSION["product_details"]["product_name"] ?></td>
                            <td><?php echo $_SESSION["product_details"]["category"] ?></td>
                            <td><?php echo $_SESSION["product_details"]["brand"] ?></td>
                            <td><?php echo $_SESSION["product_details"]["quantity_available"] ?></td>
                            <td><?php echo $_SESSION["product_details"]["supply_price"] ?></td>
                            <td>
                              <div class="d-flex justify-content-evenly">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orderModal">Order</button>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateProductModal">Edit</button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal">Delete</button>
                              </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


  <!-- Order Modal -->
  <div class="modal fade" id="orderModal" aria-labelledby="orderModalLabel" aria-hidden="true">
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
              <input type="text" class="form-control" readonly value="<?php echo $_SESSION["product_details"]["product_name"] ?>">
            </div>
            <div class="mb-3">
              <label class="form-label">Category</label>
              <input type="text" class="form-control" readonly value="<?php echo $_SESSION["product_details"]["category"] ?> ">
            </div>
            <div class="mb-3">
              <label class="form-label">Brand</label>
              <input type="text" class="form-control" readonly value="<?php echo $_SESSION["product_details"]["brand"] ?> ">
            </div>
            <div class="mb-3">
              <label class="form-label">Inventory Quantity</label>
              <input type="text" class="form-control" readonly value="<?php echo $_SESSION["product_details"]["quantity_available"] ?> ">
            </div>
            <!-- Quantity Input -->
            <div class="mb-3">
              <label class="form-label" for="quantityInput">Quantity to Order</label>
              <input type="number" class="form-control" id="quantityInput" name="quantity_ordered" placeholder="Enter quantity"
                value="<?php echo isset($_SESSION["order_product_old_input"]["quantity_ordered"]) ? $_SESSION["order_product_old_input"]["quantity_ordered"] : ''; ?>">
                <?php if(isset($_SESSION["order_product_errors"]["quantity_ordered"])) { ?>
                    <span class="text-danger"><?php echo $_SESSION["order_product_errors"]["quantity_ordered"] ?></span>
                <?php } ?>
            </div>
            <!--Hidden Product Id-->
            <input type="hidden" class="form-control" id="quantityInput" name="product_id" value="<?php echo $_SESSION["product_details"]["product_id"]?>">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Order</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!--Edit/Update Modal-->
  <div class="modal fade" id="updateProductModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="updateProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="updateProductModalLabel">Update Existing Product</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="?command=updateProduct">
            <div class="card-body">
              <!--Product Name -->
              <div class="form-group mb-4">
                <label class="form-label" for="id_product_name">Product Name</label>
                <input type="text" id="id_product_name" class="form-control" name="product_name" 
                  value="<?php echo isset($_SESSION["update_product_old_input"]["product_name"]) ? $_SESSION["update_product_old_input"]["product_name"] : $_SESSION["product_details"]["product_name"] ?>"
                >
                <?php if(isset($_SESSION["update_product_errors"]["product_name"])) { ?>
                  <span class="text-danger"><?php echo $_SESSION["update_product_errors"]["product_name"]; ?></span>
                <?php } ?>
              </div>

              <!--Category-->
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group mb-4">
                    <label class="form-label" for="id_brand">Brand</label>
                    <input type="text" id="id_brand" class="form-control" name="brand" 
                      value="<?php echo isset($_SESSION["update_product_old_input"]["brand"]) ? $_SESSION["update_product_old_input"]["brand"] : $_SESSION["product_details"]["brand"] ?>"
                    >
                  </div>
                  <?php if(isset($_SESSION["update_product_errors"]["brand"])) { ?>
                    <span class="text-danger"><?php echo $_SESSION["update_product_errors"]["brand"]; ?></span>
                  <?php } ?>
                </div>

                <!--Quantity Field-->
                <div class="col-md-4">
                  <div class="form-group mb-4">
                    <label class="form-label" for="id_volume">Volume (mL)</label>
                    <input type="number" id="id_volume" class="form-control" name="volume" 
                      value="<?php echo isset($_SESSION["update_product_old_input"]["volume"]) ? $_SESSION["update_product_old_input"]["volume"] : $_SESSION["product_details"]["volume"] ?>"
                    >
                    <?php if(isset($_SESSION["update_product_errors"]["volume"])) { ?>
                      <span class="text-danger"><?php echo $_SESSION["update_product_errors"]["volume"]; ?></span>
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
                      value="<?php echo isset($_SESSION["update_product_old_input"]["category"]) ? $_SESSION["update_product_old_input"]["category"] : $_SESSION["product_details"]["category"] ?>"
                    >
                        <option value="">Select a category</option>
                        <option value="Beer">Beer</option>
                        <option value="Whiskey">Whiskey</option>
                        <option value="Vodka">Vodka</option>
                    </select>
                    <?php if(isset($_SESSION["add_product_errors"]["category"])) { ?>
                      <span class="text-danger"><?php echo $_SESSION["update_product_errors"]["category"]; ?></span>
                    <?php } ?>
                  </div>
                </div>

                <!--Quantity Field-->
                <div class="col-md-4">
                  <div class="form-group mb-4">
                    <label class="form-label" for="id_quantity">Quantity</label>
                    <input type="number" id="id_quantity" class="form-control" name="quantity_available" 
                      value="<?php echo isset($_SESSION["update_product_old_input"]["quantity_available"]) ? $_SESSION["update_product_old_input"]["quantity_available"] : $_SESSION["product_details"]["quantity_available"] ?>"
                    >
                    <?php if(isset($_SESSION["update_product_errors"]["quantity_available"])) { ?>
                      <span class="text-danger"><?php echo $_SESSION["update_product_errors"]["quantity_available"]; ?></span>
                    <?php } ?>
                  </div>
                </div>
              </div>

              <!--Unit Price-->
              <div class="form-group mb-4">
                <label class="form-label" for="id_unit_price">Unit Price</label>
                <input type="text" id="id_unit_price" class="form-control" name="unit_price" 
                  value="<?php echo isset($_SESSION["update_product_old_input"]["unit_price"]) ? $_SESSION["update_product_old_input"]["unit_price"] : $_SESSION["product_details"]["unit_price"] ?>"
                >
                <?php if(isset($_SESSION["update_product_errors"]["unit_price"])) { ?>
                    <span class="text-danger"><?php echo $_SESSION["update_product_errors"]["unit_price"]; ?></span>
                <?php } ?>
              </div>

              <!--Supply Price-->
              <div class="form-group mb-4">
                <label class="form-label" for="id_supply_price">Supply Price</label>
                <input type="text" id="id_supply_price" class="form-control" name="supply_price" 
                  value="<?php echo isset($_SESSION["update_product_old_input"]["supply_price"]) ? $_SESSION["update_product_old_input"]["supply_price"] : $_SESSION["product_details"]["supply_price"] ?>"
                >
                <?php if(isset($_SESSION["update_product_errors"]["supply_price"])) { ?>
                    <span class="text-danger"><?php echo $_SESSION["update_product_errors"]["supply_price"]; ?></span>
                <?php } ?>
              </div>

              <!--Hidden Product Id-->
              <input type="hidden" class="form-control" id="quantityInput" name="product_id" value="<?php echo $_SESSION["product_details"]["product_id"]?>">

              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Complete</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!--Delete Confirmation Modal-->
  <div class="modal fade" id="deleteConfirmationModal" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete product "<?php echo $_SESSION["product_details"]["product_name"] ?>" from inventory?
        </div>
        <div class="modal-footer">
          <form method="post" action="?command=deleteProduct">
            <input type="hidden" name="product_id" value="<?php echo $_SESSION["product_details"]["product_id"] ?>">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
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
              <a class="nav-link" href="?command=inventory">Inventory</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Order</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </footer>

<!--Script to display order modal on page reload if session order_product_errors exist-->
<script>
  <?php if(isset($_SESSION["order_product_errors"]) && !empty($_SESSION["order_product_errors"])) { ?>
      var orderModal = new bootstrap.Modal(document.getElementById('orderModal'), {
          backdrop: 'static',
      });
      orderModal.show();
  <?php } ?>
</script>

<!--Script to display update modal on page reload if session update_product_errors exist-->
<script>
  <?php if(isset($_SESSION["update_product_errors"]) && !empty($_SESSION["update_product_errors"])) { ?>
      var orderModal = new bootstrap.Modal(document.getElementById('updateProductModal'), {
          backdrop: 'static',
      });
      orderModal.show();
  <?php } ?>
</script>

</body>
</html>
