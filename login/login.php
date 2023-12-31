<?php 
include './login.class.php';
session_start();
if (isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit();
}
if(isset($_POST['submit'])) {
    $user = new LoginUser($_POST['username'], $_POST['password']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        body {
            background-color: #f1f1f1;
        }
        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card-body {
            background-color: #f8f9fa;
        }
        .left-side {
            background-color: #007bff;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;
            padding: 1rem;
        }
        .left-side h2 {
            color: #fff;
        }
        .left-side p {
            color: #fff;
        }
        .bg-secondary-subtle {
            background-color: #f8f9fa;
        }
       
        .buttons {
            justify-content: center;
        }
        .buttons a {
            color: #fff;
            text-decoration: none;
        }
        .buttons a:hover {
            text-decoration: underline;
        }
        #error {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="card center d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="row g-0">
            <div class="col-md-4">
                <div class="left-side">
                    <div class="top-side">
                        <h2>Sign Up</h2>
                        <p>Sign up with simple details, it will be cross-checked by the administration</p>
                    </div>
                    <div class="bottom-side">
                        <h2>Sign In</h2>
                        <p>Sign in with your username and password</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card-body size-form  ">
                    <div class="container d-flex justify-content-center align-items-center" style="height: 500px;">
                        <form method="POST" action="" class="w-50" style="margin: 0 auto;">
                            <div class="form-group mb-3">
                                <label for="username">Username</label>
                                <input type="text" class="form-control border-form" name="username" id="username" placeholder="example.new" autocomplete="no-randomstring">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control border-form" name="password" id="password" placeholder="***********" autocomplete="no-randomstring">
                            </div>
                            <div class="buttons d-flex align-items-center gap-3 mt-5">
                                <button class="btn btn-primary" type="submit" name="submit">Log in</button>
                                <span>or</span>
                                <button class="btn"><a class="text-primary" href="../register/register.php">Sign Up</a></button>
                            </div>
                            <?php if(isset($user->error)) { ?>
                                <div class="alert alert-danger" id="error" role="alert">
                                    <?php echo $user->error; ?>
                                </div>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
