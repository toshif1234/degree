<?php
include("../template/admin-auth.php");
include("../template/sidebar-admin.php");
?>
<style>
    * th {
        text-align: center;
    }

    td {
        vertical-align: center;
        text-align: center;
    }
</style>

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
            aria-selected="true">Issued Book</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
            aria-selected="false">History Of Returned Book</a>
    </li>
</ul>



<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

        <?php 
 $i = 'select * from issue_fac where return_date="0";';
 $result = $link->query($i);
 ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table">
                    <tr>
                        <th scope="col">Sl No</th>
                        <th scope="col">Faculty ID</th>
                        <th scope="col">Book ID</th>
                        <th scope="col">Issue Date</th>
                        <th scope="col">Return Date</th>
                        <th scope="col" colspan="10">Options</th>
                    </tr>

                </thead>
                <tbody>
                    <?php $count=0; ?>
                    <?php foreach($result as $r){ ?>
                    <tr>
                        <div class="row">
                            <div class="col-1">
                                <form method="post" action="fac_update.php">
                                    <th style="width: 70px !important;" scope="row">
                                        <?php echo ++$count; ?>
                                    </th>
                                    <td><input class="form-control" name="fac_id" value="<?php echo $r["fac_id"] ?>"
                                        readonly></td>
                                    <td><input class="form-control" name="bookid" value="<?php echo $r["bookid"] ?>"
                                        readonly></td>
                                    <td><input class="form-control" name="issuedate" value="<?php echo $r["issue_date"];?>" readonly></td>
                                    <td><input class="form-control" type="date" name="returndate" value="<?php if($r["return_date"]!=0){echo $r["return_date"];} ?>"></td>
                                    <td>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                        </form>
                        </td>
                        <td>
                            <form method="post" action="fac_renewal_proc.php">
                                <input hidden name="fac_id" value="<?php echo $r["fac_id"] ?>" readonly>
                                <input hidden name="bookid" value="<?php echo $r["bookid"] ?>" readonly>
                                <input hidden name="issuedate" value="<?php echo $r["issue_date"];?>" readonly>
                                <input hidden type="date" name="returndate" value="<?php if($r["return_date"]!=0){echo
                                    $r["return_date"];} ?>">
                        <td><button class="btn btn-primary " type="submit">Renweal</td>
                                </form>
                        </td>
                        <td>
                            <div class="col-1">
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop1<?php echo $count; ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
        </div>
        </td>
        </tr>
        <div class="modal fade" id="staticBackdrop1<?php echo $count; ?>" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h5>Are you sure you want to delete?</h5>
                            </div>

                            <div class="modal-footer">
                                <form method="post" action="fac_view_issue_proc.php">
                                    <input name="bookid" hidden type="text" class="form-control" value="<?php echo $r["bookid"] ?>">
                                    <button type="submit" class="btn btn-danger">Yes</button>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                        aria-label="Close">No</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        <?php } ?>
        </tbody>
        </table>

    </div>
</div>
<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <?php 
 $i = 'select * from issue_fac where return_date<>"0";';
 $result = $link->query($i);
 ?>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table">
                <tr>
                    <th scope="col">Sl No</th>
                    <th scope="col">Faculty ID</th>
                    <th scope="col">Book ID</th>
                    <th scope="col">Issue Date</th>
                    <th scope="col">Return Date</th>
                    <th scope="col" colspan="10">Options</th>
                </tr>

            </thead>
            <tbody>
                <?php $count=0; ?>
                <?php foreach($result as $r){ ?>
                <tr>
                    <div class="row">
                        <div class="col-1">
                            <th style="width: 70px !important;" scope="row">
                                <?php echo ++$count; ?>
                            </th>
                            <td><input class="form-control" name="fac_id" value="<?php echo $r["fac_id"] ?>" readonly>
                            </td>
                            <td><input class="form-control" name="bookid" value="<?php echo $r["bookid"] ?>" readonly>
                            </td>
                            <td><input class="form-control" name="issuedate" value="<?php echo $r["issue_date"];?>"
                                readonly></td>
                            <td><input class="form-control" type="date" name="returndate" value="<?php if($r["return_date"]!=0){echo $r["return_date"];} ?>"></td>
                            <td>


                            <td>
                                <input hidden name="fac_id" value="<?php echo $r["fac_id"] ?>" readonly>
                                <input hidden name="bookid" value="<?php echo $r["bookid"] ?>" readonly>
                                <input hidden name="issuedate" value="<?php echo $r["issue_date"];?>" readonly>
                                <input hidden type="date" name="returndate" value="<?php if($r["return_date"]!=0){echo
                                    $r["return_date"];} ?>">
                                </form>
                            </td>
                            <td>
                                <div class="col-1">
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop<?php echo $count; ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                        </div>
                        </td>
                </tr>

                <div class="modal fade" id="staticBackdrop<?php echo $count; ?>" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h5>Are you sure you want to delete?</h5>
                            </div>

                            <div class="modal-footer">
                                <form method="post" action="fac_view_issue_proc.php">
                                    <input name="bookid" hidden type="text" class="form-control" value="<?php echo $r["bookid"] ?>">
                                    <button type="submit" class="btn btn-danger">Yes</button>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                        aria-label="Close">No</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</div>
</form>
</td>
</div>
<?php } ?>
</tbody>
</table>
<?php
include("../template/footer-admin.php");
?>