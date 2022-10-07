<?php
include("../template/admin-auth.php");
include("../template/sidebar-admin.php");
$usn = $_SESSION['username'];
$query="select * from request_book"; 
$result=$link->query($query);
if(isset($_SESSION["count"]) && $_SESSION["count"] == 1){
    $_SESSION["count"] = 0;
    echo '<div style="width:50%;" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Request Accepted </strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  
}
if(isset($_SESSION["count1"]) && $_SESSION["count1"] == 1){
    $_SESSION["count1"] = 0;
    echo '<div style="width:50%;" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Request Rejected </strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  
}
?>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table">
                <tr>
                    <th scope="col">Sl No</th>
                    <th scope="col">USN</th>
                    <th scope="col">Book ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Edition</th>
                    <th scope="col">Publication</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Request_date</th>
                    <th scope="col">Options</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php $count=0; ?>
                <?php foreach($result as $r){ ?>
                <tr>
                    <th style="width: 70px !important;" scope="row"><?php echo ++$count; ?></th>
                    <td><?php echo $r["usn"] ?></td>
                    <td style="width: 100px !important;"><?php echo $r["bookid"] ?></td>
                    <td><?php echo $r["title"]?></td>
                    <td><?php echo $r["author"]?></td>
                    <td><?php echo $r["edition"]?></td>
                    <td><?php echo $r["publications"]?></td>
                    <td><?php echo $r["sub"]?></td>
                    <td><?php echo $r["date"]?></td>
                    <form action="accept_req.php" method="post">
                    <td>
                    <button id="button1" type="submit" class="btn btn-primary">Accept</button>
                    <input type="text" name="bookid" value="<?php echo $r["bookid"] ?>" hidden>
                    </td>
                    </form>
                    <form action="reject.php" method="post">
                    <td>
                    <button  id="button1" type="submit" class="btn btn-danger">Reject</button>
                        <input type="text" name="bookid" value="<?php echo $r["bookid"] ?>" hidden>
                    </td>
                    </form>
                </tr>
<?php } ?>
</tbody>
</table>
</div>
<?php
include("../template/footer-admin.php");
?>