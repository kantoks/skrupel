<?php
  include ("../inc.conf.php");

open_db();
  $zeiger = @mysql_query("SELECT version FROM $skrupel_info");
  $array = @mysql_fetch_array($zeiger);
  $spiel_version = $array["version"];

  if ($spiel_version=='0.963') {
    @mysql_query("UPDATE $skrupel_info set version='0.964'");
    @mysql_query("ALTER TABLE $skrupel_spiele ADD module VARCHAR(255) NOT NULL");
    @mysql_query("ALTER TABLE $skrupel_schiffe ADD extra VARCHAR(255) NOT NULL");
    @mysql_query("ALTER TABLE $skrupel_sternenbasen ADD schiffbau_extra VARCHAR(255) NOT NULL");
    @mysql_query("ALTER TABLE $skrupel_planeten ADD heimatplanet TINYINT NOT NULL");
    @mysql_query("ALTER TABLE $skrupel_spiele ADD out INT NOT NULL");


    echo "Die Datenbankstruktur wurde erfolgreich aktualisiert.";
  } else {
   echo "<b>Fehler</b>: Dieser Patch ben&ouml;tigt Version 0.963, die aktuelle Version ist aber $spiel_version.";
  }

  
