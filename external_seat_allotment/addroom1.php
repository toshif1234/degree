<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";

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

<div>
    <form action="addroom2.php" method="POST" onsubmit="return myfunc()">
        <div class="row">
            <!-- <div class="col-3">
                <div class="form-group ">
                    <div>
                        <label for="sub_name1">Room ID:</label>
                        <input type="text" name="sub_name1" class="form-control" required>
                    </div>
                </div>
            </div> -->
            <div class="col-3">
                <div class="form-group ">
                    <div>
                        <label for="sub_name2">Room NO:</label>
                        <input type="text" name="sub_name2" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="form-group ">
                    <div>
                        <label for="sub_name3">NO OF DESK:</label>
                        <input type="text" name="sub_name3" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="sub_name4"> STUDENT COUNT </label>
                    <select name="sub_name4" class="form-control" id="sub_name4">
                         <option value="select1">Choose Student Count </option>
                        <option value="1"> 1 </option>
                        <option value="2"> 2 </option>

                    </select>
                    <span id="message1" style="color: red;"></span>
                </div>
                
            </div>
            <div class="col-3 ">
                <div class="form-group">
                    <label for="sub_name5"> BLOCK </label>
                    <select name="sub_name5" class="form-control" id="sub_name5">
                        <option value="select2">Choose Exam Block</option>
                        <option value="MAIN BLOCK"> MAIN BLOCK </option>
                        <option value="SUB BLOCK"> SUB BLOCK </option>

                    </select>
                    <span id="message2" style="color: red;"></span>
                </div>
                
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="sub_name6">FLOOR </label>
                    <select name="sub_name6" class="form-control" id="sub_name6">
                        <option value="select3">Choose Exam Floor</option>
                        <option value="Ground Floor"> Ground Floor </option>
                        <option value="1"> 1 </option>
                        <option value="2"> 2 </option>
                        <option value="3"> 3 </option>
                        <option value="4"> 4 </option>
                        <option value="5"> 5 </option>
                        <option value="6"> 6 </option>



                    </select>
                    <span id="message3" style="color: red;"></span>
                </div>
                
            </div>

            <div class="col-3">
                <br>
                <button class="btn btn-info" type="submit">ADD</button>
            </div>
        </div>
    </form>
</div>

<?php
include "../template/footer-fac.php";
?>