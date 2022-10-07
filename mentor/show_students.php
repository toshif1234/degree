<?php
    require_once "config.php";

    $q = 'select * from students where semester = "' . $_POST['sem'] . '" and section = "' . $_POST['sec'] . '" and branch = "' . $_POST['dept'] . '" order by usn';
    echo $q;
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
    <form action="update.php" method="post">
    <input type="submit" value="submit">
    <select name="elective" id="">
        <option selected disabled>Select Elective Subject</option>
        <?php foreach($result2 as $r2){ ?>
            <option value="<?php echo $r2['sub_name'] ?>"><?php echo $r2['sub_name'] ?></option>
        <?php } ?>
    </select>
    <table>
        <?php foreach($result as $r){ ?>
        <tr>
            <td><input type="checkbox" name="name[]" value="<?php echo $r["usn"] ?>"></td>
            <td><?php echo $r["usn"] ?></td>
        </tr>
        <?php } ?>
        

    </table>
    </form>
</body>
</html>