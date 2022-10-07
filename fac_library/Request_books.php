<?php
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
$fac_id = $_SESSION['username'];
$query="select * from request_book_fac"; 
$result=$link->query($query);
?>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table">
                <tr>
                    <th scope="col">Sl No</th>
                    <th scope="col">Faculty ID</th>
                    <th scope="col">Book ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Edition</th>
                    <th scope="col">Publication</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Request_date</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php $count=0; ?>
                <?php foreach($result as $r){ ?>
                <tr>
                    <th style="width: 70px !important;" scope="row"><?php echo ++$count; ?></th>
                    <td style="width: 100px !important;"><?php echo $r["fac_id"] ?></td>
                    <td style="width: 100px !important;"><?php echo $r["bookid"] ?></td>
                    <td><?php echo $r["title"]?></td>
                    <td><?php echo $r["author"]?></td>
                    <td><?php echo $r["edition"]?></td>
                    <td><?php echo $r["publications"]?></td>
                    <td><?php echo $r["sub"]?></td>
                    <td><?php echo $r["date"]?></td>
                 </tr>
<?php } ?>
</tbody>
</table>
</div>
<?php
include("../template/footer-fac.php");
?>