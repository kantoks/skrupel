<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'hilfe_spionage';
$langfile_2 = 'spionagen';
$fuid = int_get('fu');

if ($fuid>=1) {
    include ("inc.header.php");
    ?>
    <body text="#000000" bgcolor="#444444"  link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">    
        <script language=JavaScript>parent.document.title='<?php echo $lang['hilfe_spionage']['spionage']?>';</script>
        <?php
        if(!$module[0]) {
            ?>
            <center>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="1" height="6"></td>
                    </tr>
                    <tr>
                        <td style="text-align:center;"><?php echo $lang['hilfe_spionage']['deaktiviert']?></td>
                    </tr>
                </table>
            </center>
            <br>
            <?php
            include ("inc.footer.php");
            die();
        }
        if ($fuid==1) { ?>
            <table border="0" cellspacing="0" cellpadding="4" width="100%">
                <tr>
                    <td colspan="2" style="font-size:18px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2); text-align:center;"><?php echo $lang['hilfe_spionage']['zentrum']?></td>
                </tr>
                <tr>
                    <td style="vertical-align:top;">
                        <img src="<?php echo $bildpfad; ?>/osysteme/4.gif" border="0" width="61" height="64">
                    </td>
                    <td style="color:#aaaaaa;">
                        <span style="color:#ffffff;"><?php echo $lang['hilfe_spionage']['spion']['uber']?></span>
                        <?php echo $lang['hilfe_spionage']['spion']['text']?>
                        <span style="color:#ffffff;"><?php echo $lang['hilfe_spionage']['schiff']['uber']?></span>
                        <?php echo $lang['hilfe_spionage']['schiff']['text']?>
                        <span style="color:#ffffff;"><?php echo $lang['hilfe_spionage']['mission']['uber']?></span>
                        <?php echo $lang['hilfe_spionage']['mission']['text']?>
                        <span style="color:#ffffff;"><?php echo $lang['hilfe_spionage']['opfer']['uber']?></span>
                        <?php echo $lang['hilfe_spionage']['opfer']['text']?>
                    </td>
                </tr>
            </table>
            <?php
        }elseif ($fuid==2) {
            $xp = int_get('spid');
            $stufe = spionstufe($xp);
            if($stufe > 5) { $lvl = 5; } else { $lvl = $stufe; }
            ?>
            <table border="0" cellspacing="0" cellpadding="4" width="100%">
                <tr>
                    <td colspan="2" style="font-size:18px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2); text-align:center;">
                        <?php echo $lang['hilfe_spionage']['spioschiffe']?>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:top;">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="8"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td><img src="../daten/unknown/bilder_schiffe/1_klein.jpg" border="0" width="75" height="50"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="4"></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align:center;">
                                    <?php
                                    if($lvl > 0) {
                                        ?>
                                        <img src="<?php echo $bildpfad; ?>/icons/erf_<?php echo $lvl;?>.gif" title="<?php echo str_replace('{1}',$lvl,$lang['hilfe_spionage']['erfahrungslevel'])?>" border="0" width="22" height="22">
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="vertical-align:top;">
                        <table border="0" cellspacing="0" cellpadding="2">
                            <tr>
                                <td style="text-align:center;font-size:12px;font-weight:bold;"><nobr><?php echo str_replace('{1}',$stufe,$lang['hilfe_spionage']['stufe'])?></nobr></td>
                                <td style="text-align:right;"><span style="color:#aaaaaa;"><?php echo str_replace('{1}',$xp,$lang['hilfe_spionage']['erfahrungspunkte'])?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><img src="../bilder/empty.gif" border="0" width="1" height="4"></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#ffffff;"><?php echo $lang['hilfe_spionage']['sue']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['hilfe_spionage']['wirkunglevel']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['hilfe_spionage']['wirkungstufe']?></td>
                            </tr>
                            <?php
                            $xp_benoetigt = 0;
                            $stufe_next = $stufe + 1;
                            if($stufe_next > 10) { $stufe_next = 10; }
                            for($s=0;$s<$stufe_next;$s++) {
                                $xp_benoetigt += (($s+1)*100);
                            }
                            ?>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;">
                                    <?php
                                    echo $lang['hilfe_spionage']['aufstieg'];
                                    if($stufe == 10) { 
                                        echo $lang['hilfe_spionage']['hoechstgrenze'];
                                    } else { 
                                        echo str_replace(array('{1}','{2}'),array($stufe_next,$xp_benoetigt),$lang['hilfe_spionage']['erfahrung']);
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['hilfe_spionage']['erhalt_erfahrung']?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><img src="../bilder/empty.gif" border="0" width="1" height="4"></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#ffffff;"><?php echo $lang['hilfe_spionage']['spionage']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['hilfe_spionage']['tarnsystem']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['hilfe_spionage']['ziel']?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><img src="../bilder/empty.gif" border="0" width="1" height="4"></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['hilfe_spionage']['abbau']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['hilfe_spionage']['zehn_prozent']?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><img src="../bilder/empty.gif" border="0" width="1" height="4"></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['hilfe_spionage']['verbleib']?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><img src="../bilder/empty.gif" border="0" width="1" height="4"></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#ffffff;"><?php echo $lang['hilfe_spionage']['info']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['hilfe_spionage']['ausweichen']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['hilfe_spionage']['politik']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['hilfe_spionage']['loyds']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['hilfe_spionage']['abfrage']?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <?php
        }elseif ($fuid==3) {
            $spionage_id = int_get('spid');
            //spionagen
            $file="../daten/unknown/spionagen.txt";
            $fp = @fopen("$file","r");
            if ($fp) {
                $spion_zaehler = 0;
                while (!feof ($fp)) {
                    $buffer = @fgets($fp, 4096);
                    if(strlen($buffer) > 0) {
                        $attribute = @explode(":", $buffer);
                        $id = $attribute[0];
                        //$spionage_daten[$id]['name'] = $attribute[1];
                        //$spionage_daten[$id]['beschreibung'] = $attribute[2];
                        $spionage_daten[$id]['level'] = $attribute[3];
                        $spionage_daten[$id]['wahrscheinlichkeit'] = $attribute[4];
                        $spionage_daten[$id]['ausbeute_min'] = $attribute[5];
                        $spionage_daten[$id]['ausbeute_max'] = $attribute[6];
                        //$spionage_daten[$id]['ziel'] = $attribute[7];
                    }
                }
                @fclose($fp);
            }else {
                ?>
                <center>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="1" height="6"></td>
                        </tr>
                        <tr>
                            <td style="text-align:center;"><?php echo $lang['hilfe_spionage']['deaktiviert']?></td>
                        </tr>
                    </table>
                </center>
                <br>
                <?php
                include ("inc.footer.php");
                die();
            }
            ?>
            <table border="0" cellspacing="0" cellpadding="4" width="100%">
                <tr>
                    <td colspan="2" style="font-size:18px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2); text-align:center;"><?php echo $lang['hilfe_spionage']['spiomiss']?></td>
                </tr>
                <tr>
                    <td style="vertical-align:top;"><img src="<?php echo $bildpfad; ?>/osysteme/4.gif" border="0" width="61" height="64" >
                </td>
                    <td style="text-align:left;">
                        <table border="0" cellspacing="0" cellpadding="1">
                            <tr>
                                <td colspan="3" style="font-size:12px;font-weight:bold;"><?php echo $lang['spionagen'][$spionage_id]['name'];?></td>
                            </tr>
                            <tr>
                                <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="4"></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="color:#aaaaaa;"><?php echo $lang['spionagen'][$spionage_id]['bsch'];?></td>
                            </tr>
                            <tr>
                                <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="4"></td>
                            </tr>
                            <tr>
                                <td style="color:#aaaaaa;"><?php echo $lang['hilfe_spionage']['beziel']?></td>
                                <td style="color:#aaaaaa;text-align:right;"><?php echo $lang['hilfe_spionage']['bestufe']?></td>
                                <td style="color:#ffffff;"><?php echo $spionage_daten[$spionage_id]['level'];?></td>
                            </tr>
                            <tr>
                                <td style="color:#ffffff;"><?php echo $lang['spionagen'][$spionage_id]['ziel'];?></td>
                                <td style="color:#aaaaaa;text-align:right;"><?php echo $lang['hilfe_spionage']['chance']?></td>
                                <td style="color:#ffffff;"><?php echo str_replace('{1}',$spionage_daten[$spionage_id]['wahrscheinlichkeit'],$lang['hilfe_spionage']['vh'])?></td>
                            </tr>
                            <?php 
                            if($spionage_daten[$spionage_id]['ausbeute_max'] > 0) { 
                                if ($spionage_daten[$spionage_id]['ausbeute_min'] < $spionage_daten[$spionage_id]['ausbeute_max']) {
                                    $wirkungsgrad = str_replace(array('{1}','{2}'),array($spionage_daten[$spionage_id]['ausbeute_min'],$spionage_daten[$spionage_id]['ausbeute_max']),$lang['hilfe_spionage']['vb_vh']);
                                }
                                else {
                                    $wirkungsgrad = str_replace('{1}',$spionage_daten[$spionage_id]['ausbeute_max'],$lang['hilfe_spionage']['vh']);
                                }
                                ?>
                                <tr>
                                    <td colspan="2" style="color:#aaaaaa;text-align:right;"><?php echo $lang['hilfe_spionage']['wirkungsgrad']?></td>
                                    <td style="color:#ffffff;"><?php echo $wirkungsgrad;?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </td>
                </tr>
            </table>
            <?php
        }elseif ($fuid==4) {
            $shid = int_get('spid');
            $zeiger_schiff = @mysql_query("SELECT * FROM $skrupel_schiffe where besitzer=$spieler and id=$shid");
            $schiff = @mysql_fetch_array($zeiger_schiff);
            $extra = @explode(":", $schiff['extra']);
            $extra_spio = @explode("-", $extra[0]);
            ?>
            <table border="0" cellspacing="0" cellpadding="4" width="100%">
                <tr>
                    <td colspan="2" style="font-size:18px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2); text-align:center;"><?php echo $lang['hilfe_spionage']['spioschiffe']?></td>
                    <td style="text-align:right;">
                        <a href="hilfe_spionage.php?fu2=2&spid=<?php echo $extra_spio[0];?>&uid=<?php echo $uid;?>&sid=<?php echo $sid;?>" target="_top">
                            <img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17">
                        </a>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:top;">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <tdcolspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="8"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td><img src="../daten/<?php echo $schiff['volk'];?>/bilder_schiffe/<?php echo $schiff['bild_klein'];?>" border="0" width="75" height="50"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="4"></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align:center;">
                                    <?php
                                    if($schiff['erfahrung'] > 0) {
                                        ?>
                                        <img src="<?php echo $bildpfad; ?>/icons/erf_<?php echo $schiff['erfahrung'];?>.gif" title="<?php echo str_replace('{1}',$schiff['erfahrung'],$lang['hilfe_spionage']['erfahrungslevel'])?>" border="0" width="22" height="22">
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="2">
                            <tr>
                                <td colspan="2" style="text-align:center;font-size:12px;font-weight:bold;"><?php echo $schiff['name'];?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><img src="../bilder/empty.gif" border="0" width="1" height="4"></td>
                            </tr>
                            <tr>
                                <td style="color:#aaaaaa;text-align:right;"><?php echo $lang['hilfe_spionage']['stufe_b']?></td>
                                <td style="color:#ffffff;"><?php echo $extra_spio[1];?></td>
                            </tr>
                            <tr>
                                <td style="color:#aaaaaa;text-align:right;"><?php echo $lang['hilfe_spionage']['erfahrung_b']?></td>
                                <td style="color:#ffffff;"><?php echo $extra_spio[0];?></td>
                            </tr>
                            <?php
                            $xp_benoetigt = 0;
                            for($stufe=0;$stufe<=$extra_spio[1];$stufe++) {
                                $xp_benoetigt += (($stufe+1)*100);
                            }
                            if($extra_spio[1] == 10) { $xp_benoetigt = $lang['hilfe_spionage']['hoechststufe']; }
                            ?>
                            <tr>
                                <td style="color:#aaaaaa;text-align:right;"><?php echo $lang['hilfe_spionage']['naechstestufe']?></td>
                                <td style="color:#ffffff;"><?php echo $xp_benoetigt;?></td>
                            </tr>
                            <?php
                            $tarnung = $schiff['tarnfeld']*10;
                            if($tarnung <= 100) { $color = "#00ff00"; $tarnstatus = str_replace('{1}',$tarnung,$lang['hilfe_spionage']['wertung'][100]); }
                            if($tarnung <= 70) { $color = "#77ff00"; $tarnstatus = str_replace('{1}',$tarnung,$lang['hilfe_spionage']['wertung'][70]); }
                            if($tarnung <= 40) { $color = "#ffff00"; $tarnstatus = str_replace('{1}',$tarnung,$lang['hilfe_spionage']['wertung'][40]); }
                            if($tarnung <= 10) { $color = "#ff7700"; $tarnstatus = str_replace('{1}',$tarnung,$lang['hilfe_spionage']['wertung'][10]); }
                            if($tarnung <= 0) { $color = "#ff0000"; $tarnstatus = $lang['hilfe_spionage']['wertung'][0]; }
                            ?>
                            <tr>
                                <td style="color:#aaaaaa;text-align:right;"><?php echo $lang['hilfe_spionage']['tarnung']?></td>
                                <td style="color:<?php echo $color;?>;"><?php echo $tarnstatus;?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><img src="../bilder/empty.gif" border="0" width="1" height="4"></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['hilfe_spionage']['zehn_prozent']?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <?php
        }
    include ("inc.footer.php");
}
else {
    include ("inc.header.php");
    ?>
    <frameset framespacing="0" border="false" frameborder="0" rows="18,*,16">
        <frameset framespacing="0" border="false" frameborder="0" cols="114,*,114">
            <frame name="rahmen1" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=34&bildpfad=<?php echo $bildpfad; ?>" target="_self">
            <frame name="rahmen2" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=20&bildpfad=<?php echo $bildpfad; ?>" target="_self">
            <frame name="rahmen3" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=35&bildpfad=<?php echo $bildpfad; ?>" target="_self">
        </frameset>
        <frameset framespacing="0" border="false" frameborder="0" cols="18,*,18">
            <frameset framespacing="0" border="false" frameborder="0" rows="80,*,92">
                <frame name="rahmen15" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=25&bildpfad=<?php echo $bildpfad; ?>" target="_self">
                <frame name="rahmen16" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=26&bildpfad=<?php echo $bildpfad; ?>" target="_self">
                <frame name="rahmen17" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=27&bildpfad=<?php echo $bildpfad; ?>" target="_self">
            </frameset>
            <frame name="rahmen12" scrolling="auto" marginwidth="0" marginheight="0" noresize src="hilfe_spionage.php?fu=<?php echo int_get('fu2'); ?>&spid=<?php echo int_get('spid'); ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" target="_self">
            <frameset framespacing="0" border="false" frameborder="0" rows="80,*,92">
                <frame name="rahmen18" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=28&bildpfad=<?php echo $bildpfad; ?>" target="_self">
                <frame name="rahmen19" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=29&bildpfad=<?php echo $bildpfad; ?>" target="_self">
                <frame name="rahmen20" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=30&bildpfad=<?php echo $bildpfad; ?>" target="_self">
            </frameset>
        </frameset>
        <frameset framespacing="0" border="false" frameborder="0" cols="114,*,114">
            <frame name="rahmen6" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=36&bildpfad=<?php echo $bildpfad; ?>" target="_self">
            <frame name="rahmen7" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=23&bildpfad=<?php echo $bildpfad; ?>" target="_self">
            <frame name="rahmen8" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=37&bildpfad=<?php echo $bildpfad; ?>" target="_self">
        </frameset>
    </frameset>
    <noframes>
    <body>
        <?php
    include ("inc.footer.php");
}

function spionstufe($xp) {
    $xp_benoetigt = 0;
    for($stufe=0;$stufe<10;$stufe++) {
        $xp_benoetigt += (($stufe+1)*100);
        if($xp < $xp_benoetigt) { return $stufe; }
    }
    return 10;
}
