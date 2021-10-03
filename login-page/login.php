
<?php
//login page
require_once 'conf/conf.php';
require_once 'functions/loginfun.php';
session_start();
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<?php
//call the function
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);
	//mysql_escape_string(unescaped_string)
	$msg = Authentication($conn,$username,$password);
} 
?>
    <form action="" method="POST">
        <input type="text" name="username" placeholder="username" required>
        <input type="password" name="password" placeholder="password" required>
        <input type="submit" value="Login">
        <?php
		//display error message
		if (isset($msg)) {
			echo $msg;
		}
	?>
    </form>
</body>
</html>
