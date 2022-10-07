<?php
include_once("../config.php");
session_start();
$year = $_POST["year"];
$year = explode("-",$year);
$branch = $_SESSION["branch"];
$fyear = $year[0];
$lyear = $year[1];
if(strlen($lyear)<4){
    $lyear= $fyear[0].$fyear[1].$lyear;
}
// echo $lyear;
$dept = $_SESSION["branch"];
$sql = "select * from book  where Alumni_Cont='Yes' and dept='$branch' and Date_Of_Alumni like '$lyear%' or Date_Of_Alumni like '$fyear%'";
// echo $sql;
$result=$link->query($sql);

$count = 1;
    ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head><div>
<div class="container-fluid pl-0 pr-0 pb-3" style="overflow: hidden; border-bottom:2px solid black;">
        <div class="row pt-3" style="justify-content: center;align-items: center">
            <div class="col-2">
                <img src="..\asset\img\1aiet-logo.png" style="width:90px;display:float;float:right;" class="img-fluid p-0 m-0" srcset="">
            </div>
            <div class="col-sm-8 col-md-7 content p-0 m-0">
                <h3 style="font-size: 23px;">Alvas institute of enginering & technology</h3>
                <p>Shobavan Campus, Mijar, Moodibidri, D.K - 574225</p>
                <p>Phone: 08258-262725, Fax: 08258-262726</p>
                <h2 style="font-size: 25px;">Department of <?php echo $dept ?></h2>
                <h4> ALUMNI CONTRIBUTION <?php echo $fyear . " - " . $lyear;?></h4>
            </div>
        </div>
    </div>
   
    
</div>
<div class="table-responsive">
        <table class="table ">
            <thead class="table">
                <tr>
                    <!-- <th scope="col">Sl No</th> -->
                    <th scope="col">Book ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Edition</th>
                    <th scope="col">Publication</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Alumni_Cont</th>
                    <th scope="col">Date_Of_Contribution</th>
                </tr>
            </thead>
            <tbody>
               
                <?php foreach($result as $r){ ?>
                <tr>
                    <!-- <th style="width: 70px !important;" scope="row"><?php echo $count; ?></th> -->
                    <td style="width: 100px !important;"><?php echo $r["bookid"] ?></td>
                    <td><?php echo $r["title"]?></td>
                    <td><?php echo $r["author"]?></td>
                    <td><?php echo $r["edition"]?></td>
                    <td><?php echo $r["publications"]?></td>
                    <td><?php echo $r["sub"]?></td>
                    <td><?php echo $r["Alumni_Cont"]?></td>
                    <td><?php echo $r["Date_Of_Alumni"]?></td>
                    </td>
    </tr>
  <?php } ?>
    </tbody>
    </table>

    </div>

    <style>
        @media print {
            @page {
                /* size: landscape; */
                margin: 0.5cm;
            }

        }

        h1,
        h3,
        h2 {
            text-transform: uppercase;
            font-family: 'Times New Roman', Times, serif;
        }

        .content {
            line-height: 6px !important;
            text-align: center;
        }

        /* .book-date, .lesson-plan-break {
            page-break-after: always;
        } */

        /* .pg-break-above {
            page-break-before: always;
        } */
    </style>
</body>
<script>
    setTimeout(function() {
        window.print();
    }, 1000);
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>