<?php
if($module[0]) {
    if(count($sprachen) == 0) {
        include(LANGUAGEDIR.$language.'/lang.inc.host_spionage.php');
        include(LANGUAGEDIR.$language.'/lang.spionagen.php');

        foreach($lang['spionagen'] as $key => $val) {
            $spionage_daten[$key][$language]['name'] = $lang['spionagen'][$key]['name'];
        }
    } else {
        foreach($sprachen as $sprache) {
            include(LANGUAGEDIR.$sprache.'/lang.inc.host_spionage.php');
            include(LANGUAGEDIR.$sprache.'/lang.spionagen.php');

            foreach($lang['spionagen'] as $key => $val) {
                $spionage_daten[$key][$sprache]['name'] = $lang['spionagen'][$key]['name'];
            }
        }
    }

    //INIT
    $zeiger_spione = mysql_query("SELECT id,name,besitzer,erfahrung,extra,s_x,s_y,strecke FROM $skrupel_schiffe where volk='unknown' and klasseid=1 and spiel=$spiel");
    while($spion = mysql_fetch_array($zeiger_spione)) {
        $extra = explode(":", $spion['extra']);
        $extra_spio = explode("-", $extra[0]);
        $s_x = $spion['s_x'];
        $s_y = $spion['s_y'];
        if($extra_spio[1] == 'init') {
            //setzt einen neuen spion auf seinen ursprungsplanet
            $stufe_neu = spionstufe($extra_spio[0]);
            if($stufe_neu > 5) { $erfahrung_neu = 5; } else { $erfahrung_neu = $stufe_neu; }
            $pos_heimat = explode(",", $extra_spio[2]);
            $s_x = $pos_heimat[0];
            $s_y = $pos_heimat[1];
            $extra_spio[1] = $stufe_neu;
            $extra[0] = implode("-", $extra_spio);
            $extra_neu = implode(":", $extra);
            $zeiger_spiontemp = mysql_query("UPDATE $skrupel_schiffe set kox=$s_x,koy=$s_y,erfahrung=$erfahrung_neu,klasse='Spion (Stufe $stufe_neu)',status=2,s_x=".$pos_heimat[0].",s_y=".$pos_heimat[1].",extra='$extra_neu',tarnfeld=10 where id=".$spion['id']);
        } else {
            //erfahrung durch strecke
            $extra_spio[0] += intval($spion['strecke'] / 5);
            $extra[0] = implode("-", $extra_spio);
            $extra_neu = implode(":", $extra);
            $zeiger_spiontemp = mysql_query("UPDATE $skrupel_schiffe set extra='$extra_neu',strecke=0 where id=".$spion['id']);
        }
        //Heimatbasis noch da?
        $zeiger_heimat = mysql_query("SELECT name,besitzer from $skrupel_planeten where x_pos=$s_x and y_pos=$s_y and spiel=$spiel");
        $heimat = mysql_fetch_array($zeiger_heimat);
        if($spion['besitzer'] != $heimat['besitzer']) {
            mysql_query("DELETE from $skrupel_schiffe where id=".$spion['id']);
            neuigkeiten(2,"../bilder/news/verschollen.jpg", $spion['besitzer'],$lang['host'][$spielersprache[$spion['besitzer']]]['spionage'][0],array($spion['name'],$heimat['name']));
        }
    }

    //spionagen aus datei laden
    $spiodatei = false;
    $file = $main_verzeichnis."daten/unknown/spionagen.txt";
    $fp = fopen("$file","r");
    if($fp) {
        while (!feof ($fp)) {
            $buffer = fgets($fp, 4096);
            if(strlen($buffer) > 0) {
                $spiodatei = true;
                $attribute = explode(":", $buffer);
                $id = $attribute[0];
                //$spionage_daten[$id]['name'] = $attribute[1];
                //$spionage_daten[$id]['beschreibung'] = $attribute[2];
                $spionage_daten[$id]['level'] = $attribute[3];
                $spionage_daten[$id]['wahrscheinlichkeit'] = $attribute[4];
                $spionage_daten[$id]['ausbeute_min'] = $attribute[5];
                $spionage_daten[$id]['ausbeute_max'] = $attribute[6];
                //$spionage_daten[$id]['ziel'] = $attribute[7];
            }
        }
        fclose($fp);
    }

    //arrays f�llen
    $id_array = array();
    $zeiger_spione = mysql_query("SELECT * FROM $skrupel_schiffe WHERE volk='unknown' AND klasseid=1 AND spiel=$spiel ORDER BY erfahrung DESC, id ASC;");
    while(($spion = mysql_fetch_array($zeiger_spione)) && $spiodatei) {
        $id = $spion['id'];
        $id_array[] = $spion['id'];
        $extra_array[$id] = explode(":", $spion['extra']);
        $extra_spio_array[$id] = explode("-", $extra_array[$id][0]);

        $spiomission_array[$id] = $extra_spio_array[$id][3];
        $stufe_array[$id] = $extra_spio_array[$id][1];

        $spionname_array[$id] = $spion['name'];
        $spionbesitzer_array[$id] = $spion['besitzer'];
        $spionvolk_array[$id] = $spion['volk'];
        $spionbild_array[$id] = $spion['bild_gross'];

        $kox_array[$id] = $spion['kox'];
        $koy_array[$id] = $spion['koy'];
        $spion_sx_array[$id] = $spion['s_x'];
        $spion_sy_array[$id] = $spion['s_y'];
        $zielid_array[$id] = $spion['zielid'];
        $tarnfeld_array[$id] = $spion['tarnfeld'];
        $spezialmission_array[$id] = $spion['spezialmission'];
        $spionerfahrung_array[$id] = $spion['erfahrung'];

        $zielplanetbesitzer_array[$id] = 0;
        $zielschiffbesitzer_array[$id] = 0;
        $zielsternenbasis_array[$id] = 0;

        //spion am ziel?
        if($spiomission_array[$id] != 9  && $spiomission_array[$id] != 6) {
            $zeiger_target = mysql_query("SELECT id, besitzer, sternenbasis_id FROM $skrupel_planeten WHERE besitzer<>0 AND besitzer<>".$spionbesitzer_array[$id]." AND x_pos=".$kox_array[$id]." AND y_pos=".$koy_array[$id]." AND spiel=$spiel;");
            if(mysql_num_rows($zeiger_target)) {
                $ergebnis_target = mysql_fetch_array($zeiger_target);
                if($ergebnis_target['id'] == $zielid_array[$id]) {
                    $temp_zielid = 0;
                    $zielplanetbesitzer_array[$id] = $ergebnis_target['besitzer'];
                    $zielsternenbasis_array[$id] = $ergebnis_target['sternenbasis_id'];
                } else {
                    $temp_zielid = $ergebnis_target['id'];
                    $temp_zielplanetbesitzer = $ergebnis_target['besitzer'];
                    $temp_zielsternenbasis = $ergebnis_target['sternenbasis_id'];
                }
            }
            $zeiger_target = mysql_query("SELECT besitzer FROM $skrupel_schiffe WHERE besitzer<>0 AND besitzer<>".$spionbesitzer_array[$id]." AND kox=".$kox_array[$id]." AND koy=".$koy_array[$id]." AND id=".$zielid_array[$id]." AND spiel=$spiel;");
            if(mysql_num_rows($zeiger_target)) {
                $ergebnis_target = mysql_fetch_array($zeiger_target);
                //spion am ziel?
                $zielschiffbesitzer_array[$id] = $ergebnis_target['besitzer'];
            }
        }

        if($zielplanetbesitzer_array[$id]) $spionageziel_array[$id] = $zielplanetbesitzer_array[$id];
        else if($zielschiffbesitzer_array[$id]) $spionageziel_array[$id] = $zielschiffbesitzer_array[$id];
        else if($temp_zielid) {
            //falls durch gravitation auf planet
            $zielid_array[$id] = $temp_zielid;
            $zielplanetbesitzer_array[$id] = $temp_zielplanetbesitzer;
            $zielsternenbasis_array[$id] = $temp_zielsternenbasis;
            $spionageziel_array[$id] = $zielplanetbesitzer_array[$id];
        } else $spionageziel_array[$id] = 0;

        $politik_erlaubt_array[$id] = true;
        //wenn sie ein buendniss haben, dann spionage aktion unterdruecken
        if ($spionageziel_array[$id] && (($beziehung[$spionbesitzer_array[$id]][$spionageziel_array[$id]]['status']==3) || ($beziehung[$spionbesitzer_array[$id]][$spionageziel_array[$id]]['status']==4) || ($beziehung[$spionbesitzer_array[$id]][$spionageziel_array[$id]]['status']==5))) {
            $politik_erlaubt_array[$id] = false;
        }
    }

    //abarbeiten gegenspionage
    if(count($id_array) > 0) {
        foreach($id_array as $id) {
            $extra = $extra_array[$id];
            $extra_spio = $extra_spio_array[$id];
            $spiomission = $spiomission_array[$id];
            $stufe = $stufe_array[$id];
            $zielid = $zielid_array[$id];
            $spionbesitzer = $spionbesitzer_array[$id];
            $spionbild = $spionbild_array[$id];
            $spionname = $spionname_array[$id];
            $spionvolk = $spionvolk_array[$id];
            $kox = $kox_array[$id];
            $koy = $koy_array[$id];
            $tarnfeld = $tarnfeld_array[$id];
            $spezialmission = $spezialmission_array[$id];
            $spionerfahrung = $spionerfahrung_array[$id];
            $spion_sx = $spion_sx_array[$id];
            $spion_sy = $spion_sy_array[$id];
            $zielplanetbesitzer = $zielplanetbesitzer_array[$id];
            $zielschiffbesitzer = $zielschiffbesitzer_array[$id];
            $zielsternenbasis = $zielsternenbasis_array[$id];
            $spionageziel = $spionageziel_array[$id];
            $politik_erlaubt = $politik_erlaubt_array[$id];
            if($spezialmission==51 && $tarnfeld>1 && $spiomission==6 && $spionerfahrung >= $spionage_daten[6]['level']) {
                $reichweite = 150; //reichweite fuer gegenspionage
                $id_temp_array = array();
                foreach($id_array as $spio_zielid) {
                    if($spezialmission_array[$spio_zielid]==51 && $tarnfeld_array[$spio_zielid]>0 && $spionbesitzer_array[$spio_zielid]!=$spionbesitzer && ($spionageziel_array[$spio_zielid] || $spiomission_array[$spio_zielid]==9 || $spiomission_array[$spio_zielid]==6)) {
                        $ziel_besitzer = $spionbesitzer_array[$spio_zielid];
                        if( ! (($beziehung[$spionbesitzer][$ziel_besitzer]['status']==3) || ($beziehung[$spionbesitzer][$ziel_besitzer]['status']==4) || ($beziehung[$spionbesitzer][$ziel_besitzer]['status']==5))) {
                            $ziel_kox = $kox_array[$spio_zielid];
                            $ziel_koy = $koy_array[$spio_zielid];
                            $lichtjahre = ($kox-$ziel_kox)*($kox-$ziel_kox)+($koy-$ziel_koy)*($koy-$ziel_koy);
                            if($lichtjahre <= ($reichweite*$reichweite)) { $id_temp_array[] = $spio_zielid; }
                        }
                    }
                }
                if(count($id_temp_array) > 0) {
                    $ziel_index = array_rand($id_temp_array,1);
                    $spio_zielid = $id_temp_array[$ziel_index];
                    $ziel_name = $spionname_array[$spio_zielid];
                    $spionageziel = $spionbesitzer_array[$spio_zielid];
                    $spezialmission_array[$id] = 0;
                    if(spionerfolg($spionage_daten[6]['wahrscheinlichkeit'], $stufe-$stufe_array[$spio_zielid])) {
                        $spezialmission_array[$spio_zielid] = 0;
                        neuigkeiten(2,"../daten/$spionvolk/bilder_schiffe/".$spionbild, $spionbesitzer, $lang['host'][$spielersprache[$spionbesitzer]]['spionage'][1], array($spionname, $ziel_name, $spionage_daten[$spiomission_array[$spio_zielid]][$spielersprache[$spionbesitzer]]['name']));
                        neuigkeiten(2,"../daten/$spionvolk/bilder_schiffe/".$spionbild, $spionageziel, $lang['host'][$spielersprache[$spionageziel]]['spionage'][2], array($spionname, $ziel_name, $spionage_daten[$spiomission_array[$spio_zielid]][$spielersprache[$spionageziel]]['name'], sektor($kox, $koy)));
                        $extra_spio[0] += spionerfahrung($spionage_daten[$spiomission]['wahrscheinlichkeit'], $stufe);
                    }
                    else {
                        neuigkeiten(2,"../daten/$spionvolk/bilder_schiffe/".$spionbild, $spionbesitzer, $lang['host'][$spielersprache[$spionbesitzer]]['spionage'][3],array($spionname, $ziel_name));
                        neuigkeiten(2,"../daten/$spionvolk/bilder_schiffe/".$spionbild, $spionageziel, $lang['host'][$spielersprache[$spionageziel]]['spionage'][99],array($spionname, $ziel_name,sektor($kox, $koy)));
                    }
                    $spionageziel_array[$id] = $spionage_ziel;
                    $extra_spio_array[$id] = $extra_spio;
                    $extra[0] = implode("-", $extra_spio);
                    $extra_array[$id] = $extra;
                }
            }
        }
    }

    //abarbeiten rest
    if(count($id_array) > 0) {
        foreach($id_array as $id) {

            $extra = $extra_array[$id];
            $extra_spio = $extra_spio_array[$id];
            $spiomission = $spiomission_array[$id];
            $stufe = $stufe_array[$id];
            $zielid = $zielid_array[$id];
            $spionbesitzer = $spionbesitzer_array[$id];
            $spionname = $spionname_array[$id];
            $spionbild = $spionbild_array[$id];
            $spionvolk = $spionvolk_array[$id];
            $kox = $kox_array[$id];
            $koy = $koy_array[$id];
            $tarnfeld = $tarnfeld_array[$id];
            $spezialmission = $spezialmission_array[$id];
            $spionerfahrung = $spionerfahrung_array[$id];
            $spion_sx = $spion_sx_array[$id];
            $spion_sy = $spion_sy_array[$id];
            $zielplanetbesitzer = $zielplanetbesitzer_array[$id];
            $zielschiffbesitzer = $zielschiffbesitzer_array[$id];
            $zielsternenbasis = $zielsternenbasis_array[$id];
            $spionageziel = $spionageziel_array[$id];
            $politik_erlaubt = $politik_erlaubt_array[$id];

            $success = false;
            //wenn er am spionieren ist und seine tarnung noch funktioniert und er es aufgrund der politik auch darf
            if($spezialmission==51 && $tarnfeld>1 && $politik_erlaubt) {
                if($spiomission == 1 && $spionageziel && $spionerfahrung >= $spionage_daten[1]['level']) {
                    if(spionerfolg($spionage_daten[1]['wahrscheinlichkeit'], $stufe)) {
                        $success = true;
                        $text2 = str_replace('{1}',$spionname,$lang['host'][$spielersprache[$spionageziel]]['spionage'][6]);
                        $zeiger_mission = mysql_query("SELECT art, datum, inhalt FROM $skrupel_neuigkeiten WHERE art=7 AND spieler_id=$spionageziel AND spiel_id=$spiel;");
                        if(mysql_num_rows($zeiger_mission) == 0) {
                            $text1 = str_replace('{1}',$spionname,$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][4]);
                        } else {
                            $text1 = str_replace('{1}',$spionname,$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][5]);
                            while($ergebnis_mission = mysql_fetch_array($zeiger_mission)) {
                                $temp=explode("::::::",$ergebnis_mission['inhalt']);
                                $text1 .= "<br>".date('d.m.y G:i',$ergebnis_mission['datum'])."  ".$temp[1];
                            }
                        }
                    }
                }
                if($spiomission == 2 && $zielschiffbesitzer && $spionerfahrung >= $spionage_daten[2]['level']) {
                    if(spionerfolg($spionage_daten[2]['wahrscheinlichkeit'], $stufe)) {
                        $success = true;
                        $zeiger_mission = mysql_query("SELECT count(*) FROM $skrupel_sternenbasen WHERE besitzer=$zielschiffbesitzer AND spiel=$spiel;");
                        $ergebnis_mission = mysql_fetch_row($zeiger_mission);
                        $anzahl_sternenbasen = $ergebnis_mission[0];
                        $zeiger_mission = mysql_query("SELECT count(*) FROM $skrupel_planeten WHERE besitzer=$zielschiffbesitzer AND spiel=$spiel;");
                        $ergebnis_mission = mysql_fetch_row($zeiger_mission);
                        $anzahl_planeten = $ergebnis_mission[0];
                        $zeiger_mission = mysql_query("SELECT count(*) FROM $skrupel_schiffe WHERE besitzer=$zielschiffbesitzer AND spiel=$spiel;");
                        $ergebnis_mission = mysql_fetch_row($zeiger_mission);
                        $anzahl_schiffe = $ergebnis_mission[0];
                        $text1 = str_replace(array('{1}', '{2}', '{3}', '{4}'), array($spionname, $anzahl_sternenbasen, $anzahl_schiffe, $anzahl_planeten),$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][7]);
                        $text2 = str_replace('{1}',$spionname,$lang['host'][$spielersprache[$spionageziel]]['spionage'][8]);
                    }
                }
                if($spiomission == 3 && $zielplanetbesitzer && $spionerfahrung >= $spionage_daten[3]['level']) {
                    if(spionerfolg($spionage_daten[3]['wahrscheinlichkeit'], $stufe)) {
                        $success = true;
                        $zeiger_mission = mysql_query("SELECT sum(minen), sum(fabriken), sum(min1), sum(min2), sum(min3), sum(cantox), sum(lemin), sum(vorrat) FROM $skrupel_planeten WHERE besitzer=$zielplanetbesitzer AND spiel=$spiel;");
                        $ergebnis_mission = mysql_fetch_row($zeiger_mission);
                        $anzahl_minen = $ergebnis_mission[0];
                        $anzahl_fabriken = $ergebnis_mission[1];
                        $anzahl_bax = $ergebnis_mission[2];
                        $anzahl_ren = $ergebnis_mission[3];
                        $anzahl_vom = $ergebnis_mission[4];
                        $anzahl_can = $ergebnis_mission[5];
                        $anzahl_lem = $ergebnis_mission[6];
                        $anzahl_vor = $ergebnis_mission[7];
                        $text1 = str_replace(array('{1}', '{2}', '{3}', '{4}', '{5}', '{6}', '{7}', '{8}', '{9}'), array($spionname, $anzahl_fabriken, $anzahl_minen, $anzahl_bax, $anzahl_ren, $anzahl_vom, $anzahl_can, $anzahl_lem, $anzahl_vor),$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][7]);
                        $text2 = str_replace('{1}',$spionname,$lang['host'][$spielersprache[$spionageziel]]['spionage'][8]);
                    }
                }
                if($spiomission == 4 && $zielplanetbesitzer && $zielsternenbasis && $spionerfahrung >= $spionage_daten[4]['level']) {
                    if(spionerfolg($spionage_daten[4]['wahrscheinlichkeit'], $stufe)) {
                        $success = true;
                        $temp = $spionbesitzer;
                        $sicht_spionage[$zielplanetbesitzer][$temp] = 1;
                        $text1 = str_replace('{1}',$spionname,$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][11]);
                        $text2 = str_replace('{1}',$spionname,$lang['host'][$spielersprache[$spionageziel]]['spionage'][12]);
                    }
                }
                if($spiomission == 5 && $zielplanetbesitzer && $spionerfahrung >= $spionage_daten[5]['level']) {
                    if(spionerfolg($spionage_daten[5]['wahrscheinlichkeit'], $stufe)) {
                        $success = true;
                        $a_min = $spionage_daten[14]['ausbeute_min'] + $stufe * 5;
                        $a_max = $spionage_daten[14]['ausbeute_max'] + $stufe * 5;
                        $prozent = mt_rand($a_min, $a_max);
                        if($prozent>100) $prozent = 100;

                        //heimatplani des spions
                        $zeiger_mission = mysql_query("SELECT id FROM $skrupel_planeten WHERE x_pos=$spion_sx AND y_pos=$spion_sy AND spiel=$spiel;");
                        $ergebnis_mission = mysql_fetch_array($zeiger_mission);
                        $heimatplani = $ergebnis_mission['id'];

                        $zeiger_mission = mysql_query("SELECT name, cantox FROM $skrupel_planeten WHERE id=$zielid AND spiel=$spiel;");
                        $ergebnis_mission = mysql_fetch_array($zeiger_mission);
                        $name = $ergebnis_mission['name'];
                        $anzahl_can = $ergebnis_mission['cantox'];
                        $cantox_erbeutet = round($anzahl_can/100*$prozent);

                        mysql_query("UPDATE $skrupel_planeten SET cantox=cantox-$cantox_erbeutet WHERE id=$zielid AND spiel=$spiel;");
                        $text1 = str_replace(array('{1}', '{2}', '{3}', '{4}'), array($spionname, $cantox_erbeutet, $prozent, $name),$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][13]);
                        $text2 = str_replace(array('{1}', '{2}', '{3}', '{4}'), array($spionname, $cantox_erbeutet, $prozent, $name),$lang['host'][$spielersprache[$spionageziel]]['spionage'][14]);

                        if($heimatplani) { //zur sicherheit
                            $ziel_x = $spion_sx;
                            $ziel_y = $spion_sy;
                            $entfernung = sqrt(($ziel_y-$koy)*($ziel_y-$koy)+($ziel_x-$kox)*($ziel_x-$kox));
                            $rf_x = $kox + (($ziel_x-$kox)/$entfernung)*30;
                            $rf_y = $koy + (($ziel_y-$koy)/$entfernung)*30;
                            $rf_extra = "p:$heimatplani:$ziel_x:$ziel_y:$cantox_erbeutet:0:0:0:0:0";
                            mysql_query("INSERT INTO $skrupel_anomalien (art,x_pos,y_pos,extra,spiel) values (3,$rf_x,$rf_y,'$rf_extra',$spiel);");
                        }
                    }
                }
                //erweiterter taktische analyse
                if($spiomission == 7 && $zielschiffbesitzer && $spionerfahrung >= $spionage_daten[7]['level']) {
                    if(spionerfolg($spionage_daten[7]['wahrscheinlichkeit'], $stufe)) {
                        $success = true;
                        $text1 = str_replace('{1}',$spionname,$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][15]);
                        $text2 = str_replace('{1}',$spionname,$lang['host'][$spielersprache[$spionageziel]]['spionage'][16]);

                        $reichweite = 500; //reichweite ca 3.14 sektoren in der flaeche

                        $zeiger_mission = mysql_query("SELECT name,klasse,kox,koy,antrieb,schaden,energetik_stufe,projektile_stufe,energetik_anzahl,projektile_anzahl,hanger_anzahl,erfahrung FROM $skrupel_schiffe WHERE besitzer=$zielschiffbesitzer AND (sqrt(((kox-$kox)*(kox-$kox))+((koy-$koy)*(koy-$koy)))<=$reichweite) AND spiel=$spiel ORDER BY rand() LIMIT 0,15;");
                        if(mysql_num_rows($zeiger_mission)) {
                            $text1 .= "<br><br><table cellpadding=\"0\" cellspacing=\"5\" border=\"0\">";
                            $text1 .= $lang['host'][$spielersprache[$spionbesitzer]]['spionage'][17];
                            while($datensatz = mysql_fetch_array($zeiger_mission)) {
                                if($datensatz['erfahrung']) $bild = "<img src=\"../bilder/icons/erf_".$datensatz['erfahrung'].".gif\">"; else $bild = "&nbsp;";
                                $waffen = $lang['host'][$spielersprache[$spionbesitzer]]['spionage']['keine'];
                                if($datensatz['energetik_anzahl']) $waffen = $lang['host'][$spielersprache[$spionbesitzer]]['spionage']['energetik'][$datensatz['energetik_stufe']]." (".$datensatz['energetik_anzahl'].")";
                                if($datensatz['projektile_anzahl']) $waffen .= "<br>".$lang['host'][$spielersprache[$spionbesitzer]]['spionage']['projektile'][$datensatz['projektile_stufe']]." (".$datensatz['projektile_anzahl'].")";
                                if($datensatz['hanger_anzahl']) $waffen .= "<br>Hangar (".$datensatz['hanger_anzahl'].")";
                                $sektor = sektor($datensatz['kox'], $datensatz['koy']);
                                $text1 .= "<tr><td>".$bild."</td><td>".$datensatz['name']."</td><td>".$sektor."</td><td>".$datensatz['klasse']."</td><td>".$datensatz['schaden']."%</td><td>".$lang['host'][$spielersprache[$spionbesitzer]]['spionage']['antriebsnamen'][$datensatz['antrieb']]."</td><td>$waffen</td></tr>";
                            }
                            $text1 .= "</table>";
                        }
                        $zeiger_mission = mysql_query("SELECT name,x_pos,y_pos,rasse,defense,t_huelle,t_antrieb,t_energie,t_explosiv FROM $skrupel_sternenbasen WHERE besitzer=$zielschiffbesitzer AND spiel=$spiel;");
                        if(mysql_num_rows($zeiger_mission)) {
                            $text1 .= "<br><br><table cellpadding=\"0\" cellspacing=\"5\" border=\"0\">";
                            $text1 .= $lang['host'][$spielersprache[$spionbesitzer]]['spionage'][18];
                            while($datensatz = mysql_fetch_array($zeiger_mission)) {
                                $sektor = sektor($datensatz['x_pos'], $datensatz['y_pos']);
                                $techlevel = $datensatz['t_huelle']." ".$datensatz['t_antrieb']." ".$datensatz['t_energie']." ".$datensatz['t_explosiv'];
                                //unter umstaenden rausnehmen wegen dateizugriff
                                $file=$daten_verzeichnis.$datensatz['rasse'].'/daten.txt';
                                $fp = fopen("$file","r");
                                if ($fp) {
                                    $rasse = fgets($fp, 4096);
                                    fclose($fp);
                                } else $rasse = $datensatz['rasse'];
                                $text1 .= "<tr><td>".$datensatz['name']."</td><td>$sektor</td><td>".$rasse."</td><td>".$datensatz['defense']."</td><td>$techlevel</td></tr>";
                            }
                            $text1 .= "</table>";
                        }
                    }
                }
                //erweiterter wirtschafts analyse
                if($spiomission == 8 && $zielplanetbesitzer && $spionerfahrung >= $spionage_daten[8]['level']) {
                    if(spionerfolg($spionage_daten[8]['wahrscheinlichkeit'], $stufe)) {
                        $success = true;
                        $text1 = str_replace('{1}',$spionname,$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][19]);
                        $text2 = str_replace('{1}',$spionname,$lang['host'][$spielersprache[$spionageziel]]['spionage'][20]);

                        $reichweite = 500; //reichweite ca 3.14 sektoren in der flaeche

                        $zeiger_mission = mysql_query("SELECT name,kolonisten,cantox,vorrat,lemin,min1,min2,min3,fabriken,minen,x_pos,y_pos FROM $skrupel_planeten WHERE (sqrt(((x_pos-$kox)*(x_pos-$kox))+((y_pos-$koy)*(y_pos-$koy)))<=$reichweite) AND besitzer=$zielplanetbesitzer AND spiel=$spiel ORDER BY rand() LIMIT 0,15;");
                        if(mysql_num_rows($zeiger_mission)) {
                            $text1 .= "<br><br><table cellpadding=\"0\" cellspacing=\"5\" border=\"0\">";
                            $text1 .= $lang['host'][$spielersprache[$spionageziel]]['spionage'][21];
                            while($datensatz = mysql_fetch_array($zeiger_mission)) {
                                $text1 .= "<tr><td>".$datensatz['name']."</td><td>".$datensatz['kolonisten']."</td><td>".$datensatz['cantox']."</td><td>".$datensatz['vorrat']."</td><td>".$datensatz['lemin']."</td><td>".$datensatz['min1']."</td><td>".$datensatz['min2']."</td><td>".$datensatz['min3']."</td><td>".$datensatz['minen']."</td><td>".$datensatz['fabriken']."</td></tr>";
                            }
                            $text1 .= "</table>";
                        }
                    }
                }
                //diese mission (feindspion jagen) stellt eine sonderrolle da
                if($spiomission == 9 && $spionerfahrung >= $spionage_daten[9]['level']) {
                    $reichweite = 150; //reichweite fuer feindspion jagen
                    $id_temp_array = array();
                    foreach($id_array as $spio_zielid) {
                        $ziel_besitzer = $spionbesitzer_array[$spio_zielid];
                        if($ziel_besitzer==$spionbesitzer) { continue; }
                        if(($beziehung[$spionbesitzer][$ziel_besitzer]['status']==3) || ($beziehung[$spionbesitzer][$ziel_besitzer]['status']==4) || ($beziehung[$spionbesitzer][$ziel_besitzer]['status']==5)) { continue; }
                        if($tarnfeld_array[$spio_zielid] <= 0) { continue; }
                        $ziel_kox = $kox_array[$spio_zielid];
                        $ziel_koy = $koy_array[$spio_zielid];
                        $lichtjahre = ($kox-$ziel_kox)*($kox-$ziel_kox)+($koy-$ziel_koy)*($koy-$ziel_koy);
                        if($lichtjahre <= ($reichweite*$reichweite)) { $id_temp_array[] = $spio_zielid; }
                    }
                    if(count($id_temp_array) > 0) {
                        $ziel_index = array_rand($id_temp_array,1);
                        $spio_zielid = $id_temp_array[$ziel_index];
                        $ziel_name = $spionname_array[$spio_zielid];
                        $spionageziel = $spionbesitzer_array[$spio_zielid];
                        $sektor = sektor($kox_array[$spio_zielid], $koy_array[$spio_zielid]);
                        if(spionerfolg($spionage_daten[9]['wahrscheinlichkeit'], $stufe-$stufe_array[$spio_zielid])) {
                            $success = true;
                            $ziel_tarnfeld = $tarnfeld_array[$spio_zielid]-3;
                            if($ziel_tarnfeld > 1) {
                                $text1 = str_replace(array('{1}', '{2}'), array($spionname, $sektor),$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][22]);
                                $text2 = str_replace(array('{1}', '{2}'), array($spionname, $ziel_name),$lang['host'][$spielersprache[$spionageziel]]['spionage'][23]);
                            }
                            if($ziel_tarnfeld == 1) {
                                $text1 = str_replace(array('{1}', '{2}', '{3}'), array($spionname, $ziel_name, $sektor),$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][24]);
                                $text2 = str_replace(array('{1}', '{2}'), array($spionname, $ziel_name),$lang['host'][$spielersprache[$spionageziel]]['spionage'][25]);
                            }
                            if($ziel_tarnfeld <= 0) {
                                $text1 = str_replace(array('{1}', '{2}', '{3}'), array($spionname, $ziel_name, $sektor),$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][26]);
                                $text2 = str_replace(array('{1}', '{2}'), array($spionname, $ziel_name),$lang['host'][$spielersprache[$spionageziel]]['spionage'][27]);
                                $ziel_tarnfeld = -1; //enttarnt auch bei inkrement/dekrement weiter unten, ist allerdings net sooo sauber geloest ;)
                            }
                            $tarnfeld_array[$spio_zielid] = $ziel_tarnfeld;
                            $spionageziel_array[$id] = $spionageziel;
                        }
                        else {
                            neuigkeiten(2,"../daten/$spionvolk/bilder_schiffe/".$spionbild, $spionbesitzer, $lang['host'][$spielersprache[$spionbesitzer]]['spionage'][28],array($spionname, $ziel_name, sektor($kox, $koy)));
                            neuigkeiten(2,"../daten/$spionvolk/bilder_schiffe/".$spionbild, $spionageziel, $lang['host'][$spielersprache[$spionageziel]]['spionage'][29],array($spionname, $ziel_name, sektor($kox, $koy)));
                        }
                    }
                }
                //Zielinfo herausfinden
                if($spiomission == 10 && $zielplanetbesitzer && $zielsternenbasis && $spionerfahrung >= $spionage_daten[10]['level']) {
                    if(spionerfolg($spionage_daten[10]['wahrscheinlichkeit'], $stufe)) {
                        $success = true;
                        $zeiger_mission = mysql_query("SELECT * FROM $skrupel_spiele WHERE id=$spiel;");
                        $ergebnis_mission = mysql_fetch_array($zeiger_mission);
                        switch($ergebnis_mission['ziel_id']) {
                            case 0 : { //j4f
                                $text1 = str_replace('{1}',$spionname,$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][30]);
                                $text2 = str_replace('{1}',$spionname,$lang['host'][$spielersprache[$spionageziel]]['spionage'][31]);
                            } break;
                            case 1 : { //ueberleben
                                $text1 = str_replace('{1}',$spionname,$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][32]);
                                $text2 = str_replace('{1}',$spionname,$lang['host'][$spielersprache[$spionageziel]]['spionage'][33]);
                            } break;
                            case 2 : { //todfeind
                                $temp = "spieler_".$zielplanetbesitzer."_ziel";
                                $spielernummer = $ergebnis_mission[$temp];
                                $temp = "spieler_".$spielernummer;
                                $temp_nick = nick($ergebnis_mission[$temp]);
                                $temp_farbe = $spielerfarbe[$spielernummer];
                                $text1 = str_replace(array('{1}', '{2}', '{3}'), array($spionname, $temp_farbe, $temp_nick),$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][34]);
                                $text2 = str_replace('{1}',$spionname,$lang['host'][$spielersprache[$spionageziel]]['spionage'][35]);
                            } break;
                            case 5 : { //spice
                                $temp = "spieler_".$zielplanetbesitzer."_ziel";
                                $gelagert = $ergebnis_mission[$temp];
                                $noetig = $ergebnis_mission['ziel_info'];
                                $prozent = round((100/$noetig)*$gelagert);
                                $text1 = str_replace(array('{1}', '{2}', '{3}'), array($spionname, $gelagert, $$prozent),$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][36]);
                                $text2 = str_replace('{1}',$spionname,$lang['host'][$spielersprache[$spionageziel]]['spionage'][37]);
                            } break;
                            case 6 : { //team todfeind
                                $temp = "spieler_".$zielplanetbesitzer."_ziel";
                                $temp = $ergebnis_mission[$temp];
                                $team_ziele = explode(":", $temp);
                                $temp_id1 = "spieler_".$team_ziele[1];
                                $temp_id2 = "spieler_".$team_ziele[2];
                                $temp_nick1 = nick($ergebnis_mission[$temp_id1]);
                                $temp_nick2 = nick($ergebnis_mission[$temp_id2]);
                                $temp_farbe1 = $spielerfarbe[$team_ziele[1]];
                                $temp_farbe2 = $spielerfarbe[$team_ziele[2]];
                                $text1 = str_replace(array('{1}', '{2}', '{3}', '{4}', '{5}'), array($spionname, $temp_farbe1, $temp_nick1, $temp_farbe2, $temp_nick2),$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][38]);
                                $text2 = str_replace('{1}',$spionname,$lang['host'][$spielersprache[$spionageziel]]['spionage'][39]);
                            } break;
                        }
                    }
                }
                //Planet sabotieren
                if($spiomission == 11 && $zielplanetbesitzer && $spionerfahrung >= $spionage_daten[11]['level']) {
                    if(spionerfolg($spionage_daten[11]['wahrscheinlichkeit'], $stufe)) {
                        $a_min = $spionage_daten[11]['ausbeute_min'] + $stufe * 5;
                        $a_max = $spionage_daten[11]['ausbeute_max'] + $stufe * 5;

                        $zeiger_mission = mysql_query("SELECT * FROM $skrupel_planeten WHERE id=$zielid AND spiel=$spiel;");
                        if($datensatz = mysql_fetch_array($zeiger_mission)) {
                            $success = true;
                            $p_id=$datensatz["id"];
                            $p_minen=$datensatz["minen"];
                            $p_fabriken=$datensatz["fabriken"];
                            $p_abwehr=$datensatz["abwehr"];
                            $p_name=$datensatz["name"];

                            $staerke_angriff = mt_rand($a_min, $a_max);

                            $prozent = round($staerke_angriff/3);
                            $prozente[0] = mt_rand(0,$prozent);
                            $prozente[1] = mt_rand(0,($prozent-$prozente[0]));
                            $prozente[2] = mt_rand(0,($prozent-$prozente[0]-$prozente[1]));

                            shuffle($prozente);

                            $prozent_minen = $prozente[0]; if ($prozent_minen>100) { $prozent_minen=100; }
                            $prozent_fabriken = $prozente[1]; if ($prozent_fabriken>100) { $prozent_fabriken=100; }
                            $prozent_abwehr = $prozente[2]; if ($prozent_abwehr>100) { $prozent_abwehr=100; }

                            $vernichtet_minen=round($p_minen/100*$prozent_minen);
                            $vernichtet_fabriken=round($p_fabriken/100*$prozent_fabriken);
                            $vernichtet_abwehr=round($p_abwehr/100*$prozent_abwehr);

                            mysql_query("UPDATE $skrupel_planeten SET minen=minen-$vernichtet_minen,fabriken=fabriken-$vernichtet_fabriken,abwehr=abwehr-$vernichtet_abwehr WHERE id=$p_id;");

                            $text1 = str_replace(array('{1}', '{2}', '{3}', '{4}', '{5}', '{6}', '{7}', '{8}'), array($spionname, $p_name, $vernichtet_minen, $prozent_minen, $vernichtet_fabriken, $prozent_fabriken, $vernichtet_abwehr, $prozent_abwehr),$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][40]);
                            $text2 = str_replace(array('{1}', '{2}', '{3}', '{4}', '{5}', '{6}', '{7}', '{8}'), array($p_name, $spionname, $vernichtet_minen, $prozent_minen, $vernichtet_fabriken, $prozent_fabriken, $vernichtet_abwehr, $prozent_abwehr),$lang['host'][$spielersprache[$spionageziel]]['spionage'][41]);
                        }
                    }
                }
                //sternenbasis sabotieren
                if($spiomission == 12 && $zielplanetbesitzer && $zielsternenbasis && $spionerfahrung >= $spionage_daten[12]['level']) {
                    if(spionerfolg($spionage_daten[12]['wahrscheinlichkeit'], $stufe)) {
                        $zeiger_mission = mysql_query("SELECT name,defense,t_huelle,t_antrieb,t_energie,t_explosiv FROM $skrupel_sternenbasen WHERE planetid=$zielid AND spiel=$spiel;");
                        if(mysql_num_rows($zeiger_mission)) {
                            $success = true;
                            $datensatz = mysql_fetch_array($zeiger_mission);

                            $ziel_name = $datensatz['name'];
                            $ziel_defense = $datensatz['defense'];
                            $t_huelle = $datensatz['t_huelle'];
                            $t_antrieb = $datensatz['t_antrieb'];
                            $t_energie = $datensatz['t_energie'];
                            $t_explosiv = $datensatz['t_explosiv'];

                            $a_min = $spionage_daten[12]['ausbeute_min'] + $stufe * 5;
                            $a_max = $spionage_daten[12]['ausbeute_max'] + $stufe * 5;
                            $prozent = mt_rand($a_min, $a_max);
                            if($prozent>100) $prozent = 100;

                            $vernichtet_defense = round($ziel_defense/100*$prozent);

                            $t_stufe = 0;
                            if(spionerfolg(10, $stufe)) {
                                $vernichtet_techlevel = mt_rand(1, 4);
                                switch($vernichtet_techlevel) {
                                    case 1 : { $t_stufe = $t_huelle; $t_huelle -= 1; if($t_huelle<0) { $t_huelle=0; } $techlevelname = "R�mpfe"; } break;
                                    case 2 : { $t_stufe = $t_antrieb; $t_antrieb -= 1; if($t_antrieb<0) { $t_antrieb=0; } $techlevelname = "Antriebe"; } break;
                                    case 3 : { $t_stufe = $t_energie; $t_energie -= 1; if($t_energie<0) { $t_energie=0; } $techlevelname = "Energetikwaffen"; } break;
                                    case 4 : { $t_stufe = $t_explosiv; $t_explosiv -= 1; if($t_explosiv<0) { $t_explosiv=0; } $techlevelname = "Projektile"; } break;
                                }
                            }
                            mysql_query("UPDATE $skrupel_sternenbasen SET t_huelle=$t_huelle, t_antrieb=$t_antrieb, t_energie=$t_energie, t_explosiv=$t_explosiv, defense=defense-$vernichtet_defense WHERE planetid=$zielid AND spiel=$spiel;");
                            if($t_stufe) {
                                $text1 = str_replace(array('{1}', '{2}', '{3}', '{4}', '{5}', '{6}'), array($spionname, $ziel_name, $vernichtet_defense, $prozent, $t_stufe, $techlevelname),$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][42]);
                                $text2 = str_replace(array('{1}', '{2}', '{3}', '{4}', '{5}', '{6}'), array($spionname, $ziel_name, $vernichtet_defense, $prozent, $t_stufe, $techlevelname),$lang['host'][$spielersprache[$spionageziel]]['spionage'][43]);
                            }else {

                                $text1 = str_replace(array('{1}', '{2}', '{3}', '{4}'), array($spionname, $ziel_name, $vernichtet_defense, $prozent),$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][44]);
                                $text2 = str_replace(array('{1}', '{2}', '{3}', '{4}'), array($spionname, $ziel_name, $vernichtet_defense, $prozent),$lang['host'][$spielersprache[$spionageziel]]['spionage'][45]);
                            }
                        }
                    }
                }
                //schiff sabotieren
                if($spiomission == 13 && $zielschiffbesitzer && $spionerfahrung >= $spionage_daten[13]['level']) {
                    if(spionerfolg($spionage_daten[13]['wahrscheinlichkeit'], $stufe)) {
                        $zeiger_mission = mysql_query("SELECT besitzer,name,lemin,schaden,crew FROM $skrupel_schiffe WHERE !(volk='unknown' and klasseid=1) AND id=$zielid AND spiel=$spiel;");
                        if(mysql_num_rows($zeiger_mission)) {
                            $success = true;
                            $schiff_tot = false;
                            $datensatz = mysql_fetch_array($zeiger_mission);

                            $schiff_name = $datensatz['name'];
                            $schiff_lemin = $datensatz['lemin'];
                            $schiff_schaden = $datensatz['schaden'];
                            $schiff_crew = $datensatz['crew'];

                            $prozent_lemin = mt_rand(10, 25);
                            $prozent_schaden = mt_rand(5, 15);
                            $prozent_crew = mt_rand(5, 20);

                            //prozentpunkte, erschien mir sinnvoller
                            $schiff_schaden += $prozent_schaden; if($schiff_schaden > 100) { $schiff_tot = true; }

                            $crew_vernichtet = round($schiff_crew/100*$prozent_crew);
                            $lemin_vernichtet = round($schiff_lemin/100*$prozent_lemin);
                            if($schiff_tot) {
                                mysql_query("DELETE FROM $skrupel_schiffe where id=$zielid;");
                                mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 's:$zielid:%'");
                                mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where (flug=3 or flug=4) and zielid=$zielid;");
                                $text1 = str_replace(array('{1}', '{2}'), array($spionname, $schiff_name),$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][46]);
                                $text2 = str_replace(array('{1}', '{2}'), array($spionname, $schiff_name),$lang['host'][$spielersprache[$spionageziel]]['spionage'][47]);

                                $schiffevernichtet++;
                            } else {
                                mysql_query("UPDATE $skrupel_schiffe SET schaden=$schiff_schaden, crew=crew-$crew_vernichtet, lemin=lemin-$lemin_vernichtet WHERE id=$zielid AND spiel=$spiel;");
                                $text1 = str_replace(array('{1}', '{2}', '{3}', '{4}', '{5}', '{6}', '{7}'), array($spionname, $schiff_name, $prozent_schaden, $lemin_vernichtet, $prozent_lemin, $crew_vernichtet, $prozent_crew),$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][48]);
                                $text2 = str_replace(array('{1}', '{2}', '{3}', '{4}', '{5}', '{6}', '{7}'), array($spionname, $schiff_name, $prozent_schaden, $lemin_vernichtet, $prozent_lemin, $crew_vernichtet, $prozent_crew),$lang['host'][$spielersprache[$spionageziel]]['spionage'][49]);
                            }
                        }
                    }
                }
                if($spiomission == 14 && $zielplanetbesitzer && !$zielsternenbasis && $spionerfahrung >= $spionage_daten[14]['level']) {
                    if(spionerfolg($spionage_daten[14]['wahrscheinlichkeit'], $stufe)) {
                        $success = true;
                        $a_min = $spionage_daten[14]['ausbeute_min'] + $stufe * 5;
                        $a_max = $spionage_daten[14]['ausbeute_max'] + $stufe * 5;
                        $prozent = mt_rand($a_min, $a_max);
                        if($prozent>100) $prozent = 100;

                        $zeiger_mission = mysql_query("SELECT name, kolonisten FROM $skrupel_planeten WHERE id=$zielid AND spiel=$spiel;");
                        $ergebnis_mission = mysql_fetch_array($zeiger_mission);
                        $name = $ergebnis_mission['name'];
                        $anzahl_kol = $ergebnis_mission['kolonisten'];
                        $kolonisten_vernichted = round($anzahl_kol/100*$prozent);
                        if(($anzahl_kol - $kolonisten_vernichted) < 2000) {
                            mysql_query("UPDATE $skrupel_planeten SET besitzer=$spionbesitzer, kolonisten=kolonisten-$kolonisten_vernichted WHERE id=$zielid AND spiel=$spiel;");
                            $text1 =
                            $text2 =
                            $text1 = str_replace(array('{1}', '{2}', '{3}', '{4}'), array($spionname, $name, $kolonisten_vernichted, $prozent),$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][50]);
                            $text2 = str_replace(array('{1}', '{2}', '{3}', '{4}'), array($spionname, $name, $kolonisten_vernichted, $prozent),$lang['host'][$spielersprache[$spionageziel]]['spionage'][51]);
                            $stat_kol_erobert[$spionbesitzer]++;
                            $planetenerobert++;
                        }
                        else {
                            mysql_query("UPDATE $skrupel_planeten SET kolonisten=kolonisten-$kolonisten_vernichted WHERE id=$zielid AND spiel=$spiel;");
                            $text1 = str_replace(array('{1}', '{2}', '{3}', '{4}'), array($spionname, $name, $kolonisten_vernichted, $prozent),$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][52]);
                            $text2 = str_replace(array('{1}', '{2}', '{3}', '{4}'), array($spionname, $name, $kolonisten_vernichted, $prozent),$lang['host'][$spielersprache[$spionageziel]]['spionage'][53]);
                            $planetenerobertfehl++;
                        }
                    }
                }
                if($spiomission == 15 && $zielschiffbesitzer && $spionerfahrung >= $spionage_daten[15]['level']) {
                    if(spionerfolg($spionage_daten[15]['wahrscheinlichkeit'], $stufe)) {
                        $zeiger_mission = mysql_query("SELECT name, kox, koy FROM $skrupel_schiffe WHERE !(volk='unknown' and klasseid=1) AND id=$zielid AND spiel=$spiel;");
                        if(mysql_num_rows($zeiger_mission)) {
                            $success = true;
                            $ergebnis_mission = mysql_fetch_array($zeiger_mission);
                            $ns_name = $ergebnis_mission['name'];
                            $ns_kox = $ergebnis_mission['kox'];
                            $ns_koy = $ergebnis_mission['koy'];
                            //Neues Schiff weicht zusaetzlich aus
                            $winkel = mt_rand(0,360);
                            $ns_kox += cos(deg2rad($winkel))*20;
                            $ns_koy += sin(deg2rad($winkel))*20;
                            if ($ns_kox<=0) {$ns_kox=1;}
                            if ($ns_kox>$umfang) {$ns_kox=$umfang;}
                            if ($ns_koy<=0) {$ns_koy=1;}
                            if ($ns_koy>$umfang) {$ns_koy=$umfang;}
                            mysql_query("UPDATE $skrupel_schiffe SET besitzer=$spionbesitzer, status=1, schwerebt=0, leichtebt=0, fracht_leute=0, spezialmission=0, flug=0, kox=$ns_kox, koy=$ns_koy, s_x=$spion_sx, s_y=$spion_sy, ordner=0 WHERE id=$zielid AND spiel=$spiel;");
                            $text1 = str_replace(array('{1}', '{2}'), array($spionname, $ns_name),$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][54]);
                            $text2 = str_replace(array('{1}', '{2}'), array($spionname, $ns_name),$lang['host'][$spielersprache[$spionageziel]]['spionage'][55]);
                        }
                    }
                }
            }

            //nachricht und schiff-update
            //wenn er an einem zielpunkt ist
            if($spionageziel) {
                if($success) {
                    $sektor = sektor($kox, $koy);
                    $extra_spio[0] += spionerfahrung($spionage_daten[$spiomission]['wahrscheinlichkeit'], $stufe);
                    neuigkeiten(2,"../daten/$spionvolk/bilder_schiffe/".$spionbild, $spionbesitzer, $text1);
                    neuigkeiten(2,"../daten/$spionvolk/bilder_schiffe/".$spionbild, $spionageziel, $text2.$lang['host'][$spielersprache[$spionageziel]]['spionage'][56], $sektor);
                }
                else {
                    if($spiomission != 9 && $spiomission != 6) {
                        if($politik_erlaubt) neuigkeiten(2,"../daten/$spionvolk/bilder_schiffe/".$spionbild,$spionbesitzer,$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][57], array($spionname, $spionage_daten[$spiomission][$spielersprache[$spionbesitzer]]['name']));
                        else neuigkeiten(2,"../daten/$spionvolk/bilder_schiffe/".$spionbild,$spionbesitzer,$lang['host'][$spielersprache[$spionbesitzer]]['spionage'][58], array($spionname, $spionage_daten[$spiomission][$spielersprache[$spionbesitzer]]['name']));
                    }
                }
                $extra[0] = implode("-", $extra_spio);
                $extra_neu = implode(":", $extra);
                //nicht ausweichen wenn tarnung in diesem tick schon aus war
                if($spiomission != 9 && $spiomission != 6 && $tarnfeld > 1) {
                    $winkel = mt_rand(0,360);
                    $kox += cos(deg2rad($winkel))*20;
                    $koy += sin(deg2rad($winkel))*20;
                    if ($kox<=0) {$kox=1;}
                    if ($kox>$umfang) {$kox=$umfang;}
                    if ($koy<=0) {$koy=1;}
                    if ($koy>$umfang) {$koy=$umfang;}
                    $zeiger_spiontemp = mysql_query("UPDATE $skrupel_schiffe SET extra='$extra_neu', status=1, kox=$kox, koy=$koy WHERE id=$id;");
                } else {
                    $zeiger_spiontemp = mysql_query("UPDATE $skrupel_schiffe SET extra='$extra_neu', WHERE id=$id;");
                }
            }

            //LVLUP
            $stufe_neu = spionstufe($extra_spio[0]);
            if($stufe_neu > $stufe) {
                if($stufe_neu > 5) { $erfahrung_neu = 5; } else { $erfahrung_neu = $stufe_neu; }
                $extra_spio[1] = $stufe_neu;
                $extra[0] = implode("-", $extra_spio);
                $extra_neu = implode(":", $extra);
                $stufe_array[$id] = $stufe_neu;
                $spionerfahrung_array[$id] = $erfahrung_neu;
                $zeiger_spiontemp = mysql_query("UPDATE $skrupel_schiffe set erfahrung=$erfahrung_neu,klasse='Spion (Stufe $stufe_neu)',extra='$extra_neu' where id=$id;");
                if($stufe_neu <= 5) {   neuigkeiten(2,"../daten/$spionvolk/bilder_schiffe/".$spionbild,$spionbesitzer,"Unser Spion $spionname konnte sich durch langes Training neue Fertigkeiten aneignen."); }
                else { neuigkeiten(2,"../daten/$spionvolk/bilder_schiffe/".$spionbild,$spionbesitzer,"Unser Spion $spionname konnte durch langes Training seine Fertigkeiten zus&auml;tzlich verbessern."); }
            }
        }
    }

    //tarnung wird dekrementiert / incrementiert

    if(count($id_array) > 0) {
        foreach($id_array as $id) {

        $spionbesitzer = $spionbesitzer_array[$id];
        $kox = $kox_array[$id];
        $koy = $koy_array[$id];
        $tarnfeld = $tarnfeld_array[$id];
        $scanned = 0;

        $zeiger = mysql_query("SELECT besitzer FROM $skrupel_schiffe WHERE
                                    (    ((sqrt(((kox-$kox)*(kox-$kox))+((koy-$koy)*(koy-$koy)))<=47) AND scanner=0)
                                        OR ((sqrt(((kox-$kox)*(kox-$kox))+((koy-$koy)*(koy-$koy)))<=85) AND scanner=1)
                                        OR ((sqrt(((kox-$kox)*(kox-$kox))+((koy-$koy)*(koy-$koy)))<=116) AND scanner=2)
                                    ) AND !(volk='unknown' and klasseid=1) AND besitzer<>$spionbesitzer AND spiel=$spiel;");
        while(($datensatz = mysql_fetch_array($zeiger)) && $scanned==0) {
            if($beziehung[$spionbesitzer][$datensatz['besitzer']]['status']>=3 && $beziehung[$spionbesitzer][$datensatz['besitzer']]['status']<=5){
	    } else { $scanned=1;}
        }

        if($scanned==0) {
            $zeiger = mysql_query("SELECT besitzer FROM $skrupel_planeten WHERE (((sqrt(((x_pos-$kox)*(x_pos-$kox))+((y_pos-$koy)*(y_pos-$koy)))<=53) AND sternenbasis_art<>3) OR ((sqrt(((x_pos-$kox)*(x_pos-$kox))+((y_pos-$koy)*(y_pos-$koy)))<=116) AND sternenbasis_art=3)) AND besitzer<>$spionbesitzer AND besitzer>0 AND spiel=$spiel;");
            while(($datensatz = mysql_fetch_array($zeiger)) && $scanned==0) {
                $ziel_besitzer = $datensatz['besitzer'];
                if ($beziehung[$spionbesitzer][$datensatz['besitzer']]['status']>=3 && $beziehung[$spionbesitzer][$datensatz['besitzer']]['status']<=5){
		} else { $scanned=1;}
            }
        }
        if($scanned==1) $tarnfeld--;
        else $tarnfeld++;

        if($tarnfeld > 10) $tarnfeld = 10;
        if($tarnfeld < 0) $tarnfeld = 0;
        mysql_query("UPDATE $skrupel_schiffe SET tarnfeld=$tarnfeld WHERE id=$id AND spiel=$spiel;");

        }
    }
}

//kleine funktionen fuer wahrscheinlichkeitsberechung
function spionerfolg($wahrscheinlichkeit, $stufe) {
  $erg = mt_rand(0,100) + $stufe * 5;
    if($erg > 100) { $erg = 100; }
    if($erg > (100 - $wahrscheinlichkeit)) { return true; }
    return false;
}
function spionerfahrung($wahrscheinlichkeit, $stufe) {
    $xp = floor(((100 - $wahrscheinlichkeit) - ($stufe * 5)) * 1.2);
    if($xp < 5) { $xp = 5; }
    return $xp;
}
function spionstufe($xp) {
    $xp_benoetigt = 0;
    for($stufe=0;$stufe<10;$stufe++) {
        $xp_benoetigt += (($stufe+1)*100);
        if($xp < $xp_benoetigt) { return $stufe; }
    }
    return 10;
}
?>
