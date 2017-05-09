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
    <body>
        <div class="messages">
            <h2>Change password</h2>
            <form action="createaccount.php" method='POST' enctype="multipart/form-data">
                <table class="center">
                    <tr><td>Username: <input type="text" name="username"></td>
                    <tr><td>Old Password: <input type="opassword" name="password"></td>
                    <tr><td>New Password: <input type="npassword" name="password"></td>
                </table>
                <input type="submit" class="button" name="create" value="Add account">
            </form>
        </div>
        <!-- Psuedocode:
        Step 0: Check the loggin status. If not logged in, don't show up the form, and display message of "you need to log in to use this functionality". 

        Step 1: If logged in, get the login username $current_user = $_SESSION['logged_user_by_sql']. Display the form that allow users to enter old password, new password, and another textbox to double check the new password. The form will also include javascript to show interactive message.

        Step 2: check if the submit button is clicked. If so, get two values entered and validate them. Check: if all inputs are text, if old password matches the password on account, and also if two new passwords entered match. 

        Step 3: hash the new password by password_hash(input, PASSWORD_DEFAULT)
            
        Step 4: execute UPDATE login SET ‘hashed_password’ = $hashed_new_password WHERE username = $current_user

        Step 5: display success message, or otherwise display error message.
        -->           
    </body>
</html>