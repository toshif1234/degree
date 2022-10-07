<?php
include("../template/stud_auth.php");
include("../template/student_sidebar.php");
$usn = $_SESSION['username'];
$query="select * from request_book where usn='$usn'"; 
$result=$link->query($query);
?>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table">
                <tr>
                    <th scope="col">Sl No</th>
                    <th scope="col">BOOK ID</th>
                    <th scope="col">USN</th>
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
                    <th scope="row"><?php echo ++$count; ?></th>
                    <td><?php echo $r["bookid"] ?></td>
                    <td><?php echo $r["usn"] ?></td>
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
include("../template/footer-admin.php");
?>