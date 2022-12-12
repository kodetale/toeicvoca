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
    include './lib/include/top.php'
  ?>

<div id="index_wrap" class="wrap">
      
  <?php 
    $list_num = 10;
    $page = isset($_GET["page"])? $_GET["page"] : 1;
  ?>

  <div class="w_day">
    <form id="start" action="wrong.php" method="get">
      
      <?php
        $i = 1;
        $select_form = '<select id="w_day" name="day" class="select" onchange="this.form.submit()">';
          
          while($i <= 30) {
            $selected = ''; 
              if($i == $_GET['day']) {
                $selected = " selected"; 
              }
            $select_form .= '<option value="'.$i.'"'.$selected.'>DAY'.$i.'</option>';
            $i++;
          }

        $select_form .= '</select>';
        echo $select_form;
      ?>

      <input type="hidden" name="page" value="1">  
    </form>
  </div>
      
  <?php
    $day = $_GET['day'];
    $page = $_GET['page'];
        
    $sql = "select * from wrong left join day".$day." on wrong.q = day".$day.".q where userkey=".$_SESSION['userkey']. " and wrong.day=".$day;
    $result = mysqli_query($conn, $sql);
    $row_num = mysqli_num_rows($result);
        
    $list = 10;
    $block_ct = 4;
        
    $block_num = ceil($page/$block_ct);
    $block_start = (($block_num - 1) * $block_ct) + 1;
    $block_end = $block_start + $block_ct - 1;
    $total_page = ceil($row_num / $list);
        
    if($block_end > $total_page) $block_end = $total_page;
    $start_num = ($page-1) * $list;

    $sql2 = "select * from wrong left join day".$day." on wrong.q = day".$day.".q where userkey=".$_SESSION['userkey']. " and wrong.day=".$day
    ." limit ".$start_num.", ".$list;
    $result2 = mysqli_query($conn, $sql2);
    
    if($row_num == 0) {
      echo '저장된 오답이 없습니다.';
    } else {
    ?>

  <div>
    <table class="w_table">
      <tr>
        <td width="35%">단어</td>
        <td width="54%">뜻</td>
        <td width="11%">삭제</td>
      </tr>
        
        <?php
          $id_num = 1;
          while($row = mysqli_fetch_array($result2)){
        ?>

      <tr>
        <td id="voca<?=$id_num?>" onclick="speak(this.id)"><?=$row['voca']?></td>
        <td id="answer<?=$id_num?>" onclick="reveal(this.id)" class="hide"><?=$row['answer']?></td>
        <td><form action="wrong_delete_process.php" method="post" onsubmit="if(!confirm('오답노트에서 삭제하시겠습니까?')){return false};">
              <input type="hidden" name="userkey" value="<?=$_SESSION['userkey']?>">
              <input type="hidden" name="day" value="<?=$_GET['day']?>">
              <input type="hidden" name="q" value="<?=$row['q']?>">
              <input type="hidden" name="page" value="<?=$_GET['page']?>">
              <input type="image" src="./lib/img/heart.png" class="heart">
            </form></td>
      </tr>
      
      <?php
            $id_num++;
          }
        }
      ?>
    </table>
      
    <div id="page_num">
      
        <?php
          for($i=$block_start; $i<=$block_end; $i++) { 
            if($page == $i) {
              echo "<span class='now_num'>[$i]</span>";
            } else {
              echo "<span><a href='?day=$day&page=$i'>[$i]</a></span>";
            }
          }
        ?>
        
    </div>
    
    <?php
      if($row_num > 0) {
    ?>

    <div class="guide">단어를 클릭하면 음성을 들을 수 있습니다.</div>
    
    <?php 
      }
    ?>
    
  </div>
</div>
  
<script type="text/javascript" src="./lib/js/logout.js"></script>
<script type="text/javascript">

  function speak(id) {
    if (typeof SpeechSynthesisUtterance === "undefined" || typeof window.speechSynthesis === "undefined") {
      alert("이 브라우저에서는 음성을 지원하지 않습니다")
    }
    
    window.speechSynthesis.cancel() 

    const speechMsg = new SpeechSynthesisUtterance()
    speechMsg.rate = 0.9   
    speechMsg.pitch = 1
    speechMsg.lang = "en-US"
    speechMsg.text = document.getElementById(id).innerText

    window.speechSynthesis.speak(speechMsg)
  }
  
  function reveal(id) {
    document.getElementById(id).classList.toggle('reveal');
  }

</script>
</body>

</html>