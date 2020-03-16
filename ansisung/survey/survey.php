<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/ansisung/lib/db_connector.php";
include $_SERVER['DOCUMENT_ROOT']."/ansisung/lib/create_table.php";

if(!isset($_SESSION['userid'])){
  echo "<script>alert('권한없음!'); window.close();</script>";
  exit;
}
create_table($conn,'survey');//가입인사게시판테이블생성
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/survey.css">
    <script type="text/javascript" src="../js/survey_form.js"></script>
    <title>설문조사</title>
  </head>
  <body>
    <form name=survey_form method=post >
    <table border=0 cellspacing=0 cellpdding=0 width='200' align='center'>
      <input type=hidden name=percent value=100>
       <tr height=40>
          <td><img src="../img/bbs_poll.gif"></td>
       </tr>
       <tr height=1 bgcolor=#cccccc><td></td></tr>
       <tr height=7><td></td></tr>
       <tr><td><b> ♬ 가장 좋아하는 기타 작곡가는?</b></td></tr>
       <tr><td><input type=radio name='composer' value='ans1' >1. 타레가</td></tr>
       <tr height=5><td></td></tr>
       <tr><td><input type=radio name='composer' value='ans2' >2. 빌라로보스</td></tr>
       <tr height=5><td></td></tr>
       <tr><td><input type=radio name='composer' value='ans3' >3. 끌레양</td></tr>
       <tr height=5><td></td></tr>
       <tr><td><input type=radio name='composer' value='ans4' >4. 소르</td></tr>
       <tr height=7><td></td></tr>
       <tr height=1 bgcolor=#cccccc><td></td></tr>
       <tr>
       <tr height=7><td></td></tr>
       <tr>
         <td align=middle><img src="../img/b_vote.gif" border="0"  style='cursor:hand'
            onclick=update()></a>
           <img src="../img/b_result.gif" border="0"  style='cursor:hand'
               onclick=result()></a></td></tr>
    </table>
  </form>
  </body>
</html>
