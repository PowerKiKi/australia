<?php

$min = 1;
$max = 120;
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
    echo '<br />';
}
