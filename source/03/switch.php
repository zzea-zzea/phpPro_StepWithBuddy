<?php
$value = 150;
$money = 100000;

switch ($value) {
  case ($value <100):
  $computeValue = $money*0.15;
  echo "\$value = {$value} 값은 100 이하이어서 {$computeValue}";
  break;
  case ($value >=100 && $value < 200):
  $computeValue = $money*0.1;
  echo "\$value = {$value} 값은 100~199 {$computeValue}";
  break;
  case ($value >200 && $value <=300):
  $computeValue = $money*0.05;
  echo "\$value = {$value} 값은 200~300 {$computeValue}";
  break;
}
 ?>
