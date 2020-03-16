
    <?php
      $table = $_GET["table"];

      if($table == "free"){
        $board_title ="자유게시판";
      }else{
        $board_title="공지사항";
      }

     ?>
     <h1><?=$board_title?></h1>
