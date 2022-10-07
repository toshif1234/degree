<?php
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
if(isset($_SESSION["feed_add"]) && $_SESSION["feed_add"] == 1){
    $_SESSION["feed_add"] = 0;
    echo '<div style="width:50%;" class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Feedback Added</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  
}
else if(isset($_SESSION["feed_add"]) && $_SESSION["feed_add"] == 2){
    $_SESSION["feed_add"] = 0;
    echo '<div style="width:50%;" class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Failed to add feedback</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  
}
?>

<form action="submit_feed.php" method="post" id='form'>
<div class="row m-4">
        <div class="form-group col-4 mt-4">
          <label for="feed">Feedback Name</label>
            <input id="feed" type="text" name="feedback_name"><br>
        </div>
        <div>
        <label for="question">Add Questions</label>
        <input id="question" type="button" value="Add" onClick="add();">
        </div>
<div id="place"></div>

    <!-- <button id="button" value="Add" onClick:"add()"> -->

<input type="text" id = 'num' name="number" value='' id="" hidden>
<button onclick='submit_form()'>Submit</button>
</div>
</form>
<script>
let i = 0;
function add()
{
    i++;
    const arr = [];
    for(j = 1; j < i; j++){
        arr[j] = document.getElementById("new" + j).value;
    }
    document.getElementById("place").innerHTML+="<input type='text' id = 'new" + i + "' value='' name = 'q" + i + "'>";
    for(j = 1; j < i; j++){
        document.getElementById("new" + j).value = arr[j];
    }
}
function submit_form(){
    document.getElementById('num').value = i;
    document.getElementById('form').submit();
}
</script>
<?php
include "../template/footer-fac.php";
?>