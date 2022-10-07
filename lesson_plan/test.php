<?php
// $con=mysqli_connect("localhost","root","","erp_alvas");
require_once "../config.php";
$con = $link;

    
class DocxConversion{
    private $filename;

    public function __construct($filePath) {
        $this->filename = $filePath;
    }

    private function read_doc() {
        $fileHandle = fopen($this->filename, "r");
        $line = @fread($fileHandle, filesize($this->filename));   
        $lines = explode(chr(0x0D),$line);
        $outtext = "";
        foreach($lines as $thisline)
          {
            $pos = strpos($thisline, chr(0x00));
            if (($pos !== FALSE)||(strlen($thisline)==0))
              {
              } else {
                $outtext .= $thisline." ";
              }
          }
         $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);
        return $outtext;
    }

    private function read_docx(){

        $striped_content = '';
        $content = '';

        $zip = zip_open($this->filename);

        if (!$zip || is_numeric($zip)) return false;

        while ($zip_entry = zip_read($zip)) {

            if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

            if (zip_entry_name($zip_entry) != "word/document.xml") continue;

            $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

            zip_entry_close($zip_entry);
        }// end while

        zip_close($zip);

        $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
        $content = str_replace('</w:r></w:p>', "\r\n", $content);
        $striped_content = strip_tags($content);

        return $striped_content;
    }




    public function convertToText() {

        if(isset($this->filename) && !file_exists($this->filename)) {
            return "File Not exists";
        }

        $fileArray = pathinfo($this->filename);
        $file_ext  = $fileArray['extension'];
        if($file_ext == "doc" || $file_ext == "docx" || $file_ext == "xlsx" || $file_ext == "pptx")
        {
            if($file_ext == "doc") {
                return $this->read_doc();
            } elseif($file_ext == "docx") {
                return $this->read_docx();
            } elseif($file_ext == "xlsx") {
                return $this->xlsx_to_text();
            }elseif($file_ext == "pptx") {
                return $this->pptx_to_text();
            }
        } else {
            return "Invalid File Type";
        }
    }

}

$target_path = "../uploads/";
$target_path = $target_path.basename($_FILES['ufile']['name']);

if(move_uploaded_file($_FILES['ufile']['tmp_name'],$target_path)){
    $doc_file = $_FILES['ufile']['name'];
}
else{
    echo "error";
}

$docObj = new DocxConversion("../uploads/" . $doc_file);
$docText= $docObj->convertToText();

// print_r($docText);
$vtb = explode("Textbooks:",$docText);

$viewtb = explode("Reference Books:",$vtb[1]);

$vtu_co = explode("Course Outcomes:",$docText);
// print_r($vtu_co);
$vtu_cos = explode("Question Paper Pattern:",$vtu_co[1]);

$v_co = array_fill(0, 6, 0);

$vtu_cos_separation = explode("\r\n", $vtu_cos[0]);
$i = 0;

foreach($vtu_cos_separation as $v){
    if(empty($v)){
        $v_co[$i++] = 0;
    }
    else if(isset($v)){
        $v_co[$i++] = $v;
    }
}

// print_r($viewtb);

$textBooks = explode("\n",$viewtb[0]);
// print_r($textBooks);
$i = 0;

$v_txt = array_fill(0, 3, 0);

foreach($textBooks as $t){
    if(empty($t)){
        $v_txt[$i++] = 0;
    }
    else if(isset($t)){
        $v_txt[$i++] = $t;
    }
}

// print_r($v_co);

// print_r($vtu_cos_separation);`

$q_co = 'select sub from co';
$r_co = $con->query($q_co);

// print_r($r_co);

$flag_for_co = 0;

foreach($r_co as $r){
    if($r['sub'] == $_POST['sub']){
        // echo '1';
        $flag_for_co = 1;
        break;
    }
}

if($flag_for_co == 0){
    $query_co = "insert into co(`faculty_id`,`sub`,`co1`,`co2`,`co3`,`co4`,`co5`,`co6`,`t1`,`t2`,`t3`) values(\"" . $_POST["faculty_id"] . "\",\"" . $_POST["sub"] . "\",\"" . $v_co[0] . "\",\"" . $v_co[1] . "\",\"" . $v_co[2] . "\",\"" . $v_co[3] . "\",\"" . $v_co[4] . "\",\"" . $v_co[5] . "\",\"" . $v_txt[1] . "\",\"" . $v_txt[2] . "\",\"" . $v_txt[3] . "\")";
    $fac_co = $con->query($query_co);
}

$mod = explode("Module",$docText);
$module = array();
for($i = 1 ; $i<count($mod)-1;$i++){
    array_push($module,$mod[$i]);
}
$q =  explode("Course Outcomes",$mod[5]);
array_push($module,$q[0]);

////////////////////////////////////////////////////////////////////////////////////////////
$a = array();
$b = array();
$topic = array();
foreach($module as $m){
    $a = explode("Reference 1:",$m);
    $b = explode("Textbook 1:",$a[0]);
    array_push($topic,$b[0]);
}

// topic array has all the tpoics according to module

// print_r($topic);

// split function start

function splitArray($arr){
    $tend = array(array());
    $count1 = 0;
    $ct = count($arr);
    $rem = ceil($ct/8);
    $l = 8 * $rem - $ct;
    $ch = 8 - $l;
    for($i = 0; $i<8;$i++){
        if($i < $ch){
            for($j = 0; $j<$rem;$j++){
                $tend[$i][$j] = $arr[$count1];
                $count1++;
            }
        }
        else{
            for($j = 0; $j<$rem-1;$j++){
                $tend[$i][$j] = $arr[$count1];
                $count1++;
            }
        }
    }

    // echo "------------------------------------------------------------";
    // print_r($tend);
    // echo "------------------------------------------------------------";
    return $tend;
}

// split function stop

$q_ls = 'select subid from lessonpanl';
$r_ls = $con->query($q_ls);
$flag_for_ls = 0;

foreach($r_ls as $r){
    if($r['subid'] == $_POST['sub']){
        $flag_for_ls = 1;
        break;
    }
}

if($flag_for_ls == 0){
$module_count = 1;
foreach($topic as $t){
    $split1 = explode( ";",$t);
    $split2 = explode( ",",$t);
    
    if (count($split1) > count($split2)){
        $to = $split1;

    }
    else{
        $to = $split2;
    }
    
    // print_r($to);
    
    if(count($to) >= 8){
                            $div = intdiv(count($to) , 8) ;
                            // echo count($to);
                            // echo "<br>";
                            // echo $div;
                            // echo "up";
                            $abc = array();
                    //         for($i=0;$i<$div*8;$i){
                    //             $temp = array();
                    //             for($j=0;$j<$div;$j++){
                    //                 array_push($temp,$to[$i]);
                    //                 $i++;
                    //             }
                    //             array_push($abc,$temp);
                                
                    //         }
                    //         print_r($abc);
                    //         echo "<br>";
                    // echo "<br>";
                    // echo "<br>";
                    // echo $to[3];
                                        // echo "toooooooooooooooooooooooooooo";
                                        // print_r($to);
                                        // echo "dfsssssssssssssssssssssssss";
                                        // $abc = array_chunk($to, $div, false);
                                        // print_r($abc);
                                        $abc = splitArray($to);
                                        // print_r($abc);
                                        foreach($abc as $s)
                                            {
                                               $c = "";
                                                foreach($s as $h )
                                                {
                                    //                 echo $h;
                                                $c = $c . $h;
                                                }
                                                $q_chk_sr_no = "select max(sr_no) from lessonpanl";
                                                $r_chk_sr_no = $con->query($q_chk_sr_no);
                                                $c_chk = 0;
                                                if(mysqli_num_rows($r_chk_sr_no) > 0){
                                                    $r_chk = mysqli_fetch_assoc($r_chk_sr_no);
                                                    $c_chk = $r_chk['max(sr_no)'] + 1;
                                                }
                                                $q342 = "insert into lessonpanl(sr_no,sem,subid,section,pending,module, vtu_textbook, vtu_co) values(\"" . $c_chk . "\", \"" . $_POST['sem'] . "\", \"" . $_POST['sub'] . "\", \"" . $_POST['sec'] . "\",\"" . $c . "\",\"" . $module_count . "\",\"" . $viewtb[0] . "\",\"" . $vtu_cos[0] . "\")";
                                                // echo $q342;
                                                $res = $con->query($q342);
                                                
                                            }
                    


                             }
                                else{
                                    // echo count($to);
                                    // echo "<br>";
                                    $div = intdiv( 8,count($to)) ;
                                    print_r($div);
                                    // echo "down";
                                    $abc = array();
                                            foreach($to as $t){
                                                
                                                        for($i=0;$i<$div;$i++){
                                                            $temp = array();
                                                            array_push($temp,$t);
                                                            array_push($abc,$temp);
                                                         }
                                                // array_push($abc,$temp);
                                                     }
                                    //  print_r($abc);
                                    // echo "sdfsdsffsddsfdffds";
                                                foreach($abc as $s)
                                                {
                                                    $c = "";
                                                    foreach($s as $h )
                                                    {
                                                        //  echo $h;
                                        //                  echo "<br>";
                                        // echo "<br>";
                                        // echo "<br>";

                                                        $c = $c . $h;
                                                    }
                                                    $q_chk_sr_no = "select max(sr_no) from lessonpanl";
                                                $r_chk_sr_no = $con->query($q_chk_sr_no);
                                                $c_chk = 0;
                                                if(mysqli_num_rows($r_chk_sr_no) > 0){
                                                    $r_chk = mysqli_fetch_assoc($r_chk_sr_no);
                                                    $c_chk = $r_chk['max(sr_no)'] + 1;
                                                }
                                                    $res = $con->query("insert into lessonpanl(sr_no,sem,subid,section,pending,module, vtu_textbook, vtu_co) values(\"" . $c_chk . "\",\"" . $_POST['sem'] . "\", \"" . $_POST['sub'] . "\", \"" . $_POST['sec'] . "\",\"" . $c . "\",\"" . $module_count . "\",\"" . $viewtb[0] . "\",\"" . $vtu_cos[0] . "\")");
                                                    
                                                 }
                                    
                                }
$module_count++;

}





// foreach($mod as $m){
//     echo $m;
// echo "<br>";
// echo "<br>";
// echo "<br>";
// $q =  explode("Course Outcomes",$m);
// print_r($q);

// }

// $q =  explode("Course Outcomes",$mod[5]);



}

// print_r($vtu_cos[0]);
// print_r($vtu_cos);
session_start();
$_SESSION["sem"] = $_POST['sem'];
$_SESSION["subid"] = $_POST['sub'];
$_SESSION["sec"] = $_POST['sec'];
$_SESSION["vtu"] = $vtu_cos[0];
header("Location: display.php");

    ?>
