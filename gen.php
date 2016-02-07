<?php

$min = 0;
$max = 350;
for ($i = $min; $i < $max; ++$i) {
    $s = '';
    if ($i < 100) {
        $s = '0';
    }
    if ($i < 10) {
        $s = '00';
    }
    echo '<img src="img.php?num=' . $s . $i . '&size=small">';
    echo '<img src="img.php?num=' . $s . $i . '&size=med">';
//   echo "http://www.lucki.ch/img.php?num=" . $i . "&size=small";
   echo '<br />';
}
