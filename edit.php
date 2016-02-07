<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title>Australian's random pictures</title>
 <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<h1>Australian's admin</h1><br />don't forget me, <a href="index.php">look my pictures</a>, <a href="chat.php">chat with me</a>, <a href="edit.php">Edit</a>, <a href="mail.php">Mail</a>

<br /><br /><?php
if (!isset($_GET["file"])) {
  
  $d = dir("./");
  $a = array();
  while (false !== ($entry = $d->read()))
    $a[] = $entry;
  sort($a);
  
  foreach ($a as $entry)
     echo '<a href="edit.php?file='.$entry.'">'.$entry."</a><br />\n";
}
else {
if (isset($_POST["write"])){
  $f = fopen($_POST["write"], "w");
  fwrite($f, trim(stripcslashes($_POST["text"])));
  fclose($f);
  echo $_POST["write"]." writed ! (" .time().")";
}
echo '
<form action="edit.php?file='.$_GET["file"].'" method="post">
'.$_GET["file"].':<br />
<input type="hidden" name="write" value="'.$_GET["file"].'">
<textarea name="text" rows="30" cols="150">'.join(file($_GET["file"]), '').'</textarea >
<input type="submit" value="send" />
</form>';

}

?>
</body></html>