<?php
session_start();
include('../db/db.php');
if (!isset($_SESSION['admin'])) {
  echo "<script> window.open('login.php','_self')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('../includes/head.php'); ?>
</head>

<body>
  <?php include('../includes/nav.php'); ?>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <h3>Events</h3>
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Price</th>
            <th class="right-align">Action</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $getEvents = "select * from events";
          $runEvents = mysqli_query($conn, $getEvents);
          while ($rowEvents = mysqli_fetch_array($runEvents)) {
            $eId = $rowEvents['id'];
            $name = $rowEvents['name'];
            $price = $rowEvents['price'];

            echo "
                  <tr>
                    <td>$name</td>
                    <td>₹ $price</td>
                    <td class='right-align'>
                      <a href='./edit.php?eventid=$eId' class='waves-effect waves-light btn light-blue'>Edit<i class='material-icons left'>edit</i></a>
                      <a href='../delete.php?eventid=$eId' class='waves-effect waves-light btn red'>Delete<i class='material-icons left'>delete</i></a>
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
    <a class="btn-floating btn-large waves-effect waves-light green modal-trigger" href="./add.php">
      <i class="large material-icons">add</i>
    </a>
  </div>

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