<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> PHP-DOG</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" href="./css/login.css" >
    <script src ="./js/login.js"></script>
  </head>
  <body>
    <header>
        <?php include "header.php";?>
      </header>
      <section>
        <form name="login_form" action="login.php" method="post">
          <div id="header">
            <h2><img src="./img/heart.gif" style="width : 300px; height : 130px;"><p id = "p_text">LOGIN</p></h2>
              <div id="idpw-div">
                <input name ="id" id="inputId" type="text" size="55" style="height : 30px" placeholder="아이디"><p id ="checkId"></p><br>
                <input name="pass" id="inputPassword" type="text" size="55" style="height : 30px" placeholder="비밀번호"><br><p id ="checkPass"></p><br>
              </div><br>
                <button id="loginbtn" type="button" name="button" onclick="check_input()">LOGIN</button> <br>
          </div>
        </form>

      </section>
      <footer>
          <?php include "footer.php";?>
        </footer>
  </body>
</html>
