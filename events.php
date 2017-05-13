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

        <title>Events | Cornell Media and Entertainment</title>
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
        <div class="sidebar">        
        <?php
            if (isset($id)){
                $id = $_GET['id'];
            }else{
                $id = "default";
            }
            
            require_once 'includes/config.php';
            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            if( $mysqli->connect_errno ) {
                print("<p>$mysqli->connect_error<p>") ;
                die( "Couldn't connect to database");
            }
            
            $query = "SELECT * FROM events";
            $result = $mysqli->query($query);
            $pageContent = '';

            echo '<ul>';
            if ($id == 'default') {
                echo '<li class="selected"><a href="events.php?id=default">All Events</a></li>';
            } else {
                echo '<li><a href="events.php?id=default">All Events</a></li>';
            }
            while ($row = $result->fetch_assoc()){
                $name = $row['name'];
                $eid = $row['event_id'];
                $description = $row['description'];
                $history = $row['history'];

                if ($id == "default") {
                    $pageContent .= '<div class="textbeside">';
                    $pageContent .= "<h2>$name</h2>";
                    $pageContent .= "<h3>Event Description</h3>";
                    $pageContent .= "<p>$description</p>";
                    $pageContent .= "<h3>History</h3>";
                    $pageContent .= "<p>$history</p></div>";
                }

                if ($eid == $id){
                    print("<li class='selected'><a href=events.php?id=".$eid.">".$name."</a></li>");
                    
                    $pageContent .= '<div class="textbeside">';
                    $pageContent .= "<h2>$name</h2>";
                    $pageContent .= "<h3>Event Description</h3>";
                    $pageContent .= "<p>$description</p>";
                    $pageContent .= "<h3>History</h3>";
                    $pageContent .= "<p>$history</p></div>";
                } else {
                    print("<li><a href=events.php?id=".$eid.">".$name."</a></li>");
                }
            }
            echo "</ul></div>";

            //page content
            echo "<div class='content'>";
            echo $pageContent;
            echo "</div>";

            /* Psuedocode:
            After printing out the sidebar, we need to print out all relevant information from the events table. 
                        
            Step 1: deal with the special case when id = default, which in this case means display all events.
                Thus, if ($id == "default"){
                $sql = "SELECT * FROM events"
                }
            
            Step 2: else (in other cases), $sql = "SELECT * FROM events WHERE event_id =".$id
            
            Step 3: $info = mysqli -> query($sql)
            
            Step 4: while ($detail = $info -> fetch_assoc())
                print out all information returned.
                
            Step 5: Present image slider when a single event has been chosen. $pictures = $mysqli -> query('SELECT * FROM photos INNER JOIN albums ON photos.album_id = albums.album_id WHERE albums.event_id = $id')
            
            Step 6: print out all file path in the format of <img class="picslides" src=file_path style="width:100%">
            
            Step 7: import the javascript 
            <script type="text/javascript" src="scripts/imageslide.js"></script>

            Step 8: additional styling may be needed in case of weird size of pictures, but we'll leave it alone now. 

            -->
            */


            ?>
    </body>
</html>