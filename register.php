<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="./lib/css/style.css">
  <link rel="stylesheet" href="./lib/css/modal.css">
  <script src="//code.jquery.com/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TOEIC VOCA</title>
</head>

<body>

  <?php
    include './lib/include/top.php';
    include './lib/include/modal.php';
  ?>

  <div id="regist_wrap" class="wrap">
    <div class = "form_wrap">
      <h1>회원가입</h1>
      <form action="register_process.php" method="post" name="regiform" id="regist_form" class="form"
        onsubmit="return sendit()">
        <label for="userid" class="regist_label">아이디</label>
        <div class="form_line"><input type="text" name="userid" id="userid"><input type="button" id="checkIdBtn" value="중복체크"
        onclick="checkId()">
        <p id="result">&nbsp;</p>
        </div>
        <label for="userpw" class="regist_label">비밀번호</label>
        <div class="form_line"><input type="password" name="userpw" id="userpw"></div>
        <label for="userpw_ch" class="regist_label">비밀번호 확인</label>
        <div class="form_line"><input type="password" name="userpw_ch" id="userpw_ch"></div>
        <label for="username" class="regist_label">이름</label>
        <div class="form_line"><input type="text" name="username" id="username"></div>
        <div class="form_line"><input id="submit" type="submit" value="회원가입" class="form_btn"></div>
      </form>
    </div>
  </div>

<script src="./lib/js/register.js"></script>
<script src="./lib/js/alert.js"></script>
</body>

</html>