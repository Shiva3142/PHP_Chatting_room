<?php
session_start();
include './database_connection.php';
if (isset($_SESSION['user_name']) and isset($_SESSION['room_name'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sql1="DELETE FROM rooms WHERE room_name='".$_SESSION['room_name']."';";
        $sql2="DELETE FROM messages WHERE room_name='".$_SESSION['room_name']."';";
        $sql3="DELETE FROM users WHERE room_name='".$_SESSION['room_name']."';";
        mysqli_query($connection,$sql1);
        mysqli_query($connection,$sql2);
        mysqli_query($connection,$sql3);
        session_unset();
        session_destroy();
        header("location:deleted.html");
    } else {
    header('error.html');
    }
} else {
    header('error.html');
}
?>