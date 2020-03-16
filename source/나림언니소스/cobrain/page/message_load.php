<?php
  $mode = $_POST["mode"];
  $page = $_POST["page"];
  $id = $_POST["id"];
  $scale = $_POST["scale"];

  $con = mysqli_connect("localhost", "root", "123456", "cobrain");

  if ($mode=="send")
    $sql = "select * from message where send_id='$id' order by num desc";
  else
    $sql = "select * from message where rv_id='$id' order by num desc";

  $result = mysqli_query($con, $sql);
  $total_record = mysqli_num_rows($result); // 전체 글 수

  // 전체 페이지 수($total_page) 계산
  if ($total_record % $scale == 0)
    $total_page = floor($total_record/$scale);
  else
    $total_page = floor($total_record/$scale) + 1;

  // 표시할 페이지($page)에 따라 $truncated_num(한페이지에서 10개 리스트 보여지고 그 뒤 짤리는 넘버) 계산
  $truncated_num = ($page - 1) * $scale;
  $start_num = $total_record - $truncated_num;

  //게시판 맨 상단 번호
  $number = $total_record - $truncated_num;

  //json으로 만들어 보낼 배열객체
  $message_total_arr=array();

  //전체 페이지 수를 저장
  array_push($message_total_arr, array("total_page"=>$total_page, "number"=>$number));

   for ($i=$truncated_num; $i < $truncated_num+$scale && $i < $total_record; $i++)
   {
     // 가져올 레코드로 위치(포인터) 이동
      mysqli_data_seek($result, $i);

      //포인터에 해당되는 레코드를 가져옴
      $row = mysqli_fetch_array($result);

      $num = $row["num"];
      $subject = $row["subject"];
      $content = $row["content"];
      $regist_day = $row["regist_day"];

      if($mode=="send"){
        $msg_id = $row["rv_id"];
      }else if($mode=="rcv"){
        $msg_id = $row["send_id"];
      }else{
        $msg_id ="오류!";
      }

    $result2 = mysqli_query($con, "select name from members where id='$msg_id'");
    $record = mysqli_fetch_array($result2);
    $msg_name = $record["name"];

    $message_arr = array("num"=>$num, "subject"=>$subject, "name"=>$msg_name, "id"=>$msg_id, "content"=>$content, "regist_day"=>$regist_day);

    array_push($message_total_arr, $message_arr);
  }

  echo json_encode($message_total_arr);

?>
