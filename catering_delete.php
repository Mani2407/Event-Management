<?php
session_start();
include('./db/db.php');
if (!isset($_SESSION['admin'])) {
  echo "<script> window.open('login.php','_self')</script>";
}

$cid=$_GET['catering_id'];

$delete_item="DELETE FROM `caterings` WHERE id='$cid'";
$delete_item_run=mysqli_query($conn,$delete_item);

	echo "<script>alert('Item Deleted')</script>";
	echo "<script>window.location.href='catering_requests.php'</script>";



?>