<?php 
  include './lib/include/sql_conn.php';

  $userkey = $_POST['userkey'];
  $day = $_POST['day'];
  $q = $_POST['q'];
  $page = $_POST['page'];
  $sql = "delete from wrong where userkey=".$userkey." and day=".$day." and q=".$q;
  
  mysqli_query($conn, $sql);
  
  header("Location: wrong.php?day=$day&page=$page");
?>