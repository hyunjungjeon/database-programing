<?php
//var_dump($_POST); //var_dump에 전달된 정보가 저장이 됨

$link = mysqli_connect("localhost","root","bnm123","dbp");

$query = "
  INSERT INTO music (
    title, singer, created
    ) VALUE (
      '{$_POST['title']}',
      '{$_POST['singer']}',
      now()
      )
    "; //연관 배열이라는 타입으로 인덱스를 의미가 있는 정보로 사용가능 함


$result = mysqli_query($link,$query);

if($result == false){
  echo '저장하는 과정에서 문제가 발생했습니다. 관리자에게 문의하세요.';
  error_log(mysqli_error($link)); //오류를 관리자가 볼 수 있는 내부의 로그 파일에 저장함
}else{
  echo '성공했습니다. <a href="index.php">돌아가기</a>';//html페이지로 만들어줌 웹페이지는 php를 해석 할 수 없기 때문
}


 ?>
