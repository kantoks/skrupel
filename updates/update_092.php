<?php
  include ("../inc.conf.php");

open_db();
  $zeiger = @mysql_query("SELECT version FROM $skrupel_info");
  $array = @mysql_fetch_array($zeiger);
  $spiel_version=$array["version"];

  if ($spiel_version=='0.9') {

    $zeiger = @mysql_query("UPDATE $skrupel_info set version='0.92'");

  }



