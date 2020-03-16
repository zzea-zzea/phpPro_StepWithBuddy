<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
    <script src="/cobrain/page/board_list.js" charset="utf-8"></script>
    <link rel="stylesheet" href="/cobrain/css/board_list.css">
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
        $board = isset($_GET["board"]) ? $_GET["board"] : "";
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;

        $scale = 10; // 가져올 글 수
        $page_scale = 5; // 하단 쪽수 표시 량
        $prop="";
    ?>
    <center>
    <div class="board_list_content">
        <div class="board_list_top">
          <ul class="board_top_ul">
          </ul>
        </div>
        <div class="board_list_middle">
          <ul class="board_list_ul">
            <?php
              $con = mysqli_connect("localhost", "root", "123456", "cobrain");
              
              //게시판에 따라 sql 쿼리문 작성
              if($board=="커뮤니티")
                $sql = "select * from communityboard order by num desc";
              else if($board=="묻고답하기")
                $sql = "select * from qnaboard order by num desc";
              else
                echo "<script>alert('존재하지 않는 게시판입니다.'); history.go(-1);</script>";
              
              $result = mysqli_query($con, $sql);
              
              // 전체 글 수
              $total_record = mysqli_num_rows($result); 

              // 전체 페이지 수($total_page) 계산
              if ($total_record % $scale == 0)
                $total_page = floor($total_record/$scale);
              else
                $total_page = floor($total_record/$scale)+1;

              // 표시할 페이지($page)에 따라 $truncated_num(한페이지에서 10개 리스트 보여지고 그 뒤 짤리는 넘버) 계산
              $truncated_num = ($page - 1) * $scale;
              $start_num = $total_record - $truncated_num;

              //게시판 맨 상단 번호
              $number = $total_record - $truncated_num;

              for ($i=$truncated_num; $i < $truncated_num+$scale && $i < $total_record; $i++){
                // 가져올 레코드로 위치(포인터) 이동
                mysqli_data_seek($result, $i);
                $row = mysqli_fetch_array($result);
                $num = $row["num"];
                $id = $row["id"];
                $name = $row["name"];
                $subject = $row["subject"];
                $regist_day = $row["regist_day"];
                $hit = $row["hit"];
                $comment = $row["comment"];
                $rcm = $row["rcm"];

                if($board=="묻고답하기"){
                  $lang = $row["lang"];
                  $prop = $lang;
                }else if($board=="커뮤니티"){
                  $part = $row["part"];
                  $prop = $part;
                }
          
            
                $file_type = $row["file_type"];
                
                if($file_type){
                  if(strstr($file_type, "image")){
                    $file_icon = '<i class="far fa-file-image"></i>';
                  }else if(strstr($file_type, "text")){
                    $file_icon = '<i class="far fa-file-alt"></i>';
                  }else if(strstr($file_type, "vedio")){
                    $file_icon = '<i class="far fa-file-video"></i>';
                  }else if(strstr($file_type, "audio")){
                    $file_icon = '<i class="far fa-file-audio"></i>';
                  }else{
                    $file_icon = '<i class="far fa-save"></i>';
                  }

                }else{
      	          $file_icon = "";
                }

                if($board=="커뮤니티"){
                  $html = '<li>
                              <span class="col1">'.$number.'</span>
                              <span class="col8">'.$part.'</span>
                              <span class="col2"><a href="board_view.php?board='.$board.'&page='.$page.'&prop='.$prop.'&num='.$num.'">'.$subject.'</a></span>
                              <span class="col9">'.$file_icon.'</span>
                              <span class="col3">'.$comment.'</span>
                              <span class="col4">'.$rcm.'</span>
                              <span class="col5">'.$hit.'</span>
                              <span class="col6">'.$name.'</span>
                              <span class="col7">'.$regist_day.'</span>
                            </li>';

                }else if($board=="묻고답하기"){
                  $html = '<li>
                              <span class="col1">'.$number.'</span>
                              <span class="col8">'.$lang.'</span>
                              <span class="col2"><a href="board_view.php?board='.$board.'&page='.$page.'&prop='.$prop.'&num='.$num.'">'.$subject.'</a></span>
                              <span class="col9">'.$file_icon.'</span>
                              <span class="col3">'.$comment.'</span>
                              <span class="col4">'.$rcm.'</span>
                              <span class="col5">'.$hit.'</span>
                              <span class="col6">'.$name.'</span>
                              <span class="col7">'.$regist_day.'</span>
                            </li>';
                }else{
                  $html ="게시판을 불러오지 못했습니다.";
                }
                $number--;
                echo $html;
              }

              mysqli_close($con);
            ?>
          </ul>
        </div>
        <div class="board_list_bottom">
          <?php
            $pageGroup = ceil($page/$page_scale);    // 페이지 그룹 번호
            $last = $pageGroup * $page_scale; //쪽수매기기 마지막 번호
          
            //마지막 번호는 전체 페이지를 넘을 수 없음
            if($total_page < $page_scale){
              $last = $total_page;
            }else if($last > $total_page){
              $last = $total_page;
            }

            // 화면에 보여질 첫번째 페이지 번호
            $first = $last - ($page_scale-1);

            if($first < 1){
              $first = 1;
            }else if($last == $total_page){
              $first = $total_page - ($total_page % $page_scale)+1;
            }

            $next = $last+1;
            $prev = $first-1;
            echo "<script>console.log({$first},{$last})</script>";

            $html="";

            if($prev > 0){
              $html .= "<span id='next'><a href='board_list.php?board=".$board."&prop=".$prop."&page=".$prev."'><span class='fas fa-caret-left'></span></a></span>";
            }
          
            for($i=$first; $i <= $last; $i++){
              $html .= "<span><a id=".$i." href='board_list.php?board=".$board."&prop=".$prop."&page=".$i."'>".$i."</a></span> ";
            }
          
            if($last < $total_page){
              $html .= "<span id='next'><a href='board_list.php?board=".$board."&prop=".$prop."&page=".$next."'><span class='fas fa-caret-right'></span></a></span>";
            }
            //글쓰기 버튼 추가
            $html .= '<button id="btnWriteBoard" type="button" name="button" onclick="gotoBoardWrite()">글쓰기</button>';
            echo $html;
          ?>
        </div>
    </div>
    <span id="get_board" style="display:none"><?=$board?></span>
    <span id="get_prop" style="display:none"><?=$prop?></span>
    <span id="get_page" style="display:none"><?=$page?></span>
    </center>
</body>
</html>