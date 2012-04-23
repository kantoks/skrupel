<?php
/*
:noTabs=false:indentSize=4:tabSize=4:folding=explicit:collapseFolds=1:
*/

require_once ('../inc.conf.php');
require_once ('inc.hilfsfunktionen.php');

open_db();

include ('inc.check.php');
if (!empty($langfile_1)) include ('../lang/'.$spieler_sprache.'/lang.'.$langfile_1.'.php');
if (!empty($langfile_2)) include ('../lang/'.$spieler_sprache.'/lang.'.$langfile_2.'.php');

$zeiger = @mysql_query("SELECT * FROM $skrupel_info");
$array = @mysql_fetch_array($zeiger);
$spiel_chat      = $array['chat'];
$spiel_anleitung = $array['anleitung'];
$spiel_forum     = $array['forum'];
$spiel_forum_url = $array['forum_url'];
$spiel_version   = $array['version'];
$spiel_extend    = $array['extend'];
$spiel_serial    = $array['serial'];

$useragent = getEnv("HTTP_USER_AGENT");

//compressed_output();

//ob_start("ob_gzhandler", 65536);

$firefox = preg_match("=firefox=i", $useragent);
$linux = preg_match("=linux=i", $useragent);

$plus=0;
if ($linux) { $plus=1; }
?>
<html>
<head>
    <meta name="Author" content="Bernd Kantoks bernd@kantoks.de">
    <meta http-equiv="imagetoolbar" content="no">
    <style type="text/css">
        body,p,td {
            font-family: Verdana;
            font-size: <?php echo 10-$plus; ?>px;
            color: #ffffff;
            scrollbar-darkshadow-color: #444444;
            scrollbar-3dlight-color: #444444;
            scrollbar-track-color: #444444;
            scrollbar-face-color: #555555;
            scrollbar-shadow-color: #222222;
            scrollbar-highlight-color: #888888;
            scrollbar-arrow-color: #555555;
        }
        td.weissklein {
            font-family: Verdana;
            font-size: <?php echo 10-$plus; ?>px;
            color: #ffffff;
        }
        td.weissgross {
            font-family: Verdana;
            font-size: <?php echo 12-$plus; ?>px;
            color: #ffffff;
        }
        a {
            color: #aaaaaa;
            font-weight: normal;
            text-decoration: none;
        }
        a:hover {
            font-weight: normal;
            text-decoration: underline;
            color: #ffffff;
        }
        input,select {
            background-color: #555555;
            color: #ffffff;
            border-bottom-color: #222222;
            border-left-color: #888888;
            border-right-color: #222222;
            border-top-color: #888888;
            Border-style: solid;
            Border-width: 1px;
            font-family: Verdana;
            font-size: <?php echo 10-$plus; ?>px;
        }
        input.nofunc {
            background-color: #555555;
            color: #777777;
            border-bottom-color: #222222;
            border-left-color: #888888;
            border-right-color: #222222;
            border-top-color: #888888;
            Border-style: solid;
            Border-width: 1px;
            font-family: Verdana;
            font-size: <?php echo 10-$plus; ?>px;
        }
        input.eingabe {
            background-color: #555555;
            color: #ffffff;
            border-bottom-color: #888888;
            border-left-color: #222222;
            border-right-color: #888888;
            border-top-color: #222222;
            Border-style: solid;
            Border-width: 1px;
            font-family: Verdana;
            font-size: <?php echo 10-$plus; ?>px;
        }
        textarea {
            background-color: #555555;
            color: #ffffff;
            border-bottom-color: #888888;
            border-left-color: #222222;
            border-right-color: #888888;
            border-top-color: #222222;
            Border-style: solid;
            Border-width: 1px;
            font-family: Verdana;
            font-size: <?php echo 10-$plus; ?>px;
        }
    </style>
    <script language=JavaScript>
        function hilfe(hid) {
            oben=100;
            links=Math.ceil((screen.width-480)/2);
            window.open('hilfe.php?fu2='+hid+'&uid=<?php echo $uid; ?>&sid=<?php echo $sid;?>','Hilfe','resizable=yes,scrollbars=no,width=480,height=180,top='+oben+',left='+links);
        }
    </script>
    <link href="js/flexcroll/standard_grey.css" rel="stylesheet" type="text/css" />
    <?php 
        $showNot = array('meta_simulation.php', 'flotte_beta.php', 'basen_alpha.php');
        if ((@intval(substr($spieler_optionen,17,1))!=1) and (!in_array(basename($_SERVER['PHP_SELF']), $showNot))) { ?>
        <script type="text/javascript" src="js/flexcroll/flexcroll.js"></script>   
    <?php } ?>   
</head>