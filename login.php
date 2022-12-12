<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="./lib/css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

  <?php
    include './lib/include/top.php'
  ?>
  
  <div id="login_wrap" class="wrap">
    <div class="form_wrap">
      <h1>로그인</h1>
      <form action="login_process.php" method="post" id="login_form" class="form">
        <div class="form_line"><input type="text" name="userid" id="userid" placeholder="아이디"></div>
        <div class="form_line"><input type="password" name="userpw" id="userpw" placeholder="비밀번호"></div>
        <div class="form_line"><input type="submit" value="로그인" class="form_btn"></div>
      </form>
    </div>
  </div>
</body>

</html>