<meta charset="utf-8">

<?php
include_once $_SERVER['DOCUMENT_ROOT']."/ansisung/lib/db_connector.php";
include $_SERVER['DOCUMENT_ROOT']."/ansisung/lib/create_table.php";
create_table($conn,'member');//낙서장 테이블생성
//_________________________________________________________________________//
$id= $q_id = $sql= $result = "";
// $name = $sub1 = $sub2 = $sub3 = $sub4 =$sub5 =  "";
// $sum = $avg= $sql = $q_name = $mode = $result= "";
//1. INSERT_stu,
//_________________________________________________________________________//
if(isset($_GET["mode"])&&$_GET["mode"]== "id_check"){
  if(empty($_GET["id"])){
    echo "아이디값이 없습니다. 아이디값을 입력하세요";
  }else{
      // $id= test_input($_GET["id"]);
      //3 데이타베이스에서 sql injection 방어할수 있음.
      $q_id = mysqli_real_escape_string($conn, test_input($_GET["id"]));

      $sql="select * from member where id = '$q_id'";
      $result = mysqli_query($conn,$sql);
      if (!$result) {
        die('Error: ' . mysqli_error($conn));
      }
      $rowcount=mysqli_num_rows($result);
      // var_dump($rowcount);
      if($rowcount){
        echo "아이디가 중복이 됩니다.<br>";
        echo "다른 아이디를 사용하세요.<br>";
      }else{
        echo "사용가능한 아이디 입니다. ";
      }
  }//내부 end of if
}else if(isset($_GET["mode"])&&$_GET["mode"]== "nick_check"){
  if(empty($_GET["nick"])){
    echo "닉네임값이 없습니다. 닉네임값을 입력하세요";
  }else{
      $nick= test_input($_GET["nick"]);
      //3 데이타베이스에서 sql injection 방어할수 있음.
      $q_nick = mysqli_real_escape_string($conn, $nick);

      $sql="select * from member where nick = '$q_nick'";
      $result = mysqli_query($conn,$sql);
      if (!$result) {
        die('Error: ' . mysqli_error($conn));
      }
      $rowcount=mysqli_num_rows($result);
      // var_dump($rowcount);
      if($rowcount){
        echo "닉네임이 중복이 됩니다.<br>";
        echo "다른 닉네임을 사용하세요.<br>";
      }else{
        echo "사용가능한 닉네임 입니다. ";
      }
  }//내부 end of if
}else if(isset($_GET["mode"])&&$_GET["mode"]=="insert"){
    $id = test_input($_POST["id"]);
    $q_id = mysqli_real_escape_string($conn, $id);
    $sql="select * from member where id = '$q_id'";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
    $rowcount=mysqli_num_rows($result);
    // var_dump($rowcount);
    if($rowcount){
      echo "<script>alert('아이디존재!!!');history.go(-1);</script>";
      exit;
    }else{
      $pass = test_input($_POST["pass"]);
      $name= test_input($_POST["name"]);
      $nick = test_input($_POST["nick"]);
      $hp1 = test_input($_POST["hp1"]);
      $hp2 = test_input($_POST["hp2"]);
      $hp3 = test_input($_POST["hp3"]);
      $hp =$hp1."-".$hp2."-".$hp3;
      $email1 = test_input($_POST["email1"]);
      $email2 = test_input($_POST["email2"]);
      $email = $email1."@".$email2;
      $regist_day=date("Y-m-d (H:i)");

      $sql="INSERT INTO member (id,pass,name,nick,hp,email,regist_day,level) ";
      $sql.=" VALUES ('$id','$pass','$name','$nick','$hp','$email','$regist_day',9)";
      $result = mysqli_query($conn,$sql);
      if (!$result) {
        die('Error: ' . mysqli_error($conn));
      }
      mysqli_close($conn);
      echo "<script>location.href='../index.php';</script>";
  }//end of if rowcount

}//end of if insert

mysqli_close($conn);
// Header("Location: p260_score_list.php");

?>
