<?php 
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'uebersicht_kolonien';
$langfile_2 = 'orbitale_systeme';
$fuid = int_get('fu');

if ($fuid==1) {
    include ("inc.header.php");
    ?>
    <body text="#ffffff" bgcolor="#444444"  link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <script language=JavaScript>
            function nativedetail(shid) {
                oben=100;
                links=Math.ceil((screen.width-580)/2);
                window.open('hilfe_native.php?fu2='+shid+'&uid=<?php echo $uid?>&sid=<?php echo $sid?>','domspezien','resizable=yes,scrollbars=no,width=580,height=180,top='+oben+',left='+links);
            }
        </script>
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
        <center><img src="../lang/<?php echo $spieler_sprache?>/topics/kolonien.gif" border="0" width="162" height="52"></center>
        <?php 
        $zeiger = @mysql_query("SELECT * FROM $skrupel_planeten where besitzer=$spieler and spiel=$spiel order by name");
        $planetenanzahl = @mysql_num_rows($zeiger);
        if ($planetenanzahl>=1) {
            ?>
            <center>
                <table border="0" cellspacing="0" cellpadding="0">
                    <?php 
                    for  ($i=0; $i<$planetenanzahl;$i++) {
                        $ok = @mysql_data_seek($zeiger,$i);
                        $array = @mysql_fetch_array($zeiger);
                        $pid=$array["id"];
                        $name=$array["name"];
                        $x_pos=$array["x_pos"];
                        $y_pos=$array["y_pos"];
                        $bild=$array["bild"];
                        $kolonisten=$array["kolonisten"];
                        $schwerebt=$array["schwerebt"];
                        $leichtebt=$array["leichtebt"];
                        $lemin=$array["lemin"];
                        $min1=$array["min1"];
                        $min2=$array["min2"];
                        $min3=$array["min3"];
                        $minen=$array["minen"];
                        $cantox=$array["cantox"];
                        $vorrat=$array["vorrat"];
                        $fabriken=$array["fabriken"];
                        $abwehr=$array["abwehr"];
                        $logbuch=$array["logbuch"];
                        $auto_minen=$array["auto_minen"];
                        $auto_fabriken=$array["auto_fabriken"];
                        $auto_abwehr=$array["auto_abwehr"];
                        $auto_vorrat=$array["auto_vorrat"];
                        $sternenbasis=$array["sternenbasis"];
                        $sternenbasis_id=$array["sternenbasis_id"];
                        $sternenbasis_art=$array["sternenbasis_art"];
                        $native_id=$array["native_id"];
                        $native_name=$array["native_name"];
                        $native_art_name=$array["native_art_name"];
                        $native_abgabe=$array["native_abgabe"];
                        $native_bild=$array["native_bild"];
                        $native_text=$array["native_text"];
                        $native_kol=$array["native_kol"];
                        $osys_anzahl=$array["osys_anzahl"];
                        $osys[1]=$array["osys_1"];
                        $osys[2]=$array["osys_2"];
                        $osys[3]=$array["osys_3"];
                        $osys[4]=$array["osys_4"];
                        $osys[5]=$array["osys_5"];
                        $osys[6]=$array["osys_6"];
                        for($i2=1; $i2<=$osys_anzahl; $i2++) {
                            if ($osys[$i2]>=1) {
                                $osys[$i2] = "<img src=\"../bilder/osysteme/".$osys[$i2].".gif\" border=\"0\" width=\"32\" height=\"30\" title=\"".$lang['orbitalesysteme']['name'][$osys[$i2]]."\">";
                            } else {
                                $osys[$i2] = "<img src=\"../bilder/osysteme/blank.gif\" border=\"0\" width=\"32\" height=\"30\">";
                            }
                        }
                        for($i2=6; $i2>$osys_anzahl; $i2--) {
                            $osys[$i2] = "<img src=\"../bilder/empty.gif\" border=\"0\" width=\"32\" height=\"30\">";
                        }
                        $temp=$array["temp"];
                        $klasse=$array["klasse"];
                        if ($klasse==1) {
                            $klassename="M";
                        }elseif ($klasse==2) {
                            $klassename="N";
                        }elseif ($klasse==3) {
                            $klassename="J";
                        }elseif ($klasse==4) {
                            $klassename="L";
                        }elseif ($klasse==5) {
                            $klassename="G";
                        }elseif ($klasse==6) {
                            $klassename="I";
                        }elseif ($klasse==7) {
                            $klassename="C";
                        }elseif ($klasse==8) {
                            $klassename="K";
                        }elseif ($klasse==9) {
                            $klassename="F";
                        }
                        $planet_lemin=$array["planet_lemin"];
                        $planet_min1=$array["planet_min1"];
                        $planet_min2=$array["planet_min2"];
                        $planet_min3=$array["planet_min3"];
                        $konz_lemin=$array["konz_lemin"];
                        $konz_min1=$array["konz_min1"];
                        $konz_min2=$array["konz_min2"];
                        $konz_min3=$array["konz_min3"];
                        if ($konz_lemin==1) {
                            $konz_lemin="fl&uuml;chtig";
                        }elseif ($konz_lemin==2) {
                            $konz_lemin="weit gestreut";
                        }elseif ($konz_lemin==3) {
                            $konz_lemin="verteilt";
                        }elseif ($konz_lemin==4) {
                            $konz_lemin="konzentriert";
                        }elseif ($konz_lemin==5) {
                            $konz_lemin="hochkonz.";
                        }
                        if ($konz_min1==1) {
                            $konz_min1="fl&uuml;chtig";
                        }elseif ($konz_min1==2) {
                            $konz_min1="weit gestreut";
                        }elseif ($konz_min1==3) {
                            $konz_min1="verteilt";
                        }elseif ($konz_min1==4) {
                            $konz_min1="konzentriert";
                        }elseif ($konz_min1==5) {
                            $konz_min1="hochkonz.";
                        }
                        if ($konz_min2==1) {
                            $konz_min2="fl&uuml;chtig";
                        }elseif ($konz_min2==2) {
                            $konz_min2="weit gestreut";
                        }elseif ($konz_min2==3) {
                            $konz_min2="verteilt";
                        }elseif ($konz_min2==4) {
                            $konz_min2="konzentriert";
                        }elseif ($konz_min2==5) {
                            $konz_min2="hochkonz.";
                        }
                        if ($konz_min3==1) {
                            $konz_min3="fl&uuml;chtig";
                        }elseif ($konz_min3==2) {
                            $konz_min3="weit gestreut";
                        }elseif ($konz_min3==3) {
                            $konz_min3="verteilt";
                        }elseif ($konz_min3==4) {
                            $konz_min3="konzentriert";
                        }elseif ($konz_min3==5) {
                            $konz_min3="hochkonz.";
                        }
                        ?>
                        <tr>
                            <td>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                        <td><a href="planeten.php?fu=2&pid=<?php echo $pid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>" target="untenmitte"><img src="<?php echo $bildpfad?>/planeten/<?php echo $klasse?>_<?php echo $bild?>.jpg" border="0" title="<?php echo $logbuch?>"></a></td>
                                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                    </tr>
                                </table>
                            </td>
                            <td><img src="../bilder/empty.gif" border="0" width="8" height="1"></td>
                            <td>
                                <center>
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td><nobr><a href="planeten.php?fu=2&pid=<?php echo $pid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>" target="untenmitte"><?php echo $name?></a></nobr></td>
                                            <td  style="color:#aaaaaa;"><nobr>&nbsp;(<?php echo  $x_pos."/".$y_pos;?>)</nobr></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><img src="../bilder/empty.gif" border="0" width="1" height="3"></td>
                                        </tr>
                                    </table>
                                </center>
                                <center>
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td>
                                                <center>
                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td  style="color:#aaaaaa;"><?php echo $lang['uebersichtkolonien']['klasse']?>&nbsp;</td>
                                                            <td><?php echo $klassename?></td>
                                                            <td  style="color:#aaaaaa;">&nbsp;<?php echo $lang['uebersichtkolonien']['planet']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="4"></td>
                                                        </tr>
                                                    </table>
                                                </center>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="../bilder/empty.gif" border="0" width="140" height="1"></td>
                                        </tr>
                                        <tr>
                                            <td background="<?php echo $bildpfad?>/skalen/temperatur.gif">
                                                <table border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td><img src="../bilder/empty.gif" border="0" width="<?php echo  ($temp*1.4)-1; ?>" height="25"></td>
                                                        <td bgcolor="#528ECE"><img src="../bilder/empty.gif" border="0" width="1" height="25"></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="../bilder/empty.gif" border="0" width="140" height="1"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <center>
                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td><img src="../bilder/empty.gif" border="0" width="1" height="3"></td>
                                                        </tr>
                                                        <tr>
                                                            <td  style="color:#aaaaaa;"><center><?php echo $lang['uebersichtkolonien']['durchtemperatur']?><br></center></td>
                                                        </tr>
                                                        <tr>
                                                            <td><center><?php echo  $temp-35; ?> <?php echo $lang['uebersichtkolonien']['grad']?></center></td>
                                                        </tr>
                                                    </table>
                                                </center>
                                            </td>
                                        </tr>
                                    </table>
                                </center>
                            </td>
                            <td><img src="../bilder/empty.gif" border="0" width="8" height="1"></td>
                            <td>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td rowspan="2"><img src="<?php echo $bildpfad?>/icons/alleleute.gif" border="0" width="17" height="17"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['uebersichtkolonien']['kolonisten']?></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                        <td><nobr><?php echo $kolonisten?>/<?php echo $leichtebt?>/<?php echo $schwerebt?></nobr></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2"><img src="<?php echo $bildpfad?>/icons/cantox.gif" border="0" width="17" height="17"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['uebersichtkolonien']['cantox']?></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                        <td><nobr><?php echo $cantox?></nobr></td>
                                    </tr>
                                    <?php
                                    if (($native_id>=1) and ($native_kol>=1)) {
                                        ?>
                                        <tr>
                                            <td rowspan="2"><img src="<?php echo $bildpfad?>/icons/native_1.gif" border="0" width="17" height="17"></td>
                                            <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                            <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['uebersichtkolonien']['domspezies']?></td>
                                        </tr>
                                        <tr>
                                            <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                            <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                            <td><nobr><a href="javascript:nativedetail(<?php echo $native_id?>);" style="color:#ffffff"><?php echo $native_name?></a></nobr></td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2"><img src="<?php echo $bildpfad?>/icons/native_2.gif" border="0" width="17" height="17"></td>
                                            <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                            <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['uebersichtkolonien']['population']?></td>
                                        </tr>
                                        <tr>
                                            <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                            <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                            <td><nobr><?php echo  $native_kol; ?></nobr></td>
                                        </tr>
                                        <?php
                                    } else {
                                        ?>
                                        <tr>
                                            <td rowspan="2"><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                                            <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                            <td colspan="2" style="color:#aaaaaa;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                            <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                            <td><nobr>&nbsp;</nobr></td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2"><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                                            <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                            <td colspan="2" style="color:#aaaaaa;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                            <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                            <td><nobr>&nbsp;</nobr></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </table>
                            </td>
                            <td><img src="../bilder/empty.gif" border="0" width="8" height="1"></td>
                            <td>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td rowspan="2"><img src="<?php echo $bildpfad?>/icons/minen.gif" border="0" width="17" height="17"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['uebersichtkolonien']['minen']?></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                        <td><nobr><?php echo $minen?><?php  if ($auto_minen==1) { echo " <i>(".$lang['uebersichtkolonien']['auto'].")</i>";} ?></nobr></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2"><img src="<?php echo $bildpfad?>/icons/fabrik.gif" border="0" width="17" height="17"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['uebersichtkolonien']['fabriken']?></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                        <td><nobr><?php echo $fabriken?><?php  if ($auto_fabriken==1) { echo " <i>(".$lang['uebersichtkolonien']['auto'].")</i>";} ?></nobr></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2"><img src="<?php echo $bildpfad?>/icons/abwehr.gif" border="0" width="17" height="17"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['uebersichtkolonien']['pds']?></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                        <td><nobr><?php echo $abwehr?><?php  if ($auto_abwehr==1) { echo " <i>(".$lang['uebersichtkolonien']['auto'].")</i>";} ?></nobr></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2"><img src="<?php echo $bildpfad?>/icons/vorrat.gif" border="0" width="17" height="17"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['uebersichtkolonien']['vorraete']?></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                        <td><nobr><?php echo str_replace('{1}',$vorrat,$lang['uebersichtkolonien']['kt']); if ($auto_vorrat==1) { echo " <i>(".$lang['uebersichtkolonien']['auto'].")</i>";} ?></nobr></td>
                                    </tr>
                                </table>
                            </td>
                            <td><img src="../bilder/empty.gif" border="0" width="8" height="1"></td>
                            <td>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td rowspan="2"><img src="<?php echo $bildpfad?>/icons/lemin.gif" border="0" width="17" height="17"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['uebersichtkolonien']['lemin']?></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                        <td><?php echo str_replace('{1}',$lemin.'/'.$planet_lemin,$lang['uebersichtkolonien']['kt'])?></td>
                                        <td>&nbsp;(<?php echo $konz_lemin?>)</td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2"><img src="<?php echo $bildpfad?>/icons/mineral_1.gif" border="0" width="17" height="17"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['uebersichtkolonien']['baxterium']?></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                        <td><?php echo str_replace('{1}',$min1.'/'.$planet_min1,$lang['uebersichtkolonien']['kt'])?></td>
                                        <td>&nbsp;(<?php echo $konz_min1?>)</td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2"><img src="<?php echo $bildpfad?>/icons/mineral_2.gif" border="0" width="17" height="17"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['uebersichtkolonien']['rennurbin']?></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                        <td><?php echo str_replace('{1}',$min2.'/'.$planet_min2,$lang['uebersichtkolonien']['kt'])?></td>
                                        <td>&nbsp;(<?php echo $konz_min2?>)</td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2"><img src="<?php echo $bildpfad?>/icons/mineral_3.gif" border="0" width="17" height="17"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['uebersichtkolonien']['vomisaan']?></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                        <td><?php echo str_replace('{1}',$min3.'/'.$planet_min3,$lang['uebersichtkolonien']['kt'])?></td>
                                        <td>&nbsp;(<?php echo $konz_min3?>)</td>
                                    </tr>
                                </table>
                            </td>
                            <td><img src="../bilder/empty.gif" border="0" width="4" height="1"></td>
                            <td>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td><?php echo $osys[1]?></td>
                                        <td><?php echo $osys[2]?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $osys[3]?></td>
                                        <td><?php echo $osys[4]?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $osys[5]?></td>
                                        <td><?php echo $osys[6]?></td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <?php 
                                if ($sternenbasis==2) {
                                    if ($sternenbasis_art==1) {
                                        $icon='erf_1.gif';
                                        $artname=$lang['uebersichtkolonien']['raumwerft'];
                                    }elseif ($sternenbasis_art==2) {
                                        $icon='erf_2.gif';
                                        $artname=$lang['uebersichtkolonien']['kampfstation'];
                                    }elseif ($sternenbasis_art==0) {
                                        $icon='erf_3.gif';
                                        $artname=$lang['uebersichtkolonien']['sternenbasis'];
                                    }elseif ($sternenbasis_art==3) {
                                        $icon='erf_5.gif';
                                        $artname=$lang['uebersichtkolonien']['Kriegsbasis'];
                                    }
                                    ?>
                                    <center>
                                        <a href="basen.php?fu=2&baid=<?php echo $sternenbasis_id?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>" target="untenmitte">
                                            <img src="<?php echo $bildpfad?>/icons/<?php echo $icon?>" border="0" title="<?php echo $artname?>">
                                            <br>
                                            <img src="../bilder/icons/basis.gif" border="0" width="36" height="36" title="<?php echo $artname?>">
                                        </a>
                                    </center>
                                    <?php
                                } else {
                                    echo "&nbsp;";
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="11"><img src="../bilder/empty.gif" border="0" width="1" height="17"></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </center>
            </div>
            <?php 
        }
    include ("inc.footer.php");
}
