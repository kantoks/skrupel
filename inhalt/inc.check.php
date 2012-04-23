<?php

require_once ('../inc.conf.php');
require_once ('inc.hilfsfunktionen.php');
open_db();

$sid = (isset($_GET['sid']) && !preg_match('/[^0-9A-Za-z\/\.]/',$_GET['sid']))?$_GET['sid']:0;
$uid = (isset($_GET['uid']) && !preg_match('/[^0-9A-Za-z\/\.]/',$_GET['uid']))?$_GET['uid']:0;
$zeiger = @mysql_query("SELECT * FROM $skrupel_user where uid='$uid'");
$datensaetze = @mysql_num_rows($zeiger);
if ($datensaetze==1) {
    $array = @mysql_fetch_array($zeiger);
    $spieler_id=$array['id'];
    $spieler_name=$array['nick'];
    $spieler_email=$array['email'];
    $spieler_icq=$array['icq'];
    $spieler_optionen=$array['optionen'];
    $spieler_avatar=$array['avatar'];
    $spieler_jabber=$array['jabber'];
    $bildpfad=$array['bildpfad'];
    $spieler_sprache=$array['sprache'];
    $zeiger2 = @mysql_query("SELECT * FROM $skrupel_spiele where sid='$sid' and (spieler_1=$spieler_id or spieler_2=$spieler_id or spieler_3=$spieler_id or spieler_4=$spieler_id or spieler_5=$spieler_id or spieler_6=$spieler_id or spieler_7=$spieler_id or spieler_8=$spieler_id or spieler_9=$spieler_id or spieler_10=$spieler_id)");
    $datensaetze2 = @mysql_num_rows($zeiger2);
    if ($datensaetze2==1) {
        $array2 = @mysql_fetch_array($zeiger2);
        $spiel = $array2['id'];
        $phase = $array2['phase'];
        $module = @explode(':', $array2['module']);
        $module = array_pad($module, 5, 0);
        if ($phase==1) {
            if ((preg_match ("/kommunikation_exch/i",$SCRIPT_NAME)) or (preg_match ("/kommunikation_exch/i",$SCRIPT_FILENAME))) {
                header("Location: kommunikation_exch.php?fu=7");exit;
            } else {
                header("Location: runde_ende.php?fu=1&spiel=$spiel&sprache=".$spieler_sprache);exit;
            }
        }
        $spieler_1=$array2["spieler_1"];
        $spieler_2=$array2["spieler_2"];
        $spieler_3=$array2["spieler_3"];
        $spieler_4=$array2["spieler_4"];
        $spieler_5=$array2["spieler_5"];
        $spieler_6=$array2["spieler_6"];
        $spieler_7=$array2["spieler_7"];
        $spieler_8=$array2["spieler_8"];
        $spieler_9=$array2["spieler_9"];
        $spieler_10=$array2["spieler_10"];
        for ($i=1; $i<=10; $i++) {
            $tmpstr = 'spieler_'.$i;
            $spieler_id_c[$i]        = $array2[$tmpstr];
            $spieler_zug_c[$i]       = $array2[$tmpstr.'_zug'];
            $spieler_rasse_c[$i]     = $array2[$tmpstr.'_rasse'];
            $spieler_rassename_c[$i] = $array2[$tmpstr.'_rassename'];
            $spieler_hash[$i]        = $array2[$tmpstr.'_hash'];
            $spieler_basen_c[$i]     = $array2[$tmpstr.'_basen'];
            $spieler_planeten_c[$i]  = $array2[$tmpstr.'_planeten'];
            $spieler_schiffe_c[$i]   = $array2[$tmpstr.'_schiffe'];
            $spieler_gesamt_c[$i]    = $array2[$tmpstr.'_platz'];
            $spieler_raus_c[$i]      = $array2[$tmpstr.'_raus'];
            $spieler_ziel_c[$i]      = $array2[$tmpstr.'_ziel'];
            if ($spieler_id_c[$i]==$spieler_id) {
                $spieler = $i;
                $spieler_raus = $spieler_raus_c[$i];
                $zug_abgeschlossen = $spieler_zug_c[$i];
                $spieler_rasse = $spieler_rasse_c[$i];
                $spieler_ziel = $spieler_ziel_c[$i];
            }
        }
        $spieler_admin=$array2['spieler_admin'];
        $spieler_1_basen=$array2['spieler_1_basen'];$spieler_1_planeten=$array2['spieler_1_planeten'];$spieler_1_schiffe=$array2['spieler_1_schiffe'];
        $spieler_2_basen=$array2['spieler_2_basen'];$spieler_2_planeten=$array2['spieler_2_planeten'];$spieler_2_schiffe=$array2['spieler_2_schiffe'];
        $spieler_3_basen=$array2['spieler_3_basen'];$spieler_3_planeten=$array2['spieler_3_planeten'];$spieler_3_schiffe=$array2['spieler_3_schiffe'];
        $spieler_4_basen=$array2['spieler_4_basen'];$spieler_4_planeten=$array2['spieler_4_planeten'];$spieler_4_schiffe=$array2['spieler_4_schiffe'];
        $spieler_5_basen=$array2['spieler_5_basen'];$spieler_5_planeten=$array2['spieler_5_planeten'];$spieler_5_schiffe=$array2['spieler_5_schiffe'];
        $spieler_6_basen=$array2['spieler_6_basen'];$spieler_6_planeten=$array2['spieler_6_planeten'];$spieler_6_schiffe=$array2['spieler_6_schiffe'];
        $spieler_7_basen=$array2['spieler_7_basen'];$spieler_7_planeten=$array2['spieler_7_planeten'];$spieler_7_schiffe=$array2['spieler_7_schiffe'];
        $spieler_8_basen=$array2['spieler_8_basen'];$spieler_8_planeten=$array2['spieler_8_planeten'];$spieler_8_schiffe=$array2['spieler_8_schiffe'];
        $spieler_9_basen=$array2['spieler_9_basen'];$spieler_9_planeten=$array2['spieler_9_planeten'];$spieler_9_schiffe=$array2['spieler_9_schiffe'];
        $spieler_10_basen=$array2['spieler_10_basen'];$spieler_10_planeten=$array2['spieler_10_planeten'];$spieler_10_schiffe=$array2['spieler_10_schiffe'];
        $spieler_1_gesamt=$array2['spieler_1_platz'];
        $spieler_2_gesamt=$array2['spieler_2_platz'];
        $spieler_3_gesamt=$array2['spieler_3_platz'];
        $spieler_4_gesamt=$array2['spieler_4_platz'];
        $spieler_5_gesamt=$array2['spieler_5_platz'];
        $spieler_6_gesamt=$array2['spieler_6_platz'];
        $spieler_7_gesamt=$array2['spieler_7_platz'];
        $spieler_8_gesamt=$array2['spieler_8_platz'];
        $spieler_9_gesamt=$array2['spieler_9_platz'];
        $spieler_10_gesamt=$array2['spieler_10_platz'];
        $spieler_1_raus=$array2['spieler_1_raus'];
        $spieler_2_raus=$array2['spieler_2_raus'];
        $spieler_3_raus=$array2['spieler_3_raus'];
        $spieler_4_raus=$array2['spieler_4_raus'];
        $spieler_5_raus=$array2['spieler_5_raus'];
        $spieler_6_raus=$array2['spieler_6_raus'];
        $spieler_7_raus=$array2['spieler_7_raus'];
        $spieler_8_raus=$array2['spieler_8_raus'];
        $spieler_9_raus=$array2['spieler_9_raus'];
        $spieler_10_raus=$array2['spieler_10_raus'];
        $ziel_id=$array2['ziel_id'];
        $ziel_info=$array2['ziel_info'];
        $nebel=$array2['nebel'];
        $aufloesung=$array2['aufloesung'];
        $spieleranzahl=$array2['spieleranzahl'];
        $spiel_name=$array2['name'];
        $umfang=$array2['umfang'];
        $spiel_out=$array2['oput'];
        $plasma_wahr=$array2['plasma_wahr'];
        $plasma_max=$array2['plasma_max'];
        $plasma_lang=$array2['plasma_lang'];
        $piraten_mitte=$array2['piraten_mitte'];
        $piraten_aussen=$array2['piraten_aussen'];
        $piraten_min=$array2['piraten_min'];
        $piraten_max=$array2['piraten_max'];
    } else {
        if ((preg_match ("/kommunikation_exch/i",$SCRIPT_NAME)) or (preg_match ("/kommunikation_exch/i",$SCRIPT_FILENAME))) {
            header("Location: kommunikation_exch.php?fu=7"); exit;
        } else {
            header("Location: ../index.php?sprache=".$spieler_sprache); exit;
        }
    }
} else {
    if ((preg_match ("/kommunikation_exch/i",$SCRIPT_NAME)) or (preg_match ("/kommunikation_exch/i",$SCRIPT_FILENAME))) {
        header("Location: kommunikation_exch.php?fu=7"); exit;
    } else {
        header("Location: ../index.php"); exit;
    }
}
