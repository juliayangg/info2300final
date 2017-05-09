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

        <title>Login | Cornell Media and Entertainment</title>
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
        <div class='messages'>
            <?php
            if (isset($_SESSION['logged_user_by_sql'])) {
                $db_username = $_SESSION['logged_user_by_sql'];
                print("<p>Hello, $db_username. You now have the administrative authority upon this web. <p>");
                print("<p><a href='logout.php'>Logout</a><br/></p>");
            } else {
                $post_username=filter_input( INPUT_POST, 'username', FILTER_SANITIZE_STRING );
                $post_password=filter_input( INPUT_POST, 'password', FILTER_SANITIZE_STRING );
                if (empty($post_username ) || empty( $post_password ) ) {
            ?>
            <h2>Log in</h2>
            <form action="login.php" method="post">
                <p>
                    <br>Username: <input type="text" name="username"> <br><br>
                    Password: <input type="password" name="password"> <br><br>
                    <input type="submit" value="Submit">
                </p>
            </form>
            <?php
                } else {
                    require_once 'includes/config.php';
                    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                    if( $mysqli->connect_errno ) {
                        print("<p>$mysqli->connect_error<p>") ;
                        die( "Couldn't connect to database");
                    }
                    $post_username = $_POST['username'];
                    $post_password = $_POST['password'];
                
                    $query = "SELECT * FROM login WHERE username = ?";
                
                    $stmt = $mysqli->stmt_init();
                    if ($stmt->prepare($query)) {
                        $stmt->bind_param('s', $post_username);
                        $stmt->execute();
                        $result = $stmt->get_result();
                    }
                    
                    if ($result && $result->num_rows == 1) {
                        $row = $result->fetch_assoc();
                        $db_hash_password = $row['hashed_password'];

                        if( password_verify( $post_password, $db_hash_password ) ) {
                            $db_username = $row['username'];
                            $_SESSION['logged_user_by_sql'] = $db_username;
                        }
                    }
                    
                    $mysqli->close();

                    if ( isset($_SESSION['logged_user_by_sql'] ) ) {
                        echo '<script>window.location="admin.php"</script>';

                    } else {
                        echo '<p>We cannot find matching username and password you entered</p>';
                        echo '<p>Please check your input and<a href="login.php"> try again.</a></p>';
                    }
                } 
            }
            ?>
        </div>
    </body>
</html>