<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <ul>
      <li>나의 취미
        <?php
          $num = count($_POST{"hobby"});
          for ($i=0; $i<$num ; $i++) {
            echo $_POST["hobby"][$i];
            if($i != $num - 1){
              echo ", ";
            }
          }

         ?>
      </li>
    </ul>

  </body>
</html>
