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
                    <tr><td>Re-enter Password: <input type="password" name="rpassword"></td>
                </table>
                <input type="submit" class="button" name="change" value="Change password">
            </form>
        </div>

        <?php
         if(isset($_POST["change"])){
             $errlist = array();
             $opassword = filter_input( INPUT_POST, 'opassword', FILTER_SANITIZE_STRING );
             if (empty($opassword)){
                 $errlist[]="Please enter the old password.<br>";
             }else{
                 $fetchinfo = "SELECT * FROM login WHERE username='$username'";
                 $result = $mysqli->query($fetchinfo);
                 if (!$result) {
                    print($mysqli->error);
                    exit();
                 }else if ($result && $result->num_rows == 1) {
                      $row = $result->fetch_assoc();
                      $hashpw = $row['hashed_password'];
                      if (!password_verify($opassword, $hashpw)){
                          $errlist[]="Incorrect old password.<br>";
                      }
                 }else{
                      $errlist[]="Something wrong with your login status.<br>";
                 }
             }
             
             $npassword = filter_input( INPUT_POST, 'npassword', FILTER_SANITIZE_STRING );
             if (empty($npassword)){
                 $errlist[]="Please enter the new password.<br>";
             }else if ($opassword == $npassword){
                 $errlist[]= "Password change failed: old password and new password are the same. <br>";
             }
             
             $rpassword = filter_input( INPUT_POST, 'rpassword', FILTER_SANITIZE_STRING );
             if (empty($rpassword)){
                 $errlist[]="Please re-enter the new password.<br>";
             }else if ($rpassword != $npassword){
                 $errlist[]="Two passwords do not match.<br>";
             }
             
             if (count($errlist)!=0){
                 echo "<p class='error'>Submission unsuccessful. The following errors occur:<br>";
                 foreach ($errlist as $error){
                     echo "$error";
                 }
                 echo "</p>";
             }else {
                 $hashed_new_password = password_hash($npassword, PASSWORD_DEFAULT);
                 $updatePW = "UPDATE login SET hashed_password = '$hashed_new_password' WHERE username = '$username'";
                 $update = $mysqli->query($updatePW);
                 if (!$update) {
                     print($mysqli->error);
                     exit();
                 }
                 echo "<p>Password reset successful. Please <a href='logout.php'>logout</a> to log in again.";
             }
         }
        ?>        
    </body>
</html>