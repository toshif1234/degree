<?php
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
error_reporting(0);

$_SESSION['sub'] = $_POST['sub'];
$_SESSION['feedback_name'] = $_POST['feedback_name'];
// echo $_SESSION['feedback_name'];
$q_sem='select sem,sub_code from subjects_new where sub_name="'.$_SESSION['sub'].'"';
$r_sem=mysqli_fetch_assoc($link->query($q_sem));
// echo $r_sem['sem'];
$sem=$r_sem['sem'];
$subcode=$r_sem['sub_code'].' - '.$_SESSION['sub'];
// echo $subcode;
$feed='select * from feedback_response where sem="'.$sem.'" and feedback_name="'.$_SESSION['feedback_name'].'"and sub="'.$subcode.'"';
$r_feed=$link->query($feed);
// print_r($r_feed);
$count=0;
foreach($r_feed as $r)
{
    print_r($r);
    print_r("\n");
}
for($i=1;$i<$count;$i++)
{
    if($r_feed['q'.$i]=='0')
    {
        $count=$count+1;
        break;
    }
}
print_r($count);
// for(i=1;i<=$count;i++)
// { 
//     foreach($r_feed as $s)
//     {
//         question.$i+=$s['q'.$i];
//     }
// }

?>
<div>
    
        <div class="row">
            <div class="col">
                <div id="chart">
                    <canvas id="myChart" style="width:100%;max-height:500px;min-height:300px;"></canvas>
                </div>
            </div>
        </div>
    
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    
</script>
<script >
    var ratings = [];
    var questions = []
    // var i = 0;
    // var j = 0;
    // <?php 
    // foreach($subcode as $s){
    // ?>
    //     subjects[i++] = "<?php echo $s ?>";
    // <?php   
    // foreach($marks as $m){
    // ?>
    //     marks[j++] = "<?php echo $m ?>";

    // console.log(subjects);
    // console.log(marks);
    
</script>
<script>


var myChart = new Chart("myChart", {
    type: 'bar',
    data: {
        labels: questions,
        datasets: [{
            label: 'Marks',
            data: ratings,
            backgroundColor: [
                '#ffe6b877'

            ],
            borderColor: [
                '#fea90f'
            ],
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            },
            yAxes: [{
            ticks: {
                fontSize: 14
            }
        }],
        xAxes: [{
            ticks: {
                fontSize: 14
            }
        }]
        },

    }
});
</script>







<?php
include "../template/footer-fac.php";
?>