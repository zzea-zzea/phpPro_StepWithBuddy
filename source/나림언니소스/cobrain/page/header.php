<?php
  session_start();

  if(isset($_SESSION["userid"])){
    $userid = $_SESSION["userid"];
  }else{
    $userid = "";
  }
  if(isset($_SESSION["username"])){
    $username = $_SESSION["username"];
  }else{
    $usesrname = "";
  }
  if (isset($_SESSION["userpoint"])){
    $userpoint = $_SESSION["userpoint"];
  }
  else {
    $userpoint = "";
  }
  if (isset($_SESSION["userlevel"])){
    $userlevel = $_SESSION["userlevel"];
  }
  else {
    $userlevel = "";
  }
 ?>
  <div id="top">
    <a href="/cobrain/index.php">
      <div id="top_logo">
        <img src="/cobrain/image/cobrain_logo_mark.png" height="40">
        <img src="/cobrain/image/cobrain_logo_title.png" height="40">
      </div>
    </a>

    <ul id="top_menu">
      <?php
       if($userid==""){
       ?>
         <li><a href="/cobrain/page/member_form.php">회원가입</a><span> | </span></li>
         <li><a href="/cobrain/page/login_form.php">로그인</a></li>
     <?php
        }else{
          $user_LvPt = "[ Level: ".$userlevel." | Point: ".$userpoint." ]";
      ?>
        <li><a href="/cobrain/page/mypage.php"><?=$username?>(<span id="userInfo"><?=$userid?></span>)님</a></li>
        <li><a href="/cobrain/page/message_box.php"><span class="far fa-envelope"></span></a></li>
        <li><span id="user_LvPt"><?=$user_LvPt?></span> <span> | </span></li>
        <li><a href="/cobrain/page/logout.php">로그아웃</a></li>
     
      <?php
        }
       ?>
    </ul>
  </div>



  <div id="menuBar">
    <center>
      <ul>
        <li><a href="/cobrain/index.php">HOME</a><span> | </span></li>
        <li><a href="/cobrain/page/board_list.php?board=커뮤니티">커뮤니티</a><span> | </span></li>
        <li><a href="/cobrain/page/board_list.php?board=묻고답하기">묻고답하기</a><span> | </span></li>
        <li><a href="/cobrain/page/message_box.php">쪽지보내기</a></li>
        <li id="searchMini"><a herf="#"><div>검색창 띄우기</div></a></li>
        <fieldset id="searchBarBox">
          <input id="searchBarInput" type="text">
          <button id="btnTopSearch" type="button" name="button"></button>
        </fieldset>
      </ul>
    </center>
  </div>
