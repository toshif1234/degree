<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
//session_start();
$date =  $_SESSION['date'];
$session = substr($date, -2);
$date1 = substr($date, 0, 10);

//$se=$_SESSION['session'];
$q="select * from exam_duty 
where date='$date1' and session='$session'
order by case when duty='Room Duty' then 1
when duty='Reserve' then 2
when duty='Relive' then 3 
else NULL end";
$res = $link->query($q);

?>

<form action="updateems1.php" method="POST">
  <h4>Exam Duty Details</h4><br>

  <a href="emspdf.php" class="btn btn-danger" style="margin-left: 88%;">Print Details</a>
<br><br>
  <div>
    <table id="customers">
      <?php
      if ($res->num_rows > 0) {
        $counter=0;
      ?>
        <tr>
          <th> SI No. </th>
          <!-- <th>Room Number</th> -->
          <th>Date</th>
          <th>Faculty ID</th>
          <th>Faculty Name</th>
          <th>Session</th>
          <th>Sem</th>
          <th>Duty</th>
          <th>Update</th>
        </tr>
        <?php
        foreach ($res as $row) {
        ?>
          <tr>
            <?php $si = $row["si_no"] ?>
            <td><?php echo ++$counter ?></td>
            <td><?php echo $row["date"] ?></td>
            <td><?php echo $row["faculty_id"] ?></td>
            <td><?php echo $row["faculty_name"] ?></td>
            <td><?php echo $row["session"] ?></td>
            <td><?php echo $row["sem"] ?></td>
            <td><?php echo $row["duty"] ?></td>
            <td><a href="updateems1.php?du=<?php echo $row["duty"] ?>&si=<?php echo $si ?>" class="btn btn-info">Edit</a></td>
          </tr>
  </div>




<?php
        }
      } else {
        echo "<center><h3> Records Not Found</h3></center>";
      }

?>

<style>
  #customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  #customers td,
  #customers th {
    border: 1px solid #ddd;
    padding: 8px;
  }

  #customers tr:nth-child(even) {
    background-color: white;
  }

  #customers tr:nth-child(odd) {
    background-color: white;
  }

  #customers tr:hover {
    background-color: #f2f2f2;
  }

  #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color:#7386d5;
    color: white;
  }
</style>

<?php
include("../template/footer-fac.php") ?>