<?php
  session_start();
  
  include './lib/include/sql_conn.php';
  
  $userkey = $_SESSION["userkey"];

  $sql = "delete from user where userkey = '$userkey'";
  
  mysqli_query($conn, $sql);
?>

<script>
  alert("탈퇴가 완료되었습니다.")
  location.href = "logout_process.php";
</script>