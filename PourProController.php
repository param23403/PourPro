<?php

class PourProController {

    private $input;
    private $db;
    private $errorMessage = "";
    private $errorModelInfo = "";
    public function __construct($input) {
        session_start();
        $this->input = $input;
        $this->db = new Database();
    }

    public function run() {
        // Check if a specific command is set
        $command = "inventory";

        if (isset($this->input["command"]))
            $command = $this->input["command"];

        if (!isset($_SESSION["email"]))
            $command = "login";

        switch ($command) {
            case 'login':
                $this->loginDatabase();
                break;
            case 'logout':
                $this->logout();
                break;
            case 'signUp':
                $this->showSignUp();
                break;
            case 'detail':
                $this->showDetail();
                break;
            case 'inventory':
                $this->showInventory();
                break;
            case 'addProduct':
                $this->addProduct();
            case 'profile':
                $this->showProfile();
            default:
                $this->showLogin();
        }
    }


    public function showLogin() {
        $errorMessage = "";
        if (!empty($this->errorMessage)) {
            $errorMessage = "<div class='alert alert-danger'>{$this->errorMessage}</div>";
        }
        // include '/opt/src/pourpro/templates/login.php';
        include '/students/jpg5wq/students/jpg5wq/private/pourpro/templates/login.php';
        // include '/students/xtz3mx/students/xtz3mx/private/pourpro/templates/home.php';
    }

    public function showSignUp() {
        // include '/opt/src/pourpro/templates/signup.php';
        include '/students/jpg5wq/students/jpg5wq/private/pourpro/templates/signup.php';
        // include '/students/xtz3mx/students/xtz3mx/private/pourpro/templates/signup.php';
    }

    public function showInventory() {
        $this->getAllProducts();
        // include '/opt/src/pourpro/templates/inventory.php';
        include '/students/jpg5wq/students/jpg5wq/private/pourpro/templates/inventory.php';
        // include '/students/xtz3mx/students/xtz3mx/private/pourpro/templates/inventory.php';
    }

    public function showDetail() {
        // include '/opt/src/pourpro/templates/detail.php';
        include '/students/jpg5wq/students/jpg5wq/private/pourpro/templates/detail.php';
        // include '/students/xtz3mx/students/xtz3mx/private/pourpro/templates/detail.php';
    }

    public function loginDatabase() {
        // User must provide a non-empty name, email, and password to attempt a login
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
                    $_POST["type"]
                );
                $_SESSION["name"] = $_POST["fullname"];
                $_SESSION["email"] = $_POST["email"];
                $_SESSION["type"] = $_POST["type"];
                // Send user to the appropriate page (question)
                header("Location: ?command=inventory");
                return;
            } else {
                // User was in the database, verify password is correct
                // Note: Since we used a 1-way hash, we must use password_verify()
                // to check that the passwords match.
                if (password_verify($_POST["passwd"], $res[0]["password"])) {
                    // Password was correct, save their information to the
                    // session and send them to the question page
                    $_SESSION["name"] = $res[0]["name"];
                    $_SESSION["email"] = $res[0]["email"];
                    $_SESSION["type"] = $res[0]["type"];
                    header("Location: ?command=inventory");
                    return;
                } else {
                    // Password was incorrect
                    $this->errorMessage = "Incorrect password.";
                }
            }
        } else {
            $this->errorMessage = "Name, email, and password are required.";
        }
        // If something went wrong, show the welcome page again
        $this->showLogin();
    }
    
    public function isValidAddProductInput($input) {
        // Clear errors
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
                $errors[$field] = $field . ' must be less than or equal to 100 characters';
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
    
        return $errors;
    }

    public function addProduct() {
        // Clear session errors and old input
        unset($_SESSION['old_input']);
        unset($_SESSION['errors']);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Validate Form Input
            $errors = $this->isValidAddProductInput($_POST);

            // Add form data to db if no errors
            if (empty($errors)) {
                $this->db->query(
                    "insert into products (product_name, category, brand, volume, unit_price, supply_price, quantity_available) 
                    values ($1, $2, $3, $4, $5,$6,$7);",
                    $_POST["product_name"],
                    $_POST["category"],
                    $_POST["brand"],
                    $_POST["volume"],
                    floatval($_POST["unit_price"]),
                    floatval($_POST["supply_price"]),
                    floatval($_POST["quantity_available"])
                );

                unset($_SESSION['old_input']);
                unset($_SESSION['errors']);
                header("Location: ?command=inventory");
                return;
            } else {
                // Retain old values in form if they produced errors
                $_SESSION['old_input'] = $_POST;
                $_SESSION["errors"] = $errors;
                header("Location: ?command=inventory");
            }
        } else {
            $this->errorModelInfo = "Please enter all the information correctly";
        }
    }

    public function isValidOrderProductInput($input) {
        $errors = [];

        if (!isset($input['quantity_ordered']) || empty($input['quantity_ordered'])) {
            $errors['quantity_ordered'] = 'Quantity is required';
        } elseif (!is_numeric($input['quantity_ordered']) || $input['quantity_ordered'] < 0) {
            $errors['quantity_ordered'] = 'Quantity ordered must be a positive integer';
        }
    }

    public function orderProduct() {
        // Clear session errors and old input
        unset($_SESSION['old_input']);
        unset($_SESSION['errors']);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Validate Form Input
            $errors = $this->isValidOrderProductInput($_POST);

            // Add form data to db if no errors
            if (empty($errors)) {
                // Update the quantity available for specified product
                $query = "UPDATE products SET quantity_available = quantity_available + $1 WHERE product_id = $2";
                $this->db->query(
                    $query,
                    intval($_POST["quantity_ordered"]),
                    intval($_POST["product_id"])
                );

                unset($_SESSION['old_input']);
                unset($_SESSION['errors']);
                header("Location: ?command=inventory");
                return;
            } else {
                // Retain old values in form if they produced errors
                $_SESSION['old_input'] = $_POST;
                $_SESSION["errors"] = $errors;
                header("Location: ?command=inventory");
            }
        } else {
            $this->errorModelInfo = "Please enter all the information correctly";
        }

    }

    public function getAllProducts(){
        $products = $this->db->query("select * from products");
        $_SESSION["products"] = $products;
        return $products;
    }
    public function showProfile(){
        // include '/opt/src/pourpro/templates/profile.php';
        include '/students/jpg5wq/students/jpg5wq/private/pourpro/templates/profile.php';
        // include '/students/xtz3mx/students/xtz3mx/private/pourpro/templates/profile.php';
    }
    public function logout() {
        session_destroy();
        session_start();
        $this->showLogin();
    }
}
