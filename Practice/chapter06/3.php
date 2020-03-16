<?php
function child_rate($cat)
{
    if ($cat=="입장권") {
        $price = 13000;
    } elseif ($cat =="자유 이용권 주간") {
        $price = 25000;
    } elseif ($cat =="자유 이용권 야간") {
        $price = 22000;
    } else {
        $price = 22000;
    }
}
function youth_rate($cat)
{
    if ($cat =="입장권") {
        $price = 15000;
    } elseif ($cat =="자유 이용권 주간") {
        $price = 28000;
    } elseif ($cat =="자유 이용권 야간") {
        $price = 25000;
    } else {
        $price = 25000;
    }
}
function adult_rate($cat)
{
    if ($cat=="입장권") {
        $price = 18000;
    } elseif ($cat=="자유 이용권 주간") {
        $price = 32000;
    } elseif ($cat=="자유 이용권 야간") {
        $price = 29000;
    } else {
        $price = 29000;
    }
    return $price;
}
$age = 2;
$category = "자유 이용권 야간";
if ($age>=0 && $age<=3) {
    $fee = 0;
} elseif ($age>=4 && $age<=11) {
    $fee = child_rate($category);
} elseif ($age>=4 && $age<=11) {
    $fee = youth_rate($category);
} else {
    $fee = adult_rate($category);
}

  echo "입장권 종류 : $category<br>";
  echo "입장객 나이 : {$age}세<br>";
  echo "입장료 : {$fee}원";
