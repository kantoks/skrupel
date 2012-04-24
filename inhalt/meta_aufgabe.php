<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'meta_aufgabe';
$fuid = int_get('fu');

if ($fuid==1) {
    include ("inc.header.php");
    ?>
    <body text="#000000" bgcolor="#444444"  link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" cellspacing="0" cellpadding="0" height="100%">
                <tr>
                    <td>
                        <center><img src="../lang/<?php echo $spieler_sprache?>/topics/aufgabe.gif" border="0" width="157" height="52"></center>
                        <br>
                        <center>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="color:#aaaaaa;">
                                        <center><?php echo $lang['metaaufgabe']['keinechance']?></center>
                                    </td>
                                </tr>
                            </table>
                        </center>
                        <br><br>
                        <center>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><form method="post" action="meta_aufgabe.php?fu=2&uid=<?php echo $uid?>&sid=<?php echo $sid?>" onsubmit="return confirm('<?php echo $lang['metaaufgabe']['wirklichaufgeben']?>');"></td>
                                </tr>
                                <tr>
                                    <td><input type="submit" name="button" value="<?php echo $lang['metaaufgabe']['aufgeben']?>"></td>
                                </tr>
                                <tr>
                                    <td></form></td>
                                </tr>
                            </table>
                        </center>
                        <br><br>
                        <center><?php echo $lang['metaaufgabe']['trittein']?></center>
                        <br>
                        <center>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="color:#aaaaaa;">
                                        <?php echo $lang['metaaufgabe']['folgen']?>
                                    </td>
                                </tr>
                            </table>
                        </center>
                        <br>
                        <center><?php echo $lang['metaaufgabe']['loggtaus']?></center>
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
    <body text="#000000" bgcolor="#444444"  link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" cellspacing="0" cellpadding="0" height="100%">
                <tr>
                    <td><center><?php echo $lang['metaaufgabe']['reorganisiert']?></center></td>
                </tr>
            </table>
        </center>
        <script language=JavaScript>
            top.window.location='meta_aufgabe.php?fu=3&uid=<?php echo $uid?>&sid=<?php echo $sid?>';
        </script>
        <?php
    include ("inc.footer.php");
}
if ($fuid==3) {
    include ("inc.host_func.php");
	open_db();
    include ("inc.check.php");
    ///////////////////////////////Sprachinclude(nur die benoetigten) Anfang
    $zeiger = mysql_query("SELECT * FROM $skrupel_spiele WHERE id=$spiel");
    $sprachtemp_1 = mysql_fetch_array($zeiger);
    $sprachen = array();
    for ($i=1; $i<=10; $i++){
        $spieler_t = 'spieler_'.$i;
        if($sprachtemp_1[$spieler_t] > 0) {
            $zeiger = mysql_query("SELECT * FROM $skrupel_user WHERE id={$sprachtemp_1[$spieler_t]}");
            $sprachtemp_3 = mysql_fetch_array($zeiger);
            $spielersprache[$i] = ($sprachtemp_3['sprache']=='') ? $language : $sprachtemp_3['sprache'];
            if (in_array($sprachtemp_3['sprache'], $sprachen)) $sprachen[] = $sprachtemp_3['sprache'];
        }
    }
    if(count($sprachen) == 0) {
        include('../lang/'.$language.'/lang.meta_aufgabe_b.php');
    } else {
        foreach($sprachen as $sprache) {
            include('../lang/'.$sprache.'/lang.meta_aufgabe_b.php');
        }
    }
    ///////////////////////////////Sprachinclude(nur die benoetigten) Ende
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
    if (($spieler_1>=1) and ($spieler<>1)) { neuigkeit(4,"../bilder/news/aufgabe.jpg",1,str_replace(array('{1}','{2}'), array($spielerfarbe[$spieler], $spieler_name), $lang['metaaufgabe'][$spielersprache[1]]['hataufgegeben'])); }
    if (($spieler_2>=1) and ($spieler<>2)) { neuigkeit(4,"../bilder/news/aufgabe.jpg",2,str_replace(array('{1}','{2}'), array($spielerfarbe[$spieler], $spieler_name), $lang['metaaufgabe'][$spielersprache[2]]['hataufgegeben'])); }
    if (($spieler_3>=1) and ($spieler<>3)) { neuigkeit(4,"../bilder/news/aufgabe.jpg",3,str_replace(array('{1}','{2}'), array($spielerfarbe[$spieler], $spieler_name), $lang['metaaufgabe'][$spielersprache[3]]['hataufgegeben'])); }
    if (($spieler_4>=1) and ($spieler<>4)) { neuigkeit(4,"../bilder/news/aufgabe.jpg",4,str_replace(array('{1}','{2}'), array($spielerfarbe[$spieler], $spieler_name), $lang['metaaufgabe'][$spielersprache[4]]['hataufgegeben'])); }
    if (($spieler_5>=1) and ($spieler<>5)) { neuigkeit(4,"../bilder/news/aufgabe.jpg",5,str_replace(array('{1}','{2}'), array($spielerfarbe[$spieler], $spieler_name), $lang['metaaufgabe'][$spielersprache[5]]['hataufgegeben'])); }
    if (($spieler_6>=1) and ($spieler<>6)) { neuigkeit(4,"../bilder/news/aufgabe.jpg",6,str_replace(array('{1}','{2}'), array($spielerfarbe[$spieler], $spieler_name), $lang['metaaufgabe'][$spielersprache[6]]['hataufgegeben'])); }
    if (($spieler_7>=1) and ($spieler<>7)) { neuigkeit(4,"../bilder/news/aufgabe.jpg",7,str_replace(array('{1}','{2}'), array($spielerfarbe[$spieler], $spieler_name), $lang['metaaufgabe'][$spielersprache[7]]['hataufgegeben'])); }
    if (($spieler_8>=1) and ($spieler<>8)) { neuigkeit(4,"../bilder/news/aufgabe.jpg",8,str_replace(array('{1}','{2}'), array($spielerfarbe[$spieler], $spieler_name), $lang['metaaufgabe'][$spielersprache[8]]['hataufgegeben'])); }
    if (($spieler_9>=1) and ($spieler<>9)) { neuigkeit(4,"../bilder/news/aufgabe.jpg",9,str_replace(array('{1}','{2}'), array($spielerfarbe[$spieler], $spieler_name), $lang['metaaufgabe'][$spielersprache[9]]['hataufgegeben'])); }
    if (($spieler_10>=1) and ($spieler<>10)) { neuigkeit(4,"../bilder/news/aufgabe.jpg",10,str_replace(array('{1}','{2}'), array($spielerfarbe[$spieler], $spieler_name), $lang['metaaufgabe'][$spielersprache[10]]['hataufgegeben'])); }
    $zeiger = @mysql_query("SELECT * FROM $skrupel_spiele where id=$spiel");
    $ok = @mysql_data_seek($zeiger,0);
    $a_runde = @mysql_fetch_array($zeiger);
    $runde=$a_runde["runde"];
    $zeiger = @mysql_query("SELECT besitzer,id,spiel FROM $skrupel_sternenbasen where besitzer=$spieler and spiel=$spiel order by id");
    $basenanzahl = @mysql_num_rows($zeiger);
    if ($basenanzahl>=1) {
        for ($i=0; $i<$basenanzahl;$i++) {
            $ok = @mysql_data_seek($zeiger,$i);
            $array = @mysql_fetch_array($zeiger);
            $baid=$array["id"];
            if($runde<51){
                $zeiger_temp = @mysql_query("DELETE FROM $skrupel_huellen where baid=$baid;");
            }
        }
    }
    if($runde>49){
        $zeiger = @mysql_query("UPDATE $skrupel_sternenbasen set besitzer=0 where besitzer=$spieler and spiel=$spiel");
    }else{
        $zeiger = @mysql_query("DELETE FROM $skrupel_sternenbasen where besitzer=$spieler and spiel=$spiel");
    }
    $zeiger = @mysql_query("SELECT * FROM $skrupel_schiffe where besitzer=$spieler and spiel=$spiel");
    $schiffanzahl = @mysql_num_rows($zeiger);
    if ($schiffanzahl>=1) {
        for ($i=0; $i<$schiffanzahl;$i++) {
            $ok = @mysql_data_seek($zeiger,$i);
            $array = @mysql_fetch_array($zeiger);
            $shid=$array["id"];
            $zeiger_temp = @mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 's:$shid:%'");
            $zeiger_temp = @mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where flug=3 and zielid=$shid");
        }
    }
    $zeiger = @mysql_query("DELETE FROM $skrupel_schiffe where besitzer=$spieler and spiel=$spiel");
    $zeiger = @mysql_query("DELETE FROM $skrupel_politik where spiel=$spiel and (partei_a=$spieler or partei_b=$spieler)");
    if($runde>49){
        $zeiger = @mysql_query("UPDATE $skrupel_planeten set kolonisten=0,besitzer=0,heimatplanet=0,auto_minen=0,auto_fabriken=0,abwehr=0,auto_abwehr=0,auto_vorrat=0,logbuch='' where besitzer=$spieler and spiel=$spiel");
    }else{
        $zeiger = @mysql_query("UPDATE $skrupel_planeten set sternenbasis_defense=0, heimatplanet=0, sternenbasis_art=0, sternenbasis=0, sternenbasis_name='', sternenbasis_id=0, sternenbasis_rasse='', kolonisten=0,besitzer=0,minen=0,vorrat=0,cantox=0,auto_minen=0,fabriken=0,auto_fabriken=0,abwehr=0,auto_abwehr=0,auto_vorrat=0,logbuch='' where besitzer=$spieler and spiel=$spiel");
    }
    $zeiger = @mysql_query("UPDATE $skrupel_planeten set kolonisten_new=0, schwerebt_new=0, leichtebt_new=0, kolonisten_spieler=0 where kolonisten_spieler=$spieler and spiel=$spiel");
    $zeiger = @mysql_query("DELETE FROM $skrupel_neuigkeiten where spieler_id=$spieler and spiel_id=$spiel");
    if ($spieler==1) { $zeiger = @mysql_query("UPDATE $skrupel_spiele set spieler_1_raus=1,spieleranzahl=spieleranzahl-1,spieler_1_zug=0 where id=$spiel");
    }elseif ($spieler==2) { $zeiger = @mysql_query("UPDATE $skrupel_spiele set spieler_2_raus=1,spieleranzahl=spieleranzahl-1,spieler_2_zug=0 where id=$spiel");
    }elseif ($spieler==3) { $zeiger = @mysql_query("UPDATE $skrupel_spiele set spieler_3_raus=1,spieleranzahl=spieleranzahl-1,spieler_3_zug=0 where id=$spiel");
    }elseif ($spieler==4) { $zeiger = @mysql_query("UPDATE $skrupel_spiele set spieler_4_raus=1,spieleranzahl=spieleranzahl-1,spieler_4_zug=0 where id=$spiel");
    }elseif ($spieler==5) { $zeiger = @mysql_query("UPDATE $skrupel_spiele set spieler_5_raus=1,spieleranzahl=spieleranzahl-1,spieler_5_zug=0 where id=$spiel");
    }elseif ($spieler==6) { $zeiger = @mysql_query("UPDATE $skrupel_spiele set spieler_6_raus=1,spieleranzahl=spieleranzahl-1,spieler_6_zug=0 where id=$spiel");
    }elseif ($spieler==7) { $zeiger = @mysql_query("UPDATE $skrupel_spiele set spieler_7_raus=1,spieleranzahl=spieleranzahl-1,spieler_7_zug=0 where id=$spiel");
    }elseif ($spieler==8) { $zeiger = @mysql_query("UPDATE $skrupel_spiele set spieler_8_raus=1,spieleranzahl=spieleranzahl-1,spieler_8_zug=0 where id=$spiel");
    }elseif ($spieler==9) { $zeiger = @mysql_query("UPDATE $skrupel_spiele set spieler_9_raus=1,spieleranzahl=spieleranzahl-1,spieler_9_zug=0 where id=$spiel");
    }elseif ($spieler==10) { $zeiger = @mysql_query("UPDATE $skrupel_spiele set spieler_10_raus=1,spieleranzahl=spieleranzahl-1,spieler_10_zug=0 where id=$spiel"); }
    $zeiger = @mysql_query("UPDATE $skrupel_user set uid='',bildpfad='' where id=$spieler_id");
    ///////////////////////////////////////////////////////////////////////////////////////////////NEBELSEKTOREN ANFANG
    if ($nebel>=1) {
        $besitzer_recht[1]='1000000000';
        $besitzer_recht[2]='0100000000';
        $besitzer_recht[3]='0010000000';
        $besitzer_recht[4]='0001000000';
        $besitzer_recht[5]='0000100000';
        $besitzer_recht[6]='0000010000';
        $besitzer_recht[7]='0000001000';
        $besitzer_recht[8]='0000000100';
        $besitzer_recht[9]='0000000010';
        $besitzer_recht[10]='0000000001';
    $dateiinclude="inc.host_nebel.php";
    include ($dateiinclude);
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////NEBELSEKTOREN ENDE
    ///////////////////////////////////////////////////////////////////////////////////////////////RANGLISTE ANFANG
    for ($m=1;$m<11;$m++) {
        $spieler_basen_c[$m]=0;
        $spieler_planeten_c[$m]=0;
        $spieler_schiffe_c[$m]=0;
        $spieler_basen_c_wert[$m]=0;
        $spieler_planeten_c_wert[$m]=0;
        $spieler_schiffe_c_wert[$m]=0;
    }
    $zeiger = @mysql_query("SELECT id,besitzer,spiel FROM $skrupel_planeten where spiel=$spiel and besitzer>0 order by id");
    $planetenanzahl = @mysql_num_rows($zeiger);
    if ($planetenanzahl>=1) {
        for ($i=0; $i<$planetenanzahl;$i++) {
            $ok = @mysql_data_seek($zeiger,$i);
            $array = @mysql_fetch_array($zeiger);
            $besitzer=$array["besitzer"];
            $spieler_planeten_c[$besitzer]=$spieler_planeten_c[$besitzer]+5;
        }
    }
    $zeiger = @mysql_query("SELECT id,besitzer,spiel FROM $skrupel_sternenbasen where spiel=$spiel and besitzer>0 order by id");
    $planetenanzahl = @mysql_num_rows($zeiger);
    if ($planetenanzahl>=1) {
        for ($i=0; $i<$planetenanzahl;$i++) {
            $ok = @mysql_data_seek($zeiger,$i);
            $array = @mysql_fetch_array($zeiger);
            $besitzer=$array["besitzer"];
            $spieler_basen_c[$besitzer]=$spieler_basen_c[$besitzer]+10;
        }
    }
    $zeiger = @mysql_query("SELECT id,besitzer,techlevel,spiel FROM $skrupel_schiffe where spiel=$spiel and besitzer>0 order by id");
    $planetenanzahl = @mysql_num_rows($zeiger);
    if ($planetenanzahl>=1) {
        for ($i=0; $i<$planetenanzahl;$i++) {
            $ok = @mysql_data_seek($zeiger,$i);
            $array = @mysql_fetch_array($zeiger);
            $besitzer=$array["besitzer"];
            $techlevel=$array["techlevel"];
            $spieler_schiffe_c[$besitzer]=$spieler_schiffe_c[$besitzer]+$techlevel;
        }
    }
    for ($m=1;$m<11;$m++) {
        $spieler_schiffe_platz_c[$m]=platz_schiffe($spieler_schiffe_c[$m]);
    }
    for ($m=1;$m<11;$m++) {
        $spieler_schiffe_c[$m]=$spieler_schiffe_platz_c[$m];
        $spieler_basen_platz_c[$m]=platz_basen($spieler_basen_c[$m]);
    }
    for ($m=1;$m<11;$m++) {
        $spieler_basen_c[$m]=$spieler_basen_platz_c[$m];
        $spieler_planeten_platz_c[$m]=platz_planeten($spieler_planeten_c[$m]);
    }
    for ($m=1;$m<11;$m++) {
        $spieler_planeten_c[$m]=$spieler_planeten_platz_c[$m];
        $spieler_gesamt_c[$m]=$spieler_schiffe_c[$m]+$spieler_basen_c[$m]+$spieler_planeten_c[$m];
    }
    for ($m=1;$m<11;$m++) {
        $spieler_platz_c[$m]=platz($spieler_gesamt_c[$m]);
    }
    $zeiger_temp = @mysql_query("UPDATE $skrupel_spiele set spieler_1_basen=$spieler_basen_c[1],spieler_1_planeten=$spieler_planeten_c[1],spieler_1_schiffe=$spieler_schiffe_c[1],spieler_2_basen=$spieler_basen_c[2],spieler_2_planeten=$spieler_planeten_c[2],spieler_2_schiffe=$spieler_schiffe_c[2],spieler_3_basen=$spieler_basen_c[3],spieler_3_planeten=$spieler_planeten_c[3],spieler_3_schiffe=$spieler_schiffe_c[3],spieler_4_basen=$spieler_basen_c[4],spieler_4_planeten=$spieler_planeten_c[4],spieler_4_schiffe=$spieler_schiffe_c[4],spieler_5_basen=$spieler_basen_c[5],spieler_5_planeten=$spieler_planeten_c[5],spieler_5_schiffe=$spieler_schiffe_c[5],spieler_6_basen=$spieler_basen_c[6],spieler_6_planeten=$spieler_planeten_c[6],spieler_6_schiffe=$spieler_schiffe_c[6],spieler_7_basen=$spieler_basen_c[7],spieler_7_planeten=$spieler_planeten_c[7],spieler_7_schiffe=$spieler_schiffe_c[7],spieler_8_basen=$spieler_basen_c[8],spieler_8_planeten=$spieler_planeten_c[8],spieler_8_schiffe=$spieler_schiffe_c[8],spieler_9_basen=$spieler_basen_c[9],spieler_9_planeten=$spieler_planeten_c[9],spieler_9_schiffe=$spieler_schiffe_c[9],spieler_10_basen=$spieler_basen_c[10],spieler_10_planeten=$spieler_planeten_c[10],spieler_10_schiffe=$spieler_schiffe_c[10],spieler_1_platz=$spieler_platz_c[1],spieler_2_platz=$spieler_platz_c[2],spieler_3_platz=$spieler_platz_c[3],spieler_4_platz=$spieler_platz_c[4],spieler_5_platz=$spieler_platz_c[5],spieler_6_platz=$spieler_platz_c[6],spieler_7_platz=$spieler_platz_c[7],spieler_8_platz=$spieler_platz_c[8],spieler_9_platz=$spieler_platz_c[9],spieler_10_platz=$spieler_platz_c[10] where id=$spiel");
    ///////////////////////////////////////////////////////////////////////////////////////////////RANGLISTE ENDE
    
    if ($bildpfad=='../bilder') { $bildpfad='bilder'; }
    $backlink="../index.php?pic_path=$bildpfad&sprache=".$spieler_sprache;
    header ("Location: $backlink");
}
