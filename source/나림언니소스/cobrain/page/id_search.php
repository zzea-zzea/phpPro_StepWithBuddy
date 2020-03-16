<?php
  $value = $_GET["id"];

  $con = mysqli_connect("localhost", "root", "123456", "cobrain");
  $sql = "select * from members where id='$value' or name='$value'";
  $result = mysqli_query($con, $sql);

  $num_match = mysqli_num_rows($result);

  $data_arr = array();

  if(!$num_match){
    array_push($data_arr, array("result"=>"0"));
  } else{
    for($i = 0; $i<$num_match; $i++){
      mysqli_data_seek($result, $i);
      $row = mysqli_fetch_array($result);
      $db_id = $row["id"];
      $db_name = $row["name"];

      array_push($data_arr, array("result"=>$num_match, "id"=>$db_id, "name"=>$db_name));
    }
  }

  mysqli_close($con);
  echo json_encode($data_arr);
 ?>
