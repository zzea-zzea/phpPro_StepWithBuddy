<?php
include $_SERVER['DOCUMENT_ROOT']."/ansisung/lib/session_call.php";
include $_SERVER['DOCUMENT_ROOT']."/ansisung/lib/db_connector.php";
?>
<meta charset="utf-8">
<?php
$content= $q_content = $sql= $result = $userid="";
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$usernick = $_SESSION['usernick'];

if(isset($_GET["mode"])&&$_GET["mode"]=="insert"){
    $content = trim($_POST["content"]);
    $subject = trim($_POST["subject"]);
    if(empty($content)||empty($subject)){
      alert_back('1. 내용이나제목입력요망!');
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

    //include 파일업로드기능
    include  "./lib/file_upload.php";

    //8 파일의 실제명과 저장되는 명을 삽입한다.
    $sql="INSERT INTO `concert_board` VALUES (null,'$q_userid','$username','$usernick','$q_subject','$q_content','$regist_day',0,'$is_html','$upfile_name','$copied_file_name');";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      alert_back('Error:5 ' . mysqli_error($conn));
      // die('Error: ' . mysqli_error($conn));
    }


    //등록된사용자가 최근 입력한 이미지게시판을 보여주기 위하여 num 찾아서 전달하기 위함이다.
    $sql="SELECT num from `concert_board` where id ='$userid' order by num desc limit 1;";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      alert_back('Error: 6' . mysqli_error($conn));
      // die('Error: ' . mysqli_error($conn));
    }
    $row=mysqli_fetch_array($result);
    $num=$row['num'];
    mysqli_close($conn);

    echo "<script>location.href='./view.php?num=$num&hit=$hit';</script>";

}else if(isset($_GET["mode"])&&$_GET["mode"]=="delete"){
    $num = test_input($_GET["num"]);
    $q_num = mysqli_real_escape_string($conn, $num);

    //삭제할 게시물의 이미지파일명을 가져와서 삭제한다.
    $sql="SELECT `file_copied_0` from `concert_board` where num ='$q_num';";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      alert_back('Error: 6' . mysqli_error($conn));
      // die('Error: ' . mysqli_error($conn));
    }
    $row=mysqli_fetch_array($result);
    $file_copied_0=$row['file_copied_0'];

    if(!empty($file_copied_0)){
      unlink("./data/".$file_copied_0);
    }

    $sql ="DELETE FROM `concert_board` WHERE num=$q_num";
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
  $is_html=(isset($_POST["is_html"]))?('y'):('n');
  $q_subject = mysqli_real_escape_string($conn, $subject);
  $q_content = mysqli_real_escape_string($conn, $content);
  $q_userid = mysqli_real_escape_string($conn, $userid);
  $q_num = mysqli_real_escape_string($conn, $num);
  $regist_day=date("Y-m-d (H:i)");

  //삭제할게 있으면 삭제하라.
  if(isset($_POST['del_file']) && $_POST['del_file'] =='1'){
    //삭제할 게시물의 이미지파일명을 가져와서 삭제한다.
    $sql="SELECT `file_copied_0` from `concert_board` where num ='$q_num';";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      alert_back('Error: 6' . mysqli_error($conn));
      // die('Error: ' . mysqli_error($conn));
    }
    $row=mysqli_fetch_array($result);
    $file_copied_0=$row['file_copied_0'];
    if(!empty($file_copied_0)){
      unlink("./data/".$file_copied_0);
    }

    $sql="UPDATE `concert_board` SET `file_name_0`='', `file_copied_0` ='' WHERE `num`=$q_num;";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }

  }

  //파일첨부
  if(!empty($_FILES['upfile']['name'])){
    //include 파일업로드기능
    include  "./lib/file_upload.php";

    $sql="UPDATE `concert_board` SET `subject`='$q_subject',`content`='$q_content',`regist_day`='$regist_day',`is_html` ='$is_html', `file_name_0`= '$upfile_name', `file_copied_0` ='$copied_file_name' WHERE `num`=$q_num;";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
  }
  echo "<script>location.href='./view.php?num=$num&hit=$hit';</script>";
}//end of if insert

?>
