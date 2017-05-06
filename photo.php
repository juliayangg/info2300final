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

        <title>Photo Details | Cornell Media and Entertainment</title>
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
        <div class="sidebar">        
            <?php
            $pid = $_GET['pid'];
            
            /* Psuedocode:            
            Step 1: $query = SELECT * FROM photos LEFT OUTER JOIN albums ON albums.album_id=photos.album_id LEFT OUTER JOIN events ON albums.event_id=events.event_id WHERE photos.photo_id = $pid
            
            Step 2: $result = $mysqli -> query ($query)
            
            Step 3: print out relevant information of this photo, including which album it belongs to and which event it belongs to. Display them in a pleasant format. Make sure to rescale the image to similar size.
            */
            ?>
        </div>
    </body>
</html>