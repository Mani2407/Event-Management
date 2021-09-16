<?php
session_start();
require_once ('stripe.php');
if(isset($_POST['stripeToken'])){
    \Stripe\Stripe::setVerifySslCerts(false);

    $token=$_POST['stripeToken'];

    $data=\Stripe\Charge::create(array(
        "amount"=>1000,
        "currency"=>"cad",
        "description"=>"sample",
        "source"=>$token,
    ));

    echo "<pre>";
    echo "<h4>Payment Successful<h4>";
}
?>