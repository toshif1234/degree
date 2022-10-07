<?php
include("../template/stud_auth.php");
include("../template/student_sidebar.php");


?>
<!--  -->
<div class="card p-2 " style="width: 24rem;">
    <div class="row" style="align-items: center;">
        <div class="col" style="display: flex;align-items: center;">
            <Span class="p-0 m-1 avatar " style="color:orange; font-size:20px; font-weight:bold;">
                <?php echo 'A';?>
            </Span>
            <h3 class="pl-2">
                <small class="text-muted pl-2"> name </small>
            </h3>

            <div class="col"></div>
            <div class="col">
                <button class="btn" style="float: right;"><i class="fas fa-times"></i></button>
            </div>
        </div>

    </div>
    <img src="../asset/img/bg.png" class="card-img-top" alt="...">
    <div class="card-body">
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
            content.</p>
    </div>
    <div class="row">
        <div class="col" style="float: left;">
            <div class="btn-group" role="group" aria-label="Basic example" style="background-color: #ebecec;border-radius:6px">
                <button type="button" class="btn"><i class="far fa-thumbs-up"></i> 123</button>
                <button type="button" class="btn" style="border-left: 1px solid #7f7f7f;" ><i class="far fa-thumbs-down"></i> 999</button>
            </div>
        </div>
    
        <div class="col" >
            <div class="btn-group" role="group" style="float: right;" aria-label="Basic example" style="background-color: #ebecec;border-radius:6px">
                <button type="button" class="btn"><i class="far fa-comments"></i></button>
                <button type="button" class="btn" style="border-left: 1px solid #7f7f7f;" ><i class="far fa-save"></i></button>
            </div>
        </div>
    </div>
</div>
<!--  -->
<?php 
include("../template/student-footer.php");

?>