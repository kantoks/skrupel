<?php
include('../inc.conf.php');
include_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'osys_spionage';
$fuid = int_get('fu');
$pid = int_get('pid');

include("inc.header.php");
$schiffdatei = false;
$file='../daten/unknown/schiffe.txt';
$fp = @fopen("$file","r");
if ($module[0] && $fp) {
    $buffer = @fgets($fp, 4096);
    @fclose($fp);
    if(strlen($buffer) > 0) {
        $schiff = @explode(":", $buffer);
        $schiffdatei = true;
        $spion_zaehler = 8;
        $erfahrung = 0;
        for ($stufe=0;$stufe<$spion_zaehler;$stufe++) {
            //0name:1kid:2tlvl:3bild:4bildk:5ctx:6mi1:7mi2:8mi3:9waf1:10waf2:11waf3:12fra:13tan:14antr:15cre:16ma:17fert:18beschr
            $spion_daten[$stufe]['schiff'] = $schiff;
            $spion_daten[$stufe]['name'] = "Spion (Stufe $stufe)";
            if($stufe > 5) { $spion_daten[$stufe]['level'] = 5; } else { $spion_daten[$stufe]['level'] = $stufe; }
            $spion_daten[$stufe]['cantox'] = floor(pow(floor($schiff[5]),($stufe*0.05)+1));
            $spion_daten[$stufe]['min1'] = floor(pow(floor($schiff[6]),($stufe*0.06)+1));
            $spion_daten[$stufe]['min2'] = floor(pow(floor($schiff[7]),($stufe*0.06)+1));
            $spion_daten[$stufe]['min3'] = floor(pow(floor($schiff[8]),($stufe*0.06)+1));
            $erfahrung += $stufe*100;
            $spion_daten[$stufe]['erfahrung'] = $erfahrung;
        }
    }
}
if(!$schiffdatei) {
    ?>
    <body text="#000000" scroll="auto" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="6"></td>
                </tr>
                <tr>
                    <td style="text-align:center;"><?php echo $lang['osys']['spionage']['funktionsunfaehig']?></td>
                </tr>
            </table>
        </center>
        <br>
        <?php
    include("inc.footer.php");
    die();
}
//spion bzw auswahl an spionen anzeigen
if ($fuid==1) {
    ?>
    <body text="#000000" scroll="auto" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <script language=JavaScript>
            function hilfe_spionage_osys() {
                oben=100;
                links=Math.ceil((screen.width-480)/2);
                window.open('hilfe_spionage.php?fu2=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>','<?php echo $lang['osys']['spionage']['hilfe']?>','resizable=yes,scrollbars=no,width=480,height=200,top='+oben+',left='+links);
            }
            function hilfe_spionage_schiff(shid) {
                oben=100;
                links=Math.ceil((screen.width-480)/2);
                window.open('hilfe_spionage.php?fu2=2&spid='+shid+'&uid=<?php echo $uid?>&sid=<?php echo $sid?>','<?php echo $lang['osys']['spionage']['hilfe']?>','resizable=yes,scrollbars=no,width=480,height=200,top='+oben+',left='+links);
            }
        </script>
        <?php
        $zeiger_planet = @mysql_query("SELECT id,cantox,besitzer,min1,min2,min3,x_pos,y_pos,sternenbasis,sternenbasis_id FROM $skrupel_planeten where besitzer=$spieler and id=".$pid);
        $planet = @mysql_fetch_array($zeiger_planet);
        $zeiger_schiff = @mysql_query("SELECT id,name,klasse,volk,tarnfeld,bild_gross,ordner FROM $skrupel_schiffe where spiel=$spiel and besitzer=$spieler and volk='unknown' and klasseid=1 and s_x=".$planet['x_pos']." and s_y=".$planet['y_pos']);
        if(@mysql_num_rows($zeiger_schiff) == 0) {
            $werft_frei=false;
            $werft_bau=false;
            $zeiger_starbase = @mysql_query("SELECT schiffbau_status,schiffbau_extra FROM $skrupel_sternenbasen where spiel=$spiel and besitzer=$spieler and status=1");
            while($starbase = @mysql_fetch_array($zeiger_starbase)) {
                if($starbase['schiffbau_status'] == 0) { $werft_frei=true; }
                else {
                    $extra = @explode(":", $starbase['schiffbau_extra']);
                    $extra_spio = @explode("-", $extra[0]);
                    $pos_heimat = @explode(",", $extra_spio[2]);
                    if($pos_heimat[0] == $planet['x_pos'] && $pos_heimat[1] == $planet['y_pos']) { $werft_bau=true; break; }
                }
            }
            if($werft_bau) {
                ?>
                <center>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="1" height="6"></td>
                        </tr>
                        <tr>
                            <td style="text-align:center;"><?php echo $lang['osys']['spionage']['nichtAusbildung']?></td>
                        </tr>
                    </table>
                </center>
                <br>
                <?php
            }elseif(!$werft_frei) {
                ?>
                <center>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="1" height="6"></td>
                        </tr>
                        <tr>
                            <td style="text-align:center;"><?php echo $lang['osys']['spionage']['nichtWerft']?></td>
                        </tr>
                    </table>
                </center>
                <br>
                <?php
            }else {
                ?>
                <center>
                    <table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                            <td colspan="11"><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><a href="javascript:hilfe_spionage_osys();"><img src="<?php echo $bildpfad?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                            <td style="color:#aaaaaa;text-align:center;"><?php echo $lang['osys']['spionage']['Level']?></td>
                            <td style="text-align:center;"><img src="<?php echo $bildpfad?>/icons/cantox.gif" border="0" width="17" height="17"></td>
                            <td style="text-align:center;"><img src="<?php echo $bildpfad?>/icons/mineral_1.gif" border="0" width="17" height="17"></td>
                            <td style="text-align:center;"><img src="<?php echo $bildpfad?>/icons/mineral_2.gif" border="0" width="17" height="17"></td>
                            <td style="text-align:center;"><img src="<?php echo $bildpfad?>/icons/mineral_3.gif" border="0" width="17" height="17"></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td></td>
                        </tr>
                        <?php
                        for($si=0;$si<$spion_zaehler;$si++) {
                            if($zug_abgeschlossen==0 && $spion_daten[$si]['cantox']<=$planet['cantox'] && $spion_daten[$si]['min1']<=$planet['min1'] && $spion_daten[$si]['min2']<=$planet['min2'] && $spion_daten[$si]['min3']<=$planet['min3']) { $ok=1; } else { $ok=0; };
                            ?>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="1" height="18"></td>
                                <td>
                                    <form name="formular" method="post" action="osys_spionage.php?fu=2&pid=<?php echo $planet['id'];?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>">
                                    <input type="hidden" name="stufe" value="<?php echo $si;?>">
                                </td>
                                <td><nobr><a href="javascript:hilfe_spionage_schiff(<?php echo $spion_daten[$si]['erfahrung'];?>);" style="color:#ffffff;"><?php echo $spion_daten[$si]['name'];?></a></nobr></td>
                                <td style="text-align:center;"><?php echo $spion_daten[$si]['level'];?></td>
                                <td style="color:#aaaaaa;text-align:center;"><?php echo $spion_daten[$si]['cantox'];?></td>
                                <td style="color:#aaaaaa;text-align:center;"><?php echo $spion_daten[$si]['min1'];?></td>
                                <td style="color:#aaaaaa;text-align:center;"><?php echo $spion_daten[$si]['min2'];?></td>
                                <td style="color:#aaaaaa;text-align:center;"><?php echo $spion_daten[$si]['min3'];?></td>
                                <td>&nbsp;</td>
                                <td><?php if ($ok==1) { ?><input type="submit" value="<?php echo $lang['osys']['spionage']['ausbilden']?>" style="width:80px;"><?php } else { ?>&nbsp;<?php } ?></td>
                                <td></form></td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td colspan="11"><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
                        </tr>
                    </table>
                </center>
                <?php
            }
        }else {
            $schiff = @mysql_fetch_array($zeiger_schiff);
            if($schiff['tarnfeld'] > 0) {
                $rand = "background=\"".$bildpfad."/aufbau/tarnrand.gif\"";
                $style = " style=\"filter:alpha(opacity=50);\" onmouseover=\"this.style.filter='alpha(opacity=100)';\" onmouseout=\"this.style.filter='alpha(opacity=50)';\"";
            }else {
                $rand = "bgcolor=\"#aaaaaa\"";
                $style = "";
            }
            ?>
            <script language=JavaScript>
                function link_spionschiff() {
                    if (parent.parent.mittelinksoben.document.globals.map.value==0) {
                        parent.parent.mittelinksoben.document.globals.map.value=1;
                        parent.parent.mittemitte.window.location='galaxie.php?fu=2&uid=<?php echo $uid?>&sid=<?php echo $sid?>';
                    }
                    else {
                        parent.parent.mittemitte.aktuell.style.visibility='hidden';
                    }
                    parent.parent.untenmitte.window.location='flotte.php?fu=2&shid=<?php echo $schiff['id'];?>&oid=<?php echo $schiff['ordner'];?>&uid=<?php echo $uid;?>&sid=<?php echo $sid;?>';
                }
            </script>
            <center>
                <table border="0" cellspacing="0" cellpadding="2" width="100%">
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="1" height="10"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top;">
                            <a href="javascript:hilfe_spionage_osys();"><img src="<?php echo $bildpfad?>/icons/hilfe.gif" border="0" width="17" height="17"></a>
                        </td>
                        <td style="vertical-align:top;text-align:center">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td <?php echo $rand;?> colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                </tr>
                                <tr>
                                    <td <?php echo $rand;?>><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                    <td>
                                        <a href="javascript:;" onclick="link_spionschiff();body.focus();">
                                            <img src="../daten/<?php echo $schiff['volk'];?>/bilder_schiffe/<?php echo $schiff['bild_gross'];?>" border="0"  height="80"<?php echo $style;?> title="[<?php echo $schiff['name'];?>] <?php echo $schiff['klasse'];?>">
                                        </a>
                                    </td>
                                    <td <?php echo $rand;?>><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                </tr>
                                <tr>
                                    <td <?php echo $rand;?> colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </center>
            <?php
        }
}
if ($fuid==2) {
    ?>
    <body text="#000000" scroll="auto" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <script language="JavaScript">
            function check() {
                if(document.formular.schiffsname.value == "")  {
                    alert("<?php echo html_entity_decode($lang['osys']['spionage']['bitteschiffsname'])?>");
                    document.formular.schiffsname.focus();
                    return false;
                }
                return true;
            }
        </script>
        <center>
            <br>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="6"></td>
                </tr>
                <tr>
                    <td>
                        <form name="formular"  method="post" action="osys_spionage.php?fu=3&pid=<?php echo $pid;?>&uid=<?php echo $uid;?>&sid=<?php echo $sid;?>" onSubmit="return check();">
                        <input type="hidden" name="stufe" value="<?php echo int_post('stufe');?>">
                    </td>
                    <td><?php echo $lang['osys']['spionage']['Schiffsname']?></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="text" name="schiffsname" maxlength=20 style="width:165px;" class="eingabe" autocomplete="off"></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submitbutton" value="<?php echo $lang['osys']['spionage']['inauftrag']?>" style="width:165px;"></td>
                    <td></form></td>
                </tr>
            </table>
        </center>
        <script language=JavaScript>
            document.formular.schiffsname.focus();
        </script>
        <?php
}
if ($fuid==3) {
    ?>
    <body text="#000000" scroll="auto" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php
        $zeiger_planet = @mysql_query("SELECT id,cantox,besitzer,min1,min2,min3,x_pos,y_pos,sternenbasis,sternenbasis_id FROM $skrupel_planeten where besitzer=$spieler and id=".$pid);
        $planet = @mysql_fetch_array($zeiger_planet);
        $zeiger_schiff = @mysql_query("SELECT id FROM $skrupel_schiffe where spiel=$spiel and besitzer=$spieler and volk='unknown' and klasseid=1 and s_x=".$planet['x_pos']." and s_y=".$planet['y_pos']);
        if($zug_abgeschlossen==0 && @mysql_num_rows($zeiger_schiff) == 0) {
            $werft_frei=false;
            $werft_bau=false;
            $zeiger_starbase = @mysql_query("SELECT schiffbau_status,schiffbau_extra FROM $skrupel_sternenbasen where spiel=$spiel and besitzer=$spieler and status=1");
            while($starbase = @mysql_fetch_array($zeiger_starbase)) {
                if($starbase['schiffbau_status'] == 0) { $werft_frei=true; }
                else {
                    $extra = @explode(":", $starbase['schiffbau_extra']);
                    $extra_spio = @explode("-", $extra[0]);
                    $pos_heimat = @explode(",", $extra_spio[2]);
                    if($pos_heimat[0] == $planet['x_pos'] && $pos_heimat[1] == $planet['y_pos']) { $werft_bau=true; break; }
                }
            }
            if($werft_bau) {
                ?>
                <center>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="1" height="6"></td>
                        </tr>
                        <tr>
                            <td style="text-align:center;"><?php echo $lang['osys']['spionage']['nichtAusbildung']?></td>
                        </tr>
                    </table>
                </center>
                <br>
                <?php
            }elseif(!$werft_frei) {
                ?>
                <center>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="1" height="6"></td>
                        </tr>
                        <tr>
                            <td style="text-align:center;"><?php echo $lang['osys']['spionage']['nichtWerft']?></td>
                        </tr>
                    </table>
                </center>
                <br>
                <?php
            }else {
                $si = int_post('stufe');
                if($spion_daten[$si]['cantox']<=$planet['cantox'] && $spion_daten[$si]['min1']<=$planet['min1'] && $spion_daten[$si]['min2']<=$planet['min2'] && $spion_daten[$si]['min3']<=$planet['min3']) { $ok=1; } else { $ok=0; };
                if($ok) {
                    $cantox = $planet['cantox'] - $spion_daten[$si]['cantox'];
                    $min1 = $planet['min1'] - $spion_daten[$si]['min1'];
                    $min2 = $planet['min2'] - $spion_daten[$si]['min2'];
                    $min3 = $planet['min3'] - $spion_daten[$si]['min3'];
                    $zeiger_temp = @mysql_query("UPDATE $skrupel_planeten set cantox=$cantox,min1=$min1,min2=$min2,min3=$min3 where besitzer=$spieler and id=".$planet['id']);
                    $zeiger_starbase = @mysql_query("SELECT id,x_pos,y_pos FROM $skrupel_sternenbasen where spiel=$spiel and besitzer=$spieler and status=1 and schiffbau_status=0");
                    $starbase_nearest = @mysql_fetch_array($zeiger_starbase);
                    $lichtjahre1 = (($planet['x_pos'] - $starbase_nearest['x_pos']) * ($planet['x_pos'] - $starbase_nearest['x_pos']) + ($planet['y_pos'] - $starbase_nearest['y_pos']) * ($planet['y_pos'] - $starbase_nearest['y_pos']));
                    while($starbase = @mysql_fetch_array($zeiger_starbase)) {
                        $lichtjahre2 = (($planet['x_pos'] - $starbase['x_pos']) * ($planet['x_pos'] - $starbase['x_pos']) + ($planet['y_pos'] - $starbase['y_pos']) * ($planet['y_pos'] - $starbase['y_pos']));
                        if($lichtjahre2 < $lichtjahre1) {
                            $starbase_nearest = $starbase;
                            $lichtjahre1 = $lichtjahre2;
                        }
                    }
                    $schiffsname=str_post('schiffsname','SQLSAFE');
                    //$schiffsname=str_replace("'"," ",$schiffsname);
                    //$schiffsname=str_replace('"'," ",$schiffsname);
                    $extra = $spion_daten[$si]['erfahrung']."-init-".$planet['x_pos'].",".$planet['y_pos']."-0";
                    $schiff = $spion_daten[$si]['schiff'];
                    //0name:1kid:2tlvl:3bild:4bildk:5ctx:6mi1:7mi2:8mi3:9waf1:10waf2:11waf3:12fra:13tan:14antr:15cre:16ma:17fert:18beschr
                    $zeiger_temp = @mysql_query("UPDATE $skrupel_sternenbasen set schiffbau_status=1,schiffbau_klasse=1,schiffbau_bild_gross='".$schiff[3]."',schiffbau_bild_klein='".$schiff[4]."',schiffbau_crew=".$schiff[15].",schiffbau_masse=".$schiff[16].",schiffbau_tank=".$schiff[13].",schiffbau_fracht=".$schiff[12].",schiffbau_antriebe=".$schiff[14].",schiffbau_energetik=".$schiff[9].",schiffbau_projektile=".$schiff[10].",schiffbau_hangar=".$schiff[11].",schiffbau_klasse_name='".$spion_daten[$si]['name']."',schiffbau_rasse='unknown',schiffbau_fertigkeiten='".$schiff[17]."',schiffbau_energetik_stufe=0,schiffbau_projektile_stufe=0,schiffbau_techlevel=".$schiff[2].",schiffbau_antriebe_stufe=8,schiffbau_name='$schiffsname',schiffbau_extra='$extra' where besitzer=$spieler and status=1 and id=".$starbase_nearest['id']);
                    ?>
                    <center>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="1" height="6"></td>
                            </tr>
                            <tr>
                                <td style="text-align:center;"><?php echo $lang['osys']['spionage']['Ausbildung']?></td>
                            </tr>
                        </table>
                    </center>
                    <br>
                    <script language=JavaScript>
                        var ant=parent.planeten.document.getElementById('cantox');
                        ant.innerHTML='<?php echo $cantox; ?>';
                        var ant=parent.planeten.document.getElementById('min1');
                        ant.innerHTML='<?php echo $min1; ?>';
                        var ant=parent.planeten.document.getElementById('min2');
                        ant.innerHTML='<?php echo $min2; ?>';
                        var ant=parent.planeten.document.getElementById('min3');
                        ant.innerHTML='<?php echo $min3; ?>';
                    </script>
                    <?php
                }else {
                    ?>
                    <center>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="1" height="6"></td>
                            </tr>
                            <tr><td style="text-align:center;"><?php echo $lang['osys']['spionage']['nichtRohstoffe']?></td></tr>
                        </table>
                    </center>
                    <br>
                    <?php
                }
            }
        }
}
include("inc.footer.php");
