<?php

    include('header.php');
    include('config.php');


$searchtitle = "";
$searchauthor = "";

if (isset($_POST) && !empty($_POST)) {
# Get data from form
    $searchtitle = trim($_POST['searchtitle']);
    $searchauthor = trim($_POST['searchauthor']);
}


// adding html entities
$searchtitle = htmlentities($searchtitle);
$searchauthor = htmlentities($searchauthor);


//  if (!$searchtitle && !$searchauthor) {
//    echo "You must specify either a title or an author";
//    exit();
//  }

$searchtitle = addslashes($searchtitle);
$searchauthor = addslashes($searchauthor);

//To search through fname and lname from authors table - issue: if type only last name, no result
$parts = explode(" ", $searchauthor);
$fname = $parts[0];
$lname = $parts[1]; 

# Open the database - these variables are defined in the config file.
@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    printf("<br><a href=index.php>Return to home page </a>");
    exit();
}

$query = "SELECT books.id, books.title, authors.F_name, authors.L_name, books.onloan FROM books 
            JOIN book_author ON book_author.book_id = books.id
            JOIN authors ON book_author.author_id = authors.id";


if ($searchtitle && !$searchauthor) { // Title search only
    $query = $query . " where title like '%" . $searchtitle . "%'";
}
if (!$searchtitle && $searchauthor) { // Author search only
    $query = $query . " where F_name like '%" . $fname . "%' and L_name like '%" . $lname . "%'"; //Using author table (fname and lname)
}
if ($searchtitle && $searchauthor) { // Title and Author search
    $query = $query . " where title like '%" . $searchtitle . "%' and F_name like '%" . $fname . "%'"; // uses books author (only fname)
}

# Here's the query using bound result parameters
    // echo "we are now using bound result parameters <br/>";
    $stmt = $db->prepare($query); /* Pepares above query statement so that it is understandable/readable for the php guy: Basically "I want to use this format, please prepare it so you can read it lel" - this can return false which fucks up the below stmt, and often the problem lies in the names not being right.*/
    $stmt->bind_result($bookid, $title, $auth_fname, $auth_lname, $onloan); /* Whatever we put in the query statement above (where we select variables from a table), we have to assign to something, which we do here. So in bind results we create the variabes, hence the $symbol, whereas in the select query we just mention the variable name, undeclared. So it is dependent on this part to actually exist. 

    Basically, out of the query we are going to get results in the form of columns from the database, but it has to go somewhere, so this statement binds those results to be executable, by assigning the results a variable so they exist outside the database, in a way. So you're telling it to take the SQL data and copy it to php code, so we have it somewhere and can reuse it later on, as seen when we echo out the table with the data inside the variables. 

    It is important to remember that the variables need to be declared in the same order, and the same number, that you mention them in the query, or the code does not know what you are assigning to what. So if you mention 3 variables, you have to declare 3 variables, and they need to be in the same order. */

    $stmt->execute(); /* Here the above is done. Basically these 3 statements say to fetch, store and then be done. "Prepare the DB guy to go fetch the data from SQL through the query and then store it to PHP". */

    echo '<table bgcolor="#dddddd" cellpadding="6">';
    echo '<tr> <td><b>ID</b></td> <td><b>Title</b></td> <td><b>Author</b></td> <td><b>Reserved</b></td> </b> </tr>';
    while ($stmt->fetch()) { //Fetches results from prepared statement - all the data/results go inside while loop. 
        if($onloan == 0) {
            $onloan = 'NO';
            echo "<tr>";
            echo "<td> $bookid </td> <td> $title </td><td> $auth_fname $auth_lname </td> <td> $onloan </td>";
            echo '<td><a href="reserveBook.php?bookid=' . urlencode($bookid) . '"> Reserve </a></td>';
            echo "</tr>";
        } else {
            $onloan = 'YES';
            echo "<tr>";
            echo "<td> $bookid </td> <td> $title </td><td> $auth_fname $auth_lname </td> <td> $onloan </td>";
            echo '<td><a href="returnBook.php?bookid=' . urlencode($bookid) . '"> Return </a></td>';
            echo "</tr>";
        }
    }
    echo "</table>";


?>

<h3>Search our Book Catalog</h3>
<hr>
You may search by title, or by author, or both<br>
<form action="search.php" method="POST">
    <table bgcolor="#bdc0ff" cellpadding="6">
        <tbody>
            <tr>
                <td>Title:</td>
                <td><INPUT type="text" name="searchtitle"></td>
            </tr>
            <tr>
                <td>Author:</td>
                <td><INPUT type="text" name="searchauthor"></td>
            </tr>
            <tr>
                <td></td>
                <td><INPUT type="submit" name="submit" value="Submit"></td>
            </tr>
        </tbody>
    </table>
</form>

    <?php include('footer.php'); ?>