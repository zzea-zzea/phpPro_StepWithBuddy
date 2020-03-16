<?php
session_start();
//****************************
include_once "../lib/db_connector.php";
$id=$sql=$pass=$name=$nick=$hp=$hp1=$hp2=$hp3="";
$email=$email1=$email2="";
$id= $_SESSION["userid"];

$sql="select * from member where id='$id'";
$result = mysqli_query($conn,$sql);
if (!$result) {
  die('Error: ' . mysqli_error($conn));
}
$row=mysqli_fetch_array($result);
$pass=$row['pass'];
$name=$row['name'];
$nick=$row['nick'];
$hp=explode('-', $row['hp']);
$hp1=$hp[0];
$hp2=$hp[1];
$hp3=$hp[2];
$email=explode('@',$row['email']);
$email1= $email[0];
$email2= $email[1];
?>
 <!DOCTYPE html>
 <html lang="ko" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="../css/common.css">
     <link rel="stylesheet" href="../css/member.css">
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
          <form name="member_form" action="modify.php?mode=update" method="post">
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
                    <div id="id1"><input type="text" name="id" value="<?=$id?>" readonly></div>
                    <div id="id3">아이디 수정불가</div>
                  </li>
                  <li><input type="password" name="pass" value="<?=$pass?>"></li>
                  <li><input type="password" name="pass_confirm" value="<?=$pass?>"></li>
                  <li><input type="text" name="name" value="<?=$name?>"></li>
                  <li>
                    <div id="nick1"><input type="text" name="nick" value="<?=$nick?>"></div>
                    <div id="nick2"><a href="#"><img src="../img/check_id.gif" onclick="check_nick_modify();"></a></div>
                  </li>
                  <li>
                    <input type="text" class="hp" name="hp1" value="<?=$hp1?>">   -
                    <input type="text" class="hp" name="hp2" value="<?=$hp2?>"> -
                    <input type="text" class="hp" name="hp3" value="<?=$hp3?>">
                  </li>
                  <li>

                    <input type="text"  name="email1" value="<?=$email1?>">@
                    <input type="text"  name="email2" value="<?=$email2?>">
                  </li>
                </ul>
              </div><!--end of join2 -->
              <div class="clear"></div>
              <div id="must"> *는 필수항목입니다.</div>
            </div><!--end of form_join -->
            <div id="button">
              <a href="#"> <input type="button"  value="수  정" onclick="check_input()"></a>
              &nbsp;&nbsp;
              <a href="./member_form_modify.php"> <input type="button"  value="취  소"> </a>
            </div>
          </form><!--회원가입내용 -->
        </div><!--end of col2  -->
       </div><!--end of content -->
     </div><!--end of wrap  -->
   </body>
 </html>
