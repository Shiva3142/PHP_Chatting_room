<?php
session_start();
include './database_connection.php';
if (isset($_SESSION['user_name']) and isset($_SESSION['room_name'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $requestdata = file_get_contents('php://input');
        $requestdata = json_decode($requestdata, true);
        // $requestdata=array($requestdata);
        $status = $requestdata["message"];
        // $array=var_dump(json_decode($requestdata));
        // echo json_encode($message);
        if ($status == "join") {
            $sql = "INSERT INTO messages(room_name,message,ip_address,send_by,type) VALUES('" . $_SESSION['room_name'] . "','".$_SESSION['user_name']." joined the chatroom','" . $_SERVER['REMOTE_ADDR'] . "','" . $_SESSION['user_name'] . "','join_status')";
            $result = mysqli_query($connection, $sql);
        } elseif ($status == 'left') {
            $sql = "INSERT INTO messages(room_name,message,ip_address,send_by,type) VALUES('" . $_SESSION['room_name'] . "','".$_SESSION['user_name']." left the chatroom ','" . $_SERVER['REMOTE_ADDR'] . "','" . $_SESSION['user_name'] . "','left_status')";
            $result = mysqli_query($connection, $sql);
        } else {
            header('location:error.html');
        }
    } else {
    header('error.html');
    }
} else {
    header('error.html');
}
?>