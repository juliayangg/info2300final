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

        <title>Contact Us | Cornell Media and Entertainment</title>
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
        <div class="contacts">
            <h2>Contact CME</h2>
            <h3>Intersted in getting in touch? Contact Us Below</h3>
            <p><a href="mailto:cornellcme@gmail.com" style="color:black;">cornellcme@gmail.com</a></p>
            <p><a href="https://goo.gl/forms/6hVFfiRbejRNLgXu1" target="_blank">Click here to apply</a></p>
            
            <br>
            <h3>Find Us on Campus</h3>
            <p>Room 144, Goldwin Smith Hall, Cornell</p>
            
            <div id="map">
                <script>
                    function initMap() {
                        var uluru = {lat: 42.449073, lng: -76.483534}; 
                        var map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 10,
                            center: uluru
                        });
                        var marker = new google.maps.Marker({
                            position: uluru,
                            map: map
                        });
                    }
                </script>
                <script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUqsDzgr-h1h38AIhFKSLY4xyNMBuRDDc&callback=initMap">
                </script>
            </div>
        </div>
  </body>
</html>