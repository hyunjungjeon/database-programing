<?php
 $link = mysqli_connect("localhost", "root", "bnm123", "dbp");
 $query = "SELECT * FROM music";
 $result = mysqli_query($link, $query);
 $list = '';
 while ($row=mysqli_fetch_array($result)) {
     $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$row['title']}</a></li>";
 }

$article = array( //php배열을 선언하는 방법
  'title' => '',
  'singer'=> ''
);

if (isset($_GET['id'])) { //참일때만 실행
    $query = "SELECT * FROM music WHERE id = {$_GET['id']}";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
    $article = array( //php배열을 선언하는 방법
     'title' => $row['title'],
     'singer'=> $row['singer']
   );
}

$query = "SELECT * FROM recommender";
$result = mysqli_query($link, $query);
$select_form = '<select name = "recommender_id">';
while ($row = mysqli_fetch_array($result)) {
    $select_form .= '<option value="'.$row['id'].'">'.$row['name'].'</option>'; //.= 기존에서 덧붙인다는 의미
}
$select_form .='</select>';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charest="uft-8">
  <title>PLAYLIST</title>
  <style>
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
  <form action="process_create.php" method="post">
    <p><input type="text" name="title" placeholder="노래 제목"></p>
    <p><textarea name="singer" placeholder="가수 이름"></textarea></p>
    <?=$select_form ?>
    <p><input type ="submit"></p>
  </form>
</body>
</html>
