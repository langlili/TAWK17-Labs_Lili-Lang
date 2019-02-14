<?php
include('config.php');


function isUserAdmin($username) {
    
    $conn = new mysqli('localhost', 'root', '', 'redoinglabs');

    $query = "SELECT administrator FROM users WHERE username='$username'";
    $res = $conn->query($query);
    if (!$res) {
        die("query error");
    }

    $usertype = $res->fetch_assoc()["administrator"];
    if ($usertype == 0) {
        return false;
    }

    return true;
}
/*

function getAllAuthors() { // Go to database, give me author ID, etc, put it all into one query and push it into an array 

    $conn = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

    $query = "SELECT authors.ID, authors.F_name, authors.L_name FROM authors";

   $res = $conn->query($query);

    if (!$res) {
        die("Query Error: ??");
    }
    $data = array();

    while ($row = $res->fetch_assoc()) {
        array_push($data, $row);
    }
    $conn->close();
    return $data;
}


function generateAuthorOptions($authors=null) { // I have it all in an array, I say "for that array in authors, I want to list out each one of them; Each index in the authors array will be an author and for each author we name properties (assign properties to variables which we use in our html tags). Each one of them is going to be an option with an id in the background - id can't be seen, name is seen, but the id is the real option (value). 
    if (is_null($authors)) {
        $authors = getAllAuthors();
    }
    $html='';
    foreach ($authors as $index => $author) {
        $author_id = $author['id'];
        $author_name = $author['first_name'] . " " . $author['last_name']; 

        $html .= '<option value="' . $author_id . '">';
        $html .= $author_name . '</option>';
    }
    return $html;
}

*/

?>