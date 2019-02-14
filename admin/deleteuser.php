<?php

include ("config.php");


$userid = trim($_GET['userid']); //variable is mentioned in urlencode from users.php, this GET is basically the request from clicking that link. And here we define that variable.
echo '<INPUT type="hidden" name="userid" value=' . $userid . '>';

$userid = trim($_GET['userid']); 
$userid = addslashes($userid);

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
        printf("<br><a href=index.php>Return to home page </a>");
        exit();
    }

   echo "You are deleting user with the ID:"           .$userid;

    $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param('i', $userid);
    $stmt->execute();
    printf("<br>User Deleted!");
    printf("<br><a href=users.php>Return to user list</a>");
    printf("<br><a href=index.php>Return to home page </a>");
    exit;