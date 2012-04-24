<?php
  include ("../inc.conf.php");

open_db();
  $zeiger = @mysql_query("SELECT version FROM $skrupel_info");
  $array = @mysql_fetch_array($zeiger);
  $spiel_version=$array["version"];

  if ($spiel_version=='0.92') {

    $zeiger = @mysql_query("UPDATE $skrupel_info set version='0.93'");

    $zeiger = @mysql_query("ALTER TABLE $skrupel_schiffe ADD erfahrung TINYINT NOT NULL, ADD strecke INT NOT NULL");

    $zeiger = @mysql_query("ALTER TABLE $skrupel_spiele ADD piraten_mitte TINYINT NOT NULL, ADD piraten_aussen TINYINT NOT NULL, ADD piraten_min TINYINT NOT NULL, ADD piraten_max TINYINT NOT NULL");

    echo "Die Datenbankstruktur wurde erfolgreich aktualisiert.";

  } else {

   echo "<b>Fehler</b>: Dieser Patch ben&ouml;tigt Version 0.92, die aktuelle Version ist aber $spiel_version.";

  }


