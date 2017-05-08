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

        <title>Upload Photos | Cornell Media and Entertainment</title>
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
            <h2>Manage photos</h2>
            <form action="uploadphoto.php" method="post" enctype="multipart/form-data">
                <p>
				    <label for="new-photos">Multiple photo upload: </label>
				    <input id="new-photos" type="file" name="newphotos[]" multiple>
                    <br><br>
                    Choose an album these photos belong to: <br><br>
                    <?php
                    require_once 'includes/config.php';
                    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                    if ($mysqli->errno) {
                        print ("<h2>Error Connecting to Database</h2>");
                        exit();
                    }
                    $albuminfo=$mysqli->query('SELECT * FROM albums INNER JOIN events ON events.event_id = albums.event_id');
                    while ($info = $albuminfo->fetch_assoc()){
                        $aid = $info['album_id'];
                        $name = $info['name'];
                        $year = $info['year'];
                        echo '<input type="checkbox" name="albums" value="'.$aid.'">'.$name.' '.$year.'<br>';
                    }
                    ?>
                    <br>
                    <input type="submit" name="submit" value="Upload photos">
                </p>
            </form>
            <!-- Psuedocode:
            Step 0: Check the loggin status. If not logged in, don't show up the form, and display message of "you need to log in to use this functionality"

            Step 1: if isset $_POST['submit'], and !isset $_FILES['newphotos'], print("please select at least one image to upload")
            
            Step 2: else (which means isset $_FILES['newphotos']), iterate through each photo in this photo list, check if each file is a picture file (jpg,png,etc.)
            
            Step 3: $originalName = $newPhotos['name'][$i] and if $newPhotos['error'][$i] == 0, then $tempName = $newPhotos['tmp_name'][$i];
            
            Step 4: move_uploaded_file( $tempName, "images/$originalName" );
						$_SESSION['photos'][] = $originalName; 
                        if failed, print out failuer message. 
            
            Step 5: $uaid = $_POST['albums'] and then insert these information into photos table with default photo_id, file_path, and album_id as $uaid. If failed, print out failuer message. 
            
            Step 6: print out success message and a href to view all photos (href=photos.php?sort=photos). 
            -->           
        </div>
    </body>
</html>