<?php

// echo "phase marks entery";
error_reporting(0);
include("../template/fac-auth.php");
require_once "../config.php";
include("../template/sidebar-fac.php");
//session_start();
$branch = $_SESSION["branch"];
$sec = $_SESSION["sec"];
$sem = $_SESSION["sem"];
$sub = $_SESSION["sub"];
// echo $/sub;
$cc=0;
$qq = "select distinct * from project_phase where branch = \"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\"  order by usn";    
// echo $qq;
$result = $link->query($qq);



?>
<h4> Subject : <?php echo $sub ?> </h4>
<div class="container">
<div class="table-responsive-sm custom-table">
        <?php
        if($sem==7)
        {




        ?>
                        <table class="table" style="width:max-content;" id="table1">
                            <thead>
                                <tr>
                                    <!-- <th></th> -->
                                    <th scope="col" class="sticky-col first-col">USN</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phase 1</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="phase_insert.php" method="post">
                                        <input type="submit"  class="btn btn-success" value="SUBMIT">
                                        <?php
                                        if(isset($result)){

                                    
                                        foreach ($result as $r) {
                                            $cc++;
                                        ?>
                                        <tr >
                            

                                <td class="sticky-col first-col">
                                    <input type="text" class="form-control" id="usn" name="usn<?php echo $cc ?>"
                                        value="<?php echo $r['usn']; ?>" readonly />
                                </td>
                                <td>
                                    <input type="text" class="form-control mb-1" id="" name="name<?php echo $cc ?>"
                                        value="<?php echo $r['name']; ?>" readonly />
                                </td>

                                <td>
                                    <input type="number" min="0" max="100" class="form-control tab1-phase1" id="phase1"
                                        value="<?php echo $r['phase1']; ?>" <?php if(empty($r['phase1'])){ ?> placeholder="N/A"
                                        <?php } ?> name="phase1<?php echo $cc ?>"
                                         />
                                </td>
                                        </tr>
                                        <?php } } ?>
                                        
                                        <input type="text" name="cc" id="" value="<?php echo $cc ?>" hidden>

                                </form>

                            </tbody>
                        </table>
        <?php
        }
        ?>
        <?php
        if($sem==8)
        {



        ?>
                        <table class="table" style="width:max-content;" id="table1">
                            <thead>
                                <tr>
                                    <!-- <th></th> -->
                                    <th scope="col" class="sticky-col first-col">USN</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phase 2</th>
                                    <th scope="col">Phase 3</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="phase_insert.php" method="post">
                                        <input type="submit"  id="IA1_Form_submit_Btn" class="btn btn-success" value="SUBMIT">
                                        <?php
                                        if(isset($result)){

                                    
                                        foreach ($result as $r) {
                                            $cc++;
                                        ?>
                                        <tr>
                                        <td class="sticky-col first-col">
                                            <input type="text" class="form-control" id="usn" name="usn<?php echo $cc ?>"
                                                value="<?php echo $r['usn']; ?>" readonly />
                                        </td>
                                        <td>
                                            <input type="text" class="form-control mb-1" id="" name="name<?php echo $cc ?>"
                                                value="<?php echo $r['name']; ?>" readonly />
                                        </td>

                                        <td>
                                    <input type="number" min="0" max="40" class="form-control tab1-phase2" id="phase2"
                                        value="<?php echo $r['phase2']; ?>" <?php if(empty($r['phase2'])){ ?> placeholder="N/A"
                                        <?php } ?> name="phase2<?php echo $cc ?>"
                                         />
                                </td>
                                        <td>
                                    <input type="number" min="0" max="60" class="form-control tab1-phase3" id="phase3"
                                        value="<?php echo $r['phase3']; ?>" <?php if(empty($r['phase3'])){ ?> placeholder="N/A"
                                        <?php } ?> name="phase3<?php echo $cc ?>"
                                         />
                                </td>
                                <td>
                                <input type="text" class="form-control mb-1" id="" name="phase_total<?php echo $cc ?>"
                                                value="<?php echo $r['phase_total']; ?>" readonly />
                                </td>
                                        </tr>
                                        <?php }  ?>
                                        <input type="text" name="cc" id="" value="<?php echo $cc ?>" hidden>

                                </form>

                            </tbody>
                        </table>
            <?php
            }}
            ?>
    </div>
</div>
<!-- <script>
    function myFunction3() {
    console.log("myFunctin3");
    $('#table3 tr td div:first-child input[type="checkbox"]').click(
        function() {
            //enable/disable all except checkboxes, based on the row is checked or not
            console.log(this.checked);
            $(this)
                .closest("tr")
                .find(":input:not(:first)")
                .attr("disabled", !this.checked);

        }
    );
}

function myFunction2() {
    console.log("myFunctin2");
    $('#table2 tr td:first-child input[type="checkbox"]').click(
        function() {
            //enable/disable all except checkboxes, based on the row is checked or not
            $(this)
                .closest("tr")
                .find(":input:not(:first)")
                .attr("disabled", !this.checked);
        }
    );
}

function myFunction1() {
    console.log("myFunctin1");
    $('#table1 tr td div:first-child input[type="checkbox"]').click(
        function() {
            //enable/disable all except checkboxes, based on the row is checked or not
            console.log(this.checked);
            $(this)
                .closest("tr")
                .find(":input:not(:first)")
                .attr("disabled", !this.checked);
        }
    );
}

function disable3() {
    console.log('dis3')
}
</script> -->
