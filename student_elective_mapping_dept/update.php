<?php 
    require_once "config.php";
    // session_start();
    $sub = $_POST['elective'];
    $f = 0;
    $_SESSION['view_flag'] = 1;
    foreach($_POST["name"] as $name)
    {
    $q = 'INSERT INTO `elective_maping`(`usn`, `sub_name`, `branch`) VALUES ("' . $name . '","' . $sub . '", "' . $_SESSION['dept'] . '")';

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