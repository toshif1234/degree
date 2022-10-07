<?php
include("../template/fac-auth.php");
include "../Classes/PHPExcel.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$php = PHPExcel_IOFactory::createReader("Excel2007");
$excelFile = $php->load("Book1.xlsx");

$writer = PHPExcel_IOFactory::createWriter($excelFile, "Excel2007");
$sheet = $excelFile->getActiveSheet();

?>



<?php
session_start();
$_SESSION['assignment'] = 1;
require_once '../config.php';
$q = "select * from assignment_marks where semester = " . $_POST['semester'] . " and section = \"" . $_POST['section'] . "\" and branch = \"" . $_POST['branch'] . "\" and sub_name = \"" . $_POST['sub_name'] . "\" and fac_name = \"" . $_SESSION['username'] . "\"";
// echo $q;

$assign_count = "select * from add_assignment where semester = " . $_POST['semester'] . " and section = \"" . $_POST['section'] . "\" and branch = \"" . $_POST['branch'] . "\" and sub_name = \"" . $_POST['sub_name'] . "\" and fac_name = \"" . $_SESSION['username'] . "\"";

$count = 0;
$ac = $link->query($assign_count);
$assignment_numbers = array();
foreach ($ac as $a) {
    $assignment_numbers[] = $a['assignment_no'];
    $count++;
}
$result = $link->query($q);

?>


<?php
$sheet->getCell('A1')->setValue("slno");
$sheet->getCell('B1')->setValue("USN");
$sheet->getCell('C1')->setValue("NAME");
$sheet->getStyle('A1')->getFont()->setBold(true);
$sheet->getStyle('B1')->getFont()->setBold(true);
$sheet->getStyle('C1')->getFont()->setBold(true);
?>
<?php
if (in_array("1", $assignment_numbers)) {
?>

<?php
    $sheet->getStyle('D1')->getFont()->setBold(true);
    $sheet->getCell('D1')->setValue("Assignment 1");
}
?>

<?php

if (in_array("2", $assignment_numbers)) {
?>

<?php
    $d1 = $sheet->getCell('D1')->getValue();
    if ($d1 != "") {
        $sheet->getCell('E1')->setValue("Assignment 2");
    } else {
        $sheet->getCell('D1')->setValue("Assignment 2");
    }
}

?>
<?php
if (in_array("3", $assignment_numbers)) {
?>

<?php
    $d1 = $sheet->getCell('D1')->getValue();
    $e1 = $sheet->getCell('E1')->getValue();
    if ($d1 == "") {
        $sheet->getCell('D1')->setValue("Assignment 3");
    } else if ($e1 == "") {
        $sheet->getCell('E1')->setValue("Assignment 3");
    } else {
        $sheet->getCell('F1')->setValue("Assignment 3");
    }
}

?>
<?php
if (in_array("4", $assignment_numbers)) {
?>

<?php
    $d1 = $sheet->getCell('D1')->getValue();
    $e1 = $sheet->getCell('E1')->getValue();
    $f1 = $sheet->getCell('F1')->getValue();
    if ($d1 == "") {
        $sheet->getCell('D1')->setValue("Assignment 4");
    } else if ($e1 == "") {
        $sheet->getCell('E1')->setValue("Assignment 4");
    } else if ($f1 == "") {
        $sheet->getCell('F1')->setValue("Assignment 4");
    } else {
        $sheet->getCell('G1')->setValue("Assignment 4");
    }
}
?>
<?php
if (in_array("5", $assignment_numbers)) {
?>

    <?php
    $d1 = $sheet->getCell('D1')->getValue();
    $e1 = $sheet->getCell('E1')->getValue();
    $f1 = $sheet->getCell('F1')->getValue();
    $g1 = $sheet->getCell("G1")->getValue();

    if ($d1 == "") {
        $sheet->getCell('D1')->setValue("Assignment 5");
    } else if ($e1 == "") {
        $sheet->getCell('E1')->setValue("Assignment 5");
    } else if ($f1 == "") {
        $sheet->getCell('F1')->setValue("Assignment 5");
    } else if ($g1 == "") {
        $sheet->getCell('G1')->setValue("Assignment 5");
    } else {
        $sheet->getCell('H1')->setValue("Assignment 5");
    }
    ?>
<?php
}
?>

<?php
$d1 = $sheet->getCell('D1')->getValue();
$e1 = $sheet->getCell('E1')->getValue();
$f1 = $sheet->getCell('F1')->getValue();
$g1 = $sheet->getCell("G1")->getValue();
$h1 = $sheet->getCell("H1")->getValue();
if ($e1 == "") {
    $sheet->getCell('E1')->setValue("Average");
} else if ($f1 == "") {
    $sheet->getCell('F1')->setValue("Average");
} else if ($g1 == "") {
    $sheet->getCell('G1')->setValue("Average");
} else if ($h1 == "") {
    $sheet->getCell('H1')->setValue("Average");
} else {
    $sheet->getCell('I1')->setValue("Average");
}
?>

<?php
$cnt = 0;
foreach ($result as $row) {
    $cnt++;
?>
    <?php
    $sheet->getCell('A' . ($cnt + 1))->setValue("$cnt");
    ?>
    <?php
    $sheet->getCell('B' . ($cnt + 1))->setValue($row['usn']);
    ?>

    <?php
    $sheet->getCell('C' . ($cnt + 1))->setValue($row['stud_name']);
    ?>


    <?php
    if (in_array("1", $assignment_numbers)) {
    ?>

        <?php
        if ($d1 == "Assignment 1") {
            $sheet->getCell('D' . ($cnt + 1))->setValue($row['a1']);
        } ?>

    <?php } ?>

    <?php
    if (in_array("2", $assignment_numbers)) {
    ?>

        <?php
        $d1 = $sheet->getCell('D1')->getValue();
        if ($d1 != "") {
            $sheet->getCell('E' . ($cnt + 1))->setValue($row['a2']);
        } else {
            $sheet->getCell('D' . ($cnt + 1))->setValue($row['a2']);
        }
        ?>

    <?php } ?>

    <?php
    if (in_array("3", $assignment_numbers)) {
    ?>

        <?php
        $d1 = $sheet->getCell('D1')->getValue();
        $e1 = $sheet->getCell('E1')->getValue();
        if ($d1 == "") {
            $sheet->getCell('D' . ($cnt + 1))->setValue($row['a3']);
        } else if ($e1 == "") {
            $sheet->getCell('E' . ($cnt + 1))->setValue($row['a3']);
        } else {
            $sheet->getCell('F' . ($cnt + 1))->setValue($row['a3']);
        }
        ?>

    <?php } ?>

    <?php
    if (in_array("4", $assignment_numbers)) {
    ?>

        <?php
        $d1 = $sheet->getCell('D1')->getValue();
        $e1 = $sheet->getCell('E1')->getValue();
        $f1 = $sheet->getCell('F1')->getValue();
        if ($d1 == "") {
            $sheet->getCell('D' . ($cnt + 1))->setValue($row['a4']);
        } else if ($e1 == "") {
            $sheet->getCell('E' . ($cnt + 1))->setValue($row['a4']);
        } else if ($f1 == "") {
            $sheet->getCell('F' . ($cnt + 1))->setValue($row['a4']);
        } else {
            $sheet->getCell('G' . ($cnt + 1))->setValue($row['a4']);
        }

        ?>

    <?php } ?>

    <?php
    if (in_array("5", $assignment_numbers)) {
    ?>


        <?php
        $d1 = $sheet->getCell('D1')->getValue();
        $e1 = $sheet->getCell('E1')->getValue();
        $f1 = $sheet->getCell('F1')->getValue();
        $g1 = $sheet->getCell("G1")->getValue();

        if ($d1 == "") {
            $sheet->getCell('D' . ($cnt + 1))->setValue($row['a5']);
        } else if ($e1 == "") {
            $sheet->getCell('E' . ($cnt + 1))->setValue($row['a5']);
        } else if ($f1 == "") {
            $sheet->getCell('F' . ($cnt + 1))->setValue($row['a5']);
        } else if ($g1 == "") {
            $sheet->getCell('G' . ($cnt + 1))->setValue($row['a5']);
        } else {
            $sheet->getCell('H' . ($cnt + 1))->setValue($row['a5']);
        }
        ?>
    <?php } ?>

    <?php
    $avg = ($row['a1'] + $row['a2'] + $row['a3'] + $row['a4'] + $row['a5']) / $count;
    ?>

    <?php
    $d1 = $sheet->getCell('D1')->getValue();
    $e1 = $sheet->getCell('E1')->getValue();
    $f1 = $sheet->getCell('F1')->getValue();
    $g1 = $sheet->getCell("G1")->getValue();
    $h1 = $sheet->getCell("H1")->getValue();
    if ($e1 == "Average") {
        $sheet->getCell('E' . ($cnt + 1))->setValue(ceil($avg));
    } else if ($f1 == "Average") {
        $sheet->getCell('F' . ($cnt + 1))->setValue(ceil($avg));
    } else if ($g1 == "Average") {
        $sheet->getCell('G' . ($cnt + 1))->setValue(ceil($avg));
    } else if ($h1 == "Average") {
        $sheet->getCell('H' . ($cnt + 1))->setValue(ceil($avg));
    } else {
        $sheet->getCell('I' . ($cnt + 1))->setValue(ceil($avg));
    }
    ?>
<?php
}
?>


<?php
$section = $_SESSION['section'];
$sub = $_SESSION['sub_name'];
if (file_exists("../assignment_download/Assignment_Average_" . "$section" . "-sec_" . "$sub" . ".xlsx")) {
    unlink("../assignment_download/Assignment_Average_" . "$section" . "-sec_" . "$sub" . ".xlsx");
}
$writer->save("Assignment_Average_" . "$section" . "-sec_" . "$sub" . ".xlsx");
// echo "<script>window.location.href='../assignment/fac_assignment_avg_marks.php';</script>";
header("Location: ../assignment/fac_assignment_avg_marks.php"); ?>