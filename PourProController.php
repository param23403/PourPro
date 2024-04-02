<?php

class PourProController {

    private $input;
    private $db;
    private $errorMessage = "";
    public function __construct($input) {
        session_start();
        $this->input = $input;
        $this->db = new Database();
    }

    public function run() {
        // Check if a specific command is set
        $command = "detail";
        
        if(isset($this->input["command"]))
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
            default:
                $this->showLogin();
        }
    }

   

    public function showLogin() {
        $errorMessage = "";
        if (!empty($this->errorMessage)) {
            $errorMessage = "<div class='alert alert-danger'>{$this->errorMessage}</div>";
        }
        include '/opt/src/pourpro/templates/login.php';
        // include '/students/jpg5wq/students/jpg5wq/private/pourpro/templates/home.php';
        // include '/students/xtz3mx/students/xtz3mx/private/pourpro/templates/home.php';
    }
    public function showSignUp() {
        include '/opt/src/pourpro/templates/signup.php';
        // include '/students/jpg5wq/students/jpg5wq/private/pourpro/templates/signup.php';
        // include '/students/xtz3mx/students/xtz3mx/private/pourpro/templates/signup.php';
    }
    public function showInventory() {
        include '/opt/src/pourpro/templates/inventory.php';
        // include '/students/jpg5wq/students/jpg5wq/private/pourpro/templates/inventory.php';
        // include '/students/xtz3mx/students/xtz3mx/private/pourpro/templates/inventory.php';
    }
    public function showDetail() {
        include '/opt/src/pourpro/templates/detail.php';
        // include '/students/jpg5wq/students/jpg5wq/private/pourpro/templates/detail.php';
        // include '/students/xtz3mx/students/xtz3mx/private/pourpro/templates/detail.php';
    }
    public function loginDatabase() {
        // User must provide a non-empty name, email, and password to attempt a login
        if(isset($_POST["fullname"]) && !empty($_POST["fullname"]) &&
            isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["passwd"]) && !empty($_POST["passwd"])) {

                // Check if user is in database, by email
                $res = $this->db->query("select * from users where email = $1;", $_POST["email"]);
                if (empty($res)) {
                    // User was not there (empty result), so insert them
                    $this->db->query("insert into users (name, email, password, score) values ($1, $2, $3, $4);",
                        $_POST["fullname"], $_POST["email"],
                        // Use the hashed password!
                        password_hash($_POST["passwd"], PASSWORD_DEFAULT), 0);
                    $_SESSION["name"] = $_POST["fullname"];
                    $_SESSION["email"] = $_POST["email"];
                    $_SESSION["score"] = 0;
                    // Send user to the appropriate page (question)
                    header("Location: ?command=detail");
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
                        $_SESSION["score"] = $res[0]["score"];
                        header("Location: ?command=detail");
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
    // public function checkCreds(){
    //     if (isset($_POST['email']) && isset($_POST['password'])&& !empty($_POST['email']) && !empty($_POST['password'])){
    //         $_SESSION['email'] = $_POST['email'];
    //         $_SESSION['password'] = $_POST['password'];
    //         header("Location: ?command=detail");  
    //         return;              
    //     }
    //     $this->errorMessage = "Error Logging in- Please Enter the correct email and password";
    //     $this->showHome();
    // }
    public function logout(){
        session_destroy();
        session_start();
        $this->showLogin();
    }
}
