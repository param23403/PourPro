<!-- cart.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Your Cart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="css/inventory.css">
  <style>
    .cart-row {
      display: flex;
      align-items: center;
      padding: 10px 0;
      border-bottom: 1px solid #ddd;
      background-color: white;
    }

    .cart-image {
      flex: 0 0 100px;
      height: 100px;
      object-fit: scale-down;
      border-radius: 5px;
      margin-right: 15px;
    }

    .cart-info {
      flex-grow: 1;
    }

    .cart-controls {
      display: flex;
      align-items: center;
    }

    .cart-quantity {
      width: 50px;
      text-align: center;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    .remove-from-cart {
      color: #dc3545;
      text-decoration: none;
      margin-left: 10px;
    }

    .remove-from-cart:hover {
      text-decoration: underline;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

<?php include __DIR__ . '/components/customer_navbar.php'; ?>

<div class="container">
  <h1 class="my-4">Your Cart</h1>

  <div id="cart-items">
  </div>

  <p id="empty-cart-message" style="display: none;">Your cart is empty.</p>
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
      <div class="cart-row bg-white p-2" data-product-id="${product.product_id}">
        <img src="${product.image_link}" class="cart-image" alt="${product.product_name}">
        <div class="cart-info">
          <h5>${product.product_name}</h5>
          <p>Category: ${product.category} | Brand: ${product.brand} | Price: $${product.price}</p>
        </div>
        <div class="cart-controls p-2">
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
    const productId = $(this).closest(".cart-row").data("product-id");
    removeProductFromCart(productId);
  });
 
});
</script>
<a class="checkout btn btn-primary" href="?command=checkout">Checkout</a>

</body>
</html>