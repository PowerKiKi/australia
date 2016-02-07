<?php
/* Qq fonctions de debuggage
* */

// Affichage d'un tableau (recursif)
function viewArray($arr)
{
   echo '<table cellpadding="0" cellspacing="0" border="1">';
   foreach ($arr as $key1 => $elem1) {
       echo '<tr>';
       echo '<td>'.$key1.'&nbsp;</td>';
       if (is_array($elem1)) { extArray($elem1); }
       else { echo '<td>'.$elem1.'&nbsp;</td>'; }
       echo '</tr>';
   }
   echo '</table>';
}

function extArray($arr)
{
   echo '<td>';
   echo '<table cellpadding="0" cellspacing="0" border="1">';
   foreach ($arr as $key => $elem) {
      echo '<tr>';
       echo '<td>'.$key.'&nbsp;</td>';
       if (is_array($elem)) { extArray($elem); }
       else { echo '<td>'.htmlspecialchars($elem).'&nbsp;</td>'; }
      echo '</tr>';
   }
   echo '</table>';
   echo '</td>';
}

function v($x){ viewarray($x);}

?>
