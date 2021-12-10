<?php
session_start();
include './database_connection.php';
if (isset($_SESSION['user_name']) and isset($_SESSION['room_name'])) {
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $requestdata=file_get_contents('php://input');
            $requestdata=json_decode($requestdata,true);
            // $requestdata=array($requestdata);
            $message=$requestdata["message"];
            // $array=var_dump(json_decode($requestdata));
            // echo json_encode($message);
            $message = str_replace("<", "&lt;", $message);
            $message = str_replace(">", "&gt;", $message);
            $message = str_replace("'", "&apos;", $message);
            $message = str_replace('"', "&quot;", $message);
            $message = str_replace("\n", "<br>", $message);
            $sql="INSERT INTO messages(room_name,message,ip_address,send_by) VALUES('".$_SESSION['room_name']."','".$message."','".$_SERVER['REMOTE_ADDR']."','".$_SESSION['user_name']."')";
            $result=mysqli_query($connection,$sql);
            echo json_encode(['data'=>$result,'user'=>$_SESSION['user_name'],'room_name'=>$_SESSION['room_name'],'ip_address'=>$_SERVER['REMOTE_ADDR']]);
        } else {
            echo "not get";
        }
    }
    else{
        header('error.html');
    }
?>