

<?php 


class  RegisterUser {

    // define the properties
    
    private $username;
    private $email;
    private $password;
    public $error;

    public $success;
    private $storage = "user.json";
    private $stored_users;
    private $new_user;

    // define the constructor

    public function __construct($username,$email,$password) {

        

        $this->username = filter_var(trim($username), FILTER_SANITIZE_STRING);

        $this->email = filter_var(trim($email),FILTER_VALIDATE_EMAIL);

        $this->password = filter_var(trim($password), FILTER_SANITIZE_STRING);
        
        $this->encrypted_password = password_hash($this->password, PASSWORD_DEFAULT);

        $this->stored_users = json_decode(file_get_contents($this->storage), true);

        $this->new_user = [
            "username" => $this->username,
            "email" => $this->email,
            "password" => $this->encrypted_password
           
        ];

        if($this->checkFieldValues()   && !$this->emailexists()) {
            session_start();
            $_SESSION['email'] = $this->email;
            $rootFolder = 'assets/user_folders/';

            
            $userFolder = $rootFolder . $_SESSION['email'];
            
            
            if (!file_exists($userFolder)) {
                
                if (mkdir($userFolder, 0777, true)) {
                    echo "User folder created successfully!";
                } else {
                    echo "Failed to create user folder!";
                }
            } else {
                echo "User folder already exists!";
            }
            $this->insertuser();
            header("Location: login.php");
        } else {
             $this->error;
        }
    }

    // define the field

    private function checkFieldValues() {
        if(empty($this->username) || empty($this->email) || empty($this->password)) {
            $this->error = "Please fill all the fields";
            return false;
        } else {
           return true;
        }
    }

    // check condition

    // private function checkConditions() {
    //     if(!isset($this->checkbox)){
    //         $this->error = "Please accept the terms and conditions";
    //         return false;
    //     } else {
    //         return true;
        
    //     }
    // }

    // check if the user already exists
    private function emailexists() {
        foreach($this->stored_users as $user) {
            if($user['email'] == $this->email || $user['username'] == $this->username) {
                $this->error = "Email or Username already exists";
                return true;
            }
        }
        return false;
    }

    //insert user 
    private function insertuser() {
        array_push($this->stored_users, $this->new_user);
        file_put_contents($this->storage, json_encode($this->stored_users));
        
    }

}

?>