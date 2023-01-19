<?php 
  include './lib/include/sql_conn.php';

  $userkey = $_POST['userkey'];
  $day = $_POST['day'];
  $q = $_POST['q'];

  $sql = "select * from wrong where userkey ='$userkey' and day = '$day' and q = '$q'";
  $result = mysqli_query($conn, $sql);
  
  if(mysqli_num_rows($result) === 0) {
    $sql2 = "insert into wrong (userkey, day, q) value (".$userkey.", ".$day.", ".$q.")";
    $result2 = mysqli_query($conn, $sql2);
  }

  if ($q == 40) {
    header("Location: wrong.php?day=$day&page=1");
  } else {
    header("Location: studyB.php?day=$day&q=".$q+1);
  }
?>
