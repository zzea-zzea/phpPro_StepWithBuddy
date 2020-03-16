<?php
  $send_id = $_POST["send_id"];
  $rv_id = $_POST['rv_id'];
  $subject = $_POST['subject'];
  $content = $_POST['content'];

  $subject = htmlspecialchars($subject, ENT_QUOTES);
  $content = htmlspecialchars($content, ENT_QUOTES);
  $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

	$con = mysqli_connect("localhost", "root", "123456", "cobrain");

  $sql = "insert into message (send_id, rv_id, subject, content,  regist_day) ";
  $sql .= "values('$send_id', '$rv_id', '$subject', '$content', '$regist_day')";
  $result = mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
  mysqli_close($con);                // DB 연결 끊기

  if($result==true){
    echo "1";
  }else{
    echo "0";
  }

 ?>
