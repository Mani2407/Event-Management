<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('../includes/head.php'); ?>
</head>

<body>
  <?php
  include('../db/db.php');
  include('../functions/functions.php');

  if (isset($_GET['bookingid'])) {
    $id = $_GET['bookingid'];
    $status = null;

    if (isset($_GET['approve'])) {
      $status = 1;
    }
    if (isset($_GET['reject'])) {
      $status = 0;
    }

    $updateBooking = "update bookings set status='$status' where id='$id'";
    $runBooking = mysqli_query($conn, $updateBooking);
    if ($runBooking) {
      echo "
            <script>
              if ( window.history.replaceState ) {
                  window.history.replaceState( null, null, window.location.href );
              }
            </script>";
      showErrorSuccessModel(1, 'Booking Updated Successfully.', 'OK', './requests.php');
    } else {
      echo "
            <script>
              if ( window.history.replaceState ) {
                  window.history.replaceState( null, null, window.location.href );
              }
            </script>";
      showErrorSuccessModel(0, 'Something Went Wrong.', 'OK', './requests.php');
    }
  }
  ?>

</body>

</html>