<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Fields</title>
</head>

<body>
    <?php
    
    require_once '../config.php';

        session_start();
       

       
        
        $_SESSION["usn"] = $_POST['usn'];
        
        $_SESSION["id"] = $_POST['id'];
      
       
       
       
        $S="MENTOR";

    //    $q='INSERT INTO `nodue`(`usn`, `sub`,`due`) VALUES ("' . $_SESSION["usn"] . '","' . $_SESSION["sub"] . '","' . $_SESSION["id"] . '")';
    //$q='INSERT INTO `nodue`(`usn`, `subj`,`DUE`) VALUES ("' . $_SESSION["usn"] . '","' . $_SESSION["sub"] . '","' . $_SESSION["id"] . '")';
        
       $p = "update nodue set  
                                   due =\"" . $_SESSION["id"] . "\"
                                   
                                  
          where usn =\"" . $_SESSION["usn"] . "\" and subj =\"" . $S . "\"" ;
       
        // echo $q;
        ?>


        
        
         <?php
        if ($link->query($p) ) {
            // header("Location: ../students/student_view_details.php");
            
           header("Location: student_view_details.php");
          
        } 
        else {
            echo "<h1>failed</h1>";
        }
    ?> 


    
</body>

</html>