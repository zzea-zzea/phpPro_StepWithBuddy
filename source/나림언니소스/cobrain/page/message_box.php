<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
  <script src="/cobrain/page/message_box.js" charset="utf-8"></script>
  <link rel="stylesheet" href="/cobrain/css/message_box.css">
  <link rel="stylesheet" href="/cobrain/css/index.css">
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="/cobrain/image/favicon.ico"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
  <body>
    <header>
      <?php include "./header.php"; ?>
    </header>
    <main>
      <center>
        <div class="message_box_contain">
          <div class="message_box_tab_group">
            <div class="message_box_tab_rcv">
              받은 쪽지함
            </div>
            <div class="message_box_tab_send">
              보낸 쪽지함
            </div>
          </div>
          <div class="message_box_content">
            <div class="message_board">
              <ul class="message_borad_header">
                <li><span class = "col1 board_header">번호</span></li>
                <li><span class = "col2 board_header">제목</span></li>
                <li><span class = "col3 board_header" id="sendOrRcvUser"></span></li>
                <li><span class = "col4 board_header">등록일</span></li>
              </ul>
            </div>
            <div class="message_board_list">
              <ul class="message_board_list_ul">
              </ul>
            </div>
            <div class="message_box_paging">
            </div>
          </div>
        </div>
        <div id="overlay"></div>
        <div id="popupLayer">
          <form id="msg_form" action="./message_insert.php" method="post">
            <h3>쪽지 보내기</h3>
            <div class="msg_form_div">
              <label for="send_id">보내는 사람</label>
              <input type="text" class="formInput" id="send_id" name="send_id" value="<?=$userid?>" disabled>
              <p class="subMsg" id="pwValSubMsg"></p>
            </div>
            <div class="msg_form_div">
              <label for="rcv_id">받는 사람</label>
              <input type="text" class="formInput" id="rcv_id" name="rcv_id" disabled>
              <input type="button" class="btn_search" name="rcv_id_search" value="검색" onclick="findRcvId()">
            </div>
            <div class="msg_form_div">
              <label for="subject">제목</label>
              <input type="text" class="formInput" id="subject" name="subject">
            </div>
            <div class="msg_form_div content">
              <label for="content">내용</label>
              <textarea class="formInput" id="content" name="content"></textarea>
            </div>
              <div class="msg_form_btns">
                <input type="button" id="btnFormClose" value="취소하기" onclick="closePopupLayer()">
                <input type="button" id="btnFormSubmit" value="보내기" >
              </div>
          </form>
        </div>
        <div id="search_id_popup">
          <div>아이디(이름)을 검색합니다</div>
          <input type="text" class="formInput searchId" id="inputSearchId" name="inputSearchId">
          <input type="button" class="btn_search" value="검색" onclick="searchIDonServ()">
          <span id="id_result"></span>
          <button type="button" id="btn_close" name="button" onclick="closeIdSearchPopupLayer()">닫기</button>
        </div>
      </center>
    </main>
  </body>
</html>
