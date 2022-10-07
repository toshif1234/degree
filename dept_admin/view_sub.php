<?php 
require_once "../config.php";
include("../template/fac-auth.php");
                    error_reporting(0);

include("../template/sidebar-fac.php");

?>
                <div class="container">

                    <?php
                    $con = $link;
                    $branch=$_POST["branch"];

                        $q = "select * from subjects_new where branch=\"" . $branch . "\"";
                        if ($con->query($q)) {
                        } else {
                            echo "error";
                        }

                        $row = $con->query($q);

                    ?>
                        <table class="table table-hover table-light table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col" style= "text-align:center;">Subject Name</th>
                                    <th scope="col" style= "text-align:center;">Subject Code</th>

                                </tr>
                            </thead>
                            <tbody >
                                <?php

                                foreach ($row as $r) {
                                ?>

                                    <tr>
                                        <td style= "text-align:center;"><?php echo $r["sub_name"] ?></td>
                                        <td style= "text-align:center;"><?php echo $r["sub_code"] ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>

                    <?php

                    
                    ?>
                </div>
            </div>
            <!-- page content end -->
        </div>
    </div>
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
</body>

</html>