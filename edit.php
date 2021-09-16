<?php
session_start();
include('../db/db.php');
include('../../functions/functions.php');
if (!isset($_SESSION['admin'])) {
  echo "<script> window.open('login.php','_self')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('../includes/head.php'); ?>
</head>

<body>
  <?php include('../includes/nav.php'); ?>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">

      <form action="#" method="post" enctype="multipart/form-data">
        <h4>Edit Event</h4>
        <?php
        if (isset($_GET['eventid'])) {
          $id = $_GET['eventid'];
          $getEvents = "select * from events where id='$id'";
          $runEvents = mysqli_query($conn, $getEvents);
          $rowEvents = mysqli_fetch_array($runEvents);
          $imageId = $rowEvents['id'];
          $name = $rowEvents['name'];
          $image = $rowEvents['image'];
          $price = $rowEvents['price'];
          $description = $rowEvents['description'];
          $location=$rowEvents['location'];
          $noofpeople=$rowEvents['noofpeople'];
          $duration=$rowEvents['duration'];
?>
<div class="row">
        <div class="input-field col s12">
          <input id="name" name="name" type="text" value="<?php echo $name; ?>" class="validate">
          <label for="name">Name</label>
        </div>
        <div class="file-field input-field col s12">
          <div class="btn light-blue">
            <span>Images</span>
            <input type="file" name="image[]" multiple >
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text" value="<?php echo $image; ?>" placeholder="Upload Image">
          </div>
        </div>
        <div class="input-field col s12">
          <textarea name="description" id="description" class="materialize-textarea" data-length="120"><?php echo $description; ?></textarea>
          <label for="description">Description</label>
        </div>
        <div class="input-field col s12">
          <textarea name="location" id="description" class="materialize-textarea" data-length="120"><?php echo $location; ?></textarea>
          <label for="description">Location</label>
        </div>
        <div class="input-field col s12">
          <input type="number" name="noofpeople" min="1" max="10000" class="materialize-textarea">
          <label for="description">Max No. of People</label>
        </div>
        <div class="input-field col s12">
          <input type="number" name="duration" min="1" max="10000" class="materialize-textarea">
          <label for="description">Duration(hrs)</label>
        </div>
        <div class="input-field col s12">
          <input type="number" name="price" min="1" max="10000" class="materialize-textarea">
          <label for="description">Price</label>
        </div>
        <div class="input-field col s12">
          <button type="submit" name="editevent" class="waves-effect waves-light btn light-blue">Update Event</button>
        </div>
      </div>

          
  <?php      }
        ?>
      </form>
    </div>
  </div>

  <?php include('../includes/footerScripts.php'); ?>
  <script>
    $(document).ready(function() {
      $('.modal').modal();
    });
  </script>

</body>

</html>

<?php
if (isset($_POST['editevent'])) {
  if (isset($_GET['eventid'])) {
    $id = $_GET['eventid'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
  $price = mysqli_real_escape_string($conn, $_POST['price']);
  $description = $_POST['description'];
  $location = $_POST['location'];
  $noofpeople = $_POST['noofpeople'];
  $duration = $_POST['duration'];
  $price = $_POST['price'];
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
        move_uploaded_file($_FILES['image']['tmp_name'][$i],"../../eventsimages/$newImageName");
        $imagesss=$imagesss.",".$newImageName;  
      }
      $updateevent="Update events set name='$name', price='$price',description='$description',image='$imagesss',location='$location',noofpeople='$noofpeople',duration='$duration' where id='$id'";
      $runEvents = mysqli_query($conn, $updateevent);
      if ($runEvents) {
        showErrorSuccessModel(1, 'Event Updated.');
        echo "<script>window.location.href='events.php'</script>";
      } else {
        showErrorSuccessModel(0, '');
      }
    }
  
  }
}
?>