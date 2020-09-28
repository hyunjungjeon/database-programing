<?php
  $link = mysqli_connect("localhost", "root", "bnm123", "dbp");
  $filtered = array(
      'id' => mysqli_real_escape_string($link, $_POST['id']),
      'title' => mysqli_real_escape_string($link, $_POST['title']),
     'singer' => mysqli_real_escape_string($link, $_POST['singer']),


  );

  $query = "
   UPDATE music
     SET
       title = '{$filtered['title']}',
       singer = '{$filtered['singer']}'
     WHERE
       id = '{$filtered['id']}'
 ";

 $result = mysqli_multi_query($link, $query);
  if ($result == false) {
      echo '수정하는 과정에서 문제가 발생했습니다. 관리자에게 문의하세요.';
      error_log(mysqli_error($link));
  } else {
      echo '성공했습니다. <a href="index.php">돌아가기</a>';
  }
