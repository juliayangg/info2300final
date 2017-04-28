<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <?php
            $style_path = 'css/styles.css';
            $version = filemtime($style_path);
            echo "<link rel='stylesheet' href='$style_path?ver=$version'>";
            
            include "nav.html";
        ?>
    </head>
    <body>
        <div class="sidebar">
            <ul>
                <li><a href="eboard.php?type=presvp">President/Vice-Presidents</a></li>
                <li><a href="eboard.php?type=multimedia">Multimedia</a></li>
                <li><a href="eboard.php?type=operations">Operations</a></li>
                <li><a href="eboard.php?type=finance">Finance</a></li>
                <li><a href="eboard.php?type=alumni">Alumni</a></li>
            </ul>
        </div>
        
        <?php
            $type = $_GET['type'];
//            echo '<div id="eboard">"';
//            switch ($type) {
//                case "presvp":
//                    echo '<img src="img/eboard/pres.jpeg">';
//                    echo '<img src="img/eboard/vp.jpg">';
//                break;
//            }
//            echo '<div>';
        ?>
        <div id="eboard">
            <img src="img/eboard/pres.jpeg">
            <img src="img/eboard/vp.jpg">
        </div>
    </body>
</html>