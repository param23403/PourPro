<?php
$products = $_SESSION['CustProducts'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shop Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="css/common.css">
  <style>
    .product-container {
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 10px;
      background-color: #f8f9fa;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
    }

    .card {
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      transition: box-shadow 0.3s;
    }

    .card:hover {
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .card-img-top {
      height: 200px;
      object-fit: contain; 
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
    }

    .card-body {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .card-title {
      white-space: nowrap;
      overflow: hidden; 
      text-overflow: ellipsis; 
      font-weight: bold; 
    }

    .cart-info {
      display: none;
      background-color: #f9f9f9; 
      border: 1px solid #ddd; 
      border-radius: 10px;
      padding: 4px;
    }

    .remove-from-cart {
      color: #dc3545;
      text-decoration: none;
    }

    .remove-from-cart:hover {
      text-decoration: underline;
    }

    .row {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem; 
      justify-content: space-between;
    }

    .col-md-3 {
      flex: 1 0 22%; 
      min-width: 250px;
      max-width: 22%; 
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>

<?php include __DIR__ . '/components/customer_navbar.php'; ?>

<div class="container my-4 product-container">
  <h2>Shop Products</h2> 
  <div class="row">
    <?php foreach ($products as $product): ?>
      <div class="col-md-3 mb-4"> <!-- Card column -->
        <div class="card" data-product-id="<?php echo htmlspecialchars($product["product_id"]); ?>">
          <?php if (!empty($product["image_link"])): ?>
            <img src="<?php echo htmlspecialchars($product["image_link"]); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product["product_name"]); ?>">
          <?php endif; ?>
          <div class="card-body"> 
            <h5 class="card-title"><?php echo htmlspecialchars($product["product_name"]); ?></h5>
            <p class="card-text">
              <strong>Category:</strong> <?php echo htmlspecialchars($product["category"]); ?><br>
              <strong>Brand:</strong> <?php echo htmlspecialchars($product["brand"]); ?><br>
              <strong>Price:</strong> $<?php echo htmlspecialchars(number_format($product["unit_price"], 2)); ?>
            </p>
            <div class="product-info">
              <input type="hidden" class="product-image" value="<?php echo htmlspecialchars($product["image_link"]); ?>">
              <input type="hidden" class="product-category" value="<?php echo htmlspecialchars($product["category"]); ?>">
              <input type="hidden" class="product-brand" value="<?php echo htmlspecialchars($product["brand"]); ?>">
              <input type="hidden" class="product-price" value="<?php echo htmlspecialchars(number_format($product["unit_price"], 2)); ?>">
              <input type="hidden" class="product-quantity-available" value="<?php echo htmlspecialchars($product["quantity_available"]); ?>">
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <button class="btn btn-primary add-to-cart">Add to Cart</button>
              <div class="cart-info"> 
                <span class="cart-quantity">Item in Cart</span>
                <button class="btn btn-link remove-from-cart">Remove</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php include __DIR__ . '/components/customer_footer.php'; ?>

<script>
function loadCartFromLocalStorage() {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  return cart;
}

function saveCartToLocalStorage(cart) {
  localStorage.setItem('cart', JSON.stringify(cart));
}

function findProductInCart(cart, productId) {
  return cart.find(item => item.product_id === productId);
}

function addItemToCart(product) {
  let cart = loadCartFromLocalStorage();
  let existingItem = findProductInCart(cart, product.product_id);

  if (existingItem) {

    existingItem.quantity += 1;
  } else {
    // Set item quantity property
    product.quantity = 1;
    cart.push(product);
  }

  saveCartToLocalStorage(cart);
  updateCartUI();
}

function removeItemFromCart(productId) {
  let cart = loadCartFromLocalStorage();
  cart = cart.filter(item => item.product_id !== productId);
  saveCartToLocalStorage(cart);
}

function updateCartUI() {
  let cart = loadCartFromLocalStorage();
  $(".card").each(function() {
    let productId = $(this).data("product-id");
    let productInCart = findProductInCart(cart, productId);

    if (productInCart) {
      $(this).find(".add-to-cart").hide();
      $(this).find(".cart-info").show();
    } else {
      $(this).find(".add-to-cart").show();
      $(this).find(".cart-info").hide();
    }
  });
}

$(document).ready(function() {
  updateCartUI();

  $(".add-to-cart").click(function() {
    let card = $(this).closest(".card");
    let productId = card.data("product-id");

    let product = {
      product_id: productId,
      product_name: card.find(".card-title").text(),
      category: card.find(".product-category").val(),
      brand: card.find(".product-brand").val(),
      price: parseFloat(card.find(".product-price").val()),
      image_link: card.find(".product-image").val(),
      quantity_available: card.find(".product-quantity-available").val()
    };

    addItemToCart(product);
    updateCartUI();
  });

  $(".remove-from-cart").click(function() {
    let productId = $(this).closest(".card").data("product-id");
    removeItemFromCart(productId);
    updateCartUI();
  });
});

</script>

</body>
</html>
