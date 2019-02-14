<?php
include ("config.php");



if (isset($_POST['deletebook'])) {
    $book_id = $_POST['book_id'];
    $conn = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

    // Make sure queries are in this order because of foreign key constraint.
    $query = "DELETE FROM book_author WHERE book_id =" . "$book_id";
    $res = $conn->query($query);

    $query = "DELETE FROM books WHERE books.id =" . "$book_id";
    $res = $conn->query($query);

    printf("<br>Book might be deleted! Please double check (no one is perfect).");
    printf("<br><a href=search.php>Search for more Books </a>");
    printf("<br><a href=index.php>Return to home page </a>");
    exit;
}


/*

$bookid = trim($_GET['bookid']);
echo '<INPUT type="hidden" name="bookid" value=' . $bookid . '>';

$bookid = trim($_GET['bookid']); 
$bookid = addslashes($bookid);

$conn = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

   echo "You are deleting book with the ID:"           .$bookid;



    $query = "DELETE FROM books WHERE id =" . "$bookid";
    $res = $conn->query($query);

    $query = "DELETE FROM book_author WHERE book_id =" . "$bookid";
    $res = $conn->query($query);
    printf("<br>Book Deleted!");
    printf("<br><a href=search.php>Search for more Books </a>");
    printf("<br><a href=index.php>Return to home page </a>");
    exit;
*/

    ?>