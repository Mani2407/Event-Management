<?php
include('./db/db.php');
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
      <form action="#" method="post">
      <div class="row">
        <div class="col m3">
        </div>
        <div class="col m6">
          <div class="card" style="padding: 10px 48px;">
            <h4>Forgot Password</h4>
            <div class="row">
              <div class="input-field col s12">
                <input id="phone" required="required" name="email" type="text" class="validate">
                <label for="phone">Enter Email to identify your account</label>
              </div>
              <div class="input-field col s12">
                <button type="submit" name="login" class="waves-effect waves-light btn light-blue">Validate</button>
                <a class="waves-effect waves-light btn green accent-4" href="login.php">Login Page</a>
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
  <br><br><br><br>
  <?php include('./includes/footer.php'); ?>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

</body>

</html>

<?php
if (isset($_POST['login'])) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $selectUser  = "select * from users where emailid='$email'";
  $runUser = mysqli_query($conn, $selectUser);
  $checkUser = mysqli_num_rows($runUser);
  
  $rowUser =  mysqli_fetch_array($runUser);
  $userId = $rowUser['id'];
  $userPhone = $rowUser['emailid'];

  
  if ($checkUser == 0) {
    echo "<script>alert('Email Address not Found... ')</script>";
    exit();
  }
  
  if ($checkUser == 1) {
    $_SESSION['userId'] = $userId;
    $_SESSION['user'] = $userPhone;
    echo "<script>window.open('./forgot_password1.php','_self')</script>";
  }
}

?>