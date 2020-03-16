        <div id="main_img_bar">
            <img src="./img/main_img.png">
        </div>
        <div id="main_content">
            <div id="latest">
                <h4>최근 게시글(15장)</h4>
                <ul>
<!-- 최근 게시 글 DB에서 불러오기 -->
<?php
    $con = mysqli_connect("localhost", "root", "123456", "sample");
    $sql = "select * from board order by num desc limit 5";
    $result = mysqli_query($con, $sql);

    if (!$result)
        echo "게시판 DB 테이블(board)이 생성 전이거나 아직 게시글이 없습니다!";
    else
    {
        while( $row = mysqli_fetch_array($result) )
        {
            $regist_day = substr($row["regist_day"], 0, 10);
?>
                <li>
                    <span><?=$row["subject"]?></span>
                    <span><?=$row["name"]?></span>
                    <span><?=$regist_day?></span>
                </li>
<?php
        }
    }
?>
            </div>
            <div id="point_rank">
                <h4>포인트 랭킹(15장)</h4>
                <ul>
<!-- 포인트 랭킹 표시하기 -->
<?php
    $rank = 1;
    $sql = "select * from members order by point desc limit 5";
    $result = mysqli_query($con, $sql);

    if (!$result)
        echo "회원 DB 테이블(members)이 생성 전이거나 아직 가입된 회원이 없습니다!";
    else
    {
        while( $row = mysqli_fetch_array($result) )//연관배열
        {
            $name  = $row["name"];
            $id    = $row["id"];
            $point = $row["point"];
            $name = mb_substr($name, 0, 1)." * ".mb_substr($name, 2, 1);
?>
                <li>
                    <span><?=$rank?></span>//객체
                    <span><?=$name?></span>
                    <span><?=$id?></span>
                    <span><?=$point?></span>
                </li>
<?php
            $rank++;
        }
    }
// $POST["id"] => $ => 배열 거기에 아이디 값을 가져옴
// 1.숫자 2.문자 3.부울형 4.배열 5. 객체
// 사용자가 입력한 값 디비에 인덱션 하는 부분을 검토 해야할때 - filltering
// 디비로 부터 사용자에게 보여줄때 - escaping
// html specialchars 을 넣어서 전부 방어
// 주소 - $sever.document
// 맨처음에 sectionstart 앞에 아무것도 적지 말아라

// @session_start();
// session_start()에서 오류가 나올때 꼭 알아두어야 할내용
// - session_start(); 전에 출력문이 있으면 안된다.
// - @session_start(); 이문장은 경고가 나오면 경고문을 보이지말라는 의미지 해결은 아님
// - 그래도 안된다면 세션변수가 저장되는 폴더 권한을 777로 주었는지 확인해보자.
// - 그래도 안된다면 php.ini 에서 default-charset utf-8 로 설정해보라.

    mysqli_close($con);
?>
                </ul>
            </div>
        </div>
