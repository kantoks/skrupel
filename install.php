<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Skrupel - Tribute Compilation Installation</title>
<META NAME="Author" CONTENT="Bernd Kantoks bernd@kantoks.de">
<meta name="robots" content="index">
<meta name="keywords" content=" ">
<META HTTP-EQUIV="imagetoolbar" CONTENT="no">
<style type="text/css">
BODY,P,TD
{
        font-family:                Verdana;
        font-size:                10px;
         color:                    #ffffff;

  scrollbar-DarkShadow-Color:#444444;
  scrollbar-3dLight-Color:#444444;

  scrollbar-Track-Color:#444444;
  scrollbar-Face-Color:#555555;

  scrollbar-Shadow-Color:#222222;
  scrollbar-Highlight-Color:#888888;

  scrollbar-Arrow-Color:#555555;

}

A
{
		 color:                        #aaaaaa;
       font-weight:                bold;
        text-decoration:        underline;
        }

A:Hover
{
        font-weight:                bold;
        text-decoration:        underline;
        color:                        #ffffff;
}

INPUT,SELECT
{

        background-color:       #555555;
        color:       #ffffff;
        BORDER-BOTTOM-COLOR: #222222;
        BORDER-LEFT-COLOR: #888888;
        BORDER-RIGHT-COLOR: #222222;
        BORDER-TOP-COLOR: #888888;
        Border-Style: solid;
        Border-Width: 1px;
        font-family:                Verdana;
        font-size:                10px;
}
INPUT.eingabe
{

        background-color:       #555555;
        color:       #ffffff;
        BORDER-BOTTOM-COLOR: #888888;
        BORDER-LEFT-COLOR: #222222;
        BORDER-RIGHT-COLOR: #888888;
        BORDER-TOP-COLOR: #222222;
        Border-Style: solid;
        Border-Width: 1px;
        font-family:                Verdana;
        font-size:                10px;
}
</style>
</head>
<body text="#000000" bgcolor="#000000" scroll="no" background="bilder/hintergrund.gif" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<center><table border="0" height="100%" cellspacing="0" cellpadding="0">
	<tr>
	  <td><table border="0" cellspacing="0" cellpadding="0" background="bilder/login.gif">
			 <tr>
				<td><img src="bilder/empty.gif" border="0" width="1" height="1"></td>
				<td><img src="bilder/empty.gif" border="0" width="628" height="1"></td>
				<td><img src="bilder/empty.gif" border="0" width="1" height="1"></td>
			 </tr>
			 <tr>
				<td><img src="bilder/empty.gif" border="0" width="1" height="347"></td>
				<td valign="middle"><center>

<?php
  include ("inc.conf.php");

  $conn = @mysql_connect($server.':'.$port,"$login","$password");
  if ($conn) {
    $db = @mysql_select_db("$database",$conn);
    if ($db) {
      $zeiger = @mysql_query("SELECT version FROM $skrupel_info");
	  $array = @mysql_fetch_array($zeiger);
      if ($array["version"] == "0.974") {
        $installed = true;
      } else {
        $installed = false;
      }
    }
  }
?>

      <b>Willkommen bei der Skrupel-Installation.</b><br><br>

      <?php if ($installed) {
        echo "Skrupel wurde erfolgreich installiert.";
      } elseif (!$database || !$server || !$login || !$db) { ?>
        Bitte &ouml;ffne als erstes die Datei "inc.conf.php"<br>auf deinem Computer mit einem Text-Editor (z.B. Notepad).<br><br>
        Suche dir deine Zugangsdaten für die Datenbank raus<br>und f&uuml;lle die Datenbankzugangsdaten-Felder in der "inc.conf.php" aus.<br><br>
        Aus Sicherheitsgründen solltest du die Adminszugangsdaten &auml;ndern.<br>Diese werden benötigt, wenn du z.B. neue Spiele erstellen willst.<br><br>
        Am besten änderst du die Absenderemail des Servers.<br>Von dieser werden Anmeldebestätigungen und andere E-Mails verschickt.<br><br>
        Wenn du das gemacht hast, lade die "inc.conf.php" wieder auf deinen Server<br>und überschreibe die alte, unausgefüllte Version.<br><br>
        Danach kannst du diese Seite neu laden. Solltest du das alles bereits ausgefüllt haben<br>und wieder auf dieser Seite landen, heisst das, dass die Daten falsch sind.
      <?php } else {
          @mysql_query("CREATE TABLE $skrupel_scan (
	    id int(11) NOT NULL auto_increment,
	    spiel int(11) NOT NULL,
	    besitzer tinyint(4) NOT NULL,
	    x int(11) NOT NULL,
	    y int(11) NOT NULL,
	    PRIMARY KEY (id)
	    ) TYPE=MyISAM");

	  @mysql_query("CREATE TABLE $skrupel_anomalien (
	    id int(11) NOT NULL auto_increment,
	    art tinyint(4) NOT NULL default '0',
	    x_pos int(11) NOT NULL default '0',
	    y_pos int(11) NOT NULL default '0',
	    extra varchar(255) NOT NULL default '',
	    sicht varchar(10) NOT NULL default '',
	    spiel int(11) NOT NULL default '0',
	    sicht_1 tinyint(4) NOT NULL default '0',
	    sicht_2 tinyint(4) NOT NULL default '0',
	    sicht_3 tinyint(4) NOT NULL default '0',
	    sicht_4 tinyint(4) NOT NULL default '0',
	    sicht_5 tinyint(4) NOT NULL default '0',
	    sicht_6 tinyint(4) NOT NULL default '0',
	    sicht_7 tinyint(4) NOT NULL default '0',
	    sicht_8 tinyint(4) NOT NULL default '0',
	    sicht_9 tinyint(4) NOT NULL default '0',
	    sicht_10 tinyint(4) NOT NULL default '0',
	    PRIMARY KEY  (id)
	    ) TYPE=MyISAM");

	  @mysql_query("CREATE TABLE $skrupel_chat (
	    id int(11) NOT NULL auto_increment,
	    spiel tinyint(4) NOT NULL default '0',
	    datum varchar(10) NOT NULL default '',
	    text text NOT NULL,
	    an int(11) NOT NULL default '0',
	    von varchar(50) NOT NULL default '',
	    farbe varchar(7) NOT NULL default '',
	    PRIMARY KEY  (id),
	    UNIQUE KEY id (id)
	    ) TYPE=MyISAM");

	  @mysql_query("CREATE TABLE $skrupel_forum_beitrag (
	    id int(11) NOT NULL auto_increment,
	    forum tinyint(4) NOT NULL default '0',
	    thema int(11) NOT NULL default '0',
	    datum varchar(10) NOT NULL default '',
	    beitrag text NOT NULL,
	    verfasser varchar(30) NOT NULL default '',
	    spielerid tinyint(4) NOT NULL default '0',
	    spiel int(11) NOT NULL default '0',
	    PRIMARY KEY  (id)
	    ) TYPE=MyISAM");

	  @mysql_query("CREATE TABLE $skrupel_forum_thema (
	    id int(11) NOT NULL auto_increment,
	    forum tinyint(4) NOT NULL default '0',
	    icon tinyint(4) NOT NULL default '0',
	    thema varchar(50) NOT NULL default '',
	    beginner varchar(30) NOT NULL default '',
	    antworten tinyint(4) NOT NULL default '0',
	    letzter varchar(10) NOT NULL default '',
	    spiel int(11) NOT NULL default '0',
	    PRIMARY KEY  (id)
	    ) TYPE=MyISAM");

	  @mysql_query("CREATE TABLE $skrupel_huellen (
	    id int(11) NOT NULL auto_increment,
	    baid int(11) NOT NULL default '0',
	    klasse tinyint(4) NOT NULL default '0',
	    bild_gross varchar(255) NOT NULL default '',
	    bild_klein varchar(255) NOT NULL default '',
	    crew int(11) NOT NULL default '0',
	    masse int(11) NOT NULL default '0',
	    tank int(11) NOT NULL default '0',
	    fracht int(11) NOT NULL default '0',
	    antriebe tinyint(4) NOT NULL default '0',
	    energetik tinyint(4) NOT NULL default '0',
	    projektile tinyint(4) NOT NULL default '0',
	    hangar tinyint(4) NOT NULL default '0',
	    klasse_name varchar(25) NOT NULL default '',
	    rasse varchar(255) NOT NULL default '',
	    fertigkeiten varchar(255) NOT NULL default '',
	    techlevel tinyint(4) NOT NULL default '0',
	    spiel int(11) NOT NULL default '0',
	    PRIMARY KEY  (id),
	    UNIQUE KEY id (id)
	    ) TYPE=MyISAM");

	  @mysql_query("CREATE TABLE $skrupel_info (
	    version varchar(10) NOT NULL default '',
	    chat tinyint(4) NOT NULL default '0',
	    anleitung tinyint(4) NOT NULL default '0',
	    forum tinyint(4) NOT NULL default '0',
	    forum_url varchar(255) NOT NULL default '',
	    stat_spiele int(11) NOT NULL default '0',
	    extend VARCHAR(255) NOT NULL default '',
	    serial VARCHAR(20) NOT NULL
	    ) TYPE=MyISAM");

	    $conso=array("b","c","d","f","g","h","j","k","l","m","n","p","r","s","t","v","w","x","y","z");
	    $vocal=array("a","e","i","o","u");
	    $serial="";
	    @srand((double)microtime()*1000000);
	    for($f=1; $f<=20; $f++) {
	       $serial.=$conso[rand(0,19)];
	       $serial.=$vocal[rand(0,4)];
	    }

	  @mysql_query("INSERT INTO $skrupel_info VALUES ('0.974',0,0,0,'http://',0,'','$serial')");

	  @mysql_query("CREATE TABLE $skrupel_kampf (
	    id int(11) NOT NULL auto_increment,
	    schiff_id_1 int(11) NOT NULL default '0',
	    schiff_id_2 int(11) NOT NULL default '0',
	    name_1 varchar(255) NOT NULL default '',
	    name_2 varchar(255) NOT NULL default '',
	    rasse_1 varchar(255) NOT NULL default '',
	    rasse_2 varchar(255) NOT NULL default '',
	    bild_1 varchar(255) NOT NULL default '',
	    bild_2 varchar(255) NOT NULL default '',
	    datum varchar(10) NOT NULL default '',
	    energetik_1 text NOT NULL,
	    energetik_2 text NOT NULL,
	    projektile_1 text NOT NULL,
	    projektile_2 text NOT NULL,
	    hangar_1 text NOT NULL,
	    hangar_2 text NOT NULL,
	    schild_1 text NOT NULL,
	    schild_2 text NOT NULL,
	    schaden_1 text NOT NULL,
	    schaden_2 text NOT NULL,
	    art tinyint(4) NOT NULL default '0',
	    spiel int(11) NOT NULL default '0',
	    crew_1 text NOT NULL,
	    crew_2 text NOT NULL,
	    PRIMARY KEY  (id),
	    UNIQUE KEY id (id)
	    )TYPE=MyISAM");

	  @mysql_query("CREATE TABLE $skrupel_nebel (
	    id int(11) NOT NULL auto_increment,
	    spiel int(11) NOT NULL default '0',
	    x_a int(11) NOT NULL default '0',
	    y_a int(11) NOT NULL default '0',
	    sicht varchar(10) NOT NULL default '',
	    x_e int(11) NOT NULL default '0',
	    y_e int(11) NOT NULL default '0',
	    PRIMARY KEY  (id)
	    ) TYPE=MyISAM");

	  @mysql_query("CREATE TABLE $skrupel_neuigkeiten (
	    id int(11) NOT NULL auto_increment,
	    datum varchar(10) NOT NULL default '',
	    art tinyint(4) NOT NULL default '0',
	    icon varchar(255) NOT NULL default '',
	    inhalt text NOT NULL,
	    spieler_id tinyint(4) NOT NULL default '0',
	    spiel_id int(11) NOT NULL default '0',
	    sicher tinyint(4) NOT NULL default '0',
	    PRIMARY KEY  (id),
	    UNIQUE KEY id (id)
	    ) TYPE=MyISAM");

	  @mysql_query("CREATE TABLE $skrupel_planeten (
	    id int(11) NOT NULL auto_increment,
	    name varchar(255) NOT NULL default '',
	    x_pos int(11) NOT NULL default '0',
	    y_pos int(11) NOT NULL default '0',
	    besitzer tinyint(4) NOT NULL default '0',
	    klasse tinyint(4) NOT NULL default '0',
	    bild tinyint(4) NOT NULL default '0',
	    temp tinyint(4) NOT NULL default '0',
	    kolonisten bigint(20) NOT NULL default '0',
	    lemin int(11) NOT NULL default '0',
	    min1 int(11) NOT NULL default '0',
	    min2 int(11) NOT NULL default '0',
	    min3 int(11) NOT NULL default '0',
	    planet_lemin int(11) NOT NULL default '0',
	    planet_min1 int(11) NOT NULL default '0',
	    planet_min2 int(11) NOT NULL default '0',
	    planet_min3 int(11) NOT NULL default '0',
	    konz_lemin tinyint(4) NOT NULL default '0',
	    konz_min1 tinyint(4) NOT NULL default '0',
	    konz_min2 tinyint(4) NOT NULL default '0',
	    konz_min3 tinyint(4) NOT NULL default '0',
	    minen int(11) NOT NULL default '0',
	    vorrat int(11) NOT NULL default '0',
	    cantox int(11) NOT NULL default '0',
	    auto_minen tinyint(4) NOT NULL default '0',
	    fabriken int(11) NOT NULL default '0',
	    auto_fabriken tinyint(4) NOT NULL default '0',
	    auto_vorrat tinyint(4) NOT NULL default '0',
	    abwehr int(11) NOT NULL default '0',
	    auto_abwehr tinyint(4) NOT NULL default '0',
	    sternenbasis tinyint(4) NOT NULL default '0',
	    sternenbasis_name varchar(20) NOT NULL default '',
	    sternenbasis_id int(11) NOT NULL default '0',
	    sternenbasis_rasse varchar(255) NOT NULL default '',
	    kolonisten_new int(11) NOT NULL default '0',
	    kolonisten_spieler int(11) NOT NULL default '0',
	    sternenbasis_defense tinyint(4) NOT NULL default '0',
	    p_defense_gesamt int(11) NOT NULL default '0',
	    logbuch text NOT NULL,
	    sicht varchar(10) NOT NULL default '',
	    sicht_beta varchar(10) NOT NULL default '',
	    sicht_temp varchar(10) NOT NULL default '',
	    spiel int(11) NOT NULL default '0',
	    native_id int(11) NOT NULL default '0',
	    native_name varchar(50) NOT NULL default '',
	    native_art int(11) NOT NULL default '0',
	    native_art_name varchar(50) NOT NULL default '',
	    native_abgabe float NOT NULL default '0',
	    native_bild varchar(255) NOT NULL default '',
	    native_text varchar(255) NOT NULL default '',
	    native_fert varchar(255) NOT NULL default '',
	    native_kol bigint(20) NOT NULL default '0',
	    osys_anzahl tinyint(4) NOT NULL default '0',
	    osys_1 tinyint(4) NOT NULL default '0',
	    osys_2 tinyint(4) NOT NULL default '0',
	    osys_3 tinyint(4) NOT NULL default '0',
	    osys_4 tinyint(4) NOT NULL default '0',
	    osys_5 tinyint(4) NOT NULL default '0',
	    osys_6 tinyint(4) NOT NULL default '0',
	    heimatplanet tinyint(4) NOT NULL default '0',
	    leichtebt int(11) NOT NULL default '0',
	    schwerebt int(11) NOT NULL default '0',
	    leichtebt_new int(11) NOT NULL default '0',
	    schwerebt_new int(11) NOT NULL default '0',
	    leichtebt_bau int(11) NOT NULL default '0',
	    schwerebt_bau int(11) NOT NULL default '0',
	    sternenbasis_art tinyint(4) NOT NULL default '0',
        artefakt tinyint(4) NOT NULL default '0',
	    sicht_1 tinyint(4) NOT NULL default '0',
	    sicht_2 tinyint(4) NOT NULL default '0',
	    sicht_3 tinyint(4) NOT NULL default '0',
	    sicht_4 tinyint(4) NOT NULL default '0',
	    sicht_5 tinyint(4) NOT NULL default '0',
	    sicht_6 tinyint(4) NOT NULL default '0',
	    sicht_7 tinyint(4) NOT NULL default '0',
	    sicht_8 tinyint(4) NOT NULL default '0',
	    sicht_9 tinyint(4) NOT NULL default '0',
	    sicht_10 tinyint(4) NOT NULL default '0',
	    sicht_1_beta tinyint(4) NOT NULL default '0',
	    sicht_2_beta tinyint(4) NOT NULL default '0',
	    sicht_3_beta tinyint(4) NOT NULL default '0',
	    sicht_4_beta tinyint(4) NOT NULL default '0',
	    sicht_5_beta tinyint(4) NOT NULL default '0',
	    sicht_6_beta tinyint(4) NOT NULL default '0',
	    sicht_7_beta tinyint(4) NOT NULL default '0',
	    sicht_8_beta tinyint(4) NOT NULL default '0',
	    sicht_9_beta tinyint(4) NOT NULL default '0',
	    sicht_10_beta tinyint(4) NOT NULL default '0',
	    UNIQUE KEY id (id)
	    ) TYPE=MyISAM");

	  @mysql_query("CREATE TABLE $skrupel_politik (
	    id int(11) NOT NULL auto_increment,
	    partei_a int(11) NOT NULL default '0',
	    partei_b int(11) NOT NULL default '0',
	    status tinyint(4) NOT NULL default '0',
	    optionen tinyint(4) NOT NULL default '0',
	    spiel int(11) NOT NULL default '0',
	    PRIMARY KEY  (id)
	    ) TYPE=MyISAM");

	  @mysql_query("CREATE TABLE $skrupel_politik_anfrage (
	    id int(11) NOT NULL auto_increment,
	    partei_a tinyint(4) NOT NULL default '0',
	    partei_b tinyint(4) NOT NULL default '0',
	    art tinyint(4) NOT NULL default '0',
	    zeit tinyint(4) NOT NULL default '0',
	    spiel int(11) NOT NULL default '0',
	    PRIMARY KEY  (id)
	    ) TYPE=MyISAM");

	  @mysql_query("CREATE TABLE $skrupel_schiffe (
	    id int(11) NOT NULL auto_increment,
	    besitzer int(11) NOT NULL default '0',
	    status tinyint(4) NOT NULL default '0',
	    name varchar(25) NOT NULL default '',
	    klasse varchar(25) NOT NULL default '',
	    klasseid int(11) NOT NULL default '0',
	    volk varchar(255) NOT NULL default '',
	    techlevel tinyint(4) NOT NULL default '0',
	    antrieb tinyint(4) NOT NULL default '0',
	    antrieb_anzahl tinyint(4) NOT NULL default '0',
	    kox int(11) NOT NULL default '0',
	    koy int(11) NOT NULL default '0',
	    flug tinyint(4) NOT NULL default '0',
	    warp tinyint(4) NOT NULL default '0',
	    plasmawarp tinyint(4) NOT NULL default '0',
	    zielx int(11) NOT NULL default '0',
	    ziely int(11) NOT NULL default '0',
	    zielid int(11) NOT NULL default '0',
	    crew int(11) NOT NULL default '0',
	    crewmax int(11) NOT NULL default '0',
	    lemin int(11) NOT NULL default '0',
	    leminmax int(11) NOT NULL default '0',
	    schaden tinyint(4) NOT NULL default '0',
	    mission tinyint(4) NOT NULL default '0',
	    frachtraum int(11) NOT NULL default '0',
	    masse int(11) NOT NULL default '0',
	    masse_gesamt int(11) NOT NULL default '0',
	    fracht_leute int(11) NOT NULL default '0',
	    fracht_cantox int(11) NOT NULL default '0',
	    fracht_vorrat int(11) NOT NULL default '0',
	    fracht_min1 int(11) NOT NULL default '0',
	    fracht_min2 int(11) NOT NULL default '0',
	    fracht_min3 int(11) NOT NULL default '0',
	    bild_gross varchar(255) NOT NULL default '',
	    bild_klein varchar(255) NOT NULL default '',
	    energetik_stufe tinyint(4) NOT NULL default '0',
	    energetik_anzahl tinyint(4) NOT NULL default '0',
	    projektile_stufe tinyint(4) NOT NULL default '0',
	    projektile_anzahl tinyint(4) NOT NULL default '0',
	    hanger_anzahl tinyint(4) NOT NULL default '0',
	    schild tinyint(4) NOT NULL default '0',
	    fertigkeiten varchar(255) NOT NULL default '',
	    spezialmission tinyint(4) NOT NULL default '0',
	    tarnfeld tinyint(4) NOT NULL default '0',
	    scanner tinyint(4) NOT NULL default '0',
	    sprungtorbauid int(11) NOT NULL default '0',
	    logbuch text NOT NULL,
	    routing_id varchar(255) NOT NULL default '',
	    routing_koord varchar(255) NOT NULL default '',
	    routing_status tinyint(4) NOT NULL default '0',
	    routing_mins varchar(255) NOT NULL default '',
	    routing_warp tinyint(4) NOT NULL default '0',
	    routing_rohstoff tinyint(4) NOT NULL default '0',
	    routing_tank int(11) NOT NULL default '0',
	    routing_schritt tinyint(4) NOT NULL default '0',
	    sicht varchar(10) NOT NULL default '',
	    spiel int(11) NOT NULL default '0',
	    aggro tinyint(4) NOT NULL default '0',
	    projektile tinyint(4) NOT NULL default '0',
	    projektile_auto tinyint(4) NOT NULL default '0',
	    s_x int(11) NOT NULL default '0',
	    s_y int(11) NOT NULL default '0',
	    erfahrung tinyint(4) NOT NULL default '0',
	    strecke int(11) NOT NULL default '0',
	    traktor_id int(11) NOT NULL default '0',
	    ordner int(11) NOT NULL default '0',
	    extra varchar(255) NOT NULL default '',
	    kox_old int(11) NOT NULL default '0',
	    koy_old int(11) NOT NULL default '0',
	    leichtebt int(11) NOT NULL default '0',
	    schwerebt int(11) NOT NULL default '0',
	    zusatzmodul tinyint(4) NOT NULL default '0',
	    sicht_1 tinyint(4) NOT NULL default '0',
	    sicht_2 tinyint(4) NOT NULL default '0',
	    sicht_3 tinyint(4) NOT NULL default '0',
	    sicht_4 tinyint(4) NOT NULL default '0',
	    sicht_5 tinyint(4) NOT NULL default '0',
	    sicht_6 tinyint(4) NOT NULL default '0',
	    sicht_7 tinyint(4) NOT NULL default '0',
	    sicht_8 tinyint(4) NOT NULL default '0',
	    sicht_9 tinyint(4) NOT NULL default '0',
	    sicht_10 tinyint(4) NOT NULL default '0',
	    sicht_1_beta tinyint(4) NOT NULL default '0',
	    sicht_2_beta tinyint(4) NOT NULL default '0',
	    sicht_3_beta tinyint(4) NOT NULL default '0',
	    sicht_4_beta tinyint(4) NOT NULL default '0',
	    sicht_5_beta tinyint(4) NOT NULL default '0',
	    sicht_6_beta tinyint(4) NOT NULL default '0',
	    sicht_7_beta tinyint(4) NOT NULL default '0',
	    sicht_8_beta tinyint(4) NOT NULL default '0',
	    sicht_9_beta tinyint(4) NOT NULL default '0',
	    sicht_10_beta tinyint(4) NOT NULL default '0',
	    temp_verfolgt INT DEFAULT '0' NOT NULL ,
	    UNIQUE KEY id (id)
	    ) TYPE=MyISAM");

	  @mysql_query("CREATE TABLE $skrupel_spiele (
	    id int(11) NOT NULL auto_increment,
	    sid varchar(20) NOT NULL default '',
	    phase tinyint(4) NOT NULL default '0',
	    ziel_id tinyint(4) NOT NULL default '0',
	    ziel_info varchar(255) NOT NULL default '',
	    module varchar(255) NOT NULL default '',
	    spieler_1 int(11) NOT NULL default '0',
	    spieler_2 int(11) NOT NULL default '0',
	    spieler_3 int(11) NOT NULL default '0',
	    spieler_4 int(11) NOT NULL default '0',
	    spieler_5 int(11) NOT NULL default '0',
	    spieler_6 int(11) NOT NULL default '0',
	    spieler_7 int(11) NOT NULL default '0',
	    spieler_8 int(11) NOT NULL default '0',
	    spieler_9 int(11) NOT NULL default '0',
	    spieler_10 int(11) NOT NULL default '0',
	    spieleranzahl tinyint(4) NOT NULL default '0',
	    spieler_1_zug tinyint(4) NOT NULL default '0',
	    spieler_2_zug tinyint(4) NOT NULL default '0',
	    spieler_3_zug tinyint(4) NOT NULL default '0',
	    spieler_4_zug tinyint(4) NOT NULL default '0',
	    spieler_5_zug tinyint(4) NOT NULL default '0',
	    spieler_6_zug tinyint(4) NOT NULL default '0',
	    spieler_7_zug tinyint(4) NOT NULL default '0',
	    spieler_8_zug tinyint(4) NOT NULL default '0',
	    spieler_9_zug tinyint(4) NOT NULL default '0',
	    spieler_10_zug tinyint(4) NOT NULL default '0',
	    lasttick varchar(20) NOT NULL default '',
	    spieler_1_basen tinyint(4) NOT NULL default '0',
	    spieler_1_planeten tinyint(4) NOT NULL default '0',
	    spieler_1_schiffe tinyint(4) NOT NULL default '0',
	    spieler_2_basen tinyint(4) NOT NULL default '0',
	    spieler_2_planeten tinyint(4) NOT NULL default '0',
	    spieler_2_schiffe tinyint(4) NOT NULL default '0',
	    spieler_3_basen tinyint(4) NOT NULL default '0',
	    spieler_3_planeten tinyint(4) NOT NULL default '0',
	    spieler_3_schiffe tinyint(4) NOT NULL default '0',
	    spieler_4_basen tinyint(4) NOT NULL default '0',
	    spieler_4_planeten tinyint(4) NOT NULL default '0',
	    spieler_4_schiffe tinyint(4) NOT NULL default '0',
	    spieler_5_basen tinyint(4) NOT NULL default '0',
	    spieler_5_planeten tinyint(4) NOT NULL default '0',
	    spieler_5_schiffe tinyint(4) NOT NULL default '0',
	    spieler_6_basen tinyint(4) NOT NULL default '0',
	    spieler_6_planeten tinyint(4) NOT NULL default '0',
	    spieler_6_schiffe tinyint(4) NOT NULL default '0',
	    spieler_7_basen tinyint(4) NOT NULL default '0',
	    spieler_7_planeten tinyint(4) NOT NULL default '0',
	    spieler_7_schiffe tinyint(4) NOT NULL default '0',
	    spieler_8_basen tinyint(4) NOT NULL default '0',
	    spieler_8_planeten tinyint(4) NOT NULL default '0',
	    spieler_8_schiffe tinyint(4) NOT NULL default '0',
	    spieler_9_basen tinyint(4) NOT NULL default '0',
	    spieler_9_planeten tinyint(4) NOT NULL default '0',
	    spieler_9_schiffe tinyint(4) NOT NULL default '0',
	    spieler_10_basen tinyint(4) NOT NULL default '0',
	    spieler_10_planeten tinyint(4) NOT NULL default '0',
	    spieler_10_schiffe tinyint(4) NOT NULL default '0',
	    letztermonat text NOT NULL,
	    spieler_1_rasse varchar(255) NOT NULL default '',
	    spieler_2_rasse varchar(255) NOT NULL default '',
	    spieler_3_rasse varchar(255) NOT NULL default '',
	    spieler_4_rasse varchar(255) NOT NULL default '',
	    spieler_5_rasse varchar(255) NOT NULL default '',
	    spieler_6_rasse varchar(255) NOT NULL default '',
	    spieler_7_rasse varchar(255) NOT NULL default '',
	    spieler_8_rasse varchar(255) NOT NULL default '',
	    spieler_9_rasse varchar(255) NOT NULL default '',
	    spieler_10_rasse varchar(255) NOT NULL default '',
	    autozug tinyint(4) NOT NULL default '0',
	    nebel tinyint(4) NOT NULL default '0',
	    spieler_1_platz tinyint(4) NOT NULL default '0',
	    spieler_2_platz tinyint(4) NOT NULL default '0',
	    spieler_3_platz tinyint(4) NOT NULL default '0',
	    spieler_4_platz tinyint(4) NOT NULL default '0',
	    spieler_5_platz tinyint(4) NOT NULL default '0',
	    spieler_6_platz tinyint(4) NOT NULL default '0',
	    spieler_7_platz tinyint(4) NOT NULL default '0',
	    spieler_8_platz tinyint(4) NOT NULL default '0',
	    spieler_9_platz tinyint(4) NOT NULL default '0',
	    spieler_10_platz tinyint(4) NOT NULL default '0',
	    name varchar(50) NOT NULL default '',
	    runde int(11) NOT NULL default '0',
	    plasma_wahr tinyint(4) NOT NULL default '0',
	    plasma_max tinyint(4) NOT NULL default '0',
	    plasma_lang tinyint(4) NOT NULL default '0',
	    spieler_admin tinyint(4) NOT NULL default '0',
	    spieler_1_raus tinyint(4) NOT NULL default '0',
	    spieler_2_raus tinyint(4) NOT NULL default '0',
	    spieler_3_raus tinyint(4) NOT NULL default '0',
	    spieler_4_raus tinyint(4) NOT NULL default '0',
	    spieler_5_raus tinyint(4) NOT NULL default '0',
	    spieler_6_raus tinyint(4) NOT NULL default '0',
	    spieler_7_raus tinyint(4) NOT NULL default '0',
	    spieler_8_raus tinyint(4) NOT NULL default '0',
	    spieler_9_raus tinyint(4) NOT NULL default '0',
	    spieler_10_raus tinyint(4) NOT NULL default '0',
	    spieler_1_ziel varchar(255) NOT NULL default '',
	    spieler_2_ziel varchar(255) NOT NULL default '',
	    spieler_3_ziel varchar(255) NOT NULL default '',
	    spieler_4_ziel varchar(255) NOT NULL default '',
	    spieler_5_ziel varchar(255) NOT NULL default '',
	    spieler_6_ziel varchar(255) NOT NULL default '',
	    spieler_7_ziel varchar(255) NOT NULL default '',
	    spieler_8_ziel varchar(255) NOT NULL default '',
	    spieler_9_ziel varchar(255) NOT NULL default '',
	    spieler_10_ziel varchar(255) NOT NULL default '',
	    piraten_mitte tinyint(4) NOT NULL default '0',
	    piraten_aussen tinyint(4) NOT NULL default '0',
	    piraten_min tinyint(4) NOT NULL default '0',
	    piraten_max tinyint(4) NOT NULL default '0',
	    gewinner varchar(255) NOT NULL default '',
	    siegeranzahl tinyint(4) NOT NULL default '0',
	    spieler_1_rassename varchar(40) NOT NULL default '',
	    spieler_2_rassename varchar(40) NOT NULL default '',
	    spieler_3_rassename varchar(40) NOT NULL default '',
	    spieler_4_rassename varchar(40) NOT NULL default '',
	    spieler_5_rassename varchar(40) NOT NULL default '',
	    spieler_6_rassename varchar(40) NOT NULL default '',
	    spieler_7_rassename varchar(40) NOT NULL default '',
	    spieler_8_rassename varchar(40) NOT NULL default '',
	    spieler_9_rassename varchar(40) NOT NULL default '',
	    spieler_10_rassename varchar(40) NOT NULL default '',
	    oput int(11) NOT NULL default '0',
	    umfang int(11) NOT NULL default '0',
	    aufloesung int(11) NOT NULL default '0',
	    passwort varchar(20) NOT NULL,
	    rassenerlaubt varchar(255) NOT NULL,
	    kommentar varchar(255) NOT NULL,
	    jabber varchar(255) NOT NULL,
	    spieler_1_hash CHAR(20) NOT NULL,
        spieler_2_hash CHAR(20) NOT NULL,
        spieler_3_hash CHAR(20) NOT NULL,
        spieler_4_hash CHAR(20) NOT NULL,
        spieler_5_hash CHAR(20) NOT NULL,
        spieler_6_hash CHAR(20) NOT NULL,
        spieler_7_hash CHAR(20) NOT NULL,
        spieler_8_hash CHAR(20) NOT NULL,
        spieler_9_hash CHAR(20) NOT NULL,
        spieler_10_hash CHAR(20) NOT NULL,
	    UNIQUE KEY id (id)
	    ) TYPE=MyISAM");

	  @mysql_query("CREATE TABLE $skrupel_sternenbasen (
	    id int(11) NOT NULL auto_increment,
	    name varchar(20) NOT NULL default '',
	    x_pos int(11) NOT NULL default '0',
	    y_pos int(11) NOT NULL default '0',
	    rasse varchar(255) NOT NULL default '',
	    planetid int(11) NOT NULL default '0',
	    besitzer tinyint(4) NOT NULL default '0',
	    status tinyint(4) NOT NULL default '0',
	    schaden tinyint(4) NOT NULL default '0',
	    t_huelle tinyint(4) NOT NULL default '0',
	    t_antrieb tinyint(4) NOT NULL default '0',
	    t_energie tinyint(4) NOT NULL default '0',
	    t_explosiv tinyint(4) NOT NULL default '0',
	    defense int(11) NOT NULL default '0',
	    jaeger tinyint(4) NOT NULL default '0',
	    vorrat_antrieb_1 tinyint(4) NOT NULL default '0',
	    vorrat_antrieb_2 tinyint(4) NOT NULL default '0',
	    vorrat_antrieb_3 tinyint(4) NOT NULL default '0',
	    vorrat_antrieb_4 tinyint(4) NOT NULL default '0',
	    vorrat_antrieb_5 tinyint(4) NOT NULL default '0',
	    vorrat_antrieb_6 tinyint(4) NOT NULL default '0',
	    vorrat_antrieb_7 tinyint(4) NOT NULL default '0',
	    vorrat_antrieb_8 tinyint(4) NOT NULL default '0',
	    vorrat_antrieb_9 tinyint(4) NOT NULL default '0',
	    vorrat_energetik_1 tinyint(4) NOT NULL default '0',
	    vorrat_energetik_2 tinyint(4) NOT NULL default '0',
	    vorrat_energetik_3 tinyint(4) NOT NULL default '0',
	    vorrat_energetik_4 tinyint(4) NOT NULL default '0',
	    vorrat_energetik_5 tinyint(4) NOT NULL default '0',
	    vorrat_energetik_6 tinyint(4) NOT NULL default '0',
	    vorrat_energetik_7 tinyint(4) NOT NULL default '0',
	    vorrat_energetik_8 tinyint(4) NOT NULL default '0',
	    vorrat_energetik_9 tinyint(4) NOT NULL default '0',
	    vorrat_energetik_10 tinyint(4) NOT NULL default '0',
	    vorrat_projektile_1 tinyint(4) NOT NULL default '0',
	    vorrat_projektile_2 tinyint(4) NOT NULL default '0',
	    vorrat_projektile_3 tinyint(4) NOT NULL default '0',
	    vorrat_projektile_4 tinyint(4) NOT NULL default '0',
	    vorrat_projektile_5 tinyint(4) NOT NULL default '0',
	    vorrat_projektile_6 tinyint(4) NOT NULL default '0',
	    vorrat_projektile_7 tinyint(4) NOT NULL default '0',
	    vorrat_projektile_8 tinyint(4) NOT NULL default '0',
	    vorrat_projektile_9 tinyint(4) NOT NULL default '0',
	    vorrat_projektile_10 tinyint(4) NOT NULL default '0',
	    schiffbau_status tinyint(4) NOT NULL default '0',
	    schiffbau_klasse tinyint(4) NOT NULL default '0',
	    schiffbau_bild_gross varchar(255) NOT NULL default '',
	    schiffbau_bild_klein varchar(255) NOT NULL default '',
	    schiffbau_crew int(11) NOT NULL default '0',
	    schiffbau_masse int(11) NOT NULL default '0',
	    schiffbau_tank int(11) NOT NULL default '0',
	    schiffbau_fracht int(11) NOT NULL default '0',
	    schiffbau_antriebe tinyint(4) NOT NULL default '0',
	    schiffbau_energetik tinyint(4) NOT NULL default '0',
	    schiffbau_projektile tinyint(4) NOT NULL default '0',
	    schiffbau_hangar tinyint(4) NOT NULL default '0',
	    schiffbau_klasse_name varchar(25) NOT NULL default '',
	    schiffbau_rasse varchar(255) NOT NULL default '',
	    schiffbau_fertigkeiten varchar(255) NOT NULL default '',
	    schiffbau_energetik_stufe tinyint(4) NOT NULL default '0',
	    schiffbau_projektile_stufe tinyint(4) NOT NULL default '0',
	    schiffbau_techlevel tinyint(4) NOT NULL default '0',
	    schiffbau_antriebe_stufe tinyint(4) NOT NULL default '0',
	    schiffbau_name varchar(25) NOT NULL default '',
	    logbuch text NOT NULL,
	    sicht varchar(10) NOT NULL default '',
	    spiel int(11) NOT NULL default '0',
	    schiffbau_extra varchar(255) NOT NULL default '',
	    art tinyint(4) NOT NULL default '0',
	    schiffbau_zusatz tinyint(4) NOT NULL default '0',
	    sicht_1 tinyint(4) NOT NULL default '0',
	    sicht_2 tinyint(4) NOT NULL default '0',
	    sicht_3 tinyint(4) NOT NULL default '0',
	    sicht_4 tinyint(4) NOT NULL default '0',
	    sicht_5 tinyint(4) NOT NULL default '0',
	    sicht_6 tinyint(4) NOT NULL default '0',
	    sicht_7 tinyint(4) NOT NULL default '0',
	    sicht_8 tinyint(4) NOT NULL default '0',
	    sicht_9 tinyint(4) NOT NULL default '0',
	    sicht_10 tinyint(4) NOT NULL default '0',
	    PRIMARY KEY  (id),
	    UNIQUE KEY id (id)
	    ) TYPE=MyISAM");

	  @mysql_query("CREATE TABLE $skrupel_user (
	    id int(11) NOT NULL auto_increment,
	    nick varchar(30) NOT NULL default '',
	    passwort varchar(30) NOT NULL default '',
	    email varchar(255) NOT NULL default '',
	    uid varchar(20) NOT NULL default '',
	    icq varchar(20) NOT NULL default '',
	    jabber varchar(255) NOT NULL default '',
	    optionen varchar(255) NOT NULL default '',
	    chatfarbe varchar(6) NOT NULL default 'ffffff',
	    stat_teilnahme int(11) NOT NULL default '0',
	    stat_sieg int(11) NOT NULL default '0',
	    stat_schlacht int(11) NOT NULL default '0',
	    stat_schlacht_sieg int(11) NOT NULL default '0',
	    stat_kol_erobert int(11) NOT NULL default '0',
	    stat_lichtjahre bigint(20) NOT NULL default '0',
	    stat_monate int(11) NOT NULL default '0',
	    bildpfad varchar(255) NOT NULL default '',
	    avatar varchar(255) NOT NULL default '',
	    sprache varchar(255) NOT NULL default '$language',
	    UNIQUE KEY id (id)
	    ) TYPE=MyISAM");

	  @mysql_query("CREATE TABLE $skrupel_konplaene (
	    id int(11) NOT NULL auto_increment,
	    besitzer int(11) NOT NULL default '0',
	    spiel int(11) NOT NULL default '0',
	    rasse varchar(255) NOT NULL default '',
	    klasse varchar(25) NOT NULL default '',
	    klasse_id int(11) NOT NULL default '0',
	    techlevel tinyint(4) NOT NULL default '0',
	    sonstiges text NOT NULL,
	    PRIMARY KEY  (id)
	    ) TYPE=MyISAM");

	  @mysql_query("CREATE TABLE $skrupel_ordner (
	    id int(11) NOT NULL auto_increment,
	    name varchar(20) NOT NULL default '',
	    besitzer int(11) NOT NULL default '0',
	    spiel int(11) NOT NULL default '0',
	    icon tinyint(4) NOT NULL,
	    PRIMARY KEY  (id)
	    ) TYPE=MyISAM");

	  @mysql_query("CREATE TABLE $skrupel_begegnung (
	    id INT NOT NULL AUTO_INCREMENT,
	    partei_a TINYINT NOT NULL,
	    partei_b TINYINT NOT NULL,
	    spiel INT NOT NULL,
	    PRIMARY KEY (id)
	    ) TYPE=MyISAM");


	  $zeiger = @mysql_query("SELECT version FROM $skrupel_info");
	  $array = @mysql_fetch_array($zeiger);
	  if ($array["version"] == "0.972") {
	    $installed = true;
	  } else {
	    $installed = false;
      }
      if ($installed) {
?>
      Skrupel wurde installiert. Du kannst dich jetzt unter http://{DEIN-SKRUPEL-SERVER}/admin/ mit deinem<br>
      gew&auml;hlten Adminnamen und Passwort einloggen, einen User erstellen und dein erstes Spiel starten.<br><br>
      Viel Spass, und danke, dass du Skrupel installiert hast!<br><br>
      Bitte l&ouml;sche diese Datei (install.php) jetzt.
<?php
      } else {
        echo "Installation aus unbekannten Gr&uuml;nden fehlgeschlagen.<br>Bitte versuche es erneut (inc.conf.php &uuml;berpr&uuml;fen und Seite neuladen).<br>Sollte es weiterhin nicht gehen, melde dich bitte im Forum.";
      }
  }

@mysql_close();
?>

        </center></td>
				<td><img src="bilder/empty.gif" border="0" width="1" height="347"></td>
			 </tr>
			 <tr>
				<td><img src="bilder/empty.gif" border="0" width="1" height="1"></td>
				<td><img src="bilder/empty.gif" border="0" width="628" height="1"></td>
				<td><img src="bilder/empty.gif" border="0" width="1" height="1"></td>
			 </tr>
	  </table></td>
	</tr>
</table></center>
</body>
</html>
