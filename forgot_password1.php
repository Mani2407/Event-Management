<?php
include('./db/db.php');
session_start();
$email=$_SESSION['user'];
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
                <input id="phone" name="email" value="<?php echo $email;  ?>" readonly type="text" class="validate">
                <label for="phone">Enter Email to identify your account</label>
              </div>
              <div class="input-field col s12">
                <input id="phone" name="pwd"  type="text" class="validate">
                <label for="phone">Enter Password</label>
              </div>
              <div class="input-field col s12">
                <input id="phone" name="cnfrmpwd"  type="text" class="validate">
                <label for="phone">Enter Confirm Password</label>
              </div>
              <div class="input-field col s12">
                <button type="submit" name="login" class="waves-effect waves-light btn light-blue">Update</button>
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
  $pwd=mysqli_real_escape_string($conn,$_POST['pwd']);
  $cnfrmpwd=mysqli_real_escape_string($conn,$_POST['cnfrmpwd']);

  if($pwd==$cnfrmpwd){
    $sql_update="Update users set `password`='$pwd' where emailid='$email'";

    $sql_run=mysqli_query($conn,$sql_update);
    echo "<script>alert('Password Updated')</script>";
    echo "<script>window.open('./login.php','_self')</script>";
  }else{
    echo "<script>alert('Password Not Updated')</script>";
    echo "<script>window.open('./login.php','_self')</script>";
  }
}

?>