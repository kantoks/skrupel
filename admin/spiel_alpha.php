<?php
require_once ('../inc.conf.php'); 
require_once (../inhalt/'inc.hilfsfunktionen.php');
$lang = array();
include ("../lang/".$language."/lang.admin.spiel_alpha.php");
$fuid = int_get('fu');
$prozentarray=array(0,1,2,3,4,5,6,7,8,9,10,15,20,30,40,50,60,70,80,90,100);

if ($fuid==1) {
include ("inc.header.php");
if (@intval(substr($spiel_extend,1,1))==1) {
    //Wird nur bei installierter, aktiver KI ausgefuehrt. Es werden pro installierter KI ein Spieler
    //erstellt. Falls mehr Spieler pro KI in einem Spiel sein sollen, muss dieser Code entsprechend
    //veraendert werden.
    include("../extend/ki/ki_basis/kiEinrichten.php");
}
if (($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)) {
?>
<body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center><table border="0" cellspacing="0" cellpadding="4">
    <tr>
        <td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)"><?php echo $lang['admin']['spiel']['alpha']['neues_spiel']?></td>
    </tr>
</table></center>
<form name="formular" method="post" action="spiel_alpha.php?fu=10">
<center><table border="0" cellspacing="0" cellpadding="2">
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['wie_name']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><input type="text" name="spiel_name" class="eingabe" value="" maxlength="50" style="width:250px;"></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['siegbedingungen']['wie']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td><input type="radio" name="siegbedingungen" value="0" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['siegbedingungen']['jff']?></td></tr>
      <tr><td><input type="radio" name="siegbedingungen" value="1"></td><td>&nbsp;</td><td><table border="0" cellspacing="0" cellpadding="0"><tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['siegbedingungen']['ueberleben'][0]?></td><td><select name="zielinfo_1"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option></select></td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['siegbedingungen']['ueberleben'][1]?></td></tr></table></td></tr>
      <tr><td><input type="radio" name="siegbedingungen" value="2"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['siegbedingungen']['tf']?></td></tr>
      <tr><td><input type="radio" name="siegbedingungen" value="6"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['siegbedingungen']['ttf']?></td></tr>
      <?php /* ?>
      <tr><td><input type="radio" name="siegbedingungen" value="3"></td><td>&nbsp;</td><td><table border="0" cellspacing="0" cellpadding="0"><tr><td style="color:#aaaaaa;">Dominanz (es gilt &nbsp;</td><td><select name="zielinfo_3"><option value="30">30 %</option><option value="40">40 %</option><option value="50">50 %</option><option value="60">60 %</option><option value="70">70 %</option><option value="80">80 %</option><option value="90">90 %</option></select></td><td style="color:#aaaaaa;">&nbsp;aller Planeten zu beherrschen)</td></tr></table></td></tr>
      <tr><td><input type="radio" name="siegbedingungen" value="4"></td><td>&nbsp;</td><td><table border="0" cellspacing="0" cellpadding="0"><tr><td style="color:#aaaaaa;">King of the Planet (in der Mitte der Galaxie befindet sich ein heiliger Planet, welcher &nbsp;</td><td><select name="zielinfo_4"><option value="25">25</option><option value="50">50</option><option value="100">100</option><option value="150">150</option><option value="200">200</option></select></td><td style="color:#aaaaaa;">&nbsp;Monate beherrscht werden muss)</td></tr></table></td></tr>
      <?php */ ?>
      <tr><td><input type="radio" name="siegbedingungen" value="5"></td><td>&nbsp;</td><td><table border="0" cellspacing="0" cellpadding="0"><tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['siegbedingungen']['spice'][0]?></td><td><select name="zielinfo_5"><option value="2500">2500</option><option value="5000">5000</option><option value="7500">7500</option><option value="10000">10000</option><option value="15000">15000</option></select></td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['siegbedingungen']['spice'][1]?></td></tr></table></td></tr>
     </table></td></tr>
    <tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['optional']['welche']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><input type="checkbox" name="modul_0" value="1" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['optional']['sus']?></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><input type="checkbox" name="modul_4" value="1"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['optional']['wysiwyg']?></td>
        </tr>
        <tr>
            <td><input type="checkbox" name="modul_2" value="1" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['optional']['mf']?></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <?php /*
            <td><input type="checkbox" name="modul_5" value="1"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['optional']['f']?></td>
            */ ?>
            <td></td><td></td><td></td>
        </tr>
        <tr>
            <td><input type="checkbox" name="modul_3" value="1" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['optional']['tk']?></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <?php /*
            <td><input type="checkbox" name="modul_6" value="1"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['optional']['h']?></td>
            */ ?>
            <td></td><td></td><td></td>
        </tr>
      <?php /* ?>
      <tr><td><input type="checkbox" name="modul_1" value="1" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['optional']['as'][0]?><select name="stat_delay"><?php for($i=0;$i<=15;$i++) { ?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?></select><?php echo $lang['admin']['spiel']['alpha']['optional']['as'][1]?></td></tr>
            <?php */ ?>
      </table></td></tr>
</table></center>
<br><br>
<center><table border="0" cellspacing="0" cellpadding="0"><tr>
<td><input type="submit" name="bla" value="<?php echo str_replace('{1}',2,$lang['admin']['spiel']['alpha']['weiter_'])?>"></td><td></form></td>
</tr></table></center><?php
 } include ("inc.footer.php");
 }
if ($fuid==10) {
include ("inc.header.php");
if (($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)) {
?>
<body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)"><?php echo $lang['admin']['spiel']['alpha']['neues_spiel']?></td></tr></table></center>
<form name="formular" method="post" action="spiel_alpha.php?fu=2">
<?php
foreach ($_POST as $key => $value) {
    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
}
?>
<center><table border="0" cellspacing="0" cellpadding="2">
  <tr><td><?php echo $lang['admin']['spiel']['alpha']['struktur']?><br><br></td></tr>
  <tr>
<?php
$zahl=0;
include ("../lang/".$language."/lang.admin.galaxiestrukturen.php");
$file='../daten/gala_strukturen.txt';
$fp = @fopen("$file","r");
if ($fp) {
$zaehler=0;
while (!feof ($fp)) {
    $buffer = @fgets($fp, 4096);
    $struktur[$zaehler]=$buffer;
    $zaehler++;
}
@fclose($fp); }
for ($n=0;$n<$zaehler;$n++) {
$strukturdaten=explode(':',$struktur[$n]);
?>
<td with="50%"><table border="0" cellspacing="0" cellpadding="2" with="100%">
 <tr>
   <td><input type="radio" name="struktur" value="<?php echo $strukturdaten[1]; ?>" <?php if ($n==0) { echo 'checked'; } ?>></td>
   <td style="color:#aaaaaa;" colspan="2"><?php echo $lang['admin']['galaxiestrukturen'][$strukturdaten[0]]; ?></td>
 </tr>
 <tr>
   <td></td>
   <td><table border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td><img src="../bilder/admin/gala_1.gif"></td>
       <td><img src="../bilder/admin/gala_2.gif"></td>
       <td><img src="../bilder/admin/gala_3.gif"></td>
     </tr>
     <tr>
       <td><img src="../bilder/admin/gala_4.gif"></td>
       <td background="../daten/bilder_galaxien/<?php echo $strukturdaten[1]; ?>.png"><img src="../bilder/admin/gala_stars.gif"></td>
       <td><img src="../bilder/admin/gala_5.gif"></td>
     </tr>
     <tr>
       <td><img src="../bilder/admin/gala_6.gif"></td>
       <td><img src="../bilder/admin/gala_7.gif"></td>
       <td><img src="../bilder/admin/gala_8.gif"></td>
     </tr>
   </table></td>
   <td width="100%"><center><?php echo $lang['admin']['spiel']['alpha']['spieleranzahl']?><br><br>
     <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input type="button" style="height:20px;width:20px;" value="1"></td>
        <td><input type="button" style="height:20px;width:20px;" value="<?php if (strstr($strukturdaten[2],'2')) { echo '2'; } ?>"></td>
        <td><input type="button" style="height:20px;width:20px;" value="<?php if (strstr($strukturdaten[2],'3')) { echo '3'; } ?>"></td>
        <td><input type="button" style="height:20px;width:20px;" value="<?php if (strstr($strukturdaten[2],'4')) { echo '4'; } ?>"></td>
        <td><input type="button" style="height:20px;width:20px;" value="<?php if (strstr($strukturdaten[2],'5')) { echo '5'; } ?>"></td>
        <td><input type="button" style="height:20px;width:20px;" value="<?php if (strstr($strukturdaten[2],'6')) { echo '6'; } ?>"></td>
        <td><input type="button" style="height:20px;width:20px;" value="<?php if (strstr($strukturdaten[2],'7')) { echo '7'; } ?>"></td>
        <td><input type="button" style="height:20px;width:20px;" value="<?php if (strstr($strukturdaten[2],'8')) { echo '8'; } ?>"></td>
        <td><input type="button" style="height:20px;width:20px;" value="<?php if (strstr($strukturdaten[2],'9')) { echo '9'; } ?>"></td>
        <td><input type="button" style="height:20px;width:20px;" value="<?php if (strstr($strukturdaten[2],'10')) { echo '10'; } ?>"></td>
      <tr>
     </table>
   </<center></td>
 </tr>
</table></td>
<?php
$zahl++;
if ($zahl==2) {
  $zahl=0;
  echo '</tr>';
}
} ?>
</table></center>
<br><br>
<center><table border="0" cellspacing="0" cellpadding="0"><tr>
<td><input type="submit" name="bla" value="<?php echo str_replace('{1}',3,$lang['admin']['spiel']['alpha']['weiter_'])?>"></td><td></form></td>
</tr></table></center><br><br><?php
 } include ("inc.footer.php");
 }
if ($fuid==3) {
include ("inc.header.php");
if (($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)) {
$file='../daten/gala_strukturen.txt';
$fp = @fopen("$file","r");
if ($fp) {
while (!feof ($fp)) {
    $buffer = @fgets($fp, 4096);
    $strukturdaten=explode(':',$buffer);
    if ($strukturdaten[1]==str_post('struktur','SHORTNAME')) {
       $spieleranzahlmog=trim($strukturdaten[2]);
    }
}
@fclose($fp); }
?>
<script language="JavaScript" type="text/javascript">
  spielermog = new Array(0,1,<?php if (strstr($spieleranzahlmog,'2')) { echo '1'; } else { echo '0'; } ?>,<?php if (strstr($spieleranzahlmog,'3')) { echo '1'; } else { echo '0'; } ?>,<?php if (strstr($spieleranzahlmog,'4')) { echo '1'; } else { echo '0'; } ?>,<?php if (strstr($spieleranzahlmog,'5')) { echo '1'; } else { echo '0'; } ?>,<?php if (strstr($spieleranzahlmog,'6')) { echo '1'; } else { echo '0'; } ?>,<?php if (strstr($spieleranzahlmog,'7')) { echo '1'; } else { echo '0'; } ?>,<?php if (strstr($spieleranzahlmog,'8')) { echo '1'; } else { echo '0'; } ?>,<?php if (strstr($spieleranzahlmog,'9')) { echo '1'; } else { echo '0'; } ?>,<?php if (strstr($spieleranzahlmog,'10')) { echo '1'; } else { echo '0'; } ?>);
function check() {
  var spieleranzahl=0;
  if (document.formular.user_1.value != '0') { spieleranzahl++; }
  if (document.formular.user_2.value != '0') { spieleranzahl++; }
  if (document.formular.user_3.value != '0') { spieleranzahl++; }
  if (document.formular.user_4.value != '0') { spieleranzahl++; }
  if (document.formular.user_5.value != '0') { spieleranzahl++; }
  if (document.formular.user_6.value != '0') { spieleranzahl++; }
  if (document.formular.user_7.value != '0') { spieleranzahl++; }
  if (document.formular.user_8.value != '0') { spieleranzahl++; }
  if (document.formular.user_9.value != '0') { spieleranzahl++; }
  if (document.formular.user_10.value != '0') { spieleranzahl++; }
  if ((document.formular.user_1.value == '0') <?php for ($n=2;$n<=10;$n++) { ?> && (document.formular.user_<?php echo $n; ?>.value == '0')<?php } ?>)  {
      alert("<?php echo html_entity_decode($lang['admin']['spiel']['alpha']['min_spieler'])?>");
          return false;
  }
<?php if (int_post('startposition')==1) { ?>
  if (spielermog[spieleranzahl]==0) {
    alert ('<?php echo html_entity_decode(str_replace('{1}',$spieleranzahlmog,$lang['admin']['spiel']['alpha']['nur_spieler']))?>');
    return false;
  }
<?php } ?>
<?php for ($oprt=1;$oprt<=10;$oprt++) { ?>
  if (document.formular.user_<?php echo $oprt; ?>.value >= '1') {
         var anzahle=0;
           <?php for ($n=1;$n<=10;$n++) { ?>
             if (document.formular.user_<?php echo $n; ?>.value == document.formular.user_<?php echo $oprt; ?>.value) { anzahle++; }
           <?php } ?>
         if (anzahle!=1) {
           alert("<?php echo html_entity_decode($lang['admin']['spiel']['alpha']['max_slot'])?>");
           return false;
         }
   }
<?php } ?>
<?php if (int_post('siegbedingungen')==6) {  ?>
<?php for ($oprt=1;$oprt<=10;$oprt++) { ?>
  if (document.formular.user_<?php echo $oprt; ?>.value >= '1') {
    <?php for ($op=0;$op<=4;$op++) { ?>
     if (document.formular.team<?php echo $oprt; ?>[<?php echo $op; ?>].checked == true) {
         var anzahl=0;
           <?php for ($n=1;$n<=10;$n++) { ?>
             if (document.formular.team<?php echo $n; ?>[<?php echo $op; ?>].checked == true) { anzahl++; }
           <?php } ?>
         if (anzahl!=2) {
           alert("<?php echo html_entity_decode($lang['admin']['spiel']['alpha']['zwei_spieler'])?>");
           return false;
         }
     }
    <?php } ?>
  if ((document.formular.team<?php echo $oprt;?>[0].checked == false) <?php for ($n=1;$n<=4;$n++) { ?> && (document.formular.team<?php echo $oprt; ?>[<?php echo $n; ?>].checked == false)<?php } ?>)  {
      alert("<?php echo html_entity_decode($lang['admin']['spiel']['alpha']['team_spieler'])?>");
      return false;
  }
  } else {
  if ((document.formular.team<?php echo $oprt; ?>[0].checked == true) <?php for ($n=1;$n<=4;$n++) { ?> || (document.formular.team<?php echo $oprt; ?>[<?php echo $n; ?>].checked == true)<?php } ?>)  {
      alert("<?php echo html_entity_decode($lang['admin']['spiel']['alpha']['kein_team'])?>");
      return false;
  }
  }
<?php } ?>
<?php } ?>
  return true;
}
</script>
<body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)"><?php echo $lang['admin']['spiel']['alpha']['neues_spiel']?></td></tr></table></center>
<form name="formular" method="post" action="spiel_alpha.php?fu=4" onSubmit="return check();">
<?php
foreach ($_POST as $key => $value) {
    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
}
?>
<center><table border="0" cellspacing="0" cellpadding="2">
<?php
$verzeichnis="../daten/";
$handle=opendir("$verzeichnis");
$zaehler=0;
while ($file=readdir($handle)) {
   if ((substr($file,0,1)<>'.') and (substr($file,0,7)<>'bilder_') and (substr($file,strlen($file)-4,4)<>'.txt')) {
if (trim($file)=='unknown') { } else {
$datei='../daten/'.$file.'/daten.txt';
$fp = @fopen("$datei","r");
if ($fp) {
$zaehler2=0;
while (!feof ($fp)) {
    $buffer = @fgets($fp, 4096);
    $daten[$zaehler][$zaehler2]=$buffer;
    $zaehler2++;
}
@fclose($fp); }
$filename[$zaehler]=$file;
$zaehler++;
}
   }
}
closedir($handle);
  $zeiger = @mysql_query("SELECT * FROM $skrupel_user order by nick");
  $useranzahl = @mysql_num_rows($zeiger);
   ?>
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['wer_volk']?></td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="1">
   <tr>
   <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
   <td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['admin']?></td>
<?php if (int_post('siegbedingungen')==6) {  ?>
   <td>&nbsp;&nbsp;</td>
   <td><?php echo $lang['admin']['spiel']['alpha']['teams']?></td>
   <td>&nbsp;</td>
   <td style="color:#aaaaaa;"><center><?php echo $lang['admin']['spiel']['alpha']['team']['i']?></center></td>
   <td>&nbsp;</td>
   <td style="color:#aaaaaa;"><center><?php echo $lang['admin']['spiel']['alpha']['team']['ii']?></center></td>
   <td>&nbsp;</td>
   <td style="color:#aaaaaa;"><center><?php echo $lang['admin']['spiel']['alpha']['team']['iii']?></center></td>
   <td>&nbsp;</td>
   <td style="color:#aaaaaa;"><center><?php echo $lang['admin']['spiel']['alpha']['team']['iv']?></center></td>
   <td>&nbsp;</td>
   <td style="color:#aaaaaa;"><center><?php echo $lang['admin']['spiel']['alpha']['team']['v']?></center></td>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
<?php } ?>
   </tr>
<?php 
    if (@intval(substr($spiel_extend,1,1))==1) {
        $gefundene_KI_spieler = array();
        include("../extend/ki/ki_basis/spielerAuswahlKI.php");
    }
    for ($k=1;$k<11;$k++) { ?>
        <tr>
          <td style="color:<?php echo $spielerfarbe[$k];?>;"><select name="user_<?php echo $k;?>">
             <option value="0" style="background-color:<?php echo $spielerfarbe[$k]; ?>;"><?php echo $lang['admin']['spiel']['alpha']['leer_slot']?></option>
<?php 
   if (@intval(substr($spiel_extend,1,1))==1) $gefundene_KIs = array();
   for ($n=0;$n<$useranzahl;$n++) {
   $ok = @mysql_data_seek($zeiger,$n);
   $array = @mysql_fetch_array($zeiger);
   $uid=$array["id"];
   $nick=$array["nick"];
   if (@intval(substr($spiel_extend,1,1))==1) {
        $ergebnis = filterKI($gefundene_KI_spieler, $gefundene_KIs, $nick, $uid);
        $gefundene_KI_spieler = $ergebnis['ki_spieler'];
        $gefundene_KIs = $ergebnis['kis'];
        if($ergebnis['continue']) continue;
   }   
   ?>
     <option value="<?php echo $uid;?>" style="background-color:<?php echo $spielerfarbe[$k];?>;"><?php echo $nick;?></option>
<?php } ?>
   </select></td>
          <td>&nbsp;</td>
          <td><select name="rasse_<?php echo $k; ?>">
<?php for ($n=0;$n<$zaehler;$n++) { ?>
     <option value="<?php echo $filename[$n]; ?>" style="background-color:<?php echo $spielerfarbe[$k]; ?>;"><?php echo $daten[$n][0]; ?></option>
<?php } ?>
          </select></td>
          <td>&nbsp;</td>
          <td><input type="radio" name="spieler_admin" value="<?php echo $k; ?>"></td>
<?php if (int_post('siegbedingungen')==6) {  ?>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
   <td><center><input type="radio" name="team<?php echo $k; ?>" value="1"></center></td>
   <td>&nbsp;</td>
   <td><center><input type="radio" name="team<?php echo $k; ?>" value="2"></center></td>
   <td>&nbsp;</td>
   <td><center><input type="radio" name="team<?php echo $k; ?>" value="3"></center></td>
   <td>&nbsp;</td>
   <td><center><input type="radio" name="team<?php echo $k; ?>" value="4"></center></td>
   <td>&nbsp;</td>
   <td><center><input type="radio" name="team<?php echo $k; ?>" value="5"></center></td>
   <td>&nbsp;</td>
   <td><center><input type="radio" name="team<?php echo $k; ?>" value="0" checked></center></td>
<?php } ?>
        </tr>
<?php } ?>
   <tr>
   <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
   <td><table border="0" cellspacing="0" cellpadding="0"><tr><td><input type="radio" name="spieler_admin" value="0" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['niemand']?></td></tr></table></td>
   </tr>
</table></center>
           <br>
<center><table border="0" cellspacing="0" cellpadding="0"><tr>
<td><input type="submit" name="bla" value="<?php echo str_replace('{1}',5,$lang['admin']['spiel']['alpha']['weiter_'])?>"></td><td></form></td>
</tr></table></center>
<?php
 } include ("inc.footer.php");
 }
if ($fuid==2) {
include ("inc.header.php");
?>
<body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)"><?php echo $lang['admin']['spiel']['alpha']['neues_spiel']?></td></tr></table></center>
<form name="formular" method="post" action="spiel_alpha.php?fu=3">
<?php
foreach ($_POST as $key => $value) {
    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
}
?>
<center><table border="0" cellspacing="0" cellpadding="2">
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['startpositionen']['wie']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td><input type="radio" name="startposition" value="1" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['startpositionen']['vorg']?></td></tr>
      <tr><td><input type="radio" name="startposition" value="2"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['startpositionen']['zufl']?></td></tr>
      <tr><td><input type="radio" name="startposition" value="3"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['startpositionen']['admin']?></td></tr>
     </table></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['groesse']['welche']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <?php /* ?>
      <tr><td><input type="radio" name="imperiumgroesse" value="1"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['groesse']['1']?></td></tr>
      <?php */ ?>
      <tr><td><input type="radio" name="imperiumgroesse" value="2" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['groesse']['2']?></td></tr>
      <?php /* ?>
      <tr><td><input type="radio" name="imperiumgroesse" value="3"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['groesse']['3']?></td></tr>
      <?php */ ?>
      <tr><td><input type="radio" name="imperiumgroesse" value="4"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['groesse']['4']?></td></tr>
      <?php /* ?>
      <tr><td><input type="radio" name="imperiumgroesse" value="5"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['groesse']['5']?></td></tr>
      <tr><td><input type="radio" name="imperiumgroesse" value="6"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['groesse']['6']?></td></tr>
      <?php */ ?>
   </table></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['ausscheiden']['wann']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
   <tr><td><input type="radio" name="out" value="3" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['ausscheiden']['1']?></td></tr>
   <tr><td><input type="radio" name="out" value="2"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['ausscheiden']['2']?></td></tr>
   <tr><td><input type="radio" name="out" value="1"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['ausscheiden']['3']?></td></tr>
      <tr><td><input type="radio" name="out" value="0"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['ausscheiden']['4']?></td></tr>
      </table></td></tr>
</table></center>
<br><br>
<center><table border="0" cellspacing="0" cellpadding="0"><tr>
<td><input type="submit" name="bla" value="<?php echo str_replace('{1}',4,$lang['admin']['spiel']['alpha']['weiter_'])?>"></td><td></form></td>
</tr></table></center><br>
<?php
include ("inc.footer.php");
 }
if ($fuid==4) {
include ("inc.header.php");
if ((int_get('startposset') != 1) and (int_post('startposition') == 3)) {
?>
<script type="text/javascript">
    function check () {
        for (n=0;n<document.formular.active.length;n++) {
            feldnamex = 'user_' + document.formular.active[n].value + '_xx';
            if (document.getElementById(feldnamex).value == '') {
                alert ('<?php echo html_entity_decode($lang['admin']['spiel']['alpha']['jeder_startposition'])?>');
                return false;
            }
        }
        return true;
    }
</script>
<body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <center><table border="0" cellspacing="0" cellpadding="4"><tr><td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)"><?php echo $lang['admin']['spiel']['alpha']['neues_spiel']?></td></tr></table></center>
    <form name="formular" method="post" action="spiel_alpha.php?fu=4&startposset=1" onSubmit="return check();">
<?php
foreach ($_POST as $key => $value) {
    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
}
?>
  <center>
    <table border="0" cellspacing="0" cellpadding="2">
      <tr><td><?php echo $lang['admin']['spiel']['alpha']['wo_startposition']?></td><td><img src="../bilder/empty.gif" width="220" height="1"></td></tr>
      <tr><td>&nbsp;</td><td></td></tr>
      <tr>
        <td valign="top">
          <table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="3"><img src="../bilder/aufbau/galaoben.gif" border="0" width="258" height="4"></td>
            </tr>
            <tr>
              <td><img src="../bilder/aufbau/galalinks.gif" border="0" width="4" height="250"></td>
              <td><iframe src="spiel_alpha.php?fu=12&struktur=<?php echo str_post('struktur','SHORTNAME'); ?>" width="250" height="250" name="map" scrolling="no" marginheight="0" marginwidth="0" frameborder="0"></iframe></td>
              <td><img src="../bilder/aufbau/galarechts.gif" border="0" width="4" height="250"></td>
            </tr>
            <tr>
              <td colspan="3"><img src="../bilder/aufbau/galaunten.gif" border="0" width="258" height="4"></td>
            </tr>
          </table>
        </td>
        <td valign="top">
          <table border="0" cellspacing="0" cellpadding="2">
            <?php
              $first = 0;
              for ($n=1;$n<=10;$n++) {
                if (int_post('user_'.$n) >= 1) {
                   $zeiger_temp = @mysql_query("SELECT * FROM $skrupel_user where id = ".int_post('user_'.$n));
                   $array_temp = @mysql_fetch_array($zeiger_temp);
                   echo '<tr><td><input type="radio" name="active" id="active" value="'.$n.'" ';
                   if ($first == 0) {
                     $first = 1;
                      echo 'checked';
                   }
                   echo '></td><td>&nbsp;</td><td style="color:'.$spielerfarbe[$n].';">';
                   echo $array_temp["nick"].'</td><td><input type="hidden" name="user_'.$n.'_x" id="user_'.$n.'_xx" value=""><input type="hidden" name="user_'.$n.'_y" id="user_'.$n.'_yy" value=""></td></tr>';
                }
              }
            ?>
          </table>
        </td>
      </tr>
    </table>
  </center>
  <br/>
  <center>
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input type="submit" name="bla" value="Weiter"></td><td></form></td>
      </tr>
    </table>
  </center>
<?php
} else {
?>
<body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)"><?php echo $lang['admin']['spiel']['alpha']['neues_spiel']?></td></tr></table></center>
<form name="formular" method="post" action="spiel_alpha.php?fu=5">
<?php
foreach ($_POST as $key => $value) {
    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
}
?>
<center><table border="0" cellspacing="0" cellpadding="2">
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['cantox']['wieviel']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td><input type="radio" name="geldmittel" value="15000"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['cantox']['1']?></td></tr>
      <tr><td><input type="radio" name="geldmittel" value="5000"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['cantox']['2']?></td></tr>
      <tr><td><input type="radio" name="geldmittel" value="3500" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['cantox']['3']?></td></tr>
      <tr><td><input type="radio" name="geldmittel" value="1000"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['cantox']['4']?></td></tr>
  </table></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['res']['wieviel']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td><input type="radio" name="mineralienhome" value="1"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['res']['1']?></td></tr>
      <tr><td><input type="radio" name="mineralienhome" value="2" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['res']['2']?></td></tr>
      <tr><td><input type="radio" name="mineralienhome" value="3"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['res']['3']?></td></tr>
      <tr><td><input type="radio" name="mineralienhome" value="4"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['res']['4']?></td></tr>
  </table></td></tr>
   <tr><td>&nbsp;</td></tr>
</table></center>
<center><table border="0" cellspacing="0" cellpadding="0"><tr>
<td><input type="submit" name="bla" value="<?php echo str_replace('{1}',6,$lang['admin']['spiel']['alpha']['weiter_'])?>"></td><td></form></td>
</tr></table></center>
<?php
}
include ("inc.footer.php");
 }
if ($fuid==5) {
include ("inc.header.php");
?>
<body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)"><?php echo $lang['admin']['spiel']['alpha']['neues_spiel']?></td></tr></table></center>
<form name="formular" method="post" action="spiel_alpha.php?fu=6">
<?php
foreach ($_POST as $key => $value) {
    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
}
?>
<center><table border="0" cellspacing="0" cellpadding="2">
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['welche']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input type="radio" name="umfang" value="1000"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['a']['1']?></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input type="radio" name="umfang" value="3000"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['a']['5']?></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input type="radio" name="sternendichte" value="400" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['b']['1']?></td>
      </tr>
      <tr>
        <td><input type="radio" name="umfang" value="1500"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['a']['2']?></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input type="radio" name="umfang" value="3500"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['a']['6']?></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input type="radio" name="sternendichte" value="300"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['b']['2']?></td>
      </tr>
     <tr>
        <td><input type="radio" name="umfang" value="2000"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['a']['3']?></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input type="radio" name="umfang" value="4000"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['a']['7']?></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input type="radio" name="sternendichte" value="200"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['b']['3']?></td>
     </tr>
     <tr>
        <td><input type="radio" name="umfang" value="2500" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['a']['4']?></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input type="radio" name="umfang" value="4500"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['a']['8']?></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input type="radio" name="sternendichte" value="100"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['umfang_dicht']['b']['4']?></td>
     </tr>
 </table></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['res_n_hq']['wieviel']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td><input type="radio" name="mineralien" value="1"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['res_n_hq']['1']?></td><td>&nbsp;&nbsp;</td><td><input type="radio" name="leminvorkommen" value="3"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['res_n_hq']['5']?></td></tr>
      <tr><td><input type="radio" name="mineralien" value="2"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['res_n_hq']['2']?></td><td>&nbsp;&nbsp;</td><td><input type="radio" name="leminvorkommen" value="2" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['res_n_hq']['6']?></td></tr>
      <tr><td><input type="radio" name="mineralien" value="3" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['res_n_hq']['3']?></td><td>&nbsp;&nbsp;</td><td><input type="radio" name="leminvorkommen" value="1"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['res_n_hq']['7']?></td></tr>
      <tr><td><input type="radio" name="mineralien" value="4"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['res_n_hq']['4']?></td><td></td><td></td><td></td><td></td></tr>
  </table></td></tr>
   <tr><td>&nbsp;</td></tr>
</table></center>
<center><table border="0" cellspacing="0" cellpadding="0"><tr>
<td><input type="submit" name="bla" value="<?php echo str_replace('{1}',7,$lang['admin']['spiel']['alpha']['weiter_'])?>"></td><td></form></td>
</tr></table></center>
<?php
include ("inc.footer.php");
 }
if ($fuid==6) {
include ("inc.header.php");
?>
<body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)"><?php echo $lang['admin']['spiel']['alpha']['neues_spiel']?></td></tr></table></center>
<form name="formular" method="post" action="spiel_alpha.php?fu=7">
<?php
foreach ($_POST as $key => $value) {
    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
}
?>
<center><table border="0" cellspacing="0" cellpadding="2">
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['ds']['wie']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td><input type="radio" name="spezien" value="0"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['ds']['1']?></td></tr>
      <tr><td><input type="radio" name="spezien" value="25"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['ds']['2']?></td></tr>
      <tr><td><input type="radio" name="spezien" value="50" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['ds']['3']?></td></tr>
      <tr><td><input type="radio" name="spezien" value="75"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['ds']['4']?></td></tr>
      <tr><td><input type="radio" name="spezien" value="100"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['ds']['5']?></td></tr>
  </table></td></tr>
    <tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['plasmasturm_frage']['1']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['plasmasturm_frage']['2']?></td><td>&nbsp;</td><td><select name="max" style="width:100px;">
    <option value="0">0</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5" selected>5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    </select></td></tr>
      <tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['plasmasturm_frage']['3']?></td><td>&nbsp;</td><td><select name="wahr" style="width:100px;">
  <?php for($p=1;$p<21;$p++){ ?>
    <option value="<?php echo $prozentarray[$p]?>"><?php echo str_replace('{1}',$prozentarray[$p],$lang['admin']['spiel']['alpha']['vh']);?></option>
  <?php } ?>
    </select></td></tr>
      <tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['plasmasturm_frage']['4']?></td><td>&nbsp;</td><td><select name="lang" style="width:100px;">
  <?php for($p=3;$p<13;$p++){ ?>
    <option value="<?php echo $prozentarray[$p]?>"><?php echo str_replace('{1}',$prozentarray[$p],$lang['admin']['spiel']['alpha']['runden']);?></option>
  <?php } ?>
    </select></td></tr>
      </table></td></tr>
   <tr><td>&nbsp;</td></tr>
</table></center>
<center><table border="0" cellspacing="0" cellpadding="0"><tr>
<td><input type="submit" name="bla" value="<?php echo str_replace('{1}',8,$lang['admin']['spiel']['alpha']['weiter_'])?>"></td><td></form></td>
</tr></table></center>
<?php
include ("inc.footer.php");
 }
if ($fuid==7) {
include ("inc.header.php");
?>
<body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)"><?php echo $lang['admin']['spiel']['alpha']['neues_spiel']?></td></tr></table></center>
<form name="formular" method="post" action="spiel_alpha.php?fu=8">
<?php
foreach ($_POST as $key => $value) {
    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
}
?>
<center><table border="0" cellspacing="0" cellpadding="2">
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['wurmloch_frage']['1']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td><input type="radio" name="instabil" value="0" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;">00</td><td>&nbsp;</td><td><input type="radio" name="instabil" value="2"></td><td>&nbsp;</td><td style="color:#aaaaaa;">02</td><td>&nbsp;</td><td><input type="radio" name="instabil" value="10"></td><td>&nbsp;</td><td style="color:#aaaaaa;">10</td><td>&nbsp;</td><td><input type="radio" name="instabil" value="30"></td><td>&nbsp;</td><td style="color:#aaaaaa;">30</td></tr>
      <tr><td><input type="radio" name="instabil" value="1"></td><td>&nbsp;</td><td style="color:#aaaaaa;">01</td><td>&nbsp;</td><td><input type="radio" name="instabil" value="5"></td><td>&nbsp;</td><td style="color:#aaaaaa;">05</td><td>&nbsp;</td><td><input type="radio" name="instabil" value="20"></td><td>&nbsp;</td><td style="color:#aaaaaa;">20</td><td>&nbsp;</td><td><input type="radio" name="instabil" value="50"></td><td>&nbsp;</td><td style="color:#aaaaaa;">50</td></tr>
 </table></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['wurmloch_frage']['2']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td><input type="radio" name="stabil" value="0" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['1']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="1"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['2']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="2"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['3']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="3"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['4']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="4"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['5']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="5"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['6']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="6"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['7']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="7"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['8']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="8"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['9']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="9"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['10']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="10"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['11']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="11"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['12']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="12"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['13']?></td></tr>
      <tr><td><input type="radio" name="stabil" value="13"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['wurmloch_stabil']['14']?></td></tr>
  </table></td></tr>
       <tr><td>&nbsp;</td></tr>
</table></center>
<center><table border="0" cellspacing="0" cellpadding="0"><tr>
<td><input type="submit" name="bla" value="<?php echo str_replace('{1}',9,$lang['admin']['spiel']['alpha']['weiter_'])?>"></td><td></form></td>
</tr></table></center>
<?php
include ("inc.footer.php");
 }
if ($fuid==8) {
include ("inc.header.php");
?>
<body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)"><?php echo $lang['admin']['spiel']['alpha']['neues_spiel']?></td></tr></table></center>
<form name="formular" method="post" action="spiel_alpha.php?fu=11">
<?php
foreach ($_POST as $key => $value) {
    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
}
?>
<center><table border="0" cellspacing="0" cellpadding="2">
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['nebel']['wie']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td><input type="radio" name="nebel" value="0"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['nebel']['1']?></td></tr>
      <tr><td><input type="radio" name="nebel" value="1"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['nebel']['2']?></td></tr>
      <tr><td><input type="radio" name="nebel" value="2"></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['nebel']['3']?></td></tr>
      <tr><td><input type="radio" name="nebel" value="3" checked></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['nebel']['4']?></td></tr>
     </table></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['spiel']['alpha']['raumpiratenfrage']['1']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['raumpiratenfrage']['2']?></td><td>&nbsp;</td><td><select name="piraten_mitte" style="width:60px;">
  <?php for($p=0;$p<21;$p++){ ?>
    <option value="<?php echo $prozentarray[$p]?>"><?php echo str_replace('{1}',$prozentarray[$p],$lang['admin']['spiel']['alpha']['vh']);?></option>
  <?php } ?>
    </select></td></tr>
      <tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['raumpiratenfrage']['3']?></td><td>&nbsp;</td><td><select name="piraten_aussen" style="width:60px;">
  <?php for($p=0;$p<21;$p++){ ?>
    <option value="<?php echo $prozentarray[$p]?>"><?php echo str_replace('{1}',$prozentarray[$p],$lang['admin']['spiel']['alpha']['vh']);?></option>
  <?php } ?>
    </select></td></tr>
      <tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['raumpiratenfrage']['4']?></td><td>&nbsp;</td><td><select name="piraten_min" style="width:60px;">
  <?php for($p=1;$p<21;$p++){ ?>
    <option value="<?php echo $prozentarray[$p]?>"><?php echo str_replace('{1}',$prozentarray[$p],$lang['admin']['spiel']['alpha']['vh']);?></option>
  <?php } ?>
    </select></td></tr>
      <tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['alpha']['raumpiratenfrage']['5']?></td><td>&nbsp;</td><td><select name="piraten_max" style="width:60px;">
  <?php for($p=1;$p<21;$p++){ ?>
    <option value="<?php echo $prozentarray[$p]?>"><?php echo str_replace('{1}',$prozentarray[$p],$lang['admin']['spiel']['alpha']['vh']);?></option>
  <?php } ?>
    </select></td></tr>
      </table></td></tr>
    <tr><td>&nbsp;</td></tr>
</table></center>
<center><table border="0" cellspacing="0" cellpadding="0"><tr>
<td><input type="submit" name="bla" value="<?php echo $lang['admin']['spiel']['alpha']['erstellen']?>"></td><td></form></td>
</tr></table></center>
<?php
include ("inc.footer.php");
 }
if ($fuid==12) {
include ("inc.header.php");
?>
<script type="text/javascript">
function auswahl(xx, yy) {
    if(typeof(parent.document.formular.active.length) !== 'undefined') {
        for (n=0;n<parent.document.formular.active.length;n++) {
            if (parent.document.formular.active[n].checked) { 
                feldnamex = 'user_' + parent.document.formular.active[n].value + '_xx';
                feldnamey = 'user_' + parent.document.formular.active[n].value + '_yy';
                parent.document.getElementById(feldnamex).value = xx;
                parent.document.getElementById(feldnamey).value = yy;
                elementname = 'start_' + parent.document.formular.active[n].value;
                element = document.getElementById(elementname);
                element.style.top = (yy*2.5)-3.5;
                element.style.left = (xx*2.5)-3.5;
            }
        }
    } else {
        feldnamex = 'user_' + parent.document.formular.active.value + '_xx';
        feldnamey = 'user_' + parent.document.formular.active.value + '_yy';
        parent.document.getElementById(feldnamex).value = xx;
        parent.document.getElementById(feldnamey).value = yy;
        elementname = 'start_' + parent.document.formular.active.value;
        element = document.getElementById(elementname);
        element.style.top = (yy*2.5)-3.5;
        element.style.left = (xx*2.5)-3.5;
    }
}
var IE = document.all?true:false;
var NS = (!document.all && document.getElementById)?true:false;
if (!IE && !NS) {
    document.captureEvents(Event.MOUSEMOVE);
}
document.onmousemove = getMouseXY;
var tempX = 0;
var tempY = 0;
function getMouseXY(e) {
  if (IE) {
    tempXX = event.clientX + document.body.scrollLeft;
    tempYY = event.clientY + document.body.scrollTop;
  } else {
    tempXX = e.pageX;
    tempYY = e.pageY;
  }
  if (tempXX!=tempX) {
  tempX=tempXX;
  tempY=tempYY;
  if (tempX < 0){tempX = 0;}
  if (tempY < 0){tempY = 0;;}
  }
}
</script>
<body text="#ffffff" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div id="galastruktur" style="z-index:1;position: absolute; left:0px; top:0px; width: 250px; height: 250px;">
    <img src="../daten/bilder_galaxien/<?php echo str_get('struktur','SHORTNAME'); ?>.png" width="250" height="250">
</div>
<div id="stars" style="z-index:2;position: absolute; left:0px; top:0px; width: 250px; height: 250px;">
    <img src="../bilder/admin/gala_stars_big.gif" width="250" height="250" border="0">
</div>
<div id="empty" style="z-index:4;position: absolute; left:0px; top:0px; width: 250px; height: 250px;">
    <a href="#" onclick="auswahl(tempX/2.5, tempY/2.5);" style="cursor:crosshair;"><img src="../bilder/empty.gif" width="250" height="250" border="0"></a>
</div>
<?php
for ($n=1;$n<11;$n++) {
    echo '<div id="start_'.$n.'" style="z-index:3;position: absolute; left:-1000px; top:-1000px; width: 7px; height: 7px;">';
    echo '<img src="../bilder/karte/farben/schiff_5_'.$n.'.gif" width="7" height="7" border="0">';
    echo '</div>';
}
?>
<?php
include ("inc.footer.php");
 }
if ($fuid==11) {
include ("inc.header.php");
?>
<body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)"><?php echo $lang['admin']['spiel']['alpha']['neues_spiel']?></td></tr></table></center>
<form name="formular" id="formular" method="post" action="spiel_alpha.php?fu=9">
<?php
foreach ($_POST as $key => $value) {
    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
}
?>
<br><br><br><br><br>
<center>
<img src="../bilder/radd.gif" height="46" width="51"><br><br>
<?php echo $lang['admin']['spiel']['alpha']['geduld']?>
</center>
</form>
<script language=JavaScript>
  document.getElementById('formular').submit();
 </script>
<?php
include ("inc.footer.php");
 }
if ($fuid==9) {
include ("inc.header.php");
if (($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)) {
srand((double)microtime()*1000000);
/*function rannum() {
    mt_srand((double)microtime()*1000000);
    $num = mt_rand(48,122);
    return $num;
}
function genchr() {
    do {
        $num = rrannum();
    } while ( ( $num > 57 && $num < 65 ) || ( $num > 90 && $num < 97 ) );
    return chr($num);
}
function zufallstring() {
    $a = rgenchr();$e = rgenchr();$i = rgenchr();$m = rgenchr();$q = rgenchr();
    $b = rgenchr();$f = rgenchr();$j = rgenchr();$n = rgenchr();$r = rgenchr();
    $c = rgenchr();$g = rgenchr();$k = rgenchr();$o = rgenchr();$s = rgenchr();
    $d = rgenchr();$h = rgenchr();$l = rgenchr();$p = rgenchr();$t = rgenchr();
    $salt = "$a$b$c$d$e$f$g$h$i$j$k$l$m$n$o$p$q$r$s$t";
    return $salt;
}

define('ONLY_LETTERS',0);
define('WITH_NUMBERS', 1);
define('WITH_SPECIAL_CHARACTERS', 2);
function zufallstring($size = 20, $url = ONLY_LETTERS){
  mt_srand();
  $pool = 'abcdefghijklmnopqrstuvwxyz';
  $pool .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  if($url & WITH_SPECIAL_CHARACTERS){
    $pool .= ',.-;:_#+*~!§$%&/()=?';
  }
  if($url & WITH_NUMBERS){
    $pool .='0123456789';
  }
  $pool_size = strlen($pool);
  $salt ='';
  for($i = 0;$i<$size; $i++){
    $salt .= $pool[mt_rand(0, $pool_size - 1)];
  }
  return $salt; 
}*/
//////////////////////////////////////
  $zeiger = @mysql_query("SELECT extend,serial FROM $skrupel_info");
  $array = @mysql_fetch_array($zeiger);
  $spiel_extend=$array["extend"];
  $spiel_serial=$array["serial"];
//////////////////////////////////////
$sid=zufallstring();
$spielname=str_post('spiel_name','SQLSAFE');
   //$spielname=str_replace("'"," ",$spielname);
   //$spielname=str_replace('"'," ",$spielname);
$ziel_id=int_post('siegbedingungen');
$umfang=int_post('umfang');
$struktur=str_post('struktur','SHORTNAME');
$piraten_mitte=int_post('piraten_mitte');
$piraten_aussen=int_post('piraten_aussen');
$piraten_min=int_post('piraten_min');
$piraten_max=int_post('piraten_max');
$out=int_post('out');
if ($ziel_id==6) {
 $team[1]=int_post('team1');
 $team[2]=int_post('team2');
 $team[3]=int_post('team3');
 $team[4]=int_post('team4');
 $team[5]=int_post('team5');
 $team[6]=int_post('team6');
 $team[7]=int_post('team7');
 $team[8]=int_post('team8');
 $team[9]=int_post('team9');
 $team[10]=int_post('team10');
}
$module = array();
$module[0] = int_post('modul_0');
$module[1] = 0;
$module[2] = int_post('modul_2');
$module[3] = int_post('modul_3');
$module[4] = int_post('modul_4');
$module[5] = int_post('modul_5');
$module[6] = int_post('modul_6');
$module = @implode(":", $module);
$zeiger = @mysql_query("INSERT INTO $skrupel_spiele (sid,name,module,oput) values ('$sid','$spielname','$module',$out)");
$zeiger = @mysql_query("SELECT id,sid FROM $skrupel_spiele where sid='$sid'");
$array = @mysql_fetch_array($zeiger);
$spiel=$array["id"];
$aufloesung=50;
$daten_verzeichnis="../daten/";
$handle=opendir("$daten_verzeichnis");
while ($rasse=readdir($handle)) {
  $file=$daten_verzeichnis.$rasse.'/daten.txt';
  //if ((substr($rasse,0,1)<>'.') and (substr($rasse,0,7)<>'bilder_') and (substr($rasse,strlen($rasse)-4,4)<>'.txt')) {
  if(is_dir($daten_verzeichnis.$rasse) && is_file($file)){
    $daten=array();
    $attribute="";
    $fp = @fopen("$file","r");
    if ($fp) {
      $zaehler2=0;
      while (!feof ($fp)) {
        $buffer = @fgets($fp, 4096);
        $daten[$zaehler2]=$buffer;
        $zaehler2++;
      }
      @fclose($fp); 
      $namerassen[$rasse]=trim($daten[0]);
      $nameplanet[$rasse]=trim($daten[5]);
    }
  }
}
///////////////////////////////////////////////////SPEZIEN
$speziena=0;
if (int_post('spezien')>=1) {
$file='../daten/dom_spezien.txt';
$fp = @fopen("$file","r");
if ($fp) {
while (!feof ($fp)) {
    $buffer = @fgets($fp, 4096);
    $ur[$speziena]=explode(":",$buffer);
    $speziena++;
}
@fclose($fp); }
$file='../daten/dom_spezien_art.txt';
$fp = @fopen("$file","r");
if ($fp) {
while (!feof ($fp)) {
    $buffer = @fgets($fp, 4096);
    $art_b=explode(":",$buffer);
    $art[$art_b[0]]=$art_b[1];
}
@fclose($fp); }
}
////////////////////////////////////////////////////FAVPLANETEN ANFANG
$daten_verzeichnis="../daten/";
$handle=opendir("$daten_verzeichnis");
while ($rasses=readdir($handle)) {
   if ((substr($rasses,0,1)<>'.') and (substr($rasses,0,7)<>'bilder_') and (substr($rasses,strlen($rasses)-4,4)<>'.txt')) {
$daten="";
$attribute="";
$file=$daten_verzeichnis.$rasses.'/daten.txt';
$fp = @fopen("$file","r");
if ($fp) {
$zaehler2=0;
while (!feof ($fp)) {
    $buffer = @fgets($fp, 4096);
    $daten[$zaehler2]=$buffer;
    $zaehler2++;
}
@fclose($fp); }
$attribute=explode(":",$daten[3]);
$r_eigenschaften[$rasses]['temperatur']=$attribute[0];
$r_eigenschaften[$rasses]['planet']=$attribute[1];
}}
////////////////////////////////////////////////////FAVPLANETEN ENDE
///////////////////////////////////////////////ERLAUBTE BEREICHE
$file='../daten/bilder_galaxien/'.$struktur.'.txt';
$fp = @fopen("$file","r");
if ($fp) {
$zaehler=0;
while (!feof ($fp)) {
    $buffer = @fgets($fp, 4096);
    $raum[$zaehler]=trim($buffer);
    //echo  $raum[$zaehler];
    $zaehler++;
}
@fclose($fp); }
///////////////////////////////////////////////PLANETEN GENRERIEREN ANFANG
$planetenname=@file('../daten/planetennamen.txt');
shuffle($planetenname);
$sternendichte=int_post('sternendichte');
$startposition=int_post('startposition');
for ($i=0;$i<$sternendichte;$i++) {
//for ($i=0;$i<50;$i++) {
  $ok=1;
  $full_zahl=0;
  while ($ok==1) {
  $oke=1;
  while ($oke==1) {
    $x=rand(50,$umfang-51);
    $y=rand(50,$umfang-51);
    $test_x=round($x*50/$umfang);
    $test_y=round($y*50/$umfang);
    if ($raum[$test_y][$test_x]==1) { $oke=2; }
  }
  //echo $raum[$test_y][$test_x].":".$test_x.":".$test_y."<br>";
  $oben=$y-55;
  $unten=$y+55;
  $links=$x-55;
  $rechts=$x+55;
    $ok=2;
    $nachbarn=0;
    $zeiger2 = @mysql_query("SELECT count(*) as total from $skrupel_planeten where x_pos>$links and x_pos<$rechts and y_pos>$oben and y_pos<$unten and spiel=$spiel");
    $array = @mysql_fetch_array($zeiger2);
    $nachbarn=$array["total"];
    if ($nachbarn>=1) {
     $ok=1;$full_zahl++;
     if ($full_zahl>=35) { break 2; }
    }
  }
  $name=trim($planetenname[$i]);
  $name = preg_replace("/\r\n|\n\r|\n|\r/", "", $name);
  $klasse=rand(1,9);
  if ($klasse==1) { $bild=rand(1,9);$temp=rand(40,60); }  //Klasse M wie Erde
  if ($klasse==2) { $bild=rand(1,24);$temp=rand(30,50);}  //Klasse N Wasserwelt
  if ($klasse==3) { $bild=rand(1,16);$temp=rand(0,10);}  //Klasse J wie Luna
  if ($klasse==4) { $bild=rand(1,14);$temp=rand(50,75); }  //Klasse L warm nur wenig Wasseroberflaeche
  if ($klasse==5) { $bild=rand(1,11);$temp=rand(86,100); }  //Klasse G Wuestenplanet
  if ($klasse==6) { $bild=rand(1,22);$temp=rand(70,95); }  //Klasse I Heiss giftige Gase
  if ($klasse==7) { $bild=rand(1,13);$temp=rand(75,90); }   //Klasse C Heiss wie Venus
  if ($klasse==8) { $bild=rand(1,33);$temp=rand(20,35); }  //Klasse K wie Mars
  if ($klasse==9) { $bild=rand(1,9);$temp=rand(25,45); }    //Klasse F jung zerklueftet
  $lemin=rand(1,70);
  $min1=rand(1,70);
  $min2=rand(1,70);
  $min3=rand(1,70);
  if (int_post('mineralien')==1) { $minrand=1000;$maxrand=7000; }
  if (int_post('mineralien')==2) { $minrand=800;$maxrand=5000; }
  if (int_post('mineralien')==3) { $minrand=500;$maxrand=3500; }
  if (int_post('mineralien')==4) { $minrand=100;$maxrand=1500; }
  $rohstoff=rand($minrand,$maxrand);
  $rohstoffe[0]=rand(0,$rohstoff);
  $rohstoffe[1]=rand(0,($rohstoff-$rohstoffe[0]));
  $rohstoffe[2]=rand(0,($rohstoff-$rohstoffe[0]-$rohstoffe[1]));
  $rohstoffe[3]=($rohstoff-$rohstoffe[0]-$rohstoffe[1]-$rohstoffe[2]);
  shuffle($rohstoffe);
  $planet_lemin=$rohstoffe[0];
  $planet_min1=$rohstoffe[1];
  $planet_min2=$rohstoffe[2];
  $planet_min3=$rohstoffe[3];
  $konz_lemin=rand(1,5);
  $konz_min1=rand(1,5);
  $konz_min2=rand(1,5);
  $konz_min3=rand(1,5);
  if (int_post('leminvorkommen')==2) {
     $zulemin=(rand(25,50)+100)/100;
     $planet_lemin=round($planet_lemin*$zulemin);
     $zulemin=(rand(25,50)+100)/100;
     $lemin=round($lemin*$zulemin);
  }
  if (int_post('leminvorkommen')==3) {
     $zulemin=(rand(50,100)+100)/100;
     $planet_lemin=round($planet_lemin*$zulemin);
     $zulemin=(rand(50,100)+100)/100;
     $lemin=round($lemin*$zulemin);
  }
  $artefakt = rand(1,100);
  if ($artefakt>6) {$artefakt=0;}
  $native_id=0;
  $native_name ='';
  $native_art=0;
  $native_art_name='';
  $native_abgabe=0;
  $native_bild='';
  $native_text='';
  $native_fert='';
  $native_kol=0;
if (int_post('spezien')>=1) {
   $zufall=rand(1,100);
   if ($zufall<=int_post('spezien')) {
      $zufall_art=rand(0,$speziena-1);
  $native_id=$ur[$zufall_art][1];
  $native_name=$lang['admin']['spiel']['alpha']['spezien'][$ur[$zufall_art][1]]['name'];
  $native_art=$ur[$zufall_art][3];
  $bla=$ur[$zufall_art][3];
  $native_art_name=trim($art[$bla]);
  $native_abgabe=$ur[$zufall_art][4];
  $native_bild=$ur[$zufall_art][2];
  $native_text=trim($lang['admin']['spiel']['alpha']['spezien'][$ur[$zufall_art][1]]['effekt']);
  $native_fert=$ur[$zufall_art][5];
  $native_kol=(rand(2000,17500));
   }
}
  $slots=rand(1,6);
  $zeiger = mysql_query("INSERT into $skrupel_planeten (osys_anzahl,native_id,native_name,native_art,native_art_name,native_abgabe,native_bild,native_text,native_fert,native_kol,name,x_pos,y_pos,klasse,bild,temp,lemin,min1,min2,min3,planet_lemin,planet_min1,planet_min2,planet_min3,konz_lemin,konz_min1,konz_min2,konz_min3,spiel,artefakt) values ($slots,$native_id,'$native_name',$native_art,'$native_art_name',$native_abgabe,'$native_bild','$native_text','$native_fert',$native_kol,'$name',$x,$y,$klasse,$bild,$temp,$lemin,$min1,$min2,$min3,$planet_lemin,$planet_min1,$planet_min2,$planet_min3,$konz_lemin,$konz_min1,$konz_min2,$konz_min3,$spiel,$artefakt)");
}
///////////////////////////////////////////////PLANETEN GENRERIEREN ENDE
////////////////////////////////////////////////WER SPIELT MIT
$spieleranzahl=0;
if (int_post('user_1')>=1) { $spieleranzahl++;$spieler[1][0]=int_post('user_1');$spieler[1][1]=str_post('rasse_1','SHORTNAME'); } else { $spieler[1][0]=0;$spieler[1][1]=''; }
if (int_post('user_2')>=1) { $spieleranzahl++;$spieler[2][0]=int_post('user_2');$spieler[2][1]=str_post('rasse_2','SHORTNAME'); } else { $spieler[2][0]=0;$spieler[2][1]=''; }
if (int_post('user_3')>=1) { $spieleranzahl++;$spieler[3][0]=int_post('user_3');$spieler[3][1]=str_post('rasse_3','SHORTNAME'); } else { $spieler[3][0]=0;$spieler[3][1]=''; }
if (int_post('user_4')>=1) { $spieleranzahl++;$spieler[4][0]=int_post('user_4');$spieler[4][1]=str_post('rasse_4','SHORTNAME'); } else { $spieler[4][0]=0;$spieler[4][1]=''; }
if (int_post('user_5')>=1) { $spieleranzahl++;$spieler[5][0]=int_post('user_5');$spieler[5][1]=str_post('rasse_5','SHORTNAME'); } else { $spieler[5][0]=0;$spieler[5][1]=''; }
if (int_post('user_6')>=1) { $spieleranzahl++;$spieler[6][0]=int_post('user_6');$spieler[6][1]=str_post('rasse_6','SHORTNAME'); } else { $spieler[6][0]=0;$spieler[6][1]=''; }
if (int_post('user_7')>=1) { $spieleranzahl++;$spieler[7][0]=int_post('user_7');$spieler[7][1]=str_post('rasse_7','SHORTNAME'); } else { $spieler[7][0]=0;$spieler[7][1]=''; }
if (int_post('user_8')>=1) { $spieleranzahl++;$spieler[8][0]=int_post('user_8');$spieler[8][1]=str_post('rasse_8','SHORTNAME'); } else { $spieler[8][0]=0;$spieler[8][1]=''; }
if (int_post('user_9')>=1) { $spieleranzahl++;$spieler[9][0]=int_post('user_9');$spieler[9][1]=str_post('rasse_9','SHORTNAME'); } else { $spieler[9][0]=0;$spieler[9][1]=''; }
if (int_post('user_10')>=1) { $spieleranzahl++;$spieler[10][0]=int_post('user_10');$spieler[10][1]=str_post('rasse_10','SHORTNAME'); } else { $spieler[10][0]=0;$spieler[10][1]=''; }
///////////////////////////////////////////////SPIELER AUFBAUEN ANFANG
///////////////////////////////////////////////STARTPOSITIONEN
if ($startposition==1) {
    $file='../daten/gala_strukturen.txt';
    $fp = @fopen("$file","r");
    if ($fp) {
        while (!feof ($fp)) {
            $buffer = @fgets($fp, 4096);
            $strukturdaten=explode(':',$buffer);
            if ($strukturdaten[1]==$struktur) {
               $spieler_koordinaten=trim($strukturdaten[2+$spieleranzahl]);
            }
        }
        @fclose($fp);
    }
    $koordinaten=explode('-',$spieler_koordinaten);
    for ($ker=0;$ker<$spieleranzahl;$ker++) {
        $ko_daten=explode(',',$koordinaten[$ker]);
        $position[$ker]['x']=$ko_daten[0];
        $position[$ker]['y']=$ko_daten[1];
    }
    shuffle($position);
}
if ($startposition==2) {
    for ($ker=0;$ker<$spieleranzahl;$ker++) {
        $oke=1;
        while ($oke==1) {
            $position[$ker]['x']=rand(2,97);
            $position[$ker]['y']=rand(2,97);
            $test_x=round($position[$ker]['x']/2);
            $test_y=round($position[$ker]['y']/2);
            if ($raum[$test_y][$test_x]==1) {
                $oke=2;
            }
        }
    }
}
if (3 == $startposition) {
    for ($kkk=1;$kkk<11;$kkk++) {
        $position[$kkk]['x'] = int_post('user_'.$kkk.'_x');
        $position[$kkk]['y'] = int_post('user_'.$kkk.'_y');
    }
}
$imperiumgroesse = int_post('imperiumgroesse');
if (($imperiumgroesse==1) or ($imperiumgroesse==2) or ($imperiumgroesse==3) or ($imperiumgroesse==4)) {
if ($imperiumgroesse==1) {
}
$iii=0;
for ($i=1;$i<=10;$i++) {
  if ($spieler[$i][0]>=1) {
      $iii++;
      $rasse = $spieler[$i][1];
      $planetenname=$nameplanet[$rasse];
        if ((1 == $startposition) or (2 == $startposition)) {
          $x_pos=round($position[$iii-1]['x']*$umfang/100);
          $y_pos=round($position[$iii-1]['y']*$umfang/100);
        }
        if (3 == $startposition) {
          $x_pos=round($position[$i]['x']*$umfang/100);
          $y_pos=round($position[$i]['y']*$umfang/100);
        }
   $oben=$y_pos-30;
   $unten=$y_pos+30;
   $links=$x_pos-30;
   $rechts=$x_pos+30;
     $zeiger_temp = @mysql_query("delete from $skrupel_planeten where x_pos>$links and x_pos<$rechts and y_pos>$oben and y_pos<$unten and spiel=$spiel");
   $zeiger_temp = mysql_query("INSERT into $skrupel_planeten (name,x_pos,y_pos,spiel) values ('$planetenname',$x_pos,$y_pos,$spiel)");
   $zeiger_temp = @mysql_query("SELECT id FROM $skrupel_planeten where x_pos=$x_pos and y_pos=$y_pos and spiel=$spiel");
   $array = @mysql_fetch_array($zeiger_temp);
   $pid=$array["id"];
  $konz_lemin=rand(4,5);
  $konz_min1=rand(4,5);
  $konz_min2=rand(4,5);
  $konz_min3=rand(4,5);
  $kolonisten=rand(1,1000)+(rand(1,1000)*5)+50000;
  $vorrat=5;
  $minen=5;
  $abwehr=5;
  $fabriken=5;
  $cantox=int_post('geldmittel');
  $lemin=rand(50,70);
  $min1=rand(50,70);
  $min2=rand(50,70);
  $min3=rand(50,70);
  if (int_post('mineralienhome')==1) { $minrand=2000;$maxrand=3000; }
  if (int_post('mineralienhome')==2) { $minrand=1500;$maxrand=2500; }
  if (int_post('mineralienhome')==3) { $minrand=1000;$maxrand=2000; }
  if (int_post('mineralienhome')==4) { $minrand=500;$maxrand=1000; }
  $planet_lemin=rand($minrand,$maxrand);
  $planet_min1=rand($minrand,$maxrand);
  $planet_min2=rand($minrand,$maxrand);
  $planet_min3=rand($minrand,$maxrand);
  $klasse=$r_eigenschaften[$rasse]['planet'];
  if ($klasse==0) { $klasse=rand(1,9); }
  if ($klasse==1) { $bild=rand(1,9);}
  if ($klasse==2) { $bild=rand(1,24);}
  if ($klasse==3) { $bild=rand(1,15);}
  if ($klasse==4) { $bild=rand(1,14);}
  if ($klasse==5) { $bild=rand(1,11);}
  if ($klasse==6) { $bild=rand(1,22);}
  if ($klasse==7) { $bild=rand(1,13);}
  if ($klasse==8) { $bild=rand(1,33);}
  if ($klasse==9) { $bild=rand(1,9);}
  $temp=$r_eigenschaften[$rasse]['temperatur'];
  if ($temp==0) {
  if ($klasse==1) { $temp=rand(40,60); }
  if ($klasse==2) { $temp=rand(30,50);}
  if ($klasse==3) { $temp=rand(0,10);}
  if ($klasse==4) { $temp=rand(50,75); }
  if ($klasse==5) { $temp=rand(86,100); }
  if ($klasse==6) { $temp=rand(70,95); }
  if ($klasse==7) { $temp=rand(75,90); }
  if ($klasse==8) { $temp=rand(20,35); }
  if ($klasse==9) { $temp=rand(25,45); }
  }
    $zeiger = @mysql_query("UPDATE $skrupel_planeten set konz_lemin=$konz_lemin,konz_min1=$konz_min1,konz_min2=$konz_min2,konz_min3=$konz_min3,osys_anzahl=4,native_id=0,native_name ='',native_art=0,native_art_name='',native_abgabe=0,native_bild='',native_text='',native_fert='',native_kol=0,besitzer=$i,heimatplanet=$i,vorrat=$vorrat,cantox=$cantox,minen=$minen,abwehr=$abwehr,fabriken=$fabriken,kolonisten=$kolonisten,lemin=$lemin,min1=$min1,min2=$min2,min3=$min3,klasse=$klasse,bild=$bild,temp=$temp,planet_lemin=$planet_lemin,planet_min1=$planet_min1,planet_min2=$planet_min2,planet_min3=$planet_min3 where id=$pid");
if (($imperiumgroesse==1) or ($imperiumgroesse==2)) {
  $namesb='Starbase I';
  $rasse = $spieler[$i][1];
  $zeiger = @mysql_query("INSERT INTO $skrupel_sternenbasen (name,x_pos,y_pos,rasse,planetid,besitzer,status,spiel) values ('$namesb',$x_pos,$y_pos,'$rasse',$pid,$i,1,$spiel)");
  $zeiger_temp = @mysql_query("SELECT * FROM $skrupel_sternenbasen where planetid=$pid");
  $array_temp = @mysql_fetch_array($zeiger_temp);
  $baid=$array_temp["id"];
  $zeiger_temp = @mysql_query("UPDATE $skrupel_planeten set sternenbasis=2,sternenbasis_name='$namesb',sternenbasis_id=$baid,sternenbasis_rasse='$rasse' where id=$pid");
}
if ($imperiumgroesse==1) {
    $schiffbau_klasse=$array["schiffbau_klasse"];
    $schiffbau_bild_gross=$array["schiffbau_bild_gross"];
    $schiffbau_bild_klein=$array["schiffbau_bild_klein"];
    $schiffbau_crew=$array["schiffbau_crew"];
    $schiffbau_masse=$array["schiffbau_masse"];
    $schiffbau_tank=$array["schiffbau_tank"];
    $schiffbau_fracht=$array["schiffbau_fracht"];
    $schiffbau_antriebe=$array["schiffbau_antriebe"];
    $schiffbau_energetik=$array["schiffbau_energetik"];
    $schiffbau_projektile=$array["schiffbau_projektile"];
    $schiffbau_hangar=$array["schiffbau_hangar"];
    $schiffbau_klasse_name=$array["schiffbau_klasse_name"];
    $schiffbau_rasse=$array["schiffbau_rasse"];
    $schiffbau_fertigkeiten=$array["schiffbau_fertigkeiten"];
    $schiffbau_energetik_stufe=$array["schiffbau_energetik_stufe"];
    $schiffbau_projektile_stufe=0;
    $schiffbau_techlevel=3;
    $schiffbau_antriebe_stufe=3;
    $schiffbau_name='Frachter I';
    $zeiger_temp = @mysql_query("INSERT INTO $skrupel_schiffe
    (besitzer,status,name,klasse,klasseid,volk,techlevel,antrieb,antrieb_anzahl,kox,koy,crew,crewmax,lemin,leminmax,frachtraum,masse,masse_gesamt,bild_gross,bild_klein,energetik_stufe,energetik_anzahl,projektile_stufe,projektile_anzahl,hanger_anzahl,schild,fertigkeiten,spiel)
 values ($i,2,'$schiffbau_name','$schiffbau_klasse_name',$schiffbau_klasse,'$schiffbau_rasse',$schiffbau_techlevel,$schiffbau_antriebe_stufe, $schiffbau_antriebe,$x_pos,$y_pos,$schiffbau_crew,$schiffbau_crew,0,$schiffbau_tank,$schiffbau_fracht,$schiffbau_masse,$schiffbau_masse,'$schiffbau_bild_gross','$schiffbau_bild_klein',$schiffbau_energetik_stufe,$schiffbau_energetik,$schiffbau_projektile_stufe,$schiffbau_projektile,$schiffbau_hangar,100,'$schiffbau_fertigkeiten',$spiel)");
}
}
}
}
//////////////////////////////////////////////SPIELER AUFBAUEN ENDE
///////////////////////////////////////////////INSTABLIE WURMLOECHER ANFANG
if (int_post('instabil')>=1) {
for ($i=0;$i<int_post('instabil');$i++) {
  $ok=1;
  while ($ok==1) {
  $x=rand(50,$umfang-100);
  $y=rand(50,$umfang-100);
  $oben=$y-30;
  $unten=$y+30;
  $links=$x-30;
  $rechts=$x+30;
    $ok=2;
    $nachbarn=0;
    $zeiger2 = @mysql_query("SELECT count(*) as total from $skrupel_planeten where x_pos>$links and x_pos<$rechts and y_pos>$oben and y_pos<$unten and spiel=$spiel");
    $array = @mysql_fetch_array($zeiger2);
    $nachbarn=$array["total"];
    if ($nachbarn>=1) {$ok=1;}
    $nachbarn=0;
    $zeiger2 = @mysql_query("SELECT count(*) as total from $skrupel_anomalien where x_pos>$links and x_pos<$rechts and y_pos>$oben and y_pos<$unten and spiel=$spiel");
    $array = @mysql_fetch_array($zeiger2);
    $nachbarn=$array["total"];
    if ($nachbarn>=1) {$ok=1;}
  }
  $zeiger2 = @mysql_query("INSERT INTO $skrupel_anomalien (art,x_pos,y_pos,spiel) values (1,$x,$y,$spiel);");
}
}
///////////////////////////////////////////////INSTABLIE WURMLOECHER ENDE
///////////////////////////////////////////////STABILE WURMLOECHER ANFANG
$stabil = int_post('stabil');
if ($stabil>=1) {
  if ($stabil<=5) {$anzahl=$stabil;}
  if ($stabil==6) {$anzahl=1;}
  if ($stabil==7) {$anzahl=2;}
  if ($stabil==8) {$anzahl=1;}
  if ($stabil==9) {$anzahl=2;}
  if ($stabil==10) {$anzahl=2;}
  if ($stabil==11) {$anzahl=1;}
  if ($stabil==12) {$anzahl=1;}
  if ($stabil==13) {$anzahl=2;}
   for ($i=0;$i<$anzahl;$i++) {
  $ok=1;
  while ($ok==1) {
  if ($stabil<=5) { $x=rand(50,$umfang-100);$y=rand(50,$umfang-100); }
  if ($stabil==6) { $x=rand(50,$umfang-100);$y=rand(50,($umfang/2)-50); }
  if ($stabil==7) { $x=rand(50,$umfang-100);$y=rand(50,($umfang/2)-50); }
  if ($stabil==8) { $x=rand(50,($umfang/2)-50);$y=rand(50,$umfang-100); }
  if ($stabil==9) { $x=rand(50,($umfang/2)-50);$y=rand(50,$umfang-100); }
  if (($stabil==10) and ($i==0)) { $x=rand(50,$umfang-100);$y=rand(50,($umfang/2)-50); }
  if (($stabil==10) and ($i==1)) { $x=rand(50,($umfang/2)-50);$y=rand(50,$umfang-100); }
  if ($stabil==11) { $x=rand(50,($umfang/2)-50);$y=rand(50,($umfang/2)-50); }
  if ($stabil==12) { $x=rand(($umfang/2)+50,$umfang-100);$y=rand(50,($umfang/2)-50); }
  if (($stabil==13) and ($i==0)) { $x=rand(50,($umfang/2)-50);$y=rand(50,($umfang/2)-50); }
  if (($stabil==13) and ($i==1)) { $x=rand(($umfang/2)+50,$umfang-100);$y=rand(50,($umfang/2)-50); }
  $oben=$y-30;
  $unten=$y+30;
  $links=$x-30;
  $rechts=$x+30;
    $ok=2;
    $nachbarn=0;
    $zeiger2 = @mysql_query("SELECT count(*) as total from $skrupel_planeten where x_pos>$links and x_pos<$rechts and y_pos>$oben and y_pos<$unten and spiel=$spiel");
    $array = @mysql_fetch_array($zeiger2);
    $nachbarn=$array["total"];
    if ($nachbarn>=1) {$ok=1;}
    $nachbarn=0;
    $zeiger2 = @mysql_query("SELECT count(*) as total from $skrupel_anomalien where x_pos>$links and x_pos<$rechts and y_pos>$oben and y_pos<$unten and spiel=$spiel");
    $array = @mysql_fetch_array($zeiger2);
    $nachbarn=$array["total"];
    if ($nachbarn>=1) {$ok=1;}
  }
  $zeiger2 = @mysql_query("INSERT INTO $skrupel_anomalien (art,x_pos,y_pos,spiel) values (1,$x,$y,$spiel);");
  $zeiger = @mysql_query("SELECT * FROM $skrupel_anomalien where x_pos=$x and y_pos=$y and spiel=$spiel");
      $array = @mysql_fetch_array($zeiger);
      $aid_eins=$array["id"];
      $x_pos_eins=$array["x_pos"];
      $y_pos_eins=$array["y_pos"];
  $ok=1;
  while ($ok==1) {
  if ($stabil<=5) { $x=rand(50,$umfang-100);$y=rand(50,$umfang-100); }
  if ($stabil==6) { $x=rand(50,$umfang-100);$y=rand(($umfang/2)+50,$umfang-100); }
  if ($stabil==7) { $x=rand(50,$umfang-100);$y=rand(($umfang/2)+50,$umfang-100); }
  if ($stabil==8) { $x=rand(($umfang/2)+50,$umfang-100);$y=rand(50,$umfang-100); }
  if ($stabil==9) { $x=rand(($umfang/2)+50,$umfang-100);$y=rand(50,$umfang-100); }
  if (($stabil==10) and ($i==0)) { $x=rand(50,$umfang-100);$y=rand(($umfang/2)+50,$umfang-100); }
  if (($stabil==10) and ($i==1)) { $x=rand(($umfang/2)+50,$umfang-100);$y=rand(50,$umfang-100); }
  if ($stabil==11) { $x=rand(($umfang/2)+50,$umfang-100);$y=rand(($umfang/2)+50,$umfang-100); }
  if ($stabil==12) { $x=rand(50,($umfang/2)-50);$y=rand(($umfang/2)+50,$umfang-100); }
  if (($stabil==13) and ($i==0)) { $x=rand(($umfang/2)+50,$umfang-100);$y=rand(($umfang/2)+50,$umfang-100); }
  if (($stabil==13) and ($i==1)) { $x=rand(50,($umfang/2)-50);$y=rand(($umfang/2)+50,$umfang-100); }
  $oben=$y-30;
  $unten=$y+30;
  $links=$x-30;
  $rechts=$x+30;
    $ok=2;
    $nachbarn=0;
    $zeiger2 = @mysql_query("SELECT count(*) as total from $skrupel_planeten where x_pos>$links and x_pos<$rechts and y_pos>$oben and y_pos<$unten and spiel=$spiel");
    $array = @mysql_fetch_array($zeiger2);
    $nachbarn=$array["total"];
    if ($nachbarn>=1) {$ok=1;}
    $nachbarn=0;
    $zeiger2 = @mysql_query("SELECT count(*) as total from $skrupel_anomalien where x_pos>$links and x_pos<$rechts and y_pos>$oben and y_pos<$unten and spiel=$spiel");
    $array = @mysql_fetch_array($zeiger2);
    $nachbarn=$array["total"];
    if ($nachbarn>=1) {$ok=1;}
  }
  $extra=$aid_eins.":".$x_pos_eins.":".$y_pos_eins;
  $zeiger2 = @mysql_query("INSERT INTO $skrupel_anomalien (art,x_pos,y_pos,extra,spiel) values (1,$x,$y,'$extra',$spiel);");
  $zeiger = @mysql_query("SELECT * FROM $skrupel_anomalien where x_pos=$x and y_pos=$y and spiel=$spiel");
      $array = @mysql_fetch_array($zeiger);
      $aid_zwei=$array["id"];
      $x_pos_zwei=$array["x_pos"];
      $y_pos_zwei=$array["y_pos"];
  $extra=$aid_zwei.":".$x_pos_zwei.":".$y_pos_zwei;
  $zeiger2 = @mysql_query("UPDATE $skrupel_anomalien set extra='$extra' where id=$aid_eins;");
     }
}
///////////////////////////////////////////////STABILE WURMLOECHER ENDE
//////////////////////////////////////////////SCHIFFSORDNER ANFANG
      for  ($k=1; $k<11;$k++) {
         $zeiger_temp = @mysql_query("INSERT INTO $skrupel_ordner (name,besitzer,spiel) values ('Frachter',$k,$spiel)");
         $zeiger_temp = @mysql_query("INSERT INTO $skrupel_ordner (name,besitzer,spiel) values ('Jäger',$k,$spiel)");
         $zeiger_temp = @mysql_query("INSERT INTO $skrupel_ordner (name,besitzer,spiel) values ('Sonstige',$k,$spiel)");
      }
//////////////////////////////////////////////SCHIFFSORDNER ENDE
//////////////////////////////////////////////ZIEL
$ziel_info='';
$spieler_1_ziel='';$spieler_2_ziel='';$spieler_3_ziel='';
$spieler_4_ziel='';$spieler_5_ziel='';$spieler_6_ziel='';
$spieler_7_ziel='';$spieler_8_ziel='';$spieler_9_ziel='';$spieler_10_ziel='';
if ($ziel_id==1) {
   $ziel_info=int_post('zielinfo_1');
}
if ($ziel_id==2) {
  $feind=0;$checkstring='';$zahl=0;
  for ($n=1;$n<=10;$n++) {
      $ok=1;
      if ($spieler[$n][0]>=1) {
        while ($ok==1) {
             $zahl=rand(1,10);
             $code=":::".$zahl.":::";
             if (($zahl!=$n) and ($spieler[$zahl][0]>=1)) {
                 if (strstr($checkstring,$code)) {    } else {
                     $ok=2;
                     $checkstring=$checkstring.$code;
                     if ($n==1) { $spieler_1_ziel="$zahl"; }
                     if ($n==2) { $spieler_2_ziel="$zahl"; }
                     if ($n==3) { $spieler_3_ziel="$zahl"; }
                     if ($n==4) { $spieler_4_ziel="$zahl"; }
                     if ($n==5) { $spieler_5_ziel="$zahl"; }
                     if ($n==6) { $spieler_6_ziel="$zahl"; }
                     if ($n==7) { $spieler_7_ziel="$zahl"; }
                     if ($n==8) { $spieler_8_ziel="$zahl"; }
                     if ($n==9) { $spieler_9_ziel="$zahl"; }
                     if ($n==10) { $spieler_10_ziel="$zahl"; }
                 }
             }
        }
      }
  }
}
//$spieleranzahl
if ($ziel_id==6) {
  $zahl=0;$ok=1;
  for ($n=1;$n<=10;$n++) {
     if ($spieler[$n][0]>=1) {
        $feind[$zahl]=$n;
        $zahl=$zahl+1;
     }
  }
  while ($ok==1) {
     $zahl=0;$ok=2;
     shuffle($feind);
  for ($n=1;$n<=10;$n++) {
     if ($spieler[$n][0]>=1) {
         if ($feind[$zahl]==$n)  {$ok=1;}
  for ($mo=1;$mo<=10;$mo++) {
     if (($spieler[$mo][0]>=1) and ($mo!=$n) and ($team[$mo]==$team[$n])) {
              if ($feind[$zahl]==$mo)  {$ok=1;}
              $partner[$n]=$mo;
     }
  }
         $zahl=$zahl+1;
     }
  }
  }
  $zahl=0;
  for ($n=1;$n<=10;$n++) {
     if ($spieler[$n][0]>=1) {
           $vernichte[$n]=$feind[$zahl];
         $zahl=$zahl+1;
     }
  }
  for ($n=1;$n<=10;$n++) {
     if ($spieler[$n][0]>=1) {
                     if ($n==1) { $spieler_1_ziel=$team[$n].':'.$vernichte[$n].':'.$vernichte[$partner[$n]]; }
                     if ($n==2) { $spieler_2_ziel=$team[$n].':'.$vernichte[$n].':'.$vernichte[$partner[$n]]; }
                     if ($n==3) { $spieler_3_ziel=$team[$n].':'.$vernichte[$n].':'.$vernichte[$partner[$n]]; }
                     if ($n==4) { $spieler_4_ziel=$team[$n].':'.$vernichte[$n].':'.$vernichte[$partner[$n]]; }
                     if ($n==5) { $spieler_5_ziel=$team[$n].':'.$vernichte[$n].':'.$vernichte[$partner[$n]]; }
                     if ($n==6) { $spieler_6_ziel=$team[$n].':'.$vernichte[$n].':'.$vernichte[$partner[$n]]; }
                     if ($n==7) { $spieler_7_ziel=$team[$n].':'.$vernichte[$n].':'.$vernichte[$partner[$n]]; }
                     if ($n==8) { $spieler_8_ziel=$team[$n].':'.$vernichte[$n].':'.$vernichte[$partner[$n]]; }
                     if ($n==9) { $spieler_9_ziel=$team[$n].':'.$vernichte[$n].':'.$vernichte[$partner[$n]]; }
                     if ($n==10) { $spieler_10_ziel=$team[$n].':'.$vernichte[$n].':'.$vernichte[$partner[$n]]; }
     }
  }
  for ($n=1;$n<=10;$n++) {
     if ($spieler[$n][0]>=1) {
       if ($n<$partner[$n]) {
          $zeigertemp = @mysql_query("INSERT INTO $skrupel_politik (partei_a,partei_b,status,optionen,spiel) values ($n,$partner[$n],5,0,$spiel)");
       }
     }
  }
}
if ($ziel_id==5) {
   $ziel_info=int_post('zielinfo_5');
   $spieler_1_ziel="0";
   $spieler_2_ziel="0";
   $spieler_3_ziel="0";
   $spieler_4_ziel="0";
   $spieler_5_ziel="0";
   $spieler_6_ziel="0";
   $spieler_7_ziel="0";
   $spieler_8_ziel="0";
   $spieler_9_ziel="0";
   $spieler_10_ziel="0";
}
//////////////////////////////////////////////ZIEL
///////////////////////////////////////////////NEBEL ERSTELLEN ANFANG
$nebel=int_post('nebel');
      $besitzer_recht[1]='1000000000';
      $besitzer_recht[2]='0100000000';
      $besitzer_recht[3]='0010000000';
      $besitzer_recht[4]='0001000000';
      $besitzer_recht[5]='0000100000';
      $besitzer_recht[6]='0000010000';
      $besitzer_recht[7]='0000001000';
      $besitzer_recht[8]='0000000100';
      $besitzer_recht[9]='0000000010';
      $besitzer_recht[10]='0000000001';
if ($nebel>=1) {
function sichtaddieren($sicht_alt,$sicht_neu) {
      if ((substr($sicht_alt,0,1)=="1") or (substr($sicht_neu,0,1)=="1")) { $s1="1"; } else { $s1="0"; }
      if ((substr($sicht_alt,1,1)=="1") or (substr($sicht_neu,1,1)=="1")) { $s2="1"; } else { $s2="0"; }
      if ((substr($sicht_alt,2,1)=="1") or (substr($sicht_neu,2,1)=="1")) { $s3="1"; } else { $s3="0"; }
      if ((substr($sicht_alt,3,1)=="1") or (substr($sicht_neu,3,1)=="1")) { $s4="1"; } else { $s4="0"; }
      if ((substr($sicht_alt,4,1)=="1") or (substr($sicht_neu,4,1)=="1")) { $s5="1"; } else { $s5="0"; }
      if ((substr($sicht_alt,5,1)=="1") or (substr($sicht_neu,5,1)=="1")) { $s6="1"; } else { $s6="0"; }
      if ((substr($sicht_alt,6,1)=="1") or (substr($sicht_neu,6,1)=="1")) { $s7="1"; } else { $s7="0"; }
      if ((substr($sicht_alt,7,1)=="1") or (substr($sicht_neu,7,1)=="1")) { $s8="1"; } else { $s8="0"; }
      if ((substr($sicht_alt,8,1)=="1") or (substr($sicht_neu,8,1)=="1")) { $s9="1"; } else { $s9="0"; }
      if ((substr($sicht_alt,9,1)=="1") or (substr($sicht_neu,9,1)=="1")) { $s10="1"; } else { $s10="0"; }
      $sicht=$s1.$s2.$s3.$s4.$s5.$s6.$s7.$s8.$s9.$s10;
  return $sicht;
}
  $dateiinclude="../inhalt/inc.host_nebel.php";
  include ($dateiinclude);
}
///////////////////////////////////////////////NEBEL ERSTELLEN ENDE
///////////////////////////////////////////////SPIELBLOCK ERSTELLEN ANFANG
$letztermonat="Es fand leider noch kein Zug statt.";
for ($sp=1; $sp<=10; $sp++) {
    $spieler_rasse_c[$sp] = $spieler[$sp][1];
}
$spieler_1=$spieler[1][0];
$spieler_2=$spieler[2][0];
$spieler_3=$spieler[3][0];
$spieler_4=$spieler[4][0];
$spieler_5=$spieler[5][0];
$spieler_6=$spieler[6][0];
$spieler_7=$spieler[7][0];
$spieler_8=$spieler[8][0];
$spieler_9=$spieler[9][0];
$spieler_10=$spieler[10][0];
$plasma_wahr=int_post('wahr');
$plasma_lang=int_post('lang');
$plasma_max=int_post('max');
$spieler_admin=int_post('spieler_admin');
for ($sp=1; $sp<=10; $sp++) {
    if (strlen($spieler_rasse_c[$sp])>=2) {
        $spieler_rassename_c[$sp] = $namerassen[$spieler_rasse_c[$sp]];
    }
}
$zeiger = @mysql_query("UPDATE $skrupel_spiele set
                        sid='$sid',
                        ziel_id=$ziel_id,
                        ziel_info='$ziel_info',
                        spieler_1=$spieler_1,
                        spieler_admin=$spieler_admin,
                        plasma_wahr=$plasma_wahr,
                        plasma_lang=$plasma_lang,
                        plasma_max=$plasma_max,
                        spieler_2=$spieler_2,
                        spieler_3=$spieler_3,
                        spieler_4=$spieler_4,
                        spieler_5=$spieler_5,
                        spieler_6=$spieler_6,
                        spieler_7=$spieler_7,
                        spieler_8=$spieler_8,
                        spieler_9=$spieler_9,
                        spieler_10=$spieler_10,
                        spieler_1_ziel='$spieler_1_ziel',
                        spieler_2_ziel='$spieler_2_ziel',
                        spieler_3_ziel='$spieler_3_ziel',
                        spieler_4_ziel='$spieler_4_ziel',
                        spieler_5_ziel='$spieler_5_ziel',
                        spieler_6_ziel='$spieler_6_ziel',
                        spieler_7_ziel='$spieler_7_ziel',
                        spieler_8_ziel='$spieler_8_ziel',
                        spieler_9_ziel='$spieler_9_ziel',
                        spieler_10_ziel='$spieler_10_ziel',
                        spieleranzahl=$spieleranzahl,
                        spieler_1_zug=0,
                        spieler_2_zug=0,
                        spieler_3_zug=0,
                        spieler_4_zug=0,
                        spieler_5_zug=0,
                        spieler_6_zug=0,
                        spieler_7_zug=0,
                        spieler_8_zug=0,
                        spieler_9_zug=0,
                        spieler_10_zug=0,
                        lasttick='',
                        spieler_1_basen=1,
                        spieler_1_schiffe=1,
                        spieler_1_planeten=1,
                        spieler_2_basen=1,
                        spieler_2_schiffe=1,
                        spieler_2_planeten=1,
                        spieler_3_basen=1,
                        spieler_3_schiffe=1,
                        spieler_3_planeten=1,
                        spieler_4_basen=1,
                        spieler_4_schiffe=1,
                        spieler_4_planeten=1,
                        spieler_5_basen=1,
                        spieler_5_schiffe=1,
                        spieler_5_planeten=1,
                        spieler_6_basen=1,
                        spieler_6_schiffe=1,
                        spieler_6_planeten=1,
                        spieler_7_basen=1,
                        spieler_7_schiffe=1,
                        spieler_7_planeten=1,
                        spieler_8_basen=1,
                        spieler_8_schiffe=1,
                        spieler_8_planeten=1,
                        spieler_9_basen=1,
                        spieler_9_schiffe=1,
                        spieler_9_planeten=1,
                        spieler_10_basen=1,
                        spieler_10_schiffe=1,
                        spieler_10_planeten=1,
                        letztermonat='$letztermonat',
                        spieler_1_rasse='{$spieler_rasse_c[1]}',
                        spieler_2_rasse='{$spieler_rasse_c[2]}',
                        spieler_3_rasse='{$spieler_rasse_c[3]}',
                        spieler_4_rasse='{$spieler_rasse_c[4]}',
                        spieler_5_rasse='{$spieler_rasse_c[5]}',
                        spieler_6_rasse='{$spieler_rasse_c[6]}',
                        spieler_7_rasse='{$spieler_rasse_c[7]}',
                        spieler_8_rasse='{$spieler_rasse_c[8]}',
                        spieler_9_rasse='{$spieler_rasse_c[9]}',
                        spieler_10_rasse='{$spieler_rasse_c[10]}',
                        spieler_1_rassename='{$spieler_rassename_c[1]}',
                        spieler_2_rassename='{$spieler_rassename_c[2]}',
                        spieler_3_rassename='{$spieler_rassename_c[3]}',
                        spieler_4_rassename='{$spieler_rassename_c[4]}',
                        spieler_5_rassename='{$spieler_rassename_c[5]}',
                        spieler_6_rassename='{$spieler_rassename_c[6]}',
                        spieler_7_rassename='{$spieler_rassename_c[7]}',
                        spieler_8_rassename='{$spieler_rassename_c[8]}',
                        spieler_9_rassename='{$spieler_rassename_c[9]}',
                        spieler_10_rassename='{$spieler_rassename_c[10]}',
                        autozug=0,
                        umfang=$umfang,
                        nebel=$nebel,
                        spieler_1_platz=1,
                        spieler_2_platz=1,
                        spieler_3_platz=1,
                        spieler_4_platz=1,
                        spieler_5_platz=1,
                        spieler_6_platz=1,
                        spieler_7_platz=1,
                        spieler_8_platz=1,
                        spieler_9_platz=1,
                        spieler_10_platz=1,
                        runde=1,
                        aufloesung=50,
                        name='$spielname',
                        piraten_mitte=$piraten_mitte,
                        piraten_aussen=$piraten_aussen,
                        piraten_min=$piraten_min,
                        piraten_max=$piraten_max
                        where id=$spiel");
if ($spieler_1>=1) {$zeiger = @mysql_query("UPDATE $skrupel_user set stat_teilnahme=stat_teilnahme+1 where id=$spieler_1"); }
if ($spieler_2>=1) {$zeiger = @mysql_query("UPDATE $skrupel_user set stat_teilnahme=stat_teilnahme+1 where id=$spieler_2"); }
if ($spieler_3>=1) {$zeiger = @mysql_query("UPDATE $skrupel_user set stat_teilnahme=stat_teilnahme+1 where id=$spieler_3"); }
if ($spieler_4>=1) {$zeiger = @mysql_query("UPDATE $skrupel_user set stat_teilnahme=stat_teilnahme+1 where id=$spieler_4"); }
if ($spieler_5>=1) {$zeiger = @mysql_query("UPDATE $skrupel_user set stat_teilnahme=stat_teilnahme+1 where id=$spieler_5"); }
if ($spieler_6>=1) {$zeiger = @mysql_query("UPDATE $skrupel_user set stat_teilnahme=stat_teilnahme+1 where id=$spieler_6"); }
if ($spieler_7>=1) {$zeiger = @mysql_query("UPDATE $skrupel_user set stat_teilnahme=stat_teilnahme+1 where id=$spieler_7"); }
if ($spieler_8>=1) {$zeiger = @mysql_query("UPDATE $skrupel_user set stat_teilnahme=stat_teilnahme+1 where id=$spieler_8"); }
if ($spieler_9>=1) {$zeiger = @mysql_query("UPDATE $skrupel_user set stat_teilnahme=stat_teilnahme+1 where id=$spieler_9"); }
if ($spieler_10>=1) {$zeiger = @mysql_query("UPDATE $skrupel_user set stat_teilnahme=stat_teilnahme+1 where id=$spieler_10"); }
$zeiger = @mysql_query("UPDATE $skrupel_info set stat_spiele=stat_spiele+1");
///////////////////////////////////////////////////////////////////////////////////////////////MOVIEGIF OPTIONAL ANFANG
$moviegif_verzeichnis = '../extend/moviegif';
if ((@file_exists($moviegif_verzeichnis)) and (@intval(substr($spiel_extend,0,1))==1))  {
  include($moviegif_verzeichnis.'/shot.php');
}
///////////////////////////////////////////////////////////////////////////////////////////////MOVIEGIF OPTIONAL END
///////////////////////////////////////////////SPIELBLOCK ERSTELLEN ENDE
?>
<body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)"><?php echo $lang['admin']['spiel']['alpha']['neues_spiel']?></td></tr></table></center>
<br><br>
<br><br><br><br><br>
<center><?php echo $lang['admin']['spiel']['alpha']['fertig']?></center><?php
 } include ("inc.footer.php");
 }
