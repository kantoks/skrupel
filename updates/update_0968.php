<?php
  include ("../inc.conf.php");

open_db();
  $zeiger = @mysql_query("SELECT version FROM $skrupel_info");
  $array = @mysql_fetch_array($zeiger);
  $spiel_version = $array["version"];

  if ($spiel_version=='0.967') {
    @mysql_query("UPDATE $skrupel_info set version='0.968'");
    @mysql_query("ALTER TABLE $skrupel_schiffe ADD leichtebt INT(11) NOT NULL, ADD schwerebt INT(11) NOT NULL");
    @mysql_query("ALTER TABLE $skrupel_planeten ADD leichtebt INT(11) NOT NULL ,ADD schwerebt INT(11) NOT NULL ,ADD leichtebt_new INT(11) NOT NULL ,ADD schwerebt_new INT(11) NOT NULL");
    @mysql_query("ALTER TABLE $skrupel_planeten ADD leichtebt_bau INT(11) NOT NULL ,ADD schwerebt_bau INT(11) NOT NULL");
    @mysql_query("ALTER TABLE $skrupel_sternenbasen ADD art TINYINT NOT NULL");
    @mysql_query("ALTER TABLE $skrupel_planeten ADD sternenbasis_art TINYINT NOT NULL");
    @mysql_query("ALTER TABLE $skrupel_schiffe ADD zusatzmodul TINYINT NOT NULL");
    @mysql_query("ALTER TABLE $skrupel_sternenbasen ADD schiffbau_zusatz TINYINT NOT NULL");

    echo "Die Datenbankstruktur wurde erfolgreich aktualisiert.";
  } else {
   echo "<b>Fehler</b>: Dieser Patch ben&ouml;tigt Version 0.967, die aktuelle Version ist aber $spiel_version.";
  }

  
