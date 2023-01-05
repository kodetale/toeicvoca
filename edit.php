<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="./lib/css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

  <?php
    include './lib/include/top.php';
    include './lib/include/sql_conn.php';

    $userkey = $_SESSION["userkey"];
    $sql = "select * from user where userkey = '{$userkey}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
  ?>
  
  <div id="regist_wrap" class="wrap">
    <div class = "form_wrap">
      <h1>정보수정</h1>
      <form action="edit_process.php" method="post" name="editform" id="regist_form" class="form"
        onsubmit="return edit_check()">
        <label for="userid" class="regist_label">아이디</label>
        <div class="edit_line"><?=$row['userid']?></div>
        <label for="userpw" class="regist_label">비밀번호</label>
        <div class="form_line"><input type="password" name="userpw" id="userpw"></div>
        <label for="userpw_ch" class="regist_label">비밀번호 확인</label>
        <div class="form_line"><input type="password" name="userpw_ch" id="userpw_ch"></div>
        <label for="username" class="regist_label">이름</label>
        <div class="form_line"><input type="text" name="username" id="username" value="<?=$row['username']?>"></div>
        <div class="form_line"><input type="submit" value="정보수정" class="form_btn"></div>
      </form>
      <div class="delete"><a href="delete_process.php" onclick="return confirm('정말 탈퇴하시겠습니까?');">회원탈퇴</a></div>
    </div>
  </div>

<script type="text/javascript" src="./lib/js/logout.js"></script>
<script src="./lib/js/edit.js"></script>
</body>

</html>