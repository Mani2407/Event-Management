<nav class="light-blue lighten-1" role="navigation">
  <div class="nav-wrapper container">
    <a id="logo-container" href="#" class="brand-logo">Event Management</a>
    <ul class="right hide-on-med-and-down">
      <!-- <li><a href="index.html">Home</a></li> -->
      <?php

          if (isset($_SESSION['admin'])) {
            echo "
              <li><a href='../logout.php'>Logout</a></li>
            ";
          } else {
            echo "
              <li><a href='../login.php'>User Login</a></li>
              <li><a href='../index.php'>Home</a></li>
            ";
          }
        ?>
      <!-- <li><a href="login.html">Login</a></li> -->
    </ul>

    <ul id="nav-mobile" class="sidenav">
      <li><a href="#">Navbar Link</a></li>
    </ul>
    <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
  </div>
</nav>