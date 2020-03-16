<style>
table {border-collapse:collapse; border: solid 1px gray;}
th { border: solid 1px gray; text-align: center; padding:5px; }
td { border: solid 1px gray; text-align: center; padding:5px; }
</style>
<?php


echo "<table border=1>";
echo "<tr align=center><th width=150>야드</th><th width=100>미터</th></tr>";

for ($yard=10; $yard <=300 ; $yard=$yard+10) {
  $meter = $yard * 0.9144;
  echo "<tr align = center>";
  echo "<td>$yard</td><td>$meter</td>";
  echo "</tr>";
}
echo "</table>";
 ?>
