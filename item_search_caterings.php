<?php
include('./db/db.php');
$item_search=$_POST['item_search'];
                $getEvents = "select * from caterings where item_name like '%$item_search%'";
                $runEvents = mysqli_query($conn, $getEvents);
                while ($rowEvents = mysqli_fetch_array($runEvents)) {
                    $eId = $rowEvents['id'];
                    $name = $rowEvents['item_name'];
                    $image = $rowEvents['image'];
                    $images = explode(',', $image);

    	  echo "
            <div class='col m4'>
              <div class='card hoverable'>
                <div class='card-image waves-effect waves-block waves-light'>
                  <img class='activator' src='./cateringimages/$images[0]' style='min-height: 307px;'>
                </div>
                <div class='card-content'>
                  <span class='card-title activator grey-text text-darken-4'>$name</span>
                  <p><a href='./catering-details.php?cateringId=$eId' class='orange-text'>Show Details</a></p>
                </div>
              </div>
            </div>";
    }
?>