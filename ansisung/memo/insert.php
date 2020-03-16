<?php
session_start();
?>
<meta charset="utf-8">

<?php
include_once "../lib/db_connector.php";

$content= $q_content = $sql= $result = $userid="";


if(isset($_GET["mode"])&&$_GET["mode"]=="memo"){
    if(empty($_POST["content"])){
      echo "<script>alert('내용입력요망!');history.go(-1);</script>";
      exit;
    }
    $userid=$_SESSION['userid'];
    $q_userid = mysqli_real_escape_string($conn, $userid);
    $sql="select * from member where id = '$q_userid'";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
    $rowcount=mysqli_num_rows($result);

    if(!$rowcount){
      echo "<script>alert('없는 아이디!!');history.go(-1);</script>";
      exit;
    }else{
      $content = test_input($_POST["content"]);
      $q_usernick = mysqli_real_escape_string($conn, $_SESSION['usernick']);
      $q_username = mysqli_real_escape_string($conn, $_SESSION['username']);
      $q_content = mysqli_real_escape_string($conn, $content);
      $regist_day=date("Y-m-d (H:i)");

      $sql="INSERT INTO `memo` VALUES (null,'$q_userid','$q_username', '$q_usernick','$q_content','$regist_day')";
      $result = mysqli_query($conn,$sql);
      if (!$result) {
        die('Error: ' . mysqli_error($conn));
      }
      mysqli_close($conn);
      echo "<script>location.href='./memo_main.php?page=1';</script>";
  }//end of if rowcount

}else if(isset($_GET["mode"])&&$_GET["mode"]=="delete"){
    $page= test_input($_GET["page"]);
    $num = test_input($_POST["num"]);
    $q_num = mysqli_real_escape_string($conn, $num);

    $sql ="DELETE FROM `memo` WHERE num=$q_num";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
    
    $sql ="DELETE FROM `memo_ripple` WHERE parent=$q_num";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }

    mysqli_close($conn);
    echo "<script>location.href='./memo_main.php?page=$page';</script>";

}else if(isset($_GET["mode"])&&$_GET["mode"]=="delete_ripple"){
  $page= test_input($_GET["page"]);
  $num = test_input($_POST["num"]);
  $q_num = mysqli_real_escape_string($conn, $num);

  $sql ="DELETE FROM `memo_ripple` WHERE num=$q_num";
  $result = mysqli_query($conn,$sql);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }
  mysqli_close($conn);
  echo "<script>location.href='./memo_main.php?page=$page';</script>";

}else if(isset($_GET["mode"])&&$_GET["mode"]=="insert_ripple"){
  if(empty($_POST["ripple_content"])){
    echo "<script>alert('내용입력요망!');history.go(-1);</script>";
    exit;
  }
  $userid=$_SESSION['userid'];
  $q_userid = mysqli_real_escape_string($conn, $userid);
  $sql="select * from member where id = '$q_userid'";
  $result = mysqli_query($conn,$sql);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }
  $rowcount=mysqli_num_rows($result);

  if(!$rowcount){
    echo "<script>alert('없는 아이디!!');history.go(-1);</script>";
    exit;
  }else{
    $content = test_input($_POST["ripple_content"]);
    $page = test_input($_POST["page"]);
    $parent = test_input($_POST["parent"]);
    $q_usernick = mysqli_real_escape_string($conn, $_SESSION['usernick']);
    $q_username = mysqli_real_escape_string($conn, $_SESSION['username']);
    $q_content = mysqli_real_escape_string($conn, $content);
    $q_parent = mysqli_real_escape_string($conn, $parent);
    $regist_day=date("Y-m-d (H:i)");

    $sql="INSERT INTO `memo_ripple` VALUES (null,'$q_parent','$q_userid','$q_username', '$q_usernick','$q_content','$regist_day')";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
    mysqli_close($conn);
    echo "<script>location.href='./memo_main.php?page=$page';</script>";
}//end of if rowcount


}//end of if insert

mysqli_close($conn);
// Header("Location: p260_score_list.php");

?>
