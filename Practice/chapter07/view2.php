<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
        $id = $_POST{"id"};
        $pass = $_POST{"pass"};
     ?>
     <ul>
       <li>아 &nbsp 이&nbsp 디 : <?= $id?> </li>
       <li>비밀번호 : <?= $pass?> </li>
     </ul>

  </body>
</html>
