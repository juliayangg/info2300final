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
        add_versioned_file( 'scripts/main.js', 'JavaScript' );
        add_versioned_file( 'css/styles.css', 'Style' );
        ?>
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

     <?php
    require_once 'includes/config.php';
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($mysqli->errno) {
        print ("<h2>Error Connecting to Database</h2>");
        exit();
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
            $currentmember=array();
            $membername="SELECT name FROM members";
            $names = $mysqli->query($membername);
            if (!$names) {
                print($mysqli->error);
                exit();
            }else{
                while ($namerow = $names->fetch_assoc()){
                    $eachname = $namerow['name'];
                    $currentmember[]=$eachname;
                }
            }
            
            if(isset($_POST["intake"])){
                $invalidlist=array();
                if (!isset($_FILES['newphoto'])){
                    echo '<p>Please select one photo to upload</p>';
                    exit();
                }
                else {
                    $name = filter_input( INPUT_POST, 'uname', FILTER_SANITIZE_STRING );
                    if (empty($name)){
                        $nameErr = "Empty name entered.<br>";
                        $invalidlist[]=$nameErr;
                    }else if (!preg_match("/^[a-zA-Z' ]+$/",$name)){
                        $nameErr = "Please enter a valid name.<br>";
                        $invalidlist[]=$nameErr;  
                    }else if(in_array($name,$currentmember)){
                        $nameErr = "Member already exists.<br>";
                        $invalidlist[]=$nameErr; 
                    }

                    $year = filter_input( INPUT_POST, 'uyear', FILTER_SANITIZE_NUMBER_INT);
                    if ($year < 2010 || $year > 2020 ){
                        $yearErr = "Please enter 4-digit number for the year.<br>";
                        $invalidlist[]=$yearErr;
                    }

                    $major = filter_input( INPUT_POST, 'umajor', FILTER_SANITIZE_STRING );
                    if (empty($major)){
                        $majorErr = "Please enter the major info.<br>";
                        $invalidlist[]=$majorErr;
                    }else if (!preg_match("/^[a-zA-Z' ]+$/",$major)){
                        $majorErr = "Please enter a valid major.<br>";
                        $invalidlist[]=$majorErr;
                    }

                    $pos = filter_input( INPUT_POST, 'position', FILTER_SANITIZE_STRING );
                    if (empty($pos)){
                        $posErr = "Please enter position info.<br>";
                        $invalidlist[]=$posErr;
                    } else {
                        $exists = false; 
                        global $positions;
                        foreach ($positions as $position){
                            if ($position === $pos){
                                $exists = true; 
                            }
                        }
                        if (!$exists){
                            $posErr = "Please choose a valid position.<br>";
                            $invalidlist[]=$posErr;
                        }
                    }

                    //uploaded photo
                    print '<pre style="display:none;">' . print_r( $_FILES, true ) . '</pre>';
                    
                    if ( !empty( $_FILES[ 'newphoto' ])) {
                        $newPhoto = $_FILES[ 'newphoto' ];
                        $originalName = $newPhoto[ 'name' ];
                        $allowedTypes = array("image/png", "image/jpeg", "image/gif");
                        $detectedType = $newPhoto['type'];
                        if ( $newPhoto[ 'error' ] == 0 && in_array($detectedType,$allowedTypes)) {
                            $tempName = $newPhoto[ 'tmp_name' ];
                            move_uploaded_file( $tempName, 'img/eboard/'.$originalName);
                            $_SESSION['photos'][] = $originalName;
                        } else if (!in_array($detectedType,$allowedTypes)){
                            $photoErr = 'Invalid photo type.<br>';
                            $invalidlist[]=$photoErr;
                        }else{
                            $photoErr = 'Photo upload error.<br>';
                            $invalidlist[]=$photoErr;
                        }
                    }
                    
                    if (count($invalidlist)!=0) {
                        echo "<p class='error'>Submission unsuccessful. The following errors occur:<br>";
                        foreach ($invalidlist as $msg){
                             echo "$msg";
                        }
                        echo "</p>";
                    }
                    
                    else if (count($invalidlist)==0){

                        $picpath = "eboard/$originalName";

                        $insertMember = "INSERT INTO members VALUES (DEFAULT, '$name', $year, '1', '$major', '$pos', '$picpath')";
                        $result = $mysqli->query($insertMember);
                                if (!$result) {
                                    print($mysqli->error);
                                    exit();
                                }
                        echo "<p>Information of $name is successfully updated.</a>";
                    }
                }
            }
            ?>        
        </div>
    </body>
</html>