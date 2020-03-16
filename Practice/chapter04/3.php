<?php

$num = 300;
$sum = 0;

while ($num<=3000) {
    if ($num%2==1) {
        $sum = $sum + $num;
    }
    $num++;
}
echo "300~3000 홀수의 합 : $sum";
