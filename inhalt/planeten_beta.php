<?php 
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'planeten_beta';
$fuid = int_get('fu');
$pid = int_get('pid');

if ($fuid==1) {
include ("inc.header.php");
    $zeiger = @mysql_query("SELECT besitzer,id,native_id,native_name,native_art_name,native_abgabe,native_bild,native_text,native_kol FROM $skrupel_planeten where besitzer=$spieler and id=".$pid);
    $array = @mysql_fetch_array($zeiger);
    $native_id=$array["native_id"];
    $native_name=$array["native_name"];
    $native_art_name=$array["native_art_name"];
    $native_abgabe=$array["native_abgabe"];
    $native_bild=$array["native_bild"];
    $native_text=$array["native_text"];
    $native_kol=$array["native_kol"];
    ?>
    <body text="#000000" background="<?php echo $bildpfad?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php
        if (($native_id>=1) and ($native_kol>=1)) {
            ?>
            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                <tr>
                    <td width="100%">
                        <center>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td>
                                        <center>
                                            <table border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td><?php echo $native_name?></td>
                                                    <td style="color:#aaaaaa;">&nbsp;<i>(<?php echo $native_art_name?>)</i></td>
                                                </tr>
                                            </table>
                                        </center>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="1" height="6"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <center>
                                            <table border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td rowspan="2"><img src="<?php echo $bildpfad?>/icons/native_2.gif" border="0" width="17" height="17"></td>
                                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                                    <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['planetenbeta']['population']?></td>
                                                    <td><img src="../bilder/empty.gif" border="0" width="6" height="6"></td>
                                                    <td rowspan="2"><img src="<?php echo $bildpfad?>/icons/cantox.gif" border="0" width="17" height="17"></td>
                                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                                    <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['planetenbeta']['abgaben']?></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                                    <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                                    <td><nobr><?php echo $native_kol; ?></nobr></td>
                                                    <td><img src="../bilder/empty.gif" border="0" width="6" height="6"></td>
                                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                                    <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                                    <td><nobr><?php echo $native_abgabe*100; ?> %</nobr></td>
                                                </tr>
                                            </table>
                                        </center>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="1" height="6"></td>
                                </tr>
                                <tr>
                                    <td><center><?php echo $native_text?></center></td>
                                </tr>
                            </table>
                        </center>
                    </td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td><img src="../daten/bilder_spezien/<?php echo $native_bild?>" border="0" width="97" height="97"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <?php 
        } else {
            ?>
            <br><br><br>
            <center><?php echo $lang['planetenbeta']['alleine']?></center>
            <?php
        }
    include ("inc.footer.php");
}
if ($fuid==2) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT id,logbuch FROM $skrupel_planeten where id=".$pid);
    $array = @mysql_fetch_array($zeiger);
    $logbuch=$array["logbuch"];
    //$logbuch=str_replace("\\", "",$logbuch);
    ?>
    <body text="#000000" background="<?php echo $bildpfad?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" cellspacing="0" cellpadding="1">
                <tr>
                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="2"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                    <td><center><?php echo $lang['planetenbeta']['logbuch']?></center></td>
                    <td><a href="javascript:hilfe(31);"><img src="<?php echo $bildpfad?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                </tr>
            </table>
        </center>
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><form name="formular" method="post" action="planeten_beta.php?fu=3&pid=<?php echo $pid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"></td>
                    <td><textarea style="width:390px;height:59px;" name="logbuchdaten"><?php echo $logbuch?></textarea></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="<?php echo $lang['planetenbeta']['sichern']?>" style="width:390px;" name="submitbutton"></td>
                    <td></form></td>
                </tr>
            </table>
        </center>
        <?php 
    include ("inc.footer.php");
}
if ($fuid==3) {
    include ("inc.header.php");
    $eintrag=str_post('logbuchdaten','SQLSAFE');
    //$eintrag=str_replace("\"", "\'",$eintrag);
    //$eintrag=str_replace("\\", "",$eintrag);
    $zeiger = @mysql_query("UPDATE $skrupel_planeten set logbuch=\"$eintrag\" where id=".$pid);
    ?>
    <body text="#000000" background="<?php echo $bildpfad?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <br><br><br><br>
        <center><?php echo $lang['planetenbeta']['erfolgreichaktualisiert']?></center>
        <?php
    include ("inc.footer.php");
}
if ($fuid==4) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT id,x_pos,y_pos FROM $skrupel_planeten where id=".$pid);
    $array = @mysql_fetch_array($zeiger);
    $xpos=$array["x_pos"];
    $ypos=$array["y_pos"];
    $s_zahl=0;
    $zeiger = @mysql_query("SELECT * FROM $skrupel_schiffe where kox=$xpos and koy=$ypos and besitzer=$spieler and spiel=$spiel order by name");
    $schiffanzahl = @mysql_num_rows($zeiger);
    if ($schiffanzahl>=1) {
        $raumschiffe=$schiffanzahl;
        for ($i=0; $i<$schiffanzahl;$i++) {
            $ok = @mysql_data_seek($zeiger,$i);
            $array = @mysql_fetch_array($zeiger);
            $shid=$array["id"];
            $bild_klein=$array["bild_klein"];
            $volk=$array["volk"];
            $x_pos=$array["kox"];
            $y_pos=$array["koy"];
            $antrieb=$array["antrieb"];
            $klasse=$array["klasse"];
            $name=$array["name"];
            $flug=$array["flug"];
            $routing_status=$array["routing_status"];
            $ziely=$array["ziely"];
            $zielx=$array["zielx"];
            $zielid=$array["zielid"];
            $ordner=$array["ordner"];
            $fracht_leute=$array["fracht_leute"];
            $fracht_cantox=$array["fracht_cantox"];
            $fracht_vorrat=$array["fracht_vorrat"];
            $fracht_min1=$array["fracht_min1"];
            $fracht_min2=$array["fracht_min2"];
            $fracht_min3=$array["fracht_min3"];
            $routing_koord=$array["routing_koord"];
            $route_tip='';
            if ($routing_status>=1) {
                $routing_points_temp=explode("::",$routing_koord);
                $schritte=count($routing_points_temp);
                for ($n=0;$n<$schritte-1;$n++) {
                    $routing_points=explode(":",$routing_points_temp[$n]);
                    $zielx=$routing_points[0];
                    $ziely=$routing_points[1];
                    $zeiger_temp = @mysql_query("SELECT name FROM $skrupel_planeten where x_pos=$zielx and y_pos=$ziely and spiel=$spiel");
                    $array_temp = @mysql_fetch_array($zeiger_temp);
                    $name=$array_temp["name"];
                    $route_tip=$route_tip.'-> '.$name.' ';
                }
            }
            $tip='';
            $tip=$tip.$lang['planetenbeta']['kol'].": ".$fracht_leute." ".$lang['planetenbeta']['cx'].": ".$fracht_cantox." ".$lang['planetenbeta']['vor'].": ".$fracht_vorrat;
            $tip=$tip."\n".$lang['planetenbeta']['bax'].": ".$fracht_min1." ".$lang['planetenbeta']['ren'].": ".$fracht_min2." ".$lang['planetenbeta']['vom'].": ".$fracht_min3;
            if ($flug==0) {
                if (($routing_status==2) or ($routing_status==1)) {
                    $schiff_scan[$s_zahl][1]='<td style="color:#009900;"><nobr>'.$lang['planetenbeta']['route'];
                    $schiff_scan[$s_zahl][1]=$schiff_scan[$s_zahl][1].' <a href="#" title="'.$route_tip.'">'.$lang['planetenbeta']['r'].'</a>';
                    $schiff_scan[$s_zahl][1]=$schiff_scan[$s_zahl][1].'</nobr></td>';
                } else {
                    $schiff_scan[$s_zahl][1]='<td style="color:#990000;"><nobr><center>'.$lang['planetenbeta']['keinauftrag'].'</center></nobr></td>';
                }
            }elseif ($flug==1) {
                $schiff_scan[$s_zahl][1]='<td style="color:#009900;"><nobr>'.$lang['planetenbeta']['unterwegsnach'].$zielx.'/'.$ziely.'</nobr></td>';
            }elseif ($flug==2) {
                $zeiger_temp = @mysql_query("SELECT id,name FROM $skrupel_planeten where id=$zielid");
                $array_temp = @mysql_fetch_array($zeiger_temp);
                $planeten_name=$array_temp["name"];
                $schiff_scan[$s_zahl][1]='<td style="color:#009900;"><nobr>'.$lang['planetenbeta']['unterwegsnach'].' '.$planeten_name;
                if (($routing_status==2) or ($routing_status==1)) {
                    $schiff_scan[$s_zahl][1]=$schiff_scan[$s_zahl][1].' <a href="#" title="'.$route_tip.'">'.$lang['planetenbeta']['r'].'</a>';
                }
                $schiff_scan[$s_zahl][1]=$schiff_scan[$s_zahl][1].'</nobr></td>';
            }elseif ($flug==3) {
                $schiff_scan[$s_zahl][1]='<td style="color:#009900;"><nobr>'.$lang['planetenbeta']['versuchterfeindkontakt'].'</nobr></td>';
            }elseif ($flug==4) {
                $schiff_scan[$s_zahl][1]='<td style="color:#009900;">'.$lang['planetenbeta']['begleitschutz'].'</td>';
            }
            $schiff_scan[$s_zahl][0]=$shid;
            $schiff_scan[$s_zahl][3]=$volk;
            $schiff_scan[$s_zahl][4]=$bild_klein;
            $schiff_scan[$s_zahl][5]=$antrieb;
            $schiff_scan[$s_zahl][6]=$klasse;
            $schiff_scan[$s_zahl][7]=$name;
            $schiff_scan[$s_zahl][8]=$tip;
            $schiff_scan[$s_zahl][9]=$ordner;
            $s_zahl++;
        }
    }
    ?>
    <script language=JavaScript>
        function link_schiff(shid_t,oid_t) {
            if (parent.parent.mittelinksoben.document.globals.map.value==0) {
                parent.parent.mittelinksoben.document.globals.map.value=1;
                parent.parent.mittemitte.window.location='galaxie.php?fu=2&uid=<?php echo $uid?>&sid=<?php echo $sid?>';
      }
//            else {
//                parent.parent.mittemitte.aktuell.style.visibility='hidden';
//            }
            parent.parent.untenmitte.window.location='flotte.php?fu=2&shid='+shid_t+'&oid='+oid_t+'&uid=<?php echo $uid;?>&sid=<?php echo $sid;?>';
        }
    </script>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
        <?php
        if ($s_zahl>=1) {
            ?>
            <center>
                <table border="0" cellspacing="0" cellpadding="1">
                    <tr>
                        <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                        <td><center><?php echo $lang['planetenbeta']['eigeneraumschiffe']?></center></td>
                        <td><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                    </tr>
                </table>
            </center>
            <br>
            <center>
                <table border='0' cellspacing='0' cellpadding='0'>
                    <?php 
                    for ($i=0; $i<$s_zahl;$i++) {
                        ?>
                        <tr>
                            <td>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                        <td><a href="javascript:;" ><img src="../daten/<?php echo $schiff_scan[$i][3]?>/bilder_schiffe/<?php echo $schiff_scan[$i][4]?>" onclick="link_schiff(<?php echo $schiff_scan[$i][0]?>,<?php echo $schiff_scan[$i][9]?>);body.focus();" border="0" height="50" width="75" title="<?php echo $schiff_scan[$i][8]?>"></a></td>
                                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                    </tr>
                                </table>
                            </td>
                            <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                            <td>
                                <table border="0" cellspacing="0" cellpadding="1">
                                    <tr>
                                        <td colspan="3"><a href="javascript:;" onclick="link_schiff(<?php echo $schiff_scan[$i][0]?>,<?php echo $schiff_scan[$i][9]?>);body.focus();" style="color:#ffffff;"><?php echo $schiff_scan[$i][7]; ?></a></td>
                                    </tr>
                                    <tr>
                                        <td style="color:#aaaaaa;"><?php echo $lang['planetenbeta']['klasse']?></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td><?php echo $schiff_scan[$i][6]; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="color:#aaaaaa;"><?php echo $lang['planetenbeta']['mission']?></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td><?php echo $schiff_scan[$i][1]; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="color:#aaaaaa;"><?php echo $lang['planetenbeta']['maxwarp']?></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                        <td><?php echo $schiff_scan[$i][5]; ?></td>
                                    </tr>
                                </table>
                            </td>
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
        } else {
            ?>
            <br><br><br>
            <center><?php echo $lang['planetenbeta']['keineschiffe']?></center>
            <?php
        }
        echo '</div>';
    include ("inc.footer.php");
}
