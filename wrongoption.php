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
      <img src="./lib/img/logo.png" width="70%">
        
          <form id="start" action="wrongstudyA.php" method="get">
            <input type="hidden" name="q" value=1>
            <p><input type="submit" value="객관식 퀴즈" class="main_btn"></p>
          </form>

          <form id="start" action="wrongstudyB.php" method="get">
            <input type="hidden" name="q" value=1>
            <p><input type="submit" value="주관식 퀴즈" class="main_btn"></p>
          </form>
      
          
    </div>
  </div>

<script type="text/javascript" src="./lib/js/logout.js"></script>

</body>

</html>