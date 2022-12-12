<?php
session_start();
setcookie("c_num", "", 0, "/");
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./lib/css/style.css">
</head>

<body>

<?php
  include './lib/include/top.php'
?>

  <div id="index_wrap" class="wrap">
    <div class="main">
      <img src="logo.png" width="70%">
        
        <?php
          if (isset($_SESSION['userkey'])) {
        ?>
          
          <form id="start" action="study.php" method="get">
          
          <?php
            $i = 1; 
            $select_form = '<select name="day" class="select">';
            while($i <= 30){
              $select_form .= '<option value="'.$i.'">DAY'.$i.'</option>';
              $i++;
            }
            $select_form .= '</select>';
            
            echo $select_form;
          ?>
          
            <input type="hidden" name="q" value=1>
            <p><input type="submit" value="문제풀기" class="main_btn"></p>
          </form>
      
          <form action="wrong.php" method="GET">
            <input type="hidden" name="day" value=1>
            <input type="hidden" name="page" value=1>
            <p><input type="submit" value="오답노트" class="main_btn"></p>
          </form>
          
          <?php
            } else {
          ?>
        
          <p><a href="login.php" class="main_btn_a">로그인</a></p>
          <p><a href="register.php" class="main_btn_a">회원가입</a></p>
        
        <?php
          }
        ?>
      
    </div>
  </div>

<script type="text/javascript" src="./lib/js/logout.js"></script>
</body>

</html>