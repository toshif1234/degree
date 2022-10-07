<?php
include("../template/admin-auth.php");
include("../template/sidebar-admin.php");
// $q="select * from issue_student";
// $result=$link->query($q);


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
 $i = 'select * from issue_student where return_date="0";';
 $result = $link->query($i);
 ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table">
                    <tr>
                        <th scope="col">Sl No</th>
                        <th scope="col">USN</th>
                        <th scope="col">Book ID</th>
                        <th scope="col">Due Date</th>
                        <th scope="col">Issue Date</th>
                        <th scope="col">Return Date</th>
                        <th scope="col">Fine</th>
                        <th scope="col" colspan="10">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count=0; ?>
                    <?php foreach($result as $r){ ?>
                    <tr>
                        <div class="row">
                            <div class="col-1">
                                <form method="post" action="issue_update.php">
                                    <th style="width: 70px !important;" scope="row"><?php echo ++$count; ?></th>
                                    <td><input class="form-control" name="USN" value="<?php echo $r["usn"] ?>" readonly>
                                    </td>
                                    <td><input class="form-control" name="bookid" value="<?php echo $r["bookid"] ?>"
                                            readonly></td>
                                    <td><input class="form-control" name="duedate" value="<?php echo $r["due_date"];?>"
                                            readonly></td>
                                    <td><input class="form-control" name="issuedate"
                                            value="<?php echo $r["issue_date"];?>" readonly></td>
                                    <td><input class="form-control" type="date" name="returndate"
                                            value="<?php if($r["return_date"]!=0){echo $r["return_date"];} ?>"></td>
                                    <td><input class="form-control" name="fine" value="<?php echo $r["fine"]; ?>"></td>
                                    <td>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                        </form>
                        </td>
                        <td>
                            <form method="post" action="renewal_proc.php">
                                <input hidden name="USN" value="<?php echo $r["usn"] ?>" readonly>
                                <input hidden name="bookid" value="<?php echo $r["bookid"] ?>" readonly>
                                <input hidden name="duedate" value="<?php echo $r["due_date"];?>" readonly>
                                <input hidden name="issuedate" value="<?php echo $r["issue_date"];?>" readonly>
                                <input hidden type="date" name="returndate"
                                    value="<?php if($r["return_date"]!=0){echo $r["return_date"]; } ?>">
                                <input hidden name="fine" value="<?php echo $r["fine"]; ?>">
                        </td>
                        <td><button class="btn btn-primary " type="submit">Renweal</td>
                                </form>
                        </td>
                        <form method="post" action="bill.php">
                            <input hidden name="USN" value="<?php echo $r["usn"] ?>" readonly>
                            <input hidden name="bookid" value="<?php echo $r["bookid"] ?>" readonly>
                            <input hidden name="issuedate" value="<?php echo $r["issue_date"];?>" readonly>

                            <input hidden type="date" name="returndate"
                                value="<?php if($r["return_date"]!=0){echo $r["return_date"];} ?>">
                            <input hidden name="fine" value="<?php echo $r["fine"]; ?>"></td>
                            <td><button class="btn btn-warning " type="submit">Bill</td>
                        </form>
                        </td>
                        <td>
                            <div class="col-1">
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
        </div>
        </td>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h5>Are you sure you want to delete?</h5>
                </div>

                <div class="modal-footer">
                    <form method="post" action="view_issue_proc.php">
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
 $i = 'select * from issue_student where return_date<>"0";';
 $result = $link->query($i);
 ?>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table">
                <tr>
                    <th scope="col">Sl No</th>
                    <th scope="col">USN</th>
                    <th scope="col">Book ID</th>
                    <th scope="col">Issue Date</th>
                    <th scope="col">Return Date</th>
                    <th scope="col">Fine</th>
                    <th scope="col" colspan="10">Options</th>
                </tr>
            </thead>
            <tbody>
                <?php $count=0; ?>
                <?php foreach($result as $r){ ?>
                <tr>
                    <div class="row">
                        <div class="col-1">
                            <th style="width: 70px !important;" scope="row"><?php echo ++$count; ?></th>
                            <td><input class="form-control" name="USN" value="<?php echo $r["usn"] ?>" readonly></td>
                            <td><input class="form-control" name="bookid" value="<?php echo $r["bookid"] ?>" readonly>
                            </td>
                            <td><input class="form-control" name="issuedate" value="<?php echo $r["issue_date"];?>"
                                    readonly></td>
                            <td><input class="form-control" type="date" name="returndate"
                                    value="<?php if($r["return_date"]!=0){echo $r["return_date"];} ?>"></td>
                            <td><input class="form-control" name="fine" value="<?php echo $r["fine"]; ?>"></td>
                            <td>


                            <td>
                                <form method="post" action="bill.php">
                                    <input hidden name="USN" value="<?php echo $r["usn"] ?>" readonly>
                                    <input hidden name="bookid" value="<?php echo $r["bookid"] ?>" readonly>
                                    <input hidden name="issuedate" value="<?php echo $r["issue_date"];?>" readonly>
                                    <input hidden type="date" name="returndate"
                                        value="<?php if($r["return_date"]!=0){echo $r["return_date"];} ?>">
                                    <input hidden name="fine" value="<?php echo $r["fine"]; ?>">
                            </td>
                            <td><button class="btn btn-warning " type="submit">Bill</td>
                                    </form>
                            </td>
                            <td>
                            <div class="col-1">
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
        </div>
        </td>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h5>Are you sure you want to delete?</h5>
                </div>

                <div class="modal-footer">
                    <form method="post" action="view_issue_proc.php">
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
<!-- </td> -->
</div>
<?php } ?>
</tbody>
</table>
<?php
include("../template/footer-admin.php");
?>