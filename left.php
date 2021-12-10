<?php
session_start();
include './database_connection.php';
$sql3="DELETE FROM users WHERE user_name='".$_SESSION['user_name']."';";
mysqli_query($connection,$sql3);
session_unset();
session_destroy();
header('location:index.html');
?>