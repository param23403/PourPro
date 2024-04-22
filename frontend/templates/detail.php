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
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/detail.css">
    <link rel="stylesheet" href="css/table.css">

</head>
<body>
  <?php include __DIR__ . '/components/admin_navbar.php'; ?>

  <!--Main Container-->
  <div class="container content">
    <div class="header-row d-flex justify-content-between align-items-center">
        <!-- Title -->
        <div class="title">
            <h1 class="display-4"><?php echo $_SESSION["product_details"]["product_name"] ?> Detail</h1>
        </div>
    </div>
    <!-- Product Container
    <div class="row product-container d-flex">
        <div class="col-md-6 d-flex align-items-end">
          <div class="card">
            <div class="img-container">
                <img src="https://exceldashboardschool.com/wp-content/uploads/2013/10/sales-forecast-chart.png" class="product-img" alt="Sales Chart">
            </div>
            <div class="card-body">
              <h2 class="card-title">
              Sales Analytics</h2>
            </div>
          </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <img src="https://media.istockphoto.com/id/940975334/photo/crate-full-of-beer-bottles-isolated-on-white-background.jpg?s=612x612&w=0&k=20&c=gf32SnHpdTiyj8rfyot_z1QFcylLIt3HHy_0RZ2K9Zw=" class="card-img-top product-img" alt="Product Image">
                <div class="card-body">
                    <h2 class="card-title">
                      - $24.99</h2>
                </div>
            </div>
        </div>
    </div> -->

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
                          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orderModal" data-product='<?php echo json_encode($_SESSION["product_details"]); ?>'>Order</button>
                          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateProductModal" data-product='<?php echo json_encode($_SESSION["product_details"]); ?>'>Edit</button>
                          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal" data-product='<?php echo json_encode($_SESSION["product_details"]); ?>'>Delete</button>
                        </div>
                      </td>
                  </tr>
              </tbody>
          </table>
        </div>
      </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <?php $productSales=$_SESSION["productSales"];?>
    <?php if (isset($_SESSION["productSales"]) && !empty($_SESSION["productSales"])) { ?>
        <div class="orders-list">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Quantity Sold</th>
                        <th>Total Sale Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productSales as $productSale) { ?>
                        <tr>
                            <td>
                                <?php echo $productSale["sales_date"] ?>
                            </td>
                            <td>
                                <?php echo $productSale["date_quantity_sold"] ?>
                            </td>
                            <td>
                                <?php echo $productSale["total_sales"] ?>
                            </td>
                        </tr>
                    <?php }; ?>
                </tbody>
            </table>
        <?php }; ?>
        </div>
    </div>
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
