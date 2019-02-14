<?php

// $books = array("keyname" => "element", "keyname" => "element");

// $books = array();
// $books [] = array("title" => "", "author" => "");      ------> for multiple 

// array_search($needle, $haystack);

// array_search($searchtitle, array_column($books, 'title'));


$books = array();
$books [] = array("title" => "The Kite Runner", "author" => "Khaled Hosseini");
$books [] = array("title" => "Number the Stars", "author" => "Lois Lowry");
$books [] = array("title" => "Pride and Prejudice", "author" => "Jane Austen");
$books [] = array("title" => "Little Women", "author" => "Louisa May Alcott");

?>

<form action="BrowseBooks.php" method="GET">
	<table cellpadding="6">
		<tbody>
		    <tr>
                <td>Search by Title:</td>
			        <td><input type="text" name="searchtitle" placeholder="Search by Title.."></td>
			</tr>

			<tr>
			    <td>Search By Author:</td>
				    <td><input type="text" name="searchauthor" placeholder="Search by Author.."></td>
			</tr>

			<tr>
			<td></td>
			<td><input type="submit" name="submit" value="Submit"></td>
			</tr>
		</tbody>
	</table>
</form>



<?php

if (isset($_GET) && !empty($_GET)) {

    $searchtitle = trim($_GET['searchtitle']); //Stores input in variable

    $searchauthor = trim($_GET['searchauthor']);


    $searchtitle = addslashes($searchtitle);

    $searchauthor = addslashes($searchauthor);


    $id = array_search($searchtitle, array_column($books, 'title')); //array_search searches array for given value, array_column returns value from single column
    //Search for title input among titles in books array
    $auth = array_search($searchauthor, array_column($books, 'author'));


    echo '<table cellpadding="6">';
    echo '<tr><b><td>Title</td> <td>Author</td> <td>Reserve</td> </b> </tr>';

    if ($id !== FALSE) { // If $id (array search by title) returned something, ie not false
        $book = $books[$id];
        $title = $book['title'];
        $author = $book['author'];
        echo "<tr>";
        echo "<td> $title </td><td> $author </td>";
        echo '<td><a href="reserve.php?reservation=' .  urlencode($title) . '"> Reserve </a></td>';
        echo "</tr>";
    } else if ($auth !== FALSE) {
        $book = $books[$auth];
        $title = $book['title'];
        $author = $book['author'];
        echo "<tr>";
        echo "<td> $title </td><td> $author </td>";
        echo '<td><a href="reserve.php?reservation=' .  urlencode($author) . '"> Reserve </a></td>';
        echo "</tr>";
    }
    echo "</table>";

}




else

{
echo '<table cellpadding="6">';
echo '<tr><b><td>Title</td> <td>Author</td> <td>Reserve</td> </b> </tr>';
//prints the books one by one
foreach ($books as $book) { //for each element in books array...
    $title = $book['title']; //title equals the title of that element, etc
    $author = $book['author'];
    echo "<tr>";
    echo "<td> $title </td><td> $author </td>";
    echo '<td><a href="reserve.php?reservation=' . urlencode($title) . '"> Reserve </a></td>';
    echo "</tr>";
}
echo "</table>";
}

?>