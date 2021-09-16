<?php
session_start();
include('./db/db.php');
include('./functions/functions.php');
if (!isset($_SESSION['userId'])) {
  echo "<script> window.open('login.php','_self')</script>";
}

require_once ('stripe.php');
if(isset($_POST['stripeToken'])){
    \Stripe\Stripe::setVerifySslCerts(false);

    $token=$_POST['stripeToken'];

    $data=\Stripe\Charge::create(array(
      "amount"=>$_SESSION['total_price']*100,
      "currency"=>"cad",
      "description"=>"Catering Bookings",
      "source"=>$token,
    ));

    $chargeJson = $data->jsonSerialize();

    if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){

        $transactionID = $chargeJson['balance_transaction'];
        $paidAmount = $chargeJson['amount'];
        $paidCurrency = $chargeJson['currency'];
        $payment_status = $chargeJson['status'];
        $payment_date = date("Y-m-d H:i:s");
        $dt_tm = date('Y-m-d H:i:s');


        if($payment_status == 'succeeded'){
            $ordStatus = 'success';

         $fromDate=$_SESSION['fromDate'];
         $toDate= $_SESSION['toDate'];
         $address= $_SESSION['address'];
         $userId= $_SESSION['userId'];
         $eventId= $_SESSION['eventId'];
         $total_price= $_SESSION['total_price'];
         $num_dishes = $_SESSION['num_dishes'];

        
         $bookcatering = "insert into catering_bookings (cid,caterings_id,from_date,to_date,address,total_price,num_dishes,`payment_status`) 
         values ('$userId','$eventId','$fromDate','$toDate','$address','$total_price','$num_dishes','Completed')";
        $runEvents = mysqli_query($conn, $bookcatering);
        if ($runEvents) {
          showErrorSuccessModel(1, 'Catering Booked. We will contact you soon.');
          echo "<script>window.location.href='caterings.php'</script>";
        }

    }

  }
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
      if (isset($_GET['cateringId'])) {
        $id = $_GET['cateringId'];
        $getEvent = "select * from caterings where id='$id'";
        $runEvent = mysqli_query($conn, $getEvent);
        $rowEvent = mysqli_fetch_array($runEvent);
        $name = $rowEvent['item_name'];
        $price=$rowEvent['price'];
        $hours=1;
      }
      ?> 
      <form action="catering_payment.php" method="post" enctype="multipart/form-data">
        <h4>Book <span class="green-text"><?php echo $name; ?></span> Catering- Price C$<?php echo strval($price) ; ?></h4>
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
                  <input type="date" name="fromDate" id="fromDate" required ="required">
                  <label for="fromDate">Date</label>
                </div>
                <div class="input-field col s6" id="toDateDiv" style="display: none;">
                  <input type="date" name="toDate" id="toDate" onchange="price()">
                  <label for="toDate">To Date</label>
                </div>
              </div>
            </div>
          </div>
          <div class="input-field col s12">
           <textarea name="address" name="address" id="address" class="materialize-textarea" data-length="120"> </textarea>
            <label for="address">Customer Address & Requirements</label> 
          </div>
          <div class="input-field col s12">
            <input type="number"  value="1" onkeyup="price()" name="num_dishes" id="num_dishes" min="1" max="1000">            
            <label for="address">Number of Dishes</label>
          </div>
          <div class="input-field col s12">
            <input type="text" readonly="readonly"  value="<?php echo $price; ?>" name="price1" id="price1" data-length="120">
            <label for="address">Total Price C$</label>
          </div>
          <input type="hidden" name="price_org" id="price_org" value="<?php echo $price;  ?>">
          <input type="hidden" name="caterings_id" id="caterings_id" value="<?php echo $id;  ?>">
          <div class="input-field col s12">
            <input type="hidden"  value="<?php echo $hours; ?>" name="duration1" id="duration1" data-length="120">
            
          </div>
          <div class="input-field col s12">
            <button type="submit" name="bookevent" class="waves-effect waves-light btn light-blue">Book Catering</button>
          </div>
        </div>
      </form>
    </div>
  </div>

<script type="text/javascript">
  function price(){
    var from_date=new Date(document.getElementById("fromDate").value);
    var to_date=document.getElementById("toDate").value;
    if (to_date==''){
      to_date=from_date;
    }else{
      var to_date=new Date(document.getElementById("to_date").value);
    }
    var duration= document.getElementById("duration1").value;
    var pricee=document.getElementById("price_org").value;
    const num_dishes=document.getElementById("num_dishes").value;
    var diffTime = to_date.getTime()-from_date.getTime();
    var diffdays=diffTime/(1000 * 3600 * 24);
    if((diffdays*24)>duration){
      var hours_for_billing=(diffdays*24);
      var bill_per_hour=pricee/duration;
      var total_bill=hours_for_billing*bill_per_hour;
    }else{
      var total_bill=pricee;
    }
    document.getElementById("price1").value=total_bill*num_dishes;
  }
</script>

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
    $eventId = $_GET['cateringId'];
    $num_dishes = $_POST['num_dishes'];
    $total_price=$_POST['price1'];
    if (empty($fromDate) || empty($address)) {
      showErrorSuccessModel(0, 'All Fields are mendatory.');
    } else {

      $bookEvent = "insert into catering_bookings (cid,caterings_id,from_date,to_date,address,total_price,num_dishes) 
                      values ('$userId','$eventId','$fromDate','$toDate','$address','$total_price','$num_dishes')";
      $runEvents = mysqli_query($conn, $bookEvent);

      if ($runEvents) {
        showErrorSuccessModel(1, 'Catering Booked. We will contact you soon.');
      } else {
        showErrorSuccessModel(0, '');
      }
    }
  }
  ?>

</body>

</html>