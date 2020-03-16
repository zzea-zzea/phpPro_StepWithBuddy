<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/ansisung/lib/db_connector.php";
include $_SERVER['DOCUMENT_ROOT']."/ansisung/lib/func.php";
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/common.css">
    <title></title>
  </head>
  <body>
  <div id="wrap">
    <div id="header">
        <?php include "./lib/top_login1.php"; ?>
    </div><!--end of header  -->
    <div id="menu">
      <?php include "./lib/top_menu1.php"; ?>
    </div><!--end of menu  -->

    <div id="content">
      <div id="main_img">
        <img src="./img/main_img.jpg">
      </div>
      <div id="latest">
        <div id="latest1">
          <div id="title_latest1"><img src="./img/title_latest1.gif"></div>
            <div class="latest_box">
          <?php latest_article("greet_board", 10, 30); ?>
          </div>
        </div>
        <div id="latest2">
          <div id="title_latest2"><img src="./img/title_latest2.gif"></div>
            <div class="latest_box">
          <?php latest_article("free", 10, 30); ?>
          </div>
        </div>
      </div>
    </div><!--end of content -->
  </div><!--end of wrap  -->
  <?php mysqli_close($conn); ?>
  </body>
</html>
