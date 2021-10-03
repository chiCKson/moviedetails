<?php

define('SERVER','localhost:3306');
define('USER','user');
define('PASSWORD','123');
define('DB','moviedb');

function connect() {
    $conn = mysqli_connect(SERVER,USER,PASSWORD,DB);
    if (!$conn) {
        die("Connection Failed".mysqli_connect_error());
    }
    return $conn;
}
function disconnect($conn) {
    mysqli_close($conn);
}

function get_data($sql) {
    $conn = connect();
    $result = mysqli_query($conn,$sql); 
    return $result;
    mysqli_free_result($result);
    disconnect($conn);
}
function set_data($sql) {
    	$conn = connect();
	if (mysqli_query($conn, $sql)) {
		return true;
	} else {
        	echo "<div class='alert alert-danger'>Error Please try again.".mysqli_error($conn)."</div>";
        	return false;
    	}
    disconnect($conn);
}
?>
