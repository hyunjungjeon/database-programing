<?php
//var_dump($_POST); //var_dump에 전달된 정보가 저장이 됨

$link = mysqli_connect("localhost", "root", "bnm123", "dbp");


$filtered = array(
    'name' => mysqli_real_escape_string($link, $_POST['name'])
);

$query = "
  INSERT INTO recommender (
  name
    ) VALUE (
      '{$filtered['name']}'

      )
    "; //연관 배열이라는 타입으로 인덱스를 의미가 있는 정보로 사용가능 함


$result = mysqli_query($link, $query);

if ($result == false) {
    echo '저장하는 과정에서 문제가 발생했습니다. 관리자에게 문의하세요.';
    error_log(mysqli_error($link)); //오류를 관리자가 볼 수 있는 내부의 로그 파일에 저장함
} else {
    header('Location: recommender.php'); //문제가 없으면 recommender.php로 보냄
}
