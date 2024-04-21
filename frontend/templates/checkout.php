<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Checkout</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <style>
    /* Daniel Biondolillo and Param Patel */

    body {
      background-color: #222831;
      display: flex;
      flex-direction: column;
    }

    .title {
      font-family: Verdana, Geneva, Tahoma, sans-serif;
      color: white;
      text-align: center;
      margin-top: 2rem;
      margin-bottom: 1rem;
      font-size: larger;
    }

    .navbar {
      background-color: #ACADAC;
      margin: 8px;
    }

    .navbar-nav .nav-link {
      border-radius: 20px;
    }

    /* Change nav link background color on hover */
    .navbar-nav .nav-link:hover {
      background-color: rgb(165, 233, 253);
    }

    .table {
      width: 100%;
      background-color: #fff;
      border-radius: 5px;
    }

    .img-container {
      display: flex;
      align-items: flex-end;
      max-height: 50vh;
    }

    .img-container img {
      max-width: 100%;
      max-height: auto;
      display: block;
      border-radius: 5px;
    }

    .card-body {
      text-align: center;
    }

    td.low {
      background-color: #f8d7da;
    }

    td.good {
      background-color: #d1e7dd;
    }

    td.pending {
      background-color: #fff8e1;
    }

    .btn-group button {
      border-radius: 20px;
      margin: 5px;
      padding: 10px 20px;
    }

    /* Change opacity on button hover */
    .btn-group button:hover {
      opacity: 0.7;
    }

    .footer {
      width: 100%;
      position: fixed;
      bottom: 0;
    }

    .display-6 {
      font-size: medium
    }

    /* Media query to hide footer on screen width change */
    @media (max-width: 768px) {
      .footer {
        display: none;
      }
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</head>

<body>
  <script>
  $('.checkout').on("click", function(event) {
    event.preventDefault();
    let cartData = localStorage.getItem("cart");

    if (cartData) {
      $.ajax({
        url: "?command=performCheckout",
        type: "POST",
        dataType: 'json',
        data: cartData,
        contentType: "application/json; charset=utf-8",
        success: function(response) {
          console.log(response);
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    } else {
      console.error("No cart data found in local storage");
    }
  });
  </script>
  <?php include __DIR__ . '/components/customer_navbar.php'; ?>
  <div class="title mt-5 mb-4">
    <h1 class="display-4">Checkout</h1>
    <h6 class="display-6">Please confirm that all the products in the cart are correct</h6>
  </div>
  <a class="checkout btn btn-success">Finish Checkout</a>
  <?php include __DIR__ . '/components/customer_footer.php'; ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>