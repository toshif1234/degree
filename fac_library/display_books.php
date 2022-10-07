<?php

use GuzzleHttp\Psr7\Header;

// include("../config.php");
session_start();
    $search=$_POST["search"];
    $_SESSION['search'] = $search;
    $_SESSION['flag'] = 1;

    // echo $_SESSION['search'];
    

Header("Location: books_details.php");

    ?>
