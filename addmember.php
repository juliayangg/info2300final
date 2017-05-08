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

        <title>Add Member | Cornell Media and Entertainment</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <?php 
        require_once "includes/functions.php";
        //add_versioned_file( 'js/scripts.js', 'JavaScript' );
        add_versioned_file( 'css/styles.css', 'Style' );
        ?>
        <script src="scripts/main.js"></script> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    </head>
    
    <?php include 'includes/nav.php';?>

    <?php
    if (!isset($_SESSION['logged_user_by_sql']) ){
            print('<p> You are not logged in.</p>');
            print('<p>Please <a href="login.php">log in</a> to to access this page.</p>');
            exit();
    }
    ?>

    <?php
    $positions = array("President", "VP", "Finance", "Multimedia", "Operations");

    //displays all of the positions
    function displayPosition() {
        global $positions;
        foreach ($positions as $pos){
            echo '<input type="radio" name="position" value="'.$pos.'">' .$pos.'<br>';
        }
    }

    ?>
    <body>
        <div class="messages">
            <h2>Add a New Member</h2>
            <form action="addmember.php" method='POST' enctype="multipart/form-data">
                <table class="center">
                    <tr><td><label for="newphoto">Select a Profile Picture:</label></td></tr>
                    <tr><td><input id="newphoto" type="file" name="newphoto"></td></tr>
                    
                    <tr><td>Name: <input type="text" name="uname" onchange="validName('namemsg', this.value);" placeholder="Member's Name"></td>
                    <td><span class="error">*</span></td>
                    <td class="error" id="namemsg"></td></tr>

                    <tr><td>Graduation Year: <input type="text" name="uyear" onchange="validYear('gradmsg', this.value);" placeholder="Graduation Year"></td>
                    <td><span class="error">*</span></td>
                    <td class="error" id="gradmsg"></td></tr>

                    <tr><td>Major: <input type="text" name="umajor" onchange="validText('majormsg', this.value);" placeholder="Member's major"></td>
                    <td><span class="error">*</span></td>
                    <td class="error" id="majormsg"></td></tr>

                   <tr><td> Position: <br><?php displayPosition(); ?></td></tr>
                </table>
                <input type="submit" class="button" name="intake" value="Add Member">
                </form>
            <?php

            if(isset($_POST["intake"])){
                if (!isset($_FILES['newphoto'])){
                    echo '<p>Please select one photo to upload</p>';
                    exit();
                }
                else {
                    $name = filter_input( INPUT_POST, 'uname', FILTER_SANITIZE_STRING );
                    if (empty($name)){
                        $nameErr = "name"; 
                    }

                    $year = filter_input( INPUT_POST, 'uyear', FILTER_SANITIZE_NUMBER_INT);
                    if ($year < 2010 || $year > 2018 ){
                        $yearErr = "year";
                    }

                    $major = filter_input( INPUT_POST, 'umajor', FILTER_SANITIZE_STRING );
                    if (empty($major)){
                        $majorErr = "major";
                    }

                    $pos = $_POST['position'];
                    if (empty($pos)){
                        $posErr = "position";
                    } else {
                        $exists = false; 
                        foreach ($positions as $position){
                            if ($position === $pos){
                                $exists = true; 
                            }
                        }

                        if (!$exists){
                            $posErr = "position";
                        }
                    }

                    //uploaded photo
                    print '<pre style="display:none;">' . print_r( $_FILES, true ) . '</pre>';
                    if ( !empty( $_FILES[ 'newphoto' ]) ) {
                        $newPhoto = $_FILES[ 'newphoto' ];
                        $originalName = $newPhoto[ 'name' ];
                        if ( $newPhoto[ 'error' ] == 0 ) {
                            $tempName = $newPhoto[ 'tmp_name' ];
                            move_uploaded_file( $tempName, 'img/eboard/'.$originalName);
                            $_SESSION['photos'][] = $originalName;
                        } else{
                            $photoErr = 'photo';
                        }
                    }

                    if ($nameErr || $yearErr || $majorErr || $posErr || $photoErr ){
                         echo "<p class='error'>Submission unsuccessful. The following are invalid: $nameErr $yearErr $majorErr $posErr $photoErr </p>";                       
                    }
                    else if ($name && $year && $major && $position){

                        $picpath = "img/eboard/$originalName";

                        $insertMember = "INSERT INTO Members VALUES (NULL, '$name', $year, '1', '$major', '$pos', '$picpath')";
                        print $insertMember; 
                        $result = $mysqli->query($insertMember);
                                if (!$result) {
                                    print($mysqli->error);
                                    exit();
                                }
                        echo "<p>Submission successful. View your albums <a href='photos.php?type=default'>here</a>";
                    }

                }
                

            }

            ?>
            <!-- Psuedocode:
            Step 0: Check the loggin status. If not logged in, don't show up the form, and display message of "you need to log in to use this functionality"

            Step 1: if isset $_POST['intake'], and !isset $_FILES['newphotos'], print("please select ONE image to upload")
            
            Step 2: else (which means isset $_FILES['newphotos']), check if this file is a picture file (jpg,png,etc.). If not, print out error message and quit. 
            
            Step 3: Validate all other input, such as name must be a text, position must be in the list [President, VP, Finance, Operations]. If not, print error message and quit.

            Step 4: $originalName = $newPhotos['name'] and if $newPhotos['error'] == 0, then $tempName = $newPhotos['tmp_name']
            
            Step 4: move_uploaded_file( $tempName, "images/$originalName" );
						$_SESSION['photos'][] = $originalName; 
                        if failed, print out failuer message. 
            
            Step 5: Insert these information into photos table with default member_id and active as TRUE (users can change this status in editmember page). If failed, print out failuer message. 
            
            Step 6: print out success message and a href to view all members (href=photos.php?type=default). 
            -->           
        </div>
    </body>
</html>