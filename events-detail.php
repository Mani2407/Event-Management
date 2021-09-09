<?php
include('./db/db.php');
include('./functions/functions.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('./includes/head.php'); ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <style type="text/css">
    .center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}
  </style>
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
    $images = explode(',', $image);
    $price = $rowEvent['price'];
    $description = $rowEvent['description'];
    $location = $rowEvent['location'];
    $noofpeople = $rowEvent['noofpeople'];
    $duration = $rowEvent['duration'];
  }
}
  ?>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <div class="row">

          <div class="col m7 ">

              <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                
                  <div class="item active">
                    <img src="./eventsimages/<?php echo $images[1];?>" alt="img1"  class="center">
                  </div>

                  <div class="item">
                    <img src="./eventsimages/<?php echo $images[2];?>" alt="img2"  class="center">
                  </div>
                
              
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
          

        <div class="col m5">
          <ul class="collection with-header">
            <li class="collection-header">
              <h4>Event Name: <?php echo $name ?></h4>
            </li>
            <li class="collection-item">
              <h6 >Price: <?php echo 'C$ '.$price ?></h4>
            </li>

            <li class="collection-item">
              <h6 >Location: <?php echo $location; ?></h4>
            </li>
            <li class="collection-item">
              <h6 >Occupancy: <?php echo $noofpeople; ?></h4>
            </li>
            <li class="collection-item">
              <h6 >Duration: <?php echo $duration; ?>hr</h4>
            </li>
            <li class="collection-item">
              <h6 >Description: <?php echo $description; ?>hr</h4>
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
        
      </div>
    </div>
  </div>

  <?php include('./includes/footer.php'); ?>

  <!--  Scripts-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js">  </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
</body>

</html>