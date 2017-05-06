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
        add_versioned_file( 'scripts/main.js', 'JavaScript' );
        add_versioned_file( 'css/styles.css', 'Style' );
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    </head>
    
    <?php include 'includes/nav.php';?>
    <body>
   
        <div class="messages">
            <h2>Create a New Album</h2>
            <form action="addalbum.php" method='POST' enctype="multipart/form-data">
                <table>
                    <?
                    //implemented one example of input functionality
                    $yearErr = ""; 

                    // for each item in the table
                    //create an err variable set to ""  

                    ?>
                    <tr><td>Year: <input type="text" name="ayear" style="font-size:12pt;" onchange="validYear(this.value);" placeholder="A four-digit number"><br></td>
                    <td><span class="error">*<?php echo $yearErr;?></span></td>
                    <td class="error" id="yearmsg"></td>
                    </tr>
                    
                    <br><br>
                    <tr><td>Participant List: <input type="text" name="alist" style="font-size:12pt;" placeholder="List of participants"><br></td>
                    <!-- span class for asterick and echo err -->
                    <!-- td with id of type msg --> 
                    </tr>

                   <tr><td> Feedback: <input type="text" name="alist" style="font-size:12pt;" placeholder="Collection of feedback"><br></td>
                    <!-- span class for asterick and echo err -->
                    <!-- td with id of type msg --> </tr>
                   <tr><td>
                    Venue: <input type="text" name="alist" style="font-size:12pt;" placeholder="Venue it took place"><br></td>
                    <!-- span class for asterick and echo err -->
                    <!-- td with id of type msg --> 
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
                        echo '<input type="checkbox" name="albums" value="'.$eid.'">'.$name.'<br>';
                    }
                    ?>
                    <br></td></tr>
                    <tr><td><input type="submit" name="create" value="Create an Album"></td></tr>
                    <!-- input type clear -->
                    <!-- input type cancel returns back to admin page-->
                </table>
            </form>
            <!-- Psuedocode:
            Step 0: Check the loggin status. If not logged in, don't show up the form, and display message of "you need to log in to use this functionality"

            Step 1: if isset $_POST['create'], and check all the inputs (e.g. year has to be a four-digit number and feedback must be text). If not, print("please check your input and try again")
            
            Step 2: else (which means all input validates), insert all information into albums table as entered (with album_id as default). 

            Step 3: print out success message and a href to view all albums (href=photos.php?sort=albums). 
            -->           
        </div>
    </body>
</html>