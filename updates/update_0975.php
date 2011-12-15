<?php
  include ("../inc.conf.php");
  include ("../inhalt/inc.hilfsfunktionen.php");
  
  $conn = @mysql_connect($server.':'.$port,"$login","$password");
  $db = @mysql_select_db("$database",$conn);
  $zeiger = @mysql_query("SELECT version FROM $skrupel_info");
  $array = @mysql_fetch_array($zeiger);
  $spiel_version = $array["version"];
  if (($spiel_version=='0.974') || ($spiel_version=='0.974_nightly')) {
    @mysql_query("UPDATE `$skrupel_info` set version='0.975'");
	@mysql_query("ALTER TABLE `$skrupel_user` 
	ADD COLUMN `salt` varchar(16) NOT NULL default '' AFTER `passwort`,
	MODIFY `passwort` varchar(64) NOT NULL default '',
	ADD PRIMARY KEY ( `id` ),
	DROP INDEX `id`");
	$user = @mysql_query("SELECT `id`, `passwort` FROM `$skrupel_user`");
	while($id = mysql_fetch_array($user)){
			$passwd=cryptPasswd($id['passwort']);
			$passwd= explode(':',$passwd, 2);
            $zeiger_temp = @mysql_query("UPDATE `$skrupel_user` set passwort='{$passwd[0]}', salt = '{$passwd[1]}' where id={$id['id']}");
	}
	$zeiger_temp = @mysql_query("ALTER TABLE $skrupel_user ADD homepage VARCHAR(255) TINYTEXT NOT NULL");
    echo "Die Datenbankstruktur wurde erfolgreich aktualisiert.";
  } else {
   echo "<b>Fehler</b>: Dieser Patch ben&ouml;tigt Version 0.974, die aktuelle Version ist aber $spiel_version.";
  }
  @mysql_close();

