<?php 
    require_once "config.php";
    session_start();
    $Date = $_POST['Date'];
    $time = $_POST['time'];
    $agenda = $_POST['agenda'];
   
    $f = 0;
    $_SESSION['view_flag'] = 1;
    $content = "meet your mentor on"." ".$_POST['Date']." "."at"." ".$_POST['time']." "."Regarding"." ".$_POST['agenda'];
    foreach($_POST["name"] as $usn)
    
    {
        //$q='INSERT INTO `mentor_mapping`(`usn`, `fac_name`,`sem`) VALUES ("' . $name . '","' . $sub . '","' . $sem . '")';
        $q='INSERT INTO `shedule`(`usn`, `Date`,`time`,`agenda`) VALUES ("' . $usn . '","' . $Date . '","' . $time . '","' . $agenda . '")';
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
         //extra  s
        $p= $q='INSERT INTO `notification`(`usn`, `subject`,`content`, `end_date`) VALUES ("' . $usn . '","' . $agenda . '","' . $content . '","' . $Date . '")';
         
        try{
            $con->query($p);
            
        }
        catch(Exception $e){
            
           
            $f = 1;
            break;
        }
        //end extra
    }
    if($f){
        $_SESSION['success'] = 0;
    }else{
        $_SESSION['success'] = 1;
    }
        header("Location: student_Shselect.php");
    // }else{
    // header("Location: drop_view_dis.php");
    
?>