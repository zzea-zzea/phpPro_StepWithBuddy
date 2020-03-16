<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
  <script src="/cobrain/page/mypage.js" charset="utf-8"></script>
  <link rel="stylesheet" href="/cobrain/css/mypage.css">
  <link rel="stylesheet" href="/cobrain/css/index.css">
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="/cobrain/image/favicon.ico"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
  <link rel="shortcut icon" href="/cobrain/image/favicon.ico"/>
  <body>
    <header>
      <?php include "./header.php"; ?>
    </header>
    <main>
      <?php
         	$con = mysqli_connect("localhost", "root", "123456", "cobrain");
          $sql    = "select * from members where id='$userid'";
          $result = mysqli_query($con, $sql);
          $row    = mysqli_fetch_array($result);

          $pw = $row["pw"];
          $name = $row["name"];
          $email = $row["email"];

          mysqli_close($con);
      ?>
      <center>
        <h2>회원정보 수정</h2>
        <div id="main">
          <form id="form_mypage_edit" action="./mypage_edit.php?id=<?=$userid?>" method="post">
            <div class="formBox">
              <label for="inputId">아이디&nbsp;&nbsp;&nbsp;</label>
              <input type="text" class="formInput" id="inputId" name="inputId" value="<?=$userid?>" disabled>
            </div>
            <div class="formBox">
              <label for="inputPw1">비밀번호</label>
              <input type="text" class="formInput" id="inputPw1" name="inputPw1" placeholder="비밀번호를 입력해주세요" required>
            </div>
            <div class="formBox">
              <label for="inputPw2">비밀번호 확인</label>
              <input type="text" class="formInput" id="inputPw2" name="inputPw2" placeholder="비밀번호를 확인해주세요" required>
              <p class="subMsg" id="pwSubMsg"></p>
            </div>
            <div class="formBox">
              <label for="inputName">이름</label>
              <input type="text" class="formInput" id="inputName" name="inputName" value="<?=$name?>" required>
              <p class="subMsg" id="nameSubMsg"></p>
            </div>
            <div class="formBox">
              <label for="inputEmail">이메일</label>
              <input type="text" class="formInput" id="inputEmail" name="inputEmail" value="<?=$email?>" required>
              <p class="subMsg" id="emailSubMsg"></p>
            </div>
            <input type="button" id="btnFormSubmit1" value="정보수정" onclick="popupValidatePw()" disabled>
          </form>
        </div>
        <div id="overlay"></div>
        <div id="popupLayer">
          <h3>보안을 위해 기존 비밀번호를 입력해주세요</h3>
          <div class="formBox">
            <label for="inputPw1">비밀번호</label>
            <input type="text" class="formInput" id="inputPw3" name="inputPw3" placeholder="비밀번호를 입력해주세요" required>
            <p class="subMsg" id="pwValSubMsg"></p>
          </div>
            <input type="button" id="btnFormClose" value="취소하기" onclick="closePopupLayer()">
            <input type="button" id="btnFormSubmit2" value="제출하기" onclick="submitMyEditForm('<?=$pw?>')">
        </div>
      </center>
    </main>
  </body>
</html>
