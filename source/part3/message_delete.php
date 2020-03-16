<meta charset='utf-8'>

<?php

    $num = $_GET["num"];
    $mode = $_GET["mode"];

    $con = mysqli_connect("localhost", "root", "123456", "sample");

    $sql = "delete from message where num=$num";
    //메세지 테이블에서 num라는 해당되는 레코드를 지워라

    mysqli_query($con, $sql);
    //원칙상 리턴값이 필요함
    mysqli_close($con);                // DB 연결 끊기

    if ($mode == "send") {
        //url을 메세지박스에 send 보내고
        $url = "message_box.php?mode=send";
    } else {
        //url을 메세지박스에 rv 보내라
        $url = "message_box.php?mode=rv";
    }
    echo "
	<script>
		location.href = '$url';
	</script>

	";

?>
