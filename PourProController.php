<?php

class PourProController {

    private $input;
    // private $db;
    public function __construct($input) {
        session_start();
        $this->input = $input;
        // $this->db = new Database();
    }

    public function run() {
        // Check if a specific command is set
        $command = isset($this->input['command'])
            ? $this->input['command']
            : 'default';
        if (!isset($_SESSION["email"]))
            $command = "login";
        switch ($command) {
            case 'login':
                $this->showLogin();
                break;
            case 'checkCreds':
                $this-> checkCreds();
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
                $this->showHome();
        }
    }

   

    public function showHome() {
        include '/opt/src/pourpro/templates/home.php';
        // include '/students/jpg5wq/students/jpg5wq/private/pourpro/templates/home.php';
        // include '/students/xtz3mx/students/xtz3mx/private/pourpro/templates/home.php';
    }
    public function showLogin() {
        include '/opt/src/pourpro/templates/login.php';
        // include '/students/jpg5wq/students/jpg5wq/private/pourpro/templates/login.php';
        // include '/students/xtz3mx/students/xtz3mx/private/pourpro/templates/login.php';
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
    public function checkCreds(){
        if (isset($_POST['email']) && isset($_POST['password'])&& !empty($_POST['email']) && !empty($_POST['password'])){
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];
            $this->message= "<div class=\"alert alert-success\">You successfully logged in</div>";
        }
        else{
        $this->message = "<div class=\"alert alert-danger\">Error Logging in- Please Enter the correct email and password</div>";
        }
        $this->showLogin();
    }
    public function logout(){
        session_destroy();
    }
}
