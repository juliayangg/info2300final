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

        <title>Add Event | Cornell Media and Entertainment</title>
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
            <h2>Add a New Event</h2>
            <form action="addevent.php" method='POST'>
                 <table class="center">
                    <tr><td>Name: <input type="text" name="aname" onchange="validName('namemsg', this.value);" placeholder="Event Name"></td>
                    <td><span class="error">*</span></td>
                    <td class="error" id="namemsg"></td>
                    </tr>
                    <tr><td>History: <input type="text" name="ahistory" onchange="validText('historymsg', this.value);" placeholder="History of Event"></td>
                    <td><span class="error">*</span></td>
                    <td class="error" id="historymsg"></td>
                    </tr>
                    <tr><td>Description: <input type="text" name="adesc" onchange="validText('descriptionmsg', this.value);" placeholder="Event Description"></td>
                    <td><span class="error">*</span></td>
                    <td class="error" id="descriptionmsg"></td>
                    </tr>                
                </table>
                <input type="submit" class="button" name="add" value="Add an Event">
            </form>
            <?php 

            if(isset($_POST["add"])){
                $name = $_POST['aname'];
                if (empty($name) || !preg_match('/^[a-zA-Z- ]+$/', $name)){
                         $nameErr = "name";
                }

                $history = filter_input( INPUT_POST, 'ahistory', FILTER_SANITIZE_STRING );
                if (empty($history)){
                    $historyErr = "history";
                }


                $desc = filter_input( INPUT_POST, 'adesc', FILTER_SANITIZE_STRING );
                if (empty($desc)){
                    $descErr = "description";
                }

                if ( $nameErr || $historyErr || $descErr){
                    echo "<p class='error'>Submission unsuccessful. The following are invalid: $nameErr $historyErr $descErr </p>";
                }

                else if ( $name && $history && $desc ) {
                        $insertEvent = "INSERT INTO Events VALUES (NULL, '$name', '$history', '$desc')";
                        print $insertEvent; 
                        $result = $mysqli->query($insertEvent);
                                if (!$result) {
                                    print($mysqli->error);
                                    exit();
                                }
                        echo "<p>Submission successful. View your events <a href='events.php?id=default'>here</a>";
                }
            }

            ?>         
        </div>
    </body>
</html>