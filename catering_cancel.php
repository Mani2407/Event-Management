<?php
session_start();
include('./db/db.php');
if (!isset($_SESSION['userId'])) {
  echo "<script> window.open('login.php','_self')</script>";
}

$cid=$_GET['cancelId'];

$delete_item="UPDATE `catering_bookings` set status='2' WHERE id='$cid'";
$delete_item_run=mysqli_query($conn,$delete_item);

	echo "<script>alert('Catering Bookings Cancelled')</script>";
	echo "<script>window.location.href='view_cat_booking.php'</script>";



?>