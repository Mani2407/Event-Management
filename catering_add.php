<?php
session_start();
include('../db/db.php');
include('../functions/functions.php');
if (!isset($_SESSION['admin'])) {
  echo "<script> window.open('login.php','_self')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('includes/head.php'); ?>
</head>

<body>
  <?php include('includes/nav.php'); ?>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <form action="#" method="post" enctype="multipart/form-data">
      <h4>Add Catering</h4>
      <div class="row">
        <div class="input-field col s12">
          <input id="name" name="item_name" type="text" class="validate">
          <label for="name">Item name</label>
        </div>
        <div class="file-field input-field col s12">
          <div class="btn light-blue">
            <span>Images</span>
            <input type="file" name="image[]" multiple="multiple" accept="image/jpeg">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text" placeholder="Upload Image">
          </div>
        </div>
        <div class="input-field col s12">
          <input type="number" name="item_price" min="1" max="10000" class="materialize-textarea">
          <label for="description">Item Price</label>
        </div>
        <div class="input-field col s12">
          <textarea name="description" id="description" class="materialize-textarea" data-length="120"></textarea>
          <label for="description">Description</label>
        </div>
        <div class="input-field col s12">
          <button type="submit" name="addevent" class="waves-effect waves-light btn light-blue">Add Catering</button>
        </div>
      </div>
      </form>
    </div>
  </div>

  <?php include('../includes/footerScripts.php'); ?>
  <script>
    $(document).ready(function() {
      $('.modal').modal() ;
    });
  </script>

</body>

</html>



<?php
if(isset($_POST['addevent'])){
  $name = mysqli_real_escape_string($conn, $_POST['item_name']);
  $photoType = $_FILES['image']['type']; //returns the mimetype
  $price = $_POST['item_price'];
  $description = $_POST['description'];
  $imagesss="";
  $allowed = array("image/jpeg", "image/jpg"); //, "application/pdf");
  
    $image = $_FILES['image']['name'];
    
    $temp_name1 = $_FILES['image']['tmp_name'];

    if (empty($name) || empty($price) || empty($description) || empty($image)) {
      showErrorSuccessModel(0, 'All Fields are mendatory.');

    } else {
      $countt=count($_FILES['image']['name']);
      for($i=0;$i<$countt;$i++){
        $photoType = $_FILES['image']['type'][$i]; //returns the mimetype
        if(!in_array($photoType, $allowed)) {
          showErrorSuccessModel(0, 'Only jpg, jpeg, and pdf files are allowed.');
          break;
        } 
         $filename = $_FILES['image']['name'][$i];
        $newImageName = uniqid('em', true).'.'.strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        move_uploaded_file($_FILES['image']['tmp_name'][$i],"../cateringimages/$newImageName");
        $imagesss=$imagesss.",".$newImageName;  
      }
      
  
      $insertCatering = "insert into caterings (`item_name`, `image`,`price`,`description`) 
                      values ('$name','$newImageName','$price','$description')";
      $runEvents = mysqli_query($conn, $insertCatering);
      if ($runEvents) {
        showErrorSuccessModel(1, 'Catering added.');
      } else {
        showErrorSuccessModel(0, '');
      }
    }
  
}
?>
