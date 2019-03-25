
<html>
<head>
    <title>Welcome</title>
</head>
<body>
<?php
    include("loginserv.php");
    $user = $_SESSION['class'];
    $conn = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($conn, "login");
    //sql query to fetch information of registered user and find user match.
    $id = $user->getID();
    $query2 = mysqli_query($conn, "SELECT * FROM friends WHERE userid='$id'");
?>
<h1>Welcome </h1>
<p>Login Succesful</p>
<h2>
    <?php

    print "Friends: ";
    while ($row = mysqli_fetch_assoc($query2)){
        print $row['name'] . " ";
    }
    session_abort();
    ?>
</h2>
</body>
</html>
