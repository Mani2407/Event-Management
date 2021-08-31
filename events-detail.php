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
  <?php
  
  if (isset($_GET['eventid'])) {
    $id = $_GET['eventid'];
  $getEvent = "select * from events where id='$id'";
  $runEvent = mysqli_query($conn, $getEvent);
  while ($rowEvent = mysqli_fetch_array($runEvent)) {
    $eId = $rowEvent['id'];
    $name = $rowEvent['name'];
    $image = $rowEvent['image'];
    $price = $rowEvent['price'];
    $description = $rowEvent['description'];
  }
}
  ?>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <div class="row">
        <div class="col m7">
          <img class="activator" src="./eventsimages/<?php echo $image ?>" style="min-height: 310px; width: 600px;">
        </div>
        <div class="col m5">
          <ul class="collection with-header">
            <li class="collection-header">
              <h4><?php echo $name ?></h4>
            </li>
            <li class="collection-item">
              <h4 class="green-text" style="margin: 0; padding: 0;"><?php echo '₹ '.$price ?></h4>
            </li>
            <!-- <li class="collection-item">Engagement</li>
            <li class="collection-item">Photoshoot & Prewedding</li>
            <li class="collection-item">Food Management</li>
            <li class="collection-item">Music Management</li>
            <li class="collection-item">Mahendi Ceremony</li>
            <li class="collection-item">Haldi Ceremony</li> -->
          </ul>
          <br>
          <!-- <div class="row"> -->
          <!-- <h4 class="green-text col m5" style="margin: 0; margin-left: 10px; padding: 0;" >₹ 1,00,000</h4> -->
          <a href="./book-event.php?eventid=<?php echo $eId; ?>" class="waves-effect waves-light btn light-blue col m12">Book Event</a>

          <!-- </div> -->
        </div>
      </div>
      <div>
        <blockquote style="text-align: justify; border-color: lightblue;"><?php echo $description ?></blockquote>
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