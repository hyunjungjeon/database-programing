<?php
  $link = mysqli_connect("localhost","admin","admin","sakila");

  $query = "
    SELECT c.customer_id, c.first_name, c.last_name, c.email, sum(p.amount) psum
    FROM customer c
    INNER JOIN payment p ON p.customer_id = c.customer_id
    GROUP BY c.customer_id
    limit 10 OFFSET 0
    ";


$currentPage = 0;
        if (isset($_GET["currentPage"])) {
            $currentPage = $_GET["currentPage"];
            if(isset($_POST["email"])==false){
            if($currentPage < 0){
                $query = "
                SELECT c.customer_id, c.first_name, c.last_name, c.email, sum(p.amount) psum
                FROM customer c
                INNER JOIN payment p ON p.customer_id = c.customer_id
                GROUP BY c.customer_id
                limit 10 OFFSET 0
                ";
            
            $currentPage = 0;
            }
           else
           { 
            $query = "
            SELECT c.customer_id, c.first_name, c.last_name, c.email, sum(p.amount) psum
            FROM customer c
            INNER JOIN payment p ON p.customer_id = c.customer_id
            GROUP BY c.customer_id
            LIMIT 10 OFFSET ".$currentPage."";
          
            }
        }
     }

     if(isset($_POST['email'])){
        $email = mysqli_real_escape_string($link,$_POST['email']);
        $query = "
        SELECT c.customer_id, c.first_name, c.last_name, c.email, sum(p.amount) psum
        FROM customer c
        INNER JOIN payment p ON p.customer_id = c.customer_id
        WHERE c.email = '{$email}'
        GROUP BY c.customer_id
        ";
        
    }

$result = mysqli_query($link, $query);
$article = '';

while ($row = mysqli_fetch_array($result)) {
      $article .= '<tr>';
      $article .= '<td>'.$row['customer_id'].'</td>';
      $article .= '<td>'.$row['first_name'].'</td>';
      $article .= '<td>'.$row['last_name'].'</td>';
      $article .= '<td>'.$row['email'].'</td>';
      $article .= '<td>'.$row['psum'].'</td>';
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
                    <form action='customer_info.php' method="POST">
                        <label>검색할 고객의 이메일을 적어주세요: </label>
                        <input type="text" name="email" placeholder="email@gmail.com">
                        <input type="submit" name="search" value="Search">
                    </form>
                </div>
                <table class="DB">
                    <tr>
                        <th>고객 아이디</th>
                        <th>고객 fist_name</th>
                        <th>고객 last_name</th>
                        <th>email</th>
                        <th>총 구매 금액</th>
                    </tr>
                    <?= $article ?>
                </table>
                <form action='customer_info.php' method="GET" class="bt">
                    <input type="hidden" name="currentPage" value='<?=($currentPage-10)?>'>
                    <input type="submit" name="back" value="Back">
                </form>

                <form action='customer_info.php' method="GET" class="bt">
                    <input type="hidden" name="currentPage" value='<?=($currentPage+10)?>'>
                    <input type="submit" name="next" value="Next">
                </form>


            </div>
        </div>
    </div>
</body>

</html>