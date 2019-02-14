<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
@ob_start();
session_start();

//Cookies store directly on the client
//Expiration can be set, last until the set date/time

// session_start();
// if (isset($_COOKIE['varname']))
// setcookie('varname', $value, time(), 'domain', httponly?)   ---> this is what actually creates a cookie, not the session (the session uses a cookie)
// setcookie(name, value, time) is the simplified parameters

//$timeout = time()-86400    -------> unset cookie by resetting with exp time in the past
// setcookie('varname', '$timeout');

if (isset($_COOKIE['counter']))
    $count = $_COOKIE['counter'];
else
    $count = 0;
$count = $count + 1;
setcookie('counter', $count, time() + 24 * 3600, '/', 'localhost', false);
?>
<html>
    <head>
        <title>Counting with a cookie</title>
    </head>
    <body>
        <FORM action="cookie.php" method="GET">
            <INPUT type="submit" name="Count" value="Count">
            <?php
            echo "count is $count";
            ?>
        </FORM>
    </body>
</html>
