<?php
//I have to prepare security for session hijacking and present the functionality verbally

//We want people to approach session through http (secure connection), not f.ex JS (because of cross-side scripting)
ini_set('session.cookie_httponly', true); //set value of configuration setting: string's var name, string's new value
session_start();

//We also want to check whether the user's IP address is the same as the one stored on the server for that session (id)
//As such, we want to store the IP of the user and later check the IP of the user

if(isset($_SESSION['userip']) === false) {//If user IP is not set...
    $_SESSION['userip'] = $_SERVER['REMOTE_ADDR']; //We set it (to the remote address from server, in other words, we set the IP to equal the IP)
} //What we did: If no session for this IP, create one.

if($_SESSION['userip'] !== $_SERVER['REMOTE_ADDR']) { //If the stored user IP doesn't equal the one of current user (someone trying to steal session)
    session_unset(); //destroys a particular session variable
    session_destroy(); //destroys all the session data for that user
}

?>

<?php
//Your forms should always be protected from XSS attacks.
//If you have comments for an example, you need to prevent people from putting executable code in the comment input field.
//Otherwise someone can for an example put in html tags for creating an iframe of a website and then the whole comments page will become a copy of another webpage
//Then you wouldn't be able to use the website as the iframe takes up the whole screen.

//To prevent this we add html entities and string escaping, example:

$comment = htmlentities($comment);
$comment = mysqli_real_escape_string($db, $comment);
?>