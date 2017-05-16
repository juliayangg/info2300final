<?php
if(!isset($_SESSION)) {
    session_start(); 
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>Photos | Cornell Media and Entertainment</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="scripts/search.js"></script>
        <?php 
            include 'includes/nav.php'; 
            require_once "includes/functions.php";
            require_once 'includes/config.php';
            add_versioned_file( 'css/styles.css', 'Style' );
        ?>
    </head>
    <body> 
        <br>
        <?php
            $sort = $_GET['sort'];
            echo '<div class="sidebar">';
            echo '<ul>';
            if ($sort == "photos"){
                echo '<li><a href="photos.php?sort=albums">All Albums</a></li>';
                print("<li class='selected'><a href=photos.php?sort=".$sort.">All Photos</a></li>");
            } else {
                echo '<li class="selected"><a href="photos.php?sort='.$sort.'">All Albums</a></li>';
                echo '<li><a href="photos.php?sort=photos">All Photos</a></li>';
            }
            echo '</ul></div>';
            
            echo "<div class='content'>";
            

            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            if ($sort == "albums") {
                echo "<div class='top-bar'>";
                    echo '<h3>Please be patient. The photos may take some time to load.</h3>';
                    echo "<div class='search'> Search: <input type='text' id='search-text' placeholder='Event, Year or Venue'></div>";
                echo "</div>";
                $result = $mysqli->query("SELECT * FROM `albums` INNER JOIN events WHERE albums.event_id = events.event_id");
                echo "<div class='gallery'>";
                while ($row = $result->fetch_assoc()) {
                    $albumID = $row['album_id'];
                    $photo_result = $mysqli->query("SELECT * FROM `photos` WHERE photos.album_id=$albumID LIMIT 1");
                    while ($photo_row = $photo_result->fetch_assoc()) {
                        echo "<div class='album-container'>";
                            echo "<a class='unstyled-link' href=album.php?aid=$albumID>";
                            echo "<img src=img/" . $photo_row['file_path'] . ">";
                            echo "<span class='deets'><span>Learn More</span></span>";
                            echo "</a>";
                            echo "<h2 class='album-title'>" . $row['name'] . "</h2>    " . $row['year'];
                        echo "</div>";
                    }
                }
                echo "</div>";
            } else {
                $result = $mysqli->query("SELECT * FROM photos");
                while ($row = $result->fetch_assoc()) {
                    echo "<a class='unstyled-link' href='photo.php?pid=" . $row['photo_id'] . "'>";
                    echo "<div class='image-container'>";
                        echo "<img src=img/" . $row['file_path'] . " alt='CME photos'>";
                        echo "<span class='deets'><span>Learn More</span></span>";
                    echo "</div>";
                    echo "</a>";
                }
            }
            echo "</div>";
        ?>

    </body>
</html>