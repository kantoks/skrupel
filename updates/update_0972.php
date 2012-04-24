<?php
  include ("../inc.conf.php");
open_db();
$zeiger = @mysql_query("SELECT version FROM $skrupel_info");
  $array = @mysql_fetch_array($zeiger);
  $spiel_version = $array["version"];
  if ($spiel_version=='0.971') {
  $conso=array("b","c","d","f","g","h","j","k","l","m","n","p","r","s","t","v","w","x","y","z");
  $vocal=array("a","e","i","o","u");
  $serial="";
  @srand((double)microtime()*1000000);
  for($f=1; $f<=20; $f++) {
     $serial.=$conso[rand(0,19)];
     $serial.=$vocal[rand(0,4)];
  }
    @mysql_query("UPDATE $skrupel_info set version='0.972'");
    @mysql_query("ALTER TABLE $skrupel_user ADD sprache VARCHAR(255) NOT NULL DEFAULT '$language'");
    @mysql_query("ALTER TABLE $skrupel_user ADD chatfarbe VARCHAR(6) NOT NULL DEFAULT 'ffffff'");
    @mysql_query("ALTER TABLE $skrupel_info ADD extend VARCHAR(255) NOT NULL DEFAULT ''");
    @mysql_query("ALTER TABLE $skrupel_info ADD serial VARCHAR(20) NOT NULL");
    @mysql_query("UPDATE $skrupel_info set serial='$serial'");
    @mysql_query("CREATE TABLE $skrupel_begegnung (id INT NOT NULL AUTO_INCREMENT,partei_a TINYINT NOT NULL,partei_b TINYINT NOT NULL,spiel INT NOT NULL,PRIMARY KEY (id))");
    echo "Die Datenbankstruktur wurde erfolgreich aktualisiert.";
  } else {
   echo "<b>Fehler</b>: Dieser Patch ben&ouml;tigt Version 0.971, die aktuelle Version ist aber $spiel_version.";
  }
  

