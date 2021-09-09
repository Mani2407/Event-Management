<?php
session_start();
include('./db/db.php');
if (!isset($_SESSION['admin'])) {
  echo "<script> window.open('login.php','_self')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('./includes/head.php'); ?>
</head>

<body>
  <?php include('./includes/nav.php'); ?>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <h3 align="center">Welcome Admin</h3>      
      <br><br><br><br><br><br><br><br><h3 align="center">Number of Booking Requests: <?php 
        $sql="Select count(*) as total from bookings";
        $runn=mysqli_query($conn,$sql);
        $fetch=mysqli_fetch_array($runn);
        echo $fetch['total'];
       ?></h3><h3 align="center">Number of Catering Requests: <?php  
       $sql="Select count(*) as total from caterings";
        $runn=mysqli_query($conn,$sql);
        $fetch=mysqli_fetch_array($runn);
        echo $fetch['total']; ?></h3>

      </div>
  </div>
  
  
  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  
</body>

</html>

<?php

if (isset($_GET['approve'])) {
  echo 'Done';
}


?>