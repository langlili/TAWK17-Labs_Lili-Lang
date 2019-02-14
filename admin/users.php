<?php
include("config.php");
$title = "Add new user";
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
@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    printf("<br><a href=index.php>Return to home page </a>");
    exit();
}

$query = " SELECT id, username FROM users ";

$stmt = $db->prepare($query);
$stmt->bind_result($userid, $username);
$stmt->execute();

echo '<table bgcolor="#dddddd" cellpadding="6">';
echo '<tr> <td><b>ID</b></td> <td><b>Username</b></td> <td><b>Delete?</b></td></b> </tr>';
while ($stmt->fetch()) { //Fetches results from prepared statement - all the data/results go inside while loop. 
        echo "<tr>";
        echo "<td> $userid </td> <td> $username </td>";
        echo '<td><a href="deleteuser.php?userid=' . urlencode($userid) . '"> Delete </a></td>';
        echo "</tr>";
}
echo "</table>";



if (isset($_POST['newusername'])) {

    $newusername = trim($_POST['newusername']);
    $newuserpass = trim($_POST['newuserpass']);

    if (isset($_POST['usertype'])) {
        $usertype = $_POST['usertype'];
    } else {
        $usertype = 0;
    }


    if (!$newusername || !$newuserpass) {
        printf("You must must give the user a name and a password first");
        printf("<br><a href=index.php>Return to home page </a>");
        exit();
    }

    $newusername = addslashes($newusername);
    $newuserpass = addslashes($newuserpass);
    $newuserpass = sha1($newuserpass);

    # Open the database using the "librarian" account
@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
        printf("<br><a href=index.php>Return to home page </a>");
        exit();
    }

    $query = "INSERT INTO users (username, userpass, administrator) VALUES (?, ?, ?)";


    $stmt = $db->prepare($query);
    $stmt->bind_param('sss', $newusername, $newuserpass, $usertype);
    $stmt->execute();
    printf("<br>User Created!");
    printf("<br><a href=index.php>Return to home page </a>");
    exit;
}

?>

<h3>Create a new user</h3>
<hr>
<form action="users.php" method="POST">
    <table bgcolor="#bdc0ff" cellpadding="6">
        <tbody>
            <tr>
                <td>Username:</td>
                <td><INPUT type="text" name="newusername"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><INPUT type="text" name="newuserpass"></td>
            </tr>
            <tr>
            <tr>
                <td>Admin?:</td>
                <td><input type="checkbox" name="usertype" value="1"></td>
            </tr>
                <td></td>
                <td><INPUT type="submit" name="submit" value="Create"></td>
            </tr>
        </tbody>
    </table>
</form>
<?php include("footer.php"); ?>