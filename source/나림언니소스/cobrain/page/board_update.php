<?php
    $num = $_POST["num"];
    $page = $_POST["page"];
    $board = $_POST["board"];
    $subject = $_POST["board_write_subject"];
    $content = $_POST["board_write_content"];

    $subject = htmlspecialchars($subject, ENT_QUOTES);
	$content = htmlspecialchars($content, ENT_QUOTES);

	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

	$upload_dir = '../data/';

	$upfile_name	 = $_FILES["upfile"]["name"];
	$upfile_tmp_name = $_FILES["upfile"]["tmp_name"];//파일 임시이름
	$upfile_type     = $_FILES["upfile"]["type"];//파일 형식
	$upfile_size     = $_FILES["upfile"]["size"];
    $upfile_error    = $_FILES["upfile"]["error"];
    
    //파일업로드
    if ($upfile_name && !$upfile_error){

		$file = explode(".", $upfile_name);
		$file_name = $file[0]; //파일명
		$file_ext  = $file[1]; //확장자

		$new_file_name = date("Y_m_d_H_i_s");
		$new_file_name = $new_file_name;
		$copied_file_name = $new_file_name.".".$file_ext; //실제 서버에 저장될 파일명      
		$uploaded_file = $upload_dir.$copied_file_name; //파일을 폴더에 복사

		if( $upfile_size  > 1000000 ) {
			echo("
					<script>
					alert('업로드 파일 크기가 최대 용량(1MB)을 초과합니다<br>파일 크기를 확인해주세요');
					history.go(-1)
					</script>
			");
			exit;
		}

		if (!move_uploaded_file($upfile_tmp_name, $uploaded_file) ){
			echo("
					<script>
					alert('서버에 파일 업로드를 실패했습니다');
					// history.go(-1);
					</script>
			");
			exit;
		}
	}
	else{
		$upfile_name      = "";
		$upfile_type      = "";
		$copied_file_name = "";
    }
    
    //기존파일 삭제
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
          
    //게시글 수정
    $sql = "update {$board}board set subject='$subject', content='$content'
            , regist_day='$regist_day', file_name='$upfile_name'
            , file_type='$upfile_type', file_copied='$copied_file_name'";
    $sql .= " where num=$num";
    mysqli_query($con, $sql);

    mysqli_close($con);


    //페이지이동
    if($board=="community"){
		$href_value = "board=커뮤니티&num=".$num."&page=".$page;
	}else if($board=="qna"){
		$href_value = "board=묻고답하기&num=".$num."&page=".$page;
	}

    echo "
	     <script>
	         location.href = '/cobrain/page/board_view.php?{$href_value}';
	     </script>
       ";
?>

   
