<?php
 $link = mysqli_connect("localhost", "root", "bnm123", "dbp");
 $query = "SELECT * FROM music";
 $result = mysqli_query($link, $query);
 $list = '';
 $update_link='';
 $delete_link='';
 $recommender = '';

 while ($row=mysqli_fetch_array($result)) {
     $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$row['title']}</a></li>";
 }

$article = array( //php배열을 선언하는 방법
  'title' => '자주 듣는 노래를 소개해보세요',
  'singer'=> ''
);

if (isset($_GET['id'])) { //참일때만 실행
    $filtered_id = mysqli_real_escape_string($link, $_GET['id']);
    $query = "SELECT * FROM music LEFT JOIN recommender ON
    music.recommender_id = recommender.id
    WHERE music.id = {$filtered_id}";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);

    $article['title'] =
    htmlspecialchars($row['title']);
    $article['singer'] =
    htmlspecialchars($row['singer']);
    $article['name'] =
    htmlspecialchars($row['name']);

    $update_link='<a href="update.php?id='.$_GET['id'].'">update</a>';
    $delete_link='
       <form action="process_delete.php" method="POST">
         <input type="hidden" name="id" value="'.$_GET['id'].'">
         <input type="submit" value="delete">
       </form>';

    $recommender = "<p>by {$article['name']}</p>";
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
  <a href = "recommender.php">recommender</a>
  <ol>

    <?= $list ?> <!--php코드가 들어가겠다 라는 것을 줄여서 쓴 것 -->
  </ol>
  <a href="create.php">create</a>
  <?=$update_link ?>
  <?=$delete_link ?>
  <h2><?=$article['title'] ?></h2>
  <h3><?=$article['singer'] ?></h3>
  <h3><?=$recommender ?></h3>

</body>
</html>
