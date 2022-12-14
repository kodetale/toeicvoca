<?php
  include './lib/include/sql_conn.php';
  session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="./lib/css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="//code.jquery.com/jquery.min.js"></script>
</head>

<body>
  
<?php
  include './lib/include/top.php';
  $day = $_GET['day'];
  $q = $_GET['q'];
  $sql = "select * from day".$day." where q=".$q;
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
?>

<div id="index_wrap" class="wrap">
  <div class="q"><h3><?=$row['q']?>/40</h3></div>
  <div>
    <h1><?=$row['voca']?><button type="button" id="read"><img src="./lib/img/read.png" width="23px" height="18px"></button></h1>
    <ul style="margin-top:30px;">

      <?php
        $com =  mb_substr($row['answer'], 0, 2);
        $sql2 = "select * from ".$row['category'];
        $result2 = mysqli_query($conn, $sql2);
        $row_num = mysqli_num_rows($result2);
              
        while(true) {
          $ex = [];
          $temp = range(1, $row_num);
          shuffle($temp);
          $ex_num =  array_slice($temp, 0, 3);
            for($i=0; $i<3; $i++) {
              $sql3 = "select * from ".$row['category']." where id=".$ex_num[$i];
              $result3 = mysqli_query($conn, $sql3);
              $row3 = mysqli_fetch_array($result3);
              $ex[] = $row3['word'];
                if(mb_strpos($ex[$i], $com) !== false) {
                  continue 2;
                }
            }
            break;
        }
              
        $ex[] = $row['answer'];
        shuffle($ex);
            
        for($i=0; $i<4 ; $i++) {
          $list_ex = '<li class="list_ex">';
          $list_ex .= '<div>';
          $list_ex .= '<input type="radio" class="radio_btn" name="answer" id="ex'.($i+1).'" value="'.$ex[$i].'" onclick="correctAns(this.id ,this.value)" />';
          $list_ex .= '<label id="ex'.($i+1).'_l" for="ex'.($i+1).'"> <span style="font-size:14px;">('.($i+1).')&nbsp;</span> '.$ex[$i].' </label>';
          $list_ex .= '</div>';
          $list_ex .= '</li>';
          echo $list_ex;
          }
      ?>
      
    </ul>
      
    <?php
      $result-> close();
    ?>
      
  </div>
</div>

<script type="text/javascript" src="./lib/js/logout.js"></script>
<script>
  const read = document.getElementById("read")
  read.addEventListener("click", e => {
    speak('<?=$row['voca']?>')
  })

  function speak(text) {
    if(typeof SpeechSynthesisUtterance === "undefined" || typeof window.     speechSynthesis === "undefined") {
      alert("??? ????????????????????? ????????? ???????????? ????????????")
    }
    
    window.speechSynthesis.cancel()

    const speechMsg = new SpeechSynthesisUtterance()
    speechMsg.rate = 0.9   
    speechMsg.pitch = 1 
    speechMsg.lang = "en-US"
    speechMsg.text = text

    window.speechSynthesis.speak(speechMsg)
  }

  function correctAns(id, answer) {
    $.ajax({
      url: "lib/correctAns.php",
      type: "GET",
      data: {
        day: <?=$_GET['day']?>,
        q: <?=$_GET['q']?>,
        answer : answer,
        userkey: <?=$_SESSION['userkey']?>
        }
    }).done(function(data) {
      if (data == 'o') {
        $.ajax({
          url: "lib/cnt.php",
          type : "POST",
          data : {
            ox: data
          }
        });
        document.getElementById(id + '_l').classList.toggle('o');
        setTimeout(function() {
          if(<?=$row['q']?> == 40) {
            location.href="result.php?day=<?=$_GET['day']?>";
          } else {
            location.href="study.php?day=<?=$_GET['day']?>&q=<?=$row['q']+1?>";
          }
        }, 150);
      } else {
        document.getElementById(id + '_l').classList.toggle('x');
        setTimeout(function() {
          if(<?=$row['q']?> == 40) {
            location.href="result.php?day=<?=$_GET['day']?>";
          } else {
            location.href="study.php?day=<?=$_GET['day']?>&q=<?=$row['q']+1?>";
          }
        }, 150);
      } 
    });
  }
</script>
</body>

</html>