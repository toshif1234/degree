<?php
include("../template/admin-auth.php");
include("../template/sidebar-admin.php");
if(isset($_POST['branch'])){
$_SESSION['branch']=$_POST['branch'];
$dept = $_SESSION['branch'] ;
}
else
{
    $dept = $_SESSION['branch'] ;
}
if(isset($_SESSION['flag']) && $_SESSION['flag'] == 1 )
{
    $search = $_SESSION['search'];
    $query = "select bookid,title,author,edition,publications,sub,Alumni_Cont,Date_Of_Alumni,dept,usn,Alumni_Name from book where sub like '%$search%' and dept='$dept'"; 
    // echo $query;
    $result=$link->query($query);
    // $_SESSION['flag'] = 0;
    unset($_SESSION['search']);
    $no_of_pages = 0;
    $this_page_first_res=0;
}
else
{
    // $_SESSION['flag'] = 0;
    $results_per_page=20;
    $q = "select * from book where dept='$dept'";
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
    $sql = "select * from book where dept='$dept' LIMIT " . $this_page_first_res . ',' . $results_per_page;
    // echo $sql;
    $result=$link->query($sql);
}

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
    
    <form method="post" action="Download_Books.php">
        <div class="col-sm-12 col-md-2">
            <button type="submit" class="btn btn-primary">Download Excel</button>
        </div>
    </form>
    <form method="post" action="Download_Books.php">
        <div class="col-sm-12 col-md-2">
            <a href="viewbookspdf.php" class="btn btn-info mt-2">Download PDF</a>
        </div>
    </form>
  
    
    <form method="post" action="DisplayBooks.php">
    <div class="form-outline">
    <div class="row">
    <!-- <div class="col"><button class="btn btn-info" style="float: right;" onclick="location.reload()">Refresh</button></div> -->
    <div class="col">
            <input type="search" id="form1" name="search" class="form-control" placeholder="Search by Subject" aria-label="Search" />
        </div> 
        </div>
</div>
    </form>
    <form action="refresh.php" method="post">
    <div class="col"><button class="btn btn-info" style="float: right;">Refresh</button></div>

    </form>

    <form method="post" action="Alumni_Cont_List.php">
        <div class="form-group">
        </div>
        <button type="submit" class="btn btn-primary">Alumni Contribution</button>
        </div>
    </form>

    <br>
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
                    <th scope="col">Alumni Contribution</th>
                    <th scope="col">Date Of Contribution</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i=1;
                if(isset($_SESSION['flag']) ){
                   $i=$this_page_first_res;
                }
                     $count=1;
                    //  $_SESSION['flag'] = 0;
            ?>
                <?php foreach($result as $r){ ?>
                <tr>
                    <th style="width: 70px !important;" scope="row"><?php echo $i+$count; ?></th>
                    <td style="width: 100px !important;"><?php echo $r["bookid"] ?></td>
                    <td><?php echo $r["title"]?></td>
                    <td><?php echo $r["author"]?></td>
                    <td><?php echo $r["edition"]?></td>
                    <td><?php echo $r["publications"]?></td>
                    <td><?php echo $r["sub"]?></td>
                    <td><?php echo $r["Alumni_Cont"]?></td>
                    <td><?php echo $r["Date_Of_Alumni"]?></td>
                    <td>
                        <div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn  btn-warning m-2 btn-sm" data-bs-toggle="modal"
                                data-bs-target="#exampleModal<?php echo $r["bookid"] ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn  btn-danger m-2 btn-sm" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop<?php echo $r["bookid"] ?>">
                                <i class="fas fa-trash"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?php echo $r["bookid"] ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                            <button type="button" class="close btn" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span style="font-size: 25px;" aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="container">

                                                <form action="viewbooksedit_book_proc.php" method="post">
                                                    <div class="row">
                                                        <div class="mb-3 col-md-6">
                                                            <label for="exampleInputPassword1" class="form-label">Book
                                                                Id</label>
                                                            <input name="bookid1" type="text"
                                                                value="<?php echo $r["bookid"]?>" class="form-control"
                                                                id="exampleInputPassword1" readonly>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="exampleInputPassword1"
                                                                class="form-label">Title</label>
                                                            <input name="title1" type="text" class="form-control"
                                                                id="exampleInputPassword1"
                                                                value="<?php echo $r["title"]?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="mb-3 col-md-6">
                                                            <label for="exampleInputPassword1"
                                                                class="form-label">Author</label>
                                                            <input name="author1" type="text" class="form-control"
                                                                id="exampleInputPassword1"
                                                                value="<?php echo $r["author"]?>">
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="exampleInputPassword1"
                                                                class="form-label">Edition</label>
                                                            <input name="edition1" type="text" class="form-control"
                                                                id="exampleInputPassword1"
                                                                value="<?php echo $r["edition"]?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="mb-3 col-md-6">
                                                            <label for="exampleInputPassword1"
                                                                class="form-label">Publication</label>
                                                            <input name="publication1" type="text" class="form-control"
                                                                id="exampleInputPassword1"
                                                                value="<?php echo $r["publications"]?>">
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="exampleInputPassword1"
                                                                class="form-label">Subject</label>
                                                            <input name="subject1" type="text" class="form-control"
                                                                id="exampleInputPassword1"
                                                                value="<?php echo $r["sub"]?>">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="mb-3 col-md-6">
                                                            <label for="exampleInputPassword1"
                                                                class="form-label">Alumni_Cont</label>
                                                            <input name="alumni_cont" type="text" class="form-control"
                                                                id="exampleInputPassword1"
                                                                value="<?php echo $r["Alumni_Cont"]?>">
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="exampleInputPassword1"
                                                                class="form-label">Date_Of_Alumni</label>
                                                            <input name="Date" type="date" class="form-control"
                                                                id="exampleInputPassword1"
                                                                value="<?php echo $r["date_of_alumni"]?>">
                                                        </div>
                                                    </div>

                                            </div>

                                            <div class="col-md-1 text-center">
                                            </div>


                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop<?php echo $r["bookid"] ?>" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Delete</h5>
                                        <button type="button" class="close btn" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span style="font-size: 25px;" aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Are you sure you want to delete?</h5>
                                    </div>

                                    <div class="modal-footer">
                                        <form method="post" action="viewbooksdelete_book_proc.php">
                                            <input name="bookid" hidden type="text" class="form-control"
                                                value="<?php echo $r["bookid"] ?>">
                                            <button type="submit" class="btn btn-danger">Yes</button>
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                                aria-label="Close">No</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
    </div>
    </div>
    </td>
    </tr>
    <?php $count++;} ?>
    </tbody>
    </table>
    <a hidden href="<?php echo 'library.xlsx' ?>" download id="down"></a>
    
<?php
    $down = $_SESSION['down'] ?? 0;
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
//  echo $_SESSION['flag'];
 if(isset($_SESSION['flag']) && !($_SESSION['flag'])){
    if($page>1){
     echo "<a href='view_books.php?page=".($page-1)."' class='button'>Previous</a>";
    }
    for( $i = 1;$i<=$no_of_pages;$i++){
        if($i == $page){
            echo "<a class='active' href='view_books.php?page=$i'>$i</a>";
        }else{
            echo "<a href='view_books.php?page=$i'>$i</a>";
        }
       
    }
    if($page<$no_of_pages){
    echo "<a href='view_books.php?page=".($page+1)."' class='button'>Next</a>";
    }

}
else
{
    $_SESSION['flag'] = 0;
}
    ?>
</div>

    <?php
include("../template/footer-admin.php");
?>