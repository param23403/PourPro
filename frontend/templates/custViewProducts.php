<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="author" content="Param Patel and Daniel Biondolillo">
  <meta name="description" content="This software allows you to manage your liquor business better">
  <meta name="keywords" content="Liquor Store management software">

  <title>View Products</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <h1>View Products</h1>
  <?php
  $noOfProducts = count($_SESSION['CustProducts']);
  for ($i = 0; $i < $noOfProducts; $i++) : ?>
    <p>
      <?php echo $_SESSION["CustProducts"][$i]["product_name"] ?><br>
      <?php echo $_SESSION["CustProducts"][$i]["category"] ?><br>
      <?php echo $_SESSION["CustProducts"][$i]["brand"] ?><br>
      <?php echo $_SESSION["CustProducts"][$i]["unit_price"] ?><br>
      <?php echo $_SESSION["CustProducts"][$i]["image_link"] ?><br>
    </p>
  <?php endfor; ?>
</body>

</html>