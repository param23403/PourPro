<?php

class PourProController {

    private $input;
    private $errorMessage = '';
    private $db;
    public function __construct($input) {
        session_start();
        $this->input = $input;
        $this->db = new Database();
    }

    public function run() {
        // Check if a specific command is set
        $command = "login";

        if (isset($this->input["command"]))
            $command = $this->input["command"];


        switch ($command) {
            case 'logindb':
                $this->loginDatabase();
                break;
            case 'login';
                $this->showLogin();
                break;
            case 'signupDatabase':
                $this->signupDatabase();
                break;
            case 'logout':
                if (!isset($_SESSION["email"])) {
                    $this->showLogin();
                    break;
                } else {
                    $this->logout();
                    break;
                }
            case 'signUp':
                $this->showSignUp();
                break;
            case 'detail':
                if (!isset($_SESSION["email"])) {
                    $this->showLogin();
                    break;
                } else {
                    if ($_SESSION["type"] === "admin") {
                        $this->showDetail($_GET['product_id']);
                        break;
                    } else {
                        $this->showCustViewProducts();
                        break;
                    }
                }
            case 'navDetail':
                if (!isset($_SESSION["email"])) {
                    $this->showLogin();
                    break;
                } else {
                    if ($_SESSION["type"] === "admin") {
                        $productId = $_GET['product_id'];
                        header("Location: ?command=detail&product_id=$productId");
                        break;
                    } else {
                        $this->showCustViewProducts();
                        break;
                    }
                }
            case 'pastOrders':
                if (!isset($_SESSION["email"])) {
                    $this->showLogin();
                    break;
                } else {
                    if ($_SESSION["type"] === "admin") {
                        $this->showPastOrders();
                        break;
                    } else {
                        $this->showCustViewProducts();
                        break;
                    }
                }
            case 'navInventory':
                if (!isset($_SESSION["email"])) {
                    $this->showLogin();
                    break;
                } else {
                    if ($_SESSION["type"] === "admin") {
                        header("Location: ?command=inventory");
                        break;
                    } else {
                        $this->showCustViewProducts();
                        break;
                    }
                }
            case 'inventory':
                if (!isset($_SESSION["email"])) {
                    $this->showLogin();
                    break;
                } else {
                    if ($_SESSION["type"] === "admin") {
                        $this->showInventory();
                        break;
                    } else {
                        $this->showCustViewProducts();
                        break;
                    }
                }
            case 'addProduct':
                if (!isset($_SESSION["email"])) {
                    $this->showLogin();
                    break;
                } else {
                    if ($_SESSION["type"] === "admin") {
                        $this->addProduct();
                        break;
                    } else {
                        $this->showCustViewProducts();
                        break;
                    }
                }
            case 'profile':
                if (!isset($_SESSION["email"])) {
                    $this->showLogin();
                    break;
                } else {
                    $this->showProfile();
                    break;
                }
            case 'productListToJson':
                if (!isset($_SESSION["email"])) {
                    $this->showLogin();
                    break;
                } else {
                    if ($_SESSION["type"] === "admin") {
                        $this->showProductListJson();
                        break;
                    } else {
                        $this->showCustViewProducts();
                        break;
                    }
                }
            case 'orderProduct':
                if (!isset($_SESSION["email"])) {
                    $this->showLogin();
                    break;
                } else {
                    if ($_SESSION["type"] === "admin") {
                        $this->orderProduct();
                        break;
                    } else {
                        $this->showCustViewProducts();
                        break;
                    }
                }
            case 'updateProduct':
                if (!isset($_SESSION["email"])) {
                    $this->showLogin();
                    break;
                } else {
                    if ($_SESSION["type"] === "admin") {
                        $this->updateProduct();
                        break;
                    } else {
                        $this->showCustViewProducts();
                        break;
                    }
                }
            case 'deleteProduct':
                if (!isset($_SESSION["email"])) {
                    $this->showLogin();
                    break;
                } else {
                    if ($_SESSION["type"] === "admin") {
                        $this->deleteProduct();
                        break;
                    } else {
                        $this->showCustViewProducts();
                        break;
                    }
                }
            case 'custViewProducts':
                if (!isset($_SESSION["email"])) {
                    $this->showLogin();
                    break;
                } else {
                    $this->showCustViewProducts();
                    break;
                }
            case 'cart':
                if (!isset($_SESSION["email"])) {
                    $this->showLogin();
                    break;
                } else {
                    $this->showCart();
                    break;
                }
            case 'checkout':
                if (!isset($_SESSION["email"])) {
                    $this->showLogin();
                    break;
                } else {
                    $this->showCheckout();
                    break;
                }
            case 'performCheckout':
                if (!isset($_SESSION["email"])) {
                    $this->showLogin();
                    break;
                } else {
                    $this->doCheckout();
                    break;
                }
            default:
                $this->showLogin();
        }
    }


    public function showLogin() {
        $errorMessage = "";
        if (!empty($this->errorMessage)) {
            $errorMessage = "<div class='alert alert-danger'>{$this->errorMessage}</div>";
        }
        // include '/opt/src/pourpro/frontend/templates/login.php';
        include '/students/jpg5wq/students/jpg5wq/private/pourpro/frontend/templates/login.php';
        // include '/students/xtz3mx/students/xtz3mx/private/pourpro/frontend/templates/login.php';
    }

    public function showSignUp() {
        $errorMessage = "";
        if (!empty($this->errorMessage)) {
            $errorMessage = "<div class='alert alert-danger'>{$this->errorMessage}</div>";
        }
        // include '/opt/src/pourpro/templates/signup.php';
        include '/students/jpg5wq/students/jpg5wq/private/pourpro/frontend/templates/signup.php';
        // include '/students/xtz3mx/students/xtz3mx/private/pourpro/templates/signup.php';
    }

    public function showProfile() {
        // include '/opt/src/pourpro/templates/profile.php';
        include '/students/jpg5wq/students/jpg5wq/private/pourpro/frontend/templates/profile.php';
        // include '/students/xtz3mx/students/xtz3mx/private/pourpro/templates/profile.php';
    }

    public function showInventory() {
        $this->getAllProducts();
        // include '/opt/src/pourpro/frontend/templates/inventory.php';
        include '/students/jpg5wq/students/jpg5wq/private/pourpro/frontend/templates/inventory.php';
        // include '/students/xtz3mx/students/xtz3mx/private/pourpro/frontend/templates/inventory.php';
    }

    public function showDetail($product_id) {
        $productDetails = $this->getProductDetails($product_id);
        $_SESSION['product_details'] = $productDetails;

        // include '/opt/src/pourpro/frontend/templates/detail.php';
        include '/students/jpg5wq/students/jpg5wq/private/pourpro/frontend/templates/detail.php';
        // include '/students/xtz3mx/students/xtz3mx/private/pourpro/frontend/templates/detail.php';
    }

    public function showCustViewProducts() {
        $this->getAllProductsForCustomer();
        // include '/opt/src/pourpro/frontend/templates/custViewProducts.php';
        include '/students/jpg5wq/students/jpg5wq/private/pourpro/frontend/templates/custViewProducts.php';
        // include '/students/xtz3mx/students/xtz3mx/private/pourpro/templates/custViewProducts.php';
    }

    public function showCart() {
        // include '/opt/src/pourpro/frontend/templates/cart.php';
        include '/students/jpg5wq/students/jpg5wq/private/pourpro/frontend/templates/cart.php';
        // include '/students/xtz3mx/students/xtz3mx/private/pourpro/templates/cart.php';
    }
    public function showCheckout() {
        // include '/opt/src/pourpro/frontend/templates/checkout.php';
        include '/students/jpg5wq/students/jpg5wq/private/pourpro/frontend/templates/checkout.php';
        // include '/students/xtz3mx/students/xtz3mx/private/pourpro/templates/checkout.php';
    }

    public function showPastOrders() {
        $this->getAllPastOrders();
        // include '/opt/src/pourpro/frontend/templates/pastOrders.php';
        include '/students/jpg5wq/students/jpg5wq/private/pourpro/frontend/templates/pastOrders.php';
        // include '/students/xtz3mx/students/xtz3mx/private/pourpro/templates/pastOrders.php';
    }
    private function getProductDetails($product_id) {
        $details = $this->db->query("SELECT * from products WHERE product_id = $1", $product_id);

        return $details[0];
    }

    // Used to output JSON object https://stackoverflow.com/questions/4064444/returning-json-from-a-php-script
    public function showProductListJson() {
        $products = $this->getAllProducts();
        $jsonData = json_encode($products);

        header('Content-Type: application/json');

        echo $jsonData;
        exit();
    }
    public function loginDatabase() {
        if (
            isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["passwd"]) && !empty($_POST["passwd"])
        ) {
            $res = $this->db->query("select * from users where email = $1;", $_POST["email"]);
            if (!empty($res)) {
                if (password_verify($_POST["passwd"], $res[0]["password"])) {
                    // Password was correct, save their information to the
                    // session and send them to the question page
                    $_SESSION["name"] = $res[0]["name"];
                    $_SESSION["email"] = $res[0]["email"];
                    $_SESSION["type"] = $res[0]["type"];
                    if ($_SESSION["type"] === "admin") {
                        header("Location: ?command=inventory");
                    } else {
                        header("Location: ?command=custViewProducts");
                    }
                    return;
                } else {
                    // Password was incorrect
                    $this->errorMessage = "Incorrect password.";
                }
            } else {
                $this->errorMessage = "Something went wrong with our database. Sorry :(";
            }
        } else {
            $this->errorMessage = "Email, and password are required.";
        }
    }
    public function signupDatabase() {
        // User must provide a non-empty name, email, and password to attempt to signup
        if (
            isset($_POST["fullname"]) && !empty($_POST["fullname"]) &&
            isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["passwd"]) && !empty($_POST["passwd"])
        ) {

            // Check if user is in database, by email
            $res = $this->db->query("select * from users where email = $1;", $_POST["email"]);
            if (empty($res)) {
                // User was not there (empty result), so insert them
                $this->db->query(
                    "insert into users (name, email, password, type) values ($1, $2, $3, $4);",
                    $_POST["fullname"],
                    $_POST["email"],
                    // Use the hashed password!
                    password_hash($_POST["passwd"], PASSWORD_DEFAULT),
                    "customer"
                );
                $_SESSION["name"] = $_POST["fullname"];
                $_SESSION["email"] = $_POST["email"];
                $_SESSION["type"] = "customer";
                if ($_SESSION["type"] === "admin") {
                    header("Location: ?command=inventory");
                } else {
                    header("Location: ?command=custViewProducts");
                }
                return;
            } else {
                // User was in the database, tell them that user exists and to login
                $this->errorMessage = "User already exists. Please login instead!";
            }
        } else {
            $this->errorMessage = "Name, email, and password are required.";
        }

        // If something went wrong, show the SignUp page again
        $this->showSignup();
    }


    public function isValidProductInput($input) {

        $errors = [];

        // Check if product_name is set, not empty, and within acceptable length
        if (!isset($input['product_name']) || empty($input['product_name'])) {
            $errors['product_name'] = 'Product name is required';
        } elseif (strlen($input['product_name']) > 255) {
            $errors['product_name'] = 'Product name must be less than or equal to 255 characters';
        }

        // Check if category, brand, and volume are set and within acceptable length
        $fields = ['category', 'brand', 'volume'];
        foreach ($fields as $field) {
            if (isset($input[$field]) && !empty($input[$field]) && strlen($input[$field]) > 100) {
                $errors[$field] = ucfirst($field) . ' must be less than or equal to 100 characters';
            }
        }

        // Volume
        if (!isset($input['volume']) || empty($input['volume'])) {
            $errors['volume'] = 'Volume is required';
        } elseif (!is_numeric($input['volume']) || $input['volume'] < 0) {
            $errors['volume'] = 'Volume must be a positive integer';
        }

        // Quantity Available
        if (!isset($input['quantity_available']) || empty($input['quantity_available'])) {
            $errors['quantity_available'] = 'Quantity is required';
        } elseif (!is_numeric($input['quantity_available']) || $input['quantity_available'] < 0) {
            $errors['quantity_available'] = 'Quantity must be a positive integer';
        }

        // Unit Price
        if (!isset($input['unit_price']) || empty($input['unit_price'])) {
            $errors['unit_price'] = 'Unit price is required';
        } elseif (!is_numeric($input['unit_price']) || !preg_match('/^\d+(\.\d{2})$/', $input['unit_price'])) {
            $errors['unit_price'] = 'Unit price must be in valid numeric currency format';
        }

        // Supply Price
        if (!isset($input['supply_price']) || empty($input['supply_price'])) {
            $errors['supply_price'] = 'Supply price is required';
        } elseif (!is_numeric($input['supply_price']) || !preg_match('/^\d+(\.\d{2})$/', $input['supply_price'])) {
            $errors['supply_price'] = 'Supply price must be in valid numeric currency format';
        }
        if (!isset($input['image_link']) || empty($input['image_link'])) {
            $errors['image_link'] = 'Image link is required';
        }

        return $errors;
    }

    public function isValidOrderProductInput($input) {
        $errors = [];

        // Not Empty, Positive Integer
        if (!isset($input['quantity_ordered'])) {
            $errors['quantity_ordered'] = 'Quantity is required';
        } elseif (!is_numeric($input['quantity_ordered']) || $input['quantity_ordered'] <= 0) {
            $errors['quantity_ordered'] = 'Quantity ordered must be a positive integer';
        }

        return $errors;
    }


    // Add new product to database from Inventory View
    public function addProduct() {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Validate Form Input
            $errors = $this->isValidProductInput($_POST);

            // Add form data to db if no errors
            if (!empty($errors)) {
                // Return validation errors as JSON response
                http_response_code(200);
                echo json_encode(array('errors' => $errors));
                return;
            } else {
                $this->db->query(
                    "insert into products (product_name, category, brand, volume, unit_price, supply_price, quantity_available, image_link) 
                    values ($1, $2, $3, $4, $5,$6,$7,$8);",
                    $_POST["product_name"],
                    $_POST["category"],
                    $_POST["brand"],
                    $_POST["volume"],
                    floatval($_POST["unit_price"]),
                    floatval($_POST["supply_price"]),
                    floatval($_POST["quantity_available"]),
                    $_POST["image_link"]
                );
                // Return success message as JSON response
                echo json_encode(array('success' => true));

                return;
            }
        } else {
            // Invalid request method
            http_response_code(405);
            echo json_encode(array('error' => 'Invalid request method'));
            return;
        }
    }


    // Order more of existing product in database from Inventory View
    public function orderProduct() {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Validate Form Input
            $errors = $this->isValidOrderProductInput($_POST);

            // Check for validation errors
            if (!empty($errors)) {
                // Return validation errors as JSON response
                http_response_code(200);
                echo json_encode(array('errors' => $errors));
                return;
            } else {
                // Update quantity available for specified product
                $query = "UPDATE products SET quantity_available = quantity_available + $1 WHERE product_id = $2";
                $this->db->query(
                    $query,
                    intval($_POST["quantity_ordered"]),
                    intval($_POST["product_id"])
                );

                $pricequery = $this->db->query(
                    "SELECT supply_price FROM products WHERE product_id=$1",
                    intval($_POST["product_id"])
                );

                $price = $pricequery[0]["supply_price"];
                $this->db->query(
                    "insert into orders (product_id, quantity_ordered, total_cost) values ($1,$2,$3);",
                    intval($_POST["product_id"]),
                    intval($_POST["quantity_ordered"]),
                    floatval($price) * intval($_POST["quantity_ordered"])
                );
                // Return success message as JSON response
                echo json_encode(array('success' => true));

                return;
            }
        } else {
            // Invalid request method
            http_response_code(405);
            echo json_encode(array('error' => 'Invalid request method'));
            return;
        }
    }
    public function getAllPastOrders() {
        $orders = $this->db->query("select * from orders");
        foreach ($orders as $key => $order) {
            $pid = $order["product_id"];
            $pname =  $this->db->query("select product_name from products where product_id=$1", $pid);

            if (!empty($pname)) {
                $orders[$key]["product_name"] = $pname[0]["product_name"];
            } else {
                $orders[$key]["product_name"] = "Product name not found";
            }
        };

        // Update the session variable with the modified orders
        $_SESSION["orders"] = $orders;
        return $orders;
    }
    public function doCheckout() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Use 'php://input' for raw data after HTTP headers https://stackoverflow.com/questions/8893574/php-php-input-vs-post
            $rawPostData = file_get_contents('php://input');

            $cart = json_decode($rawPostData, true);

            if ($cart === null) {
                http_response_code(400);
                echo "No cart exists or cart is empty";
                return;
            }
            
            foreach ($cart as $product) {
                if (isset($product['quantity']) && isset($product['product_id'])) {
                    $query = "UPDATE products SET quantity_available = quantity_available - $1 WHERE product_id = $2";
                    $this->db->query(
                        $query,
                        [intval($product["quantity"]), intval($product["product_id"])]
                    );
                }
            }

            $this->showCustViewProducts();
        } else {
            // Invalid request
            http_response_code(405);
        }
}
    // Edit existing product in database from Inventory View
    public function updateProduct() {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Validate Form Input
            $errors = $this->isValidProductInput($_POST);

            // Add form data to db if no errors
            if (!empty($errors)) {
                // Return validation errors as JSON response
                http_response_code(200);
                echo json_encode(array('errors' => $errors));
                return;
            } else {
                $query = "UPDATE products SET 
                product_name = $1,
                category = $2,
                brand = $3,
                volume = $4,
                unit_price = $5,
                supply_price = $6,
                quantity_available = $7
                WHERE product_id = $8";

                $this->db->query(
                    $query,
                    $_POST["product_name"],
                    $_POST["category"],
                    $_POST["brand"],
                    $_POST["volume"],
                    floatval($_POST["unit_price"]),
                    floatval($_POST["supply_price"]),
                    floatval($_POST["quantity_available"]),
                    intval($_POST["product_id"])
                );

                // Return success message as JSON response
                echo json_encode(array('success' => true));
                return;
            }
        } else {
            // Invalid request method
            http_response_code(405); // Method Not Allowed
            echo json_encode(array('error' => 'Invalid request method'));
            return;
        }
    }


    // Delete existing product in database from Inventory View
    public function deleteProduct() {

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product_id"])) {
            // Execute delete query
            $query = "DELETE FROM products WHERE product_id = $1";
            $res = $this->db->query($query, intval($_POST['product_id']));

            // Ensure query was executed
            if ($res !== false) {
                header("Location: ?command=inventory");
                exit();
            } else {
                $_SESSION['db_errors'] = ['Failed to delete product'];
            }
        }
    }

    public function getAllProducts() {
        $products = $this->db->query("select * from products");
        $_SESSION["products"] = $products;
        return $products;
    }
    public function getAllProductsForCustomer() {
        $Custproducts = $this->db->query("SELECT * from products WHERE quantity_available > 0");
        $_SESSION["CustProducts"] = $Custproducts;
        return $Custproducts;
    }
    public function logout() {
        session_destroy();
        session_start();
        $this->showLogin();
    }
}
