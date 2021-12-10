<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include './database_connection.php';
    // try {
    $room_name = trim($_POST['room']);
    $chat_user_name = trim($_POST['name']);
    $chat_password = trim($_POST['share_password']);
    $owner_password = trim($_POST['owner_password']);
    if ($chat_password == $owner_password) {
        $_SESSION['creating_error'] = True;
        $_SESSION['creating_message'] = "Please choose different passwords for sharing and owning the chatroom";
        header('location:home.php');
    } else {


        $sql = "SELECT * FROM rooms Where room_name='" . $room_name . "';";
        $result = mysqli_query($connection, $sql);
        $row_count = mysqli_num_rows($result);
        echo $row_count;
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $_SESSION['creating_error'] = True;
                $_SESSION['creating_message'] = "Given named chatroom is already exists";
                header('location:home.php');
            } else {
                $sql = "INSERT INTO rooms (room_name,created_by,authentication_password,owner_password) VALUES('" . $room_name . "','" . $chat_user_name . "','" . $chat_password . "','" . $owner_password . "')";
                $_SESSION['user_name'] = $chat_user_name;
                $_SESSION['room_name'] = $room_name;
                $_SESSION['is_owner'] = true;
                mysqli_query($connection, $sql);
                $sql1 = "INSERT INTO users (room_name,user_name,ip_address) VALUES('" . $room_name . "','" . $chat_user_name . " (--owner--)','" . $_SERVER['REMOTE_ADDR'] . "')";
                mysqli_query($connection, $sql1);
                echo "true";
                header("location:room.php?room_name=" . $room_name);
            }
        } else {
            $_SESSION['creating_error'] = True;
            $_SESSION['creating_message'] = "Error Occured at creating chatroom".mysqli_error($connection);
            header('location:home.php');
        }
        mysqli_close($connection);

        // } catch (Exception $e) {
        //     echo $e  ; 
        // }
    }
} else {
    header('location:error.html');
}
?>