<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title>Australia's random pictures</title>
 <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<h1>Australia's random pictures</h1><br />don't forget me, <a href="chat.php">chat with me</a>
<?php
$nbPerPage = 15;

function print_pages($total)
{
    global $nbPerPage;
    $res = '';

    if (!isset($_GET['page'])) {
        $_GET['page'] = ceil($total / $nbPerPage);
    }

    $res .= 'pages: ' . ($_GET['page'] > 1?'<a href="?page=' . ($_GET['page'] - 1) . '"><<</a>':'<<');
    for ($i = 1; $i <= ceil($total / $nbPerPage); ++$i) {
        if ($i == $_GET['page']) {
            $res .= ' ' . $i;
        } else {
            $res .= ' <a href="?page=' . $i . '">' . $i . '</a>';
        }
    }

    $res .= ' ' . ($_GET['page'] < ceil($total / $nbPerPage)?'<a href="?page=' . ($_GET['page'] + 1) . '">>></a>':'>>');

    return $res;
}

  // Faisage d'un joli tableau a partir du fichier texte [numero => texte]
  $text = preg_replace("/\n\s*/i", "\n", trim(implode(file('text.txt'), "\n")));
  $array = [];
  foreach (preg_split("/\n/D", $text) as $line) {
      $line_array = preg_split('/ -- /D', $line);

    // Si on rencontre une ligne avec seulment '--', on arrete le parsage de le machin
    if (trim($line_array[0]) == '--') {
        if (!isset($_GET['all'])) {
            break;
        }
    } else {
        $array[$line_array[0]] = $line_array[1];
    }
  }

  // Faisage de le titre joli
  echo '';

  $size = 0;
  $buffer = '<tr>';
  echo '<table class="main" width="100%" >';
  echo '<tr><td colspan="3" style="background-color: white; text-align: center;">' . print_pages(count($array)) . '</td><tr>';
  $i = 0;
  $first = $nbPerPage * ($_GET['page'] - 1);
  $last = $nbPerPage * $_GET['page'];
  foreach ($array as $num => $text) {
      if ($i >= $first && $i <= $last) {
          $buffer .= '<td class="yopla"><table width="100%"><tr><td width="90">' . $num . '<br /><a href="img.php?num=' . $num . '&size=med"><img src="img.php?num=' . $num . '&size=small"></a><br /><a href="img.php?num=' . $num . '&size=med">[med]</a><a href="img.php?num=' . $num . '&size=big">[big]</a></td><td>' . $text . '</td></tr></table></td>';

      // Flush si on a 3 images pour construire la ligne
      if (++$size == 3) {
          echo $buffer . '</tr>';
          $buffer = '<tr>';
          $size = 0;
      }
      }
      ++$i;
  }
  if (isset($_GET['all']) && $size > 0) {
      echo $buffer . '<tr>';
  }
  echo '<tr><td colspan="3" style="background-color: white; text-align: center;">' . print_pages(count($array)) . '</td><tr>';
  echo '</table>';
?>

</body>
</html>
