<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>PHP-DOG</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/qna.css">
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
  <style>
    #main_img_bar { height: 230px; text-align: center; background-color: #7fb537;  }
      #menu_bar { height: 48px; background-color: #7fb537; }
        footer { height: 100px; background-color: #66912d; }
        #qna_box .buttons button { padding: 5px 10px; cursor: pointer; background-color:#7fb537; border: 1px solid #7fb537; color: white; font-weight: bold;}
  </style>
<header>
    <?php include "header.php";?>
</header>
<section>
  <div id="main_img_bar">
        <img src="./img/dog5.gif">
    </div>
   	<div id="qna_box">
	    <h3 id="qna_title">
	    		댓글쓰기 > 수정하기
		</h3>
<?php
	$num  = $_GET["num"];
	$page = $_GET["page"];
	$con = mysqli_connect("localhost", "root", "123456", "phpprograming");
	$sql = "select * from qna where num=$num";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$name       = $row["name"];
	$subject    = $row["subject"];
	$content    = $row["content"];
?>
	    <form  name="qna_form" method="post" action="qna_list.php?num=<?=$num?>&page=<?=$page?>">
	    	 <ul id="qna_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2"><?=$name?></span>
				</li>
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="subject" type="text" value="<?=$subject?>"></span>
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
	</div> <!-- board_box -->
</section>
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
