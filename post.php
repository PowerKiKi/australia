<?php


$sep_message = "::@@::@@::";
$sep_name = "::__::__::";

$filename = 'chat.txt';
$somecontent = $sep_message . date("D M j G:i:s").$sep_name. $_POST["name"] .$sep_name. stripcslashes($_POST["message"])."\n";

if (preg_match("/^\s*$/i", $_POST["name"]) || preg_match("/^\s*$/i", $_POST["message"])){
  header("Location: chat.php?error=1");
  die();
}
setcookie("name", $_POST["name"], 6666666666);

// Let's make sure the file exists and is writable first.
if (is_writable($filename)) {

    // In our example we're opening $filename in append mode.
    // The file pointer is at the bottom of the file hence 
    // that's where $somecontent will go when we fwrite() it.
    if (!$handle = fopen($filename, 'a')) {
         echo "Cannot open file ($filename)";
         exit;
    }
/*
    // Write $somecontent to our opened file.
    if (fwrite($handle, $somecontent) === FALSE) {
        echo "Cannot write to file ($filename)";
        exit;
    }    
    //echo "Success, wrote ($somecontent) to file ($filename)";    
    */
    fclose($handle);
    header("Location: chat.php");
} else {
    echo "The file $filename is not writable";
}


?>
