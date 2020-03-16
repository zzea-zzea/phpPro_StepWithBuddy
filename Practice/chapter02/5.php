
<style>
table {border-collapse:collapse; border: solid 1px gray;}
th { border: solid 1px gray; text-align: center; padding:5px; }
td { border: solid 1px gray; text-align: center; padding:5px; }
</style>

<?php
$name = "김지혜";
$phone = "010-2110-6711";
$address = "경기도 남양주시 와부읍 팔당리629번지";
$mail = "yoojoo300@naver.com";

echo"<table>";

echo "<tr align = center>";
echo "<th>이름</th>";
echo "<th>휴대폰 번호</th>";
echo "<th>주소</th>";
echo "<th>이메일</th>";
echo "</tr>";

echo "<tr align = center>";
echo "<td>$name</th>";
echo "<td>$phone</th>";
echo "<td>$address</th>";
echo "<td>$mail</th>";
echo "</tr>";
 ?>
