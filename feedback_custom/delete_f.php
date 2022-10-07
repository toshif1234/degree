<form action="delete_feed.php" method="POST">
<div class="row m-4">
        <div class="form-group col-4 mt-4">
            <label for="feedback">Delete Feedback :</label>
            <select name="feedback_name" id="feedback" class='form-control' required>
            <option value="" selected disabled>Select Feedback</option>

                <?php 
                foreach($r as $s)
                {
                    
                    ?>
                <option value="<?php echo $s['feedback_name'] ?>"><?php echo $s['feedback_name'] ?></option>
                <?php
                    
                }
                ?>
            </select>
        </div>
    </div>
    <div class="col col-4 col-md-4 col-lg-4">
            <input type="submit" class="btn btn-primary" style="margin-left: 3em;" name="" id="" value='SUBMIT'> 
        </div>

</form>