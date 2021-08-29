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

          echo "
            <div class='row'>
            <div class='input-field col s12'>
              <input id='name' name='name' type='text' class='validate' value='$name'>
              <label for='name'>Name</label>
            </div>
            <div class='input-field col s6 m4'>
              <input id='price' name='price' type='text' class='validate' value='$price'>
              <label for='price'>Price</label>
            </div>
            <div class='input-field col s6 m3'>
              <img src='../eventsimages/$image' style='height: 180px' />
            </div>
            <div class='file-field input-field col s5'>
              <div class='btn light-blue'>
                <span>File</span>
                <input type='file' name='image'>
              </div>
              <div class='file-path-wrapper'>
                <input class='file-path validate' type='text' placeholder='Upload Image'>
              </div>
            </div>
            <div class='input-field col s12'>
              <textarea name='description' id='description' class='materialize-textarea' data-length='120'>$description</textarea>
              <label for='description'>Description</label>
            </div>
            <div class='input-field col s12'>
              <button type='submit' name='editevent' class='waves-effect waves-light btn light-blue'>Update Event</button>
            </div>
          </div>
						";
        }
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

    $allowed = array("image/jpeg", "image/jpg"); //, "application/pdf");

    if (empty($name) || empty($description) || empty($price)) {
      showErrorSuccessModel(0, 'All Fields are mendatory.');
    } else {
      $image = $_FILES['image']['name'];
      if ($image) {
        $photoType = $_FILES['image']['type']; //returns the mimetype
        if (!in_array($photoType, $allowed)) {
          showErrorSuccessModel(0, 'Only jpg, jpeg, and pdf files are allowed.');
        } else {
          $temp_name1 = $_FILES['image']['tmp_name'];
          $newImageName = uniqid('em', true) . '.' . strtolower(pathinfo($image, PATHINFO_EXTENSION));
          move_uploaded_file($temp_name1, "../../eventsimages/$newImageName");

          $updateEvent = "update events set name='$name',price='$price',description='$description',image='$image' where id='$id'";
          $runEvent = mysqli_query($conn, $updateEvent);
          if ($runEvent) {
            echo "
					<script>
						if ( window.history.replaceState ) {
								window.history.replaceState( null, null, window.location.href );
						}
					</script>";
            showErrorSuccessModel(1, 'Event Updated Successfully.');
          } else {
            echo "
					<script>
						if ( window.history.replaceState ) {
								window.history.replaceState( null, null, window.location.href );
						}
					</script>";
            showErrorSuccessModel(0, 'Something Went Wrong.');
          }
        }
      } else {
        $updateEvent = "update events set name='$name',price='$price',description='$description' where id='$id'";
        $runEvent = mysqli_query($conn, $updateEvent);
        if ($runEvent) {
          echo "
					<script>
						if ( window.history.replaceState ) {
								window.history.replaceState( null, null, window.location.href );
						}
					</script>";
          showErrorSuccessModel(1, 'Event Updated Successfully.');
        } else {
          echo "
					<script>
						if ( window.history.replaceState ) {
								window.history.replaceState( null, null, window.location.href );
						}
					</script>";
          showErrorSuccessModel(0, 'Something Went Wrong.');
        }
      }
    }
  }
}
?>