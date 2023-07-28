<?php


include 'layout/header.php' ;

// uploading a file
if (isset($_POST['submit'])) {
   
 $file = $_FILES['file'];
 print_r($file);

  
  $fileName = $file['name'];
  $fileTmpName = $file['tmp_name'];
  $fileSize =$file['size'];
  $fileError = $file['error'];
  $fileType = $file['type'];


  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));
  
  

  $allowed = array('jpg', 'jpeg', 'png', 'pdf');

  if(in_array($fileActualExt,$allowed)) {
    if($fileError === 0) {
      if($fileSize < 20971520) {
        $fileDestination = 'assets/user_folders'.'/'.$_SESSION['email'].'/'.$fileName;
        move_uploaded_file($fileTmpName,$fileDestination);
        header("Location: index.php?uploadsuccess");
        
       
      } else {
        echo "Your file is too big!";
      }
    } else {
      echo "There was an error uploading your file!";
    }
  } else {
    echo "You cannot upload files of this type!";
  }

  // if(isset($_GET['delete'])) {
  //   // get the file and then make the path and unlink it
  //   $file = $_FILES['file'];
  //   echo
  //   $fileName = $file['name'];
    
  //   $fileDestination = 'assets/user_folders'.'/'.$_SESSION['email'].'/'.$fileName;
  //   unlink($fileDestination);
  //   header("Location: index.php?success");
  // }

}



// Creating a Folder
if (isset($_POST["create"])) {
   
  $folderName = $_POST["folder_name"];

  
  $folderName = preg_replace('/[^A-Za-z0-9\-]/', '_', $folderName);

  
  $baseDirectory = 'assets/user_folders'.'/'.$_SESSION['email'].'/';

  
  if (!file_exists($baseDirectory)) {
      mkdir($baseDirectory, 0777, true);
  }

  
  $folderPath = $baseDirectory . $folderName;

  
  if (file_exists($folderPath)) {
      echo "Folder already exists.";
  } else {
      
      if (mkdir($folderPath, 0777)) {
          header("Location: index.php?foldercreated");
      } else {
          header("Location: index.php?exists");
      }
  }
}




?>

<!DOCTYPE html>
   

   <div class="header " >
    <div class="container  d-flex justify-content-between">
   
    <div class="header-content d-flex justify-content-start mx-2">
      <i class="fa-regular fa-folder-open  " style=" "></i>
       <h1>File Manger</h1>
     
      
    </div>

    <!-- modals -->
    <div class="modals  ">
      <!-- modal 1 -->
      <!-- Button trigger modal -->
<button type="button" class="btn btn-primary h-auto my-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Upload File
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data">
        <label for="file">Upload File</label> <br>
        <input type="file" name="file" class="form-control"> <br>
        <input type="submit" class="btn btn-primary" name="submit" value="Upload">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </form>
      </div>
      
      
      
    </div>
  </div>
</div>

  <!-- modal 2 -->

  <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModa2">
  Create Folder
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModa2" tabindex="-1" aria-labelledby="exampleModalLabe2" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     
      <div class="modal-body">
      <form action="" method="POST" enctype="multipart/form-data">
        <label for="folder_name">Create Folder</label> <br>
        <input type="text" name="folder_name" class="form-control"> <br>
        <input type="submit" class="btn btn-primary" name="create" value="Create">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
      
    </div>
  </div>
</div>

    </div>
    </div>
   </div>
    
   

    <table class="table table-striped">
        <div class="container w-50">
        <thead>
    <tr>
      <th scope="col">Title/Name</th>
      <th scope="col">File Type</th>
      <th scope="col">Data Added</th>
      <th scope="col">Manage</th>
      <th> <input class="form-check-input" id="mainCheckbox" type="checkbox" value="" id="defaultCheck1" onclick="checkAll()"></th>
    </tr>
  </thead>
  <tbody>

      

      <?php 
      
      $dir = "assets/user_folders".'/'.$_SESSION['email'].'/';
      // $files = scandir($dir);
      // $files = array_diff(scandir($dir), array('..', '.'));
      $files = glob($dir.'*.{jpg,jpeg,png,pdf}', GLOB_BRACE);
      $files = array_map('basename', $files);
      

    foreach($files as $file) { ?>
    
      
      <tr> 

      <td>
      <?php $fileName = explode('.' , $file);
            echo $fileName[0];
      ?>
      </td>

      <td>
        <?php $filetype = explode('.',$file);
              echo strtoupper( $filetype[1]);
        ?>
      </td>

      <td> 
      <?php  $dateAdded = date("d-m-Y g:i A");
      echo $dateAdded;
      ?>
      </td>

      <td>
      <i class='fa-regular fa-eye text-success border p-1 ' ></i> 
      <a href="?delete"><i class='fa-regular fa-trash-can border text-danger p-1' ></i> </a>
      </td>

      <td>
      <input class='form-check-input otherCheckbox' type='checkbox' value='' id='defaultCheck1'>
      </td>
       </tr> 

       

     
   
    <?php } ?>
    
   

    <!-- looping on the folders to upload them inside the table -->
   <?php  
   
    $dir = "assets/user_folders".'/'.$_SESSION['email'].'/';
    $folders = glob($dir.'*', GLOB_ONLYDIR);
    $folders = array_map('basename', $folders);


    foreach($folders as $folder) { ?>

      <tr>
        
        <td>
        <i class="fa-regular fa-folder-closed"></i>
          <?php echo $folder ?>
        </td>

        <td>Folder</td>

        <td> 
      <?php  $dateAdded = date("d-m-Y g:i A");
      echo $dateAdded;
      ?>
      </td>

      <td>
      <i class='fa-regular fa-eye text-success border p-1 ' ></i> 
      <a href="?delete"><i class='fa-regular fa-trash-can border text-danger p-1' ></i> </a>
      </td>

      <td>
      <input class='form-check-input otherCheckbox' type='checkbox' value='' id='defaultCheck1'>
      </td>
      </tr>


   <?php } ?>


    

      
    

  </tbody>
        </div>
  
</table>

   
       
    <?php include 'layout/footer.php' ?>
</html>