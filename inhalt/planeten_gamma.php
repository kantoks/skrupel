<?php 
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'planeten_gamma';
$fuid = int_get('fu');
$pid = int_get('pid');

if ($fuid==1) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_planeten where besitzer=$spieler and id=".$pid);
    $array = @mysql_fetch_array($zeiger);
    $pid=$array["id"];
    $name=$array["name"];
    $x_pos=$array["x_pos"];
    $y_pos=$array["y_pos"];
    $bild=$array["bild"];
    $temp=$array["temp"];
    $minen=$array["minen"];
    $cantox=$array["cantox"];
    $vorrat=$array["vorrat"];
    $osys_1=$array["osys_1"];
    $osys_2=$array["osys_2"];
    $osys_3=$array["osys_3"];
    $osys_4=$array["osys_4"];
    $osys_5=$array["osys_5"];
    $osys_6=$array["osys_6"];
    $kolonisten=$array["kolonisten"];
    $auto_minen=$array["auto_minen"];
    $planet_lemin=$array["planet_lemin"];
    $planet_min1=$array["planet_min1"];
    $planet_min2=$array["planet_min2"];
    $planet_min3=$array["planet_min3"];
    $konz_lemin=$array["konz_lemin"];
    $konz_min1=$array["konz_min1"];
    $konz_min2=$array["konz_min2"];
    $konz_min3=$array["konz_min3"];
    $metro_minen_plus=0;
    if(($osys_1==9) or ($osys_2==9) or ($osys_3==9) or ($osys_4==9) or ($osys_5==9) or ($osys_6==9)){
        $metro_minen_plus=24;
    }
    if ($konz_lemin==1) { $konz_lemin=$lang['planetengamma']['fluechtig']; }
    if ($konz_lemin==2) { $konz_lemin=$lang['planetengamma']['weitgestreut']; }
    if ($konz_lemin==3) { $konz_lemin=$lang['planetengamma']['verteilt']; }
    if ($konz_lemin==4) { $konz_lemin=$lang['planetengamma']['konzentriert']; }
    if ($konz_lemin==5) { $konz_lemin=$lang['planetengamma']['hochkonz']; }
    if ($konz_min1==1) { $konz_min1=$lang['planetengamma']['fluechtig']; }
    if ($konz_min1==2) { $konz_min1=$lang['planetengamma']['weitgestreut']; }
    if ($konz_min1==3) { $konz_min1=$lang['planetengamma']['verteilt']; }
    if ($konz_min1==4) { $konz_min1=$lang['planetengamma']['konzentriert']; }
    if ($konz_min1==5) { $konz_min1=$lang['planetengamma']['hochkonz']; }
    if ($konz_min2==1) { $konz_min2=$lang['planetengamma']['fluechtig']; }
    if ($konz_min2==2) { $konz_min2=$lang['planetengamma']['weitgestreut']; }
    if ($konz_min2==3) { $konz_min2=$lang['planetengamma']['verteilt']; }
    if ($konz_min2==4) { $konz_min2=$lang['planetengamma']['konzentriert']; }
    if ($konz_min2==5) { $konz_min2=$lang['planetengamma']['hochkonz']; }
    if ($konz_min3==1) { $konz_min3=$lang['planetengamma']['fluechtig']; }
    if ($konz_min3==2) { $konz_min3=$lang['planetengamma']['weitgestreut']; }
    if ($konz_min3==3) { $konz_min3=$lang['planetengamma']['verteilt']; }
    if ($konz_min3==4) { $konz_min3=$lang['planetengamma']['konzentriert']; }
    if ($konz_min3==5) { $konz_min3=$lang['planetengamma']['hochkonz']; }
    $max_cantox=floor($cantox/4);
    $max_vorrat=$vorrat;
    if ($max_cantox<=$max_vorrat) { $max_bau=$max_cantox; }
    if ($max_vorrat<=$max_cantox) { $max_bau=$max_vorrat; }
    if (($kolonisten/100)<=200) { $max_col=floor($kolonisten/100)+$metro_minen_plus; } else { $max_col=200+floor(sqrt($kolonisten/100))+$metro_minen_plus; }
    $max_minen=$minen+$max_bau;
    if ($max_minen>$max_col) { $max_minen=$max_col;$max_bau=$max_col-$minen;}
    if ($max_minen>400+$metro_minen_plus) {
        $max_minen=400+$metro_minen_plus;
        $max_bau=400-$minen+$metro_minen_plus;
    }
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td valign="top">
                        <table border="0" cellspacing="0" cellpadding="0" style="width:100%">
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="1" height="8"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="1" height="8"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="1" height="8"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="1" height="8"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="1" height="8"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="1" height="8"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="1" height="8"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="1" height="8"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="1" height="8"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="1" height="8"></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="9"><center><?php echo $lang['planetengamma']['minen']?></center></td>
                            </tr>
                            <tr>
                                <td colspan="10"><img src="../bilder/empty.gif" border="0" width="5" height="6"></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td rowspan="2"><img src="<?php echo $bildpfad?>/icons/minen.gif" border="0" width="17" height="17"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="2" style="color:#aaaaaa;"><nobr><?php echo $lang['planetengamma']['inbetrieb']?></nobr></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['planetengamma']['maximal']?></td>
                                <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                <td rowspan="2"><a href="javascript:hilfe(8);"><img src="<?php echo $bildpfad?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><?php echo $minen?></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><?php echo $max_minen?></td>
                                <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                            </tr>
                            <tr>
                                <td colspan="10"><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            </tr>
                        </table>
                        <?php
                        if ($max_bau>=1) {
                            ?>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><form name="formular" method="post" action="planeten_gamma.php?fu=3&pid=<?php echo $pid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                    <td>
                                        <select name="minenauftrag" style="font-family:Verdana;font-size:9px;width:50px;">
                                            <?php
                                            for ($i=1;$i<=$max_bau;$i++) 
                                                {
                                                ?>
                                                <option value=<?php echo $i?> <?php if ($i==$max_bau) { echo "selected"; } ?>><?php echo $i?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                    <td><input type="submit" value="<?php echo $lang['planetengamma']['minenbauen']?>" style="width:110px;"></td>
                                    <td></form></td>
                                </tr>
                                <tr>
                                    <td colspan="7"><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                            </table>
                            <?php
                        }
                        ?>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><form name="formular" method="post" action="planeten_gamma.php?fu=2&pid=<?php echo $pid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><input type="checkbox" name="minauto" value="1" style="width:25px;" <?php if ($auto_minen==1) { echo "checked"; }?>></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><input type="submit" value="<?php echo $lang['planetengamma']['mineauto']?>" style="width:135px;"></td>
                                <td></form></td>
                            </tr>
                        </table>
                    </td>
                    <td><img src="../bilder/empty.gif" border="0" width="13" height="1"></td>
                    <td>
                        <img src="../bilder/empty.gif" border="0" width="5" height="6"><br>
                        <iframe src="planeten_gamma.php?fu=12&pid=<?php echo $pid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>" width="97" height="97" name="map" scrolling="no" marginheight="0" marginwidth="0" frameborder="0"></iframe>
                    </td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td colspan="5"><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td rowspan="2"><img src="<?php echo $bildpfad?>/icons/lemin.gif" border="0" width="17" height="17"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['planetengamma']['lemin']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><?php echo str_replace('{1}',$planet_lemin,$lang['planetengamma']['kt'])?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td rowspan="2"><img src="<?php echo $bildpfad?>/icons/mineral_1.gif" border="0" width="17" height="17"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['planetengamma']['baxterium']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><?php echo str_replace('{1}',$planet_min1,$lang['planetengamma']['kt'])?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td rowspan="2"><img src="<?php echo $bildpfad?>/icons/mineral_2.gif" border="0" width="17" height="17"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['planetengamma']['rennurbin']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><?php echo str_replace('{1}',$planet_min2,$lang['planetengamma']['kt'])?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td rowspan="2"><img src="<?php echo $bildpfad?>/icons/mineral_3.gif" border="0" width="17" height="17"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['planetengamma']['vomisaan']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><?php echo str_replace('{1}',$planet_min3,$lang['planetengamma']['kt'])?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </center>
        <?php 
    include ("inc.footer.php");
}
if ($fuid==2) {
    include ("inc.header.php");
    ?>
    <body text="#000000" scroll="no" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php 
        $auto_minen=0;
        if (int_post('minauto')==1) { $auto_minen=1;$message="<center>".$lang['planetengamma']['mineautoja']."</center>"; } else { $auto_minen=0;$message="<center>".$lang['planetengamma']['mineautonein']."</center>"; }
        $zeiger = @mysql_query("update $skrupel_planeten set auto_minen=$auto_minen where id=".$pid." and besitzer=$spieler");
        ?>
        <br><br>
        <?php
        echo $message;
    include ("inc.footer.php");
}
if ($fuid==3) {
    include ("inc.header.php");
    ?>
    <body text="#000000" scroll="no" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php 
        $minenauftrag=int_post('minenauftrag');
        $zeiger = @mysql_query("SELECT * FROM $skrupel_planeten where besitzer=$spieler and id=".$pid);
        $array = @mysql_fetch_array($zeiger);
        $pid=$array["id"];
        $minen=$array["minen"];
        $cantox=$array["cantox"];
        $vorrat=$array["vorrat"];
        $kolonisten=$array["kolonisten"];
        $osys_1=$array["osys_1"];
        $osys_2=$array["osys_2"];
        $osys_3=$array["osys_3"];
        $osys_4=$array["osys_4"];
        $osys_5=$array["osys_5"];
        $osys_6=$array["osys_6"];
        $metro_minen_plus=0;
        if(($osys_1==9) or ($osys_2==9) or ($osys_3==9) or ($osys_4==9) or ($osys_5==9) or ($osys_6==9)){
            $metro_minen_plus=24;
        }
        $max_cantox=floor($cantox/4);
        $max_vorrat=$vorrat;
        if ($max_cantox<=$max_vorrat) { $max_bau=$max_cantox; }
        if ($max_vorrat<=$max_cantox) { $max_bau=$max_vorrat; }
        if (($kolonisten/100)<=200) { $max_col=floor($kolonisten/100)+$metro_minen_plus; } else { $max_col=200+floor(sqrt($kolonisten/100))+$metro_minen_plus; }
        $max_minen=$minen+$max_bau;
        if ($max_minen>$max_col) { $max_minen=$max_col;$max_bau=$max_col-$minen;}
        if ($max_minen>400+$metro_minen_plus) {
            $max_minen=400+$metro_minen_plus;
            $max_bau=400-$minen+$metro_minen_plus;
        }
        if ($minenauftrag>($max_bau)) { $minenauftrag=$max_bau; }
        $minen=$minen+$minenauftrag;
        $cantox=$cantox-($minenauftrag*4);
        $vorrat=$vorrat-$minenauftrag;
        $message="<center>$minenauftrag ".$lang['planetengamma']['mineerfolgreich']."</center>";
        $zeiger = @mysql_query("update $skrupel_planeten set minen=$minen,cantox=$cantox,vorrat=$vorrat where id=$pid and besitzer=$spieler");
        ?>
        <br><br>
        <?php echo $message?>
        <script language=JavaScript>
            var ant=parent.planeten.document.getElementById('cantox');
            ant.innerHTML='<?php echo $cantox; ?>';
            var ant=parent.planeten.document.getElementById('vorrat');
            ant.innerHTML='<?php echo $vorrat; ?>';
            var ant=parent.planeten.document.getElementById('minen');
            ant.innerHTML='<?php echo $minen; ?>';
        </script>
        <?php 
    include ("inc.footer.php");
}
if ($fuid==4) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_planeten where besitzer=$spieler and id=".$pid);
    $array = @mysql_fetch_array($zeiger);
    $pid=$array["id"];
    $name=$array["name"];
    $x_pos=$array["x_pos"];
    $y_pos=$array["y_pos"];
    $bild=$array["bild"];
    $temp=$array["temp"];
    $cantox=$array["cantox"];
    $vorrat=$array["vorrat"];
    $kolonisten=$array["kolonisten"];
    $auto_fabriken=$array["auto_fabriken"];
    $fabriken=$array["fabriken"];
    $auto_vorrat=$array["auto_vorrat"];
    $osys_1=$array["osys_1"];
    $osys_2=$array["osys_2"];
    $osys_3=$array["osys_3"];
    $osys_4=$array["osys_4"];
    $osys_5=$array["osys_5"];
    $osys_6=$array["osys_6"];
    $metro_fabriken_plus=0;
    if(($osys_1==9) or ($osys_2==9) or ($osys_3==9) or ($osys_4==9) or ($osys_5==9) or ($osys_6==9)){
        $metro_fabriken_plus=12;
    }
    $max_cantox=floor($cantox/3);
    $max_vorrat=$vorrat;
    if ($max_cantox<=$max_vorrat) { $max_bau=$max_cantox; }
    if ($max_vorrat<=$max_cantox) { $max_bau=$max_vorrat; }
    if (($kolonisten/100)<=100) { $max_col=floor($kolonisten/100)+$metro_fabriken_plus; } else { $max_col=100+floor(sqrt($kolonisten/100))+$metro_fabriken_plus; }
    $max_fabriken=$fabriken+$max_bau;
    if ($max_fabriken>$max_col) { $max_fabriken=$max_col;$max_bau=$max_col-$fabriken;}
    if ($max_fabriken>200+$metro_fabriken_plus) {
        $max_fabriken=200+$metro_fabriken_plus;
        $max_bau=200-$fabriken+$metro_fabriken_plus;
    }
    ?>
    <body text="#444444" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td valign="top">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td colspan="9"><img src="../bilder/empty.gif" border="0" width="150" height="8"></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="8"><center><?php echo $lang['planetengamma']['fabriken']?></center></td>
                            </tr>
                            <tr>
                                <td colspan="10"><img src="../bilder/empty.gif" border="0" width="5" height="6"></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td rowspan="2"><img src="<?php echo $bildpfad?>/icons/fabrik.gif" border="0" width="17" height="17"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['planetengamma']['inbetrieb']?></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['planetengamma']['maximal']?></td>
                                <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                <td rowspan="2"><a href="javascript:hilfe(6);"><img src="<?php echo $bildpfad?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><?php echo $fabriken?></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><?php echo $max_fabriken?></td>
                                <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                            </tr>
                            <tr>
                                <td colspan="9"><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            </tr>
                        </table>
                        <?php
                        if ($max_bau>=1) {
                            ?>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><form name="formular" method="post" action="planeten_gamma.php?fu=6&pid=<?php echo $pid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                    <td>
                                        <select name="fabrikenauftrag" style="font-family:Verdana;font-size:9px;width:50px;">
                                            <?php
                                            for ($i=1;$i<=$max_bau;$i++) {
                                                ?>
                                                <option value=<?php echo $i?> <?php if ($i==$max_bau) echo "selected"; ?>><?php echo $i?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                    <td><input type="submit" value="<?php echo $lang['planetengamma']['fabrikenbauen']?>" style="width:110px;"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                    <td></form></td>
                                </tr>
                                <tr>
                                    <td colspan="7"><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                            </table>
                            <?php
                        }
                        ?>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><form name="formular" method="post" action="planeten_gamma.php?fu=5&pid=<?php echo $pid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><input type="checkbox" name="fabrikauto" value="1" style="width:25px;" <?php if ($auto_fabriken==1) { echo "checked"; }?>></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><input type="submit" value="<?php echo $lang['planetengamma']['mineauto']?>" style="width:135px;"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td></form></td>
                            </tr>
                            <tr>
                                <td colspan="7"><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            </tr>
                        </table>
                    </td>
                    <td><img src="../bilder/empty.gif" border="0" width="15" height="5"></td>
                    <td valign="top">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td colspan="6"><img src="../bilder/empty.gif" border="0" width="5" height="14"></td>
                            </tr>
                            <tr>
                                <td colspan="6">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td rowspan="2"><img src="<?php echo $bildpfad?>/icons/vorrat.gif" border="0" width="17" height="17"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td style="color:#aaaaaa;" colspan="2"><?php echo $lang['planetengamma']['vorraete']?></td>
                                <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                <td rowspan="2"><a href="javascript:hilfe(7);"><img src="<?php echo $bildpfad?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><?php echo str_replace('{1}',$vorrat,$lang['planetengamma']['kt'])?></td>
                                <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                            </tr>
                            <tr>
                                <td colspan="7"><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            </tr>
                        </table>
                        <?php
                        if ($vorrat>=1) {
                            ?>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><form name="formular" method="post" action="planeten_gamma.php?fu=7&pid=<?php echo $pid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                    <td>
                                        <select name="vorratauftrag" style="font-family:Verdana;font-size:9px;width:50px;">
                                            <?php
                                            for ($i=1;$i<=$vorrat;$i++) {
                                                ?>
                                                <option value=<?php echo $i?> <?php if ($i==$vorrat) echo "selected"; ?>><?php echo $i?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                    <td><input type="submit" value="<?php echo $lang['planetengamma']['vorraeteverkaufen']?>" style="width:110px;"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                    <td></form></td>
                                </tr>
                                <tr>
                                    <td colspan="7"><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                            </table>
                            <?php
                        }
                        ?>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><form name="formular" method="post" action="planeten_gamma.php?fu=8&pid=<?php echo $pid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><input type="checkbox" name="vorratauto" value="1" style="width:25px;" <?php if ($auto_vorrat==1) { echo "checked"; }?>></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><input type="submit" value="<?php echo $lang['planetengamma']['autverkauf']?>" style="width:135px;"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td></form></td>
                            </tr>
                            <tr>
                                <td colspan="7"><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </center>
        <?php 
    include ("inc.footer.php");
}
if ($fuid==5) {
    include ("inc.header.php");
    ?>
    <body text="#000000" scroll="no" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php 
        $auto_fabriken=0;
        if (int_post('fabrikauto')==1) { $auto_fabriken=1;$message="<center>".$lang['planetengamma']['fabrikautoja']."</center>"; } else { $auto_fabriken=0;$message="<center>".$lang['planetengamma']['farbikautonein']."</center>"; }
        $zeiger = @mysql_query("update $skrupel_planeten set auto_fabriken=$auto_fabriken where id=".$pid." and besitzer=$spieler");
        ?>
        <br><br>
        <?php 
        echo $message;
    include ("inc.footer.php");
}
if ($fuid==6) {
    include ("inc.header.php");
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" scroll="no" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php 
        $fabrikenauftrag=int_post('fabrikenauftrag');
        $zeiger = @mysql_query("SELECT * FROM $skrupel_planeten where besitzer=$spieler and id=".$pid);
        $array = @mysql_fetch_array($zeiger);
        $pid=$array["id"];
        $fabriken=$array["fabriken"];
        $cantox=$array["cantox"];
        $vorrat=$array["vorrat"];
        $kolonisten=$array["kolonisten"];
        $osys_1=$array["osys_1"];
        $osys_2=$array["osys_2"];
        $osys_3=$array["osys_3"];
        $osys_4=$array["osys_4"];
        $osys_5=$array["osys_5"];
        $osys_6=$array["osys_6"];
        $metro_fabriken_plus=0;
        if(($osys_1==9) or ($osys_2==9) or ($osys_3==9) or ($osys_4==9) or ($osys_5==9) or ($osys_6==9)){
            $metro_fabriken_plus=12;
        }
        $max_cantox=floor($cantox/3);
        $max_vorrat=$vorrat;
        if ($max_cantox<=$max_vorrat) { $max_bau=$max_cantox; }
        if ($max_vorrat<=$max_cantox) { $max_bau=$max_vorrat; }
        if (($kolonisten/100)<=100) { $max_col=floor($kolonisten/100)+$metro_fabriken_plus; } else { $max_col=100+floor(sqrt($kolonisten/100))+$metro_fabriken_plus; }
        $max_fabriken=$fabriken+$max_bau;
        if ($max_fabriken>$max_col) { $max_fabriken=$max_col;$max_bau=$max_col-$fabriken;}
        if ($max_fabriken>200+$metro_fabriken_plus) {
            $max_fabriken=200+$metro_fabriken_plus;
            $max_bau=200-$fabriken+$metro_fabriken_plus;
        }
        if ($fabrikenauftrag>($max_bau)) { $fabrikenauftrag=$max_bau; }
        $fabriken=$fabriken+$fabrikenauftrag;
        $cantox=$cantox-($fabrikenauftrag*3);
        $vorrat=$vorrat-$fabrikenauftrag;
        $message="<center>$fabrikenauftrag ".$lang['planetengamma']['fabrikerfolgreich']."</center>";
         $zeiger = @mysql_query("update $skrupel_planeten set fabriken=$fabriken,cantox=$cantox,vorrat=$vorrat where id=$pid and besitzer=$spieler");
        ?>
        <br><br>
        <?php echo $message?>
        <script language=JavaScript>
            var ant=parent.planeten.document.getElementById('cantox');
            ant.innerHTML='<?php echo $cantox; ?>';
            var ant=parent.planeten.document.getElementById('vorrat');
            ant.innerHTML='<?php echo $vorrat; ?>';
            var ant=parent.planeten.document.getElementById('fabriken');
            ant.innerHTML='<?php echo $fabriken; ?>';
        </script>
        <?php 
    include ("inc.footer.php");
}
if ($fuid==7) {
    include ("inc.header.php");
    ?>
    <body text="#000000" scroll="no" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php 
        $vorratauftrag=int_post('vorratauftrag');
        $zeiger = @mysql_query("SELECT * FROM $skrupel_planeten where besitzer=$spieler and id=".$pid);
        $array = @mysql_fetch_array($zeiger);
        $pid=$array["id"];
        $cantox=$array["cantox"];
        $vorrat=$array["vorrat"];
        if ($vorratauftrag>$vorrat) {$vorratauftrag=$vorrat;}
        $vorrat=$vorrat-$vorratauftrag;
        $cantox=$cantox+$vorratauftrag;
        $message="<center>$vorratauftrag KT ".$lang['planetengamma']['vorraeteerfolgreichverkauft']."</center>";
        $zeiger = @mysql_query("update $skrupel_planeten set vorrat=$vorrat,cantox=$cantox where id=$pid and besitzer=$spieler");
        ?>
        <br><br>
        <?php echo $message?>
        <script language=JavaScript>
            var ant=parent.planeten.document.getElementById('cantox');
            ant.innerHTML='<?php echo $cantox; ?>';
            var ant=parent.planeten.document.getElementById('vorrat');
            ant.innerHTML='<?php echo $vorrat; ?>';
        </script>
        <?php 
    include ("inc.footer.php");
}
if ($fuid==8) {
    include ("inc.header.php");
    ?>
    <body text="#000000" scroll="no" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php 
        $auto_vorrat=0;
        if (int_post('vorratauto')==1) { $auto_vorrat=1;$message="<center>".$lang['planetengamma']['vorratautoja']."</center>"; } else { $auto_vorrat=0;$message="<center>".$lang['planetengamma']['vorratautonein']."</center>"; }
        $zeiger = @mysql_query("update $skrupel_planeten set auto_vorrat=$auto_vorrat where id=".$pid." and besitzer=$spieler");
        ?>
        <br><br>
        <?php
        echo $message;
    include ("inc.footer.php");
}
if ($fuid==9) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_planeten where besitzer=$spieler and id=".$pid);
    $array = @mysql_fetch_array($zeiger);
    $pid=$array["id"];
    $name=$array["name"];
    $x_pos=$array["x_pos"];
    $y_pos=$array["y_pos"];
    $bild=$array["bild"];
    $temp=$array["temp"];
    $cantox=$array["cantox"];
    $vorrat=$array["vorrat"];
    $kolonisten=$array["kolonisten"];
    $abwehr=$array["abwehr"];
    $auto_abwehr=$array["auto_abwehr"];
    $osys_1=$array["osys_1"];
    $osys_2=$array["osys_2"];
    $osys_3=$array["osys_3"];
    $osys_4=$array["osys_4"];
    $osys_5=$array["osys_5"];
    $osys_6=$array["osys_6"];
    $leichtebt=$array["leichtebt"];
    $schwerebt=$array["schwerebt"];
    $kolonisten=$array["kolonisten"];
    $max_cantox=floor($cantox/10);
    $max_vorrat=$vorrat;
    if ($max_cantox<=$max_vorrat) { $max_bau=$max_cantox; }
    if ($max_vorrat<=$max_cantox) { $max_bau=$max_vorrat; }
    if (($kolonisten/100)<=50) { $max_col=floor($kolonisten/100); } else { $max_col=50+floor(sqrt($kolonisten/100)); }
    if (($osys_1==11) or ($osys_2==11) or ($osys_3==11) or ($osys_4==11) or ($osys_5==11) or ($osys_6==11)) {
        $max_col=floor($max_col*1.5);
    }
    $max_abwehr=$abwehr+$max_bau;
    if ($max_abwehr>$max_col) { $max_abwehr=$max_col;$max_bau=$max_col-$abwehr;}
    if ($max_abwehr>300) {
        $max_abwehr=300;
        $max_bau=300-$abwehr;
    }
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td valign="top">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td colspan="10"><img src="../bilder/empty.gif" border="0" width="150" height="8"></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="9"><center><?php echo $lang['planetengamma']['pds']?></center></td>
                            </tr>
                            <tr>
                                <td colspan="10"><img src="../bilder/empty.gif" border="0" width="5" height="6"></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td rowspan="2"><img src="<?php echo $bildpfad?>/icons/abwehr.gif" border="0" width="17" height="17"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['planetengamma']['inbetrieb']?></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['planetengamma']['maximal']?></td>
                                <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                <td rowspan="2"><a href="javascript:hilfe(5);"><img src="<?php echo $bildpfad?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><?php echo $abwehr?></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><?php echo $max_abwehr?></td>
                                <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                            </tr>
                            <tr>
                                <td colspan="10"><img src="../bilder/empty.gif" border="0" width="5" height="7"></td>
                            </tr>
                        </table>
                        <?php
                        if ($max_bau>=1) {
                            ?>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><form name="formular" method="post" action="planeten_gamma.php?fu=11&pid=<?php echo $pid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                    <td>
                                        <select name="abwehrauftrag" style="font-family:Verdana;font-size:9px;width:50px;">
                                            <?php
                                            for ($i=1;$i<=$max_bau;$i++) {
                                                ?>
                                                <option value=<?php echo $i?> <?php if ($i==$max_bau) echo "selected"; ?>><?php echo $i?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                    <td><input type="submit" value="<?php echo $lang['planetengamma']['pdsbauen']?>" style="width:110px;"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                    <td></form></td>
                                </tr>
                                <tr>
                                    <td colspan="7"><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                            </table>
                            <?php
                        }
                        ?>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><form name="formular" method="post" action="planeten_gamma.php?fu=10&pid=<?php echo $pid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><input type="checkbox" name="abwehrauto" value="1" style="width:25px;" <?php if ($auto_abwehr==1) { echo "checked"; }?>></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><input type="submit" value="<?php echo $lang['planetengamma']['mineauto']?>" style="width:135px;"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td></form></td>
                            </tr>
                            <tr>
                                <td colspan="7"><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            </tr>
                        </table>
                    </td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                    <td valign="top">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td></td>
                                <td><img src="../bilder/empty.gif" border="0" width="180" height="8"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><center><?php echo $lang['planetengamma']['militaer']?></center></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="13"></td>
                            </tr>
                            <tr>
                                <td><img src="<?php echo $bildpfad?>/icons/crew.gif" border="0" width="17" height="17"></td>
                                <td><nobr><?php echo $kolonisten?> <?php echo $lang['planetengamma']['kolonisten']?></nobr></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="4"></td>
                            </tr>
                            <tr>
                                <td><img src="<?php echo $bildpfad?>/icons/leichtebt.gif" border="0" width="17" height="17"></td>
                                <td><nobr><?php echo $leichtebt?> <?php echo $lang['planetengamma']['leichtebt']?></nobr></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="4"></td>
                            </tr>
                            <tr>
                                <td><img src="<?php echo $bildpfad?>/icons/schwerebt.gif" border="0" width="17" height="17"></td>
                                <td><nobr><?php echo $schwerebt?> <?php echo $lang['planetengamma']['schwerebt']?></nobr></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </center>
        <?php 
    include ("inc.footer.php");
}
if ($fuid==10) {
    include ("inc.header.php");
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" scroll="no" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php 
        $auto_abwehr=0;
        if (int_post('abwehrauto')==1) { $auto_abwehr=1;$message="<center>".$lang['planetengamma']['pdsautoja']."</center>"; } else { $auto_abwehr=0;$message="<center>".$lang['planetengamma']['pdsautonein']."</center>"; }
        $zeiger = @mysql_query("update $skrupel_planeten set auto_abwehr=$auto_abwehr where id=".$pid." and besitzer=$spieler");
        ?>
        <br><br>
        <?php echo $message;
    include ("inc.footer.php");
}
if ($fuid==11) {
    include ("inc.header.php");
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" scroll="no" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php 
        $abwehrauftrag=int_post('abwehrauftrag');
        $zeiger = @mysql_query("SELECT * FROM $skrupel_planeten where besitzer=$spieler and id=".$pid);
        $array = @mysql_fetch_array($zeiger);
        $pid=$array["id"];
        $cantox=$array["cantox"];
        $vorrat=$array["vorrat"];
        $kolonisten=$array["kolonisten"];
        $abwehr=$array["abwehr"];
        $osys_1=$array["osys_1"];
        $osys_2=$array["osys_2"];
        $osys_3=$array["osys_3"];
        $osys_4=$array["osys_4"];
        $osys_5=$array["osys_5"];
        $osys_6=$array["osys_6"];
        $max_cantox=floor($cantox/10);
        $max_vorrat=$vorrat;
        if ($max_cantox<=$max_vorrat) { $max_bau=$max_cantox; }
        if ($max_vorrat<=$max_cantox) { $max_bau=$max_vorrat; }
        if (($kolonisten/100)<=50) { $max_col=floor($kolonisten/100); } else { $max_col=50+floor(sqrt($kolonisten/100)); }
        if (($osys_1==11) or ($osys_2==11) or ($osys_3==11) or ($osys_4==11) or ($osys_5==11) or ($osys_6==11)) {
            $max_col=floor($max_col*1.5);
        }
        $max_abwehr=$abwehr+$max_bau;
        if ($max_abwehr>$max_col) { $max_abwehr=$max_col;$max_bau=$max_col-$abwehr;}
        if ($max_abwehr>300) {
            $max_abwehr=300;
            $max_bau=300-$abwehr;
        }
        if ($abwehrauftrag>($max_bau)) { $abwehrauftrag=$max_bau; }
        $abwehr=$abwehr+$abwehrauftrag;
        $cantox=$cantox-($abwehrauftrag*10);
        $vorrat=$vorrat-$abwehrauftrag;
        $message="<center>$abwehrauftrag ".$lang['planetengamma']['pdserfolgreich']."</center>";
        $zeiger = @mysql_query("update $skrupel_planeten set vorrat=$vorrat,cantox=$cantox,abwehr=$abwehr where id=$pid and besitzer=$spieler");
        ?>
        <br><br>
        <?php echo $message?>
        <script language=JavaScript>
            var ant=parent.planeten.document.getElementById('cantox');
            ant.innerHTML='<?php echo $cantox; ?>';
            var ant=parent.planeten.document.getElementById('vorrat');
            ant.innerHTML='<?php echo $vorrat; ?>';
            var ant=parent.planeten.document.getElementById('abwehr');
            ant.innerHTML='<?php echo $abwehr; ?>';
        </script>
        <?php 
    include ("inc.footer.php");
}
if ($fuid==12) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_planeten where besitzer=$spieler and id=".$pid);
    $array = @mysql_fetch_array($zeiger);
    $pid=$array["id"];
    $name=$array["name"];
    $x_pos=$array["x_pos"];
    $y_pos=$array["y_pos"];
    $bild=$array["bild"];
    $temp=$array["temp"];
    $minen=$array["minen"];
    $cantox=$array["cantox"];
    $vorrat=$array["vorrat"];
    $kolonisten=$array["kolonisten"];
    $auto_minen=$array["auto_minen"];
    $planet_lemin=$array["planet_lemin"];
    $planet_min1=$array["planet_min1"];
    $planet_min2=$array["planet_min2"];
    $planet_min3=$array["planet_min3"];
    $konz_lemin=$array["konz_lemin"];
    $konz_min1=$array["konz_min1"];
    $konz_min2=$array["konz_min2"];
    $konz_min3=$array["konz_min3"];
    if ($konz_lemin==1) { $skonz_lemin=$lang['planetengamma']['fluechtig']; }
    if ($konz_lemin==2) { $skonz_lemin=$lang['planetengamma']['weitgestreut']; }
    if ($konz_lemin==3) { $skonz_lemin=$lang['planetengamma']['verteilt']; }
    if ($konz_lemin==4) { $skonz_lemin=$lang['planetengamma']['konzentriert']; }
    if ($konz_lemin==5) { $skonz_lemin=$lang['planetengamma']['hochkonz']; }
    if ($konz_min1==1) { $skonz_min1=$lang['planetengamma']['fluechtig']; }
    if ($konz_min1==2) { $skonz_min1=$lang['planetengamma']['weitgestreut']; }
    if ($konz_min1==3) { $skonz_min1=$lang['planetengamma']['verteilt']; }
    if ($konz_min1==4) { $skonz_min1=$lang['planetengamma']['konzentriert']; }
    if ($konz_min1==5) { $skonz_min1=$lang['planetengamma']['hochkonz']; }
    if ($konz_min2==1) { $skonz_min2=$lang['planetengamma']['fluechtig']; }
    if ($konz_min2==2) { $skonz_min2=$lang['planetengamma']['weitgestreut']; }
    if ($konz_min2==3) { $skonz_min2=$lang['planetengamma']['verteilt']; }
    if ($konz_min2==4) { $skonz_min2=$lang['planetengamma']['konzentriert']; }
    if ($konz_min2==5) { $skonz_min2=$lang['planetengamma']['hochkonz']; }
    if ($konz_min3==1) { $skonz_min3=$lang['planetengamma']['fluechtig']; }
    if ($konz_min3==2) { $skonz_min3=$lang['planetengamma']['weitgestreut']; }
    if ($konz_min3==3) { $skonz_min3=$lang['planetengamma']['verteilt']; }
    if ($konz_min3==4) { $skonz_min3=$lang['planetengamma']['konzentriert']; }
    if ($konz_min3==5) { $skonz_min3=$lang['planetengamma']['hochkonz']; }
    $minfarben[0]='00F14A';
    $minfarben[1]='FFDECA';
    $minfarben[2]='E90505';
    $minfarben[3]='0085EF';
    function mineral($min,$anzahl,$kon) {
        global $minfarben;
        $punkteanzahl=round($anzahl/30*2.5);
        for ($i=0; $i<$punkteanzahl;$i=$i+($kon*2)) {
            $x=0;$y=0;
            while (round(sqrt((48-$x)*(48-$x)+(48-$y)*(48-$y)))>(40-$kon)) {
                $x=rand(6,90);
                $y=rand(6,90);
            }
            if ($kon==1) {
                ?>
                <div id="p_<?php echo $i?>" style="position: absolute; left:<?php echo $x; ?>px; top:<?php echo $y; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $minfarben[$min]?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                <?php 
            }
            if ($kon>1) {
            $punkte=$kon*2;
            $xpos=$x;
            $ypos=$y;
                for ($p=0; $p<$punkte;$p++) {
                    ?>
                    <div id="p_<?php echo $p?>_<?php echo $i?>" style="position: absolute; left:<?php echo $xpos; ?>px; top:<?php echo $ypos; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $minfarben[$min]?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                    <?php 
                    $richtung=rand(0,7);
                    if ($richtung==0) { $xpos--; }
                    if ($richtung==1) { $ypos--; }
                    if ($richtung==2) { $xpos++; }
                    if ($richtung==3) { $ypos++; }
                    if ($richtung==4) { $xpos--;$ypos--; }
                    if ($richtung==5) { $ypos--;$xpos++; }
                    if ($richtung==6) { $xpos++;$ypos++; }
                    if ($richtung==7) { $xpos--;$ypos++; }
                }
            }
        }
    }
    ?>
    <body text="#000000" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <img border="0" src="../bilder/skalen/scan.gif" width="97" height="97">
        <?php 
        mineral(0,$planet_lemin,$konz_lemin);
        mineral(1,$planet_min1,$konz_min1);
        mineral(2,$planet_min2,$konz_min2);
        mineral(3,$planet_min3,$konz_min3);
        ?>
        <div id="blabla" style="position: absolute; left:0px; top:0px; width:97px; height:97px;visibility=visible;"><img border="0" src="../bilder/empty.gif" width="97" height="97" title="<?php
            echo $lang['planetengamma']['lemin'].': '.$skonz_lemin."\n";
            echo $lang['planetengamma']['baxterium'].': '.$skonz_min1."\n";
            echo $lang['planetengamma']['rennurbin'].': '.$skonz_min2."\n";
            echo $lang['planetengamma']['vomisaan'].': '.$skonz_min3;
        ?>"></div>
        <?php 
    include ("inc.footer.php");
}
