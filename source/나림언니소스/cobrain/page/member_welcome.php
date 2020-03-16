<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/cobrain/css/index.css">
    <link rel="shortcut icon" href="/cobrain/image/favicon.ico"/>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <style media="screen">
      #welcomeBox{
        width: 400px;
        height: 300px;
        border: 1px solid #dddddd;
        border-radius: 10px;
        padding-top: 40px;
        padding-left: 30px;
        padding-right: 30px;
        padding-bottom: 40px;
        margin-bottom: 100px;
        margin-top: 100px;
      }

      #welcomeBox h2{
        font-size: 1.8rem;
      }

      #welcomeContent {
        font-size: 1.2rem;
      }

      #welcomeName{
        display: inline-block;
        color: #e65553;
        font-weight: bold;
        margin-bottom: 10px;
      }

      #btnWelcomeQNA{
        width: 100%;
        background-color: #e65553;
        border: 1px solid #e65553;
        font-size: 1rem;
        padding: 10px;
        border-radius: 5px;
        color: white;
        margin: 6px;
        margin-top: 20px;
        font-weight: bold;
      }

      #btnWelcomeQNA:hover{
        cursor: pointer;
      }

      #btnWelcomeCom{
        width: 100%;
        background-color: #e65553;
        border: 1px solid #e65553;
        font-size: 1rem;
        padding: 10px;
        border-radius: 5px;
        color: white;
        margin: 6px;
        font-weight: bold;
      }

      #btnWelcomeCom:hover{
        cursor: pointer;
      }
    </style>
  </head>
  <body>
    <header>
      <?php include "./header.php"; ?>
    </header>
    <main>
      <?php
        $name = $_GET["name"];
       ?>
      <center>
        <div id="welcomeBox">
          <h2>회원가입이 완료되었습니다</h2>
            <div id="welcomeContent"><span id="welcomeName"><?=$name?></span>님!<br>
              코브레인에서 새로운 지식을 공유하세요!<br>
              <button id="btnWelcomeQNA" type="button" name="button" onclick="location.href='/cobrain/page/board_list.php?board=묻고답하기'">Q&A 바로가기</button><br>
              <button id="btnWelcomeCom" type="button" name="button" onclick="location.href='/cobrain/page/board_list.php?board=커뮤니티'">커뮤니티 바로가기</button>
            </div>
        </div>
      </center>
    </main>
  </body>
</html>
