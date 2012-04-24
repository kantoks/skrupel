<?php
  include ("../inc.conf.php");

open_db();
  $zeiger = @mysql_query("SELECT version FROM $skrupel_info");
  $array = @mysql_fetch_array($zeiger);
  $spiel_version=$array["version"];

  if (strlen($skrupel_politik_anfrage)>=1) {

  if ($spiel_version=='0.96') {

    $zeiger = @mysql_query("UPDATE $skrupel_info set version='0.961'");
    $zeiger = mysql_query("CREATE TABLE $skrupel_politik_anfrage (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,partei_a TINYINT NOT NULL ,partei_b TINYINT NOT NULL ,art TINYINT NOT NULL ,zeit TINYINT NOT NULL ,spiel INT NOT NULL)");
    $zeiger = @mysql_query("DELETE FROM $skrupel_politik");
    $zeiger = @mysql_query("ALTER TABLE $skrupel_spiele ADD umfang INT NOT NULL");
    $zeiger = @mysql_query("UPDATE $skrupel_spiele set umfang=2500");
    $zeiger = @mysql_query("ALTER TABLE $skrupel_kampf ADD crew_1 TEXT NOT NULL ,ADD crew_2 TEXT NOT NULL");


    echo "Die Datenbankstruktur wurde erfolgreich aktualisiert.";

  } else {

   echo "<b>Fehler</b>: Dieser Patch ben&ouml;tigt Version 0.96, die aktuelle Version ist aber $spiel_version.";

  }
  } else {

   echo '<b>Fehler</b>: Die Variable <b>$skrupel_politik_anfrage</b> muss in der <b>inc.conf.php</b> definiert werden.';

  }


