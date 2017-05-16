<?php
	session_start();
	
	if (isset($_SESSION['logged_user_by_sql'])) {
		$olduser = $_SESSION['logged_user_by_sql'];
		unset($_SESSION['logged_user_by_sql']);
	} else {
		$olduser = false;
	}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Logout | Cornell Media and Entertainment</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <?php 
        require_once "includes/functions.php";
        add_versioned_file( 'css/styles.css', 'Style' );
        ?>
    </head>
    <body>   
        <?php include 'includes/nav.php';?>
        <div class="messages">
            <?php
            if ( $olduser ) {
                print("<p>Thanks for using our page, $olduser!</p>");
                print("<p>Return to our <a href='login.php'>login page</a>.</p>");
            } else {
                print("<p>You haven't logged in.</p>");
                print("<p>Go to our <a href='login.php'>login page</a>.</p>");
            }
            ?>
        </div>
    </body>
</html>