<?php
include 'include/sql_conn.php';

$day = $_GET['day'];
$q = $_GET['q'];
$answer = $_GET['answer'];
$userkey = $_GET['userkey'];
$sql = "select * from quiz where day =".$day." and q=".$q;
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

  if($answer == $row['answer']) {
    echo "o";
  }
  else {
    $sql2 = "insert into wrong (userkey, day, q) value (".$userkey.", ".$day.", ".$q.")";
    $result2 = mysqli_query($conn, $sql2);
    echo "x";
  }
?>