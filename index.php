<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('./includes/head.php');
  include('./functions/functions.php');
session_start(); ?>
</head>
<body>
  <?php include('./includes/nav.php'); ?>
  <div style="background-image: linear-gradient(rgba(0,0,0,.7), rgba(0,0,0,.7)), url(images/index.jpg); background-repeat: no-repeat; background-size: cover;">
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
       <div>
      <img src="images/logo.png" style="height: 90px; width: 100px;  margin-left: 400px;">
    </div>
      <h1 class="header center orange-text">Event Management</h1>
      <div class="row center">
        <h5 class="header col s12 light white-text">Best event management company in the world.</h5>
      </div>
      <div class="row center">
        <a href="./events.php" id="download-button" class="btn-large waves-effect waves-light orange">Show Events</a>
      </div>
      <br><br>

    </div>
  </div>


  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">flash_on</i></h2>
            <h5 class="center white-text">Speed In Work</h5>

            <p class="light white-text" style="text-align: justify;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Explicabo doloremque sunt illo iusto, aliquam, magnam aut minima minus quas veniam nobis ipsam voluptatem fuga officiis. Atque voluptatem cum vitae. Voluptas.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">group</i></h2>
            <h5 class="center white-text">Good Communication</h5>

            <p class="light white-text" style="text-align: justify;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem vel aperiam sequi soluta saepe praesentium iste molestias, laboriosam beatae delectus nobis reiciendis tempore deleniti quibusdam corporis modi voluptas numquam perspiciatis.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">settings</i></h2>
            <h5 class="center white-text">Best Panning</h5>

            <p class="light white-text" style="text-align: justify;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti hic voluptatibus reiciendis cum? Porro, officia libero. Quia eos quod similique porro, laborum voluptate dicta illo voluptates culpa nisi facere rerum.</p>
          </div>
        </div>
      </div>

    </div>
    <br><br>
  </div>
  </div>  

  <?php include('./includes/footer.php'); ?>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
