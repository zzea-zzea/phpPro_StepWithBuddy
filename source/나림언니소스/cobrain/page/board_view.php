<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
  <script src="/cobrain/page/board_view.js" charset="utf-8"></script>
  <link rel="stylesheet" href="/cobrain/css/board_view.css">
  <link rel="stylesheet" href="/cobrain/css/index.css">
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="/cobrain/image/favicon.ico"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
  <!-- identicon -->
  <script src="//cdn.rawgit.com/placemarker/jQuery-MD5/master/jquery.md5.js"></script>
  <script src="//rawgit.com/stewartlord/identicon.js/master/pnglib.js"></script>
  <script src="//rawgit.com/stewartlord/identicon.js/master/identicon.js"></script>
</head>
<body>
  <header>
    <?php include "./header.php"; ?>
  </header>
  <?php
    $userid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
    $username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";

    $board = isset($_GET["board"]) ? $_GET["board"] : "";
    $prop = isset($_GET["prop"]) ? $_GET["prop"] : "";
    $page = isset($_GET["page"]) ? $_GET["page"] : "";
    $num = isset($_GET["num"]) ? $_GET["num"] : "";
    
    //db연결
    $con = mysqli_connect("localhost", "root", "123456", "cobrain");
    
    //게시판에 따라 sql 쿼리문 작성
    if($board=="커뮤니티")
      $sql = "select * from communityboard where num=$num";
    else if($board=="묻고답하기")
      $sql = "select * from qnaboard where num=$num";
    else
      echo "<script>alert('존재하지 않는 게시판입니다.'); history.go(-1);</script>";

    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_array($result);

    $id      = $row["id"];
    $name      = $row["name"];
    $regist_day = $row["regist_day"];
    $subject    = $row["subject"];
    $content    = $row["content"];
    $hit          = $row["hit"];
    $rcm          = $row["rcm"];
    $comment          = $row["comment"];
    $file_name    = $row["file_name"];
    $file_type    = $row["file_type"];
    $file_copied  = $row["file_copied"];

    if($board=="커뮤니티")
      $part = $row["part"];
    else if($board=="묻고답하기")
      $lang = $row["lang"];

    $content = str_replace(" ", "&nbsp;", $content);
    $content = str_replace("\n", "<br>", $content);
    
    if($file_name) {
      $real_name = $file_copied;
      $file_path = "../data/".$real_name;
      $file_size = filesize($file_path);
    }
      
    //조회수 증가
    $new_hit = $hit + 1;
    if($board=="커뮤니티")
      $sql = "update communityboard set hit=$new_hit where num=$num";   
    else if($board=="묻고답하기")
      $sql = "update qnaboard set hit=$new_hit where num=$num";       
    
    mysqli_query($con, $sql);

  ?>
  <center>
    <div class="board_view_wrap">
      <div class="board_view_top">
        <span class="board_view_boardname"><i class="fas fa-paste"></i><?=$board?></span>
      </div>
      <div class="board_view_writer">
        <img class="identicon" data-user="<?=$id?>"></img>
        <div class="board_view_writer_leftside">
          <span class="writer_name"><?=$name?>(<?=$id ?>)</span></br>
          <span class="writer_rday"><?=$regist_day?></span>
        </div>
        <div class="board_view_writer_rightside">
          <span class="writer_rcm"><i class="far fa-thumbs-up">&nbsp;</i><?=$rcm?></span>
          <span class="writer_comment"><i class="far fa-comment-dots">&nbsp;</i><?=$comment?></span>
          <span class="writer_hit"><i class="far fa-eye">&nbsp;</i><?=$hit?></span>
        </div>
      </div>
      <div class="board_view_title">
        <span class="writer_title"><?=$subject?></span>
      </div>
      <div class="board_view_content">
        <span class="writer_content"><?=$content?></span><br>
        <span class="writer_file">
          <?php
            if($file_name){
              echo "첨부파일 : {$file_name} ({$file_size} Byte)<a href='board_download.php?num={$num}&real_name={$real_name}&file_name={$file_name}&file_type={$file_type}'>&nbsp;&nbsp;<i class='fas fa-file-download'></i></a>";
            }

            if($userid==$id){
              echo '<button id="btn_delete_post" onclick="deletePost()">삭제하기</button>';
              echo '<button id="btn_modify_post" onclick="modifyPost()">수정하기</button></span>';
            }
          ?>
      </div>
    </div>

    <?php
      if($board=="커뮤니티")
        $sql = "select * from comment where board = 'community' and board_num='$num'";
      else if($board=="묻고답하기")
        $sql = "select * from comment where board = 'qna' and board_num='$num'";

      $result = mysqli_query($con, $sql);
      $cmt_count = mysqli_num_rows($result); 
    
    ?>
    
    <div class="board_comment_wrap">
      <div class="comment_count">
        <i class="far fa-comment-dots">&nbsp;</i>댓글 : <?=$cmt_count?>개
      </div>
      <?php
        for($i = 0; $i<$cmt_count ; $i++){
          
          mysqli_data_seek($result, $i);
          $cmt_row = mysqli_fetch_array($result);
  
          $cmt_num      = $cmt_row["num"];
          $cmt_id      = $cmt_row["id"];
          $cmt_name      = $cmt_row["name"];
          $cmt_regist_day = $cmt_row["regist_day"];
          $cmt_content    = $cmt_row["content"];
          $cmt_rcm          = $cmt_row["rcm"];
      
          $cmt_content = str_replace(" ", "&nbsp;", $cmt_content);
          $cmt_content = str_replace("\n", "<br>",$cmt_content);

          echo '<div class="comment_box">
                  <img class="identicon comment" data-user="'.$cmt_id.'"></img>
                  <div class="comment_writer">
                    <span class="comment_name">'.$cmt_name.'('.$cmt_id.')</span></br>
                    <span class="comment_rday">'.$cmt_regist_day.'</span>
                  </div>
                  <div class="comment_content">
                    '.$cmt_content.'
                  </div>
                  <div class ="comment_rcm">
                    <span id="btn_comment_rcm"><i class="far fa-thumbs-up">&nbsp;'.$cmt_rcm.'</i></span>
                    <span id="btn_comment_reply"><i class="far fa-comment-dots"></i></span>
                  </div>
                </div>';
        }
        //댓글쓰기(로그인한사람만)

        if($board=="커뮤니티")
          $board = "community";
        else if($board=="묻고답하기")
          $board = "qna";

        if(!$userid){
          echo '<div class="comment_write_box">
                  <span id="comment_warning">로그인 후 이용하실 수 있습니다</span>
                </div>';
        }else{
          echo '<form id="comment_form" action="./comment_insert.php" method="post">
                  <div class="comment_write_box on">
                    <img class="identicon comment" data-user="'.$userid.'"></img>
                    <div class="comment_writer">
                      <span class="comment_name" id="newcmt_nameid">'.$username.'('.$userid.')</span>
                    </div>
                    <div class="comment_content">
                      <textarea name="newcmt_content" id="newcmt_id" cols="30" rows="10"></textarea>
                    </div>
                    <span id="submit_newcmt" onclick="submitComment()"><i class="fas fa-check"></i></span>
                  </div>
                  <input type="hidden" name="userid" id="userid" value="'.$userid.'">
                  <input type="hidden" name="id" id="id" value="'.$id.'">
                  <input type="hidden" name="username" id="username" value="'.$username.'">
                  <input type="hidden" name="board" id="board" value="'.$board.'">
                  <input type="hidden" name="num" id="num" value="'.$num.'">
                  <input type="hidden" id="page" value="'.$page.'">
                  <input type="hidden" id="prop" value="'.$prop.'">
                </form>';

        }
        mysqli_close($con); 
      ?>
    </div>
  </center>
</body>
</html>