
    <link rel="stylesheet" href="gugudan.css">

    <table>

      <?php
        for ($b=1; $b<=9; $b++) {
            echo "<tr>";
            for ($a=1; $a<=9; $a++) {
              if($b==1){
                $c = $a + 1;
                echo "<td>{$c}단</td>";
              }else{
                $c = $a * $b;
                echo "<td>{$a}x{$b}=$c</td>";
              }
            }
            echo "</tr>";
        }
      ?>
  </table>
