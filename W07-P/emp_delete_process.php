<?php
    $link = mysqli_connect("localhost", "admin", "admin", "employees");
    $filtered = array(
        'emp_no' => mysqli_real_escape_string($link, $_POST['emp_no']),
        'birth_date' => mysqli_real_escape_string($link, $_POST['birth_date']),
        'first_name' => mysqli_real_escape_string($link, $_POST['first_name']),
        'last_name' => mysqli_real_escape_string($link, $_POST['last_name']),
        'gender' => mysqli_real_escape_string($link, $_POST['gender']),
        'hire_date' => mysqli_real_escape_string($link, $_POST['hire_date'])
    );
    $query = "
        DELETE FROM employees
        WHERE emp_no  = '{$filtered['emp_no']}'
        ";

    $result = mysqli_query($link, $query);
    if($result == false){
        echo '삭제하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요.';
        error_log(mysqli_error($link));
    } else {
        header('Location: index.php');
    }
?>