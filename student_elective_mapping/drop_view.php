<?php
    require_once "config.php";
        error_reporting(0);

    $q1 = 'select * from dept_pso';
    $q2 = 'select distinct semester,section from students';
    $result2 = $con->query($q2);
    $result1 = $con->query($q1);
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
    <form action="show_students.php" method="POST">
        <select name="dept" id="">
            <option selected disabled>Select Department</option>
            <?php foreach($result1 as $r){ ?>
                <option value="<?php echo $r['dept_name'] ?>"><?php echo $r['dept_name'] ?></option>
            <?php } ?>
        </select>
        <select name="sem" id="">
            <option selected disabled>Select SEM</option>
                <?php foreach($result2 as $r){ ?>
                <option value="<?php echo $r['semester'] ?>"><?php echo $r['semester'] ?></option>
            <?php } ?>
        </select>
        <select name="sec" id="">
        <?php foreach($result2 as $r){ ?>
                <option value="<?php echo $r['section'] ?>"><?php echo $r['section'] ?></option>
            <?php } ?>
        </select>
        <input type="submit" value="SUBMIT" name='sub'>
    </form>
</body>
</html>