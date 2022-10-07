<?php
    
    include "../Classes/PHPExcel.php";
    require_once "../config.php";
    $target_path = "../uploads/";
    $target_path = $target_path.basename('student' . ".xlsx");

    if(move_uploaded_file($_FILES['xl']['tmp_name'],$target_path)){
        $doc_file = $_FILES['xl']['name'];
    }
    else{
        echo "error";
    }

    $php = PHPExcel_IOFactory::createReader("Excel2007");
    $excelFile = $php->load("../uploads/student.xlsx");
    
    $writer = PHPExcel_IOFactory::createWriter($excelFile, "Excel2007");
    $sheet = $excelFile -> getActiveSheet();

    $q = 'select * from students';
    $result = $link->query($q);
    
    if(mysqli_num_rows($result)>0){
    $d = 1;
        while(1){
            $d++;
            $v = array();
            for($i = 'A'; $i != $sheet->getHighestColumn(); $i++){
                    // if($i == 'BT'){
                    //     break;
                    // }
                // echo $i;
                $v[] = empty($sheet->getCell($i . $d)->getValue()) ? "NULL" : $sheet->getCell($i . $d)->getValue();
            }
            $v[] = empty($sheet->getCell($i . $d)->getValue()) ? "NULL" : $sheet->getCell($i . $d)->getValue();
            // print_r($v);
            if($v[0]=='NULL')
            {
                break;
            }
            else
            {
                try{
                    if($v[8]=="CSE")
                    {
                        $v[8]="Computer Science and Engineering";
                        // echo $r[8];
                        // echo "<br>";
                    }
                    echo $v[10];
                    if($v[8]=="ISE")
                    {
                        $v[8]="Information Science and Engineering";
                        // echo $r[8];
                        // echo "<br>";
                    }
                    if($v[8]=="ECE")
                    {
                        $v[8]="Electronics and Communication Engineering";
                        // echo $r[8];
                        // echo "<br>";
                    }
                    if($v[8]=="ME")
                    {
                        $v[8]="Mechanical Engineering";
                        // echo $r[8];
                        // echo "<br>";
                    }
                    if($v[8]=="CV")
                    {
                        $v[8]="Civil Engineering";
                        // echo $r[8];
                        // echo "<br>";
                    }
                    $q1="insert into students (`adm_no`, `usn`, `batch`, `semester`, `section`, `fname`, `mname`, `lname`, `branch`, `kcet`, `comedk`, `jee`, `nationality`, `data_of_admission`, `dob`, `place_of_birth`, `gender`, `mob_no`, `email_id`, `aadhar`, `pan_card`, `sc_st`, `caste`, `annual_income`, `present_state`, `present_dist`, `present_house_no_name`, `present_post_village`, `present_pincode`, `permanent_state`, `permanent_dist`, `permanent_house_no_name`, `permanent_post_village`, `permanent_pin_code`) values(\"" . $v[0] . "\",\"" . $v[1] . "\",\"" . $v[2] . "\",\"" . $v[3] . "\",\"" . $v[4] . "\",\"" . $v[5] . "\",\"" . $v[6] . "\",\"" . $v[7] . "\",\"" . $v[8] . "\",\"" . $v[9] . "\",\"" . $v[10] . "\",\"" . $v[11] . "\",\"" . $v[12] . "\",\"" . $v[13] . "\",\"" . $v[14] . "\",\"" . $v[15] . "\",\"" . $v[16] . "\",\"" . $v[17] . "\",\"" . $v[18] . "\",\"" . $v[19] . "\",\"" . $v[20] . "\",\"" . $v[21] . "\",\"" . $v[22] . "\",\"" . $v[23] . "\",\"" . $v[24] . "\",\"" . $v[25] . "\",\"" . $v[26] . "\",\"" . $v[27] . "\",\"" . $v[28] . "\",\"" . $v[29] . "\",\"" . $v[30] . "\",\"" . $v[31] . "\",\"" . $v[32] . "\",\"" . $v[33] . "\");"; 
                    $result=$link->query($q1);
                    // $q1 = "INSERT INTO `students`(`adm_no`, `usn`, `batch`, `semester`, `section`, `fname`, `mname`, `lname`, `branch`, `kcet`, `comedk`, `jee`, `nationality`, `data_of_admission`, `dob`, `place_of_birth`, `gender`, `mob_no`, `email_id`, `aadhar`, `pan_card`, `sc_st`, `caste`, `annual_income`, `present_state`, `present_dist`, `present_house_no_name`, `present_post_village`, `present_pincode`, `permanent_state`, `permanent_dist`, `permanent_house_no_name`, `permanent_post_village`, `permanent_pin_code`) VALUES ()";
                    // echo $q1 . '<br>';
                    $q_ssc = 'insert into sslc_details values("' .$v[0] . '", "' . $v[34] . '", "' . $v[35] . '", "' . $v[36] . '", "' . $v[37] . '", "' . $v[38] . '", "' . $v[39] . '", "' . $v[40] . '")';
                    $link->query($q_ssc);
                    // echo $q_ssc;
                    $q2="insert into puc_details values(\"" . $v[0] . "\",\"" . $v[41] . "\",\"" . $v[42] . "\",\"" . $v[43] . "\",\"" . $v[44] . "\",\"" . $v[45] . "\",\"" . $v[46] . "\",\"" . $v[47] . "\",\"" . $v[48] . "\",\"" . $v[49] . "\",\"" . $v[50] . "\",\"" . $v[51] . "\",\"" . $v[52] . "\",\"" . $v[53] . "\",\"" . $v[54] . "\",\"" . $v[55] . "\",\"" . $v[56] . "\",\"" . $v[57] . "\",\"" . $v[58] . "\")";
                    $link->query($q2);
                    // echo $q2;
                    $q3="insert into parents_details values(\"" . $v[0] . "\",\"" . $v[1] . "\",\"" . $v[59] . "\",\"" . $v[60] . "\",\"" . $v[61] . "\",\"" . $v[62] . "\",\"" . $v[63] . "\",\"" . $v[64] . "\",\"" . $v[65] . "\",\"" . $v[66] . "\",\"" . $v[67] . "\",\"" . $v[68] . "\",\"" . $v[69] . "\",\"" . $v[70] . "\")";
                    $link->query($q3);
                    // echo $q3;
                }
                catch(Exception $e){
                    echo "error";
                } 
            }
        
        }
    }

    header("Location: ../students/students_insert.php");

    
    
