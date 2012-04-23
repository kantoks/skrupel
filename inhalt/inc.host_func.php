<?php
function sektor($x, $y) {
    $sektor_x = round(($x/250)+0.5);
    $sektor_y = round(($y/250)+0.5);
    return chr(64+$sektor_x).$sektor_y;
}
function rasse_laden($filename) {
    $data = file_get_contents($filename);
    if($data) {
        $rows = explode("\n", $data);
        $attribute1 = explode(":", $rows[2]);
        $attribute2 = explode(":", $rows[4]);
        return array(
            'temperatur' => intval($attribute1[0]),
            'steuern' => (float)$attribute1[1],
            'minen' => (float)$attribute1[2],
            'bodenangriff' => (float)$attribute1[3],
            'bodenverteidigung' => (float)$attribute1[4],
            'fabriken' => (float)$attribute1[5],
            'pklasse' => intval($attribute1[6]),
            'assgrad' => intval($attribute2[0]),
            'assart' => intval($attribute2[1])
        );
    } else {
        return false;
    }
}
function neuigkeiten($art,$icon,$spieler_id,$inhalt,$werte) {
    global $skrupel_neuigkeiten,$spiel;
	open_db();
    $datum=time();
    //echo $inhalt.'<br>';
    $search=array();
    $anzahl=sizeof($werte);
    for ($n=1;$n<=$anzahl;$n++) {
        $platzhalter='{'.$n.'}';
        $search[]=$platzhalter;
        //echo $platzhalter.'<br>';
    }
    $inhalt=str_replace($search,$werte,$inhalt);
    $zeiger_temp = mysql_query("insert into $skrupel_neuigkeiten (datum,art,icon,inhalt,spieler_id,spiel_id) values ('$datum',$art,'$icon','$inhalt',$spieler_id,$spiel);");
}
function sichtaddieren($sicht_alt,$sicht_neu) {
    if ((substr($sicht_alt,0,1)=="1") or (substr($sicht_neu,0,1)=="1")) { $s1="1"; } else { $s1="0"; }
    if ((substr($sicht_alt,1,1)=="1") or (substr($sicht_neu,1,1)=="1")) { $s2="1"; } else { $s2="0"; }
    if ((substr($sicht_alt,2,1)=="1") or (substr($sicht_neu,2,1)=="1")) { $s3="1"; } else { $s3="0"; }
    if ((substr($sicht_alt,3,1)=="1") or (substr($sicht_neu,3,1)=="1")) { $s4="1"; } else { $s4="0"; }
    if ((substr($sicht_alt,4,1)=="1") or (substr($sicht_neu,4,1)=="1")) { $s5="1"; } else { $s5="0"; }
    if ((substr($sicht_alt,5,1)=="1") or (substr($sicht_neu,5,1)=="1")) { $s6="1"; } else { $s6="0"; }
    if ((substr($sicht_alt,6,1)=="1") or (substr($sicht_neu,6,1)=="1")) { $s7="1"; } else { $s7="0"; }
    if ((substr($sicht_alt,7,1)=="1") or (substr($sicht_neu,7,1)=="1")) { $s8="1"; } else { $s8="0"; }
    if ((substr($sicht_alt,8,1)=="1") or (substr($sicht_neu,8,1)=="1")) { $s9="1"; } else { $s9="0"; }
    if ((substr($sicht_alt,9,1)=="1") or (substr($sicht_neu,9,1)=="1")) { $s10="1"; } else { $s10="0"; }
    $sicht=$s1.$s2.$s3.$s4.$s5.$s6.$s7.$s8.$s9.$s10;
    return $sicht;
}
function platz_schiffe($wert) {
  global $spieler_schiffe_c;
  $zahl=1;
  for ($mn=1;$mn<11;$mn++) {
    if ($spieler_schiffe_c[$mn]>$wert) { $zahl++; }
  }
  return $zahl;
}
function platz_basen($wert) {
  global $spieler_basen_c;
  $zahl=1;
  for ($mn=1;$mn<11;$mn++) {
    if ($spieler_basen_c[$mn]>$wert) { $zahl++; }
  }
  return $zahl;
}
function platz_planeten($wert) {
  global $spieler_planeten_c;
  $zahl=1;
  for ($mn=1;$mn<11;$mn++) {
    if ($spieler_planeten_c[$mn]>$wert) { $zahl++; }
  }
  return $zahl;
}
function platz($wert) {
  global $spieler_gesamt_c;
  $zahl=1;
  for ($mn=1;$mn<11;$mn++) {
    if ($spieler_gesamt_c[$mn]<$wert) { $zahl++; }
  }
  return $zahl;
}
// Function: beam_das
// Declaration: function beam_das($db_handle_p,$id_a_p,$typ_a_p,$id_b_p,$typ_b_p,$was_p,$wieviel_p)
// Description:
//   Beamt angegebene Ware in angegebener von A nach B
//   Dabei wird jedoch nie mehr gebeamt, als auf A vorhanden ist
//   und auf B passt
//   Es wird nicht ueberprueft, ob die Objekte nah genug beieinander sind
// Parameters:
//   $db_handle_p  Datenbankvirbindung fuer die Queries
//   $id_a_p    Id des Objekts, von dem gebeamt wird
//   $typ_b_p    Typ des Objekts, von dem gebeamt wird ("s" oder "p")
//   $id_b_p    Id des Objekts, auf das gebeamt wird
//   $typ_b_p    Typ des Objekts, auf das gebeamt wird ("s" oder "p")
//   $was_p    Ware, die gebeamt werden soll
//       Planet    Schiff
//       lemin    fracht_lemin
//       min1    fracht_min1
//       min2    fracht_min2
//       min3    fracht_min3
//       vorrat    fracht_vorrat
//       cantox    fracht_cantox
//       kolonisten  fracht_leute
//      Es reicht aus, die Bezeichnungen aus der Planeten-
//      Tabelle zu benutzen
//   $wieviel_p    Anzahl Einheiten, die gebeamt werden sollen.
// Return values:
//   0-n  Beamen erfolgreich, returnwert ist tatsaechlich gebeamte Menge
//   -1   id von A nicht eindeutig oder nicht gefunden
//   -2   id von B nicht eindeutig oder nicht gefunden
//
function beam_das($db_handle_p,$id_a_p,$typ_a_p,$id_b_p,$typ_b_p,$was_p,$wieviel_p)
{
    global $skrupel_planeten,$skrupel_schiffe,$debug_beamen;
    if($debug_beamen)
    {
        print "DB_HANDLE: $db_handle<br>\n";
        print "ID von A: $id_a_p<br>\n";
        print "Typ von A: $typ_a_p<br>\n";
        print "ID von B: $id_b_p<br>\n";
        print "Typ von B: $typ_b_p<br>\n";
        print "Was: $was_p<br>\n";
        print "Wieviel: $wieviel_p<br>\n";
    }
    // Diesen Trivialfall loesen wir ohne Datenbank-Zugriff
    if(!$wieviel_p || ($wieviel_p==0)) { return 0; }
    // Datensatz von A holen
    if($typ_a_p=="p") { $table_a=$skrupel_planeten; }
    else { $table_a=$skrupel_schiffe; }
    if(!($query_ret=mysql_query("SELECT * FROM $table_a WHERE id=$id_a_p;",
                   $db_handle_p)))
    { return -1; }
    if(mysql_num_rows($query_ret)!=1) { return -1; }
    $array_a=mysql_fetch_array($query_ret);
    // Datensatz von B holen
    if($typ_b_p=="p") { $table_b=$skrupel_planeten; }
    else { $table_b=$skrupel_schiffe; }
    if(!($query_ret=mysql_query("SELECT * FROM $table_b WHERE id=$id_b_p;",
                   $db_handle_p)))
    { return -1; }
    if(mysql_num_rows($query_ret)!=1) { return -2; }
    $array_b=mysql_fetch_array($query_ret);
    // Variablenfummelei: die Parameter sind die Spaltenbezeichnungen fuer
    //          die Planetentabelle
    //        fuer Schiffe muss umgesetzt werden.
    if($typ_a_p=="p") { $was_auf_a=$was_p; }
    else
    {
      switch($was_p)
      {
      case "lemin":  $was_auf_a="lemin";
      break;
      case "min1":  $was_auf_a="fracht_min1";
      break;
      case "min2":  $was_auf_a="fracht_min2";
      break;
      case "min3":  $was_auf_a="fracht_min3";
      break;
      case "vorrat":  $was_auf_a="fracht_vorrat";
      break;
      case "cantox":  $was_auf_a="fracht_cantox";
      break;
      case "kolonisten":$was_auf_a="fracht_leute";
      break;
      }
    }
    if($typ_b_p=="p") { $was_auf_b=$was_p; }
    else
    {
      switch($was_p)
      {
      case "lemin":  $was_auf_b="lemin";
      break;
      case "min1":  $was_auf_b="fracht_min1";
      break;
      case "min2":  $was_auf_b="fracht_min2";
      break;
      case "min3":  $was_auf_b="fracht_min3";
      break;
      case "vorrat":  $was_auf_b="fracht_vorrat";
      break;
      case "cantox":  $was_auf_b="fracht_cantox";
      break;
      case "kolonisten":$was_auf_b="fracht_leute";
      break;
      }
    }
    $wieviel=$wieviel_p;
    // Ueberpruefen, ob genug $was_p auf A vorhanden ist
    // ggf. Beam-Menge anpassen
    if($array_a[$was_auf_a]<$wieviel_p)
    {
        $wieviel=$array_a[$was_auf_a];
    }
    if($debug_beamen) { print "wieviel: $wieviel<br>\n"; }
    // Sinnlos, ohne was Beambares weiter zu machen
    if(!$wieviel || ($wieviel==0)) { return 0; }
    // Hier vielleicht eine Warnung ausgeben
    // Ueberpruefen, ob $was_p noch in B rein passt
    // ggf. Menge anpassen
    //
    // Fuer Planeten muss man nix pruefen, da passt alles drauf.
    // Bei Schiffen den Frachtraum mit der Gesamtfracht vergleichen
    // bzw die Menge mit dem maximalen Tankinhalt
    if($typ_b_p=="s")
    {
    if($was_p=="lemin")
    {
        $passt_max=$array_b["leminmax"]-$array_b["lemin"];
        if($wieviel>$passt_max)
        {
            $wieviel=$passt_max;
        }
    }
    elseif($was_p=="cantox")
    { // Nix machen, Cantox passt immer
    }
    else
    {
        $gesamtfracht=0;
        // Cantox wiegt nix, Leute muss man anders behandeln
        foreach(array("fracht_min1","fracht_min2","fracht_min3",
                  "fracht_vorrat")
            as $fracht)
        { $gesamtfracht+=$array_b[$fracht]; }
        $gesamtfracht+=round($array_b["fracht_leute"]/100);
        // Bei Kolonisten muss man den aufgewandten Frachtraum
        // durch 100 teilen
        if($was_p=="kolonisten")
        { $gewicht=round($wieviel/100); }
        else
        { $gewicht=$wieviel; }
            if(($gesamtfracht+$gewicht)>$array_b["frachtraum"])
        {
            $wieviel=$array_b["frachtraum"]-$gesamtfracht;
        // Bei Kolonisten dieses Ergebnis mal hundert nehmen
        if($was_p=="kolonisten") { $wieviel*=100; }
        }
    }
    }
    if($debug_beamen) { print "wieviel: $wieviel<br>\n"; }
    // Datenbank updaten
    $query_str= "UPDATE $table_a ".
        "  SET ${was_auf_a}=${was_auf_a}-${wieviel} ".
        "  WHERE id=$id_a_p";
    if($debug_beamen)
    { print "<p>$query_str<br>\n"; }
    else
    { $zeiger_temp = mysql_query($query_str,$db_handle_p); }
    if($typ_b_p=="p"){
        $besitzera=$array_a["besitzer"];
        $besitzerb=$array_b["besitzer"];
        if($besitzera==$besitzerb){
            $query_str= "UPDATE $table_b ".
                "  SET ${was_auf_b}=${was_auf_b}+${wieviel} ".
                "  WHERE id=$id_b_p";
            }else{
                if($was_auf_b=="kolonisten"){
                        $query_str= "UPDATE $table_b ".
                            "  SET kolonisten_new=kolonisten_new+${wieviel} , kolonisten_spieler=$besitzera".
                            "  WHERE id=$id_b_p";
                    }else{
                        $query_str= "UPDATE $table_b ".
                            "  SET ${was_auf_b}=${was_auf_b}+${wieviel} ".
                            "  WHERE id=$id_b_p";
                    }
                }
        }else{
        $query_str= "UPDATE $table_b ".
            "  SET ${was_auf_b}=${was_auf_b}+${wieviel} ".
            "  WHERE id=$id_b_p";
        }
    if($debug_beamen)
    { print "$query_str<br>\n"; }
    else
    { $zeiger_temp = mysql_query($query_str,$db_handle_p); }
/*
    // Sonderfall: Kolonisten auf Fremdplaneten
    if($was_auf_b=="kolonisten_new")
    {
    $dieser_spieler=$array_a["besitzer"];
        $query_str= "UPDATE $table_b ".
        "  SET kolonisten_spieler=$dieser_spieler".
        "  WHERE id=$id_b_p";
        if($debug_beamen)
        { print "$query_str<br>\n"; }
        else
        { $zeiger_temp = mysql_query($query_str,$db_handle_p); }
    }
*/
    return $wieviel;
}
// Beamen von Schiff nach Planet
function beam_s_p($db_handle_p,$id_a_p,$id_b_p,$was_p,$wieviel_p)
{
    return beam_das($db_handle_p,$id_a_p,"s",$id_b_p,"p",$was_p,$wieviel_p);
}
// Beamen von Planet nach Schiff
function beam_p_s($db_handle_p,$id_a_p,$id_b_p,$was_p,$wieviel_p)
{
    return beam_das($db_handle_p,$id_a_p,"p",$id_b_p,"s",$was_p,$wieviel_p);
}
// Beamen von Schiff nach Schiff
function beam_s_s($db_handle_p,$id_a_p,$id_b_p,$was_p,$wieviel_p)
{
    return beam_das($db_handle_p,$id_a_p,"s",$id_b_p,"s",$was_p,$wieviel_p);
}
/*function rannum() {
    mt_srand((double)microtime()*1000000);
    $num = mt_rand(48,122);
    return $num;
}
function genchr() {
    do {
        $num = rrannum();
    } while ( ( $num > 57 && $num < 65 ) || ( $num > 90 && $num < 97 ) );
    return chr($num);
}
function rzufallstring() {
    $a = rgenchr();$e = rgenchr();$i = rgenchr();$m = rgenchr();$q = rgenchr();
    $b = rgenchr();$f = rgenchr();$j = rgenchr();$n = rgenchr();$r = rgenchr();
    $c = rgenchr();$g = rgenchr();$k = rgenchr();$o = rgenchr();$s = rgenchr();
    $d = rgenchr();$h = rgenchr();$l = rgenchr();$p = rgenchr();$t = rgenchr();
    $salt = "$a$b$c$d$e$f$g$h$i$j$k$l$m$n$o$p$q$r$s$t";
    return $salt;
}
*/
define('ONLY_LETTERS',0);
define('WITH_NUMBERS', 1);
define('WITH_SPECIAL_CHARACTERS', 2);
if (! function_exists("zufallstring")){
function zufallstring($size = 20, $url = ONLY_LETTERS){
  mt_srand();
  $pool = 'abcdefghijklmnopqrstuvwxyz';
  $pool .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  if($url & WITH_SPECIAL_CHARACTERS){
    $pool .= ',.-;:_#+*~!§$%&/()=?';
  }
  if($url & WITH_NUMBERS){
    $pool .='0123456789';
  }
  $pool_size = strlen($pool);
  $salt ='';
  for($i = 0;$i<$size; $i++){
    $salt .= $pool[mt_rand(0, $pool_size - 1)];
  }
  return $salt; 
} }
