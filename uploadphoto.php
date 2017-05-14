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
        <form action="uploadphoto.php" method="post" enctype="multipart/form-data">
            <p>
                <label for="new-photos">Multiple photos upload: <br><br></label>
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
        $invalidlist=array();

        if(isset($_POST["submit"])){
            $albumErr="";

            $album = filter_input( INPUT_POST, 'albums', FILTER_SANITIZE_STRING );
            if (empty($album)){
                $albumErr = "no album selected";
                $invalidlist[]=$albumErr;
            } else if (!preg_match("/^[a-zA-Z0-9' ]+$/",$album)){
                $albumErr = "invalid major";
                $invalidlist[]=$albumErr;
            }

            //no album selected, immediately exit
            if (!empty($albumErr)){
                echo  "<p class='error'>Submission unsuccessful. The following errors have occured: $albumErr";
                exit();
            }

            if (!isset($_FILES['newphotos'])){
                echo "<p> Submission unsuccessful. Please select at least one image to upload</p";
                exit();
            } 
            else if ( isset( $_FILES['newphotos'] ) ) {
                $newPhotos = $_FILES['newphotos'];
                for ( $i = 0; $i < count( $newPhotos['name'] ); $i++) {
                    $originalName = $newPhotos['name'][$i];

                    $allowedTypes = array("image/png", "image/jpeg", "image/gif");
                    $detectedType = $newPhotos['type'][$i];

                    if ($newPhotos[ 'error' ][$i] == 0 && in_array($detectedType,$allowedTypes) ) {
                        $tempName = $newPhotos[ 'tmp_name' ][$i];
                        move_uploaded_file( $tempName,
                            "img/photos/$originalName" );
                        $_SESSION['photos'][ ] = $originalName;
                        print("$originalName was uploaded successfully.");
                    } else if (!in_array($detectedType,$allowedTypes)){
                            $photoErr = 'invalid photo type';
                            $invalidlist[]=$photoErr;
                    } else{
                            $photoErr = 'photo upload error';
                            $invalidlist[]=$photoErr;
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
                for ( $i = 0; $i < count( $newPhotos['name'] ); $i++) {
                    $insertImg = "INSERT INTO photos VALUES (NULL, 'img/photos/$originalName', $album)";
                    echo "$insertImg";
                    $result = $mysqli->query($insertImg);
                        if (!$result) {
                            print($mysqli->error);
                            exit();
                        }
                }
                
                echo "<p>Picture(s) uploaded successfully. View them <a href=photos.php?sort=photos'>here</a>";
            }

        }

        ?>
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