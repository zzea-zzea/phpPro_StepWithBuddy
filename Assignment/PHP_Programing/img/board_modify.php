<?php
    $num = $_GET["num"];
    $page = $_GET["page"];

    $subject = $_POST["subject"];
    $content = $_POST["content"];

    $con = mysqli_connect("localhost", "root", "123456", "sample");
    $sql = "update board set subject='$subject', content='$content' ";
    $sql .= " where num=$num";
    //board테이블에서 $num값에 데이터를 가져와서 $subject,$content값으로 수정,바꾼다
    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "
	      <script>
	          location.href = 'board_list.php?page=$page';
	      </script>
	  ";
?>
