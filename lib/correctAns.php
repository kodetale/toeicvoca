<?php
include 'include/sql_conn.php';

$day = $_GET['day'];
$q = $_GET['q'];
$answer = $_GET['answer'];
$userkey = $_GET['userkey'];
$sql = "select * from day".$day." where q=".$q;
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

  if($answer == $row['answer']) {
    echo "o";
  }
  else {
    $sql3 = "insert into wrong (userkey, day, q) value (".$userkey.", ".$day.", ".$q.")";
    $result3 = mysqli_query($conn, $sql3);
    echo "x";
  }
?>