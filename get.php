<?php
session_start();
include './database_connection.php';
if (isset($_SESSION['user_name']) and isset($_SESSION['room_name'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $requestdata = file_get_contents('php://input');
        $requestdata = json_decode($requestdata, true);
        // $requestdata=array($requestdata);
        $id = $requestdata["id"];

        $sql1 = "SELECT * FROM rooms Where room_name='" . $_SESSION['room_name'] . "';";
        $result = mysqli_query($connection, $sql1);
        $row_count = mysqli_num_rows($result);
        // echo $row_count;
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $sql = "SELECT * FROM messages WHERE index_no>$id and room_name='" . $_SESSION['room_name'] . "';";
                $data = mysqli_query($connection, $sql);
                $result_html = "";
                while ($row = mysqli_fetch_assoc($data)) {
                    if ($row['type'] == 'message') {
                        if ($row['send_by'] == $_SESSION['user_name']) {
                            $result_html = $result_html . '<div class="message right">
                            <h4>' . $row["send_by"] . '</h4>
                            <p>' . $row["message"] . '</p>
                            <span>' . $row["send_time"] . '</span>
                            </div>';
                        } else {
                            $result_html = $result_html . '<div class="message left">
                            <h4>' . $row["send_by"] . '</h4>
                            <p>' . $row["message"] . '</p>
                            <span>' . $row["send_time"] . '</span>
                            </div>';



                        }
                    } else {
                        $result_html = $result_html . '
                        <p style="font-size:80%;text-align:center;clear:both;width:fit-content;margin:5px auto;padding: 2px 5px;color:black;border-radius:10px;background:#b8e994;">
                    ' . $row["message"] . ' at '.$row['send_time'].' 
                </p>';


                    }


                    $id = $row['index_no'];
                }
                // $array=var_dump(json_decode($requestdata));
                // echo json_encode($message);
                echo json_encode(['result_html' => $result_html, 'id' => $id, 'status' => true]);
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