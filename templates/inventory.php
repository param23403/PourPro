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
            <a class="nav-link" href="?command=inventory">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?command=inventory">Inventory</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Order</a>
          </li>
        </ul>
        <strong class="navbar-brand">PourPro</strong>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="#">@PourPro</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?command=profile">Profile</a>
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
        <button type="button" class="btn btn-success m-2" data-bs-toggle="modal" data-bs-target="#addProductModal">
          Add Product to Inventory
        </button>
        <a href="?command=productListToJson" class="btn btn-info m-2" role="button">
          Export Product List
        </a>
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
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orderModal<?php echo $_SESSION["products"][$i]["product_id"] ?>">Order</button>
                        <a href="?command=detail&product_id=<?php echo $_SESSION["products"][$i]["product_id"] ?>" class="btn btn-primary">View</a>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateProductModal<?php echo $_SESSION["products"][$i]["product_id"] ?>">Edit</button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal<?php echo $_SESSION["products"][$i]["product_id"] ?>">Delete</button>
                      </div>
                    </td>
                  </tr>


                  <!-- Order Modal -->
                  <div class="modal fade order-modal" id="orderModal<?php echo $_SESSION["products"][$i]["product_id"] ?>" aria-labelledby="orderModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="orderModalLabel">Order Product</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="?command=orderProduct" class="order-form">
                          <div class="modal-body">
                            <!-- Read Only Product Information -->
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
                            <div class="mb-3">
                              <label class="form-label">Inventory Quantity</label>
                              <input type="text" class="form-control" readonly value="<?php echo $_SESSION["products"][$i]["quantity_available"] ?> ">
                            </div>
                            <!-- Quantity Input -->
                            <div class="mb-3">
                              <label class="form-label" for="quantityInput">Quantity to Order</label>
                              <input type="number" class="modal-input form-control" id="quantityInput" name="quantity_ordered" placeholder="Enter quantity" data-default-value="">
                              <span class="text-danger quantity_ordered_error">
                                <!--Populated by JS/jQuery-->
                              </span>
                            </div>
                            <!--Hidden Product Id-->
                            <input type="hidden" class="form-control" id="quantityInput" name="product_id" value="<?php echo $_SESSION["products"][$i]["product_id"]?>">
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
                  <div class="modal fade update-modal" id="updateProductModal<?php echo $_SESSION["products"][$i]["product_id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="updateProductModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="updateProductModalLabel">Update Existing Product</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form method="post" action="?command=updateProduct" class="update-form">
                            <div class="card-body">
                              <!--Product Name -->
                              <div class="form-group mb-4">
                                <label class="form-label" for="id_product_name">Product Name</label>
                                <input type="text" id="id_product_name" class="form-control modal-input" name="product_name" 
                                  value="<?php echo isset($_SESSION["products"][$i]["product_name"]) ? $_SESSION["products"][$i]["product_name"] : '' ?>"
                                  data-default-value="<?php echo isset($_SESSION["products"][$i]["product_name"]) ? $_SESSION["products"][$i]["product_name"] : '' ?>"
                                >
                                <span class="text-danger product_name_error"></span>
                              </div>

                              <!--Category-->
                              <div class="row">
                                <div class="col-md-8">
                                  <div class="form-group mb-4">
                                    <label class="form-label" for="id_brand">Brand</label>
                                    <input type="text" id="id_brand" class="form-control modal-input" name="brand" 
                                      value="<?php echo isset($_SESSION["products"][$i]["brand"]) ? $_SESSION["products"][$i]["brand"] : '' ?>"
                                      data-default-value="<?php echo isset($_SESSION["products"][$i]["brand"]) ? $_SESSION["products"][$i]["brand"] : '' ?>"
                                    >
                                  </div>
                                    <span class="text-danger brand_error"></span>
                                </div>

                                <!--Volume Field-->
                                <div class="col-md-4">
                                  <div class="form-group mb-4">
                                    <label class="form-label" for="id_volume">Volume (mL)</label>
                                    <input type="number" id="id_volume" class="form-control modal-input" name="volume" 
                                      value="<?php echo isset($_SESSION["products"][$i]["volume"]) ? $_SESSION["products"][$i]["volume"] : '' ?>"
                                      data-default-value="<?php echo isset($_SESSION["products"][$i]["volume"]) ? $_SESSION["products"][$i]["volume"] : '' ?>"
                                    >
                                      <span class="text-danger volume_error"></span>
                                  </div>
                                </div>
                              </div>

                              <!--Category-->
                              <div class="row">
                                <div class="col-md-8">
                                  <div class="form-group mb-4">
                                    <label class="form-label" for="id_category">Category</label>
                                    <select id="id_category" class="form-control modal-input" name="category">
                                      <option value="">Select a category</option>
                                      <option value="Beer"<?php echo (isset($_SESSION["products"][$i]["category"]) && $_SESSION["products"][$i]["category"] == "Beer") ? ' selected' : ''; ?>>Beer</option>
                                      <option value="Whiskey"<?php echo (isset($_SESSION["products"][$i]["category"]) && $_SESSION["products"][$i]["category"] == "Whiskey") ? ' selected' : ''; ?>>Whiskey</option>
                                      <option value="Vodka"<?php echo (isset($_SESSION["products"][$i]["category"]) && $_SESSION["products"][$i]["category"] == "Vodka") ? ' selected' : ''; ?>>Vodka</option>
                                    </select>
                                      <span class="text-danger category_error"></span>
                                  </div>
                                </div>

                                <!--Quantity Field-->
                                <div class="col-md-4">
                                  <div class="form-group mb-4">
                                    <label class="form-label" for="id_quantity">Quantity</label>
                                    <input type="number" id="id_quantity" class="form-control modal-input" name="quantity_available" 
                                      value="<?php echo isset($_SESSION["products"][$i]["quantity_available"]) ? $_SESSION["products"][$i]["quantity_available"]: '' ?>"
                                      data-default-value="<?php echo isset($_SESSION["products"][$i]["quantity_available"]) ? $_SESSION["products"][$i]["quantity_available"]: '' ?>"
                                    >
                                      <span class="text-danger quantity_available_error"></span>
                                  </div>
                                </div>
                              </div>

                              <div class="form-group mb-4">
                                <label class="form-label" for="id_unit_price">Unit Price</label>
                                <input type="text" id="id_unit_price" class="form-control modal-input" name="unit_price" 
                                  value="<?php echo isset($_SESSION["products"][$i]["unit_price"]) ? $_SESSION["products"][$i]["unit_price"] : '' ?>"
                                  data-default-value="<?php echo isset($_SESSION["products"][$i]["unit_price"]) ? $_SESSION["products"][$i]["unit_price"] : '' ?>"
                                >
                                <span class="text-danger unit_price_error"></span>
                              </div>

                              <!--Supply Price Field-->
                              <div class="form-group mb-4">
                                <label class="form-label" for="id_supply_price">Supply Price</label>
                                <input type="text" id="id_supply_price" class="form-control modal-input" name="supply_price" 
                                  value="<?php echo isset($_SESSION["products"][$i]["supply_price"]) ? $_SESSION["products"][$i]["supply_price"] : '' ?>"
                                  data-default-value="<?php echo isset($_SESSION["products"][$i]["supply_price"]) ? $_SESSION["products"][$i]["supply_price"] : '' ?>"
                                >
                                <span class="text-danger supply_price_error"></span>
                              </div>

                              <!--Hidden Product Id-->
                              <input type="hidden" class="form-control" id="quantityInput" name="product_id" value="<?php echo $_SESSION["products"][$i]["product_id"]?>">

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
                  <div class="modal fade" id="deleteConfirmationModal<?php echo $_SESSION["products"][$i]["product_id"] ?>" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          Are you sure you want to delete product "<?php echo $_SESSION["products"][$i]["product_name"] ?>" from inventory?
                        </div>
                        <div class="modal-footer">
                          <form method="post" action="?command=deleteProduct">
                            <input type="hidden" name="product_id" value="<?php echo $_SESSION["products"][$i]["product_id"] ?>">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endfor; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      

      <!--Example Modal Taken From Bootstrap5.3 Documentation @https://getbootstrap.com/docs/5.3/components/modal/-->
      <!-- Add Product to Inventory Modal -->
      <div class="modal fade add-product-modal" id="addProductModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addProductModalLabel">Add Product to Inventory</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="?command=addProduct" class="add-product-form">
                <div class="card-body">
                  <!--Product Name -->
                  <div class="form-group mb-4">
                    <label class="form-label" for="id_product_name">Product Name</label>
                    <input type="text" id="id_product_name" class="form-control modal-input" name="product_name">
                      <span class="text-danger product_name_error"></span>
                  </div>

                  <!--Category-->
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group mb-4">
                        <label class="form-label" for="id_brand">Brand</label>
                        <input type="text" id="id_brand" class="form-control modal-input" name="brand">
                      </div>
                        <span class="text-danger brand_error"></span>
                    </div>

                    <!--Quantity Field-->
                    <div class="col-md-4">
                      <div class="form-group mb-4">
                        <label class="form-label" for="id_volume">Volume (mL)</label>
                        <input type="number" id="id_volume" class="form-control modal-input" name="volume">
                          <span class="text-danger volume_error"></span>
                      </div>
                    </div>
                  </div>

                  <!--Category-->
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group mb-4">
                        <label class="form-label" for="id_category">Category</label>
                        <select id="id_category" class="form-control modal_input" name="category"> 
                            <option value="" selected="selected">Select a category</option>
                            <option value="Beer">Beer</option>
                            <option value="Whiskey">Whiskey</option>
                            <option value="Vodka">Vodka</option>
                        </select>
                          <span class="text-danger category_error"></span>
                      </div>
                    </div>

                    <!--Quantity Field-->
                    <div class="col-md-4">
                      <div class="form-group mb-4">
                        <label class="form-label" for="id_quantity">Quantity</label>
                        <input type="number" id="id_quantity" class="form-control modal-input" name="quantity_available">
                          <span class="text-danger quantity_available_error"></span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group mb-4">
                    <label class="form-label" for="id_unit_price">Unit Price</label>
                    <input type="text" id="id_unit_price" class="form-control modal-input" name="unit_price">
                        <span class="text-danger unit_price_error"></span>
                  </div>

                  <!-- Field-->
                  <div class="form-group mb-4">
                    <label class="form-label" for="id_supply_price">Supply Price</label>
                    <input type="text" id="id_supply_price" class="form-control modal-input" name="supply_price">
                      <span class="text-danger supply_price_error"></span>
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

<script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous">
</script>

<script>
  $(document).ready(function() {

    // Script for order form error handling
    $('.order-form').submit(function(event) {
      event.preventDefault();
      let formData = $(this).serialize();
      $.ajax({
        type: 'POST',
        url: '?command=orderProduct',
        data: formData,
        dataType: 'json',
        success: function(response) {
          // Check if the response contains errors
          if (response.errors) {
            // Render validation errors dynamically
            $.each(response.errors, function(key, value) {
              $('.' + key + '_error').text(value);
            });
          } else {
            $('.order-modal').modal('hide');
            // Reload page
            location.reload();
          }
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    });

    // Script for update form error handling
    $('.update-form').submit(function(event) {
      event.preventDefault();
      let formData = $(this).serialize();

      $.ajax({
        type: 'POST',
        url: '?command=updateProduct',
        data: formData,
        dataType: 'json',
        success: function(response) {
          // Check if the response contains errors
          if (response.errors) {
            // Render validation errors dynamically
            $.each(response.errors, function(key, value) {
              $('.' + key + '_error').text(value);
            });
          } else {
            $('.update-modal').modal('hide');
            // Reload page
            location.reload();
          }
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    });
  });

  // Script for add product error handling
  $('.add-product-form').submit(function(event) {
    event.preventDefault();
    let formData = $(this).serialize();

    $.ajax({
      type: 'POST',
      url: '?command=addProduct',
      data: formData,
      dataType: 'json',
      success: function(response) {
        // Check if the response contains errors
        if (response.errors) {
          // Render validation errors dynamically
          $.each(response.errors, function(key, value) {
            $('.' + key + '_error').text(value);
          });
        } else {
          $('.add-product-modal').modal('hide');
          // Reload page
          location.reload();
        }
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
      }
    });
  });

  // Event listener for any modal hidden event
  $('.modal').on('hidden.bs.modal', function (e) {

    // Reset inputs to their default values
    $('.modal-input').each(function() {
        let defaultValue = $(this).data('default-value');
        $(this).val(defaultValue);
    });

    // Clear dropdowns back to default on close
    $('select').each(function() {
      let defaultValue = $(this).find('option[selected]').val();
      $(this).val(defaultValue);
    });

    // Clear error messages
    $('.text-danger').text('');
});
</script>

</body>
</html>