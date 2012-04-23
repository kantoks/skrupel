<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'planeten_alpha';
$langfile_2 = 'orbitale_systeme';
$fuid = int_get('fu');
$pid = int_get('pid');

if ($fuid==1) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_planeten where besitzer=$spieler and id=".$pid);
    $array = @mysql_fetch_array($zeiger);
    $pid=$array["id"];
    $name=$array["name"];
    $x_pos=$array["x_pos"];
    $y_pos=$array["y_pos"];
    $bild=$array["bild"];
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
    ?>
    <body text="#000000" background="<?php echo $bildpfad?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <center>
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td style="color:#aaaaaa;"><?php echo $lang['planetenalpha']['klasse']?>&nbsp;</td>
                                                <td><?php echo $klassename?></td>
                                                <td style="color:#aaaaaa;">&nbsp;<?php echo $lang['planetenalpha']['planet']?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="3"></td>
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
                                            <td><img src="../bilder/empty.gif" border="0" width="<?php echo ($temp*1.4)-1; ?>" height="25"></td>
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
                                                <td style="color:#aaaaaa;"><center><?php echo $lang['planetenalpha']['durchtemperatur']?><br></center></td>
                                            </tr>
                                            <tr>
                                                <td><center><?php echo $temp-35; ?> <?php echo $lang['planetenalpha']['grad']?></center></td>
                                            </tr>
                                        </table>
                                    </center>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td><td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td><img src="<?php echo $bildpfad?>/planeten/<?php echo $klasse?>_<?php echo $bild?>.jpg" border="0" width="113" height="97"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </center>
        <?php
    include ("inc.footer.php");
}
if ($fuid==2) {
    include ("inc.header.php");
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" scroll="auto" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php
        $zeiger = @mysql_query("SELECT * FROM $skrupel_planeten where besitzer=$spieler and id=".$pid);
        $array = @mysql_fetch_array($zeiger);
        $pid=$array["id"];
        $cantox=$array["cantox"];
        $vorrat=$array["vorrat"];
        $min1=$array["min1"];
        $min2=$array["min2"];
        $min3=$array["min3"];
        $lemin=$array["lemin"];
        $sternenbasis=$array["sternenbasis"];
        $sternenbasis_name=$array["sternenbasis_name"];
        $sternenbasis_id=$array["sternenbasis_id"];
        $sternenbasis_rasse=$array["sternenbasis_rasse"];
        $sternenbasis_art=$array["sternenbasis_art"];
        $kosten_werft=array(328,20,21,78,210,107);
        $kosten_station=array(522,51,83,99,250,210);
        $kosten_sbasis=array(855,35,70,123,418,370);
        $kosten_kbasis=array(3250,270,327,520,830,920);
        if ($sternenbasis==0) {
            ?>
            <table border="0" cellspacing="0" cellpadding="1">
                <tr>
                    <td colspan="11"><img src="../bilder/empty.gif" border="0" width="1" height="7"></td>
                </tr>
                <tr>
                    <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                    <td></td>
                    <td><center><img src="<?php echo $bildpfad?>/icons/cantox.gif" border="0" width="17" height="17"></center></td>
                    <td><center><img src="<?php echo $bildpfad?>/icons/vorrat.gif" border="0" width="17" height="17"></center></td>
                    <td><center><img src="<?php echo $bildpfad?>/icons/lemin.gif" border="0" width="17" height="17"></center></td>
                    <td><center><img src="<?php echo $bildpfad?>/icons/mineral_1.gif" border="0" width="17" height="17"></center></td>
                    <td><center><img src="<?php echo $bildpfad?>/icons/mineral_2.gif" border="0" width="17" height="17"></center></td>
                    <td><center><img src="<?php echo $bildpfad?>/icons/mineral_3.gif" border="0" width="17" height="17"></center></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td></td>
                </tr>
                 <tr>
                    <?php
                    $vorhanden=1;
                    ?>
                    <td><?php echo $lang['planetenalpha']['raumwerft']?></td>
                    <td><form name="formular" method="post" action="planeten_alpha.php?fu=12&art=1&pid=<?php echo $pid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"></td>
                    <td <?php if ($cantox<$kosten_werft[0]) { echo "style='color:#990000;'";$vorhanden=0; } else { echo "style='color:#aaaaaa;'"; } ?>><center><?php echo $kosten_werft[0]?></center></td>
                    <td <?php if ($vorrat<$kosten_werft[1]) { echo "style='color:#990000;'";$vorhanden=0; } else { echo "style='color:#aaaaaa;'"; } ?>><center><?php echo $kosten_werft[1]?></center></td>
                    <td <?php if ($lemin<$kosten_werft[2]) { echo "style='color:#990000;'";$vorhanden=0; } else { echo "style='color:#aaaaaa;'"; } ?>><center><?php echo $kosten_werft[2]?></center></td>
                    <td <?php if ($min1<$kosten_werft[3]) { echo "style='color:#990000;'";$vorhanden=0; } else { echo "style='color:#aaaaaa;'"; } ?>><center><?php echo $kosten_werft[3]?></center></td>
                    <td <?php if ($min2<$kosten_werft[4]) { echo "style='color:#990000;'";$vorhanden=0; } else { echo "style='color:#aaaaaa;'"; } ?>><center><?php echo $kosten_werft[4]?></center></td>
                    <td <?php if ($min3<$kosten_werft[5]) { echo "style='color:#990000;'";$vorhanden=0; } else { echo "style='color:#aaaaaa;'"; } ?>><center><?php echo $kosten_werft[5]?></center></td>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="17"></td>
                    <td><?php if ($vorhanden==1) { ?><input type="submit" value="<?php echo $lang['planetenalpha']['auftraggeben']?>" style="width:145px;"><?php } else { ?>&nbsp;<?php } ?></td>
                    <td></form></td>
                </tr>
                <tr>
                    <?php
                    $vorhanden=1;
                    ?>
                    <td><?php echo $lang['planetenalpha']['kampfstation']?></td>
                    <td><form name="formular" method="post" action="planeten_alpha.php?fu=12&art=2&pid=<?php echo $pid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"></td>
                    <td <?php if ($cantox<$kosten_station[0]) { echo "style='color:#990000;'";$vorhanden=0; } else { echo "style='color:#aaaaaa;'"; } ?>><center><?php echo $kosten_station[0]?></center></td>
                    <td <?php if ($vorrat<$kosten_station[1]) { echo "style='color:#990000;'";$vorhanden=0; } else { echo "style='color:#aaaaaa;'"; } ?>><center><?php echo $kosten_station[1]?></center></td>
                    <td <?php if ($lemin<$kosten_station[2]) { echo "style='color:#990000;'";$vorhanden=0; } else { echo "style='color:#aaaaaa;'"; } ?>><center><?php echo $kosten_station[2]?></center></td>
                    <td <?php if ($min1<$kosten_station[3]) { echo "style='color:#990000;'";$vorhanden=0; } else { echo "style='color:#aaaaaa;'"; } ?>><center><?php echo $kosten_station[3]?></center></td>
                    <td <?php if ($min2<$kosten_station[4]) { echo "style='color:#990000;'";$vorhanden=0; } else { echo "style='color:#aaaaaa;'"; } ?>><center><?php echo $kosten_station[4]?></center></td>
                    <td <?php if ($min3<$kosten_station[5]) { echo "style='color:#990000;'";$vorhanden=0; } else { echo "style='color:#aaaaaa;'"; } ?>><center><?php echo $kosten_station[5]?></center></td>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="17"></td>
                    <td><?php if ($vorhanden==1) { ?><input type="submit" value="<?php echo $lang['planetenalpha']['auftraggeben']?>" style="width:145px;"><?php } else { ?>&nbsp;<?php } ?></td>
                    <td></form></td>
                </tr>
                <tr>
                    <?php $vorhanden=1; ?>
                    <td><?php echo $lang['planetenalpha']['sternenbasis']?></td>
                    <td><form name="formular" method="post" action="planeten_alpha.php?fu=12&art=0&pid=<?php echo $pid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"></td>
                    <td <?php if ($cantox<$kosten_sbasis[0]) { echo "style='color:#990000;'";$vorhanden=0; } else { echo "style='color:#aaaaaa;'"; } ?>><center><?php echo $kosten_sbasis[0]?></center></td>
                    <td <?php if ($vorrat<$kosten_sbasis[1]) { echo "style='color:#990000;'";$vorhanden=0; } else { echo "style='color:#aaaaaa;'"; } ?>><center><?php echo $kosten_sbasis[1]?></center></td>
                    <td <?php if ($lemin<$kosten_sbasis[2]) { echo "style='color:#990000;'";$vorhanden=0; } else { echo "style='color:#aaaaaa;'"; } ?>><center><?php echo $kosten_sbasis[2]?></center></td>
                    <td <?php if ($min1<$kosten_sbasis[3]) { echo "style='color:#990000;'";$vorhanden=0; } else { echo "style='color:#aaaaaa;'"; } ?>><center><?php echo $kosten_sbasis[3]?></center></td>
                    <td <?php if ($min2<$kosten_sbasis[4]) { echo "style='color:#990000;'";$vorhanden=0; } else { echo "style='color:#aaaaaa;'"; } ?>><center><?php echo $kosten_sbasis[4]?></center></td>
                    <td <?php if ($min3<$kosten_sbasis[5]) { echo "style='color:#990000;'";$vorhanden=0; } else { echo "style='color:#aaaaaa;'"; } ?>><center><?php echo $kosten_sbasis[5]?></center></td>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="17"></td>
                    <td><?php if ($vorhanden==1) { ?><input type="submit" value="<?php echo $lang['planetenalpha']['auftraggeben']?>" style="width:145px;"><?php } else { ?>&nbsp;<?php } ?></td>
                    <td></form></td>
                </tr>
                <tr>
                    <?php $vorhanden=1; ?>
                    <td><?php echo $lang['planetenalpha']['kriegsbasis']?></td>
                    <td><form name="formular" method="post" action="planeten_alpha.php?fu=12&art=3&pid=<?php echo $pid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"></td>
                    <td <?php if ($cantox<$kosten_kbasis[0]) { echo "style='color:#990000;'";$vorhanden=0; } else { echo "style='color:#aaaaaa;'"; } ?>><center><?php echo $kosten_kbasis[0]?></center></td>
                    <td <?php if ($vorrat<$kosten_kbasis[1]) { echo "style='color:#990000;'";$vorhanden=0; } else { echo "style='color:#aaaaaa;'"; } ?>><center><?php echo $kosten_kbasis[1]?></center></td>
                    <td <?php if ($lemin<$kosten_kbasis[2]) { echo "style='color:#990000;'";$vorhanden=0; } else { echo "style='color:#aaaaaa;'"; } ?>><center><?php echo $kosten_kbasis[2]?></center></td>
                    <td <?php if ($min1<$kosten_kbasis[3]) { echo "style='color:#990000;'";$vorhanden=0; } else { echo "style='color:#aaaaaa;'"; } ?>><center><?php echo $kosten_kbasis[3]?></center></td>
                    <td <?php if ($min2<$kosten_kbasis[4]) { echo "style='color:#990000;'";$vorhanden=0; } else { echo "style='color:#aaaaaa;'"; } ?>><center><?php echo $kosten_kbasis[4]?></center></td>
                    <td <?php if ($min3<$kosten_kbasis[5]) { echo "style='color:#990000;'";$vorhanden=0; } else { echo "style='color:#aaaaaa;'"; } ?>><center><?php echo $kosten_kbasis[5]?></center></td>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="17"></td>
                    <td><?php if ($vorhanden==1) { ?><input type="submit" value="<?php echo $lang['planetenalpha']['auftraggeben']?>" style="width:145px;"><?php } else { ?>&nbsp;<?php } ?></td>
                    <td></form></td>
                </tr>
            </table>
            <?php
        }
        if ($sternenbasis==1) {
            ?>
            <center>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><br><center><?php echo $lang['planetenalpha']['bereitsimbau']?></center></td>
                    </tr>
                </table>
            </center>
            <?php
        }
        if ($sternenbasis==2) {
            if ($sternenbasis_art==0) {
                $basisbild='1.jpg';
            }elseif ($sternenbasis_art==1) {
                $basisbild='2.jpg';
            }elseif ($sternenbasis_art==2) {
                $basisbild='3.jpg';
            }elseif ($sternenbasis_art==3) {
                $basisbild='4.jpg';
            }
            ?>
            <center>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="6"></td>
                    </tr>
                    <tr>
                        <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                    </tr>
                    <tr>
                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                        <td><a href="basen.php?fu=2&baid=<?php echo $sternenbasis_id?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>" target="_parent"><img src="<?php $file='../daten/'.$sternenbasis_rasse.'/bilder_basen/'.$basisbild; if (@file_exists($file)) { echo $file; } else { echo '../daten/'.$sternenbasis_rasse.'/bilder_basen/1.jpg'; }?>" border="0" height="94" width="141"></a></td>
                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                    </tr>
                    <tr>
                        <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                    </tr>
                </table>
            </center>
            <?php
        }
    include ("inc.footer.php");
}
if ($fuid==3) {
    include ("inc.header.php");
    $art=int_get('art');
    ?>
    <body text="#000000" scroll="no" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php
        $zeiger = @mysql_query("SELECT * FROM $skrupel_planeten where besitzer=$spieler and id=".$pid);
        $array = @mysql_fetch_array($zeiger);
        $pid=$array["id"];
        $x_pos=$array["x_pos"];
        $y_pos=$array["y_pos"];
        $cantox=$array["cantox"];
        $vorrat=$array["vorrat"];
        $min1=$array["min1"];
        $min2=$array["min2"];
        $min3=$array["min3"];
        $lemin=$array["lemin"];
        $sternenbasis=$array["sternenbasis"];
        $native_id=$array["native_id"];
        $native_abgabe=$array["native_abgabe"];
        $native_fert=$array["native_fert"];
        $native_kol=$array["native_kol"];
        $native_fert_tech_1=0;
        $native_fert_tech_2=0;
        $native_fert_tech_3=0;
        $native_fert_tech_4=0;
        $native_fert_tech_5=0;
         if (($native_id>=1) and ($native_kol>1)) {
            $native_fert_tech_1=@intval(substr($native_fert,12,1));
            $native_fert_tech_2=@intval(substr($native_fert,13,1));
            $native_fert_tech_3=@intval(substr($native_fert,14,1));
            $native_fert_tech_4=@intval(substr($native_fert,15,1));
            if (@intval(substr($native_fert,30,1))==1) {
                $zufall=rand(1,4);
                switch($zufall) {
                    case 1:
                        $native_fert_tech_1=rand(1,10);
                    break;
                    case 2:
                        $native_fert_tech_2=rand(1,10);
                        break;
                    case 3:
                        $native_fert_tech_3=rand(1,10);
                        break;
                    case 4:
                        $native_fert_tech_4=rand(1,10);
                        break;
                }
            }
         }
        if($zug_abgeschlossen==0 && $sternenbasis==0) {
            $vorhanden=1;
            if ($art==1) { 
                $kosten=array(328,20,21,78,210,107);
            }elseif ($art==2) {
                $kosten=array(522,51,83,99,250,210);
            }elseif ($art==0) {
                $kosten=array(855,35,70,123,418,370);
            }elseif ($art==3) {
                $kosten=array(3250,270,327,520,830,920);
            }
            if($cantox<$kosten[0]) { $vorhanden=0; }
            if($vorrat<$kosten[1]) { $vorhanden=0; }
            if($lemin<$kosten[2]) { $vorhanden=0; }
            if($min1<$kosten[3]) { $vorhanden=0; }
            if($min2<$kosten[4]) { $vorhanden=0; }
            if($min3<$kosten[5]) { $vorhanden=0; }
            //echo $kosten[0].':'.$kosten[1].':'.$kosten[2].':'.$kosten[3].':'.$kosten[4].':'.$kosten[5].'<br>';
            //echo $cantox.':'.$vorrat.':'.$lemin.':'.$min1.':'.$min2.':'.$min3.'<br>';
            if ($vorhanden==1) {
                $cantox=$cantox-$kosten[0];
                $vorrat=$vorrat-$kosten[1];
                $lemin=$lemin-$kosten[2];
                $min1=$min1-$kosten[3];
                $min2=$min2-$kosten[4];
                $min3=$min3-$kosten[5];
                $stationsname=str_post('stationsname','SQLSAFE');
                //$stationsname=str_replace("'"," ",$stationsname);
                //$stationsname=str_replace('"'," ",$stationsname);
                $zeiger_temp = @mysql_query("INSERT INTO $skrupel_sternenbasen (art,status,name,x_pos,y_pos,rasse,planetid,besitzer,spiel,t_huelle,t_antrieb,t_energie,t_explosiv) values ($art,0,'$stationsname',$x_pos,$y_pos,'$spieler_rasse',$pid,$spieler,$spiel,$native_fert_tech_1,$native_fert_tech_2,$native_fert_tech_3,$native_fert_tech_4);");
                $zeiger_temp = @mysql_query("SELECT id,planetid FROM $skrupel_sternenbasen where planetid=$pid");
                $array_temp = @mysql_fetch_array($zeiger_temp);
                $sbid=$array_temp["id"];
                $zeiger_temp = @mysql_query("UPDATE $skrupel_planeten set cantox=$cantox,vorrat=$vorrat,lemin=$lemin,min1=$min1,min2=$min2,min3=$min3,sternenbasis_id=$sbid,sternenbasis_art=$art,sternenbasis=1,sternenbasis_name='$stationsname',sternenbasis_rasse='$spieler_rasse' where id=$pid");
                $message="<center>".$lang['planetenalpha']['auftragerfolgreich']."</center>";
                ?>
                <br><br>
                <?php echo $message?>
                <script language=JavaScript>
                    var ant=parent.planeten.document.getElementById('cantox');
                    ant.innerHTML='<?php echo $cantox; ?>';
                    var ant=parent.planeten.document.getElementById('vorrat');
                    ant.innerHTML='<?php echo $vorrat; ?>';
                    var ant=parent.planeten.document.getElementById('min1');
                    ant.innerHTML='<?php echo $min1; ?>';
                    var ant=parent.planeten.document.getElementById('min2');
                    ant.innerHTML='<?php echo $min2; ?>';
                    var ant=parent.planeten.document.getElementById('min3');
                    ant.innerHTML='<?php echo $min3; ?>';
                    var ant=parent.planeten.document.getElementById('lemin');
                    ant.innerHTML='<?php echo $lemin; ?>';
                </script>
                <?php
            }
        }
    include ("inc.footer.php");
}
if ($fuid==4) {
    include ("inc.header.php");
    $file='../daten/orbitale_systeme.txt';
    $fp = @fopen("$file","r");
    if ($fp) {
        $zaehler2=0;
        while (!feof ($fp)) {
            $buffer = @fgets($fp, 4096);
            $daten=explode(":",trim($buffer));
            $schlus=@intval($daten[0]);
            $osys_daten[$schlus][0]=$daten[2];
            $osys_daten[$schlus][1]=$daten[3];
            $zaehler2++;
        }
        @fclose($fp);
    }
    $zeiger = @mysql_query("SELECT id,besitzer,osys_anzahl,osys_1,osys_2,osys_3,osys_4,osys_5,osys_6 FROM $skrupel_planeten where besitzer=$spieler and id=".$pid);
    $array = @mysql_fetch_array($zeiger);
    $pid=$array["id"];
    $osys_anzahl=$array["osys_anzahl"];
    $osys[1]=$array["osys_1"];
    $osys[2]=$array["osys_2"];
    $osys[3]=$array["osys_3"];
    $osys[4]=$array["osys_4"];
    $osys[5]=$array["osys_5"];
    $osys[6]=$array["osys_6"];
    ?>
    <body text="#000000" scroll="no" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" cellspacing="0" cellpadding="1">
                <tr>
                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                    <td><center><?php echo $lang['planetenalpha']['orbitalesysteme']?></center></td>
                    <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                </tr>
            </table>
        </center>
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                 <tr>
                    <?php
                    $pos=2;
                    for ($n=1;$n<=$osys_anzahl;$n++) {
                        if ($pos==1) { $pos=2; } else { $pos=1; }
                        if ($osys[$n]==0) {
                            ?>
                            <td valign="top">
                                <?php
                                if ($pos==1) { 
                                    ?>
                                    <img src="../bilder/empty.gif" border="0" width="61" height="15"><br>
                                    <?php
                                }
                                ?>
                                <a href="planeten_alpha.php?fu=6&position=<?php echo $n?>&pid=<?php echo $pid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"><img src="../bilder/osysteme/blank.gif" border="0" width="61" height="64" title="<?php echo $lang['planetenalpha']['leererstandort']?>"></a>
                            </td>
                            <?php
                        } else {
                            ?>
                            <td valign="top">
                                <?php
                                if ($pos==1) {
                                    ?>
                                    <img src="../bilder/empty.gif" border="0" width="61" height="15"><br>
                                    <?php
                                }
                                ?>
                                <a href="<?php echo $osys_daten[$osys[$n]][1]?>&pid=<?php echo $pid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"><img src="../bilder/osysteme/<?php echo $osys[$n]?>.gif" border="0" width="61" height="64" title="<?php echo $lang['orbitalesysteme']['name'][$osys[$n]]?>"></a>
                            </td>
                            <?php
                        }
                    }
                    ?>
                </tr>
            </table>
        </center>
    <?php include ("inc.footer.php");
}
if ($fuid==5) {
    include ("inc.header.php");
    $oid = int_get('oid');
    ?>
    <body text="#000000" scroll="no" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" cellspacing="0" cellpadding="1">
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
                </tr>
                <tr>
                    <td><center><?php echo $lang['orbitalesysteme']['name'][$oid]?></center></td>
                </tr>
            </table>
        </center>
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><img src="<?php echo $bildpfad?>/osysteme/<?php echo $oid?>.gif" border="0" width="61" height="64" title="<?php echo $osys_daten[$oid][0]?>"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['orbitalesysteme']['lang'][$oid]?></td>
                </tr>
            </table>
        </center>
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><?php echo $lang['orbitalesysteme']['kurz'][$oid]?></td>
                </tr>
            </table>
        </center>
    <?php include ("inc.footer.php");
}
if ($fuid==6) {
    include ("inc.header.php");
    $zeiger2 = @mysql_query("SELECT id,spiel,cantox,besitzer,min1,min2,min3,vorrat,lemin,osys_anzahl,osys_1,osys_2,osys_3,osys_4,osys_5,osys_6 FROM $skrupel_planeten where besitzer=$spieler and id=".$pid);
    $array2 = @mysql_fetch_array($zeiger2);
    $spiel=$array2["spiel"];
    $cantox=$array2["cantox"];
    $min1=$array2["min1"];
    $min2=$array2["min2"];
    $min3=$array2["min3"];
    $lemin=$array2["lemin"];
    $vorrat=$array2["vorrat"];
    $osys_anzahl=$array2["osys_anzahl"];
    $osys_1=$array2["osys_1"];
    $osys_2=$array2["osys_2"];
    $osys_3=$array2["osys_3"];
    $osys_4=$array2["osys_4"];
    $osys_5=$array2["osys_5"];
    $osys_6=$array2["osys_6"];
    $file='../daten/'.$spieler_rasse_c[$spieler].'/daten.txt';
    $fp = @fopen("$file","r");
    if ($fp) {
        $zaehler2=0;
        while (!feof ($fp)) {
            $buffer = @fgets($fp, 4096);
            $daten[$zaehler2]=$buffer;
            $zaehler2++;
        }
        @fclose($fp);
    }
    $verbieten=explode(":",trim($daten[6]));
    $erlauben=explode(":",trim($daten[7]));
    $file='../daten/orbitale_systeme.txt';
    $fp = @fopen("$file","r");
    if ($fp) {
        $zaehler2=0;
        while (!feof ($fp)) {
            $buffer = @fgets($fp, 4096);
            $daten=explode(":",trim($buffer));
            $schlus=@intval($daten[0]);
            $erlaubt=0;
            if ($schlus!=4) {
                if ($daten[1]=='1') {
                    if (!in_array($schlus,$verbieten)) {
                        $erlaubt=1;
                    }
                } else {
                    if (in_array($schlus,$erlauben)) {
                        $erlaubt=1;
                    }
                }
                if ($erlaubt==1) {
                    $reihenfolge[]=$schlus;
                    $osys_daten[$schlus][1]=$daten[4];
                    $osys_daten[$schlus][2]=$daten[5];
                    $osys_daten[$schlus][3]=$daten[6];
                    $osys_daten[$schlus][4]=$daten[7];
                    $osys_daten[$schlus][5]=$daten[8];
                    $osys_daten[$schlus][6]=$daten[9];
                }
            }
            $zaehler2++;
        }
        @fclose($fp);
    }
    if($module[0]) {
        $zeiger_spio = @mysql_query("SELECT id FROM $skrupel_planeten WHERE (osys_1=4 OR osys_2=4 OR osys_3=4 OR osys_4=4 OR osys_5=4 OR osys_6=4) AND besitzer=$spieler AND spiel=$spiel;");
        $num_spio_osys = @mysql_num_rows($zeiger_spio);
        if($num_spio_osys > 10) $num_spio_osys = 10;
        $osys_daten[4][1]=floor(pow(1700,($num_spio_osys*0.04)+1)); //ctx
        $osys_daten[4][2]=floor(pow(130,($num_spio_osys*0.08)+1)); //vor
        $osys_daten[4][3]=floor(pow(82,($num_spio_osys*0.08)+1)); //lem
        $osys_daten[4][4]=floor(pow(122,($num_spio_osys*0.08)+1)); //bax
        $osys_daten[4][5]=floor(pow(114,($num_spio_osys*0.08)+1)); //ren
        $osys_daten[4][6]=floor(pow(96,($num_spio_osys*0.08)+1)); //vom
        $reihenfolge[]=4;
    }
    ?>
    <body text="#000000" scroll="auto" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <script language=JavaScript>
            function systemdetail(syid) {
                oben=100;
                links=Math.ceil((screen.width-580)/2);
                window.open('hilfe_osystem.php?fu2='+syid+'&uid=<?php echo $uid?>&sid=<?php echo $sid?>','Hilfe','resizable=yes,scrollbars=no,width=580,height=180,top='+oben+',left='+links);
            }
        </script>
        <center>
            <table border="0" cellspacing="0" cellpadding="2">
                <tr>
                    <td colspan="10"><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                    <td><center><img src="<?php echo $bildpfad?>/icons/cantox.gif" border="0" width="17" height="17"></center></td>
                    <td><center><img src="<?php echo $bildpfad?>/icons/vorrat.gif" border="0" width="17" height="17"></center></td>
                    <td><center><img src="<?php echo $bildpfad?>/icons/lemin.gif" border="0" width="17" height="17"></center></td>
                    <td><center><img src="<?php echo $bildpfad?>/icons/mineral_1.gif" border="0" width="17" height="17"></center></td>
                    <td><center><img src="<?php echo $bildpfad?>/icons/mineral_2.gif" border="0" width="17" height="17"></center></td>
                    <td><center><img src="<?php echo $bildpfad?>/icons/mineral_3.gif" border="0" width="17" height="17"></center></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <?php
                for($kg=0;$kg<count($reihenfolge);$kg++) { 
                    $nj=$reihenfolge[$kg];
                    ?>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="1" height="18"></td>
                        <td>
                            <form name="formular" method="post" action="planeten_alpha.php?fu=7&pid=<?php echo $pid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>">
                            <input type="hidden" name="bau" value="<?php echo $nj?>">
                            <input type="hidden" name="position" value="<?php echo int_get('position')?>">
                        </td>
                        <td><nobr><a href="javascript:systemdetail(<?php echo $nj?>);" style="color:#ffffff;"><?php echo $lang['orbitalesysteme']['name'][$nj]?></a></nobr></td>
                        <td style="color:#<?php if ($cantox>=$osys_daten[$nj][1]) { ?>aaaaaa<?php } else { ?>ff0000<?php } ?>;"><center><?php echo $osys_daten[$nj][1]?></center></td>
                        <td style="color:#<?php if ($vorrat>=$osys_daten[$nj][2]) { ?>aaaaaa<?php } else { ?>ff0000<?php } ?>;"><center><?php echo $osys_daten[$nj][2]?></center></td>
                        <td style="color:#<?php if ($lemin>=$osys_daten[$nj][3]) { ?>aaaaaa<?php } else { ?>ff0000<?php } ?>;"><center><?php echo $osys_daten[$nj][3]?></center></td>
                        <td style="color:#<?php if ($min1>=$osys_daten[$nj][4]) { ?>aaaaaa<?php } else { ?>ff0000<?php } ?>;"><center><?php echo $osys_daten[$nj][4]?></center></td>
                        <td style="color:#<?php if ($min2>=$osys_daten[$nj][5]) { ?>aaaaaa<?php } else { ?>ff0000<?php } ?>;"><center><?php echo $osys_daten[$nj][5]?></center></td>
                        <td style="color:#<?php if ($min3>=$osys_daten[$nj][6]) { ?>aaaaaa<?php } else { ?>ff0000<?php } ?>;"><center><?php echo $osys_daten[$nj][6]?></center></td>
                        <?php
                        if (($vorrat>=$osys_daten[$nj][2]) and ($cantox>=$osys_daten[$nj][1]) and ($min1>=$osys_daten[$nj][4]) and ($min2>=$osys_daten[$nj][5]) and ($min3>=$osys_daten[$nj][6]) and ($lemin>=$osys_daten[$nj][3])) {
                            if (($zug_abgeschlossen!=0) or($osys_1==$nj) or ($osys_2==$nj) or ($osys_3==$nj) or ($osys_4==$nj) or ($osys_5==$nj) or ($osys_6==$nj)) {
                                ?>
                                <td>&nbsp;</td>
                                <?php
                            } else {
                                ?>
                                <td><input type="submit" value="<?php echo $lang['planetenalpha']['bauen']?>" style="width:50px;"></td>
                                <?php
                            }
                        } else { 
                            ?>
                            <td>&nbsp;</td>
                            <?php
                        }
                        ?>
                        <td></form></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </center>
    <?php include ("inc.footer.php");
}
if ($fuid==7) {
    include ("inc.header.php");
    $zeiger2 = @mysql_query("SELECT id,spiel,cantox,besitzer,min1,min2,min3,vorrat,lemin,osys_anzahl,osys_1,osys_2,osys_3,osys_4,osys_5,osys_6 FROM $skrupel_planeten where besitzer=$spieler and id=".$pid);
    $array2 = @mysql_fetch_array($zeiger2);
    $spiel=$array2["spiel"];
    $cantox=$array2["cantox"];
    $min1=$array2["min1"];
    $min2=$array2["min2"];
    $min3=$array2["min3"];
    $lemin=$array2["lemin"];
    $vorrat=$array2["vorrat"];
    $osys_anzahl=$array2["osys_anzahl"];
    $osys_1=$array2["osys_1"];
    $osys_2=$array2["osys_2"];
    $osys_3=$array2["osys_3"];
    $osys_4=$array2["osys_4"];
    $osys_5=$array2["osys_5"];
    $osys_6=$array2["osys_6"];
    $file='../daten/'.$spieler_rasse_c[$spieler].'/daten.txt';
    $fp = @fopen("$file","r");
    if ($fp) {
        $zaehler2=0;
        while (!feof ($fp)) {
            $buffer = @fgets($fp, 4096);
            $daten[$zaehler2]=$buffer;
            $zaehler2++;
        }
        @fclose($fp);
    }
    $verbieten=explode(":",$daten[6]);
    $erlauben=explode(":",$daten[7]);
    $file='../daten/orbitale_systeme.txt';
    $fp = @fopen("$file","r");
    if ($fp) {
        $zaehler2=0;
        while (!feof ($fp)) {
            $buffer = @fgets($fp, 4096);
            $daten=explode(":",trim($buffer));
            $schlus=@intval($daten[0]);
            $erlaubt=0;
            if ($schlus!=4) {
                if ($daten[1]=='1') {
                    if (!in_array($schlus,$verbieten)) {
                        $erlaubt=1;
                    }
                } else {
                    if (in_array($schlus,$erlauben)) {
                        $erlaubt=1;
                    }
                }
                if ($erlaubt==1) {
                    $reihenfolge[]=$schlus;
                    $osys_daten[$schlus][1]=$daten[4];
                    $osys_daten[$schlus][2]=$daten[5];
                    $osys_daten[$schlus][3]=$daten[6];
                    $osys_daten[$schlus][4]=$daten[7];
                    $osys_daten[$schlus][5]=$daten[8];
                    $osys_daten[$schlus][6]=$daten[9];
                }
            }
            $zaehler2++;
        }
        @fclose($fp);
    }
    if($module[0]) {
        $zeiger_spio = @mysql_query("SELECT id FROM $skrupel_planeten WHERE (osys_1=4 OR osys_2=4 OR osys_3=4 OR osys_4=4 OR osys_5=4 OR osys_6=4) AND besitzer=$spieler AND spiel=$spiel;");
        $num_spio_osys = @mysql_num_rows($zeiger_spio);
        if($num_spio_osys > 10) $num_spio_osys = 10;
        $osys_daten[4][1]=floor(pow(1700,($num_spio_osys*0.04)+1)); //ctx
        $osys_daten[4][2]=floor(pow(130,($num_spio_osys*0.08)+1)); //vor
        $osys_daten[4][3]=floor(pow(82,($num_spio_osys*0.08)+1)); //lem
        $osys_daten[4][4]=floor(pow(122,($num_spio_osys*0.08)+1)); //bax
        $osys_daten[4][5]=floor(pow(114,($num_spio_osys*0.08)+1)); //ren
        $osys_daten[4][6]=floor(pow(96,($num_spio_osys*0.08)+1)); //vom
        $reihenfolge[]=4;
    }
    $bau = int_post('bau');
    $position = int_post('position');
    $osys_benoetigt[0]=$lang['orbitalesysteme']['name'][$bau];
    $osys_benoetigt[1]=$osys_daten[$bau][1];
    $osys_benoetigt[2]=$osys_daten[$bau][2];
    $osys_benoetigt[3]=$osys_daten[$bau][3];
    $osys_benoetigt[4]=$osys_daten[$bau][4];
    $osys_benoetigt[5]=$osys_daten[$bau][5];
    $osys_benoetigt[6]=$osys_daten[$bau][6];
    if (($osys_1==$bau) or ($osys_2==$bau) or ($osys_3==$bau) or ($osys_4==$bau) or ($osys_5==$bau) or ($osys_6==$bau) or (!$lang['orbitalesysteme']['name'][$bau]>=1)) {
    } else {
        if (($vorrat>=$osys_benoetigt[2]) and ($cantox>=$osys_benoetigt[1]) and ($min1>=$osys_benoetigt[4]) and ($min2>=$osys_benoetigt[5]) and ($min3>=$osys_benoetigt[6]) and ($lemin>=$osys_benoetigt[3])) {
            if($zug_abgeschlossen==0 && $position<=$osys_anzahl) {
                $vorrat=$vorrat-$osys_benoetigt[2];
                $cantox=$cantox-$osys_benoetigt[1];
                $min1=$min1-$osys_benoetigt[4];
                $min2=$min2-$osys_benoetigt[5];
                $min3=$min3-$osys_benoetigt[6];
                $lemin=$lemin-$osys_benoetigt[3];
                if ($position==1) {
                    $spalte="osys_1";
                }elseif ($position==2) {
                    $spalte="osys_2";
                }elseif ($position==3) {
                    $spalte="osys_3";
                }elseif ($position==4) {
                    $spalte="osys_4";
                }elseif ($position==5) {
                    $spalte="osys_5";
                }elseif ($position==6) {
                    $spalte="osys_6";
                }
                $art=$bau;
                if($art==24){
                    $osys_anzahl=min($osys_anzahl+2,6);
                    $zeiger_temp = @mysql_query("UPDATE $skrupel_planeten set osys_anzahl=$osys_anzahl where besitzer=$spieler and id=".$pid);
                }
                $zeiger_temp = @mysql_query("UPDATE $skrupel_planeten set $spalte=$art,cantox=$cantox,min1=$min1,min2=$min2,min3=$min3,lemin=$lemin,vorrat=$vorrat where besitzer=$spieler and id=".$pid);
                $message="<center>".str_replace(array('{1}'),array($osys_benoetigt[0]),$lang['planetenalpha']['erfolgreichkonstruiert'])."</center>";
            }else { 
                $message="";
            }
        }
    }
    ?>
    <body text="#000000" scroll="no" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <br><br>
        <?php echo $message?>
        <script language=JavaScript>
            var ant=parent.planeten.document.getElementById('cantox');
            ant.innerHTML='<?php echo $cantox; ?>';
            var ant=parent.planeten.document.getElementById('vorrat');
            ant.innerHTML='<?php echo $vorrat; ?>';
            var ant=parent.planeten.document.getElementById('min1');
            ant.innerHTML='<?php echo $min1; ?>';
            var ant=parent.planeten.document.getElementById('min2');
            ant.innerHTML='<?php echo $min2; ?>';
            var ant=parent.planeten.document.getElementById('min3');
            ant.innerHTML='<?php echo $min3; ?>';
            var ant=parent.planeten.document.getElementById('lemin');
            ant.innerHTML='<?php echo $lemin; ?>';
        </script>
        <?php
    include ("inc.footer.php");
}
if ($fuid==8) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_planeten where besitzer=$spieler and id=".$pid);
    $array = @mysql_fetch_array($zeiger);
    $pid=$array["id"];
    $leichtebt=$array["leichtebt"];
    $leichtebt_bau=$array["leichtebt_bau"];
    $kolonisten=$array["kolonisten"];
    $cantox=$array["cantox"];
    $vorrat=$array["vorrat"];
    $min1=$array["min1"];
    $min2=$array["min2"];
    $min3=$array["min3"];
    $osys_1=$array["osys_1"];
    $osys_2=$array["osys_2"];
    $osys_3=$array["osys_3"];
    $osys_4=$array["osys_4"];
    $osys_5=$array["osys_5"];
    $osys_6=$array["osys_6"];
    $koloschalter=1;
    $rohstoffschalter=1;
    if(($osys_1==21) or ($osys_2==21) or ($osys_3==21) or ($osys_4==21) or ($osys_5==21) or ($osys_6==21)){
        $koloschalter=0;
    }
    if(($osys_1==22) or ($osys_2==22) or ($osys_3==22) or ($osys_4==22) or ($osys_5==22) or ($osys_6==22)){
        $rohstoffschalter=0;
    }
    $moeglich=100;
    if ((100-$leichtebt_bau)<$moeglich) { $moeglich=$moeglich-$leichtebt_bau; }
    if ((3000-$leichtebt)<$moeglich) { $moeglich=3000-$leichtebt; }
    if ((($kolonisten-1000)<$moeglich) and $koloschalter) { $moeglich=$kolonisten-1000; }
    if ((floor($cantox/2))<$moeglich) { $moeglich=floor($cantox/2); }
    if (($vorrat<$moeglich) and $rohstoffschalter) { $moeglich=$vorrat; }
    if (($min1<$moeglich)and $rohstoffschalter) { $moeglich=$min1; }
    if (($min2<$moeglich) and $rohstoffschalter) { $moeglich=$min2; }
    ?>
    <body text="#000000" scroll="no" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table cellpadding="0" cellpsacing="0" border="0">
                <tr>
                    <td valign="top" width="100%">
                        <center>
                            <table cellpadding="0" cellpspacing="0" border="0">
                                <tr>
                                    <td>
                                        <center>
                                            <table border="0" cellspacing="0" cellpadding="1">
                                                <tr>
                                                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                                                    <td><center><?php echo $lang['orbitalesysteme']['name'][10]?></center></td>
                                                    <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                                </tr>
                                            </table>
                                        </center>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><center><img src="<?php echo $bildpfad?>/icons/crew.gif" border="0" width="17" height="17"></center></td>
                                    <td><center><img src="<?php echo $bildpfad?>/icons/cantox.gif" border="0" width="17" height="17"></center></td>
                                    <td><center><img src="<?php echo $bildpfad?>/icons/vorrat.gif" border="0" width="17" height="17"></center></td>
                                    <td><center><img src="<?php echo $bildpfad?>/icons/mineral_1.gif" border="0" width="17" height="17"></center></td>
                                    <td><center><img src="<?php echo $bildpfad?>/icons/mineral_2.gif" border="0" width="17" height="17"></center></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                </tr>
                                <tr>
                                    <td align="right"><?php echo $lang['planetenalpha']['ausbildungskosten']?>&nbsp;</td>
                                    <?php
                                    if($koloschalter){
                                        ?>
                                        <td><center>1</center></td>
                                        <?php
                                    }else{
                                        ?>
                                        <td><center>0</center></td>
                                        <?php
                                    }
                                    ?>
                                    <td><center>2</center></td>
                                    <?php
                                    if($rohstoffschalter){
                                        ?>
                                        <td><center>1</center></td>
                                        <td><center>1</center></td>
                                        <td><center>1</center></td>
                                        <?php
                                    }else{
                                        ?>
                                        <td><center>0</center></td>
                                        <td><center>0</center></td>
                                        <td><center>0</center></td>
                                        <?php
                                    }
                                    ?>
                                    <td><img src="../bilder/empty.gif" border="0" width="1" height="18"></td>
                                </tr>
                                <tr>
                                    <td align="right"><?php echo $lang['planetenalpha']['ausbildungszeit']?>&nbsp;</td>
                                    <td colspan="5">
                                        <table cellpadding="0" cellpspacing="0" border="0">
                                            <tr>
                                                <td><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                <td><?php echo $leichtebt_bau?>/100</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td><img src="../bilder/empty.gif" border="0" width="1" height="10"></td>
                                </tr>
                                <tr>
                                    <td align="right"><?php echo $lang['planetenalpha']['neuausbilden']?>&nbsp;</td>
                                    <td colspan="5">
                                        <table cellpadding="0" cellpspacing="0" border="0">
                                            <tr>
                                                <td><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                <?php
                                                if ($moeglich>=1) {
                                                    ?>
                                                    <td><form name="formular" method="post" action="planeten_alpha.php?fu=9&pid=<?php echo $pid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"></td>
                                                    <td>
                                                        <select name="neuinfa" style="width:50px;">
                                                            <?php
                                                            for ($n=1;$n<=$moeglich;$n++) {
                                                                ?>
                                                                <option value="<?php echo $n?>"><?php echo $n?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td><input type="submit" value="<?php echo $lang['planetenalpha']['ok']?>" style="width:30px;"></td>
                                                    <td></form>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <td><i><?php echo $lang['planetenalpha']['nichtm']?></i></td>
                                                    <?php
                                                }
                                                ?>
                                            </tr>
                                        </table>
                                    </td>
                                    <td><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                </tr>
                            </table>
                        </center>
                    </td>
                    <td>
                        <center>
                            <br><img src="<?php echo $bildpfad?>/osysteme/10.gif" border="0" width="61" height="64">
                            <table cellpadding="0" cellpsacing="0" border="0">
                                <tr>
                                    <td><img src="<?php echo $bildpfad?>/icons/leichtebt.gif" border="0" width="17" height="17"></td>
                                    <td><?php echo $leichtebt?></td>
                                </tr>
                            </table>
                        </center>
                    </td>
                </tr>
            </table>
        </td></center>
    <?php include ("inc.footer.php");
}
if ($fuid==9) {
    include ("inc.header.php");
    $zeiger2 = @mysql_query("SELECT id,leichtebt,leichtebt_bau,kolonisten,spiel,cantox,besitzer,min1,min2,min3,vorrat,lemin,osys_1,osys_2,osys_3,osys_4,osys_5,osys_6 FROM $skrupel_planeten where besitzer=$spieler and id=".$pid);
    $array2 = @mysql_fetch_array($zeiger2);
    $spiel=$array2["spiel"];
    $cantox=$array2["cantox"];
    $min1=$array2["min1"];
    $min2=$array2["min2"];
    $min3=$array2["min3"];
    $lemin=$array2["lemin"];
    $vorrat=$array2["vorrat"];
    $osys_anzahl=$array2["osys_anzahl"];
    $osys_1=$array2["osys_1"];
    $osys_2=$array2["osys_2"];
    $osys_3=$array2["osys_3"];
    $osys_4=$array2["osys_4"];
    $osys_5=$array2["osys_5"];
    $osys_6=$array2["osys_6"];
    $leichtebt=$array2["leichtebt"];
    $leichtebt_bau=$array2["leichtebt_bau"];
    $kolonisten=$array2["kolonisten"];
    $bauen=int_post('neuinfa');
    $koloschalter=1;
    $rohstoffschalter=1;
    if(($osys_1==21) or ($osys_2==21) or ($osys_3==21) or ($osys_4==21) or ($osys_5==21) or ($osys_6==21)){
        $koloschalter=0;
    }
    if(($osys_1==22) or ($osys_2==22) or ($osys_3==22) or ($osys_4==22) or ($osys_5==22) or ($osys_6==22)){
        $rohstoffschalter=0;
    }
    if (($osys_1==10) or ($osys_2==10) or ($osys_3==10) or ($osys_4==10) or ($osys_5==10) or ($osys_6==10)) {
        $moeglich=100;
        if ((100-$leichtebt_bau)<$moeglich) { $moeglich=$moeglich-$leichtebt_bau; }
        if ((3000-$leichtebt)<$moeglich) { $moeglich=3000-$leichtebt; }
        if ((($kolonisten-1000)<$moeglich) and $koloschalter) { $moeglich=$kolonisten-1000; }
        if ((floor($cantox/2))<$moeglich) { $moeglich=floor($cantox/2); }
        if (($vorrat<$moeglich) and $rohstoffschalter) { $moeglich=$vorrat; }
        if (($min1<$moeglich)and $rohstoffschalter) { $moeglich=$min1; }
        if (($min2<$moeglich) and $rohstoffschalter) { $moeglich=$min2; }
        if ($bauen>$moeglich) {
            $bauen=$moeglich;
        }
        $leichtebt_bau=$leichtebt_bau+$bauen;
        if($koloschalter){
            $kolonisten=$kolonisten-$bauen;
        }
        $cantox=$cantox-($bauen*2);
        if($rohstoffschalter){
            $vorrat=$vorrat-$bauen;
            $min1=$min1-$bauen;
            $min2=$min2-$bauen;
        }
        $zeiger_temp = @mysql_query("UPDATE $skrupel_planeten set leichtebt_bau=$leichtebt_bau,cantox=$cantox,min1=$min1,min2=$min2,kolonisten=$kolonisten,vorrat=$vorrat where besitzer=$spieler and id=".$pid);
        $message="<center>".str_replace(array('{1}'),array($bauen),$lang['planetenalpha']['ausbildungneu'])."</center>";
    }
    ?>
    <body text="#000000" scroll="no" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <br><br>
        <?php echo $message?>
        <script language=JavaScript>
            var ant=parent.planeten.document.getElementById('cantox');
            ant.innerHTML='<?php echo $cantox; ?>';
            var ant=parent.planeten.document.getElementById('vorrat');
            ant.innerHTML='<?php echo $vorrat; ?>';
            var ant=parent.planeten.document.getElementById('min1');
            ant.innerHTML='<?php echo $min1; ?>';
            var ant=parent.planeten.document.getElementById('min2');
            ant.innerHTML='<?php echo $min2; ?>';
            var ant=parent.planeten.document.getElementById('kolonisten');
            ant.innerHTML='<?php echo $kolonisten; ?>';
        </script>
    <?php include ("inc.footer.php");
}
if ($fuid==10) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_planeten where besitzer=$spieler and id=".$pid);
    $array = @mysql_fetch_array($zeiger);
    $pid=$array["id"];
    $schwerebt=$array["schwerebt"];
    $schwerebt_bau=$array["schwerebt_bau"];
    $kolonisten=$array["kolonisten"];
    $cantox=$array["cantox"];
    $lemin=$array["lemin"];
    $min1=$array["min1"];
    $min2=$array["min2"];
    $min3=$array["min3"];
    $osys_1=$array["osys_1"];
    $osys_2=$array["osys_2"];
    $osys_3=$array["osys_3"];
    $osys_4=$array["osys_4"];
    $osys_5=$array["osys_5"];
    $osys_6=$array["osys_6"];
    $koloschalter=1;
    $rohstoffschalter=1;
    if(($osys_1==21) or ($osys_2==21) or ($osys_3==21) or ($osys_4==21) or ($osys_5==21) or ($osys_6==21)){
        $koloschalter=0;
    }
    if(($osys_1==22) or ($osys_2==22) or ($osys_3==22) or ($osys_4==22) or ($osys_5==22) or ($osys_6==22)){
        $rohstoffschalter=0;
    }    
    $moeglich=50;
    if ((50-$schwerebt_bau)<$moeglich) { $moeglich=$moeglich-$schwerebt_bau; }
    if ((1500-$schwerebt)<$moeglich) { $moeglich=1500-$schwerebt; }
    if (((floor(($kolonisten-1000)/3))<$moeglich) and $koloschalter) { $moeglich=floor(($kolonisten-1000)/3); }
    if ((floor($cantox/13))<$moeglich) { $moeglich=floor($cantox/13); }
    if (((floor($lemin/2))<$moeglich) and $rohstoffschalter) { $moeglich=floor($lemin/2); }
    if (((floor($min1/4))<$moeglich) and $rohstoffschalter) { $moeglich=floor($min1/4); }
    if (((floor($min2/5))<$moeglich) and $rohstoffschalter) { $moeglich=floor($min2/5); }
    if (($min3<$moeglich) and $rohstoffschalter) { $moeglich=$min3; }
    ?>
    <body text="#000000" scroll="no" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table cellpadding="0" cellpsacing="0" border="0">
                <tr>
                    <td valign="top" width="100%">
                        <center>
                            <table cellpadding="0" cellpspacing="0" border="0">
                                <tr>
                                    <td>
                                        <center>
                                            <table border="0" cellspacing="0" cellpadding="1">
                                                <tr>
                                                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                                                    <td><center><?php echo $lang['orbitalesystem']['name'][12]?></center></td>
                                                    <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                                </tr>
                                            </table>
                                        </center>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><center><img src="<?php echo $bildpfad?>/icons/crew.gif" border="0" width="17" height="17"></center></td>
                                    <td><center><img src="<?php echo $bildpfad?>/icons/cantox.gif" border="0" width="17" height="17"></center></td>
                                    <td><center><img src="<?php echo $bildpfad?>/icons/lemin.gif" border="0" width="17" height="17"></center></td>
                                    <td><center><img src="<?php echo $bildpfad?>/icons/mineral_1.gif" border="0" width="17" height="17"></center></td>
                                    <td><center><img src="<?php echo $bildpfad?>/icons/mineral_2.gif" border="0" width="17" height="17"></center></td>
                                    <td><center><img src="<?php echo $bildpfad?>/icons/mineral_3.gif" border="0" width="17" height="17"></center></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                </tr>
                                <tr>
                                    <td align="right"><?php echo $lang['planetenalpha']['ausbildungskosten']?>&nbsp;</td>
                                    <?php
                                    if($koloschalter){
                                        ?>
                                        <td><center>3</center></td>
                                        <?php
                                    }else{
                                        ?>
                                        <td><center>0</center></td>
                                        <?php
                                    }
                                    ?>
                                    <td><center>13</center></td>
                                    <?php
                                    if($rohstoffschalter){
                                        ?>
                                        <td><center>2</center></td>
                                        <td><center>4</center></td>
                                        <td><center>5</center></td>
                                        <td><center>1</center></td>
                                        <?php
                                    }else{
                                        ?>
                                        <td><center>0</center></td>
                                        <td><center>0</center></td>
                                        <td><center>0</center></td>
                                        <td><center>0</center></td>
                                        <?php
                                    }
                                    ?>
                                    <td><img src="../bilder/empty.gif" border="0" width="1" height="18"></td>
                                </tr>
                                <tr>
                                    <td align="right"><?php echo $lang['planetenalpha']['ausbildungszeit']?>&nbsp;</td>
                                    <td colspan="5">
                                        <table cellpadding="0" cellpspacing="0" border="0">
                                            <tr>
                                                <td><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                <td><?php echo $schwerebt_bau?>/50</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td><img src="../bilder/empty.gif" border="0" width="1" height="10"></td>
                                </tr>
                                <tr>
                                    <td align="right"><?php echo $lang['planetenalpha']['neuausbilden']?>&nbsp;</td>
                                    <td colspan="5">
                                        <table cellpadding="0" cellpspacing="0" border="0">
                                            <tr>
                                                <td><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                <?php
                                                if ($moeglich>=1) {
                                                    ?>
                                                    <td><form name="formular" method="post" action="planeten_alpha.php?fu=11&pid=<?php echo $pid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"></td>
                                                    <td>
                                                        <select name="neuinfa" style="width:50px;">
                                                            <?php
                                                            for ($n=1;$n<=$moeglich;$n++) { 
                                                                ?>
                                                                <option value="<?php echo $n?>"><?php echo $n?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td><input type="submit" value="<?php echo $lang['planetenalpha']['ok']?>" style="width:30px;"></td>
                                                    <td></form>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <td><i><?php echo $lang['planetenalpha']['nichtm']?></i></td>
                                                    <?php
                                                }
                                                ?>
                                            </tr>
                                        </table>
                                    </td>
                                    <td><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                </tr>
                            </table>
                        </center>
                    </td>
                    <td>
                        <center>
                            <br><img src="<?php echo $bildpfad?>/osysteme/12.gif" border="0" width="61" height="64">
                            <table cellpadding="0" cellpsacing="0" border="0">
                                <tr>
                                    <td><img src="<?php echo $bildpfad?>/icons/schwerebt.gif" border="0" width="17" height="17"></td>
                                    <td><?php echo $schwerebt?></td>
                                </tr>
                            </table>
                        </center>
                    </td>
                </tr>
            </table>
        </center>
    <?php include ("inc.footer.php");
}
if ($fuid==11) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT id,schwerebt,schwerebt_bau,kolonisten,cantox,min1,min2,min3,lemin,osys_1,osys_2,osys_3,osys_4,osys_5,osys_6 FROM $skrupel_planeten where besitzer=$spieler and id=".$pid);
    $array = @mysql_fetch_array($zeiger);
    $pid=$array["id"];
    $schwerebt=$array["schwerebt"];
    $schwerebt_bau=$array["schwerebt_bau"];
    $kolonisten=$array["kolonisten"];
    $cantox=$array["cantox"];
    $lemin=$array["lemin"];
    $min1=$array["min1"];
    $min2=$array["min2"];
    $min3=$array["min3"];
    $osys_1=$array["osys_1"];
    $osys_2=$array["osys_2"];
    $osys_3=$array["osys_3"];
    $osys_4=$array["osys_4"];
    $osys_5=$array["osys_5"];
    $osys_6=$array["osys_6"];
    $bauen=int_post('neuinfa');
    $koloschalter=1;
    $rohstoffschalter=1;
    if(($osys_1==21) or ($osys_2==21) or ($osys_3==21) or ($osys_4==21) or ($osys_5==21) or ($osys_6==21)){
        $koloschalter=0;
    }
    if(($osys_1==22) or ($osys_2==22) or ($osys_3==22) or ($osys_4==22) or ($osys_5==22) or ($osys_6==22)){
        $rohstoffschalter=0;
    }
    if (($osys_1==12) or ($osys_2==12) or ($osys_3==12) or ($osys_4==12) or ($osys_5==12) or ($osys_6==12)) {
        $moeglich=50;
        if ((50-$schwerebt_bau)<$moeglich) { $moeglich=$moeglich-$schwerebt_bau; }
        if ((1500-$schwerebt)<$moeglich) { $moeglich=1500-$schwerebt; }
        if (((floor(($kolonisten-1000)/3))<$moeglich) and $koloschalter) { $moeglich=floor(($kolonisten-1000)/3); }
        if ((floor($cantox/13))<$moeglich) { $moeglich=floor($cantox/13); }
        if (((floor($lemin/2))<$moeglich) and $rohstoffschalter) { $moeglich=floor($lemin/2); }
        if (((floor($min1/4))<$moeglich) and $rohstoffschalter) { $moeglich=floor($min1/4); }
        if (((floor($min2/5))<$moeglich) and $rohstoffschalter) { $moeglich=floor($min2/5); }
        if (($min3<$moeglich) and $rohstoffschalter) { $moeglich=$min3; }
        if ($bauen>$moeglich) {
            $bauen=$moeglich;
        }
        $schwerebt_bau=$schwerebt_bau+$bauen;
        if($koloschalter){
            $kolonisten=$kolonisten-($bauen*3);
            if ($kolonisten<1000) {
                $kolonisten=1000;
            }
        }
        $cantox=$cantox-($bauen*13);
        if($rohstoffschalter) { 
            $lemin=$lemin-($bauen*2);
            $min1=$min1-($bauen*4);
            $min2=$min2-($bauen*5);
            $min3=$min3-($bauen);
        }
        $zeiger_temp = @mysql_query("UPDATE $skrupel_planeten set schwerebt_bau=$schwerebt_bau,cantox=$cantox,min1=$min1,min2=$min2,min3=$min3,kolonisten=$kolonisten,lemin=$lemin where besitzer=$spieler and id=".$pid);
        $message="<center>".str_replace(array('{1}'),array($bauen),$lang['planetenalpha']['ausbildungneuschwer'])."</center>";
    }
    ?>
    <body text="#000000" scroll="no" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <br><br>
        <?php echo $message?>
        <script language=JavaScript>
            var ant=parent.planeten.document.getElementById('cantox');
            ant.innerHTML='<?php echo $cantox; ?>';
            var ant=parent.planeten.document.getElementById('min1');
            ant.innerHTML='<?php echo $min1; ?>';
            var ant=parent.planeten.document.getElementById('min2');
            ant.innerHTML='<?php echo $min2; ?>';
            var ant=parent.planeten.document.getElementById('min3');
            ant.innerHTML='<?php echo $min3; ?>';
            var ant=parent.planeten.document.getElementById('lemin');
            ant.innerHTML='<?php echo $lemin; ?>';
            var ant=parent.planeten.document.getElementById('kolonisten');
            ant.innerHTML='<?php echo $kolonisten; ?>';
        </script>
        <?php
    include ("inc.footer.php");
}
if ($fuid==12) {
    include ("inc.header.php");
    $art=int_get('art');
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" scroll="auto" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <br>
        <script language="JavaScript">
            function check() {
                if(document.formular.stationsname.value == "") {
                    alert("<?php echo html_entity_decode($lang['planetenalpha']['bittename'])?>");
                    document.formular.stationsname.focus();
                    return false;
                }
                return true;
            }
        </script>
        <br>
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><form name="formular" method="post" action="planeten_alpha.php?fu=3&pid=<?php echo $pid?>&art=<?php echo $art?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>" onSubmit="return check();"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><center><?php echo $lang['planetenalpha']['stationsname']?></center></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4"><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><center><input type="text" name="stationsname" maxlength=20 style="width:165px;" class="eingabe" autocomplete="off"></center></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4"><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><center><input type="submit" name="submitbutton" value="<?php echo $lang['planetenalpha']['auftraggeben']?>" style="width:165px;"></center></td>
                    <td></form></td>
                </tr>
                <tr>
                    <td colspan="4"><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                </tr>
            </table>
        </center>
        <script language=JavaScript>
            document.formular.stationsname.focus();
        </script>
        <?php
    include ("inc.footer.php");
}
if ($fuid==13) {
    include ("inc.header.php");
    $s_zahl=0;
    $zeiger = @mysql_query("SELECT * FROM $skrupel_planeten where id=$pid");
    $array = @mysql_fetch_array($zeiger);
    $x_pos=$array["x_pos"];
    $y_pos=$array["y_pos"];
    $besitzer=$array["besitzer"];
    $osys_1=$array["osys_1"];
    $osys_2=$array["osys_2"];
    $osys_3=$array["osys_3"];
    $osys_4=$array["osys_4"];
    $osys_5=$array["osys_5"];
    $osys_6=$array["osys_6"];
    $sternenbasis_art=$array["sternenbasis"];
    if((($osys_1==8) or ($osys_2==8) or ($osys_3==8) or ($osys_4==8) or ($osys_5==8) or ($osys_6==8))and ($besitzer==$spieler)){
        $reichweite=53;
        if(($osys_1==13) or ($osys_2==13) or ($osys_3==13) or ($osys_4==13) or ($osys_5==13) or ($osys_6==13)){$reichweite=90;}
        if($sternenbasis_art>1){$reichweite=116;}
        $raumschiffe=0;
        //wenn das schiff absolute tarnung hat, dann ignorieren -> spione koennen nicht durch diese scanner erfasst werden
        $zeiger = @mysql_query("SELECT * FROM $skrupel_schiffe where sqrt(((kox-$x_pos)*(kox-$x_pos))+((koy-$y_pos)*(koy-$y_pos)))<=$reichweite and besitzer<>$spieler and tarnfeld<2 and spiel=$spiel order by id");
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
                $schiff_scan[$s_zahl][0]=$shid;
                $schiff_scan[$s_zahl][1]=$x_pos;
                $schiff_scan[$s_zahl][2]=$y_pos;
                $schiff_scan[$s_zahl][3]=$volk;
                $schiff_scan[$s_zahl][4]=$bild_klein;
                $schiff_scan[$s_zahl][5]=$antrieb;
                $schiff_scan[$s_zahl][6]=$klasse;
                $s_zahl++;
            }
        }
        ?>
        <body text="#000000" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <br>
            <?php 
            echo $schiffsanzahl;
            if ($s_zahl>=1) {
                ?>
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
                                            <td><img src="../daten/<?php echo $schiff_scan[$i][3]?>/bilder_schiffe/<?php echo $schiff_scan[$i][4]?>" border="0" height="50" width="75"></td>
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
                                            <td style="color:#aaaaaa;"><?php echo $lang['planetenalpha']['klasse']?></td>
                                            <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                            <td><?php echo $schiff_scan[$i][6]; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="color:#aaaaaa;"><?php echo $lang['planetenalpha']['koordinaten']?></td>
                                            <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                            <td><?php echo $schiff_scan[$i][1]."/".$schiff_scan[$i][2]; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="color:#aaaaaa;"><?php echo $lang['planetenalpha']['maxwarp']?></td>
                                            <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                            <td><?php echo $schiff_scan[$i][5]; ?></td>
                                        </tr>
                                    </table>
                                </td>
                                <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                                <td><form name="formular" method="post" action="flotte_beta.php?fu=3&shid=<?php echo $schiff_scan[$i][0]?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"></td>
                                <td><input type="submit" name="bla" value="<?php echo $lang['planetenalpha']['detailscan']?>" style="width:70px;"></td>
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
                <center><?php echo $lang['planetenalpha']['noscan']?></center>
                <?php
            }
        }
    include ("inc.footer.php");
}
