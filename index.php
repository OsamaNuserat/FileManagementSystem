<?php

include 'header.php' ;
 
 if (isset($_POST['submit'])) {
   
 $file = $_FILES['file'];
 global $file;
  
  $fileName = $file['name'];
  $fileTmpName = $file['tmp_name'];
  $fileSize =$file['size'];
  $fileError = $file['error'];
  $fileType = $file['type'];
  print_r($fileType);

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
        <label for="text">Create Folder</label> <br>
        <input type="text" name="folder" class="form-control"> <br>
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
      
      $dir = "assets/user_folders".'/'.$_SESSION['email'];
      $files = scandir($dir);
      $files = array_diff(scandir($dir), array('..', '.'));
      
 
    foreach($files as $file) {  ?>
     
      <tr> 

      <td>
      <?php echo $file ?>
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
      <a href="#"><i class='fa-regular fa-eye text-success border p-1 '></i></a> 
      <a href="#"><i class='fa-regular fa-trash-can border text-danger p-1'></i></a> 
      </td>

      <td>
      <input class='form-check-input otherCheckbox' type='checkbox' value='' id='defaultCheck1'>
      </td>
       </tr> 
     
      
    <?php } ?>
    

  </tbody>
        </div>
  
</table>

   
       
    <?php include 'footer.php' ?>
</html>