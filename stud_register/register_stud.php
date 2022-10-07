<?php 
include("../template/admin-auth.php");
error_reporting(0);

include("../template/sidebar-admin.php");

$dept = $_POST['dept'] ?? $_SESSION['dept'];
// echo $_POST['dept'];
$_SESSION['dept'] = $dept;

$q = 'select * from students where branch ="' . $dept . '"';
// echo $q;
$result = $link->query($q);

?>

<form action="auto_gen.php" method="POST">
    <input hidden type="text" name="dept" value="<?php echo $_SESSION['dept'] ?>">
    <button style="float:right" onclick="loader()" type="submit" class="btn btn-primary m-5">Auto Generate</button>
</form>




<form action="register_proc.php" method="POST">
    <div class="form-group col-md-4">
        <label for="usn">USN</label>
        <select name="usn" class="form-control" id="usn">
            <option selected disabled>Select USN</option>
            <?php
                            foreach($result as $r){
                        ?>
            <option value="<?php echo $r['usn'] ?>"><?php echo $r['usn'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" disabled value="1234567890" id="password">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<div hidden id="loader" class="loader load-container">
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--text'></div>
</div>


<style>

.load-container {
        padding: 0;
        margin: 0;
        width: 100vw !important;
        height: 100vh !important;
        background: radial-gradient(#7d59b6bf, #4447ad);
        z-index: 99999999999999;
    }
    
.container {
  height: 100vh;
  width: 100vw;
  font-family: Helvetica;
}

.loader {
  height: 20px;
  width: 250px;
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
}
.loader--dot {
  animation-name: loader;
  animation-timing-function: ease-in-out;
  animation-duration: 3s;
  animation-iteration-count: infinite;
  height: 20px;
  width: 20px;
  border-radius: 100%;
  background-color: black;
  position: absolute;
  border: 2px solid white;
}
.loader--dot:first-child {
  background-color: #8cc759;
  animation-delay: 0.5s;
}
.loader--dot:nth-child(2) {
  background-color: #8c6daf;
  animation-delay: 0.4s;
}
.loader--dot:nth-child(3) {
  background-color: #ef5d74;
  animation-delay: 0.3s;
}
.loader--dot:nth-child(4) {
  background-color: #f9a74b;
  animation-delay: 0.2s;
}
.loader--dot:nth-child(5) {
  background-color: #60beeb;
  animation-delay: 0.1s;
}
.loader--dot:nth-child(6) {
  background-color: #fbef5a;
  animation-delay: 0s;
}
.loader--text {
  position: absolute;
  top: 200%;
  left: 0;
  right: 0;
  width: 50rem;
  margin: auto;
}
.loader--text:after {
  content: "Please wait... Student Credintial is being generated...";
  font-weight: bold;
  animation-name: loading-text;
  animation-duration: 3s;
  animation-iteration-count: infinite;
}

@keyframes loader {
  15% {
    transform: translateX(0);
  }
  45% {
    transform: translateX(230px);
  }
  65% {
    transform: translateX(230px);
  }
  95% {
    transform: translateX(0);
  }
}
@keyframes loading-text {
  0% {
    content: "Please wait... Student Credintial is being generated...";
  }
  25% {
    content: "Please wait... Student Credintial is being generated...";
  }
  50% {
    content: "Please wait... Student Credintial is being generated...";
  }
  75% {
    content: "Please wait... Student Credintial is being generated...";
  }
}
</style>


<script>
function loader() {
    //   console.log("Hello world!");
    // document.getElementsById("loader").removeAttribute("hidden");
    document.getElementById("loader").removeAttribute("hidden");
}
</script>



<?php include("../template/footer-admin.php") ?>