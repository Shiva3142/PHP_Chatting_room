<?php
session_start();
session_unset();
session_destroy();
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include './database_connection.php';
    $room_name = $_POST['room_name'];
    // echo $room_name;
    $authentication_password = trim($_POST['password']);
    $chat_user_name = trim($_POST['user_name']);
    $authenticate = false;
    $sql = "SELECT * FROM rooms Where room_name='" . $room_name . "' and authentication_password ='" . $authentication_password . "'  ;";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // session_start();
            $_SESSION['user_name'] = $chat_user_name;
            $_SESSION['room_name'] = $room_name;
            $sql1 = "INSERT INTO users (room_name,user_name,ip_address) VALUES('" . $room_name . "','" . $chat_user_name . "','" . $_SERVER['REMOTE_ADDR'] . "')";
            mysqli_query($connection, $sql1);
            $authenticate = true;
        } else {
            // header("location:error.html");
            $authenticate = false;
        }
    } else {
        // header("location:error.html");
        $authenticate = false;
    }
    if ($authenticate == false) {
        $sql = "SELECT * FROM rooms Where room_name='" . $room_name . "'and created_by='".$chat_user_name."' and owner_password ='" . $authentication_password . "'  ;";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                // session_start();
                $_SESSION['user_name'] = $chat_user_name;
                $_SESSION['room_name'] = $room_name;
                $_SESSION['is_owner'] = true;
                $authenticate=true;
            } else {
                // header("location:error.html");
                $authenticate = false;
            }
        } else {
            // header("location:error.html");
            $authenticate = false;
        }
    }
    if ($authenticate == false) {
        $_SESSION['invalid_credentials'] = True;
    }
    header("location:room.php?room_name=" . $room_name);
}
?>