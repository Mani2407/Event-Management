  <?php
include('./db/db.php');
  session_start();
?>

  <?php
  $fromDate="";
  $toDate="";
  $address="";
  $userId="";
  $eventId="";
  $total_price="";
  if (isset($_POST['bookevent'])) {
    $_SESSION['fromDate'] =  $_POST['fromDate'];
    $_SESSION['toDate']=  $_POST['toDate'];
    $_SESSION['address']= $_POST['address'];
    $_SESSION['userId'] = $_SESSION['userId'];
    $_SESSION['eventId'] = $_POST['caterings_id'];
    $_SESSION['total_price']=$_POST['price1'];
    $_SESSION['num_dishes']= $_POST['num_dishes'];
    
      
  }
  ?>

  

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('./includes/head.php'); ?>
</head>

<body>
  <?php include('./includes/nav.php'); ?>

  <!--
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <form action="#" method="post">
      <div class="row">
        <div class="col m3">
        </div>
        <div class="col m6">
          <div class="card" style="padding: 10px 48px;">
            <h4>Checkout</h4>
            <div class="row">
              <div class="input-field col s12">
                <input id="phone" name="name_card" required="required" type="text" class="validate">
                <label for="phone">Name on Card</label>
              </div>
              <div class="input-field col s12">
                <label for="password">Card Number</label>
                <input id="password" name="card_number" required="required" type="number" min="01" class="validate">
              </div>
              <div class="input-field col s12">
                <input id="password" name="month" required="required" type="number" min="01" class="validate">
                <label for="password">Month</label>
              </div>
              <div class="input-field col s12">
                <input id="password" name="year" required="required" type="number" min="01" class="validate">
                <label for="password">Year</label>
              </div>
              <div class="input-field col s12">
                <button type="submit" name="confrm_payment" class="waves-effect waves-light btn light-blue">Confirm Payment</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col m3">
        </div>
      </div>
      </form>
    </div>
  </div>
  <br><br><br><br> -->

  <?php
  require('stripe.php');
  ?>
      <form action="catering_booking.php" method="post" style="margin: 10% 0% 30% 45%">
        <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="<?php echo $publishableKey?>"
                data-amount=<?php echo $_SESSION['total_price'] * 100 ?>
                data-currency="cad"
                data-name="OnEM"
                data-description="Management"
        >
        </script>

    </form>



  <?php include('./includes/footer.php'); ?>
<?php 

/*
if(isset($_POST['confrm_payment'])){
   $fromDate=$_SESSION['fromDate'];
   $toDate= $_SESSION['toDate'];
   $address= $_SESSION['address'];
   $userId= $_SESSION['userId'];
   $eventId= $_SESSION['eventId'];
   $total_price= $_SESSION['total_price'];
  $name=$_POST['name_card'];
  $card_number=$_POST['card_number'];
  $month=$_POST['month'];
  $year=$_POST['year'];
      $bookEvent = "insert into catering_bookings (cid,caterings_id,from_date,to_date,address,total_price,num_dishes, `name_on_card`, `card_number`, `month`, `year`,`payment_status`) 
                      values ('$userId','$eventId','$fromDate','$toDate','$address','$total_price','$num_dishes','$name','$card_number','$month','$year','Completed')";
  $runEvents = mysqli_query($conn, $bookEvent);
  if ($runEvents) {
    echo "<script>alert('Booked')</script>";
    echo "<script>window.location.href='caterings.php'</script>";
  } 
}*/

?>
  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

</body>

</html>




