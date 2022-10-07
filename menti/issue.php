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
        $_SESSION["Date"] = $_POST['Date'];
        
        $_SESSION["agenda"] = $_POST['agenda'];
       $_SESSION["any_issue"] = $_POST['any_issue'];
       $_SESSION["Remark"] = $_POST['Remark'];
       

       $redirect = "../menti/student_meeting_view.php";



        $q = "update shedule set  
                                   agenda =\"" . $_SESSION["agenda"] . "\",
                                  any_issue =\"" . $_SESSION["any_issue"] . "\" ,
                                 Remark =\"" . $_SESSION["Remark"] . "\" 
                                  
          where usn =\"" . $_SESSION["usn"] . "\" and Date =\"" . $_SESSION["Date"] . "\" and agenda =\"" . $_SESSION["agenda"] . "\"" ;
       
        // echo $q;
        ?>
        
        <?php
        if ($link->query($q)) {
            // header("Location: ../students/student_view_details.php");
            
           header("Location: ../menti/meeting_des.php");
          
        } 
        else {
            echo "<h1>failed</h1>";
        }
    ?>
    
</body>

</html>