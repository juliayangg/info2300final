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
    <body>
        <div class="messages">
            <p>See Psuedocode comments for now.</p>
        </div>
        <!-- Psuedocode:
        Step 0: Check the loggin status. If not logged in, don't show up the form, and display message of "you need to log in to use this functionality". If logged in, display the form that allow users to enter new username and password. The form will also include javascript to show interactive message.

        Step 1: check if the submit button is clicked. If so, get two values entered and validate them. 
            
        Step 2: Check if there is duplication of username in the database. 

        Step 3: hash the password by password_hash(input, PASSWORD_DEFAULT)
            
        Step 4: execute INSERT INTO login (‘username’, ‘hashed_password’) VALUES (username, hashed_password)

        Step 5: display success message, or otherwise display error message. 
        -->           
    </body>
</html>