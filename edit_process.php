<html>
  <head>
    <link rel="stylesheet" href="./lib/css/modal.css">
    <script src="//code.jquery.com/jquery.min.js"></script>
  </head>

  <body>

    <?php 
      include './lib/include/modal.php';
    ?>

  </body>

  <script src="./lib/js/alert.js"></script>
  
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
    $(".modal_close").on("click", function () {
      location.href = "edit.php";
    });
    action_popup.alert("정보가 수정되었습니다.");
  </script>
</html>
