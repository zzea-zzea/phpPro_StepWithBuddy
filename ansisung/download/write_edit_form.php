<?php
include $_SERVER['DOCUMENT_ROOT']."/ansisung/lib/session_call.php";
include $_SERVER['DOCUMENT_ROOT']."/ansisung/lib/db_connector.php";

$num=$id=$subject=$content=$day=$hit="";
$mode="insert";
$checked="";
$id= $_SESSION['userid'];

if(isset($_GET["mode"])&&$_GET["mode"]=="update"){
    $mode="update";
    $num = test_input($_GET["num"]);
    $q_num = mysqli_real_escape_string($conn, $num);

    $sql="SELECT * from `download_board` where num ='$q_num';";
    $result = mysqli_query($conn,$sql);

    if (!$result) alert_back("Error: " . mysqli_error($conn));

    $row=mysqli_fetch_array($result);
    $id=$row['id'];
    $subject= htmlspecialchars($row['subject']);
    $content= htmlspecialchars($row['content']);
    $subject=str_replace("\n", "<br>",$subject);
    $subject=str_replace(" ", "&nbsp;",$subject);
    $content=str_replace("\n", "<br>",$content);
    $content=str_replace(" ", "&nbsp;",$content);
    $file_name_0=$row['file_name_0'];
    $file_copied_0=$row['file_copied_0'];
    $file_type_0=$row['file_type_0'];
    $day=$row['regist_day'];
    $hit=$row['hit'];
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/greet.css">
    <script type="text/javascript" src="../js/member_form.js"></script>
    <title></title>
  </head>
  <body>
    <div id="wrap">
      <div id="header">
          <?php include $_SERVER['DOCUMENT_ROOT']."/ansisung/lib/top_login2.php"; ?>
      </div><!--end of header  -->
      <div id="menu">
        <?php include $_SERVER['DOCUMENT_ROOT']."/ansisung/lib/top_menu2.php"; ?>
      </div><!--end of menu  -->
      <div id="content">
       <div id="col1">
         <div id="left_menu">
           <?php include $_SERVER['DOCUMENT_ROOT']."/ansisung/lib/left_menu.php"; ?>
         </div>
       </div><!--end of col1  -->
       <div id="col2">
         <div id="title"><img src="../img/title_greet.gif"></div>
         <div class="clear"></div>
         <div id="write_form_title"><img src="../img/write_form_title.gif"></div>
         <div class="clear"></div>
         <form name="board_form" action="dml_board.php?mode=<?=$mode?>" method="post" enctype="multipart/form-data">
          <input type="hidden" name="num" value="<?=$num?>">
          <input type="hidden" name="hit" value="<?=$hit?>">
          <div id="write_form">
              <div class="write_line"></div>
              <div id="write_row1">
                <div class="col1">아이디</div>
                <div class="col2"><?=$id?></div>
              </div><!--end of write_row1  -->
              <div class="write_line"></div>
              <div id="write_row2">
                <div class="col1">제&nbsp;&nbsp;목</div>
                <div class="col2"><input type="text" name="subject" value=<?=$subject?>></div>
              </div><!--end of write_row2  -->
              <div class="write_line"></div>

              <div id="write_row3">
                <div class="col1">내&nbsp;&nbsp;용</div>
                <div class="col2"><textarea name="content" rows="15" cols="79"><?=$content?></textarea>  </div>
              </div><!--end of write_row3  -->
              <div class="write_line"></div>
              <div id="write_row4">
                <div class="col1">첨부파일</div>
                <div class="col2">
                  <?php
                    if($mode=="insert"){
                      echo '<input type="file" name="upfile" >';
                    }else{
                  ?>
                    <input type="file" name="upfile" onclick='document.getElementById("del_file").checked=true; document.getElementById("del_file").disabled=true'>
                 <?php
                    }
                  ?>
                  <?php
                    if($mode=="update" && !empty($file_name_0)){
                      echo "$file_name_0 파일등록";
                      echo '<input type="checkbox" id="del_file" name="del_file" value="1">삭제';
                      echo '<div class="clear"></div>';
                    }
                  ?>
                </div><!--end of col2  -->
              </div><!--end of write_row4  -->
              <div class="clear"></div>

              <div class="write_line"></div>
              <div class="clear"></div>
            </div><!--end of write_form  -->

            <div id="write_button">
              <input type="image" onclick='document.getElementById("del_file").disabled=false' src="../img/ok.png">&nbsp;
              <a href="./list.php"><img src="../img/list.png"></a>
            </div><!--end of write_button-->
         </form>

      </div><!--end of col2  -->
      </div><!--end of content -->
    </div><!--end of wrap  -->
  </body>
</html>
