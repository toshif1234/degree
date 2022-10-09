<?php

include_once "../template/admin-auth.php";
include_once "../template/sidebar-admin.php";
$q1 = 'select * from coordinator where class_cordinator<>0';
$result = $link->query($q1);


    

?>

<div class="container">

<table class="table">
  <thead>
    <tr>
      <th scope="col">Faculty ID</th>
      <th scope="col">CLASS COORDINATOR</th>
      <th scope="col">Course</th>
      <th scope="col">SEM-SEC</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
      <?php foreach($result as $r){?>
    <tr>
      <td><?php echo $r["faculty_id"] ?></td>
      <td><?php echo $r["name"] ?></td>
      <td><?php echo $r["branch"] ?></td>
      <td><?php echo $r["class_cordinator"] ?></td>
      <td>
        <!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $r["faculty_id"] ?>">
  Remove
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal<?php echo $r["faculty_id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?php echo $r["faculty_id"] ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel<?php echo $r["faculty_id"] ?>"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h4>Are you sure you want to remove: </h4>
      <h6><?php echo $r["name"] ?></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <form action="delete_class.php" method="post">
            <input hidden type="text" name="fac_id" value="<?php echo $r["faculty_id"] ?>">
            <button type="submit" class="btn btn-primary">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>

      </td>
    </tr>
  <?php } ?>
  </tbody>
</table>


</div>



<?php 

include_once "../template/footer-admin.php";

?>