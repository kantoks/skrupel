<?php
$siegeranzahl=0;
$spieler_ids[1]=$spieler_1;
$spieler_ids[2]=$spieler_2;
$spieler_ids[3]=$spieler_3;
$spieler_ids[4]=$spieler_4;
$spieler_ids[5]=$spieler_5;
$spieler_ids[6]=$spieler_6;
$spieler_ids[7]=$spieler_7;
$spieler_ids[8]=$spieler_8;
$spieler_ids[9]=$spieler_9;
$spieler_ids[10]=$spieler_10;
if ($ziel_id==0) {
    for ($m=1;$m<11;$m++) {
        if ($spieler_gesamt_c[$m]==1) {
            $zeiger_temp= mysql_query("SELECT * FROM $skrupel_user where id=$spieler_id_c[$m]");
            $array_temp = mysql_fetch_array($zeiger_temp);
            $username=$array_temp["nick"];
            $gewinner="<font color=".$spielerfarbe[$m].">".$username."</font>";
            $sieger[$siegeranzahl]=$gewinner;
            $siegeranzahl++;
            $zeiger_temp = mysql_query("UPDATE $skrupel_user set stat_sieg=stat_sieg+1 where id=$spieler_id_c[$m]");
        }
    }
    if ($siegeranzahl>1) {
        $gewinner="";
        for ($n=0;$n<$siegeranzahl;$n++) {
            $gewinner=$gewinner.$sieger[$n];
            if ($n<$siegeranzahl-2) { $gewinner=$gewinner.", "; }
            if ($n==$siegeranzahl-2) { $gewinner=$gewinner." und "; }
        }
    } else {
        $gewinner=$sieger[0];
    }
}
if ($ziel_id==1) {
    for ($m=1;$m<11;$m++) {
        if (($spieler_raus_c[$m]==0) and ($spieler_id_c[$m]>=1)) {
            $zeiger_temp= mysql_query("SELECT * FROM $skrupel_user where id=$spieler_id_c[$m]");
            $array_temp = mysql_fetch_array($zeiger_temp);
            $username=$array_temp["nick"];
            $gewinner="<font color=".$spielerfarbe[$m].">".$username."</font>";
            $sieger[$siegeranzahl]=$gewinner;
            $siegeranzahl++;
            $zeiger_temp = mysql_query("UPDATE $skrupel_user set stat_sieg=stat_sieg+1 where id=$spieler_id_c[$m]");
        }
    }
    if ($siegeranzahl>1) {
        $gewinner="";
        for ($n=0;$n<$siegeranzahl;$n++) {
            $gewinner=$gewinner.$sieger[$n];
            if ($n<$siegeranzahl-2) { $gewinner=$gewinner.", "; }
            if ($n==$siegeranzahl-2) { $gewinner=$gewinner." und "; }
        }
    } else {
        $gewinner=$sieger[0];
    }
    $zeiger_temp = mysql_query("UPDATE $skrupel_spiele set phase=1, gewinner='$gewinner', siegeranzahl=$siegeranzahl where id=$spiel;");
}
if ($ziel_id==2) {
    for ($m=1;$m<11;$m++) {
        $todfeind[$m]=intval($spieler_ziel_c[$m]);
    }
    $tote=0;
    for ($m=1;$m<11;$m++) {
        if ($spieler_raus_c[$m]==1) { $totleute[$tote]=$m;$tote++; }
    }
    for ($n=1;$n<=10;$n++) {
        for ($mrt=0;$mrt<$tote;$mrt++) {
            if ($todfeind[$n]==$totleute[$mrt]) {
                $zeiger_temp= mysql_query("SELECT * FROM $skrupel_user where id=".$spieler_id_c[$n]);
                $array_temp = mysql_fetch_array($zeiger_temp);
                $username=$array_temp["nick"];
                $gewinner="<font color=".$spielerfarbe[$n].">".$username."</font>";
                $sieger[$siegeranzahl]=$gewinner;
                $siegeranzahl++;
                $zeiger_temp = mysql_query("UPDATE $skrupel_user set stat_sieg=stat_sieg+1 where id=".$spieler_id_c[$n]);
            }
        }
    }
    if ($siegeranzahl>1) {
        $gewinner="";
        for ($n=0;$n<$siegeranzahl;$n++) {
            $gewinner=$gewinner.$sieger[$n];
            if ($n<$siegeranzahl-2) { $gewinner=$gewinner.", "; }
            if ($n==$siegeranzahl-2) { $gewinner=$gewinner." und "; }
        }
    } else {
        $gewinner=$sieger[0];
    }
    $zeiger_temp = mysql_query("UPDATE $skrupel_spiele set phase=1, gewinner='$gewinner', siegeranzahl=$siegeranzahl where id=$spiel;");
}
if ($ziel_id==5) {
    for ($k=1;$k<11;$k++) {
        if (intval($spieler_ziel_c[$k]) >= intval($ziel_info)) {
            $zeiger_temp= mysql_query("SELECT * FROM $skrupel_user where id=$spieler_id_c[$k]");
            $array_temp = mysql_fetch_array($zeiger_temp);
            $username=$array_temp["nick"];
            $gewinner="<font color=".$spielerfarbe[$k].">".$username."</font>";
            $sieger[$siegeranzahl]=$gewinner;
            $siegeranzahl++;
            $zeiger_temp = mysql_query("UPDATE $skrupel_user set stat_sieg=stat_sieg+1 where id=$spieler_id_c[$k]");
        }
    }
    if ($siegeranzahl>1) {
        $gewinner="";
        for ($n=0;$n<$siegeranzahl;$n++) {
            $gewinner=$gewinner.$sieger[$n];
            if ($n<$siegeranzahl-2) { $gewinner=$gewinner.", "; }
            if ($n==$siegeranzahl-2) { $gewinner=$gewinner." und "; }
        }
    } else {
        $gewinner=$sieger[0];
    }
    $zeiger_temp = mysql_query("UPDATE $skrupel_spiele set phase=1, gewinner='$gewinner', siegeranzahl=$siegeranzahl where id=$spiel;");
}
if ($ziel_id==6) {
    for ($k=1;$k<11;$k++) {
        $zieldaten=explode(':',$spieler_ziel_c[$k]);
        $todfeinda[$k]=intval($zieldaten[1]);
        $todfeindb[$k]=intval($zieldaten[2]);
    }
    $tote=0;
    for ($k=1;$k<11;$k++) {
        if ($spieler_raus_c[$k]==1) { $totleute[$tote]=$k;$tote++; }
    }
    for ($n=1;$n<=10;$n++) {
        $ok=1;
        for ($mrt=0;$mrt<$tote;$mrt++) {
            if ((($todfeinda[$n]==$totleute[$mrt]) or ($todfeindb[$n]==$totleute[$mrt])) and ($ok==1)) {
                $zeiger_temp= mysql_query("SELECT * FROM $skrupel_user where id=".$spieler_ids[$n]);
                $array_temp = mysql_fetch_array($zeiger_temp);
                $username=$array_temp["nick"];
                $gewinner="<font color=".$spielerfarbe[$n].">".$username."</font>";
                $sieger[$siegeranzahl]=$gewinner;
                $siegeranzahl++;
                $zeiger_temp = mysql_query("UPDATE $skrupel_user set stat_sieg=stat_sieg+1 where id=".$spieler_ids[$n]);
                $ok=2;
            }
        }
    }
    if ($siegeranzahl>1) {
        $gewinner="";
        for ($n=0;$n<$siegeranzahl;$n++) {
            $gewinner=$gewinner.$sieger[$n];
            if ($n<$siegeranzahl-2) { $gewinner=$gewinner.", "; }
            if ($n==$siegeranzahl-2) { $gewinner=$gewinner." und "; }
        }
    } else {
        $gewinner=$sieger[0];
    }
    $zeiger_temp = mysql_query("UPDATE $skrupel_spiele set phase=1, gewinner='$gewinner', siegeranzahl=$siegeranzahl where id=$spiel;");
}
