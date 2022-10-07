<?php
include("../template/fac-auth.php");

include("../template/sidebar-fac.php");
$faculty_id1 = $_SESSION['username'];
//echo $usn;

?>
<style>
    .pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  transition: background-color .3s;
}

/* Style the active/current link */
.pagination a.active {
  background-color: dodgerblue;
  color: white;
}

/* Add a grey background color on mouse-over */
.pagination a:hover:not(.active) {background-color: #ddd;}
.form-outline{
    margin-left: 60%;
     padding:10px;
     border-radius: 10px;
   }
 
   input[type=text] {
      width: 30%;
      -webkit-transition: width 0.15s ease-in-out;
      transition: width 0.15s ease-in-out;
   }

   input[type=text]:focus {
     width: 70%;
   } 
</style> 
<form method="post" action="display_books.php">
<div class="form-outline" >
    <div class="row">
        <!-- <div class="col"><button class="btn btn-info" style="float: right;" onclick="location.reload()">Refresh</button></div> -->
        <div class="col">
            <input type="search" id="form1" name="search" class="form-control" placeholder="Search By Subject" aria-label="Search" />

        </div>
    </div>
    

</div>
</form>
<form action="refresh_fac.php" method="post">
    <div class="col"><button class="btn btn-info" style="float: right;">Refresh</button></div>

    </form>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                aria-selected="true">Available Books</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                aria-selected="false">History</a>
        </li>
    </ul>
    
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <?php
            $q5="select faculty_dept from faculty_details where faculty_name='$faculty_id1';";
            $branch=mysqli_fetch_assoc($link->query($q5))['faculty_dept'];
        if(isset($_SESSION['flag']) && $_SESSION['flag'] == 1 )
{
    $search = $_SESSION['search'];
    $query = "select bookid,title,author,edition,publications,sub,Alumni_Cont,Date_Of_Alumni,dept,usn,Alumni_Name from book where sub like '%$search%' and dept='$branch';"; 
    $result=$link->query($query);
    
    unset($_SESSION['search']);
    $no_of_pages = 0;
    $this_page_first_res=1;
}
else
{
    $results_per_page=40;
    $q = "select * from book where flag=0 and dept='$branch';";
    $res = $link->query($q);
    $nu_res = mysqli_num_rows($res);
    $no_of_pages = ceil($nu_res/$results_per_page);
    if(!isset($_GET['page'])){
        $page = 1;
    }
    else{
        $page = $_GET['page'];
    }
    $this_page_first_res = ($page-1)*$results_per_page+1;
    $sql = "select * from book where flag=0 and dept='$branch' LIMIT " . $this_page_first_res . ',' . $results_per_page;
    $result=$link->query($sql);
}

?>
           
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table">
                        <tr>
                            <th scope="col">Sl No</th>
                            <th scope="col">Book ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Edition</th>
                            <th scope="col">Publication</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Option</th>
                            

                        </tr>
                    </thead>
                    <tbody>
                    <?php
                $i=1;
                if(isset($_SESSION['flag']) && $_SESSION['flag'] == 0){
                   $i=$this_page_first_res;
                }
                     $count=0;
            ?>
                        <?php foreach($result as $r){ ?>
                        <tr>
                            <th style="width: 70px !important;"><?php echo $i+$count; ?></th>
                            <td style="width: 100px !important;"><?php echo $r["bookid"] ?></td>
                            <td><?php echo $r["title"]?></td>
                            <td><?php echo $r["author"]?></td>
                            <td><?php echo $r["edition"]?></td>
                            <td><?php echo $r["publications"]?></td>
                            <td><?php echo $r["sub"]?></td>
                            <form method="post" action="Request_proc.php">
                            <td>
                            <button id="button1" type="submit" class="btn btn-primary">Request</button>
                        <input type="text" name="bookid1" value="<?php echo $r["bookid"] ?>" hidden></td></form>
                        </tr>
                        <?php $count++;} ?>
                    </tbody>
                </table>
                <div class="pagination">
 <?php
 if(isset($_SESSION['flag']) && $_SESSION['flag'] == 0){
    if($page>1){
     echo "<a href='books_details.php?page=".($page-1)."' class='button'>Previous</a>";
    }
    for( $i = 1;$i<=$no_of_pages;$i++){
        if($i == $page){
            echo "<a class='active' href='books_details.php?page=$i'>$i</a>";
        }else{
            echo "<a href='books_details.php?page=$i'>$i</a>";
        }
       
    }
    if($page<$no_of_pages){
    echo "<a href='books_details.php?page=".($page+1)."' class='button'>Next</a>";
    }

}
else
{
    $_SESSION['flag'] = 0;
}
    ?>
    </div>
                
            </div>
        </div>

        <!-- history tab-->
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <?php
        $x = "select faculty_id from faculty_details where faculty_name='$faculty_id1';";
            $r1 = $link->query($x);
            $row1 = $r1 -> fetch_assoc();
            $faculty_id = $row1['faculty_id'];
            $q="select * from issue_fac where fac_id ='$faculty_id'";
            $result12=$link->query($q);
            
            ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table">
                        <tr>
                            <th scope="col">Sl No</th>
                            <th scope="col">Book ID</th>
                            <th scope="col">Issue Date</th>
                            <th scope="col">Return Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count=0; 
                        // print_r($result12);
                         foreach($result12 as $r){ ?>
                        <tr>
                            <th  scope="row"><?php echo ++$count; ?></th>
                            <td  ><?php echo $r["bookid"] ?></td>
                            <td><?php echo $r["issue_date"]?></td>
                            <td><?php echo $r["return_date"]?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
                        
<?php
include("../template/footer-fac.php");
?>
