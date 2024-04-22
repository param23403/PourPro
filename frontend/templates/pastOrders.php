<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Past Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/table.css">
</head>

<body>
  <!-- Include the navbar -->
  <?php include __DIR__ . '/components/admin_navbar.php'; ?>

  <div class="container content"> 

    <div class="title">
      <h1>Past Orders</h1>
    </div>

    <?php $orders=$_SESSION["orders"];?>
    <?php if (isset($_SESSION["orders"]) && !empty($_SESSION["orders"])) { ?>
        <div class="orders-list">
            <table>
                <thead>
                    <tr>
                        <th>Order Date</th>
                        <th>Product Name</th>
                        <th>Quantity Ordered</th>
                        <th>Total Cost</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) { ?>
                        <tr>
                            <td>
                                <?php echo $order["order_date"] ?>
                            </td>
                            <td>
                                <?php echo $order["product_name"] ?>
                            </td>
                            <td>
                                <?php echo $order["quantity_ordered"] ?>
                            </td>
                            <td>
                                <?php echo $order["total_cost"] ?>
                            </td>
                        </tr>
                    <?php }; ?>
                </tbody>
            </table>
            <?php }; ?>
            <br>
            <br>
            <br>
            <br>
        </div>
    </div>                    

    <?php include __DIR__ . '/components/admin_footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>