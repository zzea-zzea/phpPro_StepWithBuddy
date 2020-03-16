<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
    <script src="/cobrain/page/board_modify.js" charset="utf-8"></script>
    <link rel="stylesheet" href="/cobrain/css/board_modify.css">
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

        if(isset($_SESSION["userid"])){
            $userid = $_SESSION["userid"];
        }else{
            $userid = "";
        }
        if(isset($_SESSION["username"])){
            $username = $_SESSION["username"];
        }else{
            $username = "";
        }
    
        $num   = $_GET["num"];
        $page   = $_GET["page"];
        $id   = $_GET["id"];
        $board   = $_GET["board"];
        $prop   = $_GET["prop"];

        if($board=="community")
            $board_kor = "커뮤니티";
        else if($board =="qna")
            $board_kor = "묻고답하기";
    
        if($userid!=$id){
            echo("
                    <script>
                    alert('게시글 수정은 글쓴이만 할 수 있습니다.');
                    history.go(-1)
                    </script>
            ");
           exit;
        }

        $con = mysqli_connect("localhost", "root", "123456", "cobrain");
        $sql = "select * from {$board}board where num=$num";
        $result = mysqli_query($con, $sql);

        $row = mysqli_fetch_array($result);
        $subject    = $row["subject"];
        $content    = $row["content"];		
        $file_name  = $row["file_name"];
        
    ?>
    <center>
    <div class="board_write">
        <form id="board_modify_form" action="./board_update.php" method="post" enctype="multipart/form-data">
            <h3>수정하기</h3>
                <div class="board_write_item">
                    <label for="board_write_writer">작성자</label>
                    <input type="text" id="board_write_writer" class="board_write_input" name="board_write_writer" value="<?=$username?>(<?=$userid?>)" disabled>
                </div>
                <div class="board_write_item">
                    <label for="select_board">게시판</label>
                    <select id="select_board" name="select_board" value="<?=$board_kor?>">
                        <option value="<?=$board_kor?>"><?=$board_kor?></option>
                    </select>
                    <select id="select_board_prop" name="select_board_prop" value="<?=$prop?>">
                         <option value="<?=$prop?>"><?=$prop?></option>
                    </select>
                </div>
                <div class="board_write_item">
                    <label for="board_write_subject">제목</label>
                    <input type="text" class="board_write_input" id="board_write_subject" name="board_write_subject" value="<?=$subject?>">
                </div>
                <div class="board_write_item">
                    <?php
                        if($file_name){
                            echo '<label for="file">파일변경</label>
                                    <input type="file" name="upfile"> <span id="now_file">기존파일: '.$file_name.'</span>';
                        }else{
                            echo '<label for="file">첨부파일</label>
                                    <input type="file" name="upfile">';
                        }
                    ?>
                </div>
                <textarea name="board_write_content" id="board_write_content" cols="30" rows="10"><?=$content?></textarea>
                <div class="msg_form_btns">
                <input type="button" id="btnBoardWriteCancle" value="취소하기" onclick="history.go(-1);">
                <input type="button" id="btnBoardWriteSubmit" value="수정하기" onclick="submitBoardForm()">
              </div>
              <input type="hidden" name="page" value="<?=$page?>">
              <input type="hidden" name="num" value="<?=$num?>">
              <input type="hidden" name="board" value="<?=$board?>">
              <span id="get_board" style="display: none"><?=$board?></span><span id="get_prop" style="display: none"><?=$prop?></span>
          </form>
    </div>
    </center>
</body>
</html>