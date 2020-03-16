<meta charset="utf-8">
<?php
    session_start();
    if(isset($_SESSION["userid"])){
        $userid = $_SESSION["userid"];
    }else{
        $userid = "";
    }

    if(isset($_SESSION["username"])){
        $username = $_SESSION["username"];
    }else{
        $username = "";
    }

    if(!$userid){
        echo("
                    <script>
                    alert('댓글쓰기는 로그인 후 이용가능합니다.');
                    history.go(-1)
                    </script>
        ");
       exit;
    }

    $id = $_POST["userid"];
    $name = $_POST["username"];
    $board = $_POST["board"];
    $num = $_POST["num"];
	$content = $_POST["newcmt_content"];

	$content = htmlspecialchars($content, ENT_QUOTES);

	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장
	
	$con = mysqli_connect("localhost", "root", "123456", "cobrain");

	$sql = "insert into comment (board, board_num, id, name, regist_day, content, rcm) ";
	$sql .= "values('$board', '$num', '$id', '$name', '$regist_day', '$content', 0)";

	mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행

	// 포인트 부여하기
  	$point_up = 20;

	$sql = "select point from members where id='$id'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$new_point = $row["point"] + $point_up;
	
	$sql = "update members set point=$new_point where id='$id'";
	mysqli_query($con, $sql);

	// 댓글수증가

	$sql = "select comment from {$board}board where num=$num";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$new_comment = $row["comment"] +1;
	
	$sql = "update {$board}board set comment=$new_comment where num=$num";
	mysqli_query($con, $sql);

	mysqli_close($con); // DB 연결 끊기

	if($board=="community"){
		$href_value = "board=커뮤니티&num=".$num;
	}else if($board=="qna"){
		$href_value = "board=묻고답하기&num=".$num;
	}
	

	echo "
	   <script>
	    location.href = '/cobrain/page/board_view.php?{$href_value}';
	   </script>
	";
?>

  
