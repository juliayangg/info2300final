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

        <title>Members | Cornell Media and Entertainment</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <?php 
        require_once "includes/functions.php";
        require_once "includes/config.php";
        //add_versioned_file( 'js/scripts.js', 'JavaScript' );
        add_versioned_file( 'css/styles.css', 'Style' );
        ?>
    </head>
    
    <?php include 'includes/nav.php';?>
    <body>      
        <?php
            $type = $_GET['type'];
            /* Psuedocode:
            The code below is only for display purpose. The final product of this page will contain a PHP that connects to SQL and display relavant member information with SQL command. 
            
            We can't implement this now because we are still waiting for clients to provide more information of the club. 
            
            Step 0: print out the sidebars. (For how to print out the sidebar, it should work similarly to the one in the events page). 
            
            Step 1: get the type.
            
            Step 2: deal with the special case when type = alumni.
                In this case, $query = 'SELECT * FROM members WHERE active = FALSE'
            
            Step 3: when type = default, change it into "%"
            
            Step 4: when type = presvp, change it into "president"
            
            Step 5: $query = "SELECT * FROM member WHERE position LIKE '%".$type."%'
            
            Step 6: $result = mysqli -> query($query)
            
            Step 7: print out a header of "All current members" or "President / VP" or "Alumni" etc according to type, and display all pictures as the $result returns. When hovering, other relevant information will all display. 
            */
            
            
            sideMenu($type);
        
            echo "<div class='content'>";
            if ($type == "presvp")
                presVPgallery();
            else if ($type == "default") {
                presVPgallery();
                otherGallery("multimedia");
                otherGallery("operations");
                otherGallery("finance");
            } else 
                otherGallery($type);
        
            echo "</div>";
            
            function sideMenu($type) {
                $sideMenuString = "<div class='sidebar'><ul>";
                
                $sideMenuString .= $type=="default" ? '<li class="selected"><a href="eboard.php?type=default">All</a></li>' : '<li><a href="eboard.php?type=default">All</a></li>';
                
                $sideMenuString .= $type=="presvp" ? '<li class="selected"><a href="eboard.php?type=presvp">President/VP</a></li>' : '<li><a href="eboard.php?type=presvp">President/VP</a></li>';
                
                $sideMenuString .= $type=="multimedia" ? '<li class="selected"><a href="eboard.php?type=multimedia">Multimedia</a></li>' : '<li><a href="eboard.php?type=multimedia">Multimedia</a></li>';
                
                $sideMenuString .= $type=="operations" ? '<li class="selected"><a href="eboard.php?type=operations">Operations</a></li>' : '<li><a href="eboard.php?type=operations">Operations</a></li>';
                
                $sideMenuString .= $type=="finance" ? '<li class="selected"><a href="eboard.php?type=finance">Finance</a></li>' : '<li><a href="eboard.php?type=finance">Finance</a></li>';
                
                $sideMenuString .= $type=="alumni" ? '<li class="selected"><a href="eboard.php?type=alumni">Alumni</a></li>' : '<li><a href="eboard.php?type=alumni">Alumni</a></li>';
                
                $sideMenuString .= "</ul></div>";
                echo $sideMenuString;
            }
                
            function presVPgallery() {
                echo '<h2>PRESIDENT/VICE-PRESIDENT</h2>';
                echo '<div id="gallery">';
                        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                        $result = $mysqli->query("SELECT * FROM members WHERE position LIKE '%president%'");
                        $presidentString = "";
                        $vpString = "";
                        while ($row = $result->fetch_assoc()) {
                            $position = strtolower($row['position']);
                            $file_path = "eboard/" . $row['file_path'];
                            $name = $row['name'];
                            $grad_year = "'" . substr(($row['grad_year']), 2);
                            $major = $row['major'];

                            if (strpos($position, 'vice') === false) { //PRESIDENT
                                $presidentString .= '<div class="picture">';
                                $presidentString .= "<img src='img/$file_path'>";
                                $presidentString .= "<span class='deets'>   <span>$name<br>$major$grad_year<br>President</span></span>";
                                $presidentString .=  "</div>";
                            } else { //VICE-PRESIDENT
                                $vpString .= '<div class="picture">';
                                $vpString .= "<img src='img/$file_path'>";
                                $vpString .= "<span class='deets'>   <span>$name<br>$major$grad_year<br>President</span></span>";
                                $vpString .=  "</div>";
                            }
                        }
                        echo $presidentString;
                        echo $vpString;
                    echo '</div>';
            }
       
            function otherGallery($type) {
                echo '<h2>'. strtoupper($type) . '</h2>';
                    echo '<div id="gallery">';
                        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                        $result = $mysqli->query("SELECT * FROM members WHERE position LIKE '%$type%'");

                        while ($row = $result->fetch_assoc()) {
                            $position = strtolower($row['position']);
                            $file_path = "eboard/" . $row['file_path'];
                            $name = $row['name'];
                            $grad_year = "'" . substr(($row['grad_year']), 2);
                            $major = $row['major'];

                            echo '<div class="picture">';
                                echo "<img src='img/$file_path'>";
                                $typeTitle = ucfirst($type);
                                echo "<span class='deets'><span>$name<br>$major$grad_year<br>$typeTitle</span></span>";
                            echo  "</div>";   
                        }
                echo '</div>';
            }
            
            
        ?>
        </div>
    </body>
</html>