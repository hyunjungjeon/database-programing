<?php
 $link = mysqli_connect("localhost", "root", "bnm123", "dbp");
 $query = "SELECT * FROM music";
 $result = mysqli_query($link, $query);
 $list = '';
 while ($row=mysqli_fetch_array($result)) {
     $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$row['title']}</a></li>";
 }

$article = array(
  'title' => '',
  'singer'=> ''
);

if (isset($_GET['id'])) {
    $filtered_id = mysqli_real_escape_string($link, $_GET['id']);
    $query = "SELECT * FROM music WHERE id = {$_GET['id']}";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
    $article = array(
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
    <?= $list ?>
  </ol>
  <form action="process_update.php" method="post">
    <input type="hidden" name="id" value="<?=$filtered_id?>">
    <p><input type="text" name="title" placeholder="title" value="<?=$article['title']?>"></p>
       <p><textarea name="singer" placeholder="singer"><?=$article['singer']?></textarea></p>
       <p><input type="submit"></p>
  </form>
</body>
</html>
