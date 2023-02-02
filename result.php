<?php
  session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <?php include './lib/include/head.php' ?>
  <title>TOEIC VOCA - 결과</title>
</head>

<body>

<?php
  include './lib/include/top.php';
  include './lib/include/modal.php';
?>

  <div id="index_wrap" class="wrap">
    <div>
      <div class="main">
        <h1>DAY <?=$_GET['day']?> 결과</h1> 
        <div class="result"> 40문제 중 
          <span style="color:#38b635;">

          <?php
            if(isset($_COOKIE['c_num'])) {
              echo $_COOKIE['c_num'].'개';
              setcookie("c_num", "", 0, "/");
            } else {
              echo '0개';
            }
          ?>
          
          </span>맞았습니다.</div>
        <form action="wrong.php" method="GET">
          <input type="hidden" name="day" value=<?=$_GET['day']?>>
          <input type="hidden" name="page" value=1>
          <p><input type="submit" value="오답노트" class="main_btn">
        </form>
      </div>
    </div>
  </div>

<script type="text/javascript" src="./lib/js/logout.js"></script>
<script type="text/javascript" src="./lib/js/alert.js"></script>
</body>

</html>