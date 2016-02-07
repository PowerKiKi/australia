<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title>Australian's random pictures</title>
 <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<h1>Australian's chat</h1><br />don't forget me, <a href="index.php">look my pictures</a>


<?php
include('smile.php');
$sep_message = "::@@::@@::";
$sep_name = "::__::__::";
$nbPerPage = 20;

function print_pages($total) {
  global $nbPerPage;
  $res = '';
  
  if (!isset($_GET["page"]))
    $_GET["page"] = ceil($total / $nbPerPage);

  $res .= 'pages: '.($_GET["page"] > 1?'<a href="chat.php?page='.($_GET["page"]-1).'"><<</a>':'<<');
  for ($i = 1; $i <= ceil($total / $nbPerPage); $i++)
    if ($i == $_GET["page"])
      $res .= ' '.$i;
    else
      $res .= ' <a href="chat.php?page='.$i.'">'.$i.'</a>';
      
  $res .= ' '.($_GET["page"] < ceil($total / $nbPerPage)?'<a href="chat.php?page='.($_GET["page"]+1).'">>></a>':'>>');
  return $res;
}

if (file_exists("chat.txt")) {
  $messages = split($sep_message, join(file("chat.txt"), ''));
  
  echo "<table width=\"90%\">";
  echo '<tr><td colspan="3" style="background-color: white; text-align: center;">'.print_pages(count($messages)).'</td><tr>';
  $i = 0;
  $first = $nbPerPage * ($_GET["page"]-1);
  $last = $nbPerPage * $_GET["page"] ;

   $nicks = array();
  foreach($messages as $line){
    $array = split($sep_name, $line);
    $nicks[$array[1]] =$array[1];
  }
  sort($nicks);
  $newNicks = array();
  foreach($nicks as $x => $n){
    $newNicks[$x] = '<span class="nickname">'.$n.'</span>';
  }

  foreach ($messages as $line) {
    if ($i >= $first && $i <= $last) {
      $array = split($sep_name, $line);
      echo "<tr><td width=\"140\" class=\"yopla\">$array[0]</td><td width=\"140\"class=\"nickname\">$array[1]</td><td class=\"yopla\">".str_replace($nicks, $newNicks, str_replace($smileText, $smileURL, $array[2]))."</td></tr>";  
    }
    $i++;
  }
  echo '<tr><td colspan="3" style="background-color: white; text-align: center;">'.print_pages(count($messages)).'</td><tr>';
  echo "</table>";
  
}


?>
<br /><?php if (isset($_GET["error"])) echo "remplis tous les champs et arrete d'embeter mon site-euh !"; ?><br />
<form action="post.php" method="post">
name:<br />
<input type="text" name="name" <?php if  (isset($_COOKIE["name"])) echo ' value="'.$_COOKIE["name"].'"';?>/><br /><br />
message:<br />
<textarea name="message" rows="4" cols="70"></textarea >
<input type="submit" value="send">
</form>

</body>
</html>
