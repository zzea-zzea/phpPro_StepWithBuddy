<?php
session_start();
 ?>
 <!DOCTYPE html>
 <html lang="ko" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="../css/common.css">
     <link rel="stylesheet" href="../css/member.css">
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
          <form name="member_form" action="check_id.php?mode=insert" method="post">
            <div id="title">
              <img src="../img/title_join.gif" >
            </div><!--타이틀끝  -->
            <div id="form_join">
              <div id="join1">
                <ul>
                  <li>* 아이디</li>
                  <li>* 비밀번호</li>
                  <li>* 비밀번호확인</li>
                  <li>* 이름</li>
                  <li>* 닉네임</li>
                  <li>* 휴대폰</li>
                  <li>&nbsp;&nbsp;&nbsp;이메일</li>
                </ul>
              </div><!--end of join1 -->
              <div id="join2">
                <ul>
                  <li>
                    <div id="id1"><input type="text" name="id"></div>
                    <div id="id2"><a href="#"><img src="../img/check_id.gif" onclick="check_id();"></a></div>
                    <div id="id3">4~12자의 영문 소문자, 숫자와 특수기호(_)만 사용</div>
                  </li>
                  <li><input type="password" name="pass"></li>
                  <li><input type="password" name="pass_confirm"></li>
                  <li><input type="text" name="name"></li>
                  <li>
                    <div id="nick1"><input type="text" name="nick"></div>
                    <div id="nick2"><a href="#"><img src="../img/check_id.gif" onclick="check_nick();"></a></div>
                  </li>
                  <li>
                    <select class="hp" name="hp1">
                      <option value="010">010</option>
                      <option value="011">011</option>
                      <option value="016">016</option>
                      <option value="017">017</option>
                      <option value="018">018</option>
                      <option value="019">019</option>
                    </select>   -
                    <input type="text" class="hp" name="hp2"> -
                    <input type="text" class="hp" name="hp3">
                  </li>
                  <li>
                    <input type="text" id="email1" name="email1">@
                    <input type="text" id="email1" name="email2">
                  </li>
                </ul>
              </div><!--end of join2 -->
              <div class="clear"></div>
              <div id="must"> *는 필수항목입니다.</div>
            </div><!--end of form_join -->
            <div id="button">
              <a href="#"> <img src="../img/button_save.gif" onclick="check_input()"></a>
              &nbsp;&nbsp;
              <a href="#"> <img src="../img/button_reset.gif" onclick="reset_form()"> </a>
            </div>
          </form><!--회원가입내용 -->
        </div><!--end of col2  -->
       </div><!--end of content -->
     </div><!--end of wrap  -->
   </body>
 </html>
