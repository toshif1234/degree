<?php
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";


// echo $_SESSION['feedback_name'];
if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
    $q_sem='select sem,sub_code from subjects where sub_name="'.$_SESSION['sub'].'"';
}
else{
    $q_sem='select sem,sub_code from subjects_new where sub_name="'.$_SESSION['sub'].'"';
}
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
    for($i=1;$i<=30;$i++)
    {
        if($r['q'.$i]!=0)
        {
            $count=$count+1;
        }
    }
    break;
}
// print_r($count);
$ratings=array();
$rating=array();
$subsq=array();
$rows=mysqli_num_rows($r_feed);
for($i=1;$i<=$count;$i++)
{ 
    $question=0;
    foreach($r_feed as $s)
    {
        $question=$question+$s['q'.$i];
    }
    $ratings[]=round($question/$rows,1);
    
}
// print_r($ratings[10]+$ratings[11]+$ratings[12]+$ratings[13]+$ratings[15]+$ratings[16]);
    // echo"<br>";
$rating[]=round(($ratings[0]+$ratings[1]+$ratings[2]+$ratings[3])/4,1);
$rating[]=round(($ratings[4]+$ratings[5]+$ratings[6]+$ratings[7]+$ratings[8]+$ratings[9])/6,1);
$rating[]=round(($ratings[10]+$ratings[11]+$ratings[12]+$ratings[13]+$ratings[14]+$ratings[15])/6,1);
$rating[]=round(($ratings[16]+$ratings[17]+$ratings[18]+$ratings[19]+$ratings[20]+$ratings[21])/6,1);
$rating[]=round(($ratings[22]+$ratings[23]+$ratings[24]+$ratings[25]+$ratings[26])/5,1);
// print_r($rating);
array_push($subsq,"Class Control","Helping Attitude","Subject Command","Time Sense","Use of Teacing Aid");
// print_r($subsq);
?>
<style>
    #Back-btn{display: none;}
</style>
<div>
    <!-- <h1>Welcome <?php echo $_SESSION["username"] ?> </h1> -->
    
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
    var subsq = [];
    var rating = []
    var i = 0;
    var j = 0;
    <?php 
    foreach($subsq as $s){
    ?>
        subsq[i++] = "<?php echo $s ?>";
    <?php   }
    foreach($rating as $m){
    ?>
        rating[j++] = "<?php echo $m ?>";
    <?php } ?>
    console.log(subsq);
    console.log(rating);
    
</script>
<script>


var myChart = new Chart("myChart", {
    type: 'bar',
    yAxes:{maximum: 5},
    data: {
        labels: subsq,
        datasets: [{
            label: 'rating',
            data: rating,
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
            yAxes: [{
                ticks: {
                    // max : 5
                    beginAtZero: true
                    // suggestedMax : 5
                }
            }]
        }
    }
    // options: {
    //     scales: {
    //         // y: 
    //         //     beginAtZero: true
    //         // ,
    //         yAxes: [{
    //         ticks: {
    //             // beginAtZero:true
    //             fontSize: 14
    //         }
    //     }],
    //     xAxes: [{
    //         ticks: {
    //             fontSize: 14
    //         }
    //     }]
    //     },

    // }
});
</script>





<a href='download'><button>Link To freeCodeCamp</button></a>




<?php
include "../template/footer-fac.php";
?>