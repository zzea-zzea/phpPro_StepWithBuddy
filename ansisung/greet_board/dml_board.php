<?php
session_start();
?>
<meta charset="utf-8">

<?php
include_once "../lib/db_connector.php";

$content= $q_content = $sql= $result = $userid="";
$userid = $_SESSION['userid'];
if(empty($userid)){
  echo "<script>alert('로그인요망!');history.go(-1);</script>";
  exit;
}

if(isset($_GET["mode"])&&$_GET["mode"]=="insert"){
    $content = trim($_POST["content"]);
    $subject = trim($_POST["subject"]);
    if(empty($content)||empty($subject)){
      echo "<script>alert('내용이나제목입력요망!');history.go(-1);</script>";
      exit;
    }
    $subject = test_input($_POST["subject"]);
    $content = test_input($_POST["content"]);
    $userid = test_input($userid);
    $hit = 0;
    $is_html=(!isset($_POST["is_html"]))?('n'):('y');
    $q_subject = mysqli_real_escape_string($conn, $subject);
    $q_content = mysqli_real_escape_string($conn, $content);
    $q_userid = mysqli_real_escape_string($conn, $userid);
    $regist_day=date("Y-m-d (H:i)");

    $sql="INSERT INTO `greet_board` VALUES (null,'$q_userid','$q_subject','$q_content','$regist_day',0,'$is_html');";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }

    $sql="SELECT num from greet_board where id ='$userid' order by num desc limit 1;";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
    $row=mysqli_fetch_array($result);
    $num=$row['num'];
    mysqli_close($conn);

    echo "<script>location.href='./view.php?num=$num&hit=$hit';</script>";


}else if(isset($_GET["mode"])&&$_GET["mode"]=="delete"){
    $num = test_input($_GET["num"]);
    $q_num = mysqli_real_escape_string($conn, $num);

    $sql ="DELETE FROM `greet_board` WHERE num=$q_num";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }

    mysqli_close($conn);
    echo "<script>location.href='./list.php?page=1';</script>";

}else if(isset($_GET["mode"])&&$_GET["mode"]=="update"){
  $content = trim($_POST["content"]);
  $subject = trim($_POST["subject"]);
  if(empty($content)||empty($subject)){
    echo "<script>alert('내용이나제목입력요망!');history.go(-1);</script>";
    exit;
  }
  $subject = test_input($_POST["subject"]);
  $content = test_input($_POST["content"]);
  $userid = test_input($userid);
  $num = test_input($_POST["num"]);
  $hit = test_input($_POST["hit"]);
  $is_html=(!isset($_POST["is_html"]))?('n'):('y');
  $q_subject = mysqli_real_escape_string($conn, $subject);
  $q_content = mysqli_real_escape_string($conn, $content);
  $q_userid = mysqli_real_escape_string($conn, $userid);
  $q_num = mysqli_real_escape_string($conn, $num);
  $regist_day=date("Y-m-d (H:i)");

  $sql="UPDATE `greet_board` SET `subject`='$q_subject',`content`='$q_content',`regist_day`='$regist_day',`is_html` ='$is_html' WHERE `num`=$q_num;";
  $result = mysqli_query($conn,$sql);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }
  echo "<script>location.href='./view.php?num=$num&hit=$hit';</script>";
}//end of if insert


// Header("Location: p260_score_list.php");

?>
