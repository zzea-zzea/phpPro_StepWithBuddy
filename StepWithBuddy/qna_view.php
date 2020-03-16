<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>PHP-DOG</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/qna.css">
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
	    <h3 class="title">
			댓글쓰기 > 내용보기
		</h3>
<?php
    $num  = $_GET["num"];
    $page  = $_GET["page"];

    $con = mysqli_connect("localhost", "root", "123456", "phpprograming");
    $sql = "select * from qna where num=$num";
    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_array($result);
    $id      = $row["id"];
    $name      = $row["name"];
    $regist_day = $row["regist_day"];
    $subject    = $row["subject"];
    $content    = $row["content"];
    $hit          = $row["hit"];

    $content = str_replace(" ", "&nbsp;", $content);
    $content = str_replace("\n", "<br>", $content);

    $new_hit = $hit + 1;
    $sql = "update qna set hit=$new_hit where num=$num";
    mysqli_query($con, $sql);
?>
	    <ul id="view_content">
			<li>
				<span class="col1"><b>제목 :</b> <?=$subject?></span>
				<span class="col2"><?=$name?> | <?=$regist_day?></span>
			</li>
			<li>
        		<?=$content?>
			</li>
	    </ul>
	    <ul class="buttons">
				<li><button onclick="location.href='qna_list.php?page=<?=$page?>'">목록</button></li>
				<li><button onclick="location.href='qna_modify_form.php?num=<?=$num?>&page=<?=$page?>'">수정</button></li>
				<li><button onclick="location.href='qna_form.php?num=<?=$num?>&page=<?=$page?>&mode=response'">답변</button></li>
				<li><button onclick="location.href='qna_insert.php?num=<?=$num?>&page=<?=$page?>&mode=delete'">삭제</button></li>
		</ul>
	</div> <!-- board_box -->
</section>
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
