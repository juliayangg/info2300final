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

    <title>Edit Member Info | Cornell Media and Entertainment</title>
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
    $positions = array("President", "Vice President", "Finance", "Multimedia", "Operations");
    //displays all of the positions
    function displayPosition() {
        global $positions;
        foreach ($positions as $pos){
            echo '<input type="radio" name="position" value="'.$pos.'">' .$pos.'<br>';
        }
    }
    
    require_once 'includes/config.php';
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($mysqli->errno) {
        print ("<h2>Error Connecting to Database</h2>");
        exit();
    }

    $members = array();
    $getMembers=$mysqli->query('SELECT member_id,name FROM members');
    while ($info = $getMembers->fetch_assoc()){
        $id = $info['member_id'];
        $name = $info['name'];
        $members[$id] = $name;
    }

    function displayMembers() {
        global $members;
        //echo '<select id="members">';
        echo "<option disabled selected value> -- select a member -- </option>";
        foreach ($members as $id => $name){
            echo "<option value='$id'>$name</option>";
        }
        //echo '</select>';
    }

    ?>

    <body>
    <div class="messages">
        <h2>Edit Member Status</h2>
        <form method='POST' enctype="multipart/form-data">
            <table class="center">    
                <tr><td>Name:
                    <select name="memberStatus">
                       <?php displayMembers() ?>
                   </select></td></tr>

                   <tr><td> Status:<br>
                    <input type="radio" name="status" value="1">Active<br>
                    <input type="radio" name="status" value="0">Inactive
                </td></tr>
            </table>
            <input type="submit" class="button" name="changeStatus" value="Change Status">
        </form>
    </div>
        
    <div class="messages">
        <h2>Edit Member</h2>
        <form method='POST' enctype="multipart/form-data">
            <table class="center">
                <tr>
                    <td>Name: <select name="editMember">
                        <?php displayMembers() ?>
                        </select></td>
                </tr>
        
                <tr>
                    <td>Graduation Year: 
                    <input type="text" name="uyear" onchange="validYear('gradmsg', this.value);" placeholder="Graduation Year"></td>
                    <td><span class="error">*</span></td>
                    <td class="error" id="gradmsg"></td>
                </tr>
                
                <tr>
                    <td>Major: <input type="text" name="umajor" onchange="validText('majormsg', this.value);" placeholder="Member's major"></td>
                    <td><span class="error">*</span></td>
                    <td class="error" id="majormsg"></td>
                </tr>

                <tr>
                    <td>Position: <br><?php displayPosition(); ?></td>
                </tr>
            </table>
            <input type="submit" class="button" name="intake" value="Edit Member">
        </form>
    </div>

    <?php
    $errlist=array();

    if(isset($_POST["changeStatus"])){

        if (!isset($_POST['memberStatus'])){
            $errlist[] = "please choose a member.<br>";
        } else {
            $selectedMember = filter_input( INPUT_POST, 'memberStatus', FILTER_SANITIZE_NUMBER_INT );
        }

        $status = filter_input( INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT );
        if (!isset($status)){
            $errlist[] = "please chooose a status.<br>";
        } 

        if (count($errlist)!=0){
            echo "<p class='error'>Submission unsuccessful. The following errors occur:<br>";
            foreach ($errlist as $err){
                echo "$err";
            }
            echo "</p>";
        } else {
            $updateActivity = "UPDATE members SET active=$status WHERE member_id=$selectedMember";
            $result = $mysqli->query($updateActivity);
            if (!$result) {
                print($mysqli->error);
                exit();
            }
            echo "<p>Status Update Successful.</a>";
        } 
    }
    ?>

    <?php
    $errors=array();

    if(isset($_POST["intake"])){
        if (!isset($_POST['editMember'])){
            $errors[] = "please choose a member.<br>";
        } else {
            $selectedMember = filter_input( INPUT_POST, 'editMember', FILTER_SANITIZE_NUMBER_INT );
        }

        $year = filter_input( INPUT_POST, 'uyear', FILTER_SANITIZE_NUMBER_INT);
        if (!preg_match("/^\d{4}$/", $year)){
            $errors[] = "please enter a valid year.<br>";
        }

        $major = filter_input( INPUT_POST, 'umajor', FILTER_SANITIZE_STRING );
        if (empty($major)){
            $errors[] = "please enter a major.<br>";
        }else if (!preg_match("/^[a-zA-Z' ]+$/",$major)){
            $errors[] = "please enter a valid major.<br>";
        }

        $pos = filter_input( INPUT_POST, 'position', FILTER_SANITIZE_STRING );
        if (empty($pos)){
            $errors[] = "please choose a position.<br>";
        } else {
            $exists = false; 
            global $positions;
            foreach ($positions as $position){
                if ($position === $pos){
                    $exists = true; 
                }
            }
            if (!$exists){
                $errors[] = "please choose a valid position.<br>";
            }
        }

        if (count($errors)!=0){
            echo "<p class='error'>Submission unsuccessful. The following errors occur:<br>";
            foreach ($errors as $error){
                echo "$error";
            }
            echo "</p>";
        } else {
            $updateinfo = "UPDATE members SET grad_year=$year, major='$major', position='$pos' WHERE member_id=$selectedMember";
            $result = $mysqli->query($updateinfo);
            if (!$result) {
                print($mysqli->error);
                exit();
            } else{
                echo "<p>Submission successful.</a>";
            }
        }
    }
    ?>
    </body>
</html>