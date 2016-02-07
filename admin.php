<?php
//include_once("debug.inc");
//v($_FILES);
if (isset($_POST["text"])){
  $f = fopen("text.txt", "w");
  fwrite($f, trim(stripcslashes($_POST["text"])));
  fclose($f);
  echo "text.txt writed !";
}
if (isset($_POST["mails"])){
//echo $_POST['mails'];
$mails =  $_POST['mails'];
//sort($mails);
  $f = fopen("mail.txt", "w");
  fwrite($f, trim(stripcslashes($mails)));
  fclose($f);
  echo "mail.txt writed !";
}

if (isset($_FILES["uploadimage"])) {
  $res = move_uploaded_file ($_FILES["uploadimage"]["tmp_name"], "img/".$_FILES["uploadimage"]["name"]);
  echo $_FILES["uploadimage"]["name"]." upload ". ($res?"ok":"<b>FAILED</b>");
}
?>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title>Australian's random pictures</title>
 <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<h1>Australian's admin</h1><br />don't forget me, <a href="index.php">look my pictures</a>, <a href="chat.php">chat with me</a>, <a href="edit.php">Edit</a>, <a href="mail.php">Mail</a>

<br /><br />

<form action="admin.php" method="post" enctype="multipart/form-data">
upload:<br />
<input type="file" name="uploadimage" />
<input type="submit" value="send" />
</form>
<br /><hr>



<form action="admin.php" method="post">
text:<br />
<textarea name="text" rows="8" cols="70"><?php echo join(file('text.txt'), '');?></textarea >
<input type="submit" value="send" />
</form>
<br /><hr>
<?php
$mails = file("mail.txt");
echo count($mails) . " mails:<br>";
echo "<p>";
foreach ($mails as $m)
  echo $m ."; ";
echo "</p>";


?>
<form action="admin.php" method="post">
text:<br />
<textarea name="mails" rows="8" cols="70"><?php echo join($mails, '');?></textarea >
<input type="submit" value="send" />
</form>
<br /><hr>

<?php
$d = dir("img/");
$a = array();
while (false !== ($entry = $d->read())) {
$a[] = $entry;
}
sort($a);
foreach ($a as $entry)
   echo '<a href="img/'.$entry.'">'.$entry."</a><br />\n";

?>

</body>
</html>
