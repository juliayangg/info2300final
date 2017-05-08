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
            <h2>Add a New Member</h2>
            <form action="addmember.php" method='POST' enctype="multipart/form-data">
                <p>
                    <label for="newphoto">Select a Profile Picture to upload</label>
                    <input id="newphoto" type="file" name="newphoto"><br><br>
                    Name: <input type="text" name="utitle" style="font-size:12pt;" placeholder="Member's Name"><br><br>
                    Graduation Year: <input type="text" name="uyear" style="font-size:12pt;" placeholder="Graduation Year"><br><br>
                    Major: <input type="text" name="uphotographer" style="font-size:12pt;" placeholder="Member's major"><br><br>
                    Position: <br>
                    <input type="checkbox" name="position" value="President">President<br>
                    <input type="checkbox" name="position" value="VP">Vice President<br>
                    <input type="checkbox" name="position" value="Finance">Finance<br> 
                    <input type="checkbox" name="position" value="Multimedia">Multimedia<br>
                    <input type="checkbox" name="position" value="Operations">Operations
                    <br><br>
                    <input type="submit" name="intake" value="Add a Member">
                    </p>
                </form>

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