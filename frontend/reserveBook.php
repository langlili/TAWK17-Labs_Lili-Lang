<?php

include ("config.php");


$bookid = trim($_GET['bookid']);
echo '<INPUT type="hidden" name="bookid" value=' . $bookid . '>';

$bookid = trim($_GET['bookid']); 
$bookid = addslashes($bookid);

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
        printf("<br><a href=index.php>Return to home page </a>");
        exit();
    }

   echo "You are reserving book with the ID:"           .$bookid;

    $stmt = $db->prepare("UPDATE books SET onloan=1 WHERE id = ?");
    $stmt->bind_param('i', $bookid);
    $stmt->execute();
    printf("<br>Book Reserved!");
    printf("<br><a href=search.php>Search for more Books </a>");
    printf("<br><a href=mybooks.php>Show my reserved Books </a>");
    printf("<br><a href=index.php>Return to home page </a>");
    exit;
