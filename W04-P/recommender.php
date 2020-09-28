<?php
$link = mysqli_connect("localhost", "root", "bnm123", "dbp");

$query = "SELECT * FROM recommender";
$result = mysqli_query($link, $query);
$recommender_info = '';

while ($row = mysqli_fetch_array($result)) {
    $filtered = array(
    'id' => htmlspecialchars($row['id']),
    'name' => htmlspecialchars($row['name']),
  );
    $recommender_info .= '<tr>';
    $recommender_info .= '<td>'.$filtered['id'].'</td>';
    $recommender_info .= '<td>'.$filtered['name'].'</td>';
    $recommender_info .= '<td><a href = "recommender.php?id='.$filtered['id'].'">update</a></td>';
    $recommender_info .=
    '<td>
      <form action = "process_delete_recommender.php" method = "post">
        <input type="hidden" name = "id" value="'.$filtered['id'].'">
        <input type="submit" value = "delete">
      </form>
    </td>';
    $recommender_info .= '</tr>';
}

$escaped = array(
  'name' => ' '
);

$form_action = 'process_create_recommender.php';
$label_submit = 'Create recommender';
$form_id = '';

if (isset($_GET['id'])) {
    $filtered_id = mysqli_real_escape_string($link, $_GET['id']);
    settype($filtered_id, 'integer');
    $query = "SELECT * FROM recommender WHERE id = {$filtered_id}";
    $result= mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
    $escaped['name']= htmlspecialchars($row['name']);

    $form_action = 'process_update_recommender.php';
    $label_submit = 'Update recommender';
    $form_id = '<input type = "hidden" name = "id" value = "'.$_GET['id'].'">';
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset = "utf-8">
  <title>PLAYLIST</title>
</head>
<body>
  <h1><a href="index.php">PLAYLIST</a></h1>
  <p><a href="index.php">list</a></p>

  <table border="1">
    <tr>
      <th>id</th>
      <th>name</th>
      <th>update</th>
      <th>delete</th>
    </tr>
    <?=$recommender_info ?>
  </table>
  <br>
  <form action = "<?=$form_action?>" method = "post">
    <?=$form_id ?>
  <label for="fname">name:</label><br>
     <input type="text" id="name" name="name" placeholder="name" value="<?=$escaped['name']?>"><br><br>

    <input type = "submit" value="<?=$label_submit?>">
  </form>


</body>
</html>
