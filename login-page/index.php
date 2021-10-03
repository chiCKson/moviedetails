<?php
//index page need authorized access
session_start();
if (isset($_SESSION['loginuser'])) {
	echo "Hi user".$_SESSION['loginuser'];
}
else{
	header('location:login.php');
}

?>