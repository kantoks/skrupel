<?php
require_once ('../inc.conf.php'); 
require_once (../inhalt/'inc.hilfsfunktionen.php');
include ("../lang/".$language."/lang.admin.spiel_beta.php");
$fuid = int_get('fu');
$prozentarray=array(0,1,2,3,4,5,6,7,8,9,10,15,20,30,40,50,60,70,80,90,100);

if ($fuid==1) {
  include_once ('../inhalt/inc.hilfsfunktionen.php');
  include ("inc.header.php");
  if (($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)) {
?>
<body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)"><?php echo $lang['admin']['spiel']['beta']['spiel_bearbeiten']?></td></tr></table></center>
<?php
$daten_verzeichnis="../daten/";
$handle=opendir("$daten_verzeichnis");
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
  $zeiger = @mysql_query("SELECT * FROM $skrupel_spiele order by name");
  $spielanzahl = @mysql_num_rows($zeiger);
  if ($spielanzahl>=1) {
   ?><center><table border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['spielname']?></td>
        <td style="color:#aaaaaa;"><center><nobr><?php echo $lang['admin']['spiel']['beta']['runde']?></nobr></center></td>
        <td style="color:#aaaaaa;"><center><nobr><?php echo $lang['admin']['spiel']['beta']['lasttick']?></nobr></center></td>
        <td style="color:#aaaaaa;"><center><nobr><?php echo $lang['admin']['spiel']['beta']['autotick']?></nobr></center></td>
        <td style="color:#aaaaaa;"><center><nobr><?php echo $lang['admin']['spiel']['beta']['mitspieler']?></nobr></center></td>
        <td><img src="../bilder/empty.gif" height="22" width="1"></td>
      </tr>
   <?php
   for  ($i=0; $i<$spielanzahl;$i++) {
   $ok = @mysql_data_seek($zeiger,$i);
     $array = @mysql_fetch_array($zeiger);
   $slot_id=$array["id"];
   $name=$array["name"];
   $runde=$array["runde"];
   $lasttick=$array["lasttick"];
   $autotick=$array["autozug"];
   $spieler_1=$array["spieler_1"];
   $spieler_2=$array["spieler_2"];
   $spieler_3=$array["spieler_3"];
   $spieler_4=$array["spieler_4"];
   $spieler_5=$array["spieler_5"];
   $spieler_6=$array["spieler_6"];
   $spieler_7=$array["spieler_7"];
   $spieler_8=$array["spieler_8"];
   $spieler_9=$array["spieler_9"];
   $spieler_10=$array["spieler_10"];
   $spieler_admin=$array["spieler_admin"];
    $spieler_1_rasse=$array["spieler_1_rasse"];
      $spieler_2_rasse=$array["spieler_2_rasse"];
      $spieler_3_rasse=$array["spieler_3_rasse"];
      $spieler_4_rasse=$array["spieler_4_rasse"];
      $spieler_5_rasse=$array["spieler_5_rasse"];
      $spieler_6_rasse=$array["spieler_6_rasse"];
      $spieler_7_rasse=$array["spieler_7_rasse"];
      $spieler_8_rasse=$array["spieler_8_rasse"];
      $spieler_9_rasse=$array["spieler_9_rasse"];
      $spieler_10_rasse=$array["spieler_10_rasse"];
  $spieler_1_raus=$array["spieler_1_raus"];
  $spieler_2_raus=$array["spieler_2_raus"];
  $spieler_3_raus=$array["spieler_3_raus"];
  $spieler_4_raus=$array["spieler_4_raus"];
  $spieler_5_raus=$array["spieler_5_raus"];
  $spieler_6_raus=$array["spieler_6_raus"];
  $spieler_7_raus=$array["spieler_7_raus"];
  $spieler_8_raus=$array["spieler_8_raus"];
  $spieler_9_raus=$array["spieler_9_raus"];
  $spieler_10_raus=$array["spieler_10_raus"];
   if ($lasttick>=1) {
     $datum=date('d.m.y G:i',$lasttick);
   } else {
     $datum="noch keinen";
   }
   if ($autotick>=1) {
     $autot="alle ".$autotick." Stunden";
   } else {
     $autot="niemals";
   }
   ?>
    <tr>
      <td valign="top"><nobr><?php echo $name; ?></nobr></td>
      <td valign="top" style="color:#c9c9c9;"><center><?php echo $runde; ?></center></td>
      <td valign="top" style="color:#c9c9c9;"><center><nobr><?php echo $datum; ?></nobr></center></td>
      <td valign="top" style="color:#c9c9c9;"><center><nobr><?php echo $autot; ?></nobr></center></td>
      <td valign="top" style="color:#c9c9c9;"><center><?php
      if ($spieler_1>=1) {
        $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_1");
        $array_temp = @mysql_fetch_array($zeiger_temp);
        $username=$array_temp["nick"];
        if ($spieler_1_raus==1) { $username="<s>".$username."</s>"; }
        if ($spieler_admin==1) {
          ?><b><font color="<?php echo $spielerfarbe[1]; ?>"><?php echo $username; ?> <i>(<?php echo $r_eigenschaften[$spieler_1_rasse]['name']; ?>)</i></font></b> <?php
        } else {
          ?><font color="<?php echo $spielerfarbe[1]; ?>"><?php echo $username; ?> <i>(<?php echo $r_eigenschaften[$spieler_1_rasse]['name']; ?>)</i></font> <?php
        }
      }
      if ($spieler_2>=1) {
        $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_2");
        $array_temp = @mysql_fetch_array($zeiger_temp);
        $username=$array_temp["nick"];
        if ($spieler_2_raus==1) { $username="<s>".$username."</s>"; }
        if ($spieler_admin==2) {
          ?><b><font color="<?php echo $spielerfarbe[2]; ?>"><?php echo $username; ?> <i>(<?php echo $r_eigenschaften[$spieler_2_rasse]['name']; ?>)</i></font></b> <?php
        } else {
          ?><font color="<?php echo $spielerfarbe[2]; ?>"><?php echo $username; ?> <i>(<?php echo $r_eigenschaften[$spieler_2_rasse]['name']; ?>)</i></font> <?php
        }
      }
      if ($spieler_3>=1) {
        $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_3");
        $array_temp = @mysql_fetch_array($zeiger_temp);
        $username=$array_temp["nick"];
        if ($spieler_3_raus==1) { $username="<s>".$username."</s>"; }
        if ($spieler_admin==3) {
          ?><b><font color="<?php echo $spielerfarbe[3]; ?>"><?php echo $username; ?> <i>(<?php echo $r_eigenschaften[$spieler_3_rasse]['name']; ?>)</i></font></b> <?php
        } else {
          ?><font color="<?php echo $spielerfarbe[3]; ?>"><?php echo $username; ?> <i>(<?php echo $r_eigenschaften[$spieler_3_rasse]['name']; ?>)</i></font> <?php
        }
      }
      if ($spieler_4>=1) {
        $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_4");
        $array_temp = @mysql_fetch_array($zeiger_temp);
        $username=$array_temp["nick"];
        if ($spieler_4_raus==1) { $username="<s>".$username."</s>"; }
        if ($spieler_admin==4) {
          ?><b><font color="<?php echo $spielerfarbe[4]; ?>"><?php echo $username; ?> <i>(<?php echo $r_eigenschaften[$spieler_4_rasse]['name']; ?>)</i></font></b> <?php
        } else {
          ?><font color="<?php echo $spielerfarbe[4]; ?>"><?php echo $username; ?> <i>(<?php echo $r_eigenschaften[$spieler_4_rasse]['name']; ?>)</i></font> <?php
        }
      }
      if ($spieler_5>=1) {
        $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_5");
        $array_temp = @mysql_fetch_array($zeiger_temp);
        $username=$array_temp["nick"];
        if ($spieler_5_raus==1) { $username="<s>".$username."</s>"; }
        if ($spieler_admin==5) {
          ?><b><font color="<?php echo $spielerfarbe[5]; ?>"><?php echo $username; ?> <i>(<?php echo $r_eigenschaften[$spieler_5_rasse]['name']; ?>)</i></font></b> <?php
        } else {
          ?><font color="<?php echo $spielerfarbe[5]; ?>"><?php echo $username; ?> <i>(<?php echo $r_eigenschaften[$spieler_5_rasse]['name']; ?>)</i></font> <?php
        }
      }
      if ($spieler_6>=1) {
        $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_6");
        $array_temp = @mysql_fetch_array($zeiger_temp);
        $username=$array_temp["nick"];
        if ($spieler_6_raus==1) { $username="<s>".$username."</s>"; }
        if ($spieler_admin==6) {
          ?><b><font color="<?php echo $spielerfarbe[6]; ?>"><?php echo $username; ?> <i>(<?php echo $r_eigenschaften[$spieler_6_rasse]['name']; ?>)</i></font></b> <?php
        } else {
          ?><font color="<?php echo $spielerfarbe[6]; ?>"><?php echo $username; ?> <i>(<?php echo $r_eigenschaften[$spieler_6_rasse]['name']; ?>)</i></font> <?php
        }
      }
      if ($spieler_7>=1) {
        $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_7");
        $array_temp = @mysql_fetch_array($zeiger_temp);
        $username=$array_temp["nick"];
        if ($spieler_7_raus==1) { $username="<s>".$username."</s>"; }
        if ($spieler_admin==7) {
          ?><b><font color="<?php echo $spielerfarbe[7]; ?>"><?php echo $username; ?> <i>(<?php echo $r_eigenschaften[$spieler_7_rasse]['name']; ?>)</i></font></b> <?php
        } else {
          ?><font color="<?php echo $spielerfarbe[7]; ?>"><?php echo $username; ?> <i>(<?php echo $r_eigenschaften[$spieler_7_rasse]['name']; ?>)</i></font> <?php
        }
      }
      if ($spieler_8>=1) {
        $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_8");
        $array_temp = @mysql_fetch_array($zeiger_temp);
        $username=$array_temp["nick"];
        if ($spieler_8_raus==1) { $username="<s>".$username."</s>"; }
        if ($spieler_admin==8) {
          ?><b><font color="<?php echo $spielerfarbe[8]; ?>"><?php echo $username; ?> <i>(<?php echo $r_eigenschaften[$spieler_8_rasse]['name']; ?>)</i></font></b> <?php
        } else {
          ?><font color="<?php echo $spielerfarbe[8]; ?>"><?php echo $username; ?> <i>(<?php echo $r_eigenschaften[$spieler_8_rasse]['name']; ?>)</i></font> <?php
        }
      }
      if ($spieler_9>=1) {
        $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_9");
        $array_temp = @mysql_fetch_array($zeiger_temp);
        $username=$array_temp["nick"];
        if ($spieler_9_raus==1) { $username="<s>".$username."</s>"; }
        if ($spieler_admin==9) {
          ?><b><font color="<?php echo $spielerfarbe[9]; ?>"><?php echo $username; ?> <i>(<?php echo $r_eigenschaften[$spieler_9_rasse]['name']; ?>)</i></font></b> <?php
        } else {
          ?><font color="<?php echo $spielerfarbe[9]; ?>"><?php echo $username; ?> <i>(<?php echo $r_eigenschaften[$spieler_9_rasse]['name']; ?>)</i></font> <?php
        }
      }
      if ($spieler_10>=1) {
        $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_10");
        $array_temp = @mysql_fetch_array($zeiger_temp);
        $username=$array_temp["nick"];
        if ($spieler_10_raus==1) { $username="<s>".$username."</s>"; }
        if ($spieler_admin==10) {
          ?><b><font color="<?php echo $spielerfarbe[10]; ?>"><?php echo $username; ?> <i>(<?php echo $r_eigenschaften[$spieler_10_rasse]['name']; ?>)</i></font></b> <?php
        } else {
          ?><font color="<?php echo $spielerfarbe[10]; ?>"><?php echo $username; ?> <i>(<?php echo $r_eigenschaften[$spieler_10_rasse]['name']; ?>)</i></font> <?php
        }
      }
      ?></center></td>
      <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
     <tr><td><form name="formular"  method="post" action="spiel_beta.php?fu=2&slot_id=<?php echo $slot_id; ?>"></td>
     <td><input type="submit" name="bla" value="Bearbeiten" style="width:120px;"></td>
     <td></form></td></tr>
   </table></td>
    </tr>
<?php } ?>
</table></center>
<?php } else { ?>
<center><table border="0" height="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $lang['admin']['spiel']['beta']['keinespiele']?></td>
  </tr>
</table></center>
<?php } ?>
<?php
} include ("inc.footer.php");
 }
 if ($fuid==2) {
include ("inc.header.php");
if (($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)) {
$spiel=int_get('slot_id');
    $zeiger2 = @mysql_query("SELECT * FROM $skrupel_spiele where id='$spiel'");
    $datensaetze2 = @mysql_num_rows($zeiger2);
    $array2 = @mysql_fetch_array($zeiger2);
    $phase=$array2["phase"];
    $module = @explode(":", $array2['module']);
      $spieler_id_c[1]=$array2["spieler_1"];
      $spieler_id_c[2]=$array2["spieler_2"];
      $spieler_id_c[3]=$array2["spieler_3"];
      $spieler_id_c[4]=$array2["spieler_4"];
      $spieler_id_c[5]=$array2["spieler_5"];
      $spieler_id_c[6]=$array2["spieler_6"];
      $spieler_id_c[7]=$array2["spieler_7"];
      $spieler_id_c[8]=$array2["spieler_8"];
      $spieler_id_c[9]=$array2["spieler_9"];
      $spieler_id_c[10]=$array2["spieler_10"];
            $spieler_zug_c[1]=$array2["spieler_1_zug"];
            $spieler_zug_c[2]=$array2["spieler_2_zug"];
            $spieler_zug_c[3]=$array2["spieler_3_zug"];
            $spieler_zug_c[4]=$array2["spieler_4_zug"];
            $spieler_zug_c[5]=$array2["spieler_5_zug"];
            $spieler_zug_c[6]=$array2["spieler_6_zug"];
            $spieler_zug_c[7]=$array2["spieler_7_zug"];
            $spieler_zug_c[8]=$array2["spieler_8_zug"];
            $spieler_zug_c[9]=$array2["spieler_9_zug"];
            $spieler_zug_c[10]=$array2["spieler_10_zug"];
$spieler_admin=$array2["spieler_admin"];
      $spieler_rasse_c[1]=$array2["spieler_1_rasse"];
      $spieler_rasse_c[2]=$array2["spieler_2_rasse"];
      $spieler_rasse_c[3]=$array2["spieler_3_rasse"];
      $spieler_rasse_c[4]=$array2["spieler_4_rasse"];
      $spieler_rasse_c[5]=$array2["spieler_5_rasse"];
      $spieler_rasse_c[6]=$array2["spieler_6_rasse"];
      $spieler_rasse_c[7]=$array2["spieler_7_rasse"];
      $spieler_rasse_c[8]=$array2["spieler_8_rasse"];
      $spieler_rasse_c[9]=$array2["spieler_9_rasse"];
      $spieler_rasse_c[10]=$array2["spieler_10_rasse"];
    $spieler_rassename_c[1]=$array2["spieler_1_rassename"];
  $spieler_rassename_c[2]=$array2["spieler_2_rassename"];
  $spieler_rassename_c[3]=$array2["spieler_3_rassename"];
  $spieler_rassename_c[4]=$array2["spieler_4_rassename"];
  $spieler_rassename_c[5]=$array2["spieler_5_rassename"];
  $spieler_rassename_c[6]=$array2["spieler_6_rassename"];
  $spieler_rassename_c[7]=$array2["spieler_7_rassename"];
  $spieler_rassename_c[8]=$array2["spieler_8_rassename"];
  $spieler_rassename_c[9]=$array2["spieler_9_rassename"];
  $spieler_rassename_c[10]=$array2["spieler_10_rassename"];
      $spieler_raus_c[1]=$array2["spieler_1_raus"];
      $spieler_raus_c[2]=$array2["spieler_2_raus"];
      $spieler_raus_c[3]=$array2["spieler_3_raus"];
      $spieler_raus_c[4]=$array2["spieler_4_raus"];
      $spieler_raus_c[5]=$array2["spieler_5_raus"];
      $spieler_raus_c[6]=$array2["spieler_6_raus"];
      $spieler_raus_c[7]=$array2["spieler_7_raus"];
      $spieler_raus_c[8]=$array2["spieler_8_raus"];
      $spieler_raus_c[9]=$array2["spieler_9_raus"];
      $spieler_raus_c[10]=$array2["spieler_10_raus"];
      $nebel=$array2["nebel"];
      $aufloesung=$array2["aufloesung"];
      $spieleranzahl=$array2["spieleranzahl"];
      $spiel_name=$array2["name"];
      $umfang=$array2["umfang"];
      $spiel_out=$array2["oput"];
      $autozug=$array2["autozug"];
      $name=$array2["name"];
      $plasma_wahr=$array2["plasma_wahr"];
      $plasma_max=$array2["plasma_max"];
      $plasma_lang=$array2["plasma_lang"];
      $piraten_mitte=$array2["piraten_mitte"];
        $piraten_aussen=$array2["piraten_aussen"];
        $piraten_min=$array2["piraten_min"];
        $piraten_max=$array2["piraten_max"];
?>
<body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)"><?php echo str_replace('{1}',$name,$lang['admin']['spiel']['beta']['bearbeiten_spiel']);?></td></tr></table></center>
<br>
<center><table border="0" cellspacing="0" cellpadding="2">
<tr><td>
<table border="0" cellspacing="0" cellpadding="2" width="100%">
<tr><td>
</td>
<td width="100%">
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)"><?php echo $lang['admin']['spiel']['beta']['aktionen']?></td></tr></table></center>
<br>
<center>
<table border="0" cellspacing="0" cellpadding="0">
     <tr><td><form name="formular"  method="post" action="spiel_beta.php?fu=4&slot_id=<?php echo $spiel; ?>"></td>
     <td><input type="submit" name="bla" value="<?php echo $lang['admin']['spiel']['beta']['ticken']?>" style="width:120px;"></td>
     <td></form></td></tr>
   </table>
</center>
</td>
</tr></table>
</td></tr>
<tr><td>&nbsp;</td></tr>
<?php /* ?> 
<tr><td>
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)"><?php echo $lang['admin']['spiel']['beta']['mitspieler']?></td></tr></table></center>
</td></tr>
<?php
  $zeiger = @mysql_query("SELECT * FROM $skrupel_user order by nick");
  $useranzahl = @mysql_num_rows($zeiger);
   ?>
   <tr><td>Wer spielt mit und mit welchem Volk?</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="1">
   <tr>
   <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
   <td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['admin']?></td>
   </tr>
<?php for ($k=1;$k<11;$k++) {
if ($spieler_id_c[$k]>=1) {
?>
        <tr>
          <td style="color:<?php echo $spielerfarbe[$k]?>;"><select name="user_<?php echo $k?>" style="width:250px;">
<?php for ($n=0;$n<$useranzahl;$n++) {
   $ok = @mysql_data_seek($zeiger,$n);
   $array = @mysql_fetch_array($zeiger);
   $uid=$array["id"];
   $nick=$array["nick"];
   ?>
     <option value="<?php echo $uid?>" <?php if ($spieler_id_c[$k]==$uid) { echo 'selected';} ?> style="background-color:<?php echo $spielerfarbe[$k]?>;"><?php echo $nick?></option>
<?php } ?>
   </select></td>
          <td>&nbsp;</td>
          <td><nobr><?php echo $spieler_rassename_c[$k]?></nobr></td>
          <td>&nbsp;</td>
          <td><input type="radio" name="spieler_admin" value="<?php echo $k?>" <?php if ($spieler_admin==$k) { echo 'checked'; } ?>></td>
        </tr>
<?php }} ?>
   <tr>
   <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
   <td><table border="0" cellspacing="0" cellpadding="0"><tr><td><input type="radio" name="spieler_admin" value="0" <?php if ($spieler_admin==0) { echo 'checked'; } ?>></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['niemand']?></td></tr></table></td>
   </tr>
</table></td></tr>
<tr><td>&nbsp;</td></tr>
<?php */ ?>
<tr><td>
<center><table border="0" cellspacing="0" cellpadding="4"><tr><td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)"><?php echo $lang['admin']['spiel']['beta']['optionen']?></td></tr></table></center>
</td></tr>
   <tr><td><?php echo $lang['admin']['spiel']['beta']['wie_name']?></td></tr>
   <tr><td><form name="formular"  method="post" action="spiel_beta.php?fu=3&slot_id=<?php echo $spiel; ?>">&nbsp;</td></tr>
   <tr><td><input type="text" name="spiel_name" class="eingabe" value="<?php echo $name; ?>" maxlength="50" style="width:250px;"></td></tr>
    <tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['spiel']['beta']['optional']['welche']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td><input type="checkbox" name="modul_0" value="1" <?php if ($module[0]==1) { echo 'checked'; }?>></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['optional']['sus']?></td></tr>
      <tr><td><input type="checkbox" name="modul_2" value="1" <?php if ($module[2]==1) { echo 'checked'; }?>></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['optional']['mf']?></td></tr>
      <tr><td><input type="checkbox" name="modul_3" value="1" <?php if ($module[3]==1) { echo 'checked'; }?>></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['optional']['tk']?></td></tr>
      </table></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['spiel']['beta']['optional']['aufloesung']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
   <tr><td><input type="radio" name="aufloesung" value="50" <?php if ($aufloesung==50) { echo 'checked'; }?>></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['optional']['50lj']?></td></tr>
   <tr><td><input type="radio" name="aufloesung" value="250" <?php if ($aufloesung==250) { echo 'checked'; }?>></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['optional']['250lj']?></td></tr>
   <tr><td><input type="checkbox" name="modul_4" value="1" <?php if ($module[4]==1) { echo 'checked'; }?>></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['optional']['wysiwyg']?></td></tr>
   <tr><td><input type="checkbox" name="modul_5" value="1" <?php if ($module[5]==1) { echo 'checked'; }?>></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['optional']['f']?></td></tr>
   <tr><td><input type="checkbox" name="modul_6" value="1" <?php if ($module[6]==1) { echo 'checked'; }?>></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['optional']['h']?></td></tr>
     </table></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['spiel']['beta']['optional']['wannautotick']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
   <tr><td><input type="radio" name="autotick" value="0" <?php if ($autozug==0) { echo 'checked'; }?>></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['optional']['nie']?></td></tr>
   <tr><td><input type="radio" name="autotick" value="6" <?php if ($autozug==6) { echo 'checked'; }?>></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['optional']['6h']?></td></tr>
   <tr><td><input type="radio" name="autotick" value="12" <?php if ($autozug==12) { echo 'checked'; }?>></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['optional']['12h']?></td></tr>
   <tr><td><input type="radio" name="autotick" value="18" <?php if ($autozug==18) { echo 'checked'; }?>></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['optional']['18h']?></td></tr>
   <tr><td><input type="radio" name="autotick" value="24" <?php if ($autozug==24) { echo 'checked'; }?>></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['optional']['24h']?></td></tr>
   <tr><td><input type="radio" name="autotick" value="48" <?php if ($autozug==48) { echo 'checked'; }?>></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['optional']['48h']?></td></tr>
     </table></td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td><?php echo $lang['admin']['spiel']['beta']['optional']['langegenug']?></td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td><table border="0" cellspacing="0" cellpadding="0">
  <?php
  for($li=1;$li<11;$li++){?>
    <input type="hidden" name="spieler_<?php echo $li; ?>_raus" value="<?php echo $spieler_raus_c[$li]; ?>" >
    <?php
    if(($spieler_id_c[$li]>0)and($spieler_raus_c[$li]==0)){ 
      $zeiger3 = @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_id_c[$li]");
      $array3 = @mysql_fetch_array($zeiger3);?>
      <tr><td><input type="checkbox" name="spieler_<?php echo $li; ?>_raus" value="2" ></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $array3["nick"]; ?></td></tr>
  <?php }}?>
  </table></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['spiel']['beta']['ausscheiden']['wann']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
   <tr><td><input type="radio" name="out" value="3" <?php if ($spiel_out==3) { echo 'checked'; }?>></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['ausscheiden']['1']?></td></tr>
   <tr><td><input type="radio" name="out" value="2" <?php if ($spiel_out==2) { echo 'checked'; }?>></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['ausscheiden']['2']?></td></tr>
   <tr><td><input type="radio" name="out" value="1" <?php if ($spiel_out==1) { echo 'checked'; }?>></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['ausscheiden']['3']?></td></tr>
      <tr><td><input type="radio" name="out" value="0" <?php if ($spiel_out==0) { echo 'checked'; }?>></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['ausscheiden']['4']?></td></tr>
      </table></td></tr>
    <tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['spiel']['beta']['plasmasturm_frage']['1']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['plasmasturm_frage']['2']?></td><td>&nbsp;</td><td><select name="max" style="width:100px;">
    <option value="0" <?php if ($plasma_max==0) { echo 'selected'; }?>>0</option>
    <option value="1" <?php if ($plasma_max==1) { echo 'selected'; }?>>1</option>
    <option value="2" <?php if ($plasma_max==2) { echo 'selected'; }?>>2</option>
    <option value="3" <?php if ($plasma_max==3) { echo 'selected'; }?>>3</option>
    <option value="4" <?php if ($plasma_max==4) { echo 'selected'; }?>>4</option>
    <option value="5" <?php if ($plasma_max==5) { echo 'selected'; }?>>5</option>
    <option value="6" <?php if ($plasma_max==6) { echo 'selected'; }?>>6</option>
    <option value="7" <?php if ($plasma_max==7) { echo 'selected'; }?>>7</option>
    <option value="8" <?php if ($plasma_max==8) { echo 'selected'; }?>>8</option>
    <option value="9" <?php if ($plasma_max==9) { echo 'selected'; }?>>9</option>
    <option value="10" <?php if ($plasma_max==10) { echo 'selected'; }?>>10</option>
    </select></td></tr>
      <tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['plasmasturm_frage']['3']?></td><td>&nbsp;</td><td><select name="wahr" style="width:100px;">
  <?php for($p=1;$p<21;$p++){ ?>
    <option value="<?php echo $prozentarray[$p]?>"><?php echo str_replace('{1}',$prozentarray[$p],$lang['admin']['spiel']['beta']['vh']);?></option>
  <?php } ?>
    </select></td></tr>
      <tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['plasmasturm_frage']['4']?></td><td>&nbsp;</td><td><select name="llang" style="width:100px;">
  <?php for($p=3;$p<13;$p++){ ?>
    <option value="<?php echo $prozentarray[$p]?>"><?php echo str_replace('{1}',$prozentarray[$p],$lang['admin']['spiel']['beta']['runden']);?></option>
  <?php } ?>
    </select></td></tr>
      </table></td></tr>
<tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['spiel']['beta']['nebel']['wie']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td><input type="radio" name="nebel" value="0" <?php if ($nebel==0) { echo 'checked'; }?>></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['nebel']['1']?></td></tr>
      <tr><td><input type="radio" name="nebel" value="1" <?php if ($nebel==1) { echo 'checked'; }?>></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['nebel']['2']?></td></tr>
      <tr><td><input type="radio" name="nebel" value="2" <?php if ($nebel==2) { echo 'checked'; }?>></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['nebel']['3']?></td></tr>
      <tr><td><input type="radio" name="nebel" value="3" <?php if ($nebel==3) { echo 'checked'; }?>></td><td>&nbsp;</td><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['nebel']['4']?></td></tr>
     </table></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><?php echo $lang['admin']['spiel']['beta']['raumpiratenfrage']['1']?></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr><td><table border="0" cellspacing="0" cellpadding="0">
      <tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['raumpiratenfrage']['2']?></td><td>&nbsp;</td><td><select name="piraten_mitte" style="width:60px;">
  <?php for($p=0;$p<21;$p++){ ?>
    <option value="<?php echo $prozentarray[$p]?>"><?php echo str_replace('{1}',$prozentarray[$p],$lang['admin']['spiel']['beta']['vh']);?></option>
  <?php } ?>
    </select></td></tr>
      <tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['raumpiratenfrage']['3']?></td><td>&nbsp;</td><td><select name="piraten_aussen" style="width:60px;">
  <?php for($p=0;$p<21;$p++){ ?>
    <option value="<?php echo $prozentarray[$p]?>"><?php echo str_replace('{1}',$prozentarray[$p],$lang['admin']['spiel']['beta']['vh']);?></option>
  <?php } ?>
    </select></td></tr>
      <tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['raumpiratenfrage']['4']?></td><td>&nbsp;</td><td><select name="piraten_min" style="width:60px;">
  <?php for($p=1;$p<21;$p++){ ?>
    <option value="<?php echo $prozentarray[$p]?>"><?php echo str_replace('{1}',$prozentarray[$p],$lang['admin']['spiel']['beta']['vh']);?></option>
  <?php } ?>
    </select></td></tr>
      <tr><td style="color:#aaaaaa;"><?php echo $lang['admin']['spiel']['beta']['raumpiratenfrage']['5']?></td><td>&nbsp;</td><td><select name="piraten_max" style="width:60px;">
  <?php for($p=1;$p<21;$p++){ ?>
    <option value="<?php echo $prozentarray[$p]?>"><?php echo str_replace('{1}',$prozentarray[$p],$lang['admin']['spiel']['beta']['vh']);?></option>
  <?php } ?>
    </select></td></tr>
      </table></td></tr>
    <tr><td>&nbsp;</td></tr>
</table></center>
<center><table border="0" cellspacing="0" cellpadding="0"><tr>
<td><input type="submit" name="bla" value="<?php echo $lang['admin']['spiel']['beta']['aendern']?>"></td><td></form></td>
</tr></table></center><br>
<?php
}
include ("inc.footer.php");
}
if ($fuid==3) {
  include ("inc.header.php");
  if (($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)) {
  $spiel = int_get('slot_id');
  $spiel_name = str_post('spiel_name','SQLSAFE');
  $module = array();
  $module[0] = int_post('modul_0');
  $module[1] = 0;
  $module[2] = int_post('modul_2');
  $module[3] = int_post('modul_3');
  $module[4] = int_post('modul_4');
  $module[5] = int_post('modul_5');
  $module[6] = int_post('modul_6');
  $module = @implode(":", $module);
  $aufloesung=int_post('aufloesung');
  $autotick=int_post('autotick');
  $out=int_post('out');
  $max=int_post('max');
  $wahr=int_post('wahr');
  $llang=int_post('llang');
  $nebel=int_post('nebel');
  $piraten_mitte=int_post('piraten_mitte');
  $piraten_aussen=int_post('piraten_aussen');
  $piraten_min=int_post('piraten_min');
  $piraten_max=int_post('piraten_max');
  $spieler_raus[1]=int_post('spieler_1_raus');
  $spieler_raus[2]=int_post('spieler_2_raus');
  $spieler_raus[3]=int_post('spieler_3_raus');
  $spieler_raus[4]=int_post('spieler_4_raus');
  $spieler_raus[5]=int_post('spieler_5_raus');
  $spieler_raus[6]=int_post('spieler_6_raus');
  $spieler_raus[7]=int_post('spieler_7_raus');
  $spieler_raus[8]=int_post('spieler_8_raus');
  $spieler_raus[9]=int_post('spieler_9_raus');
  $spieler_raus[10]=int_post('spieler_10_raus');
  $zeiger = @mysql_query("SELECT spiel,partei_a,partei_b,status,optionen FROM $skrupel_politik where spiel=$spiel");
  $polanzahl = @mysql_num_rows($zeiger);
  if ($polanzahl>=1) {
    for  ($i=0; $i<$polanzahl;$i++) {
      $ok = @mysql_data_seek($zeiger,$i);
      $array = @mysql_fetch_array($zeiger);
      $status=$array["status"];
      $partei_a=$array["partei_a"];
      $partei_b=$array["partei_b"];
      $beziehung[$partei_a][$partei_b]['status']=$status;
      $beziehung[$partei_b][$partei_a]['status']=$status;
      $beziehung[$partei_a][$partei_b]['optionen']=$optionen;
      $beziehung[$partei_b][$partei_a]['optionen']=$optionen;
    }
  }
  for($li=1;$li<11;$li++) {
    if($spieler_raus[$li]==2) {
      $zeiger = @mysql_query("SELECT besitzer,id,spiel FROM $skrupel_sternenbasen where besitzer=$li and spiel=$spiel order by id");
      $basenanzahl = @mysql_num_rows($zeiger);
      if ($basenanzahl>=1) {
        for  ($i=0; $i<$basenanzahl;$i++) {
          $ok = @mysql_data_seek($zeiger,$i);
          $array = @mysql_fetch_array($zeiger);
          $baid=$array["id"];
          $zeiger_temp = @mysql_query("DELETE FROM $skrupel_huellen where baid=$baid;");
          }
      }
      $zeiger = @mysql_query("SELECT * FROM $skrupel_spiele where id=$spiel");
      $ok = @mysql_data_seek($zeiger,0);
      $a_runde = @mysql_fetch_array($zeiger);
      $runde=$a_runde["runde"];
      if($runde>49){
        $zeiger = @mysql_query("UPDATE $skrupel_sternenbasen set besitzer=0 where besitzer=$li and spiel=$spiel");
      }else{
        $zeiger = @mysql_query("DELETE FROM $skrupel_sternenbasen where besitzer=$li and spiel=$spiel");
      }
      $zeiger = @mysql_query("SELECT * FROM $skrupel_schiffe where besitzer=$li and spiel=$spiel");
      $schiffanzahl = @mysql_num_rows($zeiger);
      if ($schiffanzahl>=1) {
        for  ($i=0; $i<$schiffanzahl;$i++) {
          $ok = @mysql_data_seek($zeiger,$i);
          $array = @mysql_fetch_array($zeiger);
          $shid=$array["id"];
          $zeiger_temp = @mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 's:$shid:%'");
          $zeiger_temp = @mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where flug=3 and zielid=$shid");
        }
      }
      $zeiger = @mysql_query("DELETE FROM $skrupel_schiffe where besitzer=$li and spiel=$spiel");
      $zeiger = @mysql_query("DELETE FROM $skrupel_politik where spiel=$spiel and (partei_a=$li or partei_b=$li)");
      $zeiger = @mysql_query("UPDATE $skrupel_planeten set kolonisten=0,besitzer=0,minen=0,vorrat=0,cantox=0,auto_minen=0,fabriken=0,auto_fabriken=0,abwehr=0,auto_abwehr=0,auto_vorrat=0,logbuch='' where besitzer=$li and spiel=$spiel");
      $zeiger = @mysql_query("UPDATE $skrupel_planeten set kolonisten_new=0,kolonisten_spieler=0 where kolonisten_spieler=$sli and spiel=$spiel");
      $zeiger = @mysql_query("DELETE FROM $skrupel_neuigkeiten where spieler_id=$li and spiel_id=$spiel");
      $spielerraus="spieler_".$li."_raus";
      $spielerzug="spieler_".$li."_zug";
      $zeiger = @mysql_query("UPDATE $skrupel_spiele set $spielerraus=1,spieleranzahl=spieleranzahl-1,$spielerzug=0 where id=$spiel");
      $zeiger = @mysql_query("UPDATE $skrupel_user set uid='',bildpfad='' where id=$spieler_id");
    }
  }
  $zeiger = @mysql_query("UPDATE $skrupel_spiele set
    module='$module',
    plasma_wahr=$wahr,
    plasma_lang=$llang,
    plasma_max=$max,
    oput=$out,
    autozug=$autotick,
    nebel=$nebel,
    aufloesung=$aufloesung,
    name='$spiel_name',
    piraten_mitte=$piraten_mitte,
    piraten_aussen=$piraten_aussen,
    piraten_min=$piraten_min,
    piraten_max=$piraten_max
  where id=$spiel");
  ?>
  <body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <center><table border="0" height="100%" cellspacing="0" cellpadding="0">
    <tr>
      <td><?php echo $lang['admin']['spiel']['beta']['aktualisiertn']?><br><br><br>
      <center><table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><form name="formular"  method="post" action="spiel_beta.php?fu=2&slot_id=<?php echo $spiel;?>"></td>
          <td><input type="submit" name="bla" value="<?php echo $lang['admin']['spiel']['beta']['zurueck']?>"></td><td></form></td>
        </tr>
      </table></center></td>
    </tr>
  </table></center>
  <?php
  } 
  include ("inc.footer.php");
}
if ($fuid==4) {
include ("inc.header.php");
if (($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)) {
$spiel=int_get('slot_id');
?>
<body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center><table border="0" height="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td><center><?php echo $lang['admin']['spiel']['beta']['geduld']?></center></td>
    </tr>
</table></center>
<script language=JavaScript>
  window.location='spiel_beta.php?fu=5&slot_id=<?php echo $spiel; ?>';
 </script>
<?php
} include ("inc.footer.php");
 }
if ($fuid==5) {
include ("inc.header.php");
if (($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)) {
$spiel=int_get('slot_id');
    $zeiger2 = @mysql_query("SELECT * FROM $skrupel_spiele where id='$spiel'");
    $datensaetze2 = @mysql_num_rows($zeiger2);
    if ($datensaetze2==1) {
         $array2 = @mysql_fetch_array($zeiger2);
         $sid=$array2["sid"];
         $phase=$array2["phase"];
         $module = @explode(":", $array2['module']);
      $spieler_1=$array2["spieler_1"];
            $spieler_2=$array2["spieler_2"];
            $spieler_3=$array2["spieler_3"];
            $spieler_4=$array2["spieler_4"];
            $spieler_5=$array2["spieler_5"];
            $spieler_6=$array2["spieler_6"];
            $spieler_7=$array2["spieler_7"];
            $spieler_8=$array2["spieler_8"];
            $spieler_9=$array2["spieler_9"];
            $spieler_10=$array2["spieler_10"];
      $spieler_id_c[1]=$array2["spieler_1"];
      $spieler_id_c[2]=$array2["spieler_2"];
      $spieler_id_c[3]=$array2["spieler_3"];
      $spieler_id_c[4]=$array2["spieler_4"];
      $spieler_id_c[5]=$array2["spieler_5"];
      $spieler_id_c[6]=$array2["spieler_6"];
      $spieler_id_c[7]=$array2["spieler_7"];
      $spieler_id_c[8]=$array2["spieler_8"];
      $spieler_id_c[9]=$array2["spieler_9"];
      $spieler_id_c[10]=$array2["spieler_10"];
            $spieler_1_zug=$array2["spieler_1_zug"];
            $spieler_2_zug=$array2["spieler_2_zug"];
            $spieler_3_zug=$array2["spieler_3_zug"];
            $spieler_4_zug=$array2["spieler_4_zug"];
            $spieler_5_zug=$array2["spieler_5_zug"];
            $spieler_6_zug=$array2["spieler_6_zug"];
            $spieler_7_zug=$array2["spieler_7_zug"];
            $spieler_8_zug=$array2["spieler_8_zug"];
            $spieler_9_zug=$array2["spieler_9_zug"];
            $spieler_10_zug=$array2["spieler_10_zug"];
            $spieler_zug_c[1]=$array2["spieler_1_zug"];
            $spieler_zug_c[2]=$array2["spieler_2_zug"];
            $spieler_zug_c[3]=$array2["spieler_3_zug"];
            $spieler_zug_c[4]=$array2["spieler_4_zug"];
            $spieler_zug_c[5]=$array2["spieler_5_zug"];
            $spieler_zug_c[6]=$array2["spieler_6_zug"];
            $spieler_zug_c[7]=$array2["spieler_7_zug"];
            $spieler_zug_c[8]=$array2["spieler_8_zug"];
            $spieler_zug_c[9]=$array2["spieler_9_zug"];
            $spieler_zug_c[10]=$array2["spieler_10_zug"];
      $spieler_admin=$array2["spieler_admin"];
      $spieler_1_rasse=$array2["spieler_1_rasse"];
      $spieler_2_rasse=$array2["spieler_2_rasse"];
      $spieler_3_rasse=$array2["spieler_3_rasse"];
      $spieler_4_rasse=$array2["spieler_4_rasse"];
      $spieler_5_rasse=$array2["spieler_5_rasse"];
      $spieler_6_rasse=$array2["spieler_6_rasse"];
      $spieler_7_rasse=$array2["spieler_7_rasse"];
      $spieler_8_rasse=$array2["spieler_8_rasse"];
      $spieler_9_rasse=$array2["spieler_9_rasse"];
      $spieler_10_rasse=$array2["spieler_10_rasse"];
      $spieler_rasse_c[1]=$array2["spieler_1_rasse"];
      $spieler_rasse_c[2]=$array2["spieler_2_rasse"];
      $spieler_rasse_c[3]=$array2["spieler_3_rasse"];
      $spieler_rasse_c[4]=$array2["spieler_4_rasse"];
      $spieler_rasse_c[5]=$array2["spieler_5_rasse"];
      $spieler_rasse_c[6]=$array2["spieler_6_rasse"];
      $spieler_rasse_c[7]=$array2["spieler_7_rasse"];
      $spieler_rasse_c[8]=$array2["spieler_8_rasse"];
      $spieler_rasse_c[9]=$array2["spieler_9_rasse"];
      $spieler_rasse_c[10]=$array2["spieler_10_rasse"];
    $spieler_rassename_c[1]=$array2["spieler_1_rassename"];
  $spieler_rassename_c[2]=$array2["spieler_2_rassename"];
  $spieler_rassename_c[3]=$array2["spieler_3_rassename"];
  $spieler_rassename_c[4]=$array2["spieler_4_rassename"];
  $spieler_rassename_c[5]=$array2["spieler_5_rassename"];
  $spieler_rassename_c[6]=$array2["spieler_6_rassename"];
  $spieler_rassename_c[7]=$array2["spieler_7_rassename"];
  $spieler_rassename_c[8]=$array2["spieler_8_rassename"];
  $spieler_rassename_c[9]=$array2["spieler_9_rassename"];
  $spieler_rassename_c[10]=$array2["spieler_10_rassename"];
  $spieler_1_basen=$array2["spieler_1_basen"];$spieler_1_planeten=$array2["spieler_1_planeten"];$spieler_1_schiffe=$array2["spieler_1_schiffe"];
  $spieler_2_basen=$array2["spieler_2_basen"];$spieler_2_planeten=$array2["spieler_2_planeten"];$spieler_2_schiffe=$array2["spieler_2_schiffe"];
  $spieler_3_basen=$array2["spieler_3_basen"];$spieler_3_planeten=$array2["spieler_3_planeten"];$spieler_3_schiffe=$array2["spieler_3_schiffe"];
  $spieler_4_basen=$array2["spieler_4_basen"];$spieler_4_planeten=$array2["spieler_4_planeten"];$spieler_4_schiffe=$array2["spieler_4_schiffe"];
  $spieler_5_basen=$array2["spieler_5_basen"];$spieler_5_planeten=$array2["spieler_5_planeten"];$spieler_5_schiffe=$array2["spieler_5_schiffe"];
  $spieler_6_basen=$array2["spieler_6_basen"];$spieler_6_planeten=$array2["spieler_6_planeten"];$spieler_6_schiffe=$array2["spieler_6_schiffe"];
  $spieler_7_basen=$array2["spieler_7_basen"];$spieler_7_planeten=$array2["spieler_7_planeten"];$spieler_7_schiffe=$array2["spieler_7_schiffe"];
  $spieler_8_basen=$array2["spieler_8_basen"];$spieler_8_planeten=$array2["spieler_8_planeten"];$spieler_8_schiffe=$array2["spieler_8_schiffe"];
  $spieler_9_basen=$array2["spieler_9_basen"];$spieler_9_planeten=$array2["spieler_9_planeten"];$spieler_9_schiffe=$array2["spieler_9_schiffe"];
  $spieler_10_basen=$array2["spieler_10_basen"];$spieler_10_planeten=$array2["spieler_10_planeten"];$spieler_10_schiffe=$array2["spieler_10_schiffe"];
  $spieler_basen_c[1]=$array2["spieler_1_basen"];$spieler_planeten_c[1]=$array2["spieler_1_planeten"];$spieler_schiffe_c[1]=$array2["spieler_1_schiffe"];
  $spieler_basen_c[2]=$array2["spieler_2_basen"];$spieler_planeten_c[2]=$array2["spieler_2_planeten"];$spieler_schiffe_c[2]=$array2["spieler_2_schiffe"];
  $spieler_basen_c[3]=$array2["spieler_3_basen"];$spieler_planeten_c[3]=$array2["spieler_3_planeten"];$spieler_schiffe_c[3]=$array2["spieler_3_schiffe"];
  $spieler_basen_c[4]=$array2["spieler_4_basen"];$spieler_planeten_c[4]=$array2["spieler_4_planeten"];$spieler_schiffe_c[4]=$array2["spieler_4_schiffe"];
  $spieler_basen_c[5]=$array2["spieler_5_basen"];$spieler_planeten_c[5]=$array2["spieler_5_planeten"];$spieler_schiffe_c[5]=$array2["spieler_5_schiffe"];
  $spieler_basen_c[6]=$array2["spieler_6_basen"];$spieler_planeten_c[6]=$array2["spieler_6_planeten"];$spieler_schiffe_c[6]=$array2["spieler_6_schiffe"];
  $spieler_basen_c[7]=$array2["spieler_7_basen"];$spieler_planeten_c[7]=$array2["spieler_7_planeten"];$spieler_schiffe_c[7]=$array2["spieler_7_schiffe"];
  $spieler_basen_c[8]=$array2["spieler_8_basen"];$spieler_planeten_c[8]=$array2["spieler_8_planeten"];$spieler_schiffe_c[8]=$array2["spieler_8_schiffe"];
  $spieler_basen_c[9]=$array2["spieler_9_basen"];$spieler_planeten_c[9]=$array2["spieler_9_planeten"];$spieler_schiffe_c[9]=$array2["spieler_9_schiffe"];
  $spieler_basen_c[10]=$array2["spieler_10_basen"];$spieler_planeten_c[10]=$array2["spieler_10_planeten"];$spieler_schiffe_c[10]=$array2["spieler_10_schiffe"];
  $spieler_1_gesamt=$array2["spieler_1_platz"];
  $spieler_2_gesamt=$array2["spieler_2_platz"];
  $spieler_3_gesamt=$array2["spieler_3_platz"];
  $spieler_4_gesamt=$array2["spieler_4_platz"];
  $spieler_5_gesamt=$array2["spieler_5_platz"];
  $spieler_6_gesamt=$array2["spieler_6_platz"];
  $spieler_7_gesamt=$array2["spieler_7_platz"];
  $spieler_8_gesamt=$array2["spieler_8_platz"];
  $spieler_9_gesamt=$array2["spieler_9_platz"];
  $spieler_10_gesamt=$array2["spieler_10_platz"];
  $spieler_gesamt_c[1]=$array2["spieler_1_platz"];
  $spieler_gesamt_c[2]=$array2["spieler_2_platz"];
  $spieler_gesamt_c[3]=$array2["spieler_3_platz"];
  $spieler_gesamt_c[4]=$array2["spieler_4_platz"];
  $spieler_gesamt_c[5]=$array2["spieler_5_platz"];
  $spieler_gesamt_c[6]=$array2["spieler_6_platz"];
  $spieler_gesamt_c[7]=$array2["spieler_7_platz"];
  $spieler_gesamt_c[8]=$array2["spieler_8_platz"];
  $spieler_gesamt_c[9]=$array2["spieler_9_platz"];
  $spieler_gesamt_c[10]=$array2["spieler_10_platz"];
      $spieler_1_raus=$array2["spieler_1_raus"];
      $spieler_2_raus=$array2["spieler_2_raus"];
      $spieler_3_raus=$array2["spieler_3_raus"];
      $spieler_4_raus=$array2["spieler_4_raus"];
      $spieler_5_raus=$array2["spieler_5_raus"];
      $spieler_6_raus=$array2["spieler_6_raus"];
      $spieler_7_raus=$array2["spieler_7_raus"];
      $spieler_8_raus=$array2["spieler_8_raus"];
      $spieler_9_raus=$array2["spieler_9_raus"];
      $spieler_10_raus=$array2["spieler_10_raus"];
      $spieler_raus_c[1]=$array2["spieler_1_raus"];
      $spieler_raus_c[2]=$array2["spieler_2_raus"];
      $spieler_raus_c[3]=$array2["spieler_3_raus"];
      $spieler_raus_c[4]=$array2["spieler_4_raus"];
      $spieler_raus_c[5]=$array2["spieler_5_raus"];
      $spieler_raus_c[6]=$array2["spieler_6_raus"];
      $spieler_raus_c[7]=$array2["spieler_7_raus"];
      $spieler_raus_c[8]=$array2["spieler_8_raus"];
      $spieler_raus_c[9]=$array2["spieler_9_raus"];
      $spieler_raus_c[10]=$array2["spieler_10_raus"];
      $ziel_id=$array2["ziel_id"];
      $ziel_info=$array2["ziel_info"];
      $spieler_1_ziel=$array2["spieler_1_ziel"];
      $spieler_2_ziel=$array2["spieler_2_ziel"];
      $spieler_3_ziel=$array2["spieler_3_ziel"];
      $spieler_4_ziel=$array2["spieler_4_ziel"];
      $spieler_5_ziel=$array2["spieler_5_ziel"];
      $spieler_6_ziel=$array2["spieler_6_ziel"];
      $spieler_7_ziel=$array2["spieler_7_ziel"];
      $spieler_8_ziel=$array2["spieler_8_ziel"];
      $spieler_9_ziel=$array2["spieler_9_ziel"];
      $spieler_10_ziel=$array2["spieler_10_ziel"];
      $spieler_ziel_c[1]=$array2["spieler_1_ziel"];
      $spieler_ziel_c[2]=$array2["spieler_2_ziel"];
      $spieler_ziel_c[3]=$array2["spieler_3_ziel"];
      $spieler_ziel_c[4]=$array2["spieler_4_ziel"];
      $spieler_ziel_c[5]=$array2["spieler_5_ziel"];
      $spieler_ziel_c[6]=$array2["spieler_6_ziel"];
      $spieler_ziel_c[7]=$array2["spieler_7_ziel"];
      $spieler_ziel_c[8]=$array2["spieler_8_ziel"];
      $spieler_ziel_c[9]=$array2["spieler_9_ziel"];
      $spieler_ziel_c[10]=$array2["spieler_10_ziel"];
      $nebel=$array2["nebel"];
      $aufloesung=$array2["aufloesung"];
      $spieleranzahl=$array2["spieleranzahl"];
      $spiel_name=$array2["name"];
      $umfang=$array2["umfang"];
      $spiel_out=$array2["oput"];
      $plasma_wahr=$array2["plasma_wahr"];
      $plasma_max=$array2["plasma_max"];
      $plasma_lang=$array2["plasma_lang"];
      $piraten_mitte=$array2["piraten_mitte"];
        $piraten_aussen=$array2["piraten_aussen"];
        $piraten_min=$array2["piraten_min"];
        $piraten_max=$array2["piraten_max"];
for ($mn=1;$mn<11;$mn++) {
    if ($spieler_id_c[$mn]==$spieler_id) {$spieler=$mn;$spieler_raus=$spieler_raus_c[$mn];$zug_abgeschlossen=$spieler_zug_c[$mn];$spieler_rasse=$spieler_rasse_c[$mn];$spieler_ziel=$spieler_ziel_c[$mn];}
}
    }
$main_verzeichnis="../";
include ("../inhalt/inc.host.php");
  $lasttick=time();
  $zeiger = mysql_query("UPDATE $skrupel_spiele set lasttick='$lasttick',spieler_1_zug=0,spieler_2_zug=0,spieler_3_zug=0,spieler_4_zug=0,spieler_5_zug=0,spieler_6_zug=0,spieler_7_zug=0,spieler_8_zug=0,spieler_9_zug=0,spieler_10_zug=0 where sid='$sid';");
?>
<body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center><table border="0" height="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $lang['admin']['spiel']['beta']['fertig']?><br><br><br>
    <center><table border="0" cellspacing="0" cellpadding="0"><tr>
<td><form name="formular"  method="post" action="spiel_beta.php?fu=2&slot_id=<?php echo $spiel; ?>"></td>
<td><input type="submit" name="bla" value="<?php echo $lang['admin']['spiel']['beta']['zurueck']?>"></td><td></form></td>
</tr></table></center></td>
    </tr>
</table></center>
<?php
} include ("inc.footer.php");
 }
