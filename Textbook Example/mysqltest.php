<?php
echo "MySql  connection Test<br>";
$db = mysqli_connect("localhost", "root", "123456", "test");
if($db){echo "connect : succeed<br>";}
else{echo "disconnect : error<br>";}
$result = mysqli_query($db, 'SELECT VERSION() as VERSION');
$data = mysqli_fetch_assoc($result);
echo $data['VERSION'];
?>
