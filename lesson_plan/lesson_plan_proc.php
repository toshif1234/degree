<?php
    include("../config.php");
    include("../template/fac-auth.php");
    session_start();
    $_SESSION["sem"] = $_POST['sem'];
    $sem=$_SESSION['sem'];
    // echo $sem;
    $_SESSION["subid"] = $_POST['sub'];
    $subid=$_SESSION["subid"];
    
    $c=explode("-",$subid);
    // $subtype = mysqli_fetch_assoc($link->query('select sub_id from subjects_new where sub_code = "' . $c[0] . '"'))['sub_id'];
    $a=$c[0];

    $z=preg_split("/[A-Za-z]*/", $a);
    // echo $z[4];

    $m=$z[4];
    $_SESSION["sec"] = $_POST['sec'];
    $_SESSION['branch'] = $_POST['branch'];
    $branch=$_POST['branch'];

    $q_id = 'select * from faculty_details where faculty_name = "' . $_SESSION['username'] . '"';
    $fac_id = mysqli_fetch_assoc($link->query($q_id))['faculty_id'];
    
    $c = 'select count(*) as c from lessonpanl where sem="' . $_POST['sem'] . '" and section="' . $_POST['sec'] . '" and subid = "' . $_POST['sub'] . '" and branch = "' . $_POST['branch'] . '"';
    $res1 = mysqli_fetch_assoc($link->query($c));
    // echo gettype($sem);
    // echo $m;
    // echo $sem;
    // echo gettype($m);
    if((string)$m==(string)$sem){
    if($res1['c'] > 0){
        header("Location: display.php");
    }
    
    else{
    $total = $_POST["mod1"] + $_POST["mod2"] + $_POST["mod3"] + $_POST["mod4"] + $_POST["mod5"];
    echo $res1["c"];
    
    if($_POST["total_hour"] == $total ){
        for($i = 0;$i<$_POST["mod1"]; $i++){
            $q = 'INSERT INTO `lessonpanl`( `sem`, `subid`, `section`, `module`, `branch`) VALUES ("' . $_POST['sem'] . '","' . $_POST['sub'] . '","' . $_POST['sec'] . '","1","' . $_POST['branch'] . '")';
            // echo $q;
            $res = $link->query($q);
        }
        for($i = 0;$i<$_POST["mod2"]; $i++){
            $q = 'INSERT INTO `lessonpanl`( `sem`, `subid`, `section`, `module` , `branch`) VALUES ("' . $_POST['sem'] . '","' . $_POST['sub'] . '","' . $_POST['sec'] . '","2","' . $_POST['branch'] . '")';
            // echo $q;
            $res = $link->query($q);
        }
        for($i = 0;$i<$_POST["mod3"]; $i++){
            $q = 'INSERT INTO `lessonpanl`( `sem`, `subid`, `section`, `module`, `branch` ) VALUES ("' . $_POST['sem'] . '","' . $_POST['sub'] . '","' . $_POST['sec'] . '","3","' . $_POST['branch'] . '")';
            // echo $q;
            $res = $link->query($q);
        }
        for($i = 0;$i<$_POST["mod4"]; $i++){
            $q = 'INSERT INTO `lessonpanl`( `sem`, `subid`, `section`, `module` , `branch`) VALUES ("' . $_POST['sem'] . '","' . $_POST['sub'] . '","' . $_POST['sec'] . '","4","' . $_POST['branch'] . '")';
            // echo $q;
            $res = $link->query($q);
        }
        for($i = 0;$i<$_POST["mod5"]; $i++){
            $q = 'INSERT INTO `lessonpanl`( `sem`, `subid`, `section`, `module` , `branch`) VALUES ("' . $_POST['sem'] . '","' . $_POST['sub'] . '","' . $_POST['sec'] . '","5","' . $_POST['branch'] . '")';
            
            // echo $q;
            $res = $link->query($q);
        }
        $link->query('insert into co values("' . $fac_id . '", "' . $_SESSION["subid"] . '", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0","' . $_SESSION['branch'] . '")');
       header("Location: display.php");
        // echo 
        ?>
        
        <?php
        
    }

    else
    {
        // echo "hello";
        if($_POST["total_hour"] != $total){
            $_SESSION["lesson_done"] = "Total contact hours didn't match";
        }else{
            $_SESSION["lesson_done"] = "Lesson plan already exist";
        }
        
        header("Location: lesson_plan.php");
        // ?>
       
        <?php
    }
    }
}
else{
    $_SESSION['check_error']=1;
    header("Location: lesson_plan.php");
}

    
    
?>