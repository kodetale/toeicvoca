<?php
  include './lib/include/sql_conn.php';
  session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="./lib/css/style.css">
  <link rel="stylesheet" href="./lib/css/modal.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="//code.jquery.com/jquery.min.js"></script>
  <title>TOEIC VOCA - 객관식 오답퀴즈</title>
</head>

<body>
  
<?php
  include './lib/include/top.php';
  include './lib/include/modal.php';
  $w_q = $_GET['q'];
  $sql = "select @ROWNUM:=@ROWNUM+1 AS w_q, q.* from ( SELECT @ROWNUM := 0) R, wrong w left join quiz q on w.day = q.day and w.q = q.q where userkey = ".$_SESSION['userkey'];
  $result = mysqli_query($conn, $sql);
  $row_num = mysqli_num_rows($result);
?>

<div id="study_wrap" class="wrap">
  
  <?php 
    while($row = mysqli_fetch_array($result)) {
      if($w_q === $row['w_q']) {
        $day = $row['day'];
        $q = $row['q'];
        $voca = $row['voca'];
  ?>
  
  <div>
  <div class="day">DAY <?=$row['day']?></div>
  <div class="q"><h3><?=$w_q?>/<?=$row_num?></h3></div>
    <h1><?=$row['voca']?><button type="button" id="read"><img src="./lib/img/read.png" width="23px" height="18px"></button></h1>
    <ul style="margin-top:30px;">

      <?php
        $com =  mb_substr($row['answer'], 0, 2);
        $sql2 = "select answer from quiz where category ='".$row['category']."'";
        $result2 = mysqli_query($conn, $sql2);
        $answer = [];
        $ex = [];

        while($row2 = mysqli_fetch_array($result2)) {
          $answer[] = $row2['answer'];
        }
        
        shuffle($answer);
        
        for($i=0; $i<sizeof($answer); $i++) {
          if(mb_strpos($answer[$i], $com) !== false) {
            continue 1;
          } else {
            $ex[] = $answer[$i];
          }
          if(sizeof($ex) == 3) {
            break;
          }
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
        }
      }

      $result-> close();
    ?>
      
  </div>
</div>

<script type="text/javascript" src="./lib/js/logout.js"></script>
<script type="text/javascript" src="./lib/js/alert.js"></script>
<script>
  const read = document.getElementById("read")
  read.addEventListener("click", e => {
    speak('<?=$voca?>')
  })

  function speak(text) {
    if(typeof SpeechSynthesisUtterance === "undefined" || typeof window.     speechSynthesis === "undefined") {
      alert("이 브라우저에서는 음성을 지원하지 않습니다")
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
        day: <?=$day?>,
        q: <?=$q?>,
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
          if(<?=$w_q?> == <?=$row_num?>) {
            location.href="wrongresult.php";
          } else {
            location.href="wrongstudyA.php?q=<?=$w_q+1?>";
          }
        }, 150);
      } else {
        document.getElementById(id + '_l').classList.toggle('x');
        setTimeout(function() {
          if(<?=$w_q?> == <?=$row_num?>) {
            location.href="wrongresult.php";
          } else {
            location.href="wrongstudyA.php?q=<?=$w_q+1?>";
          }
        }, 150);
      } 
    });
  }
</script>
</body>

</html>