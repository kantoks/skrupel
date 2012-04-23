<?php
/*
:noTabs=false:indentSize=4:tabSize=4:folding=explicit:collapseFolds=1:
*/
require_once ('../inc.conf.php'); 
require_once (../inhalt/'inc.hilfsfunktionen.php');
include ("../lang/".$language."/lang.spiel_gamma.php");
$fuid = int_get('fu');

if ($fuid==1) {
include ("inc.header.php");
if (($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)) {
?>
<body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)"><?php echo $lang['spielgamma']['ueberschrift']; ?></td></tr></table></center>
<?php
$daten_verzeichnis = '../daten/';
$handle = opendir($daten_verzeichnis);
while ($rasses=readdir($handle)){
  $file=$daten_verzeichnis.$rasses.'/daten.txt';
  //if ((substr($rasses,0,1)<>'.') and (substr($rasses,0,7)<>'bilder_') and (substr($rasses,-4)<>'.txt')) {
  if(is_dir($daten_verzeichnis.$rasses) && is_file($file)){
    $daten=array();
    $fp = @fopen("$file","r");
    if ($fp) {
      $zaehler2=0;
      while (!feof ($fp)) {
        $buffer = @fgets($fp, 4096);
        $daten[$zaehler2]=$buffer;
        $zaehler2++;
      }
      @fclose($fp);
      $r_eigenschaften[$rasses]['name']=trim($daten[0]);
    }
  }
}
$zeiger = @mysql_query("SELECT * FROM $skrupel_spiele ORDER BY name");
$spielanzahl = @mysql_num_rows($zeiger);
if ($spielanzahl>=1) {
    ?><center><table border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td style="color:#aaaaaa;"><?php echo $lang['spielgamma']['listespielname']; ?></td>
        <td style="color:#aaaaaa;"><center><nobr><?php echo $lang['spielgamma']['listerunde']; ?></nobr></center></td>
        <td style="color:#aaaaaa;"><center><nobr><?php echo $lang['spielgamma']['listeletztertick']; ?></nobr></center></td>
        <td style="color:#aaaaaa;"><center><nobr><?php echo $lang['spielgamma']['listeautozug']; ?></nobr></center></td>
        <td style="color:#aaaaaa;"><center><nobr><?php echo $lang['spielgamma']['listemitspieler']; ?></nobr></center></td>
        <td><img src="../bilder/empty.gif" height="22" width="1"></td>
      </tr>
    <?php
    for ($i=0; $i<$spielanzahl; $i++) {
        $ok = @mysql_data_seek($zeiger,$i);
        $array = @mysql_fetch_array($zeiger);
        $slot_id = $array['id'];
        $name = $array['name'];
        $runde = $array['runde'];
        $lasttick = $array['lasttick'];
        $autotick = $array['autozug'];
        $spieler_admin = $array['spieler_admin'];
        for ($j=1; $j<=10; $j++) {
            $tmpstr = 'spieler_'.$j;
            $spieler_id_c[$j]   = $array[$tmpstr];
            $spieler_rasse_c[$j] = $array[$tmpstr.'_rasse'];
            $spieler_raus_c[$j]   = $array[$tmpstr.'_raus'];
        }
        if ($lasttick>=1) {
            $datum = date('d.m.y G:i',$lasttick);
        } else {
            $datum = 'noch keinen';
        }
        if ($autotick>=1) {
            $autot = "alle $autotick Stunden";
        } else {
            $autot = 'niemals';
        }
        ?>
        <tr>
          <td valign="top"><nobr><?php echo $name; ?></nobr></td>
          <td valign="top" style="color:#c9c9c9;"><center><?php echo $runde; ?></center></td>
          <td valign="top" style="color:#c9c9c9;"><center><nobr><?php echo $datum; ?></nobr></center></td>
          <td valign="top" style="color:#c9c9c9;"><center><nobr><?php echo $autot; ?></nobr></center></td>
          <td valign="top" style="color:#c9c9c9;"><center><?php
        for ($j=1; $j<=10; $j++) {
            if ($spieler_id_c[$j] > 0) {
                $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user WHERE id={$spieler_id_c[$j]};");
                $array_temp = @mysql_fetch_array($zeiger_temp);
                $username = $array_temp['nick'];
                if ($spieler_raus_c[$j]==1) $username = "<s>$username</s>";
                if ($spieler_admin==$j) {
                    ?><b><font color="<?php echo $spielerfarbe[$j]; ?>"><?php echo $username; ?> <i>(<?php echo $r_eigenschaften[$spieler_rasse_c[$j]]['name']; ?>)</i></font></b> <?php
                } else {
                    ?><font color="<?php echo $spielerfarbe[$j]; ?>"><?php echo $username; ?> <i>(<?php echo $r_eigenschaften[$spieler_rasse_c[$j]]['name']; ?>)</i></font> <?php
                }
            }
        }
          ?></center></td>
          <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
         <tr><td><form name="formular"  method="post" action="spiel_gamma.php?fu=2&slot_id=<?php echo $slot_id?>" onsubmit="return confirm('Das Spiel \'<?php echo $name; ?>\' wirklich l&ouml;schen?');"></td>
         <td><input type="submit" name="bla" value="L&ouml;schen" style="width:120px;"></td>
         <td></form></td></tr>
       </table></td>
        </tr>
    <?php } ?>
</table></center>
<?php } else { ?>
<center><table border="0" height="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $lang['spielgamma']['keineoffenespiele']; ?></td>
  </tr>
</table></center>
<?php } ?>
<?php
}
include ("inc.footer.php");
}
if ($fuid==2) {
include ("inc.header.php");
if (($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)) {
    $spiel = int_get('slot_id');
    if (@intval(substr($spiel_extend,1,1))==1){
      include("../extend/ki/ki_basis/spielLoeschenKI.php");
    }
    if (@intval(substr($spiel_extend,2,1))==1){
        include("../extend/xstats/xstatsDeleteGame.php");
    }
    $zeiger = @mysql_query("DELETE FROM $skrupel_planeten WHERE spiel=$spiel");
    $zeiger = @mysql_query("DELETE FROM $skrupel_sternenbasen WHERE spiel=$spiel");
    $zeiger = @mysql_query("DELETE FROM $skrupel_schiffe WHERE spiel=$spiel");
    $zeiger = @mysql_query("DELETE FROM $skrupel_huellen WHERE spiel=$spiel");
    $zeiger = @mysql_query("DELETE FROM $skrupel_kampf WHERE spiel=$spiel");
    $zeiger = @mysql_query("DELETE FROM $skrupel_neuigkeiten WHERE spiel_id=$spiel");
    $zeiger = @mysql_query("DELETE FROM $skrupel_anomalien WHERE spiel=$spiel");
    $zeiger = @mysql_query("DELETE FROM $skrupel_nebel WHERE spiel=$spiel");
    $zeiger = @mysql_query("DELETE FROM $skrupel_politik WHERE spiel=$spiel");
    $zeiger = @mysql_query("DELETE FROM $skrupel_spiele WHERE id=$spiel");
    $zeiger = @mysql_query("DELETE FROM $skrupel_ordner WHERE spiel=$spiel");
    $zeiger = @mysql_query("DELETE FROM $skrupel_konplaene WHERE spiel=$spiel");
    $zeiger = @mysql_query("DELETE FROM $skrupel_scan WHERE spiel=$spiel");
    $zeiger = @mysql_query("DELETE FROM $skrupel_begegnung WHERE spiel=$spiel");
    ?>
    <body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <center><table border="0" height="100%" cellspacing="0" cellpadding="0">
    <tr>
    <td><?php echo $lang['spielgamma']['spielgeloescht']; ?></td>
    </tr>
    </table></center><?php
}
include ("inc.footer.php");
}
