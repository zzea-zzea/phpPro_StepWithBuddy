<?php
    session_start();

    if(isset($_SESSION["userid"])){
        $userid = $_SESSION["userid"];
    }else{
        $userid = "";
    }

    $num   = $_GET["num"];
    $page   = $_GET["page"];
    $id   = $_GET["id"];
    $board   = $_GET["board"];

    if($userid!=$id){
        echo("
                <script>
                alert('게시글 삭제는 글쓴이만 할 수 있습니다.');
                history.go(-1)
                </script>
        ");
       exit;
    }

    $con = mysqli_connect("localhost", "root", "123456", "cobrain");
    $sql = "select * from {$board}board where num = $num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $copied_name = $row["file_copied"];

	if ($copied_name)
	{
		$file_path = "../data/".$copied_name;
		unlink($file_path);
    }

    $sql = "delete from {$board}board where num = $num";
    mysqli_query($con, $sql);
    mysqli_close($con);

    if($board=="community"){
		$href_value = "board=커뮤니티&page=".$page;
	}else if($board=="qna"){
		$href_value = "board=묻고답하기&page=".$page;
	}

    echo "
	     <script>
	         location.href = '/cobrain/page/board_list.php?{$href_value}';
	     </script>
       ";
       
?>

