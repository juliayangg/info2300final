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
                    <tr><td>Re-enter Password: <input type="password" name="rpassword"></td>
                </table>
                <input type="submit" class="button" name="create" value="Add account">
            </form>
        </div>

        <?php
        if(isset($_POST["create"])){
            $errlist=array();
            $username = filter_input( INPUT_POST, 'username', FILTER_SANITIZE_STRING );
            if (empty($username)){
                $errlist[] = "Enter a username.<br>";
            }else if(!preg_match("/^[a-zA-Z0-9']+$/",$username)){
                $errlist[]="Username can only contain letters and numbers.<br>";  
            }else{
                foreach ($currentUsernames as $oldUser){
                    if ($oldUser == $username){
                        $errlist[]="Username already exists.<br>";
                    }
                }
            }
            
            $password = filter_input( INPUT_POST, 'password', FILTER_SANITIZE_STRING );
            if (empty($password)){
                $errlist[] = "Enter a password.<br>";
            }
            
            $rpassword = filter_input( INPUT_POST, 'rpassword', FILTER_SANITIZE_STRING );
            if (empty($rpassword)){
                $errlist[] = "Re-enter the password.<br>";
            }else if ($password != $rpassword){
                $errlist[] = "Two passwords do not match.<br>";
            }

            if (count($errlist)!=0){
                echo "<p class='error'>Submission unsuccessful. The following errors occur:<br>";
                foreach ($errlist as $error){
                    echo "$error";
                }
                echo "</p>";
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