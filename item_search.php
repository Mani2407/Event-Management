<?php
include('./db/db.php');
$item_search=$_POST['item_search'];
                $getEvents = "select * from events where name like '%$item_search%'";
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
            </div>";
    }
?>