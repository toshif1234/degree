<?php
include("../template/admin-auth.php");
include("../template/sidebar-admin.php");

// $q2="SELECT distinct YEAR(return_date) as year FROM `issue_student` WHERE return_date IS NOT NULL GROUP BY MONTH(return_date)";


// $result = $link->query($q2);
// echo $q2;



// while($row = $res -> mysqli_fetch_array($q1)){
// $fine = $row['finetotalamount'];
// echo $fine;
// $row=$row++;
// }
// while ($row1 = mysql_fetch_array($q1))
?>
<html>
<head>
<style>
        .table td {
text-align: center;
} 
.table th {
text-align: center;
} 
</style>
</head>
<body>
  <?php
  // foreach($result as $r){
  //   echo "<p>" . $r['year'] . "</p>";
    
    $q1="SELECT  YEAR(return_date) as year,MONTH(return_date) as month,SUM(fine) finetotalamount FROM `issue_student` WHERE return_date IS NOT NULL and return_date LIKE '%" . $_POST['year'] . "%' GROUP BY MONTH(return_date) ";
    $res=$link->query($q1);
    // echo $q1;
    $month = array(
      '1' => 'JANUARY',
      '2' => 'FEBRUARY',
      '3' => 'MARCH',
      '4' => 'APRIL',
      '5' => 'MAY',
      '6' => 'JUNE',
      '7' => 'JULY',
      '8' => 'AUGUST',
      '9' => 'SEPTEMBER',
      '10' => 'OCTOBER',
      '11' => 'NOVEMBER',
      '12' => 'DECEMBER'
    );
    foreach($res as $r2){
      $fine[$r2['month']] = $r2['finetotalamount'];
    }


  ?>
<table class="table">
  
  <thead>
  
    
    <tr>
      <th >Month</th>
      <th >Fine</th>
    </tr>
  </thead>
  <tbody>
<?php
$c = array_keys($month);
$i=0;
foreach($month as $mon){
?> 
    <tr>
      <td><?php echo $mon ?></td>
      <td><?php
      if(isset($fine[$c[$i]]))
      {
        echo $fine[$c[$i]];
      }
      else
      {
        echo "No fine";
      } 
       
      $i++;?></td>
    </tr>
<?php } ?>

  </tbody>
</table>
<?php  ?>
</body>   
</html>
<?php 
include("../template/footer-admin.php");
?>