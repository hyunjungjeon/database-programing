<?php
 $link = mysqli_connect("localhost", "root", "bnm123", "dbp");

 settype($_POST['id'], 'integer');
   $filtered = array(
       'id' => mysqli_real_escape_string($link, $_POST['id'])
   );

   $query = "
     DELETE
       FROM recommender
       WHERE id ={$filtered['id']}
   ";


   $result = mysqli_multi_query($link, $query);
   if ($result == false) {
       echo '삭제하는 과정에서 문제가 발생했습니다. 관리자에게 문의하세요.';
       error_log(mysqli_error($link));
   } else {
       header('Location: recommender.php'); //문제가 없으면 recommender.php로 보냄
   }
