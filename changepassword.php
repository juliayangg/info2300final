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

        <title>Chnage Password | Cornell Media and Entertainment</title>
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
    } else {
        $username = $_SESSION['logged_user_by_sql'];
    }
    ?>

     <?php
        require_once 'includes/config.php';
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($mysqli->errno) {
            print ("<h2>Error Connecting to Database</h2>");
            exit();
        }  
    ?>


    <body>
        <div class="messages">
            <h2>Change password</h2>
            <form action="changepassword.php" method='POST' enctype="multipart/form-data">
                <table class="center">
                    <tr><td>Username: <?php echo $username; ?> </td>
                    <tr><td>Old Password: <input type="password" name="opassword"></td>
                    <tr><td>New Password: <input type="password" name="npassword"></td>
                </table>
                <input type="submit" class="button" name="change" value="Change password">
            </form>
        </div>

        <?php
        $opasswordErr = $npasswordErr = "";
         if(isset($_POST["change"])){

            $opassword = filter_input( INPUT_POST, 'opassword', FILTER_SANITIZE_STRING );
            if (empty($opassword)){
                $opasswordErr = "old password";
            }

            $npassword = filter_input( INPUT_POST, 'npassword', FILTER_SANITIZE_STRING );
            if (empty($npassword)){
                $npasswordErr = "new password";
            }

            if ($opasswordErr || $npasswordErr ){
                echo "<p class='error'> Password change failed: invalid $opasswordErr $npasswordErr </p>"; 
            } 

            else { 
                $changePW = "SELECT * FROM login WHERE username='$username'";
                $result = $mysqli->query($changePW);
                if (!$result) {
                    print($mysqli->error);
                    exit();
                }
                while ($row = $result->fetch_assoc()) {
                    $name = $row['username'];
                    $hashpw = $row['hashed_password'];
                 }

                 if (password_hash($opassword, PASSWORD_DEFAULT) === $hashpw){
                    echo "<p> Password change failed: incorrect old password.</p>";
                    exit();
                 } 

                else if ($opassword == $npassword){
                    echo "<p> Password change failed: old password and new password are the same. </p>";
                    exit();
                 }

                 else {
                    $hashed_new_password = password_hash($npassword, PASSWORD_DEFAULT);
                    $updatePW = "UPDATE login SET hashed_password = '$hashed_new_password' WHERE username = '$username'";
                    print $updatePW;
                    $result = $mysqli->query($updatePW);
                    if (!$result) {
                       print($mysqli->error);
                       exit();
                    }
                    echo "<p>Password reset successful. Please <a href='logout.php'>logout</a> to log in again.";
                 }
            }
        }
        ?>        
    </body>
</html>