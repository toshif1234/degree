<?php
    
    include "../Classes/PHPExcel.php";
    error_reporting(0);
    require_once "../config.php";
    $target_path = "../uploads/";
    $con = $link;
    $target_path = $target_path.basename('faculty' . ".xlsx");

    if(move_uploaded_file($_FILES['xl']['tmp_name'],$target_path)){
        $doc_file = $_FILES['xl']['name'];
    }
    else{
        echo "error";
    }

    $php = PHPExcel_IOFactory::createReader("Excel2007");
    $excelFile = $php->load("../uploads/faculty.xlsx");
    
    $sheet = $excelFile -> getActiveSheet();

    $q = 'select * from faculty_details';
    $result = $link->query($q);
    
    if(mysqli_num_rows($result)>0){
    $d = 1;
        while(1){
            $d++;
            $v = array();
            for($i = 'A'; $i != $sheet->getHighestColumn(); $i++){
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
                    if($v[3]=="CSE")
                    {
                        $v[3]="Computer Science and Engineering";
                        // echo $r[8];
                        // echo "<br>";
                    }
                    // echo $v[10];
                    if($v[3]=="ISE")
                    {
                        $v[3]="Information Science and Engineering";
                        // echo $r[8];
                        // echo "<br>";
                    }
                    if($v[3]=="ECE")
                    {
                        $v[3]="Electronics and Communication Engineering";
                        // echo $r[8];
                        // echo "<br>";
                    }
                    if($v[3]=="ME")
                    {
                        $v[3]="Mechanical Engineering";
                        // echo $r[8];
                        // echo "<br>";
                    }
                    if($v[3]=="CV")
                    {
                        $v[3]="Civil Engineering";
                        // echo $r[8];
                        // echo "<br>";
                    }
                    $q1="insert into faculty_details values(\"" . $v[0] . "\",\"" . $v[1] . "\",\"" . $v[2] . "\",\"" . $v[3] . "\",\"" . $v[4] . "\",\"" . $v[5] . "\",\"" . $v[6] . "\",\"" . $v[7] . "\",\"" . $v[8] . "\",\"" . $v[9] . "\",\"" . $v[10] . "\",\"" . $v[11] . "\",\"" . $v[12] . "\",\"" . $v[13] . "\",\"" . $v[14] . "\",\"" . $v[15] . "\",\"" . $v[16] . "\",\"" . $v[17] . "\",\"" . $v[18] . "\",\"" . $v[19] . "\",\"" . $v[20] . "\",\"" . $v[21] . "\",\"" . $v[22] . "\",\"" . $v[23] . "\",\"" . $v[24] . "\",\"" . $v[25] . "\",\"" . $v[26] . "\",\"" . $v[27] . "\",\"" . $v[28] . "\");"; 
                    // echo $q1;  
			        $result=$con->query($q1);
                }
                catch(Exception $e){

                } 
            }
        
        }
    }

    header("Location: ../students/students_insert.php");

    
    
