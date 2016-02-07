<?php
//include_once("debug.inc");
//v($_FILES);
if (isset($_POST['chat'])) {
    $f = fopen('chat.txt', 'w');
    fwrite($f, trim(stripcslashes($_POST['chat'])));
    fclose($f);
    echo 'chat.txt writed !';
}

?>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title>Australian's random pictures</title>
 <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<h1>Australian's admin</h1><br />don't forget me, <a href="index.php">look my pictures</a>, <a href="chat.php">chat with me</a>

<br /><br />

<form action="achat.php" method="post">
chat:<br />
<textarea name="chat" rows="50" cols="120"><?php echo implode(file('chat.txt'), '');?></textarea >
<input type="submit" value="send" />
</form>
</body>
</html>
