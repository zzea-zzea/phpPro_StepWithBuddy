<!-- //board테이블에 저장
<!-- //board테이블에 저장
//파일 복사 날짜 파일명 복사 -->
<meta charset="utf-8">
<?php
session_start();
$username=$_SESSION['username'];
$userid=$_SESSION['userid'];
$mode = $_GET['mode'];
function test_input($data)
{
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
    $con = mysqli_connect("localhost", "root", "123456", "phpprograming");
if ($mode=='insert') {
    $content = $_POST["content"];
    $subject = $_POST["subject"];
    if (empty($content)||empty($subject)) {
        echo "<script>alert('내용이나제목입력요망!');history.go(-1);</script>";
        exit;
    }
    $subject = test_input($_POST["subject"]);
    $content = test_input($_POST["content"]);
    $userid = test_input($userid);
    $hit = 0;
    //초기값
    //그룹 넘버 = 0 --->답변 : 0
    //댑스 = 0 --->답변 : 1
    //오더 = 0 --->답변 : 오더 보다 큰 값은 전부 1을 더해서 저장하고 자기자신은 보더에 더하기 1을 해서 저장한다
    $q_subject = mysqli_real_escape_string($con, $subject);
    $q_content = mysqli_real_escape_string($con, $content);
    $q_userid = mysqli_real_escape_string($con, $userid);
    $regist_day=date("Y-m-d (H:i)");

    //그룹번호, 들여쓰기 기본값
    $group_num = 0;
    $depth=0;
    $ord=0;

    $sql="INSERT INTO `qna` VALUES (null,$group_num,$depth,$ord,'$q_userid','$username','$q_subject','$q_content','$regist_day',0);";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Error: ' . mysqli_error($con));
    }

    //현재 최대큰번호를 가져와서 그룹번호로 저장하기
    $sql="SELECT max(num) from qna;";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Error: ' . mysqli_error($con));
    }
    $row=mysqli_fetch_array($result);
    $max_num=$row['max(num)'];
    $sql="UPDATE `qna` SET `group_num`= $max_num WHERE `num`=$max_num;";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Error: ' . mysqli_error($con));
    }
    mysqli_close($con);

    // echo "<script>location.href='./view.php?num=$max_num&hit=$hit';</script>";
    echo "<script>location.href='./qna_list.php';</script>";

//response
} elseif ($mode=='response') {
    $num=(int)$_GET['num'];
    $sql = "select * from qna where num = $num ";
    $result=mysqli_query($con, $sql);
    $row=mysqli_fetch_array($result);
    $content = trim($_POST["content"]);
    $subject = trim($_POST["subject"]);
    if (empty($content)||empty($subject)) {
        echo "<script>alert('내용이나제목입력요망!');history.go(-1);</script>";
        exit;
    }
    $subject = test_input($_POST["subject"]);
    $content = test_input($_POST["content"]);
    $userid = test_input($userid);
    // $hit = test_input($_POST["hit"]);
    $hit =0;
    // $q_subject = mysqli_real_escape_string($conn, $subject);
    // $q_content = mysqli_real_escape_string($conn, $content);
    // $q_userid = mysqli_real_escape_string($conn, $userid);
    // $q_num = mysqli_real_escape_string($conn, $num);
    $regist_day=date("Y-m-d (H:i)");

    $sql="SELECT * from qna where num =$num;"; //부모넘버
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Error: ' . mysqli_error($con));
    }
    $row=mysqli_fetch_array($result);

    //현재 그룹넘버값을 가져와서 저장한다.
    $group_num=(int)$row['group_num'];
    //현재 들여쓰기값을 가져와서 증가한후 저장한다.
    $depth=(int)$row['depth'] + 1;
    //현재 순서값을 가져와서 증가한후 저장한다.
    $ord=(int)$row['ord'] + 1;

    //현재 그룹넘버가 같은 모든 레코드를 찾아서 현재 $ord값보다 같거나 큰 레코드에 $ord 값을 1을 증가시켜 저장한다.
    //(최근댓글(1)이위에 그전댓글(2)이 바로 밑에 처음단 댓글(3)은 맨 아래)
    $sql="UPDATE `qna` SET `ord`=`ord`+1 WHERE `group_num` = $group_num and `ord` >= $ord";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Error: ' . mysqli_error($con));
    }

    $sql="INSERT INTO `qna` VALUES (null,$group_num,$depth,$ord,
    '$userid','$username','$subject','$content','$regist_day',$hit);";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Error: ' . mysqli_error($con));
    }

    $sql="SELECT max(num) from qna;";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Error: ' . mysqli_error($con));
    }
    $row=mysqli_fetch_array($result);
    $max_num=$row['max(num)'];

    echo "<script>location.href='./qna_list.php?num=$max_num&hit=$hit';</script>";
} else if ($mode=='delete') {
  $num = test_input($_GET["num"]);
  $q_num = mysqli_real_escape_string($con, $num);

  $sql ="DELETE FROM `qna` WHERE num=$q_num";
  $result = mysqli_query($con,$sql);
  if (!$result) {
    die('Error: ' . mysqli_error($con));
  }

  mysqli_close($con);
  echo "<script>location.href='./qna_list.php?page=1';</script>";
}
?>
