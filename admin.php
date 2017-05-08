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

        <title>Administration | Cornell Media and Entertainment</title>
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
            
    <body>
        <div class="text">

            <h3>Welcome!</h3>
            <h3>You can now use the following functionalities.</h3>
            <h4><a href="uploadphoto.php">Upload Photos</a> | <a href="addalbum.php">Add Album</a> | <a href="addevent.php">Add Event</a> | <a href="addmember.php">Add Member</a> | <a href="editmember.php">Edit Member</a> | <a href="changepassword.php">Change Password</a> | <a href="createaccount.php"> Create Account</a></h4>

            <h4><a href="logout.php">Logout</a></h4>
        </div>

    </body>
</html>