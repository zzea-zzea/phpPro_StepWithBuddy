
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" type="text/css" href="../../css/board/board.css">

    <!-- Bootstrap core CSS -->
    <link href="../../css/main/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="../../css/main/small-business.css" rel="stylesheet">
<style>
  form { display: inline-block; }

  #header_box { width: 1100px; margin: 0 auto; }

  #header_box div { display: inline-block; }

  header { position: fixed; top: 0; width: 100%; background-color: antiquewhite; }

  #icon_box { margin-left: 190px; }

  #search { width: 700px; height: 50px; font-size: 20px; }

  header span { display: inline-block; width: 45px; height: 45px; }

  #login_icon { background-image: url(""); }

  #info_icon { background-image: url(""); }

  #btn_search { height: 45px; width: 45px; background-image: url("../../img/main/search1.png"); border: none; background-color: none; outline: none; }

  header a { width: 45px; height: 52px; padding: 0; margin: 0; display: inline-block; vertical-align: middle; }

  img{vertical-align:unset;}

  #btn_home { background-image: url("../../img/main/home1.png"); }

  #btn_info { background-image: url("../../img/main/info1.png"); }

  #btn_login { background-image: url("../../img/main/key1.jpg"); }

  .no-flex { flex: none; }

  .col-lg-7 { width: 450px; }

  #menu_bar { height: 48px; background-color: #443e58; font-size: 16px; }

  #menu_bar ul { width: 1200px; margin: 0 auto; padding: 14px 0 0 40px; }

  #menu_bar li { display: inline; margin-left: 10.5%; color: white; }

  #pop_up { display: none; position: absolute; top: 54px; right: 128px; background-color: antiquewhite; }
  #pop_log { display: none; position: absolute; top: 54px; right: 128px; background-color: antiquewhite; }
  #pop_box { width: 350px; height: 250px; }

  #pop_box ul { width: 50%; float: left; list-style: none; padding-left: 5px; }

  #pop_box li { text-align: center; }
  #pop_login ul{ width: 100%; list-style: none; padding-left: 5px; }
  #pop_login{ width: 150px; }
  .reply { margin-left: 213px; }
  body{ padding-top: 67px; }



</style>

<script src="../../js/main/pop_up_menu.js"></script>

  <script>
    function resize(obj) {
      obj.style.height = "1px";
      obj.style.height = (1 + obj.scrollHeight) + "px";
    }
  </script>
</head>

<body>
  <?php include "../../lib/common_page/header.php" ?>
  <!-- header -->
  <div class="board_header">
    <div id="board_header_div">
      <p><a href="board_form.html">BOARD</a></p>
    </div>
  </div>
  <!-- nav -->
  <div class="board_nav">
    <div id="board_nav_box">
      <div id="board_box_message">
        <p><span>"__"</span> 개의 게시물이 있습니다 !</p>
      </div>
      <div id="board_box_writing">
        <p><a href="board_writing.html">+ 글쓰기</a></p>
      </div>
      <div id="board_box_mypost">
        <p><a href="board_myboard_form.html">내 게시글 보기</a></p>
      </div>
      <div id="board_box_viewall">
        <p><a href="board_form.html">전체보기</a></p>
      </div>
    </div>
  </div>
  <!-- center -->
  <div class="board_myboard_widen">
    <div id="board_myboard_widen_box">
      <div id="board_myboard_widen_photo">
        <img src="../../img/board/default.jpg">
      </div>
      <div id="board_myboard_widen_top">
        <span id="board_myboard_widen_top_p_span">TITLE :</span> <span id="myboard_widen_title_span">제목이 옵니다</span><br>
         <span id="board_myboard_widen_top_p_span">MEMBER_ID :</span> <span id="myboard_widen_memberId_span">작성자 명이 옵니다</span><br>
         <span id="board_myboard_widen_top_p_span">DATE :</span> <span id="myboard_widen_date_span">날짜가 옵니다</span><br>
      </div>
      <div id="board_myboard_widen_center">
        <p><span id="myboard_widen_content_span">내용이 옵니다</span></p>
      </div>
    </div>
    <div id="board_myboard_widen_button_box">
      <button type="button"><a href="board_myboard_rewrite.html">Edit</a></button>
    </div>
    <div id="board_widen_comment_box">
      <div id="board_widen_comment_input_box">
        <div id="board_widen_comment_input_span">
          <p>댓글 <span>1000</span>개</p>
        </div>
        <div id="board_widen_comment_input_text">
          <img id="board_widen_comment_input_text_image" src="../../img/board/default_proflie.png">
          <textarea id="input_comment_area" rows="1" onkeydown="resize(this)" onkeyup="resize(this)" placeholder="Comment"></textarea>
          <input type="button" value="Add">
        </div>
      </div>
      <div id="board_widen_comment_show_text">
          <img src="../../img/board/default_proflie.png">
        <div id="board_widen_comment_show_text_member">
          <span>작성자명</span><br>
          <span>댓글 내용이 옵니다</span><br>
          <span>날짜</span>&nbsp;&nbsp;<span>▼ 답글</span>
        </div>
      </div>
      <div id="board_widen_comment_viewmore_click">
        <img src="../../img/board/default_proflie.png">
        <div id="board_widen_comment_show_text_member">
          <span>작성자명</span><br>
          <span>댓글 내용이 옵니다</span><br>
          <span>날짜</span>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <?php include "../../lib/common_page/footer.php" ?>
  </footer>

</body>

</html>
