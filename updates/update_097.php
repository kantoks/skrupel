<?php
  include ("../inc.conf.php");

open_db();
  $zeiger = @mysql_query("SELECT version FROM $skrupel_info");
  $array = @mysql_fetch_array($zeiger);
  $spiel_version = $array["version"];

  if ($spiel_version=='0.969') {
    @mysql_query("UPDATE $skrupel_info set version='0.97'");
    @mysql_query("ALTER TABLE $skrupel_planeten ADD artefakt TINYINT NOT NULL");
    @mysql_query("ALTER TABLE $skrupel_spiele ADD spieler_1_hash VARCHAR(20) NOT NULL ,ADD spieler_2_hash VARCHAR(20) NOT NULL ,ADD spieler_3_hash VARCHAR(20) NOT NULL ,ADD spieler_4_hash VARCHAR(20) NOT NULL ,ADD spieler_5_hash VARCHAR(20) NOT NULL ,ADD spieler_6_hash VARCHAR(20) NOT NULL ,ADD spieler_7_hash VARCHAR(20) NOT NULL ,ADD spieler_8_hash VARCHAR(20) NOT NULL ,ADD spieler_9_hash VARCHAR(20) NOT NULL ,ADD spieler_10_hash VARCHAR(20) NOT NULL");
  @mysql_query("ALTER TABLE $skrupel_spiele ADD aufloesung INT NOT NULL");
  @mysql_query("UPDATE $skrupel_spiele set aufloesung=250");
  @mysql_query("ALTER TABLE $skrupel_spiele CHANGE out oput INT(11) DEFAULT 0 NOT NULL");
  @mysql_query("ALTER TABLE $skrupel_sternenbasen CHANGE defense defense INT(11) DEFAULT 0 NOT NULL");
  @mysql_query("ALTER TABLE $skrupel_info ADD chat TINYINT DEFAULT 0 NOT NULL,ADD anleitung TINYINT DEFAULT 0 NOT NULL,ADD forum TINYINT DEFAULT 0 NOT NULL,ADD forum_url VARCHAR(255) NOT NULL");

    echo "Die Datenbankstruktur wurde erfolgreich aktualisiert.";
  } else {
   echo "<b>Fehler</b>: Dieser Patch ben&ouml;tigt Version 0.969, die aktuelle Version ist aber $spiel_version.";
  }

  
