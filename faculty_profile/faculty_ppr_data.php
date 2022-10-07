 <?php
    require_once '../config.php';
    $con =  $link;
        session_start();
        //paper presentation details
            $_SESSION["faculty_id"] = $_POST['faculty_id'];
            $_SESSION["faculty_ppr_type"] = $_POST['faculty_ppr_type'];
            $_SESSION["faculty_ppr_year"] = $_POST['faculty_ppr_year'];
            $_SESSION["faculty_ppr_title"] = $_POST['faculty_ppr_title'];
            $_SESSION["faculty_ppr_jourrnal"] = $_POST['faculty_ppr_jourrnal'];
            $_SESSION["faculty_ppr_pub_date"] = $_POST['faculty_ppr_pub_date'];
            $_SESSION["faculty_ppr_volume"] = $_POST['faculty_ppr_volume'];
            $_SESSION["faculty_ppr_issue"] = $_POST['faculty_ppr_issue'];
            $_SESSION["faculty_ppr_issn"] = $_POST['faculty_ppr_issn'];
        



            $q4 = "insert into faculty_ppr_details(faculty_id,	faculty_ppr_type,	faculty_ppr_year,	faculty_ppr_title,	faculty_ppr_jourrnal,	faculty_ppr_pub_date,	faculty_ppr_volume,	faculty_ppr_issue,	faculty_ppr_issn)
             values (\"" . $_SESSION["faculty_id"] . "\",
                                                                \"" . $_SESSION["faculty_ppr_type"] . "\",
                                                                \"" . $_SESSION["faculty_ppr_year"] . "\",
                                                                \"" . $_SESSION["faculty_ppr_title"] . "\",
                                                                \"" . $_SESSION["faculty_ppr_jourrnal"] . "\",
                                                                \"" . $_SESSION["faculty_ppr_pub_date"] . "\",
                                                                \"" . $_SESSION["faculty_ppr_volume"] . "\",
                                                                \"" . $_SESSION["faculty_ppr_issue"] . "\",
                                                                \"" . $_SESSION["faculty_ppr_issn"] . "\"
                                                                
                                                                )";
                                                               
              
            
            
            
            if($r = $con->query($q4))
                {
                    header ("Location:faculty_login_profile_view.php");
                }
                else
                {
                echo "ppr Details Not Recorded";
             }

    ?>