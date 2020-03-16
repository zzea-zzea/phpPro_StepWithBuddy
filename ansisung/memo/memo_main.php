<?php
session_start();
include "../lib/db_connector.php";
include "../lib/create_table.php";
include "./lib/memo_func.php";

create_table($conn,'memo');//낙서장 테이블생성
create_table($conn,'memo_ripple');//낙서장리플 테이블생성

define('SCALE', 5);
$sql=$result=$total_record=$total_page=$start="";
$row="";
$memo_id=$memo_num=$memo_date=$memo_nick=$memo_content="";
$total_record=0;
$sql="select * from memo order by num desc";
$result=mysqli_query($conn,$sql);
$total_record=mysqli_num_rows($result);//총레코드수

//1.전체페이지, 2.디폴트페이지, 3.현재페이지 시작번호 4.보여줄리스트번호
//1.전체페이지
$total_page=($total_record % SCALE == 0 )?
($total_record/SCALE):(ceil($total_record/SCALE));
//2.페이지가 없으면 디폴트 페이지 1페이지
if(empty($_GET['page'])){
  $page=1;
}else{
  $page=$_GET['page'];
}

//3.현재페이지 시작번호계산함.
$start=($page -1) * SCALE;
//4. 리스트에 보여줄 번호를 최근순으로 부여함.
$number = $total_record - $start;
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/memo.css">
    <script type="text/javascript" src="../js/member_form.js"></script>
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
         <div id="title">
           <img src="../img/title_memo.gif" alt="">
         </div>
         <div id="memo_row1">
           <form name="memo_form" action="insert.php?mode=memo" method="post">
             <div id="memo_writer"><span>▷ <?=$_SESSION['usernick']?></span></div>
             <div id="memo1"> <textarea name="content" rows="6" cols="95"></textarea></div>
             <div id="memo2"> <input type="image"  src="../img/memo_button.gif" > </div>
           </form>
         </div><!--div end of memo_row1 -->
         <?php
          for ($i = $start; $i < $start+SCALE && $i<$total_record; $i++){
            mysqli_data_seek($result,$i);
            $row=mysqli_fetch_array($result);
            $memo_id=$row['id'];
            $memo_num=$row['num'];
            $memo_date=$row['regist_day'];
            $memo_nick=$row['nick'];
            $memo_content=$row['content'];
            $memo_content=str_replace("\n", "<br>",$memo_content);
            $memo_content=str_replace(" ", "&nbsp;",$memo_content);
        ?>
            <div id="memo_writer_title">
              <ul>
                <li id="writer_title1"><?=$number?></li>
                <li id="writer_title2"><?=$memo_nick?></li>
                <li id="writer_title3"><?=$memo_date?></li>
                <li id="writer_title4">
                <?php
                $message=memo_delete($memo_id,$memo_num,'insert.php',$page);
                echo $message;
                ?>
                </li>
              </ul>
            </div>
            <div id="memo_content"><?=$memo_content?></div>
            <!--주낙서장내용출력  -->
            <!--덧글내용시작  -->
            <div id="ripple">
              <div id="ripple1">덧글</div>
              <div id="ripple2">
                <?php
                  $sql="select * from memo_ripple where parent='$memo_num' ";
                  $ripple_result= mysqli_query($conn,$sql);
                  while($ripple_row=mysqli_fetch_array($ripple_result)){
                    $ripple_num=$ripple_row['num'];
                    $ripple_id=$ripple_row['id'];
                    $ripple_nick =$ripple_row['nick'];
                    $ripple_date=$ripple_row['regist_day'];
                    $ripple_content=$ripple_row['content'];
                    $ripple_content=str_replace("\n", "<br>",$ripple_content);
                    $ripple_content=str_replace(" ", "&nbsp;",$ripple_content);
                ?>
                    <div id="ripple_title">
                      <ul>
                        <li><?=$ripple_nick."&nbsp;&nbsp;".$ripple_date?></li>
                        <li id="mdi_del">
                        <?php
                        $message =memo_ripple_delete($ripple_id,$ripple_num,'insert.php',$page);
                        echo $message;
                        ?>
                        </li>
                      </ul>
                    </div>
                    <div id="ripple_content">
                      <?=$ripple_content?>
                    </div>
                <?php
                  }//end of while
                ?>

                <form name="ripple_form" action="insert.php?mode=insert_ripple" method="post">
                  <input type="hidden" name="parent" value="<?=$memo_num?>">
                  <input type="hidden" name="page" value="<?=$page?>">
                  <div id="ripple_insert">
                    <div id="ripple_textarea"><textarea name="ripple_content" rows="3" cols="80"></textarea></div>
                    <div id="ripple_button"> <input type="image"  src="../img/memo_ripple_button.png"></div>
                  </div><!--end of ripple_insert -->
                </form>
              </div><!--end of ripple2  -->
              <div class="clear"></div>
              <div calss="linespace_10"></div>

        <?php
            $number--;
         }//end of for
        ?>
        <div id="page_num">이전◀ &nbsp;&nbsp;&nbsp;&nbsp;
        <?php
          for ($i=1; $i <= $total_page ; $i++) {
            if($page==$i){
              echo "<b>&nbsp;$i&nbsp;</b>";
            }else{
              echo "<a href='./memo_main.php?page=$i'>&nbsp;$i&nbsp;</a>";
            }
          }
        ?>
        &nbsp;&nbsp;&nbsp;&nbsp;▶ 다음
        <br><br><br><br><br><br><br>
        </div>
      </div><!--end of ripple  -->
       </div><!--end of col2  -->
      </div><!--end of content -->
    </div><!--end of wrap  -->
  </body>
</html>
