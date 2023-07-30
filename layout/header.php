
<?php 

session_start();
if(!isset($_SESSION['user'])) {
    header("Location: login/login.php");
    exit();
}
if(isset($_GET['logout'])) {
    unset($_SESSION['user']);
    header("Location: login/login.php");
    exit();
}



?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Manger</title>
     
    
    <!-- css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- custom css -->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">


</head>
<!-- navbar -->
<nav class="navbar navbar-expand-lg bg-dark bg-gradient text-white">
  <div class="container ">
  
        <h3 class="nav-link"  >Welcome <?php echo  $_SESSION['user']; ?> <h3>
        
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

      <li class="nav-item d-flex justify-content-end">
          <a href="?logout"  class="text-white "><i class="fa-solid fa-arrow-right-from-bracket mx-1">Log out</i></a>
          
        </li>

       

       

       
        
      </ul>
      
    </div>
  </div>
</nav>
<body >