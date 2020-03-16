<?php
$money = 3000;
$price = 800;
$num = 3;

$change = $money - $price * $num;

echo "물건 가격 : $price <br>";
echo "구매 개수 : $num <br>";
echo "지불액 : $money <br>";
echo "거스름돈은 $change 원 입니다.";
