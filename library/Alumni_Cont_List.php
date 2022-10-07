<?php
include("../template/admin-auth.php");
include("../template/sidebar-admin.php");
$branch = $_SESSION['branch'];
if(isset($_SESSION['flag']) && $_SESSION['flag'] == 1)
{
    $search = $_SESSION['search'];
    $query = "select bookid,title,author,edition,publications,sub,Alumni_Cont,Date_Of_Alumni,dept,usn,Alumni_Name from book where title like '%$search%' and Alumni_Cont='Yes' and dept='$branch' order by Date_Of_Alumni;"; 
    // $result=$link->query($query);
    // $_SESSION['flag'] = 0;
    $result=$link->query($query);
    // echo $query;
    unset($_SESSION['search']);
    $no_of_pages = 0;
    $this_page_first_res=0;
}
    else
{
    $results_per_page=40;
    $q = "select * from book where Alumni_Cont='Yes' and dept='$branch';";
    $res = $link->query($q);
    $nu_res = mysqli_num_rows($res);
    $no_of_pages = ceil($nu_res/$results_per_page);
    if(!isset($_GET['page'])){
        $page = 1;
    }
    else{
        $page = $_GET['page'];
    }
    $this_page_first_res = ($page-1)*$results_per_page;
    $sql = "select * from book  where Alumni_Cont='Yes' and dept='$branch' order by Date_Of_Alumni LIMIT " . $this_page_first_res . ',' . $results_per_page;
    // echo $sql;
    $result=$link->query($sql);
}
// echo $query;

?>
<style>

/* Pagination links */
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

* th {
    text-align: center;
}

td {
    vertical-align: center;
    text-align: center;
}

.form-outline {
    margin-left: 60%;
    padding: 10px;
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
<br>

<head>
<form method="post" action="Alumni_Download_Books.php">
        <div class="col-sm-12 col-md-2">
            <button type="submit" class="btn btn-primary">Download</button>
        </div>
    </form>
    <form method="post" action="alumnibookspdf.php">
        <div class="col-sm-12 col-md-4">
                <div class="form-group ">
                   
                        <label for="year1">Year</label>
                        <input type="text" name="year" class="form-control" id="year1" required>
                   
                </div>
            </div>  
        <div class="col-sm-12 col-md-2">
            <button type="submit" class="btn btn-info mt-2">Download PDF</button>
        </div>
    </form>

    


    <form method="post" action="alumnisearch.php">
    <div class="form-outline">
    <div class="row">
    <!-- <div class="col"><button class="btn btn-info" style="float: right;" onclick="location.reload()">Refresh</button></div> -->
    <div class="col">
            <input type="search" id="form1" name="search" class="form-control" placeholder="Search by Title" aria-label="Search" />
        </div> 
        </div>
</div>
    </form>
    <form action="refresh_alumi.php" method="post">
    <div class="col"><button class="btn btn-info" style="float: right;">Refresh</button></div>

    </form>
    <br>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table">
                <tr>
                    <th scope="col">Sl No</th>
                    <th scope="col">USN</th>
                    <th scope="col">Alumni_Name</th>
                    <th scope="col">Book ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Edition</th>
                    <th scope="col">Publication</th>
                    <th scope="col">Date_Of_Alumni</th>
                </tr>
            </thead>
            <tbody>
                <?php
            $i=1;
                if(isset($_SESSION['flag']) ){
                   $i=$this_page_first_res;
                }
                     $count=1;
                foreach($result as $r){ ?>
                <tr>
                    <th style="width: 70px !important;" scope="row"><?php echo $i+$count; ?></th>
                    <td><?php echo $r["usn"]?></td>
                    <td><?php echo $r["Alumni_Name"]?></td>
                    <td><?php echo $r["bookid"] ?></td>
                    <td><?php echo $r["title"]?></td>
                    <td><?php echo $r["author"]?></td>
                    <td><?php echo $r["edition"]?></td>
                    <td><?php echo $r["publications"]?></td>
                    <td><?php echo $r["Date_Of_Alumni"]?></td>
                    <td>                      
    </div>
    </td>
    </tr>
    <?php $count++;} ?>
    </tbody>
    </table>
    <a hidden href="<?php echo 'Alumni_List.xlsx' ?>" download id="down"></a>
    
    <?php
        $down = $_SESSION['down'] ?? 0;
        // echo $down;
        if($down == 1){ ?>
            <script>
                document.getElementById('down').click();
               <?php $_SESSION['down'] = 0; ?>
            </script>
        <?php
        }
    ?>
    <div class="pagination">
 <?php
 if(isset($_SESSION['flag']) && !($_SESSION['flag'])){
    if($page>1){
     echo "<a href='Alumni_Cont_List.php?page=".($page-1)."' class='button'>Previous</a>";
    }
    for( $i = 1;$i<=$no_of_pages;$i++){
        if($i == $page){
            echo "<a class='active' href='Alumni_Cont_List.php?page=$i'>$i</a>";
        }else{
            echo "<a href='Alumni_Cont_List.php.php?page=$i'>$i</a>";
        }
       
    }
    if($page<$no_of_pages){
    echo "<a href='Alumni_Cont_List.php?page=".($page+1)."' class='button'>Next</a>";
    }

}else{
$_SESSION['flag'] = 0;
}
    ?>
</div>

    <?php
include("../template/footer-admin.php");
?>