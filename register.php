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
              <h4>Register</h4>
              <div class="row">
                <div class="input-field col s12">
                  <input id="name" name="name" type="text" class="validate">
                  <label for="name">Full Name</label>
                </div>
                <div class="input-field col s12">
                  <input id="phone" name="phone" type="text" class="validate">
                  <label for="phone">Phone Number</label>
                </div>
                <!-- <div class="input-field col s12">
                <input id="email" type="email" class="validate">
                <label for="email">Email ID</label>
              </div> -->
                <div class="input-field col s12">
                  <input id="address" name="address" type="text" class="validate">
                  <label for="address">Address</label>
                </div>
                <div class="input-field col s12">
                  <input id="password" name="password" type="password" class="validate">
                  <label for="password">Password</label>
                </div>
                <div class="input-field col s12">
                  <button type="submit" name="register" class="waves-effect waves-light btn light-blue">Register</button>
                  <a class="waves-effect waves-light btn green accent-4" href="login.php">Already Registerd? Login</a>
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
  <br><br><br>
  <?php include('./includes/footer.php'); ?>
  <?php include('./includes/footerScripts.php'); ?>
</body>

</html>

<?php
if (isset($_POST['register'])) {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $address = $_POST['address'];
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($name) || empty($address) || empty($phone) || empty($password)) {
      echo "
					<script>
						if ( window.history.replaceState ) {
								window.history.replaceState( null, null, window.location.href );
						}
					</script>";
          showErrorSuccessModel(0, 'All Fields are mendatory.');
    } else {
        if(strlen($phone) != 10){
          showErrorSuccessModel(0, 'Please enter 10 digit of phone number');
        } else {
          $getUsers = "select * from users where phone='$phone'";
          $runUsers = mysqli_query($conn, $getUsers);
          $res = mysqli_num_rows($runUsers);
  
          if ($res >= 1) {
            echo "
                <script>
                  if ( window.history.replaceState ) {
                      window.history.replaceState( null, null, window.location.href );
                  }
                </script>";
            showErrorSuccessModel(0, 'Phone No. already exist.');
          } else {
  
            $insertUser = "insert into users (name,phone,address,password) 
                              values ('$name','$phone','$address','$password')";
            $run_user = mysqli_query($conn, $insertUser);
            if ($run_user) {
              echo "
                  <script>
                    if ( window.history.replaceState ) {
                        window.history.replaceState( null, null, window.location.href );
                    }
                  </script>";
            showErrorSuccessModel(1, 'Registered Successfully.', 'Login', './login.php');
            }
          }
        }
    }
}
?>