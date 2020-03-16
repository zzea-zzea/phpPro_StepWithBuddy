<!-- //board테이블에 저장
//파일 복사 날짜 파일명 복사 -->
<meta charset="utf-8">
<?php
    session_start();
    if (isset($_SESSION["userid"])) {
        $userid = $_SESSION["userid"];
    } else {
        $userid = "";
    }
    if (isset($_SESSION["username"])) {
        $username = $_SESSION["username"];
    } else {
        $username = "";
    }

    if (!$userid) {
        echo("
                    <script>
                    alert('게시판 글쓰기는 로그인 후 이용해 주세요!');
                    history.go(-1)
                    </script>
        ");
        exit;
    }

    $subject = $_POST["subject"];
    $content = $_POST["content"];

    $subject = htmlspecialchars($subject, ENT_QUOTES);
    //사용자가 입력한 싱글코테이션 마크나 데이터베이스에 입력이 되면 문제가 될수 있어서 문자로 변환하여
    //방어할때 쓰입니다
    //Insert into table (subject, content) values(' ',' ');
    //$subject와 ENT_QUOTES를 문자로 변환하겠다
    $content = htmlspecialchars($content, ENT_QUOTES);

    $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

    $upload_dir = './data/';
    //상대 경로로 해야 문제가 되지 않는다
    //업로드시 중요한것은 진짜 파일은 임시저장장치에 다른이름으로 서버가 임시 파일명으로 구현함
    //파일명으로 읽겠다 = $_FLIE = 배열

    $upfile_name	 = $_FILES["upfile"]["name"];
    $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
    $upfile_type     = $_FILES["upfile"]["type"];
    $upfile_size     = $_FILES["upfile"]["size"];
    $upfile_error    = $_FILES["upfile"]["error"];
    //이차원구조 배열로 잡혀있음

    if ($upfile_name && !$upfile_error) {
        //파일명이 잇으면 true 에러가 안뜨면 true
        $file = explode(".", $upfile_name);
        //"." = 확장자
        //.기준으로 글을 나눔
        // e)board_insert.php
        $file_name = $file[0];  // e)board_insert
        $file_ext  = $file[1];  // e)php

        $new_file_name = date("Y_m_d_H_i_s");
        // $new_file_name = $new_file_name;
        $copied_file_name = $new_file_name.".".$file_ext;
        // 동시에 같이 겹치지 않기 위해
        $uploaded_file = $upload_dir.$copied_file_name;

        if ($upfile_size  > 1000000) {
            echo("
				<script>
				alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
				history.go(-1)
				</script>
				");
            exit;
        }

        if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
            //임시장치에서 하드장치로 저장
            echo("
					<script>
					alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
					history.go(-1)
					</script>
				");
            exit;
        }
    } else {
        $upfile_name      = "";
        $upfile_type      = "";
        $copied_file_name = "";
    }

    $con = mysqli_connect("localhost", "root", "123456", "sample");
    // mysqli_connect
    // 거대한 파일 = 객체를 접근할수 있는 핸들값을 가지고 잇음 = 파일을 접근 할수 있는 주소를 가지고 있음
    $sql = "insert into board (id, name, subject, content, regist_day, hit,  file_name, file_type, file_copied) ";
    $sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day', 0, ";
    $sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";
    //$upfile_name = 진짜이름
    //$upfile_type = 타입
    //$copied_file_name = $new_file_name.".".$file_ext;
    //진짜이름과 다운로드 된 이름을 가지고 저장한다
    mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행

    // 포인트 부여하기
    $point_up = 100;

    $sql = "select point from members where id='$userid'";
    // members 테이블에서 id가 $userid에 해당된 레코드에 포인트라는 항목값만 보여주라
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    // $result에있는 레코드 값을 배열로 가져와라
    // 레코드 셋은 가져오면 최상위 위치를 가리키고 잇음
    // 첫번째 레코드 셋값을 배열로 만듬
    // 레코드 셋값을 하나만 배열로 만든
    // 한번 읽어버리면 자동으로 다음포인트로 이동
    // 그게 싫다면 dataseek
    $new_point = $row["point"] + $point_up;
    //point = int = parsint + 100
    $sql = "update members set point=$new_point where id='$userid'";
    // 멤버 테이블에서 아이디가 유저아이디랑 같은 데이터의 포인트 컬럼값을 뉴 포인터로 업데이트 해라
    mysqli_query($con, $sql);

    mysqli_close($con);                // DB 연결 끊기

    echo "
	   <script>
	    location.href = 'board_list.php';
	   </script>
	";
?>
