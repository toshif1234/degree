<?php
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";

$_SESSION['feedback_name'] = $_POST['feedback_name'];

$q='select * from feedback_all where feedback_name="'.$_SESSION['feedback_name'].'"';
$r=$link->query($q);

?>
<form action="update_feed.php" method="POST">
<?php
    $r2=mysqli_fetch_assoc($r);
for($i=1;$i<=30;$i++){ 
        if($r2['q'.$i])
        { ?>
        <tr>
            <td><?php echo $i ?></td>
    <td><div><textarea class="form-control" name="q<?php echo $i ?>" id="com" cols="150" rows="4"><?php echo $r2['q'.$i] ?> </textarea></div></td>
        </tr>
        <?php } 
        else{
            break;
        }
    } ?>
    <input type="text" value="<?php echo $i-1 ?>" name="count" hidden>
    <input type="submit" value="Update">


</form>


<?php
include "../template/footer-fac.php";
?>