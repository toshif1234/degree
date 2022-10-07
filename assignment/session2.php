<?php
session_start();
require_once '../config.php';
$_SESSION['assignment_no'] = $_POST['assignment_no'];
$_SESSION['semester'] = $_POST['semester'];
$_SESSION['branch'] = $_POST['branch'];
$_SESSION['section'] = $_POST['section'];
$found = 0;

// echo $_POST['semester'];
// echo $_POST['section'];

$qry = "select * from add_assignment where assignment_no = '".$_SESSION['assignment_no']."' and semester = '".$_SESSION['semester']."' and branch = '".$_SESSION['branch']."' and section = '".$_SESSION['section']."'";
$result = $link->query($qry);
foreach($result as $row)
{
    if($row['assignment_no'] == $_SESSION['assignment_no'] && $row['semester'] == $_SESSION['semester'] && $row['branch'] == $_SESSION['branch'] && $row['section'] == $_SESSION['section'] && $row['fac_name'] == $_SESSION['username'])
    {
        $found = 1;
        break;
    }
    
}
if($found == 1)
{
    header("Location: ../assignment/fac_assign_marks_lastpage.php");
}
else{
    $_SESSION['assignment_error'] = "error";
    header("Location: ../assignment/assign_marks.php");
}

 

?>
