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
  <link rel="stylesheet" href="css/inventory.css">
</head>
<body>
  <?php include __DIR__ . '/components/admin_navbar.php'; ?>

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
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orderModal" data-product='<?php echo json_encode($_SESSION["products"][$i]) ?>'>Order</button>
                        <a href="?command=detail&product_id=<?php echo $_SESSION["products"][$i]["product_id"] ?>" class="btn btn-primary">View</a>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateProductModal" data-product='<?php echo json_encode($_SESSION["products"][$i]); ?>'>Edit</button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal" data-product='<?php echo json_encode($_SESSION["products"][$i]); ?>'>Delete</button>
                      </div>
                    </td>
                  </tr>
                <?php endfor; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<br>
<br>
<br>
<br>
  <?php include __DIR__ . '/components/admin_footer.php'; ?>

  <!-- Modals -->
  <?php include __DIR__ . '/admin_modals/add_product_modal.php'; ?>
  <?php include __DIR__ . '/admin_modals/order_modal.php'; ?>
  <?php include __DIR__ . '/admin_modals/update_product_modal.php'; ?>
  <?php include __DIR__ . '/admin_modals/delete_modal.php'; ?>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="js/inventory.js"></script>

</body>
</html>