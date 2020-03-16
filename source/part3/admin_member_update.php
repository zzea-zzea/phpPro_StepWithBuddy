<?php
    session_start();
// session_start()에서 오류가 나올때 꼭 알아두어야 할내용
// - session_start(); 전에 출력문이 있으면 안된다.
// - @session_start(); 이문장은 경고가 나오면 경고문을 보이지말라는 의미지 해결은 아님
// - 그래도 안된다면 세션변수가 저장되는 폴더 권한을 777로 주었는지 확인해보자.
// - 그래도 안된다면 php.ini 에서 default-charset utf-8 로 설정해보라.
    if (isset($_SESSION["userlevel"])) {
        $userlevel = $_SESSION["userlevel"];
    }

    // enpty = 비어있는지 안비어있는지 물어봄
    else {
        $userlevel = "";
    }

    if ($userlevel != 1) {
        echo("
            <script>
            alert('관리자가 아닙니다! 회원정보 수정은 관리자만 가능합니다!');
            history.go(-1)
            </script>

        ");
        exit;
    }
//<script>
// alert('관리자가 아닙니다! 회원정보 수정은 관리자만 가능합니다!');
// history.go(-1)
// </script>
//  html specialchar로 찍어본다
    $num   = $_GET["num"];
    $level = $_POST["level"];
    $point = $_POST["point"];

    $con = mysqli_connect("localhost", "root", "123456", "sample");
    $sql = "update members set level=$level, point=$point where num=$num";
    //멤버테이블에서 넘버가 같은값을 찾아서 레벨과 포인트를 바꾸시오
    mysqli_query($con, $sql);
    mysqli_close($con);

    // header("admin.php");
    // header('Location : admin.php');
    echo "
         <script>
             location.href = 'admin.php';
         </script>
       ";
?>
