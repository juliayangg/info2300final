<?php
if(!isset($_SESSION)) {
    session_start(); 
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width">

        <title>Create Account | Cornell Media and Entertainment</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <?php 
        require_once "includes/functions.php";
        //add_versioned_file( 'js/scripts.js', 'JavaScript' );
        add_versioned_file( 'css/styles.css', 'Style' );
        ?>
    </head>
    
    <?php include 'includes/nav.php';?>
    <?php
    if (!isset($_SESSION['logged_user_by_sql']) ){
            print('<p> You are not logged in.</p>');
            print('<p>Please <a href="login.php">log in</a> to to access this page.</p>');
            exit();
    }
    ?>
    <?php
        $currentUsernames = array(); 

        require_once 'includes/config.php';
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($mysqli->errno) {
            print ("<h2>Error Connecting to Database</h2>");
            exit();
        }
        $info = $mysqli->query('SELECT username FROM login');
        while ($row = $info->fetch_assoc()) {
            $name = $row['username'];
            array_push($currentUsernames, $name);
        }
        ?>

    <body>
        <div class="messages">
            <h2>Create a new account</h2>
            <form action="createaccount.php" method='POST' enctype="multipart/form-data">
                <table class="center">
                    <tr><td>Username: <input type="text" name="username"></td>

                    <tr><td>Password: <input type="password" name="password"></td>
                </table>
                <input type="submit" class="button" name="create" value="Add account">
            </form>
        </div>

        <?php
        $usernameErr = $passwordErr = "";

        if(isset($_POST["create"])){
            $username = filter_input( INPUT_POST, 'username', FILTER_SANITIZE_STRING );
            if (empty($username)){
                $usernameErr = "username";
            }
            $password = filter_input( INPUT_POST, 'password', FILTER_SANITIZE_STRING );
            if (empty($password)){
                $passwordErr = "password";
            }

            foreach ($currentUsernames as $oldUser){
                if ($oldUser == $username){
                    echo "<p class='error'> Account creation failed: username already exists </p>"; 
                    exit();
                }
            }

            if ($usernameErr || $passwordErr){
                echo "<p class='error'> Account creation failed: invalid $usernameErr $passwordErr </p>"; 
            }
            else {
                $hashpassword = password_hash($password, PASSWORD_DEFAULT);

                $insertUsername = "INSERT INTO login VALUES ('$username', '$hashpassword')";
                $result = $mysqli->query($insertUsername);
                if (!$result) {
                    print($mysqli->error);
                    exit();
                }
                echo "<p>Account creation successful. Please <a href='logout.php'>logout</a> to test your new account.";
            }   
        }

        ?>        
    </body>
</html>