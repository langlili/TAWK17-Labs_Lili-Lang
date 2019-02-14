<?php

include('config.php');
//The login makes use of SQL injections
//SQL injection works by interfering with the input by messing with the username part so that the password doesn't even check
//Basically commenting out the password through the username field
//To counter this we use mysqli_real_escape_string

session_start(); //Starts session
if(isset($_SESSION['username'])) {
        header("location: index.php");
        exit();
  }
@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname); //connecting to db

if(isset($_POST['username'], $_POST['userpass'])){ //checking for input

  $uname = mysqli_real_escape_string($db, $_POST['username']); //prevents commenting out input (escaping special characters) - has to connect to db to add slashes (escape) for some reason
  $upass = sha1($_POST['userpass']); //hashing the inputted password 

  echo $uname;
  echo "</br>";
  echo $upass;

  $query = ("SELECT * FROM users WHERE username = '{$uname}' "." AND userpass = '{$upass}'");

  $stmt = $db->prepare($query);
  $stmt->bind_result($userid, $username, $userpass, $usertype);
  $stmt->execute();
  $stmt->store_result();


  $totalcount = $stmt->num_rows(); //Total count = the number of rows (1 or 0) we got back from the statement (number of matching users)

}

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Labs</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
      <?php //Check usertype
        if(isset($totalcount)){ //If all the password checking has executed (which means the totalcount is set)
            if($totalcount == 0){ //If no matching user
                echo "Username or password is incorrect, or you don't have rights to access this page";
            } else{
                $_SESSION['username'] = $uname;
                header("location: index.php");
                exit();
            }
        }
       ?>

            <form method="POST" action="">
                <input type="text" name="username">
                <input type="password" name="userpass">
                <input type="submit" value="Go">
            </form>

        <?php include("footer.php"); ?>

    </body>
</html>