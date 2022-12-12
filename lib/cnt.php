<?php 
  $ox = $_POST['ox'];
  if($ox == 'o') {
    if(isset($_COOKIE['c_num'])) {
      $c_num = $_COOKIE['c_num'];
    } else {
      $c_num = 0;
    }
    setcookie("c_num", ++$c_num, time() + 3600, "/");
  }   
?>