<?php
  include './lib/include/sql_conn.php';

  $userid = $_POST['userid'];
  $userpw = $_POST['userpw'];

  $sql = "SELECT * FROM user WHERE userid ='{$userid}'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  
	$hashedPassword = $row['userpw'];
  $passwordResult = password_verify($userpw, $hashedPassword);

  if ($passwordResult === true) {
    session_start();
    $_SESSION['userkey'] = $row['userkey'];
    $_SESSION['username'] = $row['username'];
?>

  <script>
		location.href = "index.php";
	</script>

<?php
	} else {
?>

<script>
	alert("로그인에 실패했습니다.");
	location.href = "login.php";
</script>

<?php
	}
?>