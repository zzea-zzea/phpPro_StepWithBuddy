<!-- 페이지 설정
전체 레코드 갯수(138)
한 페이지수(10)
페이지 셋팅 넘버(페이지 -1)*10=10
보여줄페이지 시작위치(138-10)
(i=10;i<10+10&&i<전체 레코드 셋;i++)
< 이전 1  2  3  ....  9 다음 >
1.이전=($page -1) 2.숫자=($page =i) 3.다음=($page +1)
4.목록
5.글쓰기
6.제목
=페치 로우는 row[0] 인덱스로 찾을수 있고
=패치 어레이는 인덱스랑 키값으로 찾을수 있다 ->row[0] 도 가능 row["id"]도 가능

-->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
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
	    <h3>
	    	댓글쓰기 > 목록보기
		</h3>
	    <ul id="qna_list">
				<li>
					<span class="col1">번호</span>
					<span class="col2">제목</span>
					<span class="col3">글쓴이</span>
					<span class="col5">등록일</span>
					<span class="col6">조회</span>
				</li>
<?php
	if (isset($_GET["page"]))
  //넘어오는 겟방식에 키값이 존재 하느냐 안하느냐
  //존재 하면 get으로 페이지 값을 받아오고
  //(겟방식으로 페이지를 또 보낼수 잇다 = 쪽지 기능과 같음)
		$page = $_GET["page"];
	else
  //없으면 페이지에 1을 넣는다
  	$page = 1;
  //전부 문자로 구현

	$con = mysqli_connect("localhost", "root", "123456", "phpprograming");
	$sql = "select * from qna order by group_num desc, ord asc";
  //board 라는 테이블 에서 num 이라는 내림차순하는 레토드 값이 레코드 셋입니다.
	$result = mysqli_query($con, $sql) or die("ERROR : " . mysqli_error($con));
	$total_record = mysqli_num_rows($result); // 전체 글 수
  //result를 전체 레코드 갯수를 세오는것
//------------------------------------------------------------------------------
  //-----페이지를 정하려면 전체 갯수를 확인
  //한페이지당 몇개씩 보여줄것인지 보여주기
  //1.전체갯수 : 138
  //2.목록수 : 10
  //페이지 수 = 전체갯수에서 목록수를 나누었을때 딱 떨어지지 않으면 1을 더해준다
  //3.페이지수 : 138 % 10 + 1 // [x % 10 => x/10+1] => 14개
  //if(x%10===0)라며 물어본다
  //4.시작할 페이지
  //5.페이지 시작위치 정하는 변수
  //시작할 페이지 => (시작할 페이지 -1) * 목록수
  //6.페이지별 시작하는 번호
  //138-x = 138...129
//------------------------------------------------------------------------------

  $scale = 10;
  //목록수 = $scale

	// 전체 페이지 수($total_page) 계산
	if ($total_record % $scale == 0)
		$total_page = floor($total_record/$scale);
	else
		$total_page = floor($total_record/$scale) + 1;

	// 표시할 페이지($page)에 따라 $start 계산
	$start = ($page - 1) * $scale;
  //레코드 셋을 불러오면 내림차순의 위치를 정할곳을 결정

	$number = $total_record - $start;

   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
//읽어야할 갯수 = settingnumber
   {
      mysqli_data_seek($result, $i);
      //
      //mysqli_data_seek 함수는 리절트 셋(result set)에서 원하는 순번의 데이터를 선택하는데 쓰입니다.
      //mysqli_data_seek 함수로 원하는 순번을 선택하고 mysqli_fetch_row 로 선택한 데이터를 가져옵니다.
      //recode_set =
      // 가져올 레코드로 위치(포인터) 이동
      $row = mysqli_fetch_array($result);
      //i 번째에 있는 레코드 셋을 가져와서 로우에 넣어라
      // 하나의 레코드 가져오기
  	  $num         = $row["num"];
  	  $id          = $row["id"];
  	  $name        = $row["name"];
  	  $subject     = $row["subject"];
      $regist_day  = $row["regist_day"];
      $hit         = $row["hit"];
?>
				<li>
					<span class="col1"><?=$number?></span>
					<span class="col2"><a href="qna_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></span>
					<span class="col3"><?=$name?></span>
					<span class="col5"><?=$regist_day?></span>
					<span class="col6"><?=$hit?></span>
				</li>
<?php
   	   $number--;
       //	$number = $total_record - $start;
       //128
   }
   mysqli_close($con);

?>
	    	</ul>
			<ul id="page_num">
<?php
	if ($total_page>=2 && $page >= 2)
	{
		$new_page = $page-1;
		echo "<li><a href='qna_list.php?page=$new_page'>◀ 이전</a> </li>";
	}
	else
		echo "<li>&nbsp;</li>";

   	// 게시판 목록 하단에 페이지 링크 번호 출력
   	for ($i=1; $i<=$total_page; $i++)
   	{
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<li><b> $i </b></li>";
		}
		else
		{
			echo "<li><a href='qna_list.php?page=$i'> &nbsp;&nbsp;&nbsp;&nbsp;$i&nbsp;&nbsp;&nbsp;&nbsp;</a><li>";
		}
   	}
   	if ($total_page>=2 && $page != $total_page)
   	{
		$new_page = $page+1;
		echo "<li> <a href='qna_list.php?page=$new_page'>다음 ▶</a> </li>";
	}
	else
		echo "<li>&nbsp;</li>";
?>
			</ul> <!-- page -->
			<ul class="buttons">
				<li><button onclick="location.href='qna_list.php'">목록</button></li>
				<li>
<?php
    if($userid) {
?>
					<button onclick="location.href='qna_form.php?mode=insert'">글쓰기</button>
<?php
	} else {
?>
					<a href="javascript:alert('로그인 후 이용해 주세요!')"><button>글쓰기</button></a>
<?php
	}
?>
				</li>
			</ul>
	</div> <!-- qna_box -->
</section>
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
