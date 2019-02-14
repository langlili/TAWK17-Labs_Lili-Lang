<?php
@ob_start();
session_start();

//Session data gets stored on the server. Sessions use a cookie as a key of sorts, to associate with the data that is stored on the server side.
//It is preferred to use sessions because the actual values are hidden from the client
//If it was all based on cookies, a user (or hacker) could manipulate their cookie data and then play requests to your site.
//Sessions for short term, cookies for long term. Sessions last until closing browser


// session_start();
// if (!isset($_SESSION['variable']))

// conditions to be fulfilled {  $_SESSION['variable]  } maybe equal it to whatever we found out, then redirection perhaps, with header(location)

// session_destroy();    -----> destroys all sessions
// unset($_SESSION['name']);            --------> delete specific session

?>
<html>
    <head>
        <title>Counting with the SESSION array</title>
    </head>
    <body>
        <FORM action="session.php" method="GET">
            <INPUT type="submit" name="Count" value="Count">
            <?php
            session_start();
            if (!isset($_SESSION['counter']))
                $count = 0;
            else
                $count = $_SESSION['counter'];
            $count = $count + 1;
            $_SESSION['counter'] = $count;
            echo "count is $count";
            ?>
        </FORM>

    </body>
</html>

