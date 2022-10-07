<?php
    require_once '../config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrive the Data</title>
</head>

<body>

    <?php

      $con =  $link;

            $faculty_id=$_POST['faculty_id'];
            

           

            $q="delete from faculty_details where faculty_id=\"" . $faculty_id . "\"";

            
            

            
             if($r = $con->query($q))
             {
               header("Location: faculty_view_details.php");
             }
             else
             {
                 echo "Record is not deleted";
             }

    
    ?>
    
</body>


                                                     




</html>