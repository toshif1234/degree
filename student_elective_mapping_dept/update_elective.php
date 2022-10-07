<?php 
    require_once "config.php";
    // session_start();
    $fac = $_POST['fac'];
    $f = 0;
    $_SESSION['view_flag'] = 1;
    foreach($_POST["name"] as $name)
    {
        $q='INSERT INTO `fac_elec_stud`(`faculty_name`, `usn`, `sub`) VALUES ("' . $fac . '","' . $name . '", "' . $_SESSION['sub'] . '")';
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
        header("Location: display_students.php");
    // }else{
    // header("Location: drop_view_dis.php");
