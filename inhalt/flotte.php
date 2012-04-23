<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'flotte';
$fuid = int_get('fu');
$shid = int_get('shid');

if ($fuid==1) {
    include ("inc.header.php");
    ?>
    <body text="#000000" <?php if (@intval(substr($spieler_optionen,17,1))!=1) { ?>onload="document.getElementById('bodycontent').style.width = (document.getElementById('bodytable').offsetWidth) + 'px';CSBfleXcroll('bodybody');"<?php } ?> style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <div id="bodybody" class="flexcrollafter" onfocus="this.blur()">
        <div id="bodycontent" style="margin:0 auto;">
        <script language=JavaScript>
            function fensterbreit(){
                if (parent.parent.mittemitte.window.innerWidth) return parent.parent.mittemitte.window.innerWidth;
                else if (parent.parent.mittemitte.document.body && parent.parent.mittemitte.document.body.offsetWidth) return parent.parent.mittemitte.document.body.offsetWidth;
                else return 0;
            }
            function fensterhoch(){
                if (parent.parent.mittemitte.window.innerHeight) return parent.parent.mittemitte.window.innerHeight;
                else if (parent.parent.mittemitte.document.body && parent.parent.mittemitte.document.body.offsetHeight) return parent.parent.mittemitte.document.body.offsetHeight;
                else return 0;
            }
            function movemap(wertx,werty) {
                breite=fensterbreit();
                hoch=fensterhoch();
                aktuellx=wertx-15;
                aktuelly=werty-15;
                wertx=wertx-(breite/2);
                werty=werty-(hoch/2);
                <?php if (@intval(substr($spieler_optionen,17,1))!=1) { ?>
                    var scrollDiv = parent.parent.mittemitte.document.getElementById("complete");
                    if(scrollDiv.contentScroll) scrollDiv.contentScroll(wertx,werty,false);
                <?php } else { ?>
                    parent.parent.mittemitte.document.getElementById("complete").scrollLeft = wertx;
                    parent.parent.mittemitte.document.getElementById("complete").scrollTop = werty; 
                <?php } ?>
                parent.parent.mittemitte.document.getElementById("aktuell").style.visibility='visible';
                parent.parent.mittemitte.document.getElementById("aktuell").style.left=aktuellx;
                parent.parent.mittemitte.document.getElementById("aktuell").style.top=aktuelly;
            }
        </script>
        <?php
        $oid=int_get('oid');
        if (!$oid) { $oid=0; }
        $total=0;
        $zeiger5 = @mysql_query("SELECT count(*) as total FROM $skrupel_schiffe where besitzer=$spieler and spiel=$spiel");
        $array5 = @mysql_fetch_array($zeiger5);
        $total=$array5["total"];
        $zeiger = @mysql_query("SELECT * FROM $skrupel_schiffe where besitzer=$spieler and status>0 and spiel=$spiel and ordner=$oid order by name");
        $schiffanzahl = @mysql_num_rows($zeiger);
        if (($schiffanzahl>=1) or (($total>=1) and ($oid==0))) {
            ?>
            <center>
                <table border="0" cellspacing="0" cellpadding="0" id="bodytable">
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <?php
                                    if ($oid==0) {
                                        $zeiger2 = @mysql_query("SELECT * FROM $skrupel_ordner where besitzer=$spieler and spiel=$spiel order by name");
                                        $ordneranzahl = @mysql_num_rows($zeiger2);
                                        if ($ordneranzahl>=1) {
                                            for ($i2=0; $i2<$ordneranzahl;$i2++) {
                                                $ok2 = @mysql_data_seek($zeiger2,$i2);
                                                $array2 = @mysql_fetch_array($zeiger2);
                                                $ooid=$array2["id"];
                                                $name=$array2["name"];
                                                $name=stripslashes($name);
                                                $total=0;
                                                $zeiger5 = @mysql_query("SELECT count(*) as total FROM $skrupel_schiffe where besitzer=$spieler and spiel=$spiel and ordner=$ooid");
                                                $array5 = @mysql_fetch_array($zeiger5);
                                                $total=$array5["total"];
                                                ?>
                                                <td>
                                                    <table border="0" cellspacing="0" cellpadding="0" background="<?php echo $bildpfad; ?>/menu/flotte_ordner.gif">
                                                        <tr>
                                                            <td><img src="../bilder/empty.gif" border="0" width="1" height="15"></td>
                                                            <td><img src="../bilder/empty.gif" border="0" width="98" height="1"></td>
                                                            <td><img src="../bilder/empty.gif" border="0" width="1" height="15"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><img src="../bilder/empty.gif" border="0" width="1" height="58"></td>
                                                            <td style="filter:glow(color=#000000, strenght=#1);" valign="top"><center><a href="flotte.php?fu=1&oid=<?php echo $ooid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" style="color:#ffffff;"><?php echo $name; ?><br><?php echo $total; ?></a></center></td>
                                                            <td><img src="../bilder/empty.gif" border="0" width="1" height="58"></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <?php
                                            }
                                            ?>
                                            <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                            <?php
                                        }
                                    }
                                    for  ($i=0; $i<$schiffanzahl;$i++) {
                                        $ok = @mysql_data_seek($zeiger,$i);
                                        $array = @mysql_fetch_array($zeiger);
                                        $shid=$array["id"];
                                        $name=$array["name"];
                                        $klasse=$array["klasse"];
                                        $antrieb=$array["antrieb"];
                                        $klasseid=$array["klasseid"];
                                        $kox=$array["kox"];
                                        $koy=$array["koy"];
                                        $flug=$array["flug"];
                                        $zielx=$array["zielx"];
                                        $ziely=$array["ziely"];
                                        $zielid=$array["zielid"];
                                        $volk=$array["volk"];
                                        $bild=$array["bild_gross"];
                                        $erfahrung=$array["erfahrung"];
                                        $crew=$array["crew"];
                                        $crewmax=$array["crewmax"];
                                        $crewmax_d=max(1,$array["crewmax"]);
                                        $lemin=$array["lemin"];
                                        $leminmax=$array["leminmax"];
                                        $leminmax_d=max(1,$array["leminmax"]);
                                        $schaden=$array["schaden"];
                                        $routing_status=$array["routing_status"];
                                        $logbuch=$array["logbuch"];
                                        $tarnfeld=$array["tarnfeld"];
                                        $frachtraum=$array["frachtraum"];
                                        $frachtraum_d=max(1,$array["frachtraum"]);
                                        $fracht_leute=$array["fracht_leute"];
                                        $leichtebt=$array["leichtebt"];
                                        $schwerebt=$array["schwerebt"];
                                        $fracht_cantox=$array["fracht_cantox"];
                                        $fracht_vorrat=$array["fracht_vorrat"];
                                        $fracht_min1=$array["fracht_min1"];
                                        $fracht_min2=$array["fracht_min2"];
                                        $fracht_min3=$array["fracht_min3"];
                                        $fracht=round(($fracht_leute/100)+($leichtebt*0.3)+($schwerebt*1.5))+$fracht_vorrat+$fracht_min1+$fracht_min2+$fracht_min3;
                                        $routing_koord=$array["routing_koord"];
                                        $routing_status=$array["routing_status"];
                                        $routing_schritt=$array["routing_schritt"];
                                        $route_tip='';
                                        if ($routing_status>=1) {
                                            $routing_points_temp=explode("::",$routing_koord);
                                            $schritte=count($routing_points_temp);
                                            for ($n=0;$n<$schritte-1;$n++) {
                                                $routing_points=explode(":",$routing_points_temp[($n+$routing_schritt)%($schritte-1)]);
                                                $zielx=$routing_points[0];
                                                $ziely=$routing_points[1];
                                                $zeiger_temp = @mysql_query("SELECT name FROM $skrupel_planeten where x_pos=$zielx and y_pos=$ziely and spiel=$spiel");
                                                $array_temp = @mysql_fetch_array($zeiger_temp);
                                                $pname=$array_temp["name"];
                                                $route_tip=$route_tip.'-> '.$pname.' ';
                                            }
                                        }
                                        $tip="[$name]";
                                        $tip=$tip."\n";
                                        $tip=$tip."\n".$lang['flotte']['kol'].": ".$fracht_leute." ".$lang['flotte']['cx'].": ".$fracht_cantox." ".$lang['flotte']['vor'].": ".$fracht_vorrat;
                                        $tip=$tip."\n".$lang['flotte']['bax'].": ".$fracht_min1." ".$lang['flotte']['ren'].": ".$fracht_min2." ".$lang['flotte']['vom'].": ".$fracht_min3;
                                        if (strlen($logbuch)>=1) {
                                            $tip=$tip."\n";
                                            $tip=$tip."\n$logbuch";
                                        }
                                        if ($tarnfeld>=1) {
                                            ?>
                                            <td>
                                                <table border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td background="<?php echo $bildpfad; ?>/aufbau/tarnrand.gif" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                    </tr>
                                                    <tr>
                                                        <td background="<?php echo $bildpfad; ?>/aufbau/tarnrand.gif"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                        <td bgcolor="#000000"><a href="flotte.php?fu=2&shid=<?php echo $shid; ?>&oid=<?php echo $oid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"><img src="../daten/<?php echo $volk; ?>/bilder_schiffe/<?php echo $bild; ?>" border="0"  height="80" title="<?php echo $tip; ?>" style="filter:alpha(opacity=50);" onmouseover="this.style.filter='alpha(opacity=100)';" onmouseout="this.style.filter='alpha(opacity=50)';"></a></td>
                                                        <td background="<?php echo $bildpfad; ?>/aufbau/tarnrand.gif"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                    </tr>
                                                    <tr>
                                                        <td background="<?php echo $bildpfad; ?>/aufbau/tarnrand.gif" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        <?php } else { ?>
                                            <td>
                                                <table border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                        <td><a href="flotte.php?fu=2&shid=<?php echo $shid; ?>&oid=<?php echo $oid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"><img src="../daten/<?php echo $volk; ?>/bilder_schiffe/<?php echo $bild; ?>" border="0"  height="80" width="122" title="<?php echo $tip; ?>"></a></td>
                                                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <?php
                                        }
                                        ?>
                                        <td>
                                            <table border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td bgcolor="#990000" valign="bottom"><img src="<?php echo $bildpfad; ?>/skalen/gruen_1.gif" border="0" width="10" height="<?php echo 0.82*(100-$schaden); ?>" title="<?php echo str_replace('{1}',$schaden,$lang['flotte']['schaden'])?>"></td>
                                                    <td><img src="../bilder/empty.gif" border="0" width="1" height="82"></td>
                                                    <td bgcolor="#990000" valign="bottom"><img src="<?php echo $bildpfad; ?>/skalen/hellblau_1.gif" border="0" width="10" height="<?php echo 82*$crew/$crewmax_d; ?>" title="<?php echo str_replace('{2}',$crewmax,str_replace('{1}',$crew,$lang['flotte']['crew']))?>"></td>
                                                    <td><img src="../bilder/empty.gif" border="0" width="1" height="82"></td>
                                                    <td bgcolor="#990000" valign="bottom"><img src="<?php echo $bildpfad; ?>/skalen/gold_1.gif" border="0" width="10" height="<?php echo 82*$lemin/$leminmax_d; ?>" title="<?php echo str_replace('{2}',$leminmax,str_replace('{1}',$lemin,$lang['flotte']['lemin']))?>"></td>
                                                    <td><img src="../bilder/empty.gif" border="0" width="1" height="82"></td>
                                                    <td bgcolor="#990000" valign="bottom"><img src="<?php echo $bildpfad; ?>/skalen/grau_1.gif" border="0" width="10" height="<?php echo 82*$fracht/$frachtraum_d; ?>" title="<?php echo str_replace('{2}',$frachtraum,str_replace('{1}',$fracht,$lang['flotte']['fracht']))?>"></td>
                                                    <td><img src="../bilder/empty.gif" border="0" width="6" height="82"></td>
                                                    <td>
                                                        <table border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td><center><a href="javascript:;" onclick="movemap(<?php echo $kox.",".$koy;  ?>);"><?php if ($erfahrung==0) { ?><img src="<?php echo $bildpfad; ?>/karte/farben/schiff_aktiv_<?php echo $spieler; ?>.gif" border="0" width="15" height="15"><?php } else { ?><img src="<?php echo $bildpfad; ?>/icons/erf_<?php echo $erfahrung; ?>.gif" title="<?php echo $lang['flotte']['erfahrungslevel']." ".$erfahrung; ?>" border="0" width="22" height="22"><?php } ?></a></center></td>
                                                            </tr>
                                                            <tr>
                                                                <td><img src="../bilder/empty.gif" border="0" width="10" height="5"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><nobr><center><?php echo $name; ?></center></nobr></td>
                                                            </tr>
                                                            <tr>
                                                                <td><img src="../bilder/empty.gif" border="0" width="10" height="5"></td>
                                                            </tr>
                                                            <tr>
                                                                <?php
                                                                if ($flug==0) {
                                                                    if (($routing_status==2) or ($routing_status==1)) {
                                                                        ?>
                                                                        <td style="color:#009900;">
                                                                            <nobr><center>
                                                                                <?php 
                                                                                echo $lang['flotte']['route']." ";
                                                                                if (($routing_status==2) or ($routing_status==1)) {
                                                                                    ?>
                                                                                    <a href="#" title="<?php echo $route_tip; ?>"><?php echo $lang['flotte']['r']; ?></a>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </center></nobr>
                                                                        </td>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <td style="color:#990000;"><nobr><center><?php echo $lang['flotte']['keinauftrag']; ?></center></nobr></td>
                                                                        <?php
                                                                    }
                                                                }elseif ($flug==1) {
                                                                    ?>
                                                                    <td style="color:#009900;"><nobr><center><?php echo str_replace('{1}',"<br>".$zielx."/".$ziely,$lang['flotte']['unterwegsnach']);?></center></nobr></td>
                                                                    <?php
                                                                }elseif ($flug==2) {
                                                                    $zeiger_temp = @mysql_query("SELECT id,name FROM $skrupel_planeten where id=$zielid");
                                                                    $array_temp = @mysql_fetch_array($zeiger_temp);
                                                                    $planeten_name=$array_temp["name"];
                                                                    ?>
                                                                    <td style="color:#009900;">
                                                                        <nobr><center>
                                                                            <?php 
                                                                            echo str_replace('{1}',"<br>".$planeten_name." ",$lang['flotte']['unterwegsnach']); 
                                                                            if (($routing_status==2) or ($routing_status==1)) {
                                                                                ?>
                                                                                <a href="#" title="<?php echo $route_tip; ?>"><?php echo $lang['flotte']['r']; ?></a>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </center></nobr>
                                                                    </td>
                                                                    <?php
                                                                }elseif ($flug==3) {
                                                                    ?>
                                                                    <td style="color:#009900;"><nobr><center><?php echo $lang['flotte']['versuchterfeindkontakt']; ?></center></nobr></td>
                                                                    <?php
                                                                }elseif ($flug==4) { ?>
                                                                    <td style="color:#009900;"><?php echo $lang['flotte']['begleitschutz']; ?></td>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td><img src="../bilder/empty.gif" border="0" width="6" height="80"></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <?php
                                        /****************************
                                        * kommentar_flotte.php.txt  * 
                                        * Kommentar 1               *
                                        ****************************/
                                    }
                                    ?>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </center>
            </div>
            </div>
            <?php
        } else {
            ?>
            <br><br><br><br>
            <?php if ($oid==0) { ?>
                <center><?php echo $lang['flotte']['keineflotte']; ?></center>
            <?php } else { ?>
                <center><?php echo $lang['flotte']['ordnerleer']; ?></center>
                <?php
            }
        }
    include ("inc.footer.php");
}
if ($fuid==2) {
    include ("inc.header.php");
    $oid=int_get('oid');
    if (!$oid) {
        $zeiger = @mysql_query("SELECT id,ordner,besitzer FROM $skrupel_schiffe where besitzer=$spieler and id=$shid");
        $array = @mysql_fetch_array($zeiger);
        $oid=$array["ordner"];
    }
    ?>
    <frameset framespacing="0" border="false" frameborder="0" cols="*,26,230,239,400,26,*">
        <frame name="randlinks" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=14&bildpfad=<?php echo $bildpfad; ?>" target="_self">
        <frame name="pfeillinks" scrolling="no" marginwidth="0" marginheight="0" noresize src="flotte.php?fu=7&oid=<?php echo $oid; ?>&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" target="_self">
        <frame name="ship" scrolling="no" marginwidth="0" marginheight="0" noresize src="flotte.php?fu=3&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" target="_self">
        <?php if ($zug_abgeschlossen==0) { ?>
            <frame name="shipsmenu" scrolling="no" marginwidth="0" marginheight="0" noresize src="flotte.php?fu=4&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" target="_self">
            <frame name="shipsdetails" scrolling="auto" marginwidth="0" marginheight="0" noresize src="flotte_alpha.php?fu=1&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" target="_self">
        <?php } else { ?>
            <frame name="shipsmenu" scrolling="no" marginwidth="0" marginheight="0" noresize src="flotte.php?fu=5&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" target="_self">
            <frame name="shipsdetails" scrolling="auto" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=14" target="_self">
        <?php } ?>
        <frame name="pfeilrechts" scrolling="no" marginwidth="0" marginheight="0" noresize src="flotte.php?fu=8&oid=<?php echo $oid; ?>&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" target="_self">
        <frame name="randrechts" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=14&bildpfad=<?php echo $bildpfad; ?>" target="_self">
    </frameset>
    <noframes>
    <body>
        <?php
    include ("inc.footer.php");
}
if ($fuid==3) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_schiffe where besitzer=$spieler and id=$shid");
    $schiffanzahl = @mysql_num_rows($zeiger);
    $ok = @mysql_data_seek($zeiger,$schritt);
    $array = @mysql_fetch_array($zeiger);
    $shid=$array["id"];
    $name=$array["name"];
    $klasse=$array["klasse"];
    $antrieb=$array["antrieb"];
    $klasseid=$array["klasseid"];
    $kox=$array["kox"];
    $koy=$array["koy"];
    $flug=$array["flug"];
    $zielx=$array["zielx"];
    $ziely=$array["ziely"];
    $zielid=$array["zielid"];
    $volk=$array["volk"];
    $bild=$array["bild_klein"];
    $erfahrung=$array["erfahrung"];
    $ordner=$array["ordner"];
    $crew=$array["crew"];
    $crewmax=$array["crewmax"];
    $crewmax_d=max(1,$array["crewmax"]);
    $lemin=$array["lemin"];
    $leminmax=$array["leminmax"];
    $leminmax_d=max(1,$array["leminmax"]);
    $schaden=$array["schaden"];
    $frachtraum=$array["frachtraum"];
    $frachtraum_d=max(1,$array["frachtraum"]);
    $fracht_leute=$array["fracht_leute"];
    $leichtebt=$array["leichtebt"];
    $schwerebt=$array["schwerebt"];
    $fracht_cantox=$array["fracht_cantox"];
    $fracht_vorrat=$array["fracht_vorrat"];
    $fracht_min1=$array["fracht_min1"];
    $fracht_min2=$array["fracht_min2"];
    $fracht_min3=$array["fracht_min3"];
    $fracht=round(($fracht_leute/100)+($leichtebt*0.3)+($schwerebt*1.5))+$fracht_vorrat+$fracht_min1+$fracht_min2+$fracht_min3;
    $routing_koord=$array["routing_koord"];
    $routing_status=$array["routing_status"];
    $routing_schritt=$array["routing_schritt"];
    $route_tip='';
    if ($routing_status>=1) {
        $routing_points_temp=explode("::",$routing_koord);
        $schritte=count($routing_points_temp);
        for ($n=0;$n<$schritte-1;$n++) {
            $routing_points=explode(":",$routing_points_temp[($n+$routing_schritt)%($schritte-1)]);
            $zielx=$routing_points[0];
            $ziely=$routing_points[1];
            $zeiger_temp = @mysql_query("SELECT name FROM $skrupel_planeten where x_pos=$zielx and y_pos=$ziely and spiel=$spiel");
            $array_temp = @mysql_fetch_array($zeiger_temp);
            $pname=$array_temp["name"];
            $route_tip=$route_tip.'-> '.$pname.' ';
        }
    }
    ?>
    <body text="#000000" background="<?php echo $bildpfad; ?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="movemap(<?php echo $kox.",".$koy;  ?>);">
        <script language=JavaScript>
            function fensterbreit(){
                if (parent.parent.mittemitte.window.innerWidth) return parent.parent.mittemitte.window.innerWidth;
                else if (parent.parent.mittemitte.document.body && parent.parent.mittemitte.document.body.offsetWidth) return parent.parent.mittemitte.document.body.offsetWidth;
                else return 0;
            }
            function fensterhoch(){
                if (parent.parent.mittemitte.window.innerHeight) return parent.parent.mittemitte.window.innerHeight;
                else if (parent.parent.mittemitte.document.body && parent.parent.mittemitte.document.body.offsetHeight) return parent.parent.mittemitte.document.body.offsetHeight;
                else return 0;
            }
            function movemap(wertx,werty) {
                breite=fensterbreit();
                hoch=fensterhoch();
                aktuellx=wertx-15;
                aktuelly=werty-15;
                wertx=wertx-(breite/2);
                werty=werty-(hoch/2);
                <?php if (@intval(substr($spieler_optionen,17,1))!=1) { ?>
                    var scrollDiv = parent.parent.mittemitte.document.getElementById("complete");
                    if(scrollDiv.contentScroll) scrollDiv.contentScroll(wertx,werty,false);
                <?php } else { ?>
                    parent.parent.mittemitte.document.getElementById("complete").scrollLeft = wertx;
                    parent.parent.mittemitte.document.getElementById("complete").scrollTop = werty; 
                <?php } ?>
                parent.parent.mittemitte.document.getElementById("aktuell").style.visibility='visible';
                parent.parent.mittemitte.document.getElementById("aktuell").style.left=aktuellx;
                parent.parent.mittemitte.document.getElementById("aktuell").style.top=aktuelly;
            }
            function linksub(url) {
                if (parent.parent.mittelinksoben.document.globals.kursmodus.value==1) {
                    alert('<?php echo html_entity_decode($lang['flotte']['nochkursmodus'])?>');
                } else {
                    parent.shipsdetails.window.location=url;
                }
            }
            function linktop(url) {
                if (parent.parent.mittelinksoben.document.globals.kursmodus.value==1) {
                    alert('<?php echo html_entity_decode($lang['flotte']['nochkursmodus'])?>');
                } else {
                    parent.window.location=url;
                }
            }
            function schiffdetail(shid,volk) {
                oben=100;
                links=Math.ceil((screen.width-580)/2);
                window.open('hilfe_schiff.php?fu2='+shid+'&volk='+volk+'&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>','Hilfe','resizable=yes,scrollbars=no,width=580,height=180,top='+oben+',left='+links);
            }
            function hilfe_spionage_schiff(shid) {
                oben=100;
                links=Math.ceil((screen.width-480)/2);
                window.open('hilfe_spionage.php?fu2=4&spid='+shid+'&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>','Hilfe','resizable=yes,scrollbars=no,width=480,height=200,top='+oben+',left='+links);
            }
        </script>
        <table  border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td colspan="3"><img src="../bilder/empty.gif" border="0" width="10" height="5"></td>
            </tr>
            <tr>
                <td><img src="../bilder/empty.gif" border="0" width="8" height="1"></td>
                <td>
                    <table border="0" cellspacing="0" cellpadding="0" width="100%">
                        <tr>
                            <td>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td><nobr><?php echo $name; ?></nobr></td>
                                    </tr>
                                    <?php
                                    if($module[0] && $volk == 'unknown' && $klasseid == 1) {
                                        $klasse_link = "javascript:hilfe_spionage_schiff($shid);";
                                    }else {
                                        $klasse_link = "javascript:schiffdetail($klasseid,'$volk');";
                                    }
                                    ?>
                                    <tr>
                                        <td><nobr><a href="<?php echo $klasse_link;/*/--/*/?>" style="color:#ffffff;"><?php echo $klasse; ?></a></nobr></td>
                                    </tr>
                                </table>
                            </td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                            <?php if ($erfahrung>=1) { ?>
                                <td width="100%"><img src="<?php echo $bildpfad; ?>/icons/erf_<?php echo $erfahrung; ?>.gif" title="<?php echo $lang['flotte']['erfahrungslevel']." ".$erfahrung; ?>" border="0" width="22" height="22"></td>
                            <?php } ?>
                            <td align="right" <?php if ($erfahrung==0) { ?>width="100%"<?php } ?>>
                                <a href="javascript:linktop('flotte.php?fu=1&oid=<?php echo $ordner; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');document.body.focus();">
                                    <img src="<?php echo $bildpfad; ?>/icons/flotteordner.gif" title="<?php echo $lang['flotte']['ordneruebersicht']?>" border="0" width="22" height="22">
                                </a>
                            </td>
                        </tr>
                    </table>
                </td>
                <td><img src="../bilder/empty.gif" border="0" width="8" height="1"></td>
            </tr>
            <tr>
                <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                <?php
                if ($flug==0) {
                    if (($routing_status==2) or ($routing_status==1)) {
                        ?>
                        <td><div id="auftrag" style="color:#009900;"><nobr>
                            <?php 
                            echo $lang['flotte']['route']." ";
                            if (($routing_status==2) or ($routing_status==1)) {
                                ?>
                                <a href="#" title="<?php echo $route_tip; ?>"><?php echo $lang['flotte']['r']; ?></a>
                                <?php
                            }
                            ?>
                        </nobr></div></td>
                    <?php } else { ?>
                        <td><div id="auftrag" style="color:#990000;"><nobr><?php echo $lang['flotte']['keinauftrag']; ?></nobr></div></td>
                        <?php
                    }
                }elseif ($flug==1) {
                    ?>
                    <td><div id="auftrag" style="color:#009900;"><?php echo str_replace('{1}'," ".$zielx."/".$ziely." ",$lang['flotte']['unterwegsnach']); ?></div></td>
                    <?php
                }elseif ($flug==2) {
                    $zeiger_temp = @mysql_query("SELECT id,name FROM $skrupel_planeten where id=$zielid");
                    $array_temp = @mysql_fetch_array($zeiger_temp);
                    $planeten_name=$array_temp["name"];
                    ?>
                    <td><div id="auftrag" style="color:#009900;">
                        <?php
                        echo str_replace('{1}'," ".$planeten_name." ",$lang['flotte']['unterwegsnach']);
                        if (($routing_status==2) or ($routing_status==1)) {
                            ?>
                            <a href="#" title="<?php echo $route_tip; ?>"><?php echo $lang['flotte']['r']; ?></a>
                            <?php
                        }
                        ?>
                    </div></td>
                    <?php
                }elseif ($flug==3) {
                    ?>
                    <td><div id="auftrag" style="color:#009900;"><?php echo $lang['flotte']['versuchterfeindkontakt']; ?></div></td>
                    <?php
                }elseif ($flug==4) {
                    ?>
                    <td><div id="auftrag" style="color:#009900;"><?php echo $lang['flotte']['begleitschutz']; ?></div></td>
                    <?php
                }
                ?>
                <td><img src="../bilder/empty.gif" border="0" width="8" height="1"></td>
            </tr>
            <tr>
                <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="200" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="8" height="1"></td>
            </tr>
            <tr>
                <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                <td>
                    <table  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="2" height="1"></td>
                            <td>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                        <td>
                                            <a href="javascript:;" onclick="movemap(<?php echo $kox.",".$koy;  ?>);">
                                                <img src="../daten/<?php echo $volk; ?>/bilder_schiffe/<?php echo $bild; ?>" border="0" width="75" height="50">
                                            </a>
                                        </td>
                                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                    </tr>
                                </table>
                            </td>
                            <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                            <td>
                                <center>
                                    <table  border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td><img src="../bilder/empty.gif" border="0" width="130" height="2"></td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#990000"><div style="position: absolute; z-index:1; background-image:url(<?php echo $bildpfad; ?>/skalen/gruen_1_r.gif); width:<?php echo (100-$schaden)*1.3; ?>;"><img src="../bilder/empty.gif" border="0" width="<?php echo (100-$schaden)*1.3; ?>" height="12"></div><div style="position: absolute; z-index:2; color: #151515;"><?php echo str_replace('{1}',$schaden,$lang['flotte']['schaden'])?></div></td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#990000"><img src="../bilder/empty.gif" border="0" width="130" height="11"></td>
                                        </tr>
                                        <tr>
                                            <td><img src="../bilder/empty.gif" border="0" width="1" height="2"></td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#990000"><div style="position: absolute; z-index:1; background-image:url(<?php echo $bildpfad; ?>/skalen/hellblau_1_r.gif); width:<?php echo (130*$crew/$crewmax_d); ?>;"><img src="../bilder/empty.gif" border="0" width="<?php echo (130*$crew/$crewmax); ?>" height="12"></div><div style="position: absolute; z-index:2; color:#151515;"><?php echo str_replace('{2}',$crewmax,str_replace('{1}',$crew,$lang['flotte']['crew']))?></div></td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#990000"><img src="../bilder/empty.gif" border="0" width="130" height="11"></td>
                                        </tr>
                                        <tr>
                                            <td><img src="../bilder/empty.gif" border="0" width="1" height="2"></td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#990000"><div style="position: absolute; z-index:1; background-image:url(<?php echo $bildpfad; ?>/skalen/gold_1_r.gif); width:<?php echo (130*$lemin/$leminmax_d); ?>;"><img src="../bilder/empty.gif" border="0" width="<?php echo (130*$lemin/$leminmax); ?>" height="12"></div><div style="position: absolute; z-index:2; color:#151515;"><?php echo str_replace('{2}',$leminmax,str_replace('{1}',$lemin,$lang['flotte']['lemin']))?></div></td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#990000"><img src="../bilder/empty.gif" border="0" width="130" height="11"></td>
                                        </tr>
                                        <tr>
                                            <td><img src="../bilder/empty.gif" border="0" width="1" height="2"></td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#990000"><div style="position: absolute; z-index:1; background-image:url(<?php echo $bildpfad; ?>/skalen/grau_1_r.gif); width:<?php echo (130*$fracht/$frachtraum_d); ?>;"><img src="../bilder/empty.gif" border="0" width="<?php echo (130*$fracht/$frachtraum_d); ?>" height="12"></div><div style="position: absolute; z-index:2; color:#151515;"><?php echo str_replace('{2}',$frachtraum,str_replace('{1}',$fracht,$lang['flotte']['fracht']))?></div></td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#990000"><img src="../bilder/empty.gif" border="0" width="130" height="11"></td>
                                        </tr>
                                    </table>
                                </center>
                            </td>
                            <td><img src="../bilder/empty.gif" border="0" width="2" height="1"></td>
                        </tr>
                    </table>
                </td>
                <td><img src="../bilder/empty.gif" border="0" width="8" height="1"></td>
            </tr>
        </table>
        <?php
    include ("inc.footer.php");
}
if ($fuid==4) {
    include ("inc.header.php");
    ?>
    <script language=JavaScript>
        function linksub(url) {
            if (parent.parent.mittelinksoben.document.globals.kursmodus.value==1) {
                alert('<?php echo html_entity_decode($lang['flotte']['nochkursmodus'])?>');
            } else {
                parent.shipsdetails.window.location=url;
            }
        }
    </script>
    <body text="#000000" background="<?php echo $bildpfad; ?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td><img src="../bilder/empty.gif" border="0" width="239" height="6"></td>
            </tr>
            <tr>
                <td><img src="<?php echo $bildpfad; ?>/konsole/schiffe.gif" border="0" width="239" height="95" usemap="#konsole"></td>
            </tr>
        </table>
        <map name="konsole">
            <area shape=rect coords="26,16,53,36" href="javascript:linksub('flotte_alpha.php?fu=1&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');self.focus();" title="<?php echo $lang['flotte']['kurs']; ?>">
            <area shape=rect coords="72,11,99,40" href="javascript:linksub('flotte_alpha.php?fu=3&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');self.focus();" title="<?php echo $lang['flotte']['spezialmission']; ?>">
            <area shape=rect coords="118,12,148,40" href="javascript:linksub('flotte_alpha.php?fu=5&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');self.focus();" title="<?php echo $lang['flotte']['routing']; ?>">
            <area shape=rect coords="25,59,52,83" href="javascript:linksub('flotte_beta.php?fu=1&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');self.focus();" title="<?php echo $lang['flotte']['scanning']; ?>">
            <?php if(@intval(substr($spieler_optionen,13,1))==1) { ?>
                <area shape=rect coords="72,57,100,85" href="javascript:linksub('flotte_beta.php?fu=6&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');self.focus();" title="<?php echo $lang['flotte']['transporterraum']; ?>">
            <?php } else { ?>
                <area shape=rect coords="72,57,100,85" href="javascript:linksub('flotte_beta.php?fu=4&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');self.focus();" title="<?php echo $lang['flotte']['transporterraum']; ?>">
            <?php } ?>
            <area shape=rect coords="116,61,146,84" href="javascript:linksub('flotte_beta.php?fu=8&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');self.focus();" title="<?php echo $lang['flotte']['logbuch']; ?>">
            <area shape=rect coords="163,15,182,29" href="javascript:linksub('flotte_gamma.php?fu=1&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');self.focus();" title="<?php echo $lang['flotte']['waffensysteme']; ?>">
            <?php if(@intval(substr($spieler_optionen,13,1))==1) { ?>
                <area shape=rect coords="163,40,182,56" href="javascript:linksub('flotte_gamma.php?fu=5&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');self.focus();" title="<?php echo $lang['flotte']['aggressivitaet']; ?>">
            <?php } else { ?>
                <area shape=rect coords="163,40,182,56" href="javascript:linksub('flotte_gamma.php?fu=2&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');self.focus();" title="<?php echo $lang['flotte']['aggressivitaet']; ?>">
            <?php } ?>
            <area shape=rect coords="163,65,182,86" href="javascript:linksub('flotte_gamma.php?fu=4&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');self.focus();" title="<?php echo $lang['flotte']['lagerraeume']; ?>">
            <area shape=rect coords="194,15,213,29" href="javascript:linksub('flotte_delta.php?fu=1&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');self.focus();" title="<?php echo $lang['flotte']['projektillager']; ?>">
            <area shape=rect coords="194,40,213,56" href="javascript:linksub('flotte_delta.php?fu=4&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');self.focus();" title="<?php echo $lang['flotte']['antriebssysteme']; ?>">
            <area shape=rect coords="194,65,213,86" href="javascript:linksub('flotte_delta.php?fu=5&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');self.focus();" title="<?php echo $lang['flotte']['optionen']; ?>">
        </map>
        <?php
    include ("inc.footer.php");
}
if ($fuid==5) {
    include ("inc.header.php");
    ?>
    <body text="#000000" background="<?php echo $bildpfad; ?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <script language=JavaScript>
            function linksub(url) {
                if (parent.parent.mittelinksoben.document.globals.kursmodus.value==1) {
                    alert('<?php echo html_entity_decode($lang['flotte']['nochkursmodus'])?>');
                } else {
                    parent.shipsdetails.window.location=url;
                }
        }
        </script>
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td><img src="../bilder/empty.gif" border="0" width="239" height="6"></td>
            </tr>
            <tr>
                <td><img src="<?php echo $bildpfad; ?>/konsole/schiffe_no.gif" border="0" width="239" height="95" usemap="#konsole"></td>
            </tr>
        </table>
        <map name="konsole">
            <area shape=rect coords="25,59,52,83" href="javascript:linksub('flotte_beta.php?fu=1&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');self.focus();" title="<?php echo $lang['flotte']['scanning']; ?>">
            <area shape=rect coords="116,61,146,84" href="javascript:linksub('flotte_beta.php?fu=8&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');self.focus();" title="<?php echo $lang['flotte']['logbuch']; ?>">
            <area shape=rect coords="163,15,182,29" href="javascript:linksub('flotte_gamma.php?fu=1&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');self.focus();" title="<?php echo $lang['flotte']['waffensysteme']; ?>">
            <area shape=rect coords="163,65,182,86" href="javascript:linksub('flotte_gamma.php?fu=4&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');self.focus();" title="<?php echo $lang['flotte']['lagerraeume']; ?>">
            <area shape=rect coords="194,40,213,56" href="javascript:linksub('flotte_delta.php?fu=4&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');self.focus();" title="<?php echo $lang['flotte']['antriebssysteme']; ?>">
            <area shape=rect coords="194,65,213,86" href="javascript:linksub('flotte_delta.php?fu=5&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');self.focus();" title="<?php echo $lang['flotte']['optionen']; ?>">
        </map>
        <?php
    include ("inc.footer.php");
}
if ($fuid==6) {
    include ("inc.header.php");
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <script language=JavaScript>
            function fensterbreit(){
                if (parent.parent.mittemitte.window.innerWidth) return parent.parent.mittemitte.window.innerWidth;
                else if (parent.parent.mittemitte.document.body && parent.parent.mittemitte.document.body.offsetWidth) return parent.parent.mittemitte.document.body.offsetWidth;
                else return 0;
            }
            function fensterhoch(){
                if (parent.parent.mittemitte.window.innerHeight) return parent.parent.mittemitte.window.innerHeight;
                else if (parent.parent.mittemitte.document.body && parent.parent.mittemitte.document.body.offsetHeight) return parent.parent.mittemitte.document.body.offsetHeight;
                else return 0;
            }
            function movemap(wertx,werty) {
                breite=fensterbreit();
                hoch=fensterhoch();
                aktuellx=wertx-15;
                aktuelly=werty-15;
                wertx=wertx-(breite/2);
                werty=werty-(hoch/2);
                <?php if (@intval(substr($spieler_optionen,17,1))!=1) { ?>
                    var scrollDiv = parent.parent.mittemitte.document.getElementById("complete");
                    if(scrollDiv.contentScroll) scrollDiv.contentScroll(wertx,werty,false);
                <?php } else { ?>
                    parent.parent.mittemitte.document.getElementById("complete").scrollLeft = wertx;
                    parent.parent.mittemitte.document.getElementById("complete").scrollTop = werty; 
                <?php } ?>
                parent.parent.mittemitte.document.getElementById("aktuell").style.visibility='visible';
                parent.parent.mittemitte.document.getElementById("aktuell").style.left=aktuellx;
                parent.parent.mittemitte.document.getElementById("aktuell").style.top=aktuelly;
            }
        </script>
        <?php
        $flottex=int_get('flottex');
        $flottey=int_get('flottey');
        $zeiger = @mysql_query("SELECT * FROM $skrupel_schiffe where besitzer=$spieler and status>0 and spiel=$spiel and kox=$flottex and koy=$flottey order by name");
        $schiffanzahl = @mysql_num_rows($zeiger);
        if ($schiffanzahl>=1) {
            ?>
            <center>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <?php
                                    for  ($i=0; $i<$schiffanzahl;$i++) {
                                        $ok = @mysql_data_seek($zeiger,$i);
                                        $array = @mysql_fetch_array($zeiger);
                                        $shid=$array["id"];
                                        $name=$array["name"];
                                        $klasse=$array["klasse"];
                                        $antrieb=$array["antrieb"];
                                        $klasseid=$array["klasseid"];
                                        $kox=$array["kox"];
                                        $koy=$array["koy"];
                                        $flug=$array["flug"];
                                        $zielx=$array["zielx"];
                                        $ziely=$array["ziely"];
                                        $zielid=$array["zielid"];
                                        $volk=$array["volk"];
                                        $bild=$array["bild_gross"];
                                        $erfahrung=$array["erfahrung"];
                                        $crew=$array["crew"];
                                        $crewmax=$array["crewmax"];
                                        $crewmax_d=max(1,$array["crewmax"]);
                                        $lemin=$array["lemin"];
                                        $leminmax=$array["leminmax"];
                                        $leminmax_d=max(1,$array["leminmax"]);
                                        $schaden=$array["schaden"];
                                        $routing_status=$array["routing_status"];
                                        $logbuch=$array["logbuch"];
                                        $tarnfeld=$array["tarnfeld"];
                                        $ordner=$array["ordner"];
                                        $frachtraum=$array["frachtraum"];
                                        $frachtraum_d=max(1,$array["frachtraum"]);
                                        $fracht_leute=$array["fracht_leute"];
                                        $leichtebt=$array["leichtebt"];
                                        $schwerebt=$array["schwerebt"];
                                        $fracht_cantox=$array["fracht_cantox"];
                                        $fracht_vorrat=$array["fracht_vorrat"];
                                        $fracht_min1=$array["fracht_min1"];
                                        $fracht_min2=$array["fracht_min2"];
                                        $fracht_min3=$array["fracht_min3"];
                                        $fracht=round(($fracht_leute/100)+($leichtebt*0.3)+($schwerebt*1.5))+$fracht_vorrat+$fracht_min1+$fracht_min2+$fracht_min3;
                                        $routing_koord=$array["routing_koord"];
                                        $routing_status=$array["routing_status"];
                                        $routing_schritt=$array["routing_schritt"];
                                        $route_tip='';
                                        if ($routing_status>=1) {
                                            $routing_points_temp=explode("::",$routing_koord);
                                            $schritte=count($routing_points_temp);
                                            for ($n=0;$n<$schritte-1;$n++) {
                                                $routing_points=explode(":",$routing_points_temp[($n+$routing_schritt)%($schritte-1)]);
                                                $zielx=$routing_points[0];
                                                $ziely=$routing_points[1];
                                                $zeiger_temp = @mysql_query("SELECT name FROM $skrupel_planeten where x_pos=$zielx and y_pos=$ziely and spiel=$spiel");
                                                $array_temp = @mysql_fetch_array($zeiger_temp);
                                                $pname=$array_temp["name"];
                                                $route_tip=$route_tip.'-> '.$pname.' ';
                                            }
                                        }
                                        $tip="[$name]";
                                        $tip=$tip."\n";
                                        $tip=$tip."\n".$lang['flotte']['kol'].": ".$fracht_leute." ".$lang['flotte']['cx'].": ".$fracht_cantox." ".$lang['flotte']['vor'].": ".$fracht_vorrat;
                                        $tip=$tip."\n".$lang['flotte']['bax'].": ".$fracht_min1." ".$lang['flotte']['ren'].": ".$fracht_min2." ".$lang['flotte']['vom'].": ".$fracht_min3;
                                        if (strlen($logbuch)>=1) {
                                            $tip=$tip."\n";
                                            $tip=$tip."\n$logbuch";
                                        }
                                        if ($tarnfeld>=1) {
                                            ?>
                                            <td>
                                                <table border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td background="<?php echo $bildpfad; ?>/aufbau/tarnrand.gif" colspan="3">
                                                            <img src="../bilder/empty.gif" border="0" width="1" height="1">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td background="<?php echo $bildpfad; ?>/aufbau/tarnrand.gif">
                                                            <img src="../bilder/empty.gif" border="0" width="1" height="1">
                                                        </td>
                                                        <td bgcolor="#000000">
                                                            <a href="flotte.php?fu=2&shid=<?php echo $shid; ?>&oid=<?php echo $ordner; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>">
                                                                <img src="../daten/<?php echo $volk; ?>/bilder_schiffe/<?php echo $bild; ?>" border="0"  height="80" title="<?php echo $tip; ?>" style="filter:alpha(opacity=50);" onmouseover="this.style.filter='alpha(opacity=100)';" onmouseout="this.style.filter='alpha(opacity=50)';">
                                                            </a>
                                                        </td>
                                                        <td background="<?php echo $bildpfad; ?>/aufbau/tarnrand.gif">
                                                            <img src="../bilder/empty.gif" border="0" width="1" height="1">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td background="<?php echo $bildpfad; ?>/aufbau/tarnrand.gif" colspan="3">
                                                            <img src="../bilder/empty.gif" border="0" width="1" height="1">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <?php
                                        } else {
                                            ?>
                                            <td>
                                                <table border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                        <td>
                                                            <a href="flotte.php?fu=2&shid=<?php echo $shid; ?>&oid=<?php echo $ordner; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>">
                                                                <img src="../daten/<?php echo $volk; ?>/bilder_schiffe/<?php echo $bild; ?>" border="0"  height="80" title="<?php echo $tip; ?>">
                                                            </a>
                                                        </td>
                                                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <?php
                                        }
                                        ?>
                                        <td>
                                            <table border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td bgcolor="#990000" valign="bottom"><img src="<?php echo $bildpfad; ?>/skalen/gruen_1.gif" border="0" width="10" height="<?php echo 82-($schaden*0.82); ?>" title="<?php echo str_replace('{1}',$schaden,$lang['flotte']['schaden'])?>"></td>
                                                    <td><img src="../bilder/empty.gif" border="0" width="1" height="82"></td>
                                                    <td bgcolor="#990000" valign="bottom"><img src="<?php echo $bildpfad; ?>/skalen/hellblau_1.gif" border="0" width="10" height="<?php echo 82*$crew/$crewmax_d; ?>" title="<?php echo str_replace('{2}',$crewmax,str_replace('{1}',$crew,$lang['flotte']['crew']))?>"></td>
                                                    <td><img src="../bilder/empty.gif" border="0" width="1" height="82"></td>
                                                    <td bgcolor="#990000" valign="bottom"><img src="<?php echo $bildpfad; ?>/skalen/gold_1.gif" border="0" width="10" height="<?php echo 82*$lemin/$leminmax_d; ?>" title="<?php echo str_replace('{2}',$leminmax,str_replace('{1}',$lemin,$lang['flotte']['lemin']))?>"></td>
                                                    <td><img src="../bilder/empty.gif" border="0" width="1" height="82"></td>
                                                    <td bgcolor="#990000" valign="bottom"><img src="<?php echo $bildpfad; ?>/skalen/grau_1.gif" border="0" width="10" height="<?php echo 82*$fracht/$frachtraum_d; ?>" title="<?php echo str_replace('{2}',$frachtraum,str_replace('{1}',$fracht,$lang['flotte']['fracht']))?>"></td>
                                                    <td><img src="../bilder/empty.gif" border="0" width="6" height="80"></td>
                                                    <td>
                                                        <table border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td>
                                                                    <center>
                                                                        <a href="javascript:;" onclick="movemap(<?php echo $kox.",".$koy;  ?>);">
                                                                            <?php
                                                                            if ($erfahrung==0) {
                                                                                ?>
                                                                                <img src="<?php echo $bildpfad; ?>/karte/farben/schiff_aktiv_<?php echo $spieler; ?>.gif" border="0" width="15" height="15">
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <img src="<?php echo $bildpfad; ?>/icons/erf_<?php echo $erfahrung; ?>.gif" title="<?php echo $lang['flotte']['erfahrungslevel']." ".$erfahrung; ?>" border="0" width="22" height="22">
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </a>
                                                                    </center>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><img src="../bilder/empty.gif" border="0" width="10" height="5"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><nobr><center><?php echo $name; ?></center></nobr></td>
                                                            </tr>
                                                            <tr>
                                                                <td><img src="../bilder/empty.gif" border="0" width="10" height="5"></td>
                                                            </tr>
                                                            <tr>
                                                                <?php
                                                                if ($flug==0) {
                                                                    if (($routing_status==2) or ($routing_status==1)) {
                                                                        ?>
                                                                        <td style="color:#009900;">
                                                                            <nobr><center>
                                                                                <?php echo $lang['flotte']['route']." "; ?>
                                                                                <a href="#" title="<?php echo $route_tip; ?>"><?php echo $lang['flotte']['r']; ?></a>
                                                                            </center></nobr>
                                                                        </td>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <td style="color:#990000;"><nobr><center><?php echo $lang['flotte']['keinauftrag']; ?></center></nobr></td>
                                                                        <?php
                                                                    }
                                                                }elseif ($flug==1) { ?>
                                                                    <td style="color:#009900;"><nobr><center><?php echo str_replace('{1}',"<br>".$zielx."/".$ziely,$lang['flotte']['unterwegsnach']); ?></center></nobr></td>
                                                                    <?php
                                                                }elseif ($flug==2) {
                                                                    $zeiger_temp = @mysql_query("SELECT id,name FROM $skrupel_planeten where id=$zielid");
                                                                    $array_temp = @mysql_fetch_array($zeiger_temp);
                                                                    $planeten_name=$array_temp["name"];
                                                                    ?>
                                                                    <td style="color:#009900;">
                                                                        <nobr><center>
                                                                            <?php 
                                                                            echo str_replace('{1}',"<br>".$planeten_name." ",$lang['flotte']['unterwegsnach']);
                                                                            if (($routing_status==2) or ($routing_status==1)) {
                                                                                ?>
                                                                                <a href="#" title="<?php echo $route_tip; ?>"><?php echo $lang['flotte']['r']; ?></a>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </center></nobr>
                                                                    </td>
                                                                    <?php
                                                                }elseif ($flug==3) {
                                                                    ?>
                                                                    <td style="color:#009900;"><nobr><center><?php echo $lang['flotte']['versuchterfeindkontakt']; ?></center></nobr></td>
                                                                    <?php
                                                                }elseif ($flug==4) {
                                                                    $zeiger_temp = @mysql_query("SELECT id,name FROM $skrupel_schiffe where id=$zielid");
                                                                    $array_temp = @mysql_fetch_array($zeiger_temp);
                                                                    $schiff_name=$array_temp["name"];
                                                                    ?>
                                                                    <td style="color:#009900;"><nobr><center><?php echo $lang['flotte']['begleitschutz']; ?><br><?php echo $schiff_name; ?></center></nobr></td>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td><img src="../bilder/empty.gif" border="0" width="6" height="80"></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </center><?php
        } else { ?>
            <br><br><br><br>
            <center><?php echo $lang['flotte']['keineflotte']; ?></center>
            <?php
        }
    include ("inc.footer.php");
}
if ($fuid==7) {
    include ("inc.header.php");
    $oid=int_get('oid');
    ?>
    <script language=JavaScript>
        function linksub(url) {
            if (parent.parent.mittelinksoben.document.globals.kursmodus.value==1) {
                alert('<?php echo $lang['flotte']['nochkursmodus']; ?>');
            } else {
                parent.window.location=url;
            }
        }
    </script>
    <body text="#000000" scroll="no" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php
        $zeiger = @mysql_query("SELECT id,name,besitzer,status,spiel,flug FROM $skrupel_schiffe where besitzer=$spieler and ordner=$oid and status>0 and spiel=$spiel order by name");
        $schiffanzahl = @mysql_num_rows($zeiger);
        if ($schiffanzahl>=1) {
            for  ($i=0; $i<$schiffanzahl;$i++) {
                $ok = @mysql_data_seek($zeiger,$i);
                $array = @mysql_fetch_array($zeiger);
                $shid_t=$array["id"];
                if (($shid==$shid_t) and ($i>=1)) { ?>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="26" height="8"></td>
                        </tr>
                        <tr>
                            <td>
                                <a href="javascript:linksub('flotte.php?fu=2&shid=<?php echo $shid_back; ?>&oid=<?php echo $oid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');self.focus();">
                                    <img src="<?php echo $bildpfad; ?>/konsole/pfeil_links.gif" border="0" width="26" height="90">
                                </a>
                            </td>
                        </tr>
                    </table>
                    <?php
                }
                $shid_back=$shid_t;
            }
        }
    include ("inc.footer.php");
}
if ($fuid==8) {
    include ("inc.header.php");
    $oid=int_get('oid');
    ?>
    <script language=JavaScript>
        function linksub(url) {
            if (parent.parent.mittelinksoben.document.globals.kursmodus.value==1) {
                alert('<?php echo html_entity_decode($lang['flotte']['nochkursmodus']); ?>');
            } else {
                parent.window.location=url;
            }
        }
    </script>
    <body text="#000000" scroll="no" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php
        $zeiger = @mysql_query("SELECT id,name,besitzer,status,spiel,flug FROM $skrupel_schiffe where besitzer=$spieler and ordner=$oid and status>0 and spiel=$spiel order by name");
        $schiffanzahl = @mysql_num_rows($zeiger);
        if ($schiffanzahl>=1) {
            for  ($i=0; $i<$schiffanzahl;$i++) {
                $ok = @mysql_data_seek($zeiger,$i);
                $array = @mysql_fetch_array($zeiger);
                $shid_t=$array["id"];
                if ($shid==$shid_old) {
                    ?>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="26" height="8"></td>
                        </tr>
                        <tr>
                            <td>
                                <a href="javascript:linksub('flotte.php?fu=2&shid=<?php echo $shid_t; ?>&oid=<?php echo $oid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');self.focus();">
                                    <img src="<?php echo $bildpfad; ?>/konsole/pfeil_rechts.gif" border="0" width="26" height="90">
                                </a>
                            </td>
                        </tr>
                    </table>
                    <?php
                }
                $shid_old=$shid_t;
            }
        }
    include ("inc.footer.php");
}
