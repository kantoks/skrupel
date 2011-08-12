<?php
if(count($sprachen) == 0) {
    include(LANGUAGEDIR.$language.'/lang.inc.host_bodenkampf.php');
} else {
    foreach($sprachen as $sprache) {
        include(LANGUAGEDIR.$sprache.'/lang.inc.host_bodenkampf.php');
    }
}
for ($i=0; $i<$planetenanzahl;$i++) {
    $ok = mysql_data_seek($zeiger,$i);
    $array = mysql_fetch_array($zeiger);
    $pid=$array["id"];
    $p_bild=$array["bild"];
    $p_klasse=$array["klasse"];
    $name=$array["name"];
    $besitzer=$array["besitzer"];
    $kolonisten=$array["kolonisten"];
    $kolonisten_spieler=$array["kolonisten_spieler"];
    $kolonisten_new=$array["kolonisten_new"];
    $leichtebt=$array["leichtebt"];
    $schwerebt=$array["schwerebt"];
    $leichtebt_new=$array["leichtebt_new"];
    $schwerebt_new=$array["schwerebt_new"];
    $sternenbasis_id=$array["sternenbasis_id"];
    $native_id=$array["native_id"];
    $native_fert=$array["native_fert"];
    $native_kol=$array["native_kol"];
    $native_fert_kampf=intval(substr($native_fert,9,3))/100;
    $rasse=$spieler_rasse_c[$besitzer];
    $besitzer_stark=$r_eigenschaften[$rasse]['bodenverteidigung'];
    $rasse=$spieler_rasse_c[$kolonisten_spieler];
    $kolonisten_spieler_stark=$r_eigenschaften[$rasse]['bodenangriff'];
    if (($native_id>=1) and ($native_kol>1) and ($native_fert_kampf>0)) {
        $besitzer_stark=round(($besitzer_stark*$native_fert_kampf)+0.5);
    }
    //$verteidiger=$kolonisten*$besitzer_stark;
    //$angreifer=$kolonisten_new*$kolonisten_spieler_stark;
    /////////////////////////////////////////////////////////////////
    $verteidiger_st=$besitzer_stark;
    $angreifer_st=$kolonisten_spieler_stark;
    $verteidiger_kol=$kolonisten;
    $angreifer_kol=$kolonisten_new;
    $verteidiger_leichtebt=$leichtebt;
    $angreifer_leichtebt=$leichtebt_new;
    $verteidiger_schwerebt=$schwerebt;
    $angreifer_schwerebt=$schwerebt_new;
    ///////////////////SCHWER GEGEN SCHWER
    $angreifer_staerke=$angreifer_st*$angreifer_schwerebt*100;
    $verteidiger_staerke=$verteidiger_st*$verteidiger_schwerebt*80;
    if ($angreifer_staerke==$verteidiger_staerke) {
        $verteidiger_schwerebt=0;
        $angreifer_schwerebt=0;
    } else {
        if ($angreifer_staerke>$verteidiger_staerke) {
            $angreifer_schwerebt=round(($angreifer_staerke-$verteidiger_staerke)/($angreifer_st*100));
            $verteidiger_schwerebt=0;
        } else {
            $verteidiger_schwerebt=round(($verteidiger_staerke-$angreifer_staerke)/($verteidiger_st*80));
            $angreifer_schwerebt=0;
        }
    }
    ///////////////////LEICHT GEGEN LEICHT
    $angreifer_staerke=$angreifer_st*$angreifer_leichtebt*16;
    $verteidiger_staerke=$verteidiger_st*$verteidiger_leichtebt*16;
    if ($angreifer_staerke==$verteidiger_staerke) {
        $verteidiger_leichtebt=0;
        $angreifer_leichtebt=0;
    } else {
        if ($angreifer_staerke>$verteidiger_staerke) {
            $angreifer_leichtebt=round(($angreifer_staerke-$verteidiger_staerke)/($angreifer_st*16));
            $verteidiger_leichtebt=0;
        } else {
            $verteidiger_leichtebt=round(($verteidiger_staerke-$angreifer_staerke)/($verteidiger_st*16));
            $angreifer_leichtebt=0;
        }
    }
    ///////////////////LEICHT GEGEN SCHWER
    if (($angreifer_schwerebt>=1) and ($verteidiger_leichtebt>=1)) {
        $angreifer_staerke=$angreifer_st*$angreifer_schwerebt*100;
        $verteidiger_staerke=$verteidiger_st*$verteidiger_leichtebt*16;
        if ($angreifer_staerke==$verteidiger_staerke) {
            $verteidiger_leichtebt=0;
            $angreifer_schwerebt=0;
        } else {
            if ($angreifer_staerke>$verteidiger_staerke) {
                $angreifer_schwerebt=round(($angreifer_staerke-$verteidiger_staerke)/($angreifer_st*100));
                $verteidiger_leichtebt=0;
            } else {
                $verteidiger_leichtebt=round(($verteidiger_staerke-$angreifer_staerke)/($verteidiger_st*16));
                $angreifer_schwerebt=0;
            }
        }
    }
    if (($verteidiger_schwerebt>=1) and ($angreifer_leichtebt>=1)) {
        $verteidiger_staerke=$verteidiger_st*$verteidiger_schwerebt*80;
        $angreifer_staerke=$angreifer_st*$angreifer_leichtebt*16;
        if ($angreifer_staerke==$verteidiger_staerke) {
            $verteidiger_schwerebt=0;
            $angreifer_leichtebt=0;
        } else {
            if ($angreifer_staerke>$verteidiger_staerke) {
                $angreifer_leichtebt=round(($angreifer_staerke-$verteidiger_staerke)/($angreifer_st*16));
                $verteidiger_schwerebt=0;
            } else {
                $verteidiger_schwerebt=round(($verteidiger_staerke-$angreifer_staerke)/($verteidiger_st*80));
                $angreifer_leichtebt=0;
            }
        }
    }
    ///////////////////KOLS GEGEN LEICHTSCHWER
    if (($angreifer_schwerebt>=1) and ($verteidiger_kol>=1)) {
        $angreifer_staerke=$angreifer_st*$angreifer_schwerebt*100;
        $verteidiger_staerke=$verteidiger_st*$verteidiger_kol;
        if ($angreifer_staerke==$verteidiger_staerke) {
            $verteidiger_kol=0;
            $angreifer_schwerebt=0;
        } else {
            if ($angreifer_staerke>$verteidiger_staerke) {
                $angreifer_schwerebt=round(($angreifer_staerke-$verteidiger_staerke)/($angreifer_st*100));
                $verteidiger_kol=0;
            } else {
                $verteidiger_kol=round(($verteidiger_staerke-$angreifer_staerke)/($verteidiger_st));
                $angreifer_schwerebt=0;
            }
        }
    }
    if (($verteidiger_schwerebt>=1) and ($angreifer_kol>=1)) {
        $verteidiger_staerke=$verteidiger_st*$verteidiger_schwerebt*80;
        $angreifer_staerke=$angreifer_st*$angreifer_kol;
        if ($angreifer_staerke==$verteidiger_staerke) {
            $verteidiger_schwerebt=0;
            $angreifer_kol=0;
        } else {
            if ($angreifer_staerke>$verteidiger_staerke) {
                $angreifer_kol=round(($angreifer_staerke-$verteidiger_staerke)/($angreifer_st));
                $verteidiger_schwerebt=0;
            } else {
                $verteidiger_schwerebt=round(($verteidiger_staerke-$angreifer_staerke)/($verteidiger_st*80));
                $angreifer_kol=0;
            }
        }
    }
    if (($angreifer_leichtebt>=1) and ($verteidiger_kol>=1)) {
        $angreifer_staerke=$angreifer_st*$angreifer_leichtebt*16;
        $verteidiger_staerke=$verteidiger_st*$verteidiger_kol;
        if ($angreifer_staerke==$verteidiger_staerke) {
            $verteidiger_kol=0;
            $angreifer_leichtebt=0;
        } else {
            if ($angreifer_staerke>$verteidiger_staerke) {
                $angreifer_leichtebt=round(($angreifer_staerke-$verteidiger_staerke)/($angreifer_st*16));
                $verteidiger_kol=0;
            } else {
                $verteidiger_kol=round(($verteidiger_staerke-$angreifer_staerke)/($verteidiger_st));
                $angreifer_leichtebt=0;
            }
        }
    }
    if (($verteidiger_leichtebt>=1) and ($angreifer_kol>=1)) {
        $verteidiger_staerke=$verteidiger_st*$verteidiger_leichtebt*16;
        $angreifer_staerke=$angreifer_st*$angreifer_kol;
        if ($angreifer_staerke==$verteidiger_staerke) {
            $verteidiger_leichtebt=0;
            $angreifer_kol=0;
        } else {
            if ($angreifer_staerke>$verteidiger_staerke) {
                $angreifer_kol=round(($angreifer_staerke-$verteidiger_staerke)/($angreifer_st));
                $verteidiger_leichtebt=0;
            } else {
                $verteidiger_leichtebt=round(($verteidiger_staerke-$angreifer_staerke)/($verteidiger_st*16));
                $angreifer_kol=0;
            }
        }
    }
    if (($angreifer_kol>=1) and ($verteidiger_kol>=1)) {
        $angreifer_staerke=$angreifer_st*$angreifer_kol;
        $verteidiger_staerke=$verteidiger_st*$verteidiger_kol;
        if ($angreifer_staerke==$verteidiger_staerke) {
            $verteidiger_kol=0;
            $angreifer_kol=0;
        } else {
            if ($angreifer_staerke>$verteidiger_staerke) {
                $angreifer_kol=round(($angreifer_staerke-$verteidiger_staerke)/($angreifer_st));
                $verteidiger_kol=0;
            } else {
                $verteidiger_kol=round(($verteidiger_staerke-$angreifer_staerke)/($verteidiger_st));
                $angreifer_kol=0;
            }
        }
    }
    if (($verteidiger_kol>=1) or ($verteidiger_leichtebt>=1) or ($verteidiger_schwerebt>=1)) {
        $planetenerobertfehl++;
        $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set kolonisten=$verteidiger_kol,leichtebt=$verteidiger_leichtebt,schwerebt=$verteidiger_schwerebt,kolonisten_spieler=0,kolonisten_new=0,leichtebt_new=0,schwerebt_new=0 where id=$pid;");
        $datum=time();
        neuigkeiten(1,"../bilder/planeten/$p_klasse"."_"."$p_bild.jpg",$besitzer,$lang['hostbodenkampf'][$spielersprache[$besitzer]][0],array($name));
        neuigkeiten(1,"../bilder/planeten/$p_klasse"."_"."$p_bild.jpg",$kolonisten_spieler,$lang['hostbodenkampf'][$spielersprache[$kolonisten_spieler]][1],array($name));
    }
    if (($angreifer_kol>=1) or ($angreifer_leichtebt>=1) or ($angreifer_schwerebt>=1)) {
        $planetenerobert++;
        $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set besitzer=$kolonisten_spieler,kolonisten=$angreifer_kol,leichtebt=$angreifer_leichtebt,schwerebt=$angreifer_schwerebt,kolonisten_spieler=0,kolonisten_new=0,leichtebt_new=0,schwerebt_new=0 where id=$pid;");
        if ($sternenbasis_id>=1) { $zeiger_temp = mysql_query("UPDATE $skrupel_sternenbasen set besitzer=$kolonisten_spieler where id=$sternenbasis_id;"); }
        $datum=time();
        $stat_kol_erobert[$kolonisten_spieler]++;
        neuigkeiten(1,"../bilder/planeten/$p_klasse"."_"."$p_bild.jpg",$besitzer,$lang['hostbodenkampf'][$spielersprache[$besitzer]][2],array($name));
        neuigkeiten(1,"../bilder/planeten/$p_klasse"."_"."$p_bild.jpg",$kolonisten_spieler,$lang['hostbodenkampf'][$spielersprache[$kolonisten_spieler]][3],array($name));
    }
    if (($angreifer_kol==0) and ($angreifer_leichtebt==0) and ($angreifer_schwerebt==0) and ($verteidiger_kol==0) and ($verteidiger_leichtebt==0) and ($verteidiger_schwerebt==0)) {
        $datum=time();
        neuigkeiten(1,"../bilder/planeten/$p_klasse"."_"."$p_bild.jpg",$besitzer,$lang['hostbodenkampf'][$spielersprache[$besitzer]][2],array($name));
        neuigkeiten(1,"../bilder/planeten/$p_klasse"."_"."$p_bild.jpg",$kolonisten_spieler,$lang['hostbodenkampf'][$spielersprache[$kolonisten_spieler]][1],array($name));
        $zeiger_temp = mysql_query("UPDATE $skrupel_planeten set leichtebt=0,schwerebt=0,kolonisten=0,besitzer=0,auto_minen=0,auto_fabriken=0,abwehr=0,auto_abwehr=0,auto_vorrat=0,logbuch='' where id=$pid");
        if ($sternenbasis_id>=1) {
            $zeiger_temp = mysql_query("UPDATE $skrupel_sternenbasen set besitzer=0 where id=$sternenbasis_id");
        }
    }
    ////////////////////////////////////////////////////////////////
}
