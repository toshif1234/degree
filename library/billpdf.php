<?php
include("../config.php");
session_start();
$usn=$_POST["usn"];
$dept = $_SESSION["branch"];
$q = 'select * from issue_student where bookid="' . $_POST['bookid'] . '"';
//echo $q;
$x = 'select * from book where bookid="' . $_POST['bookid'] . '"';
//echo $x;
$s="select * from students where usn='$usn';";
// echo $s;
//$result = $link->query($s);
$r1 = mysqli_fetch_assoc($link->query($s));
$r = mysqli_fetch_assoc($link->query($q));
$y = mysqli_fetch_assoc($link->query($x));
?>

<style>
.container_bill{
  padding-right: 90px;
  padding-left: 32%;
}
</style> 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
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
            </div>
        </div>
    </div>
   
    
</div>
<div class="container_bill">
<div class="row contacts">

                    <div class="col invoice-details mt-4" style=" center;">
                        <h1 class="invoice-id">INVOICE</h1>
                        <br>
                        <div class="name"> NAME: <?php echo $r1["fname"]?></div>
                        <div class="usn"> USN: <?php echo $r["usn"]?></div>
                        <div class="sem">SEMESTER: <?php echo $r1["semester"]?> </div>
                        <div class="sec"> SECTION: <?php echo $r1["section"]?></div>
                    </div>
</div>
                <br>
                </br>
            <div >
                <table border="0" cellspacing="20" cellpadding="10">
                    <thead>
                        <tr>
                            <th class="text-right"> SL No.   </th>
                            <th class="text-right">Book ID </th>
                            <th class="text-right">Issue Date </th>
                            <th class="text-right">Return date</th>
                            <th class="text-right">Fine</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $count=0; ?>
                        <tr>
                            <th scope="row"><?php echo ++$count; ?></th>
                            <td><?php echo $r["bookid"] ?></td>
                            <td><?php echo $r["issue_date"]?></td>
                            <td><?php echo $r["return_date"]?></td>
                            <td><?php echo $r["fine"]?></td>      
                        </tr>
                </table>
                <br></br>
               <p><u>Paid to:</u>
            <br/>Alva's Institute of Engineering and Technology<br/>
            Dept of Computer Science<br/>
            <br>
            </br>
            <br> Signature of Incharge<br> 
</p>
            
        </div>
</div>
</div>
</div>
<script>
    setTimeout(function() {
        window.print();
    }, 1000);
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>