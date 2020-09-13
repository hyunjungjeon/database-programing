<?php
 $link = mysqli_connect("localhost","root","bnm123","dbp");
 $query = "SELECT * FROM music";
 $result = mysqli_query($link, $query);
 $list = '';
 while($row=mysqli_fetch_array($result)){
  $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$row['title']}</a></li>";
 }

$article = array( //php배열을 선언하는 방법
  'title' => '자주 듣는 노래를 소개해보세요',
  'singer'=> ''
);

if(isset($_GET['id'])){ //참일때만 실행
   $query = "SELECT * FROM music WHERE id = {$_GET['id']}";
   $result = mysqli_query($link,$query);
   $row = mysqli_fetch_array($result);
   $article = array( //php배열을 선언하는 방법
     'title' => $row['title'],
     'singer'=> $row['singer']
   );
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charest="uft-8">
  <title>PLAYLIST</title>
  <style>
    h2{
      color: purple;
    }
    h3{
      color: purple;
    }
    a:link{
      color: purple;
      font-weight: bold;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <h1><a href="index.php">PLAYLIST</a></h1>
  <ol>

    <?= $list ?> <!--php코드가 들어가겠다 라는 것을 줄여서 쓴 것 -->
  </ol>
  <a href="create.php">create</a>
  <h2><?=$article['title'] ?></h2>
  <h3><?=$article['singer'] ?></h3>

</body>
</html>
