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
        require_once "includes/config.php";
        //add_versioned_file( 'js/scripts.js', 'JavaScript' );
        add_versioned_file( 'css/styles.css', 'Style' );
        ?>
    </head>
    
    <?php include 'includes/nav.php';?>
    <body>       
        <?php
        $aid = $_GET['aid'];

        /* Psuedocode:            
        Step 1: $query = SELECT * FROM albums INNER JOIN events ON events.event_id = albums.event_id WHERE album_id = $aid

        Step 2: $result = $mysqli -> query ($query)

        Step 3: display relevant text information of this album at the top. 

        Step 4: $sql = SELECT * FROM photos WHERE album_id = $aid and $photos = $mysqli -> query ($sql)

        Step 5: display all photos in that album ($photos). Allow users to click on the photo to view image details (href=photo.php?pid=$photo_id)

        */

        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = $mysqli->query("SELECT * FROM albums INNER JOIN events ON events.event_id = albums.event_id WHERE album_id=$aid");
        
        echo "<div class=single-album-content>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<h2 class='single-album-title'>" . $row['name'] . "</h2>";
            echo "<b>Participants</b>: " . $row['participant_List'] . "<br>";
            echo "<b>Feedback</b>: " . $row['feedbak'] . "<br>";
            echo "<b>Venue</b>: " . $row['venue'] . "<br><br>";
            echo "<b>History</b>: " . $row['history'] . "<br><br>";
            echo "<b>Description</b>: " . $row['description'] . "<br><br>";
            $photo_result = $mysqli->query("SELECT * FROM photos WHERE album_id = $aid");
            
            echo "<div class='gallery'>";
            while ($photo_row = $photo_result->fetch_assoc()) {
                echo "<div class='single-album-container'>";
                    echo "<img src=img/" . $photo_row['file_path'] . ">";
                echo "</div>";
            }
            $name = $row['name'];
            echo "</div>";
            echo "</div>";  
        }

        ?>
    </body>
</html>