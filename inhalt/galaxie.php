<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');

open_db();
include ('inc.check.php');

$langfile_1 = 'galaxie';
$fuid = int_get('fu');
$noani='';
if (@intval(substr($spieler_optionen,15,1))==1) {
    $noani='_noani';
}

if ($fuid==1) {
    $gox = int_get('gox');
    $goy = int_get('goy');
    $sprung='';
    if (($gox >= 1) and ($goy >= 1)) {
        $gox = round($gox*$umfang/250);
        $goy = round($goy*$umfang/250);
        $sprung='&gox='.$gox.'&goy='.$goy;
    }
    ?>
    <html>
        <head>
            <meta http-equiv="imagetoolbar" content="no">
            <style type="text/css">
                body, p, td {
                    font-family:    Verdana;
                    font-size:        <?php echo 10-$plus; ?>px;
                    color:            #d0d0d0;
                }
            </style>
        </head>
        <body style="background-color: #000000; border: 0;" onLoad="window.location='galaxie.php?fu=2&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?><?php echo $sprung; ?>';" background="<?php echo $bildpfad; ?>/karte/hintergrund_c.gif" scroll="auto" style="background-image:url('<?php echo $bildpfad; ?>/karte/hintergrund_c.gif'); background-attachment:fixed;" TEXT="#ffffff" LINK="#000000" VLINK="#000000" ALINK="#000000" topmargin="0" leftmargin=0 marginwidth="0" marginheight="0">
            <center>
                <table border="0" cellspacing="0" cellpadding="0" height="100%">
                    <tr>
                        <td>
                            <center>
                                <img src="<?php echo $bildpfad; ?>/rad.gif" height="75" width="83">
                                <br><br>
                                <?php echo $lang['galaxie']['lade']; ?>
                            </center>
                        </td>
                    </tr>
                </table>
            </center>
        </body>
    </html>
    <?php
}
if ($fuid==2) {
    $useragent = getEnv("HTTP_USER_AGENT");
    $linux=preg_match("=linux=i", $useragent);
    $plus=0;
    if ($linux) { $plus=1; }
    srand((double)microtime()*1000000);
    //politik
    //tabelle initialisieren
    $beziehung = array_fill(1, 10, array_fill(1, 10, array('status'=>0, 'optionen'=>0)));
    $zeiger = mysql_query("SELECT partei_a,partei_b,status,optionen FROM $skrupel_politik WHERE spiel=$spiel AND (partei_a=$spieler OR partei_b=$spieler)");
    while($array = mysql_fetch_array($zeiger)) {
        list($partei_a, $partei_b, $status, $optionen) = $array;
        $beziehung[$partei_a][$partei_b]['status']   = $status;
        $beziehung[$partei_b][$partei_a]['status']   = $status;
        $beziehung[$partei_a][$partei_b]['optionen'] = $optionen;
        $beziehung[$partei_b][$partei_a]['optionen'] = $optionen;
    }
    if($module[0]) {
        $file="../daten/unknown/spionagen.txt";
        $fp = @fopen("$file","r");
        if ($fp) {
            $spion_zaehler = 0;
            while (!feof ($fp)) {
                $buffer = @fgets($fp, 4096);
                if(strlen($buffer) > 0) {
                    $attribute = @explode(":", $buffer);
                    $spionage_daten[$attribute[0]]['name'] = $attribute[1];
                }
            }
            @fclose($fp);
        } else {
            $spionage_daten = "";
        }
    }
    ?>
    <html>
        <head>
            <meta http-equiv="imagetoolbar" content="no">
            <style type="text/css">
                body, p, td {
                    font-family:    Verdana;
                    font-size:    <?php echo 10-$plus; ?>px;
                    color:        #d0d0d0;
                    cursor:        <?php if (@intval(substr($spieler_optionen,11,1))==1) { echo "crosshair"; } else { echo "url(../bilder/cursor/blau.cur), crosshair"; } ?>;
                }
                a {
                    cursor: <?php if (@intval(substr($spieler_optionen,11,1))==1) { echo "crosshair"; } else { echo "url(../bilder/cursor/blau.cur), crosshair"; } ?>;
                }
                body {
                    scrollbar-DarkShadow-Color:    #222222;
                    scrollbar-3dLight-Color:    #888888;
                    scrollbar-Track-Color:        #<?php if ($nebel>=1) { echo "111111"; } else { echo "000000"; } ?>;
                    scrollbar-Face-Color:        #555555;
                    scrollbar-Shadow-Color:        #<?php if ($nebel>=1) { echo "111111"; } else { echo "000000"; } ?>;
                    scrollbar-Highlight-Color:  #<?php if ($nebel>=1) { echo "111111"; } else { echo "000000"; } ?>;
                    scrollbar-Arrow-Color:        #555555;
                }
            </style>
            <script type="text/javascript" src="../lang/<?php echo $spieler_sprache; ?>/lang.galaxie.js"></script>
            <script type="text/javascript" src="js/galaxie.js"></script>
            <script type="text/javascript">
                info.uid = '<?php echo $uid; ?>';
                info.sid = '<?php echo $sid; ?>';
                info.sprache = '<?php echo $spieler_sprache; ?>';
                info.bildpfad = '<?php echo $bildpfad; ?>';
                info.umfang = <?php echo $umfang; ?>;
                <?php
                if(intval(substr($spieler_optionen,12,1)) == 0) echo "settings.enabletooltips = true;\n";
                if(intval(substr($spieler_optionen, 2,1)) == 1) echo "settings.tooltip_planetkolonisten = true;\n";
                if(intval(substr($spieler_optionen, 3,1)) == 1) echo "settings.tooltip_planetbasisres = true;\n";
                if(intval(substr($spieler_optionen, 4,1)) == 1) echo "settings.tooltip_planetmineralien = true;\n";
                if(intval(substr($spieler_optionen, 5,1)) == 1) echo "settings.tooltip_planetanlagen = true;\n";
                if(intval(substr($spieler_optionen, 6,1)) == 1) echo "settings.tooltip_planetlogbuch = true;\n";
                if(intval(substr($spieler_optionen,14,1)) == 1) echo "settings.enableshipimages = true;\n";
                if(intval(substr($spieler_optionen, 9,1)) == 1) echo "settings.tooltip_schifffracht = true;\n";
                if(intval(substr($spieler_optionen, 8,1)) == 1) echo "settings.tooltip_schiffspezialmission = true;\n";
                if(intval(substr($spieler_optionen,10,1)) == 1) echo "settings.tooltip_schifflogbuch = true;\n";
                if(intval(substr($spieler_optionen, 7,1)) == 1) echo "settings.tooltip_schiffbasiswerte = true;\n";
                if(intval(substr($spieler_optionen,17,1)) != 1) echo "settings.scrollbars = true;\n";
                ?>
            </script>
            <?php if (@intval(substr($spieler_optionen,17,1))!=1) { ?>
                <link href="js/flexcroll/standard_grey.css" rel="stylesheet" type="text/css" />
                <script type="text/javascript" src="js/flexcroll/flexcroll.js"></script>
            <?php } ?>
        </head>
        <body style="background-color: #111111; border: 0;" onLoad="move_sticky();<?php if (@intval(substr($spieler_optionen,17,1))!=1) { ?>CSBfleXcroll('complete');<?php } ?>" scroll="auto"  TEXT="#ffffff" LINK="#000000" VLINK="#000000" ALINK="#000000" topmargin="0" leftmargin=0 marginwidth="0" marginheight="0">
        <div id="complete" class='flexcrollafter' style="position:relative;height:100%;width:100%px;overflow:auto;">
            <div style="overflow:hidden;height:<?php echo $umfang; ?>px;width:<?php echo $umfang; ?>px;max-width:<?php echo $umfang; ?>px; max-height:<?php echo $umfang; ?>px;">
                <?php
                $spalte='sicht_'.$spieler;
                $spalte_beta=$spalte.'_beta';
                ?>
                <script type="text/javascript">
                <!--
                    ns4 = (document.layers)? true:false;
                    ie = (document.styleSheets&& document.all)? true:false;
                    ns6 = (document.getElementById&& !document.all)? true:false;
                    opera= (document.all&& !document.styleSheets)? true:false;
                    top_position = 10;
                    right_position = 85;
                    rechts_overflowhidden_korrektur=0;
                    //Scrollbalkenkorrektur && Overfloekorrekut(ie)
                    if (ie) {
                        if(document.body.offsetWidth><?php echo $umfang?>){
                            rechts_overflowhidden_korrektur=document.body.offsetWidth-<?php echo $umfang?>;
                        }else{
                            if(document.body.offsetHeight<<?php echo $umfang?>)right_position=105;
                        }
                    } else {
                        if(window.innerHeight<<?php echo $umfang?>)right_position=105;
                    }
                    function move_sticky(e) {
                        if (ie) {
          document.all.sticky.style.position='absolute';
                            document.all.sticky.style.top=document.body.scrollTop+top_position;
                            document.all.sticky.style.left=document.body.scrollLeft-right_position-rechts_overflowhidden_korrektur+document.body.offsetWidth;
                            setTimeout("move_sticky()",200);
                        } else {
                            document.getElementById("sticky").style.top=top_position;
                            document.getElementById("sticky").style.left=window.innerWidth-right_position-rechts_overflowhidden_korrektur;
                        }
                    }
                    function hide_sticky() {
                        if (ns6||opera) document.getElementById("sticky").style.visibility = "hidden";
                        if (ns4) document.sticky.visibility = "hidden";
                        if (ie) document.all.sticky.style.visibility = "hidden";
                    }
                    function jump(e) {
      if (ie) {
                            posx = event.clientX - document.body.offsetWidth + right_position + rechts_overflowhidden_korrektur;
                            posy = event.clientY - top_position;
                        } else {
                            posx = e.pageX-window.pageXOffset-window.innerWidth+right_position+rechts_overflowhidden_korrektur;
                            posy = e.pageY-window.pageYOffset-top_position;
                        }
                        posx = Math.round(posx * <?php echo $umfang; ?>/75);
                        posy = Math.round(posy * <?php echo $umfang; ?>/75);
                        movemap(posx,posy);
                        self.focus();
                    }
                //-->
                </script>
                <form>
                     <input type="hidden" id="platzhalter">
                </form>
                <div id="sticky" style="position:fixed;z-index:20; left:1px;top=10;">
                    <?php
                    if ($nebel>=1) {
                        $zeiger = @mysql_query("SELECT id,x_pos,y_pos,besitzer FROM $skrupel_planeten where $spalte=1 and spiel=$spiel order by id");
                    } else {
                        $zeiger = @mysql_query("SELECT id,x_pos,y_pos,besitzer FROM $skrupel_planeten where spiel=$spiel order by id");
                    }
                    $datensaetze = @mysql_num_rows($zeiger);
                    if ($datensaetze>=1) {
                        for  ($i=0; $i<$datensaetze;$i++) {
                            $ok = @mysql_data_seek($zeiger,$i);
                            $array = @mysql_fetch_array($zeiger);
                            $id=$array["id"];
                            $x_pos=$array["x_pos"];
                            $y_pos=$array["y_pos"];
                            $besitzer=$array["besitzer"];
                            $x_position=$x_pos*75/$umfang;
                            $y_position=$y_pos*75/$umfang;
                            $farbe='#aaaaaa';
                            if ($besitzer>=1) {
                                $farbe=$spielerfarbe[$besitzer];
                            }
                            ?>
                            <div id="planet_mini_<?php echo $id; ?>" style="background-color:<?php echo $farbe; ?>;position: absolute; left:<?php echo $x_position?>px; top:<?php echo $y_position?>px; width:1px; height:1px;visibility:visible;">
                                <!img src="../bilder/empty.gif" width="1" height="1" border="0">
                            </div>
                            <?php
                            }
                        }
                    if ($nebel>=2) {
                        $zeiger = @mysql_query("SELECT id,x_pos,y_pos FROM $skrupel_planeten where $spalte_beta=1 and $spalte=0 and spiel=$spiel order by id");
                        $datensaetze = @mysql_num_rows($zeiger);
                        if ($datensaetze>=1) {
                            for  ($i=0; $i<$datensaetze;$i++) {
                                $ok = @mysql_data_seek($zeiger,$i);
                                $array = @mysql_fetch_array($zeiger);
                                $id=$array["id"];
                                $x_pos=$array["x_pos"];
                                $y_pos=$array["y_pos"];
                                $x_position=$x_pos*75/$umfang;
                                $y_position=$y_pos*75/$umfang;
                                ?>
                                <div id="planet_mini_<?php echo $id; ?>" style="background-color:#aaaaaa;position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position; ?>px; width:1px; height:1px;visibility:visible;">
                                    <!img src="../bilder/empty.gif" width="1" height="1" border="0">
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                    <div id="minkarte" style="position: absolute; left:0px; top:0px; width:75px; height:75px;visibility:visible; border: 1px solid #444444;">
                        <a href="javascript:;" onclick="jump(event)"><img src="../bilder/empty.gif" width="75" height="75" border="0"></a>
                    </div>
                </div>
                <div id="tooltip_uebersicht" style="z-index:15;position: absolute; left:0px; top:0px;visibility:hidden;">
                    <table border="0" cellspacing="0" cellpadding="2" style="background-color:#444444;">
                        <tr>
                            <td style="background-color:#222222;border-style:solid;border-width:1px;border-color:#888888 #888888 #888888 #888888;color:#ffffff;">
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td><img src="../bilder/empty.gif" width="15" height="17"></td>
                                        <td><nobr><b>&nbsp;<?php echo $lang['galaxie']['imperien']; ?>&nbsp;</b></nobr></td>
                                        <td><img src="../bilder/empty.gif" width="2" height="17"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-style:solid;border-width:1px;border-color:#444444 #666666 #666666 #666666;">
                                <table border="0" cellspacing="0" cellpadding="1">
                                    <?php
                                    for ($mn=1;$mn<11;$mn++) {
                                        if ($spieler_id_c[$mn]>=1) {
                                            $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_id_c[$mn]");
                                            $array_temp = @mysql_fetch_array($zeiger_temp);
                                            $username=$array_temp["nick"];
                                            if ($spieler_raus_c[$mn]==1) { $username="<s>".$username."</s>"; }
                                            ?>
                                            <tr>
                                                <td valign="top"><img src="../bilder/empty.gif" width="15" height="17"></td>
                                                <td style="color:<?php echo $spielerfarbe[$mn]; ?>;"><?php echo $username; ?> - <?php echo $spieler_rassename_c[$mn]; ?></td>
                                                <td valign="top"><img src="../bilder/empty.gif" width="2" height="17"></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                <?php
                if(@intval(substr($spieler_optionen,14,1))==1) {
                    ?>
                    <div id="tooltip_schiffbild" style="z-index:15;position: absolute; left:0px; top:0px;visibility:hidden;">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="background-color:#222222;border-style:solid;border-width:1px;border-color:#888888 #888888 #888888 #888888;color:#ffffff;">
                                    <div id="tooltip_schiffbildinhalt"></div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <?php
                }
                if(@intval(substr($spieler_optionen,12,1))==0) {
                    ?>
                    <div id="tooltip_abkommen" style="z-index:15;position: absolute; left:0px; top:0px;visibility:hidden;">
                        <div id="tip_abkommen"></div>
                    </div>
                    <div id="tooltip_planetbesetzt" style="z-index:15;position: absolute; left:0px; top:0px;visibility:hidden;">
                        <table border="0" cellspacing="0" cellpadding="2" style="background-color:#444444;">
                            <tr>
                                <td style="background-color:#222222;border-style:solid;border-width:1px;border-color:#888888 #888888 #888888 #888888;color:#ffffff;">
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td><img src="<?php echo $bildpfad; ?>/karte/tool_planet.gif" width="18" height="17"></td>
                                            <td><nobr><b><div id="tip_name"></div></b></nobr></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-style:solid;border-width:1px;border-color:#444444 #666666 #666666 #666666;">
                                    <table border="0" cellspacing="0" cellpadding="1">
                                        <?php
                                        if(@intval(substr($spieler_optionen,2,1))==1) {
                                            ?>
                                            <tr>
                                                <td><img src="<?php echo $bildpfad; ?>/icons/crew.gif" width="17" height="17"></td>
                                                <td style="color:#aaaaaa;" colspan="3"><div id="tip_kolonisten"></div></td>
                                            </tr>
                                            <?php
                                        }
                                        if(@intval(substr($spieler_optionen,3,1))==1) {
                                            ?>
                                            <tr>
                                                <td><img src="<?php echo $bildpfad; ?>/icons/cantox.gif" width="17" height="17"></td>
                                                <td style="color:#aaaaaa;"><div id="tip_cantox"></div></td>
                                                <td><img src="<?php echo $bildpfad; ?>/icons/vorrat.gif" width="17" height="17"></td>
                                                <td style="color:#aaaaaa;"><div id="tip_vorrat"></div></td>
                                            </tr>
                                            <?php
                                        }
                                        if(@intval(substr($spieler_optionen,4,1))==1) {
                                            ?>
                                            <tr>
                                                <td><img src="<?php echo $bildpfad; ?>/icons/lemin.gif" width="17" height="17"></td>
                                                <td style="color:#aaaaaa;"><nobr><div id="tip_lemin"></div></nobr></td>
                                                <td><img src="<?php echo $bildpfad; ?>/icons/mineral_2.gif" width="17" height="17"></td>
                                                <td style="color:#aaaaaa;"><nobr><div id="tip_min2"></div></nobr></td>
                                            </tr>
                                            <tr>
                                                <td><img src="<?php echo $bildpfad; ?>/icons/mineral_1.gif" width="17" height="17"></td>
                                                <td style="color:#aaaaaa;"><nobr><div id="tip_min1"></div></nobr></td>
                                                <td><img src="<?php echo $bildpfad; ?>/icons/mineral_3.gif" width="17" height="17"></td>
                                                <td style="color:#aaaaaa;"><nobr><div id="tip_min3"></div></nobr></td>
                                            </tr>
                                            <?php
                                        }
                                        if(@intval(substr($spieler_optionen,5,1))==1) {
                                            ?>
                                            <tr>
                                                <td><img src="<?php echo $bildpfad; ?>/icons/minen.gif" width="17" height="17"></td>
                                                <td style="color:#aaaaaa;"><nobr><div id="tip_minen"></div></nobr></td>
                                                <td><img src="<?php echo $bildpfad; ?>/icons/fabrik.gif" width="17" height="17"></td>
                                                <td style="color:#aaaaaa;"><nobr><div id="tip_fabrik"></div></nobr></td>
                                            </tr>
                                            <?php
                                        }
                                        if(@intval(substr($spieler_optionen,6,1))==1) {
                                            ?>
                                            <tr>
                                                <td valign="top"><img src="<?php echo $bildpfad; ?>/icons/logbuch.gif" width="17" height="17"></td>
                                                <td style="color:#aaaaaa;" colspan="3"><div id="tip_logbuch"></div></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="tooltip_planetunbesetzt" style="z-index:15;position: absolute; left:0px; top:0px;visibility:hidden;">
                        <table border="0" cellspacing="0" cellpadding="2" style="background-color:#444444;">
                            <tr>
                                <td style="background-color:#222222;border-style:solid;border-width:1px;border-color:#888888 #888888 #888888 #888888;color:#ffffff;">
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td><img src="<?php echo $bildpfad; ?>/karte/tool_planet.gif" width="18" height="17"></td>
                                            <td><nobr><b><div id="tip_un_name"></div></b></nobr></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="tooltip_basis" style="z-index:15;position: absolute; left:0px; top:0px;visibility:hidden;">
                        <table border="0" cellspacing="0" cellpadding="2" style="background-color:#444444;">
                            <tr>
                                <td style="background-color:#222222;border-style:solid;border-width:1px;border-color:#888888 #888888 #888888 #888888;color:#ffffff;">
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td><img src="<?php echo $bildpfad; ?>/karte/tool_basis.gif" width="18" height="17"></td>
                                            <td><nobr><b><div id="tip_basis_name"></div></b></nobr></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-style:solid;border-width:1px;border-color:#444444 #666666 #666666 #666666;">
                                    <table border="0" cellspacing="0" cellpadding="1">
                                        <tr>
                                            <td valign="top"><img src="<?php echo $bildpfad; ?>/icons/logbuch.gif" width="17" height="17"></td>
                                            <td style="color:#aaaaaa;" colspan="3"><div id="tip_basis_logbuch"></div></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="tooltip_unbasis" style="z-index:15;position: absolute; left:0px; top:0px;visibility:hidden;">
                        <table border="0" cellspacing="0" cellpadding="2" style="background-color:#444444;">
                            <tr>
                                <td style="background-color:#222222;border-style:solid;border-width:1px;border-color:#888888 #888888 #888888 #888888;color:#ffffff;">
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td><img src="<?php echo $bildpfad; ?>/karte/tool_basis.gif" width="18" height="17"></td>
                                            <td><nobr><b><div id="tip_unbasis_name"></div></b></nobr></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="tooltip_schiff" style="z-index:15;position: absolute; left:0px; top:0px;visibility:hidden;">
                        <table border="0" cellspacing="0" cellpadding="2" style="background-color:#444444;">
                            <tr>
                                <td style="background-color:#222222;border-style:solid;border-width:1px;border-color:#888888 #888888 #888888 #888888;color:#ffffff;">
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td><img src="<?php echo $bildpfad; ?>/karte/tool_schiff.gif" width="18" height="17"></td>
                                            <td><nobr><b><div id="tip_schiffname"></div></b></nobr></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-style:solid;border-width:1px;border-color:#444444 #666666 #666666 #666666;">
                                    <table border="0" cellspacing="0" cellpadding="1">
                                        <?php
                                        if(@intval(substr($spieler_optionen,7,1))==1) {
                                            ?>
                                            <tr>
                                                <td><img src="<?php echo $bildpfad; ?>/icons/krieg.gif" width="17" height="17"></td>
                                                <td style="color:#aaaaaa;"><nobr><div id="tip_schiffschaden"></div></nobr></td>
                                                <td><img src="<?php echo $bildpfad; ?>/icons/lemin.gif" width="17" height="17"></td>
                                                <td style="color:#aaaaaa;"colspan="3"><nobr><div id="tip_schifftank"></div></nobr></td>
                                                <td style="color:#aaaaaa;" ><nobr><div id="tip_schifferfahrung"></div></nobr></td>
                                            </tr>
                                            <?php
                                        }
                                        if(@intval(substr($spieler_optionen,8,1))==1) {
                                            ?>
                                            <tr>
                                                <td valign="top"><img src="<?php echo $bildpfad; ?>/icons/smission.gif" width="17" height="17"></td>
                                                <td style="color:#aaaaaa;" colspan="5"><div id="tip_schiffmission"></div></td>
                                            </tr>
                                            <?php
                                        }
                                        if(@intval(substr($spieler_optionen,9,1))==1) {
                                            ?>
                                            <tr>
                                                <td><img src="<?php echo $bildpfad; ?>/icons/crew.gif" width="17" height="17"></td>
                                                <td style="color:#aaaaaa;"><nobr><div id="tip_schiffkolonisten"></div></nobr></td>
                                                <td><img src="<?php echo $bildpfad; ?>/icons/cantox.gif" width="17" height="17"></td>
                                                <td style="color:#aaaaaa;"><nobr><div id="tip_schiffcantox"></div></nobr></td>
                                                <td><img src="<?php echo $bildpfad; ?>/icons/mineral_2.gif" width="17" height="17"></td>
                                                <td style="color:#aaaaaa;"><nobr><div id="tip_schiffmin2"></div></nobr></td>
                                            </tr>
                                            <tr>
                                                <td><img src="<?php echo $bildpfad; ?>/icons/vorrat.gif" width="17" height="17"></td>
                                                <td style="color:#aaaaaa;"><nobr><div id="tip_schiffvorrat"></div></nobr></td>
                                                <td><img src="<?php echo $bildpfad; ?>/icons/mineral_1.gif" width="17" height="17"></td>
                                                <td style="color:#aaaaaa;"><nobr><div id="tip_schiffmin1"></div></nobr></td>
                                                <td><img src="<?php echo $bildpfad; ?>/icons/mineral_3.gif" width="17" height="17"></td>
                                                <td style="color:#aaaaaa;"><nobr><div id="tip_schiffmin3"></div></nobr></td>
                                            </tr>
                                            <?php
                                        }
                                        if(@intval(substr($spieler_optionen,10,1))==1) {
                                            ?>
                                            <tr>
                                                <td valign="top"><img src="<?php echo $bildpfad; ?>/icons/logbuch.gif" width="17" height="17"></td>
                                                <td style="color:#aaaaaa;" colspan="5"><div id="tip_schifflogbuch"></div></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="tooltip_flotte" style="z-index:15;position: absolute; left:0px; top:0px;visibility:hidden;">
                        <table border="0" cellspacing="0" cellpadding="2" style="background-color:#444444;">
                            <tr>
                                <td style="background-color:#222222;border-style:solid;border-width:1px;border-color:#888888 #888888 #888888 #888888;color:#ffffff;">
                                    <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td><img src="<?php echo $bildpfad?>/karte/tool_schiff.gif" width="18" height="17"></td>
                                        <td><nobr><b>&nbsp;<?php echo $lang['galaxie']['raumflotte']?>&nbsp;</b></nobr></td>
                                    </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-style:solid;border-width:1px;border-color:#444444 #666666 #666666 #666666;">
                                    <table border="0" cellspacing="0" cellpadding="1">
                                        <tr>
                                            <td valign="top"><img src="../bilder/empty.gif" width="17" height="17"></td>
                                            <td style="color:#aaaaaa;"><div id="tip_flotteliste"></div></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <?php
                }
                //////////////////////////////////////////////////////////////////////////////////raum
                $zeiger = @mysql_query("SELECT * FROM $skrupel_scan where spiel=$spiel and besitzer=$spieler");
                $datensaetze = @mysql_num_rows($zeiger);
                if ($datensaetze>=1) {
                    for  ($i=0; $i<$datensaetze;$i++) {
                        $ok = @mysql_data_seek($zeiger,$i);
                        $array = @mysql_fetch_array($zeiger);
                        $rid=$array["id"];
                        $x_pos=$array["x"]-125;
                        $y_pos=$array["y"]-125;
                        $bild=rand(0,9);
                        ?>
                        <div id="raum_<?php echo $rid; ?>" style="z-index:0;position: absolute; left:<?php echo $x_pos; ?>px; top:<?php echo $y_pos; ?>px; width:250px; height:250px;visibility=visible;">
                            <img border="0" src="../bilder/karte/all/<?php echo $bild; ?>.gif" width="250" height="250">
                        </div>
                        <?php
                    }
                }
                //////////////////////////////////////////////////////////////////////////////////minenfeld
                if ($module[2]) {
                    $zeiger = @mysql_query("SELECT * FROM $skrupel_anomalien where spiel=$spiel and ($spalte=1 or extra like '$spieler:%') and art=5 order by id");
                    $datensaetze = @mysql_num_rows($zeiger);
                    if ($datensaetze>=1) {
                        for  ($i=0; $i<$datensaetze;$i++) {
                            $ok = @mysql_data_seek($zeiger,$i);
                            $array = @mysql_fetch_array($zeiger);
                            $aid=$array["id"];
                            $x_pos=$array["x_pos"];
                            $y_pos=$array["y_pos"];
                            $extra=$array["extra"];
                            $extrab=explode(":",$extra);
                            $oben=$y_pos-87;
                            $links=$x_pos-87;
                            $bild='fremd';
                            if (($extrab[0]==$spieler) or
                                ($beziehung[$spieler][$extrab[0]]['status']==3) or
                                ($beziehung[$spieler][$extrab[0]]['status']==4) or
                                ($beziehung[$spieler][$extrab[0]]['status']==5))
                                { $bild='eigen'; }
                            ?>
                            <div id="minenfeld_<?php echo $id; ?>" style="z-index:0;position: absolute; left:<?php echo $links; ?>px; top:<?php echo $oben; ?>px; width:174px; height:174px;visibility=visible;">
                                <img border="0" src="../bilder/karte/minen/<?php echo $bild; ?>.gif" width="174" height="174">
                            </div>
                            <?php
                        }
                    }
                }
                //////////////////////////////////////////////////////////////////////////////////nebel
                $zeiger = @mysql_query("SELECT * FROM $skrupel_anomalien where spiel=$spiel and art=4 order by id");
                $datensaetze = @mysql_num_rows($zeiger);
                if ($datensaetze>=1) {
                    for  ($i=0; $i<$datensaetze;$i++) {
                        $ok = @mysql_data_seek($zeiger,$i);
                        $array = @mysql_fetch_array($zeiger);
                        $x_pos=$array["x_pos"];
                        $y_pos=$array["y_pos"];
                        $random=rand(1,3);
                        ?>
                        <div id="darknebel_<?php echo $id; ?>" style="z-index:1;position: absolute; left:<?php echo $x_pos-4; ?>px; top:<?php echo $y_pos-4; ?>px; width:18px; height:18px;visibility:visible;">
                            <img border="0" src="../bilder/karte/nebel/1_<?php echo $random; ?>.png" width="18" height="18">
                        </div>
                        <?php
                    }
                }
                //////////////////////////////////////////////////////////////////////////////////sektorbezeichnung
                for  ($y=1; $y<=$umfang/250;$y++) {
                    for  ($x=1; $x<=$umfang/250;$x++) {
                        $xpos=$x*250-125-5;
                        $ypos=$y*250-125-10;
                        $xname=chr($x+64);
                        ?>
                        <div id="bezeichnung_<?php echo $x; ?>_<?php echo $y; ?>" style="z-index:1;position: absolute; left:<?php echo $xpos; ?>px; top:<?php echo $ypos; ?>px;font-size:15px;color:#333333;">
                            <b><?php echo $xname; ?><?php echo $y; ?></b>
                        </div>
                        <?php
                    }
                }
                //////////////////////////////////////////////////////////////////////////////////sprungtor wurmloch raumfalte
                if ($nebel>=1) {
                    $zeiger = @mysql_query("SELECT * FROM $skrupel_anomalien where $spalte=1 and spiel=$spiel order by id");
                } else {
                    $zeiger = @mysql_query("SELECT * FROM $skrupel_anomalien where spiel=$spiel order by id");
                }
                $datensaetze = @mysql_num_rows($zeiger);
                if ($datensaetze>=1) {
                    for  ($i=0; $i<$datensaetze;$i++) {
                        $ok = @mysql_data_seek($zeiger,$i);
                        $array = @mysql_fetch_array($zeiger);
                        $aid=$array["id"];
                        $art=$array["art"];
                        $x_pos=$array["x_pos"];
                        $y_pos=$array["y_pos"];
                        $extra=$array["extra"];
                        if ($art==1) {
                            $xpos=$x_pos-20;
                            $ypos=$y_pos-20;
                            ?>
                            <div id="anomalie_<?php echo $aid; ?>" style="z-index:3;position: absolute; left:<?php echo $xpos; ?>px; top:<?php echo $ypos; ?>px; width:40px; height:40px;">
                                <img border="0" src="<?php echo $bildpfad; ?>/karte/wurmloch.gif" width="40" height="40" title="<?php echo $lang['galaxie']['wurmloch']?>">
                            </div>
                            <?php
                        }
                        if ($art==2) {
                            $xpos=$x_pos-10;
                            $ypos=$y_pos-10;
                            ?>
                            <div id="anomalie_<?php echo $aid; ?>" style="z-index:3;position: absolute; left:<?php echo $xpos; ?>px; top:<?php echo $ypos; ?>px; width:20px; height:20px;">
                                <img border="0" src="<?php echo $bildpfad; ?>/karte/sprungtor.gif" width="20" height="20" title="<?php echo $lang['galaxie']['sprungtor']?>">
                            </div>
                            <?php
                        }
                        if ($art==3) {
                            $xpos=$x_pos-7;
                            $ypos=$y_pos-7;
                            ?>
                            <div id="anomalie_<?php echo $aid; ?>" style="z-index:3;position: absolute; left:<?php echo $xpos; ?>px; top:<?php echo $ypos; ?>px; width:14px; height:14px;">
                                <img border="0" src="<?php echo $bildpfad; ?>/karte<?php echo $noani; ?>/raumfalte.gif" width="14" height="14" title="<?php echo $lang['galaxie']['Raumfalte']?>Raumfalte">
                            </div>
                            <?php
                        }
                    }
                }
                //////////////////////////////////////////////////////////////////////////////////schiffe scanfelder
                if ($nebel>=1) {
                    $zeiger = @mysql_query("SELECT id,kox,koy,status,besitzer,spezialmission,tarnfeld,scanner FROM $skrupel_schiffe where (status=1 or status=2) and (tarnfeld=0 or besitzer=$spieler) and spiel=$spiel and $spalte=1");
                } else {
                    $zeiger = @mysql_query("SELECT id,kox,koy,status,besitzer,spezialmission,tarnfeld,scanner FROM $skrupel_schiffe where (status=1 or status=2) and (tarnfeld=0 or besitzer=$spieler) and spiel=$spiel");
                }
                $datensaetze = @mysql_num_rows($zeiger);
                    if ($datensaetze>=1) {
                        for  ($i=0; $i<$datensaetze;$i++) {
                        $ok = @mysql_data_seek($zeiger,$i);
                        $array = @mysql_fetch_array($zeiger);
                        $id=$array["id"];
                        $name=$array["name"];
                        $x_pos=$array["kox"];
                        $y_pos=$array["koy"];
                        $scanner=$array["scanner"];
                        if ($scanner==0) {
                            $x_position=$x_pos-48;
                            $y_position=$y_pos-48;
                            ?>
                            <div id="scan_<?php echo $id; ?>" style="z-index:2;position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position; ?>px; width:95px; height:95px;">
                                <img border="0" src="<?php echo $bildpfad?>/karte/scan_47.<?php if(@intval(substr($spieler_optionen,16,1))==1) { echo 'gif'; } else { echo 'png'; }?>" width="95" height="95">
                            </div>
                            <?php
                        }
                        if ($scanner==1) {
                            $x_position=$x_pos-85;
                            $y_position=$y_pos-85;
                            ?>
                            <div id="scan_<?php echo $id; ?>" style="z-index:2;position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position; ?>px; width:170px; height:170px;">
                                <img border="0" src="<?php echo $bildpfad?>/karte/scan_1.<?php if(@intval(substr($spieler_optionen,16,1))==1) { echo 'gif'; } else { echo 'png'; }?>" width="170" height="170">
                            </div>
                            <?php
                        }
                        if ($scanner==2) {
                            $x_position=$x_pos-120;
                            $y_position=$y_pos-120;
                            ?>
                            <div id="scan_<?php echo $id; ?>" style="z-index:2;position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position; ?>px; width:240px; height:240px;">
                                <img border="0" src="<?php echo $bildpfad?>/karte/scan_2.<?php if(@intval(substr($spieler_optionen,16,1))==1) { echo 'gif'; } else { echo 'png'; }?>" width="240" height="240">
                            </div>
                            <?php
                        }
                        if ($ziel_id==5) {
                            $x_position=$x_pos-72;
                        $y_position=$y_pos-72;
                            ?>
                            <div id="scan_ex_<?php echo $id; ?>" style="z-index:2;position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position; ?>px; width:144px; height:144px;">
                                <img border="0" src="<?php echo $bildpfad?>/karte/scan_red_72.gif" width="144" height="144">
                            </div>
                            <?php
                        }
                    }
                }
                //////////////////////////////////////////////////////////////////////////////////erste sternenbasis und bildaufbau
                $gox = int_get('gox');
                $goy = int_get('goy');
                if (($gox>=1) and ($goy>=1)) {
                    $start_map_x = $gox;
                    $start_map_y = $goy;
                } else {
                    $zeiger = @mysql_query("SELECT besitzer,status,spiel,id,x_pos,y_pos FROM $skrupel_sternenbasen where besitzer=$spieler and status=1 and spiel=$spiel order by id limit 0,1");
                    $basenanzahl = @mysql_num_rows($zeiger);
                    if ($basenanzahl>=1) {
                        $array = @mysql_fetch_array($zeiger);
                        $start_map_x=$array["x_pos"];
                        $start_map_y=$array["y_pos"];
                    } else {
                        $start_map_x=floor($umfang/2);
                        $start_map_y=floor($umfang/2);
                    }
                }
                ?>
                <div id="aktuell" style="z-index:2;position: absolute; left:0px; top:0px; width:30px; height:30px;visibility:hidden;">
                    <img border="0" src="<?php echo $bildpfad; ?>/karte<?php echo $noani; ?>/aktuell.gif" width="30" height="30">
                </div>
                <div id="raum" style="background-image:url('<?php echo $bildpfad;?>/karte/hintergrund_b.gif');z-index:3;position: absolute; left:0px; top:0px; width:<?php echo $umfang-1; ?>px; height:<?php echo $umfang-3; ?>px;">
                    <a href="javascript:;" onclick="linie(event)"><img border="0" src="../bilder/empty.gif" width="<?php echo $umfang-1; ?>" height="<?php echo $umfang-3; ?>"></a>
                </div>
                <script language=JavaScript>movemapfirst(<?php echo $start_map_x.','.$start_map_y; ?>);</script>
                <?php
                //////////////////////////////////////////////////////////////////////////////////sternenbasen
                if ($nebel>=1) {
                    $zeiger = @mysql_query("SELECT * FROM $skrupel_sternenbasen where status=1 and $spalte=1 and spiel=$spiel order by id");
                } else {
                    $zeiger = @mysql_query("SELECT * FROM $skrupel_sternenbasen where status=1 and spiel=$spiel order by id");
                }
                $basenanzahl = @mysql_num_rows($zeiger);
                if ($basenanzahl>=1) {
                    for  ($i=0; $i<$basenanzahl;$i++) {
                        $ok = @mysql_data_seek($zeiger,$i);
                        $array = @mysql_fetch_array($zeiger);
                        $bid=$array["id"];
                        $name=$array["name"];
                        $rasse=$array["rasse"];
                        $planetid=$array["planetid"];
                        $besitzer=$array["besitzer"];
                        $x_pos=$array["x_pos"];
                        $y_pos=$array["y_pos"];
                        $logbuch=$array["logbuch"];
                        $x_position=$x_pos-13;
                        $y_position=$y_pos-13;
                        $nametip="[$name]";
                        if ($besitzer==$spieler) {
                            if (strlen($logbuch)==0) { $logbuch="<i>no logdata</i>"; }
                            $logbuch = preg_replace("(\r\n|\n|\r)", "<br>", $logbuch);
                            ?>
                            <div id="basis_<?php echo $bid; ?>_<?php echo $besitzer; ?>" style="z-index:4;position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position; ?>px; width:26px; height:26px;">
                                <a href="javascript:;" onclick="takebase(<?php echo $bid; ?>);" onmouseover="tooltipbasis(<?php echo $x_pos+9; ?>,<?php echo $y_pos+9; ?>,' <?php echo $nametip; ?> ','<?php echo $logbuch; ?>');" onmouseout="tooltipbasisout();"
                                    <?php if(@intval(substr($spieler_optionen,11,1))==0) { ?>
                                        style="cursor: url(../bilder/cursor/weiss.cur), crosshair;"
                                    <?php } ?>
                                    ><img border="0" src="<?php echo $bildpfad; ?>/karte<?php echo $noani; ?>/farben/sternenbasis_<?php echo $besitzer; ?>.gif" width="26" height="26"></a>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div id="basis_<?php echo $bid; ?>_<?php echo $besitzer; ?>" style="z-index:4;position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position; ?>px; width:26px; height:26px;" onmouseover="tooltipunbasis(<?php echo $x_pos+9; ?>,<?php echo $y_pos+9; ?>,' <?php echo $nametip; ?> ');" onmouseout="tooltipunbasisout();"
                                <?php if(@intval(substr($spieler_optionen,11,1))==0) { ?>
                                    style="cursor: url(../bilder/cursor/rot.cur), crosshair;"
                                <?php } ?>
                                ><img border="0" src="<?php echo $bildpfad; ?>/karte<?php echo $noani; ?>/farben/sternenbasis_<?php echo $besitzer; ?>.gif" width="26" height="26">
                            </div>
                            <?php
                        }
                    }
                }
                //////////////////////////////////////////////////////////////////////////////////schiffe
                $checkstring="";
                if ($nebel>=1) {
                    $zeiger = @mysql_query("SELECT volk,bild_klein,masse,kox_old,koy_old,klasse,schaden,antrieb,frachtraum,fracht_leute,fracht_cantox,fracht_vorrat,fracht_min1,fracht_min2,fracht_min3,lemin,leminmax,logbuch,routing_status,routing_id,routing_koord,besitzer,id,name,kox,koy,flug,zielx,ziely,zielid,techlevel,masse_gesamt,status,spezialmission,tarnfeld,extra,sicht,ordner,erfahrung FROM $skrupel_schiffe where status>0 and spiel=$spiel and (($spalte=1 and tarnfeld=0) or ($spalte_beta=1 and (((tarnfeld<2) and (volk!='unknown')) or tarnfeld=0)) or besitzer=$spieler) order by masse desc");
                } else {
                    $zeiger = @mysql_query("SELECT volk,bild_klein,masse,kox_old,koy_old,klasse,schaden,antrieb,frachtraum,fracht_leute,fracht_cantox,fracht_vorrat,fracht_min1,fracht_min2,fracht_min3,lemin,leminmax,logbuch,routing_status,routing_id,routing_koord,besitzer,id,name,kox,koy,flug,zielx,ziely,zielid,techlevel,masse_gesamt,status,spezialmission,tarnfeld,extra,sicht,ordner,erfahrung FROM $skrupel_schiffe where status>0 and spiel=$spiel order by masse desc");
                }
                $datensaetze = @mysql_num_rows($zeiger);
                if ($datensaetze>=1) {
                    for  ($i=0; $i<$datensaetze;$i++) {
                        $ok = @mysql_data_seek($zeiger,$i);
                        $array = @mysql_fetch_array($zeiger);
                        $id=$array["id"];
                        $name=$array["name"];
                        $x_pos=$array["kox"];
                        $y_pos=$array["koy"];
                        $kox_old=$array["kox_old"];
                        $koy_old=$array["koy_old"];
                        $techlevel=$array["techlevel"];
                        $flug=$array["flug"];
                        $zielx=$array["zielx"];
                        $ziely=$array["ziely"];
                        $zielid=$array["zielid"];
                        $antrieb=$array["antrieb"];
                        $besitzer=$array["besitzer"];
                        $klasse=$array["klasse"];
                        $schaden=$array["schaden"];
                        $masse_gesamt=$array["masse_gesamt"];
                        $masse=$array["masse"];
                        $bild_klein=$array["bild_klein"];
                        $volk=$array["volk"];
                        $kox=$x_pos; $flottex=0;
                        $koy=$y_pos; $flottey=0;
                        $code=":::".$id.":::";
                        $status=$array["status"];
                        $spezialmission=$array["spezialmission"];
                        $tarnfeld=$array["tarnfeld"];
                        $extra = $array['extra'];
                        $routing_status=$array["routing_status"];
                        $routing_id=$array["routing_id"];
                        $routing_koord=$array["routing_koord"];
                        $logbuch=$array["logbuch"];
                        $lemin=$array["lemin"];
                        $leminmax=$array["leminmax"];
                        $frachtraum=$array["frachtraum"];
                        $fracht_leute=$array["fracht_leute"];
                        $fracht_cantox=$array["fracht_cantox"];
                        $fracht_vorrat=$array["fracht_vorrat"];
                        $fracht_min1=$array["fracht_min1"];
                        $fracht_min2=$array["fracht_min2"];
                        $fracht_min3=$array["fracht_min3"];
                        $ordner=$array["ordner"];
                        $erfahrung=$array["erfahrung"];
                        if ($besitzer==$spieler) {
                            if ($ordner==0) {
                                $icon=0;
                            } else {
                                $zeigertemp = @mysql_query("SELECT icon FROM $skrupel_ordner where id=$ordner");
                                $arraytemp = @mysql_fetch_array($zeigertemp);
                                $icon=$arraytemp["icon"];
                            }
                        }
                        if (strlen($logbuch)==0) { $logbuch="<i>no logdata</i>"; }
                        $logbuch = preg_replace("(\r\n|\n|\r)", "<br>", $logbuch);
                        $freierraum=$frachtraum-$fracht_vorrat-$fracht_min1-$fracht_min2-$fracht_min3-round($fracht_leute/100);
                        $anzeigemasse=$masse;
                        $anzeige=round($anzeigemasse/100);
                        if ($anzeige<1) {$anzeige=1;}
                        if ($anzeige>10) {$anzeige=10;}
                        $flottengroesse=0;
                        $flottegemischt=0;
                        if ($besitzer==$spieler) {
                            if (strstr($checkstring,$code)) {    } else {
                                $schiffort=1;
                                $flotte="";$first=0;
                                $zeiger3 = @mysql_query("SELECT id,name,kox,koy,klasse,spiel,status,masse,ordner FROM $skrupel_schiffe where status>0 and spiel=$spiel and kox=$kox and koy=$koy order by name");
                                $datensaetze3 = @mysql_num_rows($zeiger3);
                                if ($datensaetze3>=2) {
                                    $schiffort=$datensaetze3;
                                    $first=$id;
                                    $flottex=$kox;
                                    $flottey=$koy;
                                    for  ($i3=0; $i3<$datensaetze3;$i3++) {
                                        $ok3 = @mysql_data_seek($zeiger3,$i3);
                                        $array3 = @mysql_fetch_array($zeiger3);
                                        $iddrunter=$array3["id"];
                                        $name3=$array3["name"];
                                        $klasse3=$array3["klasse"];
                                        $ordner3=$array3["ordner"];
                                        $flotte.="[".$name3."] ".$klasse3."<br>";
                                        $checkstring.=":::".$iddrunter.":::";
                                        $flottengroesse++;
                                        if ($ordner3==0) {
                                            $icon3=0;
                                        } else {
                                            $zeigertemp = @mysql_query("SELECT icon FROM $skrupel_ordner where id=$ordner3");
                                            $arraytemp = @mysql_fetch_array($zeigertemp);
                                            $icon3=$arraytemp["icon"];
                                        }
                                        if ($icon3!=$icon) { $flottegemischt=1; }
                                    }
                                }
                                $spez_tip='<i>'.$lang['galaxie']['speztip'][0].'</i>';
                                if ($spezialmission==1) { $spez_tip=$lang['galaxie']['speztip'][1]; }
                                if ($spezialmission==5) { $spez_tip=$lang['galaxie']['speztip'][2]; }
                                if ($spezialmission==14) { $spez_tip=$lang['galaxie']['speztip'][3]; }
                                if ($spezialmission==15) { $spez_tip=$lang['galaxie']['speztip'][4]; }
                                if ($spezialmission==2) { $spez_tip=$lang['galaxie']['speztip'][5]; }
                                if ($spezialmission==7) { $spez_tip=$lang['galaxie']['speztip'][6]; }
                                if ($spezialmission==8) { $spez_tip=$lang['galaxie']['speztip'][7]; }
                                if ($spezialmission==6) { $spez_tip=$lang['galaxie']['speztip'][8]; }
                                if ($spezialmission==4) { $spez_tip=$lang['galaxie']['speztip'][9]; }
                                if ($spezialmission==13) { $spez_tip=$lang['galaxie']['speztip'][10]; }
                                if ($spezialmission==12) { $spez_tip=$lang['galaxie']['speztip'][11]; }
                                if ($spezialmission==3) { $spez_tip=$lang['galaxie']['speztip'][12]; }
                                if ($spezialmission==11) { $spez_tip=$lang['galaxie']['speztip'][13]; }
                                if ($spezialmission==9) { $spez_tip=$lang['galaxie']['speztip'][14]; }
                                if ($spezialmission==10) { $spez_tip=$lang['galaxie']['speztip'][14]; }
                                if ($spezialmission==16) { $spez_tip=$lang['galaxie']['speztip'][15]; }
                                if ($spezialmission==17) { $spez_tip=$lang['galaxie']['speztip'][16]; }
                                if ($spezialmission==18) { $spez_tip=$lang['galaxie']['speztip'][16]; }
                                if ($spezialmission==19) { $spez_tip=$lang['galaxie']['speztip'][17]; }
                                if ($spezialmission==20) { $spez_tip=$lang['galaxie']['speztip'][18]; }
                                if ($spezialmission==21) { $spez_tip=$lang['galaxie']['speztip'][19]; }
                                if ($spezialmission==22) { $spez_tip=$lang['galaxie']['speztip'][20]; }
                                if ($spezialmission==23) { $spez_tip=$lang['galaxie']['speztip'][21]; }
                                if (($spezialmission>=31) and ($spezialmission<=40)) { $spez_tip=$lang['galaxie']['speztip'][22]; }
                                if (($spezialmission>=41) and ($spezialmission<=50)) { $spez_tip=$lang['galaxie']['speztip'][23]; }
                                if ($spezialmission==24) { $spez_tip=$lang['galaxie']['speztip'][24]; }
                                if ($spezialmission==25) { $spez_tip=$lang['galaxie']['speztip'][25]; }
                                if ($spezialmission==26) { $spez_tip=$lang['galaxie']['speztip'][26]; }
                                if ($spezialmission==27) { $spez_tip=$lang['galaxie']['speztip'][27]; }
                                if ($spezialmission==28) { $spez_tip=$lang['galaxie']['speztip'][28]; }
                                if ($spezialmission==29) { $spez_tip=$lang['galaxie']['speztip'][29]; }
                                if ($spezialmission==30) { $spez_tip=$lang['galaxie']['speztip'][33]; }
                                if ($spezialmission==70) { $spez_tip=$lang['galaxie']['speztip'][30]; }
                                if ($spezialmission==71) { $spez_tip=$lang['galaxie']['speztip'][31]; }
                                if ($spezialmission>71 and $spezialmission<77) { $spez_tip=$lang['galaxie']['speztip'][32]; }
                                if($module[0] && $spezialmission==51) {
                                    $extra1 = @explode(":", $extra);
                                    $extra_spio = @explode("-", $extra1[0]);
                                    $spez_tip = $spionage_daten[$extra_spio[3]]['name'];
                                    if($spez_tip == "") { $spez_tip = "<i>".$lang['galaxie']['speztip'][0]."</i>"; }
                                }
                                $nametip="[$name] $klasse";
                            }
                            if ($routing_status==2) {
                                $routing_points_temp=explode("::",$routing_koord);
                                for ($r=0;$r<count($routing_points_temp)-1;$r++) {
                                    $routing_points[$r]=explode(":",$routing_points_temp[$r]);
                                }
                                for ($r=0;$r<count($routing_points_temp)-1;$r++) {
                                    $start_x=$routing_points[$r][0];
                                    $start_y=$routing_points[$r][1];
                                    if ($r==count($routing_points_temp)-2) {
                                        $ziel_x=$routing_points[0][0];
                                        $ziel_y=$routing_points[0][1];
                                    } else {
                                        $ziel_x=$routing_points[$r+1][0];
                                        $ziel_y=$routing_points[$r+1][1];
                                    }
                                    $schritt_x=($ziel_x-$start_x)/10;
                                    $schritt_y=($ziel_y-$start_y)/10;
                                    $lauf_x=$start_x;
                                    $lauf_y=$start_y;
                                    for ($k=1;$k<10;$k++) {
                                        $lauf_x=$lauf_x+$schritt_x;
                                        $lauf_y=$lauf_y+$schritt_y;
                                        ?>
                                        <div id="punkt_<?php echo $r; ?>_<?php echo $k; ?>_tour_<?php echo $id; ?>"
                                        style="z-index:4;position: absolute; left:<?php echo $lauf_x; ?>px; top:<?php echo $lauf_y;?>px; width:1px; height:1px;background-color:#aaaaaa;">
                                            <!img src="../bilder/empty.gif" width=1 height=1>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            if ((strstr($checkstring,$code)) and ($first!=$id)) {    } else {
                                if ($status==2) {
                                    $x_position=$x_pos-9;
                                    $y_position=$y_pos-9;
                                    if ($schiffort==1) {
                                        ?>
                                        <div id="schiff_<?php echo $id; ?>_<?php echo $spieler; ?>"
                                            style="z-index:5;position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position; ?>px; width:18px; height:18px;">
                                            <a href="javascript:;" onclick="takeship(<?php echo $id; ?>,<?php echo $flottex; ?>,<?php echo $flottey; ?>,<?php echo $x_pos; ?>,<?php echo $y_pos; ?>);" onmouseover="tooltipschiff(<?php echo $x_pos+9; ?>,<?php echo $y_pos+9; ?>,' <?php echo $nametip; ?> ','<?php echo $schaden; ?>%','<?php echo $lemin; ?>/<?php echo $leminmax; ?>','<?php echo $spez_tip; ?>','<?php echo $fracht_leute; ?>','<?php echo $fracht_cantox; ?>','<?php echo $fracht_min1; ?>','<?php echo $fracht_min2; ?>','<?php echo $fracht_min3; ?>','<?php echo $fracht_vorrat; ?>','<?php echo $logbuch; ?>','<?php echo $bild_klein; ?>','<?php echo $volk; ?>','<?php echo $erfahrung; ?>');" onmouseout="tooltipschiffout();" <?php if(@intval(substr($spieler_optionen,11,1))==0) { ?>style="cursor: url(../bilder/cursor/weiss.cur), crosshair;"<?php } ?>><img border="0" src="<?php echo $bildpfad; ?>/karte<?php echo $noani; ?>/farben/umlaufbahn_<?php echo $spieler; ?>.gif" width="18" height="18"></a>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div id="schiff_<?php echo $id; ?>_<?php echo $spieler; ?>"
                                            style="z-index:5;position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position; ?>px; width:18px; height:18px;">
                                            <a href="javascript:;" onclick="takeship(<?php echo $id; ?>,<?php echo $flottex; ?>,<?php echo $flottey; ?>,<?php echo $x_pos; ?>,<?php echo $y_pos; ?>);" onmouseover="tooltipflotte(<?php echo $x_pos+9; ?>,<?php echo $y_pos+9; ?>,'<?php echo $flotte; ?>');" onmouseout="tooltipflotteout();" <?php if(@intval(substr($spieler_optionen,11,1))==0) { ?>style="cursor: url(../bilder/cursor/weiss.cur), crosshair;"<?php } ?>><img border="0" src="<?php echo $bildpfad; ?>/karte<?php echo $noani; ?>/farben/umlaufbahn_<?php echo $spieler; ?>.gif" width="18" height="18"></a>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    if ($schiffort==1) {
                                        $x_position=$x_pos-7;
                                        $y_position=$y_pos-7;
                                        if (($kox_old>=1) and ($koy_old>=1)) {
                                            $richtung = round((rad2deg(atan2(($y_pos - $koy_old), ($x_pos - $kox_old))))/45)+2;
                                            if ($richtung==8) { $richtung=0; }
                                            if ($richtung==-1) { $richtung=7; }
                                            if ($richtung==-2) { $richtung=6; }
                                            if ($richtung==-3) { $richtung=5; }
                                        } else {
                                            $richtung=2;
                                        }
                                        $clip1=($richtung*15);
                                        $clip2=($richtung*15)+14;
                                        ?>
                                        <div id="schiff_<?php echo $id; ?>_<?php echo $spieler; ?>"
                                            style="z-index:10;position: absolute; left:<?php echo $x_position-$clip1; ?>px; top:<?php echo $y_position; ?>px;clip:rect(0px, <?php echo $clip2; ?>px, 15px, <?php echo $clip1; ?>px);">
                                            <a href="javascript:;" onclick="takeship(<?php echo $id; ?>,<?php echo $flottex; ?>,<?php echo $flottey; ?>,<?php echo $x_pos; ?>,<?php echo $y_pos; ?>);" onmouseover="tooltipschiff(<?php echo $x_pos+9; ?>,<?php echo $y_pos+9; ?>,' <?php echo $nametip; ?> ','<?php echo $schaden; ?>%','<?php echo $lemin; ?>/<?php echo $leminmax; ?>','<?php echo $spez_tip; ?>','<?php echo $fracht_leute; ?>','<?php echo $fracht_cantox; ?>','<?php echo $fracht_min1; ?>','<?php echo $fracht_min2; ?>','<?php echo $fracht_min3; ?>','<?php echo $fracht_vorrat; ?>','<?php echo $logbuch; ?>','<?php echo $bild_klein; ?>','<?php echo $volk; ?>','<?php echo $erfahrung; ?>');" onmouseout="tooltipschiffout();" <?php if(@intval(substr($spieler_optionen,11,1))==0) { ?>style="cursor: url(../bilder/cursor/weiss.cur), crosshair;"<?php } ?>><img border="0" src="<?php echo $bildpfad; ?>/karte/schiffe/<?php echo $spieler; ?>_<?php echo $icon; ?>.gif" width="120" height="15"></a>
                                        </div>
                                        <?php
                                    } else {
                                        //flotte unterwegs
                                        $x_position=$x_pos-7;
                                        $y_position=$y_pos-7;
                                        if (($kox_old>=1) and ($koy_old>=1)) {
                                            $richtung = round((rad2deg(atan2(($y_pos - $koy_old), ($x_pos - $kox_old))))/45)+2;
                                            if ($richtung==8) { $richtung=0; }
                                            if ($richtung==-1) { $richtung=7; }
                                            if ($richtung==-2) { $richtung=6; }
                                            if ($richtung==-3) { $richtung=5; }
                                        } else {
                                            $richtung=2;
                                        }
                                        $clip1=($richtung*15);
                                        $clip2=($richtung*15)+14;
                                        ?>
                                        <div id="schiff_<?php echo $id; ?>_<?php echo $spieler; ?>"
                                            style="z-index:10;position: absolute; left:<?php echo $x_position-$clip1; ?>px; top:<?php echo $y_position; ?>px;clip:rect(0px, <?php echo $clip2; ?>px, 15px, <?php echo $clip1; ?>px);">
                                            <a href="javascript:;" onclick="takeship(<?php echo $id; ?>,<?php echo $flottex; ?>,<?php echo $flottey; ?>,<?php echo $x_pos; ?>,<?php echo $y_pos; ?>);" onmouseover="tooltipflotte(<?php echo $x_pos+9; ?>,<?php echo $y_pos+9; ?>,'<?php echo $flotte; ?>');" onmouseout="tooltipflotteout();" <?php if(@intval(substr($spieler_optionen,11,1))==0) { ?>style="cursor: url(../bilder/cursor/weiss.cur), crosshair;"<?php } ?>><img border="0" src="<?php echo $bildpfad; ?>/karte/schiffe/<?php echo $spieler; ?>_<?php
                                            if ($flottegemischt==1) { echo 'flotte'; } else { echo $icon; }
                                            ?>.gif" width="120" height="15"></a>
                                        </div>
                                        <?php
                                        if ($flottengroesse>=10) { $flottengroesse='max'; }
                                        ?>
                                        <div id="flotte_<?php echo $id; ?>_<?php echo $spieler; ?>"
                                            style="z-index:9;position: absolute; left:<?php echo $x_position+17; ?>px; top:<?php echo $y_position; ?>px;width:3px; height:5px;"><img border="0" src="<?php echo $bildpfad; ?>/karte/schiffe/zahl_<?php echo $flottengroesse; ?>.gif" width="3" height="5">
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            if (($flug==0) or (($flug==4) and ($zielx==$x_pos) and ($ziely==$y_pos))) {
                                for ($k=1;$k<=20;$k++) {
                                    ?>
                                    <div id="punkt_<?php echo $k; ?>_<?php echo $id; ?>"
                                        style="z-index:9;position: absolute; left:0px; top:0px; width:1px; height:1px; background-color:<?php echo $spielerfarbe[$spieler]; ?>;visibility:hidden;"><!img src="../bilder/empty.gif" width=1 height=1>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div id="auswahlrand_<?php echo $id; ?>"
                                    style="z-index:5;position: absolute; left:0px; top:0px; width:16px; height:16px;visibility:hidden;"><img src="<?php echo $bildpfad; ?>/karte/farben/planetenrand_auswahl_<?php echo $spieler; ?>.gif" width=16 height=16>
                                </div>
                                <?php
                            }
                            if ($flug==1) {
                                $schrittx=($zielx-$x_pos)/20;
                                $schritty=($ziely-$y_pos)/20;
                                $laufx=$x_pos;
                                $laufy=$y_pos;
                                for ($k=1;$k<=20;$k++) {
                                    $laufx=$laufx+$schrittx;
                                    $laufy=$laufy+$schritty;
                                    ?>
                                    <div id="punkt_<?php echo $k; ?>_<?php echo $id; ?>"
                                        style="z-index:9;position: absolute; left:<?php echo $laufx; ?>px; top:<?php echo $laufy; ?>px; width:1px; height:1px; background-color:<?php echo $spielerfarbe[$spieler]; ?>;"><!img src="../bilder/empty.gif" width=1 height=1>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div id="auswahlrand_<?php echo $id; ?>"
                                    style="z-index:5;position: absolute; left:0px; top:0px; width:16px; height:16px;visibility:hidden;"><img src="<?php echo $bildpfad; ?>/karte/farben/planetenrand_auswahl_<?php echo $spieler; ?>.gif" width=16 height=16>
                                </div>
                                <?php
                            }
                            if ($flug==2) {
                                $schrittx=($zielx-$x_pos)/20;
                                $schritty=($ziely-$y_pos)/20;
                                $laufx=$x_pos;
                                $laufy=$y_pos;
                                for ($k=1;$k<=20;$k++) {
                                    $laufx=$laufx+$schrittx;
                                    $laufy=$laufy+$schritty;
                                    ?>
                                    <div id="punkt_<?php echo $k; ?>_<?php echo $id; ?>"
                                        style="z-index:9;position: absolute; left:<?php echo $laufx; ?>px; top:<?php echo $laufy; ?>px; width:1px; height:1px; background-color:<?php echo $spielerfarbe[$spieler]; ?>;"><!img src="../bilder/empty.gif" width=1 height=1>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div id="auswahlrand_<?php echo $id; ?>"
                                    style="z-index:5;position: absolute; left:<?php echo $zielx-8; ?>px; top:<?php echo $ziely-8; ?>px; width:16px; height:16px"><img src="<?php echo $bildpfad; ?>/karte/farben/planetenrand_auswahl_<?php echo $spieler; ?>.gif" width=16 height=16>
                                </div>
                                <?php
                            }
                            if ($flug==3) {
                                $schrittx=($zielx-$x_pos)/20;
                                $schritty=($ziely-$y_pos)/20;
                                $laufx=$x_pos;
                                $laufy=$y_pos;
                                for ($k=1;$k<=20;$k++) {
                                    $laufx=$laufx+$schrittx;
                                    $laufy=$laufy+$schritty;
                                    ?>
                                    <div id="punkt_<?php echo $k; ?>_<?php echo $id; ?>"
                                        style="z-index:9;position: absolute; left:<?php echo $laufx; ?>px; top:<?php echo $laufy; ?>px; width:1px; height:1px; background-color:<?php echo $spielerfarbe[$spieler]; ?>;"><!img src="../bilder/empty.gif" width=1 height=1>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div id="auswahlrand_<?php echo $id; ?>"
                                    style="z-index:5;position: absolute; left:<?php echo $zielx-8; ?>px; top:<?php echo $ziely-8; ?>px; width:16px; height:16px"><img src="<?php echo $bildpfad; ?>/karte/farben/planetenrand_auswahl_<?php echo $spieler; ?>.gif" width=16 height=16>
                                </div>
                                <?php
                            }
                            if (($flug==4) and (($zielx!=$x_pos) or ($ziely!=$y_pos))) {
                                $schrittx=($zielx-$x_pos)/20;
                                $schritty=($ziely-$y_pos)/20;
                                $laufx=$x_pos;
                                $laufy=$y_pos;
                                for ($k=1;$k<=20;$k++) {
                                    $laufx=$laufx+$schrittx;
                                    $laufy=$laufy+$schritty;
                                    ?>
                                    <div id="punkt_<?php echo $k; ?>_<?php echo $id; ?>"
                                        style="z-index:9;position: absolute; left:<?php echo $laufx; ?>px; top:<?php echo $laufy; ?>px; width:1px; height:1px; background-color:<?php echo $spielerfarbe[$spieler]; ?>;"><!img src="../bilder/empty.gif" width=1 height=1>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div id="auswahlrand_<?php echo $id; ?>"
                                    style="z-index:5;position: absolute; left:<?php echo $zielx-8; ?>px; top:<?php echo $ziely-8; ?>px; width:16px; height:16px"><img src="<?php echo $bildpfad; ?>/karte/farben/planetenrand_auswahl_<?php echo $spieler; ?>.gif" width=16 height=16>
                                </div>
                                <?php
                            }
                        } else {
                            if ($antrieb==5) {$anzeige=rand(1,10);}
                            $anzeigefarbe=$besitzer;
                            if (($spezialmission>=41) and ($spezialmission<=50)) { $anzeigefarbe=$spezialmission-40; }
                            if (($kox_old>=1) and ($koy_old>=1)) {
                                $schritt_x=($kox_old-$x_pos)/10;
                                $schritt_y=($koy_old-$y_pos)/10;
                                $lauf_x=$x_pos;
                                $lauf_y=$y_pos;
                                for ($k=1;$k<5;$k++) {
                                    $lauf_x=$lauf_x+$schritt_x;
                                    $lauf_y=$lauf_y+$schritt_y;
                                    ?>
                                    <div id="punktf_<?php echo $k; ?>_<?php echo $id; ?>"
                                        style="z-index:4;position: absolute; left:<?php echo $lauf_x; ?>px; top:<?php echo $lauf_y; ?>px; width:1px; height:1px;background-color:#777777;"><!img src="../bilder/empty.gif" width=1 height=1>
                                    </div>
                                    <?php
                                }
                            }
                            if ($status==2) {
                                $x_position=$x_pos-9;
                                $y_position=$y_pos-9;
                                ?>
                                <div id="schiff_<?php echo $id; ?>_<?php echo $spieler; ?>"
                                    style="z-index:5;position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position; ?>px; width:18px; height:18px;">
                                    <a href="javascript:;" onclick="funk(<?php echo $anzeigefarbe; ?>)" onMouseOver="tooltipenemyship(<?php echo $x_pos; ?>,<?php echo $y_pos; ?>,<?php echo $beziehung[$spieler][$anzeigefarbe]['status']; ?>);" onMouseOut="tooltipenemyshipout();" <?php if(@intval(substr($spieler_optionen,11,1))==0) { ?>style="cursor: url(../bilder/cursor/rot.cur), crosshair;"<?php } ?>><img border="0" src="<?php echo $bildpfad; ?>/karte<?php echo $noani; ?>/farben/umlaufbahn_<?php echo $anzeigefarbe; ?>.gif" width="18" height="18"></a>
                                </div>
                                <?php
                            } else {
                                $x_position=$x_pos-round(($anzeige+2)/2);
                                $y_position=$y_pos-round(($anzeige+2)/2);
                                ?>
                                <div id="schiff_<?php echo $id; ?>_<?php echo $spieler; ?>"
                                    style="z-index:8;position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position; ?>px; width:<?php echo $anzeige+2; ?>px; height:<?php echo $anzeige+2; ?>px;">
                                    <a href="javascript:;" onclick="enemyship(<?php echo $x_pos; ?>,<?php echo $y_pos; ?>,<?php echo $id; ?>,<?php echo $anzeigefarbe; ?>);" onMouseOver="tooltipenemyship(<?php echo $x_pos; ?>,<?php echo $y_pos; ?>,<?php echo $beziehung[$spieler][$anzeigefarbe]['status']; ?>);" onMouseOut="tooltipenemyshipout();" <?php if(@intval(substr($spieler_optionen,11,1))==0) { ?>style="cursor: url(../bilder/cursor/rot.cur), crosshair;"<?php } ?>><img border="0" src="<?php echo $bildpfad; ?>/karte/farben/schiff_<?php echo $anzeige; ?>_<?php echo $anzeigefarbe; ?>.gif" width="<?php echo $anzeige+2; ?>" height="<?php echo $anzeige+2; ?>"></a>
                                </div>
                                <?php
                            }
                        }
                    }
                }
                //////////////////////////////////////////////////////////////////////////////////aufbau karte
                $farbe="#ffffff";
                for ($k=1;$k<=20;$k++) {
                    if ($farbe=="#ffffff") {$farbe="#0000ff";} else {$farbe="#ffffff";}
                    ?>
                    <div id="punkt<?php echo $k; ?>"
                        style="z-index:9;position: absolute; left:0px; top:0px; width:1px; height:1px; background-color:<?php echo $farbe; ?>;visibility:hidden;">
                        <!img src="../bilder/empty.gif" width=1 height=1>
                    </div>
                    <?php
                }
                ?>
                <div id="auswahlrand" style="z-index:5;position: absolute; left:0px; top:0px; width:16px; height:16px;visibility:hidden;">
                    <img src="<?php echo $bildpfad; ?>/karte/planetenrand_auswahl.gif" width=16 height=16>
                </div>
                <div id="x_0_1" style="z-index:1;position: absolute; left:4px; top:4px;visibility:visible;color:#a0a0a0;">0</div>
                <div id="x_0_2" style="z-index:1;position: absolute; left:4px; top:<?php echo $umfang-16; ?>px;visibility:visible;color:#a0a0a0;">0</div>
                <div id="x_500_1" style="z-index:1;position: absolute; left:489px; top:4px;visibility:visible;color:#a0a0a0;">500</div>
                <div id="x_500_2" style="z-index:1;position: absolute; left:489px; top:<?php echo $umfang-16; ?>px;visibility:visible;color:#a0a0a0;">500</div>
                <div id="y_500_1" style="z-index:1;position: absolute; left:4px; top:502px;visibility:visible;color:#a0a0a0;">500</div>
                <div id="y_500_2" style="z-index:1;position: absolute; left:<?php echo $umfang-27; ?>px; top:502px;visibility:visible;color:#a0a0a0;">500</div>
                <?php
                if ($umfang>1000) {
                    ?>
                    <div id="x_1000_1" style="z-index:1;position: absolute; left:985px; top:4px;visibility:visible;color:#a0a0a0;">1000</div>
                    <div id="x_1000_2" style="z-index:1;position: absolute; left:985px; top:<?php echo $umfang-16; ?>px;visibility:visible;color:#a0a0a0;">1000</div>
                    <div id="y_1000_2" style="z-index:1;position: absolute; left:<?php echo $umfang-33; ?>px; top:1002px;visibility:visible;color:#a0a0a0;">1000</div>
                    <div id="y_1000_1" style="z-index:1;position: absolute; left:4px; top:1002px;visibility:visible;color:#a0a0a0;">1000</div>
                    <?php
                }
                if ($umfang>1500) {
                    ?>
                    <div id="x_1500_1" style="z-index:1;position: absolute; left:1485px; top:4px;visibility:visible;color:#a0a0a0;">1500</div>
                    <div id="x_1500_2" style="z-index:1;position: absolute; left:1485px; top:<?php echo $umfang-16; ?>px;visibility:visible;color:#a0a0a0;">1500</div>
                    <div id="y_1500_1" style="z-index:1;position: absolute; left:4px; top:1502px;visibility:visible;color:#a0a0a0;">1500</div>
                    <div id="y_1500_2" style="z-index:1;position: absolute; left:<?php echo $umfang-33; ?>px; top:1502px;visibility:visible;color:#a0a0a0;">1500</div>
                    <?php
                }
                if ($umfang>2000) {
                    ?>
                    <div id="x_2000_1" style="z-index:1;position: absolute; left:1985px; top:4px;visibility:visible;color:#a0a0a0;">2000</div>
                    <div id="x_2000_2" style="z-index:1;position: absolute; left:1985px; top:<?php echo $umfang-16; ?>px;visibility:visible;color:#a0a0a0;">2000</div>
                    <div id="y_2000_1" style="z-index:1;position: absolute; left:4px; top:2002px;visibility:visible;color:#a0a0a0;">2000</div>
                    <div id="y_2000_2" style="z-index:1;position: absolute; left:<?php echo $umfang-33; ?>px; top:2002px;visibility:visible;color:#a0a0a0;">2000</div>
                    <?php
                }
                if ($umfang>2500) {
                    ?>
                    <div id="x_2500_1" style="z-index:1;position: absolute; left:2485px; top:4px;visibility:visible;color:#a0a0a0;">2500</div>
                    <div id="x_2500_2" style="z-index:1;position: absolute; left:2485px; top:<?php echo $umfang-16; ?>px;visibility:visible;color:#a0a0a0;">2500</div>
                    <div id="y_2500_1" style="z-index:1;position: absolute; left:4px; top:2502px;visibility:visible;color:#a0a0a0;">2500</div>
                    <div id="y_2500_2" style="z-index:1;position: absolute; left:<?php echo $umfang-33; ?>px; top:2502px;visibility:visible;color:#a0a0a0;">2500</div>
                    <?php
                }
                if ($umfang>3000) {
                    ?>
                    <div id="x_3000_1" style="z-index:1;position: absolute; left:2985px; top:4px;visibility:visible;color:#a0a0a0;">3000</div>
                    <div id="x_3000_2" style="z-index:1;position: absolute; left:2985px; top:<?php echo $umfang-16; ?>px;visibility:visible;color:#a0a0a0;">3000</div>
                    <div id="y_3000_1" style="z-index:1;position: absolute; left:4px; top:3002px;visibility:visible;color:#a0a0a0;">3000</div>
                    <div id="y_3000_2" style="z-index:1;position: absolute; left:<?php echo $umfang-33; ?>px; top:3002px;visibility:visible;color:#a0a0a0;">3000</div>
                    <?php
                }
                if ($umfang>3500) {
                    ?>
                    <div id="x_3500_1" style="z-index:1;position: absolute; left:3485px; top:4px;visibility:visible;color:#a0a0a0;">3500</div>
                    <div id="x_3500_2" style="z-index:1;position: absolute; left:3485px; top:<?php echo $umfang-16; ?>px;visibility:visible;color:#a0a0a0;">3500</div>
                    <div id="y_3500_1" style="z-index:1;position: absolute; left:4px; top:3502px;visibility:visible;color:#a0a0a0;">3500</div>
                    <div id="y_3500_2" style="z-index:1;position: absolute; left:<?php echo $umfang-33; ?>px; top:3502px;visibility:visible;color:#a0a0a0;">3500</div>
                    <?php
                }
                if ($nebel>=1) {
                    $zeiger = @mysql_query("SELECT * FROM $skrupel_planeten where $spalte=1 and spiel=$spiel order by id");
                } else {
                    $zeiger = @mysql_query("SELECT * FROM $skrupel_planeten where spiel=$spiel order by id");
                }
                $datensaetze = @mysql_num_rows($zeiger);
                if ($datensaetze>=1) {
                    for  ($i=0; $i<$datensaetze;$i++) {
                        $ok = @mysql_data_seek($zeiger,$i);
                        $array = @mysql_fetch_array($zeiger);
                        $id=$array["id"];
                        $name=$array["name"];
                        $x_pos=$array["x_pos"];
                        $y_pos=$array["y_pos"];
                        $besitzer=$array["besitzer"];
                        $klasse=$array["klasse"];
                        $logbuch=$array["logbuch"];
                        $kolonisten=$array["kolonisten"];
                        $vorrat=$array["vorrat"];
                        $cantox=$array["cantox"];
                        $fabriken=$array["fabriken"];
                        $minen=$array["minen"];
                        $auto_minen=$array["auto_minen"];
                        $auto_fabriken=$array["auto_fabriken"];
                        $osys_1=$array["osys_1"];
                        $osys_2=$array["osys_2"];
                        $osys_3=$array["osys_3"];
                        $osys_4=$array["osys_4"];
                        $osys_5=$array["osys_5"];
                        $osys_6=$array["osys_6"];
                        $sternenbasis_art=$array["sternenbasis_art"];
                        $sternenbasis=$array["sternenbasis"];
                        if ($auto_minen==1) {$minen=$minen." <i>".$lang['galaxie']['auto']."</i>";}
                        if ($auto_fabriken==1) {$fabriken=$fabriken." <i>".$lang['galaxie']['auto']."</i>";}
                        $planet_lemin=$array["planet_lemin"];
                        $planet_min1=$array["planet_min1"];
                        $planet_min2=$array["planet_min2"];
                        $planet_min3=$array["planet_min3"];
                        $lemin=$array["lemin"];
                        $min1=$array["min1"];
                        $min2=$array["min2"];
                        $min3=$array["min3"];
                        if (strlen($logbuch)==0) { $logbuch="<i>".$lang['galaxie']['nologdata']."</i>"; }
                        $logbuch = preg_replace("(\r\n|\n|\r)", "<br>", $logbuch);
                        if ((($osys_1==5) or ($osys_2==5) or ($osys_3==5) or ($osys_4==5) or ($osys_5==5) or ($osys_6==5)) and ($besitzer!=$spieler)) {
                            $klasse=3;
                        }
                        if ($klasse==1) { $klassename="M"; }
                        if ($klasse==2) { $klassename="N"; }
                        if ($klasse==3) { $klassename="J"; }
                        if ($klasse==4) { $klassename="L"; }
                        if ($klasse==5) { $klassename="G"; }
                        if ($klasse==6) { $klassename="I"; }
                        if ($klasse==7) { $klassename="C"; }
                        if ($klasse==8) { $klassename="K"; }
                        if ($klasse==9) { $klassename="F"; }
                        if ($besitzer==$spieler) { $eigentum=1;}
                        if ($besitzer==0) { $eigentum=0;}
                        if (($besitzer>=1) and ($besitzer!=$spieler)) { $eigentum=0;}
                        $x_position=$x_pos-5;
                        $y_position=$y_pos-5;
                        $nametip="[$name] ".$lang['galaxie']['klasse']." $klassename";
                        ?>
                        <div id="planet_<?php echo $id; ?>"
                            style="z-index:6;position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position; ?>px; width:10px; height:10px;visibility:visible;">
                            <a href="javascript:;" onclick="linieplanet(<?php echo $x_position+5;echo ",";echo $y_position+5;echo ",'$name'";echo ",$id";echo ",$eigentum,0";  ?>);self.focus();" onmouseover="tooltipunbesetzt(<?php echo $x_position+14; ?>,<?php echo $y_position+14; ?>,' <?php echo $nametip; ?> ',0);" onmouseout="tooltipunbesetztout();" <?php if(@intval(substr($spieler_optionen,11,1))==0) { ?>style="cursor: url(../bilder/cursor/weiss.cur), crosshair;"<?php } ?>><img border="0" src="<?php echo $bildpfad; ?>/karte/planeten/<?php echo $klasse; ?>.gif" width="10" height="10"></a>
                        </div>
                        <?php
                        if ($besitzer>=1) {
                            ?>
                            <div id="planetbesetzt_scan_<?php echo $id; ?>"
                                style="z-index:0;position: absolute; left:<?php echo $x_position-51; ?>px; top:<?php echo $y_position-51; ?>px; width:112px; height:112px;visibility:visible;"><img border="0" src="<?php echo $bildpfad; ?>/karte/scan_planet.<?php if(@intval(substr($spieler_optionen,16,1))==1) { echo 'gif'; } else { echo 'png'; }?>" width="112" height="112">
                            </div>
                            <?php
                            if (($sternenbasis_art==3) and ($sternenbasis==2)) {
                                ?>
                                <div id="planetbesetzt_basisscan_<?php echo $id; ?>"
                                    style="z-index:0;position: absolute; left:<?php echo $x_position-115; ?>px; top:<?php echo $y_position-115; ?>px; width:240px; height:240px;">
                                    <img border="0" src="<?php echo $bildpfad; ?>/karte/scan_2.gif" width="240" height="240">
                                </div>
                                <?php
                            }
                            if ($besitzer==$spieler) {
                                ?>
                                <div id="planetbesetzt_<?php echo $id; ?>"
                                    style="z-index:7;position: absolute; left:<?php echo $x_position-2; ?>px; top:<?php echo $y_position-2; ?>px; width:14px; height:14px;visibility:visible;">
                                    <a href="javascript:;" onclick="linieplanet(<?php echo $x_position+5;echo ",";echo $y_position+5;echo ",'$name'";echo ",$id";echo ",$eigentum";echo ",0";  ?>);self.focus();" onmouseover="tooltipbesetzt(<?php echo $x_position+14; ?>,<?php echo $y_position+14; ?>,' <?php echo $nametip; ?> ','<?php echo $kolonisten; ?>','<?php echo $cantox; ?>','<?php echo "$lemin ($planet_lemin)"; ?>','<?php echo "$min1 ($planet_min1)"; ?>','<?php echo "$min2 ($planet_min2)"; ?>','<?php echo "$min3 ($planet_min3)"; ?>',' <?php echo $minen; ?> ','<?php echo $fabriken; ?>','<?php echo $vorrat; ?>','<?php echo $logbuch; ?>');" onmouseout="tooltipbesetztout();" <?php if(@intval(substr($spieler_optionen,11,1))==0) { ?>style="cursor: url(../bilder/cursor/weiss.cur), crosshair;"<?php } ?>><img border="0" src="<?php echo $bildpfad; ?>/karte/farben/planetbesetzt_<?php echo $besitzer; ?>.gif" width="14" height="14"></a>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div id="planetbesetzt_<?php echo $id; ?>"
                                    style="z-index:7;position: absolute; left:<?php echo $x_position-2; ?>px; top:<?php echo $y_position-2; ?>px; width:14px; height:14px;visibility:visible;">
                                    <a href="javascript:;" onclick="linieplanet(<?php echo $x_position+5;echo ",";echo $y_position+5;echo ",'$name'";echo ",$id";echo ",$eigentum"; echo ",$besitzer";  ?>);" onmouseover="tooltipunbesetzt(<?php echo $x_position+14; ?>,<?php echo $y_position+14; ?>,' <?php echo $nametip; ?> ',<?php echo $beziehung[$spieler][$besitzer]['status']; ?>);" onmouseout="tooltipunbesetztout();" <?php if(@intval(substr($spieler_optionen,11,1))==0) { ?>style="cursor: url(../bilder/cursor/rot.cur), crosshair;"<?php } ?>><img border="0" src="<?php echo $bildpfad; ?>/karte/farben/planetbesetzt_<?php echo $besitzer; ?>.gif" width="14" height="14"></a>
                                </div>
                                <?php
                            }
                        }
                    }
                }
                if ($nebel>=2) {
                    $zeiger = @mysql_query("SELECT * FROM $skrupel_planeten where $spalte_beta=1 and $spalte=0 and spiel=$spiel order by id");
                    $datensaetze = @mysql_num_rows($zeiger);
                    if ($datensaetze>=1) {
                        for  ($i=0; $i<$datensaetze;$i++) {
                            $ok = @mysql_data_seek($zeiger,$i);
                            $array = @mysql_fetch_array($zeiger);
                            $id=$array["id"];
                            $name=$array["name"];
                            $besitzer=$array["besitzer"];
                            $x_pos=$array["x_pos"];
                            $y_pos=$array["y_pos"];
                            $besitzer=$array["besitzer"];
                            $klasse=$array["klasse"];
                            $logbuch="";
                            $osys_1=$array["osys_1"];
                            $osys_2=$array["osys_2"];
                            $osys_3=$array["osys_3"];
                            $osys_4=$array["osys_4"];
                            $osys_5=$array["osys_5"];
                            $osys_6=$array["osys_6"];
                            if ((($osys_1==5) or ($osys_2==5) or ($osys_3==5) or ($osys_4==5) or ($osys_5==5) or ($osys_6==5)) and ($besitzer!=$spieler)) {
                                $klasse=3;
                            }
                            if ($klasse==1) { $klassename="M"; }
                            if ($klasse==2) { $klassename="N"; }
                            if ($klasse==3) { $klassename="J"; }
                            if ($klasse==4) { $klassename="L"; }
                            if ($klasse==5) { $klassename="G"; }
                            if ($klasse==6) { $klassename="I"; }
                            if ($klasse==7) { $klassename="C"; }
                            if ($klasse==8) { $klassename="K"; }
                            if ($klasse==9) { $klassename="F"; }
                            if ($besitzer==$spieler) { $eigentum=1;}
                            if ($besitzer==0) { $eigentum=0;}
                            if (($besitzer>=1) and ($besitzer!=$spieler)) { $eigentum=0;}
                            $x_position=$x_pos-5;
                            $y_position=$y_pos-5;
                            $nametip="[$name] ".$lang['galaxie']['klasse']." $klassename";
                            ?>
                            <div id="planet_<?php echo $id; ?>"
                                style="z-index:6;position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position; ?>px; width:10px; height:10px;visibility:visible;">
                                <a href="javascript:;" onclick="linieplanet(<?php echo $x_position+5;echo ",";echo $y_position+5;echo ",'$name'";echo ",$id";echo ",$eigentum,0";  ?>);self.focus();" onmouseover="tooltipunbesetzt(<?php echo $x_position+14; ?>,<?php echo $y_position+14; ?>,' <?php echo $nametip?> ',0);" onmouseout="tooltipunbesetztout();" <?php if(@intval(substr($spieler_optionen,11,1))==0) { ?>style="cursor: url(../bilder/cursor/weiss.cur), crosshair;"<?php } ?>><img border="0" src="<?php echo $bildpfad; ?>/karte/planeten/<?php echo $klasse; ?>.gif" width="10" height="10"></a>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
            </div>
            </div>
        </body>
    </html>
    <?php
}

