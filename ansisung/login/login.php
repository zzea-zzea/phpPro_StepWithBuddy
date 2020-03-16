<?php
session_start();
?>
<meta charset="utf-8">
<?php
include_once "../lib/db_connector.php";
$id= $q_id = $sql= $result = $pass = $q_pass= $row= "";
$flag ="NO";

$sql = "show tables from ansisung";
$result=mysqli_query($conn,$sql) or die('Error: '.mysqli_error($conn));

while ($row=mysqli_fetch_row($result)) {
  if($row[0] ==='member'){
    $flag="OK";
    break;
  }
}

if($flag==="NO"){
    echo "<script>alert('member 테이블이 없습니다.');
      history.go(-1);
    </script> ";
    mysqli_close($conn);
    exit;
}


if(!(isset($_POST["id"]) && isset($_POST["pass"]))||
(empty($_POST["id"]) || empty($_POST["pass"]))){
    echo "<script>alert('id와 pass 모두 입력해주세요.');
      history.go(-1);
    </script> ";
    mysqli_close($conn);
    exit;
}else{

  $id= test_input($_POST["id"]);
  $pass= test_input($_POST["pass"]);
  //3 데이타베이스에서 sql injection 방어할수 있음.
  $q_id = mysqli_real_escape_string($conn, $id);
  $q_pass = mysqli_real_escape_string($conn, $pass);

  $sql="select * from member where id = '$q_id' AND pass = '$q_pass'";
  $result = mysqli_query($conn,$sql);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }
  $rowcount=mysqli_num_rows($result);
  // var_dump($rowcount);
  if(!$rowcount){
    echo "<script>alert('로그인실패');
      history.go(-1);
    </script> ";
    mysqli_close($conn);
    exit;
  }else{
    $row=mysqli_fetch_array($result);
    $_SESSION['userid']=$row['id'];
    $_SESSION['username']=$row['name'];
    $_SESSION['usernick']=$row['nick'];
    $_SESSION['userlevel']=$row['level'];
  }

}//end of  check id and pass

mysqli_close($conn);
Header("Location: ../index.php");

?>
