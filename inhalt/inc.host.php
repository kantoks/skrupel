<?php
include ('inc.host_func.php');
if ($main_verzeichnis!='../') $main_verzeichnis='';
define('DATADIR', $main_verzeichnis.'daten/');
define('INCLUDEDIR', $main_verzeichnis.'inhalt/');
define('LANGUAGEDIR', $main_verzeichnis.'lang/');
$xstats_verzeichnis = $main_verzeichnis.'extend/xstats';
if (@intval(substr($spiel_extend,1,1))==1) {
    include("../extend/ki/ki_basis/berechneKI.php");
}
if ((@file_exists($xstats_verzeichnis)) and (intval(substr($spiel_extend,2,1))==1)) {
    include($xstats_verzeichnis.'/xstatsCollect.php');
}
///////////////////////////////Sprachinclude(nur die benoetigten) Anfang
$zeiger = mysql_query("SELECT * FROM $skrupel_spiele WHERE id=$spiel");
$sprachtemp_1 = mysql_fetch_array($zeiger);
$sprachen = array();
for ($i=1; $i<=10; $i++){
    $spieler = 'spieler_'.$i;
    if($sprachtemp_1[$spieler] > 0) {
        $zeiger = mysql_query("SELECT * FROM $skrupel_user WHERE id={$sprachtemp_1[$spieler]}");
        $sprachtemp_3 = mysql_fetch_array($zeiger);
        $spielersprache[$i] = ($sprachtemp_3['sprache']=='') ? $language : $sprachtemp_3['sprache'];
        if (in_array($sprachtemp_3['sprache'], $sprachen)) $sprachen[] = $sprachtemp_3['sprache'];
    }
}
if(count($sprachen) == 0) {
    include(LANGUAGEDIR.$language.'/lang.inc.host.php');
} else {
    foreach($sprachen as $sprache) {
        include(LANGUAGEDIR.$sprache.'/lang.inc.host.php');
    }
}
///////////////////////////////Sprachinclude(nur die benoetigten) Ende
srand((double)microtime()*1000000);
mt_srand(time());
$mt_randmax=mt_getrandmax();
$schiffverschollen=0;
$neuekolonie=0;
$neueschiffe=0;
$neuebasen=0;
$schiffevernichtet=0;
$planetenerobert=0;
$planetenerobertfehl=0;
mysql_query("DELETE FROM $skrupel_kampf WHERE spiel=$spiel");
mysql_query("DELETE FROM $skrupel_nebel WHERE spiel=$spiel");
mysql_query("DELETE FROM $skrupel_scan WHERE spiel=$spiel");
mysql_query("DELETE FROM $skrupel_neuigkeiten WHERE sicher=0 AND spiel_id=$spiel AND (art<=4 OR art=7 OR art=8)");
///////////////////////////////////////////////////////////////////////////////////////////////RASSENEIGENSCHAFTEN ANFANG
$handle = opendir(DATADIR);
if ($handle) {
    while ($rasse = readdir($handle)) {
        if (is_dir(DATADIR.$rasse) && is_file(DATADIR.$rasse.'/daten.txt')) {
            $rassendaten = rasse_laden(DATADIR.$rasse.'/daten.txt');
            if ($rassendaten) $r_eigenschaften[$rasse] = $rassendaten;
        }
    }
    closedir($handle);
}
///////////////////////////////////////////////////////////////////////////////////////////////RASSENEIGENSCHAFTEN ENDE
///////////////////////////////////////////////////////////////////////////////////////////////SPIELEREIGENSCHAFTEN ANFANG
for ($k=1; $k<=10; $k++) {
    $s_eigenschaften[$k]['rasse']=$spieler_rasse_c[$k];
}
///////////////////////////////////////////////////////////////////////////////////////////////SPIELEREIGENSCHAFTEN ENDE
///////////////////////////////////////////////////////////////////////////////////////////////BEGEGNUNGEN ANFANG
if ($module[4]==1) {
    $begegnungen = array();
    $zeiger = mysql_query("SELECT partei_a,partei_b FROM $skrupel_begegnung where spiel=$spiel");
    $polanzahl = mysql_num_rows($zeiger);
    if ($polanzahl>=1) {
        for  ($i=0; $i<$polanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $partei_a=$array["partei_a"];
        $partei_b=$array["partei_b"];
        $begegnung[$partei_a][$partei_b]=1;
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////BEGEGNUNGEN ENDE
///////////////////////////////////////////////////////////////////////////////////////////////WAFFENWERTE ANFANG
$strahlenschaden = array ('0','3','7','10','15','12','29','35','37','18','45');
$strahlenschadencrew = array ('0','1','2','2','4','16','7','8','9','33','11');
$torpedoschaden = array ('0','5','8','10','6','15','30','35','12','48','55');
$torpedoschadencrew = array ('0','1','2','2','13','6','7','8','36','12','14');
///////////////////////////////////////////////////////////////////////////////////////////////WAFFENWERTE ENDE
///////////////////////////////////////////////////////////////////////////////////////////////STATS INITIALISIEREN ANFANG
$stat_sieg = array_fill(1, 10, 0);
$stat_schlacht = array_fill(1, 10, 0);
$stat_schlacht_sieg = array_fill(1, 10, 0);
$stat_kol_erobert = array_fill(1, 10, 0);
$stat_lichtjahre = array_fill(1, 10, 0);
///////////////////////////////////////////////////////////////////////////////////////////////STATS INITIALISIEREN ENDE
///////////////////////////////////////////////////////////////////////////////////////////////POLITIKSTATUS ANFANG
//tabelle initialisieren
$beziehung = array_fill(1, 10, array_fill(1, 10, array('status'=>0, 'optionen'=>0)));
$zeiger = mysql_query("SELECT partei_a,partei_b,status,optionen FROM $skrupel_politik WHERE spiel=$spiel");
while($array = mysql_fetch_array($zeiger)) {
    list($partei_a, $partei_b, $status, $optionen) = $array;
    $beziehung[$partei_a][$partei_b]['status']   = $status;
    $beziehung[$partei_b][$partei_a]['status']   = $status;
    $beziehung[$partei_a][$partei_b]['optionen'] = $optionen;
    $beziehung[$partei_b][$partei_a]['optionen'] = $optionen;
}
///////////////////////////////////////////////////////////////////////////////////////////////POLITIKSTATUS ENDE
///////////////////////////////////////////////////////////////////////////////////////////////ROUTESTARTEN ANFANG
$zeiger = mysql_query("SELECT * FROM $skrupel_schiffe where flug=0 and status=2 and routing_status=2 and spiel=$spiel order by id");
$schiffanzahl = mysql_num_rows($zeiger);
if ($schiffanzahl>=1) {
    for  ($i=0; $i<$schiffanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $besitzer=$array["besitzer"];
        $volk=$array["volk"];
        $shid=$array["id"];
        $name=$array["name"];
        $bild_gross=$array["bild_gross"];
        $routing_id=$array["routing_id"];
        $routing_koord=$array["routing_koord"];
        $routing_schritt=$array["routing_schritt"];
        $routing_warp=$array["routing_warp"];
        $routing_mins=$array["routing_mins"];
        $routing_mins_temp=explode(":",$routing_mins);
        $mins=$routing_mins_temp[$routing_schritt];
        $mins_cantox=substr($mins,0,1);
        $mins_vorrat=substr($mins,1,1);
        $mins_lemin=substr($mins,2,1);
        $mins_min1=substr($mins,3,1);
        $mins_min2=substr($mins,4,1);
        $mins_min3=substr($mins,5,1);
        $leuts_kol=(int)substr($mins,7,7);
        $leuts_lbt=(int)substr($mins,14,4);
        $leuts_sbt=(int)substr($mins,18,4);
        $frachtraum=$array["frachtraum"];
        $leichtebt=$array["leichtebt"];
        $schwerebt=$array["schwerebt"];
        $fracht_leute=$array["fracht_leute"];
        $fracht_cantox=$array["fracht_cantox"];
        $fracht_vorrat=$array["fracht_vorrat"];
        $fracht_min1 = $array["fracht_min1"];
        $fracht_min2 = $array["fracht_min2"];
        $fracht_min3 = $array["fracht_min3"];
        $voll_laden=substr($mins,6,1);
        if(($voll_laden!=1)or($mins_vorrat==1)or($mins_min1==1)or($mins_min2==1)or($mins_min3==1)or($leuts_kol==1)or($leuts_kol>2)or($leuts_lbt==1)or($leuts_lbt>2)or($leuts_sbt==1)or($leuts_sbt>2)){
             if(($voll_laden!=1)or((round(($fracht_leute/100)+($leichtebt*0.3)+($schwerebt*1.5)+0.5)+$fracht_vorrat+$fracht_min1+$fracht_min2+$fracht_min3)>=$frachtraum)){
                $routing_points_temp=explode("::",$routing_koord);
                if ($routing_schritt==count($routing_points_temp)-2) {
                    $routing_schritt=0;} else {$routing_schritt++;
                }
                $routing_points=explode(":",$routing_points_temp[$routing_schritt]);
                $routing_id_temp=explode(":",$routing_id);
                $zielx=$routing_points[0];
                $ziely=$routing_points[1];
                $warp=$routing_warp;
                $zielid=$routing_id_temp[$routing_schritt];
                $zeigertemp = mysql_query("update $skrupel_schiffe set flug=2,warp=$warp,zielx=$zielx,ziely=$ziely,zielid=$zielid,routing_schritt=$routing_schritt where id=$shid");
            } else {
                $zeigertemp = mysql_query("update $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where id=$shid");
            }
        } else {
            neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['flug'][9],array($name));
            $zeigertemp = mysql_query("update $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0,routing_schritt=0,routing_koord='',routing_warp=0,routing_mins='',routing_id='',routing_tank=0,routing_status=0 where id=$shid");
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////ROUTESTARTEN ENDE
///////////////////////////////////////////////////////////////////////////////////////////////MINENAKTION LOESCHEN BEI BEWEGUNG ANFANG
if ($module[2]) {
    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set spezialmission=0 where spiel=$spiel and flug>=1 and (spezialmission=24 or spezialmission=25)");
}
///////////////////////////////////////////////////////////////////////////////////////////////MINENAKTION LOESCHEN BEI BEWEGUNG ENDE
///////////////////////////////////////////////////////////////////////////////////////////////TRAKTORSTRAHL UEBERPRUEFEN ANFANG
$zeiger = mysql_query("SELECT id,traktor_id,besitzer,warp FROM $skrupel_schiffe where spezialmission=21 and spiel=$spiel order by id");
while($array = mysql_fetch_array($zeiger)) {
    list($shid, $traktor_id, $besitzer, $warp) = $array;
    if ($warp>7) {
        mysql_query("UPDATE $skrupel_schiffe SET warp=7 WHERE id=$shid AND spiel=$spiel");
    }
    $zeiger2 = mysql_query("SELECT flug,besitzer,spezialmission FROM $skrupel_schiffe WHERE id=$traktor_id AND spiel=$spiel");
    $array2 = mysql_fetch_array($zeiger2);
    list($flug, $besitzer2, $spezialmission) = $array2;
    if ($flug>0 || $spezialmission>0 || $besitzer!=$besitzer2) {
        mysql_query("UPDATE $skrupel_schiffe SET spezialmission=0,traktor_id=0 WHERE id=$shid AND spiel=$spiel");
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////TRAKTORSTRAHL UEBERPRUEFEN ENDE
///////////////////////////////////////////////////////////////////////////////////////////////SCHIFFSUEBERGABE ANFANG
$zeiger = mysql_query("SELECT * FROM $skrupel_schiffe where spezialmission>=31 and spezialmission<=40 and !(volk='unknown' and klasseid=1) and spiel=$spiel order by id");
while($array = mysql_fetch_array($zeiger)) {
    $shid=$array['id'];
    $name=$array['name'];
    $volk=$array['volk'];
    $besitzer=$array['besitzer'];
    $bild_gross=$array['bild_gross'];
    $spezialmission=$array['spezialmission'];
    $neu_besitzer = $spezialmission-30;
    $neu_nick_besitzer = nick($spieler_id_c[$neu_besitzer]);
    $nick_besitzer = nick($spieler_id_c[$besitzer]);
    neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['uebergabe'][0],array($name,'<font color='.$spielerfarbe[$neu_besitzer].'>'.$neu_nick_besitzer.'</font>'));
    neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$neu_besitzer,$lang['host'][$spielersprache[$neu_besitzer]]['uebergabe'][1],array('<font color='.$spielerfarbe[$besitzer].'>'.$nick_besitzer.'</font>',$name));
    mysql_query("UPDATE $skrupel_schiffe set spezialmission=0,besitzer=$neu_besitzer,fracht_leute=0,schwerebt=0,leichtebt=0,ordner=0 where id=$shid");
}
///////////////////////////////////////////////////////////////////////////////////////////////SCHIFFSUBERGABE ENDE
///////////////////////////////////////////////////////////////////////////////////////////////PLASMASTURM - SCHIFFE ANFANG
$zeiger = mysql_query("SELECT * FROM $skrupel_anomalien where spiel=$spiel and art=4 order by id");
$datensaetze = mysql_num_rows($zeiger);
if ($datensaetze>=1) {
    for  ($i=0; $i<$datensaetze;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $x_pos=$array["x_pos"];
        $y_pos=$array["y_pos"];
        $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set spezialmission=0 where (spezialmission=13 or spezialmission=11 or spezialmission=12 or spezialmission=8 or spezialmission=7 or spezialmission=9 or spezialmission=10) and kox>=$x_pos and kox<=$x_pos+10 and koy>=$y_pos and koy<=$y_pos+10 and zusatzmodul<>9 and spiel=$spiel");
        $zeiger_temp = mysql_query("SELECT id,warp,plasmawarp FROM $skrupel_schiffe where warp>5 and kox>=$x_pos and kox<=$x_pos+10 and koy>=$y_pos and koy<=$y_pos+10 and zusatzmodul<>9 and spiel=$spiel order by id");
        $datensaetze_temp = mysql_num_rows($zeiger_temp);
        if ($datensaetze_temp>=1) {
            for  ($j=0; $j<$datensaetze_temp;$j++) {
                $ok = mysql_data_seek($zeiger_temp,$j);
                $array_temp = mysql_fetch_array($zeiger_temp);
                $shid = $array_temp["id"];
                $warp = $array_temp["warp"];
                $plasmawarp = $array_temp["plasmawarp"];
                $plasmawarp = max(0,$warp,$plasmawarp);
                $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set plasmawarp=$plasmawarp,warp=5 where spiel=$spiel and id=$shid");
            }
        }
    }
}
$zeiger = mysql_query("SELECT * FROM $skrupel_schiffe where spiel=$spiel and plasmawarp<>0 order by id");
$datensaetze = mysql_num_rows($zeiger);
if ($datensaetze>=1) {
    for  ($i=0; $i<$datensaetze;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $shid=$array["id"];
        $kox=$array["kox"];
        $koy=$array["koy"];
        $plasmawarp=$array["plasmawarp"];
        $zeiger_temp = mysql_query("SELECT * FROM $skrupel_anomalien where art=4 and x_pos<=$kox and x_pos>=$kox-10 and y_pos<=$koy and y_pos>=$koy-10 and spiel=$spiel order by id");
        $datensaetze_temp = mysql_num_rows($zeiger_temp);
        if ($datensaetze_temp>=1){
        } else {
            $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set warp=$plasmawarp, plasmawarp=0 where spiel=$spiel and id=$shid");
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////PLASMASTURM - SCHIFFE ENDE
///////////////////////////////////////////////////////////////////////////////////////////////BODENKAMPF ANFANG
$zeiger = mysql_query("SELECT * FROM $skrupel_planeten where kolonisten_spieler>=1 and ((kolonisten_new>=1) or (leichtebt_new>=1) or (schwerebt_new>=1)) and besitzer>=1 and spiel=$spiel order by id");
$planetenanzahl = mysql_num_rows($zeiger);
if ($planetenanzahl>0) {
    include(INCLUDEDIR.'inc.host_bodenkampf.php');
}
///////////////////////////////////////////////////////////////////////////////////////////////BODENKAMPF ENDE
///////////////////////////////////////////////////////////////////////////////////////////////WELLENGENERATOR ANFANG
$reichweite = 65;
$zeiger = mysql_query("SELECT * FROM $skrupel_schiffe WHERE spezialmission=70 and spiel=$spiel order by id");
while($array = mysql_fetch_array($zeiger)) {
    $shid = $array["id"];
    $name = $array["name"];
    $kox = $array["kox"];
    $koy = $array["koy"];
    $volk = $array["volk"];
    $besitzer = $array["besitzer"];
    $bild_gross = $array["bild_gross"];
    $vomisaan = $array["fracht_min3"];
    $fertigkeiten=$array["fertigkeiten"];
    $wellengenerator_fert=intval(substr($fertigkeiten,60,1));
    if ($wellengenerator_fert>=1 && $vomisaan >= $wellengenerator_fert) {
        $erfolg = false;
        $zeiger_temp = mysql_query("SELECT * FROM $skrupel_schiffe WHERE (sqrt(((kox-$kox)*(kox-$kox))+((koy-$koy)*(koy-$koy)))<=$reichweite) and spiel=$spiel order by id");
        while($array_temp = mysql_fetch_array($zeiger_temp)) {
            $t_shid = $array_temp["id"];
            $t_name = $array_temp["name"];
            $t_volk = $array_temp["volk"];
            $t_besitzer = $array_temp["besitzer"];
            $t_bild_gross = $array_temp["bild_gross"];
            $t_spezialmission = $array_temp["spezialmission"];
            $t_warp = $array_temp["warp"];
            $zielx = $array_temp["kox"];
            $ziely = $array_temp["koy"];
            $lichtjahre2 = ($kox-$zielx)*($kox-$zielx)+($koy-$ziely)*($koy-$ziely);
            if($lichtjahre2 <= $reichweite*$reichweite) {
                if(($t_spezialmission!=7 && $t_spezialmission!=16) || $t_besitzer==$besitzer || ($beziehung[$besitzer][$t_besitzer]['status']>=3 && $beziehung[$besitzer][$t_besitzer]['status']<=5)) {
                    if($t_warp > 7) {
                        neuigkeiten(2,"../daten/$t_volk/bilder_schiffe/$t_bild_gross",$t_besitzer,$lang['host'][$spielersprache[$t_besitzer]]['wellengenerator'][2],array($t_name));
                        mysql_query("UPDATE $skrupel_schiffe set warp=7 where id=$t_shid");
                    }
                } else {
                    $erfolg = true;
                    neuigkeiten(2,"../daten/$t_volk/bilder_schiffe/$t_bild_gross",$t_besitzer,$lang['host'][$spielersprache[$t_besitzer]]['wellengenerator'][0],array($t_name));
                    mysql_query("UPDATE $skrupel_schiffe set spezialmission=0,warp=0,flug=0,zielx=0,ziely=0,zielid=0 where id=$t_shid");
                }
            }
        }
        $vomisaan -= $wellengenerator_fert;
        mysql_query("UPDATE $skrupel_schiffe set fracht_min3=$vomisaan where id=$shid");
        if ($erfolg) {
            neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['wellengenerator'][3],array($name));
        }
    } else {
        neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['wellengenerator'][1],array($name));
        mysql_query("UPDATE $skrupel_schiffe set spezialmission=0 where id=$shid");
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////WELLENGENERATOR ENDE
///////////////////////////////////////////////////////////////////////////////////////////////SPRUNGTRIEBWERK ANFANG
$zeiger = mysql_query("SELECT * FROM $skrupel_schiffe where flug>=1 and flug<=2 and status>0 and spezialmission=7 and spiel=$spiel order by id");
$schiffanzahl = mysql_num_rows($zeiger);
if ($schiffanzahl>=1) {
    for  ($i=0; $i<$schiffanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $shid=$array["id"];
        $name=$array["name"];
        $kox=$array["kox"];
        $koy=$array["koy"];
        $flug=$array["flug"];
        $zielx=$array["zielx"];
        $ziely=$array["ziely"];
        $volk=$array["volk"];
        $besitzer=$array["besitzer"];
        $bild_gross=$array["bild_gross"];
        $lemin=$array["lemin"];
        $fertigkeiten=$array["fertigkeiten"];
        $spezialmission=$array["spezialmission"];
        $status=$array["status"];
        $fert_sprung_kosten=intval(substr($fertigkeiten,11,3));
        $fert_sprung_min=intval(substr($fertigkeiten,14,4));
        $fert_sprung_max=intval(substr($fertigkeiten,18,4));
        if ($lemin>=$fert_sprung_kosten) {
            $lichtjahre=sqrt(($kox-$zielx)*($kox-$zielx)+($koy-$ziely)*($koy-$ziely));
            $reichweite=mt_rand($fert_sprung_min,$fert_sprung_max);
            $faktor=$reichweite/$lichtjahre;
            $strecke_x=($zielx-$kox)*$faktor;
            $strecke_y=($ziely-$koy)*$faktor;
            $kox_neu=$kox+$strecke_x;
            $koy_neu=$koy+$strecke_y;
            $lemin=$lemin-$fert_sprung_kosten;
            $rand_x_a = max(min($kox,$kox_neu),1);
            $rand_x_b = min(max($kox,$kox_neu),$umfang);
            $rand_y_a = max(min($koy,$koy_neu),1);
            $rand_y_b = min(max($koy,$koy_neu),$umfang);
            $zeiger_temp = mysql_query("SELECT * FROM $skrupel_schiffe WHERE kox>=$rand_x_a and kox<=$rand_x_b and koy>=$rand_y_a and koy<=$rand_y_b and spezialmission=70 and spiel=$spiel order by kox ".($kox<$kox_neu?"asc":"desc").", koy ".($koy<$koy_neu?"asc":"desc"));
            while($array_temp = mysql_fetch_array($zeiger_temp)) {
                $t_kox = $array_temp["kox"];
                $t_koy = $array_temp["koy"];
                $t_besitzer = $array_temp["besitzer"];
                $t_name = $array_temp["name"];
                $t_volk = $array_temp["volk"];
                $t_bild_gross = $array_temp["bild_gross"];
                if ($t_besitzer != $besitzer && $beziehung[$besitzer][$t_besitzer]['status'] < 3) {
                    $co1 = (($t_kox-$kox)*($kox_neu-$kox)+($t_koy-$koy)*($koy_neu-$koy));
                    $c_ = sqrt(($t_kox-$kox)*($t_kox-$kox)+($t_koy-$koy)*($t_koy-$koy));
                    $a_ = sin(acos($co1/(($c_*$reichweite)+1)))*$c_;
                    if ($a_ <= 65) {
                        $reichweite2 = sqrt($c_*$c_ - $a_*$a_);
                        $faktor = $reichweite2/$lichtjahre;
                        $kox_neu = intval($kox+($zielx-$kox)*$faktor);
                        $koy_neu = intval($koy+($ziely-$koy)*$faktor);
                        neuigkeiten(2,"../daten/$t_volk/bilder_schiffe/$t_bild_gross",$t_besitzer,$lang['host'][$spielersprache[$t_besitzer]]['wellengenerator'][4],array($t_name));
                        neuigkeiten(2,"../bilder/news/sprung.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['sprungtriebwerk'][3],array($name,(int)$reichweite2));
                        $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set spezialmission=0,kox=$kox_neu, koy=$koy_neu, lemin=$lemin, flug=0, status=1 where id=$shid");
                        continue(2);
                    }
                }
            }
            if (($kox_neu>=10) and ($kox_neu<=$umfang-13) and ($koy_neu>=10) and ($koy_neu<=$umfang-13)) {
                neuigkeiten(2,"../bilder/news/sprung.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['sprungtriebwerk'][0],array($name,$reichweite));
                $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set spezialmission=0,kox=$kox_neu, koy=$koy_neu, lemin=$lemin, flug=0, status=1 where id=$shid");
            } else {
                $schiffverschollen++;
                neuigkeiten(2,"../bilder/news/sprung.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['sprungtriebwerk'][1],array($name));
                $zeiger_temp = mysql_query("DELETE FROM $skrupel_schiffe where id=$shid");
                $zeiger_temp = mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 's:$shid:%'");
                $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where flug=3 and zielid=$shid");
            }
        } else {
            neuigkeiten(2,"../bilder/news/sprung.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['sprungtriebwerk'][2],array($name));
            $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set spezialmission=0,flug=0 where id=$shid");
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////SPRUNGTRIEBWERK ANFANG
///////////////////////////////////////////////////////////////////////////////////////////////SUBRAUMVERZERRUNG ANFANG
$zeiger = mysql_query("SELECT * FROM $skrupel_schiffe where spezialmission=9 and spiel=$spiel order by id");
$schiffanzahl = mysql_num_rows($zeiger);
if ($schiffanzahl>=1) {
    for  ($i=0; $i<$schiffanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $shid=$array["id"];
        $name=$array["name"];
        $klasse=$array["klasse"];
        $antrieb=$array["antrieb"];
        $klasseid=$array["klasseid"];
        $kox=$array["kox"];
        $koy=$array["koy"];
        $volk=$array["volk"];
        $besitzer=$array["besitzer"];
        $bild_gross=$array["bild_gross"];
        $fertigkeiten=$array["fertigkeiten"];
        $fert_subver=intval(substr($fertigkeiten,23,1));
        $sub_schaden=$fert_subver*50;
        $zeiger_temp = mysql_query("SELECT * FROM $skrupel_schiffe where (sqrt((($kox-kox)*($kox-kox))+(($koy-koy)*($koy-koy)))<=83) and spezialmission<>9 and spiel=$spiel order by id");
        $treffschiff = mysql_num_rows($zeiger_temp);
        if ($treffschiff>=1) {
            for ($k=0; $k<$treffschiff;$k++) {
                $ok2 = mysql_data_seek($zeiger_temp,$k);
                $array_temp = mysql_fetch_array($zeiger_temp);
                $t_shid=$array_temp["id"];
                $t_name=$array_temp["name"];
                $t_klasse=$array_temp["klasse"];
                $t_antrieb=$array_temp["antrieb"];
                $t_klasseid=$array_temp["klasseid"];
                $t_volk=$array_temp["volk"];
                $t_besitzer=$array_temp["besitzer"];
                $t_bild_gross=$array_temp["bild_gross"];
                $t_schaden=$array_temp["schaden"];
                $t_masse=$array_temp["masse"];
                $zielx=$array_temp["kox"];
                $ziely=$array_temp["koy"];
                $schaden=round($t_schaden+($sub_schaden*(80/($t_masse+1))*(80/($t_masse+1))+2));
                if ($schaden<100) {
                    neuigkeiten(2,"../daten/$t_volk/bilder_schiffe/$t_bild_gross",$t_besitzer,$lang['host'][$spielersprache[$t_besitzer]]['subraumverzerrer'][0],array($t_name,$schaden));
                    $zeiger_temp2 = mysql_query("UPDATE $skrupel_schiffe set schaden=$schaden where id=$t_shid");
                }
                if ($schaden>=100) {
                    neuigkeiten(2,"../daten/$t_volk/bilder_schiffe/$t_bild_gross",$t_besitzer,$lang['host'][$spielersprache[$t_besitzer]]['subraumverzerrer'][1],array($t_name));
                    $zeiger_temp2 = mysql_query("DELETE FROM $skrupel_schiffe where id=$t_shid");
                    $zeiger_temp2 = mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 's:$t_shid:%'");
                    $zeiger_temp2 = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where (flug=3 or flug=4) and zielid=$t_shid");
                }
            }
        }
        $zeiger_temp = mysql_query("SELECT * FROM $skrupel_anomalien where (sqrt(($kox-x_pos)*($kox-x_pos)+($koy-y_pos)*($koy-y_pos))<=83) and art=3 and spiel=$spiel order by id");
        $trefffalte = mysql_num_rows($zeiger_temp);
        if ($trefffalte>=1) {
            for ($k=0; $k<$trefffalte;$k++) {
                $ok2 = mysql_data_seek($zeiger_temp,$k);
                $array_temp = mysql_fetch_array($zeiger_temp);
                $fid=$array_temp["id"];
                $war=mt_rand(1,10);
                if($war<=$fert_subver){
                    $zeiger_temp2 = mysql_query("DELETE FROM $skrupel_anomalien where id=$fid");
                }
            }
        }
        neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['subraumverzerrer'][2],array($name));
        $zeiger_temp2 = mysql_query("DELETE FROM $skrupel_schiffe where id=$shid");
        $zeiger_temp2 = mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 's:$shid:%'");
        $zeiger_temp2 = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where (flug=3 or flug=4) and zielid=$shid");
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////SUBRAUMVERZERRUNG ENDE
///////////////////////////////////////////////////////////////////////////////////////////////LOYDS FLUCHTMANOEVER ANFANG
$zeiger = mysql_query("SELECT * FROM $skrupel_schiffe where spezialmission=16 and spiel=$spiel order by id");
$schiffanzahl = mysql_num_rows($zeiger);
if ($schiffanzahl>=1) {
    for  ($i=0; $i<$schiffanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $shid=$array["id"];
        $name=$array["name"];
        $volk=$array["volk"];
        $schaden=$array["schaden"];
        $besitzer=$array["besitzer"];
        $bild_gross=$array["bild_gross"];
        $spezialmission=$array["spezialmission"];
        $fertigkeiten=$array["fertigkeiten"];
        $s_x=$array["s_x"];
        $s_y=$array["s_y"];
        $fluchtmanoever=intval(substr($fertigkeiten,38,2));
        $kox=$s_x;
        $koy=$s_y;
        if ($fluchtmanoever==1) {
            $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set spezialmission=0,kox=$kox,koy=$koy,flug=0,warp=0,zielx=0,ziely=0,zielid=0 where id=$shid");
            $zeiger_temp2 = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where (flug=3 or flug=4) and zielid=$shid");
            neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['fluchtmanoever'][0],array($name));
        }
        if ($fluchtmanoever>=2) {
            $schadenbumm=mt_rand(1,$fluchtmanoever);
            $schaden=$schaden+$schadenbumm;
            if ($schaden<100) {
                neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['fluchtmanoever'][1],array($name,$schadenbumm));
                $zeiger_temp2 = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where (flug=3 or flug=4) and zielid=$shid");
                $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set schaden=$schaden,spezialmission=0,kox=$kox,koy=$koy,flug=0,warp=0,zielx=0,ziely=0,zielid=0 where id=$shid");
            }
            if ($schaden>=100) {
                neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['fluchtmanoever'][2],array($name));
                $zeiger_temp2 = mysql_query("DELETE FROM $skrupel_schiffe where id=$shid");
                $zeiger_temp2 = mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 's:$shid:%'");
                $zeiger_temp2 = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where (flug=3 or flug=4) and zielid=$shid");
            }
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////LOYDS FLUCHTMANOEVER ENDE
///////////////////////////////////////////////////////////////////////////////////////////////FLUG ANFANG
//alte Koordinaten und temp_verfolgt nullen
mysql_query("UPDATE $skrupel_schiffe SET kox_old=0,koy_old=0,temp_verfolgt=0 WHERE spiel=$spiel");
//Verfolger auf 1 setzen
mysql_query("UPDATE $skrupel_schiffe SET temp_verfolgt=1 WHERE spiel=$spiel AND flug>2");
//setze temp_verfolgt auf 1 bei allen Schiffen die verfolgt werden
$zeiger = mysql_query("SELECT DISTINCT zielid FROM $skrupel_schiffe where flug>2 and spiel=$spiel");
while($array = mysql_fetch_array($zeiger)) {
    $zid = $array['zielid'];
    mysql_query("UPDATE $skrupel_schiffe SET temp_verfolgt=1 WHERE spiel=$spiel AND id=$zid ");
}
$zeiger = mysql_query("SELECT id,zielid,flug,kox,koy FROM $skrupel_schiffe WHERE flug>0 AND status>0 AND spiel=$spiel AND temp_verfolgt=1 ORDER BY zielid DESC");
$schiffanzahl = mysql_num_rows($zeiger);
if($schiffanzahl>0){
    for  ($i=0; $i< $schiffanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        //erzeuge das Arbeitsarray mit dem wir arbeiten
        $feld_shid[$i]=$array["id"];
        $feld_zielid[$i]=$array["zielid"];
        $feld_flug[$i]=$array["flug"];
        $feld_kox[$i]=$array["kox"];
        $feld_koy[$i]=$array["koy"];
        $feld_flags[$i]=0;
        $feld_schlange[$i]=0;
    }
    //Beginn der Herstellung der Abarbeitungsreihenfolge fuer den Flug
    for  ($i=0; $i< $schiffanzahl;$i++) {
        //nur noch nicht bearbeitete Objekte bearbeiten
        if($feld_schlange[$i]==0){
            $j=$i;
            $anzahl_schlange=0;
            $abbruch_1=1;
            while($abbruch_1){
                $anzahl_schlange++;
                $feld_flags[$j]=$anzahl_schlange;
                $test_ob_zielid_vorhanden=array_search($feld_zielid[$j],$feld_shid);
                if($feld_shid[$test_ob_zielid_vorhanden]==$feld_zielid[$j]){
                    $test_ob_zielid_vorhanden++;
                }else{
                }
                //Test ob ein Schiff das Ende einer normalen Schlange ist
                if(($feld_flug[$j]>2)&&($test_ob_zielid_vorhanden!=false)){
                    $j=$test_ob_zielid_vorhanden-1;
                    //hier haben wir einen Kreis entdeckt
                    if($feld_flags[$j]) {
                        $zwischenwert=-$feld_flags[$j]-1;
                        $j=$i;
                        $abbruch_2=1;
                        do{
                            //wir setzen alle Schiffe in der Schlange die vor dem Kreis sind auf -1< je nach position in der Schlange und alle im Kreis auf -1
                            if($feld_flags[$j]==0){
                                $abbruch_2=0;
                            }else{
                                $feld_schlange[$j]=min(++$zwischenwert,-1);
                                $feld_flags[$j]=0;
                                $j=array_search($feld_zielid[$j],$feld_shid);
                            }
                        }while($abbruch_2);
                        $abbruch_1=0;
                    }else{
                        //hier treffen wir das Ende einer Schon bearbeiteten Schlange
                        if($feld_schlange[$j]!=0){
                            $abbruch_1=0;
                            if($feld_schlange[$j]< 0){
                                //hier treffen wir eine Minusschlange also eine die in einem Kreis endet
                                //wir fuegen also noch betragsmaessig groessere Minuswerte an
                                $zwischenwert=$feld_schlange[$j]-$anzahl_schlange;
                                $j=$i;
                                do{
                                    $abbruch_2=0;
                                    $feld_schlange[$j]=$zwischenwert++;
                                    if($feld_flags[$j]==0){
                                        $abbruch_2=0;
                                    }
                                    $feld_flags[$j]=0;
                                    $j=array_search($feld_zielid[$j],$feld_shid);
                                }while($abbruch_2);
                            }else{
                                //hier treffen wir das ende einer Ordentlichen Schlange wir merken uns wieder die Positionen erhoeht um die des Endes auf das wir trafen
                                $zwischenwert=$feld_schlange[$j]+$anzahl_schlange;
                                $j=$i;
                                for($k=0;$k<$anzahl_schlange;$k++){
                                    $feld_schlange[$j]=$zwischenwert-$k;
                                    $feld_flags[$j]=0;
                                    $j=array_search($feld_zielid[$j],$feld_shid);
                                }
                            }
                        }
                    }
                }else{
                    //hier haben wir also eine ordentlich schlange die mit eine Schiff endet das kein anderes verfolgt
                    $abbruch_1=0;
                    $j=$i;
                    //wir merken uns schonmal welche wir Schiffe bearbeitet haben und auch an welcehr position sie in der schlange waren
                    for($k=0;$k< $anzahl_schlange;$k++){
                        $feld_schlange[$j]=$anzahl_schlange-$k;
                        $feld_flags[$j]=0;
                        $j=array_search($feld_zielid[$j],$feld_shid);
                    }
                }
            }
        }
    }
}
//So wir haben jetzt folgende Situation:
//Alle Schiffe in Normalen schlangen dh die Mit einem Schiff beginnen das nix verfogt(wert1)und mit einem/mehreren Enden die nicht verfogt werden(groesserer schlangepositionswert) haben einen positiven schlangewert
//Alle Schiffe die in einem Kreis enden dh ein oder Mehrer Schiffe im Ringel die sich verfolgen haben  eine -1 wenn sie dierekt im Kreisel sind oder noch betragsmaessig groessere negative werte wenn sie zum Kreis hinfuehren auch hier kann es sich nach hinten spalten
//wir muessen jetzt noch diese Kreisel aufbrechen dies machen wir in dem wir fuer jeden Kreis(jeweil mit -1) das Geometrische Mittel MP der Koordinaten bestimmen und dann das schiff aus dem Kreis welches den Groessten abstand dazu hat als erstes Schiff einer Neuen ordentlichen Schlange nehmen
//mit Endzielpunk MP, so erhalten wir die Geringste abweichung von einem Tatsaechlichem stetigen resultat einer normalen bewegung, dabei muessen wir aber die Zielid der Schiffe in einem Array fuer alle Kreisel vom  ende der schlange speichern um sie nach dem Flug wieder einzusetzen
$kreisel_anzahl=0;
if($schiffanzahl>0){
    do{
        //wir suchen den ersten kreisel
        $i=array_search(-1,$feld_schlange);
        if($feld_schlange[$i]==-1){
            $schalter=1;
        }else{
            $schalter=0;
        }
        if($schalter){
            $kreisel_anzahl++;
            $j=$i;
            $anzahl_schlange=0;
            $MP_x=0;
            $MP_y=0;
            do{
                $feld_flags[$j]=1;
                $j=array_search($feld_zielid[$j],$feld_shid);
                $MP_x+=$feld_kox[$j];
                $MP_y+=$feld_koy[$j];
                $anzahl_schlange++;
            }while(!$feld_flags[$j]);
            $MP_x=round($MP_x/$anzahl_schlange);
            $MP_y=round($MP_y/$anzahl_schlange);
            //Suche aus schiffen von eben das schiff mit der Groessten entfernung zu MP heraus Speichere zielid shid des schiffes in zweitem array zwischenarray
            $entfernung_1=9;
            for($k=0;$k< $anzahl_schlange;$k++){
                $j=array_search($feld_zielid[$j],$feld_shid);
                $zeiger3 = mysql_query("SELECT warp FROM $skrupel_schiffe where id=$feld_shid[$j] and spiel=$spiel");
                $array3 = mysql_fetch_array($zeiger3);
                $entfernung_2=$array3["warp"];
                //$entfernung_2=((($MP_x-$feld_kox[$j])*($MP_x-$feld_kox[$j]))+(($MP_y-$feld_koy[$j])*($MP_y-$feld_koy[$j])));
                if($entfernung_2<=$entfernung_1){
                    $feldindex_maxentfernung=$j;
                    $entfernung_1=$entfernung_2;
                }
            }
            $zwischenarray_shid[$kreisel_anzahl-1]=$feld_shid[$feldindex_maxentfernung];
            $zwischenarray_zielid[$kreisel_anzahl-1]=$feld_zielid[$feldindex_maxentfernung];
            //neues Temporaeres ziel
            $zeiger2 = mysql_query("UPDATE $skrupel_schiffe set zielx=$MP_x,ziely=$MP_y,zielid=-1 where spiel=$spiel and id=$feld_shid[$feldindex_maxentfernung]");
            //jetzt machen wir endlich aus dem Kreisel eine Schlange
            $ind=$feldindex_maxentfernung;
            for($k=$anzahl_schlange;$k>0;$k--){
                $ind=array_search($feld_zielid[$ind],$feld_shid);
                $feld_schlange[$ind]=$k;
            }
        }
    }while($schalter);
}
//jetzt muessen wir nur noch die Moegliche seitenbuschel als Aeste an die Schlangen anhaengen
//solange wie Schiff mit Schlange < -1 existiert{
//hier tragen wir ein ob kleiner minus eins oder nicht
for($i=0; $i<$schiffanzahl;$i++) {
    if($feld_schlange[$i]<-1) {
        $j=$i;
        do{
            $j=array_search($feld_zielid[$j],$feld_shid);
        }while($feld_schlange[$j]<1);
        $wert=$feld_schlange[$j]-$feld_schlange[$i];
        $j=$i;
        do{
            $feld_schlange[$j]=--$wert;
            $j=array_search($feld_zielid[$j],$feld_shid);
        }while($feld_schlange[$j]<1);
    }
}
//so jetzt schreiben wir noch die werte der Schlangenfelder auf die temp_verfolgt der DB und dann knnen wir danach sortiert auslesen
//e
for($i=0; $i<$schiffanzahl;$i++) {
    $zeiger = mysql_query("UPDATE $skrupel_schiffe set temp_verfolgt=$feld_schlange[$i] where spiel=$spiel and id=$feld_shid[$i]");
}
//so wir haben es geschaft alles ist wohlgeordnet jetzt kann geflogen werden
$zeiger = mysql_query("SELECT * FROM $skrupel_schiffe where flug>0 and status>0 and spiel=$spiel order by temp_verfolgt");
$schiffanzahl = mysql_num_rows($zeiger);
if ($schiffanzahl>=1) {
    for  ($i=0; $i<$schiffanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $rauswurf=1;
        $array = mysql_fetch_array($zeiger);
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
        $warp=$array["warp"];
        $volk=$array["volk"];
        $masse=$array["masse"];
        $masse_gesamt=$array["masse_gesamt"];
        $besitzer=$array["besitzer"];
        $bild_gross=$array["bild_gross"];
        $status=$array["status"];
        $fracht_min2=$array["fracht_min2"];
        $routing_status=$array["routing_status"];
        $zusatzmodul=$array["zusatzmodul"];
        $crew=$array["crew"];
        $crewmax=$array["crewmax"];
        $lemin=$array["lemin"];
        $leminmax=$array["leminmax"];
        $schaden=$array["schaden"];
        $flugbonus=1;
        $spritweniger=0;
        $erfahrung=$array["erfahrung"];
        $energetik_anzahl=$array["energetik_anzahl"];
        $projektile_anzahl=$array["projektile_anzahl"];
        $hanger_anzahl=$array["hanger_anzahl"];
        if (($energetik_anzahl==0) and ($projektile_anzahl==0) and ($hanger_anzahl==0)) { $spritweniger=$erfahrung*8; }
        if ($zusatzmodul==2) { $spritweniger=$spritweniger+11; }
        $kox_old=$kox;
        $koy_old=$koy;
        ////////////////////////////
        $spezialmission=$array["spezialmission"];
        $traktor_id=$array["traktor_id"];
        if ($spezialmission==21) {
            $zeiger2 = mysql_query("SELECT id,masse,spiel FROM $skrupel_schiffe where id=$traktor_id and spiel=$spiel");
            $trakanzahl = mysql_num_rows($zeiger2);
            if ($trakanzahl>=1) {
                $array2 = mysql_fetch_array($zeiger2);
                $masse2=$array2["masse"];
                $masse_gesamt=round($masse+($masse2/2));
            } else {
                $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set spezialmission=0,traktor_id=0 where id=$shid and spiel=$spiel");
            }
        }
        ////////////////////////////overdrive
        $overdrive=0;
        $overdrive_raus=0;
        if (($spezialmission>=61) and ($spezialmission<=69)) {
            $overdrive_stufe=$spezialmission-60;
            $temp=mt_rand(0,100);
            if ($temp<=($overdrive_stufe*10)) {
                $overdrive_raus=1;
                neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['flug'][0],array($name));
            } else {
                $overdrive=1;
                $flugbonus=$flugbonus+($overdrive_stufe*0.1);
            }
        }
        ////////////////////////////
        $streckemehr=0;
        if ($antrieb==1) { $verbrauchpromonat = array ("0","0","0","0","0","0","0","0","0","0"); }
        if ($antrieb==2) { $verbrauchpromonat = array ("0","100","107.5","300","400","500","600","700","800","900"); }
        if ($antrieb==3) { $verbrauchpromonat = array ("0","100","106.25","107.78","337.5","500","600","700","800","900"); }
        if ($antrieb==4) { $verbrauchpromonat = array ("0","100","103.75","104.44","106.25","300","322.22","495.92","487.5","900"); }
        if ($antrieb==5) { $verbrauchpromonat = array ("0","100","103.75","104.44","106.25","104","291.67","291.84","366.41","900"); }
        if ($antrieb==6) { $verbrauchpromonat = array ("0","100","103.75","104.44","106.25","104","103.69","251.02","335.16","900"); }
        if ($antrieb==7) { $verbrauchpromonat = array ("0","100","103.75","104.44","106.25","104","103.69","108.16","303.91","529.63"); }
        if ($antrieb==8) { $verbrauchpromonat = array ("0","100","100","100","100","100","100","102.04","109.38","529.63"); }
        if ($antrieb==9) { $verbrauchpromonat = array ("0","100","100","100","100","100","100","100","100","100"); }
        if ((($flug==4) or ($flug==3))and ($zielid!=-1)) {
            $zeiger_temp = mysql_query("SELECT id,kox,koy,spezialmission,antrieb,tarnfeld,besitzer,name,bild_gross,volk FROM $skrupel_schiffe where id=$zielid order by id");
            $array_temp = mysql_fetch_array($zeiger_temp);
            $zielxt=$zielx;
            $zielyt=$ziely;
            $name_2=$array_temp["name"];
            $volk_2=$array_temp["volk"];
            $bild_gross_2=$array_temp["bild_gross"];
            $besitzer_2=$array_temp["besitzer"];
            $tarnfeld_2=$array_temp["tarnfeld"];
            $antrieb_2=$array_temp["antrieb"];
            $spezialmission_2=$array_temp["spezialmission"];
            $zielx=$array_temp["kox"];
            $ziely=$array_temp["koy"];
            if(($flug==3)and(($spezialmission_2==8)or($antrieb_2==2))and ($tarnfeld_2< 2)){
        $n_gescannt=1;
    $scan_temp_reichweite=(($spezialmission==11)?85:(($spezialmission==12)?116:47))+($warp*$warp);
    if((($zielx-$kox)*($zielx-$kox))+(($ziely-$koy)*($ziely-$koy))<=($scan_temp_reichweite*$scan_temp_reichweite)){
      $n_gescannt=0;
    }
                $zeiger_temp2 = mysql_query("SELECT besitzer FROM $skrupel_schiffe where (
                    (sqrt(((kox-$zielx)*(kox-$zielx))+((koy-$ziely)*(koy-$ziely)))<=47) and ((spezialmission<>11) and (spezialmission<>12)))
                     or ((sqrt(((kox-$zielx)*(kox-$zielx))+((koy-$ziely)*(koy-$ziely)))<=85) and (spezialmission=11))
                     or  ((sqrt(((kox-$zielx)*(kox-$zielx))+((koy-$ziely)*(koy-$ziely)))<=116) and (spezialmission=12))
                     order by id");
                $anzahl_temp2 = mysql_num_rows($zeiger_temp2);
                if($anzahl_temp2 > 0){
                    for($j=0;$j< $anzahl_temp2; $j++){
                        $ok = mysql_data_seek($zeiger_temp2,$j);
                        $array_temp2 = mysql_fetch_array($zeiger_temp2);
                        $besitzer_temp2=$array_temp2["besitzer"];
                        if(($besitzer==$besitzer_temp2)or($beziehung[$besitzer][$besitzer_temp2]['status']> 3)){
                            $n_gescannt=0;
                        }
                    }
                }
                $zeiger_temp2 = mysql_query("SELECT besitzer FROM $skrupel_planeten where (
                    (sqrt(((x_pos-$zielx)*(x_pos-$zielx))+((y_pos-$ziely)*(y_pos-$ziely)))<=53) and (sternenbasis_art<>3))
                    or ((sqrt(((x_pos-$zielx)*(x_pos-$zielx))+((y_pos-$ziely)*(y_pos-$ziely)))<=116) and (sternenbasis_art=3))
                    order by id");
                $anzahl_temp2 = mysql_num_rows($zeiger_temp2);
                if($anzahl_temp2 > 0){
                    for($j=0;$j< $anzahl_temp2; $j++){
                        $ok = mysql_data_seek($zeiger_temp2,$j);
                        $array_temp2 = mysql_fetch_array($zeiger_temp2);                        
                        $besitzer_temp2=$array_temp2["besitzer"];
                        if(($besitzer==$besitzer_temp2)or($beziehung[$besitzer][$besitzer_temp2]['status']> 3)){
                            $n_gescannt=0;
                        }
                    }
                }
                if($n_gescannt==1){
                    $zielx=$zielxt;
                    $ziely=$zielyt;
                    $sektork=sektor($zielx,$ziely);
                    neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['flug'][7],array($spielerfarbe[$besitzer],$name,$sektork,$spielerfarbe[$besitzer_2],$name_2));
                    neuigkeiten(2,"../daten/$volk_2/bilder_schiffe/$bild_gross_2",$besitzer_2,$lang['host'][$spielersprache[$besitzer_2]]['flug'][8],array($spielerfarbe[$besitzer_2],$name_2,$sektork,$spielerfarbe[$besitzer],$name));
                }
            }
        }
        if ((($kox!=$zielx) or ($koy!=$ziely)) and ($overdrive_raus==0)) {
            $lichtjahre=sqrt(($kox-$zielx)*($kox-$zielx)+($koy-$ziely)*($koy-$ziely));
            $zeit=$lichtjahre/($warp*$warp*$flugbonus);
            if (($status==2) and ($warp<=3) and ($antrieb<=3)) {
                $zeit=$lichtjahre/(4*4);
            }
            if ($antrieb==1) {
                $zufall=mt_rand(1,100);
            if ($zufall<=11) {
                $zeit=$lichtjahre/(9*9);
                neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['flug'][1],array($name));
            }
        }
        $verbrauch=$verbrauchpromonat[$warp];
        if ($zeit<=1) {
            $kox=$zielx;$koy=$ziely;
            $verbrauch=floor($lichtjahre*$verbrauch*$masse_gesamt/100000);
        } else {
            $kox=$kox+(($zielx-$kox)/$zeit);
            $koy=$koy+(($ziely-$koy)/$zeit);
            $verbrauch=floor($warp*$warp*$verbrauch*$masse_gesamt/100000);
        }
        $verbrauch=$verbrauch-($verbrauch/100*$spritweniger);
        if ($verbrauch==0) { $verbrauch=1; }
        if ($verbrauchpromonat[$warp]==0) { $verbrauch=0; }
        if (($antrieb==4) and ($verbrauch>=1)) {
            $zufall=mt_rand(1,100);
            if ($zufall<=17) {
                $verbrauchneu=floor(37*($verbrauch/100));
                neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['flug'][2],array($name,$verbrauch,$verbrauchneu));
                $verbrauch=$verbrauchneu;
            }
        }
        if (($verbrauch>$lemin) and ($fracht_min2>=1) and ($fracht_min2+$lemin>=$verbrauch) and ($antrieb==6)) {
            $fehlt=$verbrauch-$lemin;
            $fracht_min2=$fracht_min2-$fehlt;
            $lemin=$verbrauch;
        }
        if ($verbrauch>$lemin) { $rauswurf=2; } else {
            $lemin=$lemin-$verbrauch;
            if ($zeit<=1) {
                $streckemehr=$lichtjahre;
                if ($flug==1) {
                    $flug_neu=0;
                    $status=1;
                    neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['flug'][3],array($name));
                }
                if ($flug==2) {
                    $flug_neu=0;
                    $status=2;
                    if ($routing_status>=1) {
                        neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['flug'][4],array($name));
                    } else {
                        neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['flug'][5],array($name));
                    }
                }
                if ($flug==4) {
                    $flug_neu=$flug;
                    $status=1;
                }
                if ($flug==3) {
                    $flug_neu=0;
                    $status=1;
                }
            } else {
                $streckemehr=$warp*$warp;
                $flug_neu=$flug;
                $status=1;
            }
        }
        if ($rauswurf==1) {
            if (($flug==1) or ($flug==2)) {
                $zeiger2 = mysql_query("UPDATE $skrupel_schiffe set kox_old=$kox_old,koy_old=$koy_old,strecke=strecke+$streckemehr,fracht_min2=$fracht_min2,kox=$kox, koy=$koy, lemin=$lemin, flug=$flug_neu, status=$status where id=$shid");
            }
            if (($flug==4) or ($flug==3)) {
                $zeiger2 = mysql_query("UPDATE $skrupel_schiffe set kox_old=$kox_old,koy_old=$koy_old,strecke=strecke+$streckemehr,fracht_min2=$fracht_min2,kox=$kox, koy=$koy, zielx=$zielx, ziely=$ziely, lemin=$lemin, flug=$flug_neu, status=$status where id=$shid");
            }
            $stat_lichtjahre[$besitzer]=$stat_lichtjahre[$besitzer]+$streckemehr;
            if ($spezialmission==21) {
                $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set kox=$kox, koy=$koy, status=$status where id=$traktor_id and spiel=$spiel");
            }
        } else {
            $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where id=$shid");
            $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set routing_schritt=0,routing_status=0,routing_koord='',routing_id='',routing_mins='',routing_warp=0,routing_tank=0,routing_rohstoff=0 where id=$shid");
            neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['flug'][6],array($name));
        }
    }elseif(($overdrive_raus==1)and(($flug==4) or ($flug==3))and ($zielid!=-1)){
        $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set zielx=$zielx,ziely=$ziely where id=$shid");
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////FLUG ENDE
///////////////////////////////////////////////////////////////////////////////////////////////ZIELKORREKTUR ANFANG
if($kreisel_anzahl>0){
    for($i=0;$i< $kreisel_anzahl;$i++){
        $zeiger2 = mysql_query("SELECT kox,koy FROM $skrupel_schiffe where spiel=$spiel and id=$zwischenarray_zielid[$i]");
        $array2 = mysql_fetch_array($zeiger2);
        $t_kox=$array2["kox"];
        $t_koy=$array2["koy"];
        $zeiger2 = mysql_query("UPDATE $skrupel_schiffe set zielx=$t_kox,ziely=$t_koy,zielid=$zwischenarray_zielid[$i] where spiel=$spiel and id=$zwischenarray_shid[$i]");
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////ZIELKORREKTUR ENDE
///////////////////////////////////////////////////////////////////////////////////////////////ERFAHRUNG DURCH STRECKE ANFANG
$zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set erfahrung=erfahrung+1,strecke=strecke-1000 where strecke>999 and erfahrung<5 and spiel=$spiel");
///////////////////////////////////////////////////////////////////////////////////////////////ERFAHRUNG DURCH STRECKE ENDE
///////////////////////////////////////////////////////////////////////////////////////////////WURMLOCH ANFANG
$zeiger = mysql_query("SELECT * FROM $skrupel_anomalien where spiel=$spiel order by id");
$datensaetze = mysql_num_rows($zeiger);
if ($datensaetze>=1) {
    for  ($i=0; $i<$datensaetze;$i++) {
    $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $aid=$array["id"];
        $art=$array["art"];
        $x_pos=$array["x_pos"];
        $y_pos=$array["y_pos"];
        $extra=$array["extra"];
        $extras=explode(":",$extra);
        if (($art==1) or ($art==2)) {
            if ($art==1) { $reichweite=15; }elseif ($art==2) { $reichweite=10; }
            $zeiger_temp = mysql_query("SELECT * FROM $skrupel_schiffe where sqrt( (kox-$x_pos)*(kox-$x_pos)+(koy-$y_pos)*(koy-$y_pos) )<=$reichweite and spiel=$spiel order by id");
            $schiffanzahl = mysql_num_rows($zeiger_temp);
            if ($schiffanzahl>=1) {
                for  ($k=0; $k<$schiffanzahl;$k++) {
                    $ok_temp = mysql_data_seek($zeiger_temp,$k);
                    $array_temp = mysql_fetch_array($zeiger_temp);
                    $shid=$array_temp["id"];
                    $bild_gross=$array_temp["bild_gross"];
                    $volk=$array_temp["volk"];
                    $s_x_pos=$array_temp["kox"];
                    $s_y_pos=$array_temp["koy"];
                    $antrieb=$array_temp["antrieb"];
                    $besitzer=$array_temp["besitzer"];
                    $name=$array_temp["name"];
                    $spezialmission=$array_temp["spezialmission"];
                    if ($extras[0]>=1) {
                        if ($spezialmission==29) {
                            $zeiger2 = mysql_query("UPDATE $skrupel_anomalien set extra='' where id=$aid");
                            $aid2=intval($extras[0]);
                            $zeiger2 = mysql_query("UPDATE $skrupel_anomalien set extra='' where id=$aid2");
                        }
                        $alpha=(double)(6.28318530718*mt_rand(0,$mt_randmax)/$mt_randmax);
                        $y=max(0,min($umfang,$extras[2]+round(($reichweite+3)*sin($alpha))));
                        $x=max(0,min($umfang,$extras[1]+round(($reichweite+3)*cos($alpha))));
                        $zeiger2 = mysql_query("UPDATE $skrupel_schiffe set kox=$x, koy=$y, zielx=0, ziely=0, flug=0, status=1  where id=$shid");
                        $zeiger_temp2 = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where (flug=3 or flug=4) and zielid=$shid");
                        if ($art==1) {
                            if ($spezialmission==29) {
                                neuigkeiten(2,"../bilder/news/wurmloch.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['wurmloch'][4],array($name));
                            } else {
                                neuigkeiten(2,"../bilder/news/wurmloch.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['wurmloch'][0],array($name));
                            }
                        }elseif ($art==2) {
                            if ($spezialmission==29) {
                                neuigkeiten(2,"../bilder/news/sprungtor.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['wurmloch'][5],array($name));
                            } else {
                                neuigkeiten(2,"../bilder/news/sprungtor.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['wurmloch'][1],array($name));
                            }
                        }
                    } else {
                        $ok=1;
                        while ($ok==1) {
                            $x=mt_rand(50,$umfang-100);
                            $y=mt_rand(50,$umfang-100);
                            $ok=2;
                            $nachbarn=0;
                            $zeiger2 = mysql_query("SELECT count(*) as total from $skrupel_planeten where sqrt( (x_pos-$x)*(x_pos-$x)+(x_pos-$x)*(x_pos-$x) )<=20 and spiel=$spiel");
                            $array = mysql_fetch_array($zeiger2);
                            $nachbarn=$array["total"];
                            if ($nachbarn>=1) {$ok=1;}
                        }
                        $zeiger2 = mysql_query("UPDATE $skrupel_schiffe set kox=$x, koy=$y, zielx=0, ziely=0, flug=0, status=1  where id=$shid");
                        $zeiger_temp2 = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where (flug=3 or flug=4) and zielid=$shid");
                        if ($art==1) {
                            neuigkeiten(2,"../bilder/news/wurmloch.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['wurmloch'][2],array($name));
                        }elseif ($art==2) {
                            neuigkeiten(2,"../bilder/news/sprungtor.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['wurmloch'][3],array($name));
                        }
                    }
                }
            }
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////WURMLOCH ENDE
///////////////////////////////////////////////////////////////////////////////////////////////DRUGUNVERZERRER ANFANG
$zeiger = mysql_query("SELECT * FROM $skrupel_schiffe where spezialmission=30 and spiel=$spiel order by id");
$schiffanzahl = mysql_num_rows($zeiger);
if ($schiffanzahl>=1) {
    for  ($i=0; $i<$schiffanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $shid=$array["id"];
        $name=$array["name"];
        $klasse=$array["klasse"];
        $klasseid=$array["klasseid"];
        $kox=$array["kox"];
        $koy=$array["koy"];
        $volk=$array["volk"];
        $besitzer=$array["besitzer"];
        $bild_gross=$array["bild_gross"];
        $reichweite=round(intval($array["masse"])/2);
        $zeiger_temp = mysql_query("SELECT * FROM $skrupel_schiffe where (sqrt(((kox-$kox)*(kox-$kox))+((koy-$koy)*(koy-$koy)))<=$reichweite) and tarnfeld=1 and spiel=$spiel order by id");
        $treffschiff = mysql_num_rows($zeiger_temp);
        if ($treffschiff>=1) {
            for ($k=0; $k<$treffschiff;$k++) {
                $ok2 = mysql_data_seek($zeiger_temp,$k);
                $array_temp = mysql_fetch_array($zeiger_temp);
                $t_shid=$array_temp["id"];
                $t_name=$array_temp["name"];
                $t_klasse=$array_temp["klasse"];
                $t_klasseid=$array_temp["klasseid"];
                $t_volk=$array_temp["volk"];
                $t_besitzer=$array_temp["besitzer"];
                $t_bild_gross=$array_temp["bild_gross"];
                neuigkeiten(2,"../daten/$t_volk/bilder_schiffe/$t_bild_gross",$t_besitzer,$lang['host'][$spielersprache[$t_besitzer]]['drugunverzerrer'][0],array($t_name));
                $zeiger_temp2 = mysql_query("UPDATE $skrupel_schiffe set tarnfeld=0 where id=$t_shid");
            }
        }
        neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['drugunverzerrer'][1],array($name));
        $zeiger_temp2 = mysql_query("DELETE FROM $skrupel_schiffe where id=$shid");
        $zeiger_temp2 = mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 's:$shid:%'");
        $zeiger_temp2 = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where (flug=3 or flug=4) and zielid=$shid");
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////DRUGUNVERZERRER ENDE
///////////////////////////////////////////////////////////////////////////////////////////////SELFDESTRUCT ANFANG
$zeiger = mysql_query("SELECT * FROM $skrupel_schiffe where spezialmission=15 and spiel=$spiel order by id");
$schiffanzahl = mysql_num_rows($zeiger);
if ($schiffanzahl>=1) {
    for  ($i=0; $i<$schiffanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $shid=$array["id"];
        $name=$array["name"];
        $klasse=$array["klasse"];
        $antrieb=$array["antrieb"];
        $klasseid=$array["klasseid"];
        $kox=$array["kox"];
        $koy=$array["koy"];
        $volk=$array["volk"];
        $besitzer=$array["besitzer"];
        $bild_gross=$array["bild_gross"];
        $fertigkeiten=$array["fertigkeiten"];
        $sub_schaden=intval($array["techlevel"])*50;
        $reichweite=83;
        $zeiger_temp = mysql_query("SELECT * FROM $skrupel_schiffe where (sqrt(((kox-$kox)*(kox-$kox))+((koy-$koy)*(koy-$koy)))<=$reichweite) and spezialmission<>15 and spiel=$spiel order by id");
        $treffschiff = mysql_num_rows($zeiger_temp);
        if ($treffschiff>=1) {
            for ($k=0; $k<$treffschiff;$k++) {
                $ok2 = mysql_data_seek($zeiger_temp,$k);
                $array_temp = mysql_fetch_array($zeiger_temp);
                $t_shid=$array_temp["id"];
                $t_name=$array_temp["name"];
                $t_klasse=$array_temp["klasse"];
                $t_antrieb=$array_temp["antrieb"];
                $t_klasseid=$array_temp["klasseid"];
                $t_volk=$array_temp["volk"];
                $t_besitzer=$array_temp["besitzer"];
                $t_bild_gross=$array_temp["bild_gross"];
                $t_schaden=$array_temp["schaden"];
                $t_masse=$array_temp["masse"];
                $zielx=$array_temp["kox"];
                $ziely=$array_temp["koy"];
                $schaden=round($t_schaden+($sub_schaden*(80/($t_masse+1))*(80/($t_masse+1))+2));
                if ($schaden<100) {
                    neuigkeiten(2,"../daten/$t_volk/bilder_schiffe/$t_bild_gross",$t_besitzer,$lang['host'][$spielersprache[$t_besitzer]]['selfdestruct'][0],array($t_name,$schaden));
                    $zeiger_temp2 = mysql_query("UPDATE $skrupel_schiffe set schaden=$schaden where id=$t_shid");
                }
                if ($schaden>=100) {
                    neuigkeiten(2,"../daten/$t_volk/bilder_schiffe/$t_bild_gross",$t_besitzer,$lang['host'][$spielersprache[$t_besitzer]]['selfdestruct'][1],array($t_name));
                    $zeiger_temp2 = mysql_query("DELETE FROM $skrupel_schiffe where id=$t_shid");
                    $zeiger_temp2 = mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 's:$t_shid:%'");
                    $zeiger_temp2 = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where (flug=3 or flug=4) and zielid=$t_shid");
                }
            }
        }
        neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['selfdestruct'][2],array($name));
        $zeiger_temp2 = mysql_query("DELETE FROM $skrupel_schiffe where id=$shid");
        $zeiger_temp2 = mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 's:$shid:%'");
        $zeiger_temp2 = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where (flug=3 or flug=4) and zielid=$shid");
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////SELFDESTRUCT ENDE
///////////////////////////////////////////////////////////////////////////////////////////////RAUMFALTEN ANFANG
$zeiger = mysql_query("SELECT * FROM $skrupel_anomalien where extra like 's:%' and art=3 and spiel=$spiel order by id");
$anoanzahl = mysql_num_rows($zeiger);
if ($anoanzahl>=1) {
    for  ($i=0; $i<$anoanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $anoid=$array["id"];
        $extra=$array["extra"];
        $extras=explode(":",$extra);
        $zeiger_temp = mysql_query("SELECT id,kox,koy,spiel FROM $skrupel_schiffe where  spiel=$spiel and id=".$extras[1]." order by id");
        $array_temp = mysql_fetch_array($zeiger_temp);
        $kox=$array_temp["kox"];
        $koy=$array_temp["koy"];
        $optionen="s:".$extras[1].":$kox:$koy:".$extras[4].":".$extras[5].":".$extras[6].":".$extras[7].":".$extras[8].":".$extras[9];
        $zeiger_temp = mysql_query("UPDATE $skrupel_anomalien set extra='$optionen' where spiel=$spiel and id=$anoid");
    }
}
$zeiger = mysql_query("SELECT * FROM $skrupel_anomalien where  art=3 and spiel=$spiel order by id");
$anoanzahl = mysql_num_rows($zeiger);
if ($anoanzahl>=1) {
    for  ($i=0; $i<$anoanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $anoid=$array["id"];
        $extra=$array["extra"];
        $kox=$array["x_pos"];
        $koy=$array["y_pos"];
        $extras=explode(":",$extra);
        $zielx=$extras[2];
        $ziely=$extras[3];
        $warp=12.67;
        $lichtjahre=sqrt(($kox-$zielx)*($kox-$zielx)+($koy-$ziely)*($koy-$ziely));
        $zeit=$lichtjahre/($warp*$warp);
        if ($zeit<=1) {
            if ($extras[0]=='p') {
                $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set cantox=cantox+".$extras[4].", vorrat=vorrat+".$extras[5].", lemin=lemin+".$extras[6].", min1=min1+".$extras[7].", min2=min2+".$extras[8].", min3=min3+".$extras[9]." where id=".$extras[1]." and spiel=$spiel");
                $zeiger_temp = mysql_query("DELETE FROM $skrupel_anomalien  where id=$anoid and spiel=$spiel");
                $zeiger_temp = mysql_query("SELECT id,besitzer,name FROM $skrupel_planeten where spiel=$spiel and id=".$extras[1]);
                $array_temp = mysql_fetch_array($zeiger_temp);
                $name=$array_temp["name"];
                $besitzer=$array_temp["besitzer"];
                if ($besitzer>=1)  {
                    neuigkeiten(1,"../bilder/news/raumfalte.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['raumfalte'][0],array($name,$extras[4],$extras[6],$extras[8],$extras[5],$extras[7],$extras[9]));
                }
            }elseif ($extras[0]=='s') {
                $zeiger_temp = mysql_query("SELECT * FROM $skrupel_schiffe where id=".$extras[1]." and spiel=$spiel");
                $array_temp = mysql_fetch_array($zeiger_temp);
                $besitzer=$array_temp["besitzer"];
                $fracht_leute=$array_temp["fracht_leute"];
                $fracht_cantox=$array_temp["fracht_cantox"];
                $fracht_vorrat=$array_temp["fracht_vorrat"];
                $fracht_lemin=$array_temp["lemin"];
                $fracht_min1=$array_temp["fracht_min1"];
                $fracht_min2=$array_temp["fracht_min2"];
                $fracht_min3=$array_temp["fracht_min3"];
                $frachtraum=$array_temp["frachtraum"];
                $leminmax=$array_temp["leminmax"];
                $name=$array_temp["name"];
                $freiraum=$frachtraum-$fracht_min1-$fracht_min2-$fracht_min3-round($fracht_leute/100)-$fracht_vorrat;
                $freitank=$leminmax-$fracht_lemin;
                $p_min1=$extras[7];
                $p_min2=$extras[8];
                $p_min3=$extras[9];
                $p_vorrat=$extras[5];
                $p_cantox=$extras[4];
                $p_lemin=$extras[6];
                if ($p_min1<=$freiraum) { $freiraum=$freiraum-$p_min1;$fracht_min1=$fracht_min1+$p_min1; } else
                    {$fracht_min1=$fracht_min1+$freiraum;$freiraum=0; }
                if ($p_min2<=$freiraum) { $freiraum=$freiraum-$p_min2;$fracht_min2=$fracht_min2+$p_min2; } else
                    { $fracht_min2=$fracht_min2+$freiraum;$freiraum=0; }
                if ($p_min3<=$freiraum) { $freiraum=$freiraum-$p_min3;$fracht_min3=$fracht_min3+$p_min3; } else
                    { $fracht_min3=$fracht_min3+$freiraum;$freiraum=0; }
                if ($p_vorrat<=$freiraum) { $freiraum=$freiraum-$p_vorrat;$fracht_vorrat=$fracht_vorrat+$p_vorrat; } else
                    { $fracht_vorrat=$fracht_vorrat+$freiraum;$freiraum=0; }
                $fracht_cantox=$fracht_cantox+$p_cantox;
                if ($p_lemin<=$freitank){ $freitank=$freitank-$p_lemin;$fracht_lemin=$fracht_lemin+$p_lemin; } else
                                        { $fracht_lemin=$fracht_lemin+$freitank; }
                $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set lemin=$fracht_lemin,fracht_vorrat=$fracht_vorrat,fracht_cantox=$fracht_cantox,fracht_min1=$fracht_min1,fracht_min2=$fracht_min2,fracht_min3=$fracht_min3 where id=".$extras[1]." and spiel=$spiel");
                $zeiger_temp = mysql_query("DELETE FROM $skrupel_anomalien  where id=$anoid and spiel=$spiel");
                neuigkeiten(2,"../bilder/news/raumfalte.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['raumfalte'][1],array($name,$extras[4],$extras[6],$extras[8],$extras[5],$extras[7],$extras[9]));
            }
        } else {
            $kox=round($kox+(($zielx-$kox)/$zeit));
            $koy=round($koy+(($ziely-$koy)/$zeit));
            $zeiger_temp = mysql_query("UPDATE $skrupel_anomalien set x_pos=$kox, y_pos=$koy where id=$anoid");
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////RAUMFALTEN ENDE
///////////////////////////////////////////////////////////////////////////////////////////////AUTOPROJEKTILE ANFANG
$zeiger = mysql_query("SELECT * FROM $skrupel_schiffe where projektile_anzahl>=1 and projektile_auto=1 and spiel=$spiel");
$anoanzahl = mysql_num_rows($zeiger);
if ($anoanzahl>=1) {
    for  ($i=0; $i<$anoanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $shid=$array["id"];
        $projektile=$array["projektile"];
        $projektile_auto=$array["projektile_auto"];
        $projektile_stufe=$array["projektile_stufe"];
        $projektile_anzahl=$array["projektile_anzahl"];
        $fracht_cantox=$array["fracht_cantox"];
        $fracht_min1=$array["fracht_min1"];
        $fracht_min2=$array["fracht_min2"];
        $max=$projektile_anzahl*5;
        $max_bau=$max-$projektile;
        $max_cantox=floor($fracht_cantox/35);
        if ($max_cantox<$max_bau) {$max_bau=$max_cantox;}
        $max_min1=floor($fracht_min1/2);
        if ($max_min1<$max_bau) {$max_bau=$max_min1;}
        if ($fracht_min2<$max_bau) {$max_bau=$fracht_min2;}
        if ($max_bau>=1) {
            $projektile=$projektile+$max_bau;
            $fracht_cantox=$fracht_cantox-($max_bau*35);
            $fracht_min1=$fracht_min1-($max_bau*2);
            $fracht_min2=$fracht_min2-$max_bau;
            $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set projektile=$projektile,fracht_cantox=$fracht_cantox,fracht_min1=$fracht_min1,fracht_min2=$fracht_min2 where id=$shid");
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////AUTOPROJEKTILE ENDE
///////////////////////////////////////////////////////////////////////////////////////////////SCHIFFSBAU ANFANG
$zeiger = mysql_query("SELECT * FROM $skrupel_sternenbasen where schiffbau_status=1 and status=1 and spiel=$spiel order by id");
$basenanzahl = mysql_num_rows($zeiger);
if ($basenanzahl>=1) {
    $neueschiffe=$neueschiffe+$basenanzahl;
    for  ($i=0; $i<$basenanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $baid=$array["id"];
        $x_pos=$array["x_pos"];
        $y_pos=$array["y_pos"];
        $zeiger2 = mysql_query("SELECT * FROM $skrupel_planeten where x_pos=$x_pos and y_pos=$y_pos and spiel=$spiel order by id");
        $ok = mysql_data_seek($zeiger2,0);
        $array2 = mysql_fetch_array($zeiger2);
        $osys_1=$array2["osys_1"];
        $osys_2=$array2["osys_2"];
        $osys_3=$array2["osys_3"];
        $osys_4=$array2["osys_4"];
        $osys_5=$array2["osys_5"];
        $osys_6=$array2["osys_6"];
        $besitzer=$array["besitzer"];
        $planetid=$array["planetid"];
        $schiffbau_klasse=$array["schiffbau_klasse"];
        $schiffbau_bild_gross=$array["schiffbau_bild_gross"];
        $schiffbau_bild_klein=$array["schiffbau_bild_klein"];
        $schiffbau_crew=$array["schiffbau_crew"];
        $schiffbau_masse=$array["schiffbau_masse"];
        $schiffbau_tank=$array["schiffbau_tank"];
        $schiffbau_fracht=$array["schiffbau_fracht"];
        $schiffbau_antriebe=$array["schiffbau_antriebe"];
        $schiffbau_energetik=$array["schiffbau_energetik"];
        $schiffbau_projektile=$array["schiffbau_projektile"];
        $schiffbau_hangar=$array["schiffbau_hangar"];
        $schiffbau_klasse_name=$array["schiffbau_klasse_name"];
        $schiffbau_rasse=$array["schiffbau_rasse"];
        $schiffbau_fertigkeiten=$array["schiffbau_fertigkeiten"];
        $schiffbau_energetik_stufe=$array["schiffbau_energetik_stufe"];
        $schiffbau_projektile_stufe=$array["schiffbau_projektile_stufe"];
        $schiffbau_techlevel=$array["schiffbau_techlevel"];
        $schiffbau_antriebe_stufe=$array["schiffbau_antriebe_stufe"];
        $schiffbau_name=$array["schiffbau_name"];
        $schiffbau_zusatz=$array["schiffbau_zusatz"];
        $schiffbau_extra=$array["schiffbau_extra"];
        $schalter=0;
        if(($osys_1==15) or ($osys_2==15) or ($osys_3==15) or ($osys_4==15) or ($osys_5==15) or ($osys_6==15)and $schiffbau_masse<100){
            $schalter=1;
            for($j=1;$j<=strlen($schiffbau_fertigkeiten);$j++){
                if(($j<53) or($j>55)){
                    if(intval(substr($schiffbau_fertigkeiten,$j,1))!=0){
                        $schalter=0;
                    }
                }
            }
        }
        if($schalter==1){
            if($schiffbau_energetik_stufe!=0){
                $vorrat_energetik_string='vorrat_energetik_'.$schiffbau_energetik_stufe;
            }else{
                $vorrat_energetik_string='vorrat_energetik_1';
            }
            if($schiffbau_projektile_stufe!=0){
                $vorrat_projektile_string='vorrat_projektile_'.$schiffbau_projektile_stufe;
            }else{
                $vorrat_projektile_string='vorrat_projektile_1';
            }
            if($schiffbau_antriebe_stufe!=0){
                $vorrat_antrieb_string='vorrat_antrieb_'.$schiffbau_antriebe_stufe;
            }else{
                $vorrat_antrieb_string='vorrat_antrieb_1';
            }
            $energetik=$array[$vorrat_energetik_string];
            $projektile=$array[$vorrat_projektile_string];
            $antrieb=$array[$vorrat_antrieb_string];
            if($energetik>=$schiffbau_energetik and $projektile>=$schiffbau_projektile and $antrieb>=$schiffbau_antriebe){
                $energetik=$energetik-$schiffbau_energetik;
                $projektile=$projektile-$schiffbau_projektile;
                $antrieb=$antrieb-$schiffbau_antriebe;
            }else{
                $schalter=0;
            }
            if($schalter==1){
                $zeiger3 = mysql_query("SELECT * FROM $skrupel_huellen where baid=$baid and spiel=$spiel and klasse=$schiffbau_klasse order by id");
                $huellenanzahl = mysql_num_rows($zeiger3);
                if($huellenanzahl>0){
                    $neueschiffe++;
                    $ok = mysql_data_seek($zeiger3,0);
                    $array3 = mysql_fetch_array($zeiger3);
                    $hid=$array3["id"];
                    $schiffbau_name2=$schiffbau_name.'(2)';
                    $zeiger_temp = mysql_query("INSERT INTO $skrupel_schiffe (s_x,s_y,besitzer,status,name,klasse,klasseid,volk,techlevel,antrieb,antrieb_anzahl,kox,koy,crew,crewmax,lemin,leminmax,frachtraum,masse,masse_gesamt,bild_gross,bild_klein,energetik_stufe,energetik_anzahl,projektile_stufe,projektile_anzahl,hanger_anzahl,schild,fertigkeiten,spiel,extra,zusatzmodul) values ($x_pos,$y_pos,$besitzer,2,'$schiffbau_name2','$schiffbau_klasse_name',$schiffbau_klasse,'$schiffbau_rasse',$schiffbau_techlevel,$schiffbau_antriebe_stufe, $schiffbau_antriebe,$x_pos,$y_pos,$schiffbau_crew,$schiffbau_crew,0,$schiffbau_tank,$schiffbau_fracht,$schiffbau_masse,$schiffbau_masse,'$schiffbau_bild_gross','$schiffbau_bild_klein',$schiffbau_energetik_stufe,$schiffbau_energetik,$schiffbau_projektile_stufe,$schiffbau_projektile,$schiffbau_hangar,100,'$schiffbau_fertigkeiten',$spiel,'$schiffbau_extra',$schiffbau_zusatz)");
                    $zeiger_temp = mysql_query("UPDATE $skrupel_sternenbasen set $vorrat_energetik_string='$energetik',$vorrat_projektile_string='$projektile',$vorrat_antrieb_string='$antrieb' where spiel=$spiel and id=$baid");
                    $zeiger_temp = mysql_query("DELETE FROM $skrupel_huellen where spiel=$spiel and id=$hid");
                    neuigkeiten(2,"../daten/$schiffbau_rasse/bilder_schiffe/$schiffbau_bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['schiffbau'][0],array($schiffbau_name2));
                    $schiffbau_name=$schiffbau_name.'(1)';
                }
            }
        }
        $zeiger_temp = mysql_query("INSERT INTO $skrupel_schiffe (s_x,s_y,besitzer,status,name,klasse,klasseid,volk,techlevel,antrieb,antrieb_anzahl,kox,koy,crew,crewmax,lemin,leminmax,frachtraum,masse,masse_gesamt,bild_gross,bild_klein,energetik_stufe,energetik_anzahl,projektile_stufe,projektile_anzahl,hanger_anzahl,schild,fertigkeiten,spiel,extra,zusatzmodul) values ($x_pos,$y_pos,$besitzer,2,'$schiffbau_name','$schiffbau_klasse_name',$schiffbau_klasse,'$schiffbau_rasse',$schiffbau_techlevel,$schiffbau_antriebe_stufe, $schiffbau_antriebe,$x_pos,$y_pos,$schiffbau_crew,$schiffbau_crew,0,$schiffbau_tank,$schiffbau_fracht,$schiffbau_masse,$schiffbau_masse,'$schiffbau_bild_gross','$schiffbau_bild_klein',$schiffbau_energetik_stufe,$schiffbau_energetik,$schiffbau_projektile_stufe,$schiffbau_projektile,$schiffbau_hangar,100,'$schiffbau_fertigkeiten',$spiel,'$schiffbau_extra',$schiffbau_zusatz)");
        neuigkeiten(2,"../daten/$schiffbau_rasse/bilder_schiffe/$schiffbau_bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['schiffbau'][0],array($schiffbau_name));
    }
}
$zeiger_temp = mysql_query("UPDATE $skrupel_sternenbasen set schiffbau_status=0,schiffbau_extra='' where spiel=$spiel");
///////////////////////////////////////////////////////////////////////////////////////////////SCHIFFSBAU ENDE
///////////////////////////////////////////////////////////////////////////////////////////////GRAVITATION ANFANG
$zeiger2 = mysql_query("SELECT * FROM $skrupel_schiffe where status<>2 and spiel=$spiel order by id");
$schiffanzahl = mysql_num_rows($zeiger2);
if ($schiffanzahl>=1) {
    for  ($ir=0; $ir<$schiffanzahl;$ir++) {
        $ok2 = mysql_data_seek($zeiger2,$ir);
        $array2 = mysql_fetch_array($zeiger2);
        $shid=$array2["id"];
        $kox=$array2["kox"];
        $koy=$array2["koy"];
        $flug=$array2["flug"];
        $zielid=$array2["zielid"];
        $volk=$array2["volk"];
        $bild_gross=$array2["bild_gross"];
        $besitzer=$array2["besitzer"];
        $name=$array2["name"];
        $reichweite=13;
        $zeiger = mysql_query("SELECT * FROM $skrupel_planeten where (sqrt(((x_pos-$kox)*(x_pos-$kox))+((y_pos-$koy)*(y_pos-$koy)))<=$reichweite) and spiel=$spiel order by id");
        $planetenanzahl = mysql_num_rows($zeiger);
        if ($planetenanzahl>=1) {
            for  ($i=0; $i<$planetenanzahl;$i++) {
                $ok = mysql_data_seek($zeiger,$i);
                $array = mysql_fetch_array($zeiger);
                $pid=$array["id"];
                $x_pos=$array["x_pos"];
                $y_pos=$array["y_pos"];
                if ($pid==$zielid) {
                    neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['flug'][5],array($name));
                    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set flug=0 where id=$shid");
                }
                $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set kox=$x_pos,koy=$y_pos,status=2 where id=$shid");
            }
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////GRAVITATION ENDE
///////////////////////////////////////////////////////////////////////////////////////////////MINENFELDER ANFANG
if($module[2]) {
    $zeiger = mysql_query("SELECT crew,crewmax,masse,id,name,klasse,klasseid,volk,kox,koy,besitzer,bild_gross,status,flug,schaden FROM $skrupel_schiffe where status=1 and not (klasseid=1 and volk like 'unknown') and spiel=$spiel order by id");
    $schiffanzahl = mysql_num_rows($zeiger);
    if ($schiffanzahl>=1) {
        for  ($i=0; $i<$schiffanzahl;$i++) {
            $ok = mysql_data_seek($zeiger,$i);
            $array = mysql_fetch_array($zeiger);
            $shid=$array["id"];
            $name=$array["name"];
            $klasse=$array["klasse"];
            $klasseid=$array["klasseid"];
            $kox=$array["kox"];
            $koy=$array["koy"];
            $volk=$array["volk"];
            $besitzer=$array["besitzer"];
            $bild_gross=$array["bild_gross"];
            $status=$array["status"];
            $leminmax=$array["leminmax"];
            $flug=$array["flug"];
            $schaden=$array["schaden"];
            $masse=$array["masse"];
            $crew=$array["crew"];
            $crewmax=$array["crewmax"];
            $reichweite=85;
            $minenanzahl=0;
            $zeiger2 = mysql_query("SELECT * FROM $skrupel_anomalien where spiel=$spiel and art=5 and (sqrt(((x_pos-$kox)*(x_pos-$kox))+((y_pos-$koy)*(y_pos-$koy)))<=$reichweite) order by id");
            //echo "$name $kox , $koy <br>";
            //echo "SELECT * FROM $skrupel_anomalien where spiel=$spiel and art=5 and x_pos>=$rand_x_a and x_pos<=$rand_x_b and y_pos>=$rand_y_a and y_pos<=$rand_y_b order by id"."<br><br>";
            $datensaetze2 = mysql_num_rows($zeiger2);
            if ($datensaetze2>=1) {
                for  ($irt=0; $irt<$datensaetze2;$irt++) {
                    $ok2 = mysql_data_seek($zeiger2,$irt);
                    $array2 = mysql_fetch_array($zeiger2);
                    $aid=$array2["id"];
                    $x_pos=$array2["x_pos"];
                    $y_pos=$array2["y_pos"];
                    $mineextra=explode(":",$array2["extra"]);
                    //echo $aid.':';
                    //$besitzerminenfeld=intval();
                    //echo $mineextra[1].'<br><br>';
                    if( ($mineextra[0]==$besitzer) or
                        ($beziehung[$besitzer][$mineextra[0]]['status']==3) or
                        ($beziehung[$besitzer][$mineextra[0]]['status']==4) or
                        ($beziehung[$besitzer][$mineextra[0]]['status']==5))
                    {} else {
                        if (intval($mineextra[1])>=$minenanzahl) {
                            $minenanzahl=intval($mineextra[1]);
                            $aanomalie[0]=$aid; // id
                            $aanomalie[1]=$mineextra[0]; // besitzer
                            $aanomalie[2]=intval($mineextra[1]); // anzahl
                            $aanomalie[3]=$mineextra[2]; // stufe
                        }
                    }
                }
            }
            //echo $minenanzahl.'<br>';
            if ($minenanzahl>=1) {
                $zufall=mt_rand(0,50);
                $minentreffer=round($zufall*$minenanzahl/100);
                //echo $minentreffer.':';
                if ($minenanzahl==1) { $minentreffer=1; }
                if ($minentreffer>=1) {
                    $aanomalie[2]=$aanomalie[2]-$minentreffer;
                    if ($aanomalie[2]<=0) {
                        $zeiger_temp = mysql_query("DELETE FROM $skrupel_anomalien where spiel=$spiel and id=$aanomalie[0]");
                    } else {
                        $mineextra=$aanomalie[1].':'.$aanomalie[2].':'.$aanomalie[3];
                        $zeiger_temp = mysql_query("UPDATE $skrupel_anomalien set extra='$mineextra' where spiel=$spiel and id=$aanomalie[0]");
                    }
                    $minen_schaden=$torpedoschaden["$aanomalie[3]"];
                    $minen_schaden_crew=$torpedoschadencrew["$aanomalie[3]"];
                    //echo $minen_schaden.':'.$masse.':'.$minentreffer.'<br><br>';
                    $schaden_rumpf=round(($minen_schaden*(80/($masse+1))*(80/($masse+1))+2))*$minentreffer;
                    $schaden=$schaden+$schaden_rumpf;
                    $schaden_crew=($minen_schaden_crew*(80/($masse+1))*(80/($masse+1))+2)*$minentreffer;
                    $crew=$crew-floor($crewmax*$schaden_crew/100);
                    $schaden_crewmen=floor($crewmax*$schaden_crew/100);
                    $sektork=sektor($kox,$koy);
                    //echo $schaden_rumpf.":";
                    //echo $schaden_crewmen."<br><br>";
                    //echo $schaden.":".$crew;
                    if (($schaden>=100) or ($crew<1)) {
                        $zeiger_temp = mysql_query("DELETE FROM $skrupel_schiffe where id=$shid and besitzer=$besitzer;");
                        $zeiger_temp = mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 's:$shid:%'");
                        $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where (flug=3 or flug=4) and zielid=$shid");
                        neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['minenfelder'][0],array($name,$sektork));
                    } else {
                        $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set crew=$crew,schaden=$schaden,scanner=0 where id=$shid and besitzer=$besitzer;");
                        neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['minenfelder'][1],array($name,$sektork,$minentreffer,$schaden_rumpf,$schaden_crewmen));
                    }
                }
            }
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////MINENFELDER ENDE
///////////////////////////////////////////////////////////////////////////////////////////////MINENFELDER SCHRUMPFEN ANFANG
if($module[2]) {
    $zeiger2 = mysql_query("SELECT id,extra,spiel FROM $skrupel_anomalien where spiel=$spiel and art=5 order by id");
    $datensaetze2 = mysql_num_rows($zeiger2);
    if ($datensaetze2>=1) {
        for ($irt=0; $irt<$datensaetze2;$irt++) {
            $ok2 = mysql_data_seek($zeiger2,$irt);
            $array2 = mysql_fetch_array($zeiger2);
            $aid=$array2["id"];
            $mineextra=explode(":",$array2["extra"]);
            $aanomalie[0]=$aid; // id
            $aanomalie[1]=$mineextra[0]; // besitzer
            $aanomalie[2]=intval($mineextra[1]); // anzahl
            $aanomalie[3]=$mineextra[2]; // stufe
            $zufall=mt_rand(0,100);
            if ($zufall<=80) {
                $aanomalie[2]=$aanomalie[2]-1;
                if ($aanomalie[2]<=0) {
                    $zeiger_temp = mysql_query("DELETE FROM $skrupel_anomalien where spiel=$spiel and id=$aanomalie[0]");
                } else {
                    $mineextra=$aanomalie[1].':'.$aanomalie[2].':'.$aanomalie[3];
                    $zeiger_temp = mysql_query("UPDATE $skrupel_anomalien set extra='$mineextra' where spiel=$spiel and id=$aanomalie[0]");
                }
            }
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////MINENFELDER SCHRUMPFEN ENDE
///////////////////////////////////////////////////////////////////////////////////////////////SPIONAGE ANFANG
if($module[0]) {
    include(INCLUDEDIR.'inc.host_spionage.php');
}
///////////////////////////////////////////////////////////////////////////////////////////////SPIONAGE ENDE
///////////////////////////////////////////////////////////////////////////////////////////////SUBRAUMVERZERRUNG BETA ANFANG
$zeiger = mysql_query("SELECT * FROM $skrupel_schiffe where spezialmission=10 and spiel=$spiel order by id");
$schiffanzahl = mysql_num_rows($zeiger);
if ($schiffanzahl>=1) {
    for ($i=0; $i<$schiffanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $shid=$array["id"];
        $name=$array["name"];
        $klasse=$array["klasse"];
        $antrieb=$array["antrieb"];
        $klasseid=$array["klasseid"];
        $kox=$array["kox"];
        $koy=$array["koy"];
        $volk=$array["volk"];
        $besitzer=$array["besitzer"];
        $bild_gross=$array["bild_gross"];
        $fertigkeiten=$array["fertigkeiten"];
        $fert_subver=intval(substr($fertigkeiten,23,1));
        $sub_schaden=$fert_subver*50;
        $zeiger_temp = mysql_query("SELECT * FROM $skrupel_schiffe where (sqrt(($kox-kox)*($kox-kox)+($koy-koy)*($koy-koy))<=83) and spezialmission<>10 and spiel=$spiel order by id");
        $treffschiff = mysql_num_rows($zeiger_temp);
        if ($treffschiff>=1) {
            for ($k=0; $k<$treffschiff;$k++) {
                $ok2 = mysql_data_seek($zeiger_temp,$k);
                $array_temp = mysql_fetch_array($zeiger_temp);
                $t_shid=$array_temp["id"];
                $t_name=$array_temp["name"];
                $t_klasse=$array_temp["klasse"];
                $t_antrieb=$array_temp["antrieb"];
                $t_klasseid=$array_temp["klasseid"];
                $t_volk=$array_temp["volk"];
                $t_besitzer=$array_temp["besitzer"];
                $t_bild_gross=$array_temp["bild_gross"];
                $t_schaden=$array_temp["schaden"];
                $t_masse=$array_temp["masse"];
                $zielx=$array_temp["kox"];
                $ziely=$array_temp["koy"];
                $schaden=round($t_schaden+($sub_schaden*(80/($t_masse+1))*(80/($t_masse+1))+2));
                if ($schaden<100) {
                    neuigkeiten(2,"../daten/$t_volk/bilder_schiffe/$t_bild_gross",$t_besitzer,$lang['host'][$spielersprache[$t_besitzer]]['subraumverzerrer'][0],array($t_name,$schaden));
                    $zeiger_temp2 = mysql_query("UPDATE $skrupel_schiffe set schaden=$schaden where id=$t_shid");
                }
                if ($schaden>=100) {
                    neuigkeiten(2,"../daten/$t_volk/bilder_schiffe/$t_bild_gross",$t_besitzer,$lang['host'][$spielersprache[$t_besitzer]]['subraumverzerrer'][1],array($t_name));
                    $zeiger_temp2 = mysql_query("DELETE FROM $skrupel_schiffe where id=$t_shid");
                    $zeiger_temp2 = mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 's:$t_shid:%'");
                    $zeiger_temp2 = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where (flug=3 or flug=4) and zielid=$t_shid");
                }
            }
        }
        $zeiger_temp = mysql_query("SELECT * FROM $skrupel_anomalien where (sqrt(($kox-x_pos)*($kox-x_pos)+($koy-y_pos)*($koy-y_pos))<=83) and art=3 and spiel=$spiel order by id");
        $trefffalte = mysql_num_rows($zeiger_temp);
        if ($trefffalte>=1) {
            for ($k=0; $k<$trefffalte;$k++) {
                $ok2 = mysql_data_seek($zeiger_temp,$k);
                $array_temp = mysql_fetch_array($zeiger_temp);
                $fid=$array_temp["id"];
                $war=mt_rand(1,10);
                if($war<=$fert_subver){
                    $zeiger_temp2 = mysql_query("DELETE FROM $skrupel_anomalien where id=$fid");
                }
            }
        }
        neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['subraumverzerrer'][2],array($name));
        $zeiger_temp2 = mysql_query("DELETE FROM $skrupel_schiffe where id=$shid");
        $zeiger_temp2 = mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 's:$shid:%'");
        $zeiger_temp2 = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where (flug=3 or flug=4) and zielid=$shid");
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////SUBRAUMVERZERRUNG BETA ENDE
///////////////////////////////////////////////////////////////////////////////////////////////SCHIFFSKAMPF PLANET ANFANG
include(INCLUDEDIR.'inc.host_orbitalkampf.php');
///////////////////////////////////////////////////////////////////////////////////////////////SCHIFFSKAMPF PLANET ENDE
///////////////////////////////////////////////////////////////////////////////////////////////SCHIFFSKAMPF ANFANG
include(INCLUDEDIR.'inc.host_raumkampf.php');
///////////////////////////////////////////////////////////////////////////////////////////////SCHIFFSKAMPF ENDE
///////////////////////////////////////////////////////////////////////////////////////////////STERNENBASEN ANFANG
///////////////////////////////////////////////////////////////////////////////////////////////STERNENBASEN BAUEN ANFANG
$zeiger = mysql_query("SELECT * FROM $skrupel_sternenbasen where status=0 and spiel=$spiel order by id");
$basenanzahl = mysql_num_rows($zeiger);
if ($basenanzahl>=1) {
    for ($i=0; $i<$basenanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $bid=$array["id"];
        $name=$array["name"];
        $rasse=$array["rasse"];
        $planetid=$array["planetid"];
        $besitzer=$array["besitzer"];
        $zeiger_temp = mysql_query("UPDATE $skrupel_sternenbasen set status=1 where id=$bid");
        $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set sternenbasis=2 where id=$planetid");
        $neuebasen++;
        neuigkeiten(3,"../daten/$rasse/bilder_basen/1.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['basenbauen'][0],array($name));
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////STERNENBASEN BAUEN ENDE
///////////////////////////////////////////////////////////////////////////////////////////////STERNENBASEN ENDE
///////////////////////////////////////////////////////////////////////////////////////////////SCHIFF WEICHT PLANET AUS ANFANG
$zeiger = mysql_query("SELECT id,status,besitzer,name,klasse,klasseid,kox,koy,volk,bild_gross FROM $skrupel_schiffe where status=2 and spiel=$spiel order by id");
$schiffanzahl = mysql_num_rows($zeiger);
if ($schiffanzahl>=1) {
    for ($i=0; $i<$schiffanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $shid=$array["id"];
        $status=$array["status"];
        $besitzer=$array["besitzer"];
        $name=$array["name"];
        $klasse=$array["klasse"];
        $klasseid=$array["klasseid"];
        $kox=$array["kox"];
        $koy=$array["koy"];
        $volk=$array["volk"];
        $bild_gross=$array["bild_gross"];
        $gemeinsam=0;
        $zeiger_temp = mysql_query("SELECT count(*) as gemeinsam FROM $skrupel_planeten where x_pos=$kox and y_pos=$koy and besitzer<>$besitzer and besitzer>=1 and spiel=$spiel");
        $array_temp = mysql_fetch_array($zeiger_temp);
        $gemeinsam=$array_temp["gemeinsam"];
        if ($gemeinsam>=1) {
            $zeiger2 = mysql_query("SELECT x_pos,y_pos,spiel,id,name,besitzer,bild,klasse FROM $skrupel_planeten where x_pos=$kox and y_pos=$koy and spiel=$spiel");
            $array2 = mysql_fetch_array($zeiger2);
            $p_id=$array2["id"];
            $p_name=$array2["name"];
            $p_besitzer=$array2["besitzer"];
            $p_bild=$array2["bild"];
            $p_klasse=$array2["klasse"];
            if (($beziehung[$besitzer][$p_besitzer]['status']==3) or ($beziehung[$besitzer][$p_besitzer]['status']==4)) {
                $alpha=(double)(6.28318530718*mt_rand(0,$mt_randmax)/$mt_randmax);
                $koy=max(0,min($umfang,$koy+round(20*sin($alpha))));
                $kox=max(0,min($umfang,$kox+round(20*cos($alpha))));
                $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set status=1,kox=$kox, koy=$koy where id=$shid and spiel=$spiel");
                neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['ausweichen'][0],array($name,$spielerfarbe[$p_besitzer],$p_name));
            }
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////SCHIFF WEICHT PLANET AUS ENDE
///////////////////////////////////////////////////////////////////////////////////////////////SCHIFF WEICHT SCHIFF AUS ANFANG
$zeiger = mysql_query("SELECT id,status,masse,besitzer,name,klasse,klasseid,kox,koy,volk,bild_gross FROM $skrupel_schiffe where spiel=$spiel order by id");
$schiffanzahl = mysql_num_rows($zeiger);
$checkstring="";
if ($schiffanzahl>=1) {
    for ($i=0; $i<$schiffanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $shid=$array["id"];
        $status=$array["status"];
        $besitzer=$array["besitzer"];
        $name=$array["name"];
        $klasse=$array["klasse"];
        $klasseid=$array["klasseid"];
        $kox=$array["kox"];
        $koy=$array["koy"];
        $masse=$array["masse"];
        $volk=$array["volk"];
        $bild_gross=$array["bild_gross"];
        $code=":::".$shid.":::";
        if (strstr($checkstring,$code)) {} else {
            $gemeinsam=0;
            $zeiger_temp = mysql_query("SELECT count(*) as gemeinsam FROM $skrupel_schiffe where kox=$kox and koy=$koy and besitzer<>$besitzer and spiel=$spiel");
            $array_temp = mysql_fetch_array($zeiger_temp);
            $gemeinsam=$array_temp["gemeinsam"];
            if ($gemeinsam>=1) {
                $zeiger2 = mysql_query("SELECT id,status,masse,besitzer,name,klasse,klasseid,kox,koy,volk,bild_gross FROM $skrupel_schiffe where kox=$kox and koy=$koy and id<>$shid and besitzer<>$besitzer and spiel=$spiel");
                for ($ihj=0; $ihj<$gemeinsam;$ihj++) {
                    $ok2 = mysql_data_seek($zeiger2,$ihj);
                    $code=":::".$shid.":::";
                    if (strstr($checkstring,$code)) {} else {
                        $array2 = mysql_fetch_array($zeiger2);
                        $shid_2=$array2["id"];
                        $status_2=$array2["status"];
                        $besitzer_2=$array2["besitzer"];
                        $name_2=$array2["name"];
                        $klasse_2=$array2["klasse"];
                        $klasseid_2=$array2["klasseid"];
                        $kox_2=$array2["kox"];
                        $koy_2=$array2["koy"];
                        $masse_2=$array2["masse"];
                        $volk_2=$array2["volk"];
                        $bild_gross_2=$array2["bild_gross"];
                        if ($status==2) {
                            $abstand=20;
                            $zeiger3 = mysql_query("SELECT x_pos,y_pos,spiel,id,besitzer FROM $skrupel_planeten where x_pos=$kox and y_pos=$koy and spiel=$spiel");
                            $array3 = mysql_fetch_array($zeiger3);
                            $p_besitzer=$array3["besitzer"];
                            if ($p_besitzer==$besitzer) { $springer=2; }
                            if ($p_besitzer==$besitzer_2) { $springer=1; }
                            if (($p_besitzer!=$besitzer) and ($p_besitzer!=$besitzer_2)) {
                                if ($masse==$masse_2) {
                                    $springer=mt_rand(1,2);
                                } else {
                                    if ($masse>$masse_2) {
                                        $springer=2;
                                    } else {
                                        $springer=1;
                                    }
                                }
                            }
                        } else {
                            $abstand=15;
                            if ($masse==$masse_2) {
                                $springer=mt_rand(1,2);
                            } else {
                                if ($masse>$masse_2) {
                                    $springer=2;
                                } else {
                                    $springer=1;
                                }
                            }
                        }
                        $alpha=(double)(6.28318530718*mt_rand(0,$mt_randmax)/$mt_randmax);
                        $koy=max(0,min($umfang,$koy+round(20*sin($alpha))));
                        $kox=max(0,min($umfang,$kox+round(20*cos($alpha))));
                        if ($springer==1) {
                            $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set status=1,kox=$kox, koy=$koy where id=$shid and spiel=$spiel");
                            neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['ausweichen'][1],array($name,$spielerfarbe[$besitzer_2],$name_2));
                            $checkstring=$checkstring.":::".$shid.":::";
                        } else {
                            $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set status=1,kox=$kox, koy=$koy where id=$shid_2 and spiel=$spiel");
                            neuigkeiten(2,"../daten/$volk_2/bilder_schiffe/$bild_gross_2",$besitzer_2,$lang['host'][$spielersprache[$besitzer_2]]['ausweichen'][1],array($name_2,$spielerfarbe[$besitzer],$name));
                            $checkstring=$checkstring.":::".$shid_2.":::";
                        }
                    }
                }
            }
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////SCHIFF WEICHT SCHIFF AUS ENDE
/////////////////////////////////////////////////////////////////////////////////////////////SPEZIALMISSIONEN ANFANG
$zeiger = mysql_query("SELECT * FROM $skrupel_schiffe where spezialmission>=1 and spiel=$spiel order by id");
$schiffanzahl = mysql_num_rows($zeiger);
if ($schiffanzahl>=1) {
    for ($i=0; $i<$schiffanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $shid=$array["id"];
        $name=$array["name"];
        $masse=$array["masse"];
        $klasse=$array["klasse"];
        $antrieb=$array["antrieb"];
        $klasseid=$array["klasseid"];
        $kox=$array["kox"];
        $koy=$array["koy"];
        $volk=$array["volk"];
        $besitzer=$array["besitzer"];
        $bild_gross=$array["bild_gross"];
        $frachtraum=$array["frachtraum"];
        $lemin=$array["lemin"];
        $leminmax=$array["leminmax"];
        $crew=$array["crew"];
        $crewmax=$array["crewmax"];
        $flug=$array["flug"];
        $schaden=$array["schaden"];
        $leichtebt=$array["leichtebt"];
        $schwerebt=$array["schwerebt"];
        $erfahrung=$array["erfahrung"];
        $energetik_stufe=$array["energetik_stufe"];
        $energetik_anzahl=$array["energetik_anzahl"];
        $projektile_stufe=$array["projektile_stufe"];
        $projektile_anzahl=$array["projektile_anzahl"];
        $projektile=$array["projektile"];
        $hanger_anzahl=$array["hanger_anzahl"];
        $sprungtorbauid=$array["sprungtorbauid"];
        $fertigkeiten=$array["fertigkeiten"];
        $spezialmission=$array["spezialmission"];
        $status=$array["status"];
        $extra = explode(":", trim($array['extra']));
        $fracht_leute=$array["fracht_leute"];
        $fracht_cantox=$array["fracht_cantox"];
        $fracht_vorrat=$array["fracht_vorrat"];
        $fracht_lemin=$array["lemin"];
        $fracht_min1=$array["fracht_min1"];
        $fracht_min2=$array["fracht_min2"];
        $fracht_min3=$array["fracht_min3"];
        $zusatzmodul=$array["zusatzmodul"];
        $frachtfrei=$frachtraum-$fracht_vorrat-$fracht_min1-$fracht_min2-$fracht_min3-floor($fracht_leute/100);
        $tankfrei=$leminmax-$fracht_lemin;
        $fert_sub_vorrat=intval(substr($fertigkeiten,0,2));
        $fert_sub_min1=intval(substr($fertigkeiten,2,1));
        $fert_sub_min2=intval(substr($fertigkeiten,3,1));
        $fert_sub_min3=intval(substr($fertigkeiten,4,1));
        $fert_terra_warm=intval(substr($fertigkeiten,5,1));
        $fert_terra_kalt=intval(substr($fertigkeiten,6,1));
        $fert_quark_vorrat=intval(substr($fertigkeiten,7,1));
        $fert_quark_min1=intval(substr($fertigkeiten,8,1));
        $fert_quark_min2=intval(substr($fertigkeiten,9,1));
        $fert_quark_min3=intval(substr($fertigkeiten,10,1));
        $fert_sprung_kosten=intval(substr($fertigkeiten,11,3));
        $fert_sprung_min=intval(substr($fertigkeiten,14,4));
        $fert_sprung_max=intval(substr($fertigkeiten,18,4));
        $fert_sprungtorbau_min1=intval(substr($fertigkeiten,25,3));
        $fert_sprungtorbau_min2=intval(substr($fertigkeiten,28,3));
        $fert_sprungtorbau_min3=intval(substr($fertigkeiten,31,3));
        $fert_sprungtorbau_lemin=intval(substr($fertigkeiten,34,3));
        $fert_reperatur=intval(substr($fertigkeiten,37,1));
        $viralmin=intval(substr($fertigkeiten,41,2));
        $viralmax=intval(substr($fertigkeiten,43,3));
        $erwtrans=intval(substr($fertigkeiten,46,2));
        $cybern=intval(substr($fertigkeiten,48,2));
        $destabi=intval(substr($fertigkeiten,50,2));
        /////////////////////////////////////////////////////////////////////////////////////////////MINENFELD RAEUMEN ANFANG
        if (($module[2]) and ($spezialmission==25) and ($hanger_anzahl>=1)) {
            if($status!=2){
                $erfolg=0;
                if ($hanger_anzahl==1) { $erfolg=1; }
                if ($hanger_anzahl>=2) {
                    $erfolg=mt_rand(round($hanger_anzahl/2),$hanger_anzahl);
                }
                //echo $erfolg;
                if ($erfolg>=1) {
                    $reichweite=100;
                    $minenanzahl=0;
                    $zeiger2 = mysql_query("SELECT * FROM $skrupel_anomalien where spiel=$spiel and art=5 and (sqrt(((x_pos-$kox)*(x_pos-$kox))+((y_pos-$koy)*(y_pos-$koy)))<=$reichweite) order by id");
                    $datensaetze2 = mysql_num_rows($zeiger2);
                    if ($datensaetze2>=1) {
                        for ($irt=0; $irt<$datensaetze2;$irt++) {
                            $ok2 = mysql_data_seek($zeiger2,$irt);
                            $array2 = mysql_fetch_array($zeiger2);
                            $aid=$array2["id"];
                            $x_pos=$array2["x_pos"];
                            $y_pos=$array2["y_pos"];
                            $mineextra=explode(":",$array2["extra"]);
                            if(    ($mineextra[0]==$besitzer) or
                                ($beziehung[$besitzer][$mineextra[0]]['status']==3) or
                                ($beziehung[$besitzer][$mineextra[0]]['status']==4) or
                                ($beziehung[$besitzer][$mineextra[0]]['status']==5))
                            {} else {
                                if (intval($mineextra[1])>=$minenanzahl) {
                                    $minenanzahl=intval($mineextra[1]);
                                    $aanomalie[0]=$aid; // id
                                    $aanomalie[1]=$mineextra[0]; // besitzer
                                    $aanomalie[2]=intval($mineextra[1]); // anzahl
                                    $aanomalie[3]=$mineextra[2]; // stufe
                                }
                            }
                        }
                    }
                    if ($minenanzahl>=1) {
                        $aanomalie[2]=$aanomalie[2]-$erfolg;
                        if ($aanomalie[2]<=0) {
                            $zeiger_temp = mysql_query("DELETE FROM $skrupel_anomalien where spiel=$spiel and id=$aanomalie[0]");
                            neuigkeiten(4,"../bilder/news/minenfeld.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['minenfelder'][2],array($name));
                            neuigkeiten(4,"../bilder/news/minenfeld.jpg",$aanomalie[1],$lang['host'][$spielersprache[$aanomalie[1]]]['minenfelder'][3]);
                        } else {
                            neuigkeiten(4,"../bilder/news/minenfeld.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['minenfelder'][4],array($name,$erfolg));
                            $mineextra=$aanomalie[1].':'.$aanomalie[2].':'.$aanomalie[3];
                            $zeiger_temp = mysql_query("UPDATE $skrupel_anomalien set extra='$mineextra' where spiel=$spiel and id=$aanomalie[0]");
                        }
                    }
                }
            }else{
                neuigkeiten(4,"../bilder/news/minenfeld.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['minenfelder'][7],array($name));
                $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set spezialmission=0 where id=$shid");
            }
        }
        /////////////////////////////////////////////////////////////////////////////////////////////MINENFELD RAEUMEN ENDE
        /////////////////////////////////////////////////////////////////////////////////////////////MINENFELD LEGEN ANFANG
        if (($module[2]) and ($spezialmission==24)) {
            if($status!=2){
                $legen=intval($extra[2]);
                if ($legen>$projektile) {$legen=$projektile;}
                if ($legen>=1) {
                    $projektile=$projektile-$legen;
                    $extra[2]=0;
                    $extra_neu = implode(":", $extra);
                    $mineextra=$besitzer.':'.$legen.':'.$projektile_stufe;
                    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set projektile=$projektile,spezialmission=0,extra='$extra_neu' where id=$shid");
                    $zeiger_temp = mysql_query("INSERT INTO $skrupel_anomalien (art,x_pos,y_pos,extra,spiel) values (5,$kox,$koy,'$mineextra',$spiel);");
                    neuigkeiten(4,"../bilder/news/minenfeld.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['minenfelder'][5],array($name,$legen));
                } else {
                    $extra[2]=0;
                    $extra_neu = implode(":", $extra);
                    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set spezialmission=0,extra='$extra_neu' where id=$shid");
                }
            }else{
                neuigkeiten(4,"../bilder/news/minenfeld.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['minenfelder'][6],array($name));
                $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set spezialmission=0 where id=$shid");
            }
        }
        /////////////////////////////////////////////////////////////////////////////////////////////MINENFELD LEGEN ENDE
        /////////////////////////////////////////////////////////////////////////////////////////////AUTOGRAPSCH ANFANG
        unset($a_planet);
        // Fuer alle Eventualitaeten:
        // Hole Datensatz des Planeten
        if(    (    ($spezialmission==26) or
                ($spezialmission==27) or
                ($spezialmission==28)
            ) and ($status==2))
        {
            // Hole Planeten, um den das aktuelle Schiff gerade kreist
            $query_ret=mysql_query( "SELECT * FROM $skrupel_planeten WHERE x_pos=$kox and y_pos=$koy and spiel=$spiel;");
            // Mache nur was, wenn da auch nur ein Planet ist
            if($query_ret && (mysql_num_rows($query_ret)==1) )
            {
                $a_planet=mysql_fetch_array($query_ret);
                $planet_id=$a_planet["id"];
            }
        }
        // bei Quarkern gehen wir vorsichtiger vor:
        // 113 Lemin runter, 113 Vorraete und 113 Material rauf
        if( ($spezialmission==26) && ($status==2) && $a_planet)
        {
            beam_s_p($conn, $shid,$planet_id,"lemin",113);
            $p_vorrat=$a_planet["vorrat"];
                $p_min1=$a_planet["min1"];
                $p_min2=$a_planet["min2"];
                $p_min3=$a_planet["min3"];
                $osys_1=$a_planet["osys_1"];
                $osys_2=$a_planet["osys_2"];
                $osys_3=$a_planet["osys_3"];
                $osys_4=$a_planet["osys_4"];
                $osys_5=$a_planet["osys_5"];
                $osys_6=$a_planet["osys_6"];
                $p_besitzer=$a_planet["besitzer"];
            if((($osys_1==7) or ($osys_2==7) or ($osys_3==7) or ($osys_4==7) or ($osys_5==7)or ($osys_6==7))and($p_besitzer!=$besitzer)){
                $p_min1=max(0,($p_min1-100));
                $p_min2=max(0,($p_min2-100));
                $p_min3=max(0,($p_min3-100));
            }
            $uber=113;
            if ($fert_quark_vorrat>=1){
                $uber=min(113,$uber,floor(($p_vorrat+$fracht_vorrat)/$fert_quark_vorrat));
            }
            if ($fert_quark_min1>=1){
                $uber=min(113,$uber,floor(($p_min1+$fracht_min1)/$fert_quark_min1));
            }
            if ($fert_quark_min2>=1){
                $uber=min(113,$uber,floor(($p_min2+$fracht_min2)/$fert_quark_min2));
            }
            if ($fert_quark_min3>=1){
                $uber=min(113,$uber,floor(($p_min3+$fracht_min3)/$fert_quark_min3));
            }
            if($fert_quark_vorrat>=1){
                $fert_quark_vorrat_t=($fert_quark_vorrat*$uber)-$fracht_vorrat;
                $fert_quark_vorrat_t=max(0,$fert_quark_vorrat_t);
                $fracht_vorrat+=beam_p_s($conn, $planet_id, $shid, "vorrat", $fert_quark_vorrat_t);
            }
            if ($fert_quark_min1>=1){
                $fert_quark_min1_t=($fert_quark_min1*$uber)-$fracht_min1;
                $fert_quark_min1_t=max(0,$fert_quark_min1_t);
                $fracht_min1+=beam_p_s($conn, $planet_id, $shid, "min1", $fert_quark_min1_t);
            }
            if ($fert_quark_min2>=1){
                $fert_quark_min2_t=($fert_quark_min2*$uber)-$fracht_min2;
                $fert_quark_min2_t=max(0,$fert_quark_min2_t);
                $fracht_min2+=beam_p_s($conn, $planet_id, $shid, "min2", $fert_quark_min2_t);
            }
            if ($fert_quark_min3>=1){
                $fert_quark_min3_t=($fert_quark_min3*$uber)-$fracht_min3;
                $fert_quark_min3_t=max(0,$fert_quark_min3_t);
                $fracht_min3+=beam_p_s($conn, $planet_id, $shid, "min3", $fert_quark_min3_t);
            }
        }
        // Wenn Subpartikelcluster an ist und das Schiff sich im Planetenorbit
        // befindet: alles abladen und Vorraete fassen
        if( ($spezialmission==27) && ($status==2) && $a_planet){
            $p_vorrat=$a_planet["vorrat"];
            $osys_1=$a_planet["osys_1"];
            $osys_2=$a_planet["osys_2"];
            $osys_3=$a_planet["osys_3"];
            $osys_4=$a_planet["osys_4"];
            $osys_5=$a_planet["osys_5"];
            $osys_6=$a_planet["osys_6"];
            $p_besitzer=$a_planet["besitzer"];
            if((($osys_1==7) or ($osys_2==7) or ($osys_3==7) or ($osys_4==7) or ($osys_5==7)or ($osys_6==7))and($p_besitzer!=$besitzer)){
                $p_vorrat=max(0,($p_vorrat-100));
            }
            $fert_sub_vorrat_t=min($fert_sub_vorrat*287,floor(($p_vorrat+$fracht_vorrat)/$fert_sub_vorrat)*$fert_sub_vorrat);
            // Erstmal alles runterbeamen
            beam_s_p($conn, $shid,$planet_id,"vorrat",$frachtraum);
            beam_s_p($conn, $shid,$planet_id,"min1",$frachtraum);
            beam_s_p($conn, $shid,$planet_id,"min2",$frachtraum);
            beam_s_p($conn, $shid,$planet_id,"min3",$frachtraum);
            // Dann ordentlich Vorraete rauf beamen
            $fracht_vorrat=beam_p_s($conn, $planet_id, $shid, "vorrat", $fert_sub_vorrat_t);
        }
        // Wenn Cybernrittnikk an ist und das Schiff sich im Planetenorbit
        // befindet: Kolos abladen und Vorraete fassen
        if( ($spezialmission==28) && ($status==2) && $a_planet){
            // Erstmal alles runterbeamen
            // Aber nur, wenn der Planet niemand wichtigem gehoert.
            if($beziehung[$a_planet["besitzer"]][$besitzer]['status']<3){
                beam_s_p($conn, $shid,$planet_id,"kolonisten",$frachtraum*100);
            }
            $p_vorrat=$a_planet["vorrat"];
            $osys_1=$a_planet["osys_1"];
            $osys_2=$a_planet["osys_2"];
            $osys_3=$a_planet["osys_3"];
            $osys_4=$a_planet["osys_4"];
            $osys_5=$a_planet["osys_5"];
            $osys_6=$a_planet["osys_6"];
            $p_besitzer=$a_planet["besitzer"];
            if((($osys_1==7) or ($osys_2==7) or ($osys_3==7) or ($osys_4==7) or ($osys_5==7)or ($osys_6==7))and($p_besitzer!=$besitzer)){
                $p_vorrat=max(0,($p_vorrat-100));
            }
            $p_vorrat=min(220,$p_vorrat);
            // Dann ordentlich Vorraete rauf beamen
            $fracht_vorrat+=beam_p_s($conn, $planet_id, $shid, "vorrat", $p_vorrat);
        }
        /////////////////////////////////////////////////////////////////////////////////////////////AUTOGRAPSCH ENDE
        /////////////////////////////////////////////////////////////////////////////////////////////SUBPARTIKELVERZERRUNG ANFANG
        if (    ($fracht_vorrat>=$fert_sub_vorrat)
                and ($fert_sub_vorrat>=1)
                and ( ($spezialmission==4) or ($spezialmission==27) ) )
        {
            $max=floor($fracht_vorrat/$fert_sub_vorrat);
            //$maxraum=floor($frachtfrei/($fert_sub_min1+$fert_sub_min2+$fert_sub_min3));
            //if ($maxraum < $max) { $max=$maxraum; }
            if (287<$max) {$max=287;}
            if ($max>=1) {
                $vorrat_verbrauch=$max*$fert_sub_vorrat;
                $min1_prod=$max*$fert_sub_min1;
                $min2_prod=$max*$fert_sub_min2;
                $min3_prod=$max*$fert_sub_min3;
                $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set fracht_vorrat=fracht_vorrat-$vorrat_verbrauch,fracht_min1=fracht_min1+$min1_prod,fracht_min2=fracht_min2+$min2_prod,fracht_min3=fracht_min3+$min3_prod where id=$shid");
            }
        }
        /////////////////////////////////////////////////////////////////////////////////////////////SUBPARTIKELVERZERRUNG ENDE
        /////////////////////////////////////////////////////////////////////////////////////////////DESTABILISATOR ANFANG
        if (($spezialmission==20)and ($status==2)) {
            $zufall=mt_rand(1,100);
            if ($zufall<=$destabi) {
                $zeiger2 = mysql_query("SELECT * FROM $skrupel_planeten where x_pos=$kox and y_pos=$koy and besitzer<>$besitzer and spiel=$spiel");
                $planetenanzahl = mysql_num_rows($zeiger2);
                if ($planetenanzahl==1) {
                    $array2 = mysql_fetch_array($zeiger2);
                    $p_id=$array2["id"];
                    $p_besitzer=$array2["besitzer"];
                    $p_name=$array2["name"];
                    $osys_1=$array2["osys_1"];
                    $osys_2=$array2["osys_2"];
                    $osys_3=$array2["osys_3"];
                    $osys_4=$array2["osys_4"];
                    $osys_5=$array2["osys_5"];
                    $osys_6=$array2["osys_6"];
                    if(($osys_1!=19) and ($osys_2!=19) and ($osys_3!=19) and ($osys_4!=19) and ($osys_5!=19) and ($osys_6!=19)){
                        if ($beziehung[$besitzer][$p_besitzer]['status']!=5) {
                            $sektork=sektor($kox,$koy);
                            $zeiger_temp = mysql_query("DELETE FROM $skrupel_planeten where id=$p_id and besitzer=$p_besitzer;");
                            $zeiger_temp = mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 'p:$p_id:%'");
                            $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where flug=2 and zielid=$p_id");
                            $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set status=1 where kox=$kox and koy=$koy and spiel=$spiel");
                            $zeiger_temp = mysql_query("DELETE FROM $skrupel_sternenbasen where x_pos=$kox and y_pos=$koy and spiel=$spiel");
                            $suche=array('{1}','{2}');
                            $ersetzen=array($p_name,$sektork);
                            $text=str_replace($suche,$ersetzen,$text);
                            if (($spieler_1>=1) and ($p_besitzer<>1)) { neuigkeiten(4,"../bilder/news/star_explode.jpg",1,$lang['host'][$spielersprache[1]]['destabilisator'][0],array($p_name,$sektork)); }
                            if (($spieler_2>=1) and ($p_besitzer<>2)) { neuigkeiten(4,"../bilder/news/star_explode.jpg",2,$lang['host'][$spielersprache[2]]['destabilisator'][0],array($p_name,$sektork)); }
                            if (($spieler_3>=1) and ($p_besitzer<>3)) { neuigkeiten(4,"../bilder/news/star_explode.jpg",3,$lang['host'][$spielersprache[3]]['destabilisator'][0],array($p_name,$sektork)); }
                            if (($spieler_4>=1) and ($p_besitzer<>4)) { neuigkeiten(4,"../bilder/news/star_explode.jpg",4,$lang['host'][$spielersprache[4]]['destabilisator'][0],array($p_name,$sektork)); }
                            if (($spieler_5>=1) and ($p_besitzer<>5)) { neuigkeiten(4,"../bilder/news/star_explode.jpg",5,$lang['host'][$spielersprache[5]]['destabilisator'][0],array($p_name,$sektork)); }
                            if (($spieler_6>=1) and ($p_besitzer<>6)) { neuigkeiten(4,"../bilder/news/star_explode.jpg",6,$lang['host'][$spielersprache[6]]['destabilisator'][0],array($p_name,$sektork)); }
                            if (($spieler_7>=1) and ($p_besitzer<>7)) { neuigkeiten(4,"../bilder/news/star_explode.jpg",7,$lang['host'][$spielersprache[7]]['destabilisator'][0],array($p_name,$sektork)); }
                            if (($spieler_8>=1) and ($p_besitzer<>8)) { neuigkeiten(4,"../bilder/news/star_explode.jpg",8,$lang['host'][$spielersprache[8]]['destabilisator'][0],array($p_name,$sektork)); }
                            if (($spieler_9>=1) and ($p_besitzer<>9)) { neuigkeiten(4,"../bilder/news/star_explode.jpg",9,$lang['host'][$spielersprache[9]]['destabilisator'][0],array($p_name,$sektork)); }
                            if (($spieler_10>=1) and ($p_besitzer<>10)) { neuigkeiten(4,"../bilder/news/star_explode.jpg",10,$lang['host'][$spielersprache[10]]['destabilisator'][0],array($p_name,$sektork)); }
                            if ($p_besitzer>=1) {
                                neuigkeiten(4,"../bilder/news/star_explode.jpg",$p_besitzer,$lang['host'][$spielersprache[$p_besitzer]]['destabilisator'][1],array($p_name,$sektork));
                            }
                        }
                    }else{
                        neuigkeiten(4,"../bilder/news/star_explode.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['destabilisator'][2],array($p_name,$sektork));
                    }
                }
            }
        }
        /////////////////////////////////////////////////////////////////////////////////////////////DESTABILISATOR ENDE
        /////////////////////////////////////////////////////////////////////////////////////////////CYBERRITTNIKK ANFANG
        if ($fracht_vorrat>=220 && ($spezialmission==19 || $spezialmission==28) && $s_eigenschaften[$besitzer]['rasse']==$volk) {
            $kolonistengebaut = 220*$cybern;
            $fracht_leute += $kolonistengebaut;
            mysql_query("UPDATE $skrupel_schiffe SET fracht_vorrat=fracht_vorrat-220, fracht_leute=fracht_leute+$kolonistengebaut WHERE id=$shid");
        }
        /////////////////////////////////////////////////////////////////////////////////////////////CYBERRITTNIKK ENDE
        /////////////////////////////////////////////////////////////////////////////////////////////QUARKREORGANISATOR ANFANG
        if ( ($spezialmission==6) || ($spezialmission==26) ){
            $max=$tankfrei;
            if ($fert_quark_vorrat>=1) {
                $max_vorrat=floor($fracht_vorrat/$fert_quark_vorrat);
                if ($max>$max_vorrat) {$max=$max_vorrat;}
            }
            if ($fert_quark_min1>=1) {
                $max_min1=floor($fracht_min1/$fert_quark_min1);
                if ($max>$max_min1) {$max=$max_min1;}
            }
            if ($fert_quark_min2>=1) {
                $max_min2=floor($fracht_min2/$fert_quark_min2);
                if ($max>$max_min2) {$max=$max_min2;}
            }
            if ($fert_quark_min3>=1) {
                $max_min3=floor($fracht_min3/$fert_quark_min3);
                if ($max>$max_min3) {$max=$max_min3;}
            }
            if (113<$max) {$max=113;}
            if ($max>=1) {
                $vorrat_verbrauch=$max*$fert_quark_vorrat;
                $min1_verbrauch=$max*$fert_quark_min1;
                $min2_verbrauch=$max*$fert_quark_min2;
                $min3_verbrauch=$max*$fert_quark_min3;
                $lemin_prod=$max;
                $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set fracht_vorrat=fracht_vorrat-$vorrat_verbrauch,fracht_min1=fracht_min1-$min1_verbrauch,fracht_min2=fracht_min2-$min2_verbrauch,fracht_min3=fracht_min3-$min3_verbrauch,lemin=lemin+$lemin_prod where id=$shid");
            }
        }
        /////////////////////////////////////////////////////////////////////////////////////////////QUARKREORGANISATOR ENDE
        /////////////////////////////////////////////////////////////////////////////////////////////SCHIFF RECYCLEN ANFANG
        if (($spezialmission==2) and ($status==2)) {
            $zeiger2 = mysql_query("SELECT * FROM $skrupel_planeten where x_pos=$kox and y_pos=$koy and besitzer=$besitzer and spiel=$spiel");
            $planetenanzahl = mysql_num_rows($zeiger2);
            if ($planetenanzahl==1) {
                $array2 = mysql_fetch_array($zeiger2);
                $p_id=$array2["id"];
                $p_sternenbasis=$array2["sternenbasis"];
                $p_sternenbasis_id=$array2["sternenbasis_id"];
                $osys_1=$array2["osys_1"];
                $osys_2=$array2["osys_2"];
                $osys_3=$array2["osys_3"];
                $osys_4=$array2["osys_4"];
                $osys_5=$array2["osys_5"];
                $osys_6=$array2["osys_6"];
                if ($p_sternenbasis_id>=1 or $osys_1==17 or $osys_2==17 or $osys_3==17 or $osys_4==17 or $osys_5==17 or $osys_6==17) {
                    $neu_min1=0;
                    $neu_min2=0;
                    $neu_min3=0;
                    $file=$main_verzeichnis.'daten/'.$volk.'/schiffe.txt';
                    $fp = fopen("$file","r");
                    if ($fp) {
                        $zaehler=0;
                        while (!feof ($fp)) {
                            $buffer = fgets($fp, 4096);
                            $schiff[$zaehler]=$buffer;
                            $zaehler++;
                        }
                        fclose($fp);
                    }
                    for ($ik=0;$ik<$zaehler;$ik++) {
                        $schiffwert=explode(':',$schiff[$ik]);
                        if ($schiffwert[1]==$klasseid) {
                            $neu_min1=round($schiffwert[6]/100*85);
                            $neu_min2=round($schiffwert[7]/100*85);
                            $neu_min3=round($schiffwert[8]/100*85);
                        }
                    }
                    $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set kolonisten=kolonisten+$fracht_leute,lemin=lemin+$fracht_lemin,min1=min1+$fracht_min1,min2=min2+$fracht_min2,min3=min3+$fracht_min3,vorrat=vorrat+$fracht_vorrat,cantox=cantox+$fracht_cantox where id=$p_id");
                    $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set min1=min1+$neu_min1,min2=min2+$neu_min2,min3=min3+$neu_min3 where id=$p_id");
                    $zeiger_temp = mysql_query("DELETE FROM $skrupel_schiffe where id=$shid");
                    $zeiger_temp = mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 's:$shid:%'");
                    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where (flug=3 or flug=4) and zielid=$shid");
                    neuigkeiten(3,"../daten/$volk/bilder_basen/1.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['recycle'][0],array($name,$neu_min1,$neu_min2,$neu_min3));
                }
            }
        }
        /////////////////////////////////////////////////////////////////////////////////////////////SCHIFF RECYCLEN ENDE
        /////////////////////////////////////////////////////////////////////////////////////////////SCHIFF REPARATUR ANFANG
        if (($spezialmission==14) and ($status==2) and ($schaden>=1)) {
            $reperatur=0;
            $zeiger2 = mysql_query("SELECT id,x_pos,y_pos,besitzer,spiel,sternenbasis,sternenbasis_id,sternenbasis_art FROM $skrupel_planeten where x_pos=$kox and y_pos=$koy and besitzer=$besitzer and spiel=$spiel");
            $planetenanzahl = mysql_num_rows($zeiger2);
            if ($planetenanzahl==1) {
                $array2 = mysql_fetch_array($zeiger2);
                $p_id=$array2["id"];
                $p_sternenbasis=$array2["sternenbasis"];
                $p_sternenbasis_id=$array2["sternenbasis_id"];
                $p_sternenbasis_art=$array2["sternenbasis_art"];
                if (($p_sternenbasis_id>=1) and ($p_sternenbasis_art==0)) {
                    $reperatur=11;
                }
                if (($p_sternenbasis_id>=1) and ($p_sternenbasis_art==3)) {
                    $reperatur=11;
                }
                if (($p_sternenbasis_id>=1) and ($p_sternenbasis_art==1)) {
                    $reperatur=19;
                }
                $zeiger3 = mysql_query("SELECT id,kox,koy,besitzer,fertigkeiten,status FROM $skrupel_schiffe where besitzer=$besitzer and kox=$kox and koy=$koy and status=2 and spiel=$spiel order by id");
                $schiffanzahl3 = mysql_num_rows($zeiger3);
                if ($schiffanzahl3>=1) {
                    for ($ikk=0; $ikk<$schiffanzahl3;$ikk++) {
                        $ok3 = mysql_data_seek($zeiger3,$ikk);
                        $array3 = mysql_fetch_array($zeiger3);
                        $kox=$array3["kox"];
                        $koy=$array3["koy"];
                        $besitzer=$array3["besitzer"];
                        $fertigkeiten=$array3["fertigkeiten"];
                        $status=$array3["status"];
                        $fert_reperatur=intval(substr($fertigkeiten,37,1));
                        if (($fert_reperatur>=1) and ($fert_reperatur>$reperatur)) { $reperatur=$fert_reperatur; }
                    }
                }
                if ($reperatur>=1) {
                    $schaden=$schaden-$reperatur;
                    if ($schaden>=1) {
                        $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set schaden=$schaden where id=$shid");
                    } else {
                        $schaden=0;
                        $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set schaden=0 where id=$shid");
                        neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['reparatur'][0],array($name));
                    }
                }
            }
        }
        /////////////////////////////////////////////////////////////////////////////////////////////SCHIFF REPARATUR ENDE
        /////////////////////////////////////////////////////////////////////////////////////////////CREW ANHEUERN ANFANG
        if (($spezialmission==23) and ($status==2)) {
            $reperatur=0;
            $zeiger2 = mysql_query("SELECT id,kolonisten,x_pos,y_pos,besitzer,spiel,sternenbasis,sternenbasis_id FROM $skrupel_planeten where x_pos=$kox and y_pos=$koy and besitzer=$besitzer and spiel=$spiel");
            $planetenanzahl = mysql_num_rows($zeiger2);
            if ($planetenanzahl==1) {
                $array2 = mysql_fetch_array($zeiger2);
                $p_id=$array2["id"];
                $p_sternenbasis=$array2["sternenbasis"];
                $p_sternenbasis_id=$array2["sternenbasis_id"];
                $p_kolonisten=$array2["kolonisten"];
                if ($p_sternenbasis_id>=1) {
                    $leute_neu=intval($extra[1]);
                    if ($leute_neu>$p_kolonisten) { $leute_neu=$p_kolonisten; }
                    $p_kolonisten=$p_kolonisten-$leute_neu;
                    $crew=$crew+$leute_neu;
                    $extra[1]='';
                    $extra_neu = implode(":", $extra);
                    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set crew=$crew,extra='$extra_neu',spezialmission=0 where id=$shid");
                    $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set kolonisten=$p_kolonisten where id=$p_id");
                    if($crew==$crewmax){
                        neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['crew'][0],array($name,$leute_neu));
                    }else{
                        neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['crew'][0],array($name,$leute_neu,$crew));
                    }
                }
            }
        }
        /////////////////////////////////////////////////////////////////////////////////////////////CREW ANHEUERN ENDE
        /////////////////////////////////////////////////////////////////////////////////////////////TANKEN ANFANG
        if (($spezialmission==1) and ($status==2)) {
            $zeiger2 = mysql_query("SELECT * FROM $skrupel_planeten where x_pos=$kox and y_pos=$koy and spiel=$spiel");
            $planetenanzahl = mysql_num_rows($zeiger2);
            if ($planetenanzahl==1) {
                $array2 = mysql_fetch_array($zeiger2);
                $p_id=$array2["id"];
                $osys_1=$array2["osys_1"];
                $osys_2=$array2["osys_2"];
                $osys_3=$array2["osys_3"];
                $osys_4=$array2["osys_4"];
                $osys_5=$array2["osys_5"];
                $osys_6=$array2["osys_6"];
                $p_lemin=$array2["lemin"];
                $p_besitzer=$array2["besitzer"];
                if((($osys_1==7) or ($osys_2==7) or ($osys_3==7) or ($osys_4==7) or ($osys_5==7)or ($osys_6==7))and($p_besitzer!=$besitzer)){
                    $p_lemin=max(0,($p_lemin-100));
                }
                $lemin_tanken=$leminmax-$lemin;
                if ($lemin_tanken>$p_lemin) {$lemin_tanken=$p_lemin;}
                $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set lemin=lemin-$lemin_tanken where id=$p_id");
                $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set lemin=lemin+$lemin_tanken where id=$shid");
            }
        }
        /////////////////////////////////////////////////////////////////////////////////////////////TANKEN ENDE
        /////////////////////////////////////////////////////////////////////////////////////////////PLANETENBOMBARDEMENT ANFANG
        if (($spezialmission==3) and ($status==2)) {
            $zeiger2 = mysql_query("SELECT * FROM $skrupel_planeten where x_pos=$kox and y_pos=$koy and besitzer<>$besitzer and besitzer>=1 and spiel=$spiel");
            $planetenanzahl = mysql_num_rows($zeiger2);
            if ($planetenanzahl==1) {
                $array2 = mysql_fetch_array($zeiger2);
                $p_id=$array2["id"];
                $osys_1=$array2["osys_1"];
                $osys_2=$array2["osys_2"];
                $osys_3=$array2["osys_3"];
                $osys_4=$array2["osys_4"];
                $osys_5=$array2["osys_5"];
                $osys_6=$array2["osys_6"];
                $p_kolonisten=$array2["kolonisten"];
                $p_minen=$array2["minen"];
                $p_fabriken=$array2["fabriken"];
                $p_abwehr=$array2["abwehr"];
                $p_name=$array2["name"];
                $p_bild=$array2["bild"];
                $p_klasse=$array2["klasse"];
                $p_besitzer=$array2["besitzer"];
                $native_id=$array2["native_id"];
                $native_abgabe=$array2["native_abgabe"];
                $native_fert=$array2["native_fert"];
                $native_kol=$array2["native_kol"];
                $native_fert_schutz=intval(substr($native_fert,21,2));
                if ($beziehung[$besitzer][$p_besitzer]['status']!=5) {
                    $maxcol=100;
                    if (($native_id>=1) and ($native_kol>1)) { $maxcol=$maxcol-$native_fert_schutz; }
                    $staerke_angriff=round(($hanger_anzahl*35)+($torpedoschaden[$projektile_stufe]*$projektile_anzahl)+($strahlenschaden[$energetik_stufe]*$energetik_anzahl));
                    $prozent=round($staerke_angriff/4);
                    $prozente[0]=mt_rand(0,$prozent);
                    $prozente[1]=mt_rand(0,($prozent-$prozente[0]));
                    $prozente[2]=mt_rand(0,($prozent-$prozente[0]-$prozente[1]));
                    $prozente[3]=($prozent-$prozente[0]-$prozente[1]-$prozente[2]);
                    shuffle($prozente);
                    $prozent_kolonisten=$prozente[0];if ($prozent_kolonisten>100) { $prozent_kolonisten=100; }
                    $prozent_minen=$prozente[1];if ($prozent_minen>100) { $prozent_minen=100; }
                    $prozent_fabriken=$prozente[2];if ($prozent_fabriken>100) { $prozent_fabriken=100; }
                    $prozent_abwehr=$prozente[3];if ($prozent_abwehr>100) { $prozent_abwehr=100; }
                    if ($prozent_kolonisten>$maxcol) {$prozent_kolonisten=$maxcol;}
                    $vernichtet_kolonisten=round($p_kolonisten/100*$prozent_kolonisten);
                    $o_kolonisten=$p_kolonisten;
                    $p_kolonisten=$p_kolonisten-$vernichtet_kolonisten;
                    if(($osys_1==7) or ($osys_2==7) or ($osys_3==7) or ($osys_4==7) or ($osys_5==7)or ($osys_6==7)){
                        $p_kolonisten=max(1000,$p_kolonisten);
                        $vernichtet_kolonisten=$o_kolonisten-$p_kolonisten;
                        $prozent_kolonisten=round($vernichtet_kolonisten/$o_kolonisten*100);
                    }
                    $vernichtet_minen=round($p_minen/100*$prozent_minen);
                    $vernichtet_fabriken=round($p_fabriken/100*$prozent_fabriken);
                    $vernichtet_abwehr=round($p_abwehr/100*$prozent_abwehr);
                    $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set kolonisten=$p_kolonisten,minen=minen-$vernichtet_minen,fabriken=fabriken-$vernichtet_fabriken,abwehr=abwehr-$vernichtet_abwehr where id=$p_id");
                    neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['bombardement'][0],array($name,$p_name,$vernichtet_minen,$prozent_minen,$vernichtet_fabriken,$prozent_fabriken,$vernichtet_abwehr,$prozent_abwehr,$vernichtet_kolonisten,$prozent_kolonisten));
                    neuigkeiten(1,"../bilder/planeten/$p_klasse"."_"."$p_bild.jpg",$p_besitzer,$lang['host'][$spielersprache[$p_besitzer]]['bombardement'][1],array($p_name,$vernichtet_minen,$prozent_minen,$vernichtet_fabriken,$prozent_fabriken,$vernichtet_abwehr,$prozent_abwehr,$vernichtet_kolonisten,$prozent_kolonisten));
                }
            }
        }
        /////////////////////////////////////////////////////////////////////////////////////////////PLANETENBOMBARDEMENT ENDE
        /////////////////////////////////////////////////////////////////////////////////////////////VIRALER ANGRIFF ANFANG
        if (($spezialmission==17) and ($status==2)) {
            $zeiger2 = mysql_query("SELECT * FROM $skrupel_planeten where x_pos=$kox and y_pos=$koy and besitzer<>$besitzer and besitzer>=1 and spiel=$spiel");
            $planetenanzahl = mysql_num_rows($zeiger2);
            if ($planetenanzahl==1) {
                $array2 = mysql_fetch_array($zeiger2);
                $p_id=$array2["id"];
                $p_kolonisten=$array2["kolonisten"];
                $p_name=$array2["name"];
                $p_bild=$array2["bild"];
                $p_klasse=$array2["klasse"];
                $p_besitzer=$array2["besitzer"];
                $osys_1=$array2["osys_1"];
                $osys_2=$array2["osys_2"];
                $osys_3=$array2["osys_3"];
                $osys_4=$array2["osys_4"];
                $osys_5=$array2["osys_5"];
                $osys_6=$array2["osys_6"];
                if(($osys_1!=20) and ($osys_2!=20) and ($osys_3!=20) and ($osys_4!=20) and ($osys_5!=20) and ($osys_6!=20)){
                    if ($beziehung[$besitzer][$p_besitzer]['status']!=5) {
                        $prozent_kolonisten=mt_rand($viralmin,$viralmax);
                        $vernichtet_kolonisten=round($p_kolonisten/100*$prozent_kolonisten);
                        $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set kolonisten=kolonisten-$vernichtet_kolonisten where id=$p_id");
                        neuigkeiten(2,"../bilder/news/epedemie.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['viral'][0],array($name,$p_name,$vernichtet_kolonisten,$prozent_kolonisten));
                        neuigkeiten(1,"../bilder/news/epedemie.jpg",$p_besitzer,$lang['host'][$spielersprache[$p_besitzer]]['viral'][1],array($p_name,$vernichtet_kolonisten,$prozent_kolonisten));
                    }
                }else{
                    neuigkeiten(2,"../bilder/news/epedemie.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['viral'][4],array($name,$p_name));
                    neuigkeiten(1,"../bilder/news/epedemie.jpg",$p_besitzer,$lang['host'][$spielersprache[$p_besitzer]]['viral'][5],array($p_name));
                }
            }
        }
        if (($spezialmission==18) and ($status==2)) {
            $zeiger2 = mysql_query("SELECT * FROM $skrupel_planeten where x_pos=$kox and y_pos=$koy and native_id>=1 and native_kol>0 and spiel=$spiel");
            $planetenanzahl = mysql_num_rows($zeiger2);
            if ($planetenanzahl==1) {
                $array2 = mysql_fetch_array($zeiger2);
                $p_id=$array2["id"];
                $p_name=$array2["name"];
                $p_bild=$array2["bild"];
                $p_klasse=$array2["klasse"];
                $native_id=$array2["native_id"];
                $native_kol=$array2["native_kol"];
                $p_besitzer=$array2["besitzer"];
                $osys_1=$array2["osys_1"];
                $osys_2=$array2["osys_2"];
                $osys_3=$array2["osys_3"];
                $osys_4=$array2["osys_4"];
                $osys_5=$array2["osys_5"];
                $osys_6=$array2["osys_6"];
                if(($osys_1!=20) and ($osys_2!=20) and ($osys_3!=20) and ($osys_4!=20) and ($osys_5!=20) and ($osys_6!=20)){
                    if ($beziehung[$besitzer][$p_besitzer]['status']!=5) {
                        $prozent_native=mt_rand($viralmin,$viralmax);
                        $vernichtet_native=round($native_kol/100*$prozent_native);
                        $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set native_kol=native_kol-$vernichtet_native where id=$p_id");
                        neuigkeiten(2,"../bilder/news/epedemie.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['viral'][2],array($name,$p_name,$vernichtet_native,$prozent_native));
                        if ($p_besitzer>=1) {
                            neuigkeiten(1,"../bilder/news/epedemie.jpg",$p_besitzer,$lang['host'][$spielersprache[$p_besitzer]]['viral'][3],array($p_name,$vernichtet_native,$prozent_native));
                        }
                    }
                }else{
                    neuigkeiten(2,"../bilder/news/epedemie.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['viral'][4],array($name,$p_name));
                    if ($p_besitzer>=1) {
                        neuigkeiten(1,"../bilder/news/epedemie.jpg",$p_besitzer,$lang['host'][$spielersprache[$p_besitzer]]['viral'][6],array($p_name));
                    }
                }
            }
        }
        /////////////////////////////////////////////////////////////////////////////////////////////VIRALER ANGRIFF ENDE
        /////////////////////////////////////////////////////////////////////////////////////////////TERRAFORMING ANFANG
        if (($spezialmission==5) and ($status==2)) {
            $zeiger2 = mysql_query("SELECT * FROM $skrupel_planeten where x_pos=$kox and y_pos=$koy and spiel=$spiel");
            $planetenanzahl = mysql_num_rows($zeiger2);
            if ($planetenanzahl==1) {
                $array2 = mysql_fetch_array($zeiger2);
                $p_id=$array2["id"];
                $p_temp=$array2["temp"];
                $p_name=$array2["name"];
                if ($fert_terra_warm>=1) {
                    $p_temp=$p_temp+$fert_terra_warm;
                    $tempschreib=$p_temp-35;
                    neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['terraforming'][0],array($p_name,$fert_terra_warm,$tempschreib));
                }
                if ($fert_terra_kalt>=1) {
                    $p_temp=$p_temp-$fert_terra_kalt;
                    $tempschreib=$p_temp-35;
                    neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['terraforming'][1],array($p_name,$fert_terra_kalt,$tempschreib));
                }
                $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set temp=$p_temp where id=$p_id");
            }
        }
        /////////////////////////////////////////////////////////////////////////////////////////////TERRAFORMING ENDE
        /////////////////////////////////////////////////////////////////////////////////////////////SPRUNGTOR ANFANG
        if (($spezialmission==13) and ($status==1) and ($flug==0)) {
            $ok=2;
            $zeiger2 = mysql_query("SELECT y_pos,x_pos,spiel from $skrupel_planeten where (sqrt(((x_pos-$kox)*(x_pos-$kox))+((y_pos-$koy)*(y_pos-$koy)))<=30) and spiel=$spiel");
            $p2anzahl = mysql_num_rows($zeiger2);
            if ($p2anzahl>=1) {
                $ok=1;
                neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['sprungtor'][0]);
            }else{
                $zeiger2 = mysql_query("SELECT y_pos,x_pos,spiel from $skrupel_anomalien where (sqrt(((x_pos-$kox)*(x_pos-$kox))+((y_pos-$koy)*(y_pos-$koy)))<=30) and spiel=$spiel");
                $a2anzahl = mysql_num_rows($zeiger2);
                if ($a2anzahl>=1) {
                    $ok=1;
                    neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['sprungtor'][1]);
                }else{
                    if (($fert_sprungtorbau_min1>$fracht_min1) or ($fert_sprungtorbau_min2>$fracht_min2) or ($fert_sprungtorbau_min3>$fracht_min3) or ($fert_sprungtorbau_lemin>$fracht_lemin)) {
                        $ok=1;
                        neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['sprungtor'][2]);
                    }
                }
            }
            if ($ok==2) {
                $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set fracht_min1=fracht_min1-$fert_sprungtorbau_min1,fracht_min2=fracht_min2-$fert_sprungtorbau_min2,fracht_min3=fracht_min3-$fert_sprungtorbau_min3,lemin=lemin-$fert_sprungtorbau_lemin where id=$shid");
                if ($sprungtorbauid>=1) {
                    $zeiger_temp = mysql_query("SELECT * FROM $skrupel_anomalien where id=$sprungtorbauid");
                    $array_temp = mysql_fetch_array($zeiger_temp);
                    $aid=$array_temp["id"];
                    $x_pos_eins=$array_temp["x_pos"];
                    $y_pos_eins=$array_temp["y_pos"];
                    $extra=$sprungtorbauid.":".$x_pos_eins.":".$y_pos_eins;
                    $zeiger2 = mysql_query("INSERT INTO $skrupel_anomalien (art,x_pos,y_pos,extra,spiel) values (2,$kox,$koy,'$extra',$spiel);");
                    $zeiger2 = mysql_query("SELECT * FROM $skrupel_anomalien where x_pos=$kox and y_pos=$koy and spiel=$spiel");
                    $array = mysql_fetch_array($zeiger2);
                    $aid_zwei=$array["id"];
                    $x_pos_zwei=$array["x_pos"];
                    $y_pos_zwei=$array["y_pos"];
                    $extra=$aid_zwei.":".$x_pos_zwei.":".$y_pos_zwei;
                    $zeiger2 = mysql_query("UPDATE $skrupel_anomalien set extra='$extra' where id=$sprungtorbauid;");
                    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set sprungtorbauid=0,spezialmission=0 where id=$shid");
                    neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['sprungtor'][3]);
                } else {
                    $zeiger_temp = mysql_query("INSERT INTO $skrupel_anomalien (art,x_pos,y_pos,spiel) values (2,$kox,$koy,$spiel);");
                    $zeiger_temp = mysql_query("SELECT * FROM $skrupel_anomalien where x_pos=$kox and y_pos=$koy and spiel=$spiel");
                    $array_temp = mysql_fetch_array($zeiger_temp);
                    $aid=$array_temp["id"];
                    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set sprungtorbauid=$aid,spezialmission=0 where id=$shid");
                    neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['sprungtor'][4]);
                }
            }
        }
        /////////////////////////////////////////////////////////////////////////////////////////////SPRUNGTOR ENDE
        /////////////////////////////////////////////////////////////////////////////////////////////Akademieausbildung Anfang
        if(($spezialmission>71) and ($spezialmission<77) and ($masse<100)){
            if($flug==0){
                $zeiger2 = mysql_query("SELECT * FROM $skrupel_planeten where besitzer=$spieler and spiel=$spiel and x_pos=$kox and y_pos=$koy");
                $planeten_anzahl = mysql_num_rows($zeiger2);
                $fert_akademie=0;
                if($planeten_anzahl==1){
                    $ok = mysql_data_seek($zeiger2,0);
                    $array2 = mysql_fetch_array($zeiger2);
                    $osys_1=$array2["osys_1"];
                    $osys_2=$array2["osys_2"];
                    $osys_3=$array2["osys_3"];
                    $osys_4=$array2["osys_4"];
                    $osys_5=$array2["osys_5"];
                    $osys_6=$array2["osys_6"];
                    $sternenbasis_art=$array2["sternenbasis_art"];
                    if((($osys_1==16) or ($osys_2==16) or ($osys_3==16) or ($osys_4==16) or ($osys_5==16) or ($osys_6==16))and($sternenbasis_art==2)and$erfahrung<5){
                        $fert_akademie=1;
                    }
                    for($j=1;$j<=strlen($fertigkeiten);$j++){
                        if(($j<53) or($j>55)){
                            if(intval(substr($fertigkeiten,$j,1))!=0){
                                $fert_akademie=0;
                            }
                        }
                    }
                    if($fert_akademie==1){
                        if($spezialmission==72 and $fracht_cantox>=100 and $fracht_vorrat>=10 and $fracht_lemin>=50){
                            $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set fracht_cantox=fracht_cantox-100,fracht_vorrat=fracht_vorrat-10,lemin=lemin-50,erfahrung=erfahrung+1,spezialmission=0 where id=$shid and erfahrung<5 and spiel=$spiel");
                            neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['akademie'][2],array($name));
                        }elseif($spezialmission>72 and $spezialmission<77){
                            $spezialmission--;
                            $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set spezialmission=$spezialmission where id=$shid and spiel=$spiel");
                            if($spezialmission>72){
                                neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['akademie'][0],array($name,$spezialmission-71));
                            }else{
                                neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['akademie'][1],array($name));
                            }
                        }
                    }
                }
            }else{
                $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set spezialmission=0 where id=$shid and spiel=$spiel");
                neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['akademie'][3],array($name));
            }
        }
        /////////////////////////////////////////////////////////////////////////////////////////////Akademieausbildung Ende
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////TARNFELD ANFANG
$zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set tarnfeld=1 where spezialmission=8 and spiel=$spiel");
if($module[0]) {
    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set tarnfeld=0 where spezialmission<>8 and !(volk='unknown' and klasseid=1) and spiel=$spiel");
    $zeiger = mysql_query("SELECT * FROM $skrupel_schiffe where tarnfeld=1 and !(volk='unknown' and klasseid=1) and spiel=$spiel order by id");
}else {
    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set tarnfeld=0 where spezialmission<>8 and spiel=$spiel");
    $zeiger = mysql_query("SELECT * FROM $skrupel_schiffe where tarnfeld=1 and spiel=$spiel order by id");
}
$schiffanzahl = mysql_num_rows($zeiger);
if ($schiffanzahl>=1) {
    for ($i=0; $i<$schiffanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $shid=$array["id"];
        $masse=$array["masse"];
        $fracht_min2=$array["fracht_min2"];
        $min2_brauch=round(($masse/100)+0.5);
        if ($min2_brauch<=$fracht_min2) {
            $fracht_min2=$fracht_min2-$min2_brauch;
            $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set fracht_min2=$fracht_min2 where id=$shid");
        } else {
            $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set tarnfeld=0 where id=$shid");
        }
    }
}
$zeiger = mysql_query("SELECT name,volk,besitzer,bild_gross,id,tarnfeld,spiel,antrieb FROM $skrupel_schiffe where tarnfeld=1 and spiel=$spiel and antrieb=7 order by id");
$schiffanzahl = mysql_num_rows($zeiger);
if ($schiffanzahl>=1) {
    for ($i=0; $i<$schiffanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $shid=$array["id"];
        $name=$array["name"];
        $volk=$array["volk"];
        $besitzer=$array["besitzer"];
        $bild_gross=$array["bild_gross"];
        $zuzahl=mt_rand(1,100);
        if ($zuzahl<=19) {
            $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set tarnfeld=0 where id=$shid");
            neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['tarnfeld'][0],array($name));
        }
    }
}
$zeiger = mysql_query("SELECT id,spiel,antrieb,antrieb_anzahl,kox,koy FROM $skrupel_schiffe where spiel=$spiel and antrieb=3 order by id");
$schiffanzahl = mysql_num_rows($zeiger);
if ($schiffanzahl>=1) {
    for ($i=0; $i<$schiffanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $shid=$array["id"];
        $kox=$array["kox"];
        $koy=$array["koy"];
        $antrieb_anzahl=$array["antrieb_anzahl"];
        $zuzahl=mt_rand(1,100);
        if ($zuzahl<=($antrieb_anzahl*2)) {
            neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['drugun'][2],array($name));
            $reichweite=117;
            if($module[0]) {
                $zeiger_temp = mysql_query("SELECT id, besitzer, name, volk, bild_gross FROM $skrupel_schiffe where (sqrt(((kox-$kox)*(kox-$kox))+((koy-$koy)*(koy-$koy)))<=$reichweite) and tarnfeld=1 and antrieb<>2 and spiel=$spiel order by id");
                $treffschiff = mysql_num_rows($zeiger_temp);
                if ($treffschiff>=1) {
                    for ($k=0; $k<$treffschiff;$k++) {
                        $ok2 = mysql_data_seek($zeiger_temp,$k);
                        $array_temp = mysql_fetch_array($zeiger_temp);
                        $t_shid=$array_temp["id"];
                        $t_besitzer=$array_temp["besitzer"];
                        $t_name=$array_temp["name"];
                        $t_volk=$array_temp["volk"];
                        $t_bild_gross=$array_temp["bild_gross"];
                        $zeiger_temp2 = mysql_query("UPDATE $skrupel_schiffe set tarnfeld=0 where id=$t_shid and spiel=$spiel");
                        neuigkeiten(2,"../daten/$t_volk/bilder_schiffe/$t_bild_gross",$t_besitzer,$lang['host'][$spielersprache[$t_besitzer]]['drugun'][0],array($t_name));
                    }
                }
                //spion tarner nur dekrementieren
                $zeiger = mysql_query("SELECT id,tarnfeld, besitzer, name, volk, bild_gross FROM $skrupel_schiffe where (sqrt(((kox-$kox)*(kox-$kox))+((koy-$koy)*(koy-$koy)))<=$reichweite) and volk='unknown' and klasseid=1 and spiel=$spiel");
                $schiffanzahl = mysql_num_rows($zeiger);
                if($schiffanzahl>=1) {
                    for($i=0; $i<$schiffanzahl;$i++) {
                        $ok = mysql_data_seek($zeiger,$i);
                        $array = mysql_fetch_array($zeiger);
                        $t_shid=$array["id"];
                        $t_besitzer=$array_temp["besitzer"];
                        $t_name=$array_temp["name"];
                        $t_volk=$array_temp["volk"];
                        $t_bild_gross=$array_temp["bild_gross"];
                        $tarnfeld=$array["tarnfeld"];
                        $tarnfeld--;
                        if($tarnfeld<=0) {
                            $tarnfeld = 0;
                            neuigkeiten(2,"../daten/$t_volk/bilder_schiffe/$t_bild_gross",$t_besitzer,$lang['host'][$spielersprache[$t_besitzer]]['drugun'][1],array($t_name));
                        }else{
                            neuigkeiten(2,"../daten/$t_volk/bilder_schiffe/$t_bild_gross",$t_besitzer,$lang['host'][$spielersprache[$t_besitzer]]['drugun'][0],array($t_name));
                        }
                        $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set tarnfeld=$tarnfeld where id=$t_shid");
                    }
                }
            }else {
                $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set tarnfeld=0 where (sqrt(((kox-$kox)*(kox-$kox))+((koy-$koy)*(koy-$koy)))<=$reichweite) and spiel=$spiel and tarnfeld=1");
            }
        }
    }
}
$zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set tarnfeld=1 where antrieb=2 and spiel=$spiel");
/////////////////////////////////////////////////////////////////////////////////////////////TARNFELD ENDE
/////////////////////////////////////////////////////////////////////////////////////////////DRUGUNVERZERRER ANFANG
$zeiger = mysql_query("SELECT fracht_leute,id,name,klasse,kox,koy,volk,besitzer,bild_gross,crew,leichtebt,schwerebt,zusatzmodul,spezialmission,status FROM $skrupel_schiffe where spezialmission=30 and zusatzmodul=6 and status=2 and spiel=$spiel order by id");
$schiffanzahl = mysql_num_rows($zeiger);
if ($schiffanzahl>=1) {
    for  ($i=0; $i<$schiffanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $shid=$array["id"];
        $name=$array["name"];
        $klasse=$array["klasse"];
        $kox=$array["kox"];
        $koy=$array["koy"];
        $volk=$array["volk"];
        $besitzer=$array["besitzer"];
        $bild_gross=$array["bild_gross"];
        $crew=$array["crew"];
        $leichtebt=$array["leichtebt"];
        $schwerebt=$array["schwerebt"];
        $zusatzmodul=$array["zusatzmodul"];
        $spezialmission=$array["spezialmission"];
        $status=$array["status"];
        $fracht_leute=$array["fracht_leute"];
        $zufall=rand(1,100);
        if ($zufall<=67) {
            $reichweite=round($masse/2);
            neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['drugun'][5],array($name,$reichweite));
            $zeiger2 = mysql_query("SELECT * FROM $skrupel_planeten where x_pos=$kox and y_pos=$koy and besitzer=$besitzer and spiel=$spiel");
            $planetenanzahl = mysql_num_rows($zeiger2);
            if ($planetenanzahl==1) {
                $array2 = mysql_fetch_array($zeiger2);
                $p_id=$array2["id"];
                $p_kolonisten=$array2["kolonisten"];
                $p_leichtebt=$array2["leichtebt"];
                $p_schwerebt=$array2["schwerebt"];
                $p_kolonisten=$p_kolonisten+$crew+$fracht_leute;
                $p_leichtebt+=$leichtebt;
                $p_schwerebt+=$schwerebt;
                $zeigertemp = mysql_query("UPDATE $skrupel_planeten set kolonisten=$p_kolonisten,leichtebt=$p_leichtebt,schwererbt=$p_schwerebt where x_pos=$kox and y_pos=$koy and besitzer=$besitzer and spiel=$spiel");
                $zeiger_temp = mysql_query("SELECT id,tarnfeld, besitzer, name, volk, bild_gross FROM $skrupel_schiffe where (sqrt(((kox-$kox)*(kox-$kox))+((koy-$koy)*(koy-$koy)))<=$reichweite) and tarnfeld>0 and spiel=$spiel order by id");
                $treffschiff = mysql_num_rows($zeiger_temp);
                if ($treffschiff>=1) {
                    for($i=0; $i<$treffschiff;$i++) {
                        $ok = mysql_data_seek($zeiger,$i);
                        $array = mysql_fetch_array($zeiger);
                        $t_shid=$array["id"];
                        $t_besitzer=$array_temp["besitzer"];
                        $t_name=$array_temp["name"];
                        $t_volk=$array_temp["volk"];
                        $t_bild_gross=$array_temp["bild_gross"];
                        $tarnfeld=$array["tarnfeld"];
                        $tarnfeld--;
                        if($tarnfeld==0){
                            neuigkeiten(2,"../daten/$t_volk/bilder_schiffe/$t_bild_gross",$t_besitzer,$lang['host'][$spielersprache[$t_besitzer]]['drugun'][3],array($t_name));
                        }else{
                            neuigkeiten(2,"../daten/$t_volk/bilder_schiffe/$t_bild_gross",$t_besitzer,$lang['host'][$spielersprache[$t_besitzer]]['drugun'][4],array($t_name));
                        }
                        $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set tarnfeld=$tarnfeld where id=$t_shid");
                    }
                }
            }
            $zeiger_temp = mysql_query("DELETE FROM $skrupel_schiffe where id=$shid");
            $zeiger_temp = mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 's:$shid:%'");
            $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where (flug=3 or flug=4) and zielid=$shid");
        }
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////DRUGUNVERZERRER ENDE
/////////////////////////////////////////////////////////////////////////////////////////////SENSORPHALANX UND LABOR ANFANG
$zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set scanner=0 where spezialmission<>11 and spezialmission<>12 and spiel=$spiel");
$zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set scanner=1 where spezialmission=11 and spiel=$spiel");
$zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set scanner=2 where spezialmission=12 and spiel=$spiel");
/////////////////////////////////////////////////////////////////////////////////////////////SENSORPHALANX UND LABOR ENDE
/////////////////////////////////////////////////////////////////////////////////////////////SPEZIALMISSIONEN ENDE
///////////////////////////////////////////////////////////////////////////////////////////////PLANETEN ANFANG
///////////////////////////////////////////////////////////////////////////////////////////////KOLONISTEN UND TRUPPEN SCHRUMPFEN ANFANG
$zeiger = mysql_query("SELECT id,name,bild,sternenbasis_id,kolonisten,besitzer,spiel,leichtebt,schwerebt,vorrat FROM $skrupel_planeten where besitzer>=1 and kolonisten<1000 and spiel=$spiel order by id");
$planetenanzahl = mysql_num_rows($zeiger);
if ($planetenanzahl>=1) {
    for ($i=0; $i<$planetenanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $pid=$array["id"];
        $name=$array["name"];
        $bild=$array["bild"];
        $sternenbasis_id=$array["sternenbasis_id"];
        $leichtebt=$array["leichtebt"];
        $schwerebt=$array["schwerebt"];
        $vorrat=$array["vorrat"];
        $kolonisten=$array["kolonisten"];
        $kolonisten=$kolonisten-mt_rand(50,200);
        if ($kolonisten<1) {
            $weg=0;
            $bodentruppen=$leichtebt+$schwerebt;
            if (($bodentruppen==0) or (($bodentruppen>=1) and ($vorrat==0))) { $weg=1; } else {
                $notwendig=round($bodentruppen*0.15);
                if ($notwendig<15) { $notwendig=15; }
                if ($notwendig>$vorrat) {
                    $zuwenig=$notwendig-$vorrat;
                    $vorrat=0;
                    $draufgehen=round($zuwenig/0.15);
                    $bodentruppen=$bodentruppen-$draufgehen;
                    if ($bodentruppen<1) { $weg=1; } else {
                        if ($draufgehen<=$schwerebt) {
                            $schwerebt=$schwerebt-$draufgehen;
                        } else {
                            $draufgehen=$draufgehen-$schwerebt;
                            $leichtebt=$leichtebt-$draufgehen;
                        }
                    }
                } else {
                    $vorrat=$vorrat-$notwendig;
                }
            }
            if ($weg==1) {
                $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set leichtebt=0,schwerebt=0,kolonisten=0,besitzer=0,auto_minen=0,auto_fabriken=0,abwehr=0,auto_abwehr=0,auto_vorrat=0,vorrat=0,logbuch='' where id=$pid");
                if ($sternenbasis_id>=1) {
                    $zeiger_temp = mysql_query("UPDATE $skrupel_sternenbasen set besitzer=0 where id=$sternenbasis_id");
                }
            } else {
                $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set vorrat=$vorrat,leichtebt=$leichtebt,schwerebt=$schwerebt where id=$pid");
            }
        } else {
            $zeiger_temp = mysql_query("update $skrupel_planeten set kolonisten=$kolonisten where id=$pid");
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////KOLONISTEN SCHRUMPFEN ENDE
///////////////////////////////////////////////////////////////////////////////////////////////PLANETEN NEU BESETZEN ANFANG
$zeiger = mysql_query("SELECT * FROM $skrupel_planeten where besitzer=0 and (kolonisten_new>0 or leichtebt_new>0 or schwerebt>0) and spiel=$spiel order by id");
$planetenanzahl = mysql_num_rows($zeiger);
if ($planetenanzahl>=1) {
    for ($i=0; $i<$planetenanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $pid=$array["id"];
        $name=$array["name"];
        $bild=$array["bild"];
        $klasse=$array["klasse"];
        $kolonisten=$array["kolonisten"];
        $kolonisten_new=$array["kolonisten_new"];
        $kolonisten_spieler=$array["kolonisten_spieler"];
        $leichtebt_new=$array["leichtebt_new"];
        $schwerebt_new=$array["schwerebt_new"];
        $sternenbasis_id=$array["sternenbasis_id"];
        $zeiger_temp = mysql_query("update $skrupel_planeten set leichtebt=$leichtebt_new,schwerebt=$schwerebt_new,leichtebt_new=0,schwerebt_new=0,besitzer=$kolonisten_spieler,kolonisten=$kolonisten_new,kolonisten_new=0,kolonisten_spieler=0 where id=$pid");
        if ($sternenbasis_id>=1) { $zeiger_temp = mysql_query("UPDATE $skrupel_sternenbasen set besitzer=$kolonisten_spieler where id=$sternenbasis_id;"); }
        if ($kolonisten_new>0) {
            $neuekolonie++;
            neuigkeiten(1,"../bilder/planeten/$klasse"."_"."$bild.jpg",$kolonisten_spieler,$lang['host'][$spielersprache[$kolonisten_spieler]]['besetzen'][0],array($name));
        } else {
            neuigkeiten(1,"../bilder/planeten/$klasse"."_"."$bild.jpg",$kolonisten_spieler,$lang['host'][$spielersprache[$kolonisten_spieler]]['besetzen'][1],array($name));
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////PLANETEN NEU BESETZEN ENDE
///////////////////////////////////////////////////////////////////////////////////////////////GROSSER METEORITEN ANFANG
$meteor=mt_rand(1,200);
if ($meteor==1) {
    $zeiger = mysql_query("SELECT id,spiel,besitzer,name,x_pos,y_pos,sternenbasis FROM $skrupel_planeten where spiel=$spiel and sternenbasis=0 order by rand() limit 0,1");
    $array = mysql_fetch_array($zeiger);
    $pid=$array["id"];
    $name=$array["name"];
    $besitzer=$array["besitzer"];
    $x_pos=$array["x_pos"];
    $y_pos=$array["y_pos"];
    $rohstoff_met=mt_rand(7500,10000);
    $rohstoffe[0]=mt_rand(0,$rohstoff_met);
    $rohstoffe[1]=mt_rand(0,($rohstoff_met-$rohstoffe[0]));
    $rohstoffe[2]=mt_rand(0,($rohstoff_met-$rohstoffe[0]-$rohstoffe[1]));
    $rohstoffe[3]=($rohstoff_met-$rohstoffe[0]-$rohstoffe[1]-$rohstoffe[2]);
    shuffle($rohstoffe);
    $lemin=$rohstoffe[0];
    $min1=$rohstoffe[1];
    $min2=$rohstoffe[2];
    $min3=$rohstoffe[3];
    if ($besitzer>=1) {
        $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set planet_lemin=planet_lemin+$lemin,planet_min1=planet_min1+$min1,planet_min2=planet_min2+$min2,planet_min3=planet_min3+$min3,native_id=0,native_name ='',native_art=0,native_art_name='',native_abgabe=0,native_bild='',native_text='',native_fert='',native_kol=0,kolonisten=0,besitzer=0,minen=0,vorrat=0,cantox=0,auto_minen=0,fabriken=0,auto_fabriken=0,abwehr=0,auto_abwehr=0,auto_vorrat=0,logbuch='' where id=$pid");
        for ($k=1;$k<11;$k++) {
            if (($spieler_id_c[$k]>=1) and ($spieler_raus_c[$k]!=1) and ($besitzer!=$k)) { neuigkeiten(4,"../bilder/news/meteor_gross.jpg",$k,$lang['host'][$spielersprache[$k]]['meteoriten'][0],array($name,$x_pos,$y_pos,$rohstoffe[0],$rohstoffe[2],$rohstoffe[1],$rohstoffe[3])); }
        }
        neuigkeiten(4,"../bilder/news/meteor_gross.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['meteoriten'][1],array($name,$x_pos,$y_pos,$rohstoffe[0],$rohstoffe[2],$rohstoffe[1],$rohstoffe[3]));
    } else {
        $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set planet_lemin=planet_lemin+$lemin,planet_min1=planet_min1+$min1,planet_min2=planet_min2+$min2,planet_min3=planet_min3+$min3,native_id=0,native_name ='',native_art=0,native_art_name='',native_abgabe=0,native_bild='',native_text='',native_fert='',native_kol=0 where id=$pid");
        for ($k=1;$k<11;$k++) {
            if (($spieler_id_c[$k]>=1) and ($spieler_raus_c[$k]!=1)) { neuigkeiten(4,"../bilder/news/meteor_gross.jpg",$k,$lang['host'][$spielersprache[$k]]['meteoriten'][0],array($name,$x_pos,$y_pos,$rohstoffe[0],$rohstoffe[2],$rohstoffe[1],$rohstoffe[3])); }
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////GROSSER METEORITEN ENDE
///////////////////////////////////////////////////////////////////////////////////////////////KLEINE METEORITEN ANFANG
$meteore=mt_rand(0,15);
for ($i=0; $i<$meteore;$i++) {
    $zeiger = mysql_query("SELECT id,spiel,besitzer,name,lemin,min1,min2,min3 FROM $skrupel_planeten where spiel=$spiel order by rand() limit 0,1");
    $array = mysql_fetch_array($zeiger);
    $pid=$array["id"];
    $name=$array["name"];
    $besitzer=$array["besitzer"];
    $lemin=$array["lemin"];
    $min1=$array["min1"];
    $min2=$array["min2"];
    $min3=$array["min3"];
    $rohstoff_met=mt_rand(50,200);
    $rohstoffe[0]=mt_rand(0,$rohstoff_met);
    $rohstoffe[1]=mt_rand(0,($rohstoff_met-$rohstoffe[0]));
    $rohstoffe[2]=mt_rand(0,($rohstoff_met-$rohstoffe[0]-$rohstoffe[1]));
    $rohstoffe[3]=($rohstoff_met-$rohstoffe[0]-$rohstoffe[1]-$rohstoffe[2]);
    shuffle($rohstoffe);
    $lemin=$lemin+$rohstoffe[0];
    $min1=$min1+$rohstoffe[1];
    $min2=$min2+$rohstoffe[2];
    $min3=$min3+$rohstoffe[3];
    $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set lemin=$lemin,min1=$min1,min2=$min2,min3=$min3 where id=$pid");
    if ($besitzer>=1) {
        neuigkeiten(2,"../bilder/news/meteor_klein.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['meteoriten'][2],array($name,$rohstoffe[0],$rohstoffe[2],$rohstoffe[1],$rohstoffe[3]));
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////KLEINE METEORITEN ENDE
///////////////////////////////////////////////////////////////////////////////////////////////PIRATEN ANFANG
if (($piraten_mitte>=1) or ($piraten_aussen>=1)) {
    $zeiger = mysql_query("SELECT zusatzmodul,spiel,id,erfahrung,energetik_anzahl,projektile_anzahl,hanger_anzahl,kox,koy,besitzer,status,name,fracht_cantox,fracht_vorrat,fracht_min1,fracht_min2,fracht_min3,techlevel FROM $skrupel_schiffe where status<>2 and techlevel>3 and energetik_anzahl=0 and projektile_anzahl=0 and hanger_anzahl=0 and spiel=$spiel order by id");
    $schiffanzahl = mysql_num_rows($zeiger);
    if ($schiffanzahl>=1) {
        for ($i=0; $i<$schiffanzahl;$i++) {
            $ok = mysql_data_seek($zeiger,$i);
            $array = mysql_fetch_array($zeiger);
            $shid=$array["id"];
            $kox=$array["kox"];
            $koy=$array["koy"];
            $fracht_min1=$array["fracht_min1"];
            $fracht_min2=$array["fracht_min2"];
            $fracht_min3=$array["fracht_min3"];
            $fracht_cantox=$array["fracht_cantox"];
            $fracht_vorrat=$array["fracht_vorrat"];
            $besitzer=$array["besitzer"];
            $name=$array["name"];
            $erfahrung=$array["erfahrung"];
            $zusatzmodul=$array["zusatzmodul"];
            if (($fracht_min1>=1) or ($fracht_min2>=1) or ($fracht_min3>=1) or ($fracht_cantox>=1) or ($fracht_vorrat>=1)) {
                $abstand=(sqrt(((($umfang/2)-$kox)*(($umfang/2)-$kox))+((($umfang/2)-$koy)*(($umfang/2)-$koy))));
                $wahrscheinlichkeit=0;
                if ($piraten_aussen>$piraten_mitte) {
                    $prozent_abstand=100-($abstand*100/($umfang/2));
                    $differenz=$piraten_aussen-$piraten_mitte;
                    $ein_prozent=$differenz/100;
                    $wahrscheinlichkeit=round(($prozent_abstand*$ein_prozent)+$piraten_mitte);
                }
                if ($piraten_aussen<$piraten_mitte) {
                    $prozent_abstand=$abstand*100/($umfang/2);
                    $differenz=$piraten_mitte-$piraten_aussen;
                    $ein_prozent=$differenz/100;
                    $wahrscheinlichkeit=round(($prozent_abstand*$ein_prozent)+$piraten_aussen);
                }
                if ($piraten_aussen==$piraten_mitte) { $wahrscheinlichkeit=$piraten_aussen; }
                $wahrscheinlichkeit=$wahrscheinlichkeit-($erfahrung*5);
                $tech_stark=0;
                $zeiger2 = mysql_query("SELECT techlevel,spiel,id,energetik_anzahl,projektile_anzahl,hanger_anzahl,kox,koy,besitzer,flug,zielid FROM $skrupel_schiffe where flug=4 and zielid=$shid and kox=$kox and koy=$koy and (energetik_anzahl>=1 or projektile_anzahl>=1 or hanger_anzahl>=1) and spiel=$spiel order by id");
                $schiffanzahl2 = mysql_num_rows($zeiger2);
                if ($schiffanzahl2>=1) {
                    for ($i2=0; $i2<$schiffanzahl;$i2++) {
                        $ok2 = mysql_data_seek($zeiger2,$i2);
                        $array2 = mysql_fetch_array($zeiger2);
                        $techlevel=$array2["techlevel"];
                        if ($techlevel>$tech_stark) {$tech_stark=$techlevel;}
                    }
                }
                if ($tech_stark>=1) {$wahrscheinlichkeit=$wahrscheinlichkeit-($tech_stark*$tech_stark);}
                $zufall=mt_rand(1,100);
                if ($zufall<=$wahrscheinlichkeit) {
                    $prozent_ganz=mt_rand($piraten_min,$piraten_max);
                    if ($erfahrung>=1) {
                        $prozent_ganz=$prozent_ganz-($erfahrung*5);
                    }
                    if ($zusatzmodul==8) { $prozent_ganz=round($prozent_ganz*0.27); }
                    if ($prozent_ganz>=1) {
                        $prozent_ganz=$prozent_ganz*5;
                        $prozente[0]=mt_rand(0,$prozent_ganz);
                        $prozente[1]=mt_rand(0,($prozent_ganz-$prozente[0]));
                        $prozente[2]=mt_rand(0,($prozent_ganz-$prozente[0]-$prozente[1]));
                        $prozente[3]=mt_rand(0,($prozent_ganz-$prozente[0]-$prozente[1]-$prozente[2]));
                        $prozente[4]=($prozent_ganz-$prozente[0]-$prozente[1]-$prozente[2]-$prozente[3]);
                        if ($prozente[0]>round($prozent_ganz/5)) { $prozente[0]=round($prozent_ganz/5); }
                        if ($prozente[1]>round($prozent_ganz/5)) { $prozente[1]=round($prozent_ganz/5); }
                        if ($prozente[2]>round($prozent_ganz/5)) { $prozente[2]=round($prozent_ganz/5); }
                        if ($prozente[3]>round($prozent_ganz/5)) { $prozente[3]=round($prozent_ganz/5); }
                        if ($prozente[4]>round($prozent_ganz/5)) { $prozente[4]=round($prozent_ganz/5); }
                        shuffle($prozente);
                        $fracht_min1_weg=ceil($prozente[0]*$fracht_min1/100);
                        $fracht_min2_weg=ceil($prozente[1]*$fracht_min2/100);
                        $fracht_min3_weg=ceil($prozente[2]*$fracht_min3/100);
                        $fracht_cantox_weg=ceil($prozente[3]*$fracht_cantox/100);
                        $fracht_vorrat_weg=ceil($prozente[4]*$fracht_vorrat/100);
                        if (($fracht_min1_weg>=1) or ($fracht_min2_weg>=1) or ($fracht_min3_weg>=1) or ($fracht_cantox_weg>=1) or ($fracht_vorrat_weg>=1)) {
                            $zeiger = mysql_query("UPDATE $skrupel_schiffe set fracht_min1=fracht_min1-$fracht_min1_weg,fracht_min2=fracht_min2-$fracht_min2_weg,fracht_min3=fracht_min3-$fracht_min3_weg,fracht_cantox=fracht_cantox-$fracht_cantox_weg,fracht_vorrat=fracht_vorrat-$fracht_vorrat_weg where id=$shid");
                            neuigkeiten(1,"../bilder/news/piraten.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['piraten'][0],array($name,$fracht_cantox_weg,$fracht_vorrat_weg,$fracht_min1_weg,$fracht_min2_weg,$fracht_min3_weg));
                        }
                    } else {
                        neuigkeiten(1,"../bilder/news/piraten.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['piraten'][1],array($name));
                    }
                } else {
                    if (($zufall<=$wahrscheinlichkeit+($tech_stark*$tech_stark)) and ($tech_stark>=1)) {
                        neuigkeiten(1,"../bilder/news/piraten.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['piraten'][1],array($name));
                    }
                }
            }
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////PIRATEN ENDE
///////////////////////////////////////////////////////////////////////////////////////////////HANDELSABKOMMEN ANFANG
$bonus=18;
for ($zaehler=1;$zaehler<=10;$zaehler++) {
    if ($spieler_id_c[$zaehler]>=1) {
        $zeiger = mysql_query("SELECT count(*) as total FROM $skrupel_planeten where besitzer=$zaehler and spiel=$spiel");
        $array = mysql_fetch_array($zeiger);
        $spieler_planetenanzahl[$zaehler]=$array["total"];
        $spieler_handelbonus[$zaehler]=100;
    }
}
for ($zaehler=1;$zaehler<=10;$zaehler++) {
    if ($spieler_id_c[$zaehler]>=1) {
        for ($zaehler2=1;$zaehler2<=10;$zaehler2++) {
            if (($spieler_id_c[$zaehler2]>=1) and ($zaehler!=$zaehler2)) {
                if (($beziehung[$zaehler][$zaehler2]['status']==2) && ($spieler_planetenanzahl[$zaehler]>0)) {
                    $spieler_handelbonus[$zaehler]=$spieler_handelbonus[$zaehler]+($spieler_planetenanzahl[$zaehler2]/$spieler_planetenanzahl[$zaehler]*$bonus);
                }
            }
        }
    $spieler_handelbonus[$zaehler]=(round($spieler_handelbonus[$zaehler]))/100;
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////HANDELSABKOMMEN ENDE
///////////////////////////////////////////////////////////////////////////////////////////////PLANETEN START
$zeiger = mysql_query("SELECT * FROM $skrupel_planeten where besitzer>=1 and spiel=$spiel order by id");
$planetenanzahl = mysql_num_rows($zeiger);
if ($planetenanzahl>=1) {
    for ($i=0; $i<$planetenanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $pid=$array["id"];
        $name=$array["name"];
        $x_pos=$array["x_pos"];
        $y_pos=$array["y_pos"];
        $bild=$array["bild"];
        $temp=$array["temp"];
        $klasse=$array["klasse"];
        $minen=$array["minen"];
        $cantox=$array["cantox"];
        $vorrat=$array["vorrat"];
        $fabriken=$array["fabriken"];
        $abwehr=$array["abwehr"];
        $besitzer=$array["besitzer"];
        $leichtebt=$array["leichtebt"];
        $schwerebt=$array["schwerebt"];
        $leichtebt_bau=$array["leichtebt_bau"];
        $schwerebt_bau=$array["schwerebt_bau"];
        $auto_minen=$array["auto_minen"];
        $auto_fabriken=$array["auto_fabriken"];
        $auto_vorrat=$array["auto_vorrat"];
        $auto_abwehr=$array["auto_abwehr"];
        $kolonisten=$array["kolonisten"];
        $lemin=$array["lemin"];
        $min1=$array["min1"];
        $min2=$array["min2"];
        $min3=$array["min3"];
        $artefakt=$array["artefakt"];
        $planet_lemin=$array["planet_lemin"];
        $planet_min1=$array["planet_min1"];
        $planet_min2=$array["planet_min2"];
        $planet_min3=$array["planet_min3"];
        $konz_lemin=$array["konz_lemin"];
        $konz_min1=$array["konz_min1"];
        $konz_min2=$array["konz_min2"];
        $konz_min3=$array["konz_min3"];
        $native_id=$array["native_id"];
        $native_abgabe=$array["native_abgabe"];
        $native_fert=$array["native_fert"];
        $native_kol=$array["native_kol"];
        $native_art=$array["native_art"];
        $osys_anzahl=$array["osys_anzahl"];
        $osys_1=$array["osys_1"];
        $osys_2=$array["osys_2"];
        $osys_3=$array["osys_3"];
        $osys_4=$array["osys_4"];
        $osys_5=$array["osys_5"];
        $osys_6=$array["osys_6"];
        $osys = array();
        $osys[1]=$array["osys_1"];
        $osys[2]=$array["osys_2"];
        $osys[3]=$array["osys_3"];
        $osys[4]=$array["osys_4"];
        $osys[5]=$array["osys_5"];
        $osys[6]=$array["osys_6"];
        $native_fert_minen=intval(substr($native_fert,0,3))/100;
        $native_fert_fabriken=intval(substr($native_fert,3,3))/100;
        $native_fert_wachstum=intval(substr($native_fert,23,3))/100;
        $native_fert_prod_vorrat=intval(substr($native_fert,16,1));
        $native_fert_prod_lemin=intval(substr($native_fert,17,1));
        $native_fert_attacke=intval(substr($native_fert,18,3))/100;
        $native_fert_intens=intval(substr($native_fert,26,1));
        $native_fert_klau=intval(substr($native_fert,27,1));
        $native_fert_angriffswarnung=intval(substr($native_fert,29,1));
        if ($native_fert_intens==1) {
            $konz_lemin=5;
            $konz_min1=5;
            $konz_min2=5;
            $konz_min3=5;
        }
        if ($native_fert_intens==2) {
            $konz_lemin=1;
            $konz_min1=1;
            $konz_min2=1;
            $konz_min3=1;
        }
        if (($native_id>=1) and ($native_kol>1) and ($native_fert_prod_vorrat>0)) {
            $vorrat=$vorrat+round($native_kol/10000*$native_fert_prod_vorrat);
            $zeigertemp = mysql_query("UPDATE $skrupel_planeten set vorrat=$vorrat where id=$pid");
        }
        if (($native_id>=1) and ($native_kol>1) and ($native_fert_prod_lemin>0)) {
            $lemin=$lemin+round($native_kol/10000*$native_fert_prod_lemin);
            $zeigertemp = mysql_query("UPDATE $skrupel_planeten set lemin=$lemin where id=$pid");
        }
        $zufall=mt_rand(1,100);
        if ($zufall<=18) {
            if ($artefakt==1) {
                $zeigertemp = mysql_query("UPDATE $skrupel_planeten set artefakt=0 where id=$pid");
                $zufall2=mt_rand(500,1500);
                $planet_lemin=$planet_lemin+$zufall2;
                $zeigertemp = mysql_query("UPDATE $skrupel_planeten set planet_lemin=$planet_lemin where id=$pid");
                neuigkeiten(1,"../bilder/news/vorkommen_lemin.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['mineralader'],array($name,'Lemin'));
            }
            if ($artefakt==2) {
                $zeigertemp = mysql_query("UPDATE $skrupel_planeten set artefakt=0 where id=$pid");
                $zufall2=mt_rand(500,1500);
                $planet_min1=$planet_min1+$zufall2;
                $zeigertemp = mysql_query("UPDATE $skrupel_planeten set planet_min1=$planet_min1 where id=$pid");
                neuigkeiten(1,"../bilder/news/vorkommen_min1.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['mineralader'],array($name,'Baxterium'));
            }
            if ($artefakt==3) {
                $zeigertemp = mysql_query("UPDATE $skrupel_planeten set artefakt=0 where id=$pid");
                $zufall2=mt_rand(500,1500);
                $planet_min2=$planet_min2+$zufall2;
                $zeigertemp = mysql_query("UPDATE $skrupel_planeten set planet_min2=$planet_min2 where id=$pid");
                neuigkeiten(1,"../bilder/news/vorkommen_min2.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['mineralader'],array($name,'Rennurbin'));
            }
            if ($artefakt==4) {
                $zeigertemp = mysql_query("UPDATE $skrupel_planeten set artefakt=0 where id=$pid");
                $zufall2=mt_rand(500,1500);
                $planet_min3=$planet_min3+$zufall2;
                $zeigertemp = mysql_query("UPDATE $skrupel_planeten set planet_min3=$planet_min3 where id=$pid");
                neuigkeiten(1,"../bilder/news/vorkommen_min3.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['mineralader'],array($name,'Vomisaan'));
            }
        }
        if ($zufall<=33) {
            if (($artefakt==6) and ($osys_anzahl<6)) {
                $zeigertemp = mysql_query("UPDATE $skrupel_planeten set artefakt=0 where id=$pid");
                $osys_anzahl++;
                $osys[$osys_anzahl]=14;
                if ($osys_anzahl==1) { $osys_1==14;$spalte='osys_1'; }
                if ($osys_anzahl==2) { $osys_2==14;$spalte='osys_2'; }
                if ($osys_anzahl==3) { $osys_3==14;$spalte='osys_3'; }
                if ($osys_anzahl==4) { $osys_4==14;$spalte='osys_4'; }
                if ($osys_anzahl==5) { $osys_5==14;$spalte='osys_5'; }
                if ($osys_anzahl==6) { $osys_6==14;$spalte='osys_6'; }
                $zeigertemp = mysql_query("UPDATE $skrupel_planeten set $spalte=14,osys_anzahl=$osys_anzahl where id=$pid");
                neuigkeiten(1,"../bilder/news/wetterstation.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['wetterstation'],array($name));
            }
        }
        if ($zufall<=50) {
            if ($artefakt==5) {
                $zeigertemp = mysql_query("UPDATE $skrupel_planeten set artefakt=0 where id=$pid");
                $zufall2=mt_rand(2000,10000);
                $kolonisten=$kolonisten+$zufall2;
                $zeigertemp = mysql_query("UPDATE $skrupel_planeten set kolonisten=$kolonisten where id=$pid");
                neuigkeiten(1,"../bilder/news/splitterkolonie.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['kolonisten'],array($name,$zufall2));
            }
        }
        if ($vorrat<0) {$vorrat=0;}
        if ($fabriken<0) {$fabriken=0;}
        if ($minen<0) {$minen=0;}
        if ($cantox<0) {$cantox=0;}
        $rasse = $s_eigenschaften[$besitzer]['rasse'];
        // TEMPERATURANPASSUNG DURCH WETTERSTATION
        if (in_array (14, $osys)) {
            if ($temp!=$r_eigenschaften[$rasse]['temperatur']) {
                    if ($r_eigenschaften[$rasse]['temperatur']==0) {
                        if ($klasse==1) { $temp=mt_rand(40,60);
                        }elseif ($klasse==2) { $temp=mt_rand(30,50);
                        }elseif ($klasse==3) { $temp=mt_rand(0,10);
                        }elseif ($klasse==4) { $temp=mt_rand(50,75);
                        }elseif ($klasse==5) { $temp=mt_rand(86,100);
                        }elseif ($klasse==6) { $temp=mt_rand(70,95);
                        }elseif ($klasse==7) { $temp=mt_rand(75,90);
                        }elseif ($klasse==8) { $temp=mt_rand(20,35);
                        }elseif ($klasse==9) { $temp=mt_rand(25,45);}
                    } else {
                        $temp=$r_eigenschaften[$rasse]['temperatur'];
                    }
                $zeigertemp = mysql_query("UPDATE $skrupel_planeten set temp=$temp where id=$pid");
            }
        }
        //BAUEN VON BODENTRUPPEN ANFANG
        if (($leichtebt_bau>=1) or ($schwerebt_bau>=1)) {
            $leichtebt=$leichtebt+$leichtebt_bau;
            $schwerebt=$schwerebt+$schwerebt_bau;
            $zeigertemp = mysql_query("UPDATE $skrupel_planeten set leichtebt=$leichtebt,leichtebt_bau=0,schwerebt=$schwerebt,schwerebt_bau=0 where id=$pid");
        }
        //BAUEN VON BODENTRUPPEN ENDE
        //SCHIFFE IM ORBIT TARNEN ANFANG
        if (($osys_1==5) or ($osys_2==5) or ($osys_3==5) or ($osys_4==5) or ($osys_5==5) or ($osys_6==5)) {
            $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set tarnfeld=1 where status=2 and kox=$x_pos and koy=$y_pos and spiel=$spiel");
        }
        //SCHIFFE IM ORBIT TARNEN ENDE
        //NATIVE ANFANG KAMPF
        if (($native_id>=1) and ($native_kol>1) and ($native_fert_attacke>0)) {
            $native_leute=mt_rand(50,5000);
            if ($native_leute>$native_kol) {
                $native_leute=$native_kol;
            }
            $besitzer_stark=$r_eigenschaften[$rasse]['bodenverteidigung'];
            $verteidiger=($kolonisten+($leichtebt*16)+($schwerebt*60))*$besitzer_stark;
            $angreifer=$native_leute*$native_fert_attacke;
            if ($verteidiger>=$angreifer) {
                $kolonisten=round($kolonisten-($angreifer*$kolonisten/$verteidiger));
                $leichtebt=round($leichtebt-($angreifer*$leichtebt/$verteidiger));
                $schwerebt=round($schwerebt-($angreifer*$schwerebt/$verteidiger));
                $native_kol=$native_kol-$native_leute;
            }
            if ($angreifer>$verteidiger) {
                $native_kol=$native_kol-round($verteidiger/$native_fert_attacke);
                $kolonisten=0;
                $leichtebt=0;
                $schwerebt=0;
            }
            $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set native_kol=$native_kol,kolonisten=$kolonisten,leichtebt=$leichtebt,schwerebt=$schwerebt where id=$pid");
        }
        //NATIVE ENDE KAMPF
        $Bankbonus=1;
        if($osys_1==3 or $osys_2==3 or $osys_3==3 or $osys_4==3 or $osys_5==3 or $osys_6==3){$Bankbonus=1.075;}
        $reservat=0;
        if($osys_1==23 or $osys_2==23 or $osys_3==23 or $osys_4==23 or $osys_5==23 or $osys_6==23){$reservat=10000;}
        //NATIVE ANGRIFFSWARNUNG ANFANG
        if (($native_id>=1) and ($native_kol>1) and ($native_fert_angriffswarnung==1)) {
            $anzahl_angreifer=0;
            $zeiger_temp = mysql_query("SELECT id,besitzer FROM $skrupel_schiffe where flug=2 and zielid=$pid and besitzer!=$besitzer");
            $anzahl_temp = mysql_num_rows($zeiger_temp);
            if ($anzahl_temp>0) {
                for ($zaehler=0; $zaehler<$anzahl_temp; $zaehler++) {
                    $ok = mysql_data_seek($zeiger_temp,$zaehler);
                    $array_temp = mysql_fetch_array($zeiger_temp);
                    $s_besitzer = $array_temp["besitzer"];
                    if ($beziehung[$besitzer][$s_besitzer]['status']<2) {
                        $anzahl_angreifer++;
                    }
                }
            }
            if ($anzahl_angreifer>0) {
                neuigkeiten(1,"../bilder/planeten/$klasse"."_"."$bild.jpg",$besitzer,$lang['host'][$spielersprache[$besitzer]]['angriffswarnung'],array($name));
            }
        }
        //NATIVE ANGRIFFSWARNUNG ENDE
        //NATIVE ANFANG
        if (($native_id>=1) and ($native_kol<1000000)) {
            $schwank=mt_rand(1,2);
            if($reservat and($native_kol>$reservat)){$schwank=1;}
            if ($schwank==1) {
                $native_kol=round($native_kol-($native_kol*0.01745));
                if ($native_kol<0) {$native_kol=0;}
            } else {
                $native_kol=round(($native_kol*0.01745)+$native_kol);
            }
            $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set native_kol=$native_kol where id=$pid");
        }
        if (($native_id>=1) and ($native_kol>1)) {
            $cantox=$cantox+round($native_kol*0.008*$native_abgabe*$Bankbonus);
        }
        //NATIVE ENDE
        //NATIVE ASSIMILIEREN ANFANG
        if (($native_id>=1) and ($native_kol>1) and ($r_eigenschaften[$rasse]['assgrad']>=1) and ($kolonisten>1)) {
            if (($r_eigenschaften[$rasse]['assart']==$native_art) or ($r_eigenschaften[$rasse]['assart']==0)) {
                $ueberlauf=round($kolonisten/100*$r_eigenschaften[$rasse]['assgrad']);
                if ($ueberlauf>=1 and $native_kol>$reservat) {
                    $ueberlauf=min($ueberlauf,$native_kol-$reservat);
                    $kolonisten=$kolonisten+$ueberlauf;
                    $native_kol=$native_kol-$ueberlauf;
                    if ($native_kol==0) {$native_id=0;}
                    $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set kolonisten=$kolonisten,native_id=$native_id,native_kol=$native_kol where id=$pid");
                }
            }
        }
        //NATIVE ASSIMILIEREN ENDE
        //KOLONISTEN ANFANG
        if (($kolonisten>=1000) and ($kolonisten<10000000)) {
            $temp_unterschied=$temp-$r_eigenschaften[$rasse]['temperatur'];
            if ($temp_unterschied<0) { $temp_unterschied=$temp_unterschied*(-1); }
            if ($r_eigenschaften[$rasse]['temperatur']==0) { $temp_unterschied=0; }
            if ($temp_unterschied<=30) {
                $wachstum=(0.1745-($temp_unterschied*0.004886666666666));
                if ($r_eigenschaften[$rasse]['pklasse']==$klasse) { $wachstum=$wachstum*1.20;}
                if($native_id>0 && $native_kol>1 && $native_fert_wachstum>0) { $wachstum *= $native_fert_wachstum; }
                if($osys_1==6 or $osys_2==6 or $osys_3==6 or $osys_4==6 or $osys_5==6 or $osys_6==6){$wachstum=0.1+$wachstum;}
                $kolonisten=round(($kolonisten/10*$wachstum)+$kolonisten);
                $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set kolonisten=$kolonisten where id=$pid");
            }
        }
        $cantox=$cantox+round($kolonisten*0.008*$r_eigenschaften[$rasse]['steuern']*$spieler_handelbonus[$besitzer]*$Bankbonus);
        $zeiger_temp = mysql_query("update $skrupel_planeten set cantox=$cantox where id=$pid");
        //KOLONISTEN ENDE
        //FABRIKEN BAUEN VORRAT ANFANG
        $fabriken_fert_temp=$fabriken;
        if (($native_id>=1) and ($native_kol>1) and ($native_fert_fabriken>0)) {
            $fabriken_fert_temp=round(($fabriken*$native_fert_fabriken));
        }
        if (($osys_1==1) or ($osys_2==1) or ($osys_3==1) or ($osys_4==1) or ($osys_5==1) or ($osys_6==1)) { $fabriken_fert_temp=round($fabriken_fert_temp*1.15); }
        $vorrat_neu=round($fabriken_fert_temp*$r_eigenschaften[$rasse]['fabriken']);
        $vorrat_klau=0;
        if ($native_fert_klau==5) {
            $vorrat_klau=round($vorrat_neu/100*mt_rand(30,80));
        }
        $vorrat=$vorrat+$vorrat_neu-$vorrat_klau;
        $zeiger_temp = mysql_query("update $skrupel_planeten set vorrat=$vorrat where id=$pid");
        //FABRIKEN BAUEN VORRAT ENDE
        //MINEN PRODUZIEREN ANFANG
        if ($minen>0) {
            $mineralgesamt=$planet_lemin+$planet_min1+$planet_min2+$planet_min3;
            $minen_fert_temp=$minen;
            if (($native_id>=1) and ($native_kol>1) and ($native_fert_minen>0)) {
                $minen_fert_temp=round(($minen*$native_fert_minen)+0.5);
            }
            if (($osys_1==2) or ($osys_2==2) or ($osys_3==2) or ($osys_4==2) or ($osys_5==2) or ($osys_6==2)) { $minen_fert_temp=round($minen_fert_temp*1.09); }
            if ($mineralgesamt>=1) {
                //Feld gibt an wieviel Minen je Kt Mineral benoetigt werden.
                $minen_je_kt_mineral=array(10,6,4,2,1);
                //Lemin Anfang
                $minen_lemin=$planet_lemin*$minen_fert_temp*$r_eigenschaften[$rasse]['minen']/$mineralgesamt;
                $lemin_neu=min($planet_lemin,floor($minen_lemin/max($minen_je_kt_mineral[$konz_lemin-1],1)));
                $mineral_klau=0;
                if ($native_fert_klau==1) {
                    $mineral_klau=round($lemin_neu/100*mt_rand(30,80));
                }
                $lemin=$lemin+$lemin_neu-$mineral_klau;
                $planet_lemin=$planet_lemin-$lemin_neu;
                //Lemin Ende
                //Baxterium Anfang
                $minen_min1=$planet_min1*$minen_fert_temp*$r_eigenschaften[$rasse]['minen']/$mineralgesamt;
                $min1_neu=min($planet_min1,floor($minen_min1/max($minen_je_kt_mineral[$konz_min1-1],1)));
                $mineral_klau=0;
                if ($native_fert_klau==2) {
                    $mineral_klau=round($min1_neu/100*mt_rand(30,80));
                }
                $min1=$min1+$min1_neu-$mineral_klau;
                $planet_min1=$planet_min1-$min1_neu;
                //Baxterium Ende
                //Rennurbin Anfang
                $minen_min2=$planet_min2*$minen_fert_temp*$r_eigenschaften[$rasse]['minen']/$mineralgesamt;
                $min2_neu=min($planet_min2,floor($minen_min2/max($minen_je_kt_mineral[$konz_min2-1],1)));
                $mineral_klau=0;
                if ($native_fert_klau==3) {
                    $mineral_klau=round($min2_neu/100*mt_rand(30,80));
                }
                $min2=$min2+$min2_neu-$mineral_klau;
                $planet_min2=$planet_min2-$min2_neu;
                //Rennurbin Ende
                //Vormissan Anfang
                $minen_min3=$planet_min3*$minen_fert_temp*$r_eigenschaften[$rasse]['minen']/$mineralgesamt;
                $min3_neu=min($planet_min3,floor($minen_min3/max($minen_je_kt_mineral[$konz_min3-1],1)));
                $mineral_klau=0;
                if ($native_fert_klau==4) {
                    $mineral_klau=round($min3_neu/100*mt_rand(30,80));
                }
                $min3=$min3+$min3_neu-$mineral_klau;
                $planet_min3=$planet_min3-$min3_neu;
                //Vormissan Ende
                $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set lemin=$lemin,min1=$min1,min2=$min2,min3=$min3,planet_lemin=$planet_lemin,planet_min1=$planet_min1,planet_min2=$planet_min2,planet_min3=$planet_min3 where id=$pid");
            }
        }
        //MINEN PRODUZIEREN ENDE
        $metro_fabriken_plus=0;
        $metro_minen_plus=0;
        if(($osys_1==9) or ($osys_2==9) or ($osys_3==9) or ($osys_4==9) or ($osys_5==9) or ($osys_6==9)){
            $metro_fabriken_plus=12;
            $metro_minen_plus=24;
        }
        //AUTOMATISCHES FABRIKENBAUEN ANFANG
        if ($auto_fabriken==1) {
            $max_cantox=floor($cantox/3);
            $max_vorrat=$vorrat;
            if ($max_cantox<=$max_vorrat) { $max_bau=$max_cantox; }
            if ($max_vorrat<=$max_cantox) { $max_bau=$max_vorrat; }
            if (($kolonisten/100)<=100) { $max_col=floor($kolonisten/100)+$metro_fabriken_plus; } else { $max_col=100+floor(sqrt($kolonisten/100))+$metro_fabriken_plus; }
            $max_fabriken=$fabriken+$max_bau;
            if ($max_fabriken>$max_col) {
                $max_fabriken = $max_col;
                $max_bau = max(0, $max_col-$fabriken);
            }
            if ($max_fabriken>200+$metro_fabriken_plus) {
                $max_fabriken=200+$metro_fabriken_plus;
                $max_bau=200-$fabriken+$metro_fabriken_plus;
            }
            $fabriken=$fabriken+$max_bau;
            $cantox=$cantox-($max_bau*3);
            $vorrat=$vorrat-$max_bau;
            $zeiger_temp = mysql_query("update $skrupel_planeten set fabriken=$fabriken,cantox=$cantox,vorrat=$vorrat where id=$pid");
        }
        //AUTOMATISCHES FABRIKENBAUEN ENDE
        //FABRIKENABBAU ANFANG
        if (($kolonisten/100)<=100) { $max_col=floor($kolonisten/100)+$metro_fabriken_plus; } else { $max_col=100+floor(sqrt($kolonisten/100))+$metro_fabriken_plus; }
        if ($fabriken>$max_col) {
            $prozent=round($fabriken-($fabriken/10));
        if ($prozent>$max_col) { $fabriken=$prozent; } else { $fabriken=$max_col; }
            $zeiger_temp = mysql_query("update $skrupel_planeten set fabriken=$fabriken where id=$pid");
        }
        //FABRIKENABBAU ENDE
        //AUTOMATISCHES MINENBAUEN ANFANG
        if ($auto_minen==1) {
            $max_cantox=floor($cantox/4);
            $max_vorrat=$vorrat;
            if ($max_cantox<=$max_vorrat) { $max_bau=$max_cantox; }
            if ($max_vorrat<=$max_cantox) { $max_bau=$max_vorrat; }
            if (($kolonisten/100)<=200) { $max_col=floor($kolonisten/100)+$metro_minen_plus; } else { $max_col=200+floor(sqrt($kolonisten/100))+$metro_minen_plus; }
            $max_minen=$minen+$max_bau;
            if ($max_minen>$max_col) {
                $max_minen = $max_col;
                $max_bau = max(0, $max_col-$minen);
            }
            if ($max_minen>400+$metro_minen_plus) {
                $max_minen=400+$metro_minen_plus;
                $max_bau=400-$minen+$metro_minen_plus;
            }
            $minen=$minen+$max_bau;
            $cantox=$cantox-($max_bau*4);
            $vorrat=$vorrat-$max_bau;
            $zeiger_temp = mysql_query("update $skrupel_planeten set minen=$minen,cantox=$cantox,vorrat=$vorrat where id=$pid");
        }
        //AUTOMATISCHES MINENBAUEN ENDE
        //MINENABBAU ANFANG
        if (($kolonisten/100)<=200) { $max_col=floor($kolonisten/100)+$metro_minen_plus; } else { $max_col=200+floor(sqrt($kolonisten/100))+$metro_minen_plus; }
        if ($minen>$max_col) {
            $prozent=round($minen-($minen/10));
            if ($prozent>$max_col) { $minen=$prozent; } else { $minen=$max_col; }
            $zeiger_temp = mysql_query("update $skrupel_planeten set minen=$minen where id=$pid");
        }
        //MINENABBAU ENDE
        //AUTOMATISCHES ABWEHRANLAGENBAUEN ANFANG
        if ($auto_abwehr==1) {
            $max_cantox=floor($cantox/10);
            $max_vorrat=$vorrat;
            if ($max_cantox<=$max_vorrat) { $max_bau=$max_cantox; }
            if ($max_vorrat<=$max_cantox) { $max_bau=$max_vorrat; }
            if (($kolonisten/100)<=50) { $max_col=floor($kolonisten/100); } else { $max_col=50+floor(sqrt($kolonisten/100)); }
            if (in_array(11,$osys)) { $max_col=floor($max_col*1.5); }
            $max_abwehr=$abwehr+$max_bau;
            if ($max_abwehr>$max_col) {
                $max_abwehr = $max_col;
                $max_bau = max(0, $max_col-$abwehr);
            }
            if ($max_abwehr>300) {
                $max_abwehr=300;
                $max_bau=300-$abwehr;
            }
            $abwehr=$abwehr+$max_bau;
            $cantox=$cantox-($max_bau*10);
            $vorrat=$vorrat-$max_bau;
            $zeiger_temp = mysql_query("update $skrupel_planeten set abwehr=$abwehr,cantox=$cantox,vorrat=$vorrat where id=$pid");
        }
        //AUTOMATISCHES ABWEHRANLAGENBAUEN ENDE
        //ABWEHRANLAGENABBAU ANFANG
        if (($kolonisten/100)<=50) { $max_col=floor($kolonisten/100); } else { $max_col=50+floor(sqrt($kolonisten/100)); }
        if (in_array(11,$osys)) { $max_col=floor($max_col*1.5); }
        if ($abwehr>$max_col) {
            $prozent=round($abwehr-($abwehr/10));
            if ($prozent>$max_col) { $abwehr=$prozent; } else { $abwehr=$max_col; }
            $zeiger_temp = mysql_query("update $skrupel_planeten set abwehr=$abwehr where id=$pid");
        }
        //ABWEHRANLAGENABBAU ENDE
        //AUTOMATISCHER VORRATVERKAUF ANFANG
        if ($auto_vorrat==1) {
            $cantox=$cantox+$vorrat;
            $vorrat=0;
            $zeiger_temp = mysql_query("update $skrupel_planeten set vorrat=$vorrat,cantox=$cantox where id=$pid");
        }
        //AUTOMATISCHER VORRATVERKAUF ENDE
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////PLANETEN ENDE
///////////////////////////////////////////////////////////////////////////////////////////////ROUTEBEAMEN ANFANG
$zeiger = mysql_query("SELECT * FROM $skrupel_schiffe where status=2 and routing_status=2 and spiel=$spiel order by id");
$schiffanzahl = mysql_num_rows($zeiger);
if ($schiffanzahl>=1) {
    for ($i=0; $i<$schiffanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $shid=$array["id"];
        $besitzer=$array["besitzer"];
        $routing_id=$array["routing_id"];
        $routing_tank=$array["routing_tank"];
        $routing_schritt=$array["routing_schritt"];
        $routing_mins=$array["routing_mins"];
        $routing_rohstoff=(int)$array["routing_rohstoff"];
        $routing_id_temp=explode(":",$routing_id);
        $zid=$routing_id_temp[$routing_schritt];
        $routing_mins_temp=explode(":",$routing_mins);
        $mins=$routing_mins_temp[$routing_schritt];
        $r_option[0]=(int)substr($mins,0,1);
        $r_option[1]=(int)substr($mins,1,1);
        $r_option[2]=(int)substr($mins,3,1);
        $r_option[3]=(int)substr($mins,4,1);
        $r_option[4]=(int)substr($mins,5,1);
        $r_option[5]=(int)substr($mins,7,7);
        $r_option[6]=(int)substr($mins,14,4);
        $r_option[7]=(int)substr($mins,18,4);
        $mins_lemin=substr($mins,2,1);
        $voll_laden=substr($mins,6,1);
        $r_fracht[0]=(int)$array["fracht_cantox"];
        $r_fracht[1]=(int)$array["fracht_vorrat"];
        $r_fracht[2]=(int)$array["fracht_min1"];
        $r_fracht[3]=(int)$array["fracht_min2"];
        $r_fracht[4]=(int)$array["fracht_min3"];
        $r_fracht[5]=(int)$array["fracht_leute"];
        $r_fracht[6]=(int)$array["leichtebt"];
        $r_fracht[7]=(int)$array["schwerebt"];
        $fracht_lemin=$array["lemin"];
        $frachtraum=$array["frachtraum"];
        $leminmax=$array["leminmax"];
        $kox=$array["kox"];
        $koy=$array["koy"];
        $r_faktor[0]=0; //cantox
        $r_faktor[1]=100; //vorrat
        $r_faktor[2]=100; //bax
        $r_faktor[3]=100; //ren
        $r_faktor[4]=100; //vor
        $r_faktor[5]=1; //kol
        $r_faktor[6]=30;  //lbt
        $r_faktor[7]=150; //sbt
        $freiraum=$frachtraum*100;
        $freitank=$leminmax-$fracht_lemin;
        for($zaehler=0;$zaehler<8;$zaehler++){
            $freiraum-=$r_fracht[$zaehler]*$r_faktor[$zaehler];
        }
        $zeiger2 = mysql_query("SELECT * FROM $skrupel_planeten where x_pos=$kox and y_pos=$koy and besitzer=$besitzer and id=$zid and spiel=$spiel");
        $planetenanzahl = mysql_num_rows($zeiger2);
        if ($planetenanzahl==1) {
            $array2 = mysql_fetch_array($zeiger2);
            $p_id=$array2["id"];
            $p_lemin=$array2["lemin"];
            $r_planet[0]=(int)$array2["cantox"];
            $r_planet[1]=(int)$array2["vorrat"];
            $r_planet[2]=(int)$array2["min1"];
            $r_planet[3]=(int)$array2["min2"];
            $r_planet[4]=(int)$array2["min3"];
            $r_planet[5]=(int)$array2["kolonisten"];
            $r_planet[6]=(int)$array2["leichtebt"];
            $r_planet[7]=(int)$array2["schwerebt"];
            //ausladen
            for($zaehler=0;$zaehler<8;$zaehler++){
                if ($r_option[$zaehler]==2) {
                    $r_planet[$zaehler]+=$r_fracht[$zaehler];
                    $freiraum+=$r_fracht[$zaehler]*$r_faktor[$zaehler];
                    $r_fracht[$zaehler]=0;
                }
            }
            //ausladen relativ
            for($zaehler=5;$zaehler<8;$zaehler++){
                if (($r_option[$zaehler]>2)and($r_option[$zaehler]>$r_planet[$zaehler])){
                    $zwischen=min($r_option[$zaehler]-$r_planet[$zaehler],$r_fracht[$zaehler]);
                    $r_planet[$zaehler]+=$zwischen;
                    $r_fracht[$zaehler]-=$zwischen;
                    $freiraum+=$zwischen*$r_faktor[$zaehler];
                }
            }
            //einladen wichtigstes Gut
            if ($r_option[$routing_rohstoff]==1){
                if (($r_planet[$routing_rohstoff]*$r_faktor[$routing_rohstoff])<=$freiraum) {
                    $freiraum=$freiraum-($r_planet[$routing_rohstoff]*$r_faktor[$routing_rohstoff]);
                    $r_fracht[$routing_rohstoff]+=$r_planet[$routing_rohstoff];
                    $r_planet[$routing_rohstoff]=0;
                }else{
                    $r_planet[$routing_rohstoff]=$r_planet[$routing_rohstoff]-(int)floor($freiraum/$r_faktor[$routing_rohstoff]);
                    $r_fracht[$routing_rohstoff]+=(int)floor($freiraum/$r_faktor[$routing_rohstoff]);
                    $freiraum-=(int)floor($freiraum/$r_faktor[$routing_rohstoff])*$r_faktor[$routing_rohstoff];
                }
            }elseif(($r_option[$routing_rohstoff]>2)and($r_option[$routing_rohstoff]<$r_planet[$routing_rohstoff])){
                    $zwischen=min($r_planet[$routing_rohstoff]-$r_option[$routing_rohstoff],(int)floor($freiraum/$r_faktor[$routing_rohstoff]));
                    $r_planet[$routing_rohstoff]-=$zwischen;
                    $r_fracht[$routing_rohstoff]+=$zwischen;
                    $freiraum-=$zwischen*$r_faktor[$routing_rohstoff];
            }
            //einladen relativ
            for($zaehler=5;$zaehler<8;$zaehler++){
                if (($r_option[$zaehler]>2)and($r_option[$zaehler]<$r_planet[$zaehler])){
                    $zwischen=min($r_planet[$zaehler]-$r_option[$zaehler],(int)floor($freiraum/$r_faktor[$zaehler]));
                    $r_planet[$zaehler]-=$zwischen;
                    $r_fracht[$zaehler]+=$zwischen;
                    $freiraum-=$zwischen*$r_faktor[$zaehler];
                }
            }
            //einladen cantox(da sonst divison durch null)
            if ($r_option[0]==1){
                $r_fracht[0]+=$r_planet[0];
                $r_planet[0]=0;
            }
            //einladen(Vorraete zum schluss)
            $ztest=1;
            $zaehler=2;
            while($ztest==1){
                if($zaehler==1){$ztest=0;}
                if ($r_option[$zaehler]==1){
                    if (($r_planet[$zaehler]*$r_faktor[$zaehler])<=$freiraum) {
                        $freiraum=$freiraum-($r_planet[$zaehler]*$r_faktor[$zaehler]);
                        $r_fracht[$zaehler]+=$r_planet[$zaehler];
                        $r_planet[$zaehler]=0;
                    }else{
                        $r_planet[$zaehler]=$r_planet[$zaehler]-(int)floor($freiraum/$r_faktor[$zaehler]);
                        $r_fracht[$zaehler]+=(int)floor($freiraum/$r_faktor[$zaehler]);
                        $freiraum-=(int)floor($freiraum/$r_faktor[$zaehler])*$r_faktor[$zaehler];
                    }
                }
                $zaehler=($zaehler==7)?1:$zaehler+1;
            }
            //rest
            if ($mins_lemin==1) {
                if ($p_lemin<=$freitank) {
                    $freitank=$freitank-$p_lemin;
                    $fracht_lemin=$fracht_lemin+$p_lemin;
                    $p_lemin=0;
                }else{
                    $p_lemin=$p_lemin-$freitank;
                    $fracht_lemin=$fracht_lemin+$freitank;
                    $freitank=0;
                }
            }
            if ($mins_lemin==2) {
                $p_lemin=$p_lemin+$fracht_lemin;
                $fracht_lemin=0;
            }
            if (($fracht_lemin<$routing_tank) and ($p_lemin>0)) {
                $fehlt=$routing_tank-$fracht_lemin;
                if ($fehlt<=$p_lemin) {
                    $p_lemin=$p_lemin-$fehlt;$fracht_lemin=$routing_tank;
                }else{
                    $fracht_lemin=$fracht_lemin+$p_lemin;$p_lemin=0;
                }
            }
            $s_cantox=$r_planet[0];
            $s_vorrat=$r_planet[1];
            $s_bax=$r_planet[2];
            $s_ren=$r_planet[3];
            $s_vor=$r_planet[4];
            $s_kol=$r_planet[5];
            $s_lbt=$r_planet[6];
            $s_sbt=$r_planet[7];
            $zeigertemp = mysql_query("UPDATE $skrupel_planeten set lemin=$p_lemin,cantox=$s_cantox,vorrat=$s_vorrat,min1=$s_bax,min2=$s_ren,min3=$s_vor,kolonisten=$s_kol,leichtebt=$s_lbt,schwerebt=$s_sbt where id=$p_id");
            $s_cantox=$r_fracht[0];
            $s_vorrat=$r_fracht[1];
            $s_bax=$r_fracht[2];
            $s_ren=$r_fracht[3];
            $s_vor=$r_fracht[4];
            $s_kol=$r_fracht[5];
            $s_lbt=$r_fracht[6];
            $s_sbt=$r_fracht[7];
            $zeigertemp = mysql_query("UPDATE $skrupel_schiffe set fracht_leute=$s_kol,leichtebt=$s_lbt,schwerebt=$s_sbt,lemin=$fracht_lemin,fracht_vorrat=$s_vorrat,fracht_cantox=$s_cantox,fracht_min1=$s_bax,fracht_min2=$s_ren,fracht_min3=$s_vor where id=$shid");
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////ROUTEBEAMEN ENDE
///////////////////////////////////////////////////////////////////////////////////////////////TRAKTORSTRAHL UEBERPRUEFEN ANFANG
$zeiger = mysql_query("SELECT id,traktor_id,kox,koy,besitzer,spezialmission,spiel FROM $skrupel_schiffe where spezialmission=21 and spiel=$spiel order by id");
$schiffanzahl = mysql_num_rows($zeiger);
if ($schiffanzahl>=1) {
    for ($i=0; $i<$schiffanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $shid=$array["id"];
        $traktor_id=$array["traktor_id"];
        $kox=$array["kox"];
        $koy=$array["koy"];
        $besitzer=$array["besitzer"];
        $zeiger2 = mysql_query("SELECT id,kox,koy,besitzer,spiel FROM $skrupel_schiffe where id=$traktor_id and kox=$kox and koy=$koy and spiel=$spiel");
        $datensaetze = mysql_num_rows($zeiger2);
        if (!$datensaetze==1) {
            $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set spezialmission=0,traktor_id=0 where id=$shid and spiel=$spiel");
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////TRAKTORSTRAHL UEBERPRUEFEN ENDE
///////////////////////////////////////////////////////////////////////////////////////////////POLITIKENDE ANFANG
$zeiger = mysql_query("DELETE FROM $skrupel_politik where optionen=1 and spiel=$spiel");
$zeiger = mysql_query("UPDATE $skrupel_politik set optionen=optionen-1 where optionen>1 and spiel=$spiel");
///////////////////////////////////////////////////////////////////////////////////////////////POLITIKENDE ENDE
///////////////////////////////////////////////////////////////////////////////////////////////PLASMASTURM VERSCHWINDEN ANFANG
$zeiger = mysql_query("SELECT * FROM $skrupel_anomalien where spiel=$spiel and (art=4 or art=6) order by id");
$datensaetze = mysql_num_rows($zeiger);
if ($datensaetze>=1) {
    for ($i=0; $i<$datensaetze;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $aid=$array["id"];
        $art=$array["art"];
        $plasma_lang=$array["extra"];
        $plasma_lang--;
        if ($plasma_lang>=1) {
            $zeiger_temp = mysql_query("UPDATE $skrupel_anomalien set extra='$plasma_lang' where id=$aid");
        } else {
            if($plasma_lang==0){
                $zeiger_temp = mysql_query("DELETE FROM $skrupel_anomalien where id=$aid");
            }else{}
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////PLASMASTURM VERSCHWINDEN ENDE
///////////////////////////////////////////////////////////////////////////////////////////////PLASMASTURM ENSTEHUNG ANFANG
$zeiger = mysql_query("SELECT count(*) as total FROM $skrupel_anomalien where art=6 and spiel=$spiel");
$array = mysql_fetch_array($zeiger);
$sturm=$array["total"];
$zufall=mt_rand(1,100);
if (($sturm<$plasma_max) and ($zufall<=$plasma_wahr)) {
     $x=mt_rand(1,(($umfang-310)/10));
     $y=mt_rand(1,(($umfang-310)/10));
    for($i=0;$i< 31;$i++){
        for($j=0;$j< 31;$j++){
            $abstand=round(sqrt(((15-$i)*(15-$i))+((15-$j)*(15-$j))));
            $zufall=mt_rand(1,100);
            if($zufall<=(100-($abstand*5))){
                $zeiger2 = mysql_query("SELECT extra from $skrupel_anomalien where x_pos=($x+$i)*10 and y_pos=($y+$j)*10 and art=4 and spiel=$spiel");
                $reihen = mysql_num_rows($zeiger2);
                if($reihen>=1){
                    $array2=mysql_fetch_array($zeiger2);
                    $zeit=$array["extra"];
                    if($zeit==-1){
                    }else{
                        $runden=mt_rand(3,$plasma_lang);
                        $plasma_lang_max=max($runden,$plasma_lang_max);
                        $runden=max(3,$runden,$zeit);
                        $zeiger_temp = mysql_query("INSERT INTO $skrupel_anomalien (art,x_pos,y_pos,extra,spiel) values (4,($x+$i)*10,($y+$j)*10,'$runden',$spiel)");
                    }
                }else{
                    $runden=mt_rand(3,$plasma_lang);
                    $plasma_lang_max=max($runden,$plasma_lang_max);
                    $zeiger_temp = mysql_query("INSERT INTO $skrupel_anomalien (art,x_pos,y_pos,extra,spiel) values (4,($x+$i)*10,($y+$j)*10,'$runden',$spiel)");
                }
            }
        }
    }
    $zeiger_temp = mysql_query("INSERT INTO $skrupel_anomalien (art,extra,spiel) values (6,'$plasma_lang_max',$spiel)");
}
///////////////////////////////////////////////////////////////////////////////////////////////PLASMASTURM ENSTEHUNG ENDE
///////////////////////////////////////////////////////////////////////////////////////////////NEBELSEKTOREN ANFANG
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
include(INCLUDEDIR.'inc.host_nebel.php');
///////////////////////////////////////////////////////////////////////////////////////////////NEBELSEKTOREN ENDE
///////////////////////////////////////////////////////////////////////////////////////////////TARNER VERFOLGEN ANFANG
$zeiger = mysql_query("SELECT besitzer,zielid,id FROM $skrupel_schiffe where flug=3 and spiel=$spiel order by id");
$schiffanzahl = mysql_num_rows($zeiger);
if ($schiffanzahl>=1) {
    for ($i=0; $i<$schiffanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $ssid=$array["id"];
        $besitzer=$array["besitzer"];
        $zielid=$array["zielid"];
        $spalte='sicht_'.$besitzer.'_beta';
        $zeiger2 = mysql_query("SELECT id FROM $skrupel_schiffe where id=$zielid and tarnfeld>=1 and $spalte=0");
        $zielanzahl = mysql_num_rows($zeiger2);
        if ($zielanzahl==1) {
            $zeigertemp = mysql_query("update $skrupel_schiffe set flug=0,zielx=0,ziely=0,zielid=0 where id=$ssid");
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////TARNER VERFOLGEN ENDE
///////////////////////////////////////////////////////////////////////////////////////////////MINEN SICHTBAR ANFANG
if ($module[2]) {
    $zeiger_temp = mysql_query("UPDATE $skrupel_anomalien set sicht='0000000000' where (art=5) and spiel=$spiel");
    $zeiger = mysql_query("SELECT * FROM $skrupel_anomalien where spiel=$spiel and art=5 order by id");
    $datensaetze = mysql_num_rows($zeiger);
    if ($datensaetze>=1) {
        for ($i=0; $i<$datensaetze;$i++) {
            $ok = mysql_data_seek($zeiger,$i);
            $array = mysql_fetch_array($zeiger);
            $aid=$array["id"];
            $kox=$array["x_pos"];
            $koy=$array["y_pos"];
            $extra=$array["extra"];
            $extrab=explode(":",$extra);
            $sicht='0000000000';
            for ($xn=1;$xn<=10;$xn++) {
                if ($spieler_id_c[$xn]>=1) {
                    $ja[$xn]=0;
                    if ($extrab[0]==$xn) { $ja[$xn]=1; }
                    if (($beziehung[$xn][$extrab[0]]['status']==4) or ($beziehung[$xn][$extrab[0]]['status']==5)) { $ja[$xn]=1; }
                }
            }
            /////////////////////
             $reichweite=161;
            $zeiger_temp = mysql_query("SELECT kox,koy,id,scanner,spiel,besitzer FROM $skrupel_schiffe where besitzer!=$extrab[0] and (sqrt(((kox-$kox)*(kox-$kox))+((koy-$koy)*(koy-$koy)))<=$reichweite) and spiel=$spiel order by id");
            $scanschiff = mysql_num_rows($zeiger_temp);
            if ($scanschiff>=1) {
                for ($k=0; $k<$scanschiff;$k++) {
                    $ok2 = mysql_data_seek($zeiger_temp,$k);
                    $array_temp = mysql_fetch_array($zeiger_temp);
                    $t_shid=$array_temp["id"];
                    $t_scanner=$array_temp["scanner"];
                    $t_zielx=$array_temp["kox"];
                    $t_ziely=$array_temp["koy"];
                    $t_besitzer=$array_temp["besitzer"];
                    $lichtjahre=sqrt(($kox-$t_zielx)*($kox-$t_zielx)+($koy-$t_ziely)*($koy-$t_ziely));
                    if ((($lichtjahre<=93) and (t_scanner==0)) or (($lichtjahre<=130) and (t_scanner==1)) or (($lichtjahre<=161) and (t_scanner==2))) {
                        $ja[$t_besitzer]=1;
                        for ($xn=1;$xn<=10;$xn++) {
                            if ($spieler_id_c[$xn]>=1) {
                                if (($beziehung[$xn][$t_besitzer]['status']==4) or ($beziehung[$xn][$t_besitzer]['status']==5)) { $ja[$xn]=1; }
                            }
                        }
                    }
                }
            }
            ////////////////
            for ($xn=1;$xn<=10;$xn++) {
                if ($spieler_id_c[$xn]>=1) {
                    if ($ja[$xn]==1) { $sicht=sichtaddieren($sicht,$besitzer_recht[$xn]); }
                }
            }
            $zeiger_temp = mysql_query("UPDATE $skrupel_anomalien set sicht='$sicht' where id=$aid and spiel=$spiel");
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////MINEN SICHTBAR ENDE
///////////////////////////////////////////////////////////////////////////////////////////////RANGLISTE ANFANG
for ($m=1;$m<11;$m++) {
    $spieler_basen_c[$m]=0;
    $spieler_planeten_c[$m]=0;
    $spieler_schiffe_c[$m]=0;
    $spieler_basen_c_wert[$m]=0;
    $spieler_planeten_c_wert[$m]=0;
    $spieler_schiffe_c_wert[$m]=0;
    $spieler_raus_c_old[$m]=$spieler_raus_c[$m];
    $spieler_raus_c[$m]=1;
    if ($spieler_id_c[$m]==0) { $spieler_raus_c[$m]=0; }
    $heimatplaneten[$m]=0;
}
$zeiger = mysql_query("SELECT id,besitzer,spiel,heimatplanet FROM $skrupel_planeten where spiel=$spiel and besitzer>=1 order by id");
$planetenanzahl = mysql_num_rows($zeiger);
if ($planetenanzahl>=1) {
    for ($i=0; $i<$planetenanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $besitzer=$array["besitzer"];
        $heimatplanet=$array["heimatplanet"];
        if (($heimatplanet>=1) and ($besitzer==$heimatplanet)) { $heimatplaneten[$heimatplanet]=1;}
        $spieler_planeten_c[$besitzer]=$spieler_planeten_c[$besitzer]+5;
    }
}
$zeiger = mysql_query("SELECT id,besitzer,spiel FROM $skrupel_sternenbasen where spiel=$spiel and besitzer>=1 order by id");
$planetenanzahl = mysql_num_rows($zeiger);
if ($planetenanzahl>=1) {
    for ($i=0; $i<$planetenanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $besitzer=$array["besitzer"];
        $spieler_basen_c[$besitzer]=$spieler_basen_c[$besitzer]+10;
    }
}
$zeiger = mysql_query("SELECT id,besitzer,techlevel,spiel FROM $skrupel_schiffe where spiel=$spiel and besitzer>=1 order by id");
$planetenanzahl = mysql_num_rows($zeiger);
if ($planetenanzahl>=1) {
    for ($i=0; $i<$planetenanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $besitzer=$array["besitzer"];
        $techlevel=$array["techlevel"];
        $spieler_schiffe_c[$besitzer]=$spieler_schiffe_c[$besitzer]+$techlevel;
    }
}
for ($m=1;$m<11;$m++) {
    $spieler_schiffe_platz_c[$m]=platz_schiffe($spieler_schiffe_c[$m]);
}
for ($m=1;$m<11;$m++) {
    $spieler_schiffe_c_wert[$m]=$spieler_schiffe_c[$m];
    $spieler_schiffe_c[$m]=$spieler_schiffe_platz_c[$m];
    $spieler_basen_platz_c[$m]=platz_basen($spieler_basen_c[$m]);
}
for ($m=1;$m<11;$m++) {
    $spieler_basen_c_wert[$m]=$spieler_basen_c[$m];
    $spieler_basen_c[$m]=$spieler_basen_platz_c[$m];
    $spieler_planeten_platz_c[$m]=platz_planeten($spieler_planeten_c[$m]);
}
for ($m=1;$m<11;$m++) {
    $spieler_planeten_c_wert[$m]=$spieler_planeten_c[$m];
    $spieler_planeten_c[$m]=$spieler_planeten_platz_c[$m];
    $spieler_gesamt_c[$m]=$spieler_schiffe_c[$m]+$spieler_basen_c[$m]+$spieler_planeten_c[$m];
}
for ($m=1;$m<11;$m++) {
    $spieler_platz_c[$m]=platz($spieler_gesamt_c[$m]);
}
for ($m=1;$m<11;$m++) {
    if ($spiel_out==0) {
        if (($spieler_planeten_c_wert[$m]>=1) or ($spieler_schiffe_c_wert[$m]>=1)) {
            $spieler_raus_c[$m]=0;
        }
    }
    if ($spiel_out==1) {
        if ($spieler_planeten_c_wert[$m]>=1) {
            $spieler_raus_c[$m]=0;
        }
    }
    if ($spiel_out==2) {
        if ($spieler_basen_c_wert[$m]>=1) {
            $spieler_raus_c[$m]=0;
        }
    }
    if ($spiel_out==3) {
        if ($heimatplaneten[$m]==1) {
            $spieler_raus_c[$m]=0;
        }
    }
}
$spieleranzahl=0;
for ($m=1;$m<11;$m++) {
    if (($spieler_id_c[$m]>=1) and ($spieler_raus_c[$m]==0)) { $spieleranzahl++; }
}
for ($m=1;$m<11;$m++) {
    if (($spieler_raus_c[$m]==1) and ($spieler_raus_c_old[$m]==0)) {
        $zeiger = mysql_query("SELECT besitzer,id,spiel FROM $skrupel_sternenbasen where besitzer=$m and spiel=$spiel order by id");
        $basenanzahl = mysql_num_rows($zeiger);
        if ($basenanzahl>=1) {
            for ($i=0; $i<$basenanzahl;$i++) {
                $ok = mysql_data_seek($zeiger,$i);
                $array = mysql_fetch_array($zeiger);
                $baid=$array["id"];
                $zeiger_temp = mysql_query("DELETE FROM $skrupel_huellen where baid=$baid;");
            }
        }
        $zeiger = mysql_query("UPDATE $skrupel_sternenbasen set besitzer=0 where besitzer=$m and spiel=$spiel");
        $zeiger = mysql_query("SELECT * FROM $skrupel_schiffe where besitzer=$m and spiel=$spiel");
        $schiffanzahl = mysql_num_rows($zeiger);
        if ($schiffanzahl>=1) {
            for ($i=0; $i<$schiffanzahl;$i++) {
                $ok = mysql_data_seek($zeiger,$i);
                $array = mysql_fetch_array($zeiger);
                $shid=$array["id"];
                $zeiger_temp = mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 's:$shid:%'");
                $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where flug=3 and zielid=$shid");
            }
        }
        $zeiger = mysql_query("DELETE FROM $skrupel_schiffe where besitzer=$m and spiel=$spiel");
        $zeiger = mysql_query("DELETE FROM $skrupel_politik where spiel=$spiel and (partei_a=$m or partei_b=$m)");
        $zeiger = mysql_query("UPDATE $skrupel_planeten set kolonisten=0,besitzer=0, auto_minen=0,auto_fabriken=0,abwehr=0,auto_abwehr=0,auto_vorrat=0,logbuch='' where besitzer=$m and spiel=$spiel");
        $zeiger = mysql_query("UPDATE $skrupel_planeten set kolonisten_new=0, schwerebt_new=0, leichtebt_new=0,kolonisten_spieler=0 where kolonisten_spieler=$m and spiel=$spiel");
        $zeiger = mysql_query("DELETE FROM $skrupel_neuigkeiten where spieler_id=$m and spiel_id=$spiel");
    }
}
$zeiger_temp = mysql_query("UPDATE $skrupel_spiele set spieleranzahl=$spieleranzahl,spieler_1_raus=$spieler_raus_c[1],spieler_2_raus=$spieler_raus_c[2],spieler_3_raus=$spieler_raus_c[3],spieler_4_raus=$spieler_raus_c[4],spieler_5_raus=$spieler_raus_c[5],spieler_6_raus=$spieler_raus_c[6],spieler_7_raus=$spieler_raus_c[7],spieler_8_raus=$spieler_raus_c[8],spieler_9_raus=$spieler_raus_c[9],spieler_10_raus=$spieler_raus_c[10],spieler_1_basen=$spieler_basen_c[1],spieler_1_planeten=$spieler_planeten_c[1],spieler_1_schiffe=$spieler_schiffe_c[1],spieler_2_basen=$spieler_basen_c[2],spieler_2_planeten=$spieler_planeten_c[2],spieler_2_schiffe=$spieler_schiffe_c[2],spieler_3_basen=$spieler_basen_c[3],spieler_3_planeten=$spieler_planeten_c[3],spieler_3_schiffe=$spieler_schiffe_c[3],spieler_4_basen=$spieler_basen_c[4],spieler_4_planeten=$spieler_planeten_c[4],spieler_4_schiffe=$spieler_schiffe_c[4],spieler_5_basen=$spieler_basen_c[5],spieler_5_planeten=$spieler_planeten_c[5],spieler_5_schiffe=$spieler_schiffe_c[5],spieler_6_basen=$spieler_basen_c[6],spieler_6_planeten=$spieler_planeten_c[6],spieler_6_schiffe=$spieler_schiffe_c[6],spieler_7_basen=$spieler_basen_c[7],spieler_7_planeten=$spieler_planeten_c[7],spieler_7_schiffe=$spieler_schiffe_c[7],spieler_8_basen=$spieler_basen_c[8],spieler_8_planeten=$spieler_planeten_c[8],spieler_8_schiffe=$spieler_schiffe_c[8],spieler_9_basen=$spieler_basen_c[9],spieler_9_planeten=$spieler_planeten_c[9],spieler_9_schiffe=$spieler_schiffe_c[9],spieler_10_basen=$spieler_basen_c[10],spieler_10_planeten=$spieler_planeten_c[10],spieler_10_schiffe=$spieler_schiffe_c[10],spieler_1_platz=$spieler_platz_c[1],spieler_2_platz=$spieler_platz_c[2],spieler_3_platz=$spieler_platz_c[3],spieler_4_platz=$spieler_platz_c[4],spieler_5_platz=$spieler_platz_c[5],spieler_6_platz=$spieler_platz_c[6],spieler_7_platz=$spieler_platz_c[7],spieler_8_platz=$spieler_platz_c[8],spieler_9_platz=$spieler_platz_c[9],spieler_10_platz=$spieler_platz_c[10] where id=$spiel");
///////////////////////////////////////////////////////////////////////////////////////////////RANGLISTE ENDE
///////////////////////////////////////////////////////////////////////////////////////////////HASH ANFANG
for ($m=1;$m<11;$m++) {
    $hash=zufallstring();
    $zeiger_temp = mysql_query("UPDATE $skrupel_spiele set spieler_".$m."_hash = '$hash' where id=$spiel");
    $spieler_hash[$m]=$hash;
}
///////////////////////////////////////////////////////////////////////////////////////////////HASH ENDE
///////////////////////////////////////////////////////////////////////////////////////////////LETZTER MONAT ENDE
if ($neuekolonie==0) {$neuekolonie=$lang['host'][$language]['letztermonat'][0];}
if ($neuekolonie==1) {$neuekolonie=$lang['host'][$language]['letztermonat'][1];}
if ($neuekolonie>=2) {$neuekolonie=str_replace(array('{1}'),array($neuekolonie),$lang['host'][$language]['letztermonat'][2]);}
if ($neueschiffe==0) {$neueschiffe=$lang['host'][$language]['letztermonat'][3];}
if ($neueschiffe==1) {$neueschiffe=$lang['host'][$language]['letztermonat'][4];}
if ($neueschiffe>=2) {$neueschiffe=str_replace(array('{1}'),array($neueschiffe),$lang['host'][$language]['letztermonat'][5]);}
if ($neuebasen==0) {$neuebasen=$lang['host'][$language]['letztermonat'][6];}
if ($neuebasen==1) {$neuebasen=$lang['host'][$language]['letztermonat'][7];}
if ($neuebasen>=2) {$neuebasen=str_replace(array('{1}'),array($neuebasen),$lang['host'][$language]['letztermonat'][8]);}
if ($schiffevernichtet==0) {$schiffevernichtet=$lang['host'][$language]['letztermonat'][9];}
if ($schiffevernichtet==1) {$schiffevernichtet=$lang['host'][$language]['letztermonat'][10];}
if ($schiffevernichtet>=2) {$schiffevernichtet=str_replace(array('{1}'),array($schiffevernichtet),$lang['host'][$language]['letztermonat'][11]);}
if ($planetenerobert==0) {$planetenerobert=$lang['host'][$language]['letztermonat'][12];}
if ($planetenerobert==1) {$planetenerobert=$lang['host'][$language]['letztermonat'][13];}
if ($planetenerobert>=2) {$planetenerobert=str_replace(array('{1}'),array($planetenerobert),$lang['host'][$language]['letztermonat'][14]);}
if ($planetenerobertfehl==0) {$planetenerobertfehl="";}
if ($planetenerobertfehl==1) {$planetenerobertfehl=$lang['host'][$language]['letztermonat'][15];}
if ($planetenerobertfehl>=2) {$planetenerobertfehl=str_replace(array('{1}'),array($planetenerobertfehl),$lang['host'][$language]['letztermonat'][16]);}
if ($schiffverschollen==0) {$schiffverschollen=$lang['host'][$language]['letztermonat'][21];}
if ($schiffverschollen==1) {$schiffverschollen=$lang['host'][$language]['letztermonat'][22];}
if ($schiffverschollen>=2) {$schiffverschollen=str_replace(array('{1}'),array($schiffverschollen),$lang['host'][$language]['letztermonat'][23]);}
$letztermonat=str_replace(array('{1}','{2}','{3}','{4}','{5}','{6}','{7}'),array($neuekolonie,$neueschiffe,$neuebasen,$schiffevernichtet,$planetenerobert,$planetenerobertfehl,$schiffverschollen),$lang['host'][$language]['letztermonat'][17]);
$zeiger_temp = mysql_query("UPDATE $skrupel_spiele set letztermonat='$letztermonat', runde=runde+1 where id=$spiel;");
///////////////////////////////////////////////////////////////////////////////////////////////ZIEL ANFANG
$endejetzt=0;
if ($ziel_id==1) {
    if ($spieleranzahl<=intval($ziel_info)) {
        $endejetzt=1;
    }
}
if ($ziel_id==2) {
    if (($spieler_raus_c[1]==1) or ($spieler_raus_c[5]==1) or ($spieler_raus_c[8]==1) or ($spieler_raus_c[2]==1) or ($spieler_raus_c[6]==1) or ($spieler_raus_c[9]==1) or ($spieler_raus_c[3]==1) or ($spieler_raus_c[7]==1) or ($spieler_raus_c[10]==1) or ($spieler_raus_c[4]==1)) {
        $endejetzt=1;
    }
}
if ($ziel_id==5) {
    for ($k=1;$k<11;$k++) {
        $spieler_ziel_t_c[$k]=0;
    }
    $zeiger = mysql_query("SELECT status,spiel,id,besitzer,fracht_min3 FROM $skrupel_schiffe where status<>2 and spiel=$spiel order by id");
    $schiffanzahl = mysql_num_rows($zeiger);
    if ($schiffanzahl>=1) {
        for ($i=0; $i<$schiffanzahl;$i++) {
            $ok = mysql_data_seek($zeiger,$i);
            $array = mysql_fetch_array($zeiger);
            $besitzer=$array["besitzer"];
            $fracht_min3=$array["fracht_min3"];
            if ($fracht_min3>=1) { $spieler_ziel_t_c[$besitzer]=$spieler_ziel_t_c[$besitzer]+$fracht_min3; }
        }
    }
    $zeiger_temp = mysql_query("UPDATE $skrupel_spiele set spieler_1_ziel='$spieler_ziel_t_c[1]',spieler_2_ziel='$spieler_ziel_t_c[2]',spieler_3_ziel='$spieler_ziel_t_c[3]',spieler_4_ziel='$spieler_ziel_t_c[4]',spieler_5_ziel='$spieler_ziel_t_c[5]',spieler_6_ziel='$spieler_ziel_t_c[6]',spieler_7_ziel='$spieler_ziel_t_c[7]',spieler_8_ziel='$spieler_ziel_t_c[8]',spieler_9_ziel='$spieler_ziel_t_c[9]',spieler_10_ziel='$spieler_ziel_t_c[10]' where id=$spiel;");
    $temp=intval($ziel_info);
    if (($spieler_ziel_t_c[1]>=$temp) or ($spieler_ziel_t_c[2]>=$temp) or ($spieler_ziel_t_c[3]>=$temp) or ($spieler_ziel_t_c[4]>=$temp) or ($spieler_ziel_t_c[5]>=$temp) or ($spieler_ziel_t_c[6]>=$temp) or ($spieler_ziel_t_c[7]>=$temp) or ($spieler_ziel_t_c[8]>=$temp) or ($spieler_ziel_t_c[9]>=$temp) or ($spieler_ziel_t_c[10]>=$temp)) {
        $endejetzt=1;
    }
}
if ($ziel_id==6) {
    if (($spieler_raus_c[1]==1) or ($spieler_raus_c[5]==1) or ($spieler_raus_c[8]==1) or ($spieler_raus_c[2]==1) or ($spieler_raus_c[6]==1) or ($spieler_raus_c[9]==1) or ($spieler_raus_c[3]==1) or ($spieler_raus_c[7]==1) or ($spieler_raus_c[10]==1) or ($spieler_raus_c[4]==1)) {
        $endejetzt=1;
    }
}
if ($endejetzt==1) {
    include(INCLUDEDIR.'inc.host_spielende.php');
}
///////////////////////////////////////////////////////////////////////////////////////////////ZIEL ENDE
///////////////////////////////////////////////////////////////////////////////////////////////STATS AUSWERTUNG ANFANG
for ($m=1;$m<11;$m++) {
    if ($spieler_id_c[$m]>=1) {$zeiger = mysql_query("UPDATE $skrupel_user set stat_sieg=stat_sieg+$stat_sieg[$m],stat_schlacht=stat_schlacht+$stat_schlacht[$m],stat_schlacht_sieg=stat_schlacht_sieg+$stat_schlacht_sieg[$m],stat_kol_erobert=stat_kol_erobert+$stat_kol_erobert[$m],stat_lichtjahre=stat_lichtjahre+$stat_lichtjahre[$m],stat_monate=stat_monate+1 where id=$spieler_id_c[$m]"); }
}
if ((@file_exists($xstats_verzeichnis)) and (intval(substr($spiel_extend,2,1))==1)) {
    xstats_collectAndStore( $sid, &$stat_schlacht,&$stat_schlacht_sieg,&$stat_kol_erobert,&$stat_lichtjahre);
}
///////////////////////////////////////////////////////////////////////////////////////////////STATS AUSWERTUNG ENDE
/////////////////////////////////////////////////////////////////////////////////////////////// BENACHRICHTIGUNG ANFANG
for ($k=1; $k<=10; $k++) {
    if ($spieler_id_c[$k]>0 and $spieler_raus_c[$k]==0) {
        $nachrichtemail=str_replace('{1}',$spiel_name,$lang['host'][$spielersprache[$k]]['letztermonat'][18]);
        $nachrichticq=str_replace('{1}',$spiel_name,$lang['host'][$spielersprache[$k]]['letztermonat'][24]);
        $emailtopic=str_replace(array('{1}'),array($spiel_name),$lang['host'][$spielersprache[$k]]['letztermonat'][20]);
        $zeiger = mysql_query("SELECT * FROM $skrupel_user WHERE id={$spieler_id_c[$k]}");
        $array = mysql_fetch_array($zeiger);
        $emailadresse=$array['email'];
        $icqnummer=$array['icq'];
        $optionen=$array['optionen'];
        $emailicq=$icqnummer."@pager.icq.com";
        $url="http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'];
        $url=substr($url,0,strlen($url)-19);
        $url="http://".$_SERVER['SERVER_NAME'];
        $folders = explode('/', $_SERVER['SCRIPT_NAME']);
        $count = 0;
        $url .= '/';
        foreach ($folders as $value) {
            if ((0 < $count) and (count($folders) > $count+1) and ('inhalt' != $value)){
                $url .= $value . '/';
            }
            $count++;
        }        
        $hash=$spieler_hash[$k];
        $nachricht_fertig = $nachrichtemail."\n\n".$url.'index.php?hash='.$hash;
        if (substr($optionen,0,1)=='1') {
        @mail($emailadresse,$emailtopic, $nachricht_fertig,
            "From: $absenderemail\r\n"
            ."Reply-To: $absenderemail\r\n"
            ."X-Mailer: PHP/" . phpversion());
        }
        /*
        if (substr($optionen,1,1)=='1') {
            $header="From $absenderemail\nReply-To:$absenderemail\n";
            @mail($emailicq,$emailtopic,"$nachrichticq",$header);
        }
        */
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////// BENACHRICHTIGUNG ENDE
///////////////////////////////////////////////////////////////////////////////////////////////LETZTER MONAT ENDE
$nachricht=str_replace('{1}',$spiel_name,$lang['host'][$language]['letztermonat'][19]);
$aktuell=time();
$zeiger = mysql_query("INSERT INTO $skrupel_chat (spiel,datum,text,an,von,farbe) values ($spiel,'$aktuell','$nachricht',0,'System','000000');");
///////////////////////////////////////////////////////////////////////////////////////////////MOVIEGIF OPTIONAL ANFANG
$moviegif_verzeichnis = $main_verzeichnis.'extend/moviegif';
if ((@file_exists($moviegif_verzeichnis)) and (intval(substr($spiel_extend,0,1))==1)) {
    include($moviegif_verzeichnis.'/shot.php');
}
///////////////////////////////////////////////////////////////////////////////////////////////MOVIEGIF OPTIONAL END
