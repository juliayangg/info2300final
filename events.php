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
    <body>
    <?php include 'includes/nav.php';?>
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
                    print("<li class='selected'><a href='events.php?id=".$eid."'>".$name."</a></li>");
                    
                    $pageContent .= '<div class="textbeside">';
                    $pageContent .= "<h2>$name</h2>";
                    $pageContent .= "<h3>Event Description</h3>";
                    $pageContent .= "<p>$description</p>";
                    $pageContent .= "<h3>History</h3>";
                    $pageContent .= "<p>$history</p></div>";
                } else {
                    print("<li><a href='events.php?id=".$eid."'>".$name."</a></li>");
                }
            }
            echo "</ul></div>";

            //page content
            echo "<div class='content'>";
            echo $pageContent;
            echo "</div>";
            ?>
        </div>
    </body>
</html>