<?php
  $id = $_GET["id"];

  $con = mysqli_connect("localhost", "root", "123456", "cobrain");
  $sql = "select * from members where id = '$id'";

  $result = mysqli_query($con, $sql);
  $result_record = mysqli_num_rows($result);

  if($result_record){
    echo "1";
  }else{
    echo "0";
  }

  mysqli_close($con);

 ?>
