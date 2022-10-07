<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
// echo $ri=$_POST['sub_name1'];
echo $rn=$_POST['sub_name2'];
echo $desk=$_POST['sub_name3'];
echo $scount=$_POST['sub_name4'];
echo $block=$_POST['sub_name5'];
echo $fllor=$_POST['sub_name6'];

$r = "insert into exam_rooms(room_number,room_desk,std_count,block,floor) values ('$rn','$desk','$scount','$block','$fllor')";
  
$res=$link->query($r);

?>
<script>
window.location.href = 'addroom3.php';
</script>

<?php
include "../template/footer-fac.php";
?>