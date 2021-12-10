<?php
    $username='root';
    $password='';
    $server='localhost';
    $database='php_chatroom';
    $connection=mysqli_connect($server,$username,$password,$database);
    if ($connection) {
        // echo "connected";
    }
    else{
        echo mysqli_connect_error($connection);
    }
?>