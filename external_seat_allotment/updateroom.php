<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
error_reporting(0);

 $rm = $_GET['si'];
 $_SESSION['si']=$rm;
$rn = $_GET['rn'];
 $rs = $_GET['rd'];
// $br = $_GET['br'];
$fcount=$_GET['scount'];
$block=$_GET['block'];
$floor=$_GET['floor'];

?>
<script>
     function myfunc() {
        var a = document.getElementById("sub_name4").value;
        //document.write(a);
        if (a == "select1") {
            document.getElementById("message1").innerHTML = "  **Please Select Valid Imformation";
            return false;
        }
    

    var b = document.getElementById("sub_name5").value;
    //document.write(b);
        if (b == "select2") {
            document.getElementById("message2").innerHTML = "  **Please Select Valid Imformation";
            return false;
        }

        var c = document.getElementById("sub_name6").value;
        //document.write(c);
        if (c == "select3") {
            document.getElementById("message3").innerHTML = "  **Please Select Valid Imformation";
            return false;
        }
     }
    
    </script>
<body>
    <h4 class="mb-4">Update Room Details</h4>
    <div class="container">
        <form action="updateroom1.php" method="POST" onsubmit="return myfunc()">
            <div class="row" style="align-items: center;
    justify-content: center;
    align-content: center;
    flex-direction: row;">
                
                <div class="col-sm-12 col-md-4">
                    <div class="form-group ">
                        <div>
                            <label for="sub_name2">Room Number:</label>
                            <input type="text" value="<?php echo $rn ?>" name="sub_name2" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="form-group ">
                        <div>
                            <label for="sub_name3">NO OF DESK:</label>
                            <input type="text" value="<?php echo $rs ?>" name="sub_name3" class="form-control" required>
                        </div>
                    </div>
                </div>



                <div class="col-sm-12 col-md-4">
                    <div class="form-group">
                        <label for="sub_name4"> STUDENT COUNT </label>
                        <select name="sub_name4" class="form-control" id="sub_name4">
                        <option disabled value="select1">Choose Student Count</option>
                            <option value="1"<?php if($fcount=="1"){ echo "selected";}?>> 1 </option>
                            <option value="2"<?php if($fcount=="2"){ echo "selected";}?>> 2 </option>
                        </select>
                        <span id="message1" style="color: red;"></span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="form-group">
                        <label for="sub_name5"> BLOCK </label>
                        <select  name="sub_name5" class="form-control" id="sub_name5">
                            <option disabled value="select2">Choose Exam Block</option>
                            <option value="MAIN BLOCK"<?php if($block=="MAIN BLOCK"){ echo "selected";}?>> MAIN BLOCK </option>
                            <option value="SUB BLOCK"<?php if($block=="SUB BLOCK"){ echo "selected";}?>> SUB BLOCK </option>

                        </select>
                        <span id="message2" style="color: red;"></span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="form-group">
                        <label for="sub_name6">FLOOR </label>
                        <select name="sub_name6" class="form-control" id="sub_name6">
                            <option disabled value="select3">Choose Exam Floor</option>
                            <option value="Ground Floor"> Ground Floor </option>
                            <option value="1"<?php if($floor=="1"){ echo "selected";}?>> 1 </option>
                            <option value="2"<?php if($floor=="2"){ echo "selected";}?>> 2 </option>
                            <option value="3"<?php if($floor=="3"){ echo "selected";}?>> 3 </option>
                            <option value="4"<?php if($floor=="4"){ echo "selected";}?>> 4 </option>
                            <option value="5"<?php if($floor=="5"){ echo "selected";}?>> 5 </option>
                            <option value="6"<?php if($floor=="6"){ echo "selected";}?>> 6 </option>



                        </select>
                        <span id="message3" style="color: red;"></span>
                    </div>
                </div>



                <div class="col-sm-12 col-md-4">
                    <tr>
                        <!-- <button class="btn btn-info" type="submit" name="submit" id="submit">Update</button> -->
                        <input class="btn btn-info mt-3" type="submit" id="button" name="submit" value="Update">
                    </tr>

                </div>
        </form>
    </div>
</body>
<?php
include "../template/footer-fac.php";
?>