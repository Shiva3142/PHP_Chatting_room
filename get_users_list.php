<?php
session_start();
include './database_connection.php';
if (isset($_SESSION['user_name']) and isset($_SESSION['room_name'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sql1 = "SELECT * FROM rooms Where room_name='" . $_SESSION['room_name'] . "';";
        $result = mysqli_query($connection, $sql1);
        $row_count = mysqli_num_rows($result);
        // echo $row_count;
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $sql = "SELECT * FROM users WHERE room_name='" . $_SESSION['room_name'] . "';";
                $data = mysqli_query($connection, $sql);
                $result_html = "";
                while ($row = mysqli_fetch_assoc($data)) {
                    $result_html=$result_html.'
                    <div class="userdetails">
                    <h4>
                    '.$row['user_name'].'
                    </h4>';
                    if (isset($_SESSION['is_owner'])) {
                        $result_html=$result_html.'
                        <p>
                        IP: '.$row['ip_address'].'
                        </p>';
                    }
                    $result_html=$result_html.'
                    <p>
                    joined at : '.$row['joined_time'].'
                    </p>
                </div>';
                }
                // $array=var_dump(json_decode($requestdata));
                // echo json_encode($message);
                echo json_encode(['result_html' => $result_html,'status' => true]);
            } else {
                echo json_encode(['status' => false]);
            }
        }
    } else {
        echo "not get";
    }
} else {
    header('error.html');
}
?>