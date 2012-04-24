<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'uebersicht_uebersicht';
$fuid = int_get('fu');

if ($fuid==1) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_spiele where id=$spiel");
    $array = @mysql_fetch_array($zeiger);
    $letztermonat=$array["letztermonat"];
    if($array["lasttick"]){
        $lasttick=$array["lasttick"];
    }else{
        $lasttick=0;
    }
    $runde=$array["runde"];
    if (strlen($lasttick)==10) {
        $datum1=date('d.m.y',$lasttick);
        $datum2=date('G:i',$lasttick);
            $datum=str_replace(array('{1}','{2}','{3}'),array($runde,$datum1,$datum2),$lang['uebersichtuebersicht']['datum']);
    }
    ?>
    <body text="#ffffff" bgcolor="#444444"  link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
        <center>
        <table border="0" cellspacing="0" cellpadding="0" width="796">
            <tr>
                <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                <td width="100%" valign=top>
                    <center><img src="../lang/<?php echo $spieler_sprache?>/topics/aktuelles.gif" border="0" width="199" height="52"></center>
                    <br><br>
                    <center>
                        <table border="0" cellspacing="0" cellpadding="0">
                        <?php if (strlen($lasttick)==10) { ?>
                            <tr>
                                <td><center><?php echo $datum?></center></td>
                            </tr>
                        <?php } ?>
                            <tr>
                                <td><?php echo $letztermonat?></td>
                            </tr>
                        </table>
                    </center>
                </td>
                <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                <td><br><br><br>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <center>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td colspan="3"><img src="<?php echo $bildpfad?>/aufbau/galaoben.gif" border="0" width="258" height="4"></td>
                                    </tr>
                                    <tr>
                                        <td><img src="<?php echo $bildpfad?>/aufbau/galalinks.gif" border="0" width="4" height="250"></td>
                                        <td><iframe src="uebersicht_uebersicht.php?fu=2&uid=<?php echo $uid?>&sid=<?php echo $sid?>" width="250" height="250" name="map" scrolling="no" marginheight="0" marginwidth="0" frameborder="0"></iframe></td>
                                        <td><img src="<?php echo $bildpfad?>/aufbau/galarechts.gif" border="0" width="4" height="250"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><img src="<?php echo $bildpfad?>/aufbau/galaunten.gif" border="0" width="258" height="4"></td>
                                    </tr>
                                </table>
                            </center>
                            <br>
                        </td>
                    </tr>
                </table>
            </tr>
            <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
        </table>
        </center>
        </div>
        <?php
    include ("inc.footer.php");
}
if ($fuid==2) {
    include ("inc.header.php");
    ?><body onLoad="window.location='uebersicht_uebersicht.php?fu=3&uid=<?php echo $uid?>&sid=<?php echo $sid?>';" text="#000000" bgcolor="#000000"   link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" cellspacing="0" cellpadding="0" height="100%">
                <tr><td><center><img src="<?php echo $bildpfad?>/radb.gif" height="46" width="51"><br><br><?php echo $lang['uebersichtuebersicht']['galaxie']?></center></td></tr>
            </table>
        </center>
        <?php
    include ("inc.footer.php");
}
if ($fuid==3) {
    include ("inc.header.php");
    if ((@extension_loaded('gd')) or (@dl('gd.so'))) {
        ?>    
        <body text="#000000" bgcolor="#111111" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">    
            <script type="text/javascript">
                var IE = document.all?true:false;
                var NS = (!document.all && document.getElementById)?true:false;
                if (!IE && !NS) {document.captureEvents(Event.MOUSEMOVE);}
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
                        if (tempY < 0){tempY = 0;}
                    }
                }    
                function map() {
                    parent.parent.parent.untenmitte.window.location = 'planeten.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>';
                    parent.parent.parent.mittelinksoben.document.globals.map.value = 1;
                    parent.parent.parent.mittemitte.window.location = 'galaxie.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>&gox=' + tempX + '&goy=' + tempY;
                }
            </script>
            <a href="javascript:map();" style="cursor: crosshair;"><img src="uebersicht_uebersicht.php?fu=4&uid=<?php echo $uid?>&sid=<?php echo $sid?>" width="250" height="250" border="0"></a>
            <?php
        include ("inc.footer.php");
    } else {
        $sektoranzahl=$umfang/$aufloesung;
        if ($nebel>=1) {
            $spieler_code="";
            for ($n=1;$n<$spieler;$n++) {
                $spieler_code=$spieler_code."_";
            }
            $spieler_code=$spieler_code."1";
            for ($n=$spieler;$n<10;$n++) {
                $spieler_code=$spieler_code."_";
            }
        }
        $spalte=$spalte='sicht_'.$spieler;
        $spalte_beta=$spalte.'_beta';
        $breite=250;
        $hoehe=250;
        $scan_gross=$breite*250/$umfang;
        ?>
        <body text="#000000" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><img src="<?php echo $bildpfad?>/karte/mapklein_g.gif" width="<?php echo $breite?>" height="<?php echo $hoehe?>"></td>
                </tr>
            </table>
            <?php
            if (($nebel>=1) and ($spieler_raus==1)) {
                ?><div id="dark" style="filter:alpha(opacity=70);-moz-opacity:70%;position: absolute; left:0px; top:0px; width:250px; height:250px;visibility=visible;background-Color:#333333;"><img border="0" src="../bilder/empty.gif" width="250" height="250"></div><?php
            }
            for ($n=1;$n<=$sektoranzahl;$n++) {
                $x=(250*$n)/$umfang*$breite;
                ?><div id="strich<?php echo $n?>" style="z-index:2;position: absolute; left:<?php echo $x?>px; top:0px; width:1px; height:<?php echo $hoehe?>px;visibility=visible;background-Color:#333333;"><img border="0" src="../bilder/empty.gif" width="1" height="<?php echo $hoehe?>"></div><?php
            }
            for ($n=1;$n<=$sektoranzahl;$n++) {
                $y=(250*$n)/$umfang*$hoehe;
                ?><div id="strich<?php echo $n+5?>" style="z-index:2;position: absolute; left:0px; top:<?php echo $y?>px; width:<?php echo $breite?>px; height:1px;visibility=visible;background-Color:#333333;"><img border="0" src="../bilder/empty.gif" width="<?php echo $breite?>" height="1"></div><?php
            }
            if (($spieler_raus==0) or ($nebel==0)) {
//////////////////////////////////////////////////////////////
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
                        $sternenbasis=$array["sternenbasis"];
                        $farbe='#aaaaaa';
                        $x_position=$x_pos/$umfang*$breite;
                        $y_position=$y_pos/$umfang*$hoehe;
                        if ($besitzer>=1) { $farbe=$spielerfarbe[$besitzer];}
                        if ($besitzer==$spieler) {
                            ?>
                            <div id="scan_planet_<?php echo $id?>" style="z-index:1;position: absolute; left:<?php echo $x_position-($scan_gross/2); ?>px; top:<?php echo $y_position-($scan_gross/2); ?>px; width:<?php echo $scan_gross; ?>px; height:<?php echo $scan_gross; ?>px;visibility=visible;"><img border="0" src="<?php echo $bildpfad?>/karte/scan_klein.gif" width="<?php echo $scan_gross; ?>" height="<?php echo $scan_gross; ?>"></div>
                        <?php } ?>
                        <div id="planet_<?php echo $id?>_1" style="z-index:3;position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position-1; ?>px; width:1px; height:3px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="3"></div>
                        <div id="planet_<?php echo $id?>_2" style="z-index:3;position: absolute; left:<?php echo $x_position-1; ?>px; top:<?php echo $y_position; ?>px; width:3px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="3" height="1"></div>
                        <?php
                        if ($sternenbasis==2) { ?>
                            <div id="planet_<?php echo $id?>_6" style="z-index:3;position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position-3; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <div id="planet_<?php echo $id?>_7" style="z-index:3;position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position-2; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <div id="planet_<?php echo $id?>_8" style="z-index:3;position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position+2; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <div id="planet_<?php echo $id?>_9" style="z-index:3;position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position+3; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <div id="planet_<?php echo $id?>_10" style="z-index:3;position: absolute; left:<?php echo $x_position-3; ?>px; top:<?php echo $y_position; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <div id="planet_<?php echo $id?>_11" style="z-index:3;position: absolute; left:<?php echo $x_position-2; ?>px; top:<?php echo $y_position; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <div id="planet_<?php echo $id?>_12" style="z-index:3;position: absolute; left:<?php echo $x_position+2; ?>px; top:<?php echo $y_position; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <div id="planet_<?php echo $id?>_13" style="z-index:3;position: absolute; left:<?php echo $x_position+3; ?>px; top:<?php echo $y_position; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                        <?php }
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
                            $farbe='#aaaaaa';
                            //$x_position=$x_pos*75/$umfang;
                            //$y_position=$y_pos*75/$umfang;
                            $x_position=$x_pos/$umfang*$breite;
                            $y_position=$y_pos/$umfang*$hoehe;
                            ?>
                            <div id="planet_<?php echo $id?>_1" style="z-index:3;position: absolute; left:<?php echo $x_position?>px; top:<?php echo $y_position-1?>px; width:1px; height:3px;visibility=visible;background-Color:#aaaaaa;"><img border="0" src="../bilder/empty.gif" width="1" height="3"></div>
                            <div id="planet_<?php echo $id?>_2" style="z-index:3;position: absolute; left:<?php echo $x_position-1?>px; top:<?php echo $y_position?>px; width:3px; height:1px;visibility=visible;background-Color:#aaaaaa;"><img border="0" src="../bilder/empty.gif" width="3" height="1"></div>
                            <?php
                        }
                    }
                }
                if ($nebel>=1) {
                    $zeiger = @mysql_query("SELECT volk,bild_klein,masse,kox_old,koy_old,klasse,schaden,antrieb,frachtraum,fracht_leute,fracht_cantox,fracht_vorrat,fracht_min1,fracht_min2,fracht_min3,lemin,leminmax,logbuch,routing_status,routing_id,routing_koord,besitzer,id,name,kox,koy,flug,zielx,ziely,zielid,techlevel,masse_gesamt,status,spezialmission,tarnfeld,extra,sicht,ordner,erfahrung FROM $skrupel_schiffe where status>0 and spiel=$spiel and (($spalte=1 and tarnfeld=0) or ($spalte_beta=1 and (((tarnfeld<2) and (volk!='unknown')) or tarnfeld=0)) or besitzer=$spieler) order by masse desc");
                } else {
                    $zeiger = @mysql_query("SELECT volk,bild_klein,masse,kox_old,koy_old,klasse,schaden,antrieb,frachtraum,fracht_leute,fracht_cantox,fracht_vorrat,fracht_min1,fracht_min2,fracht_min3,lemin,leminmax,logbuch,routing_status,routing_id,routing_koord,besitzer,id,name,kox,koy,flug,zielx,ziely,zielid,techlevel,masse_gesamt,status,spezialmission,tarnfeld,extra FROM $skrupel_schiffe where status>0 and spiel=$spiel order by masse desc");
                }
                $datensaetze = @mysql_num_rows($zeiger);
                if ($datensaetze>=1) {
                    for  ($i=0; $i<$datensaetze;$i++) {
                        $ok = @mysql_data_seek($zeiger,$i);
                        $array = @mysql_fetch_array($zeiger);
                        $id=$array["id"];
                        $x_pos=$array["kox"];
                        $y_pos=$array["koy"];
                        $besitzer=$array["besitzer"];
                        $status=$array["status"];
                        $spezialmission=$array["spezialmission"];
                        $x_position=$x_pos/$umfang*$breite;
                        $y_position=$y_pos/$umfang*$hoehe;
                        if (($spezialmission>=41) and ($spezialmission<=50)) { $besitzer=$spezialmission-40; }
                        $farbe=$spielerfarbe["$besitzer"];
                        if ($status==2)  {
                            ?>
                            <div id="schiff_<?php echo $id?>_1" style="z-index:3;position: absolute; left:<?php echo $x_position-1; ?>px; top:<?php echo $y_position-1; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <div id="schiff_<?php echo $id?>_2" style="z-index:3;position: absolute; left:<?php echo $x_position-1; ?>px; top:<?php echo $y_position+1; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <div id="schiff_<?php echo $id?>_3" style="z-index:3;position: absolute; left:<?php echo $x_position+1; ?>px; top:<?php echo $y_position-1; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <div id="schiff_<?php echo $id?>_4" style="z-index:3;position: absolute; left:<?php echo $x_position+1; ?>px; top:<?php echo $y_position+1; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <div id="schiff_<?php echo $id?>_5" style="z-index:3;position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position-2; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <div id="schiff_<?php echo $id?>_6" style="z-index:3;position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position+2; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <div id="schiff_<?php echo $id?>_7" style="z-index:3;position: absolute; left:<?php echo $x_position-2; ?>px; top:<?php echo $y_position; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <div id="schiff_<?php echo $id?>_8" style="z-index:3;position: absolute; left:<?php echo $x_position+2; ?>px; top:<?php echo $y_position; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <?php
                        } else {
                            ?>
                            <div id="schiff_<?php echo $id?>_1" style="z-index:3;position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <?php
                            if ($besitzer==$spieler) {?> 
                                <div id="scan_schiff_<?php echo $id?>" style="z-index:1;position: absolute; left:<?php echo $x_position-($scan_gross/2); ?>px; top:<?php echo $y_position-($scan_gross/2); ?>px; width:<?php echo $scan_gross; ?>px; height:<?php echo $scan_gross; ?>px;visibility=visible;"><img border="0" src="<?php echo $bildpfad?>/karte/scan_klein.gif" width="<?php echo $scan_gross; ?>" height="<?php echo $scan_gross; ?>"></div>
                            <?php }
                        }
                    }
                }
//////////////////////////////////////////////////////////////
            }
        include ("inc.footer.php");
    }
}
if ($fuid==4) {
    open_db();
    include ('inc.check.php');
    $spalte=$spalte='sicht_'.$spieler;
    $spalte_beta=$spalte.'_beta';    
    $bild = ImageCreate(250, 250);
    $hintergrundbild = ImageCreateFromGIF('../bilder/karte/mapklein_g.gif');
    $scanbild = ImageCreateFromGIF('../bilder/karte/scan_klein.gif');
    $color['background'] = imagecolorallocate($bild, 44, 44, 44);
    $color['linien'] = imagecolorallocate($bild, 30, 30, 30);
    $color['grey']  = imagecolorallocate($bild, 69, 69, 69);
    $color['black']  = imagecolorallocate($bild, 0, 0, 0);
    $color['blue']  = imagecolorallocate($bild, 0, 0, 255);
    $color['white']  = imagecolorallocate($bild, 255, 255, 255);
    $color['spieler'][0] = imagecolorallocate($bild, 170, 170, 170);
    $color['spieler'][1] = imagecolorallocate($bild, 29, 199, 16);
    $color['spieler'][2] = imagecolorallocate($bild, 229, 226, 3);
    $color['spieler'][3] = imagecolorallocate($bild, 234, 165, 0);
    $color['spieler'][4] = imagecolorallocate($bild, 135, 95, 0);
    $color['spieler'][5] = imagecolorallocate($bild, 187, 0, 0);
    $color['spieler'][6] = imagecolorallocate($bild, 215, 0, 193);
    $color['spieler'][7] = imagecolorallocate($bild, 125, 16, 199);
    $color['spieler'][8] = imagecolorallocate($bild, 16, 29, 199);
    $color['spieler'][9] = imagecolorallocate($bild, 4, 158, 239);
    $color['spieler'][10] = imagecolorallocate($bild, 16, 199, 155);    
    Imagecopy($bild,$hintergrundbild,0,0,0,0,250,250);
    $sektoranzahl=round($umfang/250)-1;
    for ($n=1;$n<=$sektoranzahl;$n++) {
        $x=(250*$n)/$umfang*250;
        $y=(250*$n)/$umfang*250;
        imageline ($bild, $x, 0, $x, 250-1, $color['linien']);
        imageline ($bild, 0, $y, 250-1, $y, $color['linien']);
    }    
    if ($nebel>=1) {
        $zeiger_planeten = @mysql_query("SELECT id,x_pos,y_pos,besitzer,sternenbasis FROM $skrupel_planeten where $spalte=1 and spiel=$spiel order by id");
    } else {
        $zeiger_planeten = @mysql_query("SELECT id,x_pos,y_pos,besitzer,sternenbasis FROM $skrupel_planeten where spiel=$spiel order by id");
    } 
    $datensaetze_planeten = @mysql_num_rows($zeiger_planeten);     
    if ($datensaetze_planeten>=1) {
        for  ($i=0; $i<$datensaetze_planeten;$i++) {
            $ok = @mysql_data_seek($zeiger_planeten,$i);
            $array = @mysql_fetch_array($zeiger_planeten);
            $id=$array["id"];
            $x_pos=$array["x_pos"];
            $y_pos=$array["y_pos"];
            $besitzer=$array["besitzer"];
            $x_position=round($x_pos/$umfang*250);
            $y_position=round($y_pos/$umfang*250);
            if ($besitzer==$spieler) {
                ImageCopyResized($bild,$scanbild,$x_position-round(31250/$umfang),$y_position-round(31250/$umfang),0,0,(round(31250/$umfang)*2)+1,(round(31250/$umfang)*2)+1,63,63);
            }
        }
    }
    if ($datensaetze_planeten>=1) {
        $array="";
        for  ($i=0; $i<$datensaetze_planeten;$i++) {
            $ok = @mysql_data_seek($zeiger_planeten,$i);
            $array = @mysql_fetch_array($zeiger_planeten);
            $id=$array["id"];
            $x_pos=$array["x_pos"];
            $y_pos=$array["y_pos"];
            $besitzer=$array["besitzer"];
            $sternenbasis=$array["sternenbasis"];
            $x_position=round($x_pos/$umfang*250);
            $y_position=round($y_pos/$umfang*250);
            imagesetpixel($bild,$x_position,$y_position,$color['spieler'][$besitzer]);
            if ($besitzer>=1) {
                imagesetpixel($bild,$x_position-1,$y_position,$color['spieler'][$besitzer]);
                imagesetpixel($bild,$x_position+1,$y_position,$color['spieler'][$besitzer]);
                imagesetpixel($bild,$x_position,$y_position-1,$color['spieler'][$besitzer]);
                imagesetpixel($bild,$x_position,$y_position+1,$color['spieler'][$besitzer]);
                if ($sternenbasis==2) {
                    imagesetpixel($bild,$x_position,$y_position-3,$color['spieler'][$besitzer]);
                    imagesetpixel($bild,$x_position,$y_position-2,$color['spieler'][$besitzer]);
                    imagesetpixel($bild,$x_position,$y_position+2,$color['spieler'][$besitzer]);
                    imagesetpixel($bild,$x_position,$y_position+3,$color['spieler'][$besitzer]);
                    imagesetpixel($bild,$x_position-3,$y_position,$color['spieler'][$besitzer]);
                    imagesetpixel($bild,$x_position-2,$y_position,$color['spieler'][$besitzer]);
                    imagesetpixel($bild,$x_position+2,$y_position,$color['spieler'][$besitzer]);
                    imagesetpixel($bild,$x_position+3,$y_position,$color['spieler'][$besitzer]);
                }
            }
        }
    }
    if ($nebel>=1) {
        $zeiger_schiffe = @mysql_query("SELECT * FROM $skrupel_schiffe where spiel=$spiel and (($spalte=1 and tarnfeld=0) or ($spalte_beta=1 and (((tarnfeld<2) and (volk!='unknown')) or tarnfeld=0)) or besitzer=$spieler) order by masse desc");
    } else {
        $zeiger_schiffe = @mysql_query("SELECT * FROM $skrupel_schiffe where spiel=$spiel order by masse desc");
    }       
    $datensaetze_schiffe = @mysql_num_rows($zeiger_schiffe);    
    if ($datensaetze_schiffe>=1) {
        for  ($i=0; $i<$datensaetze_schiffe;$i++) {
            $ok = @mysql_data_seek($zeiger_schiffe,$i);
            $array = @mysql_fetch_array($zeiger_schiffe);
            $id=$array["id"];
            $x_pos=$array["kox"];
            $y_pos=$array["koy"];
            $besitzer=$array["besitzer"];
            $x_position=round($x_pos/$umfang*250);
            $y_position=round($y_pos/$umfang*250);
            if ($besitzer==$spieler) {
                ImageCopyResized($bild,$scanbild,$x_position-round(31250/$umfang),$y_position-round(31250/$umfang),0,0,(round(31250/$umfang)*2)+1,(round(31250/$umfang)*2)+1,63,63);
            }
        }
    }    
    $zeiger_anomalie = @mysql_query("SELECT * FROM $skrupel_anomalien where spiel=$spiel and $spalte=1 order by id");
    $datensaetze_anomalie = @mysql_num_rows($zeiger_anomalie);
    if ($datensaetze_anomalie>=1) {
        for  ($i=0; $i<$datensaetze_anomalie;$i++) {
            $ok = @mysql_data_seek($zeiger_anomalie,$i);
            $array = @mysql_fetch_array($zeiger_anomalie);
            $aid=$array["id"];
            $art=$array["art"];
            $x_pos=$array["x_pos"];
            $y_pos=$array["y_pos"];
            $extra=$array["extra"];
            $x_position=round($x_pos/$umfang*250);
            $y_position=round($y_pos/$umfang*250);
            if (($art==1) or ($art==2)) {
                imagesetpixel($bild,$x_position,$y_position,$color['white']);
                imagesetpixel($bild,$x_position+1,$y_position+1,$color['blue']);
                imagesetpixel($bild,$x_position-1,$y_position-1,$color['blue']);
                imagesetpixel($bild,$x_position-1,$y_position+1,$color['blue']);
                imagesetpixel($bild,$x_position+1,$y_position-1,$color['blue']);
            }
            if ($art==3) {
                imagesetpixel($bild,$x_position,$y_position,$color['white']);
            }
        }
    }    
    if ($nebel>=2) {
        $zeiger_planeten = @mysql_query("SELECT * FROM $skrupel_planeten where $spalte_beta=1 and spiel=$spiel order by id");   
        $datensaetze_planeten = @mysql_num_rows($zeiger_planeten);
        if ($datensaetze_planeten>=1) {
            for  ($i=0; $i<$datensaetze_planeten;$i++) {
                $ok = @mysql_data_seek($zeiger_planeten,$i);
                $array = @mysql_fetch_array($zeiger_planeten);
                $id=$array["id"];
                $x_pos=$array["x_pos"];
                $y_pos=$array["y_pos"];
                $besitzer=$array["besitzer"];
                $spalte_temp=$array[$spalte];
                $sternenbasis=$array["sternenbasis"];
                $x_position=round($x_pos/$umfang*250);
                $y_position=round($y_pos/$umfang*250);
                imagesetpixel($bild,$x_position,$y_position,$color['spieler'][0]);
                if(($spalte_temp==1)or($besitzer==$spieler)){
                    imagesetpixel($bild,$x_position,$y_position,$color['spieler'][$besitzer]);
                    if ($besitzer>=1) {
                        imagesetpixel($bild,$x_position-1,$y_position,$color['spieler'][$besitzer]);
                        imagesetpixel($bild,$x_position+1,$y_position,$color['spieler'][$besitzer]);
                        imagesetpixel($bild,$x_position,$y_position-1,$color['spieler'][$besitzer]);
                        imagesetpixel($bild,$x_position,$y_position+1,$color['spieler'][$besitzer]);
                        if ($sternenbasis==2) {
                            imagesetpixel($bild,$x_position,$y_position-3,$color['spieler'][$besitzer]);
                            imagesetpixel($bild,$x_position,$y_position-2,$color['spieler'][$besitzer]);
                            imagesetpixel($bild,$x_position,$y_position+2,$color['spieler'][$besitzer]);
                            imagesetpixel($bild,$x_position,$y_position+3,$color['spieler'][$besitzer]);
                            imagesetpixel($bild,$x_position-3,$y_position,$color['spieler'][$besitzer]);
                            imagesetpixel($bild,$x_position-2,$y_position,$color['spieler'][$besitzer]);
                            imagesetpixel($bild,$x_position+2,$y_position,$color['spieler'][$besitzer]);
                            imagesetpixel($bild,$x_position+3,$y_position,$color['spieler'][$besitzer]);
                        }
                    }
                }
            }
        }
    }    
    if ($datensaetze_schiffe>=1) {
        for  ($i=0; $i<$datensaetze_schiffe;$i++) {
            $ok = @mysql_data_seek($zeiger_schiffe,$i);
            $array = @mysql_fetch_array($zeiger_schiffe);
            $id=$array["id"];
            $x_pos=$array["kox"];
            $y_pos=$array["koy"];
            $besitzer=$array["besitzer"];
            $status=$array["status"];
            $spezialmission=$array["spezialmission"];
            if (($besitzer<>$spieler) and (($spezialmission>40)and($spezialmission<51))){$besitzer=$spezialmission-40;}
            $x_position=round($x_pos/$umfang*250);
            $y_position=round($y_pos/$umfang*250);
            if ($status==2)  {
                imagesetpixel($bild,$x_position-1,$y_position-1,$color['spieler'][$besitzer]);
                imagesetpixel($bild,$x_position-1,$y_position+1,$color['spieler'][$besitzer]);
                imagesetpixel($bild,$x_position+1,$y_position-1,$color['spieler'][$besitzer]);
                imagesetpixel($bild,$x_position+1,$y_position+1,$color['spieler'][$besitzer]);
                imagesetpixel($bild,$x_position,$y_position-2,$color['spieler'][$besitzer]);
                imagesetpixel($bild,$x_position,$y_position+2,$color['spieler'][$besitzer]);
                imagesetpixel($bild,$x_position-2,$y_position,$color['spieler'][$besitzer]);
                imagesetpixel($bild,$x_position+2,$y_position,$color['spieler'][$besitzer]);
            } else {
                imagesetpixel($bild,$x_position,$y_position,$color['spieler'][$besitzer]);
            }
        }
    }    
    header("Content-Type: image/gif");
    header("Pragma: no-cache");
    header("Cach-Control: no-cache");
    header("Expires: 0");
    ImageGif($bild);
    ImageDestroy($bild);
    ImageDestroy($hintergrundbild);
    ImageDestroy($scanbild);
    @mysql_close($conn);
}
