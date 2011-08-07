<?php
  include ("../inc.conf.php");

  $conn = @mysql_connect($server.':'.$port,"$login","$password");
  $db = @mysql_select_db("$database",$conn);

  $zeiger = @mysql_query("SELECT version FROM $skrupel_info");
  $array = @mysql_fetch_array($zeiger);
  $spiel_version=$array["version"];


  if ($spiel_version=='0.961') {

    $zeiger = @mysql_query("UPDATE $skrupel_info set version='0.962'");
    $zeiger = @mysql_query("ALTER TABLE $skrupel_user ADD bildpfad VARCHAR(255) NOT NULL");


    echo "Die Datenbankstruktur wurde erfolgreich aktualisiert.";

  } else {

   echo "<b>Fehler</b>: Dieser Patch ben�tigt Version 0.961, die aktuelle Version ist aber $spiel_version.";

  }


@mysql_close();

?>