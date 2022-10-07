<?php
    
    include "../Classes/PHPExcel.php";
    require_once "../config.php";
    $target_path = "../uploads/";
    $target_path = $target_path.basename('Books' . ".xlsx");

    if(move_uploaded_file($_FILES['xl']['tmp_name'],$target_path)){
        $doc_file = $_FILES['xl']['name'];
    }
    else{
        echo "error";
    }

    $php = PHPExcel_IOFactory::createReader("Excel2007");//object creation
    $excelFile = $php->load("../uploads/Books.xlsx");
    
    $writer = PHPExcel_IOFactory::createWriter($excelFile, "Excel2007");//onject create
    $sheet = $excelFile -> getActiveSheet();// to get the active sheet

    
    // echo mysqli_num_rows($result);
   
    $d = 1;//rows
        while(1){
            $d++;
            $v = array();//row data pass
            for($i = 'A'; $i != $sheet->getHighestColumn(); $i++){ //returns highest column value like g if it is end
                    // if($i == 'BT'){
                    //     break;
                    // }
                // echo $i;
                $v[] = empty($sheet->getCell($i . $d)->getValue()) ? "NULL" : $sheet->getCell($i . $d)->getValue(); //takes entire row value and store it in array
            }
            $v[] = empty($sheet->getCell($i . $d)->getValue()) ? "NULL" : $sheet->getCell($i . $d)->getValue();//leaves last row
            // print_r($v);
            if($v[0]=='NULL')
            {
                break;
            }
            else
            {
                try{
                   
                    $q1="INSERT INTO `book` (`bookid`, `title`, `author`, `edition`, `publications`, `sub`,  `Alumni_Cont` , `Date_Of_Alumni` , `dept`, `usn`, `Alumni_Name`) VALUES(\"" . $v[0] . "\",\"" . $v[1] . "\",\"" . $v[2] . "\",\"" . $v[3] . "\",\"" . $v[4] . "\",\"" . $v[5] . "\",\"" . $v[6] . "\",\"" . $v[7] . "\",\"" . $v[8] . "\",\"" . $v[9] . "\",\"" . $v[10] . "\");"; 
                    $result=$link->query($q1);
                    
                    // echo $q1 . '<br>';
                }
                catch(Exception $e){
                    echo "error";
                } 
            }
        
        }
    

    header("Location: add_books.php");
?>