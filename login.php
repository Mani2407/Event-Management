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
            <h4>Login</h4>
            <div class="row">
              <div class="input-field col s12">
                <input id="phone" name="phone" type="text" class="validate">
                <label for="phone">Phone Number</label>
              </div>
              <div class="input-field col s12">
                <input id="password" name="password" type="password" class="validate">
                <label for="password">Password</label>
              </div>
              <div class="input-field col s12">
                <button type="submit" name="login" class="waves-effect waves-light btn light-blue">Login</button>
                <a class="waves-effect waves-light btn green accent-4" href="register.php">New User? Register</a>
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
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $selectUser  = "select * from users where phone='$phone' AND password='$password'";
  $runUser = mysqli_query($conn, $selectUser);
  $checkUser = mysqli_num_rows($runUser);
  
  $rowUser =  mysqli_fetch_array($runUser);
  $userId = $rowUser['id'];
  $userPhone = $rowUser['phone'];
  $userName = $rowUser['name'];
  
  if ($checkUser == 0) {
    echo "<script>alert('Your Phone or Password is Wrong... ')</script>";
    exit();
  }
  
  if ($checkUser == 1) {
    $_SESSION['userId'] = $userId;
    $_SESSION['user'] = $userPhone;
    $_SESSION['name'] = $userName;
    echo "<script>window.open('./events.php','_self')</script>";
  }
}

?>