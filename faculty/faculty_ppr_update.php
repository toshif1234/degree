<?php
require_once '../config.php';
$con = $link;
    session_start();
    //paper presentation details
    $paper_id = $_POST["paper_id"];
    $faculty_id = $_POST['faculty_id'];
    $faculty_ppr_type = $_POST['faculty_ppr_type'];
    $faculty_ppr_year= $_POST['faculty_ppr_year'];
    $faculty_ppr_title = $_POST['faculty_ppr_title'];
    $faculty_ppr_jourrnal = $_POST['faculty_ppr_jourrnal'];
    $faculty_ppr_pub_date = $_POST['faculty_ppr_pub_date'];
    $faculty_ppr_volume = $_POST['faculty_ppr_volume'];
    $faculty_ppr_issue = $_POST['faculty_ppr_issue'];
    $faculty_ppr_issn = $_POST['faculty_ppr_issn'];




    $q4 = "update faculty_ppr_details  set faculty_ppr_type=\"" . $faculty_ppr_type . "\",
         faculty_ppr_year = \"" . $faculty_ppr_year . "\",
         faculty_ppr_title=\"" . $faculty_ppr_title . "\",
         faculty_ppr_jourrnal= \"" . $faculty_ppr_jourrnal . "\",
         faculty_ppr_pub_date= \"" . $faculty_ppr_pub_date . "\",
         faculty_ppr_volume=\"" . $faculty_ppr_volume . "\",
         faculty_ppr_issue= \"" . $faculty_ppr_issue . "\", 
         faculty_ppr_issn= \"" . $faculty_ppr_issn . "\"  WHERE  faculty_id = \"" . $faculty_id . " \" and paper_id = $paper_id ";
    


echo $q4;




    if ($r = $con->query($q4)) {
        header("Location:faculty_view_details.php");
    } else {
        echo "ppr Details Not Recorded";
    }

?>