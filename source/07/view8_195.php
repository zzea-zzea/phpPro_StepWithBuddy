<?php
  echo("<!DOCTYPE html>
    <html lang='en' dir='ltr'>
      <head>
        <meta charset='utf-8'>
        <title></title>
        <style>
          li {
            list-style: none;
          }
        </style>
      </head>
      <body>");
  $file_dir = "c:/APM/Apache24/htdocs/source/07/data/";
  $upload = $_FILES["upload"];
  $img_path="";
  if(move_uploaded_file($upload["tmp_name"], $file_dir.$upload["name"])){
    $img_path = "./data/".$upload["name"];
  ?>
    <ul>
      <li><img src="<?= $img_path?>"></li>
      <li><?= $_POST["comment"]?></li>
    </ul>
<?php
  }
  echo("</body>
  </html>");
?>
