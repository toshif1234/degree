<?php 
    require_once "config.php";
    session_start();
    $_SESSION["sub"] = $_POST['sub'];
        
        $_SESSION["usn"] = $_POST['usn'];
        
        $_SESSION["id"] = $_POST['id'];
   
    $f = 0;
   
    
    if (is_array($_SESSION["usn"]) || is_object($_SESSION["usn"]))
{
    foreach($_SESSION["usn"] as $usn)
    
    {
        

        $q = "update nodue set  
        due =\"" . $_SESSION["id"] . "\"
        
       
              where usn =\"" .$usn. "\" and subj =\"" . $_SESSION["sub"] . "\"" ;

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
        
     
        }    //end extra
    }
    if($f){
        $_SESSION['success'] = 0;
        header("Location: nodue.php");
    }else{
        $_SESSION['success'] = 1;
        echo "failed";
    }
       

    
       
    
    
?>