<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('../includes/head.php'); ?>
</head>
<body>
  <?php
    include('../db/db.php');
    include('../functions/functions.php');

    if(isset($_GET['eventid'])){
      $id = $_GET['eventid'];
      $deleteEvents = "delete from events where id = '$id'";
      $runEvents = mysqli_query($conn, $deleteEvents);
      if ($runEvents) {
        echo "
          <script>
            window.location.href = './events/events.php';
          </script>";
      } else {
        showErrorSuccessModel(0, 'Something Went Wrong.');
      }
    }    
  ?>

</body>
</html>
