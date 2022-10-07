<?php
include("../template/admin-auth.php");
include("../template/sidebar-admin.php");
$alumni_cont=$_POST['alumni_cont'] ?? $_SESSION['alumni_cont'];
$_SESSION['alumni_cont'] = $alumni_cont;
?>





<style>
        @media screen and (min-width: 320px) {
            .import-btn {
                margin-left: 80%;
            }

        }
    </style>
    <?php
if(isset($_SESSION["flag"]) && $_SESSION["flag"] == 1){
    $_SESSION["flag"] = 0;
    echo '<div style="width:50%;" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>failed</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  
}
// if(isset($_SESSION["bookid"]) && $_SESSION["bookid"] == 1){
//     $_SESSION["popup"] = 0;
//     echo '<div style="width:50%;" class="alert alert-warning alert-dismissible fade show" role="alert">
//     <strong>Sucessful</strong> 
//     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//       <span aria-hidden="true">&times;</span>
//     </button>
//   </div>';
  
// }
// else if(isset($_SESSION["popup"]) && $_SESSION["popup"] == 2){
//     $_SESSION["popup"] = 0;
//     echo '<div style="width:50%;" class="alert alert-danger alert-dismissible fade show" role="alert">
//     <strong>failed</strong> 
//     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//       <span aria-hidden="true">&times;</span>
//     </button>
//   </div>';
  
// }

?>
<div class="row">
<div class="col-sm-10"></div>
            <div class="modal fade" id="exampleModalimport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Import</h5>
                            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                                <span style="font-size: 25px;" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="book_upload.php" method="post" enctype="multipart/form-data">
                                <input type="file" class="form-control-file" name="xl" id="fileToUpload" required accept=".xlsx">
                                <!-- only xlsx files are accetped -->
                                <br>
                                <div class="row">
                                    <div class="col"><input class="btn btn-primary" type="submit" value="Upload" onClick="upload_loading()" name="submit">
                                </div>
                                    <div class="col" hidden id="upload_loading">
                                        <strong>Uploading...</strong>
                                        <div class="spinner-border ml-auto"   role="status" aria-hidden="true"></div></div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>
            
            <!-- <form method="post" action="Downloadformat.php">
        <div class="col-sm-12 col-md-2">
            <button type="submit" class="btn btn-primary">Export</button>
        </div>
    </form> -->

    <a class="btn btn-primary" href="<?php echo 'bookformat.xlsx' ?>" download id="down">Export</a>

            <script>
                function upload_loading() {
                    file = document.getElementById("fileToUpload");
                    console.log(file.value);
                    if(file.value != ''){
                    document.getElementById('upload_loading').removeAttribute('hidden');
                    }
                }
            </script>

            <div class="col-sm-1 ml-2 mb-2 ">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalimport">
                    Import
                </button>
                <!-- <button type="file">Upload</button> -->
            </div>
        </div>

<?php
if($alumni_cont == "Yes"){
?>
<div class="container">
<form method="post" action="add_book_proc.php">
<div class="row" style="align-items: center;
    justify-content: center;
    align-content: center;
    flex-direction: row;">
<!-- <div class="col-sm-12 col-md-4">
                <div class="form-group ">
                    <div >
                        <label for="bookid1">Book ID:</label>
                        <input type="text" name="bookid" class="form-control" id="bookid1" required>
                    </div>
                </div>
            </div> -->
            <div class="col-sm-12 col-md-4">
                <div class="form-group ">
                    <div >
                        <label for="title1">Title:</label>
                        <input type="text" name="title" class="form-control" id="title1" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group ">
                    <div >
                        <label for="author1">Author:</label>
                        <input type="text" name="author" class="form-control" id="author1" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group ">
                    <div >
                        <label for="edition1">Edition:</label>
                        <input type="text" name="edition" class="form-control" id="edition1" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group ">
                    <div >
                        <label for="publication1">Publication:</label>
                        <input type="text" name="publication" class="form-control" id="publication1" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group ">
                    <div >
                        <label for="sub1">Subject:</label>
                        <input type="text" name="subject" class="form-control" id="sub1" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4" class="form-group">
               <label for="dept">Department:</label>
               <select class="form-control" name="dept" id="dept1">
               <option value="Computer Science and Engineering">Computer Science and Engineering</option>
               <option value="Information Science and Engineering">Information Science and Engineering</option>
               <option value="Electronics and Communication Engineering">Electronics and Communication Engineering</option>
               <option value="Civil Engineering">Civil Engineering</option>
               <option value="Mechanical Engineering">Mechanical Engineering</option>
               <option value="Artificial Intelligence and Machine Learning">Artificial Intelligence and Machine Learning</option>
               </select>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group ">
                    <div >
                        <label for="Date">Date of Conrtibution:</label>
                        <input type="date" name="Date" class="form-control" id="Date" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group ">
                    <div >
                        <label for="Date">USN:</label>
                        <input type="text" name="usn" class="form-control" id="usn" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group ">
                    <div >
                        <label for="Alumni_name">Alumni Name:</label>
                        <input type="text" name="Alumni_name" class="form-control" id="Alumni_name" required>
                    </div>
                </div>
            </div>
            <div class="col col-4 col-md-4 col-lg-4">
                <label for="sub" class="mb-2"></label>
                <button type="submit" class="btn btn-info mt-4"> Submit </button>
            </div>
</form>  
           
</div>
</div>
<?php   } 
else  {?>
<div class="container">
<form method="post" action="add_book_proc.php">
<div class="row" style="align-items: center;
    justify-content: center;
    align-content: center;
    flex-direction: row;">
<!-- <div class="col-sm-12 col-md-4">
                <div class="form-group ">
                    <div >
                        <label for="bookid1">Book ID:</label>
                        <input type="text" name="bookid" class="form-control" id="bookid1" required>
                    </div>
                </div>
            </div> -->
            <div class="col-sm-12 col-md-4">
                <div class="form-group ">
                    <div >
                        <label for="title1">Title:</label>
                        <input type="text" name="title" class="form-control" id="title1" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group ">
                    <div >
                        <label for="author1">Author:</label>
                        <input type="text" name="author" class="form-control" id="author1" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group ">
                    <div >
                        <label for="edition1">Edition:</label>
                        <input type="text" name="edition" class="form-control" id="edition1" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group ">
                    <div >
                        <label for="publication1">Publication:</label>
                        <input type="text" name="publication" class="form-control" id="publication1" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group ">
                    <div >
                        <label for="sub1">Subject:</label>
                        <input type="text" name="subject" class="form-control" id="sub1" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4" class="form-group">
               <label for="dept">Department:</label>
               <select class="form-control" name="dept" id="dept1">
               <option value="CSE">Computer Science and Engineering</option>
               <option value="ISE">Information Science and Engineering</option>
               <option value="ECE">Electronics and Communication Engineering</option>
               <option value="CV">Civil Engineering</option>
               <option value="ME">Mechanical Engineering</option>
               <option value="AI">Artificial Intelligence and Machine Learning</option>
               </select>
            </div>
            <div class="col col-4 col-md-4 col-lg-4">
                <label for="sub" class="mb-2"></label>
                <button type="submit" class="btn btn-info mt-4"> Submit </button>
            </div>
</form>  
            
</div>
</div>
<a hidden href="<?php echo 'bookformat.xlsx' ?>" download id="down"></a>
    
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
<?php }
include("../template/footer-admin.php");
?>