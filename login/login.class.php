<?php 

class LoginUser {
    private $username;
    private $password;
    private $stored_users;
    public $error;
    public $success;
    private $storage = "../user.json";

    public function __construct ($username,$password) {
        $this->username = $username;
        $this->password = $password;
        $this->stored_users = json_decode(file_get_contents($this->storage), true);
        if($this->checkFieldValues()) {

            $this->login();
            if($this->login()) {
                header("Location: ../index.php");
            }
        }
       
    }

    private function login() {
        $loginSuccess = false; // Flag to track successful login
    
        foreach ($this->stored_users as $user) {
            if ($user['username'] == $this->username && password_verify($this->password, $user['password'])) {
                session_start();
                $_SESSION['user'] = $this->username;
                $loginSuccess = true; // Set the flag to true for successful login
                break; // Exit the loop as we found a match
            }
        }
    
        if ($loginSuccess) {
            header("Location: ../index.php");
            exit();
        } else {
            $this->error = "Invalid username or password";
        }
    }
    

    private function checkFieldValues() {
        if(empty($this->username)  || empty($this->password)) {
            $this->error = "Please fill all the fields";
            return false;
        } else {
           return true;
        }
    }

}

?>