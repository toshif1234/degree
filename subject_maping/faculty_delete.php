<?php
session_start();
require_once '../config.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
</head>

<body>
    <?php
    $faculty_name = $_POST['faculty_name'];
    $sub_name = $_POST['sub_name'];
    $con = $link;


        $q = "delete from faculty_mapping where faculty_name = \"" . $faculty_name . "\" and sub_name = \"" . $sub_name . "\"";
        echo $q;
        // $con->query($q);
        if ($con->query($q)) {
            header("Location: faculty_view.php");
        } else {
            echo "<h1>failed</h1>";
        }
    
    ?>
</body>

</html>