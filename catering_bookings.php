<?php
session_start();
include('db/db.php');
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
      <h3>Catering Bookings</h3>
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>User Name</th>
            <th>Price</th>
            <th class="right-align">Action</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $getEvents = "select * from catering_bookings";
          $runEvents = mysqli_query($conn, $getEvents);
          while ($rowEvents = mysqli_fetch_array($runEvents)) {
            $eId = $rowEvents['id'];
            $name = $rowEvents['caterings_id'];

            $sql="select * from caterings where id='$name'";
            $sqll=mysqli_query($conn,$sql);
            $fetch=mysqli_fetch_array($sqll);
            $name=$fetch['item_name'];
            $price = $rowEvents['total_price'];
            $status= $rowEvents['status'];
            $userid=$rowEvents['cid'];
            $sql="Select * from users where id='$userid'";
            $fetch_name=mysqli_query($conn,$sql);
            $fetch=mysqli_fetch_array($fetch_name);
            $user_name=$fetch['name'];
            
            echo "
                  <tr>
                    <td>$name</td>
                    <td>$user_name</td>
                    <td>$ $price</td>
                  ";



                  if($status == NULL)
                  echo "
                    <td class='right-align'>
                      <a href='./catering_approve.php?eventid=$eId' class='waves-effect waves-light btn light-blue'>Approve<i class='material-icons left'>edit</i></a>
                      <a href='./catering_reject.php?eventid=$eId' class='waves-effect waves-light btn red'>Reject<i class='material-icons left'>delete</i></a>
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
  <!-- <div class="fixed-action-btn" style="margin-right: 8%; margin-bottom: 2%;">
    <a class="btn-floating btn-large waves-effect waves-light green modal-trigger" href="./add.php">
      <i class="large material-icons">add</i>
    </a>
  </div> -->

  <!-- Modal Structure -->
  <div id="modal1" class="modal open">
    <div class="modal-content">
      <h4>Add Event</h4>
      <div class="row">
        <div class="input-field col s12">
          <input id="name" type="text" class="validate">
          <label for="name">Name</label>
        </div>
        <div class="input-field col s6">
          <input id="price" type="text" class="validate">
          <label for="price">Price</label>
        </div>
        <div class="file-field input-field col s6">
          <div class="btn light-blue">
            <span>File</span>
            <input type="file" multiple>
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text" placeholder="Upload one or more files">
          </div>
        </div>
        <div class="input-field col s12">
          <textarea id="textarea2" class="materialize-textarea" data-length="120"></textarea>
          <label for="description">Description</label>
        </div>
        <div class="input-field col s12">
          <a class="waves-effect waves-light btn light-blue">Add</a>
          <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
        </div>
      </div>
    </div>
  </div>

  <?php include('../includes/footerScripts.php'); ?>

  <script>
    $(document).ready(function() {
      $('.modal').modal();
    });
  </script>

</body>

</html>