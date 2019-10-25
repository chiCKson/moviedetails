<?php
session_start();

function authentication($conn, $username, $password) {
    $query = "select username, password from login where username = '$username' and password = '$password'";
    $result = mysqli_query($conn,$query);

    if($result) {
        $result_count = mysqli_num_rows($result);
        if($result_count == 1) {
            $_SESSION['loginuser'] = $username;
            $message = "login success";

            //redirect
            header('location:index.php');
        }else{
            $message = "Login failed. Please check your username and password";
        }
    }else{
        $message = "Login failed. Please check your username and password";
    }
    return $message;
}
?>