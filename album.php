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

        <title>Album Details | Cornell Media and Entertainment</title>
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
            $aid = $_GET['aid'];
            
            /* Psuedocode:            
            Step 1: $query = SELECT * FROM albums INNER JOIN events ON events.event_id = albums.event_id WHERE album_id = $aid
            
            Step 2: $result = $mysqli -> query ($query)
            
            Step 3: display relevant text information of this album at the top. 
            
            Step 4: $sql = SELECT * FROM photos WHERE album_id = $aid and $photos = $mysqli -> query ($sql)

            Step 5: display all photos in that album ($photos). Allow users to click on the photo to view image details (href=photo.php?pid=$photo_id)
            
            */
            ?>
        </div>
    </body>
</html>