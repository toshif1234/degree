<?php
session_start();
error_reporting(0);
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
    $adm_no = $_POST['adm_no'];
    $con = $link;
        $q = "delete from students where adm_no = \"" . $_SESSION['adm_no'] . "\"";
        if ($con->query($q)) {
            header("Location: ../admin_dashboard.php");
        } else {
            echo "<h1>failed</h1>";
        }
    
    ?>
</body>

</html>