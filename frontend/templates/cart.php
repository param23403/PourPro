<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Your Cart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="css/inventory.css">
  <style>
  .cart-container {
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 10px;
    background-color: #f8f9fa;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }

  .cart-row {
    display: flex;
    align-items: center; 
    padding: 10px 0;
    border-bottom: 1px solid #ddd;
}

.image-container {
  flex: 0 0 40px; 
  height: 40px; 
  display: flex; 
  justify-content: center; 
  align-items: center;
}

.cart-image {
  max-width: 40px; 
  height: auto; 
  object-fit: contain; 
  border-radius: 5px;
}

.cart-info {
  flex-grow: 1;
  padding-left: 10px;
}

.cart-controls {
  display: flex;
  align-items: center;
  gap: 10px;
}

.cart-quantity {
  width: 50px; 
  text-align: center;
  border: 1px solid #ddd;
  border-radius: 5px;
  background-color: #fff;
}

.remove-from-cart {
  color: #dc3545;
  text-decoration: none;
}

.remove-from-cart:hover {
  text-decoration: underline;
}

.empty-cart-message {
  font-size: 18px;
  color: #888; 
  text-align: center;
}

  </style>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

<?php include __DIR__ . '/components/customer_navbar.php'; ?>

<div class="container my-4">
  <div class="cart-container">
    <h2 class="mb-4">Your Cart</h2> 

    <div id="cart-items">
    </div>

    <p id="empty-cart-message" class="empty-cart-message" style="display: none;">Your cart is empty.</p>
  </div>
</div>

<script>
function loadCartFromLocalStorage() {
  return JSON.parse(localStorage.getItem("cart")) || [];
}

function updateCartUI() {
  const cart = loadCartFromLocalStorage();
  const $cartItems = $("#cart-items");
  $cartItems.empty();

  if (cart.length === 0) {
    $("#empty-cart-message").show();
    return;
  } else {
    $("#empty-cart-message").hide();
  }

  cart.forEach((product) => {
    const cartRowHtml = `
      <div class="cart-row row" data-product-id="${product.product_id}">
        <div class="col-auto"> <!-- Column for the image -->
          <img src="${product.image_link}" class="cart-image" alt="${product.product_name}">
        </div>
        <div class="col"> <!-- Column for product information -->
          <h4><strong>${product.product_name}</strong></h4>
          <p>
            <strong>Category:</strong> ${product.category} |
            <strong>Brand:</strong> ${product.brand} |
            <strong>Price:</strong> $${product.price}
          </p>
        </div>
        <div class="col-auto"> <!-- Column for controls -->
          <button class="btn btn-sm btn-outline-secondary decrease-quantity">-</button>
          <input type="text" value="${product.quantity}" class="cart-quantity" readonly>
          <button class="btn btn-sm btn-outline-secondary increase-quantity">+</button>
          <a href="#" class="remove-from-cart">Remove</a>
        </div>
      </div>
    `;
    $cartItems.append(cartRowHtml);
  });
}

function updateProductQuantity(productId, increment) {
  const cart = loadCartFromLocalStorage();
  const product = cart.find((item) => item.product_id === productId);

  if (product) {
    product.quantity = Math.max(1, product.quantity + increment);
    localStorage.setItem("cart", JSON.stringify(cart));
    updateCartUI();
  }
}

function removeProductFromCart(productId) {
  let cart = loadCartFromLocalStorage();
  cart = cart.filter((item) => item.product_id !== productId);
  localStorage.setItem("cart", JSON.stringify(cart));
  updateCartUI();
}

$(document).ready(() => {
  updateCartUI();

  $("#cart-items").on("click", ".decrease-quantity", function () {
    const productId = $(this).closest(".cart-row").data("product-id");
    updateProductQuantity(productId, -1);
  });

  $("#cart-items").on("click", ".increase-quantity", function () {
    const productId = $(this).closest(".cart-row").data("product-id");
    updateProductQuantity(productId, 1);
  });

  $("#cart-items").on("click", ".remove-from-cart", function (e) {
    e.preventDefault();
    removeProductFromCart($(this).closest(".cart-row").data("product-id"));
  });
});
</script>

</body>
</html>
