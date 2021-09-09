<?php
	session_start();
	session_destroy();
	echo "<script>window.open('http://localhost/em/admin/login.php','_self')</script>";
?>