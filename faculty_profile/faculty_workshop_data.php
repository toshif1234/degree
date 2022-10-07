 <?php
    require_once '../config.php';
    $con =  $link;
    session_start();
    $_SESSION["faculty_id"] = $_POST['faculty_id'];
    $_SESSION["faculty_workshop_name"] = $_POST['faculty_workshop_name'];
    $_SESSION["faculty_workshop_title"] = $_POST['faculty_workshop_title'];
    $_SESSION["faculty_workshop_no_of_days"] = $_POST['faculty_workshop_no_of_days'];


    $q1 = "insert into faculty_workshop_details(faculty_id,faculty_workshop_name,faculty_workshop_title,faculty_workshop_no_of_days) values(\"" . $_SESSION["faculty_id"] . "\",\"" . $_SESSION["faculty_workshop_name"] . "\",\"" . $_SESSION["faculty_workshop_title"] . "\",\"" . $_SESSION["faculty_workshop_no_of_days"] . "\")";
    
    if ($r = $con->query($q1)) {
        header("Location: faculty_login_profile_view.php");
    } else {
        echo "workshop Details Not Recorded";
    }

    ?>