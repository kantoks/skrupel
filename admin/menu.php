<?php
require_once ('../inc.conf.php'); 
require_once (../inhalt/'inc.hilfsfunktionen.php');
include ("../lang/".$language."/lang.admin.menu.php");
$fuid = int_get('fu');

if ($fuid==1) { ?>
<?php
include ("inc.header.php");
if (($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)) {
?>
<body text="#ffffff" style="background-image:url('../bilder/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#444444" scroll="no" link="#ffffff" vlink="#ffffff" alink="#ffffff" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center><table border="0" cellspacing="0" cellpadding="3">
  <tr><td><img src="../bilder/empty.gif" border="0" width="1" height="3"></td></tr>
<tr>
    <td><center><?php echo $lang['admin']['menu']['allgemeines']?></center></td>
    <td><center><?php echo $lang['admin']['menu']['spiele']?></center></td>
    <td><center><?php echo $lang['admin']['menu']['mitspieler']?></center></td>
    <td><center></center></td>
    <td><center></center></td>
    <td><center></center></td>
    <td><center></center></td>
</tr>
  <tr>
   <td><table border="0" cellspacing="0" cellpadding="0">
     <tr><td><form name="formular"  method="post"  action="allgemein_beta.php?fu=1" target="rahmen12"></td>
     <td><input type="submit" name="bla" value="<?php echo $lang['admin']['menu']['einstellungen']?>" style="width:120px;"></td>
     <td></form></td></tr>
   </table></td>
   <td><table border="0" cellspacing="0" cellpadding="0">
     <tr><td><form name="formular"  method="post" action="spiel_alpha.php?fu=1" target="rahmen12"></td>
     <td><input type="submit" name="bla" value="<?php echo $lang['admin']['menu']['erstellen']?>" style="width:120px;"></td>
     <td></form></td></tr>
   </table></td>
   <td><table border="0" cellspacing="0" cellpadding="0">
     <tr><td><form name="formular"  method="post"  action="mitspieler_alpha.php?fu=1" target="rahmen12"></td>
     <td><input type="submit" name="bla" value="<?php echo $lang['admin']['menu']['anlegen']?>" style="width:120px;"></td>
     <td></form></td></tr>
   </table></td>
   <td><table border="0" cellspacing="0" cellpadding="0">
     <tr><td><form name="formular"  method="post" action="#"></td>
     <td><input type="submit" name="bla" value="" style="width:120px;"></td>
     <td></form></td></tr>
   </table></td>
   <td><table border="0" cellspacing="0" cellpadding="0">
     <tr><td><form name="formular"  method="post" action="#"></td>
     <td><input type="submit" name="bla" value="" style="width:120px;"></td>
     <td></form></td></tr>
   </table></td>
   <td><table border="0" cellspacing="0" cellpadding="0">
     <tr><td><form name="formular"  method="post" action="#"></td>
     <td><input type="submit" name="bla" value="" style="width:120px;"></td>
     <td></form></td></tr>
   </table></td>
   <td><table border="0" cellspacing="0" cellpadding="0">
     <tr><td><form name="formular"  method="post" action="#"></td>
     <td><input type="submit" name="bla" value="" style="width:120px;"></td>
     <td></form></td></tr>
   </table></td>
</tr>
  <tr>
   <td><table border="0" cellspacing="0" cellpadding="0">
     <tr><td><form name="formular"  method="post" action="allgemein_gamma.php?fu=1" target="rahmen12"></td>
     <td><input type="submit" name="bla" value="<?php echo $lang['admin']['menu']['erweiterungen']?>" style="width:120px;"></td>
     <td></form></td></tr>
   </table></td>
   <td><table border="0" cellspacing="0" cellpadding="0">
     <tr><td><form name="formular"  method="post" action="spiel_beta.php?fu=1" target="rahmen12"></td>
     <td><input type="submit" name="bla" value="<?php echo $lang['admin']['menu']['bearbeiten']?>" style="width:120px;"></td>
     <td></form></td></tr>
   </table></td>
   <td><table border="0" cellspacing="0" cellpadding="0">
     <tr><td><form name="formular"  method="post" action="mitspieler_beta.php?fu=1" target="rahmen12"></td>
     <td><input type="submit" name="bla" value="<?php echo $lang['admin']['menu']['bearbeiten']?>" style="width:120px;"></td>
     <td></form></td></tr>
   </table></td>
   <td><table border="0" cellspacing="0" cellpadding="0">
     <tr><td><form name="formular"  method="post" action="#"></td>
     <td><input type="submit" name="bla" value="" style="width:120px;"></td>
     <td></form></td></tr>
   </table></td>
   <td><table border="0" cellspacing="0" cellpadding="0">
     <tr><td><form name="formular"  method="post" action="#"></td>
     <td><input type="submit" name="bla" value="" style="width:120px;"></td>
     <td></form></td></tr>
   </table></td>
   <td><table border="0" cellspacing="0" cellpadding="0">
     <tr><td><form name="formular"  method="post" action="#"></td>
     <td><input type="submit" name="bla" value="" style="width:120px;"></td>
     <td></form></td></tr>
   </table></td>
   <td><table border="0" cellspacing="0" cellpadding="0">
     <tr><td><form name="formular"  method="post" action="#"></td>
     <td><input type="submit" name="bla" value="" style="width:120px;"></td>
     <td></form></td></tr>
   </table></td>
</tr>
  <tr>
   <td><table border="0" cellspacing="0" cellpadding="0">
     <tr><td><form name="formular"  method="post" action="allgemein_alpha.php?fu=1" target="rahmen12"></td>
     <td><input type="submit" name="bla" value="<?php echo $lang['admin']['menu']['offenbarung']?>" style="width:120px;"></td>
     <td></form></td></tr>
   </table></td>
   <td><table border="0" cellspacing="0" cellpadding="0">
     <tr><td><form name="formular"  method="post" action="spiel_gamma.php?fu=1" target="rahmen12"></td>
     <td><input type="submit" name="bla" value="<?php echo $lang['admin']['menu']['loeschen']?>" style="width:120px;"></td>
     <td></form></td></tr>
   </table></td>
   <td><table border="0" cellspacing="0" cellpadding="0">
     <tr><td><form name="formular"  method="post" action="mitspieler_gamma.php?fu=1" target="rahmen12"></td>
     <td><input type="submit" name="bla" value="<?php echo $lang['admin']['menu']['loeschen']?>" style="width:120px;"></td>
     <td></form></td></tr>
   </table></td>
   <td><table border="0" cellspacing="0" cellpadding="0">
     <tr><td><form name="formular"  method="post" action="#"></td>
     <td><input type="submit" name="bla" value="" style="width:120px;"></td>
     <td></form></td></tr>
   </table></td>
   <td><table border="0" cellspacing="0" cellpadding="0">
     <tr><td><form name="formular"  method="post" action="#"></td>
     <td><input type="submit" name="bla" value="" style="width:120px;"></td>
     <td></form></td></tr>
   </table></td>
   <td><table border="0" cellspacing="0" cellpadding="0">
     <tr><td><form name="formular"  method="post" action="#"></td>
     <td><input type="submit" name="bla" value="" style="width:120px;"></td>
     <td></form></td></tr>
   </table></td>
   <td><table border="0" cellspacing="0" cellpadding="0">
     <tr><td><form name="formular"  method="post" action="#"></td>
     <td><input type="submit" name="bla" value="" style="width:120px;"></td>
     <td></form></td></tr>
   </table></td>
</tr>
</table></center>
<?php } include ("inc.footer.php"); ?>
<?php } ?>
<?php if ($fuid==2) { ?>
<?php
include ("inc.header.php");
if (($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)) {
?><body text="#000000" bgcolor="#000000" background="../bilder/aufbau/33.gif" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
   <td><img src="../bilder/empty.gif" border="0" width="1" height="77"></td>
  </tr>
  <tr>
   <td><table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><form method=post action='index.php' target="_top"><input type="hidden" name="loginname" value="-"><input type="hidden" name="loginpass" value="-"></td>
    <td><input type="image" class="bild" name="Logout" src="../bilder/aufbau/knopp.gif" title="<?php echo $lang['admin']['menu']['logout']?>"></td>
    <td></form></td>
  </tr>
</table></td>
  </tr>
</table>
<?php } include ("inc.footer.php");
}
