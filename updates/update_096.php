<?php
  include ("../inc.conf.php");

open_db();
  $zeiger = @mysql_query("SELECT version FROM $skrupel_info");
  $array = @mysql_fetch_array($zeiger);
  $spiel_version=$array["version"];

  if ($spiel_version=='0.95') {

    $zeiger = @mysql_query("UPDATE $skrupel_info set version='0.96'");
    $zeiger = @mysql_query("ALTER TABLE $skrupel_planeten ADD osys_anzahl TINYINT NOT NULL ,ADD osys_1 TINYINT NOT NULL ,ADD osys_2 TINYINT NOT NULL ,ADD osys_3 TINYINT NOT NULL ,ADD osys_4 TINYINT NOT NULL ,ADD osys_5 TINYINT NOT NULL ,ADD osys_6 TINYINT NOT NULL;");
    $zeiger = @mysql_query("ALTER TABLE $skrupel_schiffe ADD traktor_id INT NOT NULL");
    $zeiger = @mysql_query("CREATE TABLE $skrupel_ordner (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,name VARCHAR( 20 ) NOT NULL ,besitzer INT NOT NULL ,spiel INT NOT NULL)");
    $zeiger = @mysql_query("ALTER TABLE $skrupel_schiffe ADD ordner INT DEFAULT '0' NOT NULL");


  $zeiger = @mysql_query("SELECT id FROM $skrupel_spiele order by id");
  $spielanzahl = @mysql_num_rows($zeiger);

  if ($spielanzahl>=1) {

    for  ($i=0; $i<$spielanzahl;$i++) {
      $ok = @mysql_data_seek($zeiger,$i);
      $array = @mysql_fetch_array($zeiger);
      $spid=$array["id"];

      for  ($k=1; $k<11;$k++) {
         $zeiger_temp = @mysql_query("INSERT INTO $skrupel_ordner (name,besitzer,spiel) values ('Frachter',$k,$spid)");
         $zeiger_temp = @mysql_query("INSERT INTO $skrupel_ordner (name,besitzer,spiel) values ('Jäger',$k,$spid)");
         $zeiger_temp = @mysql_query("INSERT INTO $skrupel_ordner (name,besitzer,spiel) values ('Sonstige',$k,$spid)");
      }
    }
  }

  $zeiger = @mysql_query("SELECT id,sternenbasis FROM $skrupel_planeten order by id");
  $planetenanzahl = @mysql_num_rows($zeiger);

  if ($planetenanzahl>=1) {

    for  ($i=0; $i<$planetenanzahl;$i++) {
      $ok = @mysql_data_seek($zeiger,$i);
      $array = @mysql_fetch_array($zeiger);
      $pid=$array["id"];
      $sternenbasis=$array["sternenbasis"];

      if ($sternenbasis==2) { $slots=4; } else { $slots=rand(1,6); }
      $zeiger_temp = @mysql_query("UPDATE $skrupel_planeten set osys_anzahl=$slots where id=$pid");

    }
  }


    echo "Die Datenbankstruktur wurde erfolgreich aktualisiert.";

  } else {

   echo "<b>Fehler</b>: Dieser Patch ben&ouml;tigt Version 0.95, die aktuelle Version ist aber $spiel_version.";

  }


