<?php
    require_once "../config.php";
    $con=$link;
    include("../template/student_sidebar.php");
?>

        <style>
            .label2 
            {
                background-color: rgb(50, 113, 124);
                color:white;
                padding: 0.5rem;
                font-family: sans-serif;
                border-radius: 0.3rem;
                cursor: pointer;
            }
        </style>

        <h4 style="text-align:center">Enter The Event Details</h4><br>
        <div style="margin-left:20%;margin-right:20%">
      		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        		<table   class="table table-responsive table-borderless">
        			<tr>
        				<th></th>
                        <th></th>
        				<th></th>
        			</tr>
        			<tr>
        				<td>Event Name<br></td>
                        <td></td>
                        <td> 
                            <input type = "text" name="Ename" class = "form-control" id = "name" placeholder = "Enter Event Name" required>   
        				</td>
        			</tr>
                    <?php
                        $Date = date('Y-m-d');
                        $Last_date = date('Y-m-d', strtotime($Date. ' + 7 days'));
                        
                    ?>
                    <tr>
                        <td>Date<br></td>
                        <td></td>
                        <td> 
                            <input type = "date" name="Edate" min="<?php echo $Date ?>" max="<?php echo $Last_date ?>" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Start Time<br></td>
                        <td></td>
                        <td>
                            <input type="time" name="start" id="starttime" class="form-control" min="09:00" max="17:00" required>
                            <label for="starttime">Choose time</label>
                        </td>
                    </tr>
                    <tr>
                        <td>End Time<br></td>
                        <td></td>
                        <td> 
                            <input type="time" name="end" id="endtime" class="form-control" min="09:00" max="17:00" onchange="myFunction(this.value)" required>
                            <label for="endtime">Choose time</label>
                        </td>
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
                                $s='select * from students where usn="' . $_SESSION["username"] . '"';
                                $res = $link->query($s);
                                $res = mysqli_fetch_assoc($res);
                                $ename = $_POST["Ename"];
                                $edate = $_POST["Edate"];
                                $date = date('Y-m-d');
                                $from = $_POST["start"];
                                $to = $_POST["end"];
                                $target_dir="../leave_doc/event_doc/";
                                $filename=$_FILES["fileupload"]["name"];
                                $tmpname=$_FILES["fileupload"]["tmp_name"];
                                $filetype=$_FILES["fileupload"]["type"];
                                $errors=[];
                                $fileextensions=["pdf","jpeg","jpg","png"];
                                $arr=explode(".",$filename);
                                $ext=strtolower(end($arr));
                                $uploadpath=$target_dir.basename($filename);
                                $q1 = "select * from student_event_leave where usn=\"" . $_SESSION['username'] . "\" and sem=\"" . $res["semester"] . "\" and 
                                event_date=\"" . $edate . "\" and from_time=\"" . $from . "\" and to_time=\"" . $to . "\" and (coordinator_status<>0 or coordinator_status<>1) and (hod_status<>0 or hod_status<>1)";
                                $r = $con->query($q1);
                                if(mysqli_num_rows($r) > 0)
                                {
                                    $errors[]="Leave already applied for this date.";
                                }
                                if(!in_array($ext,$fileextensions))
                                {
                                    $errors[]="Sorry, only JPG, JPEG, PNG & PDF files are allowed.";
                                }
                                if(file_exists($target_dir . $filename)) {
                                    $errors[]= "File already exists.";
                                }
                                if($to<=$from)
                                {
                                    $errors[]= "Please enter the correct time.";
                                }
                                if(empty($errors))
                                {
                                    if(move_uploaded_file($tmpname,$uploadpath))
                                    {
                                        $que = "insert into student_event_leave(usn,sem,event_name,event_date,applied_date,from_time,to_time,doc_name) values (\"" . $_SESSION['username'] . "\",
                                        \"" . $res["semester"] . "\",\"" . $ename . "\",\"" . $edate . "\",\"" . $date . "\",\"" . $from . "\",\"" . $to . "\",\"" . $uploadpath . "\")";
                                        $result = $con->query($que);
                                        echo '<script>window.location.replace("../student_leave_management/event.php");</script>';
                                        
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
                                        <p style="color:red;text-align:center;font-family: sans-serif;"><?php echo "$value"?></p>
                                <?php
                                    }
                                }
                            }
                    ?>
                <div class="text-center">
                    <input type="Submit" id="submit" name ="Submit" class="btn btn-info" value="Submit">
                </div>
            </form>
        </div>
        <script>
            function myFunction(val) {
                var x = document.getElementById("starttime").value;
                if(val<=x)
                {
                    alert("Please enter the correct time.");
                }
            }
        </script>

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
include("../template/student-footer.php");
?>