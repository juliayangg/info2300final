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

        <title>Add Album | Cornell Media and Entertainment</title>
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
    <body>
   
        <div class="messages">
            <h2>Create a New Album</h2>
            <form action="addalbum.php" method='POST' enctype="multipart/form-data">
                <table class="center">
                    <tr><td>Year: <input type="text" name="ayear" onchange="validYear('yearmsg', this.value);" placeholder="A four-digit number"></td>
                    <td><span class="error">*</span></td>
                    <td class="error" id="yearmsg"></td>
                    </tr>

                    <br><br>
                    <tr><td>Participant List: <input type="text" name="alist" onchange="validText('participantmsg', this.value);" placeholder="List of participants"><br><br></td>
                    <td><span class="error">*</span></td>
                    <td class="error" id="participantmsg"></td>
                    </tr>

                   <tr><td> Feedback: <input type="text" name="afeedback" onchange="validFeedback('feedbackErr', this.value);" placeholder="Collection of feedback"><br><br></td>
                    <td><span class="error">*</span></td>
                    <td class="error" id="feedbackErr"></td>
                   </tr>

                   <tr><td>
                    Venue: <input type="text" name="avenue" onchange="validText('venuemsg', this.value);" placeholder="Where it took place"><br><br></td>
                    <td><span class="error">*</span></td>
                    <td class="error" id="venuemsg"></td>
                </tr>
                    
                   <tr><td> Choose an event the album is about: <br>
                    <?php
                    require_once 'includes/config.php';
                    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                    if ($mysqli->errno) {
                        print ("<h2>Error Connecting to Database</h2>");
                        exit();
                    }
                    $eventinfo=$mysqli->query('SELECT * FROM events');
                    while ($info = $eventinfo->fetch_assoc()){
                        $eid = $info['event_id'];
                        $name = $info['name'];
                        echo '<input type="radio" name="albums" value="'.$eid.'">'.$name.'<br>';
                    }
                    ?>
                    <br></td></tr>

                </table>
                     <input class="button" type="reset" name="reset" value="Reset">
                    <input class="button" type="submit" name="create" value="Create">
            </form>
            <?php 
            if(isset($_POST["create"])){

                    $year = filter_input( INPUT_POST, 'ayear', FILTER_SANITIZE_NUMBER_INT);
                    if ($year < 2010 || $year > 2018 ){
                        $yearErr = "year";
                    }
                    $participant_List = $_POST['alist'];
                    if (empty($participant_List) || !preg_match('/^[a-zA-Z0-9, ]+$/', $participant_List)){
                         $participantErr = "participant list";
                     }

                    $feedback = $_POST['afeedback'];
                    if (empty($feedback) || !preg_match('/^[a-zA-Z0-9-,.\"\!\& ]+$/',$feedback)){
                         $feedbackErr = "feedback";
                     }

                    $venue = filter_input( INPUT_POST, 'avenue', FILTER_SANITIZE_STRING );
                    if (empty($venue)){
                        $venueErr = "venue";
                    }

                    $album = $_POST['albums'];
                    if (empty($album)){
                        $albumErr = "invalid album";
                    }

                    if ( $yearErr || $participantErr || $venueErr || $feedbackErr || $albumErr){
                        echo "<p class='error'>Submission unsuccessful. The following are invalid: $yearErr $participantErr $venueErr $feedbackErr $albumErr </p>";
                    }  
                    else if ($year && $participant_List && $feedback && $venue && $album){

                        $insertImage = "INSERT INTO ALBUMS VALUES (NULL, $year, '$participant_List', '$feedback', '$venue', $album)";
                        print $insertImage; 
                        $result = $mysqli->query($insertImage);
                                if (!$result) {
                                    print($mysqli->error);
                                    exit();
                                }
                        echo "<p>Submission successful. View your albums <a href='photos.php?sort=albums'>here</a>";
                    }
            }

            ?>   
        </div>
    </body>
</html>