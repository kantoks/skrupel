<?php
if(count($sprachen) == 0) {
    include(LANGUAGEDIR.$language.'/lang.inc.host_orbitalkampf.php');
} else {
    foreach($sprachen as $sprache) {
        include(LANGUAGEDIR.$sprache.'/lang.inc.host_orbitalkampf.php');
    }
}

$zeiger_temp = mysql_query("UPDATE $skrupel_planeten set sternenbasis_defense=0 where spiel=$spiel");
$zeiger = mysql_query("SELECT * FROM $skrupel_sternenbasen where status=1 and spiel=$spiel order by id");
$basenanzahl = mysql_num_rows($zeiger);

if ($basenanzahl>=1) {
    for  ($i=0; $i<$basenanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);
        $baid=$array["id"];
        $defense=$array["defense"];
        $planetid=$array["planetid"];
        $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set sternenbasis_defense=$defense where id=$planetid");
    }
}

$zeiger_temp = mysql_query("UPDATE $skrupel_planeten set p_defense_gesamt=sternenbasis_defense+abwehr+100 where spiel=$spiel");
$zeiger = mysql_query("SELECT * FROM $skrupel_schiffe where spiel=$spiel order by aggro desc");
$schiffanzahl = mysql_num_rows($zeiger);

if ($schiffanzahl>=1) {
    for  ($i=0; $i<$schiffanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);

        $shid=$array["id"];
        $besitzer=$array["besitzer"];
        $name=$array["name"];
        $status=$array["status"];
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
        $bild_gross=$array["bild_gross"];
        $bild_klein=$array["bild_klein"];
        $erfahrung=$array["erfahrung"];
        $energetik_stufe=$array["energetik_stufe"];
        $energetik_anzahl=$array["energetik_anzahl"];
        $projektile_stufe=$array["projektile_stufe"];
        $projektile_anzahl=$array["projektile_anzahl"];
        $hangar_anzahl=$array["hanger_anzahl"];
        $schild=$array["schild"];
        $schaden=$array["schaden"];
        $projektile=$array["projektile"];
        $erfahrung=$array["erfahrung"];
        $techlevel=$array["techlevel"];
        $fertigkeiten=$array["fertigkeiten"];
        $zusatzmodul=$array["zusatzmodul"];

        if (($energetik_anzahl==0) and ($zusatzmodul==5)) { $energetik_stufe=1; }

        /////////beschaedigung der waffensysteme anfang
        if ($schaden>50) {
            $prozent = ($schaden-50)*2;
            switch (mt_rand(1,3)) {
                case 1:
                    if ($energetik_anzahl>=1) {
                        $energetik_anzahl -= round($energetik_anzahl/100*$prozent);
                    }
                    break;
                case 2:
                    if ($projektile_anzahl>=1) {
                        $projektile_anzahl -= round($projektile_anzahl/100*$prozent);
                    }
                    break;
                case 3:
                    if ($hangar_anzahl>=1) {
                        $hangar_anzahl -= round($hangar_anzahl/100*$prozent);
                    }
                    break;
            }
        }
        /////////beschaedigung der waffensysteme ende

        if (($energetik_anzahl<10) and ($zusatzmodul==5)) { $energetik_anzahl++; }
        if(($zusatzmodul==1)and($erfahrung<5)){$erfahrung++;}
        $orbitalschild=intval(substr($fertigkeiten,56,1));
        $gemeinsam=0;
        $zeiger_temp = mysql_query("SELECT count(*) as gemeinsam FROM $skrupel_planeten where x_pos=$kox and y_pos=$koy and besitzer<>$besitzer and besitzer>=1 and spiel=$spiel");
        $array_temp = mysql_fetch_array($zeiger_temp);
        $gemeinsam=$array_temp["gemeinsam"];

        if ($orbitalschild==1) { $gemeinsam=0; }

        if ($gemeinsam>=1) {
            $zeiger2 = mysql_query("SELECT * FROM $skrupel_planeten where x_pos=$kox and y_pos=$koy and spiel=$spiel");
            $array2 = mysql_fetch_array($zeiger2);
            $p_id=$array2["id"];
            $p_name=$array2["name"];
            $p_besitzer=$array2["besitzer"];
            $p_bild=$array2["bild"];
            $p_klasse=$array2["klasse"];
            $p_abwehr=$array2["abwehr"];
            $p_sternenbasis=$array2["sternenbasis"];
            $p_sternenbasis_defense=$array2["sternenbasis_defense"];
            $p_defense_gesamt=$array2["p_defense_gesamt"];
            $native_id=$array2["native_id"];
            $native_fert=$array2["native_fert"];
            $native_kol=$array2["native_kol"];
            $osys_1=$array2["osys_1"];
            $osys_2=$array2["osys_2"];
            $osys_3=$array2["osys_3"];
            $osys_4=$array2["osys_4"];
            $osys_5=$array2["osys_5"];
            $osys_6=$array2["osys_6"];

            if (($beziehung[$besitzer][$p_besitzer]['status']!=3) and ($beziehung[$besitzer][$p_besitzer]['status']!=4) and ($beziehung[$besitzer][$p_besitzer]['status']!=5)) {
                //Signaturscannerphalanx
                if(($osys_1==18) or ($osys_2==18) or ($osys_3==18) or ($osys_4==18) or ($osys_5==18)or ($osys_6==18)){
                    $planet_rasse=$s_eigenschaften[$p_besitzer]['rasse'];
                    $schiff_rasse=$s_eigenschaften[$besitzer]['rasse'];
                    if (($planet_rasse=="kuatoh")and($schiff_rasse!="kuatoh")and($volk!="unknown")) {
                        $anzahl=0;
                        $zeiger7 = mysql_query("SELECT count(*) as total FROM $skrupel_konplaene where besitzer=$p_besitzer and spiel=$spiel and klasse_id=$klasseid and rasse='$volk'");
                        $array7 = mysql_fetch_array($zeiger7);
                        $anzahl=$array7["total"];
                        if ($anzahl>=1) {
                        }else{
                            $file=$main_verzeichnis."daten/".$volk."/schiffe.txt";
                            $fp = fopen("$file","r");
                            if ($fp) {
                                $zaehler=0;
                                $schiff = array();
                                while (!feof ($fp)) {
                                    $buffer = fgets($fp, 4096);
                                    $schiff[$zaehler]=$buffer;
                                    $zaehler++;
                                }
                                fclose($fp);
                            }
                            for ($iks=0;$iks<$zaehler;$iks++) {
                                $schiffwert=explode(':',$schiff[$iks]);
                                if ($schiffwert[1]==$klasseid) {
                                    $schiffwert_laenge=strlen($schiffwert[0])+strlen($schiffwert[1])+strlen($schiffwert[2])+3;
                                    $sonstiges=substr($schiff[$iks],$schiffwert_laenge,strlen($schiff[$iks])-$schiffwert_laenge);
                                    $zeiger_temp2 = mysql_query("INSERT INTO $skrupel_konplaene (besitzer,spiel,rasse,klasse,klasse_id,techlevel,sonstiges) values ($p_besitzer,$spiel,'$volk','$schiffwert[0]','$schiffwert[1]',$schiffwert[2],'$sonstiges')");
                                    for($i9=1;$i9<11;$i9++){
                                        if(($beziehung[$p_besitzer][$i9]['status']==5)and($s_eigenschaften[$i9]['rasse']==$planet_rasse)and!($i9==$p_besitzer)){
                                            $zeiger8 = mysql_query("SELECT count(*) as total8 FROM $skrupel_konplaene where besitzer=$i9 and spiel=$spiel and klasse_id=$klasseid and rasse='$volk'");
                                            $array8 = mysql_fetch_array($zeiger7);
                                            $anzahl=$array8["total"];
                                            if ($anzahl==0){
                                                $zeiger_temp = mysql_query("INSERT INTO $skrupel_konplaene (besitzer,spiel,rasse,klasse,klasse_id,techlevel,sonstiges) values ($i9,$spiel,'$volk_8','$schiffwert[0]','$schiffwert[1]',$schiffwert[2],'$sonstiges')");
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                /////////////////////////////
                $native_fert_abwehr=intval(substr($native_fert,6,3))/100;
                if (($native_id>=1) and ($native_kol>1) and ($native_fert_abwehr>0)) {
                    $p_abwehr=round(($p_abwehr*$native_fert_abwehr)+0.5);
                }
                $energetik_stufe_2=round(sqrt($p_abwehr/2));
                $energetik_anzahl_2=round(sqrt(($p_abwehr+$p_sternenbasis_defense)/3));
                $hangar_anzahl_2=round(sqrt($p_abwehr));
                if ($p_sternenbasis==2) {$hangar_anzahl_2=$hangar_anzahl_2+5;}
                if ($energetik_stufe_2>10) {$energetik_stufe_2=10;}
                if ($energetik_anzahl_2>10) {$energetik_anzahl_2=10;}
                if ($hangar_anzahl_2>10) {$hangar_anzahl_2=10;}
                $energetik_schaden=$strahlenschaden["$energetik_stufe"];
                $projektile_schaden=$torpedoschaden["$projektile_stufe"];
                $energetik_schaden_2=$strahlenschaden["$energetik_stufe_2"];

                $aufzeichnung_energetik_1="";
                $aufzeichnung_energetik_2="";
                $aufzeichnung_projektile_1="";
                $aufzeichnung_projektile_2="";
                $aufzeichnung_hangar_1="";
                $aufzeichnung_hangar_2="";
                $aufzeichnung_schild_1="";
                $aufzeichnung_schild_2="";
                $aufzeichnung_schaden_1="";
                $aufzeichnung_schaden_2="";

                $schaden_2=0;

                while (($schaden<100) and ($schaden_2<$p_defense_gesamt) and (($p_abwehr>=1)||($p_sternenbasis==2))) {

                    for  ($r=1; $r<=10;$r++) {
                        //echo "<br><br>Phase $r<br><br>";
                        if  (($schaden<100) and ($schaden_2<$p_defense_gesamt)) {

                            if ($energetik_anzahl>=$r) {
                                $aufzeichnung_energetik_1_zusatz=1;
                                $schaden_2=$schaden_2+$energetik_schaden;
                            } else { $aufzeichnung_energetik_1_zusatz=0; }

                            if ($energetik_anzahl_2>=$r) {
                                $aufzeichnung_energetik_2_zusatz=1;
                                if ($schild>0) {
                                    $schild=$schild-($energetik_schaden_2*((80/$masse)+1));
                                    //echo "Laser 2 trifft Schild 1, Schild 1 = $schild<br>";
                                } else {
                                    $schaden=$schaden+($energetik_schaden_2*(80/($masse+1))*(80/($masse+1))+2);
                                    //echo "Laser 2 trifft Rumpf 1, Rumpf 1 = $schaden<br>";
                                }
                            } else { $aufzeichnung_energetik_2_zusatz=0; }

                            if (($projektile_anzahl>=$r) and ($projektile>=1)) {
                                $projektile=$projektile-1;
                                $zuzahl=mt_rand(1,100);
                                if ($zuzahl<(66+(6*$erfahrung))) {
                                    $schaden_2=$schaden_2+$projektile_schaden;
                                    $aufzeichnung_projektile_1_zusatz=1;
                                } else {
                                    //echo "Projektil 1 verfehlt<br>";
                                    $aufzeichnung_projektile_1_zusatz=2;
                                }
                            }  else { $aufzeichnung_projektile_1_zusatz=0; }

                            $aufzeichnung_projektile_2_zusatz=0;

                            if ($hangar_anzahl>=$r) {
                                $aufzeichnung_hangar_1_zusatz=1;
                                $schaden_2=$schaden_2+4;
                            }  else { $aufzeichnung_hangar_1_zusatz=0; }

                            if ($hangar_anzahl_2>=$r) {
                                $aufzeichnung_hangar_2_zusatz=1;
                                if ($schild>0) {
                                    $schild=$schild-4;
                                    //echo "Jaeger 2 trifft Schild 1, Schild 1 = $schild<br>";
                                } else {
                                    $schaden=$schaden+4;
                                    //echo "Jaeger 2 trifft Rumpf 1, Rumpf 1 = $schaden<br>";
                                }
                            } else { $aufzeichnung_hangar_2_zusatz=0; }
                            if (($aufzeichnung_energetik_1_zusatz>=1) or ($aufzeichnung_energetik_2_zusatz>=1) or
                                ($aufzeichnung_projektile_1_zusatz>=1) or ($aufzeichnung_projektile_2_zusatz>=1) or
                                ($aufzeichnung_hangar_1_zusatz>=1) or ($aufzeichnung_hangar_2_zusatz>=1))
                            {

                                $aufzeichnung_energetik_1=$aufzeichnung_energetik_1.$aufzeichnung_energetik_1_zusatz.":";
                                $aufzeichnung_energetik_2=$aufzeichnung_energetik_2.$aufzeichnung_energetik_2_zusatz.":";

                                $aufzeichnung_projektile_1=$aufzeichnung_projektile_1.$aufzeichnung_projektile_1_zusatz.":";
                                $aufzeichnung_projektile_2=$aufzeichnung_projektile_2.$aufzeichnung_projektile_2_zusatz.":";

                                $aufzeichnung_hangar_1=$aufzeichnung_hangar_1.$aufzeichnung_hangar_1_zusatz.":";
                                $aufzeichnung_hangar_2=$aufzeichnung_hangar_2.$aufzeichnung_hangar_2_zusatz.":";

                                if ($schild<0) { $schild=0; }
                                $schild_2=0;
                                if ($schaden>100) { $schaden=100; }
                                if ($schaden_2>$p_defense_gesamt) { $schaden_2=$p_defense_gesamt; }

                                $aufzeichnung_schild_1=$aufzeichnung_schild_1.round($schild).":";
                                $aufzeichnung_schild_2=$aufzeichnung_schild_2.round($schild_2).":";
                                $aufzeichnung_schaden_1=$aufzeichnung_schaden_1.round(100-$schaden).":";
                                $aufzeichnung_schaden_2=$aufzeichnung_schaden_2.round($p_defense_gesamt-$schaden_2).":";
                            }
                        }
                    }
                }
                if ($schaden>=100) {
                    if ((@file_exists($xstats_verzeichnis)) and (intval(substr($spiel_extend,2,1))==1)) {
                        xstats_shipVSPlanet( $spiel, $shid, $besitzer, $kox, $koy, $p_id, $p_besitzer, 1);
                    }                
                    $zeiger_temp = mysql_query("DELETE FROM $skrupel_schiffe where id=$shid and besitzer=$besitzer;");
                    $zeiger_temp = mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 's:$shid:%'");
                    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where (flug=3 or flug=4) and zielid=$shid");
                    $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set p_defense_gesamt=p_defense_gesamt-$schaden_2 where id=$p_id and besitzer=$p_besitzer;");
                    $schiffevernichtet++;

                    neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['orbitalkampf'][0],array($name,$p_name));
                    neuigkeiten(1,"../bilder/planeten/$p_klasse"."_"."$p_bild.jpg",$p_besitzer,$lang['host'][$spielersprache[$p_besitzer]]['orbitalkampf'][1],array($p_name,$name));

                }
                if ((($schaden<100) and ($schaden_2>=$p_defense_gesamt)) or ($p_abwehr==0)) {
                    $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set p_defense_gesamt=p_defense_gesamt-$schaden_2 where id=$p_id and besitzer=$p_besitzer;");
                    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set schaden=$schaden,schild=$schild,projektile=$projektile where id=$shid and besitzer=$besitzer;");
                    neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['host'][$spielersprache[$besitzer]]['orbitalkampf'][2],array($name,$p_name));
                    neuigkeiten(1,"../bilder/planeten/$p_klasse"."_"."$p_bild.jpg",$p_besitzer,$lang['host'][$spielersprache[$p_besitzer]]['orbitalkampf'][3],array($name,$p_name));
                }
            }
        }
    }
}
?>
