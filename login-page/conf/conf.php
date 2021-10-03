<?php
    define('SERVER','localhost');
    define('USER','root');
    define('PASSWORD','');
    define('DB','campus');


    /*
    create database campus;
    use campus;
    create table login(
        username varchar(10),
        password varchar(10)
    );

    insert into login values
        ('user2','abc321')
    ;
    */

    $conn = mysqli_connect(SERVER,USER,PASSWORD,DB);

    if (!$conn) {
        die("Mysql connection failed");
    }

?>