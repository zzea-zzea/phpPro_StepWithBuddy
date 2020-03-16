<?php
    session_start();
    if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
    else $userlevel = "";

    if ( $userlevel != 1 )
    //레벨이 1인지 확인
    {
        echo("
            <script>
            alert('관리자가 아닙니다! 회원 삭제는 관리자만 가능합니다!');
            history.go(-1)
            </script>
        ");
                exit;
    }

    $num   = $_GET["num"];

    $con = mysqli_connect("localhost", "root", "123456", "phpprograming");
    $sql = "delete from members where num = $num";
    // 멤버 테이블에서 넘버의 레코드를 지워라
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
	     <script>
	         location.href = 'admin.php';
	     </script>
	   ";
?>
