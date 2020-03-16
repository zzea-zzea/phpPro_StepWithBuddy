<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
    <link rel="stylesheet" href="./login.css" >
  <script src ="./login.js"></script>
  </head>
  <body>
    <?php
        $id = $_POST{"id"};
        $pass = $_POST{"pass"};
        $passcheck = $_POST{"passcheck"};
        $name = $_POST{"name"};
        $fristemail = $_POST{"fristemail"};
        $secondemail = $_POST{"secondemail"};
     ?>
     <div id="header">
       <div id="header-div">
         <h2><img src="air.png">로그인</h2>
       </div>
       <div class="center">
         <ul>
           <li>아 &nbsp 이&nbsp 디 : <?= $id?> </li>
           <li>비밀번호 : <?= $pass?> </li>
           <li>비밀번호 확인 : <?= $passcheck?> </li>
           <li>이름 : <?= $name?> </li>
           <li>이메일아이디 : <?= $fristemail?> </li>
           <li>이메일주소 : <?= $secondemail?> </li>
         </ul>
       </div>

     </div>

  </body>
</html>
