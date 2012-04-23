<?php
require_once ('../inc.conf.php'); 
require_once (../inhalt/'inc.hilfsfunktionen.php');
include ("../lang/".$language."/lang.admin.mitspieler_gamma.php");
$fuid = int_get('fu');

if ($fuid==1) {
include ("inc.header.php");
if (($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)) {
?>
<body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center><table border="0" cellspacing="0" cellpadding="4"><tr>
<td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)"><?php echo $lang['admin']['mitspieler']['gamma']['spieler_loeschen']?></td>
</tr></table></center>
<?php
  $zeiger = @mysql_query("SELECT * FROM $skrupel_user order by nick");
  $spieleranzahl = @mysql_num_rows($zeiger);
  if ($spieleranzahl>=1) {
   ?><center><table border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td style="color:#aaaaaa;"><?php echo $lang['admin']['mitspieler']['gamma']['name']?></td>
        <td style="color:#aaaaaa;"><center><nobr><?php echo $lang['admin']['mitspieler']['gamma']['email']?></nobr></center></td>
        <td style="color:#aaaaaa;"><center><nobr><?php echo $lang['admin']['mitspieler']['gamma']['icq']?></nobr></center></td>
        <td style="color:#aaaaaa;"><center><nobr><?php echo $lang['admin']['mitspieler']['gamma']['aspiele']?></nobr></center></td>
        <td><img src="../bilder/empty.gif" height="22" width="1"></td>
      </tr>
   <?php
   for  ($i=0; $i<$spieleranzahl;$i++) {
   $ok = @mysql_data_seek($zeiger,$i);
   $array = @mysql_fetch_array($zeiger);
   $id=$array["id"];
   $nick=$array["nick"];
   $email=$array["email"];
   $icq=$array["icq"];
?>
  <tr>
      <td valign="top"><nobr><?php echo $nick; ?></nobr></td>
      <td valign="top" style="color:#c9c9c9;"><center><?php echo $email; ?></center></td>
      <td valign="top" style="color:#c9c9c9;"><center><?php echo $icq; ?></center></td>
      <td valign="top" style="color:#c9c9c9;"><center><?php
  $spielanzahl=0;
  $zeiger2 = @mysql_query("SELECT name,spieler_1,spieler_2,spieler_3,spieler_4,spieler_5,spieler_6,spieler_7,spieler_8,spieler_9,spieler_10 FROM $skrupel_spiele where spieler_1=$id or spieler_2=$id or spieler_3=$id or spieler_4=$id or spieler_5=$id or spieler_6=$id or spieler_7=$id or spieler_8=$id or spieler_9=$id or spieler_10=$id order by name");
  $spielanzahl = @mysql_num_rows($zeiger2);
  if ($spielanzahl>=1) {
   for  ($i2=0; $i2<$spielanzahl;$i2++) {
   $ok2 = @mysql_data_seek($zeiger2,$i2);
   $array2 = @mysql_fetch_array($zeiger2);
   $name=$array2["name"];
   echo "$name";
   if ($i2<$spielanzahl-1) { echo " - "; }
}}
      ?></center></td>
      <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
<?php if ($spielanzahl>=1) { ?>
     <tr><td></td>
     <td><input type="button" class="nofunc" name="bla" value="<?php echo $lang['admin']['mitspieler']['gamma']['loeschen']?>" style="width:120px;"></td>
     <td></td></tr>
<?php } else { ?>
     <tr><td><form name="formular"  method="post" action="mitspieler_gamma.php?fu=2&spieler_id=<?php echo $id; ?>" onsubmit="return confirm('<?php echo str_replace('{1}',$nick,$lang['admin']['mitspieler']['gamma']['wirklich']);?>');"></td>
     <td><input type="submit" name="bla" value="<?php echo $lang['admin']['mitspieler']['gamma']['loeschen']?>" style="width:120px;"></td>
     <td></form></td></tr>
<?php } ?>
   </table></td>
  </tr>
<?php }} ?>
</table></center>
<?php } include ("inc.footer.php");
 }
if ($fuid==2) {
include ("inc.header.php");
if (($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)) {
$id=int_get('spieler_id');
$zeiger = @mysql_query("DELETE from $skrupel_user where id=$id");
?>
<body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center><table border="0" height="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $lang['admin']['mitspieler']['gamma']['erfolgreich']?></td>
  </tr>
</table></center><?php
 } include ("inc.footer.php");
}
