<?php 
include './login.class.php';

if(isset($_POST['submit'])) {

    $user = new LoginUser($_POST['username'],$_POST['password']);
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
   <!-- css bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>




<div class="card center background-color-alic d-flex justify-content-center align-items-center  " style="height:100vh;">
        <div class="row g-0">
            <div class="col-md-4">
                <div class="left-side bg-primary h-100 d-flex flex-column justify-content-around align-items-center w-100">
                   
                    <div class="top-side">

                        <h2 class="text-white ">Sign Up</h2><br>
                        <p class="text-white">Sign up with simple details, it will be cross-checked by the administration</p>
                    </div>
                    <div class="bottom-side">

                        <h2 class="text-white">Sign In</h2><br>
                        <p class="text-white">Sign in with your username and password</p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card-body size-form bg-secondary-subtle h-100">
                    <div class="container">
                        <form method="POST" action='' class="w-50 " style="margin: 0 auto;" >
                            <label >UserName</label>
                            <input type="text" class="form-control border-form" name="username" placeholder="example.new" autocomplete="no-randomstring">
                            <br>
            
                            <div class="form-group mb-3">
                                <label>Password</label>
                                <input type="password" class="form-control border-form" name="password" placeholder="***********" autocomplete="no-randomstring">
                            </div>
                            <div class="buttons d-flex align-items-center gap-3">
                                <button class="btn btn-primary" type="submit" name="submit">Log in</button>
                                <span>or</span>
                                <button class="btn"><a href="../register/register.php">Sign Up</a></button>
                            </div>
                            <?php if(isset($user->error)) { ?>
                            <div class="alert alert-danger " id="error"  role="alert">
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