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

    <title>Profile</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    >
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/inventory.css">

</head>
<body>
  <?php include __DIR__ . '/components/admin_navbar.php'; ?>

  <div class="title">
        <b>Profile</b>
        <p><?php echo "Name: "; echo $_SESSION["name"]; ?></p>
        <p><?php echo "Email: "; echo $_SESSION["email"]; ?></p>
        <p><?php echo "Type: "; echo $_SESSION["type"]; ?></p>
    </div>

  <?php include __DIR__ . '/components/admin_footer.php'; ?>
</body>
</html>