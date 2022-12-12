<?php
  include './lib/include/sql_conn.php';
	
	$hashedPassword = password_hash($_POST['userpw'], PASSWORD_DEFAULT);

	$sql = "
    INSERT INTO user
    (userid, userpw, username)
    VALUES('{$_POST['userid']}', '{$hashedPassword}', '{$_POST['username']}'
    )";
  
  $result = mysqli_query($conn, $sql);

  if($result === false) {
?>

<script>
  alert("회원가입에 실패했습니다. 다시 확인 후 시도해주세요.");
  window.history.back();
</script>

<?php
  } else {
?>

<script>
  alert("회원가입이 완료되었습니다.");
  location.href = "index.php";
</script>

<?php 
  }
?>