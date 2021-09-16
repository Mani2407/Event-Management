<?php
session_start();
include('./db/db.php');
if (!isset($_SESSION['userId'])) {
  echo "<script> window.open('login.php','_self')</script>";
}

$cid=$_GET['eventid'];

$delete_item="UPDATE `bookings` set status='2' WHERE id='$cid'";
$delete_item_run=mysqli_query($conn,$delete_item);

	echo "<script>alert('Booking Cancelled')</script>";
	echo "<script>window.location.href='view_bookings.php'</script>";



?>