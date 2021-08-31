<?php
include('./db/db.php');
include('./functions/functions.php');
session_start();
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
      <div class="row">
      <?php
          $getEvents = "select * from events";
          $runEvents = mysqli_query($conn, $getEvents);
          while ($rowEvents = mysqli_fetch_array($runEvents)) {
            $eId = $rowEvents['id'];
            $name = $rowEvents['name'];
            $image = $rowEvents['image'];

            echo "
            <div class='col m4'>
              <div class='card hoverable'>
                <div class='card-image waves-effect waves-block waves-light'>
                  <img class='activator' src='./eventsimages/$image' style='min-height: 307px;'>
                </div>
                <div class='card-content'>
                  <span class='card-title activator grey-text text-darken-4'>$name</span>
                  <p><a href='./events-detail.php?eventid=$eId' class='orange-text'>Show Details</a></p>
                </div>
              </div>
            </div>
              ";
          }
          ?>
      </div>
    </div>
  </div>

  <?php include('./includes/footer.php'); ?>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

</body>

</html>