<?php
//include_once("debug.inc");
//v($_FILES);
require('phpmailer-1.72/class.phpmailer.php');


?>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title>Australian's random pictures</title>
 <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<h1>Australian's mail</h1><br />don't forget me, <a href="index.php">look my pictures</a>, <a href="chat.php">chat with me</a>

<br /><br />
<?php

if (isset($_GET['num'])){

  echo 'sending...<br /><br />';
  $mail = new PHPMailer();
  $mail->Subject = 'Australia\'s random pictures';
  $mail->From = 'powerkiki@net2000.ch';
  $mail->FromName = 'PowerKiKi';
  $mail->Mailer = 'mail';
  $mail->Body = stripcslashes($_POST['body']);


  for ($i= (int)$_GET['num']; $i < (int)$_GET['num'] + 3; $i++) {
    $num = sprintf('%03d', $i);
    $mail->AddEmbeddedImage('img/med_'.$num.'.jpg','med_'. $num.'.jpg','med_'.$num.'.jpg','base64' , 'image/jpeg');
  }
     
  

  $adresses = file('mail.txt');
//  $adresses = array('powerkiki@net2000.ch', 'adrien.crivelli@net2000.ch');
  foreach($adresses as $ad) {
    $mail->AddAddress($ad);
    
    if(!$mail->Send())
      echo $ad . " ERROR ! ".$mail->ErrorInfo . '<br />';
    else
      echo $ad . '<br />';
   $mail->ClearAddresses();
   flush();
  }
}
else if (isset($_GET['prenum'])) {
  // Faisage d'un joli tableau a partir du fichier texte [numero => texte]^M
  $text = preg_replace("/\n\s*/i", "\n", trim(join(file("text.txt"), "\n")));
    $array = array();
      foreach (split("\n", $text) as $line) {
          $line_array = split(" -- ", $line);
              
                  // Si on rencontre une ligne avec seulment '--', on arrete le parsage de le machin
                     if (trim($line_array[0]) == "--"){
                           if (!isset($_GET["all"]))
                                   ;
                                       }
                                           else      
                                                 $array[$line_array[0]] = $line_array[1];
                 }

//echo  toutes les images @@@@@ et le texte @@@@@
$body = '';
/*
for ($i= (int)$_GET['prenum']; $i < (int)$_GET['prenum'] + 3; $i++) {
  $num = sprintf('%03d', $i); 
  $body .= $num . ' -- ' . $array[$num] . "\n";
  echo '<img src="img.php?num='.$num.'&size=med"><br /><br />';
}*/
$body .= "\nhttp://kiki.euphorik.ch\n";
echo '<form action="mail.php?num='.$_GET['prenum'].'" method="post"><textarea name="body" rows="8" cols="70">'.$body.'</textarea><br /><input type="submit" value="send" /></form>';

}
else {

  $i = 1;
  while (file_exists('img/'.($num = sprintf('%03d', $i++) ).'.jpg')) {
    echo '<a href="mail.php?prenum='.$num.'"><img src="img.php?num='.$num.'&size=small"></a> ';
    
  }
}

?>

</body>
</html>
