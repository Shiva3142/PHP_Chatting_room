<?php
session_start();
include './database_connection.php';
?>
<?php
$room_name = $_GET['room_name'];
if (isset($_SESSION['user_name']) and isset($_SESSION['room_name'])) {
    if ($room_name == $_SESSION['room_name']) {
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>chatting room - ';
        echo $room_name;
        echo '</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/room.css">
    <link rel="stylesheet" href="/SK_PHP_PROJECTS/PHP_Chatting_room/css/style.css">
    <link rel="stylesheet" href="/SK_PHP_PROJECTS/PHP_Chatting_room/css/room.css">
        <script defer src="./js/room.js"></script>
        <style>
            
        </style>
        </head>
        
        <body>
            <header id="main">
                <h1><a href="/SK_PHP_PROJECTS/PHP_Chatting_room/">GupShap Chat-room</a></h1>';
                if (isset($_SESSION['is_owner'])) {
                    if ($_SESSION['is_owner'] == true) {
                        echo '<button onclick="delete_chatroom()">DELELE CHATROOM</button>';
                    }
                } else {
                    echo '<button onclick="left_the_chat()">LEFT CHATROOM</button>';
                }
            echo '</header>

            <div class="chatcontainer">
                <div class="userslistcontainer">
                    <h2><i class="fas fa-users"></i> Users List <span style="margin-left: auto;float:right" onclick="hideuserlist()">
                        <i class="fas fa-times"></i>
                    </span></h2>
                    <hr>
                    <div id="userlists"></div>
            
                </div>
                <div class="chatroomcontainer">
                    <div id="userslisttoggle">
                        <i class="fas fa-align-justify" onclick="showuserlist()"></i>
                        <h1> chatting room - ';
                            echo $room_name;
                            echo '
                        </h1>
                    </div>
                    <div class="message_container"></div>
                    <div class="messagesendercontainer">
                        <form onsubmit="sendMessage(event)" >
                            <input type="text" name="message" id="message" placeholder="Enter Your Message" >
                            <button type="submit"><i class="fas fa-paper-plane"></i></button>
                        </form>
                    </div>
            </div>
            </div>
            <footer>
            <div><strong>Desclaimer</strong> : This website is created for project purpose, main purpose is to create an chatroom system for
                users, Please support developer if any mistake in conaint of the website i.e contact to developer or plese
                try to ignore it</div>
            ALL RIGHT ARE RESERVED
            <div class="author">Created by: Shivkumar Chauhan</div>
        </footer>
        </body>
        
        </html>';
    } else {
        $sql = "SELECT * FROM rooms Where room_name='" . $room_name . "';";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                echo '
                <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>chatting room - ';
            echo $room_name;
            echo '</title>
            <link rel="stylesheet" href="css/style.css">
            <link rel="stylesheet" href="css/home.css">
            <link rel="stylesheet" href="/SK_PHP_PROJECTS/PHP_Chatting_room/css/style.css">
            <link rel="stylesheet" href="/SK_PHP_PROJECTS/PHP_Chatting_room/css/home.css">
            <style>
                footer{
                    bottom: 0;
                    position: absolute;
                    width: 100%;
                }
            </style>
        </head>
        <body>';
        if(isset($_SESSION['invalid_credentials'])){
            if ($_SESSION['invalid_credentials']==True) {
                echo '
                <div class="alert">
                <span>Invalid credentials</span>
                <span onclick="hidenotification()"><i class="fas fa-times"></i></span>
                </div>
                ';
            }
            unset($_SESSION['invalid_credentials']);
        }
        echo '
            <header>
                <h1><a href="/SK_PHP_PROJECTS/PHP_Chatting_room/">GupShap Chat-room</a></h1>
            </header>
            <form action="authenticate.php" method="post">
            <h3>Welcome to</h3>
            <h1> chatting room - ';
                echo $room_name;
                echo '</h1>
                <input type="hidden" name="room_name" value="';
            echo $room_name;
            echo '">
            <input type="text" name="user_name" id="user_name" placeholder="Enter User Name" required>
            <input type="password" name="password" id="password" placeholder="Enter Authentication Password" required>
            <button type="submit">Submit</button>
        </form>
        </body>
        <footer>
        <div><strong>Desclaimer</strong> : This website is created for project purpose, main purpose is to create an chatroom system for
            users, Please support developer if any mistake in conaint of the website i.e contact to developer or plese
            try to ignore it</div>
        ALL RIGHT ARE RESERVED
        <div class="author">Created by: Shivkumar Chauhan</div>
    </footer>
        <script>
            function hidenotification() {
                document.getElementsByClassName("alert")[0].style.display = "none"
            }
        </script>
        </html>
                ';
            } else {
                header('location:error.html');
            }
        }else{
            header('location:error.html');
        }
    }
} else {
    $sql = "SELECT * FROM rooms Where room_name='" . $room_name . "';";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            echo '
            <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>chatting room - ';
            echo $room_name;
            echo '</title>
            <link rel="stylesheet" href="css/style.css">
            <link rel="stylesheet" href="css/home.css">
            <link rel="stylesheet" href="/SK_PHP_PROJECTS/PHP_Chatting_room/css/style.css">
            <link rel="stylesheet" href="/SK_PHP_PROJECTS/PHP_Chatting_room/css/home.css">
            <style>
                footer{
                    bottom: 0;
                    position: absolute;
                    width: 100%;
                }
            </style>
        </head>
        <body>';
        if(isset($_SESSION['invalid_credentials'])){
            if ($_SESSION['invalid_credentials']==True) {
                echo '
                <div class="alert">
                <span>Invalid credentials</span>
                <span onclick="hidenotification()"><i class="fas fa-times"></i></span>
                </div>
                ';
            }
            unset($_SESSION['invalid_credentials']);
        }
        echo '
            <header>
                <h1><a href="/SK_PHP_PROJECTS/PHP_Chatting_room/">GupShap Chat-room</a></h1>
            </header>
            <form action="authenticate.php" method="post">
            <h3>Welcome to</h3>
            <h2> chatting room - ';
                echo $room_name;
                echo '</h2>
            <input type="hidden" name="room_name" value="';
            echo $room_name;
            echo '">
            <input type="text" name="user_name" id="user_name" placeholder="Enter User Name" required>
            <input type="password" name="password" id="password" placeholder="Enter Authentication Password" required>
            <button type="submit">Submit</button>
        </form>
        </body>
        <footer>
        <div><strong>Desclaimer</strong> : This website is created for project purpose, main purpose is to create an chatroom system for
            users, Please support developer if any mistake in conaint of the website i.e contact to developer or plese
            try to ignore it</div>
        ALL RIGHT ARE RESERVED
        <div class="author">Created by: Shivkumar Chauhan</div>
    </footer>
        <script>
            function hidenotification() {
                document.getElementsByClassName("alert")[0].style.display = "none"
            }
        </script>
        </html>
            ';
        } else {
            header('location:error.html');
        }
    }else{
        header('location:error.html');
    }
}
?>

<?php
mysqli_close($connection);
?>