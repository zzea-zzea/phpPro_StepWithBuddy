
 <?php
 $value = 150;
 $money = 100000;

 switch ($value) {
   case ($value<=100):
   $comuteValue = $money*0.15;
 echo "\$value = {$value} 값은 100 이하여서 {$comuteValue} <br>";
     break;

     case ($value>=101 && $value <=200):
     $comuteValue = $money*0.1;
   echo "\$value = {$value} 값은 200 이하여서 {$comuteValue} <br>";
       break;

       case ($value>=201 && $value <=300):
       $comuteValue = $money*0.05;
     echo "\$value = {$value} 값은 300 이하여서 {$comuteValue} <br>";
         break;
   default:
     // code...
     break;
 }
?>
