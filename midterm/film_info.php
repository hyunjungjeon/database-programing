<?php
  $link = mysqli_connect("localhost","admin","admin","sakila");

  $query = "
    SELECT f.title, f.release_year, f.rating, l.name, a.first_name, a.last_name
    FROM film f
    INNER JOIN film_actor actor ON actor.film_id = f.film_id
    INNER JOIN actor_info a ON a.actor_id = actor.actor_id
    INNER JOIN language l ON l.language_id = f.language_id
    ORDER BY f.film_id 
    LIMIT 10 OFFSET 0
";

$currentPage = 0;
        if (isset($_GET["currentPage"])) {
            $currentPage = $_GET["currentPage"];

            if($currentPage < 0){
                $query = "
                SELECT f.title, f.release_year, f.rating, l.name, a.first_name, a.last_name
                FROM film f
                INNER JOIN film_actor actor ON actor.film_id = f.film_id
                INNER JOIN actor_info a ON a.actor_id = actor.actor_id
                INNER JOIN language l ON l.language_id = f.language_id
                ORDER BY f.film_id 
                LIMIT 10 OFFSET 0
            "; 
            $currentPage = 0;
            }
           else
           { 
            $query = "
            SELECT f.title, f.release_year, f.rating, l.name, a.first_name, a.last_name
            FROM film f
            INNER JOIN film_actor actor ON actor.film_id = f.film_id
            INNER JOIN actor_info a ON a.actor_id = actor.actor_id
            INNER JOIN language l ON l.language_id = f.language_id
            ORDER BY f.film_id 
            LIMIT 10 OFFSET ".$currentPage."";
           }
        }

$result = mysqli_query($link, $query);
$article = '';

while ($row = mysqli_fetch_array($result)) {
      $article .= '<tr>';
      $article .= '<td>'.$row['title'].'</td>';
      $article .= '<td>'.$row['release_year'].'</td>';
      $article .= '<td>'.$row['rating'].'</td>';
      $article .= '<td>'.$row['name'].'</td>';
      $article .= '<td>'.$row['first_name'].'</td>';
      $article .= '<td>'.$row['last_name'].'</td>';
      $article .= '</tr>';
  }

 ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> 영화 대여 시스템 </title>
    <link rel=stylesheet href="style.css" type="text/css">
</head>

<body>
<div id="r_frame">
    <div id = "r_frame_cover"> 
    <span id="r_frame_title"><a href='index.php'>Midterm Report</a></span>
    <h3 id="r_frame_name">20181002 전현정</h3> 
    </div>

    <!--영화 정보-->
    <div id="r_frame_in">
        <div class="section">
            <h1 class="section_title">전체 영화 정보 조회</h1>
            <hr>
            <table class = "DB">
                <tr>
                    <th>영화 제목</th>
                    <th>개봉</th>
                    <th>등급</th>
                    <th>언어</th>
                    <th>배우 fist_name</th>
                    <th>배우 last_name</th>
                </tr>
                <?= $article ?>
            </table>
           <!-- Buttons -->
           <form action='film_info.php' method="GET" class="bt">
                    <input type="hidden" name="currentPage" value='<?=($currentPage-10)?>'>
                    <input type="submit" name="back" value="Back">
                </form>

                <form action='film_info.php' method="GET" class="bt">
                    <input type="hidden" name="currentPage" value='<?=($currentPage+10)?>'>
                    <input type="submit" name="next" value="Next">
                </form>

           
        </div>
    </div>
  </div>
</body>

</html>