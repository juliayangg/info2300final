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
        add_versioned_file( 'css/styles.css', 'Style' );
        ?>
    </head>
    <body>
    <?php include 'includes/nav.php';?>       
        <?php
        $aid = $_GET['aid'];

        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = $mysqli->query("SELECT * FROM albums INNER JOIN events ON events.event_id = albums.event_id WHERE album_id=$aid");
        
        echo "<div class=single-album-content>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<div class='albuminfo'>";
            $name = $row['name'];
            $feed = $row['feedbak'];
            $plist = $row['participant_List'];
            $venue = $row['venue'];
            $his = $row['history'];
            $dis = $row['description'];
            echo "<h2 class='single-album-title'>" . $name . "</h2>";
            echo "<p><b>Participants</b>: " . $plist . "</p>";
            echo "<p><b>Feedback</b>: " .$feed . "</p>";
            echo "<p><b>Venue</b>: " . $venue . "</p>";
            echo "<p><b>History</b>: " .$his . "</p>";
            echo "<p><b>Description</b>: " .$dis . "</p>";
            $photo_result = $mysqli->query("SELECT * FROM photos WHERE album_id = $aid");
            echo "</div>";
            echo "<div class='gallery'>";
            while ($photo_row = $photo_result->fetch_assoc()) {
                echo "<div class='single-album-container'>";
                echo "<img src=img/" . $photo_row['file_path'] . " alt='Event Photo'>";
                echo "</div>";
            }
            echo "</div>";
        echo "</div>";  
        }
        ?>
    </body>
</html>