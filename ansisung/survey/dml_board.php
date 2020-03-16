<?php
include $_SERVER['DOCUMENT_ROOT']."/ansisung/lib/session_call.php";
include $_SERVER['DOCUMENT_ROOT']."/ansisung/lib/db_connector.php";
?>
<meta charset="utf-8">
<?php
$content= $q_content = $sql= $result = $userid="";

if(isset($_GET["composer"]) && !empty($_GET["composer"])){
  $get_composer = test_input($_GET["composer"]);
  // $percent = test_input($_POST["percent"]);
  // $post_composer = test_input($_POST["composer"]);

  $sql="UPDATE `survey` SET  `$get_composer`= `$get_composer` + 1 ;";
  $result = mysqli_query($conn,$sql);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }
}

mysqli_close($conn);

Header("Location: ./result.php");

?>
