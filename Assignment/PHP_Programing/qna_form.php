<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>PHP-DOG</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/qna.css">

<style>
  #main_img_bar { height: 230px; text-align: center; background-color: #7fb537;  }
  #menu_bar { height: 48px; background-color: #7fb537; }
  footer { height: 100px; background-color: #66912d; }
  #qna_box .buttons button { padding: 5px 10px; cursor: pointer; background-color:#7fb537; border: 1px solid #7fb537; color: white; font-weight: bold;}
</style>
<script>
  function check_input() {
      if (!document.qna_form.subject.value)
      {
          alert("제목을 입력하세요!");
          document.qna_form.subject.focus();
          return;
      }
      if (!document.qna_form.content.value)
      {
          alert("내용을 입력하세요!");
          document.qna_form.content.focus();
          return;
      }
      document.qna_form.submit();
   }
</script>
</head>
<body>
<header>
    <?php include "header.php";?>
</header>
<section>
  <?php
    if (isset($_GET['mode'])) {
        $mode = $_GET['mode'];
        $con = mysqli_connect("localhost", "root", "123456", "phpprograming");
    } else {
        echo "error";
    }
   ?>

   <div id="main_img_bar">
         <img src="./img/dog5.gif">
     </div>
     <?php
     //*****************************************************
     $content= $q_content = $sql= $result = $username="";
     $group_num = 0;
     //*****************************************************
     $userid = $_SESSION['userid'];
     $username = $_SESSION['username'];
?>
<?php
if ($mode=='response') {
    $num = $_GET['num'];
    $sql = "SELECT * FROM `qna` WHERE `num`=$num;";
    $result = mysqli_query($con, $sql) or die("ERROR : " . mysqli_error($con));
    $row = mysqli_fetch_array($result);

    $subject=$row['subject'];
    $content=$row['content'];
    if ($mode == "response") {
        $subject="[re]".$subject;
        $content=$content."\n"."re>";
        $content=str_replace("<br>", "<br>▶", $content);
        $disabled="disabled";
    }

  ?>
<!-- 답변  html -->
<div id="qna_box">
  <h3 id="qna_title">
      댓글쓰기 > 답변하기
</h3>

  <form  name="qna_form" method="post" action="qna_insert.php?num=<?=$num?>&mode=<?=$mode?>"
  enctype="multipart/form-data">
     <ul id="qna_form">
    <li>
      <span class="col1">이름 : </span>
      <span class="col2"><?=$username?></span>
    </li>
      <li>
        <span class="col1">제목 : </span>
        <span class="col2"><input name="subject" type="text" value="<?=$subject?>" size =100></span>
      </li>
      <li id="text_area">
        <span class="col1">내용 : </span>
        <span class="col2">
          <textarea name="content"><?=$content?></textarea>
        </span>
      </li>
        </ul>
    <ul class="buttons">
    <li><button type="button" onclick="check_input()">완료</button></li>
    <li><button type="button" onclick="location.href='qna_list.php'">목록</button></li>
  </ul>
  </form>

</div>
<?php
} elseif ($mode=='insert') {
        ?>
 <div id="qna_box">
   <h3 id="qna_title">
       댓글쓰기 > 글쓰기
 </h3>
   <form  name="qna_form" method="post" action="qna_insert.php?mode=<?=$mode?>"
   enctype="multipart/form-data">
      <ul id="qna_form">
     <li>
       <span class="col1">이름 : </span>
       <span class="col2"><?=$username?></span>
     </li>
       <li>
         <span class="col1">제목 : </span>
         <span class="col2"><input name="subject" type="text" ></span>
       </li>
       <li id="text_area">
         <span class="col1">내용 : </span>
         <span class="col2">
           <textarea name="content"></textarea>
         </span>
       </li>
         </ul>
     <ul class="buttons">
     <li><button type="button" onclick="check_input()">완료</button></li>
     <li><button type="button" onclick="location.href='qna_list.php'">목록</button></li>
   </ul>
   </form>
</div> <!-- board_box -->
<?php
    } else if ($mode=='update') {
  ?>
<!-- updatehtml -->
<?php
    } else if ($mode=='delete') {
        ?>

  <!-- deletehtml -->
<?php
    }
     ?>
</section>
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
