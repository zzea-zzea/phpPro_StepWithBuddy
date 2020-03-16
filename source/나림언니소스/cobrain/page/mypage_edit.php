<?php
  $id = $_GET["id"];

  $pw = $_POST["inputPw1"];
  $name = $_POST["inputName"];
  $email  = $_POST["inputEmail"];

  $con = mysqli_connect("localhost", "root", "123456", "cobrain");

  if($pw==""){
    $sql = "update members set name='$name', email='$email'";
  }else{
    $sql = "update members set pass='$pass', name='$name', email='$email'";
  }
  $sql .= " where id='$id'";

  mysqli_query($con, $sql);

  mysqli_close($con);

  session_start();
  $_SESSION["username"] = $name;

  echo "
        <script>
            location.href = '/cobrain/index.php';
        </script>
	     ";
?>
