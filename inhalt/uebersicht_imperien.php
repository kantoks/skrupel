<?php
include ('../inc.conf.php');
include_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'uebersicht_imperien';
$fuid = int_get('fu');

if ($fuid==1) {
    include ("inc.header.php");
        $farbe="5f4444";
        ?>
        <body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <div id="bodybody" class="flexcroll" onfocus="this.blur()">
            <table border="0" cellspacing="0" cellpadding="0" height="100%" width="100%">
                <tr>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0" width="100%">
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                                <td valign="top">
                                    <center>
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td><center><img src="../lang/<?php echo $spieler_sprache?>/topics/siegbedingungen.gif" border="0" width="199" height="52"></center></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:center"><input type="button" onClick="var inner = this.parentNode.getElementsByTagName('table')[0]; if (inner.style.display == 'none'){inner.style.display = 'block';this.value=' - ';}else{inner.style.display = 'none';this.value=' + ';}" value=" + ">
                                                            <table cellspacing="0" cellpadding="0" rules="none" style="display:none; border:2pt #FFF solid">
                                                                <tr>
                                                                    <td>
                                                    <?php if ($ziel_id==0) { 
                                                       echo $lang['uebersichtimperien']['justforfun'];
                                                     } 
                                                    if ($ziel_id==1) {
                                                        $text=str_replace(array('{1}','{2}'),array($ziel_info,$spieleranzahl),$lang['uebersichtimperien']['ueberleben']);
                                                              echo $text; } 
                                                    if ($ziel_id==2) {
                                                        $feind=intval($spieler_ziel);
                                                        $feind_id=$spieler_id_c[$feind];
                                                        $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$feind_id");
                                                        $array_temp = @mysql_fetch_array($zeiger_temp);
                                                        $username=$array_temp["nick"];
                                                        $todfeind="<font color='".$spielerfarbe[$feind]."'>".$username."</font>";
                                                        $text=str_replace(array('{1}'),array($todfeind),$lang['uebersichtimperien']['todfeind']);
                                                                  echo $text; } 
                                                    if ($ziel_id==5) {
                                                        $text=str_replace(array('{1}','{2}'),array($ziel_info,$spieler_ziel),$lang['uebersichtimperien']['spice']);
                                                                  echo $text; } 
                                                    if ($ziel_id==6) {
                                                        $zieldaten=explode(':',$spieler_ziel);
                                                        $feinda=intval($zieldaten[1]);
                                                        $feinda_id=$spieler_id_c[$feinda];
                                                        $feindb=intval($zieldaten[2]);
                                                        $feindb_id=$spieler_id_c[$feindb];
                                                        $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$feinda_id");
                                                        $array_temp = @mysql_fetch_array($zeiger_temp);
                                                        $username=$array_temp["nick"];
                                                        $todfeinda="<font color='".$spielerfarbe[$feinda]."'>".$username."</font>";
                                                        $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$feindb_id");
                                                        $array_temp = @mysql_fetch_array($zeiger_temp);
                                                        $username=$array_temp["nick"];
                                                        $todfeindb="<font color='".$spielerfarbe[$feindb]."'>".$username."</font>";
                                                        $text=str_replace(array('{1}','{2}'),array($todfeinda,$todfeindb),$lang['uebersichtimperien']['teamtodfeind']);
                                                        echo $text; } ?>
                                                                   </td>
                                            </tr>
                                        </table>
                                    </center><br>
                                    <center>
                                        <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                            <tr>
                                                <td width="100%" colspan="3"><img src="../lang/<?php echo $spieler_sprache?>/topics/dieimperien.gif" border="0" width="185" height="52"></td>
                                                <td><center><img src="<?php echo $bildpfad?>/aufbau/rang_1.gif" border="0" width="41" height="41"></center></td>
                                                <td><center><img src="<?php echo $bildpfad?>/aufbau/rang_2.gif" border="0" width="41" height="41"></center></td>
                                                <td><center><img src="<?php echo $bildpfad?>/aufbau/rang_3.gif" border="0" width="41" height="41"></center></td>
                                                <td><center><img src="<?php echo $bildpfad?>/aufbau/rang_4.gif" border="0" width="113" height="41"></center></td>
                                            </tr>
                                            <?php
                                            for ($k=1;$k<11;$k++) {
                                                if ($spieler_id_c[$k]>=1) {
                                                    $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_id_c[$k]");
                                                    $array_temp = @mysql_fetch_array($zeiger_temp);
                                                    $username=$array_temp["nick"];
                                                    if ($spieler_raus_c[$k]==1) { $username="<s>".$username."</s>"; }
                                                    if ($spieler_raus_c[$k]==0) {
                                                        if ($spieler_zug_c[$k]==1) {
                                                            echo '<tr>';
                                                        } else {
                                                            echo '<tr bgcolor="#'.$farbe.'">';
                                                        }
                                                    }
                                                    ?>
                                                        <td><a href="meta_rassen.php?fu=2&uid=<?php echo $uid?>&sid=<?php echo $sid?>&rasse=<?php echo$spieler_rasse_c[$k]?>"><img src="../daten/<?php echo $spieler_rasse_c[$k]?>/bilder_allgemein/menu.png" width="186" height="75" border="0"></a></td>
                                                        <td>&nbsp;</td>
                                                        <td style="color:<?php echo $spielerfarbe[$k]?>;font-size:12px;" width="100%"><?php echo $spieler_rassename_c[$k]?><?php if ($spieler==$k) {?> <a href="uebersicht_imperien.php?fu=2&spid=<?php echo $spieler?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>" style="font-size:9px;">(<?php echo $lang['uebersichtimperien']['edit']?>)</a><?php }?><br><br><nobr><a href="uebersicht_imperien.php?fu=4&spid=<?php echo $spieler_id_c[$k]?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"><?php echo $username?></a></nobr></td>
                                                        <td style="font-size:11px;"><nobr><center><?php echo $spieler_basen_c[$k]?>.</center></nobr></td>
                                                        <td style="font-size:11px;"><nobr><center><?php echo $spieler_planeten_c[$k]?>.</center></nobr></td>
                                                        <td style="font-size:11px;"><nobr><center><?php echo $spieler_schiffe_c[$k]?>.</center></nobr></td>
                                                        <td style="font-size:12px;"><nobr><b><center><?php echo $spieler_gesamt_c[$k]; ?>.</center></b></nobr></td>
                                                    </tr><?php
                                                }
                                            }
                                            ?>
                                        </table>
                                    </center>
                                </td>
                                <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                            </tr>
                        </table><br>
                    </td>
                </tr>
            </table>
            </div>
            <?php
    include ("inc.footer.php");
}
if ($fuid==2) {
    include ("inc.header.php");
        if ($spieler==int_get('spid')) {
            $rassenname=$spieler_rassename_c[$spieler];
            ?>
            <body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
                <table border="0" cellspacing="0" cellpadding="0" height="100%" width="100%">
                    <tr>
                        <td>
                            <center>
                                <table border="0" cellspacing="0" cellpadding="5">
                                    <form name="formular" method="post" action="uebersicht_imperien.php?fu=3&spid=<?php echo $spieler?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>">
                                        <tr>
                                            <td></td>
                                            <td><input type="text" name="neu_name" class="eingabe" value="<?php echo $rassenname?>" maxlength="40" style="width:250px;"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><input type="submit" name="bla" value="<?php echo $lang['uebersichtimperien']['umbenennen']?>" style="width:250px;"></td>
                                            <td></td>
                                        </tr>
                                    </form>
                                </table>
                            </center>
                        </td>
                    </tr>
                </table>
                <?php
        }
    include ("inc.footer.php");
}
if ($fuid==3) {
    include ("inc.header.php");
        if ($spieler==int_get('spid')) {
            $spalte="spieler_".$spieler."_rassename";
            $zeiger_temp= @mysql_query("UPDATE $skrupel_spiele set $spalte='".str_post('neu_name','SQLSAFE')."' where id=$spiel");
            ?>
            <script language=JavaScript>
                window.location='uebersicht_imperien.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>';
            </script>
            <?php
        }
    include ("inc.footer.php");
}
if ($fuid==4) {
    include ("inc.header.php");
        $spid=int_get('spid');
        $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$spid");
        $array_temp = @mysql_fetch_array($zeiger_temp);
        $nick=$array_temp["nick"];
        $userid=$array_temp["id"];
        $email=$array_temp["email"];
        $icq=$array_temp["icq"];
        $homepage=$array_temp["homepage"];
        $avatar=$array_temp["avatar"];
        $stat_teilnahme=$array_temp["stat_teilnahme"];
        $stat_sieg=$array_temp["stat_sieg"];
        $stat_schlacht=$array_temp["stat_schlacht"];
        $stat_schlacht_sieg=$array_temp["stat_schlacht_sieg"];
        $stat_kol_erobert=$array_temp["stat_kol_erobert"];
        $stat_lichtjahre=$array_temp["stat_lichtjahre"];
        $stat_monate=$array_temp["stat_monate"];

        ?>
<body text="#ffffff" bgcolor="#444444"  link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<br><center><?php if ($avatar) {?><img src="<?php echo $avatar;?>"><?php }?><br>
<table cellpadding="1" cellspacing="0" border="1" width="50%">
  <colgroup>
    <col width="40%">
    <col width="60%">
  </colgroup>
<caption align="top"><h1 style="text-decoration:underline; white-space:nowrap"><?php echo $nick;?></h1></caption>
  <?php if ($icq) { ?> <tr><td><b>ICQ</b></td><td><a href="http://www.icq.com/people/<?php echo $icq; ?>" target="_blank"><?php echo $icq; ?></a><img src="http://web.icq.com/whitepages/online?icq=<?php echo $icq; ?>&img=5"></td></tr><?php } ?>
  <?php if ($homepage) { ?><tr><td><b><?php echo $lang['uebersichtimperien']['homepage']; ?></b></td><td><a href="<?php echo $homepage; ?>" target="_blank"><?php echo $homepage; ?></a></td></tr><?php } ?>
  <?php if ($email) { ?><tr><td><b><?php echo $lang['uebersichtimperien']['email']; ?></b></td><td><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></td></tr><?php } ?>
   <tr><td><b><?php echo $lang['uebersichtimperien']['stat_sieg']; ?></b></td><td><?php echo $stat_sieg.' '.$lang['uebersichtimperien']['von'].' '.$stat_teilnahme; ?></td></tr>
   <tr><td><b><?php echo $lang['uebersichtimperien']['stat_schlacht_sieg']; ?></b></td><td><?php echo $stat_schlacht_sieg.' '.$lang['uebersichtimperien']['von'].' '.$stat_schlacht; ?></td></tr>
   <tr><td><b><?php echo $lang['uebersichtimperien']['stat_kol_erobert']; ?></b></td><td><?php echo $stat_kol_erobert; ?></td></tr>
   <tr><td><b><?php echo $lang['uebersichtimperien']['stat_lichtjahre']; ?></b></td><td><?php echo $stat_lichtjahre; ?></td></tr>
   <tr><td><b><?php echo $lang['uebersichtimperien']['stat_monate']; ?></b></td><td><?php echo $stat_monate; ?></td></tr>
</table></center>
            <?php
    include ("inc.footer.php");
}