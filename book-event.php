<?php
session_start();
include('./db/db.php');
include('./functions/functions.php');
if (!isset($_SESSION['user'])) {
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
      <?php
      if (isset($_GET['eventid'])) {
        $id = $_GET['eventid'];
        $getEvent = "select * from events where id='$id'";
        $runEvent = mysqli_query($conn, $getEvent);
        $rowEvent = mysqli_fetch_array($runEvent);
        $name = $rowEvent['name'];
      }
      ?>
      <form action="#" method="post" enctype="multipart/form-data">
        <h4>Book <span class="green-text"><?php echo $name; ?></span> Event</h4>
        <div class="input-field col s6">
          <div class="switch">
            <label>
              More than one day
              <input type="checkbox" id="switch">
              <span class="lever"></span>
            </label>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <div class="row" id="dates">
                <div class="input-field col s12" id="fromDateDiv">
                  <input type="date" name="fromDate" id="fromDate">
                  <label for="fromDate">Date</label>
                </div>
                <div class="input-field col s6" id="toDateDiv" style="display: none;">
                  <input type="date" name="toDate" id="toDate">
                  <label for="toDate">To Date</label>
                </div>
              </div>
            </div>
          </div>
          <div class="input-field col s12">
            <textarea name="address" name="address" id="address" class="materialize-textarea" data-length="120"></textarea>
            <label for="address">Address</label>
          </div>
          <div class="input-field col s12">
            <button type="submit" name="bookevent" class="waves-effect waves-light btn light-blue">Book Event</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <?php include('./includes/footerScripts.php'); ?>
  <script>
    $(document).ready(function() {
      $('.modal').modal();
    });
    $(document).ready(function() {
      $('.datepicker').datepicker();
    })

    let daySwitch = document.querySelector('#switch');
    daySwitch.addEventListener('change', (e) => {
      console.log(e.target.checked);
      let dates = document.querySelector('#dates');
      let fromDateDiv = document.querySelector('#fromDateDiv');
      if (e.target.checked) {
        fromDateDiv.classList.remove('s12');
        fromDateDiv.classList.add('s6');
        toDateDiv.style.display = 'block';
      } else {
        fromDateDiv.classList.remove('s6');
        fromDateDiv.classList.add('s12');
        let toDateDiv = document.querySelector('#toDateDiv');
        toDateDiv.style.display = 'none';
      }
    })
  </script>

  <?php
  if (isset($_POST['bookevent'])) {
    $fromDate = mysqli_real_escape_string($conn, $_POST['fromDate']);
    $toDate = mysqli_real_escape_string($conn, $_POST['toDate']) ? mysqli_real_escape_string($conn, $_POST['toDate']) : '';
    $address = $_POST['address'];
    $userId = $_SESSION['userId'];
    $eventId = $_GET['eventid'];

    if (empty($fromDate) || empty($address)) {
      showErrorSuccessModel(0, 'All Fields are mendatory.');
    } else {

      $bookEvent = "insert into bookings (userId,event,fromDate,toDate,address) 
                      values ('$userId','$eventId','$fromDate','$toDate','$address')";
      $runEvents = mysqli_query($conn, $bookEvent);
      if ($runEvents) {
        showErrorSuccessModel(1, 'Event Booked. We will contact you soon.');
      } else {
        showErrorSuccessModel(0, '');
      }
    }
  }
  ?>

</body>

</html>