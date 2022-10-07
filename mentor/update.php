<?php 
    require_once "config.php";
    session_start();
    $sub = $_POST['elective'];
   
    $f = 0;
    $_SESSION['view_flag'] = 1;
    foreach($_POST["name"] as $name)
    {
        //$q='INSERT INTO `mentor_mapping`(`usn`, `fac_name`,`sem`) VALUES ("' . $name . '","' . $sub . '","' . $sem . '")';
        $q='INSERT INTO `mentor_mapping`(`fac_name`, `usn`) VALUES ("' . $sub . '","' . $name . '")';
        // echo $q;n
        try{
            $con->query($q);
            // echo "here";
        }
        catch(Exception $e){
            
            // echo $e;
            // echo '1';
            $f = 1;
            break;
        }
    }
    if($f){
        $_SESSION['success'] = 0;
    }else{
        $_SESSION['success'] = 1;
    }
        header("Location: show_students_dis.php");
    // }else{
    // header("Location: drop_view_dis.php");
    
?>