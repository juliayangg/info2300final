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
<?php
if (!isset($_SESSION['logged_user_by_sql']) ){
    print('<p> You are not logged in.</p>');
    print('<p>Please <a href="login.php">log in</a> to to access this page.</p>');
    exit();
}
?>

<body>
    <div class="messages">
        <h2>Manage photos</h2>
        <p style="text-align:center;">If you did not find the album you are looking for, create a new album before submit photos.</p>
        <form action="uploadphoto.php" method="post" enctype="multipart/form-data">
            <p>
                <label for="new-photos">Multiple photos upload: </label>
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
                    echo '<input type="radio" name="albums" value="'.$aid.'">'.$name.' '.$year.'<br>';
                }
                ?>
                <br>
                <input type="submit" name="submit" value="Upload photos">
            </p>
        </form>

        <?php
        
        if(isset($_POST["submit"])){
            $invalidlist=array();

            $album = filter_input( INPUT_POST, 'albums', FILTER_SANITIZE_STRING );
            if (empty($album)){
                $invalidlist[]="no album selected";
            }

            if (!isset($_FILES['newphotos'])){
                $invalidlist[]="<p> Submission unsuccessful. Please select at least one image to upload</p";
                exit();
            } 
            else if (isset( $_FILES['newphotos'])){
                $_SESSION['photos']=array();
                $newPhotos = $_FILES['newphotos'];
				for ( $i = 0; $i < count( $newPhotos['name'] ); $i++) {
					$originalName = $newPhotos['name'][$i];

                    $allowedTypes = array("image/png", "image/jpeg", "image/gif");
                    $detectedType = $newPhotos['type'][$i];
                    
                    $photonames=array();
                    if ($newPhotos['error'][$i] == 0 && in_array($detectedType,$allowedTypes) ) {
                        $tempName = $newPhotos['tmp_name'][$i];
                        move_uploaded_file( $tempName,"img/photos/$originalName" );
                        $_SESSION['photos'][] = $originalName;
                    } else if (!in_array($detectedType,$allowedTypes)){
                        $photoErr = 'Invalid photo type.<br>';
                        if (!in_array($photoErr,$invalidlist)){
                            $invalidlist[]=$photoErr;
                        }   
                    }else{
                        $photoErr = 'Photo upload error';
                        if (!in_array($photoErr,$invalidlist)){
                            $invalidlist[]=$photoErr;
                        } 
                    }
                }
            }
            
            if (count($invalidlist)!=0) {
                echo "<p class='error'>Submission unsuccessful. The following errors have occurred:";
                foreach ($invalidlist as $msg){
                     echo "&nbsp;$msg";
                }
                echo "</p>";
            } 

            else if (count($invalidlist)==0){
                foreach ($_SESSION['photos'] as $photo){
                    $insertImg = "INSERT INTO photos VALUES (DEFAULT, 'photos/$photo', $album)";
                    $result = $mysqli->query($insertImg);
                    if (!$result) {
                        print($mysqli->error);
                        exit();
                    }
                }
                echo "<p>Picture(s) uploaded successfully. View them <a href='photos.php?sort=photos'>here</a>";
                $_SESSION['photos']=array();
            }
        }
        ?>          
    </div>
</body>
</html>