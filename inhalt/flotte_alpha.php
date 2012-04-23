<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'flotte_alpha';
$fuid = int_get('fu');
$shid = int_get('shid');

if ($fuid==1) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT fracht_min2,kox,koy,flug,warp,zielx,ziely,zielid,antrieb,mission,masse_gesamt,lemin FROM $skrupel_schiffe where id=$shid");
    $array = @mysql_fetch_array($zeiger);
    $shipx=$array["kox"];
    $shipy=$array["koy"];
    $flug=$array["flug"];
    $warp=$array["warp"];
    $zielx=$array["zielx"];
    $ziely=$array["ziely"];
    $zielid=$array["zielid"];
    $antrieb=$array["antrieb"];
    $fracht_min2=$array["fracht_min2"];
    $mission=$array["mission"];
    $masse_gesamt=$array["masse_gesamt"];
    $lemin=$array["lemin"];
    if ($antrieb==0) {
        ?>
        <body text="#000000" scroll="auto" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <br><br><br>
            <center><?php echo $lang['flottealpha']['keinantrieb']; ?></center>
            <?php
    } else {
        ?>
        <body text="#000000" scroll="auto" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="rechnen();">
        <?php
        if ($antrieb==1) { $verbrauchpromonat = array ("0","0","0","0","0","0","0","0","0","0"); 
        }elseif ($antrieb==2) { $verbrauchpromonat = array ("0","100","107.5","300","400","500","600","700","800","900"); 
        }elseif ($antrieb==3) { $verbrauchpromonat = array ("0","100","106.25","107.78","337.5","500","600","700","800","900");
        }elseif ($antrieb==4) { $verbrauchpromonat = array ("0","100","103.75","104.44","106.25","300","322.22","495.92","487.5","900");
        }elseif ($antrieb==5) { $verbrauchpromonat = array ("0","100","103.75","104.44","106.25","104","291.67","291.84","366.41","900");
        }elseif ($antrieb==6) { $verbrauchpromonat = array ("0","100","103.75","104.44","106.25","104","103.69","251.02","335.16","900");
        }elseif ($antrieb==7) { $verbrauchpromonat = array ("0","100","103.75","104.44","106.25","104","103.69","108.16","303.91","529.63");
        }elseif ($antrieb==8) { $verbrauchpromonat = array ("0","100","100","100","100","100","100","102.04","109.38","529.63");
        }elseif ($antrieb==9) { $verbrauchpromonat = array ("0","100","100","100","100","100","100","100","100","100"); }
        if ($flug==0) {
            $zielxy="- / -";
            $zielname="-";
            $zielid=0;
            $lichtjahref=0;
            $lichtjahre="-";
            $warpfaktor=$antrieb;
            $zeit="-";
            $verbrauch="0";
        }elseif ($flug==1) {
            $zielxy="$zielx / $ziely";
            $zielname=$lang['flottealpha']['freierraum'];
            $zielid=0;
            $startx=$shipx;
            $starty=$shipy;
            $tempx=$zielx;
            $tempy=$ziely;
            $lichtjahre=(round((sqrt(($startx-$tempx)*($startx-$tempx)+($starty-$tempy)*($starty-$tempy)))*100))/100;
            $zeit=round(($lichtjahre / ($warp*$warp)) + 0.5);
            $lichtjahref=$lichtjahre;
            $lichtjahre="$lichtjahre ".$lang['flottealpha']['lichtjahre'];
            $zeittemp=$zeit;
            if ($zeit==1) { $zeit="1 ".$lang['flottealpha']['monat']; } else { $zeit="$zeit ".$lang['flottealpha']['monate']; }
            $warpfaktor=$warp;
            $verbrauch=$verbrauchpromonat[$warp];
            $verbrauch=round($lichtjahref*$verbrauch*$masse_gesamt/100000);
            if ($verbrauch<$zeittemp) { $verbrauch=$zeittemp; }
            if ($verbrauchpromonat[$warp]==0) { $verbrauch=0; }
        }elseif ($flug==2) {
            $zeiger_temp = @mysql_query("SELECT id,name FROM $skrupel_planeten where id=$zielid");
            $array_temp = @mysql_fetch_array($zeiger_temp);
            $planeten_name=$array_temp["name"];
            $zielname=$planeten_name;
            $zielxy="$zielx / $ziely";
            $startx=$shipx;
            $starty=$shipy;
            $tempx=$zielx;
            $tempy=$ziely;
            $lichtjahre=(round((sqrt(($startx-$tempx)*($startx-$tempx)+($starty-$tempy)*($starty-$tempy)))*100))/100;
            $zeit=round(($lichtjahre / ($warp*$warp)) + 0.5);
            $lichtjahref=$lichtjahre;
            $lichtjahre="$lichtjahre ".$lang['flottealpha']['lichtjahre'];
            $zeittemp=$zeit;
            if ($zeit==1) { $zeit="1 ".$lang['flottealpha']['monat']; } else { $zeit="$zeit ".$lang['flottealpha']['monate']; }
            $warpfaktor=$warp;
            $verbrauch=$verbrauchpromonat[$warp];
            $verbrauch=round($lichtjahref*$verbrauch*$masse_gesamt/100000);
            if ($verbrauch<$zeittemp) { $verbrauch=$zeittemp; }
            if ($verbrauchpromonat[$warp]==0) { $verbrauch=0; }
        }elseif ($flug==3) {
            $zielname=$lang['flottealpha']['feindkontakt'];
            $zielxy="$zielx / $ziely";
            $startx=$shipx;
            $starty=$shipy;
            $tempx=$zielx;
            $tempy=$ziely;
            $lichtjahre=(round((sqrt(($startx-$tempx)*($startx-$tempx)+($starty-$tempy)*($starty-$tempy)))*100))/100;
            $zeit=round(($lichtjahre / ($warp*$warp)) + 0.5);
            $lichtjahref=$lichtjahre;
            $lichtjahre="$lichtjahre ".$lang['flottealpha']['lichtjahre'];
            $zeittemp=$zeit;
            if ($zeit==1) { $zeit="1 ".$lang['flottealpha']['monat']; } else { $zeit="$zeit ".$lang['flottealpha']['monate']; }
            $warpfaktor=$warp;
            $verbrauch=$verbrauchpromonat[$warp];
            $verbrauch=round($lichtjahref*$verbrauch*$masse_gesamt/100000);
            if ($verbrauch<$zeittemp) { $verbrauch=$zeittemp; }
            if ($verbrauchpromonat[$warp]==0) { $verbrauch=0; }
        }elseif ($flug==4) {
            $zeiger_temp = @mysql_query("SELECT id,name FROM $skrupel_schiffe where id=$zielid");
            $array_temp = @mysql_fetch_array($zeiger_temp);
            $schiff_name=$array_temp["name"];
            $zielname=$schiff_name;
            $zielxy="$zielx / $ziely";
            $startx=$shipx;
            $starty=$shipy;
            $tempx=$zielx;
            $tempy=$ziely;
            $lichtjahre=(round((sqrt(($startx-$tempx)*($startx-$tempx)+($starty-$tempy)*($starty-$tempy)))*100))/100;
            $zeit=round(($lichtjahre / ($warp*$warp)) + 0.5);
            $lichtjahref=$lichtjahre;
            $lichtjahre="$lichtjahre ".$lang['flottealpha']['lichtjahre'];
            $zeittemp=$zeit;
            if ($zeit==1) { $zeit="1 ".$lang['flottealpha']['monat']; } else { $zeit="$zeit ".$lang['flottealpha']['monate']; }
            $warpfaktor=$warp;
            $verbrauch=$verbrauchpromonat[$warp];
            $verbrauch=round($lichtjahref*$verbrauch*$masse_gesamt/100000);
            if ($verbrauch<$zeittemp) { $verbrauch=$zeittemp; }
            if ($verbrauchpromonat[$warp]==0) { $verbrauch=0; }
            if ($lichtjahref==0) {$zeit="-";$verbrauch="0";}
        }
        ?>
        <script language=JavaScript>
            function rechnen(e) {
                var masse = <?php echo $masse_gesamt; ?>;
                var warp = document.formular.warpfaktor.value;
                var lichtjahre = document.formular.lichtjahref.value;
                var verbrauchpromonat = new Array("0",<?php
                    if ($antrieb==1) { echo '"0","0","0","0","0","0","0","0","0"';
                    }elseif ($antrieb==2) { echo '"100","107.5","300","400","500","600","700","800","900"';
                    }elseif ($antrieb==3) { echo '"100","106.25","107.78","337.5","500","600","700","800","900"';
                    }elseif ($antrieb==4) { echo '"100","103.75","104.44","106.25","300","322.22","495.92","487.5","900"';
                    }elseif ($antrieb==5) { echo '"100","103.75","104.44","106.25","104","291.67","291.84","366.41","900"';
                    }elseif ($antrieb==6) { echo '"100","103.75","104.44","106.25","104","103.69","251.02","335.16","900"';
                    }elseif ($antrieb==7) { echo '"100","103.75","104.44","106.25","104","103.69","108.16","303.91","529.63"';
                    }elseif ($antrieb==8) { echo '"100","100","100","100","100","100","102.04","109.38","529.63"';
                    }elseif ($antrieb==9) { echo '"100","100","100","100","100","100","100","100","100"'; }
                ?>);
                parent.parent.mittelinksoben.document.globals.verbrauch.value=verbrauchpromonat[warp];
                if ((warp>=1)&&(lichtjahre!=0)) {
                    var monate = Math.round((lichtjahre / (warp*warp)) + 0.5);
                    var verbrauch = Math.round(lichtjahre*verbrauchpromonat[warp]*masse/100000);
                    if (monate > verbrauch) { verbrauch=monate; }
                    if (verbrauchpromonat[warp]==0) { verbrauch=0; }
                } else {
                    if (lichtjahre==0) {
                        var monate = -1;
                        var verbrauch = 0;
                    } else {
                        var monate = 0;
                        var verbrauch = 0;
                    }
                }
                document.getElementById("formular").verbrauchf.value=verbrauchpromonat[warp];
                var ant=document.getElementById('zeit');
                if (monate==-1) ant.innerHTML='-';
                if (monate==0) ant.innerHTML='<?php echo $lang['flottealpha']['unendlich']; ?>';
                if (monate==1) ant.innerHTML='1 <?php echo $lang['flottealpha']['monat']; ?>';
                if (monate>=2) ant.innerHTML=monate+' <?php echo $lang['flottealpha']['monate']; ?>';
                var ant=document.getElementById('verbrauch');
                ant.innerHTML=verbrauch+' KT';
            }
            function modicheck(e) {
                if (parent.parent.mittelinksoben.document.globals.kursmodus.value==1) {
                    parent.parent.mittelinksoben.document.globals.kursmodus.value=0;
                    var ant=document.getElementById('modi');
                    ant.innerHTML='<?php echo $lang['flottealpha']['keinkursmodus']; ?>';
                    <?php
                    for($i=1;$i<21;$i++){
                        ?>
                        parent.parent.mittemitte.document.getElementById("punkt<?php echo  $i?>").style.visibility='hidden';
                        <?php
                    }
                    ?>
                    parent.parent.mittemitte.document.getElementById("auswahlrand").style.visibility='hidden';
                    var ant=document.getElementById('zielxy');
                    ant.innerHTML='<?php echo $zielxy; ?>';
                    var ant=document.getElementById('lichtjahre');
                    ant.innerHTML='<?php echo $lichtjahre; ?>';
                    var ant=document.getElementById('zielname');
                    ant.innerHTML='<?php echo $zielname; ?>';
                    var ant=document.getElementById('zeit');
                    ant.innerHTML='<?php echo $zeit; ?>';
                    formularr = document.getElementById("formular");
                    formularr.lichtjahref.value=<?php echo $lichtjahref; ?>;
                    formularr.zielxf.value=<?php echo $zielx; ?>;
                    formularr.zielyf.value=<?php echo $ziely; ?>;
                    formularr.zielidf.value=<?php echo $zielid; ?>;
                    formularr.flug.value=<?php echo $flug; ?>;
                    formularr.warpfaktor.value=<?php echo $warpfaktor; ?>;
                } else {
                    formularr = document.getElementById("formular");
                    parent.parent.mittelinksoben.document.globals.kursmodus.value=1;
                    parent.parent.mittelinksoben.document.globals.schiffid.value=<?php echo $shid; ?>;
                    parent.parent.mittelinksoben.document.globals.schiffx.value=<?php echo $shipx; ?>;
                    parent.parent.mittelinksoben.document.globals.schiffy.value=<?php echo $shipy; ?>;
                    parent.parent.mittelinksoben.document.globals.masse.value=<?php echo $masse_gesamt; ?>;
                    parent.parent.mittelinksoben.document.globals.verbrauch.value=formularr.verbrauchf.value;
                    var ant=document.getElementById('modi');
                    ant.innerHTML='<?php echo $lang['flottealpha']['kursmodusaktiviert']; ?>';
                }
            }
        </script>
            <table border="0" cellspacing="0" cellpadding="1" width="100%">
                <tr>
                    <td colspan="12"><img src="../bilder/empty.gif" border="0" width="30" height="5"></td>
                </tr>
                <tr>
                    <td colspan="8" rowspan="2" width="100%">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><form name="formular" id="formular" method="post" action="flotte_alpha.php?fu=2&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                                <td><input type="checkbox" name="pathfind" value="1" onfocus="blur();rechnen();modicheck();"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><div id="modi"><?php echo $lang['flottealpha']['keinkursmodus']; ?></div></td>
                            </tr>
                        </table>
                    </td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td></td>
                    <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottealpha']['dauer']; ?></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td></td>
                    <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                    <td><nobr><div id="zeit"><?php echo $zeit; ?></div></nobr></td>
                </tr>
                <tr>
                    <td><a href="javascript:hilfe(16);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                    <td></td>
                    <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottealpha']['zielkoordinaten']; ?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td></td>
                    <td colspan="2" style="color:#aaaaaa;" width="100%"><?php echo $lang['flottealpha']['entfernung']; ?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td></td>
                    <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottealpha']['leminverbrauch']; ?></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="30" height="1"></td>
                    <td>
                        <input type="hidden" name="lemin" value="<?php echo $lemin; ?>">
                        <input type="hidden" name="masse_gesamt" value="<?php echo $masse_gesamt; ?>">
                        <input type="hidden" name="koxf" value="<?php echo $shipx; ?>">
                        <input type="hidden" name="koyf" value="<?php echo $shipy; ?>">
                        <input type="hidden" name="zielxf" value="<?php echo $zielx; ?>">
                        <input type="hidden" name="zielyf" value="<?php echo $ziely; ?>">
                    </td>
                    <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                    <td><nobr><div id="zielxy"><?php echo $zielxy; ?></div></nobr></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><input type="hidden" name="lichtjahref" value="<?php echo $lichtjahref; ?>"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                    <td width="100%"><div id="lichtjahre"><?php echo $lichtjahre; ?></div></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><input type="hidden" name="verbrauchf" value="<?php echo $verbrauchpromonat[$warp]; ?>"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                    <td><div id="verbrauch"><?php echo $verbrauch." ".$lang['flottealpha']['kt']; ?></div></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="30" height="1"></td>
                    <td></td>
                    <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottealpha']['zielbezeichnung']; ?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td></td>
                    <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottealpha']['geschwindigkeit']; ?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td></td>
                    <td colspan="2" style="color:#aaaaaa;">&nbsp;</td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="30" height="1"></td>
                    <td>
                        <input type="hidden" name="zielidf" value="<?php echo $zielid; ?>">
                        <input type="hidden" name="flug" value="<?php echo $flug; ?>">
                        <input type="hidden" name="benzin2" value="<?php if ($antrieb==6) { echo $fracht_min2; } else { echo "0";} ?>">
                    </td>
                    <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                    <td><nobr><div id="zielname"><?php echo $zielname; ?></div></nobr></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td></td>
                    <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                    <td>
                        <select name="warpfaktor" style="font-family:Verdana;font-size:9px;" onChange="rechnen();">
                            <option value=0 <?php if ($warpfaktor==0) { echo "selected"; } ?>>-</option>
                            <option value=1 <?php if ($warpfaktor==1) { echo "selected"; } ?>><?php echo str_replace('{1}','1',$lang['flottealpha']['warp'])?></option>
                            <?php
                            if ($antrieb>1) {
                                for($i=2;$i<10;$i++){
                                    ?>
                                    <option value=<?php
                                        echo $i." "; 
                                        if($antrieb<$i){
                                            echo "style='background-color:#aa0000'; ";
                                        } 
                                        if($warpfaktor==$i){
                                            echo "selected";
                                        }
                                        echo ">".str_replace('{1}',"$i",$lang['flottealpha']['warp']);
                                        ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td></td>
                    <td colspan="2"><input type="submit" value="<?php echo $lang['flottealpha']['auftragsichern']; ?>" style="width:100px;"></td>
                </tr>
            </table>
            </form>
            <?php
        }
    include ("inc.footer.php");
}
if ($fuid==2) {
    include ("inc.header.php");
    ?>
    <body text="#000000" scroll="no" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php
        $warpfaktor=int_post('warpfaktor');
        $flug=int_post('flug');
        $lemin=int_post('lemin');
        $zielxf=int_post('zielxf');
        $zielyf=int_post('zielyf');
        $koxf=int_post('koxf');
        $koyf=int_post('koyf');
        $zielidf=int_post('zielidf');
        $verbrauchf=int_post('verbrauchf');
        $benzin2=int_post('benzin2');
        $kursmodus=int_post('pathfind');
        if ($warpfaktor==0) {
            $flug=0;
            $warp=0;
            $zielx=0;
            $ziely=0;
            $zielid=0;
            $message=$lang['flottealpha']['warpo'];
        } else {
            if ($flug==0) {
                $warp=0;
                $zielx=0;
                $ziely=0;
                $zielid=0;
                $message=$lang['flottealpha']['auftraggesichert'];
            } else {
                $lichtjahre=sqrt(($koxf-$zielxf)*($koxf-$zielxf)+($koyf-$zielyf)*($koyf-$zielyf));
                $zeit=round(($lichtjahre / ($warpfaktor*$warpfaktor)) + 0.5);
                $verbrauch=round($lichtjahre*$verbrauchf*$masse_gesamt/100000);
                if ($verbrauch<$zeit) { $verbrauch=$zeit; }
                if ($verbrauchf==0) { $verbrauch=0; }
                $lemin=$lemin-$verbrauch+$benzin2;
                if ($lemin<0) {
                    $flug=0;
                    $warp=0;
                    $zielx=0;
                    $ziely=0;
                    $zielid=0;
                    $message=$lang['flottealpha']['verbrauchzuhoch'];
                } else {
                    $warp=$warpfaktor;
                    $zielx=$zielxf;
                    $ziely=$zielyf;
                    $message=$lang['flottealpha']['kursgesichert'];
                    if ($flug==1) {
                        $zielid=0;
                    } else {
                        $zielid=$zielidf;
                    }
                }
            }
        }
        //echo "update $skrupel_schiffe set flug=$flug,warp=$warp,zielx=$zielx,ziely=$ziely,zielid=$zielid where id=$shid and besitzer=$spieler";
        $zeiger = @mysql_query("update $skrupel_schiffe set flug=$flug,warp=$warp,plasmawarp=0,zielx=$zielx,ziely=$ziely,zielid=$zielid where id=$shid and besitzer=$spieler");
        $zeiger_temp = @mysql_query("UPDATE $skrupel_schiffe set routing_schritt=0,routing_status=0,routing_koord='',routing_id='',routing_mins='',routing_warp=0,routing_tank=0,routing_rohstoff=0 where id=$shid and besitzer=$spieler");
        //echo "update $skrupel_schiffe set flug=$flug,warp=$warp,zielx=$zielx,ziely=$ziely,zielid=$zielid,mission=$mission where id=$shid and besitzer=$spieler";
        ?>
        <br><br>
        <?php echo $message; ?>
        <script language=JavaScript>
            parent.parent.mittelinksoben.document.globals.kursmodus.value=0;
            <?php
            for ($k=1;$k<=20;$k++) {
                ?>
                parent.parent.mittemitte.document.getElementById("punkt<?php echo $k; ?>").style.visibility='hidden';
                <?php
            }
            ?>
            parent.parent.mittemitte.document.getElementById("auswahlrand").style.visibility='hidden';
            <?php
            if($kursmodus) {
                if ($flug==0) {
                    for ($k=1;$k<=20;$k++) {
                        ?>
                        parent.parent.mittemitte.document.getElementById("punkt_<?php echo $k; ?>_<?php echo $shid; ?>").style.left=0;
                        parent.parent.mittemitte.document.getElementById("punkt_<?php echo $k; ?>_<?php echo $shid; ?>").style.top=0;
                        parent.parent.mittemitte.document.getElementById("punkt_<?php echo $k; ?>_<?php echo $shid; ?>").style.visibility='hidden';
                          <?php
                    }
                    ?>
                    parent.parent.mittemitte.document.getElementById("auswahlrand_<?php echo $shid; ?>").style.visibility='hidden';
                    parent.ship.auftrag.style.color='#990000';
                    var ant=parent.ship.document.getElementById('auftrag');
                    ant.innerHTML='<?php echo $lang['flottealpha']['keinauftrag']; ?>';
                    <?php
                }elseif ($flug==1) {
                    for ($k=1;$k<=20;$k++) {
                        ?>
                        parent.parent.mittemitte.document.getElementById("punkt_<?php echo $k; ?>_<?php echo $shid; ?>").style.left=parent.parent.mittemitte.document.getElementById("punkt<?php echo $k; ?>").style.left;
                        parent.parent.mittemitte.document.getElementById("punkt_<?php echo $k; ?>_<?php echo $shid; ?>").style.top=parent.parent.mittemitte.document.getElementById("punkt<?php echo $k; ?>").style.top;
                        parent.parent.mittemitte.document.getElementById("punkt_<?php echo $k; ?>_<?php echo $shid; ?>").style.visibility='visible';
                        <?php
                    }
                    ?>
                    parent.parent.mittemitte.document.getElementById("auswahlrand_<?php echo $shid; ?>").style.visibility='hidden';
                    parent.ship.auftrag.style.color='#009900';
                    var ant=parent.ship.document.getElementById('auftrag');
                    ant.innerHTML='<?php echo str_replace('{1}',$zielx."/".$ziely,$lang['flottealpha']['unterwegsnach']); ?>';
                    <?php
                }elseif ($flug==2) {
                    for ($k=1;$k<=20;$k++) {
                        ?>
                        parent.parent.mittemitte.document.getElementById("punkt_<?php echo $k; ?>_<?php echo $shid; ?>").style.left=parent.parent.mittemitte.document.getElementById("punkt<?php echo $k; ?>").style.left;
                        parent.parent.mittemitte.document.getElementById("punkt_<?php echo $k; ?>_<?php echo $shid; ?>").style.top=parent.parent.mittemitte.document.getElementById("punkt<?php echo $k; ?>").style.top;
                        parent.parent.mittemitte.document.getElementById("punkt_<?php echo $k; ?>_<?php echo $shid; ?>").style.visibility='visible';
                        <?php
                    }
                    $zeiger_temp = @mysql_query("SELECT id,name FROM $skrupel_planeten where id=$zielid");
                    $array_temp = @mysql_fetch_array($zeiger_temp);
                    $planeten_name=$array_temp["name"];
                    ?>
                    parent.parent.mittemitte.document.getElementById("auswahlrand_<?php echo $shid; ?>").style.left=parent.parent.mittemitte.document.getElementById("auswahlrand").style.left;
                    parent.parent.mittemitte.document.getElementById("auswahlrand_<?php echo $shid; ?>").style.top=parent.parent.mittemitte.document.getElementById("auswahlrand").style.top;
                    parent.parent.mittemitte.document.getElementById("auswahlrand_<?php echo $shid; ?>").style.visibility='visible';
                    parent.ship.auftrag.style.color='#009900';
                    var ant=parent.ship.document.getElementById('auftrag');
                    ant.innerHTML='<?php echo str_replace('{1}',$planeten_name,$lang['flottealpha']['unterwegsnach']); ?>';
                    <?php
                }elseif ($flug==3) {
                    for ($k=1;$k<=20;$k++) {
                        ?>
                        parent.parent.mittemitte.document.getElementById("punkt_<?php echo $k; ?>_<?php echo $shid; ?>").style.left=parent.parent.mittemitte.document.getElementById("punkt<?php echo $k?>").style.left;
                        parent.parent.mittemitte.document.getElementById("punkt_<?php echo $k; ?>_<?php echo $shid; ?>").style.top=parent.parent.mittemitte.document.getElementById("punkt<?php echo $k?>").style.top;
                        parent.parent.mittemitte.document.getElementById("punkt_<?php echo $k; ?>_<?php echo $shid; ?>").style.visibility='visible';
                        <?php
                    }
                    ?>
                    parent.parent.mittemitte.document.getElementById("auswahlrand_<?php echo $shid; ?>").style.left=parent.parent.mittemitte.document.getElementById("auswahlrand").style.left;
                    parent.parent.mittemitte.document.getElementById("auswahlrand_<?php echo $shid; ?>").style.top=parent.parent.mittemitte.document.getElementById("auswahlrand").style.top;
                    parent.parent.mittemitte.document.getElementById("auswahlrand_<?php echo $shid; ?>").style.visibility='visible';
                    parent.ship.auftrag.style.color='#009900';
                    var ant=parent.ship.document.getElementById('auftrag');
                    ant.innerHTML='<?php echo $lang['flottealpha']['versuchterfeindkontakt']; ?>';
                    <?php
                }elseif ($flug==4) {
                    for ($k=1;$k<=20;$k++) {
                        ?>
                        parent.parent.mittemitte.document.getElementById("punkt_<?php echo $k; ?>_<?php echo $shid; ?>").style.left=parent.parent.mittemitte.document.getElementById("punkt<?php echo $k?>").style.left;
                        parent.parent.mittemitte.document.getElementById("punkt_<?php echo $k; ?>_<?php echo $shid; ?>").style.top=parent.parent.mittemitte.document.getElementById("punkt<?php echo $k?>").style.top;
                        parent.parent.mittemitte.document.getElementById("punkt_<?php echo $k; ?>_<?php echo $shid; ?>").style.visibility='visible';
                        <?php
                    }
                    ?>
                    parent.parent.mittemitte.document.getElementById("auswahlrand_<?php echo $shid; ?>").style.left=parent.parent.mittemitte.document.getElementById("auswahlrand").style.left;
                    parent.parent.mittemitte.document.getElementById("auswahlrand_<?php echo $shid; ?>").style.top=parent.parent.mittemitte.document.getElementById("auswahlrand").style.top;
                    parent.parent.mittemitte.document.getElementById("auswahlrand_<?php echo $shid; ?>").style.visibility='visible';
                    parent.ship.auftrag.style.color='#009900';
                    var ant=parent.ship.document.getElementById('auftrag');
                    ant.innerHTML='<?php echo $lang['flottealpha']['begleitschutz']; ?>';
                    <?php
                }
            }
            ?>
        </script>
        <?php
    include ("inc.footer.php");
}
if ($fuid==3) {
    include ("inc.header.php");
    include ("../lang/".$spieler_sprache."/lang.spionagen.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_schiffe where id=$shid and besitzer=$spieler");
    $array = @mysql_fetch_array($zeiger);
    $status=$array["status"];
    $kox=$array["kox"];
    $koy=$array["koy"];
    $masse=$array["masse"];
    $flug=$array["flug"];
    $erfahrung=$array["erfahrung"];
    $zeiger2 = @mysql_query("SELECT * FROM $skrupel_planeten where besitzer=$spieler and spiel=$spiel and x_pos=$kox and y_pos=$koy");
    $planeten_anzahl = @mysql_num_rows($zeiger2);
    $akademie=0;
    if($planeten_anzahl==1){
        $ok = @mysql_data_seek($zeiger2,0);
        $array2 = @mysql_fetch_array($zeiger2);
        $osys_1=$array2["osys_1"];
        $osys_2=$array2["osys_2"];
        $osys_3=$array2["osys_3"];
        $osys_4=$array2["osys_4"];
        $osys_5=$array2["osys_5"];
        $osys_6=$array2["osys_6"];
        $sternenbasis_art=$array2["sternenbasis_art"];
        if((($osys_1==16) or ($osys_2==16) or ($osys_3==16) or ($osys_4==16) or ($osys_5==16) or ($osys_6==16))and $masse<100 and $erfahrung<5 and $flug==0 and $sternenbasis_art==2){
            $akademie=1;
        }
    }
    $spezialmission=$array["spezialmission"];
    $fertigkeiten=$array["fertigkeiten"];
    for($j=1;$j<=strlen($fertigkeiten);$j++){
        if(($j<53) or($j>55)){
            if(@intval(substr($fertigkeiten,$j,1))!=0){
                $akademie=0;
            }
        }
    }
    $tarnfeld=$array["tarnfeld"];
    $scanner=$array["scanner"];
    $techlevel=$array["techlevel"];
    $zielid=$array["zielid"];
    $warp=$array["warp"];
    $antrieb=$array["antrieb"];
    $antrieb_anzahl=$array["antrieb_anzahl"];
    $traktor_id=$array["traktor_id"];
    $crew=$array["crew"];
    $crewmax=$array["crewmax"];
    $zusatzmodul=$array["zusatzmodul"];
    $energetik_anzahl=$array["energetik_anzahl"];
    $projektile_anzahl=$array["projektile_anzahl"];
    $projektile_stufe=$array["projektile_stufe"];
    $projektile=$array["projektile"];
    $hanger_anzahl=$array["hanger_anzahl"];
    $extra = @explode(":", $array['extra']);
    $subpartikel=@intval(substr($fertigkeiten,0,2));
    $terra_warm=@intval(substr($fertigkeiten,5,1));
    $terra_kalt=@intval(substr($fertigkeiten,6,1));
    $quark=@intval(substr($fertigkeiten,7,4));
    $sprungtriebwerk=@intval(substr($fertigkeiten,11,11));
    $tarnfeldgen=@intval(substr($fertigkeiten,22,1));
    $subraumver=@intval(substr($fertigkeiten,23,1));
    $scannerfert=@intval(substr($fertigkeiten,24,1));
    $sprungtorbau=@intval(substr($fertigkeiten,25,12));
    $fluchtmanoever=@intval(substr($fertigkeiten,38,2));
    $signaturmaske=@intval(substr($fertigkeiten,40,1));
    $viralmin=@intval(substr($fertigkeiten,41,2));
    $viralmax=@intval(substr($fertigkeiten,43,3));
    $erwtrans=@intval(substr($fertigkeiten,46,2));
    $cybern=@intval(substr($fertigkeiten,48,2));
    $destabil=@intval(substr($fertigkeiten,50,2));
    $overdrive_min=@intval(substr($fertigkeiten,53,1));
    $overdrive_max=@intval(substr($fertigkeiten,54,1));
    $luckyshot=@intval(substr($fertigkeiten,55,1));
    $hmatrix=@intval(substr($fertigkeiten,58,1));
    $wellengenerator=@intval(substr($fertigkeiten,60,1));
    $schilddaempfer=@intval(substr($fertigkeiten,61,1));
    if($array['volk'] == 'unknown' && $array['klasseid'] == 1) { $spionage_schiff = 1; } else { $spionage_schiff = 0; }
    if($module[0]) {
        $erfahrung = $array['erfahrung'];
        $extra_spio = @explode("-", $extra[0]);
        $spionage_id = $extra_spio[3];
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
        } else { $module[0] = 0; }
    }
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
        <center>
            <table border="0" cellspacing="0" cellpadding="1">
                <tr>
                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="4"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                    <td><center><?php echo $lang['flottealpha']['spezialmissionen']; ?></center></td>
                    <td><a href="javascript:hilfe(13);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                </tr>
            </table>
        </center>
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><form name="formular" id="formular"  method="post" action="flotte_alpha.php?fu=4&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                    <td><input type="radio" name="aktion" value="0" style="width:20px;" <?php if ($spezialmission==0) { echo "checked"; }?>></td>
                    <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                    <td><?php echo $lang['flottealpha']['keine']; ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="radio" name="aktion" value="1" style="width:20px;" <?php if ($spezialmission==1) { echo "checked"; }?>></td>
                    <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><?php echo $lang['flottealpha']['autorefuel']; ?></td>
                                <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                <td align='right';><a href="javascript:hilfe(18);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                            </tr>
                        </table>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="radio" name="aktion" value="2" style="width:20px;" <?php if ($spezialmission==2) { echo "checked"; }?>></td>
                    <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><?php echo $lang['flottealpha']['schiffrecycling']; ?></td>
                                <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                <td><a href="javascript:hilfe(20);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                            </tr>
                        </table>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                        <td><input type="radio" name="aktion" value="14" style="width:20px;" <?php if ($spezialmission==14) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td><table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><?php echo $lang['flottealpha']['schiffreparatur']; ?></td>
                                <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                <td><a href="javascript:hilfe(34);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                            </tr>
                        </table>
                    </td>
                    <td></td>
                </tr>
                <?php
                if (($terra_warm>=1) or ($terra_kalt>=1)) {
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="5" style="width:20px;" <?php if ($spezialmission==5) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['terraforming']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe(19);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if ($sprungtriebwerk>=1) {
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="7" style="width:20px;" <?php if ($spezialmission==7) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['sprungtriebwerk']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe(21);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if ($wellengenerator>=1) {
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="70" style="width:20px;" <?php if ($spezialmission==70) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['wellengenerator']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if ($schilddaempfer>=1) {
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="71" style="width:20px;" <?php if ($spezialmission==71) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['schilddaempfer']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if ($zusatzmodul==6) {
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="30" style="width:20px;" <?php if ($spezialmission==30) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['drugun']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if ($hmatrix>=1) {
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="29" style="width:20px;" <?php if ($spezialmission==29) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['hmatrix']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if ($zusatzmodul==7) {
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="15" style="width:20px;" <?php if ($spezialmission==15) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['selfdestruct']?> (<?php echo $lang['flottealpha']['stufe']; ?> <?php echo $techlevel; ?>)</td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe(39);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if (($tarnfeldgen==1)or($tarnfeldgen==2)or($tarnfeldgen==3)) {
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="8" style="width:20px;" <?php if ($spezialmission==8) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td <?php if ($tarnfeld>=1) { echo "style='color:#00aa00;'"; } ?>><?php echo $lang['flottealpha']['tarnfeldgenerator']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe(22);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if ($quark>=1) {
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="6" style="width:20px;" <?php if (($spezialmission==6) || ($spezialmission==26)) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['quarkreorganisator']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><input type="checkbox" name="betamodus" value="1" style="background-color:#444444;color:#444444;BORDER-BOTTOM-COLOR: #444444;BORDER-LEFT-COLOR: #444444;BORDER-RIGHT-COLOR: #444444;BORDER-TOP-COLOR: #444444;Border-Style: solid;Border-Width: 1px;" <?php if ($spezialmission==26) { echo "checked"; }?>></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><?php echo $lang['flottealpha']['auto']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe(23);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if ($cybern>=1) {
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="19" style="width:20px;" <?php if (($spezialmission==19) || ($spezialmission==28)) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['cybernrittnikk']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><input type="checkbox" name="betamodus" value="1" style="background-color:#444444;color:#444444;BORDER-BOTTOM-COLOR: #444444;BORDER-LEFT-COLOR: #444444;BORDER-RIGHT-COLOR: #444444;BORDER-TOP-COLOR: #444444;Border-Style: solid;Border-Width: 1px;" <?php if ($spezialmission==28) { echo "checked"; }?>></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><?php echo $lang['flottealpha']['auto']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if ($subpartikel>=1) {
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="4" style="width:20px;" <?php if (($spezialmission==4) || ($spezialmission==27)) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['subpartikelcluster']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><input type="checkbox" name="betamodus" value="1" style="background-color:#444444;color:#444444;BORDER-BOTTOM-COLOR: #444444;BORDER-LEFT-COLOR: #444444;BORDER-RIGHT-COLOR: #444444;BORDER-TOP-COLOR: #444444;Border-Style: solid;Border-Width: 1px;" <?php if ($spezialmission==27) { echo "checked"; }?>></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><?php echo $lang['flottealpha']['auto']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe(24);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if ($sprungtorbau>=1) {
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="13" style="width:20px;" <?php if ($spezialmission==13) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td><table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['sprungtorkon']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe(25);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                        </tr></table></td>
                        <td></td>
                    </tr>
                    <?php
                }
                if ($fluchtmanoever>=1){
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="16" style="width:20px;" <?php if ($spezialmission==16) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['lloydsfluchtmanoever']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if ($scannerfert==2) {
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="12" style="width:20px;" <?php if ($spezialmission==12) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td <?php if ($scanner==2) { echo "style='color:#00aa00;'"; } ?>><?php echo $lang['flottealpha']['astrophysischeslabor']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe(26);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if (($energetik_anzahl>=1) or ($projektile_anzahl>=1) or ($hanger_anzahl>=1)) {
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="22" style="width:20px;" <?php if ($spezialmission==22) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['kaperangriff']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if (($energetik_anzahl>=1) or ($projektile_anzahl>=1) or ($hanger_anzahl>=1)) {
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="3" style="width:20px;" <?php if ($spezialmission==3) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['planetenbombardement']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe(27);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if (($projektile_anzahl>=1) and ($module[2]) and ($projektile>=1)) {
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="24" style="width:20px;" <?php if ($spezialmission==24) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['minenfeldlegenmit']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="4" height="1"></td>
                                    <td>
                                        <select name="projektile">
                                            <?php
                                            for ($kli=1;$kli<=$projektile;$kli++) {
                                                ?>
                                                <option value="<?php echo $kli; ?>" <?php if ($kli==@intval($extra[2])) { echo 'selected'; } ?>><?php echo $kli; ?></option><?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><img src="../bilder/empty.gif" border="0" width="4" height="1"></td>
                                    <td><?php echo $lang['flottealpha']['projektilen']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if (($hanger_anzahl>=1) and ($module[2])) {
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="25" style="width:20px;" <?php if ($spezialmission==25) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['minenfeldraeumen']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if ($viralmin>=1) {
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="17" style="width:20px;" <?php if (($spezialmission==17) or ($spezialmission==18)) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['viraleinvasion']; ?> </td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td>
                                        <select name="viralziel" style="width:128px;">
                                            <option value="0" <?php if ($spezialmission==17) { echo "selected";} ?>><?php echo $lang['flottealpha']['kolonisten']; ?></option>
                                            <option value="1" <?php if ($spezialmission==18) { echo "selected";} ?>><?php echo $lang['flottealpha']['dominatespezies']; ?></option>
                                        </select>
                                    </td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if ($scannerfert==1) {
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="11" style="width:20px;" <?php if ($spezialmission==11) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td <?php if ($scanner==1) { echo "style='color:#00aa00;'"; } ?>><?php echo $lang['flottealpha']['erweitertesensorenphalanx']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe(28);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if ($subraumver>=1) {
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="9" style="width:20px;" <?php if (($spezialmission==9) or ($spezialmission==10)) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td><table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['subraumverzerrer']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><input type="checkbox" name="betamodus" value="1" style="background-color:#444444;color:#444444;BORDER-BOTTOM-COLOR: #444444;BORDER-LEFT-COLOR: #444444;BORDER-RIGHT-COLOR: #444444;BORDER-TOP-COLOR: #444444;Border-Style: solid;Border-Width: 1px;" <?php if ($spezialmission==10) { echo "checked"; }?>></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><?php echo $lang['flottealpha']['betamodus']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe(29);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                        </tr></table></td>
                        <td></td>
                    </tr>
                    <?php
                }
                if ($signaturmaske==1) {
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="40" style="width:20px;" <?php if (($spezialmission>=41) and ($spezialmission<=50)) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['signaturmaskierung']; ?> </td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td>
                                        <select name="spielerfarbe" style="width:40px;">
                                            <?php
                                            for ($i=1; $i<=10;$i++) {
                                                ?>
                                                <option value="<?php echo $i; ?>" style="background-color:<?php echo $spielerfarbe[$i]; ?>;" <?php if ($spezialmission==40+$i) { echo "selected";} ?>>&nbsp;</option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if ($destabil>=1) { ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="20" style="width:20px;" <?php if ($spezialmission==20) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['destabilisator']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if ($overdrive_max>=1) {
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="61" style="width:20px;" <?php if (($spezialmission>=61) and ($spezialmission<=69)) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['overdrive']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="6" height="1"></td>
                                    <td>
                                        <select name="overdrive">
                                            <?php
                                            for ($kli=$overdrive_min;$kli<=$overdrive_max;$kli++) {
                                                ?>
                                                <option value="<?php echo 60+$kli; ?>" <?php if (($spezialmission-60)==$kli) { echo 'selected'; } ?>><?php echo $kli*10; ?> %</option><?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><img src="../bilder/empty.gif" border="0" width="6" height="1"></td>
                                    <td><?php echo $lang['flottealpha']['effektivitaet']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if ($crew<$crewmax) { ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="23" style="width:20px;" <?php if ($spezialmission==23) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['crewmenanheuern']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="7" height="1"></td>
                                    <td>
                                        <select name="crewmen">
                                        <?php
                                            for ($kli=$crewmax-$crew;$kli>=1;$kli--) {
                                                ?>
                                                <option value="<?php echo $kli; ?>" <?php if ($kli==@intval($extra[1])) { echo 'selected'; } ?>><?php echo $kli; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if($akademie==1){
                    if($spezialmission>71 and $spezialmission<77){
                        $value=min(76,$spezialmission);
                    }else{
                        $value=76;
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value=<?php echo $value; ?> style="width:20px;" <?php if ($spezialmission>71 and $spezialmission<77) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['ausbildung']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if (($antrieb>=3) and ($antrieb<=7)) {
                    $maxmasse=$antrieb*$antrieb_anzahl*20;
                    $schiffanzahl=0;
                    $zeiger_2 = @mysql_query("SELECT kox,koy,id,spiel,masse,besitzer,name,id FROM $skrupel_schiffe where id<>$shid and kox=$kox and koy=$koy and masse<=$maxmasse and besitzer=$spieler and spiel=$spiel");
                    $schiffanzahl = @mysql_num_rows($zeiger_2);
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="21" style="width:20px;" <?php if ($spezialmission==21) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['traktorstrahl']; ?> </td>
                                    <td><img src="../bilder/empty.gif" border="0" width="6" height="1"></td>
                                    <td>
                                        <select name="traktor_id" style="width:178px;">
                                            <?php
                                            if ($schiffanzahl>=1) {
                                                ?>
                                                <option value="0"><?php echo $lang['flottealpha']['bitteaufzielausrichten']; ?></option>
                                                <?php
                                                for  ($iz=0; $iz<$schiffanzahl;$iz++) {
                                                    $ok_2 = @mysql_data_seek($zeiger_2,$iz);
                                                    $array_2 = @mysql_fetch_array($zeiger_2);
                                                    $shid_2=$array_2["id"];
                                                    $shidname_2=$array_2["name"];
                                                    ?>
                                                    <option value="<?php echo $shid_2; ?>"  <?php if (($traktor_id==$shid_2) and ($spezialmission==21)) { echo "selected";} ?>><?php echo $shidname_2; ?></option>
                                                    <?php
                                                }
                                            } else { 
                                                ?>
                                                <option value="0"><?php echo $lang['flottealpha']['keinzielvorhanden']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe(40);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if ($module[0] && $spionage_schiff) {
                    ?>
                    <tr>
                        <td>
                            <script language=JavaScript>
                                function hilfe_spionage_missionen() {
                                    oben=100;
                                    var spid=document.formular.spionage_id.value;
                                    links=Math.ceil((screen.width-480)/2);
                                    window.open('hilfe_spionage.php?fu2=3&spid='+spid+'&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>','Hilfe','resizable=yes,scrollbars=no,width=480,height=200,top='+oben+',left='+links);
                                }
                            </script>
                        </td>
                        <td><input type="radio" name="aktion" value="51" style="width:20px;" <?php if ($spezialmission == 51) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['spionage']; ?> </td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td>
                                        <select name="spionage_id" style="width:200px;">
                                            <?php
                                            $levels = array();
                                            foreach($spionage_daten as $spio_id=>$daten) { $levels[$spio_id] = $daten['level']; }
                                            @asort($levels);
                                            foreach($levels as $spio_id=>$level) {
                                                if($erfahrung >= $level) {
                                                    ?>
                                                    <option value="<?php echo $spio_id;?>" <?php if ($spio_id==$spionage_id) { echo "selected";} ?>><?php echo $lang['spionagen'][$spio_id]['name'];?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        </td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe_spionage_missionen();"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                $zeiger = @mysql_query("SELECT * FROM $skrupel_politik where (partei_a=$spieler or partei_b=$spieler) and status=5 and spiel=$spiel");
                $allianzahl = @mysql_num_rows($zeiger);
                if (!$spionage_schiff && $allianzahl>=1) {
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="radio" name="aktion" value="30" style="width:20px;" <?php if (($spezialmission>=31) and ($spezialmission<=40)) { echo "checked"; }?>></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><?php echo $lang['flottealpha']['schiffuebergebenan']; ?> </td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td>
                                        <select name="spielerid" style="width:140px;">
                                            <?php
                                            for  ($i=0; $i<$allianzahl;$i++) {
                                                $ok = @mysql_data_seek($zeiger,$i);
                                                $array = @mysql_fetch_array($zeiger);
                                                $partei_a=$array["partei_a"];
                                                $partei_b=$array["partei_b"];
                                                if ($partei_a==$spieler) {
                                                    if ($partei_b==1) {$partei_b_id=$spieler_1;
                                                    }elseif ($partei_b==2) {$partei_b_id=$spieler_2;
                                                    }elseif ($partei_b==3) {$partei_b_id=$spieler_3;
                                                    }elseif ($partei_b==4) {$partei_b_id=$spieler_4;
                                                    }elseif ($partei_b==5) {$partei_b_id=$spieler_5;
                                                    }elseif ($partei_b==6) {$partei_b_id=$spieler_6;
                                                    }elseif ($partei_b==7) {$partei_b_id=$spieler_7;
                                                    }elseif ($partei_b==8) {$partei_b_id=$spieler_8;
                                                    }elseif ($partei_b==9) {$partei_b_id=$spieler_9;
                                                    }elseif ($partei_b==10) {$partei_b_id=$spieler_10;}
                                                    $zeiger2 = @mysql_query("SELECT * FROM $skrupel_user where id=$partei_b_id");
                                                    $array2 = @mysql_fetch_array($zeiger2);
                                                    $nick=$array2["nick"];
                                                    ?>
                                                    <option value="<?php echo $partei_b; ?>" style="background-color:<?php echo $spielerfarbe[$partei_b]; ?>;" <?php if ($spezialmission==30+$partei_b) { echo "selected";} ?>><?php echo $nick; ?></option>
                                                    <?php
                                                } else {
                                                    if ($partei_a==1) {$partei_a_id=$spieler_1;
                                                    }elseif ($partei_a==2) {$partei_a_id=$spieler_2;
                                                    }elseif ($partei_a==3) {$partei_a_id=$spieler_3;
                                                    }elseif ($partei_a==4) {$partei_a_id=$spieler_4;
                                                    }elseif ($partei_a==5) {$partei_a_id=$spieler_5;
                                                    }elseif ($partei_a==6) {$partei_a_id=$spieler_6;
                                                    }elseif ($partei_a==7) {$partei_a_id=$spieler_7;
                                                    }elseif ($partei_a==8) {$partei_a_id=$spieler_8;
                                                    }elseif ($partei_a==9) {$partei_a_id=$spieler_9;
                                                    }elseif ($partei_a==10) {$partei_a_id=$spieler_10;}
                                                    $zeiger2 = @mysql_query("SELECT * FROM $skrupel_user where id=$partei_a_id");
                                                    $array2 = @mysql_fetch_array($zeiger2);
                                                    $nick=$array2["nick"];
                                                    ?>
                                                    <option value="<?php echo $partei_a; ?>" style="background-color:<?php echo $spielerfarbe[$partei_a]; ?>;" <?php if ($spezialmission==30+$partei_a) { echo "selected";} ?>><?php echo $nick; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                    <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                if ($antrieb>=1) {
                    $zeiger2 = @mysql_query("SELECT id,spiel,name FROM $skrupel_schiffe where id<>$shid and spiel=$spiel and besitzer=$spieler order by name");
                    $schiffanzahl2 = @mysql_num_rows($zeiger2);
                    if ($schiffanzahl2>=1) {
                        ?>
                        <tr>
                            <td></td>
                            <td><input type="checkbox" name="begleitschutz" value="1" style="width:20px;" <?php if ($flug==4) { echo "checked"; }?>></td>
                            <td><img src="../bilder/empty.gif" border="0" width="3" height="3"></td>
                            <td>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td><?php echo $lang['flottealpha']['begleitschutz']; ?></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="4" height="1"></td>
                                        <td>
                                            <select name="schiff_id" style="width:112px;">
                                                <?php
                                                for  ($iii=0; $iii<$schiffanzahl2;$iii++) {
                                                    $ok2 = @mysql_data_seek($zeiger2,$iii);
                                                    $array2 = @mysql_fetch_array($zeiger2);
                                                    $schiff_id=$array2["id"];
                                                    $schiff_name=$array2["name"];
                                                    ?>
                                                    <option value="<?php echo $schiff_id; ?>" <?php if (($flug==4) and ($zielid==$schiff_id)) { echo "selected";} ?>><?php echo $schiff_name; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="warpfaktor">
                                                <?php
                                                for($i=1;$i<10;$i++){
                                                    ?>
                                                    <option value=<?php
                                                        echo $i." "; 
                                                        if($antrieb<$i){
                                                            echo "style='background-color:#aa0000'; ";
                                                        } 
                                                        if(($warp==$i) and ($flug==4)){
                                                            echo "selected";
                                                        }
                                                        echo ">".str_replace('{1}',"$i",$lang['flottealpha']['warp']);
                                                    ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                                        <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                    </tr>
                                </table>
                            </td>
                            <td></td>
                        </tr>
                        <?php
                    }
                }
                ?>
                <tr>
                    <td></td>
                    <td colspan="3"><input type="submit" name="bla" value="<?php echo $lang['flottealpha']['spezmissakt']?>" style="width:300px;"></td>
                    <td></form></td>
                </tr>
                <tr>
                    <td colspan="5"><img src="../bilder/empty.gif" border="0" width="1" height="4"></td>
                </tr>
            </table>
        </center>
        </div>
        <?php
    include ("inc.footer.php");
}
if ($fuid==4) {
    include ("inc.header.php");
    ?>
    <body text="#000000" scroll="no" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php
        $begleitschutz=int_post('begleitschutz');
        $crewmen=int_post('crewmen');
        $projektile=int_post('projektile');
        $zeiger = @mysql_query("SELECT id,kox,koy,flug,zielid,warp FROM $skrupel_schiffe where id=$shid");
        $array = @mysql_fetch_array($zeiger);
        $kox=$array["kox"];
        $koy=$array["koy"];
        $flugalt=$array["flug"];
        $zielalt=$array["zielid"];
        $warpalt=$array["warp"];
        $spezialmission=int_post('aktion');
        $betamodus=int_post('betamodus');
        $viralziel=int_post('viralziel');
        if ($spezialmission==0) {
            $message=$lang['flottealpha']['speznachricht'][0];
        } elseif ($spezialmission==1) {
            $message=$lang['flottealpha']['speznachricht'][1];
        } elseif ($spezialmission==2) {
            $message=$lang['flottealpha']['speznachricht'][2];
        } elseif ($spezialmission==3) { 
            $message=$lang['flottealpha']['speznachricht'][3];
        } elseif (($spezialmission==4) and ($betamodus<>1)) { 
            $message=$lang['flottealpha']['speznachricht'][4];
        } elseif (($spezialmission==4) and ($betamodus==1)) {
            $spezialmission=27;
            $message=$lang['flottealpha']['speznachricht'][27];
        } elseif ($spezialmission==5) {
            $message=$lang['flottealpha']['speznachricht'][5];
        } elseif (($spezialmission==6) and ($betamodus<>1)) {
            $message=$lang['flottealpha']['speznachricht'][6];
        } elseif (($spezialmission==6) and ($betamodus==1)) {
            $spezialmission=26;
            $message=$lang['flottealpha']['speznachricht'][26];
        } elseif ($spezialmission==7) {
            $message=$lang['flottealpha']['speznachricht'][7]; 
        } elseif ($spezialmission==8) { 
            $message=$lang['flottealpha']['speznachricht'][8]; 
        } elseif (($spezialmission==9) and ($betamodus<>1)) {
            $message=$lang['flottealpha']['speznachricht'][9];
        } elseif (($spezialmission==9) and ($betamodus==1)) { 
            $spezialmission=10;
            $message=$lang['flottealpha']['speznachricht'][10];
        } elseif ($spezialmission==11) {
            $message=$lang['flottealpha']['speznachricht'][11];
        } elseif ($spezialmission==12) {
            $message=$lang['flottealpha']['speznachricht'][12];
        } elseif ($spezialmission==13) {
            $message=$lang['flottealpha']['speznachricht'][13];
        } elseif ($spezialmission==14) {
            $message=$lang['flottealpha']['speznachricht'][14];
        } elseif ($spezialmission==15) {
            $message=$lang['flottealpha']['speznachricht'][15];
        } elseif ($spezialmission==16) {
            $message=$lang['flottealpha']['speznachricht'][16];
        } elseif (($spezialmission==17) and ($viralziel<>1)) { 
            $message=$lang['flottealpha']['speznachricht'][17];
        } elseif (($spezialmission==17) and ($viralziel==1)) {
            $spezialmission=18;
            $message=$lang['flottealpha']['speznachricht'][18];
        } elseif (($spezialmission==19) and ($betamodus<>1)) {
            $message=$lang['flottealpha']['speznachricht'][19];
        } elseif (($spezialmission==19) and ($betamodus==1)) {
            $spezialmission=28;
            $message=$lang['flottealpha']['speznachricht'][28];
        } elseif ($spezialmission==20) {
            $message=$lang['flottealpha']['speznachricht'][20];
        } elseif ($spezialmission==21) {
            $traktor_id=int_post('traktor_id');
            if ($traktor_id>=1) {
                $message=$lang['flottealpha']['speznachricht'][21]['t'];
                $zeiger = @mysql_query("UPDATE $skrupel_schiffe set traktor_id=".$traktor_id." where id=$shid");
            } else {
                $spezialmission=0;
                $message=$lang['flottealpha']['speznachricht'][21]['f'];
            }
        } elseif ($spezialmission==22) {
            $message=$lang['flottealpha']['speznachricht'][22];
        } elseif ($spezialmission==23) {
            $zeiger_extra = @mysql_query("SELECT extra FROM $skrupel_schiffe where besitzer=$spieler and id=$shid");
            if(@mysql_num_rows($zeiger_extra) == 1) {
                $ex_extra = @mysql_fetch_array($zeiger_extra);
                $extra = @explode(":", $ex_extra['extra']);
                $extra[1] = $crewmen;
                $extra_neu = @implode(":", $extra);
                $zeiger_extra_temp = @mysql_query("UPDATE $skrupel_schiffe set extra='$extra_neu' where id=$shid");
            }
            $message=$lang['flottealpha']['speznachricht'][23];
        } elseif ($spezialmission==24) {
            $zeiger_extra = @mysql_query("SELECT extra FROM $skrupel_schiffe where besitzer=$spieler and id=$shid");
            if(@mysql_num_rows($zeiger_extra) == 1) {
                $ex_extra = @mysql_fetch_array($zeiger_extra);
                $extra = @explode(":", $ex_extra['extra']);
                if (strlen($extra[0])==0)  { $extra[0]=''; }
                if (strlen($extra[1])==0)  { $extra[1]=''; }
                $extra[2] = $projektile;
                $extra_neu = @implode(":", $extra);
                $zeiger_extra_temp = @mysql_query("UPDATE $skrupel_schiffe set extra='$extra_neu' where id=$shid");
            }
            $message=$lang['flottealpha']['speznachricht'][24];
        } elseif ($spezialmission==25) {
            $message=$lang['flottealpha']['speznachricht'][25];
        } elseif ($spezialmission==29) {
            $message=$lang['flottealpha']['speznachricht'][29];
        } elseif ($spezialmission==30) { 
            $spezialmission=30+int_post('spielerid');                //31-40
            if ($spezialmission==30){
                $message=$lang['flottealpha']['speznachricht'][30];
            }else{
                $message=str_replace('{1}',$spielerfarbe[int_post('spielerid')],$lang['flottealpha']['speznachricht'][31]);
            }
        } elseif ($spezialmission==40) { 
            $spezialmission=40+int_post('spielerfarbe');            //41-50
            $message=str_replace('{1}',$spielerfarbe[int_post('spielerfarbe')],$lang['flottealpha']['speznachricht'][41]);
        } elseif ($module[0] and $spezialmission == 51) {
            $zeiger_spionage = @mysql_query("SELECT extra FROM $skrupel_schiffe where besitzer=$spieler and id=$shid and volk='unknown' and klasseid=1");
            if(@mysql_num_rows($zeiger_spionage) == 1) {
                $spionage = @mysql_fetch_array($zeiger_spionage);
                $extra = @explode(":", $spionage['extra']);
                $extra_spio = @explode("-", $extra[0]);
                $extra_spio[3] = int_post('spionage_id');
                $extra[0] = @implode("-", $extra_spio);
                $extra_neu = @implode(":", $extra);
                $zeiger_spionage_temp = @mysql_query("UPDATE $skrupel_schiffe set extra='$extra_neu' where id=$shid");
            }
            $message = $lang['flottealpha']['speznachricht'][51];
        } elseif ($spezialmission==61) {
            $spezialmission=int_post('overdrive');
            $message=$lang['flottealpha']['speznachricht'][61];
        } elseif ($spezialmission==70) {
            $message=$lang['flottealpha']['speznachricht'][70];
        } elseif ($spezialmission==71) {
            $message=$lang['flottealpha']['speznachricht'][71];
        } elseif ($spezialmission>71 and $spezialmission<77) {
            $zeiger = @mysql_query("SELECT * FROM $skrupel_schiffe where besitzer=$spieler and id=$shid");
            $array = @mysql_fetch_array($zeiger);
            $masse=$array["masse"];
            $flug=$array["flug"];
            $fertigkeiten=$array["fertigkeiten"];
            $schalter=0;
            for($j=1;$j<=strlen($fertigkeiten);$j++){
                if(($j<53) or($j>55)){
                    if(@intval(substr($fertigkeiten,$j,1))!=0){
                        $schalter=1;
                    }
                }
            }
            if ($spezialmission==72){
                $message=$lang['flottealpha']['speznachricht'][72];
            } elseif ($spezialmission>72 and $spezialmission<77){
                $message=str_replace('{1}',$spezialmission-71,$lang['flottealpha']['speznachricht'][73]);
            }
            if(($schalter==1) or ($masse>=100) or ($flug!=0)){
                $spezialmission=0;
                $lang['flottealpha']['speznachricht'][74];
            }
        }
        $zeiger = @mysql_query("UPDATE $skrupel_schiffe set spezialmission=".$spezialmission." where id=$shid");
        $zielid=int_post('schiff_id');
        $warp=int_post('warpfaktor');
        if (($begleitschutz==1) and (($flugalt!=4) or ($zielalt!=$zielid) or ($warpalt!=$warp))) {
            $flug=4;
            $zeiger = @mysql_query("SELECT id,kox,koy,name FROM $skrupel_schiffe where id=$zielid");
            $array = @mysql_fetch_array($zeiger);
            $zielx=$array["kox"];
            $ziely=$array["koy"];
            $name=$array["name"];
            $message=$message.str_replace('{1}',$name,$lang['flottealpha']['begleitschutzaktiviert']);
            $zeiger = @mysql_query("update $skrupel_schiffe set flug=$flug,warp=$warp,plasmawarp=0,zielx=$zielx,ziely=$ziely,zielid=$zielid where id=$shid and besitzer=$spieler");
            $zeiger_temp = @mysql_query("UPDATE $skrupel_schiffe set routing_schritt=0,routing_status=0,routing_koord='',routing_id='',routing_mins='',routing_warp=0,routing_tank=0,routing_rohstoff=0 where id=$shid and besitzer=$spieler");
        } else {
            if (($flugalt==4) and ($begleitschutz!=1)) {
                $zeiger = @mysql_query("update $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where id=$shid and besitzer=$spieler");
            }
            echo "<br>";
        }
        ?>
        <br><br><br>
        <center><?php echo $message; ?></center>
        <script language=JavaScript>
            <?php
            if (($begleitschutz==1) and (($flugalt!=4) or ($zielalt!=$zielid) or ($warpalt!=$warp))) {
                if (($kox==$zielx) and ($koy==$ziely)) {
                    for ($k=1;$k<=20;$k++) {
                        ?>
                        parent.parent.mittemitte.document.getElementById('punkt_<?php echo $k; ?>_<?php echo $shid; ?>').style.left=0;
                        parent.parent.mittemitte.document.getElementById('punkt_<?php echo $k; ?>_<?php echo $shid; ?>').style.top=0;
                        parent.parent.mittemitte.document.getElementById('punkt_<?php echo $k; ?>_<?php echo $shid; ?>').style.visibility='hidden';
                        <?php
                    }
                    ?>
                    parent.parent.mittemitte.document.getElementById('auswahlrand_<?php echo $shid; ?>').style.left=0;
                    parent.parent.mittemitte.document.getElementById('auswahlrand_<?php echo $shid; ?>').style.top=0;
                    parent.parent.mittemitte.document.getElementById('auswahlrand_<?php echo $shid; ?>').style.visibility='hidden';
                    <?php
                } else {
                    $schrittx=($zielx-$kox)/20;
                    $schritty=($ziely-$koy)/20;
                    $laufx=$kox;
                    $laufy=$koy;
                    for ($k=1;$k<=20;$k++) {
                        $laufx=$laufx+$schrittx;
                        $laufy=$laufy+$schritty;
                        echo "parent.parent.mittemitte.document.getElementById('punkt_".$k."_".$shid."').style.left=".$laufx.";";
                        echo "parent.parent.mittemitte.document.getElementById('punkt_".$k."_".$shid."').style.top=".$laufy.";";
                        echo "parent.parent.mittemitte.document.getElementById('punkt_".$k."_".$shid."').style.visibility='visible';";
                    }
                    ?>
                    parent.parent.mittemitte.document.getElementById('auswahlrand_<?php echo $shid; ?>').style.left=<?php echo $zielx-8; ?>;
                    parent.parent.mittemitte.document.getElementById('auswahlrand_<?php echo $shid; ?>').style.top=<?php echo $ziely-8; ?>;
                    parent.parent.mittemitte.document.getElementById('auswahlrand_<?php echo $shid; ?>').style.visibility='visible';
                    <?php
                }
                ?>
                parent.ship.auftrag.style.color='#009900';
                var ant=parent.ship.document.getElementById('auftrag');
                ant.innerHTML='<?php echo $lang['flottealpha']['begleitschutz']; ?>';
                <?php
            } else if (($flugalt==4) and ($begleitschutz!=1)) {
                for ($k=1;$k<=20;$k++) { ?>
                    parent.parent.mittemitte.document.getElementById('punkt_<?php echo $k; ?>_<?php echo $shid; ?>').style.left=0;
                    parent.parent.mittemitte.document.getElementById('punkt_<?php echo $k; ?>_<?php echo $shid; ?>').style.top=0;
                    parent.parent.mittemitte.document.getElementById('punkt_<?php echo $k; ?>_<?php echo $shid; ?>').style.visibility='hidden';
                    <?php
                }
                ?>
                parent.parent.mittemitte.document.getElementById('auswahlrand_<?php echo $shid; ?>').style.left=0;
                parent.parent.mittemitte.document.getElementById('auswahlrand_<?php echo $shid; ?>').style.top=0;
                parent.parent.mittemitte.document.getElementById('auswahlrand_<?php echo $shid; ?>').style.visibility='hidden';
                parent.ship.auftrag.style.color='#990000';
                var ant=parent.ship.document.getElementById('auftrag');
                ant.innerHTML='<?php echo $lang['flottealpha']['keinauftrag']; ?>';
                <?php
            }
            ?>
        </script>
        <?php
    include ("inc.footer.php");
}
if ($fuid==5) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT id,routing_status,status,kox,koy FROM $skrupel_schiffe where id=$shid");
    $array = @mysql_fetch_array($zeiger);
    $routing_status=$array["routing_status"];
    if ($routing_status==0) { $msg=$lang['flottealpha']['keineroute']; }
    if ($routing_status==1) { $msg=$lang['flottealpha']['aufbauroute']; }
    if ($routing_status==2) { $msg=$lang['flottealpha']['routevorhanden']; }
    ?>
    <body text="#000000" background="<?php echo $bildpfad; ?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0"">
        <center>
            <table border="0" cellspacing="0" cellpadding="1">
                <tr>
                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="4"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                    <td><center><?php echo $lang['flottealpha']['routing']; ?></center></td>
                    <td><a href="javascript:hilfe(30);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                </tr>
            </table>
        </center>
        <br><br>
        <center><?php echo $msg; ?></center>
        <br>
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <form name="formular"  id="formular"  method="post" action="flotte_alpha.php?fu=6&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                        <input type="hidden" value="<?php echo $lang['flottealpha']['fracht']; ?>" name="wechsel">
                    </td>
                    <td><input type="submit" value="<?php echo $lang['flottealpha']['neueroute']; ?>"  name="submitbutton"><?php if($routing_status>0){?><input type="submit" value="<?php echo $lang['flottealpha']['routebearbeiten']; ?>"  name="submitbutton"><?php }?></td>
                    <td></form></td>
                </tr>
            </table>
        </center>
        <?php 
    include ("inc.footer.php");
}
if ($fuid==6) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_schiffe where id=$shid");
    $array = @mysql_fetch_array($zeiger);
    $kox=$array["kox"];
    $koy=$array["koy"];
    $pid_a=-1;
    $cantox_a=0;
    $vorrat_a=0;
    $lem_a=0;
    $bax_a=0;
    $ren_a=0;
    $vor_a=0;
    $vol_a=0;
    $kol_a=0;
    $lbt_a=0;
    $sbt_a=0;
    $point=0;
    $points=1;
    $routing_mins="";
    $routing_id="";
    $routing_koord="";
    if(urldecode(str_post('submitbutton','DEFAULT')) == utf8_encode(html_entity_decode($lang['flottealpha']['uebernehmen']))){
        for($i=0;$i<int_post('points');$i++){
            if(int_post('pid_'.$i)!=-1){
                $routing_mins=$routing_mins.int_post('cantox_'.$i).int_post('vorrat_'.$i).int_post('lem_'.$i).int_post('bax_'.$i).int_post('ren_'.$i).int_post('vor_'.$i).int_post('vol_'.$i);
                $temp_1=int_post('kol_'.$i);
                for($j=1000000;$j>=1;$j=$j/10){
                    $temp_2=(int)($temp_1/$j);
                    $temp_1=$temp_1-($temp_2*$j);
                    $routing_mins=$routing_mins.$temp_2;
                }
                $temp_1=int_post('lbt_'.$i);
                for($j=1000;$j>=1;$j=$j/10){
                    $temp_2=(int)($temp_1/$j);
                    $temp_1=$temp_1-($temp_2*$j);
                    $routing_mins=$routing_mins.$temp_2;
                }
                $temp_1=int_post('sbt_'.$i);
                for($j=1000;$j>=1;$j=$j/10){
                    $temp_2=(int)($temp_1/$j);
                    $temp_1=$temp_1-($temp_2*$j);
                    $routing_mins=$routing_mins.$temp_2;
                }
                $routing_mins=$routing_mins.":";
                $pid_a=int_post('pid_'.$i);
                $zeiger = @mysql_query("SELECT x_pos,y_pos FROM $skrupel_planeten where besitzer=$spieler and id=$pid_a and spiel=$spiel order by name");
                $ok = @mysql_data_seek($zeiger,0);
                $array = @mysql_fetch_array($zeiger);
                $x_pos=$array["x_pos"];
                $y_pos=$array["y_pos"];
                if($i==0){
                    $zielx=$array["x_pos"];
                    $ziely=$array["y_pos"];
                    $flug=(($zielx==$kox)and($ziely==$koy))?0:2;
                    $zielid=int_post('pid_'.$i);
                }
                $routing_id=$routing_id.int_post('pid_'.$i).":";
                $routing_koord=$routing_koord.$x_pos.":".$y_pos."::";
            }
        }
        ?>
        <body text="#000000" background="<?php echo $bildpfad; ?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0"">
        <form name="formular" id="formular"  method="post" action="flotte_alpha.php?fu=7&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>">
            <center><table border="0" cellspacing="0" cellpadding="5">
                <tr><td colspan="5"><img src="../bilder/empty.gif" border="0" width="1" height="5"></td></tr>
                <tr><td></td></tr>
                <tr><td></td></tr>
                <tr><td></td></tr>
                <tr>
                    <td>
                        <input type="hidden" name="kox" value=<?php echo $kox; ?>>
                        <input type="hidden" name="koy" value=<?php echo $koy; ?>>
                        <input type="hidden" name="zielx" value=<?php echo $zielx; ?>>
                        <input type="hidden" name="ziely" value=<?php echo $ziely; ?>>
                        <input type="hidden" name="zielid" value=<?php echo $zielid; ?>>
                        <input type="hidden" name="flug" value=<?php echo $flug; ?>>
                        <input type="hidden" name="routing_mins" value=<?php echo $routing_mins; ?>>
                        <input type="hidden" name="routing_koord" value=<?php echo $routing_koord; ?>>
                        <input type="hidden" name="routing_id" value=<?php echo $routing_id; ?>>
                        <input type="submit" value="<?php echo $lang['flottealpha']['routeabschliessen']; ?>" name="submitbutton">
                    </td>
                </tr>
        </form>
        <?php
    }else{ 
        ?>
        <body text="#000000" background="<?php echo $bildpfad; ?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <form name="formular" id="formular"  method="post" action="flotte_alpha.php?fu=6&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>">
            <center><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
                </tr>
                <tr>
                    <?php    
                    if(str_post('submitbutton','DEFAULT')==$lang['flottealpha']['neueroute']){
                        ?>
                        <input type="hidden" name="pid_0" value=-1>
                        <input type="hidden" name="cantox_0" value=0>
                        <input type="hidden" name="vorrat_0" value=0>
                        <input type="hidden" name="lem_0" value=0>
                        <input type="hidden" name="bax_0" value=0>
                        <input type="hidden" name="ren_0" value=0>
                        <input type="hidden" name="vor_0" value=0>
                        <input type="hidden" name="vol_0" value=0>
                        <input type="hidden" name="kol_0" value=0>
                        <input type="hidden" name="lbt_0" value=0>
                        <input type="hidden" name="sbt_0" value=0>
                        <?php
                    }elseif(str_post('submitbutton','DEFAULT')==$lang['flottealpha']['routebearbeiten']){
                        $zeiger = @mysql_query("SELECT * FROM $skrupel_schiffe where id=$shid");
                        $array = @mysql_fetch_array($zeiger);
                        $routing_id_t=$array["routing_id"];
                        $routing_schritt=$array["routing_schritt"];
                        $routing_status=$array["routing_status"];
                        $routing_warp=$array["routing_warp"];
                        $routing_mins_t=$array["routing_mins"];
                        $routing_mins=explode(":",$routing_mins_t);
                        $routing_id=explode(":",$routing_id_t);
                        $points=count($routing_id)-1;
                        $j=0;
                        for($i=$routing_schritt;$i<$points;$i++){
                            $_POST["pid_".$j]=$routing_id[$i];
                            ?>
                            <input type="hidden" name="pid_<?php echo $j; ?>" value=<?php echo $routing_id[$i]; ?>>
                            <input type="hidden" name="cantox_<?php echo $j; ?>" value=<?php echo substr($routing_mins[$i],0,1); ?>>
                            <input type="hidden" name="vorrat_<?php echo $j; ?>" value=<?php echo substr($routing_mins[$i],1,1); ?>>
                            <input type="hidden" name="lem_<?php echo $j; ?>" value=<?php echo substr($routing_mins[$i],2,1); ?>>
                            <input type="hidden" name="bax_<?php echo $j; ?>" value=<?php echo substr($routing_mins[$i],3,1); ?>>
                            <input type="hidden" name="ren_<?php echo $j; ?>" value=<?php echo substr($routing_mins[$i],4,1); ?>>
                            <input type="hidden" name="vor_<?php echo $j; ?>" value=<?php echo substr($routing_mins[$i],5,1); ?>>
                            <input type="hidden" name="vol_<?php echo $j; ?>" value=<?php echo substr($routing_mins[$i],6,1); ?>>
                            <input type="hidden" name="kol_<?php echo $j; ?>" value=<?php echo substr($routing_mins[$i],7,7); ?>>
                            <input type="hidden" name="lbt_<?php echo $j; ?>" value=<?php echo substr($routing_mins[$i],14,4); ?>>
                            <input type="hidden" name="sbt_<?php echo $j; ?>" value=<?php echo substr($routing_mins[$i],18,4); ?>>
                            <?php
                            $j++;
                        }
                        for($i=0;$i<$routing_schritt;$i++){
                            $_POST["pid_".$j]=$routing_id[$i];
                            ?>
                            <input type="hidden" name="pid_<?php echo $j; ?>" value=<?php echo $routing_id[$i]; ?>>
                            <input type="hidden" name="cantox_<?php echo $j; ?>" value=<?php echo substr($routing_mins[$i],0,1); ?>>
                            <input type="hidden" name="vorrat_<?php echo $j; ?>" value=<?php echo substr($routing_mins[$i],1,1); ?>>
                            <input type="hidden" name="lem_<?php echo $j; ?>" value=<?php echo substr($routing_mins[$i],2,1); ?>>
                            <input type="hidden" name="bax_<?php echo $j; ?>" value=<?php echo substr($routing_mins[$i],3,1); ?>>
                            <input type="hidden" name="ren_<?php echo $j; ?>" value=<?php echo substr($routing_mins[$i],4,1); ?>>
                            <input type="hidden" name="vor_<?php echo $j; ?>" value=<?php echo substr($routing_mins[$i],5,1); ?>>
                            <input type="hidden" name="vol_<?php echo $j; ?>" value=<?php echo substr($routing_mins[$i],6,1); ?>>
                            <input type="hidden" name="kol_<?php echo $j; ?>" value=<?php echo substr($routing_mins[$i],7,7); ?>>
                            <input type="hidden" name="lbt_<?php echo $j; ?>" value=<?php echo substr($routing_mins[$i],14,4); ?>>
                            <input type="hidden" name="sbt_<?php echo $j; ?>" value=<?php echo substr($routing_mins[$i],18,4); ?>>
                            <?php
                            $j++;
                        }
                        $i=$routing_schritt;
                        $pid_a=$routing_id[$i];
                        $cantox_a=substr($routing_mins[$i],0,1);
                        $vorrat_a=substr($routing_mins[$i],1,1);
                        $lem_a=substr($routing_mins[$i],2,1);
                        $bax_a=substr($routing_mins[$i],3,1);
                        $ren_a=substr($routing_mins[$i],4,1);
                        $vor_a=substr($routing_mins[$i],5,1);
                        $vol_a=substr($routing_mins[$i],6,1);
                        $kol_a=substr($routing_mins[$i],7,7);
                        $lbt_a=substr($routing_mins[$i],14,4);
                        $sbt_a=substr($routing_mins[$i],18,4);
                    }elseif(urldecode(str_post('submitbutton','DEFAULT'))==utf8_encode(html_entity_decode($lang['flottealpha']['loeschen']))){
                        $point=int_post('point');
                        $points=int_post('points')-1;
                        for($i=0;$i<$point;$i++){
                            $pid_h[$i]=int_post('pid_'.$i);
                            ?>
                            <input type="hidden" name="pid_<?php echo $i; ?>" value=<?php echo int_post('pid_'.$i); ?>>
                            <input type="hidden" name="cantox_<?php echo $i; ?>" value=<?php echo int_post('cantox_'.$i); ?>>
                            <input type="hidden" name="vorrat_<?php echo $i; ?>" value=<?php echo int_post('vorrat_'.$i); ?>>
                            <input type="hidden" name="lem_<?php echo $i; ?>" value=<?php echo int_post('lem_'.$i); ?>>
                            <input type="hidden" name="bax_<?php echo $i; ?>" value=<?php echo int_post('bax_'.$i); ?>>
                            <input type="hidden" name="ren_<?php echo $i; ?>" value=<?php echo int_post('ren_'.$i); ?>>
                            <input type="hidden" name="vor_<?php echo $i; ?>" value=<?php echo int_post('vor_'.$i); ?>>
                            <input type="hidden" name="vol_<?php echo $i; ?>" value=<?php echo int_post('vol_'.$i); ?>>
                            <input type="hidden" name="kol_<?php echo $i; ?>" value=<?php echo int_post('kol_'.$i); ?>>
                            <input type="hidden" name="lbt_<?php echo $i; ?>" value=<?php echo int_post('lbt_'.$i); ?>>
                            <input type="hidden" name="sbt_<?php echo $i; ?>" value=<?php echo int_post('sbt_'.$i); ?>>
                            <?php
                        }
                        for($i=$point+1;$i<$points+1;$i++){
                            $pid_h[$i-1]=int_post('pid_'.$i);
                            ?>
                            <input type="hidden" name="pid_<?php echo $i-1; ?>" value=<?php echo int_post('pid_'.$i); ?>>
                            <input type="hidden" name="cantox_<?php echo $i-1; ?>" value=<?php echo int_post('cantox_'.$i); ?>>
                            <input type="hidden" name="vorrat_<?php echo $i-1; ?>" value=<?php echo int_post('vorrat_'.$i); ?>>
                            <input type="hidden" name="lem_<?php echo $i-1; ?>" value=<?php echo int_post('lem_'.$i); ?>>
                            <input type="hidden" name="bax_<?php echo $i-1; ?>" value=<?php echo int_post('bax_'.$i); ?>>
                            <input type="hidden" name="ren_<?php echo $i-1; ?>" value=<?php echo int_post('ren_'.$i); ?>>
                            <input type="hidden" name="vor_<?php echo $i-1; ?>" value=<?php echo int_post('vor_'.$i); ?>>
                            <input type="hidden" name="vol_<?php echo $i-1; ?>" value=<?php echo int_post('vol_'.$i); ?>>
                            <input type="hidden" name="kol_<?php echo $i-1; ?>" value=<?php echo int_post('kol_'.$i); ?>>
                            <input type="hidden" name="lbt_<?php echo $i-1; ?>" value=<?php echo int_post('lbt_'.$i); ?>>
                            <input type="hidden" name="sbt_<?php echo $i-1; ?>" value=<?php echo int_post('sbt_'.$i); ?>>
                            <?php
                        }
                        $i=$point+1;
                        $i=($point==$points)?$point-1:$i;
                        $pid_a=int_post('pid_'.$i);
                        $cantox_a=int_post('cantox_'.$i);
                        $vorrat_a=int_post('vorrat_'.$i);
                        $lem_a=int_post('lem_'.$i);
                        $bax_a=int_post('bax_'.$i);
                        $ren_a=int_post('ren_'.$i);
                        $vor_a=int_post('vor_'.$i);
                        $vol_a=int_post('vol_'.$i);
                        $kol_a=int_post('kol_'.$i);
                        $lbt_a=int_post('lbt_'.$i);
                        $sbt_a=int_post('sbt_'.$i);
                        $point=($point==$points)?$point-1:$point;
                        for($i=0;$i<$points;$i++){
                            $_POST["pid_".$i]=$pid_h[$i];
                        }
                    }elseif(urldecode(str_post('submitbutton','DEFAULT'))==utf8_encode(html_entity_decode($lang['flottealpha']['neuerpunkt']))){
                        $point=int_post('point')+1;
                        $points=int_post('points')+1;
                        for($i=0;$i<$point;$i++){
                            $pid_h[$i]=int_post('pid_'.$i);
                            ?>
                            <input type="hidden" name="pid_<?php echo $i; ?>" value=<?php echo int_post('pid_'.$i); ?>>
                            <input type="hidden" name="cantox_<?php echo $i; ?>" value=<?php echo int_post('cantox_'.$i); ?>>
                            <input type="hidden" name="vorrat_<?php echo $i; ?>" value=<?php echo int_post('vorrat_'.$i); ?>>
                            <input type="hidden" name="lem_<?php echo $i; ?>" value=<?php echo int_post('lem_'.$i); ?>>
                            <input type="hidden" name="bax_<?php echo $i; ?>" value=<?php echo int_post('bax_'.$i); ?>>
                            <input type="hidden" name="ren_<?php echo $i; ?>" value=<?php echo int_post('ren_'.$i); ?>>
                            <input type="hidden" name="vor_<?php echo $i; ?>" value=<?php echo int_post('vor_'.$i); ?>>
                            <input type="hidden" name="vol_<?php echo $i; ?>" value=<?php echo int_post('vol_'.$i); ?>>
                            <input type="hidden" name="kol_<?php echo $i; ?>" value=<?php echo int_post('kol_'.$i); ?>>
                            <input type="hidden" name="lbt_<?php echo $i; ?>" value=<?php echo int_post('lbt_'.$i); ?>>
                            <input type="hidden" name="sbt_<?php echo $i; ?>" value=<?php echo int_post('sbt_'.$i); ?>>
                            <?php
                        }
                        $pid_h[$point]=-1;
                        ?>
                        <input type="hidden" name="pid_<?php echo $point; ?>" value=-1>
                        <input type="hidden" name="cantox_<?php echo $point; ?>" value=0>
                        <input type="hidden" name="vorrat_<?php echo $point; ?>" value=0>
                        <input type="hidden" name="lem_<?php echo $point; ?>" value=0>
                        <input type="hidden" name="bax_<?php echo $point; ?>" value=0>
                        <input type="hidden" name="ren_<?php echo $point; ?>" value=0>
                        <input type="hidden" name="vor_<?php echo $point; ?>" value=0>
                        <input type="hidden" name="vol_<?php echo $point; ?>" value=0>
                        <input type="hidden" name="kol_<?php echo $point; ?>" value=0>
                        <input type="hidden" name="lbt_<?php echo $point; ?>" value=0>
                        <input type="hidden" name="sbt_<?php echo $point; ?>" value=0>
                        <?php
                        for($i=$point;$i<$points-1;$i++){
                            $pid_h[$i+1]=int_post('pid_'.$i);
                            ?>
                            <input type="hidden" name="pid_<?php echo $i+1; ?>" value=<?php echo int_post('pid_'.$i); ?>>
                            <input type="hidden" name="cantox_<?php echo $i+1; ?>" value=<?php echo int_post('cantox_'.$i); ?>>
                            <input type="hidden" name="vorrat_<?php echo $i+1; ?>" value=<?php echo int_post('vorrat_'.$i); ?>>
                            <input type="hidden" name="lem_<?php echo $i+1; ?>" value=<?php echo int_post('lem_'.$i); ?>>
                            <input type="hidden" name="bax_<?php echo $i+1; ?>" value=<?php echo int_post('bax_'.$i); ?>>
                            <input type="hidden" name="ren_<?php echo $i+1; ?>" value=<?php echo int_post('ren_'.$i); ?>>
                            <input type="hidden" name="vor_<?php echo $i+1; ?>" value=<?php echo int_post('vor_'.$i); ?>>
                            <input type="hidden" name="vol_<?php echo $i+1; ?>" value=<?php echo int_post('vol_'.$i); ?>>
                            <input type="hidden" name="kol_<?php echo $i+1; ?>" value=<?php echo int_post('kol_'.$i); ?>>
                            <input type="hidden" name="lbt_<?php echo $i+1; ?>" value=<?php echo int_post('lbt_'.$i); ?>>
                            <input type="hidden" name="sbt_<?php echo $i+1; ?>" value=<?php echo int_post('sbt_'.$i); ?>>
                            <?php
                        }
                        for($i=0;$i<$points;$i++){
                            $_POST["pid_".$i]=$pid_h[$i];
                        }
                    }else{
                        $point=int_post('point');
                        $points=int_post('points');
                        if(str_post('submitbutton','DEFAULT')=='<'){
                            if($point>0){
                                $point=$point-1;
                            }else{
                                $point=$points-1;
                            }
                        }elseif(str_post('submitbutton','DEFAULT')=='>'){
                            if($point<$points-1){
                                $point=$point+1;
                            }else{
                                $point=0;
                            }
                        }
                        for($i=0;$i<$points;$i++){
                            ?>
                            <input type="hidden" name="pid_<?php echo $i; ?>" value=<?php echo int_post('pid_'.$i); ?>>
                            <input type="hidden" name="kox_<?php echo $i; ?>" value=<?php echo int_post('kox_'.$i); ?>>
                            <input type="hidden" name="koy_<?php echo $i; ?>" value=<?php echo int_post('koy_'.$i); ?>>
                            <input type="hidden" name="cantox_<?php echo $i; ?>" value=<?php echo int_post('cantox_'.$i); ?>>
                            <input type="hidden" name="vorrat_<?php echo $i; ?>" value=<?php echo int_post('vorrat_'.$i); ?>>
                            <input type="hidden" name="lem_<?php echo $i; ?>" value=<?php echo int_post('lem_'.$i); ?>>
                            <input type="hidden" name="bax_<?php echo $i; ?>" value=<?php echo int_post('bax_'.$i); ?>>
                            <input type="hidden" name="ren_<?php echo $i; ?>" value=<?php echo int_post('ren_'.$i); ?>>
                            <input type="hidden" name="vor_<?php echo $i; ?>" value=<?php echo int_post('vor_'.$i); ?>>
                            <input type="hidden" name="vol_<?php echo $i; ?>" value=<?php echo int_post('vol_'.$i); ?>>
                            <input type="hidden" name="kol_<?php echo $i; ?>" value=<?php echo int_post('kol_'.$i); ?>>
                            <input type="hidden" name="lbt_<?php echo $i; ?>" value=<?php echo int_post('lbt_'.$i); ?>>
                            <input type="hidden" name="sbt_<?php echo $i; ?>" value=<?php echo int_post('sbt_'.$i); ?>>
                            <?php
                        }
                        $pid_a=int_post('pid_'.$point);
                        $cantox_a=int_post('cantox_'.$point);
                        $vorrat_a=int_post('vorrat_'.$point);
                        $lem_a=int_post('lem_'.$point);
                        $bax_a=int_post('bax_'.$point);
                        $ren_a=int_post('ren_'.$point);
                        $vor_a=int_post('vor_'.$point);
                        $vol_a=int_post('vol_'.$point);
                        $kol_a=int_post('kol_'.$point);
                        $lbt_a=int_post('lbt_'.$point);
                        $sbt_a=int_post('sbt_'.$point);
                    }
                    if($points>1){
                        if((0<$point)&&($point<$points-1)){
                            $davor=$point-1;
                            $danach=$point+1;
                        }elseif($point==0){
                            $davor=$points-1;
                            $danach=1;
                        }else{
                            $davor=$point-1;
                            $danach=0;
                        }
                    }
                    if(str_post('wechsel','DEFAULT')==$lang['flottealpha']['fracht']){
                        ?>
                        <td style="color:#aaaaaa;"><?php echo $lang['flottealpha']['wegpunkt']; ?> <?php echo $point+1; ?><?php echo $lang['flottealpha']['von']; ?><?php echo $points; ?>&nbsp;</td>
                        <td><select name="pid_<?php echo $point; ?>">
                            <?php
                            $zeiger = @mysql_query("SELECT id,besitzer,name FROM $skrupel_planeten where besitzer=$spieler and spiel=$spiel order by name");
                            $planetenanzahl = @mysql_num_rows($zeiger);
                            echo "<option value='-1'></option>";
                            if ($planetenanzahl>=1) {
                                for  ($i=0; $i<$planetenanzahl;$i++) {
                                    $ok = @mysql_data_seek($zeiger,$i);
                                    $array = @mysql_fetch_array($zeiger);
                                    $piid=$array["id"];
                                    $name=$array["name"];
                                    if(($piid<>int_post('pid_'.$davor))&&($piid<>int_post('pid_'.$danach))&&($piid<>$pid_a))echo "<option value='$piid'>$name</option>";
                                    if($piid==$pid_a)echo "<option value='$piid' selected>$name</option>";
                                }
                            }
                            if($points>0)$planetenanzahl=$planetenanzahl-1;
                            if($points>1)$planetenanzahl=$planetenanzahl-1;
                            ?>
                        </select></td>
                    </tr>
                </table></center>
                <center><table border="0" cellspacing="0" cellpadding="2">
                    <tr>
                        <td><input type="hidden" name="point" value="<?php echo $point; ?>"><input type="hidden" name="points" value="<?php echo $points; ?>"></td>
                        <td></td>
                        <td><center>+</center></td>
                        <td><center>-</center></td>
                        <td></td>
                        <td></td>
                        <td><center>+</center></td>
                        <td><center>-</center></td>
                        <td></td>
                        <td></td>
                        <td><center>+</center></td>
                        <td><center>-</center></td>
                        <td></td>
                        <td><?php echo $lang['flottealpha']['vollLaden']; ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?php echo $bildpfad; ?>/icons/cantox.gif" width="17" height="17" title="<?php echo $lang['flottealpha']['cantox']; ?>"></td>
                        <td><input type="radio" value="0" name="cantox_<?php echo $point; ?>"<?php if($cantox_a==0){?>checked<?php }?>></td>
                        <td><input type="radio" value="1" name="cantox_<?php echo $point; ?>"<?php if($cantox_a==1){?>checked<?php }?>></td>
                        <td><input type="radio" value="2" name="cantox_<?php echo $point; ?>"<?php if($cantox_a==2){?>checked<?php }?>></td>
                        <td><img src="<?php echo $bildpfad; ?>/icons/lemin.gif" width="17" height="17" title="<?php echo $lang['flottealpha']['lemin']; ?>"></td>
                        <td><input type="radio" value="0" name="lem_<?php echo $point; ?>"<?php if($lem_a==0){?>checked<?php }?>></td>
                        <td><input type="radio" value="1" name="lem_<?php echo $point; ?>"<?php if($lem_a==1){?>checked<?php }?>></td>
                        <td><input type="radio" value="2" name="lem_<?php echo $point; ?>"<?php if($lem_a==2){?>checked<?php }?>></td>
                        <td><img src="<?php echo $bildpfad; ?>/icons/mineral_2.gif" width="17" height="17" title="<?php echo $lang['flottealpha']['rennurbin']; ?>"></td>
                        <td><input type="radio" value="0" name="ren_<?php echo $point; ?>"<?php if($ren_a==0){?>checked<?php }?>></td>
                        <td><input type="radio" value="1" name="ren_<?php echo $point; ?>"<?php if($ren_a==1){?>checked<?php }?>></td>
                        <td><input type="radio" value="2" name="ren_<?php echo $point; ?>"<?php if($ren_a==2){?>checked<?php }?>></td>
                        <td></td>
                        <td><?php echo $lang['flottealpha']['vollLadenja']; ?></td>
                        <td><?php echo $lang['flottealpha']['vollLadennein']; ?></td>
                    </tr>
                    <tr>
                        <td><img src="<?php echo $bildpfad; ?>/icons/vorrat.gif" width="17" height="17" title="<?php echo $lang['flottealpha']['vorrat']; ?>"></td>
                        <td><input type="radio" value="0" name="vorrat_<?php echo $point; ?>"<?php if($vorrat_a==0){?>checked<?php }?>></td>
                        <td><input type="radio" value="1" name="vorrat_<?php echo $point; ?>"<?php if($vorrat_a==1){?>checked<?php }?>></td>
                        <td><input type="radio" value="2" name="vorrat_<?php echo $point; ?>"<?php if($vorrat_a==2){?>checked<?php }?>></td>
                        <td><img src="<?php echo $bildpfad; ?>/icons/mineral_1.gif" width="17" height="17" title="<?php echo $lang['flottealpha']['baxterium']; ?>"></td>
                        <td><input type="radio" value="0" name="bax_<?php echo $point; ?>"<?php if($bax_a==0){?>checked<?php }?>></td>
                        <td><input type="radio" value="1" name="bax_<?php echo $point; ?>"<?php if($bax_a==1){?>checked<?php }?>></td>
                        <td><input type="radio" value="2" name="bax_<?php echo $point; ?>"<?php if($bax_a==2){?>checked<?php }?>></td>
                        <td><img src="<?php echo $bildpfad; ?>/icons/mineral_3.gif" width="17" height="17" title="<?php echo $lang['flottealpha']['vomisaan']; ?>"></td>
                        <td><input type="radio" value="0" name="vor_<?php echo $point; ?>"<?php if($vor_a==0){?>checked<?php }?>></td>
                        <td><input type="radio" value="1" name="vor_<?php echo $point; ?>"<?php if($vor_a==1){?>checked<?php }?>></td>
                        <td><input type="radio" value="2" name="vor_<?php echo $point; ?>"<?php if($vor_a==2){?>checked<?php }?>></td>
                        <td></td>
                        <td><input type="radio" value="1" name="vol_<?php echo $point; ?>"<?php if($vol_a==1){?>checked<?php }?>></td>
                        <td><input type="radio" value="0" name="vol_<?php echo $point; ?>"<?php if($vol_a==0){?>checked<?php }?>></td>
                    </tr>
                </table></center>
                <center>
                    <input type="submit" value="<" name="submitbutton"><?php if($points>1){?><input type="submit" value="<?php echo $lang['flottealpha']['uebernehmen']; ?>"  name="submitbutton"><?php } if(($points<10) and ($planetenanzahl>0)){?><input type="submit" value="<?php echo $lang['flottealpha']['neuerpunkt']; ?>"  name="submitbutton"><?php }if($points>1){?><input type="submit" value="<?php echo $lang['flottealpha']['loeschen']; ?>"  name="submitbutton"><?php }?><input type="hidden" value="<?php echo $lang['flottealpha']['fracht']; ?>" name="wechsel"><input type="submit" value="<?php echo $lang['flottealpha']['passagiere']; ?>"  name="wechsel"><input type="submit" value=">"  name="submitbutton" >
                </center>
                <?php
            }elseif(str_post('wechsel','DEFAULT')==$lang['flottealpha']['passagiere']){
                ?>
                </table>
                <table border="0" cellspacing="0" cellpadding="1">
                    <tr>
                        <td></td>
                        <td style="color:#aaaaaa;"><center>
                            <?php echo $lang['flottealpha']['wegpunkt']; ?> <?php echo $point+1; ?><?php echo $lang['flottealpha']['von']; ?><?php echo $points; ?>&nbsp;
                            <?php
                            if($pid_a!=-1){
                                $zeiger = @mysql_query("SELECT id,besitzer,name FROM $skrupel_planeten where besitzer=$spieler and id=$pid_a and spiel=$spiel order by name");
                                $ok = @mysql_data_seek($zeiger,0);
                                $array = @mysql_fetch_array($zeiger);
                                $name=$array["name"];
                                echo $name;
                            }
                            ?>
                        </td></center>
                    </tr>    
                    <tr>
                        <td><input type="hidden" name="point" value="<?php echo $point; ?>"><input type="hidden" name="points" value="<?php echo $points; ?>"><img src="<?php echo $bildpfad; ?>/icons/crew.gif" width="17" height="17" title="<?php echo $lang['flottealpha']['kolonisten']; ?>"></td>
                        <td>
                            <select name="kol_<?php echo $point; ?>"style="width:140px">
                            <?php
                                if(0==$kol_a){
                                    echo "<option value='0' selected>".$lang['flottealpha']['ignorieren']."</option>";
                                }else{
                                    echo "<option value='0'>".$lang['flottealpha']['ignorieren']."</option>";
                                }
                                if(2==$kol_a){
                                    echo "<option value='2' selected>".$lang['flottealpha']['ausladen']."</option>";
                                }else{
                                    echo "<option value='2'>".$lang['flottealpha']['ausladen']."</option>";
                                }
                                for  ($i=1000; $i<5001;$i+=100) {
                                    if($i==$kol_a){
                                        echo "<option value='$i' selected>".$lang['flottealpha']['relativ']."$i</option>";
                                    }else{
                                        echo "<option value='$i'>".$lang['flottealpha']['relativ']."$i</option>";
                                    }
                                }
                                if(5001==$kol_a){
                                        echo "<option value='5001' selected>".$lang['flottealpha']['relativ']."5001</option>";
                                    }else{
                                        echo "<option value='5001'>".$lang['flottealpha']['relativ']."5001</option>";
                                    }
                                for  ($i=5100; $i<10001;$i+=100) {
                                    if($i==$kol_a){
                                        echo "<option value='$i' selected>".$lang['flottealpha']['relativ']."$i</option>";
                                    }else{
                                        echo "<option value='$i'>".$lang['flottealpha']['relativ']."$i</option>";
                                    }
                                }
                                if(10001==$kol_a){
                                        echo "<option value='10001' selected>".$lang['flottealpha']['relativ']."10001</option>";
                                    }else{
                                        echo "<option value='10001'>".$lang['flottealpha']['relativ']."10001</option>";
                                    }
                                for  ($i=10100; $i<20001;$i+=100) {
                                    if($i==$kol_a){
                                        echo "<option value='$i' selected>".$lang['flottealpha']['relativ']."$i</option>";
                                    }else{
                                        echo "<option value='$i'>".$lang['flottealpha']['relativ']."$i</option>";
                                    }
                                }
                                if(20001==$kol_a){
                                        echo "<option value='20001' selected>".$lang['flottealpha']['relativ']."20001</option>";
                                    }else{
                                        echo "<option value='20001'>".$lang['flottealpha']['relativ']."20001</option>";
                                    }
                                $j=2900;
                                for  ($i=22500; $i<10000000;$i+=$j) {
                                    $j+=200;
                                    if($i==$kol_a){
                                        echo "<option value='$i' selected>".$lang['flottealpha']['relativ']."$i</option>";
                                    }else{
                                        echo "<option value='$i'>".$lang['flottealpha']['relativ']."$i</option>";
                                    }
                                }
                            ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="<?php echo $bildpfad; ?>/icons/leichtebt.gif" width="17" height="17" title="<?php echo $lang['flottealpha']['leichtebt']; ?>"></td>
                        <td>
                            <select name="lbt_<?php echo $point; ?>" style="width:140px">
                            <?php
                                if(0==$lbt_a){
                                    echo "<option value='0' selected>".$lang['flottealpha']['ignorieren']."</option>";
                                }else{
                                    echo "<option value='0'>".$lang['flottealpha']['ignorieren']."</option>";
                                }
                                if(1==$lbt_a){
                                    echo "<option value='1' selected>".$lang['flottealpha']['einladen']."</option>";
                                }else{
                                    echo "<option value='1'>".$lang['flottealpha']['einladen']."</option>";
                                }
                                if(2==$lbt_a){
                                    echo "<option value='2' selected>".$lang['flottealpha']['ausladen']."</option>";
                                }else{
                                    echo "<option value='2'>".$lang['flottealpha']['ausladen']."</option>";
                                }
                                for  ($i=10; $i<10000;$i+=10) {
                                    if($i==$lbt_a){
                                        echo "<option value='$i' selected>".$lang['flottealpha']['relativ']."$i</option>";
                                    }else{
                                        echo "<option value='$i'>".$lang['flottealpha']['relativ']."$i</option>";
                                    }
                                }
                            ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="<?php echo $bildpfad; ?>/icons/schwerebt.gif" width="17" height="17" title="<?php echo $lang['flottealpha']['schwerebt']; ?>"></td>
                        <td>
                            <select name="sbt_<?php echo $point; ?>" style=" width:140px">
                            <?php
                                if(0==$sbt_a){
                                    echo "<option value='0' selected>".$lang['flottealpha']['ignorieren']."</option>";
                                }else{
                                    echo "<option value='0'>".$lang['flottealpha']['ignorieren']."</option>";
                                }
                                if(1==$sbt_a){
                                    echo "<option value='1' selected>".$lang['flottealpha']['einladen']."</option>";
                                }else{
                                    echo "<option value='1'>".$lang['flottealpha']['einladen']."</option>";
                                }
                                if(2==$sbt_a){
                                    echo "<option value='2' selected>".$lang['flottealpha']['ausladen']."</option>";
                                }else{
                                    echo "<option value='2'>".$lang['flottealpha']['ausladen']."</option>";
                                }
                                for  ($i=10; $i<10000;$i+=10) {
                                    if($i==$sbt_a){
                                        echo "<option value='$i' selected>".$lang['flottealpha']['relativ']."$i</option>";
                                    }else{
                                        echo "<option value='$i'>".$lang['flottealpha']['relativ']."$i</option>";
                                    }
                                }
                            ?>
                            </select>
                        </td>
                </table>
                <center>
                    <input type="submit" value="<" name="submitbutton"><input type="hidden" value="<?php echo $lang['flottealpha']['passagiere']; ?>" name="wechsel"><input type="submit" value="<?php echo $lang['flottealpha']['fracht']; ?>"  name="wechsel"><input type="submit" value=">"  name="submitbutton" >
                </center>
                <?php
            }?>
        </form>
        <?php
    }
    include ("inc.footer.php");
}
if ($fuid==7) {
    include ("inc.header.php");
    $routing_mins=str_post('routing_mins','DEFAULT');
    $routing_id=str_post('routing_id','DEFAULT');
    $routing_koord=str_post('routing_koord','DEFAULT');
    $zielx=int_post('zielx');
    $ziely=int_post('ziely');
    $zielid=int_post('zielid');
    $flug=int_post('flug');
    if (str_post('submitbutton','DEFAULT')==$lang['flottealpha']['routeabschliessen']) {
        $zeiger = @mysql_query("SELECT * FROM $skrupel_schiffe where id=$shid");
        $array = @mysql_fetch_array($zeiger);
        $antrieb=$array["antrieb"];
        $leminmax=$array["leminmax"];
        $tank=$array["routing_tank"];
        $rohstoff=$array["routing_rohstoff"];
        ?>
        <body text="#000000" background="<?php echo $bildpfad; ?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <center>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
                    </tr>
                    <tr>
                        <td><form name="formular" id="formular"  method="post" action="flotte_alpha.php?fu=8&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                        <td><?php echo $lang['flottealpha']['flugoptionen']; ?></td>
                        <td>
                            <input type="hidden" name="kox" value=<?php echo int_post('kox'); ?>>
                            <input type="hidden" name="koy" value=<?php echo int_post('koy'); ?>>
                            <input type="hidden" name="routing_mins" value="<?php echo $routing_mins?>">
                            <input type="hidden" name="routing_id" value="<?php echo $routing_id; ?>">
                            <input type="hidden" name="routing_koord" value="<?php echo $routing_koord; ?>">
                            <input type="hidden" name="zielx" value=<?php echo $zielx; ?>>
                            <input type="hidden" name="ziely" value=<?php echo $ziely; ?>>
                            <input type="hidden" name="flug" value=<?php echo $flug; ?>>
                            <input type="hidden" name="zielid" value=<?php echo $zielid; ?>>
                        </td>
                    </tr>
                </table>
            </center>
            <center>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="8"></td>
                    </tr>
                    <tr>
                        <td style="color:#aaaaaa;"><?php echo $lang['flottealpha']['geschwindigkeit']; ?></td>
                        <td>&nbsp;</td>
                        <td>
                            <select name="warpfaktor" style="width:140px;">
                                <option value=1 <?php if ($antrieb==1) { echo "selected"; } ?>><?php echo str_replace('{1}','1',$lang['flottealpha']['warp'])?></option>
                                <?php
                                if ($antrieb>1) {
                                    for($i=2;$i<10;$i++){
                                        ?>
                                        <option value=<?php
                                            echo $i." "; 
                                            if($antrieb<$i){
                                                echo "style='background-color:#aa0000'; ";
                                            } 
                                            if($antrieb==$i){
                                                echo "selected";
                                            }
                                            echo ">".str_replace('{1}',"$i",$lang['flottealpha']['warp']);
                                            ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="color:#aaaaaa;"><?php echo $lang['flottealpha']['mindesttank']; ?></td>
                        <td>&nbsp;</td>
                        <td>
                            <select name="tank" style="width:140px;">
                                <?php
                                for ($n=10;$n<$leminmax;$n=$n+10) {
                                    ?>
                                    <option value="<?php echo $n; ?>" <?php if ($tank==$n) { echo "selected";} ?>><?php echo $n." ".$lang['flottealpha']['kt']='KT'; ?></option>
                                    <?php
                                }
                                ?>
                                <option value="<?php echo $leminmax; ?>"><?php echo $leminmax." ".$lang['flottealpha']['kt']='KT'; ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="color:#aaaaaa;"><?php echo $lang['flottealpha']['primaererrohstoff']; ?></td>
                        <td>&nbsp;</td>
                        <td>
                            <select name="rohstoff" style="width:140px;">
                                <option value="2" <?php if ($rohstoff==2) { echo "selected";} ?>><?php echo $lang['flottealpha']['baxterium']; ?></option>
                                <option value="3" <?php if ($rohstoff==3) { echo "selected";} ?>><?php echo $lang['flottealpha']['rennurbin']; ?></option>
                                <option value="4" <?php if ($rohstoff==4) { echo "selected";} ?>><?php echo $lang['flottealpha']['vomisaan']; ?></option>
                                <option value="1" <?php if ($rohstoff==1) { echo "selected";} ?>><?php echo $lang['flottealpha']['vorraete']; ?></option>
                                <option value="5" <?php if ($rohstoff==5) { echo "selected";} ?>><?php echo $lang['flottealpha']['kolonisten']; ?></option>
                                <option value="6" <?php if ($rohstoff==6) { echo "selected";} ?>><?php echo $lang['flottealpha']['leichtebt']; ?></option>
                                <option value="7" <?php if ($rohstoff==7) { echo "selected";} ?>><?php echo $lang['flottealpha']['schwerebt']; ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="7"></td>
                    </tr>
                </table>
            </center>
            <center><input type="submit" style="width:160px;" value="Flugroute initialisieren"  name="submitbutton"></center></form>
            <?php
        } 
    include ("inc.footer.php");
}
if ($fuid==8) {
    include ("inc.header.php");
    $zeiger = @mysql_query("UPDATE $skrupel_schiffe set routing_id=\"".str_post('routing_id','DEFAULT')."\",
                                                     routing_koord=\"".str_post('routing_koord','DEFAULT')."\",
                                                     routing_mins=\"".str_post('routing_mins','DEFAULT')."\",
                                                     routing_status=2,
                                                     routing_schritt=0,
                                                     routing_warp=".int_post('warpfaktor').",
                                                     routing_tank=".int_post('tank').",
                                                     routing_rohstoff=".int_post('rohstoff')." where id=$shid");
    $zeiger_temp = @mysql_query("UPDATE $skrupel_schiffe set flug=".int_post('flug').",warp=".int_post('warpfaktor').",plasmawarp=0,zielx=".int_post('zielx').",ziely=".int_post('ziely').",zielid=".int_post('zielid')." where id=$shid");
    ?>
    <body text="#000000" background="<?php echo $bildpfad; ?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <br><br><br>
        <center><?php echo $lang['flottealpha']['routeerfolgreich']; ?></center>
        <script language=JavaScript>
            <?php
            if ((int_post('kox')==int_post('zielx')) and (int_post('koy')==int_post('ziely'))) {
                for ($k=1;$k<=20;$k++) {
                    ?>
                    parent.parent.mittemitte.document.getElementById('punkt_<?php echo $k; ?>_<?php echo $shid; ?>').style.left=0;
                    parent.parent.mittemitte.document.getElementById('punkt_<?php echo $k; ?>_<?php echo $shid; ?>').style.top=0;
                    parent.parent.mittemitte.document.getElementById('punkt_<?php echo $k; ?>_<?php echo $shid; ?>').style.visibility='hidden';
                    <?php
                }
                ?>
                parent.parent.mittemitte.document.getElementById('auswahlrand_<?php echo $shid; ?>').style.left=0;
                parent.parent.mittemitte.document.getElementById('auswahlrand_<?php echo $shid; ?>').style.top=0;
                parent.parent.mittemitte.document.getElementById('auswahlrand_<?php echo $shid; ?>').style.visibility='hidden';
                <?php
            } else {
                $schrittx=(int_post('zielx')-int_post('kox'))/20;
                $schritty=(int_post('ziely')-int_post('koy'))/20;
                $laufx=int_post('kox');
                $laufy=int_post('koy');
                for ($k=1;$k<=20;$k++) {
                    $laufx=$laufx+$schrittx;
                    $laufy=$laufy+$schritty;
                    echo "parent.parent.mittemitte.document.getElementById('punkt_".$k."_".$shid."').style.left=".$laufx.";";
                    echo "parent.parent.mittemitte.document.getElementById('punkt_".$k."_".$shid."').style.top=".$laufy.";";
                    echo "parent.parent.mittemitte.document.getElementById('punkt_".$k."_".$shid."').style.visibility='visible';";
                }
                ?>
                parent.parent.mittemitte.document.getElementById('auswahlrand_<?php echo $shid; ?>').style.left=<?php echo $zielx-8; ?>;
                parent.parent.mittemitte.document.getElementById('auswahlrand_<?php echo $shid; ?>').style.top=<?php echo $ziely-8; ?>;
                parent.parent.mittemitte.document.getElementById('auswahlrand_<?php echo $shid; ?>').style.visibility='visible';
                <?php
            }
            ?>
            parent.ship.auftrag.style.color='#009900';
            var ant=parent.ship.document.getElementById('auftrag');
            ant.innerHTML='<?php echo $lang['flottealpha']['route']; ?>';
        </script>
        <?php
    include ("inc.footer.php");
}
