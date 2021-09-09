<?php
$event_id=$_GET['eventid'];
include('db/db.php');
$sql="Update catering_bookings set status=1 where id='$event_id'";
$run=mysqli_query($conn,$sql);
echo "<script>window.location.href='catering_bookings.php'</script>";

?>