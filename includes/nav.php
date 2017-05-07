<div class="container">
    <a href="contact.php">Contact Us</a>
    <?php
    if (isset($_SESSION['logged_user_by_sql'])) {
        print("<div class='dropdown'>");
        print("<button class='dropbtn'><a href='admin.php'>Administration</a></button>");
        print("<div class='dropdown-content'>");
        print("<a href=uploadphoto.php>Upload Photos</a>");
        print("<a href=addalbum.php>Add Album</a>");
        print("<a href=addevent.php>Add Event</a>");
        print("<a href=addmember.php>Add Member</a>");
        print("<a href=editmember.php>Edit Member</a>");
        print("<a href=changepassword.php>Change Password</a>");
        print("<a href=createaccount.php>Create New Account</a>");
        print("</div></div>");
    }
    ?>
    <div class="dropdown">
        <button class="dropbtn"><a href="photos.php?sort=albums">Photos</a></button>
        <div class="dropdown-content">
            <a href="photos.php?sort=photos">All Photos</a>
            <a href="photos.php?sort=albums">All Albums</a>
        </div>
    </div> 
    <div class="dropdown">
        <button class="dropbtn"><a href="events.php?id=default">Events</a></button>
        <div class="dropdown-content">
        <?php
        require_once 'includes/config.php';
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($mysqli->errno) {
            print ("<h2>Error Connecting to Database</h2>");
            exit();
        }
        $info = $mysqli->query('SELECT * FROM events');
        while ($row = $info->fetch_assoc()) {
            $name = $row['name'];
            $id = $row['event_id'];
            print("<a href='events.php?id=".$id."'>".$name."</a>");
        }
        ?>
        </div>
    </div> 
    <div class="dropdown">
        <button class="dropbtn"><a href="eboard.php?type=default">Eboard</a></button>
        <div class="dropdown-content">
            <a href="eboard.php?type=presvp">President/VP</a>
            <a href="eboard.php?type=multimedia">Multimedia</a>
            <a href="eboard.php?type=operations">Operations</a>
            <a href="eboard.php?type=finance">Finance</a>
            <a href="eboard.php?type=alumni">Alumni</a>
        </div>
    </div> 
    <a href="index.php">Home</a>
</div>
<div id="logoDiv">
    <a href="index.php"><img src="img/cme.png" id="logo" alt="CME Logo" width="15%"></a>
    <h1>Cornell Media & Entertainment</h1>
    <div class="greyContainer"><a href="index.php">Cornell Media & Entertainment</a></div>
</div>