<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'flotte_beta';
$fuid = int_get('fu');
$shid = int_get('shid');

if ($fuid==1) {
    include ("inc.header.php");
    $p_zahl=0;
    $s_zahl=0;
    $zeiger = @mysql_query("SELECT * FROM $skrupel_schiffe where id=$shid");
    $array = @mysql_fetch_array($zeiger);
    $kox=$array["kox"];
    $koy=$array["koy"];
    $scanner=$array["scanner"];
    if ($scanner==0) {$reichweite=47;}
    if ($scanner==1) {$reichweite=85;}
    if ($scanner==2) {$reichweite=116;}
    $planeten=0;
    $raumschiffe=0;
    
    $zeiger = @mysql_query("SELECT * FROM $skrupel_planeten where sqrt(((x_pos-$kox)*(x_pos-$kox))+((y_pos-$koy)*(y_pos-$koy)))<=$reichweite  and besitzer<>$spieler and spiel=$spiel order by id");
    $planetenanzahl = @mysql_num_rows($zeiger);
    if ($planetenanzahl>=1) {
        $planeten=$planetenanzahl;
        for  ($i=0; $i<$planetenanzahl;$i++) {
            $ok = @mysql_data_seek($zeiger,$i);
            $array = @mysql_fetch_array($zeiger);
            
            $pid=$array["id"];
            $bild=$array["bild"];
            $name=$array["name"];
            $besitzer=$array["besitzer"];
            $klasse=$array["klasse"];
            $x_pos=$array["x_pos"];
            $y_pos=$array["y_pos"];
            $temp=$array["temp"];
            $native_id=$array["native_id"];
            $native_name=$array["native_name"];
            $native_kol=$array["native_kol"];

            $planet_scan[$p_zahl][0]=$name;
            $planet_scan[$p_zahl][1]=$x_pos;
            $planet_scan[$p_zahl][2]=$y_pos;
            $planet_scan[$p_zahl][3]=$temp;
            $planet_scan[$p_zahl][4]=$bild;
            $planet_scan[$p_zahl][5]=$pid;
            $planet_scan[$p_zahl][6]=$native_id;
            $planet_scan[$p_zahl][7]=$native_name;
            $planet_scan[$p_zahl][8]=$native_kol;
            $planet_scan[$p_zahl][9]=$klasse;
            $planet_scan[$p_zahl][10]=$besitzer;
            $p_zahl++;
        }
    }

    //wenn das schiff absolute tarnung hat, dann ignorieren -> spione koennen nicht durch diese scanner erfasst werden
    $zeiger = @mysql_query("SELECT * FROM $skrupel_schiffe where sqrt(((kox-$kox)*(kox-$kox))+((koy-$koy)*(koy-$koy)))<=$reichweite and besitzer<>$spieler and tarnfeld<2 and spiel=$spiel order by id");
    $schiffanzahl = @mysql_num_rows($zeiger);
    
    if ($schiffanzahl>=1) {
        $raumschiffe=$schiffanzahl;
        for  ($i=0; $i<$schiffanzahl;$i++) {
            $ok = @mysql_data_seek($zeiger,$i);
            $array = @mysql_fetch_array($zeiger);
            $shid=$array["id"];
            $bild_klein=$array["bild_klein"];
            $volk=$array["volk"];
            $x_pos=$array["kox"];
            $y_pos=$array["koy"];
            $antrieb=$array["antrieb"];
            $klasse=$array["klasse"];
            $besitzer=$array["besitzer"];

            $schiff_scan[$s_zahl][0]=$shid;
            $schiff_scan[$s_zahl][1]=$x_pos;
            $schiff_scan[$s_zahl][2]=$y_pos;
            $schiff_scan[$s_zahl][3]=$volk;
            $schiff_scan[$s_zahl][4]=$bild_klein;
            $schiff_scan[$s_zahl][5]=$antrieb;
            $schiff_scan[$s_zahl][6]=$klasse;
            $schiff_scan[$s_zahl][7]=$besitzer;
            $s_zahl++;
        }
    }

    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <script language=JavaScript>
            function nativedetail(shid) {
                oben=100;
                links=Math.ceil((screen.width-580)/2);
                window.open('hilfe_native.php?fu2='+shid+'&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>','domspezien','resizable=yes,scrollbars=no,width=580,height=180,top='+oben+',left='+links);
            }
        </script>
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
        <center>
            <table border="0" cellspacing="0" cellpadding="1">
                <tr>
                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="4"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                    <td><center><?php echo $lang['flottebeta']['scanning']; ?></center></td>
                    <td><a href="javascript:hilfe(14);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                </tr>
                <tr>
                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="3"></td>
                </tr>
            </table>
        </center>
        <?php
        if ($p_zahl>=1) {
            ?>
            <center>
                <table border='0' cellspacing='0' cellpadding='0'>
                    <?php
                    for  ($i=0; $i<$p_zahl;$i++) { 
                        ?>
                        <tr>
                            <td>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td bgcolor="<?php if (0 < intval($planet_scan[$i][10])) { echo $spielerfarbe[$planet_scan[$i][10]]; } else { echo '#aaaaaa';} ?>" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="<?php if (0 < intval($planet_scan[$i][10])) { echo $spielerfarbe[$planet_scan[$i][10]]; } else { echo '#aaaaaa';} ?>"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                        <td><img src="<?php echo $bildpfad; ?>/planeten/<?php echo $planet_scan[$i][9]; ?>_<?php echo $planet_scan[$i][4]; ?>.jpg" border="0"  height="50"></td>
                                        <td bgcolor="<?php if (0 < intval($planet_scan[$i][10])) { echo $spielerfarbe[$planet_scan[$i][10]]; } else { echo '#aaaaaa';} ?>"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="<?php if (0 < intval($planet_scan[$i][10])) { echo $spielerfarbe[$planet_scan[$i][10]]; } else { echo '#aaaaaa';} ?>" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                    </tr>
                                </table>
                            </td>
                            <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                            <td>
                                <table border="0" cellspacing="0" cellpadding="1">
                                    <tr>
                                        <td style="color:#aaaaaa;"><?php echo $lang['flottebeta']['name']; ?></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td><?php echo $planet_scan[$i][0]; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="color:#aaaaaa;"><?php echo $lang['flottebeta']['koordinaten']; ?></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td><?php echo $planet_scan[$i][1]."/".$planet_scan[$i][2]; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="color:#aaaaaa;"><?php echo $lang['flottebeta']['temperatur']; ?></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td><?php echo str_replace('{1}',$planet_scan[$i][3]-35,$lang['flottebeta']['grad']); ?></td>
                                    </tr>
                                    <?php
                                    if (($planet_scan[$i][6]>=1) and ($planet_scan[$i][8]>=1)) {
                                        ?>
                                        <tr>
                                            <td style="color:#aaaaaa;"><?php echo $lang['flottebeta']['domspezies']; ?></td>
                                            <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                            <td><a href="javascript:nativedetail(<?php echo $planet_scan[$i][6]; ?>);" style="color:#ffffff"><?php echo $planet_scan[$i][7]." <i>(".$planet_scan[$i][8].")</i>"; ?></a></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </table>
                            </td>
                            <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                            <td><form name="formular"  method="post" action="flotte_beta.php?fu=2&pid=<?php echo $planet_scan[$i][5]; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                            <td><input type="submit" name="bla" value="<?php echo $lang['flottebeta']['detailscan']; ?>" style="width:70px;"></td>
                            <td></form></td>
                        </tr>
                        <tr>
                            <td colspan="7"><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </center>
            <?php
        }
        if ($s_zahl>=1) {
            ?>
            <center>
                <table border='0' cellspacing='0' cellpadding='0'>
                    <?php
                    for  ($i=0; $i<$s_zahl;$i++) {
                        ?>
                        <tr>
                            <td>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td bgcolor="<?php if (0 < intval($schiff_scan[$i][7])) { echo $spielerfarbe[$schiff_scan[$i][7]]; } else { echo '#aaaaaa';} ?>" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="<?php if (0 < intval($schiff_scan[$i][7])) { echo $spielerfarbe[$schiff_scan[$i][7]]; } else { echo '#aaaaaa';} ?>"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                        <td><img src="../daten/<?php echo $schiff_scan[$i][3]; ?>/bilder_schiffe/<?php echo $schiff_scan[$i][4]; ?>" border="0"  height="50" width="75"></td>
                                        <td bgcolor="<?php if (0 < intval($schiff_scan[$i][7])) { echo $spielerfarbe[$schiff_scan[$i][7]]; } else { echo '#aaaaaa';} ?>"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="<?php if (0 < intval($schiff_scan[$i][7])) { echo $spielerfarbe[$schiff_scan[$i][7]]; } else { echo '#aaaaaa';} ?>" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                    </tr>
                                </table>
                            </td>
                            <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                            <td>
                                <table border="0" cellspacing="0" cellpadding="1">
                                    <tr>
                                        <td style="color:#aaaaaa;"><?php echo $lang['flottebeta']['klasse']; ?></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td><?php echo $schiff_scan[$i][6]; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="color:#aaaaaa;"><?php echo $lang['flottebeta']['koordinaten']; ?></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td><?php echo $schiff_scan[$i][1]."/".$schiff_scan[$i][2]; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="color:#aaaaaa;"><?php echo $lang['flottebeta']['maxwarp']; ?></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td><?php echo $schiff_scan[$i][5]; ?></td>
                                    </tr>
                                </table>
                            </td>
                            <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                            <td><form name="formular"  method="post" action="flotte_beta.php?fu=3&shid=<?php echo $schiff_scan[$i][0]; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                            <td><input type="submit" name="bla" value="<?php echo $lang['flottebeta']['detailscan']; ?>" style="width:70px;"></td>
                            <td></form></td>
                        </tr>
                        <tr>
                            <td colspan="7"><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </center>
            <?php
        }
        if (($p_zahl==0) and ($s_zahl==0)) {
            ?>
            <br>
            <center><?php echo $lang['flottebeta']['noscan']; ?></center>
            <?php
        }
        echo '</div>';
    include ("inc.footer.php");
}

if ($fuid==2) {
    include ("inc.header.php");
    include ("../lang/".$spieler_sprache."/lang.basen.php");

    $pid=int_get('pid');

    $zeiger = @mysql_query("SELECT * FROM $skrupel_planeten where id=$pid");

    $array = @mysql_fetch_array($zeiger);
    $pid=$array["id"];
    $name=$array["name"];
    $x_pos=$array["x_pos"];
    $y_pos=$array["y_pos"];
    $bild=$array["bild"];
    $klasse=$array["klasse"];
    $temp=$array["temp"];
    $besitzer=$array["besitzer"];

    $kolonisten=$array["kolonisten"];
    $minen=$array["minen"];
    $fabriken=$array["fabriken"];
    $abwehr=$array["abwehr"];

    $planet_lemin=$array["planet_lemin"];
    $planet_min1=$array["planet_min1"];
    $planet_min2=$array["planet_min2"];
    $planet_min3=$array["planet_min3"];

    $osys_1=$array["osys_1"];
    $osys_2=$array["osys_2"];
    $osys_3=$array["osys_3"];
    $osys_4=$array["osys_4"];
    $osys_5=$array["osys_5"];
    $osys_6=$array["osys_6"];

    $sternenbasis=$array["sternenbasis"];
    $sternenbasis_name=$array["sternenbasis_name"];
    $sternenbasis_id=$array["sternenbasis_id"];
    $sternenbasis_rasse=$array["sternenbasis_rasse"];
    $sternenbasis_art=$array["sternenbasis_art"];    

    if ((($osys_1==5) or ($osys_2==5) or ($osys_3==5) or ($osys_4==5) or ($osys_5==5) or ($osys_6==5)) and ($besitzer!=$spieler)) {
        $planet_lemin='???';
        $planet_min1='???';
        $planet_min2='???';
        $planet_min3='???';
        $besitzer=0;
        $sternenbasis=0;
    }
    if (0 < $sternenbasis) {
        $zeiger = @mysql_query("SELECT defense FROM $skrupel_sternenbasen where id=$sternenbasis_id");
        $array = @mysql_fetch_array($zeiger);
        $defense=$array["defense"];
        if ($sternenbasis_art==1) { $basisbild='2.jpg'; $icon='erf_1.gif'; $artname=$lang['basen']['raumwerft']; 
        }elseif ($sternenbasis_art==2) { $basisbild='3.jpg'; $icon='erf_2.gif'; $artname=$lang['basen']['kampfstation']; 
        }elseif ($sternenbasis_art==0) { $basisbild='1.jpg'; $icon='erf_3.gif'; $artname=$lang['basen']['sternenbasis']; 
        }elseif ($sternenbasis_art==3) { $basisbild='4.jpg'; $icon='erf_5.gif'; $artname=$lang['basen']['kriegsbasis']; } 
        $abwehr+=$defense;
    }
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
        <?php if (0 < $sternenbasis) { ?>
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><img src="<?php echo $bildpfad; ?>/icons/<?php echo $icon; ?>" border="0" title="<?php echo $artname; ?>"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="25" height="1"></td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="6"></td>
                            </tr>
                            <tr>
                                <td bgcolor="<?php if (0 < intval($besitzer)) { echo $spielerfarbe[$besitzer]; } else { echo '#aaaaaa';} ?>" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="<?php if (0 < intval($besitzer)) { echo $spielerfarbe[$besitzer]; } else { echo '#aaaaaa';} ?>"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td>
                                    <img src="<?php
                                    $file='../daten/'.$sternenbasis_rasse.'/bilder_basen/'.$basisbild;
                                    if (@file_exists($file)) { echo $file; } else { echo '../daten/'.$sternenbasis_rasse.'/bilder_basen/1.jpg'; }?>" border="0"  height="94" title="<?php echo $artname; ?>" width="141">
                                </td>
                                <td bgcolor="<?php if (0 < intval($besitzer)) { echo $spielerfarbe[$besitzer]; } else { echo '#aaaaaa';} ?>"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="<?php if (0 < intval($besitzer)) { echo $spielerfarbe[$besitzer]; } else { echo '#aaaaaa';} ?>" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                        </table>
                    </td>
                    <td><img src="../bilder/empty.gif" border="0" width="25" height="1"></td>
                    <td><img src="<?php echo $bildpfad; ?>/icons/<?php echo $icon; ?>" border="0" title="<?php echo $artname; ?>"></td>
                </tr>
            </table>
        </center>
        <?php } ?>
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
                            </tr>
                            <tr>
                                <td bgcolor="<?php if (0 < intval($besitzer)) { echo $spielerfarbe[$besitzer]; } else { echo '#aaaaaa';} ?>" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="<?php if (0 < intval($besitzer)) { echo $spielerfarbe[$besitzer]; } else { echo '#aaaaaa';} ?>"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td><img src="<?php echo $bildpfad; ?>/planeten/<?php echo $klasse; ?>_<?php echo $bild; ?>.jpg" border="0"  height="91"></td>
                                <td bgcolor="<?php if (0 < intval($besitzer)) { echo $spielerfarbe[$besitzer]; } else { echo '#aaaaaa';} ?>"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="<?php if (0 < intval($besitzer)) { echo $spielerfarbe[$besitzer]; } else { echo '#aaaaaa';} ?>" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                        </table>
                    </td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td valign="top">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td colspan="5"><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/crew.gif" border="0" width="17" height="17"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottebeta']['kolonisten']; ?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><?php echo $kolonisten; ?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/minen.gif" border="0" width="17" height="17"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottebeta']['minen']; ?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><?php echo $minen; ?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/fabrik.gif" border="0" width="17" height="17"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottebeta']['fabriken']; ?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><?php echo $fabriken; ?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/abwehr.gif" border="0" width="17" height="17"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottebeta']['abwehr']; ?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><?php echo $abwehr; ?></td>
                            </tr>
                        </table>
                    </td>
                    <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                    <td>
                        <img src="../bilder/empty.gif" border="0" width="5" height="6">
                        <br>
                        <iframe src="flotte_beta.php?fu=10&pid=<?php echo $pid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" width="97" height="97" name="map" scrolling="no" marginheight="0" marginwidth="0" frameborder="0"></iframe>
                    </td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td valign="top"></td>
                    <?php 
                    /*********************************
                    * kommentar_flotte_beta.php.txt  * 
                    * Kommentar 1                    *
                    *********************************/
                    ?>
                </tr>
            </table>
        </center>
        </div>
        <?php
    include ("inc.footer.php");
}

if ($fuid==3) {
    include ("inc.header.php");

    $zeiger = @mysql_query("SELECT * FROM $skrupel_schiffe where id=$shid");

    $array = @mysql_fetch_array($zeiger);
    $antrieb=$array["antrieb"];
    $energetik_stufe=$array["energetik_stufe"];
    $projektile_stufe=$array["projektile_stufe"];
    $energetik_anzahl=$array["energetik_anzahl"];
    $projektile_anzahl=$array["projektile_anzahl"];
    $hanger_anzahl=$array["hanger_anzahl"];

    $masse=$array["masse"];
    $lemin=$array["lemin"];
    $crew=$array["crew"];
    $name=$array["name"];
    $schaden=$array["schaden"];

    $volk=$array["volk"];
    $bild_klein=$array["bild_klein"];

    $fracht_vorrat=$array["fracht_vorrat"];
    $fracht_min1=$array["fracht_min1"];
    $fracht_min2=$array["fracht_min2"];
    $fracht_min3=$array["fracht_min3"];
    $fracht_leute=$array["fracht_leute"];

    $gueter=$fracht_vorrat+$fracht_min1+$fracht_min2+$fracht_min3+round($fracht_leute/100);


    if ($hanger_anzahl>=1) {} else {$hanger_anzahl="nicht vorhanden";}

    $antriebsnamen = array ("",$lang['flottebeta']['antriebe'][0],$lang['flottebeta']['antriebe'][1],$lang['flottebeta']['antriebe'][2],$lang['flottebeta']['antriebe'][3],$lang['flottebeta']['antriebe'][4],$lang['flottebeta']['antriebe'][5],$lang['flottebeta']['antriebe'][6],$lang['flottebeta']['antriebe'][7],$lang['flottebeta']['antriebe'][8]);
    $antrieb=$antriebsnamen[$antrieb];
    $projektilnamen = array ($lang['flottebeta']['nichtvorhanden'],$lang['flottebeta']['waffen'][10],$lang['flottebeta']['waffen'][11],$lang['flottebeta']['waffen'][12],$lang['flottebeta']['waffen'][13],$lang['flottebeta']['waffen'][14],$lang['flottebeta']['waffen'][15],$lang['flottebeta']['waffen'][16],$lang['flottebeta']['waffen'][17],$lang['flottebeta']['waffen'][18],$lang['flottebeta']['waffen'][19]);
    $projektile=$projektilnamen[$projektile_stufe];
    $energetiknamen = array ($lang['flottebeta']['nichtvorhanden'],$lang['flottebeta']['waffen'][0],$lang['flottebeta']['waffen'][1],$lang['flottebeta']['waffen'][2],$lang['flottebeta']['waffen'][3],$lang['flottebeta']['waffen'][4],$lang['flottebeta']['waffen'][5],$lang['flottebeta']['waffen'][6],$lang['flottebeta']['waffen'][7],$lang['flottebeta']['waffen'][8],$lang['flottebeta']['waffen'][9]);
    $energetik=$energetiknamen[$energetik_stufe];

    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td valign="top">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td colspan="3"><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            </tr>
                            <tr>
                                <td rowspan="2"><img src="../bilder/empty.gif" border="0" width="1" height="17"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottebeta']['name']; ?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><nobr><?php echo $name; ?></nobr></td>
                            </tr>
                            <tr>
                                <td rowspan="2"><img src="../bilder/empty.gif" border="0" width="1" height="17"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottebeta']['schaden']; ?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo $schaden; ?> %</td>
                            </tr>
                            <tr>
                                <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td colspan="2">
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                            <td><img src="../daten/<?php echo $volk; ?>/bilder_schiffe/<?php echo $bild_klein; ?>" border="0" width="75" height="50"></td>
                                            <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td valign="top">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td colspan="5"><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/crew.gif" border="0" width="17" height="17"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottebeta']['crew']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><?php echo $crew?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/masse.gif" border="0" width="17" height="17"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottebeta']['masse']; ?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><?php echo $masse; ?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td rowspan="2"><img src="../bilder/icons/lemin.gif" border="0" width="17" height="17"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottebeta']['lemin']; ?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><?php echo $lemin." ".$lang['flottebeta']['kt'];?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/vorrat.gif" border="0" width="17" height="17"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottebeta']['gueter']; ?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><?php echo $gueter." ".$lang['flottebeta']['kt'];?></td>
                            </tr>
                        </table>
                    </td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td valign="top">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td colspan="5"><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/antrieb.gif" border="0" width="17" height="17"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottebeta']['antrieb']; ?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><nobr><?php echo $antrieb; ?></nobr></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/laser.gif" border="0" width="17" height="17"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottebeta']['energetik']; ?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><nobr><?php if ($energetik_anzahl>=1) { echo $energetik_anzahl.' x '; } ?><?php echo $energetik; ?></nobr></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/projektil.gif" border="0" width="17" height="17"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottebeta']['projektil']; ?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><nobr><?php if ($projektile_anzahl>=1) { echo $projektile_anzahl.' x '; } ?><?php echo $projektile; ?></nobr></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/hangar.gif" border="0" width="17" height="17"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottebeta']['hangar']; ?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                <td><?php echo $hanger_anzahl; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </center>
        </div>
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
    $volk=$array["volk"];
    $bild_klein=$array["bild_klein"];
    $frachtraum=$array["frachtraum"];
    $leminmax=$array["leminmax"];
    $kox=$array["kox"];
    $koy=$array["koy"];
    $fertigkeiten=$array["fertigkeiten"];
    $s_leichtebt=$array["leichtebt"];
    $s_schwerebt=$array["schwerebt"];
    $status=$array["status"];

    $erwtrans=@intval(substr($fertigkeiten,46,2));
    $infanterie=@intval(substr($fertigkeiten,57,1));
    //$infanterie=1;

    ?>
    <style type="text/css">
        input {
            width:            50px;
            padding:        1px;
            margin-right:    15px;
        }
        
        input, select, button {
            vertical-align:    middle;
        }
        
        #slider-1 {
            margin: 0px;
            width:  230px;
        }
        #slider-2 {
            margin: 0px;
            width:  230px;
        }
        #slider-3 {
            margin: 0px;
            width:  230px;
        }
        #slider-4 {
            margin: 0px;
            width:  230px;
        }
        #slider-5 {
            margin: 0px;
            width:  230px;
        }
        #slider-6 {
            margin: 0px;
            width:  230px;
        }
        #slider-7 {
            margin: 0px;
            width:  230px;
        }
        #slider-8 {
            margin: 0px;
            width:  230px;
        }
        #slider-9 {
            margin: 0px;
            width:  230px;
        }
    </style>
    <link type="text/css" rel="StyleSheet" href="css/winclassic.css" />
    <script type="text/javascript" src="js/range.js"></script>
    <script type="text/javascript" src="js/timer.js"></script>
    <script type="text/javascript" src="js/slider.js"></script>
    <body text="#000000" scroll="auto" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <div id="bodybody" class="flexcroll" onfocus="this.blur()">
    <?php
    $reichweite=0;
    if ($erwtrans>=1) {
        $reichweite=25;
    }
    $zeiger_temp = @mysql_query("SELECT * FROM $skrupel_planeten where sqrt(((x_pos-$kox)*(x_pos-$kox))+((y_pos-$koy)*(y_pos-$koy)))<=$reichweite and spiel=$spiel");  $datensaetze_temp = @mysql_num_rows($zeiger_temp);
    if ($datensaetze_temp>=1) {
        $array_temp = @mysql_fetch_array($zeiger_temp);
        $pid=$array_temp["id"];
        $planet_name=$array_temp["name"];
        $besitzer=$array_temp["besitzer"];
        $bild=$array_temp["bild"];
        $klasse=$array_temp["klasse"];
        $kolonisten_spieler_t=$array_temp["kolonisten_spieler"];
        $planet_cantox=$array_temp["cantox"];
        $planet_vorrat=$array_temp["vorrat"];
        $planet_lemin=$array_temp["lemin"];
        $planet_min1=$array_temp["min1"];
        $planet_min2=$array_temp["min2"];
        $planet_min3=$array_temp["min3"];
        if ($besitzer==$spieler) {
            $planet_kolonisten=$array_temp["kolonisten"];
            $p_leichtebt=$array_temp["leichtebt"];
            $p_schwerebt=$array_temp["schwerebt"];
        } else {
            $planet_kolonisten=$array_temp["kolonisten_new"];
            $p_leichtebt=$array_temp["leichtebt_new"];
            $p_schwerebt=$array_temp["schwerebt_new"];
            if(($planet_kolonisten==0)and($p_leichtebt==0)and($p_schwerebt==0)){
                $kolonisten_spieler_t=0;
                $zeiger_temp = @mysql_query("UPDATE $skrupel_planeten set kolonisten_spieler=0 where id=$pid");
            }
            $osys_1=$array_temp["osys_1"];
            $osys_2=$array_temp["osys_2"];
            $osys_3=$array_temp["osys_3"];
            $osys_4=$array_temp["osys_4"];
            $osys_5=$array_temp["osys_5"];
            $osys_6=$array_temp["osys_6"];
            if((($osys_1==7) or ($osys_2==7) or ($osys_3==7) or ($osys_4==7) or ($osys_5==7)or ($osys_6==7))and($besitzer!=0)){
                $planet_cantox=max(0,$planet_cantox-500);
                $planet_vorrat=max(0,$planet_vorrat-100);
                $planet_lemin=max(0,$planet_lemin-100);
                $planet_min1=max(0,$planet_min1-100);
                $planet_min2=max(0,$planet_min2-100);
                $planet_min3=max(0,$planet_min3-100);
            }
            $beziehung[$besitzer][$spieler]['status']=0;
            $beziehung[$spieler][$besitzer]['status']=0;
            $beziehung[$besitzer][$spieler]['optionen']=0;
            $beziehung[$spieler][$besitzer]['optionen']=0;
            $zeiger = @mysql_query("SELECT spiel,partei_a,partei_b,status,optionen FROM $skrupel_politik where spiel=$spiel");
            $polanzahl = @mysql_num_rows($zeiger);
            if ($polanzahl>=1) {
                for  ($i=0; $i<$polanzahl;$i++) {
                    $ok = @mysql_data_seek($zeiger,$i);
                    $array = @mysql_fetch_array($zeiger);
                    $status=$array["status"];
                    $partei_a=$array["partei_a"];
                    $partei_b=$array["partei_b"];
                    $beziehung[$partei_a][$partei_b]['status']=$status;
                    $beziehung[$partei_b][$partei_a]['status']=$status;
                    $beziehung[$partei_a][$partei_b]['optionen']=$optionen;
                    $beziehung[$partei_b][$partei_a]['optionen']=$optionen;
                }
            }
        }

        ?>
        <script type="text/javascript">
            function checken() {
<?php
                if ((($besitzer!=$spieler) and ($beziehung[$besitzer][$spieler]['status']==5))or(($kolonisten_spieler_t!=0)and ($kolonisten_spieler_t!=$spieler))) {
                    if ($infanterie!=1) {
                        if (($fracht_leute>=1) or ($planet_kolonisten>=1)) {
                            ?>
                            document.formular.fracht_leute.value=<?php echo $fracht_leute; ?>;
                            document.formular.planet_kolonisten.value=<?php echo $planet_kolonisten; ?>;
                            <?php
                        } else {
                            ?>
                            document.formular.fracht_leute.value=0;
                            document.formular.planet_kolonisten.value=0;
                            <?php
                        }
                    }
                    if (($s_leichtebt>=1) or ($p_leichtebt>=1)) {
                        ?>
                        document.formular.s_leichtebt.value=<?php echo $s_leichtebt; ?>;
                        document.formular.p_leichtebt.value=<?php echo $p_leichtebt; ?>;
                        <?php
                    } else {
                        ?>
                        document.formular.s_leichtebt.value=0;
                        document.formular.p_leichtebt.value=0;
                        <?php
                    }
                    if ($infanterie!=1) {
                        if (($s_schwerebt>=1) or ($p_schwerebt>=1)) {
                            ?>
                            document.formular.s_schwerebt.value=<?php echo $s_schwerebt; ?>;
                            document.formular.p_schwerebt.value=<?php echo $p_schwerebt; ?>;
                            <?php
                        } else {
                            ?>
                            document.formular.s_schwerebt.value=0;
                            document.formular.p_schwerebt.value=0;
                            <?php
                        }
                    }
                } else {
                    if ($infanterie!=1) {
                        if (($fracht_leute>=1) or ($planet_kolonisten>=1)) {
                            ?>
                            document.formular.fracht_leute.value=(s7.getValue()-<?php echo $fracht_leute+$planet_kolonisten; ?>)*-1;
                            document.formular.planet_kolonisten.value=s7.getValue();
                            <?php
                        } else {
                            ?>
                            document.formular.fracht_leute.value=0;
                            document.formular.planet_kolonisten.value=0;
                            <?php
                        }
                    }
                    if (($s_leichtebt>=1) or ($p_leichtebt>=1)) {
                        ?>
                        document.formular.s_leichtebt.value=(s8.getValue()-<?php echo $s_leichtebt+$p_leichtebt; ?>)*-1;
                        document.formular.p_leichtebt.value=s8.getValue();
                        <?php
                    } else {
                        ?>
                        document.formular.s_leichtebt.value=0;
                        document.formular.p_leichtebt.value=0;
                        <?php
                    }
                    if ($infanterie!=1) {
                        if (($s_schwerebt>=1) or ($p_schwerebt>=1)) {
                            ?>
                            document.formular.s_schwerebt.value=(s9.getValue()-<?php echo $s_schwerebt+$p_schwerebt; ?>)*-1;
                            document.formular.p_schwerebt.value=s9.getValue();
                            <?php
                        } else {
                            ?>
                            document.formular.s_schwerebt.value=0;
                            document.formular.p_schwerebt.value=0;
                            <?php
                        }
                    }
                }
                if ($infanterie!=1) {
                    if (($fracht_cantox>=1) or ($planet_cantox>=1)) {
                        ?>
                        document.formular.fracht_cantox.value=(s6.getValue()-<?php echo $fracht_cantox+$planet_cantox; ?>)*-1;
                        document.formular.planet_cantox.value=s6.getValue();
                        <?php
                    } else {
                        ?>
                        document.formular.fracht_cantox.value=0;
                        document.formular.planet_cantox.value=0;
                        <?php
                    }
                }
                if (($fracht_vorrat>=1) or ($planet_vorrat>=1)) {
                    ?>
                    document.formular.fracht_vorrat.value=(s5.getValue()-<?php echo $fracht_vorrat+$planet_vorrat; ?>)*-1;
                    document.formular.planet_vorrat.value=s5.getValue();
                    <?php
                } else {
                    ?>
                    document.formular.fracht_vorrat.value=0;
                    document.formular.planet_vorrat.value=0;
                    <?php
                }
                if (($fracht_lemin>=1) or ($planet_lemin>=1)) {
                    ?>
                    document.getElementById('hid_fracht_lemin').value=(s.getValue()-<?php echo $fracht_lemin+$planet_lemin; ?>)*-1;
                    document.getElementById('hid_planet_lemin').value=s.getValue();
                    <?php
                } else {
                    ?>
                    document.getElementById('hid_fracht_lemin').value=0;
                    document.getElementById('hid_planet_lemin').value=0;
                    <?php
                }
                if ($infanterie!=1) {
                    if (($fracht_min1>=1) or ($planet_min1>=1)) {
                        ?>
                        document.formular.fracht_min1.value=(s2.getValue()-<?php echo $fracht_min1+$planet_min1; ?>)*-1;
                        document.formular.planet_min1.value=s2.getValue();
                        <?php
                    } else {
                        ?>
                        document.formular.fracht_min1.value=0;
                        document.formular.planet_min1.value=0;
                        <?php
                    }
                    if (($fracht_min2>=1) or ($planet_min2>=1)) {
                        ?>
                        document.formular.fracht_min2.value=(s3.getValue()-<?php echo $fracht_min2+$planet_min2; ?>)*-1;
                        document.formular.planet_min2.value=s3.getValue();
                        <?php
                    } else {
                        ?>
                        document.formular.fracht_min2.value=0;
                        document.formular.planet_min2.value=0;
                        <?php
                    }
                    if (($fracht_min3>=1) or ($planet_min3>=1)) {
                        ?>
                        document.formular.fracht_min3.value=(s4.getValue()-<?php echo $fracht_min3+$planet_min3; ?>)*-1;
                        document.formular.planet_min3.value=s4.getValue();
                        <?php
                    } else {
                        ?>
                        document.formular.fracht_min3.value=0;
                        document.formular.planet_min3.value=0;
                        <?php
                    }
                }
                if ((($besitzer!=$spieler) and ($beziehung[$besitzer][$spieler]['status']==5))or(($kolonisten_spieler_t!=0)and ($kolonisten_spieler_t!=$spieler))) {
                    ?>
                    var leute = eval(document.formular.fracht_leute.value+'+0');
                    leute=leute/100;
                    var schwerebt = eval(document.formular.s_schwerebt.value+'+0');
                    schwerebt=schwerebt*1.5;
                    var leichtebt = eval(document.formular.s_leichtebt.value+'+0');
                    leichtebt=leichtebt*0.3;
                    <?php
                } else {
                    if ($infanterie!=1) {
                        ?>
                        var leute = eval(document.formular.fracht_leute.value+'+0');
                        leute=leute/100;
                        var schwerebt = eval(document.formular.s_schwerebt.value+'+0');
                        schwerebt=schwerebt*1.5;
                        <?php
                    }
                    ?>
                    var leichtebt = eval(document.formular.s_leichtebt.value+'+0');
                    leichtebt=leichtebt*0.3;
                    <?php
                }
                ?>
                var vorrat = eval(document.formular.fracht_vorrat.value+'+0');
                <?php
                if ($infanterie!=1) {
                    ?>
                    var min1= eval(document.formular.fracht_min1.value+'+0');
                    var min2= eval(document.formular.fracht_min2.value+'+0');
                    var min3= eval(document.formular.fracht_min3.value+'+0');
                    <?php
                }
                if ($infanterie!=1) {
                    if ((($besitzer!=$spieler) and ($beziehung[$besitzer][$spieler]['status']==5))or(($kolonisten_spieler_t!=0)and ($kolonisten_spieler_t!=$spieler))) {
                        ?>
                        var beladenzahl = Math.round(leute+leichtebt+schwerebt+vorrat+min1+min2+min3);
                        <?php
                    } else {
                        ?>
                        var beladenzahl = Math.round(leute+leichtebt+schwerebt+vorrat+min1+min2+min3);
                        <?php
                    }
                } else {
                    ?>
                    var beladenzahl = Math.round(leichtebt+vorrat);
                    <?php
                }
                ?>
                if(beladenzahl > <?php echo $frachtraum; ?>)  {
                    var zuviel = beladenzahl -  <?php echo $frachtraum; ?>;
                    alert("<?php echo html_entity_decode(str_replace(array('{1}'),array($frachtraum),$lang['flottebeta']['frachtueberladen'][0]));?>"+zuviel+"<?php echo html_entity_decode($lang['flottebeta']['frachtueberladen'][1]); ?>");
                    return false;
                }
                var lemin= eval(document.getElementById('hid_fracht_lemin').value+'+0');
                if(lemin > <?php echo $leminmax; ?>)  {
                    var zuviell = lemin -  <?php echo $leminmax; ?>;
                    alert("<?php echo html_entity_decode(str_replace(array('{1}'),array($leminmax),$lang['flottebeta']['leminueberladen'][0]));?>"+zuviell+"<?php echo html_entity_decode($lang['flottebeta']['leminueberladen'][1]); ?>");
                    return false;
                }

                return true;
            }
        </script>
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td><form name="formular" onsubmit="return checken();"  method="post" action="flotte_beta.php?fu=5&shid=<?php echo $shid; ?>&pid=<?php echo $pid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                <td><img src="../bilder/empty.gif" border="0" width="230" height="5"></td>
                <td><img src="../bilder/empty.gif" border="0" width="60" height="5"></td>
            </tr>
            <tr>
                <td>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                        </tr>
                        <tr>
                            <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            <td><img src="../daten/<?php echo $volk; ?>/bilder_schiffe/<?php echo $bild_klein; ?>" border="0" height="50"></td>
                            <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                        </tr>
                        <tr>
                            <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                        </tr>
                    </table>
                </td>
                <td valign="top">
                    <center>
                        <table border="0" cellspacing="0" cellpadding="1">
                            <tr>
                                <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="4"></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                                <td><center><?php echo $lang['flottebeta']['transporterraum']; ?></center></td>
                                <td><a href="javascript:hilfe(15);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                            </tr>
                            <tr>
                                <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="3"></td>
                            </tr>
                        </table>
                    </center>
                    <center><nobr><?php echo $lang['flottebeta']['frachtraumgroesse']; ?>: <?php echo $frachtraum; ?> <?php echo $lang['flottebeta']['kt']?></nobr></center>
                </td>
                <td>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                        </tr>
                        <tr>
                            <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            <td><img src="<?php echo $bildpfad; ?>/planeten/<?php echo $klasse; ?>_<?php echo $bild; ?>.jpg" border="0"  height="50"></td>
                            <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                        </tr>
                        <tr>
                            <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td><img src="../bilder/empty.gif" border="0" width="77" height="5"></td>
                <td><img src="../bilder/empty.gif" border="0" width="230" height="5"></td>
                <td><img src="../bilder/empty.gif" border="0" width="60" height="5"></td>
            </tr>
        </table>
        <?php
        if ((($besitzer!=$spieler) and ($beziehung[$besitzer][$spieler]['status']==5))or(($kolonisten_spieler_t!=0)and ($kolonisten_spieler_t!=$spieler))) {
            } else {
                if ($infanterie!=1) {
                    ?>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="77" height="1"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="230" height="1"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="60" height="1"></td>
                        </tr>
                        <tr>
                            <td>
                                <center>
                                    <img src="<?php echo $bildpfad; ?>/icons/crew.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['kolonisten']; ?>">
                                    <br>
                                    <div id="fracht_leute"><?php echo $fracht_leute; ?></div>
                                </center>
                            </td>
                            <td>
                                <?php
                                if (($fracht_leute>=1) or ($planet_kolonisten>=1)) {
                                    ?>
                                    <div class="slider" id="slider-7" tabIndex="1"><input class="slider-input" id="slider-input-7"/></div>
                                    <?php
                                }
                                ?>
                            </td>
                            <td>
                                <center>
                                    <img src="<?php echo $bildpfad; ?>/icons/crew.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['kolonisten']; ?>">
                                    <br>
                                    <div id="planet_kolonisten"><?php echo $planet_kolonisten; ?></div>
                                </center>
                            </td>
                        </tr>
                    </table>
                    <?php
                    if (($fracht_leute>=1) or ($planet_kolonisten>=1)) {
                        ?>
                        <script type="text/javascript">
                            var s7 = new Slider(document.getElementById("slider-7"), document.getElementById("slider-input-7"));
                            s7.onchange = function () {
                                var ant=document.getElementById('fracht_leute');
                                ant.innerHTML=(s7.getValue()-<?php echo $fracht_leute+$planet_kolonisten; ?>)*-1;
                                var ant=document.getElementById('planet_kolonisten');
                                ant.innerHTML=s7.getValue();
                            };
                            s7.setMinimum(0);
                            s7.setMaximum(<?php echo $fracht_leute+$planet_kolonisten; ?>);
                            s7.setValue(<?php echo $planet_kolonisten;  ?>);
                        </script>
                        <?php
                    }
                }
                ?>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="77" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="230" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="60" height="1"></td>
                    </tr>
                    <tr>
                        <td>
                            <center>
                                <img src="<?php echo $bildpfad; ?>/icons/leichtebt.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['leichtebt']; ?>">
                                <br>
                                <div id="s_leichtebt"><?php echo $s_leichtebt; ?></div>
                            </center>
                        </td>
                        <td>
                            <?php
                            if (($s_leichtebt>=1) or ($p_leichtebt>=1)) {
                                ?>
                                <div class="slider" id="slider-8" tabIndex="1"><input class="slider-input" id="slider-input-8"/></div>
                                <?php
                            }
                            ?>
                        </td>
                        <td>
                            <center>
                                <img src="<?php echo $bildpfad; ?>/icons/leichtebt.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['leichtebt']; ?>">
                                <br>
                                <div id="p_leichtebt"><?php echo $p_leichtebt; ?></div>
                            </center>
                        </td>
                    </tr>
                </table>
                <?php
                if (($s_leichtebt>=1) or ($p_leichtebt>=1)) {
                    ?>
                    <script type="text/javascript">
                        var s8 = new Slider(document.getElementById("slider-8"), document.getElementById("slider-input-8"));
                        s8.onchange = function () {
                            var ant=document.getElementById('s_leichtebt');
                            ant.innerHTML=(s8.getValue()-<?php echo $s_leichtebt+$p_leichtebt; ?>)*-1;
                            var ant=document.getElementById('p_leichtebt');
                            ant.innerHTML=s8.getValue();
                        };
                        s8.setMinimum(0);
                        s8.setMaximum(<?php echo $s_leichtebt+$p_leichtebt; ?>);
                        s8.setValue(<?php echo $p_leichtebt;  ?>);
                    </script>
                    <?php
                }
                if ($infanterie!=1) {
                    ?>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="77" height="1"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="230" height="1"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="60" height="1"></td>
                        </tr>
                            <tr>
                            <td>
                                <center>
                                    <img src="<?php echo $bildpfad; ?>/icons/schwerebt.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['schwerebt']; ?>">
                                    <br>
                                    <div id="s_schwerebt"><?php echo $s_schwerebt; ?></div>
                                </center>
                            </td>
                            <td>
                                <?php
                                if (($s_schwerebt>=1) or ($p_schwerebt>=1)) {
                                    ?>
                                    <div class="slider" id="slider-9" tabIndex="1"><input class="slider-input" id="slider-input-9"/></div>
                                    <?php
                                }
                                ?>
                            </td>
                            <td>
                                <center>
                                    <img src="<?php echo $bildpfad; ?>/icons/schwerebt.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['schwerebt']; ?>">
                                    <br>
                                    <div id="p_schwerebt"><?php echo $p_schwerebt; ?></div>
                                </center>
                            </td>
                        </tr>
                    </table>
                    <?php
                    if (($s_schwerebt>=1) or ($p_schwerebt>=1)) {
                        ?>
                        <script type="text/javascript">
                            var s9 = new Slider(document.getElementById("slider-9"), document.getElementById("slider-input-9"));
                            s9.onchange = function () {
                                var ant=document.getElementById('s_schwerebt');
                                ant.innerHTML=(s9.getValue()-<?php echo $s_schwerebt+$p_schwerebt; ?>)*-1;
                                var ant=document.getElementById('p_schwerebt');
                                ant.innerHTML=s9.getValue();
                            };
                            s9.setMinimum(0);
                            s9.setMaximum(<?php echo $s_schwerebt+$p_schwerebt; ?>);
                            s9.setValue(<?php echo $p_schwerebt;  ?>);
                        </script>
                        <?php
                    }
                }
            }
            if ($infanterie!=1) {
                ?>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="77" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="230" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="60" height="1"></td>
                    </tr>
                    <tr>
                        <td>
                            <center>
                                <img src="<?php echo $bildpfad; ?>/icons/cantox.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['cantox']; ?>">
                                <br>
                                <div id="fracht_cantox"><?php echo $fracht_cantox; ?></div>
                            </center>
                        </td>
                        <td>
                            <?php
                            if (($fracht_cantox>=1) or ($planet_cantox>=1)) {
                                ?>
                                <div class="slider" id="slider-6" tabIndex="1"><input class="slider-input" id="slider-input-6"/></div>
                                <?php
                            }
                            ?>
                        </td>
                        <td>
                            <center>
                                <img src="<?php echo $bildpfad; ?>/icons/cantox.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['cantox']; ?>">
                                <br>
                                <div id="planet_cantox"><?php echo $planet_cantox; ?></div>
                            </center>
                        </td>
                    </tr>
                </table>
                <?php
                if (($fracht_cantox>=1) or ($planet_cantox>=1)) {
                    ?>
                    <script type="text/javascript">
                        var s6 = new Slider(document.getElementById("slider-6"), document.getElementById("slider-input-6"));
                        s6.onchange = function () {
                            var ant=document.getElementById('fracht_cantox');
                            ant.innerHTML=(s6.getValue()-<?php echo $fracht_cantox+$planet_cantox; ?>)*-1;
                            var ant=document.getElementById('planet_cantox');
                            ant.innerHTML=s6.getValue();
                        };
                        s6.setMinimum(0);
                        s6.setMaximum(<?php echo $fracht_cantox+$planet_cantox; ?>);
                        s6.setValue(<?php echo $planet_cantox;  ?>);
                    </script>
                    <?php
                }
            }
            ?>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="77" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="230" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="60" height="1"></td>
                </tr>
            
                <tr>
                    <td>
                        <center>
                            <img src="<?php echo $bildpfad; ?>/icons/vorrat.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['vorraete']; ?>">
                            <br>
                            <div id="fracht_vorrat"><?php echo $fracht_vorrat; ?></div>
                        </center>
                    </td>
                    <td>
                        <?php
                        if (($fracht_vorrat>=1) or ($planet_vorrat>=1)) {
                            ?>
                            <div class="slider" id="slider-5" tabIndex="1"><input class="slider-input" id="slider-input-5"/></div>
                            <?php
                        }
                        ?>
                    </td>
                    <td>
                        <center>
                            <img src="<?php echo $bildpfad; ?>/icons/vorrat.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['vorraete']; ?>">
                            <br>
                            <div id="planet_vorrat"><?php echo $planet_vorrat; ?></div>
                        </center>
                    </td>
                </tr>
            </table>
            <?php
            if (($fracht_vorrat>=1) or ($planet_vorrat>=1)) {
                ?>
                <script type="text/javascript">
                    var s5 = new Slider(document.getElementById("slider-5"), document.getElementById("slider-input-5"));
                    s5.onchange = function () {
                        var ant=document.getElementById('fracht_vorrat');
                        ant.innerHTML=(s5.getValue()-<?php echo $fracht_vorrat+$planet_vorrat; ?>)*-1;
                        var ant=document.getElementById('planet_vorrat');
                        ant.innerHTML=s5.getValue();
                    };
                    s5.setMinimum(0);
                    s5.setMaximum(<?php echo $fracht_vorrat+$planet_vorrat; ?>);
                    s5.setValue(<?php echo $planet_vorrat;  ?>);
                </script>
                <?php
            }
            ?>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="77" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="230" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="60" height="1"></td>
                </tr>
                <tr>
                    <td>
                        <center>
                            <img src="<?php echo $bildpfad; ?>/icons/lemin.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['lemin']; ?>">
                            <br>
                            <div id="fracht_lemin"><?php echo $fracht_lemin; ?></div>
                        </center>
                    </td>
                    <td>
                        <?php
                        if (($fracht_lemin>=1) or ($planet_lemin>=1)) {
                            ?>
                            <div class="slider" id="slider-1" tabIndex="1"><input class="slider-input" id="slider-input-1"/></div>
                            <?php
                        }
                        ?>
                    </td>
                    <td>
                        <center>
                            <img src="<?php echo $bildpfad; ?>/icons/lemin.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['lemin']; ?>">
                            <br><div id="planet_lemin"><?php echo $planet_lemin; ?></div>
                        </center>
                    </td>
                </tr>
            </table>
            <?php
            if (($fracht_lemin>=1) or ($planet_lemin>=1)) {
                ?>
                <script type="text/javascript">
                    var s = new Slider(document.getElementById("slider-1"), document.getElementById("slider-input-1"));
                    s.onchange = function () {
                        var ant=document.getElementById('fracht_lemin');
                        ant.innerHTML=(s.getValue()-<?php echo $fracht_lemin+$planet_lemin; ?>)*-1;
                        var ant=document.getElementById('planet_lemin');
                        ant.innerHTML=s.getValue();
                    };
                    s.setMinimum(0);
                    s.setMaximum(<?php echo $fracht_lemin+$planet_lemin; ?>);
                    s.setValue(<?php echo $planet_lemin;  ?>);
                </script>
                <?php
            }
            if ($infanterie!=1) {
                ?>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="77" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="230" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="60" height="1"></td>
                    </tr>
                    <tr>
                        <td>
                            <center>
                                <img src="<?php echo $bildpfad; ?>/icons/mineral_1.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['baxterium']; ?>">
                                <br>
                                <div id="fracht_min1"><?php echo $fracht_min1; ?></div>
                            </center>
                        </td>
                        <td>
                            <?php
                            if (($fracht_min1>=1) or ($planet_min1>=1)) {
                                ?>
                                <div class="slider" id="slider-2" tabIndex="1"><input class="slider-input" id="slider-input-2"/></div>
                                <?php
                            }
                            ?>
                        </td>
                        <td>
                            <center>
                                <img src="<?php echo $bildpfad; ?>/icons/mineral_1.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['baxterium']; ?>">
                                <br>
                                <div id="planet_min1"><?php echo $planet_min1; ?></div>
                            </center>
                        </td>
                    </tr>
                </table>
                <?php
                if (($fracht_min1>=1) or ($planet_min1>=1)) {
                    ?>
                    <script type="text/javascript">
                        var s2 = new Slider(document.getElementById("slider-2"), document.getElementById("slider-input-2"));
                        s2.onchange = function () {
                            var ant=document.getElementById('fracht_min1');
                            ant.innerHTML=(s2.getValue()-<?php echo $fracht_min1+$planet_min1; ?>)*-1;
                            var ant=document.getElementById('planet_min1');
                            ant.innerHTML=s2.getValue();
                        };
                        s2.setMinimum(0);
                        s2.setMaximum(<?php echo $fracht_min1+$planet_min1; ?>);
                        s2.setValue(<?php echo $planet_min1;  ?>);
                    </script>
                    <?php
                }
                ?>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="77" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="230" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="60" height="1"></td>
                    </tr>
                    <tr>
                        <td>
                            <center>
                                <img src="<?php echo $bildpfad; ?>/icons/mineral_2.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['rennurbin']; ?>">
                                <br>
                                <div id="fracht_min2"><?php echo $fracht_min2; ?></div>
                            </center>
                        </td>
                        <td>
                            <?php
                            if (($fracht_min2>=1) or ($planet_min2>=1)) {
                                ?>
                                <div class="slider" id="slider-3" tabIndex="1"><input class="slider-input" id="slider-input-3"/></div>
                                <?php
                            }
                            ?>
                        </td>
                        <td>
                            <center>
                                <img src="<?php echo $bildpfad; ?>/icons/mineral_2.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['rennurbin']; ?>">
                                <br>
                                <div id="planet_min2"><?php echo $planet_min2; ?></div>
                            </center>
                        </td>
                    </tr>
                </table>
                <?php
                if (($fracht_min2>=1) or ($planet_min2>=1)) {
                    ?>
                    <script type="text/javascript">
                        var s3 = new Slider(document.getElementById("slider-3"), document.getElementById("slider-input-3"));
                        s3.onchange = function () {
                            var ant=document.getElementById('fracht_min2');
                            ant.innerHTML=(s3.getValue()-<?php echo $fracht_min2+$planet_min2; ?>)*-1;
                            var ant=document.getElementById('planet_min2');
                            ant.innerHTML=s3.getValue();
                        };
                        s3.setMinimum(0);
                        s3.setMaximum(<?php echo $fracht_min2+$planet_min2; ?>);
                        s3.setValue(<?php echo $planet_min2;  ?>);
                    </script>
                    <?php
                }
                ?>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="77" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="230" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="60" height="1"></td>
                    </tr>
                    <tr>
                        <td>
                            <center>
                                <img src="<?php echo $bildpfad; ?>/icons/mineral_3.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['vomisaan']; ?>">
                                <br>
                                <div id="fracht_min3"><?php echo $fracht_min3; ?></div>
                            </center>
                        </td>
                        <td>
                            <?php
                            if (($fracht_min3>=1) or ($planet_min3>=1)) {
                                ?>
                                <div class="slider" id="slider-4" tabIndex="1"><input class="slider-input" id="slider-input-4"/></div>
                                <?php
                            }
                            ?>
                        </td>
                        <td>
                            <center>
                                <img src="<?php echo $bildpfad; ?>/icons/mineral_3.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['vomisaan']; ?>">
                                <br>
                                <div id="planet_min3"><?php echo $planet_min3; ?></div>
                            </center>
                        </td>
                    </tr>
                </table>
                <?php
                if (($fracht_min3>=1) or ($planet_min3>=1)) {
                    ?>
                    <script type="text/javascript">
                        var s4 = new Slider(document.getElementById("slider-4"), document.getElementById("slider-input-4"));
                        s4.onchange = function () {
                            var ant=document.getElementById('fracht_min3');
                            ant.innerHTML=(s4.getValue()-<?php echo $fracht_min3+$planet_min3; ?>)*-1;
                            var ant=document.getElementById('planet_min3');
                            ant.innerHTML=s4.getValue();
                        };
                        s4.setMinimum(0);
                        s4.setMaximum(<?php echo $fracht_min3+$planet_min3; ?>);
                        s4.setValue(<?php echo $planet_min3;  ?>);
                    </script>
                    <?php
                }
            }
            ?>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="367" height="5"></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit" style="width:367px;" value="<?php echo $lang['flottebeta']['durchfuehren']; ?>">
                        <input type="hidden" name="s_leichtebt" id="hid_s_leichtebt" value=0>
                        <input type="hidden" name="p_leichtebt" id="hid_p_leichtebt" value=0>
                        <input type="hidden" name="fracht_vorrat" id="hid_fracht_vorrat" value=0>
                        <input type="hidden" name="planet_vorrat" id="hid_planet_vorrat" value=0>
                        <input type="hidden" name="fracht_lemin" id="hid_fracht_lemin" value=0>
                        <input type="hidden" name="planet_lemin" id="hid_planet_lemin" value=0>
                        <?php 
                        if ($infanterie==1) {
                            ?>
                            <input type="hidden" name="fracht_leute" id="hid_fracht_leute" value='<?php echo $fracht_leute?>'>
                            <input type="hidden" name="planet_kolonisten" id="hid_planet_kolonisten" value='<?php echo $planet_kolonisten; ?>'>
                            <input type="hidden" name="s_schwerebt" id="hid_s_schwerebt" value='<?php echo $s_schwerebt?>'>
                            <input type="hidden" name="p_schwerebt" id="hid_p_schwerebt" value='<?php echo $p_schwerebt; ?>'>
                            <input type="hidden" name="fracht_cantox" id="hid_fracht_cantox" value='<?php echo $fracht_cantox?>'>
                            <input type="hidden" name="planet_cantox" id="hid_planet_cantox" value='<?php echo $planet_cantox; ?>'>
                            <input type="hidden" name="fracht_min1" id="hid_fracht_min1" value='<?php echo $fracht_min1?>'>
                            <input type="hidden" name="planet_min1" id="hid_planet_min1" value='<?php echo $planet_min1; ?>'>
                            <input type="hidden" name="fracht_min2" id="hid_fracht_min2" value='<?php echo $fracht_min2?>'>
                            <input type="hidden" name="planet_min2" id="hid_planet_min2" value='<?php echo $planet_min2; ?>'>
                            <input type="hidden" name="fracht_min3" id="hid_fracht_min3" value='<?php echo $fracht_min3?>'>
                            <input type="hidden" name="planet_min3" id="hid_planet_min3" value='<?php echo $planet_min3; ?>'>
                            <?php
                        } else {
                            ?>
                            <input type="hidden" name="fracht_leute" id="hid_fracht_leute" value=0>
                            <input type="hidden" name="planet_kolonisten" id="hid_planet_kolonisten" value=0>
                            <input type="hidden" name="s_schwerebt" id="hid_s_schwerebt" value=0>
                            <input type="hidden" name="p_schwerebt" id="hid_p_schwerebt" value=0>
                            <input type="hidden" name="fracht_cantox" id="hid_fracht_cantox" value=0>
                            <input type="hidden" name="planet_cantox" id="hid_planet_cantox" value=0>
                            <input type="hidden" name="fracht_min1" id="hid_fracht_min1" value=0>
                            <input type="hidden" name="planet_min1" id="hid_planet_min1" value=0>
                            <input type="hidden" name="fracht_min2" id="hid_fracht_min2" value=0>
                            <input type="hidden" name="planet_min2" id="hid_planet_min2" value=0>
                            <input type="hidden" name="fracht_min3" id="hid_fracht_min3" value=0>
                            <input type="hidden" name="planet_min3" id="hid_planet_min3" value=0>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td></form><img src="../bilder/empty.gif" border="0" width="367" height="5"></td>
                </tr>
            </table>
            <?php
        } else {
            ?>
            <body text="#000000" scroll="auto" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
                <br><br><br>
                <center><?php echo $lang['flottebeta']['keineobjekte']; ?></center>
                <?php
        }
        echo '</div>';
    include ("inc.footer.php");
}

if ($fuid==5) {
    include ("inc.header.php");
    ?>
    <body text="#000000" scroll="no" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php
        $pid=int_get('pid');
        $zeiger_temp = @mysql_query("SELECT * FROM $skrupel_planeten where id=$pid");
        $array_temp = @mysql_fetch_array($zeiger_temp);

        $planet_name=$array_temp["name"];
        $besitzer=$array_temp["besitzer"];
        $s_x_pos=$array_temp["x_pos"];
        $s_y_pos=$array_temp["y_pos"];
        $s_planet_kolonisten=$array_temp["kolonisten"];
        $s_p_leichtebt=$array_temp["leichtebt"];
        $s_p_schwerebt=$array_temp["schwerebt"];
        $s_planet_kolonisten_n=$array_temp["kolonisten_new"];
        $s_p_leichtebt_n=$array_temp["leichtebt_new"];
        $s_p_schwerebt_n=$array_temp["schwerebt_new"];
        $s_osys_1=$array_temp["osys_1"];
        $s_osys_2=$array_temp["osys_2"];
        $s_osys_3=$array_temp["osys_3"];
        $s_osys_4=$array_temp["osys_4"];
        $s_osys_5=$array_temp["osys_5"];
        $s_osys_6=$array_temp["osys_6"];
        $s_planet_cantox=$array_temp["cantox"];
        $s_planet_vorrat=$array_temp["vorrat"];
        $s_planet_lemin=$array_temp["lemin"];
        $s_planet_min1=$array_temp["min1"];
        $s_planet_min2=$array_temp["min2"];
        $s_planet_min3=$array_temp["min3"];

        $planet_kolonisten = (!int_post('planet_kolonisten'))?0:int_post('planet_kolonisten');
        $planet_cantox = (!int_post('planet_cantox'))?0:int_post('planet_cantox');
        $planet_vorrat = (!int_post('planet_vorrat'))?0:int_post('planet_vorrat');
        $planet_lemin = (!int_post('planet_lemin'))?0:int_post('planet_lemin');
        $planet_min1 = (!int_post('planet_min1'))?0:int_post('planet_min1');
        $planet_min2 = (!int_post('planet_min2'))?0:int_post('planet_min2');
        $planet_min3 = (!int_post('planet_min3'))?0:int_post('planet_min3');
        $fracht_leute = (!int_post('fracht_leute'))?0:int_post('fracht_leute');
        $fracht_cantox = (!int_post('fracht_cantox'))?0:int_post('fracht_cantox');
        $fracht_vorrat = (!int_post('fracht_vorrat'))?0:int_post('fracht_vorrat');
        $fracht_lemin = (!int_post('fracht_lemin'))?0:int_post('fracht_lemin');
        $fracht_min1 = (!int_post('fracht_min1'))?0:int_post('fracht_min1');
        $fracht_min2 = (!int_post('fracht_min2'))?0:int_post('fracht_min2');
        $fracht_min3 = (!int_post('fracht_min3'))?0:int_post('fracht_min3');
        $p_leichtebt = (!int_post('p_leichtebt'))?0:int_post('p_leichtebt');
        $p_schwerebt = (!int_post('p_schwerebt'))?0:int_post('p_schwerebt');
        $s_leichtebt = (!int_post('s_leichtebt'))?0:int_post('s_leichtebt');
        $s_schwerebt = (!int_post('s_schwerebt'))?0:int_post('s_schwerebt');

        if (($planet_kolonisten>=0) and ($p_leichtebt>=0) and ($p_schwerebt>=0) and ($planet_cantox>=0) and ($planet_vorrat>=0) and ($planet_lemin>=0) and ($planet_min1>=0) and ($planet_min2>=0) and ($planet_min3>=0) and ($fracht_leute>=0) and ($s_leichtebt>=0) and ($s_schwerebt>=0) and ($fracht_cantox>=0) and ($fracht_vorrat>=0) and ($fracht_lemin>=0) and ($fracht_min1>=0) and ($fracht_min2>=0) and ($fracht_min3>=0)) {
            $s_zeiger = @mysql_query("SELECT * FROM $skrupel_schiffe where id=$shid");
            $s_array = @mysql_fetch_array($s_zeiger);
            $s_spiel=$s_array["spiel"];
            $s_besitzer=$s_array["besitzer"];
            $s_besitzer_t=$s_besitzer;
            $s_fertigkeiten=$s_array["fertigkeiten"];
            $s_schiff_kolonisten=$s_array["fracht_leute"];
            $s_schiff_cantox=$s_array["fracht_cantox"];
            $s_schiff_vorrat=$s_array["fracht_vorrat"];
            $s_schiff_lemin=$s_array["lemin"];
            $s_schiff_min1=$s_array["fracht_min1"];
            $s_schiff_min2=$s_array["fracht_min2"];
            $s_schiff_min3=$s_array["fracht_min3"];
            $s_schiff_frachtraum=$s_array["frachtraum"];
            $s_schiff_leminmax=$s_array["leminmax"];
            $s_schiff_leichtebt=$s_array["leichtebt"];
            $s_schiff_schwerebt=$s_array["schwerebt"];
            $s_kox=$s_array["kox"];
            $s_koy=$s_array["koy"];
            $s_erwtrans=@intval(substr($s_fertigkeiten,46,2));
            $s_infanterie=@intval(substr($s_fertigkeiten,57,1));
            $s_zeiger = @mysql_query("SELECT * FROM $skrupel_spiele where id=$s_spiel");
            $s_array = @mysql_fetch_array($s_zeiger);
            $s_besitzer="spieler_".$s_besitzer;
            $s_spieler_id=$s_array[$s_besitzer];
            $s_zeiger = @mysql_query("SELECT uid FROM $skrupel_user where id=$s_spieler_id");
            $s_array = @mysql_fetch_array($s_zeiger);
            $s_uid=$s_array["uid"];
            if($s_uid===$uid){
                if((($s_osys_1==7) or ($s_osys_2==7) or ($s_osys_3==7) or ($s_osys_4==7) or ($s_osys_5==7)or ($s_osys_6==7))and($s_besitzer_t!=$besitzer)and($besitzer!=0)){
                    $s_planet_cantox=max(0,$s_planet_cantox-500);
                    $s_planet_vorrat=max(0,$s_planet_vorrat-100);
                    $s_planet_lemin=max(0,$s_planet_lemin-100);
                    $s_planet_min1=max(0,$s_planet_min1-100);
                    $s_planet_min2=max(0,$s_planet_min2-100);
                    $s_planet_min3=max(0,$s_planet_min3-100);
                }
                if(max(($s_kox-$s_x_pos),($s_koy-$s_y_pos))<=(($s_erwtrans>=1) ? 25 : 0)){
                    if((($s_infanterie==1)and($s_schwerebt==0)and($fracht_leute==0)and($fracht_cantox==0)and($fracht_min1==0)and($fracht_min2==0)and($fracht_min3==0))or($s_infanterie==0)){
                        if (    ($besitzer==$spieler)
                                    and(($s_schiff_kolonisten+$s_planet_kolonisten)==($fracht_leute+$planet_kolonisten))
                                    and(($s_schiff_leichtebt+$s_p_leichtebt)==($s_leichtebt+$p_leichtebt))
                                    and(($s_schiff_schwerebt+$s_p_schwerebt)==($s_schwerebt+$p_schwerebt))
                                    and(($s_schiff_lemin+$s_planet_lemin)==($fracht_lemin+$planet_lemin))
                                    and(($s_schiff_cantox+$s_planet_cantox)==($fracht_cantox+$planet_cantox))
                                    and(($s_schiff_vorrat+$s_planet_vorrat)==($fracht_vorrat+$planet_vorrat))
                                    and(($s_schiff_min1+$s_planet_min1)==($fracht_min1+$planet_min1))
                                    and(($s_schiff_min2+$s_planet_min2)==($fracht_min2+$planet_min2))
                                    and(($s_schiff_min3+$s_planet_min3)==($fracht_min3+$planet_min3))
                                    and($fracht_lemin<=$s_schiff_leminmax)
                                    and(round(($fracht_leute/100)+($s_leichtebt*0.3)+($s_schwerebt*1.5)+$fracht_vorrat+$fracht_min1+$fracht_min2+$fracht_min3)<=$s_schiff_frachtraum)
                                ){
                            $zeiger_temp = @mysql_query("UPDATE $skrupel_planeten set leichtebt=$p_leichtebt,schwerebt=$p_schwerebt,kolonisten=$planet_kolonisten,cantox=$planet_cantox,vorrat=$planet_vorrat,lemin=$planet_lemin,min1=$planet_min1,min2=$planet_min2,min3=$planet_min3 where id=$pid");
                            $zeiger_temp = @mysql_query("UPDATE $skrupel_schiffe set leichtebt=$s_leichtebt,schwerebt=$s_schwerebt,fracht_leute=$fracht_leute,fracht_cantox=$fracht_cantox,fracht_vorrat=$fracht_vorrat,lemin=$fracht_lemin,fracht_min1=$fracht_min1,fracht_min2=$fracht_min2,fracht_min3=$fracht_min3 where id=$shid");
                        }elseif(
                                ($besitzer!=$spieler)
                                    and(($s_schiff_kolonisten+$s_planet_kolonisten_n)==($fracht_leute+$planet_kolonisten))
                                    and(($s_schiff_leichtebt+$s_p_leichtebt_n)==($s_leichtebt+$p_leichtebt))
                                    and(($s_schiff_schwerebt+$s_p_schwerebt_n)==($s_schwerebt+$p_schwerebt))
                                    and(($s_schiff_lemin+$s_planet_lemin)==($fracht_lemin+$planet_lemin))
                                    and(($s_schiff_cantox+$s_planet_cantox)==($fracht_cantox+$planet_cantox))
                                    and(($s_schiff_vorrat+$s_planet_vorrat)==($fracht_vorrat+$planet_vorrat))
                                    and(($s_schiff_min1+$s_planet_min1)==($fracht_min1+$planet_min1))
                                    and(($s_schiff_min2+$s_planet_min2)==($fracht_min2+$planet_min2))
                                    and(($s_schiff_min3+$s_planet_min3)==($fracht_min3+$planet_min3))
                                    and($fracht_lemin<=$s_schiff_leminmax)
                                    and(round(($fracht_leute/100)+($s_leichtebt*0.3)+($s_schwerebt*1.5)+$fracht_vorrat+$fracht_min1+$fracht_min2+$fracht_min3)<=$s_schiff_frachtraum)
                                ){
                            if(($planet_kolonisten+$p_leichtebt+$p_schwerebt)>0){
                                $zeiger_temp = @mysql_query("UPDATE $skrupel_planeten set leichtebt_new=$p_leichtebt,schwerebt_new=$p_schwerebt,kolonisten_spieler=$spieler,kolonisten_new=$planet_kolonisten,cantox=$planet_cantox,vorrat=$planet_vorrat,lemin=$planet_lemin,min1=$planet_min1,min2=$planet_min2,min3=$planet_min3 where id=$pid");
                            }else{
                                $zeiger_temp = @mysql_query("UPDATE $skrupel_planeten set leichtebt_new=$p_leichtebt,schwerebt_new=$p_schwerebt,kolonisten_spieler=0,kolonisten_new=$planet_kolonisten,cantox=$planet_cantox,vorrat=$planet_vorrat,lemin=$planet_lemin,min1=$planet_min1,min2=$planet_min2,min3=$planet_min3 where id=$pid");
                            }
                                $zeiger_temp = @mysql_query("UPDATE $skrupel_schiffe set leichtebt=$s_leichtebt,schwerebt=$s_schwerebt,fracht_leute=$fracht_leute,fracht_cantox=$fracht_cantox,fracht_vorrat=$fracht_vorrat,lemin=$fracht_lemin,fracht_min1=$fracht_min1,fracht_min2=$fracht_min2,fracht_min3=$fracht_min3 where id=$shid");
                        }else{
                            ?>
                            <br><br><br><br>
                            <center><b><?php echo $lang['flottebeta']['betrug']?></b></center>
                            <?php
                        }
                    }else{
                        echo "Fehler 3";
                    }
                }else{
                    echo "Fehler 2";
                }
            }else{
                echo "Fehler 1";
            }
        }
        //echo "UPDATE $skrupel_schiffe set fracht_leute=$fracht_leute,fracht_cantox=$fracht_cantox,fracht_vorrat=$fracht_vorrat,lemin=fracht_lemin,fracht_min1=$fracht_min1,fracht_min2=$fracht_min2,fracht_min3=$fracht_min3 where id=$shid";
        ?>
        <script language=JavaScript>
            parent.ship.window.location='flotte.php?fu=3&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>';
        </script>
        <br><br><br><br>
        <center><?php echo $lang['flottebeta']['transporterfolgreich']; ?></center>
        <?php
    include ("inc.footer.php");
}
if ($fuid==6) {
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
    $volk=$array["volk"];
    $bild_klein=$array["bild_klein"];
    $frachtraum=$array["frachtraum"];
    $leminmax=$array["leminmax"];
    $kox=$array["kox"];
    $koy=$array["koy"];
    $fertigkeiten=$array["fertigkeiten"];
    $s_leichtebt=$array["leichtebt"];
    $s_schwerebt=$array["schwerebt"];
    $status=$array["status"];
    $erwtrans=@intval(substr($fertigkeiten,46,2));
    $infanterie=@intval(substr($fertigkeiten,57,1));

    ?>
    <style type="text/css">
        input {
            width:                50px;
            padding:     1px;
            margin-right:        15px;
        }
        
        input, select, button {
            vertical-align:        middle;
        }
        
        #slider-1 {
            margin: 0px;
            width:  230px;
        }
        #slider-2 {
            margin: 0px;
            width:  230px;
        }
        #slider-3 {
            margin: 0px;
            width:  230px;
        }
        #slider-4 {
            margin: 0px;
            width:  230px;
        }
        #slider-5 {
            margin: 0px;
            width:  230px;
        }
        #slider-6 {
            margin: 0px;
            width:  230px;
        }
        #slider-7 {
            margin: 0px;
            width:  230px;
        }
        #slider-8 {
            margin: 0px;
            width:  230px;
        }
        #slider-9 {
            margin: 0px;
            width:  230px;
        }
    </style>
    <link type="text/css" rel="StyleSheet" href="css/winclassic.css" />
    <script type="text/javascript" src="js/range.js"></script>
    <script type="text/javascript" src="js/timer.js"></script>
    <script type="text/javascript" src="js/slider.js"></script>
    <body text="#000000" scroll="auto" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php
    
        $reichweite=0;
        if ($erwtrans>=1) {
            $reichweite=25;
        }
        $zeiger_temp = @mysql_query("SELECT * FROM $skrupel_planeten where sqrt(((x_pos-$kox)*(x_pos-$kox))+((y_pos-$koy)*(y_pos-$koy)))<=$reichweite and spiel=$spiel");
        $datensaetze_temp = @mysql_num_rows($zeiger_temp);
        if ($datensaetze_temp>=1) {
            $array_temp = @mysql_fetch_array($zeiger_temp);
            $pid=$array_temp["id"];
            $planet_name=$array_temp["name"];
            $besitzer=$array_temp["besitzer"];
            $bild=$array_temp["bild"];
            $klasse=$array_temp["klasse"];
            $kolonisten_spieler_t=$array_temp["kolonisten_spieler"];
            $planet_cantox=$array_temp["cantox"];
            $planet_vorrat=$array_temp["vorrat"];
            $planet_lemin=$array_temp["lemin"];
            $planet_min1=$array_temp["min1"];
            $planet_min2=$array_temp["min2"];
            $planet_min3=$array_temp["min3"];
                    
            if ($besitzer==$spieler) {
                $planet_kolonisten=$array_temp["kolonisten"];
                $p_leichtebt=$array_temp["leichtebt"];
                $p_schwerebt=$array_temp["schwerebt"];
            } else {
                $planet_kolonisten=$array_temp["kolonisten_new"];
                $p_leichtebt=$array_temp["leichtebt_new"];
                $p_schwerebt=$array_temp["schwerebt_new"];
                if(($planet_kolonisten==0)and($p_leichtebt==0)and($p_schwerebt==0)){
                    $kolonisten_spieler_t=0;
                    $zeiger_temp = @mysql_query("UPDATE $skrupel_planeten set kolonisten_spieler=0 where id=$pid");
                }
                $osys_1=$array_temp["osys_1"];
                $osys_2=$array_temp["osys_2"];
                $osys_3=$array_temp["osys_3"];
                $osys_4=$array_temp["osys_4"];
                $osys_5=$array_temp["osys_5"];
                $osys_6=$array_temp["osys_6"];
                if((($osys_1==7) or ($osys_2==7) or ($osys_3==7) or ($osys_4==7) or ($osys_5==7)or ($osys_6==7))and($besitzer!=0)){
                    $planet_cantox=max(0,$planet_cantox-500);
                    $planet_vorrat=max(0,$planet_vorrat-100);
                    $planet_lemin=max(0,$planet_lemin-100);
                    $planet_min1=max(0,$planet_min1-100);
                    $planet_min2=max(0,$planet_min2-100);
                    $planet_min3=max(0,$planet_min3-100);
                }
                $beziehung[$besitzer][$spieler]['status']=0;
                $beziehung[$spieler][$besitzer]['status']=0;
                $beziehung[$besitzer][$spieler]['optionen']=0;
                $beziehung[$spieler][$besitzer]['optionen']=0;
                $zeiger = @mysql_query("SELECT spiel,partei_a,partei_b,status,optionen FROM $skrupel_politik where spiel=$spiel");
                $polanzahl = @mysql_num_rows($zeiger);
                if ($polanzahl>=1) {
                    for  ($i=0; $i<$polanzahl;$i++) {
                        $ok = @mysql_data_seek($zeiger,$i);
                        $array = @mysql_fetch_array($zeiger);
                        $status=$array["status"];
                        $partei_a=$array["partei_a"];
                        $partei_b=$array["partei_b"];
                        $beziehung[$partei_a][$partei_b]['status']=$status;
                        $beziehung[$partei_b][$partei_a]['status']=$status;
                        $beziehung[$partei_a][$partei_b]['optionen']=$optionen;
                        $beziehung[$partei_b][$partei_a]['optionen']=$optionen;
                    }
                }
            }
            
            ?>
            <script type="text/javascript">
                function checken() {
                    <?php
                    if ((($besitzer!=$spieler) and ($beziehung[$besitzer][$spieler]['status']==5))or(($kolonisten_spieler_t!=0)and ($kolonisten_spieler_t!=$spieler))) {
                        ?>
                        var leute = eval(document.formular.fracht_leute.value+'+0');
                        leute=leute/100;
                        var schwerebt = eval(document.formular.s_schwerebt.value+'+0');
                        schwerebt=schwerebt*1.5;
                        var leichtebt = eval(document.formular.s_leichtebt.value+'+0');
                        leichtebt=leichtebt*0.3;
                        <?php    
                    } else {
                        if ($infanterie!=1) {
                            ?>
                            var leute = eval(document.formular.fracht_leute.value+'+0');
                            leute=leute/100;
                            var schwerebt = eval(document.formular.s_schwerebt.value+'+0');
                            schwerebt=schwerebt*1.5;
                            <?php
                        }
                        ?>
                        var leichtebt = eval(document.formular.s_leichtebt.value+'+0');
                        leichtebt=leichtebt*0.3;
                        <?php
                    }
                    ?>
                    var vorrat = eval(document.formular.fracht_vorrat.value+'+0');
                    <?php
                    if ($infanterie!=1) {
                        ?>
                        var min1= eval(document.formular.fracht_min1.value+'+0');
                        var min2= eval(document.formular.fracht_min2.value+'+0');
                        var min3= eval(document.formular.fracht_min3.value+'+0');
                        <?php
                        if ((($besitzer!=$spieler) and ($beziehung[$besitzer][$spieler]['status']==5))or(($kolonisten_spieler_t!=0)and ($kolonisten_spieler_t!=$spieler))) {
                            ?>
                            var beladenzahl = Math.round(leute+leichtebt+schwerebt+vorrat+min1+min2+min3);
                            <?php
                        } else {
                            ?>
                            var beladenzahl = Math.round(leute+leichtebt+schwerebt+vorrat+min1+min2+min3);
                            <?php
                        }
                    }else{
                        ?>
                        var beladenzahl = Math.round(leichtebt+vorrat);
                        <?php
                    }
                    ?>
                    if(beladenzahl > <?php echo $frachtraum; ?>)  {
                        var zuviel = beladenzahl -  <?php echo $frachtraum; ?>;
                        alert("<?php echo html_entity_decode(str_replace(array('{1}'),array($frachtraum),$lang['flottebeta']['frachtueberladen'][0]));?>"+zuviel+"<?php echo html_entity_decode($lang['flottebeta']['frachtueberladen'][1]); ?>");
                        return false;
                    }
                    var lemin= eval(document.formular.fracht_lemin.value+'+0');
                    if(lemin > <?php echo $leminmax; ?>)  {
                        var zuviell = lemin -  <?php echo $leminmax; ?>;
                        alert("<?php echo html_entity_decode(str_replace(array('{1}'),array($leminmax),$lang['flottebeta']['leminueberladen'][0]));?>"+zuviell+"<?php echo html_entity_decode($lang['flottebeta']['leminueberladen'][1]); ?>");
                        return false;
                    }
                    return true;
                }
            </script>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><form name="formular" onsubmit="return checken();"  method="post" action="flotte_beta.php?fu=5&shid=<?php echo $shid; ?>&pid=<?php echo $pid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="230" height="5"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="60" height="5"></td>
                </tr>
                <tr>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td><img src="../daten/<?php echo $volk; ?>/bilder_schiffe/<?php echo $bild_klein; ?>" border="0" height="50"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                        </table>
                    </td>
                    <td valign="top">
                        <center>
                            <table border="0" cellspacing="0" cellpadding="1">
                                <tr>
                                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="4"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                                    <td><center><?php echo $lang['flottebeta']['transporterraum']; ?></center></td>
                                    <td><a href="javascript:hilfe(15);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="3"></td>
                                </tr>
                            </table>
                        </center>
                        <center><nobr><?php echo $lang['flottebeta']['frachtraumgroesse']; ?>: <?php echo $frachtraum; ?> <?php echo $lang['flottebeta']['kt']?></nobr></center>
                    </td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td><img src="<?php echo $bildpfad; ?>/planeten/<?php echo $klasse; ?>_<?php echo $bild; ?>.jpg" border="0"  height="50"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="77" height="5"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="230" height="5"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="60" height="5"></td>
                </tr>
            </table>
            <script type="text/javascript">
                <?php
                if ((($besitzer!=$spieler) and ($beziehung[$besitzer][$spieler]['status']==5))or(($kolonisten_spieler_t!=0)and ($kolonisten_spieler_t!=$spieler))) {
                } else {
                    ?>
                    function check_kolonisten(art) {
                        var leute_fracht = document.formular.fracht_leute.value;
                        if (isNaN(leute_fracht)) { leute_fracht=0; }
                        leute_fracht=eval(leute_fracht+'+0');
                        var leute_planet = document.formular.planet_kolonisten.value;
                        if (isNaN(leute_planet)) { leute_planet=0; }
                        leute_planet=eval(leute_planet+'+0');
                        var leute_alles = eval(document.formular.alles_leute.value+'+0');
                        if (leute_fracht>leute_alles) { leute_fracht=leute_alles; }
                        if (leute_planet>leute_alles) { leute_planet=leute_alles; }
                        if (art==1) {
                            leute_planet = leute_alles-leute_fracht;
                        } else {
                            leute_fracht = leute_alles-leute_planet;
                        }
                        document.formular.fracht_leute.value=eval(leute_fracht+'+0');
                        document.formular.planet_kolonisten.value=eval(leute_planet+'+0');
                    }
                    function check_leichtebt(art) {
                        var s_leichtebt = document.formular.s_leichtebt.value;
                        if (isNaN(s_leichtebt)) { s_leichtebt=0; }
                        s_leichtebt=eval(s_leichtebt+'+0');
                        var p_leichtebt = document.formular.p_leichtebt.value;
                        if (isNaN(p_leichtebt)) { p_leichtebt=0; }
                        p_leichtebt=eval(p_leichtebt+'+0');
                        var leichtebt_alles = eval(document.formular.alles_leichtebt.value+'+0');
                        if (s_leichtebt>leichtebt_alles) { s_leichtebt=leichtebt_alles; }
                        if (p_leichtebt>leichtebt_alles) { p_leichtebt=leichtebt_alles; }
                        if (art==1) {
                            p_leichtebt = leichtebt_alles-s_leichtebt;
                        } else {
                            s_leichtebt = leichtebt_alles-p_leichtebt;
                        }
                        document.formular.s_leichtebt.value=eval(s_leichtebt+'+0');
                        document.formular.p_leichtebt.value=eval(p_leichtebt+'+0');
                    }
                    function check_schwerebt(art) {
                        var s_schwerebt = document.formular.s_schwerebt.value;
                        if (isNaN(s_schwerebt)) { s_schwerebt=0; }
                        s_schwerebt=eval(s_schwerebt+'+0');
                        var p_schwerebt = document.formular.p_schwerebt.value;
                        if (isNaN(p_schwerebt)) { p_schwerebt=0; }
                        p_schwerebt=eval(p_schwerebt+'+0');
                        var schwerebt_alles = eval(document.formular.alles_schwerebt.value+'+0');
                        if (s_schwerebt>schwerebt_alles) { s_schwerebt=schwerebt_alles; }
                        if (p_schwerebt>schwerebt_alles) { p_schwerebt=schwerebt_alles; }
                        if (art==1) {
                            p_schwerebt = schwerebt_alles-s_schwerebt;
                        } else {
                            s_schwerebt = schwerebt_alles-p_schwerebt;
                        }
                        document.formular.s_schwerebt.value=eval(s_schwerebt+'+0');
                        document.formular.p_schwerebt.value=eval(p_schwerebt+'+0');
                    }
                    <?php
                }
                ?>
                function check_cantox(art) {
                    var cantox_fracht = document.formular.fracht_cantox.value;
                    if (isNaN(cantox_fracht)) { cantox_fracht=0; }
                    cantox_fracht=eval(cantox_fracht+'+0');
                    var cantox_planet = document.formular.planet_cantox.value;
                    if (isNaN(cantox_planet)) { cantox_planet=0; }
                    cantox_planet=eval(cantox_planet+'+0');
                    var cantox_alles = eval(document.formular.alles_cantox.value+'+0');
                    if (cantox_fracht>cantox_alles) { cantox_fracht=cantox_alles; }
                    if (cantox_planet>cantox_alles) { cantox_planet=cantox_alles; }
                    if (art==1) {
                        cantox_planet = cantox_alles-cantox_fracht;
                    } else {
                        cantox_fracht = cantox_alles-cantox_planet;
                    }
                    document.formular.fracht_cantox.value=eval(cantox_fracht+'+0');
                    document.formular.planet_cantox.value=eval(cantox_planet+'+0');
                }
                function check_vorrat(art) {
                    var vorrat_fracht = document.formular.fracht_vorrat.value;
                    if (isNaN(vorrat_fracht)) {
                        vorrat_fracht=0;
                    }
                    vorrat_fracht=eval(vorrat_fracht+'+0');
                    var vorrat_planet = document.formular.planet_vorrat.value;
                    if (isNaN(vorrat_planet)) { vorrat_planet=0; }
                    vorrat_planet=eval(vorrat_planet+'+0');
                    var vorrat_alles = eval(document.formular.alles_vorrat.value+'+0');
                    if (vorrat_fracht>vorrat_alles) { vorrat_fracht=vorrat_alles; }
                    if (vorrat_planet>vorrat_alles) { vorrat_planet=vorrat_alles; }
                    if (art==1) {
                        vorrat_planet = vorrat_alles-vorrat_fracht;
                    } else {
                        vorrat_fracht = vorrat_alles-vorrat_planet;
                    }
                    document.formular.fracht_vorrat.value=eval(vorrat_fracht+'+0');
                    document.formular.planet_vorrat.value=eval(vorrat_planet+'+0');
                }
                function check_lemin(art) {
                    var lemin_fracht = document.formular.fracht_lemin.value;
                    if (isNaN(lemin_fracht)) { lemin_fracht=0; }
                    lemin_fracht=eval(lemin_fracht+'+0');
                    var lemin_planet = document.formular.planet_lemin.value;
                    if (isNaN(lemin_planet)) { lemin_planet=0; }
                    lemin_planet=eval(lemin_planet+'+0');
                    var lemin_alles = eval(document.formular.alles_lemin.value+'+0');
                    if (lemin_fracht>lemin_alles) { lemin_fracht=lemin_alles; }
                    if (lemin_planet>lemin_alles) { lemin_planet=lemin_alles; }
                    if (art==1) {
                        lemin_planet = lemin_alles-lemin_fracht;
                    } else {
                        lemin_fracht = lemin_alles-lemin_planet;
                    }
                    document.formular.fracht_lemin.value=eval(lemin_fracht+'+0');
                    document.formular.planet_lemin.value=eval(lemin_planet+'+0');
                }
                function check_min1(art) {
                    var min1_fracht = document.formular.fracht_min1.value;
                    if (isNaN(min1_fracht)) { min1_fracht=0; }
                    min1_fracht=eval(min1_fracht+'+0');
                    var min1_planet = document.formular.planet_min1.value;
                    if (isNaN(min1_planet)) { min1_planet=0; }
                    min1_planet=eval(min1_planet+'+0');
                    var min1_alles = eval(document.formular.alles_min1.value+'+0');
                    if (min1_fracht>min1_alles) { min1_fracht=min1_alles; }
                    if (min1_planet>min1_alles) { min1_planet=min1_alles; }
                    if (art==1) {
                        min1_planet = min1_alles-min1_fracht;
                    } else {
                        min1_fracht = min1_alles-min1_planet;
                    }
                    document.formular.fracht_min1.value=eval(min1_fracht+'+0');
                    document.formular.planet_min1.value=eval(min1_planet+'+0');
                }
                function check_min2(art) {
                    var min2_fracht = document.formular.fracht_min2.value;
                    if (isNaN(min2_fracht)) { min2_fracht=0; }
                    min2_fracht=eval(min2_fracht+'+0');
                    var min2_planet = document.formular.planet_min2.value;
                    if (isNaN(min2_planet)) { min2_planet=0; }
                    min2_planet=eval(min2_planet+'+0');
                    var min2_alles = eval(document.formular.alles_min2.value+'+0');
                    if (min2_fracht>min2_alles) { min2_fracht=min2_alles; }
                    if (min2_planet>min2_alles) { min2_planet=min2_alles; }
                    if (art==1) {
                        min2_planet = min2_alles-min2_fracht;
                    } else {
                        min2_fracht = min2_alles-min2_planet;
                    }
                    document.formular.fracht_min2.value=eval(min2_fracht+'+0');
                    document.formular.planet_min2.value=eval(min2_planet+'+0');
                }
                function check_min3(art) {
                    var min3_fracht = document.formular.fracht_min3.value;
                    if (isNaN(min3_fracht)) { min3_fracht=0; }
                    min3_fracht=eval(min3_fracht+'+0');
                    var min3_planet = document.formular.planet_min3.value;
                    if (isNaN(min3_planet)) { min3_planet=0; }
                    min3_planet=eval(min3_planet+'+0');
                    var min3_alles = eval(document.formular.alles_min3.value+'+0');
                    if (min3_fracht>min3_alles) { min3_fracht=min3_alles; }
                    if (min3_planet>min3_alles) { min3_planet=min3_alles; }
                    if (art==1) {
                        min3_planet = min3_alles-min3_fracht;
                    } else {
                        min3_fracht = min3_alles-min3_planet;
                    }
                    document.formular.fracht_min3.value=eval(min3_fracht+'+0');
                    document.formular.planet_min3.value=eval(min3_planet+'+0');
                }
            </script>
            <?php 
            if ($infanterie==1) {
                ?>
                <input type="hidden" name="schiff_leute" value=0>
                <input type="hidden" name="planet_leute" value='<?php echo $planet_kolonisten; ?>'>
                <input type="hidden" name="s_schwerebt" value=0>
                <input type="hidden" name="p_schwerebt" value='<?php echo $p_schwerebt; ?>'>
                <input type="hidden" name="schiff_cantox" value=0>
                <input type="hidden" name="planet_cantox" value='<?php echo $planet_cantox; ?>'>
                <input type="hidden" name="schiff_min1" value=0>
                <input type="hidden" name="planet_min1" value='<?php echo $planet_min1; ?>'>
                <input type="hidden" name="schiff_min2" value=0>
                <input type="hidden" name="planet_min2" value='<?php echo $planet_min2; ?>'>
                <input type="hidden" name="schiff_min3" value=0>
                <input type="hidden" name="planet_min3" value='<?php echo $planet_min3; ?>'>
                <input type="hidden" name="fracht_leute" value=0>
                <input type="hidden" name="fracht_min1" value=0>
                <input type="hidden" name="fracht_min2" value=0>
                <input type="hidden" name="fracht_min3" value=0>
                <input type="hidden" name="fracht_cantox" value=0>
                <input type="hidden" name="planet_kolonisten" value="<?php echo $planet_kolonisten; ?>">
                <input type="hidden" name="alles_leute" value="<?php echo $planet_kolonisten; ?>">
                <input type="hidden" name="alles_schwerebt" value="<?php echo $p_schwerebt; ?>">
                <input type="hidden" name="alles_min1" value="<?php echo $planet_min1; ?>">
                <input type="hidden" name="alles_min2" value="<?php echo $planet_min2; ?>">
                <input type="hidden" name="alles_min3" value="<?php echo $planet_min3; ?>">
                <input type="hidden" name="alles_cantox" value="<?php echo $planet_cantox; ?>">
                <?php
            }
            if ((($besitzer!=$spieler) and ($beziehung[$besitzer][$spieler]['status']==5))or(($kolonisten_spieler_t!=0)and ($kolonisten_spieler_t!=$spieler))) {
                ?>
                <input type="hidden" name="fracht_leute" value="<?php echo $fracht_leute; ?>">
                <input type="hidden" name="planet_kolonisten" value="<?php echo $planet_kolonisten; ?>">
                <input type="hidden" name="alles_leute" value="<?php echo $fracht_leute+$planet_kolonisten; ?>">
                <input type="hidden" name="s_leichtebt" value="<?php echo $s_leichtebt; ?>">
                <input type="hidden" name="p_leichtebt" value="<?php echo $p_leichtebt; ?>">
                <input type="hidden" name="alles_leichtebt" value="<?php echo $s_leichtebt+$p_leichtebt; ?>">
                <input type="hidden" name="s_schwerebt" value="<?php echo $s_schwerebt; ?>">
                <input type="hidden" name="p_schwerebt" value="<?php echo $p_schwerebt; ?>">
                <input type="hidden" name="alles_schwerebt" value="<?php echo $s_schwerebt+$p_schwerebt; ?>">
                <?php
            } else {
                if ($infanterie!=1) { ?>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="77" height="1"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="230" height="1"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="60" height="1"></td>
                        </tr>
                        <tr>
                            <td><center><img src="<?php echo $bildpfad; ?>/icons/crew.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['kolonisten']; ?>"></center></td>
                            <td>
                                <center>
                                    <input onKeyup="check_kolonisten(1);" type="text" class="eingabe" name="fracht_leute" value="<?php echo $fracht_leute; ?>" style="width=70" maxlength="12">
                                    <input type="hidden" name="alles_leute" value="<?php echo $fracht_leute+$planet_kolonisten; ?>">
                                    <input onKeyup="check_kolonisten(2);" type="text" class="eingabe" name="planet_kolonisten" value="<?php echo $planet_kolonisten; ?>" style="width=70" maxlength="12">
                                </center>
                            </td>
                            <td><center><img src="<?php echo $bildpfad; ?>/icons/crew.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['kolonisten']; ?>"></center></td>
                        </tr>
                    </table>
                    <?php
                }
                ?>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="77" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="230" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="60" height="1"></td>
                    </tr>
                    <tr>
                        <td><center><img src="<?php echo $bildpfad; ?>/icons/leichtebt.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['leichtebt']; ?>"></center></td>
                        <td>
                            <center>
                                <input onKeyup="check_leichtebt(1);" type="text" class="eingabe" name="s_leichtebt" value="<?php echo $s_leichtebt; ?>" style="width=70" maxlength="12">
                                <input type="hidden" name="alles_leichtebt" value="<?php echo $s_leichtebt+$p_leichtebt; ?>">
                                <input onKeyup="check_leichtebt(2);" type="text" class="eingabe" name="p_leichtebt" value="<?php echo $p_leichtebt; ?>" style="width=70" maxlength="12">
                            </center>
                        </td>
                        <td><center><img src="<?php echo $bildpfad; ?>/icons/leichtebt.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['leichtebt']; ?>"></center></td>
                    </tr>
                </table>
                <?php
                if ($infanterie!=1) {
                    ?>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="77" height="1"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="230" height="1"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="60" height="1"></td>
                        </tr>
                        <tr>
                            <td><center><img src="<?php echo $bildpfad; ?>/icons/schwerebt.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['schwerebt']; ?>"></center></td>
                            <td>
                                <center>
                                    <input onKeyup="check_schwerebt(1);" type="text" class="eingabe" name="s_schwerebt" value="<?php echo $s_schwerebt; ?>" style="width=70" maxlength="12">
                                    <input type="hidden" name="alles_schwerebt" value="<?php echo $s_schwerebt+$p_schwerebt; ?>">
                                    <input onKeyup="check_schwerebt(2);" type="text" class="eingabe" name="p_schwerebt" value="<?php echo $p_schwerebt; ?>" style="width=70" maxlength="12">
                                </center>
                            </td>
                            <td><center><img src="<?php echo $bildpfad; ?>/icons/schwerebt.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['schwerebt']; ?>"></center></td>
                        </tr>
                    </table>
                    <?php
                }
            }
            if ($infanterie!=1) {
                ?>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="77" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="230" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="60" height="1"></td>
                    </tr>
                    <tr>
                        <td><center><img src="<?php echo $bildpfad; ?>/icons/cantox.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['cantox']; ?>"></center></td>
                        <td>
                            <center>
                                <input onKeyup="check_cantox(1);" type="text" class="eingabe" name="fracht_cantox" value="<?php echo $fracht_cantox; ?>" style="width=70" maxlength="12">
                                <input type="hidden" name="alles_cantox" value="<?php echo $fracht_cantox+$planet_cantox; ?>">
                                <input onKeyup="check_cantox(2);" type="text" class="eingabe" name="planet_cantox" value="<?php echo $planet_cantox; ?>" style="width=70" maxlength="12">
                            </center>
                        </td>
                        <td><center><img src="<?php echo $bildpfad; ?>/icons/cantox.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['cantox']; ?>"></center></td>
                    </tr>
                </table>
                <?php
            }
            ?>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="77" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="230" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="60" height="1"></td>
                </tr>
                <tr>
                    <td><center><img src="<?php echo $bildpfad; ?>/icons/vorrat.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['vorraete']; ?>"></center></td>
                    <td>
                        <center>
                            <input onKeyup="check_vorrat(1);" type="text" class="eingabe" name="fracht_vorrat" value="<?php echo $fracht_vorrat; ?>" style="width=70" maxlength="12">
                            <input type="hidden" name="alles_vorrat" value="<?php echo $fracht_vorrat+$planet_vorrat; ?>">
                            <input onKeyup="check_vorrat(2);" type="text" class="eingabe" name="planet_vorrat" value="<?php echo $planet_vorrat; ?>" style="width=70" maxlength="12">
                        </center>
                    </td>
                    <td><center><img src="<?php echo $bildpfad; ?>/icons/vorrat.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['vorraete']; ?>"></center></td>
                </tr>
            </table>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="77" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="230" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="60" height="1"></td>
                </tr>
                <tr>
                    <td><center><img src="<?php echo $bildpfad; ?>/icons/lemin.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['lemin']; ?>"></center></td>
                    <td>
                        <center>
                            <input onKeyup="check_lemin(1);" type="text" class="eingabe" name="fracht_lemin" value="<?php echo $fracht_lemin; ?>" style="width=70" maxlength="12">
                            <input type="hidden" name="alles_lemin" value="<?php echo $fracht_lemin+$planet_lemin; ?>">
                            <input onKeyup="check_lemin(2);" type="text" class="eingabe" name="planet_lemin" value="<?php echo $planet_lemin; ?>" style="width=70" maxlength="12">
                        </center>
                    </td>
                    <td><center><img src="<?php echo $bildpfad; ?>/icons/lemin.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['lemin']; ?>"></center></td>
                </tr>
            </table>
            <?php
            if ($infanterie!=1) {
                ?>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="77" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="230" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="60" height="1"></td>
                    </tr>
                    <tr>
                        <td><center><img src="<?php echo $bildpfad; ?>/icons/mineral_1.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['baxterium']; ?>"></center></td>
                        <td>
                            <center>
                                <input onKeyup="check_min1(1);" type="text" class="eingabe" name="fracht_min1" value="<?php echo $fracht_min1; ?>" style="width=70" maxlength="12">
                                <input type="hidden" name="alles_min1" value="<?php echo $fracht_min1+$planet_min1; ?>">
                                <input onKeyup="check_min1(2);" type="text" class="eingabe" name="planet_min1" value="<?php echo $planet_min1; ?>" style="width=70" maxlength="12">
                            </center>
                        </td>
                        <td><center><img src="<?php echo $bildpfad; ?>/icons/mineral_1.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['baxterium']; ?>"></center></td>
                    </tr>
                </table>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="77" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="230" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="60" height="1"></td>
                    </tr>
                    <tr>
                        <td><center><img src="<?php echo $bildpfad; ?>/icons/mineral_2.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['rennurbin']; ?>"></center></td>
                        <td>
                            <center>
                                <input onKeyup="check_min2(1);" type="text" class="eingabe" name="fracht_min2" value="<?php echo $fracht_min2; ?>" style="width=70" maxlength="12">
                                <input type="hidden" name="alles_min2" value="<?php echo $fracht_min2+$planet_min2; ?>">
                                <input onKeyup="check_min2(2);" type="text" class="eingabe" name="planet_min2" value="<?php echo $planet_min2; ?>" style="width=70" maxlength="12">
                            </center>
                        </td>
                        <td><center><img src="<?php echo $bildpfad; ?>/icons/mineral_2.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['rennurbin']; ?>"></center></td>
                    </tr>
                </table>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="77" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="230" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="60" height="1"></td>
                    </tr>
                    <tr>
                        <td><center><img src="<?php echo $bildpfad; ?>/icons/mineral_3.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['vomisaan']; ?>"></center></td>
                        <td>
                            <center>
                                <input onKeyup="check_min3(1);" type="text" class="eingabe" name="fracht_min3" value="<?php echo $fracht_min3; ?>" style="width=70" maxlength="12">
                                <input type="hidden" name="alles_min3" value="<?php echo $fracht_min3+$planet_min3; ?>">
                                <input onKeyup="check_min3(2);" type="text" class="eingabe" name="planet_min3" value="<?php echo $planet_min3; ?>" style="width=70" maxlength="12">
                            </center>
                        </td>
                        <td><center><img src="<?php echo $bildpfad; ?>/icons/mineral_3.gif" border="0" width="17" height="17" title="<?php echo $lang['flottebeta']['vomisaan']; ?>"></center></td>
                    </tr>
                </table>
                <?php
            }
            ?>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="367" height="5"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" style="width:367px;" value="<?php echo $lang['flottebeta']['durchfuehren']; ?>"></td>
                </tr>
                <tr>
                    <td></form><img src="../bilder/empty.gif" border="0" width="367" height="5"></td>
                </tr>
            </table>
            <?php
        } else { ?>
            <body text="#000000" scroll="auto" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
                <br><br><br>
                <center><?php echo $lang['flottebeta']['keineobjekte']; ?></center>
                <?php
        }
    include ("inc.footer.php");
}

if ($fuid==8) {
    include ("inc.header.php");

    $zeiger = @mysql_query("SELECT id,logbuch FROM $skrupel_schiffe where id=$shid");
    $array = @mysql_fetch_array($zeiger);
    $logbuch=$array["logbuch"];
    //$logbuch=str_replace("\\", "",$logbuch);

    ?>
    <body text="#000000" background="<?php echo $bildpfad; ?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" cellspacing="0" cellpadding="1">
                <tr>
                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="2"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                    <td><center><?php echo $lang['flottebeta']['logbuch']; ?></center></td>
                    <td><a href="javascript:hilfe(17);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                </tr>
            </table>
        </center>
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><form name="formular"  method="post" action="flotte_beta.php?fu=9&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                    <td><textarea style="width:390px;height:59px;" name="logbuchdaten"><?php echo $logbuch; ?></textarea></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="<?php echo $lang['flottebeta']['eintragsichern']; ?>" style="width:390px;" name="submitbutton"></td>
                    <td></form></td>
                </tr>
            </table>
        </center>
        <?php
    include ("inc.footer.php");
}

if ($fuid==9) {
    include ("inc.header.php");

    $eintrag=str_post('logbuchdaten','SQLSAFE');
    //$eintrag=str_replace("\"", "\'",$eintrag);
    //$eintrag=str_replace("\\", "",$eintrag);
    $zeiger = @mysql_query("UPDATE $skrupel_schiffe set logbuch=\"$eintrag\" where id=$shid");

    ?>
    <body text="#000000" background="<?php echo $bildpfad; ?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <br><br><br><br>
        <center><?php echo $lang['flottebeta']['logbuchaktualisiert']; ?></center>
        <?php
    include ("inc.footer.php");
}

if ($fuid==10) {
    include ("inc.header.php");

    $zeiger = @mysql_query("SELECT * FROM $skrupel_planeten where id=".int_get('pid'));
    $array = @mysql_fetch_array($zeiger);
    $pid=$array["id"];
    $name=$array["name"];
    $x_pos=$array["x_pos"];
    $y_pos=$array["y_pos"];
    $bild=$array["bild"];
    $klasse=$array["klasse"];
    $temp=$array["temp"];
    $kolonisten=$array["kolonisten"];
    $minen=$array["minen"];
    $fabriken=$array["fabriken"];
    $abwehr=$array["abwehr"];
    $planet_lemin=$array["planet_lemin"];
    $planet_min1=$array["planet_min1"];
    $planet_min2=$array["planet_min2"];
    $planet_min3=$array["planet_min3"];
    $konz_lemin=$array["konz_lemin"];
    $konz_min1=$array["konz_min1"];
    $konz_min2=$array["konz_min2"];
    $konz_min3=$array["konz_min3"];    
    $osys_1=$array["osys_1"];
    $osys_2=$array["osys_2"];
    $osys_3=$array["osys_3"];
    $osys_4=$array["osys_4"];
    $osys_5=$array["osys_5"];
    $osys_6=$array["osys_6"];

    if ((($osys_1==5) or ($osys_2==5) or ($osys_3==5) or ($osys_4==5) or ($osys_5==5) or ($osys_6==5)) and ($besitzer!=$spieler)) {
        $planet_lemin='0';
        $planet_min1='0';
        $planet_min2='0';
        $planet_min3='0';
    }


    $minfarben[0]='00F14A';
    $minfarben[1]='FFDECA';
    $minfarben[2]='E90505';
    $minfarben[3]='0085EF';
    
    function mineral($min,$anzahl,$kon) {
        
        global $minfarben;
        
        $punkteanzahl=round($anzahl/30*2.5);
        
        for  ($i=0; $i<$punkteanzahl;$i=$i+($kon*2)) {
            
            $x=0;$y=0;
            
            while (round(sqrt((48-$x)*(48-$x)+(48-$y)*(48-$y)))>(40-$kon)) {
            
                $x=rand(6,90);
                $y=rand(6,90);
            }
            
            if ($kon==1) {
            
                ?>
                <div id="p_<?php echo $i; ?>" style="position: absolute; left:<?php echo $x; ?>px; top:<?php echo $y; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $minfarben[$min]; ?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                <?php
            
            }elseif ($kon>1) {
            
                $punkte=$kon*2;
                $xpos=$x;
                $ypos=$y;
            
                for  ($p=0; $p<$punkte;$p++) {
                    
                    ?>
                    <div id="p_<?php echo $p?>_<?php echo $i; ?>" style="position: absolute; left:<?php echo $xpos; ?>px; top:<?php echo $ypos; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $minfarben[$min]; ?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
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
    include ("inc.footer.php");
}
