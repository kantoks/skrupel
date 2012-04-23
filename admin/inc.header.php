<?php
require_once ('../inc.conf.php'); 
require_once ('../inhalt/inc.hilfsfunktionen.php');
open_db();
$zeiger = @mysql_query("SELECT * FROM $skrupel_info");
$array = @mysql_fetch_array($zeiger);
$spiel_chat      = $array['chat'];
$spiel_anleitung = $array['anleitung'];
$spiel_forum     = $array['forum'];
$spiel_forum_url = $array['forum_url'];
$spiel_version   = $array['version'];
$spiel_extend    = $array['extend'];
$spiel_serial    = $array['serial'];

compressed_output();
session_name('skrupelAdmin');
session_start();
isset($_SESSION['ftploginname']) or die();
$ftploginname=$_SESSION['ftploginname'];
$ftploginpass=$_SESSION["ftploginpass"];
?>
<html>
<head>
  <META NAME="Author" CONTENT="Bernd Kantoks bernd@kantoks.de">
  <META HTTP-EQUIV="imagetoolbar" CONTENT="no">
<style type="text/css">
BODY,P,TD{
    font-family: Verdana;
    font-size: 10px;
    color: #ffffff;
    scrollbar-DarkShadow-Color:#444444;
    scrollbar-3dLight-Color:#444444;
    scrollbar-Track-Color:#444444;
    scrollbar-Face-Color:#555555;
    scrollbar-Shadow-Color:#222222;
    scrollbar-Highlight-Color:#888888;
    scrollbar-Arrow-Color:#555555;
}
TD.weissklein{
    font-family:Verdana;
    font-size:  10px;
    color: #ffffff;
}
TD.weissgross{
    font-family: Verdana;
    font-size: 12px;
    color: #ffffff;
}
A{
    color:                        #aaaaaa;
    font-weight:                normal;
    text-decoration:        none;
}
A:Hover{
    font-weight:                normal;
    text-decoration:        underline;
    color:                        #ffffff;
}
INPUT,SELECT{
    background-color:#555555;
    color:#ffffff;
    BORDER-BOTTOM-COLOR: #222222;
    BORDER-LEFT-COLOR: #888888;
    BORDER-RIGHT-COLOR: #222222;
    BORDER-TOP-COLOR: #888888;
    Border-Style: solid;
    Border-Width: 1px;
    font-family: Verdana;
    font-size: 10px;
}
INPUT.nofunc{
    background-color: #555555;
    color: #777777;
    BORDER-BOTTOM-COLOR: #222222;
    BORDER-LEFT-COLOR: #888888;
    BORDER-RIGHT-COLOR: #222222;
    BORDER-TOP-COLOR: #888888;
    Border-Style: solid;
    Border-Width: 1px;
    font-family: Verdana;
    font-size: 10px;
}
INPUT.eingabe{
    background-color: #555555;
    color: #ffffff;
    BORDER-BOTTOM-COLOR: #888888;
    BORDER-LEFT-COLOR: #222222;
    BORDER-RIGHT-COLOR: #888888;
    BORDER-TOP-COLOR: #222222;
    Border-Style: solid;
    Border-Width: 1px;
    font-family: Verdana;
    font-size: 10px;
}
INPUT.bild{
    background-color:#444444;
    Border-Style: solid;
    Border-Width: 0px;
}
TEXTAREA{
    background-color:#555555;
    color:#ffffff;
    BORDER-BOTTOM-COLOR: #888888;
    BORDER-LEFT-COLOR: #222222;
    BORDER-RIGHT-COLOR: #888888;
    BORDER-TOP-COLOR: #222222;
    Border-Style: solid;
    Border-Width: 1px;
    font-family: Verdana;
    font-size: 10px;
}
</style>
</head>
