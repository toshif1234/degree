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
    $adm_no = $_POST['usn'];
    $con = $link;
        $q = "delete from mentor_mapping where usn = \"" . $_POST["usn"] . "\"" ;
        if ($con->query($q)) {
            header("Location: ../mentor/mentor_select_dis.php");
        } else {
            echo "<h1>failed</h1>";
        }
    
    ?>
</body>

</html>