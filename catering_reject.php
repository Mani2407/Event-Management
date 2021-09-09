<?php
session_start();
include('../db/db.php');
include('../functions/functions.php');
if (!isset($_SESSION['admin'])) {
  echo "<script> window.open('login.php','_self')</script>";
}
$booking_id=$_GET['eventid'];
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
      <form action="" method="post" enctype="multipart/form-data">
      <h4>Request Rejection</h4>
      <div class="row">
        <div class="input-field col s12">
          <input id="name" name="item_name" type="text" value="<?php echo $booking_id; ?>" class="validate">
          <label for="name">Catering Booking ID</label>
        </div>
        <div class="input-field col s12">
          <textarea name="reason" id="description" class="materialize-textarea" data-length="120"></textarea>
          <label for="description">Rejection Reason</label>
        </div>
        <div class="input-field col s12">
          <button type="submit" name="reason_submit" class="waves-effect waves-light btn red">Reject</button>
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
if(isset($_POST['reason_submit'])){
  $name = mysqli_real_escape_string($conn, $_POST['reason']);
  
      $updatbooking="update catering_bookings set note='$name',status='0' where id='$booking_id'";
      $runEvents = mysqli_query($conn, $updatbooking);
      if ($runEvents) {
        showErrorSuccessModel(1, 'Catering Booking Rejected.');
        echo "<script>window.location.href='http://localhost/em/admin/catering_bookings.php'</script>";
      } else {
        showErrorSuccessModel(0, '');
      }
    
  
}
?>
