<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php
    define("ID","kpg");
    echo ID."님 환영합니다";
    $id = $_POST["id"];
    $password = $_POST["password"];
     ?>

     <ul>
       <li>아 &nbsp;이 &nbsp;디 : <?= $id?></li>
        <li>비밀번호 : <?php
          echo "{$password}";
         ?></li>
     </ul>


  </body>
</html>
