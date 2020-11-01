<?php
  $link = mysqli_connect("localhost","admin","admin","sakila");

  $query = "
    SELECT ca.name, f.title, f.release_year, f.rating 
    FROM film f
    INNER JOIN film_category fc ON fc.film_id = f.film_id
    INNER JOIN category ca ON ca.category_id = fc.category_id
    ORDER BY ca.name
    LIMIT 10 OFFSET 0
    ";

if(isset($_GET['category'])){
    $category = mysqli_real_escape_string($link,$_GET['category']);
    $query = "
    SELECT ca.name, f.title, f.release_year, f.rating 
    FROM film f
    INNER JOIN film_category fc ON fc.film_id = f.film_id
    INNER JOIN category ca ON ca.category_id = fc.category_id
    WHERE ca.name = '{$category}'
    ORDER BY ca.name
    LIMIT 10 OFFSET 0
    ";
    
}

$currentPage = 0;
        if (isset($_GET["currentPage"])) {
            $currentPage = $_GET["currentPage"];
            $category = $_GET["category"];
            if($currentPage < 0){
                $query = "
                SELECT ca.name, f.title, f.release_year, f.rating 
                FROM film f
                INNER JOIN film_category fc ON fc.film_id = f.film_id
                INNER JOIN category ca ON ca.category_id = fc.category_id
                WHERE ca.name = '{$category}'
                ORDER BY ca.name
                LIMIT 10 OFFSET 0
            "; 
            $currentPage = 0;
            }
           else
           { 
            $query = "
                SELECT ca.name, f.title, f.release_year, f.rating 
                FROM film f
                INNER JOIN film_category fc ON fc.film_id = f.film_id
                INNER JOIN category ca ON ca.category_id = fc.category_id
                WHERE ca.name = '{$category}'
                ORDER BY ca.name
                LIMIT 10 OFFSET ".$currentPage."";
           }
        }

$result = mysqli_query($link, $query);
$article = '';

while ($row = mysqli_fetch_array($result)) {
      $article .= '<tr>';
      $article .= '<td>'.$row['name'].'</td>';
      $article .= '<td>'.$row['title'].'</td>';
      $article .= '<td>'.$row['release_year'].'</td>';
      $article .= '<td>'.$row['rating'].'</td>';
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
            <h1 class="section_title">카테고리 별 영화 조회</h1>
            <hr>
            <div class="search_form">
            <form action= 'category_info.php' method = "GET">
            <label>검색할 카테고리를 선택해주세요:  </label>
                <select name = "category">
                    <option value="Action">Action</option>
                    <option value="Animation">Animation</option>
                    <option value="Children">Children</option>
                    <option value="Classics">Classics</option>
                    <option value="Comedy">Comedy</option>
                    <option value="Documentary">Documentary</option>
                    <option value="Drama">Drama</option>
                    <option value="Family">Family</option>
                    <option value="Foreign">Foregin</option>
                    <option value="Games">Games</option>
                    <option value="Horror">Horror</option>
                    <option value="Music">Music</option>
                    <option value="New">New</option>
                    <option value="Sci-Fi">Sci-Fi</option>
                    <option value="Sports">Sports</option>
                    <option value="Travel">Travel</option>
                </select>
                <input type="submit" name="search" value="Search">
            </form>
            </div>
            <table class = "DB">
                <tr>
                    <th>카테고리</th>
                    <th>영화 제목</th>
                    <th>개봉</th>
                    <th>등급</th>                   
                </tr>
                <?= $article ?>
            </table>
           
           <form action='category_info.php' method="GET" class="bt">
                <input type = "hidden" name = "category" value = '<?=$category?>'>
                <input type="hidden" name="currentPage" value='<?=($currentPage-10)?>'>
                <input type="submit" name="back" value="Back">
            </form>

            <form action='category_info.php' method="GET" class="bt">
                <input type = "hidden" name = "category" value = '<?=$category?>'>
                <input type="hidden" name="currentPage" value='<?=($currentPage+10)?>'>
                <input type="submit" name="next" value="Next">
            </form>

        </div>
    </div>
  </div>
</body>

</html>