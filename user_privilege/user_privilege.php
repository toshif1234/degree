<?php
include("../template/admin-auth.php");
error_reporting(0);
include("../template/sidebar-admin.php");
// require_once "../config.php";
$dept = $_POST['dept'] ?? $_SESSION['dept'];
$_SESSION['dept'] = $dept;
$q1 = 'select f.faculty_name, f.faculty_id, u.identity, u.username from faculty_details f, users u where f.faculty_dept = "' . $dept . '" and f.faculty_email = u.username';
// echo $q1;
$result = $link->query($q1);
$c = 0;
?>
<div class="container">
    <form action="./prev_proc.php" method="POST">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Faculty Id</th>
                    <th scope="col">Faculty Name</th>
                    <th scope="col">Department Admin</th>
                    <th scope="col">Faculty</th>
                    <th scope="col">Class Co-ordinator</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $r) {
                    $c++;
                    // echo $r['faculty_id'] . ' ' . $r['faculty_name'] . ' ' . $r['identity'] . '<br>';
                ?>

                    <tr>
                        <td><?php echo $r['faculty_id'] ?><input type="text" name="faculty_id<?php echo $c ?>" value="<?php echo $r['faculty_id'] ?>" id="" hidden></td>
                        <td><?php echo $r['faculty_name'] ?><input type="text" name="faculty_name<?php echo $c ?>" id="" value="<?php echo $r['faculty_name'] ?>" hidden></td>
                        <td>
                            <input type="radio" name="select<?php echo $c ?>" value="3" <?php if ($r['identity'] == 3) { ?> checked <?php } ?>>
                        </td>
                        <td><input type="radio" name="select<?php echo $c ?>" <?php if ($r['identity'] == 2) { ?> checked <?php } ?> value="2"></td>
                        <td><input type="radio" name="select<?php echo $c ?>" <?php if ($r['identity'] == 4) { ?> checked <?php } ?> value="4"></td>
                    </tr><input type="text" name="email<?php echo $c ?>" id="" hidden value="<?php echo $r['username'] ?>">
                <?php } ?>
            </tbody>
            <button type="submit" class="btn btn-primary mb-4">Update</button>
            <input type="text" name="count" id="" value="<?php echo $c ?>" hidden>
        </table>
    </form>
</div>
<?php include("../template/footer-admin.php") ?>