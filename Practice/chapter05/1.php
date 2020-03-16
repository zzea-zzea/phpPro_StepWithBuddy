<?php
$score = array(87,76,98,87,87,93,79,52,88,63);
$sum = 0;
for ($i=0; $i <count($score) ; $i++) {
  $sum = $sum + $score[$i];
}
$avg = $sum/10;
echo "입력된 점수 : ";

for ($i=0; $i < 10 ; $i++) {
  echo $score[$i]." ";
}

echo "<br>";
echo ("합계 : $sum, 평균 : $avg");
 ?>
