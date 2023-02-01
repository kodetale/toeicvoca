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
    
    $userid = $_POST['userid'];
    $userpw = $_POST['userpw'];
      
    $sql = "SELECT * FROM user WHERE userid ='{$userid}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
      
    if(isset($row)) {
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
      $(".modal_close").on("click", function () {
        location.href = "login.php";
      });
      action_popup.alert("아이디와 비밀번호를 다시 확인해주세요.");
    </script>
    
    <?php
      }
    } else {
    ?>

    <script>
      $(".modal_close").on("click", function () {
        location.href = "login.php";
      });
      action_popup.alert("아이디와 비밀번호를 다시 확인해주세요.");
    </script>

    <?php
    }
    ?>
</html>