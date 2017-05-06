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

        <title>Edit Member Info | Cornell Media and Entertainment</title>
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
        Step 0: Check the loggin status. If not logged in, don't show up the form, and display message of "you need to log in to use this functionality". 
        
        Step 1: If logged in, display two forms. One form will allow users to select the member he wish to change, and a submit button for changing status of active from TRUE to False.   

        Step 2: Another form will allow users to select the member he wish to change, and a dropdown list of positions so that the user can change the member to other positions. Textareas of year and major will also be provided.  

        Step 3: check if the submit button for changing active status is clicked. 
        
        Step 4: If so, update the active status of that member in database from TRUE to FALSE. 
            
        Step 5: check if the submit button for changing other information is clicked. 

        Step 6: Validate inputs and update information to the database
            
        Step 7: display success message, or otherwise display error message. 
        -->           
    </body>
</html>