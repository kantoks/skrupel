<?php
  include ("../inc.conf.php");

  $conn = @mysql_connect($server.':'.$port,"$login","$password");
  $db = @mysql_select_db("$database",$conn);

  $zeiger = @mysql_query("SELECT version FROM $skrupel_info");
  $array = @mysql_fetch_array($zeiger);
  $spiel_version = $array["version"];

  if ($spiel_version=='0.964') {
    @mysql_query("UPDATE $skrupel_info set version='0.965'");
    @mysql_query("ALTER TABLE $skrupel_planeten CHANGE p_defense_gesamt p_defense_gesamt INT DEFAULT '0' NOT NULL");


    echo "Die Datenbankstruktur wurde erfolgreich aktualisiert.";
  } else {
   echo "<b>Fehler</b>: Dieser Patch ben�tigt Version 0.964, die aktuelle Version ist aber $spiel_version.";
  }

  @mysql_close();
