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
        add_versioned_file( 'css/styles.css', 'Style' );
        ?>
    </head>
    <body>
    <?php include 'includes/nav.php';?>
    <?php
        if (isset($_GET['type'])){
            $type = $_GET['type'];
        }else{
            $type = "default";
        }
        
        
        sideMenu($type);
        
        echo "<div class='content'>";
        if ($type == "presvp"){
            presVPgallery();
        }else if ($type == "default") {
            presVPgallery();
            otherGallery("multimedia");
            otherGallery("operations");
            otherGallery("finance");
        } else if ($type == "alumni"){
            alumGallery();
        }else{
            otherGallery($type);
        }
        
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
            echo '<div class="gallery">';
            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $result = $mysqli->query("SELECT * FROM members WHERE position LIKE '%president%' AND active = 1");
            $presidentString = "";
            $vpString = "";
            while ($row = $result->fetch_assoc()) {
                $position = strtolower($row['position']);
                $file_path = $row['file_path'];
                $name = $row['name'];
                $grad_year = "'" . substr(($row['grad_year']), 2);
                $major = $row['major'];
                
                if (strpos($position, 'vice') === false) { //PRESIDENT
                    $presidentString .= '<div class="picture">';
                    $presidentString .= "<img src='img/$file_path' alt='$name'>";
                    $presidentString .= "<span class='deets'>   <span>$name<br><br>$major&nbsp;$grad_year<br><br>President</span></span>";
                    $presidentString .=  "</div>";
                } else { //VICE-PRESIDENT
                    $vpString .= '<div class="picture">';
                    $vpString .= "<img src='img/$file_path' alt='$name'>";
                    $vpString .= "<span class='deets'>   <span>$name<br><br>$major&nbsp;$grad_year<br><br>Vice-President</span></span>";
                    $vpString .=  "</div>";
                }
            }
            echo $presidentString;
            echo $vpString;
            echo '</div>';
        }
       
        function otherGallery($type) {
            echo '<h2>'. strtoupper($type) . '</h2>';
            echo '<div class="gallery">';
            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $result = $mysqli->query("SELECT * FROM members WHERE position LIKE '%$type%' AND active = 1");
            while ($row = $result->fetch_assoc()) {
                $position = strtolower($row['position']);
                $file_path = $row['file_path'];
                $name = $row['name'];
                $grad_year = "'" . substr(($row['grad_year']), 2);
                $major = $row['major'];
                
                echo '<div class="picture">';
                echo "<img src='img/$file_path' alt='$name'>";
                $typeTitle = ucfirst($type);
                echo "<span class='deets'><span>$name<br><br>$major&nbsp;$grad_year<br><br>$typeTitle</span></span>";
                echo  "</div>"; 
            }
            echo '</div>';
        }
            
        function alumGallery() {
            echo '<h2>ALUMNI MEMBERS</h2>'; 
            echo '<div class="gallery">';
            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $result = $mysqli->query("SELECT * FROM members WHERE active = 0");
            
            while ($row = $result->fetch_assoc()) {
                $position = strtolower($row['position']);
                $file_path = $row['file_path'];
                $name = $row['name'];
                $grad_year = "'" . substr(($row['grad_year']), 2);
                $major = $row['major'];
                
                echo '<div class="picture">';
                echo "<img src='img/$file_path' alt='$name'>";
                echo "<span class='deets'><span>$name<br><br>$major&nbsp;$grad_year<br><br>Alumni</span></span>";
                echo  "</div>";   
            }
            echo '</div>';
        }
        ?>
    </body>
</html>