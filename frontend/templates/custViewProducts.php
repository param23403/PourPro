<?php
$products = $_SESSION['CustProducts'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>View Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="css/inventory.css">
</head>

<style>
    .card-img-top {
      height: 200px;
      object-fit: scale-down;
    }
  </style>
<body>
<?php include __DIR__ . '/components/admin_navbar.php'; ?>

  <div class="container">
    <h1 class="my-4">View Products</h1>
    <div class="row">
      <?php foreach ($products as $product): ?>
      <div class="col-md-3 mb-4">
        <div class="card">
          <?php if (!empty($product["image_link"])): ?>
          <img src="<?php echo htmlspecialchars($product["image_link"]); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product["product_name"]); ?>">
          <?php endif; ?>
          <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($product["product_name"]); ?></h5>
            <p class="card-text">
              Category: <?php echo htmlspecialchars($product["category"]); ?><br>
              Brand: <?php echo htmlspecialchars($product["brand"]); ?><br>
              Price: $<?php echo htmlspecialchars(number_format($product["unit_price"], 2)); ?>
            </p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>

  <?php include __DIR__ . '/components/admin_footer.php'; ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>