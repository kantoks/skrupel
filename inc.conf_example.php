<?php
/////////////////////////////////////////////////////////////////////////////////

//Datenbankzugangsdaten

$db_server="localhost";
$db_port="3306";
$db_login="";
$db_password="";
$db_name="";

//Adminzugangsdaten

$admin_login="admin";
$admin_pass="admin";

//Absenderemail des Servers

$absenderemail="info@server.de";

date_default_timezone_set('Europe/Berlin');

/////////////////////////////////////////////////////////////////////////////////

//Tabellen

$skrupel_planeten='skrupel_planeten';
$skrupel_spiele='skrupel_spiele';
$skrupel_schiffe='skrupel_schiffe';
$skrupel_kampf='skrupel_kampf';
$skrupel_user='skrupel_user';
$skrupel_sternenbasen='skrupel_sternenbasen';
$skrupel_neuigkeiten='skrupel_neuigkeiten';
$skrupel_chat='skrupel_chat';
$skrupel_forum_thema='skrupel_forum_thema';
$skrupel_forum_beitrag='skrupel_forum_beitrag';
$skrupel_huellen='skrupel_huellen';
$skrupel_anomalien='skrupel_anomalien';
$skrupel_nebel='skrupel_nebel';
$skrupel_politik='skrupel_politik';
$skrupel_politik_anfrage='skrupel_politik_anfrage';
$skrupel_konplaene='skrupel_konplaene';
$skrupel_info='skrupel_info';
$skrupel_ordner='skrupel_ordner';
$skrupel_scan='skrupel_scan';
$skrupel_begegnung='skrupel_begegnung';


/////////////////////////////////////////////////////////////////////////////////

$language='de';
$ping_off=0;

/////////////////////////////////////////////////////////////////////////////////

$spielerfarbe[1]="#1DC710";    //gruen
$spielerfarbe[2]="#E5E203";    //gelb
$spielerfarbe[3]="#EAA500";    //orange
$spielerfarbe[4]="#875F00";    //braun
$spielerfarbe[5]="#bb0000";    //rot
$spielerfarbe[6]="#D700C1";    //rosa
$spielerfarbe[7]="#7D10C7";    //lila
$spielerfarbe[8]="#101DC7";    //blau
$spielerfarbe[9]="#049EEF";    //hellblau
$spielerfarbe[10]="#10C79B";   //tuerkis

/////////////////////////////////////////////////////////////////////////////////

//Error Behandlung, bei bedarf aktivieren

ini_set('display_errors', 0);
ini_set('log_errors', 0);
ini_set('ignore_repeated_errors', 1);
ini_set('error_reporting', E_ALL | E_STRICT);
ini_set('error_log', 'C:/skrupel/log/log.txt');

?>