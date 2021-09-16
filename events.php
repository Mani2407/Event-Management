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
<style>
    body{
        height:80%; 
        background-image : url('images/decor.jpg');
        height:80%;
        background-position: center;
        background-repeat: no-repeart;
        background-size:cover;
    }
    #search_item1{
      border-color:white;
      color:black;
      background-color:white;
      border-radius:10px;
    }
    #search_item1::placeholder{
      color:black;
      font-size:18px;
      text-align:center;

    }

    .card-image{
      height:300px;
    }
    </style>
<script type="text/javascript">
  function search_item(){

        var item_search =$("#search_item1").val();
        $.ajax({
          type:"POST",
          url:"item_search.php",
          data:{item_search:item_search},
          success:function(ex){
              $("#products").hide();
              $("#products_search").html(ex)

          }
        });
  }
</script>
<body>
  <?php include('./includes/nav.php'); ?>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      
      <input type="text" name="search" id="search_item1" class="form-control" placeholder="Search Event" onkeyup="search_item()">
      <div class="row" >
        <div id="products_search">
          <div id="products">
    
      <?php
          $getEvents = "select * from events";
          $runEvents = mysqli_query($conn, $getEvents);
          while ($rowEvents = mysqli_fetch_array($runEvents)) {
            $eId = $rowEvents['id'];
            $name = $rowEvents['name'];
            $image = $rowEvents['image'];
            $img = explode(',', $image)[1];

            echo "
            <div class='col m4'>
              <div class='card hoverable'>
                <div class='card-image waves-effect waves-block waves-light'>
                  <img class='activator' src='./eventsimages/$img' style='min-height: 307px;'>
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
    </div>
  </div>

  <?php include('./includes/footer.php'); ?>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

</body>

</html>