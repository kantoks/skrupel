<?php
  include ("../inc.conf.php");

open_db();
  $zeiger = @mysql_query("SELECT version FROM $skrupel_info");
  $array = @mysql_fetch_array($zeiger);
  $spiel_version = $array["version"];

  if ($spiel_version=='0.97') {
    if(isset($skrupel_scan)) {
      @mysql_query("UPDATE $skrupel_info set version='0.971'");
      @mysql_query("CREATE TABLE $skrupel_scan (
          id BIGINT NOT NULL AUTO_INCREMENT ,
          spiel INT NOT NULL ,
          besitzer TINYINT NOT NULL ,
          x INT NOT NULL ,
          y INT NOT NULL ,
          PRIMARY KEY ( id ) )");
      @mysql_query("ALTER TABLE $skrupel_planeten ADD sicht_1 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_2 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_3 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_4 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_5 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_6 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_7 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_8 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_9 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_10 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_1_beta TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_2_beta TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_3_beta TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_4_beta TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_5_beta TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_6_beta TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_7_beta TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_8_beta TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_9_beta TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_10_beta TINYINT DEFAULT '0' NOT NULL");
      @mysql_query("ALTER TABLE $skrupel_planeten ADD artefakt TINYINT DEFAULT '0' NOT NULL");
      @mysql_query("ALTER TABLE $skrupel_schiffe ADD sicht_1 TINYINT DEFAULT '0' NOT NULL ,
          ADD plasmawarp tinyint(4) NOT NULL default '0',
          ADD temp_verfolgt INT DEFAULT '0' NOT NULL ,
          ADD sicht_2 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_3 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_4 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_5 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_6 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_7 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_8 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_9 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_10 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_1_beta TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_2_beta TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_3_beta TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_4_beta TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_5_beta TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_6_beta TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_7_beta TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_8_beta TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_9_beta TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_10_beta TINYINT DEFAULT '0' NOT NULL");
      @mysql_query("ALTER TABLE $skrupel_sternenbasen ADD sicht_1 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_2 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_3 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_4 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_5 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_6 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_7 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_8 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_9 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_10 TINYINT DEFAULT '0' NOT NULL");
      @mysql_query("ALTER TABLE $skrupel_anomalien ADD sicht_1 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_2 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_3 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_4 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_5 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_6 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_7 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_8 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_9 TINYINT DEFAULT '0' NOT NULL ,
          ADD sicht_10 TINYINT DEFAULT '0' NOT NULL");

      @mysql_query("ALTER TABLE $skrupel_ordner ADD icon TINYINT NOT NULL");
      @mysql_query("ALTER TABLE $skrupel_spiele ADD passwort VARCHAR( 20 ) NOT NULL");
      @mysql_query("ALTER TABLE $skrupel_spiele ADD rassenerlaubt VARCHAR( 255 ) NOT NULL");
      @mysql_query("ALTER TABLE $skrupel_spiele ADD kommentar VARCHAR( 255 ) NOT NULL");
      @mysql_query("ALTER TABLE $skrupel_spiele
                    ADD spieler_1_hash CHAR(20) NOT NULL ,
                    ADD spieler_2_hash CHAR(20) NOT NULL ,
                    ADD spieler_3_hash CHAR(20) NOT NULL ,
                    ADD spieler_4_hash CHAR(20) NOT NULL ,
                    ADD spieler_5_hash CHAR(20) NOT NULL ,
                    ADD spieler_6_hash CHAR(20) NOT NULL ,
                    ADD spieler_7_hash CHAR(20) NOT NULL ,
                    ADD spieler_8_hash CHAR(20) NOT NULL ,
                    ADD spieler_9_hash CHAR(20) NOT NULL ,
                    ADD spieler_10_hash CHAR(20) NOT NULL");
      @mysql_query("ALTER TABLE $skrupel_user ADD jabber VARCHAR( 255 ) NOT NULL ;");

      echo "Die Datenbankstruktur wurde erfolgreich aktualisiert.";
    } else {
      echo "<b>Fehler</b>: Bitte verwende die aktuelle Version der Datei <i>inc.conf.php</i>.";
    }
  } else {
   echo "<b>Fehler</b>: Dieser Patch ben&ouml;tigt Version 0.97, die aktuelle Version ist aber $spiel_version.";
  }

  
