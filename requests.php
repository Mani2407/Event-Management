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
      <h3>Booking Requests</h3>
      <table>
        <thead>
          <tr>
              <th>Name</th>
              <th>Event</th>
              <th>Date</th>
              <th>To Date</th>
              <th>Phone</th>
              <th>Address</th>
              <th class="right-align">Action</th>
          </tr>
        </thead>

        <tbody>
        <?php
          $getBookings = "select * from bookings";
          $runBookings = mysqli_query($conn, $getBookings);
          while ($rowBookings = mysqli_fetch_array($runBookings)) {
            $bId = $rowBookings['id'];
            $uId = $rowBookings['userId'];
            $eId = $rowBookings['event'];
            $fromDate = $rowBookings['fromDate'];
            $toDate = $rowBookings['toDate'] == '0000-00-00' ? '-' : $rowBookings['toDate'];
            $address = $rowBookings['address'];
            $status = $rowBookings['status'];

            $getUser = "select * from users where id='$uId'";
            $runUser = mysqli_query($conn, $getUser);
            $rowUser =  mysqli_fetch_array($runUser);
            $name = $rowUser['name'];
            $phone = $rowUser['phone'];

            $getEvent = "select * from events where id='$eId'";
            $runEvent = mysqli_query($conn, $getEvent);
            $rowEvent =  mysqli_fetch_array($runEvent);
            $event = $rowEvent['name'];


            echo "
                  <tr>
                    <td>$name</td>
                    <td>$event</td>
                    <td>$fromDate</td>
                    <td>$toDate</td>
                    <td>$phone</td>
                    <td>$address</td>
                  ";

                  if($status == NULL)
                  echo "
                      <td class='right-align'>
                        <a href='./actions.php?bookingid=$bId&approve=1' class='waves-effect waves-light btn light-blue'>Approve <i class='material-icons left'>check</i></a>
                        <a href='./reject.php?bookingid=$bId' class='waves-effect waves-light btn red'>Reject<i class='material-icons left'>close</i></a>
                      </td>
                    </tr>
                  ";
                    
                    else if($status == 0)
                    echo "
                    
                    <td class='center-align red-text'><h6>Rejected</h6></td>
                    </tr>";

                  else
                  echo "
                  <td class='center-align green-text'><h6>Approved</h6></td>
                  </tr>";
          }
          ?>
        </tbody>
      </table>
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