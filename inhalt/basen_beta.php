<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'basen_beta';
$fuid = int_get('fu');
$baid = int_get('baid');

if ($fuid==1) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_sternenbasen where besitzer=$spieler and status=1 and id=$baid");
    $array = @mysql_fetch_array($zeiger);
    $baid=$array["id"];
    $name=$array["name"];
    $x_pos=$array["x_pos"];
    $y_pos=$array["y_pos"];
    $rasse=$array["rasse"];
    $planetid=$array["planetid"];
    $schaden=$array["schaden"];
    $t_huelle=$array["t_huelle"];
    $t_antrieb=$array["t_antrieb"];
    $t_energie=$array["t_energie"];
    $t_explosiv=$array["t_explosiv"];
    $defense=$array["defense"];
    $jaeger=$array["jaeger"];
    $zeiger2 = @mysql_query("SELECT id,cantox,besitzer,min1,min2,min3 FROM $skrupel_planeten where besitzer=$spieler and id=$planetid");
    $array2 = @mysql_fetch_array($zeiger2);
    $pid=$array2["id"];
    $cantox=$array2["cantox"];
    $min1=$array2["min1"];
    $min2=$array2["min2"];
    $min3=$array2["min3"];
    $file='../daten/'.$rasse.'/schiffe.txt';
    $fp = @fopen("$file","r");
    if ($fp) {
        $zaehler=0;
        while (!feof ($fp)) {
            $buffer = @fgets($fp, 4096);
            $schiff[$zaehler]=$buffer;
            $zaehler++;
        }
        @fclose($fp);
    }
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" scroll="auto" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
        <script language=JavaScript>
            function schiffdetail(shid,volk) {
                oben=100;
                links=Math.ceil((screen.width-580)/2);
                window.open('hilfe_schiff.php?fu2='+shid+'&volk='+volk+'&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>','Hilfe','resizable=yes,scrollbars=no,width=580,height=180,top='+oben+',left='+links);
            }
        </script>
        <table border="0" cellspacing="0" cellpadding="2">
            <tr>
                <td colspan="10"><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><a href="javascript:hilfe(9);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                <td style="color:#aaaaaa;"><center><?php echo $lang['basenbeta']['tl']; ?></center></td>
                <td><center><img src="<?php echo $bildpfad; ?>/icons/cantox.gif" border="0" width="17" height="17"></center></td>
                <td><center><img src="<?php echo $bildpfad; ?>/icons/mineral_1.gif" border="0" width="17" height="17"></center></td>
                <td><center><img src="<?php echo $bildpfad; ?>/icons/mineral_2.gif" border="0" width="17" height="17"></center></td>
                <td><center><img src="<?php echo $bildpfad; ?>/icons/mineral_3.gif" border="0" width="17" height="17"></center></td>
                <td style="color:#aaaaaa;"><?php echo $lang['basenbeta']['lager']; ?></td>
                <td>&nbsp;</td>
            </tr>
            <?php
            for ($i=0;$i<$zaehler;$i++) {
                $schiffwert=explode(':',$schiff[$i]);
                if (($t_huelle<$schiffwert[2]) or ($cantox<$schiffwert[5]) or ($min1<$schiffwert[6])  or ($min2<$schiffwert[7])  or ($min3<$schiffwert[8])) {$ok=0;} else {$ok=1;}
                $anzahl=0;
                $zeiger = @mysql_query("SELECT count(*) as total FROM $skrupel_huellen where baid=$baid and klasse=$schiffwert[1]");
                $array = @mysql_fetch_array($zeiger);
                $anzahl=$array["total"];
                ?>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="18"></td>
                    <td>
                        <form name="formular" method="post" action="basen_beta.php?fu=2&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>">
                        <input type="hidden" name="schiffid" value="<?php echo $schiffwert[1]; ?>">
                    </td>
                    <td><nobr><a href="javascript:schiffdetail(<?php echo $schiffwert[1]; ?>, '<?php echo $rasse; ?>')" style="<?php if ($t_huelle<$schiffwert[2]) { echo 'color:#aaaaaa;'; } else {echo 'color:#ffffff;';} ?>;"><?php echo $schiffwert[0]; ?></a></nobr></td>
                    <td><center><?php echo $schiffwert[2]; ?></center></td>
                    <td style="color:#aaaaaa;"><center><?php echo $schiffwert[5]; ?></center></td>
                    <td style="color:#aaaaaa;"><center><?php echo $schiffwert[6]; ?></center></td>
                    <td style="color:#aaaaaa;"><center><?php echo $schiffwert[7]; ?></center></td>
                    <td style="color:#aaaaaa;"><center><?php echo $schiffwert[8]; ?></center></td>
                    <td <?php if ($anzahl==0) { echo 'style="color:#aaaaaa;"';} ?>><center><?php echo $anzahl; ?></center></td>
                    <td>
                        <?php 
                        if ($ok==1) {
                            ?>
                            <input type="submit" value="<?php echo $lang['basenbeta']['produzieren']; ?>" style="width:80px;">
                            <?php
                        } else {
                            ?>
                            &nbsp;
                            <?php
                        }
                        ?>
                    </td>
                    <td></form></td>
                </tr>
                <?php
            }
            if ($spieler_rasse=='kuatoh') {
                $zeiger = @mysql_query("SELECT * FROM $skrupel_konplaene where besitzer=$spieler and spiel=$spiel order by techlevel,klasse");
                $plananzahl = @mysql_num_rows($zeiger);
                if ($plananzahl>=1) {
                    for  ($i=0; $i<$plananzahl;$i++) {
                        $ok = @mysql_data_seek($zeiger,$i);
                        $array = @mysql_fetch_array($zeiger);
                        $konid=$array["id"];
                        $rasses=$array["rasse"];
                        $klasse=$array["klasse"];
                        $klasseid=$array["klasse_id"];
                        $techlevel=$array["techlevel"];
                        $sonstiges=$array["sonstiges"];
                        $schiffwert="";
                        $schiffwert=explode(':',$sonstiges);
                        if (($t_huelle<$techlevel) or ($cantox<$schiffwert[2]) or ($min1<$schiffwert[3])  or ($min2<$schiffwert[4])  or ($min3<$schiffwert[5])) {$ok=0;} else {$ok=1;}
                        $anzahl=0;
                        $zeiger2 = @mysql_query("SELECT count(*) as total FROM $skrupel_huellen where baid=$baid and klasse=$klasseid and rasse='$rasses'");
                        $array2 = @mysql_fetch_array($zeiger2);
                        $anzahl=$array2["total"];
                        ?>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="1" height="18"></td>
                            <td>
                                <form name="formular" method="post" action="basen_beta.php?fu=9&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>">
                                <input type="hidden" name="schiffid" value="<?php echo $konid; ?>">
                            </td>
                            <td><nobr><a href="javascript:schiffdetail(<?php echo $klasseid; ?>,'<?php echo $rasses; ?>');" style="<?php if ($t_huelle<$techlevel) { echo 'color:#aaaaaa;'; } else {echo 'color:#ffffff;';} ?>;"><?php echo $klasse; ?></a></nobr></td>
                            <td><center><?php echo $techlevel; ?></center></td>
                            <td style="color:#aaaaaa;"><center><?php echo $schiffwert[2]; ?></center></td>
                            <td style="color:#aaaaaa;"><center><?php echo $schiffwert[3]; ?></center></td>
                            <td style="color:#aaaaaa;"><center><?php echo $schiffwert[4]; ?></center></td>
                            <td style="color:#aaaaaa;"><center><?php echo $schiffwert[5]; ?></center></td>
                            <td <?php if ($anzahl==0) { echo 'style="color:#aaaaaa;"';} ?>><center><?php echo $anzahl; ?></center></td>
                            <td>
                                <?php
                                if ($ok==1) {
                                    ?>
                                    <input type="submit" value="<?php echo $lang['basenbeta']['produzieren']; ?>" style="width:80px;">
                                    <?php
                                } else {
                                    ?>
                                    &nbsp;
                                    <?php
                                }
                                ?>
                            </td>
                            <td></form></td>
                        </tr>
                        <?php
                    }
                }
            }
            ?>
        </table>
        </div>
        <?php
    include ("inc.footer.php");
}
if ($fuid==2) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_sternenbasen where besitzer=$spieler and status=1 and id=$baid");
    $array = @mysql_fetch_array($zeiger);
    $baid=$array["id"];
    $name=$array["name"];
    $x_pos=$array["x_pos"];
    $y_pos=$array["y_pos"];
    $rasse=$array["rasse"];
    $planetid=$array["planetid"];
    $schaden=$array["schaden"];
    $t_huelle=$array["t_huelle"];
    $t_antrieb=$array["t_antrieb"];
    $t_energie=$array["t_energie"];
    $t_explosiv=$array["t_explosiv"];
    $defense=$array["defense"];
    $jaeger=$array["jaeger"];
    $zeiger2 = @mysql_query("SELECT id,cantox,besitzer,min1,min2,min3 FROM $skrupel_planeten where besitzer=$spieler and id=$planetid");
    $array2 = @mysql_fetch_array($zeiger2);
    $pid=$array2["id"];
    $cantox=$array2["cantox"];
    $min1=$array2["min1"];
    $min2=$array2["min2"];
    $min3=$array2["min3"];
    $file='../daten/'.$rasse.'/schiffe.txt';
    $fp = @fopen("$file","r");
    if ($fp) {
        $zaehler=0;
        while (!feof ($fp)) {
            $buffer = @fgets($fp, 4096);
            $schiff[$zaehler]=$buffer;
            $zaehler++;
        }
        @fclose($fp);
    }
    for ($i=0;$i<$zaehler;$i++) {
        $schiffwert=explode(':',$schiff[$i]);
        if ($schiffwert[1]==int_post('schiffid')) {
            if (($cantox>=$schiffwert[5]) and ($min1>=$schiffwert[6]) and ($min2>=$schiffwert[7]) and ($min3>=$schiffwert[8] and ($schiffwert[2]<=$t_huelle))) {
                $cantox=$cantox-$schiffwert[5];
                $min1=$min1-$schiffwert[6];
                $min2=$min2-$schiffwert[7];
                $min3=$min3-$schiffwert[8];
                $zeiger_temp = @mysql_query("UPDATE $skrupel_planeten set cantox=$cantox,min1=$min1,min2=$min2,min3=$min3 where besitzer=$spieler and id=$planetid");
                $zeiger_temp = @mysql_query("INSERT INTO $skrupel_huellen (spiel,baid,klasse,bild_gross,bild_klein,crew,masse,tank,fracht,antriebe,energetik,projektile,hangar,klasse_name,rasse,fertigkeiten,techlevel) values ($spiel,$baid,$schiffwert[1],'$schiffwert[3]','$schiffwert[4]',$schiffwert[15],$schiffwert[16],$schiffwert[13],$schiffwert[12],$schiffwert[14],$schiffwert[9],$schiffwert[10],$schiffwert[11],'$schiffwert[0]','$rasse','$schiffwert[17]',$schiffwert[2])");
                $message=str_replace('{1}',$schiffwert[0],$lang['basenbeta']['huelleerfolgreichproduziert']);
                $message='<center><br>'.$message.'</center>';
            }
        }
    }
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" scroll="auto" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <br><br>
        <?php echo $message; ?>
        <script language=JavaScript>
            var ant=parent.planeten.document.getElementById('cantox');
            ant.innerHTML='<?php echo $cantox; ?>';
            var ant=parent.planeten.document.getElementById('min1');
            ant.innerHTML='<?php echo $min1; ?>';
            var ant=parent.planeten.document.getElementById('min2');
            ant.innerHTML='<?php echo $min2; ?>';
            var ant=parent.planeten.document.getElementById('min3');
            ant.innerHTML='<?php echo $min3; ?>';
        </script>
        <?php
    include ("inc.footer.php");
}
if ($fuid==3) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_sternenbasen where besitzer=$spieler and status=1 and id=$baid");
    $array = @mysql_fetch_array($zeiger);
    $baid=$array["id"];
    $name=$array["name"];
    $x_pos=$array["x_pos"];
    $y_pos=$array["y_pos"];
    $rasse=$array["rasse"];
    $planetid=$array["planetid"];
    $schaden=$array["schaden"];
    $t_huelle=$array["t_huelle"];
    $t_antrieb=$array["t_antrieb"];
    $t_energie=$array["t_energie"];
    $t_explosiv=$array["t_explosiv"];
    $defense=$array["defense"];
    $jaeger=$array["jaeger"];
    for($i=1;$i<10;$i++){
        $vorrat_antrieb[$i-1]=$array["vorrat_antrieb_".$i];
    }
    $zeiger2 = @mysql_query("SELECT id,cantox,besitzer,min1,min2,min3 FROM $skrupel_planeten where besitzer=$spieler and id=$planetid");
    $array2 = @mysql_fetch_array($zeiger2);
    $pid=$array2["id"];
    $cantox=$array2["cantox"];
    $min1=$array2["min1"];
    $min2=$array2["min2"];
    $min3=$array2["min3"];
    $name =    array($lang['basenbeta']['antriebe'][0],$lang['basenbeta']['antriebe'][1],$lang['basenbeta']['antriebe'][2],$lang['basenbeta']['antriebe'][3],$lang['basenbeta']['antriebe'][4],$lang['basenbeta']['antriebe'][5],$lang['basenbeta']['antriebe'][6],$lang['basenbeta']['antriebe'][7],$lang['basenbeta']['antriebe'][8]);    
    $kosten =    array(
                    array(1,2,3,10,25,58,165,212,317),
                    array (1,2,2,3,3,3,3,13,17),
                    array (5,5,3,3,3,4,5,3,3),
                    array (0,1,5,7,7,15,15,28,35)
                );
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" scroll="auto" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
        <script language=JavaScript>
            function antriebdetail(aid) {
                oben=100;
                links=Math.ceil((screen.width-580)/2);
                window.open('hilfe_antriebe.php?fu2='+aid+'&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>','Hilfe','resizable=yes,scrollbars=no,width=580,height=180,top='+oben+',left='+links);
            }
        </script>
        <table border="0" cellspacing="0" cellpadding="2">
            <tr>
                <td colspan="10"><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><a href="javascript:hilfe(11);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                <td style="color:#aaaaaa;"><center><?php echo $lang['basenbeta']['tl']; ?></center></td>
                <td><center><img src="<?php echo $bildpfad; ?>/icons/cantox.gif" border="0" width="17" height="17"></center></td>
                <td><center><img src="<?php echo $bildpfad; ?>/icons/mineral_1.gif" border="0" width="17" height="17"></center></td>
                <td><center><img src="<?php echo $bildpfad; ?>/icons/mineral_2.gif" border="0" width="17" height="17"></center></td>
                <td><center><img src="<?php echo $bildpfad; ?>/icons/mineral_3.gif" border="0" width="17" height="17"></center></td>
                <td style="color:#aaaaaa;"><?php echo $lang['basenbeta']['lager']; ?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <?php
            $j=0;
            for($i=1;$i<10;$i++){
                if ($i==8) { $j=1; }
                ?>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="18"></td>
                    <td>
                        <form name="formular" method="post" action="basen_beta.php?fu=4&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>">
                        <input type="hidden" name="stufe" value="<?php echo $i?>">
                    </td>
                    <td><a href="javascript:antriebdetail(<?php echo $i?>);" <?php if ($t_antrieb<1) { echo "style=\"color:#aaaaaa;\""; } else { echo "style=\"color:#ffffff;\""; } ?>><nobr><?php echo $name[$i-1]; ?></nobr></a></td>
                    <td><center><?php echo $i+$j?></center></td>
                    <td style="color:#aaaaaa;"><center><?php echo $kosten[0][$i-1]?></center></td>
                    <td style="color:#aaaaaa;"><center><?php echo $kosten[1][$i-1]?></center></td>
                    <td style="color:#aaaaaa;"><center><?php echo $kosten[2][$i-1]?></center></td>
                    <td style="color:#aaaaaa;"><center><?php echo $kosten[3][$i-1]?></center></td>
                    <td <?php if ($vorrat_antrieb_1==0) { echo 'style="color:#aaaaaa;"';} ?>><center><?php echo $vorrat_antrieb[$i-1]; ?></center></td>
                    <?php
                    if (($cantox>=$kosten[0][$i-1]) and ($t_antrieb>=$i+$j) and ($min1>=$kosten[1][$i-1]) and ($min2>=$kosten[2][$i-1]) and ($min3>=$kosten[3][$i-1])) {
                        ?>
                        <td>
                            <select name="anzahl" style="width:40px;">
                                <?php
                                for ($kn=1;$kn<11;$kn++) {
                                    if (($cantox>=$kosten[0][$i-1]*$kn) and ($min1>=$kosten[1][$i-1]*$kn) and ($min2>=$kosten[2][$i-1]*$kn) and ($min3>=$kosten[3][$i-1]*$kn)) {
                                        ?>
                                        <option value="<?php echo $kn; ?>"><?php echo $kn; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                        <td><input type="submit" value="<?php echo $lang['basenbeta']['produzieren']; ?>" style="width:80px;"></td>
                        <?php
                    } else {
                        ?>
                        <td>&nbsp;</td>
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
        </div>
        <?php
    include ("inc.footer.php");
}
if ($fuid==4) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_sternenbasen where besitzer=$spieler and status=1 and id=$baid");
    $array = @mysql_fetch_array($zeiger);
    $baid=$array["id"];
    $name=$array["name"];
    $x_pos=$array["x_pos"];
    $y_pos=$array["y_pos"];
    $rasse=$array["rasse"];
    $planetid=$array["planetid"];
    $schaden=$array["schaden"];
    $t_huelle=$array["t_huelle"];
    $t_antrieb=$array["t_antrieb"];
    $t_energie=$array["t_energie"];
    $t_explosiv=$array["t_explosiv"];
    $defense=$array["defense"];
    $jaeger=$array["jaeger"];
    $vorrat_antrieb_1=$array["vorrat_antrieb_1"];
    $vorrat_antrieb_2=$array["vorrat_antrieb_2"];
    $vorrat_antrieb_3=$array["vorrat_antrieb_3"];
    $vorrat_antrieb_4=$array["vorrat_antrieb_4"];
    $vorrat_antrieb_5=$array["vorrat_antrieb_5"];
    $vorrat_antrieb_6=$array["vorrat_antrieb_6"];
    $vorrat_antrieb_7=$array["vorrat_antrieb_7"];
    $vorrat_antrieb_8=$array["vorrat_antrieb_8"];
    $vorrat_antrieb_9=$array["vorrat_antrieb_9"];
    $zeiger2 = @mysql_query("SELECT id,cantox,besitzer,min1,min2,min3 FROM $skrupel_planeten where besitzer=$spieler and id=$planetid");
    $array2 = @mysql_fetch_array($zeiger2);
    $pid=$array2["id"];
    $cantox=$array2["cantox"];
    $min1=$array2["min1"];
    $min2=$array2["min2"];
    $min3=$array2["min3"];
    $kosten = array (0,1,2,3,10,25,58,165,212,317);
    $antriebname = array ("",$lang['basenbeta']['antriebe'][0],$lang['basenbeta']['antriebe'][1],$lang['basenbeta']['antriebe'][2],$lang['basenbeta']['antriebe'][3],$lang['basenbeta']['antriebe'][4],$lang['basenbeta']['antriebe'][5],$lang['basenbeta']['antriebe'][6],$lang['basenbeta']['antriebe'][7],$lang['basenbeta']['antriebe'][8]);
    $minkosten_1 = array (0,1,2,2,3,3,3,3,13,17);
    $minkosten_2 = array (0,5,5,3,3,3,4,5,3,3);
    $minkosten_3 = array (0,0,1,5,7,7,15,15,28,35);
    $anzahl=int_post('anzahl');
    $stufe=int_post('stufe');
    if (($cantox>=$kosten[$stufe]*$anzahl) and ($min1>=$minkosten_1[$stufe]*$anzahl) and ($min2>=$minkosten_2[$stufe]*$anzahl) and ($min3>=$minkosten_3[$stufe]*$anzahl) and ((($stufe<8) and ($stufe<=$t_antrieb)) or (($stufe>7) and ($stufe<$t_antrieb)))) {
        $cantox=$cantox-($kosten[$stufe]*$anzahl);
        $min1=$min1-($minkosten_1[$stufe]*$anzahl);
        $min2=$min2-($minkosten_2[$stufe]*$anzahl);
        $min3=$min3-($minkosten_3[$stufe]*$anzahl);
        if ($stufe==1) { $vorrat_antrieb_1=$vorrat_antrieb_1+$anzahl;
        }elseif ($stufe==2) { $vorrat_antrieb_2=$vorrat_antrieb_2+$anzahl;
        }elseif ($stufe==3) { $vorrat_antrieb_3=$vorrat_antrieb_3+$anzahl;
        }elseif ($stufe==4) { $vorrat_antrieb_4=$vorrat_antrieb_4+$anzahl;
        }elseif ($stufe==5) { $vorrat_antrieb_5=$vorrat_antrieb_5+$anzahl;
        }elseif ($stufe==6) { $vorrat_antrieb_6=$vorrat_antrieb_6+$anzahl;
        }elseif ($stufe==7) { $vorrat_antrieb_7=$vorrat_antrieb_7+$anzahl;
        }elseif ($stufe==8) { $vorrat_antrieb_8=$vorrat_antrieb_8+$anzahl;
        }elseif ($stufe==9) { $vorrat_antrieb_9=$vorrat_antrieb_9+$anzahl;}
        $zeiger_temp = @mysql_query("UPDATE $skrupel_planeten set cantox=$cantox,min1=$min1,min2=$min2,min3=$min3 where besitzer=$spieler and id=$planetid");
        $zeiger_temp = @mysql_query("UPDATE $skrupel_sternenbasen set vorrat_antrieb_1=$vorrat_antrieb_1,vorrat_antrieb_2=$vorrat_antrieb_2,vorrat_antrieb_3=$vorrat_antrieb_3,vorrat_antrieb_4=$vorrat_antrieb_4,vorrat_antrieb_5=$vorrat_antrieb_5,vorrat_antrieb_6=$vorrat_antrieb_6,vorrat_antrieb_7=$vorrat_antrieb_7,vorrat_antrieb_8=$vorrat_antrieb_8,vorrat_antrieb_9=$vorrat_antrieb_9 where besitzer=$spieler and id=$baid");
        $aname=$antriebname[$stufe];
        $message=str_replace(array('{1}','{2}'),array($aname,$anzahl),$lang['basenbeta']['antrieberfolgreichproduziert']);
        $message='<center>'.$message.'</center>';
    }
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" scroll="auto" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <br><br><br>
        <?php echo $message; ?>
        <script language=JavaScript>
            var ant=parent.planeten.document.getElementById('cantox');
            ant.innerHTML='<?php echo $cantox; ?>';
            var ant=parent.planeten.document.getElementById('min1');
            ant.innerHTML='<?php echo $min1; ?>';
            var ant=parent.planeten.document.getElementById('min2');
            ant.innerHTML='<?php echo $min2; ?>';
            var ant=parent.planeten.document.getElementById('min3');
            ant.innerHTML='<?php echo $min3; ?>';
        </script>
        <?php
    include ("inc.footer.php");
}
if ($fuid==5) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_sternenbasen where besitzer=$spieler and status=1 and id=$baid");
    $array = @mysql_fetch_array($zeiger);
    $baid=$array["id"];
    $name=$array["name"];
    $x_pos=$array["x_pos"];
    $y_pos=$array["y_pos"];
    $rasse=$array["rasse"];
    $planetid=$array["planetid"];
    $schaden=$array["schaden"];
    $t_huelle=$array["t_huelle"];
    $t_antrieb=$array["t_antrieb"];
    $t_energie=$array["t_energie"];
    $t_explosiv=$array["t_explosiv"];
    $defense=$array["defense"];
    $jaeger=$array["jaeger"];
    $vorrat_energetik_1=$array["vorrat_energetik_1"];
    $vorrat_energetik_2=$array["vorrat_energetik_2"];
    $vorrat_energetik_3=$array["vorrat_energetik_3"];
    $vorrat_energetik_4=$array["vorrat_energetik_4"];
    $vorrat_energetik_5=$array["vorrat_energetik_5"];
    $vorrat_energetik_6=$array["vorrat_energetik_6"];
    $vorrat_energetik_7=$array["vorrat_energetik_7"];
    $vorrat_energetik_8=$array["vorrat_energetik_8"];
    $vorrat_energetik_9=$array["vorrat_energetik_9"];
    $vorrat_energetik_10=$array["vorrat_energetik_10"];
    $zeiger2 = @mysql_query("SELECT id,cantox,besitzer,min1,min2,min3 FROM $skrupel_planeten where besitzer=$spieler and id=$planetid");
    $array2 = @mysql_fetch_array($zeiger2);
    $pid=$array2["id"];
    $cantox=$array2["cantox"];
    $min1=$array2["min1"];
    $min2=$array2["min2"];
    $min3=$array2["min3"];
    $kosten = array (0,1,2,5,10,12,13,31,35,36,54);
    $techlevel = array (0,1,1,2,3,4,5,6,7,8,10);
    $waffen = array ("",$lang['basenbeta']['waffen'][0],$lang['basenbeta']['waffen'][1],$lang['basenbeta']['waffen'][2],$lang['basenbeta']['waffen'][3],$lang['basenbeta']['waffen'][4],$lang['basenbeta']['waffen'][5],$lang['basenbeta']['waffen'][6],$lang['basenbeta']['waffen'][7],$lang['basenbeta']['waffen'][8],$lang['basenbeta']['waffen'][9]);
    $minkosten_1 = array (0,0,0,2,12,12,12,12,12,18,12);
    $minkosten_2 = array (0,1,1,1,1,1,1,1,1,1,1);
    $minkosten_3 = array (0,0,0,0,1,5,1,14,30,38,57);
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" scroll="auto" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
        <table border="0" cellspacing="0" cellpadding="2">
            <tr>
                <td colspan="10"><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><a href="javascript:hilfe(12);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                <td style="color:#aaaaaa;"><center><?php echo $lang['basenbeta']['tl']; ?></center></td>
                <td><center><img src="<?php echo $bildpfad; ?>/icons/cantox.gif" border="0" width="17" height="17"></center></td>
                <td><center><img src="<?php echo $bildpfad; ?>/icons/mineral_1.gif" border="0" width="17" height="17"></center></td>
                <td><center><img src="<?php echo $bildpfad; ?>/icons/mineral_2.gif" border="0" width="17" height="17"></center></td>
                <td><center><img src="<?php echo $bildpfad; ?>/icons/mineral_3.gif" border="0" width="17" height="17"></center></td>
                <td style="color:#aaaaaa;"><?php echo $lang['basenbeta']['lager']; ?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <?php  for($n=1;$n<11;$n++){
                if ($n==1) {$var_wert=$vorrat_energetik_1;
                }elseif ($n==2) {$var_wert=$vorrat_energetik_2;
                }elseif ($n==3) {$var_wert=$vorrat_energetik_3;
                }elseif ($n==4) {$var_wert=$vorrat_energetik_4;
                }elseif ($n==5) {$var_wert=$vorrat_energetik_5;
                }elseif ($n==6) {$var_wert=$vorrat_energetik_6;
                }elseif ($n==7) {$var_wert=$vorrat_energetik_7;
                }elseif ($n==8) {$var_wert=$vorrat_energetik_8;
                }elseif ($n==9) {$var_wert=$vorrat_energetik_9;
                }elseif ($n==10) {$var_wert=$vorrat_energetik_10;}
                ?>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="18"></td>
                    <td>
                        <form name="formular" method="post" action="basen_beta.php?fu=6&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>">
                        <input type="hidden" name="stufe" value="<?php echo $n; ?>">
                    </td>
                    <td <?php if ($t_energie<$techlevel["$n"]) { echo 'style="color:#aaaaaa;"'; }?>><nobr><?php echo $waffen["$n"]; ?></nobr></td>
                    <td><center><?php echo $techlevel["$n"]; ?></center></td>
                    <td style="color:#aaaaaa;"><center><?php echo $kosten["$n"]; ?></center></td>
                    <td style="color:#aaaaaa;"><center><?php echo $minkosten_1["$n"]; ?></center></td>
                    <td style="color:#aaaaaa;"><center><?php echo $minkosten_2["$n"]; ?></center></td>
                    <td style="color:#aaaaaa;"><center><?php echo $minkosten_3["$n"]; ?></center></td>
                    <td <?php if ($var_wert==0) { echo 'style="color:#aaaaaa;"';} ?>><center><?php echo $var_wert; ?></center></td>
                    <?php
                    if (($cantox>=$kosten["$n"]) and ($t_energie>=$techlevel["$n"]) and ($min1>=$minkosten_1["$n"]) and ($min2>=$minkosten_2["$n"]) and ($min3>=$minkosten_3["$n"])) {
                        ?>
                        <td>
                            <select name="anzahl" style="width:40px;">
                                <?php
                                for ($kn=1;$kn<11;$kn++) {
                                    if (($cantox>=$kosten[$n]*$kn) and ($min1>=$minkosten_1[$n]*$kn) and ($min2>=$minkosten_2[$n]*$kn) and ($min3>=$minkosten_3[$n]*$kn)) {
                                        ?>
                                        <option value="<?php echo $kn; ?>"><?php echo $kn; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                        <td><input type="submit" value="<?php echo $lang['basenbeta']['produzieren']; ?>" style="width:80px;"></td>
                    <?php } else { ?>
                        <td>&nbsp;</td>
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
        </div>
        <?php
    include ("inc.footer.php");
}
if ($fuid==6) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_sternenbasen where besitzer=$spieler and status=1 and id=$baid");
    $array = @mysql_fetch_array($zeiger);
    $baid=$array["id"];
    $name=$array["name"];
    $x_pos=$array["x_pos"];
    $y_pos=$array["y_pos"];
    $rasse=$array["rasse"];
    $planetid=$array["planetid"];
    $schaden=$array["schaden"];
    $t_huelle=$array["t_huelle"];
    $t_antrieb=$array["t_antrieb"];
    $t_energie=$array["t_energie"];
    $t_explosiv=$array["t_explosiv"];
    $defense=$array["defense"];
    $jaeger=$array["jaeger"];
    $vorrat_energetik_1=$array["vorrat_energetik_1"];
    $vorrat_energetik_2=$array["vorrat_energetik_2"];
    $vorrat_energetik_3=$array["vorrat_energetik_3"];
    $vorrat_energetik_4=$array["vorrat_energetik_4"];
    $vorrat_energetik_5=$array["vorrat_energetik_5"];
    $vorrat_energetik_6=$array["vorrat_energetik_6"];
    $vorrat_energetik_7=$array["vorrat_energetik_7"];
    $vorrat_energetik_8=$array["vorrat_energetik_8"];
    $vorrat_energetik_9=$array["vorrat_energetik_9"];
    $vorrat_energetik_10=$array["vorrat_energetik_10"];
    $zeiger2 = @mysql_query("SELECT id,cantox,besitzer,min1,min2,min3 FROM $skrupel_planeten where besitzer=$spieler and id=$planetid");
    $array2 = @mysql_fetch_array($zeiger2);
    $pid=$array2["id"];
    $cantox=$array2["cantox"];
    $min1=$array2["min1"];
    $min2=$array2["min2"];
    $min3=$array2["min3"];
    $kosten = array (0,1,2,5,10,12,13,31,35,36,54);
    $techlevel = array (0,1,1,2,3,4,5,6,7,8,10);
    $waffen = array ("",$lang['basenbeta']['waffen'][0],$lang['basenbeta']['waffen'][1],$lang['basenbeta']['waffen'][2],$lang['basenbeta']['waffen'][3],$lang['basenbeta']['waffen'][4],$lang['basenbeta']['waffen'][5],$lang['basenbeta']['waffen'][6],$lang['basenbeta']['waffen'][7],$lang['basenbeta']['waffen'][8],$lang['basenbeta']['waffen'][9]);
    $minkosten_1 = array (0,0,0,2,12,12,12,12,12,18,12);
    $minkosten_2 = array (0,1,1,1,1,1,1,1,1,1,1);
    $minkosten_3 = array (0,0,0,0,1,5,1,14,30,38,57);
    $anzahl=int_post('anzahl');
    $stufe=int_post('stufe');
    if (($cantox>=$kosten[$stufe]*$anzahl) and ($min1>=$minkosten_1[$stufe]*$anzahl) and ($min2>=$minkosten_2[$stufe]*$anzahl) and ($min3>=$minkosten_3[$stufe]*$anzahl) and ($techlevel[$stufe]<=$t_energie)) {
        $cantox=$cantox-($kosten[$stufe]*$anzahl);
        $min1=$min1-($minkosten_1[$stufe]*$anzahl);
        $min2=$min2-($minkosten_2[$stufe]*$anzahl);
        $min3=$min3-($minkosten_3[$stufe]*$anzahl);
        if ($stufe==1) { $vorrat_energetik_1=$vorrat_energetik_1+$anzahl;
        }elseif ($stufe==2) { $vorrat_energetik_2=$vorrat_energetik_2+$anzahl;
        }elseif ($stufe==3) { $vorrat_energetik_3=$vorrat_energetik_3+$anzahl;
        }elseif ($stufe==4) { $vorrat_energetik_4=$vorrat_energetik_4+$anzahl;
        }elseif ($stufe==5) { $vorrat_energetik_5=$vorrat_energetik_5+$anzahl;
        }elseif ($stufe==6) { $vorrat_energetik_6=$vorrat_energetik_6+$anzahl;
        }elseif ($stufe==7) { $vorrat_energetik_7=$vorrat_energetik_7+$anzahl;
        }elseif ($stufe==8) { $vorrat_energetik_8=$vorrat_energetik_8+$anzahl;
        }elseif ($stufe==9) { $vorrat_energetik_9=$vorrat_energetik_9+$anzahl;
        }elseif ($stufe==10) { $vorrat_energetik_10=$vorrat_energetik_10+$anzahl;}
        $zeiger_temp = @mysql_query("UPDATE $skrupel_planeten set cantox=$cantox,min1=$min1,min2=$min2,min3=$min3 where besitzer=$spieler and id=$planetid");
        $zeiger_temp = @mysql_query("UPDATE $skrupel_sternenbasen set vorrat_energetik_1=$vorrat_energetik_1,vorrat_energetik_2=$vorrat_energetik_2,vorrat_energetik_3=$vorrat_energetik_3,vorrat_energetik_4=$vorrat_energetik_4,vorrat_energetik_5=$vorrat_energetik_5,vorrat_energetik_6=$vorrat_energetik_6,vorrat_energetik_7=$vorrat_energetik_7,vorrat_energetik_8=$vorrat_energetik_8,vorrat_energetik_9=$vorrat_energetik_9,vorrat_energetik_10=$vorrat_energetik_10 where besitzer=$spieler and id=$baid");
        $message=str_replace(array('{1}','{2}'),array($waffen[$stufe],$anzahl),$lang['basenbeta']['energetikerfolgreichproduziert']);
        $message='<center>'.$message.'</center>';
    }
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" scroll="auto" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <br><br>
        <?php echo $message; ?>
        <script language=JavaScript>
            var ant=parent.planeten.document.getElementById('cantox');
            ant.innerHTML='<?php echo $cantox; ?>';
            var ant=parent.planeten.document.getElementById('min1');
            ant.innerHTML='<?php echo $min1; ?>';
            var ant=parent.planeten.document.getElementById('min2');
            ant.innerHTML='<?php echo $min2; ?>';
            var ant=parent.planeten.document.getElementById('min3');
            ant.innerHTML='<?php echo $min3; ?>';
        </script>
        <?php
    include ("inc.footer.php");
}
if ($fuid==7) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_sternenbasen where besitzer=$spieler and status=1 and id=$baid");
    $array = @mysql_fetch_array($zeiger);
    $baid=$array["id"];
    $name=$array["name"];
    $x_pos=$array["x_pos"];
    $y_pos=$array["y_pos"];
    $rasse=$array["rasse"];
    $planetid=$array["planetid"];
    $schaden=$array["schaden"];
    $t_huelle=$array["t_huelle"];
    $t_antrieb=$array["t_antrieb"];
    $t_energie=$array["t_energie"];
    $t_explosiv=$array["t_explosiv"];
    $defense=$array["defense"];
    $jaeger=$array["jaeger"];
    $vorrat_projektile_1=$array["vorrat_projektile_1"];
    $vorrat_projektile_2=$array["vorrat_projektile_2"];
    $vorrat_projektile_3=$array["vorrat_projektile_3"];
    $vorrat_projektile_4=$array["vorrat_projektile_4"];
    $vorrat_projektile_5=$array["vorrat_projektile_5"];
    $vorrat_projektile_6=$array["vorrat_projektile_6"];
    $vorrat_projektile_7=$array["vorrat_projektile_7"];
    $vorrat_projektile_8=$array["vorrat_projektile_8"];
    $vorrat_projektile_9=$array["vorrat_projektile_9"];
    $vorrat_projektile_10=$array["vorrat_projektile_10"];
    $zeiger2 = @mysql_query("SELECT id,cantox,besitzer,min1,min2,min3 FROM $skrupel_planeten where besitzer=$spieler and id=$planetid");
    $array2 = @mysql_fetch_array($zeiger2);
    $pid=$array2["id"];
    $cantox=$array2["cantox"];
    $min1=$array2["min1"];
    $min2=$array2["min2"];
    $min3=$array2["min3"];
    $kosten = array (0,1,2,4,10,12,13,31,35,36,54);
    $techlevel = array (0,1,2,3,3,4,5,6,7,8,10);
    $waffen = array ("",$lang['basenbeta']['waffen'][10],$lang['basenbeta']['waffen'][11],$lang['basenbeta']['waffen'][12],$lang['basenbeta']['waffen'][13],$lang['basenbeta']['waffen'][14],$lang['basenbeta']['waffen'][15],$lang['basenbeta']['waffen'][16],$lang['basenbeta']['waffen'][17],$lang['basenbeta']['waffen'][18],$lang['basenbeta']['waffen'][19]);
    $minkosten_1 = array (0,1,0,4,3,1,4,7,2,3,1);
    $minkosten_2 = array (0,1,1,1,1,1,1,1,1,1,1);
    $minkosten_3 = array (0,0,0,0,1,5,1,14,7,8,9);
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" scroll="auto" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
        <table border="0" cellspacing="0" cellpadding="2">
            <tr>
                <td colspan="10"><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><a href="javascript:hilfe(12);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                <td style="color:#aaaaaa;"><center><?php echo $lang['basenbeta']['tl']; ?></center></td>
                <td><center><img src="<?php echo $bildpfad; ?>/icons/cantox.gif" border="0" width="17" height="17"></center></td>
                <td><center><img src="<?php echo $bildpfad; ?>/icons/mineral_1.gif" border="0" width="17" height="17"></center></td>
                <td><center><img src="<?php echo $bildpfad; ?>/icons/mineral_2.gif" border="0" width="17" height="17"></center></td>
                <td><center><img src="<?php echo $bildpfad; ?>/icons/mineral_3.gif" border="0" width="17" height="17"></center></td>
                <td style="color:#aaaaaa;"><?php echo $lang['basenbeta']['lager']; ?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <?php
            for($n=1;$n<11;$n++) {
                if ($n==1) {$var_wert=$vorrat_projektile_1;
                }elseif ($n==2) {$var_wert=$vorrat_projektile_2;
                }elseif ($n==3) {$var_wert=$vorrat_projektile_3;
                }elseif ($n==4) {$var_wert=$vorrat_projektile_4;
                }elseif ($n==5) {$var_wert=$vorrat_projektile_5;
                }elseif ($n==6) {$var_wert=$vorrat_projektile_6;
                }elseif ($n==7) {$var_wert=$vorrat_projektile_7;
                }elseif ($n==8) {$var_wert=$vorrat_projektile_8;
                }elseif ($n==9) {$var_wert=$vorrat_projektile_9;
                }elseif ($n==10) {$var_wert=$vorrat_projektile_10;}
                ?>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="18"></td>
                    <td>
                        <form name="formular" method="post" action="basen_beta.php?fu=8&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>">
                        <input type="hidden" name="stufe" value="<?php echo $n; ?>"></td>
                    <td <?php if ($t_explosiv<$techlevel["$n"]) { echo 'style="color:#aaaaaa;"'; }?>><nobr><?php echo $waffen["$n"]; ?></nobr></td>
                    <td><center><?php echo $techlevel["$n"]; ?></center></td>
                    <td style="color:#aaaaaa;"><center><?php echo $kosten["$n"]; ?></center></td>
                    <td style="color:#aaaaaa;"><center><?php echo $minkosten_1["$n"]; ?></center></td>
                    <td style="color:#aaaaaa;"><center><?php echo $minkosten_2["$n"]; ?></center></td>
                    <td style="color:#aaaaaa;"><center><?php echo $minkosten_3["$n"]; ?></center></td>
                    <td <?php if ($var_wert==0) { echo 'style="color:#aaaaaa;"';} ?>><center><?php echo $var_wert; ?></center></td>
                    <?php
                    if (($cantox>=$kosten[$n]) and ($t_explosiv>=$techlevel[$n]) and ($min1>=$minkosten_1[$n]) and ($min2>=$minkosten_2[$n]) and ($min3>=$minkosten_3[$n])) {
                        ?>
                        <td>
                            <select name="anzahl" style="width:40px;">
                                <?php for ($kn=1;$kn<11;$kn++) {
                                    if (($cantox>=$kosten[$n]*$kn) and ($min1>=$minkosten_1[$n]*$kn) and ($min2>=$minkosten_2[$n]*$kn) and ($min3>=$minkosten_3[$n]*$kn)) {
                                        ?>
                                        <option value="<?php echo $kn; ?>"><?php echo $kn; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                        <td><input type="submit" value="<?php echo $lang['basenbeta']['produzieren']; ?>" style="width:80px;"></td>
                    <?php } else { ?>
                        <td>&nbsp;</td>
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
        </div>
        <?php
    include ("inc.footer.php");
}
if ($fuid==8) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_sternenbasen where besitzer=$spieler and status=1 and id=$baid");
    $array = @mysql_fetch_array($zeiger);
    $baid=$array["id"];
    $name=$array["name"];
    $x_pos=$array["x_pos"];
    $y_pos=$array["y_pos"];
    $rasse=$array["rasse"];
    $planetid=$array["planetid"];
    $schaden=$array["schaden"];
    $t_huelle=$array["t_huelle"];
    $t_antrieb=$array["t_antrieb"];
    $t_energie=$array["t_energie"];
    $t_explosiv=$array["t_explosiv"];
    $defense=$array["defense"];
    $jaeger=$array["jaeger"];
    $vorrat_projektile_1=$array["vorrat_projektile_1"];
    $vorrat_projektile_2=$array["vorrat_projektile_2"];
    $vorrat_projektile_3=$array["vorrat_projektile_3"];
    $vorrat_projektile_4=$array["vorrat_projektile_4"];
    $vorrat_projektile_5=$array["vorrat_projektile_5"];
    $vorrat_projektile_6=$array["vorrat_projektile_6"];
    $vorrat_projektile_7=$array["vorrat_projektile_7"];
    $vorrat_projektile_8=$array["vorrat_projektile_8"];
    $vorrat_projektile_9=$array["vorrat_projektile_9"];
    $vorrat_projektile_10=$array["vorrat_projektile_10"];
    $zeiger2 = @mysql_query("SELECT id,cantox,besitzer,min1,min2,min3 FROM $skrupel_planeten where besitzer=$spieler and id=$planetid");
    $array2 = @mysql_fetch_array($zeiger2);
    $pid=$array2["id"];
    $cantox=$array2["cantox"];
    $min1=$array2["min1"];
    $min2=$array2["min2"];
    $min3=$array2["min3"];
    $kosten = array (0,1,2,4,10,12,13,31,35,36,54);
    $techlevel = array (0,1,2,3,3,4,5,6,7,8,10);
    $waffen = array ("",$lang['basenbeta']['waffen'][10],$lang['basenbeta']['waffen'][11],$lang['basenbeta']['waffen'][12],$lang['basenbeta']['waffen'][13],$lang['basenbeta']['waffen'][14],$lang['basenbeta']['waffen'][15],$lang['basenbeta']['waffen'][16],$lang['basenbeta']['waffen'][17],$lang['basenbeta']['waffen'][18],$lang['basenbeta']['waffen'][19]);
    $minkosten_1 = array (0,1,0,4,3,1,4,7,2,3,1);
    $minkosten_2 = array (0,1,1,1,1,1,1,1,1,1,1);
    $minkosten_3 = array (0,0,0,0,1,5,1,14,7,8,9);
    $anzahl=int_post('anzahl');
    $stufe=int_post('stufe');
    if (($cantox>=$kosten[$stufe]*$anzahl) and ($min1>=$minkosten_1[$stufe]*$anzahl) and ($min2>=$minkosten_2[$stufe]*$anzahl) and ($min3>=$minkosten_3[$stufe]*$anzahl) and ($techlevel[$stufe]<=$t_explosiv)) {
        $cantox=$cantox-($kosten[$stufe]*$anzahl);
        $min1=$min1-($minkosten_1[$stufe]*$anzahl);
        $min2=$min2-($minkosten_2[$stufe]*$anzahl);
        $min3=$min3-($minkosten_3[$stufe]*$anzahl);
        if ($stufe==1) { $vorrat_projektile_1=$vorrat_projektile_1+$anzahl;
        }elseif ($stufe==2) { $vorrat_projektile_2=$vorrat_projektile_2+$anzahl;
        }elseif ($stufe==3) { $vorrat_projektile_3=$vorrat_projektile_3+$anzahl;
        }elseif ($stufe==4) { $vorrat_projektile_4=$vorrat_projektile_4+$anzahl;
        }elseif ($stufe==5) { $vorrat_projektile_5=$vorrat_projektile_5+$anzahl;
        }elseif ($stufe==6) { $vorrat_projektile_6=$vorrat_projektile_6+$anzahl;
        }elseif ($stufe==7) { $vorrat_projektile_7=$vorrat_projektile_7+$anzahl;
        }elseif ($stufe==8) { $vorrat_projektile_8=$vorrat_projektile_8+$anzahl;
        }elseif ($stufe==9) { $vorrat_projektile_9=$vorrat_projektile_9+$anzahl;
        }elseif ($stufe==10) { $vorrat_projektile_10=$vorrat_projektile_10+$anzahl;}
        $zeiger_temp = @mysql_query("UPDATE $skrupel_planeten set cantox=$cantox,min1=$min1,min2=$min2,min3=$min3 where besitzer=$spieler and id=$planetid");
        $zeiger_temp = @mysql_query("UPDATE $skrupel_sternenbasen set vorrat_projektile_1=$vorrat_projektile_1,vorrat_projektile_2=$vorrat_projektile_2,vorrat_projektile_3=$vorrat_projektile_3,vorrat_projektile_4=$vorrat_projektile_4,vorrat_projektile_5=$vorrat_projektile_5,vorrat_projektile_6=$vorrat_projektile_6,vorrat_projektile_7=$vorrat_projektile_7,vorrat_projektile_8=$vorrat_projektile_8,vorrat_projektile_9=$vorrat_projektile_9,vorrat_projektile_10=$vorrat_projektile_10 where besitzer=$spieler and id=$baid");
        $message=str_replace(array('{1}','{2}'),array($waffen[$stufe],$anzahl),$lang['basenbeta']['projektilerfolgreichproduziert']);
        $message='<center>'.$message.'</center>';
    }
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" scroll="no" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <br><br>
        <?php echo $message; ?>
        <script language=JavaScript>
            var ant=parent.planeten.document.getElementById('cantox');
            ant.innerHTML='<?php echo $cantox; ?>';
            var ant=parent.planeten.document.getElementById('min1');
            ant.innerHTML='<?php echo $min1; ?>';
            var ant=parent.planeten.document.getElementById('min2');
            ant.innerHTML='<?php echo $min2; ?>';
            var ant=parent.planeten.document.getElementById('min3');
            ant.innerHTML='<?php echo $min3; ?>';
        </script>
        <?php
    include ("inc.footer.php");
}
if ($fuid==9) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_sternenbasen where besitzer=$spieler and status=1 and id=$baid");
    $array = @mysql_fetch_array($zeiger);
    $baid=$array["id"];
    $name=$array["name"];
    $x_pos=$array["x_pos"];
    $y_pos=$array["y_pos"];
    $rasse=$array["rasse"];
    $planetid=$array["planetid"];
    $schaden=$array["schaden"];
    $t_huelle=$array["t_huelle"];
    $t_antrieb=$array["t_antrieb"];
    $t_energie=$array["t_energie"];
    $t_explosiv=$array["t_explosiv"];
    $defense=$array["defense"];
    $jaeger=$array["jaeger"];
    $zeiger2 = @mysql_query("SELECT id,cantox,besitzer,min1,min2,min3 FROM $skrupel_planeten where besitzer=$spieler and id=$planetid");
    $array2 = @mysql_fetch_array($zeiger2);
    $pid=$array2["id"];
    $cantox=$array2["cantox"];
    $min1=$array2["min1"];
    $min2=$array2["min2"];
    $min3=$array2["min3"];
    $zeiger3 = @mysql_query("SELECT * FROM $skrupel_konplaene where besitzer=$spieler and spiel=$spiel and id=".int_post('schiffid'));
    $array3 = @mysql_fetch_array($zeiger3);
    $konid=$array3["id"];
    $rasses=$array3["rasse"];
    $klasse=$array3["klasse"];
    $klasseid=$array3["klasse_id"];
    $techlevel=$array3["techlevel"];
    $sonstiges=$array3["sonstiges"];
    $schiffwert=explode(':',$sonstiges);
    if (($cantox>=$schiffwert[2]) and ($min1>=$schiffwert[3]) and ($min2>=$schiffwert[4]) and ($min3>=$schiffwert[5])) {
        $cantox=$cantox-$schiffwert[2];
        $min1=$min1-$schiffwert[3];
        $min2=$min2-$schiffwert[4];
        $min3=$min3-$schiffwert[5];
        $zeiger_temp = @mysql_query("UPDATE $skrupel_planeten set cantox=$cantox,min1=$min1,min2=$min2,min3=$min3 where besitzer=$spieler and id=$planetid");
        $zeiger_temp = @mysql_query("INSERT INTO $skrupel_huellen (spiel,baid,klasse,bild_gross,bild_klein,crew,masse,tank,fracht,antriebe,energetik,projektile,hangar,klasse_name,rasse,fertigkeiten,techlevel) values ($spiel,$baid,$klasseid,'$schiffwert[0]','$schiffwert[1]',$schiffwert[12],$schiffwert[13],$schiffwert[10],$schiffwert[9],$schiffwert[11],$schiffwert[6],$schiffwert[7],$schiffwert[8],'$klasse','$rasses','$schiffwert[14]',$techlevel)");
        $message=str_replace('{1}',$klasse,$lang['basenbeta']['huelleerfolgreichproduziert']);
        $message='<center><br>'.$message.'</center>';
    }
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" scroll="auto" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <br><br>
        <?php echo $message; ?>
        <script language=JavaScript>
            var ant=parent.planeten.document.getElementById('cantox');
            ant.innerHTML='<?php echo $cantox; ?>';
            var ant=parent.planeten.document.getElementById('min1');
            ant.innerHTML='<?php echo $min1; ?>';
            var ant=parent.planeten.document.getElementById('min2');
            ant.innerHTML='<?php echo $min2; ?>';
            var ant=parent.planeten.document.getElementById('min3');
            ant.innerHTML='<?php echo $min3; ?>';
        </script>
        <?php
    include ("inc.footer.php");
}
