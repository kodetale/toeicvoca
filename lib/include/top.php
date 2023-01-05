<div class="top">

<?php 
  $link = $_SERVER['PHP_SELF'];
  if(basename($link) == 'index.php') {
  } else {
?>

  <span class="return">
  <a href="index.php">< 돌아가기</a>
  </span>

<?php
	}
?>

  <span class="logout">

<?php
  if (isset($_SESSION['userkey'])) {
    echo "{$_SESSION['username']}님(･ᴗ･)";
?>
  <span><a href="edit.php">정보수정</a></span>
  <span onclick="logout()">로그아웃</span>
  
<?php
  }
?>

  </span>
</div><div style="clear:both;"></div>