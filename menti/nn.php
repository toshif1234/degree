<?php
    require_once "config.php";
    include("../template/fac-auth.php");

    include("../template/sidebar-fac.php");
    $q = "select * from students s,mentor_mapping m where s.usn=m.usn  and batch=\"" . $_POST["batch"] . "\" and branch=\"" . $_POST["branch"] . "\" and m.fac_name=\"" . $_SESSION["username"] . "\"";
    
    $result = $con->query($q);
    $q1='select * from subjects where elective=1';
    $result2=$con->query($q1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="arrange.php" method="post">
    
    <B><label for="Date">Date :</label></b>
                             <input type="Date" name="Date"  id="Date" required> &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; 
    <B><label for="agenda">Arrange Meeting :</label></B>
                             <input type="text" name="agenda"  id="agenda" size="50" required></br> </br> </br>
    <table>
        <?php foreach($result as $r){ ?>
        <tr>
            <td><input type="checkbox" name="name[]" value="<?php echo $r["usn"] ?>"></td>
            <td><?php echo $r["usn"] ?></td>
            
        </tr>
        <?php } ?>
        

    </table>
    <input type="submit" value="submit">
    </form>
</body>
</html>