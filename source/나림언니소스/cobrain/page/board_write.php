<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
    <script src="/cobrain/page/board_write.js" charset="utf-8"></script>
    <link rel="stylesheet" href="/cobrain/css/board_write.css">
    <link rel="stylesheet" href="/cobrain/css/index.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/cobrain/image/favicon.ico"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
</head>
<body>
    <header>
      <?php include "./header.php"; ?>
    </header>
    <?php
        $userid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
        if(!$userid){
            echo "<script>alert('로그인 후 사용 가능합니다.'); history.go(-1);</script>";
        }
        $board = isset($_GET["board"]) ? $_GET["board"] : "";
        $prop = isset($_GET["prop"]) ? $_GET["prop"] : "";
        
    ?>
    <center>
    <div class="board_write">
        <form id="board_form" action="./board_insert.php" method="post" enctype="multipart/form-data">
            <h3>새 글 쓰기</h3>
                <div class="board_write_item">
                    <label for="board_write_writer">작성자</label>
                    <input type="text" id="board_write_writer" class="board_write_input" name="board_write_writer" value="<?=$username?>(<?=$userid?>)" disabled>
                </div>
                <div class="board_write_item">
                    <label for="select_board">게시판</label>
                    <select id="select_board" name="select_board" onchange="OnChangeSelect(this)">
                        <option value="none">게시판 선택</option>
                        <option value="묻고답하기">묻고답하기</option>
                        <option value="커뮤니티">커뮤니티</option>
                    </select>
                    <select id="select_board_prop" name="select_board_prop">
                        <option value="none">게시판을 먼저 선택하세요</option>
                        <option value="java">java</option>
                        <option value="javascript">javascript</option>
                        <option value="자유">자유</option>
                    </select>
                </div>
                <div class="board_write_item">
                    <label for="board_write_subject">제목</label>
                    <input type="text" class="board_write_input" id="board_write_subject" name="board_write_subject">
                </div>
                <div class="board_write_item">
                    <label for="file">첨부파일</label>
                    <input type="file" name="upfile">
                </div>
                <textarea name="board_write_content" id="board_write_content" cols="30" rows="10"></textarea>
                <div class="msg_form_btns">
                <input type="button" id="btnBoardWriteCancle" value="취소하기" onclick="history.go(-1);">
                <input type="button" id="btnBoardWriteSubmit" value="등록하기" onclick="submitBoardForm()">
              </div>
              <span id="get_board" style="display: none"><?=$board?></span><span id="get_prop" style="display: none"><?=$prop?></span>
          </form>
    </div>
    </center>
</body>
</html>