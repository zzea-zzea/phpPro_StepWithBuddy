<?php
  $id = $_POST["inputId"];
  $pw = $_POST["inputPw1"];
  $name = $_POST["inputName"];
  $email = $_POST["inputEmail"];
  $regist_day = date("Y-m-d (H:i)");

  $con = mysqli_connect("localhost", "root", "123456", "cobrain");
  $sql = "insert into members(id, pw, name, email, regist_day, level, point) ";
	$sql .= "values('$id', '$pw', '$name', '$email', '$regist_day', 9, 0)";

  mysqli_query($con, $sql);
  mysqli_close($con);

  echo "
      <script>
        location.href = './member_welcome.php?name={$name}';
      </script>
  ";

 ?>
