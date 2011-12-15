<?php
$zeiger_temp = mysql_query("update $skrupel_anomalien set
  sicht_1=0, sicht_2=0, sicht_3=0, sicht_4=0, sicht_5=0, sicht_6=0, sicht_7=0, sicht_8=0, sicht_9=0, sicht_10=0
  where spiel=$spiel");

$zeiger_temp = mysql_query("update $skrupel_sternenbasen set
  sicht_1=0, sicht_2=0, sicht_3=0, sicht_4=0, sicht_5=0, sicht_6=0, sicht_7=0, sicht_8=0, sicht_9=0, sicht_10=0
  where spiel=$spiel");

$zeiger_temp = mysql_query("update $skrupel_planeten set
  sicht_1=0, sicht_2=0, sicht_3=0, sicht_4=0, sicht_5=0, sicht_6=0, sicht_7=0, sicht_8=0, sicht_9=0, sicht_10=0
  where spiel=$spiel");
$zeiger_temp = mysql_query("update $skrupel_schiffe set
  sicht_1=0, sicht_2=0, sicht_3=0, sicht_4=0, sicht_5=0, sicht_6=0, sicht_7=0, sicht_8=0, sicht_9=0, sicht_10=0,
  sicht_1_beta=0, sicht_2_beta=0, sicht_3_beta=0, sicht_4_beta=0, sicht_5_beta=0, sicht_6_beta=0, sicht_7_beta=0,
  sicht_8_beta=0, sicht_9_beta=0, sicht_10_beta=0
  where spiel=$spiel");
$scans = array();
$scanhash = array();
$scantelepat = array();
$zeiger = mysql_query("SELECT id,spiel,y_pos,x_pos,besitzer,sternenbasis_art,sternenbasis,osys_1,osys_2,osys_3,osys_4,osys_5,osys_6,native_fert,native_kol,native_id FROM $skrupel_planeten where spiel=$spiel");
while ($array = mysql_fetch_array($zeiger)) {
    $p_id = $array['id'];
    $x_pos = $array['x_pos'];
    $y_pos = $array['y_pos'];
    $osys_1 = $array['osys_1'];
    $osys_2 = $array['osys_2'];
    $osys_3 = $array['osys_3'];
    $osys_4 = $array['osys_4'];
    $osys_5 = $array['osys_5'];
    $osys_6 = $array['osys_6'];
    $native_id = $array['native_id'];
    $native_kol = $array['native_kol'];
    $native_fert = $array['native_fert'];
    $besitzer = $array['besitzer'];
    $sternenbasis_art = $array['sternenbasis_art'];
    $sternenbasis = $array['sternenbasis'];
    $scanner_r = 53;
    if ($osys_1==13 or $osys_2==13 or $osys_3==13 or $osys_4==13 or $osys_5==13 or $osys_6==13){ $scanner_r=90;}
    if (($sternenbasis_art==3) and ($sternenbasis==2)) { $scanner_r=116;}
    if ($besitzer>=1) {
        //telepat prepare
        $native_fert_telepat = intval(substr($native_fert,31,1));
        if ((1 == $native_fert_telepat) && (0 < $native_kol)) {
            $scantelepat[$native_id][] = $besitzer;
        }
        //
        mysql_query("INSERT INTO $skrupel_scan (spiel,besitzer,x,y) values ($spiel,$besitzer,$x_pos,$y_pos)");
        $scans[] = array(
            'besitzer' => $besitzer,
            'x' => $x_pos,
            'y' => $y_pos
        );
        $scanhash[$besitzer.'_'.$x_pos.'_'.$y_pos] = $scanner_r;
        for ($f=1;$f<=10;$f++) {
            if (($beziehung[$besitzer][$f]['status']==4) or ($beziehung[$besitzer][$f]['status']==5) or (($sicht_spionage[$besitzer][$f]==1) && $module[0])) {
                mysql_query("INSERT INTO $skrupel_scan (spiel,besitzer,x,y) values ($spiel,$f,$x_pos,$y_pos)");
                $scans[] = array(
                    'besitzer' => $f,
                    'x' => $x_pos,
                    'y' => $y_pos
                );
                $scanhash[$f.'_'.$x_pos.'_'.$y_pos] = $scanner_r;
            }
        }
    }
}
//telepatic connection
$zeiger = mysql_query("SELECT y_pos,x_pos,native_kol,native_id,besitzer FROM $skrupel_planeten where spiel=$spiel");
while ($array = mysql_fetch_array($zeiger)) {
    $x_pos = $array['x_pos'];
    $y_pos = $array['y_pos'];
    $native_id = $array['native_id'];
    $native_kol = $array['native_kol'];
    $besitzer = $array['besitzer'];
    $scanner_r = 53;
    if ((isset($scantelepat[$native_id])) && (0 < $native_kol)) {
        foreach ($scantelepat[$native_id] as $owner) {
            mysql_query("INSERT INTO $skrupel_scan (spiel,besitzer,x,y) values ($spiel,$owner,$x_pos,$y_pos)");
            $scans[] = array(
                'besitzer' => $owner,
                'x' => $x_pos,
                'y' => $y_pos
            );
            $scanhash[$owner.'_'.$x_pos.'_'.$y_pos] = $scanner_r;
            for ($f=1;$f<=10;$f++) {
                if (($beziehung[$owner][$f]['status']==4) or ($beziehung[$owner][$f]['status']==5) or (($sicht_spionage[$owner][$f]==1) && $module[0])) {
                    mysql_query("INSERT INTO $skrupel_scan (spiel,besitzer,x,y) values ($spiel,$f,$x_pos,$y_pos)");
                    $scans[] = array(
                        'besitzer' => $f,
                        'x' => $x_pos,
                        'y' => $y_pos
                    );
                    $scanhash[$f.'_'.$x_pos.'_'.$y_pos] = $scanner_r;
                }
            }
        } 
    }
}
$zeiger = mysql_query("SELECT id,spiel,kox,koy,besitzer,scanner FROM $skrupel_schiffe where spiel=$spiel");
while ($array = mysql_fetch_array($zeiger)) {
    $s_id = $array['id'];
    $kox = $array['kox'];
    $koy = $array['koy'];
    $scanner = $array['scanner'];
    $besitzer = $array['besitzer'];
    $scanner_r = 47;
    if ($scanner==1) { $scanner_r=85;}
    if ($scanner==2) { $scanner_r=116;}
    if ($besitzer>=1) {
        $scanhashindex = $besitzer.'_'.$kox.'_'.$koy;
        if (!array_key_exists($scanhashindex, $scanhash) or $scanner_r>$scanhash[$scanhashindex]) {
            mysql_query("INSERT INTO $skrupel_scan (spiel,besitzer,x,y) values ($spiel,$besitzer,$kox,$koy)");
            $scans[] = array(
                'besitzer' => $besitzer,
                'x' => $kox,
                'y' => $koy
            );
            $scanhash[$scanhashindex] = $scanner_r;
        }
        for ($f=1;$f<=10;$f++) {
            $scanhashindex = $f.'_'.$kox.'_'.$koy;
            if (($beziehung[$besitzer][$f]['status']==4) or ($beziehung[$besitzer][$f]['status']==5) or ($beziehung[$f][$besitzer]['status']==4) or ($beziehung[$f][$besitzer]['status']==5) or (($sicht_spionage[$besitzer][$f]==1) && $module[0])) {
                if (!array_key_exists($scanhashindex, $scanhash) or $scanner_r>$scanhash[$scanhashindex]) {
                    mysql_query("INSERT INTO $skrupel_scan (spiel,besitzer,x,y) values ($spiel,$f,$kox,$koy)");
                    $scans[] = array(
                        'besitzer' => $f,
                        'x' => $kox,
                        'y' => $koy
                    );
                    $scanhash[$scanhashindex] = $scanner_r;
                }
            }
        }
    }
}
foreach ($scans as $scantupel) {
    $spalte = 'sicht_'.$scantupel['besitzer'];
    $spalte_beta = $spalte.'_beta';
    $xx = $scantupel['x'];
    $yy = $scantupel['y'];
    $chef = $scantupel['besitzer'];
    $scanhashindex = $chef.'_'.$xx.'_'.$yy;
    $scanreichweite = $scanhash[$scanhashindex];
    //kleiner hack, da in $scans für jedes schiff einer flotte ein eintrag ist
    if($scanreichweite > 0) {
        $scanhash[$scanhashindex] = 0;
        $zeiger_temp = mysql_query("update $skrupel_planeten set $spalte_beta=1
                                        where (
                                            (sqrt((x_pos-$xx)*(x_pos-$xx)+(y_pos-$yy)*(y_pos-$yy)))<=225
                                            ) and spiel=$spiel and $spalte_beta=0");
        $zeiger_temp = mysql_query("update $skrupel_planeten set $spalte=1
                                        where (
                                            (sqrt((x_pos-$xx)*(x_pos-$xx)+(y_pos-$yy)*(y_pos-$yy)))<=125
                                            ) and spiel=$spiel and $spalte=0");
        $zeiger_temp = mysql_query("update $skrupel_schiffe set $spalte=1
                                        where (
                                            (sqrt((kox-$xx)*(kox-$xx)+(koy-$yy)*(koy-$yy)))<=125
                                            ) and spiel=$spiel and $spalte=0");
        $zeiger_temp = mysql_query("update $skrupel_schiffe set $spalte_beta=1
                                        where (
                                            (sqrt((kox-$xx)*(kox-$xx)+(koy-$yy)*(koy-$yy)))<=$scanreichweite
                                            ) and spiel=$spiel");
        $zeiger_temp = mysql_query("update $skrupel_anomalien set $spalte=1
                                        where (
                                            (sqrt((x_pos-$xx)*(x_pos-$xx)+(y_pos-$yy)*(y_pos-$yy)))<=125
                                            ) and spiel=$spiel and $spalte=0 and (art!=5) ");
        $zeiger_temp = mysql_query("update $skrupel_anomalien set $spalte=1
                                        where (
                                            (sqrt((x_pos-$xx)*(x_pos-$xx)+(y_pos-$yy)*(y_pos-$yy)))<=100
                                            ) and spiel=$spiel and $spalte=0 and (art=5) ");
        $zeiger_temp = mysql_query("update $skrupel_sternenbasen set $spalte=1
                                        where (
                                            (sqrt((x_pos-$xx)*(x_pos-$xx)+(y_pos-$yy)*(y_pos-$yy)))<=125
                                            ) and spiel=$spiel and $spalte=0");
    }
}
//neue tarnungsarten:
for($i=1;$i<11;$i++){
    $spalte="sicht_".$i;
    $spalte_beta=$spalte."_beta";
    $zeiger = mysql_query("SELECT id,kox,koy,besitzer,fertigkeiten FROM $skrupel_schiffe where spiel=$spiel and $spalte=1 and $spalte_beta=0 and tarnfeld=1 and besitzer<>$i");
    $schiffanzahl = mysql_num_rows($zeiger);
    for  ($j=0; $j<$schiffanzahl;$j++) {
        $ok = mysql_data_seek($zeiger,$j);
        $array = mysql_fetch_array($zeiger);
        $s_id=$array["id"];
        $kox=$array["kox"];
        $koy=$array["koy"];
        $besitzer=$array["besitzer"];
        $fertigkeiten=$array["fertigkeiten"];
        $tarnfeldgen=intval(substr($fertigkeiten,22,1));
        //normale Tarnung
        if($tarnfeldgen==1){
            $war=rand(1,10);
            if($war==10){
                $zeiger_temp = mysql_query("update $skrupel_schiffe set $spalte_beta=1    where id=$s_id and spiel=$spiel");
            }
        //klingonen tarnung
        }elseif($tarnfeldgen==3){
            $zeiger_temp = mysql_query("SELECT id FROM $skrupel_schiffe where spiel=$spiel and besitzer=$i and (sqrt((kox-$kox)*(kox-$kox)+(koy-$koy)*(koy-$koy)))<=125");
            $anzahl_temp = mysql_num_rows($zeiger_temp);
            $zeiger_temp = mysql_query("SELECT id FROM $skrupel_planeten where spiel=$spiel and besitzer=$i and (sqrt((x_pos-$kox)*(x_pos-$kox)+(y_pos-$koy)*(y_pos-$koy)))<=125");
            $anzahl_temp += mysql_num_rows($zeiger_temp);
            $war=rand(1,20);
            if($war<=(2+$anzahl_temp)){
                $zeiger_temp = mysql_query("update $skrupel_schiffe set $spalte_beta=1    where id=$s_id and spiel=$spiel");
            }
        }
    }
}
//begegnungen fuer modul wysiwyg
if ($module[4]==1) {
    $test = array();
    for($n=1;$n<11;$n++){
        if ($spieler_id_c[$n]>=1) {
            for ($m=1;$m<11;$m++){
                if (($spieler_id_c[$m]>=1) and ($n<>$m)) {
                    if ((!$begegnung[$n][$m]) and (!$test[$n][$m])) {
                        $test[$n][$m] = 1;
                        $spalte='sicht_'.$n;
                        $totals=0;
                        $zeiger = mysql_query("SELECT count(id) as total FROM $skrupel_schiffe where spiel=$spiel and $spalte=1 and besitzer=$m");
                        $array = mysql_fetch_array($zeiger);
                        $totals=$array["total"];
                        $totalp=0;
                        $zeiger = mysql_query("SELECT count(id) as total FROM $skrupel_planeten where spiel=$spiel and $spalte=1 and besitzer=$m");
                        $array = mysql_fetch_array($zeiger);
                        $totalp=$array["total"];
                        if (($totals>=1) or ($totalp>=1)) {
                            $begegnung[$n][$m]=1;
                            $begegnung[$m][$n]=1;
                            $zeiger_temp = mysql_query("INSERT INTO $skrupel_begegnung (partei_a,partei_b,spiel) values ('$n','$m',$spiel)");
                            $zeiger_temp = mysql_query("INSERT INTO $skrupel_begegnung (partei_a,partei_b,spiel) values ('$m','$n',$spiel)");
                        }
                    }
                }
            }
        }
    }
}
