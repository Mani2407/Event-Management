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
      <h3>Catering Requests</h3>
      <table>
        <thead>
          <tr>
              <th>Item Name</th>
              <th>Price</th>
              <th>Description</th>
              <th class="right-align">Action</th>
          </tr>
        </thead>

        <tbody>
        <?php
          $getBookings = "select * from caterings";
          $runBookings = mysqli_query($conn, $getBookings);
          while ($rowBookings = mysqli_fetch_array($runBookings)) {
            $bId = $rowBookings['id'];
            $item_name = $rowBookings['item_name'];
            $price = $rowBookings['price'];
            $description = $rowBookings['description'];
            
            

            echo "
                  <tr>
                    <td>$item_name</td>
                    <td>$price</td>
                    <td>$description</td>
                  ";

                  echo "
                      <td class='right-align'>
                        <a href='./catering_edit.php?catering_id=$bId' class='waves-effect waves-light btn light-blue'>Edit <i class='material-icons left'>check</i></a>
                        <a href='./catering_delete.php?catering_id=$bId' class='waves-effect waves-light btn red'>Delete<i class='material-icons left'>close</i></a>
                      </td>
                    </tr>
                  ";
                    
                    
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
<div class="fixed-action-btn" style="margin-right: 8%; margin-bottom: 2%;">
    <a class="btn-floating btn-large waves-effect waves-light green modal-trigger" href="./catering_add.php">
      <i class="large material-icons">add</i>
    </a>
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