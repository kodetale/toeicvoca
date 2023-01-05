<?php
  session_start();
  
  include './lib/include/sql_conn.php';
  
  $userkey = $_SESSION["userkey"];
  $hashedPassword = password_hash($_POST['userpw'], PASSWORD_DEFAULT);
  $username = $_POST["username"];

  if(!$_POST['userpw']) {
    $sql = "UPDATE user SET username = '$username' WHERE userkey = '$userkey'";
  } else {
    $sql = "UPDATE user SET userpw = '$hashedPassword', username = '$username' WHERE userkey = '$userkey'";
  }
  
  mysqli_query($conn, $sql);
?>

<script>
  alert("정보가 수정되었습니다.")
  location.href = "edit.php";
</script>
