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

    <input type="text" id="ex">
    <input type="button" id="study_btn" class="main_btn" value="정답확인" onclick="checkAns()">
    <div id="answer" class="hide"> 
      <div class="answer"><?=$row['answer']?></div> 
    </div>
      
    <?php
        }
      }

      if($w_q == $row_num) {
    ?>

    <div class="next_btn">
      <a href="index.php">오답퀴즈 완료 ></a>
    </div>

    <?php 
      } else {
    ?>

    <div class="next_btn">
      <a href="wrongstudyB.php?q=<?=$w_q+1?>">다음 ></a>
    </div>

    <?php
      }
      
      $result-> close();
    ?>


      
  </div>
</div>

<script type="text/javascript" src="./lib/js/logout.js"></script>
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

  function checkAns() {
    document.getElementById('answer').classList.add('reveal');
  }


  $("#ex").keydown(function(key) {
		if(key.keyCode == 13){
			checkAns();
		}
	});

</script>

</body>

</html>