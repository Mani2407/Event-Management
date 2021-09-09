<?php
include('./db/db.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('includes/head.php'); ?>
</head>

<body>
  <?php include('./includes/admin-nav.php'); ?>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <form action="#" method="post">
        <div class="row">
          <div class="col m3">
          </div>
          <div class="col m6">
            <div class="card" style="padding: 10px 48px;">
              <h4>Admin Login</h4>
              <div class="row">
                <div class="input-field col s12">
                  <input id="email" name="email" type="email" class="validate" required>
                  <label for="email">Email ID</label>
                </div>
                <div class="input-field col s12">
                  <input id="password" name="password" type="password" class="validate" required>
                  <label for="password">Password</label>
                </div>
                <div class="input-field col s12">
                  <button type="submit" class="waves-effect waves-light btn light-blue" name="login">Login</button>
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


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <!-- <script src="js/init.js"></script>
  <script>
    fetch('../api/db/db.php')
    .then(async data => {
      let d = await data.body.getReader().read();
      console.log({data: new TextDecoder().decode(d.value)})
    })
  </script> -->
</body>

</html>

<?php
if (isset($_POST['login'])) {
  $emailId = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $selectUser  = "select * from admin where email='$emailId' AND password='$password'";
  $runUser = mysqli_query($conn, $selectUser);
  $checkUser = mysqli_num_rows($runUser);
  
  $rowAdmin =  mysqli_fetch_array($runUser);
  $adminId = $rowAdmin['id'];
  $adminEmail = $rowAdmin['email'];
  
  if ($checkUser == 0) {
    echo "<script>alert('Your Email or Password is Wrong... ')</script>";
    exit();
  }
  
  if ($checkUser == 1) {
    $_SESSION['adminId'] = $adminId;
    $_SESSION['admin'] = $adminEmail;
    echo "<script>window.open('./home.php','_self')</script>";
  }
}

?>