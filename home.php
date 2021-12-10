<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Chatroom</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="/SK_PHP_PROJECTS/PHP_Chatting_room/css/style.css">
    <link rel="stylesheet" href="/SK_PHP_PROJECTS/PHP_Chatting_room/css/home.css">
    <style>
        .alert{
            position: absolute;
            display: flex;
            justify-content: space-between;
            background-color: aqua;
            width: 75%;
            margin-top:20px;
            align-items: center;
            color: black;
            font-size: 25px;
            padding:5px 20px;
            border-radius: 20px;
            z-index: 10;
            left: 50%;
            transform: translate(-50%,0);
        }
        @media (max-width:868px) {
            .alert{
                margin-top:10px;
                width: 98%;
                font-size: 15px;
                padding: 5px;
            }
        }
        footer{
            bottom: 0;
            position: absolute;
            width: 100%;
        }
    </style>
</head>
<body>
    <?php
    if(isset($_SESSION['creating_error'])){
        if ($_SESSION['creating_error']==True) {
            echo '
            <div class="alert">
            <span>';
            echo $_SESSION['creating_message'];
            echo '</span>
            <span onclick="hidenotification()"><i class="fas fa-times"></i></span>
            </div>
            ';
        }
        unset($_SESSION['creating_error']);
        unset($_SESSION['creating_message']);
    }
    ?>
    <header>
        <h1><a href="/SK_PHP_PROJECTS/PHP_Chatting_room/">GupShap Chat-room</a></h1>
    </header>
    <form action="./claim.php" method="post">
        <h2>Create Chatroom</h2>
        <input type="text" name="room" id="room" placeholder="Enter Room Name" required>
        <input type="text" name="name" id="name" placeholder="Enter Your Name" required>
        <input type="password" name="share_password" id="password" placeholder="set password to share" required>
        <p>you can share this password to everyone whom you are sending the chatroom link</p>
        <input type="password" name="owner_password" id="password" placeholder="set password for owner" required>
        <p>please dont share this password to anyone this is for owner access (this password must be different than the password to be shared)</p>
        <button type="submit">Submit</button>
    </form>
    <footer>
        <div><strong>Desclaimer</strong> : This website is created for project purpose, main purpose is to create an chatroom system for
            users, Please support developer if any mistake in conaint of the website i.e contact to developer or plese
            try to ignore it</div>
        ALL RIGHT ARE RESERVED
        <div class="author">Created by: Shivkumar Chauhan</div>
    </footer>
</body>
<script>
    function hidenotification(){
        document.getElementsByClassName('alert')[0].style.display='none'
    }
</script>
</html>
