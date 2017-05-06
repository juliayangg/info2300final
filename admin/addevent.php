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

        <title>Add Event | Cornell Media and Entertainment</title>
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
            <h2>Add a New Event</h2>
            <form action="addevent.php" method='POST'>
                <p>
                    Name: <input type="text" name="ayear" style="font-size:12pt;" placeholder="Event Name"><br><br>
                    History: <input type="text" name="alist" style="font-size:12pt;" placeholder="History of Event"><br><br>
                    Description: <input type="text" name="alist" style="font-size:12pt;" placeholder="Event Description"><br><br>                    
                    <input type="submit" name="add" value="Add an Event">
                </p>
            </form>
            <!-- Psuedocode: 
            Step 0: Check the loggin status. If not logged in, don't show up the form, and display message of "you need to log in to use this functionality"

            Step 1: if isset $_POST['add'], and check all the inputs (e.g. all inputs have to be text). If not, print("please check your input and try again")
            
            Step 2: else (which means all inputs validate), insert all information into events table as entered (with event_id as default). 

            Step 3: print out success message and a href to view all albums (href=events.php?id=default). 
            -->           
        </div>
    </body>
</html>