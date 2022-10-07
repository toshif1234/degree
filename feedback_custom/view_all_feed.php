<?php
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";

$q='select feedback_name from feedback_all';
$r=$link->query($q);
?>
<form action="view_next.php" method="post">
    <div class="row m-4">
        <div class="form-group col-4 mt-4">
            <label for="feedback">Feedback :</label>
            <select name="feedback_name" id="feedback" class='form-control' required>
            <option value="" selected disabled>Select Feedback</option>

                <?php 
                foreach($r as $s)
                {
                    if($s['feedback_name']!='Course End')
                    { 
                    ?>
                <option value="<?php echo $s['feedback_name'] ?>"><?php echo $s['feedback_name'] ?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
    </div>
    <div class="col col-4 col-md-4 col-lg-4">
            <input type="submit" class="btn btn-primary" style="margin-left: 3em;" name="" id="" value='SUBMIT'> 
        </div>
</form>
<?php
include "../template/footer-fac.php";
?>