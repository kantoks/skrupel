<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'flotte_gamma';
$fuid = int_get('fu');
$shid = int_get('shid');

if ($fuid==1) {
    include ("inc.header.php");

    $zeiger = @mysql_query("SELECT * FROM $skrupel_schiffe where id=$shid");
    $array = @mysql_fetch_array($zeiger);
    $energetik_stufe=$array["energetik_stufe"];
    $energetik_anzahl=$array["energetik_anzahl"];
    $projektile_stufe =$array["projektile_stufe"];
    $projektile_anzahl=$array["projektile_anzahl"];
    $hanger_anzahl=$array["hanger_anzahl"];

    if ($projektile_stufe==0) { $projektile_name=$lang['flottegamma']['nichtvorhanden']; } else { $projektile_name=$lang['flottegamma']['waffen'][$projektile_stufe+9]; }
    if ($energetik_stufe==0) { $energetik_name=$lang['flottegamma']['nichtvorhanden']; } else { $energetik_name=$lang['flottegamma']['waffen'][$energetik_stufe-1]; }

    ?>
    <body text="#000000" background="<?php echo $bildpfad; ?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" cellspacing="0" cellpadding="1">
                <tr>
                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="4"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                    <td><center><?php echo $lang['flottegamma']['waffensysteme']; ?></center></td>
                    <td><a href="javascript:hilfe(12);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                </tr>
                <tr>
                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="3"></td>
                </tr>
            </table>
        </center>
        <center>
            <table border="0" cellspacing="0" cellpadding="1">
                <tr>
                    <td style="color:#aaaaaa;"><?php echo $lang['flottegamma']['nameesystem']; ?></td>
                    <td><?php echo $energetik_name; ?></td>
                </tr>
                <tr>
                    <td style="color:#aaaaaa;"><?php echo $lang['flottegamma']['anzahlesystem']; ?></td>
                    <td><?php echo $energetik_anzahl; ?></td>
                </tr>
                <tr>
                    <td style="color:#aaaaaa;"><?php echo $lang['flottegamma']['namepsystem']; ?></td>
                    <td><?php echo $projektile_name; ?></td>
                </tr>
                <tr>
                    <td style="color:#aaaaaa;"><?php echo $lang['flottegamma']['anzahlpsystem']; ?></td>
                    <td><?php echo $projektile_anzahl; ?></td>
                </tr>
                <tr>
                    <td style="color:#aaaaaa;"><?php echo $lang['flottegamma']['anzahlhangar']; ?></td>
                    <td><?php echo $hanger_anzahl; ?></td>
                </tr>
            </table>
        </center>
        <?php
    include ("inc.footer.php");
}

if ($fuid==2) {
    include ("inc.header.php");

    $zeiger = @mysql_query("SELECT id,aggro,mission FROM $skrupel_schiffe where id=$shid");
    $array = @mysql_fetch_array($zeiger);
    $aggro=$array["aggro"];
    $mission=$array["mission"];

    ?>
    <style type="text/css">
        input {
            width:            50px;
            padding:        1px;
            margin-right:    0px;
        }

        input, select, button {
            vertical-align:    middle;
        }

        #slider-1
        {
            margin: 0px;
            width:  254px;
        }
    </style>
    <link type="text/css" rel="StyleSheet" href="css/winclassic.css" />
    <script type="text/javascript" src="js/range.js"></script>
    <script type="text/javascript" src="js/timer.js"></script>
    <script type="text/javascript" src="js/slider.js"></script>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" cellspacing="0" cellpadding="1">
                <tr>
                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                    <td><center><?php if ($module[3]==1) { ?><?php echo $lang['flottegamma']['taktik']; ?><?php } else { ?><?php echo $lang['flottegamma']['aggressivitaet']; ?><?php } ?></center></td>
                    <td><a href="javascript:hilfe(<?php if ($module[3]==1) { ?><?php } else { ?>38<?php } ?>);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                </tr>
            </table>
        </center>
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="57"></td>
                    <td background="<?php echo $bildpfad; ?>/skalen/aggr.gif"><div class="slider" id="slider-1" tabIndex="1"><input class="slider-input" id="slider-input-1"/></div></td>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="57"></td>
                </tr>
                <tr>
                    <td><form name="formular" id="formular" method="post" action="flotte_gamma.php?fu=3&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="254" height="1"></td>
                    <td><input type="hidden" name="aggro" value="<?php echo $aggro; ?>"></td>
                </tr>
                <?php
                if ($module[3]==1) {
                    ?>
                    <tr>
                        <td></td>
                        <td>
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td>
                                        <center>
                                            <select name="taktik" style="width:120px;">
                                                <option value="1" <?php if ($mission==1) { echo "selected"; } ?>><?php echo $lang['flottegamma']['aggressiv']; ?></option>
                                                <option value="0" <?php if ($mission==0) { echo "selected"; } ?>><?php echo $lang['flottegamma']['ueberlegt']; ?></option>
                                                <option value="2" <?php if ($mission==2) { echo "selected"; } ?>><?php echo $lang['flottegamma']['defensiv']; ?></option>
                                            </select>
                                        </center>
                                    </td>
                                    <td><img src="../bilder/empty.gif" border="0" width="14" height="1"></td>
                                    <td><input type="submit" name="bla" value="<?php echo $lang['flottegamma']['uebernehmen']; ?>" style="width:120;padding:0px;"></td>
                                </tr>
                            </table>
                        </td>
                        <td></form></td>
                    </tr>
                    <?php
                } else {
                    ?>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                        <td><input type="submit" name="bla" value="<?php echo $lang['flottegamma']['einstellunguebernehmen']; ?>" style="width:254;padding:0px;"></td>
                        <td></form></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </center>
        <script type="text/javascript">
            var s = new Slider(document.getElementById("slider-1"), document.getElementById("slider-input-1"));
            s.onchange = function () {
                //document.getElementById("fracht_lemin").value = s.getValue();
                document.getElementById("formular").aggro.value=s.getValue();
            };
            s.setMinimum(0);
            s.setMaximum(9);
            s.setValue(<?php echo $aggro; ?>);
        </script>
        <?php
    include ("inc.footer.php");
}

if ($fuid==3) {
    include ("inc.header.php");

    if ($module[3]==1) {
        $zeiger = @mysql_query("UPDATE $skrupel_schiffe set aggro=\"".int_post('aggro')."\",mission=\"".int_post('taktik')."\" where id=$shid and besitzer=$spieler");
    } else {
        $zeiger = @mysql_query("UPDATE $skrupel_schiffe set aggro=\"".int_post('aggro')."\" where id=$shid and besitzer=$spieler");
    }
    ?>
    <body text="#000000" background="<?php echo $bildpfad; ?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <br><br><br><br>
        <center><?php echo $lang['flottegamma']['aggressivitaetuebernommen']; ?></center>
        <?php
    include ("inc.footer.php");
}

if ($fuid==4) {
    include ("inc.header.php");

    $zeiger = @mysql_query("SELECT * FROM $skrupel_schiffe where id=$shid");
    $array = @mysql_fetch_array($zeiger);
    $fracht_leute=$array["fracht_leute"];
    $fracht_cantox=$array["fracht_cantox"];
    $fracht_vorrat=$array["fracht_vorrat"];
    $fracht_lemin=$array["lemin"];
    $fracht_min1=$array["fracht_min1"];
    $fracht_min2=$array["fracht_min2"];
    $fracht_min3=$array["fracht_min3"];
    $frachtraum=$array["frachtraum"];
    $leichtebt=$array["leichtebt"];
    $schwerebt=$array["schwerebt"];

    $gesamt=$fracht_min1+$fracht_min2+$fracht_min3+round($fracht_leute/100)+$fracht_vorrat+round($leichtebt*0.3)+round($schwerebt*1.5);

    ?>
    <body text="#000000" background="<?php echo $bildpfad; ?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="7"></td>
                </tr>
                <tr>
                    <td><center><?php echo $lang['flottegamma']['lagerraeume']; ?></center></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
                </tr>
                <tr>
                    <td style="color:#aaaaaa;"><center><?php echo str_replace(array('{1}','{2}'),array($gesamt,$frachtraum),$lang['flottegamma']['lagergefuellt']);?></center></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="11"></td>
                </tr>
            </table>
        </center>
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/crew.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottegamma']['kolonisten']; ?></td>

                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/leichtebt.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottegamma']['leichtebt']; ?></td>

                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/mineral_1.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottegamma']['baxterium']; ?></td>

                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/mineral_3.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottegamma']['vomisaan']; ?></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                    <td><?php echo $fracht_leute; ?></td>

                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                    <td><?php echo $leichtebt; ?></td>

                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <div id="min1"><?php echo $fracht_min1; ?></div>
                                </td>
                                <td>&nbsp;<?php echo $lang['flottegamma']['kt']?></td>
                            </tr>
                        </table>
                    </td>

                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <div id="min3"><?php echo $fracht_min3; ?></div>
                                </td>
                                <td>&nbsp;<?php echo $lang['flottegamma']['kt']?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/cantox.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottegamma']['cantox']; ?></td>

                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/schwerebt.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottegamma']['schwerebt']; ?></td>

                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/mineral_2.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottegamma']['rennurbin']; ?></td>

                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/vorrat.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottegamma']['vorraete']; ?></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                    <td><div id="cantox"><?php echo $fracht_cantox; ?></div></td>

                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                    <td><?php echo $schwerebt; ?></td>

                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <div id="min2"><?php echo $fracht_min2; ?></div>
                                </td>
                                <td>&nbsp;<?php echo $lang['flottegamma']['kt']?></td>
                            </tr>
                        </table>
                    </td>

                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <div id="vorrat"><?php echo $fracht_vorrat; ?></div>
                                </td>
                                <td>&nbsp;<?php echo $lang['flottegamma']['kt']?></td>
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

    $zeiger = @mysql_query("SELECT id,aggro,mission FROM $skrupel_schiffe where id=$shid");
    $array = @mysql_fetch_array($zeiger);
    $aggro=$array["aggro"];
    $mission=$array["mission"];
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" cellspacing="0" cellpadding="1">
                <tr>
                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="6"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                    <td><center><?php if ($module[3]==1) { ?><?php echo $lang['flottegamma']['taktik']; ?><?php } else { ?><?php echo $lang['flottegamma']['aggressivitaet']; ?><?php } ?></center></td>
                    <td><a href="javascript:hilfe(<?php if ($module[3]==1) { ?><?php } else { ?>38<?php } ?>);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                </tr>
            </table>
        </center>
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><form name="formular" id="formular" method="post" action="flotte_gamma.php?fu=6&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                    <?php
                    if ($module[3]==1) {
                        ?>
                        <td>
                            <select name="taktik" style="width:120px;">
                                <option value="1" <?php if ($mission==1) { echo "selected"; } ?>><?php echo $lang['flottegamma']['aggressiv']; ?></option>
                                <option value="0" <?php if ($mission==0) { echo "selected"; } ?>><?php echo $lang['flottegamma']['ueberlegt']; ?></option>
                                <option value="2" <?php if ($mission==2) { echo "selected"; } ?>><?php echo $lang['flottegamma']['defensiv']; ?></option>
                            </select>
                        </td>
                        <td><img src="../bilder/empty.gif" border="0" width="14" height="1"></td>
                        <?php
                    }
                    ?>
                    <td>
                        <select name="aggro" style="<?php if ($module[3]==1) { ?>width:120px;<?php } else { ?>width:254px;<?php }?>">
                            <option value="0" style="background-color:#288516;" <?php if ($aggro==0) { echo "selected"; } ?>>&nbsp;</option>
                            <option value="1" style="background-color:#387C15;" <?php if ($aggro==1) { echo "selected"; } ?>>&nbsp;</option>
                            <option value="2" style="background-color:#4D6E13;" <?php if ($aggro==2) { echo "selected"; } ?>>&nbsp;</option>
                            <option value="3" style="background-color:#665F10;" <?php if ($aggro==3) { echo "selected"; } ?>>&nbsp;</option>
                            <option value="4" style="background-color:#814E0D;" <?php if ($aggro==4) { echo "selected"; } ?>>&nbsp;</option>
                            <option value="5" style="background-color:#9C3D0A;" <?php if ($aggro==5) { echo "selected"; } ?>>&nbsp;</option>
                            <option value="6" style="background-color:#BA2A07;" <?php if ($aggro==6) { echo "selected"; } ?>>&nbsp;</option>
                            <option value="7" style="background-color:#CE1E05;" <?php if ($aggro==7) { echo "selected"; } ?>>&nbsp;</option>
                            <option value="8" style="background-color:#E51003;" <?php if ($aggro==8) { echo "selected"; } ?>>&nbsp;</option>
                            <option value="9" style="background-color:#F80401;" <?php if ($aggro==9) { echo "selected"; } ?>>&nbsp;</option>
                        </select>
                    </td>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="45"></td>
                </tr>
                <tr>
                    <td></td>
                    <td<?php if ($module[3]==1) { ?> colspan="3" <?php } ?>><img src="../bilder/empty.gif" border="0" width="254" height="1"></td>
                    <td></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                    <td<?php if ($module[3]==1) { ?> colspan="3"<?php } ?>><input type="submit" name="bla" value="<?php echo $lang['flottegamma']['einstellunguebernehmen']; ?>" style="width:254px;"></td>
                    <td></form></td>
                </tr>
            </table>
        </center>
        <?php
    include ("inc.footer.php");
}

if ($fuid==6) {
    include ("inc.header.php");

    if ($module[3]==1) {
        $zeiger = @mysql_query("UPDATE $skrupel_schiffe set aggro=\"".int_post('aggro')."\",mission=\"".int_post('taktik')."\" where id=$shid and besitzer=$spieler");
    } else {
        $zeiger = @mysql_query("UPDATE $skrupel_schiffe set aggro=\"".int_post('aggro')."\" where id=$shid and besitzer=$spieler");
    }

    ?>
    <body text="#000000" background="<?php echo $bildpfad; ?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0"">
        <br><br><br><br>
        <center><?php echo $lang['flottegamma']['aggressivitaetuebernommen']; ?></center>
        <?php
    include ("inc.footer.php");
}
