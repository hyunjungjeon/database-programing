<?php
$link = mysqli_connect("localhost","admin","admin","employees");
if(isset($_GET['emp_no'])){
    $filtered_id =mysqli_real_escape_string($link, $_GET['emp_no']);
}else{
    $filtered_id =mysqli_real_escape_string($link, $_POST['emp_no']);
}

$query = "
SELECT *
FROM employees
WHERE emp_no='{$filtered_id}'
";

$result = mysqli_query($link,$query);
$row = mysqli_fetch_array($result);

$delete_link ='';
if(empty($row)){
    echo '없는 직원 정보입니다. <a href="index.php">돌아가기</a>';
}else{
    $delete_link = '
    <h2><a href="index.php">직원 관리 시스템</a> | 직원 정보 수정</h2>
    <form action="emp_delete_process.php" method="POST">
        <label>emp_no: </label>
        <input type="text" name="emp_no" value="'.$row['emp_no'].'" placeholder="emp_no" readonly><br>
        <label>birth_date: </label>
        <input type="date" name="birth_date" value="'.$row['birth_date'].'" placeholder="birth_date" readonly><br>
        <label>first_name: </label>
        <input type="text" name="first_name" value="'.$row['first_name'].'" placeholder="first_name" readonly><br>
        <label>last_name: </label>
        <input type="textlast_name" name="last_name" value="'.$row['last_name'].'" placeholder="last_name" readonly><br>
        <label>gender: </label>
        <select name="gender">
            <option value="F">Female</option>
            <option value="M">Male</option>
        </select> <br>
        <label>hire_date: </label>
        <input type="date" name="hire_date" value="'.$row['hire_date'].'" placeholder="hire_date" readonly><br>
        <input type="submit" value="Delete">
    </form>
    ';
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> 직원 관리 시스템 </title>
</head>

<body>
    <?=$delete_link?>
</body>

</html>