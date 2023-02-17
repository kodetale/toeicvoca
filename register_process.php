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
    include './lib/include/sql_conn.php';
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
    $hashedPassword = password_hash($_POST['userpw'], PASSWORD_DEFAULT);

    try {
    $sql = "
      INSERT INTO user
      (userid, userpw, username)
      VALUES('{$_POST['userid']}', '{$hashedPassword}', '{$_POST['username']}'
      )";
    $result = mysqli_query($conn, $sql);
    
  ?>
      
  <script>
    $(".modal_close").on("click", function () {
      location.href = "index.php";
    });
    action_popup.alert("회원가입이 완료되었습니다.");
  </script>
  
  <?php
    } catch(mysqli_sql_exception $e) {
  ?>
  
  <script>
    $(".modal_close").on("click", function () {
      window.history.back();
    });
    action_popup.alert("회원가입에 실패했습니다. 다시 시도해주세요.");
  </script>
  
  <?php
    } 
  ?>

</html>