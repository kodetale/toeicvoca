<?php
session_start();
setcookie("c_num", "", 0, "/");
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./lib/css/style.css">
  <link rel="stylesheet" href="./lib/css/modal.css">
  <script src="//code.jquery.com/jquery.min.js"></script>
  <title>TOEIC VOCA</title>
</head>

<body>

<?php
  include './lib/include/top.php';
  include './lib/include/modal.php';
?>

  <div id="index_wrap" class="wrap">
    <div class="main">
      <img src="./lib/img/logo.png" width="70%">
        
        <?php
          if (isset($_SESSION['userkey'])) {
        ?>

          <form id="start" action="option.php" method="post">
          
          <?php
            $i = 1; 
            $select_form = '<select name="day" class="select">';
            while($i <= 30){
              $select_form .= '<option value="'.$i.'">DAY '.$i.'</option>';
              $i++;
            }
            $select_form .= '</select>';
            
            echo $select_form;
          ?>
            <p><input type="submit" value="퀴즈풀기" class="main_btn"></p>
          </form>
      
          <div class="index_bar">⭑⭒⭑⭒⭑⭒⭑⭒⭑⭒⭑⭒⭑⭒⭑⭒⭑⭒⭑⭒⭑⭒⭑⭒⭑⭒⭑⭒⭑⭒⭑⭒⭑</div>
          
          <form action="wrong.php" method="GET">
            <input type="hidden" name="day" value=1>
            <input type="hidden" name="page" value=1>
            <p><input type="submit" value="오답노트" class="main_btn"></p>
          </form>

          <?php
            include './lib/include/sql_conn.php';
            $sql = "select * from wrong where userkey = ".$_SESSION['userkey'];
            $result = mysqli_query($conn, $sql);
            $row_num = mysqli_num_rows($result);
          ?>
          
          <form action="wrongoption.php" method="POST" onsubmit="return wrong_check()">
            <p><input type="submit" value="오답퀴즈" class="main_btn"></p>
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
<script type="text/javascript" src="./lib/js/alert.js"></script>
<script>

function wrong_check() {
  
  if(<?=$row_num?> == 0) {
    action_popup.alert("저장된 오답이 없습니다.");
    return false;
  }
}

</script>
</body>

</html>