<?php
    session_start();
    session_destroy();
    header("location:../Frontend/index.php");
?>