<?php


require_once "../config.php";
//session_start();
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
$dept = mysqli_fetch_assoc($link->query('select faculty_dept from faculty_details where faculty_name = "' . $_SESSION['username'] . '"'))['faculty_dept'];
// $q = 'select * from targets where dept = "' . $dept . '"';
// // echo $q;
// $result = $link->query($q);
// if (mysqli_num_rows($result) > 0) {
//     $r = mysqli_fetch_assoc($result);
//     $p = 1;
// } else {
//     $p = 0;
// }
?>
<style>
    ::placeholder {
        color: black !important;
    }
</style>
<form action="target.php" method="post">
    <!-- <div class="form-group row"> -->
    <div class="row">
        <div class="col-3">
            <label for="staticEmail" class="  col-form-label">Set Target</label>
            <input type="number" name="set_target" class="form-control" id="staticEmail" placeholder="N/A">
        </div>
        <div class="col-3">
            <label for="staticEmail" class="  col-form-label">Formative Percentage</label>
            <input type="number" name="formate_percent" class="form-control" id="staticEmail" placeholder="N/A">
        </div>
        <div class="col-3">
            <label for="staticEmail" class="  col-form-label">Summative Percentage</label>
            <input type="number" name="summative_percent" class="form-control" id="staticEmail" placeholder="N/A">
        </div>
        <div class="col-3">
            <label for="staticEmail" class="  col-form-label">Direct</label>
            <input type="number" name="direct" class="form-control" id="staticEmail" placeholder="N/A">
        </div>
        <div class="col-3">
            <label for="staticEmail" class="  col-form-label">Indirect</label>
            <input type="number" name="indirect" class="form-control" id="staticEmail" placeholder="N/A">
        </div>
        <div class="col-3">
            <label for="staticEmail" class="  col-form-label">Level 1</label>
            <input type="number" name="l1" class="form-control" id="staticEmail" placeholder="N/A">
        </div>
        <div class="col-3">
            <label for="staticEmail" class="  col-form-label">Level 2</label>
            <input type="number" name="l2" class="form-control" id="staticEmail" placeholder="N/A">
        </div>
        <div class="col-3">
            <label for="staticEmail" class="  col-form-label">Level 3</label>
            <input type="number" name="l3" class="form-control" id="staticEmail" placeholder="N/A">
        </div>
        <div class="col-3">
            <label for="staticEmail" class="  col-form-label">Summative MaxMarks</label>
            <input type="number" name="summative_max_marks" class="form-control" id="staticEmail" placeholder="N/A">
        </div>
        <div class="col-3">
            <label for="staticEmail" class="  col-form-label">Scheme</label>
            <input type="number" name="batch" class="form-control" id="staticEmail" placeholder="N/A">
        </div>
    </div>
    <?php
?>
    <input type="text" name="dept" id="" value="<?php echo $dept ?>" hidden>
    <div class="row">
        <div class="col col-md-4 col-lg-4 col-4 mt-3">
            <button class="btn btn-success" type="submit">SET</button>
        </div>
    </div>
    <!-- </div> -->
</form>
<?php
$q2 = 'select * from targets';
$result2 = $link->query($q2);
if(mysqli_num_rows($result2) > 0){
?>
<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Batch</th>
                <th scope="col">Target</th>
                <th scope="col">Formative Percentage</th>
                <th scope="col">Summative Percentage</th>
                <th scope="col">Direct</th>
                <th scope="col">Indirect</th>
                <th scope="col">Level 1</th>
                <th scope="col">Level 2</th>
                <th scope="col">Level 3</th>
                <th scope="col">Summative MaxMarks</th>


            </tr>
        </thead>
        <tbody>
            <?php foreach ($result2 as $r) {?>
                <tr>
                    <th scope="row"><?php echo $r['batch'] ?></th>
                    <td><?php echo $r['set_target'] ?></td>
                    <td><?php echo $r['f_percentage'] ?></td>
                    <td><?php echo $r['s_percentage'] ?></td>
                    <td><?php echo $r['direct'] ?></td>
                    <td><?php echo $r['indirect'] ?></td>
                    <td><?php echo $r['l1'] ?></td>
                    <td><?php echo $r['l2'] ?></td>
                    <td><?php echo $r['l3'] ?></td>
                    <td><?php echo $r['s_max'] ?></td>
                </tr>
            <?php }?>
        </tbody>
    </table>
</div>
<?php
}
include "../template/footer-fac.php"
?>