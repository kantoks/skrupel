<?php
if(count($sprachen) == 0) {
    include(LANGUAGEDIR.$language.'/lang.inc.host_raumkampf.php');
} else {
    foreach($sprachen as $sprache) {
        include(LANGUAGEDIR.$sprache.'/lang.inc.host_raumkampf.php');
    }
}

$zeiger = mysql_query("SELECT * FROM $skrupel_schiffe where spiel=$spiel order by aggro desc");
$schiffanzahl = mysql_num_rows($zeiger);

$checkstring=array();

if ($schiffanzahl>=1) {

    for ($i=0; $i<$schiffanzahl;$i++) {
        $ok = mysql_data_seek($zeiger,$i);
        $array = mysql_fetch_array($zeiger);

        $shid=$array["id"];
        //daten werden neu eingelesen, leider nicht ide beste loesung aktuell
        $fighting_ship_query = @mysql_query("SELECT * FROM $skrupel_schiffe where spiel=$spiel and id=$shid");
        if (@mysql_num_rows($fighting_ship_query) == 0) {
            continue;
        }
        $array = @mysql_fetch_array($fighting_ship_query); 
        
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
        $energetik_stufe=$array["energetik_stufe"];
        $energetik_anzahl=$array["energetik_anzahl"];
        $projektile_stufe=$array["projektile_stufe"];
        $projektile_anzahl=$array["projektile_anzahl"];
        $projektile=$array["projektile"];
        $hangar_anzahl=$array["hanger_anzahl"];
        $schild=$array["schild"];
        $schaden=$array["schaden"];
        $erfahrung=$array["erfahrung"];
        $techlevel=$array["techlevel"];
        $fertigkeiten=$array["fertigkeiten"];
        $klasseid=$array["klasseid"];
        $crew=$array["crew"];
        $crewmax=$array["crewmax"];
        $mission=$array["mission"];
        $zusatzmodul=$array["zusatzmodul"];
        $rennurbin = $array["fracht_min2"];
        $abstand=20;

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

        if (($erfahrung<5) and ($zusatzmodul==1)) { $erfahrung++; }
        if (($energetik_anzahl<10) and ($zusatzmodul==5)) { $energetik_anzahl++; }


        $spezialmission=$array["spezialmission"];

        $energetik_anzahl_alt=$energetik_anzahl;
        $hangar_anzahl_alt=$hangar_anzahl;
        $masse_alt=$masse;

        $maxunter=$energetik_anzahl;
        if ($projektile_anzahl>$maxunter) { $maxunter=$projektile_anzahl; }
        if ($hangar_anzahl>$maxunter) { $maxunter=$hangar_anzahl; }

        $klau=intval(substr($fertigkeiten,52,1));
        $luckyshot=intval(substr($fertigkeiten,55,1));
        $daempfer_fert=intval(substr($fertigkeiten,61,1));
        $kamikaze_erfolg=intval(substr($fertigkeiten,62,1))*10;
        $kamikaze_schaden=intval(substr($fertigkeiten,63,1))*100;

        if (!in_array($shid,$checkstring)) {

            $gemeinsam=0;
            $zeiger_temp = mysql_query("SELECT count(*) as gemeinsam FROM $skrupel_schiffe where kox=$kox and koy=$koy and id<>$shid and besitzer<>$besitzer and spiel=$spiel");
            $array_temp = mysql_fetch_array($zeiger_temp);
            $gemeinsam=$array_temp["gemeinsam"];

            if ($gemeinsam>=1) {

                $zeiger2 = mysql_query("SELECT * FROM $skrupel_schiffe where kox=$kox and koy=$koy and id<>$shid and besitzer<>$besitzer and spiel=$spiel order by aggro desc");

                for ($ihj=0; $ihj<$gemeinsam;$ihj++) {
                    $ok2 = mysql_data_seek($zeiger2,$ihj);


                    $array2 = mysql_fetch_array($zeiger2);
                    $shid_2=$array2["id"];
                    $besitzer_2=$array2["besitzer"];
                    $name_2=$array2["name"];
                    $energetik_stufe_2=$array2["energetik_stufe"];
                    $energetik_anzahl_2=$array2["energetik_anzahl"];
                    $projektile_stufe_2=$array2["projektile_stufe"];
                    $projektile_anzahl_2=$array2["projektile_anzahl"];
                    $hangar_anzahl_2=$array2["hanger_anzahl"];
                    $masse_2=$array2["masse"];
                    $volk_2=$array2["volk"];
                    $schild_2=$array2["schild"];
                    $schaden_2=$array2["schaden"];
                    $bild_gross_2=$array2["bild_gross"];
                    $bild_klein_2=$array2["bild_klein"];
                    $projektile_2=$array2["projektile"];
                    $erfahrung_2=$array2["erfahrung"];
                    $techlevel_2=$array2["techlevel"];
                    $fertigkeiten_2=$array2["fertigkeiten"];
                    $klasseid_2=$array2["klasseid"];
                    $crew_2=$array2["crew"];
                    $crewmax_2=$array2["crewmax"];
                    $spezialmission_2=$array2["spezialmission"];
                    $mission_2=$array2["mission"];
                    $zusatzmodul_2=$array2["zusatzmodul"];
                    $rennurbin_2 = $array2["fracht_min2"];


                    /////////beschaedigung der waffensysteme anfang
                    if ($schaden_2>50) {
                        $prozent = ($schaden_2-50)*2;
                        switch (mt_rand(1,3)) {
                            case 1:
                                if ($energetik_anzahl_2>=1) {
                                    $energetik_anzahl_2 -= round($energetik_anzahl_2/100*$prozent);
                                }
                                break;
                            case 2:
                                if ($projektile_anzahl_2>=1) {
                                    $projektile_anzahl_2 -= round($projektile_anzahl_2/100*$prozent);
                                }
                                break;
                            case 3:
                                if ($hangar_anzahl_2>=1) {
                                    $hangar_anzahl_2 -= round($hangar_anzahl_2/100*$prozent);
                                }
                                break;
                        }
                    }
                    /////////beschaedigung der waffensysteme ende

                    if (($erfahrung_2<5) and ($zusatzmodul_2==1)) { $erfahrung_2++; }
                    if (($energetik_anzahl_2<10) and ($zusatzmodul_2==5)) { $energetik_anzahl_2++; }

                    if ((!in_array($shid,$checkstring)) and (!in_array($shid_2,$checkstring))) {

                        $beideausweichen=0;
                        $ausweichen=0;
                        if ($module[3]==1) {
                            if (($mission==2) and ($mission_2==2)) {
                                $beideausweichen=1;
                            }
                            if ((($mission==2) and ($mission_2==0)) or (($mission==0) and ($mission_2==2))) {
                                $ausweichen=1;
                            }
                        }

                        if ($beideausweichen==1) {

                            ////////////////////////////////////////////////////


                            $alpha=(double)(6.28318530718*mt_rand(0,$mt_randmax)/$mt_randmax);
                            $koy_new=max(0,min($umfang,$koy+round($abstand*sin($alpha))));
                            $kox_new=max(0,min($umfang,$kox+round($abstand*cos($alpha))));

                            $sektork=sektor($kox_new,$koy_new);
                            $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set status=1,kox=$kox_new, koy=$koy_new where id=$shid and spiel=$spiel");
                            neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['hostraumkampf'][$spielersprache[$besitzer]][10],array($name,$sektork,$spielerfarbe[$besitzer_2],$name_2));

                            $alpha=(double)(6.28318530718*mt_rand(0,$mt_randmax)/$mt_randmax);
                            $koy_new=max(0,min($umfang,$koy+round($abstand*sin($alpha))));
                            $kox_new=max(0,min($umfang,$kox+round($abstand*cos($alpha))));

                            $sektork=sektor($kox_new,$koy_new);
                            $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set status=1,kox=$kox_new, koy=$koy_new where id=$shid_2 and spiel=$spiel");
                            neuigkeiten(2,"../daten/$volk_2/bilder_schiffe/$bild_gross_2",$besitzer_2,$lang['hostraumkampf'][$spielersprache[$besitzer_2]][10],array($name_2,$sektork,$spielerfarbe[$besitzer],$name));

                            $checkstring[]=$shid_2;
                            $checkstring[]=$shid;
                            break;

                            ////////////////////////////////////////////////////
                        }

                        if (($beideausweichen!=1) and ($beziehung[$besitzer][$besitzer_2]['status']!=3) and ($beziehung[$besitzer][$besitzer_2]['status']!=4) and ($beziehung[$besitzer][$besitzer_2]['status']!=5)) {

                            $maxunter_2=$energetik_anzahl_2;
                            if ($projektile_anzahl_2>$maxunter_2) { $maxunter_2=$projektile_anzahl_2; }
                            if ($hangar_anzahl_2>$maxunter_2) { $maxunter_2=$hangar_anzahl_2; }

                            $klau2=intval(substr($fertigkeiten_2,52,1));
                            $luckyshot2=intval(substr($fertigkeiten_2,55,1));
                            $daempfer_fert_2=intval(substr($fertigkeiten_2,61,1));
                            $kamikaze_erfolg_2=intval(substr($fertigkeiten_2,62,1))*10;
                            $kamikaze_schaden_2=intval(substr($fertigkeiten_2,63,1))*100;

                            $energetik_schaden=$strahlenschaden["$energetik_stufe"];
                            $energetik_schaden_2=$strahlenschaden["$energetik_stufe_2"];

                            $energetik_schaden_crew=$strahlenschadencrew["$energetik_stufe"];
                            $energetik_schaden_crew_2=$strahlenschadencrew["$energetik_stufe_2"];

                            $projektile_schaden=$torpedoschaden["$projektile_stufe"];
                            $projektile_schaden_2=$torpedoschaden["$projektile_stufe_2"];

                            $projektile_schaden_crew=$torpedoschadencrew["$projektile_stufe"];
                            $projektile_schaden_crew_2=$torpedoschadencrew["$projektile_stufe_2"];

                            if ($spezialmission==22) {
                                $energetik_schaden=round($energetik_schaden*0.5);
                                $energetik_schaden_crew=round($energetik_schaden_crew*1.25);
                                $projektile_schaden=round($projektile_schaden*0.5);
                                $projektile_schaden_crew=round($projektile_schaden_crew*1.25);
                            }
                            if ($spezialmission_2==22) {
                                $energetik_schaden_2=round($energetik_schaden_2*0.5);
                                $energetik_schaden_crew_2=round($energetik_schaden_crew_2*1.25);
                                $projektile_schaden_2=round($projektile_schaden_2*0.5);
                                $projektile_schaden_crew_2=round($projektile_schaden_crew_2*1.25);
                            }

                            $stat_schlacht[$besitzer]++;
                            $stat_schlacht[$besitzer_2]++;

                            if ($module[3]==1) {

                                $modulbonus=1.10;
                                $modulmalus=0.85;

                                if (($mission==1) and ($mission_2==0)) {
                                    $energetik_schaden=$energetik_schaden*$modulmalus;
                                    $energetik_schaden_crew=$energetik_schaden_crew*$modulmalus;
                                    $projektile_schaden=$projektile_schaden*$modulmalus;
                                    $projektile_schaden_crew=$projektile_schaden_crew*$modulmalus;
                                }
                                if (($mission==1) and ($mission_2==2)) {
                                    $energetik_schaden=$energetik_schaden*$modulbonus;
                                    $energetik_schaden_crew=$energetik_schaden_crew*$modulbonus;
                                    $projektile_schaden=$projektile_schaden*$modulbonus;
                                    $projektile_schaden_crew=$projektile_schaden_crew*$modulbonus;
                                }
                                if (($mission==0) and ($mission_2==1)) {
                                    $energetik_schaden_2=$energetik_schaden_2*$modulmalus;
                                    $energetik_schaden_crew_2=$energetik_schaden_crew_2*$modulmalus;
                                    $projektile_schaden_2=$projektile_schaden_2*$modulmalus;
                                    $projektile_schaden_crew_2=$projektile_schaden_crew_2*$modulmalus;
                                }
                                if (($mission==2) and ($mission_2==1)) {
                                    $energetik_schaden_2=$energetik_schaden_2*$modulbonus;
                                    $energetik_schaden_crew_2=$energetik_schaden_crew_2*$modulbonus;
                                    $projektile_schaden_2=$projektile_schaden_2*$modulbonus;
                                    $projektile_schaden_crew_2=$projektile_schaden_crew_2*$modulbonus;
                                }
                            }

                            //////////////////////////////////////////////////////////////////////////////////////Anfang Signaturscanner
                            $besitzer_rasse=$s_eigenschaften[$besitzer]['rasse'];
                            if (($klau==1) and ($besitzer_rasse!=$volk_2) and ($besitzer_rasse==$volk) ) {

                                //////////////////////////////////////////////////////////////////////////////////Flottenkuatoh

                                $zeiger8 = mysql_query("SELECT * FROM $skrupel_schiffe where besitzer<>$besitzer and spiel=$spiel and kox=$kox and koy=$koy and volk<>'unknown'");
                                $schiffanzahl8 = mysql_num_rows($zeiger8);
                                if($schiffanzahl8>=1){
                                    for($i8=0;$i8<$schiffanzahl8;$i8++){
                                        $ok8 = mysql_data_seek($zeiger8,$i8);
                                        $array7 = mysql_fetch_array($zeiger8);
                                        $klasseid_8=$array7["klasseid"];
                                        $volk_8=$array7["volk"];
                                        $anzahl=0;
                                        $zeiger7 = mysql_query("SELECT count(*) as total FROM $skrupel_konplaene where besitzer=$besitzer and spiel=$spiel and klasse_id=$klasseid_8 and rasse='$volk_8'");
                                        $array7 = mysql_fetch_array($zeiger7);
                                        $anzahl=$array7["total"];
                                        if ($anzahl>=1) {} else {
                                            $file=$main_verzeichnis."daten/".$volk_8."/schiffe.txt";
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
                                                if ($schiffwert[1]==$klasseid_8) {
                                                    $schiffwert_laenge=strlen($schiffwert[0])+strlen($schiffwert[1])+strlen($schiffwert[2])+3;
                                                    $sonstiges=substr($schiff[$iks],$schiffwert_laenge,strlen($schiff[$iks])-$schiffwert_laenge);
                                                    $zeiger_temp = mysql_query("INSERT INTO $skrupel_konplaene (besitzer,spiel,rasse,klasse,klasse_id,techlevel,sonstiges) values ($besitzer,$spiel,'$volk_8','$schiffwert[0]','$schiffwert[1]',$schiffwert[2],'$sonstiges')");

                                                    ///////////////////////////////////////////////////////Anfang Allianzkuatoh

                                                    for($i9=1;$i9<11;$i9++){
                                                        if(($beziehung[$besitzer][$i9]['status']==5)and($s_eigenschaften[$i9]['rasse']==$volk)and!($i9==$besitzer)){
                                                            $zeiger8 = mysql_query("SELECT count(*) as total8 FROM $skrupel_konplaene where besitzer=$i9 and spiel=$spiel and klasse_id=$klasseid_8 and rasse='$volk_8'");
                                                            $array8 = mysql_fetch_array($zeiger7);
                                                            $anzahl=$array8["total"];
                                                            if ($anzahl==0){
                                                                $zeiger_temp = mysql_query("INSERT INTO $skrupel_konplaene (besitzer,spiel,rasse,klasse,klasse_id,techlevel,sonstiges) values ($i9,$spiel,'$volk_8','$schiffwert[0]','$schiffwert[1]',$schiffwert[2],'$sonstiges')");
                                                            }
                                                        }
                                                    }
                                                    ///////////////////////////////////////////////////////Ende Allianzkuatoh
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            //////////////////////////////////////////////////////////////////////////////////////
                            $besitzer_2_rasse=$s_eigenschaften[$besitzer_2]['rasse'];
                            if (($klau2==1) and ($besitzer_2_rasse!=$volk) and ($besitzer_2_rasse==$volk_2) ) {

                                //////////////////////////////////////////////////////////////////////////////////Flottenkuatoh

                                $zeiger8 = mysql_query("SELECT * FROM $skrupel_schiffe where besitzer<>$besitzer_2 and spiel=$spiel and kox=$kox and koy=$koy and volk<>'unknown'");
                                $schiffanzahl8 = mysql_num_rows($zeiger8);
                                if($schiffanzahl8>=1){
                                    for($i8=0;$i8<$schiffanzahl8;$i8++){
                                        $ok8 = mysql_data_seek($zeiger8,$i8);
                                        $array7 = mysql_fetch_array($zeiger8);
                                        $klasseid_8=$array7["klasseid"];
                                        $volk_8=$array7["volk"];
                                        $anzahl=0;
                                        $zeiger7 = mysql_query("SELECT count(*) as total FROM $skrupel_konplaene where besitzer=$besitzer_2 and spiel=$spiel and klasse_id=$klasseid_8 and rasse='$volk_8'");
                                        $array7 = mysql_fetch_array($zeiger7);
                                        $anzahl=$array7["total"];
                                        if ($anzahl>=1) {} else {
                                            $file=$main_verzeichnis."daten/".$volk_8."/schiffe.txt";
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
                                                if ($schiffwert[1]==$klasseid_8) {
                                                    $schiffwert_laenge=strlen($schiffwert[0])+strlen($schiffwert[1])+strlen($schiffwert[2])+3;
                                                    $sonstiges=substr($schiff[$iks],$schiffwert_laenge,strlen($schiff[$iks])-$schiffwert_laenge);
                                                    $zeiger_temp = mysql_query("INSERT INTO $skrupel_konplaene (besitzer,spiel,rasse,klasse,klasse_id,techlevel,sonstiges) values ($besitzer_2,$spiel,'$volk_8','$schiffwert[0]','$schiffwert[1]',$schiffwert[2],'$sonstiges')");

                                                    ///////////////////////////////////////////////////////Anfang Allianzkuatoh

                                                    for($i9=1;$i9<11;$i9++){
                                                        if(($beziehung[$besitzer_2][$i9]['status']==5)and($s_eigenschaften[$i9]['rasse']==$volk_2)and!($i9==$besitzer_2)){
                                                            $zeiger8 = mysql_query("SELECT count(*) as total8 FROM $skrupel_konplaene where besitzer=$i9 and spiel=$spiel and klasse_id=$klasseid_8 and rasse='$volk_8'");
                                                            $array8 = mysql_fetch_array($zeiger7);
                                                            $anzahl=$array8["total"];
                                                            if ($anzahl==0){
                                                                $zeiger_temp = mysql_query("INSERT INTO $skrupel_konplaene (besitzer,spiel,rasse,klasse,klasse_id,techlevel,sonstiges) values ($i9,$spiel,'$volk_8','$schiffwert[0]','$schiffwert[1]',$schiffwert[2],'$sonstiges')");
                                                            }
                                                        }
                                                    }
                                                    ///////////////////////////////////////////////////////Ende Allianzkuatoh
                                                }
                                            }
                                        }
                                    }
                                }
                            }

                            //////////////////////////////////////////////////////////////////////////////////////Ende Signaturscanner

                            $kampf_findet_statt=1;
                            $datum=time();
                            $sektork=sektor($kox,$koy);

                            //////////////////////////////////////////////////////////////////////////////////////luckyshot

                            if ($luckyshot>=1) {
                                $luck=$luckyshot+$erfahrung;
                                $temp=mt_rand(1,100);
                                if ($temp<=$luck) {

                                    $checkstring[]=$shid_2;
                                    $kampf_findet_statt=0;

                                    $zeiger_temp = mysql_query("DELETE FROM $skrupel_schiffe where id=$shid_2 and besitzer=$besitzer_2;");
                                    $zeiger_temp = mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 's:$shid_2:%'");
                                    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where (flug=3 or flug=4) and zielid=$shid_2");

                                    $schiffevernichtet++;
                                    $stat_schlacht_sieg[$besitzer]++;

                                    neuigkeiten(2,"../daten/$volk_2/bilder_schiffe/$bild_gross_2",$besitzer_2,$lang['hostraumkampf'][$spielersprache[$besitzer_2]][0],array($name_2,$sektork,$spielerfarbe[$besitzer],$name));
                                    neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['hostraumkampf'][$spielersprache[$besitzer]][1],array($name,$sektork,$spielerfarbe[$besitzer_2],$name_2));

                                }
                            }
                            if ($luckyshot2>=1) {
                                $luck=$luckyshot2+$erfahrung_2;
                                $temp=mt_rand(1,100);
                                if ($temp<=$luck) {

                                    $checkstring[]=$shid;
                                    $kampf_findet_statt=0;

                                    $zeiger_temp = mysql_query("DELETE FROM $skrupel_schiffe where id=$shid and besitzer=$besitzer;");
                                    $zeiger_temp = mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 's:$shid:%'");
                                    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where (flug=3 or flug=4) and zielid=$shid");

                                    $schiffevernichtet++;
                                    $stat_schlacht_sieg[$besitzer_2]++;

                                    neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['hostraumkampf'][$spielersprache[$besitzer]][0],array($name,$sektork,$spielerfarbe[$besitzer],$name_2));
                                    neuigkeiten(2,"../daten/$volk_2/bilder_schiffe/$bild_gross_2",$besitzer_2,$lang['hostraumkampf'][$spielersprache[$besitzer_2]][1],array($name_2,$sektork,$spielerfarbe[$besitzer],$name));

                                }
                            }

                            //////////////////////////////////////////////////////////////////////////////////////

                            if ($kampf_findet_statt==1) {

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
                                $aufzeichnung_crew_1="$crewmax:";
                                $aufzeichnung_crew_2="$crewmax_2:";

                                $kamikaze = false;
                                $kamikaze_2 = false;

                                $freunde=0;
                                $maxunterhalb=round($maxunter/2);
                                $mintechlevel=$techlevel-2;if ($mintechlevel<1) {$mintechlevel=1;}
                                $zeiger_temp = mysql_query("SELECT count(*) as freunde FROM $skrupel_schiffe where (energetik_anzahl>=$maxunterhalb or projektile_anzahl>=$maxunterhalb or hanger_anzahl>=$maxunterhalb) and techlevel>=$mintechlevel and kox=$kox and koy=$koy and besitzer=$besitzer and spiel=$spiel");
                                $array_temp = mysql_fetch_array($zeiger_temp);
                                $freunde=$array_temp["freunde"];

                                if ($freunde>$maxunter) {$freunde=$maxunter;}

                                $feinde=0;
                                $maxunterhalb_2=round($maxunter_2/2);
                                $mintechlevel_2=$techlevel_2-2;if ($mintechlevel_2<1) {$mintechlevel_2=1;}
                                $zeiger_temp = mysql_query("SELECT count(*) as feinde FROM $skrupel_schiffe where (energetik_anzahl>=$maxunterhalb_2 or projektile_anzahl>=$maxunterhalb_2 or hanger_anzahl>=$maxunterhalb_2) and techlevel>=$mintechlevel_2 and kox=$kox and koy=$koy and besitzer=$besitzer_2 and spiel=$spiel");
                                $array_temp = mysql_fetch_array($zeiger_temp);
                                $feinde=$array_temp["feinde"];

                                if ($feinde>$maxunter_2) {$feinde=$maxunter_2;}

                                $freunde=$freunde+$erfahrung;
                                $feinde=$feinde+$erfahrung_2;

                                $gemeinsamm=0;
                                $zeiger_temp33 = mysql_query("SELECT count(*) as gemeinsamm FROM $skrupel_schiffe where kox=$kox and koy=$koy and id<>$shid and besitzer=$besitzer and fertigkeiten like '___________________________________________________________1%' and spiel=$spiel");
                                $array_temp33 = mysql_fetch_array($zeiger_temp33);
                                $gemeinsamm=$array_temp33["gemeinsamm"];

                                if ($gemeinsamm>=1) { $freunde++; }

                                $gemeinsamm=0;
                                $zeiger_temp33 = mysql_query("SELECT count(*) as gemeinsamm FROM $skrupel_schiffe where kox=$kox and koy=$koy and id<>$shid_2 and besitzer=$besitzer_2 and fertigkeiten like '___________________________________________________________1%' and spiel=$spiel");
                                $array_temp33 = mysql_fetch_array($zeiger_temp33);
                                $gemeinsamm=$array_temp33["gemeinsamm"];

                                if ($gemeinsamm>=1) { $feinde++; }

                                $waffenlos=0;

                                if (($energetik_anzahl==0) and ($energetik_anzahl_2==0) and ($projektile_anzahl==0) and ($projektile_anzahl_2==0) and ($hangar_anzahl==0) and ($hangar_anzahl_2==0)) {
                                    $waffenlos=1;
                                    if ($masse==$masse_2) { $schaden=100;$schaden_2=100; }
                                    if ($masse>$masse_2) {
                                        $schaden=round($masse_2/($masse/100));
                                        $schild=0;
                                        $schaden_2=100;
                                    }
                                    if ($masse_2>$masse) {
                                        $schaden_2=round($masse/($masse_2/100));
                                        $schild_2=0;
                                        $schaden=100;
                                    }
                                } else {

                                    /////////////////////////////////////////////////////////////////////////////////////daempfer

                                    $daempfer_an1 = false;
                                    $daempfer_an2 = false;
                                    if($daempfer_fert>=1 && $spezialmission==71 && $rennurbin>=round($masse_2/100*$daempfer_fert) && $schild_2>0) {
                                        $rennurbin -= round($masse_2/100*$daempfer_fert);
                                        mysql_query("UPDATE $skrupel_schiffe set fracht_min2=$rennurbin where id=$shid");
                                        $daempfer_an1 = true;
                                    }
                                    if($daempfer_fert_2>=1 && $spezialmission_2==71 && $rennurbin_2>=round($masse/100*$daempfer_fert_2) && $schild>0) {
                                        $rennurbin_2 -= round($masse/100*$daempfer_fert_2);
                                        mysql_query("UPDATE $skrupel_schiffe set fracht_min2=$rennurbin_2 where id=$shid_2");
                                        $daempfer_an2 = true;
                                    }

                                    //////////////////////////////////////////////////////////////////////////////////////

                                    if ($freunde>$feinde) {
                                        $vorteil=$freunde-$feinde;
                                        $energetik_anzahl=$energetik_anzahl+$vorteil;
                                        if ($energetik_anzahl==$vorteil) {$energetik_schaden=$strahlenschaden["1"];}
                                        if ($energetik_anzahl>10) {
                                            $vorteil=$energetik_anzahl-10;
                                            $energetik_anzahl=10;
                                            $hangar_anzahl=$hangar_anzahl+$vorteil;
                                            if ($hangar_anzahl>10) {
                                                $vorteil=$hangar_anzahl-10;
                                                $hangar_anzahl=10;
                                                $masse=$masse+($vorteil*100);
                                                if ($masse>1000) {$masse=1000;}
                                            }
                                        }
                                    }

                                    if ($feinde>$freunde) {
                                        $vorteil=$feinde-$freunde;
                                        $energetik_anzahl_2=$energetik_anzahl_2+$vorteil;
                                        if ($energetik_anzahl_2==$vorteil) {$energetik_schaden_2=$strahlenschaden["1"];}
                                        if ($energetik_anzahl_2>10) {
                                            $vorteil=$energetik_anzahl_2-10;
                                            $energetik_anzahl_2=10;
                                            $hangar_anzahl_2=$hangar_anzahl_2+$vorteil;
                                            if ($hangar_anzahl_2>10) {
                                                $vorteil=$hangar_anzahl_2-10;
                                                $hangar_anzahl_2=10;
                                                $masse_2=$masse_2+($vorteil*100);
                                                if ($masse_2>1000) {$masse_2=1000;}
                                            }
                                        }
                                    }

                                    ////////////////////////////////////////////////////////////////////////////Kampf Anfang

                                    while (($schaden<100) and ($schaden_2<100) and ($crew>0) and ($crew_2>0)) {

                                        /////////////////////////////////////////////////////////////////////////////////////kamikaze

                                        if($kamikaze_erfolg>0 && $kamikaze_schaden>0 && $kamikaze_erfolg_2==0) {
                                            if(mt_rand(1,100) <= $kamikaze_erfolg) {
                                                $schaden = 100;
                                                $schild_2 = 0;
                                                $schaden_2 += ($kamikaze_schaden*(80/($masse_2+1))*(80/($masse_2+1))+2);
                                                $kamikaze = true;
                                            }
                                        } elseif($kamikaze_erfolg_2>0 && $kamikaze_schaden_2>0 && $kamikaze_erfolg==0) {
                                            if(mt_rand(1,100) <= $kamikaze_erfolg_2) {
                                                $schaden_2 = 100;
                                                $schild = 0;
                                                $schaden += ($kamikaze_schaden_2*(80/($masse+1))*(80/($masse+1))+2);
                                                $kamikaze_2 = true;
                                            }
                                        } elseif($kamikaze_erfolg>0 && $kamikaze_schaden>0 && $kamikaze_erfolg_2>0 && $kamikaze_schaden_2>0) {
                                            $schaden = 100;
                                            $schaden_2 = 100;
                                            $kamikaze = true;
                                            $kamikaze_2 = true;
                                        }

                                        /////////////////////////////////////////////////////////////////////////////////////

                                        for ($r=1; $r<=10;$r++) {

                                            //echo "<br><br>Phase $r<br><br>";

                                            if (($schaden<100) and ($schaden_2<100) and ($crew>0) and ($crew_2>0)) {

                                                ////////////////////////////////////////////////////////////////Energetik Spieler 1

                                                if ($energetik_anzahl>=$r) {
                                                    $aufzeichnung_energetik_1_zusatz=1;
                                                    if ($schild_2>0 && !$daempfer_an1) {
                                                        $schild_2=$schild_2-($energetik_schaden*((80/$masse_2)+1));

                                                        //echo "Laser 1 trifft Schild 2, Schild 2 = $schild_2<br>";

                                                    } else {

                                                        $schaden_2=$schaden_2+($energetik_schaden*(80/($masse_2+1))*(80/($masse_2+1))+2);
                                                        $schaden_2_crew=($energetik_schaden_crew*(80/($masse_2+1))*(80/($masse_2+1))+2);
                                                        $crew_2=$crew_2-floor($crewmax_2*$schaden_2_crew/100);

                                                        //echo "Laser 1 trifft Rumpf 2, Rumpf 2 = $schaden_2<br>";

                                                    }
                                                } else { $aufzeichnung_energetik_1_zusatz=0; }

                                                ////////////////////////////////////////////////////////////////Energetik Spieler 2

                                                if ($energetik_anzahl_2>=$r) {
                                                    $aufzeichnung_energetik_2_zusatz=1;
                                                    if ($schild>0 && !$daempfer_an2) {
                                                        $schild=$schild-($energetik_schaden_2*((80/$masse)+1));

                                                        //echo "Laser 2 trifft Schild 1, Schild 1 = $schild<br>";

                                                    } else {
                                                        $schaden=$schaden+($energetik_schaden_2*(80/($masse+1))*(80/($masse+1))+2);
                                                        $schaden_crew=($energetik_schaden_crew_2*(80/($masse+1))*(80/($masse+1))+2);
                                                        $crew=$crew-floor($crewmax*$schaden_crew/100);

                                                        //echo "Laser 2 trifft Rumpf 1, Rumpf 1 = $schaden<br>";

                                                    }
                                                } else { $aufzeichnung_energetik_2_zusatz=0; }

                                                ////////////////////////////////////////////////////////////////Projektile Spieler 1

                                                if (($projektile_anzahl>=$r) and ($projektile>=1)) {
                                                    $projektile=$projektile-1;
                                                    if ($schild_2>0 && !$daempfer_an1) {
                                                        $zuzahl=mt_rand(1,100);
                                                        if ($zuzahl<(66+(6*$erfahrung))) {
                                                            $schild_2=$schild_2-($projektile_schaden*((80/$masse_2)+1));
                                                            $aufzeichnung_projektile_1_zusatz=1;

                                                            //echo "Projektil 1 trifft<br>Projektil 1 trifft Schild 2, Schild 2 = $schild_2<br>";

                                                        } else {

                                                            //echo "Projektil 1 verfehlt<br>";

                                                            $aufzeichnung_projektile_1_zusatz=2;
                                                        }
                                                    } else {
                                                        $zuzahl=mt_rand(1,100);
                                                        if ($zuzahl<(66+(6*$erfahrung))) {
                                                            $schaden_2=$schaden_2+($projektile_schaden*(80/($masse_2+1))*(80/($masse_2+1))+2);
                                                            $aufzeichnung_projektile_1_zusatz=1;
                                                            $schaden_2_crew=($projektile_schaden_crew*(80/($masse_2+1))*(80/($masse_2+1))+2);
                                                            $crew_2=$crew_2-floor($crewmax_2*$schaden_2_crew/100);

                                                            //echo "Projektil 1 trifft<br>Projektil 1 trifft Rumpf 2, Rumpf 2 = $schaden_2<br>";

                                                        } else {

                                                            //echo "Projektil 1 verfehlt<br>";

                                                            $aufzeichnung_projektile_1_zusatz=2;
                                                        }
                                                    }
                                                } else { $aufzeichnung_projektile_1_zusatz=0; }

                                                ////////////////////////////////////////////////////////////////Projektile Spieler 2

                                                if (($projektile_anzahl_2>=$r) and ($projektile_2>=1)) {
                                                    $projektile_2=$projektile_2-1;
                                                    if ($schild>0 && !$daempfer_an2) {
                                                        $zuzahl=mt_rand(1,100);
                                                        if ($zuzahl<(66+(6*$erfahrung_2))) {
                                                            $schild=$schild-($projektile_schaden_2*((80/$masse)+1));
                                                            $aufzeichnung_projektile_2_zusatz=1;

                                                            //echo "Projektil 2 trifft<br>Projektil 2 trifft Schild 1, Schild 1 = $schild<br>";

                                                        } else {

                                                            //echo "Projektil 2 verfehlt<br>";

                                                            $aufzeichnung_projektile_2_zusatz=2;
                                                        }
                                                    } else {
                                                        $zuzahl=mt_rand(1,100);
                                                        if ($zuzahl<(66+(6*$erfahrung_2))) {
                                                            $schaden=$schaden+($projektile_schaden_2*(80/($masse+1))*(80/($masse+1))+2);
                                                            $aufzeichnung_projektile_2_zusatz=1;
                                                            $schaden_crew=($projektile_schaden_crew_2*(80/($masse+1))*(80/($masse+1))+2);
                                                            $crew=$crew-floor($crewmax*$schaden_crew/100);

                                                            //echo "Projektil 2 trifft<br>Projektil 2 trifft Rumpf 1, Rumpf 1 = $schaden<br>";

                                                        } else {

                                                            //echo "Projektil 2 verfehlt<br>";

                                                            $aufzeichnung_projektile_2_zusatz=2;
                                                        }
                                                    }
                                                } else { $aufzeichnung_projektile_2_zusatz=0; }

                                                ////////////////////////////////////////////////////////////////Hangar Spieler 1

                                                if ($hangar_anzahl>=$r) {
                                                    $aufzeichnung_hangar_1_zusatz=1;
                                                    if ($schild_2>0 && !$daempfer_an1) {
                                                        $schild_2=$schild_2-4;

                                                        //echo "J�ger 1 trifft Schild 2, Schild 2 = $schild_2<br>";

                                                    } else {
                                                        $schaden_2=$schaden_2+4;
                                                        $crew_2=$crew_2-floor($crewmax_2*1.5/100);

                                                        //echo "J�ger 1 trifft Rumpf 2, Rumpf 2 = $schaden_2<br>";
                                                    }
                                                } else { $aufzeichnung_hangar_1_zusatz=0; }

                                                ////////////////////////////////////////////////////////////////Hangar Spieler 2

                                                if ($hangar_anzahl_2>=$r) {
                                                    $aufzeichnung_hangar_2_zusatz=1;
                                                    if ($schild>0 && !$daempfer_an2) {
                                                        $schild=$schild-4;

                                                        //echo "J�ger 2 trifft Schild 1, Schild 1 = $schild<br>";

                                                    } else {
                                                        $schaden=$schaden+4;
                                                        $crew=$crew-floor($crewmax*1.5/100);

                                                        //echo "J�ger 2 trifft Rumpf 1, Rumpf 1 = $schaden<br>";
                                                    }
                                                } else { $aufzeichnung_hangar_2_zusatz=0; }


                                                if (($aufzeichnung_energetik_1_zusatz>=1) or ($aufzeichnung_energetik_2_zusatz>=1) or
                                                    ($aufzeichnung_projektile_1_zusatz>=1) or ($aufzeichnung_projektile_2_zusatz>=1) or
                                                    ($aufzeichnung_hangar_1_zusatz>=1) or ($aufzeichnung_hangar_2_zusatz>=1)) {


                                                    $aufzeichnung_energetik_1=$aufzeichnung_energetik_1.$aufzeichnung_energetik_1_zusatz.":";
                                                    $aufzeichnung_energetik_2=$aufzeichnung_energetik_2.$aufzeichnung_energetik_2_zusatz.":";

                                                    $aufzeichnung_projektile_1=$aufzeichnung_projektile_1.$aufzeichnung_projektile_1_zusatz.":";
                                                    $aufzeichnung_projektile_2=$aufzeichnung_projektile_2.$aufzeichnung_projektile_2_zusatz.":";

                                                    $aufzeichnung_hangar_1=$aufzeichnung_hangar_1.$aufzeichnung_hangar_1_zusatz.":";
                                                    $aufzeichnung_hangar_2=$aufzeichnung_hangar_2.$aufzeichnung_hangar_2_zusatz.":";

                                                    if ($crew<0) { $crew=0; }
                                                    if ($crew_2<0) { $crew_2=0; }
                                                    if ($schild<0) { $schild=0; }
                                                    if ($schild_2<0) { $schild_2=0; }
                                                    if ($schaden>100) { $schaden=100; }
                                                    if ($schaden_2>100) { $schaden_2=100; }

                                                    $aufzeichnung_schild_1=$aufzeichnung_schild_1.round($schild).":";
                                                    $aufzeichnung_schild_2=$aufzeichnung_schild_2.round($schild_2).":";
                                                    $aufzeichnung_schaden_1=$aufzeichnung_schaden_1.round(100-$schaden).":";
                                                    $aufzeichnung_schaden_2=$aufzeichnung_schaden_2.round(100-$schaden_2).":";
                                                    $aufzeichnung_crew_1=$aufzeichnung_crew_1.$crew.":";
                                                    $aufzeichnung_crew_2=$aufzeichnung_crew_2.$crew_2.":";
                                                }
                                            }
                                        }
                                        if (($module[3]==1) and ($ausweichen==1)) { break; }
                                    }
                                    ///////////////////////////////////////////////////////////////////////////////Kampf Ende
                                }

                                /////////////////////////////////////////Selbstzerstoerung Anfang

                                if (($schaden_2<100) and ($schaden<100) and ($crew_2<=0) and ($zusatzmodul_2==7)) {
                                    $zufall=mt_rand(1,4);
                                    if ($zufall==1) {
                                        $schaden_2=100;
                                    }
                                }
                                if (($schaden_2<100) and ($schaden<100) and ($crew<=0) and ($zusatzmodul==7)) {
                                    $zufall=mt_rand(1,4);
                                    if ($zufall==1) {
                                        $schaden=100;
                                    }
                                }

                                /////////////////////////////////////////Selbstzerstoerung Ende

                                if (($schaden>=100) and ($schaden_2<100)) {
                                    $checkstring[]=$shid;
                                    $crew_2=($crew_2>0)?$crew_2:0;
                                    $zeiger_temp = mysql_query("DELETE FROM $skrupel_schiffe where id=$shid and besitzer=$besitzer;");
                                    $zeiger_temp = mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 's:$shid:%'");
                                    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where (flug=3 or flug=4) and zielid=$shid");
                                    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set crew=$crew_2,schaden=$schaden_2,schild=$schild_2,projektile=$projektile_2 where id=$shid_2 and besitzer=$besitzer_2;");

                                    if ($techlevel>=$techlevel_2) { $faktor=10; } else { $faktor=5; }
                                    $tech_unterschied=(($techlevel-$techlevel_2)*$faktor)+50;
                                    $zufall=mt_rand(1,100);
                                    if ($zufall>=$tech_unterschied) {
                                        $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set erfahrung=erfahrung+1 where erfahrung<5 and spiel=$spiel and id=$shid_2 and besitzer=$besitzer_2");
                                    }

                                    $schiffevernichtet++;
                                    $stat_schlacht_sieg[$besitzer_2]++;

                                    if($kamikaze==true) {
                                        neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['hostraumkampf'][$spielersprache[$besitzer]][12],array($name,$sektork,$spielerfarbe[$besitzer_2],$name_2));
                                        neuigkeiten(2,"../daten/$volk_2/bilder_schiffe/$bild_gross_2",$besitzer_2,$lang['hostraumkampf'][$spielersprache[$besitzer_2]][13],array($name_2,$sektork,$spielerfarbe[$besitzer],$name));
                                    } elseif ($waffenlos==0) {
                                        $zeiger_temp = mysql_query("INSERT INTO $skrupel_kampf (spiel,art,schiff_id_1,schiff_id_2,name_1,name_2,rasse_1,rasse_2,bild_1,bild_2,datum,energetik_1,energetik_2,projektile_1,projektile_2,hangar_1,hangar_2,schild_1,schild_2,schaden_1,schaden_2,crew_1,crew_2) values ($spiel,1,$shid,$shid_2,'$name','$name_2','$volk','$volk_2','$bild_klein','$bild_klein_2','$datum','$aufzeichnung_energetik_1','$aufzeichnung_energetik_2','$aufzeichnung_projektile_1','$aufzeichnung_projektile_2','$aufzeichnung_hangar_1','$aufzeichnung_hangar_2','$aufzeichnung_schild_1','$aufzeichnung_schild_2','$aufzeichnung_schaden_1','$aufzeichnung_schaden_2','$aufzeichnung_crew_1','$aufzeichnung_crew_2');");
                                        neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['hostraumkampf'][$spielersprache[$besitzer]][4],array($name,$sektork,$spielerfarbe[$besitzer_2],$name_2,$shid,$shid_2,$datum));
                                        neuigkeiten(2,"../daten/$volk_2/bilder_schiffe/$bild_gross_2",$besitzer_2,$lang['hostraumkampf'][$spielersprache[$besitzer_2]][5],array($name_2,$sektork,$spielerfarbe[$besitzer],$name,$shid,$shid_2,$datum));
                                    } else {
                                        neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['hostraumkampf'][$spielersprache[$besitzer]][6],array($name,$sektork,$spielerfarbe[$besitzer_2],$name_2));
                                        neuigkeiten(2,"../daten/$volk_2/bilder_schiffe/$bild_gross_2",$besitzer_2,$lang['hostraumkampf'][$spielersprache[$besitzer_2]][7],array($name_2,$sektork,$spielerfarbe[$besitzer],$name));
                                    }
                                    break;
                                }
                                if (($schaden_2>=100) and ($schaden<100)) {
                                    $crew=($crew>0)?$crew:0;
                                    $checkstring[]=$shid_2;
                                    $zeiger_temp = mysql_query("DELETE FROM $skrupel_schiffe where id=$shid_2 and besitzer=$besitzer_2;");
                                    $zeiger_temp = mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 's:$shid_2:%'");
                                    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where (flug=3 or flug=4) and zielid=$shid_2");
                                    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set crew=$crew,schaden=$schaden,schild=$schild,projektile=$projektile where id=$shid and besitzer=$besitzer;");

                                    if ($techlevel_2>=$techlevel) { $faktor=10; } else { $faktor=5; }
                                    $tech_unterschied=(($techlevel_2-$techlevel)*$faktor)+50;
                                    $zufall=mt_rand(1,100);
                                    if ($zufall>=$tech_unterschied) {
                                        $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set erfahrung=erfahrung+1 where erfahrung<5 and spiel=$spiel and id=$shid and besitzer=$besitzer");
                                    }

                                    $schiffevernichtet++;
                                    $stat_schlacht_sieg[$besitzer]++;

                                    if($kamikaze_2==true) {
                                        neuigkeiten(2,"../daten/$volk_2/bilder_schiffe/$bild_gross_2",$besitzer_2,$lang['hostraumkampf'][$spielersprache[$besitzer_2]][12],array($name_2,$sektork,$spielerfarbe[$besitzer],$name));
                                        neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['hostraumkampf'][$spielersprache[$besitzer]][13],array($name,$sektork,$spielerfarbe[$besitzer_2],$name_2));
                                    } elseif ($waffenlos==0) {
                                        $zeiger_temp = mysql_query("INSERT INTO $skrupel_kampf (spiel,art,schiff_id_1,schiff_id_2,name_1,name_2,rasse_1,rasse_2,bild_1,bild_2,datum,energetik_1,energetik_2,projektile_1,projektile_2,hangar_1,hangar_2,schild_1,schild_2,schaden_1,schaden_2,crew_1,crew_2) values ($spiel,1,$shid,$shid_2,'$name','$name_2','$volk','$volk_2','$bild_klein','$bild_klein_2','$datum','$aufzeichnung_energetik_1','$aufzeichnung_energetik_2','$aufzeichnung_projektile_1','$aufzeichnung_projektile_2','$aufzeichnung_hangar_1','$aufzeichnung_hangar_2','$aufzeichnung_schild_1','$aufzeichnung_schild_2','$aufzeichnung_schaden_1','$aufzeichnung_schaden_2','$aufzeichnung_crew_1','$aufzeichnung_crew_2');");
                                        neuigkeiten(2,"../daten/$volk_2/bilder_schiffe/$bild_gross_2",$besitzer_2,$lang['hostraumkampf'][$spielersprache[$besitzer_2]][4],array($name_2,$sektork,$spielerfarbe[$besitzer],$name,$shid,$shid_2,$datum));
                                        neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['hostraumkampf'][$spielersprache[$besitzer]][5],array($name,$sektork,$spielerfarbe[$besitzer_2],$name_2,$shid,$shid_2,$datum));
                                    } else {
                                        neuigkeiten(2,"../daten/$volk_2/bilder_schiffe/$bild_gross_2",$besitzer_2,$lang['hostraumkampf'][$spielersprache[$besitzer_2]][6],array($name_2,$sektork,$spielerfarbe[$besitzer],$name));
                                        neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['hostraumkampf'][$spielersprache[$besitzer]][7],array($name,$sektork,$spielerfarbe[$besitzer_2],$name_2));
                                    }
                                    //break;
                                }

                                if ((($schaden_2>=100) and ($schaden>=100)) or (($crew_2<=0) and ($crew<=0))) {
                                    $checkstring[]=$shid;
                                    $checkstring[]=$shid_2;
                                    $zeiger_temp = mysql_query("DELETE FROM $skrupel_schiffe where id=$shid_2 and besitzer=$besitzer_2;");
                                    $zeiger_temp = mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 's:$shid_2:%'");
                                    $zeiger_temp = mysql_query("DELETE FROM $skrupel_schiffe where id=$shid and besitzer=$besitzer;");
                                    $zeiger_temp = mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 's:$shid:%'");
                                    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where (flug=3 or flug=4) and zielid=$shid");
                                    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where (flug=3 or flug=4) and zielid=$shid_2");

                                    $schiffevernichtet++;
                                    $schiffevernichtet++;

                                    if($kamikaze==true || $kamikaze_2==true) {
                                        neuigkeiten(2,"../daten/$volk_2/bilder_schiffe/$bild_gross_2",$besitzer_2,$lang['hostraumkampf'][$spielersprache[$besitzer_2]][14],array($name_2,$spielerfarbe[$besitzer],$name,$sektork));
                                        neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['hostraumkampf'][$spielersprache[$besitzer]][14],array($name,$spielerfarbe[$besitzer_2],$name_2,$sektork));
                                    } elseif ($waffenlos==0) {
                                        $zeiger_temp = mysql_query("INSERT INTO $skrupel_kampf (spiel,art,schiff_id_1,schiff_id_2,name_1,name_2,rasse_1,rasse_2,bild_1,bild_2,datum,energetik_1,energetik_2,projektile_1,projektile_2,hangar_1,hangar_2,schild_1,schild_2,schaden_1,schaden_2,crew_1,crew_2) values ($spiel,1,$shid,$shid_2,'$name','$name_2','$volk','$volk_2','$bild_klein','$bild_klein_2','$datum','$aufzeichnung_energetik_1','$aufzeichnung_energetik_2','$aufzeichnung_projektile_1','$aufzeichnung_projektile_2','$aufzeichnung_hangar_1','$aufzeichnung_hangar_2','$aufzeichnung_schild_1','$aufzeichnung_schild_2','$aufzeichnung_schaden_1','$aufzeichnung_schaden_2','$aufzeichnung_crew_1','$aufzeichnung_crew_2');");
                                        neuigkeiten(2,"../daten/$volk_2/bilder_schiffe/$bild_gross_2",$besitzer_2,$lang['hostraumkampf'][$spielersprache[$besitzer_2]][8],array($name_2,$spielerfarbe[$besitzer],$name,$sektork,$shid,$shid_2,$datum));
                                        neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['hostraumkampf'][$spielersprache[$besitzer]][8],array($name,$spielerfarbe[$besitzer_2],$name_2,$sektork,$shid,$shid_2,$datum));
                                    } else {
                                        neuigkeiten(2,"../daten/$volk_2/bilder_schiffe/$bild_gross_2",$besitzer_2,$lang['hostraumkampf'][$spielersprache[$besitzer_2]][9],array($name_2,$spielerfarbe[$besitzer],$name,$sektork));
                                        neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['hostraumkampf'][$spielersprache[$besitzer]][9],array($name,$spielerfarbe[$besitzer_2],$name_2,$sektork));
                                    }
                                    break;
                                }

                                if (($schaden_2<100) and ($schaden<100) and ($crew_2<=0)) {

                                    $checkstring[]=$shid_2;

                                    $alpha=(double)(6.28318530718*mt_rand(0,$mt_randmax)/$mt_randmax);
                                    $koy_new=max(0,min($umfang,$koy+round($abstand*sin($alpha))));
                                    $kox_new=max(0,min($umfang,$kox+round($abstand*cos($alpha))));

                                    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set kox=$kox_new,koy=$koy_new,crew=0,schaden=$schaden_2,schild=$schild_2,projektile=$projektile_2,spezialmission=0,besitzer=$besitzer,fracht_leute=0,ordner=0,erfahrung=0,flug=0,warp=0,zielx=0,ziely=0,zielid=0,status=1 where id=$shid_2");
                                    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0,routing_schritt=0,routing_status=0,routing_koord='',routing_id='',routing_mins='',routing_warp=0,routing_tank=0,routing_rohstoff=0 where (flug=3 or flug=4) and zielid=$shid_2");
                                    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set crew=$crew,schaden=$schaden,schild=$schild,projektile=$projektile where id=$shid and besitzer=$besitzer;");

                                    if ($techlevel_2>=$techlevel) { $faktor=10; } else { $faktor=5; }
                                    $tech_unterschied=(($techlevel_2-$techlevel)*$faktor)+50;
                                    $zufall=mt_rand(1,100);
                                    if ($zufall>=$tech_unterschied) {
                                        $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set erfahrung=erfahrung+1 where erfahrung<5 and spiel=$spiel and id=$shid and besitzer=$besitzer");
                                    }

                                    $stat_schlacht_sieg[$besitzer]++;

                                    $zeiger_temp = mysql_query("INSERT INTO $skrupel_kampf (spiel,art,schiff_id_1,schiff_id_2,name_1,name_2,rasse_1,rasse_2,bild_1,bild_2,datum,energetik_1,energetik_2,projektile_1,projektile_2,hangar_1,hangar_2,schild_1,schild_2,schaden_1,schaden_2,crew_1,crew_2) values ($spiel,1,$shid,$shid_2,'$name','$name_2','$volk','$volk_2','$bild_klein','$bild_klein_2','$datum','$aufzeichnung_energetik_1','$aufzeichnung_energetik_2','$aufzeichnung_projektile_1','$aufzeichnung_projektile_2','$aufzeichnung_hangar_1','$aufzeichnung_hangar_2','$aufzeichnung_schild_1','$aufzeichnung_schild_2','$aufzeichnung_schaden_1','$aufzeichnung_schaden_2','$aufzeichnung_crew_1','$aufzeichnung_crew_2');");
                                    neuigkeiten(2,"../daten/$volk_2/bilder_schiffe/$bild_gross_2",$besitzer_2,$lang['hostraumkampf'][$spielersprache[$besitzer_2]][2],array($name_2,$sektork,$spielerfarbe[$besitzer],$name,$shid,$shid_2,$datum));
                                    neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['hostraumkampf'][$spielersprache[$besitzer]][3],array($name,$sektork,$spielerfarbe[$besitzer_2],$name_2,$shid,$shid_2,$datum));
                                }

                                if (($schaden_2<100) and ($schaden<100) and ($crew<=0)) {

                                    $checkstring[]=$shid;

                                    $alpha=(double)(6.28318530718*mt_rand(0,$mt_randmax)/$mt_randmax);
                                    $koy_new=max(0,min($umfang,$koy+round($abstand*sin($alpha))));
                                    $kox_new=max(0,min($umfang,$kox+round($abstand*cos($alpha))));

                                    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set kox=$kox_new,koy=$koy_new,crew=0,schaden=$schaden,schild=$schild,projektile=$projektile,spezialmission=0,besitzer=$besitzer_2,fracht_leute=0,ordner=0,erfahrung=0,flug=0,warp=0,zielx=0,ziely=0,zielid=0,status=1 where id=$shid");
                                    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0,routing_schritt=0,routing_status=0,routing_koord='',routing_id='',routing_mins='',routing_warp=0,routing_tank=0,routing_rohstoff=0 where (flug=3 or flug=4) and zielid=$shid");
                                    $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set crew=$crew_2,schaden=$schaden_2,schild=$schild_2,projektile=$projektile_2 where id=$shid_2 and besitzer=$besitzer_2;");

                                    if ($techlevel>=$techlevel_2) { $faktor=10; } else { $faktor=5; }
                                    $tech_unterschied=(($techlevel-$techlevel_2)*$faktor)+50;
                                    $zufall=mt_rand(1,100);
                                    if ($zufall>=$tech_unterschied) {
                                        $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set erfahrung=erfahrung+1 where erfahrung<5 and spiel=$spiel and id=$shid_2 and besitzer=$besitzer_2");
                                    }

                                    $stat_schlacht_sieg[$besitzer_2]++;

                                    $zeiger_temp = mysql_query("INSERT INTO $skrupel_kampf (spiel,art,schiff_id_1,schiff_id_2,name_1,name_2,rasse_1,rasse_2,bild_1,bild_2,datum,energetik_1,energetik_2,projektile_1,projektile_2,hangar_1,hangar_2,schild_1,schild_2,schaden_1,schaden_2,crew_1,crew_2) values ($spiel,1,$shid,$shid_2,'$name','$name_2','$volk','$volk_2','$bild_klein','$bild_klein_2','$datum','$aufzeichnung_energetik_1','$aufzeichnung_energetik_2','$aufzeichnung_projektile_1','$aufzeichnung_projektile_2','$aufzeichnung_hangar_1','$aufzeichnung_hangar_2','$aufzeichnung_schild_1','$aufzeichnung_schild_2','$aufzeichnung_schaden_1','$aufzeichnung_schaden_2','$aufzeichnung_crew_1','$aufzeichnung_crew_2');");
                                    neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['hostraumkampf'][$spielersprache[$besitzer]][2],array($name,$sektork,$spielerfarbe[$besitzer_2],$name_2,$shid,$shid_2,$datum));
                                    neuigkeiten(2,"../daten/$volk_2/bilder_schiffe/$bild_gross_2",$besitzer_2,$lang['hostraumkampf'][$spielersprache[$besitzer_2]][3],array($name_2,$sektork,$spielerfarbe[$besitzer],$name,$shid,$shid_2,$datum));

                                    break;
                                }

                                if (($schaden_2<100) and ($schaden<100) and ($crew>=1) and ($crew_2>=1) and ($ausweichen==1)) {
                                    if ($mission==2) {
                                        $checkstring[]=$shid;

                                        $alpha=(double)(6.28318530718*mt_rand(0,$mt_randmax)/$mt_randmax);
                                        $koy_new=max(0,min($umfang,$koy+round($abstand*sin($alpha))));
                                        $kox_new=max(0,min($umfang,$kox+round($abstand*cos($alpha))));

                                        $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set kox=$kox_new,koy=$koy_new,crew=$crew,schaden=$schaden,schild=$schild,projektile=$projektile,status=1 where id=$shid");
                                        $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set crew=$crew_2,schaden=$schaden_2,schild=$schild_2,projektile=$projektile_2 where id=$shid_2 and besitzer=$besitzer_2;");

                                        neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['hostraumkampf'][$spielersprache[$besitzer]][10],array($name,$sektork,$spielerfarbe[$besitzer_2],$name_2));
                                        neuigkeiten(2,"../daten/$volk_2/bilder_schiffe/$bild_gross_2",$besitzer_2,$lang['hostraumkampf'][$spielersprache[$besitzer_2]][11],array($name_2,$sektork));

                                        break;

                                    }
                                    if ($mission_2==2) {
                                        $checkstring[]=$shid_2;

                                        $alpha=(double)(6.28318530718*mt_rand(0,$mt_randmax)/$mt_randmax);
                                        $koy_new=max(0,min($umfang,$koy+round($abstand*sin($alpha))));
                                        $kox_new=max(0,min($umfang,$kox+round($abstand*cos($alpha))));

                                        $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set kox=$kox_new,koy=$koy_new,crew=$crew_2,schaden=$schaden_2,schild=$schild_2,projektile=$projektile_2,status=1 where id=$shid_2");
                                        $zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set crew=$crew,schaden=$schaden,schild=$schild,projektile=$projektile where id=$shid and besitzer=$besitzer;");

                                        neuigkeiten(2,"../daten/$volk_2/bilder_schiffe/$bild_gross_2",$besitzer_2,$lang['hostraumkampf'][$spielersprache[$besitzer_2]][10],array($name_2,$sektork,$spielerfarbe[$besitzer],$name));
                                        neuigkeiten(2,"../daten/$volk/bilder_schiffe/$bild_gross",$besitzer,$lang['hostraumkampf'][$spielersprache[$besitzer]][11],array($name,$sektork));
                                    }
                                }
                            }

                            //$checkstring=$checkstring.":::".$shid."::::::".$shid_2.":::";

                        }
                    }
                }
            }
        }
    }
}
$zeiger_temp = mysql_query("UPDATE $skrupel_schiffe set schild=100 where spiel=$spiel;");
