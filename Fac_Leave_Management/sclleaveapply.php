<?php
// require_once "../config.php";
include("../template/fac-auth.php");
$con=$link;

include("../template/sidebar-fac.php");
?>      <style>
            .label2 
            {
                background-color: rgb(50, 113, 124);
                color: white;
                padding: 0.5rem;
                font-family: sans-serif;
                border-radius: 0.3rem;
                cursor: pointer;
            }
        </style>
        <h4 style="text-align:center">Apply for SCL</h4><br>
            <div style="margin-left:20%;margin-right:20%">
      		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        		<table   class="table table-responsive table-borderless">
        			<tr>
        				<th></th>
                        <th></th>
        				<th></th>
        			</tr>
        			<tr>
        				<td>Reason<br></td>
                        <td></td>
                        <td> 
                            <input type = "text" name="reason" class = "form-control" id = "reason" placeholder = "Enter the Reason" required>   
        				</td>
        			</tr>

                    <tr>
                        <td> From <br></td>
                        <td></td>
                        <td> 
                            <input type = "date" name="from_date" class="form-control" min="<?php echo date('Y-m-d') ?>" required>
                        </td>
                    </tr>

                    <tr>
                        <td>To <br></td>
                        <td></td>
                        <td> <input type = "date" name="to_date" class="form-control" min="<?php echo date('Y-m-d') ?>" required></td>
                    </tr>
                    <tr>
                        <td>Upload Document<br></td>
                        <td></td>
                        <td>
                            <input type="file" name="fileupload" id="actual-btn" hidden required/>
                            <label class="label2" for="actual-btn">Choose File</label>
                            <input type="hidden" name="MAX_FILE_SIZE" required value="100000">
                            <span id="file-chosen">No file chosen</span>
                            <input type="hidden" name="MAX_FILE_SIZE" value="100000">
                        </td>
                    </tr>
                </table>
                <?php
                            if(isset($_POST["Submit"]))
                            {
                                $s='select * from faculty_details where faculty_name="' . $_SESSION["username"] . '"';
                                $res = $link->query($s);
                                $res = mysqli_fetch_assoc($res);
                                $reason = $_POST["reason"];
                                $date = date('Y-m-d');
                                $from = $_POST["from_date"];
                                $to = $_POST["to_date"];
                                $target_dir="../leave_doc/scl_doc/";
                                $filename=$_FILES["fileupload"]["name"];
                                $tmpname=$_FILES["fileupload"]["tmp_name"];
                                $filetype=$_FILES["fileupload"]["type"];
                                $errors=[];
                                $fileextensions=["pdf","jpeg","jpg","png"];
                                $arr=explode(".",$filename);
                                $ext=strtolower(end($arr));
                                $uploadpath=$target_dir.basename($filename);
                                $q1 = "select * from faculty_scl where faculty_name=\"" . $_SESSION['username'] . "\" and from_date=\"" . $from . "\" and to_date=\"" . $to . "\" and (status<>0 or status<>1)";
                                $r = $con->query($q1);
                                if(mysqli_num_rows($r) > 0)
                                {
                                    $errors[]="Leave already applied for this date.";
                                }
                                if($to<$from)
                                {
                                    $errors[]= "Please enter the correct date.";
                                }
                                if(!in_array($ext,$fileextensions))
                                {
                                    $errors[]="Sorry, only JPG, JPEG, PNG & PDF files are allowed.";
                                }
                                if (file_exists($target_dir . $filename)) {
                                    $errors[]= "File already exists.";
                                }
                                if(empty($errors))
                                {
                                    if(move_uploaded_file($tmpname,$uploadpath))
                                    {
                                        $que = "insert into faculty_scl(faculty_name,reason,applied_date,from_date,to_date,doc_name) values (\"" . $_SESSION['username'] . "\",
                                        \"" . $reason . "\",\"" . $date . "\",\"" . $from . "\",\"" . $to . "\",\"" . $uploadpath . "\")";
                                        $result = $con->query($que);
                                        echo '<script>window.location.replace("../fac_leave_management/sclleave.php");</script>';
                                    }
                                    else
                                    {
                                        ?>
                                            <p style="color:red;text-align:center;font-family: sans-serif;">upload failed</p>
                                        <?php
                                    }
                                }
                                else
                                {
                                    foreach($errors as $value)
                                    {
                                ?>
                                        <br>
                                        <p style="color:red;text-align:center;font-family: sans-serif;"><?php echo "$value"?></label>
                                <?php
                                    }
                                }
                            }
                    ?>
                <div class="text-center">
                    <input type="Submit" name ="Submit" class="btn btn-info" value="Submit">
                </div>
            </form>
        </div>
        <script>
            const actualBtn = document.getElementById('actual-btn');

            const fileChosen = document.getElementById('file-chosen');

            actualBtn.addEventListener('change', function() {
                fileChosen.textContent = this.files[0].name
            })
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {
                $('#sidebarCollapse').on('click', function() {
                    $('#sidebar').toggleClass('active');
                });
            });
        </script>
    
    <?php
include("../template/footer-fac.php");
?>