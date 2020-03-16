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
          <form name="member_form" action="login.php" method="post">
              <div id="title">
                <img src="../img/title_login.gif">
              </div><!--end of title  -->
              <div id="login_form">
                <img id="login_msg" src="../img/login_msg.gif">
                <div class="clear"></div>
                <div id="login1">
                  <img src="../img/login_key.gif" alt="">
                </div>
                <div id="login2">
                  <div id="id_input_button">
                    <div id="id_pw_title">
                      <ul>
                        <li> <img src="../img/id_title.gif" alt=""> </li>
                        <li> <img src="../img/pw_title.gif" alt=""> </li>
                      </ul>
                    </div><!--end of id_pw_title  -->
                    <div id="id_pw_input">
                      <ul>
                        <li> <input type="text" name="id" class="login_input">  </li>
                        <li> <input type="password" name="pass" class="login_input">  </li>
                      </ul>
                    </div><!--end of id_pw_input  -->
                    <div id="login_button">
                      <input type="image" src="../img/login_button.gif" >
                    </div><!--end of login_button  -->
                  </div><!--end of id_input_button  -->
                  <div class="clear"></div>
                  <div class="login_line"></div>
                  <div id="join_button">
                    <img src="../img/no_join.gif" >&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="../member/member_form.php"> <img src="../img/join_button.gif" alt=""> </a>
                  </div><!--end of join_button  -->
                </div><!--end of login2  -->
              </div><!--end of login_form  -->
          </form>
        </div><!--end of col2  -->
       </div><!--end of content -->
     </div><!--end of wrap  -->
   </body>
 </html>
