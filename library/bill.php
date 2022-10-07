<?php
include("../config.php");
include("../template/admin-auth.php");
include("../template/sidebar-admin.php");
$usn=$_POST["USN"];

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
<div id="invoice">
    <div class="toolbar hidden-print">
        <div class="text-right">
            <form method="post" action="billpdf.php">
            <input type="text" name="usn" class="form-control" id="usn" value="<?php echo $usn ?>" hidden>
            <input type="text" name="bookid" class="form-control" id="bookid" value="<?php echo $_POST['bookid'] ?>" hidden>
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
</form>
        </div>
        <hr>
    </div>
                <div class="row contacts">
                    <div class="col invoice-details">
                        <h1 class="invoice-id">INVOICE</h1>
                        <div class="name"> NAME: <?php echo $r1["fname"]?></div>
                        <div class="usn"> USN: <?php echo $r["usn"]?></div>
                        <div class="sem">SEMESTER: <?php echo $r1["semester"]?> </div>
                        <div class="sec"> SECTION: <?php echo $r1["section"]?></div>
                    </div>
                </div>
                <br>
                </br>
            <div style="border-bottom:1px solid #000;">
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
            <footer>
            </footer>
        </div>
        <div></div>
    </div>
</div>
</body>
<?php
include("../template/footer-admin.php");
?>