<?php
include("config.php");
$title = "Add new book";
include("header.php");
include('adminfunctions.php');

	session_start();
	if(isset($_SESSION['username'])) {
		if(!isUserAdmin($_SESSION['username'])) {
			header("location: login.php");
		}
	  } else {
		header("location: login.php");
	  }

?>
<head>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>


<?php

$conn = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

if (isset($_POST) && isset($_POST['add_book'])) {

    $title = htmlspecialchars($_POST['title']);
    $pagenr = htmlspecialchars($_POST['pagenr']);
    $publisher = htmlspecialchars($_POST['publisher']);
    $pub_year = htmlspecialchars($_POST['pubdate']);
    $ed_nr = htmlspecialchars($_POST['edition']);
    $author_id = $_POST['authors'];

    #Form input into book table
    $book_query = "INSERT INTO books (title, no_pages, pub_name, pub_year, ed_nr) VALUES ('$title', '$pagenr', '$publisher', '$pub_year', '$ed_nr')";
    
    $book_res = $conn->query($book_query);

    #ID's into book_author table
    $book_id = $conn->insert_id;

    $middle_query = "INSERT INTO book_author (book_id, author_id) VALUES ('$book_id', '$author_id')";

    $middle_res = $conn->query($middle_query);


    printf("<br>Book Added!");
    printf("<br><a href=index.php>Return to home page </a>");
    exit;
}


?>

<h3>Add a new book</h3>
<hr>
<p><em>You must enter both a title and an author</em></p>
<form action="addbooks.php" method="POST" id="addbook" name="addbook">
    <div class="form_group">
        <label>Title</label> <br>
        <input type="text" id="title" name="title" placeholder="Title of book">
    </div>
    <div class="form_group">
        <label>Author</label> <br>
       
            <?php /* echo generateAuthorOptions(); */ 

                $conn = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
                
                    $result = $conn->query("SELECT authors.id id, authors.f_name first_name, authors.l_name last_name FROM authors");

                    echo "<select name='authors'>";
                
                    while ($row = $result->fetch_assoc()) {
                              
                                $id = $row['id'];
                                $name = $row['first_name'] . " " . $row['last_name']; 
                                echo '<option value="'.$id.'">'.$name.'</option>';
                                
                }
                
                    echo "</select>";
            ?>
    </div>

    <div class="form_group">
        <label>Page Number</label> <br>
        <input type="text" id="pagenr" name="pagenr" placeholder="Number of pages">
    </div>

    <div class="form_group">
        <label>Publisher</label> <br>
        <input type="text" id="publisher" name="publisher" placeholder="Name of publisher">
    </div>

    <div class="form_group">
        <label>Publication Date (year) </label> <br>
        <input type="text" id="pub_date" name="pubdate" placeholder="XXXX">
    </div>

    <div class="form_group">
        <label>Edition Number</label> <br>
        <input type="text" id="ed_nr" name="edition" placeholder="1, 2, etc...">
    </div>

    <div class="form_group">
        <input class="btn" type="submit" name="add_book" value="Add">
    </div>
</form>
<?php include("footer.php"); ?>