<?php
  include ("../inc.conf.php");

open_db();
  $zeiger = @mysql_query("SELECT version FROM $skrupel_info");
  $array = @mysql_fetch_array($zeiger);
  $spiel_version=$array["version"];

  if ($spiel_version=='0.95') {

    $zeiger = @mysql_query("UPDATE $skrupel_info set version='0.95'");
    $zeiger = @mysql_query("UPDATE $skrupel_schiffe set fertigkeiten='0000000000000000000000000000000000000000000000000097' where klasse like 'Todesstern'");
    $zeiger = @mysql_query("ALTER TABLE $skrupel_konplaene CHANGE sonstiges sonstiges TEXT NOT NULL");
    $zeiger = @mysql_query("ALTER TABLE $skrupel_user ADD stat_teilnahme INT NOT NULL ,ADD stat_monate INT NOT NULL ,ADD stat_sieg INT NOT NULL ,ADD stat_schlacht INT NOT NULL ,ADD stat_schlacht_sieg INT NOT NULL ,ADD stat_kol_erobert INT NOT NULL ,ADD stat_lichtjahre BIGINT NOT NULL ;");
    $zeiger = @mysql_query("ALTER TABLE $skrupel_info ADD stat_spiele INT NOT NULL ;");
    $zeiger = @mysql_query("ALTER TABLE $skrupel_spiele ADD gewinner VARCHAR( 255 ) NOT NULL ;");
    $zeiger = @mysql_query("ALTER TABLE $skrupel_spiele ADD siegeranzahl TINYINT NOT NULL ;");
    $zeiger = @mysql_query("ALTER TABLE $skrupel_spiele ADD spieler_1_rassename VARCHAR(40) NOT NULL ;");
    $zeiger = @mysql_query("ALTER TABLE $skrupel_spiele ADD spieler_2_rassename VARCHAR(40) NOT NULL ;");
    $zeiger = @mysql_query("ALTER TABLE $skrupel_spiele ADD spieler_3_rassename VARCHAR(40) NOT NULL ;");
    $zeiger = @mysql_query("ALTER TABLE $skrupel_spiele ADD spieler_4_rassename VARCHAR(40) NOT NULL ;");
    $zeiger = @mysql_query("ALTER TABLE $skrupel_spiele ADD spieler_5_rassename VARCHAR(40) NOT NULL ;");
    $zeiger = @mysql_query("ALTER TABLE $skrupel_spiele ADD spieler_6_rassename VARCHAR(40) NOT NULL ;");
    $zeiger = @mysql_query("ALTER TABLE $skrupel_spiele ADD spieler_7_rassename VARCHAR(40) NOT NULL ;");
    $zeiger = @mysql_query("ALTER TABLE $skrupel_spiele ADD spieler_8_rassename VARCHAR(40) NOT NULL ;");
    $zeiger = @mysql_query("ALTER TABLE $skrupel_spiele ADD spieler_9_rassename VARCHAR(40) NOT NULL ;");
    $zeiger = @mysql_query("ALTER TABLE $skrupel_spiele ADD spieler_10_rassename VARCHAR(40) NOT NULL ;");

    $daten_verzeichnis="daten/";

  $handle=opendir("$daten_verzeichnis");

while ($rasse=readdir($handle)) {
   if ((substr($rasse,0,1)<>'.') and (substr($rasse,0,7)<>'bilder_') and (substr($rasse,strlen($rasse)-4,4)<>'.txt')) {

$daten="";
$attribute="";

$file=$daten_verzeichnis.$rasse.'/daten.txt';
$fp = @fopen("$file","r");
if ($fp) {
$zaehler2=0;
while (!feof ($fp)) {
    $buffer = @fgets($fp, 4096);
    $daten[$zaehler2]=$buffer;
    $zaehler2++;
}
@fclose($fp); }

$name[$rasse]=$daten[0];

}}


  $zeiger = @mysql_query("SELECT id,spieler_1_rasse,spieler_2_rasse,spieler_3_rasse,spieler_4_rasse,spieler_5_rasse,spieler_6_rasse,spieler_7_rasse,spieler_8_rasse,spieler_9_rasse,spieler_10_rasse FROM $skrupel_spiele order by id");
  $spielanzahl = @mysql_num_rows($zeiger);
  if ($spielanzahl>=1) {

   for  ($i=0; $i<$spielanzahl;$i++) {
   $ok = @mysql_data_seek($zeiger,$i);
   $array = @mysql_fetch_array($zeiger);
   $slot_id=$array["id"];

   $spieler_1_rasse=$array["spieler_1_rasse"];
   $spieler_2_rasse=$array["spieler_2_rasse"];
   $spieler_3_rasse=$array["spieler_3_rasse"];
   $spieler_4_rasse=$array["spieler_4_rasse"];
      $spieler_5_rasse=$array["spieler_5_rasse"];
      $spieler_6_rasse=$array["spieler_6_rasse"];
      $spieler_7_rasse=$array["spieler_7_rasse"];
      $spieler_8_rasse=$array["spieler_8_rasse"];
      $spieler_9_rasse=$array["spieler_9_rasse"];
      $spieler_10_rasse=$array["spieler_10_rasse"];

   if (strlen($spieler_1_rasse)>=2) { $rasse=$name[$spieler_1_rasse];$zeiger_temp = @mysql_query("UPDATE $skrupel_spiele set spieler_1_rassename='$rasse' where id=$slot_id");  }
   if (strlen($spieler_2_rasse)>=2) { $rasse=$name[$spieler_2_rasse];$zeiger_temp = @mysql_query("UPDATE $skrupel_spiele set spieler_2_rassename='$rasse' where id=$slot_id");  }
   if (strlen($spieler_3_rasse)>=2) { $rasse=$name[$spieler_3_rasse];$zeiger_temp = @mysql_query("UPDATE $skrupel_spiele set spieler_3_rassename='$rasse' where id=$slot_id");  }
   if (strlen($spieler_4_rasse)>=2) { $rasse=$name[$spieler_4_rasse];$zeiger_temp = @mysql_query("UPDATE $skrupel_spiele set spieler_4_rassename='$rasse' where id=$slot_id");  }
   if (strlen($spieler_5_rasse)>=2) { $rasse=$name[$spieler_5_rasse];$zeiger_temp = @mysql_query("UPDATE $skrupel_spiele set spieler_5_rassename='$rasse' where id=$slot_id");  }
   if (strlen($spieler_6_rasse)>=2) { $rasse=$name[$spieler_6_rasse];$zeiger_temp = @mysql_query("UPDATE $skrupel_spiele set spieler_6_rassename='$rasse' where id=$slot_id");  }
   if (strlen($spieler_7_rasse)>=2) { $rasse=$name[$spieler_7_rasse];$zeiger_temp = @mysql_query("UPDATE $skrupel_spiele set spieler_7_rassename='$rasse' where id=$slot_id");  }
   if (strlen($spieler_8_rasse)>=2) { $rasse=$name[$spieler_8_rasse];$zeiger_temp = @mysql_query("UPDATE $skrupel_spiele set spieler_8_rassename='$rasse' where id=$slot_id");  }
   if (strlen($spieler_9_rasse)>=2) { $rasse=$name[$spieler_9_rasse];$zeiger_temp = @mysql_query("UPDATE $skrupel_spiele set spieler_9_rassename='$rasse' where id=$slot_id");  }
   if (strlen($spieler_10_rasse)>=2) { $rasse=$name[$spieler_10_rasse];$zeiger_temp = @mysql_query("UPDATE $skrupel_spiele set spieler_10_rassename='$rasse' where id=$slot_id");  }
}}


    echo "Die Datenbankstruktur wurde erfolgreich aktualisiert.";

  } else {

   echo "<b>Fehler</b>: Dieser Patch ben&ouml;tigt Version 0.94, die aktuelle Version ist aber $spiel_version.";

  }


