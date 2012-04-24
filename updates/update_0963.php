<?php
  include ("../inc.conf.php");

open_db();
  $zeiger = @mysql_query("SELECT version FROM $skrupel_info");
  $array = @mysql_fetch_array($zeiger);
  $spiel_version=$array["version"];


  if ($spiel_version=='0.962') {

    $zeiger = @mysql_query("UPDATE $skrupel_info set version='0.963'");
    $zeiger = @mysql_query("ALTER TABLE $skrupel_user ADD avatar VARCHAR(255) NOT NULL");


    echo "Die Datenbankstruktur wurde erfolgreich aktualisiert.";

  } else {

   echo "<b>Fehler</b>: Dieser Patch ben&ouml;tigt Version 0.962, die aktuelle Version ist aber $spiel_version.";

  }



