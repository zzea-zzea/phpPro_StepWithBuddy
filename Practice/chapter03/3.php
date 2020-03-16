<?php

$score = 90;
echo "시험 점수 : {$score}점<br>";

if($score>=90 && $score <=100){
  echo "등급 : 수";
}else if($score>=80 && $score <=90){
  echo "등급 : 우";
}else if($score>=70 && $score <=80){
  echo "등급 : 미";
}else if($score>=60 && $score <=70){
  echo "등급 : 양";
}else if($score>=50 && $score <=60){
  echo "등급 : 가";
}else{
  echo "점수를 잘못 입력하셨습니다.";
}
 ?>
