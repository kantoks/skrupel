<?php
include ('../inc.conf.php');
include_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'basen_alpha';
$fuid = int_get('fu');
$baid = int_get('baid');

if ($fuid==1) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_sternenbasen where besitzer=$spieler and status=1 and id=$baid");
    $kosten_huelle = array ("0","100","300","600","1400","2400","3600","6100","11100","18600","28600");
    $kosten_antrieb = array ("0","100","300","600","1000","1500","2100","2800","6800","13800","23800");
    $kosten_energetik = array ("0","100","500","1400","3000","5500","9100","14000","20400","28500","38500");
    $kosten_explosiv = array ("0","100","500","1400","3000","5500","9100","14000","20400","28500","38500");
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
    $art=$array["art"];
    if (($art==0) or ($art==3)) {
        $zeiger = @mysql_query("SELECT id,cantox,besitzer FROM $skrupel_planeten where besitzer=$spieler and id=$planetid");
        $array = @mysql_fetch_array($zeiger);
        $pid=$array["id"];
        $cantox=$array["cantox"];
        ?>
        <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" scroll="auto" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <center>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="9"><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/huelle.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['basenalpha']['techlevelrumpf']; ?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="6" height="1"></td>
                        <td rowspan="2">
                            <form name="formular" method="post" action="basen_alpha.php?fu=2&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>">
                            <input type="hidden" name="antriebtl" value=0><input type="hidden" name="energietl" value=0><input type="hidden" name="huelletl" value=0><input type="hidden" name="explosivtl" value=0>
                            <?php
                            $schalter=0;
                            if(($cantox>=$kosten_huelle[$t_huelle+1]-$kosten_huelle[$t_huelle])&&($t_huelle<10)){
                                $schalter=1; ?>
                                <select name="huelletl" style="font-family:Verdana;font-size:9px;width:140px">
                                    <option value=0 > </option>
                                    <?php
                                     for($li=$t_huelle+1;$li<11;$li++){ 
                                        if($cantox>=$kosten_huelle[$li]-$kosten_huelle[$t_huelle]){?>
                                            <option value="<?php echo $li; ?>" ><?php echo $lang['basenalpha']['tl']?> <?php echo $li; ?>: <?php echo $kosten_huelle[$li]-$kosten_huelle[$t_huelle]; ?> <?php echo $lang['basenalpha']['cantox']?></option>
                                            <?php
                                        }
                                    }?>
                                </select>
                                <?php 
                            }
                            ?>
                        </td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                        <td rowspan="2"><a href="javascript:hilfe(1);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                        <td><?php echo $lang['basenalpha']['stufe']?> <?php echo $t_huelle; ?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/antrieb.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['basenalpha']['techlevelantrieb']; ?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                        <td rowspan="2">
                            <?php 
                            if(($cantox>=$kosten_antrieb[$t_antrieb+1]-$kosten_antrieb[$t_antrieb])&&($t_antrieb<10)){
                                $schalter=1;
                                ?>
                                <select name="antriebtl" style="font-family:Verdana;font-size:9px;width:140px">
                                    <option value=0 > </option>
                                    <?php
                                     for($li=$t_antrieb+1;$li<11;$li++){ 
                                        if($cantox>=$kosten_antrieb[$li]-$kosten_antrieb[$t_antrieb]){ 
                                            ?>
                                            <option value="<?php echo $li; ?>" ><?php echo $lang['basenalpha']['tl']?> <?php echo $li; ?>: <?php echo $kosten_antrieb[$li]-$kosten_antrieb[$t_antrieb]; ?> <?php echo $lang['basenalpha']['cantox']?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <?php
                            }
                            ?>
                        </td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                        <td rowspan="2"><a href="javascript:hilfe(2);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                        <td><?php echo $lang['basenalpha']['stufe']?> <?php echo $t_antrieb; ?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/laser.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['basenalpha']['techlevelenergetik']; ?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                        <td rowspan="2">
                            <?php
                            if(($cantox>=$kosten_energetik[$t_energie+1]-$kosten_energetik[$t_energie])&&($t_energie<10)){
                                $schalter=1;
                                ?>
                                <select name="energietl" style="font-family:Verdana;font-size:9px;width:140px">
                                    <option value=0 > </option>
                                    <?php
                                    for($li=$t_energie+1;$li<11;$li++){ 
                                        if($cantox>=$kosten_energetik[$li]-$kosten_energetik[$t_energie]){ 
                                            ?>
                                            <option value="<?php echo $li; ?>" ><?php echo $lang['basenalpha']['tl']?> <?php echo $li; ?>: <?php echo $kosten_energetik[$li]-$kosten_energetik[$t_energie]; ?> <?php echo $lang['basenalpha']['cantox']?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <?php
                            }
                            ?>
                        </td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                        <td rowspan="2"><a href="javascript:hilfe(3);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                        <td><?php echo $lang['basenalpha']['stufe']?> <?php echo $t_energie; ?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/projektil.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['basenalpha']['techlevelprojektile']; ?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                        <td rowspan="2">
                            <?php if(($cantox>=$kosten_explosiv[$t_explosiv+1]-$kosten_explosiv[$t_explosiv])&&($t_explosiv<10)){
                                $schalter=1;
                                ?>
                                <select name="explosivtl" style="font-family:Verdana;font-size:9px;width:140px">
                                    <option value=0 > </option>
                                        <?php
                                        for($li=$t_explosiv+1;$li<11;$li++){ 
                                            if($cantox>=$kosten_explosiv[$li]-$kosten_explosiv[$t_explosiv]){
                                                ?>
                                                <option value="<?php echo $li; ?>" ><?php echo $lang['basenalpha']['tl']?> <?php echo $li; ?>: <?php echo $kosten_explosiv[$li]-$kosten_explosiv[$t_explosiv]; ?> <?php echo $lang['basenalpha']['cantox']?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                </select>
                                <?php
                            }
                            ?>
                        </td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                        <td rowspan="2"><a href="javascript:hilfe(4);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                        <td colspan="15"></td>
                        <?php
                        if($schalter){
                            ?>
                            <td rowspan="2"><input type="submit" value="<?php echo $lang['basenalpha']['upgraden']; ?>"></td>
                            <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                        <td><?php echo $lang['basenalpha']['stufe']?> <?php echo $t_explosiv; ?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                        <td></form></td>
                    </tr>
                </table>
            </center>
            <?php
    }
    include ("inc.footer.php");
}
if ($fuid==2) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_sternenbasen where besitzer=$spieler and status=1 and id=$baid");
    $kosten_huelle = array ("0","100","300","600","1400","2400","3600","6100","11100","18600","28600");
    $kosten_antrieb = array ("0","100","300","600","1000","1500","2100","2800","6800","13800","23800");
    $kosten_energetik = array ("0","100","500","1400","3000","5500","9100","14000","20400","28500","38500");
    $kosten_explosiv = array ("0","100","500","1400","3000","5500","9100","14000","20400","28500","38500");
    $abwehrauftrag=int_post('explosivtl');
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
    $art=$array["art"];
    $message="";
    if (($art==0) or ($art==3)) {
        $zeiger = @mysql_query("SELECT id,cantox,besitzer FROM $skrupel_planeten where besitzer=$spieler and id=$planetid");
        $array = @mysql_fetch_array($zeiger);
        $pid=$array["id"];
        $cantox=$array["cantox"];
        $schalter=0;
        if($t_huelle<10){
            for($li=$t_huelle+1;$li<=int_post('huelletl');$li++){
                if ($cantox>=$kosten_huelle[$li]-$kosten_huelle[$li-1]) {
                    $minus=$kosten_huelle[$li]-$kosten_huelle[$li-1];
                    $zeiger_temp = @mysql_query("UPDATE $skrupel_planeten set cantox=cantox-$minus where besitzer=$spieler and id=$planetid");
                    $zeiger_temp = @mysql_query("UPDATE $skrupel_sternenbasen set t_huelle=t_huelle+1 where besitzer=$spieler and id=$baid");
                    $cantox=$cantox-$minus;
                    $t_huelle++;
                    $schalter=1;
                }
            }
        }
        if($schalter){
            $schalter=0;
            $message=$lang['basenalpha']['rumpferhoeht']."<br><br>";
        }
        if($t_antrieb<10){
            for($li=$t_antrieb+1;$li<=int_post('antriebtl');$li++){
                if ($cantox>=$kosten_antrieb[$li]-$kosten_antrieb[$li-1]) {
                    $minus=$kosten_antrieb[$li]-$kosten_antrieb[$li-1];
                    $zeiger_temp = @mysql_query("UPDATE $skrupel_planeten set cantox=cantox-$minus where besitzer=$spieler and id=$planetid");
                    $zeiger_temp = @mysql_query("UPDATE $skrupel_sternenbasen set t_antrieb=t_antrieb+1 where besitzer=$spieler and id=$baid");
                    $cantox=$cantox-$minus;
                    $t_antrieb++;
                    $schalter=1;
                }
            }
        }
        if($schalter){
            $schalter=0;
            $message=$message.$lang['basenalpha']['antrieberhoeht']."<br><br>";
        }
        if($t_energie<10){
            for($li=$t_energie+1;$li<=int_post('energietl');$li++){
                if ($cantox>=$kosten_energetik[$li]-$kosten_energetik[$li-1]) {
                    $minus=$kosten_energetik[$li]-$kosten_energetik[$li-1];
                    $zeiger_temp = @mysql_query("UPDATE $skrupel_planeten set cantox=cantox-$minus where besitzer=$spieler and id=$planetid");
                    $zeiger_temp = @mysql_query("UPDATE $skrupel_sternenbasen set t_energie=t_energie+1 where besitzer=$spieler and id=$baid");
                    $cantox=$cantox-$minus;
                    $t_energie++;
                    $schalter=1;
                }
            }
        }
        if($schalter){
            $schalter=0;
            $message=$message.$lang['basenalpha']['energetikerhoeht']."<br><br>";
        }
        if($t_explosiv<10){
            for($li=$t_explosiv+1;$li<=int_post('explosivtl');$li++){
                if ($cantox>=$kosten_explosiv[$li]-$kosten_explosiv[$li-1]) {
                    $minus=$kosten_explosiv[$li]-$kosten_explosiv[$li-1];
                    $zeiger_temp = @mysql_query("UPDATE $skrupel_planeten set cantox=cantox-$minus where besitzer=$spieler and id=$planetid");
                    $zeiger_temp = @mysql_query("UPDATE $skrupel_sternenbasen set t_explosiv=t_explosiv+1 where besitzer=$spieler and id=$baid");
                    $cantox=$cantox-$minus;
                    $t_explosiv++;
                    $schalter=1;
                }
            }
        }
        if($schalter){
            $schalter=0;
            $message=$message.$lang['basenalpha']['projektileerhoeht'];
        }
        ?>
        <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" scroll="auto" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <br><br><br>
            <?php echo $message; ?>
            <script language=JavaScript>
                var ant=parent.planeten.document.getElementById('cantox');
                ant.innerHTML='<?php echo $cantox; ?>';
                var ant=parent.planeten.document.getElementById('huelle');
                ant.innerHTML='<?php echo $t_huelle; ?>';
                var ant=parent.planeten.document.getElementById('antrieb');
                ant.innerHTML='<?php echo $t_antrieb; ?>';
                var ant=parent.planeten.document.getElementById('energie');
                ant.innerHTML='<?php echo $t_energie; ?>';
                var ant=parent.planeten.document.getElementById('explosiv');
                ant.innerHTML='<?php echo $t_explosiv; ?>';
            </script>
            <?php
    }
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
    $art=$array["art"];
    if (($art==0) or ($art==2) or ($art==3)) {
        if ($art==0) { $maxx=50; 
        }elseif ($art==2) { $maxx=110; 
        }elseif ($art==3) { $maxx=130; }
        $zeiger2 = @mysql_query("SELECT id,cantox,besitzer,min1,min2,min3 FROM $skrupel_planeten where besitzer=$spieler and id=$planetid");
        $array2 = @mysql_fetch_array($zeiger2);
        $pid=$array2["id"];
        $cantox=$array2["cantox"];
        $min1=$array2["min1"];
        $min2=$array2["min2"];
        $min3=$array2["min3"];
        $max_cantox=floor($cantox/10);
        $max_min2=$min2;
        $max_bau=$maxx-$defense;
        if ($max_cantox<$max_bau) {$max_bau=$max_cantox;}
        if ($max_min2<$max_bau) {$max_bau=$max_min2;}
        ?>
        <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" scroll="auto" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td colspan="10"><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td colspan="9"><?php echo $lang['basenalpha']['abwehranlagen']; ?></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/abwehr.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['basenalpha']['inbetrieb']; ?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['basenalpha']['maximal']; ?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                    <td rowspan="2"><a href="javascript:hilfe(10);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                    <td><?php echo $defense; ?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                    <td><?php echo $maxx; ?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                </tr>
                <tr>
                    <td colspan="10"><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                </tr>
            </table>
            <?php
            if ($max_bau>=1) {
                ?>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><form name="formular"  method="post" action="basen_alpha.php?fu=4&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td>
                            <select name="abwehrauftrag" style="font-family:Verdana;font-size:9px;width:50px;">
                                <?php
                                for ($i=1;$i<=$max_bau;$i++) {
                                    ?>
                                    <option value=<?php echo $i; ?> <?php if ($i==$max_bau) echo "selected"; ?>><?php echo $i; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><input type="submit" value="<?php echo $lang['basenalpha']['anlagenbauen']; ?>" style="width:110px;"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td></form></td>
                    </tr>
                    <tr>
                        <td colspan="7"><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                    </tr>
                </table>
                <?php
            }
    }
    include ("inc.footer.php");
}
if ($fuid==4) {
    include ("inc.header.php");
    $abwehrauftrag=int_post('abwehrauftrag');
    $zeiger = @mysql_query("SELECT * FROM $skrupel_sternenbasen WHERE besitzer=$spieler AND status=1 AND id=$baid");
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
    $art=$array["art"];
    if ($art==0 || $art==2 || $art==3) {
        $zeiger2 = @mysql_query("SELECT id,cantox,besitzer,min1,min2,min3 FROM $skrupel_planeten where besitzer=$spieler and id=$planetid");
        $array2 = @mysql_fetch_array($zeiger2);
        $pid=$array2['id'];
        $cantox=$array2['cantox'];
        $min1=$array2['min1'];
        $min2=$array2['min2'];
        $min3=$array2['min3'];
        $cantox=$cantox-($abwehrauftrag*10);
        $min2=$min2-$abwehrauftrag;
        $defense=$defense+$abwehrauftrag;
        $zeiger = @mysql_query("update $skrupel_planeten set cantox=$cantox,min2=$min2 where id=$pid and besitzer=$spieler");
        $zeiger = @mysql_query("update $skrupel_sternenbasen set defense=$defense where id=$baid and besitzer=$spieler");
        $message="<center>".$abwehrauftrag." ".$lang['basenalpha']['anlagengebaut']."</center>";
        ?>
        <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" scroll="auto" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <br><br>
            <?php echo $message; ?>
            <script language=JavaScript>            
                var ant=parent.planeten.document.getElementById('cantox');
                ant.innerHTML='<?php echo $cantox; ?>';
                var ant=parent.planeten.document.getElementById('min2');
                ant.innerHTML='<?php echo $min2; ?>';
                var ant=parent.planeten.document.getElementById('defense');
                ant.innerHTML='<?php echo $defense; ?>';        
            </script>
            <?php
        }
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
    $art=$array["art"];
    if (($art==0) or ($art==3)) {
        if ($art==0) { $basisbild='1.jpg'; }
        if ($art==3) { $basisbild='4.jpg'; }
        $zeiger = @mysql_query("SELECT id,cantox,besitzer,min1,min2,min3,lemin,vorrat FROM $skrupel_planeten where besitzer=$spieler and id=$planetid");
        $array = @mysql_fetch_array($zeiger);
        $pid=$array["id"];
        $planet_cantox=$array["cantox"];
        $planet_min1=$array["min1"];
        $planet_min2=$array["min2"];
        $planet_min3=$array["min3"];
        $planet_lemin=$array["lemin"];
        $planet_vorrat=$array["vorrat"];
        ?>
        <style type="text/css">
            input {
                width:                50px;
                padding:      1px;
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
        </style>
        <link type="text/css" rel="StyleSheet" href="css/winclassic.css" />
        <script type="text/javascript" src="js/range.js"></script>
        <script type="text/javascript" src="js/timer.js"></script>
        <script type="text/javascript" src="js/slider.js"></script>
        <body text="#000000" scroll="auto" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <div id="bodybody" class="flexcroll" onfocus="this.blur()">
            <?php
            if (($t_huelle>=7) and ($t_antrieb>=8)) {
                ?>
                <script type="text/javascript">
                    function checken() {
                        <?php if ($planet_cantox>=1) { ?>
                            document.formular.planet_cantox.value=(s6.getValue()-<?php echo $planet_cantox; ?>)*-1;document.formular.falte_cantox.value=s6.getValue();
                        <?php } else { ?>document.formular.falte_cantox.value=0;document.formular.planet_cantox.value=0;<?php } ?>
                        <?php if ($planet_vorrat>=1) { ?>
                            document.formular.planet_vorrat.value=(s5.getValue()-<?php echo $planet_vorrat; ?>)*-1;document.formular.falte_vorrat.value=s5.getValue();
                        <?php } else { ?>document.formular.falte_vorrat.value=0;document.formular.planet_vorrat.value=0;<?php } ?>
                        <?php if ($planet_lemin>=1) { ?>
                            document.formular.planet_lemin.value=(s.getValue()-<?php echo $planet_lemin; ?>)*-1;document.formular.falte_lemin.value=s.getValue();
                        <?php } else { ?>document.formular.falte_lemin.value=0;document.formular.planet_lemin.value=0;<?php } ?>
                        <?php if ($planet_min1>=1) { ?>
                            document.formular.planet_min1.value=(s2.getValue()-<?php echo $planet_min1; ?>)*-1;document.formular.falte_min1.value=s2.getValue();
                        <?php } else { ?>document.formular.falte_min1.value=0;document.formular.planet_min1.value=0;<?php } ?>
                        <?php if ($planet_min2>=1) { ?>
                            document.formular.planet_min2.value=(s3.getValue()-<?php echo $planet_min2; ?>)*-1;document.formular.falte_min2.value=s3.getValue();
                        <?php } else { ?>document.formular.falte_min2.value=0;document.formular.planet_min2.value=0;<?php } ?>
                        <?php if ($planet_min3>=1) { ?>
                            document.formular.planet_min3.value=(s4.getValue()-<?php echo $planet_min3; ?>)*-1;document.formular.falte_min3.value=s4.getValue();
                        <?php } else { ?>document.formular.falte_min3.value=0;document.formular.planet_min3.value=0;<?php } ?>
                        var vorrat = eval(document.formular.falte_vorrat.value+'+0');
                        var lemin= eval(document.formular.falte_lemin.value+'+0');
                        var min1= eval(document.formular.falte_min1.value+'+0');
                        var min2= eval(document.formular.falte_min2.value+'+0');
                        var min3= eval(document.formular.falte_min3.value+'+0');
                        var cantoxnot = Math.round(vorrat+min1+min2+min3+lemin)*8;
                        var cantoxhab = eval(document.formular.planet_cantox.value+'+0');
                        if (cantoxnot<75) {cantoxnot=75;}
                        if(cantoxnot > cantoxhab) {
                            alert("<?php echo html_entity_decode($lang['basenalpha']['raumfaltenichta']); ?> "+cantoxnot+" <?php echo html_entity_decode($lang['basenalpha']['raumfaltenichtb']); ?>");
                            return false;
                        }
                        if(document.formular.zielid.value=='0') {
                            alert("<?php echo html_entity_decode($lang['basenalpha']['zielobjekt']); ?>");
                            return false;
                        }
                        return true;
                    }
                </script>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><form name="formular" onsubmit="return checken();"  method="post" action="basen_alpha.php?fu=6&baid=<?php echo $baid; ?>&pid=<?php echo $pid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
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
                                    <td>
                                        <img src="<?php
                                        $file='../daten/'.$rasse.'/bilder_basen/'.$basisbild;
                                        if (@file_exists($file)) { echo $file; } else { echo '../daten/'.$rasse.'/bilder_basen/1.jpg'; }?>" border="0" height="50">
                                    </td>
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
                                        <td><center><?php echo $lang['basenalpha']['raumfaltentechnologie']; ?></center></td>
                                        <td><a href="javascript:hilfe(33);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="3"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <center>
                                                <select name="zielid" style="font-family:Verdana;font-size:9px;width:170px;">
                                                    <option value="0" selected style="background-color:#000000;"><?php echo $lang['basenalpha']['zielwaehlen']; ?></option>
                                                    <?php
                                                    $zeiger = @mysql_query("SELECT id,name,besitzer,spiel,status FROM $skrupel_schiffe where besitzer=$spieler and status>0 and spiel=$spiel order by name");
                                                    $schiffanzahl = @mysql_num_rows($zeiger);
                                                    if ($schiffanzahl>=1) {
                                                        ?>
                                                        <option value="0" style="background-color:#000000;"><?php echo $lang['basenalpha']['schiffe']; ?></option>
                                                        <?php
                                                        for  ($i=0; $i<$schiffanzahl;$i++) {
                                                            $ok = @mysql_data_seek($zeiger,$i);
                                                            $array = @mysql_fetch_array($zeiger);
                                                            $shid=$array["id"];
                                                            $name=$array["name"];
                                                            ?>
                                                            <option value="<?php echo "s".$shid; ?>"><?php echo $name; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    if ($nebel>=1) {
                                                        $zeiger = @mysql_query("SELECT sicht_beta,spiel,id,name,x_pos,y_pos,besitzer FROM $skrupel_planeten where sicht_".$spieler."=1 and spiel=$spiel and id<>$pid order by name");
                                                    } else {
                                                        $zeiger = @mysql_query("SELECT spiel,id,name,x_pos,y_pos,besitzer FROM $skrupel_planeten where spiel=$spiel and id<>$pid order by name");
                                                    }
                                                    $datensaetze = @mysql_num_rows($zeiger);
                                                    if ($datensaetze>=1) {
                                                        ?>
                                                        <option value="0" style="background-color:#000000;"><?php echo $lang['basenalpha']['planeten']; ?></option>
                                                        <?php
                                                        for  ($i=0; $i<$datensaetze;$i++) {
                                                            $ok = @mysql_data_seek($zeiger,$i);
                                                            $array = @mysql_fetch_array($zeiger);
                                                            $planetid=$array["id"];
                                                            $name=$array["name"];
                                                            $x_pos=$array["x_pos"];
                                                            $y_pos=$array["y_pos"];
                                                            $besitzer=$array["besitzer"];
                                                            ?>
                                                            <option value="<?php echo "p".$planetid; ?>" <?php if ($besitzer>=1) { echo "style='background-color:".$spielerfarbe[$besitzer].";'"; } ?>><?php echo $name; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </center>
                                        </td>
                                    </tr>
                                </table>
                            </center>
                        </td>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                </tr>
                                <tr>
                                    <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                    <td><img src="<?php echo $bildpfad; ?>/icons/anomalie.gif" border="0"  height="50"></td>
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
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="77" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="230" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="60" height="1"></td>
                    </tr>
                    <tr>
                    <td>
                        <center>
                            <img src="<?php echo $bildpfad; ?>/icons/cantox.gif" border="0" width="17" height="17">
                            <br>
                            <div id="planet_cantox"><?php echo $planet_cantox; ?></div>
                        </center>
                    </td>
                    <td>
                        <?php if ($planet_cantox>=1) {
                            ?>
                            <div class="slider" id="slider-6" tabIndex="1"><input class="slider-input" id="slider-input-6"/></div>
                            <?php
                        }
                        ?>
                    </td>
                    <td>
                        <center>
                            <img src="<?php echo $bildpfad; ?>/icons/cantox.gif" border="0" width="17" height="17">
                            <br>
                            <div id="falte_cantox">0</div>
                        </center>
                    </td>
                </tr>
            </table>
            <?php
            if ($planet_cantox>=1) {
                ?>
                <script type="text/javascript">
                    var s6 = new Slider(document.getElementById("slider-6"), document.getElementById("slider-input-6"));
                    s6.onchange = function () {
                        var ant=document.getElementById('planet_cantox');
                        ant.innerHTML=(s6.getValue()-<?php echo $planet_cantox; ?>)*-1;
                        var ant=document.getElementById('falte_cantox');
                        ant.innerHTML=s6.getValue();
                    };
                    s6.setMinimum(0);
                    s6.setMaximum(<?php echo $planet_cantox; ?>);
                    s6.setValue(0);
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
                            <img src="<?php echo $bildpfad; ?>/icons/vorrat.gif" border="0" width="17" height="17">
                            <br>
                            <div id="planet_vorrat"><?php echo $planet_vorrat; ?></div>
                        </center>
                    </td>
                    <td>
                        <?php 
                        if ($planet_vorrat>=1) {
                            ?>
                            <div class="slider" id="slider-5" tabIndex="1"><input class="slider-input" id="slider-input-5"/></div>
                            <?php
                        }
                        ?>
                    </td>
                    <td>
                        <center>
                            <img src="<?php echo $bildpfad; ?>/icons/vorrat.gif" border="0" width="17" height="17">
                            <br>
                            <div id="falte_vorrat">0</div>
                        </center>
                    </td>
                </tr>
            </table>
            <?php
            if ($planet_vorrat>=1) {
                ?>
                <script type="text/javascript">
                    var s5 = new Slider(document.getElementById("slider-5"), document.getElementById("slider-input-5"));
                    s5.onchange = function () {
                        var ant=document.getElementById('planet_vorrat');
                        ant.innerHTML=(s5.getValue()-<?php echo $planet_vorrat; ?>)*-1;
                        var ant=document.getElementById('falte_vorrat');
                        ant.innerHTML=s5.getValue();
                    };
                    s5.setMinimum(0);
                    s5.setMaximum(<?php echo $planet_vorrat; ?>);
                    s5.setValue(0);
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
                            <img src="<?php echo $bildpfad; ?>/icons/lemin.gif" border="0" width="17" height="17">
                            <br>
                            <div id="planet_lemin"><?php echo $planet_lemin; ?></div>
                        </center>
                    </td>
                    <td>
                        <?php
                        if ($planet_lemin>=1) {
                            ?>
                            <div class="slider" id="slider-1" tabIndex="1"><input class="slider-input" id="slider-input-1"/></div>
                            <?php
                        }
                        ?>
                    </td>
                    <td>
                        <center>
                            <img src="<?php echo $bildpfad; ?>/icons/lemin.gif" border="0" width="17" height="17">
                            <br>
                            <div id="falte_lemin">0</div>
                        </center>
                    </td>
                </tr>
            </table>
            <?php
            if ($planet_lemin>=1) {
                ?>
                <script type="text/javascript">
                    var s = new Slider(document.getElementById("slider-1"), document.getElementById("slider-input-1"));
                        s.onchange = function () {
                            //document.getElementById("fracht_lemin").value = s.getValue();
                            var ant=document.getElementById('planet_lemin');
                            ant.innerHTML=(s.getValue()-<?php echo $planet_lemin; ?>)*-1;
                            var ant=document.getElementById('falte_lemin');
                            ant.innerHTML=s.getValue();
                    };
                    s.setMinimum(0);
                    s.setMaximum(<?php echo $planet_lemin; ?>);
                    s.setValue(0);
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
                            <img src="<?php echo $bildpfad; ?>/icons/mineral_1.gif" border="0" width="17" height="17">
                            <br>
                            <div id="planet_min1"><?php echo $planet_min1?></div>
                        </center>
                    </td>
                    <td>
                        <?php
                        if ($planet_min1>=1) {
                            ?>
                            <div class="slider" id="slider-2" tabIndex="1"><input class="slider-input" id="slider-input-2"/></div>
                            <?php
                        }
                        ?>
                    </td>
                    <td>
                        <center>
                            <img src="<?php echo $bildpfad; ?>/icons/mineral_1.gif" border="0" width="17" height="17">
                            <br>
                            <div id="falte_min1">0</div>
                        </center>
                    </td>
                </tr>
            </table>
            <?php
            if ($planet_min1>=1) {
                ?>
                <script type="text/javascript">
                    var s2 = new Slider(document.getElementById("slider-2"), document.getElementById("slider-input-2"));
                    s2.onchange = function () {
                        var ant=document.getElementById('planet_min1');
                        ant.innerHTML=(s2.getValue()-<?php echo $planet_min1; ?>)*-1;
                        var ant=document.getElementById('falte_min1');
                        ant.innerHTML=s2.getValue();
                    };
                    s2.setMinimum(0);
                    s2.setMaximum(<?php echo $planet_min1; ?>);
                    s2.setValue(0);
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
                            <img src="<?php echo $bildpfad; ?>/icons/mineral_2.gif" border="0" width="17" height="17">
                            <br>
                            <div id="planet_min2"><?php echo $planet_min2; ?></div>
                        </center>
                    </td>
                    <td>
                        <?php
                        if ($planet_min2>=1) {
                            ?>
                            <div class="slider" id="slider-3" tabIndex="1"><input class="slider-input" id="slider-input-3"/></div>
                            <?php
                        }
                        ?>
                    </td>
                    <td>
                        <center>
                            <img src="<?php echo $bildpfad; ?>/icons/mineral_2.gif" border="0" width="17" height="17">
                            <br>
                            <div id="falte_min2">0</div>
                        </center>
                    </td>
                </tr>
            </table>
            <?php
            if ($planet_min2>=1) {
                ?>
                <script type="text/javascript">
                    var s3 = new Slider(document.getElementById("slider-3"), document.getElementById("slider-input-3"));
                    s3.onchange = function () {
                        var ant=document.getElementById('planet_min2');
                        ant.innerHTML=(s3.getValue()-<?php echo $planet_min2; ?>)*-1;
                        var ant=document.getElementById('falte_min2');
                        ant.innerHTML=s3.getValue();
                    };
                    s3.setMinimum(0);
                    s3.setMaximum(<?php echo $planet_min2; ?>);
                    s3.setValue(0);
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
                            <img src="<?php echo $bildpfad; ?>/icons/mineral_3.gif" border="0" width="17" height="17">
                            <br>
                            <div id="planet_min3"><?php echo $planet_min3; ?></div>
                        </center>
                    </td>
                    <td>
                        <?php
                        if ($planet_min3>=1) {
                            ?>
                            <div class="slider" id="slider-4" tabIndex="1"><input class="slider-input" id="slider-input-4"/></div>
                            <?php
                        }
                        ?>
                    </td>
                    <td>
                        <center>
                            <img src="<?php echo $bildpfad; ?>/icons/mineral_3.gif" border="0" width="17" height="17">
                            <br>
                            <div id="falte_min3">0</div>
                        </center>
                    </td>
                </tr>
            </table>
            <?php
            if ($planet_min3>=1) {
                ?>
                <script type="text/javascript">
                    var s4 = new Slider(document.getElementById("slider-4"), document.getElementById("slider-input-4"));
                    s4.onchange = function () {
                        var ant=document.getElementById('planet_min3');
                        ant.innerHTML=(s4.getValue()-<?php echo $planet_min3; ?>)*-1;
                        var ant=document.getElementById('falte_min3');
                        ant.innerHTML=s4.getValue();
                    };
                    s4.setMinimum(0);
                    s4.setMaximum(<?php echo $planet_min3; ?>);
                    s4.setValue(0);
                </script>
                <?php
            }
            ?>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="367" height="5"></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit" style="width:367px;" value="<?php echo $lang['basenalpha']['raumfalteinitialisieren']; ?>">
                        <input type="hidden" name="falte_cantox" value=0><input type="hidden" name="planet_cantox" value=0>
                        <input type="hidden" name="falte_vorrat" value=0><input type="hidden" name="planet_vorrat" value=0>
                        <input type="hidden" name="falte_lemin" value=0><input type="hidden" name="planet_lemin" value=0>
                        <input type="hidden" name="falte_min1" value=0><input type="hidden" name="planet_min1" value=0>
                        <input type="hidden" name="falte_min2" value=0><input type="hidden" name="planet_min2" value=0>
                        <input type="hidden" name="falte_min3" value=0><input type="hidden" name="planet_min3" value=0>
                    </td>
                </tr>
                <tr>
                    <td></form><img src="../bilder/empty.gif" border="0" width="367" height="5"></td>
                </tr>
            </table>
            </div>
            <?php } else { ?>
            <body text="#000000" scroll="auto" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
                <br><br><br>
                    <center><?php echo $lang['basenalpha']['raumfaltefehler']; ?></center>
                    <?php
            }
        }
    include ("inc.footer.php");
}
if ($fuid==6) {
    include ("inc.header.php");
    $falte_cantox=(int_post('falte_cantox')<0)?0:int_post('falte_cantox');
    $falte_lemin=(int_post('falte_lemin')<0)?0:int_post('falte_lemin');
    $falte_min1=(int_post('falte_min1')<0)?0:int_post('falte_min1');
    $falte_min2=(int_post('falte_min2')<0)?0:int_post('falte_min2');
    $falte_min3=(int_post('falte_min3')<0)?0:int_post('falte_min3');
    $falte_vorrat=(int_post('falte_vorrat')<0)?0:int_post('falte_vorrat');
    $planet_cantox=(int_post('planet_cantox')<0)?0:int_post('planet_cantox');
    $planet_lemin=(int_post('planet_lemin')<0)?0:int_post('planet_lemin');
    $planet_min1=(int_post('planet_min1')<0)?0:int_post('planet_min1');
    $planet_min2=(int_post('planet_min2')<0)?0:int_post('planet_min2');
    $planet_min3=(int_post('planet_min3')<0)?0:int_post('planet_min3');
    $planet_vorrat=(int_post('planet_vorrat')<0)?0:int_post('planet_vorrat');
    $zielid=str_post('zielid','SHORTNAME');
    $zielart=substr($zielid,0,1);
    $zielid=substr($zielid,1,strlen($zielid)-1);
    $zeiger = @mysql_query("SELECT * FROM $skrupel_sternenbasen where besitzer=$spieler and status=1 and id=$baid");
    $array = @mysql_fetch_array($zeiger);
    $baid=$array["id"];
    $name=$array["name"];
    $x_pos=$array["x_pos"];
    $y_pos=$array["y_pos"];
    $planetid=$array["planetid"];
    $zeiger = @mysql_query("SELECT id,cantox,besitzer,min1,min2,min3,lemin,vorrat FROM $skrupel_planeten where besitzer=$spieler and id=$planetid");
    $array = @mysql_fetch_array($zeiger);
    $pid=$array["id"];
    $plane_cantox=$array["cantox"];
    $plane_min1=$array["min1"];
    $plane_min2=$array["min2"];
    $plane_min3=$array["min3"];
    $plane_lemin=$array["lemin"];
    $plane_vorrat=$array["vorrat"];
    if (
        ($planet_cantox+$falte_cantox==$plane_cantox)
        and ($planet_min1+$falte_min1==$plane_min1)
        and ($planet_min2+$falte_min2==$plane_min2)
        and ($planet_min3+$falte_min3==$plane_min3)
        and ($planet_lemin+$falte_lemin==$plane_lemin)
        and ($planet_vorrat+$falte_vorrat==$plane_vorrat)
        and (($falte_min1+$falte_min2+$falte_min3+$falte_lemin+$falte_vorrat)*8<=$planet_cantox)
        and (strlen($zielid)>=1)
        and ($planet_cantox>=75)
    ){
        $kosten=($falte_min1+$falte_min2+$falte_min3+$falte_lemin+$falte_vorrat)*8; if ($kosten<75) {$kosten=75;}
        $planet_cantox=$planet_cantox-$kosten;
        $zeiger = @mysql_query("UPDATE $skrupel_planeten set cantox=$planet_cantox,min1=$planet_min1,min2=$planet_min2,min3=$planet_min3,lemin=$planet_lemin,vorrat=$planet_vorrat where besitzer=$spieler and id=$planetid");
        if ($zielart=='p') {
            $zeiger = @mysql_query("SELECT id,x_pos,y_pos FROM $skrupel_planeten where id=$zielid");
            $array = @mysql_fetch_array($zeiger);
            $px_pos=$array["x_pos"];
            $py_pos=$array["y_pos"];
            $optionen="p:$zielid:$px_pos:$py_pos:$falte_cantox:$falte_vorrat:$falte_lemin:$falte_min1:$falte_min2:$falte_min3";
        } else {
            $optionen="s:$zielid:0:0:$falte_cantox:$falte_vorrat:$falte_lemin:$falte_min1:$falte_min2:$falte_min3";
        }
        $zeiger = @mysql_query("insert into $skrupel_anomalien (art,x_pos,y_pos,extra,spiel) values (3,$x_pos,$y_pos,'$optionen',$spiel)");
        ?>
        <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" scroll="auto" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <br><br><br><br>
            <center><?php echo $lang['basenalpha']['raumfalteerfolgreich']; ?></center>
            <script language=JavaScript>
                var ant=parent.planeten.document.getElementById('cantox');
                ant.innerHTML='<?php echo $planet_cantox; ?>';
                var ant=parent.planeten.document.getElementById('min1');
                ant.innerHTML='<?php echo $planet_min1; ?>';
                var ant=parent.planeten.document.getElementById('min2');
                ant.innerHTML='<?php echo $planet_min2; ?>';
                var ant=parent.planeten.document.getElementById('min3');
                ant.innerHTML='<?php echo $planet_min3; ?>';
            </script>
            <?php
    }
    include ("inc.footer.php");
}
