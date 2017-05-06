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

        <title>Photos | Cornell Media and Entertainment</title>
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
            $sort = $_GET['sort'];
            echo '<ul>';
            if ($sort == "photos"){
                echo '<li><a href="photos.php?sort=albums">All Albums</a></li>';
                print("<li class='selected'><a href=photos.php?sort=".$sort.">All Photos</a></li>");
            }else{
                echo '<li class="selected"><a href="photos.php?sort='.$sort.'">All Albums</a></li>';
                echo '<li><a href="photos.php?sort=photos">All Photos</a></li>';
            }
            echo '</ul>';
            
            /* Psuedocode:            
            Step 1: if $sort == "albums", then $query = 'SELECT * FROM albums"
            
            Step 2: $result = $mysqli -> query ($query). print out all relevant information of albums and display them in an album format. We can't do it now because we are still waiting for clients' materials. 
            
            Step 3: give each album a link so if users click on the album they will be directed to a page with a list of photos in that album and specific info of that album. (href = album.php?aid=$album_id)
            
            Step 4: if $sort == "photos", then $query = 'SELECT * FROM photos"
            
            Step 5: $result = $mysqli -> query ($query). Print out all photos, and allow audience to click on the photo, and will be directed to a page with specific details of that photo. (href = photo.php?pid=$photo_id)
            */
            
            ?>
        </div>
        <div class="search">
            Search: <input type="text" placeholder="Event, Year or Venue">
        </div>
        <!--Psuedocode:
        Call to the serach function in search.js-->
        <div class="textbeside">
            <p>See Psuedocode comments for now.</p>
        </div>
    </body>
</html>