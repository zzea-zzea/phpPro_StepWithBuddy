<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/ansisung/lib/db_connector.php";
$num=$id=$subject=$content=$day=$hit=$image_width="";

if(empty($_GET['page'])){
  $page=1;
}else{
  $page=$_GET['page'];
}

if(isset($_GET["num"])&&!empty($_GET["num"])){
    $num = test_input($_GET["num"]);
    $hit = test_input($_GET["hit"]);
    $q_num = mysqli_real_escape_string($conn, $num);

    $sql="UPDATE `concert_board` SET `hit`=$hit WHERE `num`=$q_num;";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }

    $sql="SELECT * from `concert_board` where num ='$q_num';";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
    $row=mysqli_fetch_array($result);
    $id=$row['id'];
    $name=$row['name'];
    $nick=$row['nick'];
    $hit=$row['hit'];
    $subject= htmlspecialchars($row['subject']);
    $content= htmlspecialchars($row['content']);
    $subject=str_replace("\n", "<br>",$subject);
    $subject=str_replace(" ", "&nbsp;",$subject);
    $content=str_replace("\n", "<br>",$content);
    $content=str_replace(" ", "&nbsp;",$content);
    $is_html=$row['is_html'];
    $file_name_0=$row['file_name_0'];
    $file_copied_0=$row['file_copied_0'];
    $day=$row['regist_day'];


    //숫자 0 " " '0' null 0.0   $a = array()
    if(!empty($file_copied_0)){
      //이미지 정보를 가져오기 위한 함수 width, height, type
      $image_info=getimagesize("./data/".$file_copied_0);
      $image_width=$image_info[0];
      $image_height=$image_info[1];
      $image_type=$image_info[2];
      if($image_width>400) $image_width = 400;
    }else{
      $image_width=0;
      $image_height=0;
      $image_type="";
    }
    mysqli_close($conn);
}

?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/greet.css">
    <script type="text/javascript" src="../js/member_form.js?ver=1"></script>
    <title></title>
  </head>
  <body>
    <div id="wrap">
      <div id="header">
          <?php include "../lib/top_login2.php"; ?>
      </div><!--end of header  -->
      <div id="menu">
        <?php include "../lib/top_menu2.php"; ?>
      </div><!--end of menu  -->
      <div id="content">
       <div id="col1">
         <div id="left_menu">
           <?php include "../lib/left_menu.php"; ?>
         </div>
       </div><!--end of col1  -->
       <div id="col2">
         <div id="title"><img src="../img/title_concert.gif"></div>
         <div class="clear"></div>
         <div id="write_form_title"></div>
         <div class="clear"></div>
            <div id="write_form">
              <div class="write_line"></div>
              <div id="write_row1">
                <div class="col1">아이디</div>
                <div class="col2"><?=$id?>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  조회 : <?=$hit?> &nbsp;&nbsp;&nbsp; 입력날짜: <?=$day?>
                </div>

              </div><!--end of write_row1  -->
              <div class="write_line"></div>
              <div id="write_row2">
                <div class="col1">제&nbsp;&nbsp;목</div>
                <div class="col2"> <input type="text" name="subject" value="<?=$subject?>" readonly></div>
              </div><!--end of write_row2  -->
              <div class="write_line"></div>

              <div id="view_content">
                <div class="col2">
                  <img src='<?="./data/".$file_copied_0?>' width="<?=$image_width?>"><br>
                  <?=$content?>
                </div><!--end of col2  -->
              </div><!--end of view_content  -->
            </div><!--end of write_form  -->


            <div id="write_button">
              <a href="./list.php?page=<?=$page?>"><img src="../img/list.png"></a>

            <?php
              //관리자이거나 해당된 작성자일경우 수정, 삭제가 가능하도록 설정
              if($_SESSION['userid']=="admin" || $_SESSION['userid']==$id){
                echo('<a href="./write_edit_form.php?mode=update&num='.$num.'"><img src="../img/modify.png"></a>&nbsp;');
                echo('<img src="../img/delete.png" onclick="check_delete('.$num.')">&nbsp;');
              }
              //로그인하는 유저에게 글쓰기 기능을 부여함.
              if(!empty($_SESSION['userid'])){
              echo '<a href="write_edit_form.php"><img src="../img/write.png"></a>';
              }
            ?>
            </div><!--end of write_button-->
      </div><!--end of col2  -->
      </div><!--end of content -->
    </div><!--end of wrap  -->
  </body>
</html>
