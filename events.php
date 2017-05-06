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
            $id = $_GET['id'];
            require_once 'includes/config.php';
            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            if( $mysqli->connect_errno ) {
                print("<p>$mysqli->connect_error<p>") ;
                die( "Couldn't connect to database");
            }
            
            $query = "SELECT * FROM events";
            $result = $mysqli->query($query);
            
            echo '<ul>';
            if ($id == 'default'){
                echo '<li class="selected"><a href="events.php?id=default">All Events</a></li>';
            }else{
                echo '<li><a href="events.php?id=default">All Events</a></li>';
            }
            while ($row = $result->fetch_assoc()){
                $name = $row['name'];
                $eid = $row['event_id'];
                if ($eid == $id){
                    print("<li class='selected'><a href=events.php?id=".$eid.">".$name."</a></li>");
                }else{
                    print("<li><a href=events.php?id=".$eid.">".$name."</a></li>");
                }
            }
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
        </div>
        <div class="textbeside">
            <h2>Running Cornellians</h2>
            <h3>Event Description</h3>
            <p>Adopted from the Running Man variety show from Korea, we designed exciting missions and racing for a unique event. Divided into team white and team black, two teams competed against each other in a several tiny games to win the bonus for the final round. In the last round, two teams chase around each other to pull off each other's nametag on the back. Whichever team has the last man standing wins. However, what they didn’t realize is that secret spy couple has betrayed everyone and tried to win the final mission...</p>
            <h3>History</h3>
            <p>An Econ-major Cornellian, Magic Peng, came up with the idea of recreating the most pupolar Korean TV show RunningMan at Cornell. At that time he was a sophomore, and he decided to work with his friends to start a small event on campus just for fun. However, everyone liked his idea and he had to recruit a larger team to accomplish a bigger event.</p>
        </div>
        <div class="textbeside">
            <h2>Micro Film</h2>
            <h3>Event Description</h3>
            <p>Our first micro film production features student actors and actresses. The film  depicts Gu Nanfeng, a woman in her late twenties, encounters her hidden past after receiving a mysterious text. When facing decisions in life, people often fall for the pretty lies. So did Nanfeng. But there is a voice deep inside that keeps telling her to wake up. As she confronts her worst nightmare, she was eventually able to discover her true self and follow her childhood dreams.
            </p>
            <h3>History</h3>
            <p>Waiting for more information</p>
        </div>
    </body>
</html>