<?php
session_start();
?>
<meta charset="utf-8">

<?php
include_once "../lib/db_connector.php";
$id= $q_id = $sql= $result = "";

if(isset($_GET["mode"])&&$_GET["mode"]== "nick_check"){
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
}else if(isset($_GET["mode"])&&$_GET["mode"]=="update"){
    $id = test_input($_POST["id"]);
    $q_id = mysqli_real_escape_string($conn, $id);
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

    $sql = "UPDATE member SET pass='$pass',name='$name',nick='$nick',hp='$hp',email='$email' WHERE id='$q_id'";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
    $_SESSION['username']=$name;
    $_SESSION['usernick']=$nick;
    echo "<script>location.href='../index.php';</script>";
}//end of if insert
mysqli_close($conn);
?>
