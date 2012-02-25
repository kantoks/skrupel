<?php 
include ('../inc.conf.php');
include_once ('inc.hilfsfunktionen.php');

$sprache = str_get('sprache','SHORTNAME');
if ($sprache=='' || !preg_match('/^[a-z]{2}$/', $sprache) || !is_dir('../lang/'.$sprache)) {$sprache = $language;}
include ('../lang/'.$sprache.'/lang.runde_ende.php');

$bildpfad = str_get('bildpfad','PATHNAME');
if ($bildpfad=='' or $bildpfad=='bilder') {$bildpfad='../bilder';}

$spiel = int_get('spiel');
$fuid = int_get('fu');

if ($fuid==1) {
    ?>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
            <title>Skrupel - Tribute Compilaton V<?php echo $spiel_version?></title>
            <META NAME="Author" CONTENT="Bernd Kantoks bernd@kantoks.de">
            <meta name="robots" content="index">
            <meta name="keywords" content=" ">
            <script language="JavaScript">
                if(parent.frames.length>=1) {
                    window.top.location.href="runde_ende.php?fu=1&spiel=<?php echo $spiel?>&bildpfad=<?php echo $bildpfad?>";
                }
            </script>
        </head>
        <frameset framespacing="0" border="false" frameborder="0" rows="*,18,508,16,*">
            <frame name="rahmenk" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=0" target="_self">
            <frameset framespacing="0" border="false" frameborder="0" cols="*,114,670,114,*">
                <frame name="rahmen0" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=0&bildpfad=<?php echo $bildpfad?>" target="_self">
                <frame name="rahmen1" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=19&bildpfad=<?php echo $bildpfad?>" target="_self">
                <frame name="rahmen2" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=20&bildpfad=<?php echo $bildpfad?>" target="_self">
                <frame name="rahmen3" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=21&bildpfad=<?php echo $bildpfad?>" target="_self">
                <frame name="rahmen4" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=0&bildpfad=<?php echo $bildpfad?>" target="_self">
            </frameset>
            <frameset framespacing="0" border="false" frameborder="0" cols="*,18,862,18,*">
                <frame name="rahmen10" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=0&bildpfad=<?php echo $bildpfad?>" target="_self">
                <frameset framespacing="0" border="false" frameborder="0" rows="80,*,92">
                    <frame name="rahmen15" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=25&bildpfad=<?php echo $bildpfad?>" target="_self">
                    <frame name="rahmen16" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=26&bildpfad=<?php echo $bildpfad?>" target="_self">
                    <frame name="rahmen17" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=27&bildpfad=<?php echo $bildpfad?>" target="_self">
                </frameset>
                <frame name="rahmen12" scrolling="auto" marginwidth="0" marginheight="0" noresize src="runde_ende.php?fu=2&spiel=<?php echo $spiel?>&bildpfad=<?php echo $bildpfad?><?php if (!empty($_GET['sprache'])) echo '&sprache='.$sprache;?>" target="_self">
                <frameset framespacing="0" border="false" frameborder="0" rows="80,*,92">
                    <frame name="rahmen18" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=28&bildpfad=<?php echo $bildpfad?>" target="_self">
                    <frame name="rahmen19" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=29&bildpfad=<?php echo $bildpfad?>" target="_self">
                    <frame name="rahmen20" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=30&bildpfad=<?php echo $bildpfad?>" target="_self">
                </frameset>
                <frame name="rahmen14" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=0&bildpfad=<?php echo $bildpfad?>" target="_self">
            </frameset>
            <frameset framespacing="0" border="false" frameborder="0" cols="*,114,670,114,*">
                <frame name="rahmen5" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=0&bildpfad=<?php echo $bildpfad?>" target="_self">
                <frame name="rahmen6" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=22&bildpfad=<?php echo $bildpfad?>" target="_self">
                <frame name="rahmen7" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=23&bildpfad=<?php echo $bildpfad?>" target="_self">
                <frame name="rahmen8" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=24&bildpfad=<?php echo $bildpfad?>" target="_self">
                <frame name="rahmen9" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=0&bildpfad=<?php echo $bildpfad?>" target="_self">
            </frameset>
            <frame name="rahmenk" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=0&bildpfad=<?php echo $bildpfad?>" target="_self">
        </frameset>
        <noframes>
        <body>
        </body>
    </html>
    <?php 
}
if ($fuid==2) {
    $conn = @mysql_connect($server.':'.$port,"$login","$password");
    $db = @mysql_select_db("$database",$conn);
    $zeiger = @mysql_query("SELECT extend,serial FROM $skrupel_info");
    $array = @mysql_fetch_array($zeiger);
    $spiel_extend=$array["extend"];
    $spiel_serial=$array["serial"];
    compressed_output();
    $zeiger = @mysql_query("SELECT * FROM $skrupel_spiele where phase=1 and id=".$spiel);
    $datensaetze = @mysql_num_rows($zeiger);
    if ($datensaetze==1) {
        $array = @mysql_fetch_array($zeiger);
        $spieler_1_basen=$array["spieler_1_basen"];$spieler_1_planeten=$array["spieler_1_planeten"];$spieler_1_schiffe=$array["spieler_1_schiffe"];
        $spieler_2_basen=$array["spieler_2_basen"];$spieler_2_planeten=$array["spieler_2_planeten"];$spieler_2_schiffe=$array["spieler_2_schiffe"];
        $spieler_3_basen=$array["spieler_3_basen"];$spieler_3_planeten=$array["spieler_3_planeten"];$spieler_3_schiffe=$array["spieler_3_schiffe"];
        $spieler_4_basen=$array["spieler_4_basen"];$spieler_4_planeten=$array["spieler_4_planeten"];$spieler_4_schiffe=$array["spieler_4_schiffe"];
        $spieler_5_basen=$array["spieler_5_basen"];$spieler_5_planeten=$array["spieler_5_planeten"];$spieler_5_schiffe=$array["spieler_5_schiffe"];
        $spieler_6_basen=$array["spieler_6_basen"];$spieler_6_planeten=$array["spieler_6_planeten"];$spieler_6_schiffe=$array["spieler_6_schiffe"];
        $spieler_7_basen=$array["spieler_7_basen"];$spieler_7_planeten=$array["spieler_7_planeten"];$spieler_7_schiffe=$array["spieler_7_schiffe"];
        $spieler_8_basen=$array["spieler_8_basen"];$spieler_8_planeten=$array["spieler_8_planeten"];$spieler_8_schiffe=$array["spieler_8_schiffe"];
        $spieler_9_basen=$array["spieler_9_basen"];$spieler_9_planeten=$array["spieler_9_planeten"];$spieler_9_schiffe=$array["spieler_9_schiffe"];
        $spieler_10_basen=$array["spieler_10_basen"];$spieler_10_planeten=$array["spieler_10_planeten"];$spieler_10_schiffe=$array["spieler_10_schiffe"];
        $spieler_1_gesamt=$array["spieler_1_platz"];
        $spieler_2_gesamt=$array["spieler_2_platz"];
        $spieler_3_gesamt=$array["spieler_3_platz"];
        $spieler_4_gesamt=$array["spieler_4_platz"];
        $spieler_5_gesamt=$array["spieler_5_platz"];
        $spieler_6_gesamt=$array["spieler_6_platz"];
        $spieler_7_gesamt=$array["spieler_7_platz"];
        $spieler_8_gesamt=$array["spieler_8_platz"];
        $spieler_9_gesamt=$array["spieler_9_platz"];
        $spieler_10_gesamt=$array["spieler_10_platz"];
        $ziel_id=$array["ziel_id"];
        $ziel_info=$array["ziel_info"];
        $spieler_1_ziel=$array["spieler_1_ziel"];
        $spieler_2_ziel=$array["spieler_2_ziel"];
        $spieler_3_ziel=$array["spieler_3_ziel"];
        $spieler_4_ziel=$array["spieler_4_ziel"];
        $spieler_5_ziel=$array["spieler_5_ziel"];
        $spieler_6_ziel=$array["spieler_6_ziel"];
        $spieler_7_ziel=$array["spieler_7_ziel"];
        $spieler_8_ziel=$array["spieler_8_ziel"];
        $spieler_9_ziel=$array["spieler_9_ziel"];
        $spieler_10_ziel=$array["spieler_10_ziel"];
        $spieler_1=$array["spieler_1"];
        $spieler_2=$array["spieler_2"];
        $spieler_3=$array["spieler_3"];
        $spieler_4=$array["spieler_4"];
        $spieler_5=$array["spieler_5"];
        $spieler_6=$array["spieler_6"];
        $spieler_7=$array["spieler_7"];
        $spieler_8=$array["spieler_8"];
        $spieler_9=$array["spieler_9"];
        $spieler_10=$array["spieler_10"];
        $spieler_1_raus=$array["spieler_1_raus"];
        $spieler_2_raus=$array["spieler_2_raus"];
        $spieler_3_raus=$array["spieler_3_raus"];
        $spieler_4_raus=$array["spieler_4_raus"];
        $spieler_5_raus=$array["spieler_5_raus"];
        $spieler_6_raus=$array["spieler_6_raus"];
        $spieler_7_raus=$array["spieler_7_raus"];
        $spieler_8_raus=$array["spieler_8_raus"];
        $spieler_9_raus=$array["spieler_9_raus"];
        $spieler_10_raus=$array["spieler_10_raus"];
        $spiel_name=$array["name"];
        $gewinner=$array["gewinner"];
        $siegeranzahl=$array["siegeranzahl"];
        $runde=$array["runde"];
        $lasttick=$array["lasttick"];
        $autotick=$array["autozug"];
        if ($lasttick>=1) {
            $datum=date('d.m.y G:i',$lasttick);
        } else {
            $datum="noch keinen";
        }
        if ($autotick>=1) {
            $autot=$lang['rundeende']['alle'].' '.$autotick.' '.$lang['rundeende']['stunden'];
        } else {
            $autot=$lang['rundeende']['niemals'];
        }
        $runde=round($runde/12*100)/100;
        $spieler_ids[1]=$spieler_1;
        $spieler_ids[2]=$spieler_2;
        $spieler_ids[3]=$spieler_3;
        $spieler_ids[4]=$spieler_4;
        $spieler_ids[5]=$spieler_5;
        $spieler_ids[6]=$spieler_6;
        $spieler_ids[7]=$spieler_7;
        $spieler_ids[8]=$spieler_8;
        $spieler_ids[9]=$spieler_9;
        $spieler_ids[10]=$spieler_10;
        if ($ziel_id==0) {
            $siegb=$lang['rundeende']['justforfun'];
            if ($siegeranzahl>1) {
            $gewinner=str_replace(array('{1}'),array($gewinner),$lang['rundeende']['justforfun2']);
                } else {
                $gewinner=str_replace(array('{1}'),array($gewinner),$lang['rundeende']['justforfun1']);
            }
        }elseif ($ziel_id==1) {
            $siegb=str_replace(array('{1}'),array($ziel_info),$lang['rundeende']['ueberlebe']);
            if ($siegeranzahl>1) {
                $gewinner=str_replace(array('{1}'),array($gewinner),$lang['rundeende']['ueberleben2']);
            } else {
                $gewinner=str_replace(array('{1}'),array($gewinner),$lang['rundeende']['ueberleben1']);
            }
        }elseif ($ziel_id==2) {
            $siegb=$lang['rundeende']['todfeind'];
            if ($siegeranzahl>1) {
                $gewinner=str_replace(array('{1}'),array($gewinner),$lang['rundeende']['todfeind2']);
            } else {
                $gewinner=str_replace(array('{1}'),array($gewinner),$lang['rundeende']['todfeind1']);
            }
        }elseif ($ziel_id==5) {
            $siegb=str_replace(array('{1}'),array($ziel_info),$lang['rundeende']['spice']);
            if ($siegeranzahl>1) {
                $gewinner=str_replace(array('{1}'),array($gewinner),$lang['rundeende']['spice2']);
            } else {
                $gewinner=str_replace(array('{1}'),array($gewinner),$lang['rundeende']['spice1']);
            }
        }elseif ($ziel_id==6) {
            $siegb=$lang['rundeende']['teamtodfeind'];
            if ($siegeranzahl>1) {
                $gewinner=str_replace(array('{1}'),array($gewinner),$lang['rundeende']['teamtodfeind2']);
            } else {
                $gewinner=str_replace(array('{1}'),array($gewinner),$lang['rundeende']['teamtodfeind1']);
            }
        }
        ?>
        <html>
            <head>
                 <META NAME="Author" CONTENT="Bernd Kantoks bernd@kantoks.de">
                 <META HTTP-EQUIV="imagetoolbar" CONTENT="no">
                <style type="text/css">
                    BODY,P,TD{
                        font-family:    Verdana;
                        font-size:    10px;
                        color:        #ffffff;
                        scrollbar-DarkShadow-Color:#444444;
                        scrollbar-3dLight-Color:#444444;
                        scrollbar-Track-Color:#444444;
                        scrollbar-Face-Color:#555555;
                        scrollbar-Shadow-Color:#222222;
                        scrollbar-Highlight-Color:#888888;
                        scrollbar-Arrow-Color:#555555;
                    }
                    TD.weissklein{
                        font-family:    Verdana;
                        font-size:    10px;
                        color:        #ffffff;
                    }
                    TD.weissgross{
                        font-family:    Verdana;
                        font-size:    12px;
                        color:        #ffffff;
                    }
                    A{
                        color:            #aaaaaa;
                        font-weight:        normal;
                        text-decoration:    none;
                    }
                    A:Hover{
                        font-weight:        normal;
                        text-decoration:    underline;
                        color:            #ffffff;
                    }
                    INPUT,SELECT{
                        background-color:    #555555;
                        color:            #ffffff;
                        BORDER-BOTTOM-COLOR:     #222222;
                        BORDER-LEFT-COLOR:     #888888;
                        BORDER-RIGHT-COLOR:     #222222;
                        BORDER-TOP-COLOR:    #888888;
                        Border-Style:        solid;
                        Border-Width:        1px;
                        font-family:        Verdana;
                        font-size:        10px;
                    }
                    INPUT.nofunc{
                        background-color:        #555555;
                        color:        #777777;
                        BORDER-BOTTOM-COLOR: #222222;
                        BORDER-LEFT-COLOR: #888888;
                        BORDER-RIGHT-COLOR: #222222;
                        BORDER-TOP-COLOR: #888888;
                        Border-Style: solid;
                        Border-Width: 1px;
                        font-family:                Verdana;
                        font-size:                10px;
                    }
                    INPUT.eingabe{
                        background-color:        #555555;
                        color:        #ffffff;
                        BORDER-BOTTOM-COLOR: #888888;
                        BORDER-LEFT-COLOR: #222222;
                        BORDER-RIGHT-COLOR: #888888;
                        BORDER-TOP-COLOR: #222222;
                        Border-Style: solid;
                        Border-Width: 1px;
                        font-family:                Verdana;
                        font-size:                10px;
                    }
                    TEXTAREA{
                        background-color:        #555555;
                        color:        #ffffff;
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
            <body text="#000000" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
                <table border="0" cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad?>/logo_login.gif" width="329" height="208"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td width="100%">
                            <center>
                                <table border="0" cellspacing="0" cellpadding="1">
                                    <tr>
                                        <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['rundeende']['spielname']?></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                        <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['rundeende']['endzeit']?></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                                        <td><?php echo $spiel_name?></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                                        <td><?php echo $datum?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['rundeende']['automatischertick']?></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                        <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['rundeende']['spielzeit']?></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                                        <td><?php echo $autot?></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                                        <td><?php echo $runde?> <?php echo $lang['rundeende']['jahre']?></td>
                                    </tr>
                                </table>
                                <table border="0" cellspacing="0" cellpadding="1">
                                    <tr>
                                        <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['rundeende']['siegbedingungen']?></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                                        <td><?php echo $siegb?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['rundeende']['gewinner']?></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                                        <td><?php echo $gewinner?></td>
                                    </tr>
                                </table>
                            </center>
                        </td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    </tr>
                </table>
                <table border="0" cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td width="100%" valign="top">
                            <center>
                                <table border="0" cellspacing="0" cellpadding="3" width="100%">
                                    <tr>
                                        <td width="100%"><img src="../lang/<?php echo $sprache?>/topics/dieimperien.gif" border="0" width="185" height="52"></td>
                                        <td><center><img src="<?php echo $bildpfad?>/aufbau/rang_1.gif" border="0" width="41" height="41"></center></td>
                                        <td><center><img src="<?php echo $bildpfad?>/aufbau/rang_2.gif" border="0" width="41" height="41"></center></td>
                                        <td><center><img src="<?php echo $bildpfad?>/aufbau/rang_3.gif" border="0" width="41" height="41"></center></td>
                                        <td><center><img src="<?php echo $bildpfad?>/aufbau/rang_4.gif" border="0" width="113" height="41"></center></td>
                                    </tr>
                                    <?php 
                                    if ($spieler_1>=1) {
                                        $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_1");
                                        $array_temp = @mysql_fetch_array($zeiger_temp);
                                        $username=$array_temp["nick"];
                                        if ($spieler_1_raus==1) { $username="<s>".$username."</s>"; }
                                        ?>
                                        <tr>
                                            <td style="color:<?php echo $spielerfarbe[1]?>;font-size:12px;" width="100%"><nobr><b><?php echo $username?></b></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_1_basen?>.</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_1_planeten?>.</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_1_schiffe?>.</center></nobr></td>
                                            <td style="font-size:12px;"><nobr><b><center><?php echo $spieler_1_gesamt; ?>.</center></b></nobr></td>
                                        </tr>
                                        <?php 
                                    } else {
                                        ?>
                                        <tr>
                                            <td style="color:<?php echo $spielerfarbe[1]?>;font-size:12px;" width="100%"><nobr><?php echo $lang['rundeende']['slotnichtbelegt']?></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:12px;"><nobr><b><center>-</center></b></nobr></td>
                                        </tr>
                                        <?php 
                                    }
                                    if ($spieler_2>=1) {
                                         $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_2");
                                         $array_temp = @mysql_fetch_array($zeiger_temp);
                                         $username=$array_temp["nick"];
                                         if ($spieler_2_raus==1) { $username="<s>".$username."</s>"; }
                                        ?>
                                        <tr>
                                            <td style="color:<?php echo $spielerfarbe[2]?>;font-size:12px;" width="100%"><nobr><b><?php echo $username?></b></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_2_basen?>.</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_2_planeten?>.</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_2_schiffe?>.</center></nobr></td>
                                            <td style="font-size:12px;"><nobr><b><center><?php echo $spieler_2_gesamt; ?>.</center></b></nobr></td>
                                        </tr>
                                        <?php 
                                    } else {
                                        ?>
                                        <tr>
                                            <td style="color:<?php echo $spielerfarbe[2]?>;font-size:12px;" width="100%"><nobr><?php echo $lang['rundeende']['slotnichtbelegt']?></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:12px;"><nobr><b><center>-</center></b></nobr></td>
                                        </tr>
                                        <?php 
                                    }
                                    if ($spieler_3>=1) {
                                         $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_3");
                                         $array_temp = @mysql_fetch_array($zeiger_temp);
                                         $username=$array_temp["nick"];
                                         if ($spieler_3_raus==1) { $username="<s>".$username."</s>"; }
                                        ?>
                                        <tr>
                                            <td style="color:<?php echo $spielerfarbe[3]?>;font-size:12px;" width="100%"><nobr><b><?php echo $username?></b></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_3_basen?>.</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_3_planeten?>.</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_3_schiffe?>.</center></nobr></td>
                                            <td style="font-size:12px;"><nobr><b><center><?php echo $spieler_3_gesamt; ?>.</center></b></nobr></td>
                                        </tr>
                                        <?php 
                                    } else {
                                        ?>
                                        <tr>
                                            <td style="color:<?php echo $spielerfarbe[3]?>;font-size:12px;" width="100%"><nobr><?php echo $lang['rundeende']['slotnichtbelegt']?></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:12px;"><nobr><b><center>-</center></b></nobr></td>
                                        </tr>
                                        <?php 
                                    }
                                    if ($spieler_4>=1) {
                                        $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_4");
                                        $array_temp = @mysql_fetch_array($zeiger_temp);
                                        $username=$array_temp["nick"];
                                        if ($spieler_4_raus==1) { $username="<s>".$username."</s>"; }
                                        ?>
                                        <tr>
                                            <td style="color:<?php echo $spielerfarbe[4]?>;font-size:12px;" width="100%"><nobr><b><?php echo $username?></b></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_4_basen?>.</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_4_planeten?>.</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_4_schiffe?>.</center></nobr></td>
                                            <td style="font-size:12px;"><nobr><b><center><?php echo $spieler_4_gesamt; ?>.</center></b></nobr></td>
                                        </tr>
                                        <?php 
                                    } else {
                                        ?>
                                        <tr>
                                            <td style="color:<?php echo $spielerfarbe[4]?>;font-size:12px;" width="100%"><nobr><?php echo $lang['rundeende']['slotnichtbelegt']?></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:12px;"><nobr><b><center>-</center></b></nobr></td>
                                        </tr>
                                        <?php 
                                    }
                                    if ($spieler_5>=1) {
                                        $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_5");
                                        $array_temp = @mysql_fetch_array($zeiger_temp);
                                        $username=$array_temp["nick"];
                                        if ($spieler_5_raus==1) { $username="<s>".$username."</s>"; }
                                        ?>
                                        <tr>
                                            <td style="color:<?php echo $spielerfarbe[5]?>;font-size:12px;" width="100%"><nobr><b><?php echo $username?></b></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_5_basen?>.</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_5_planeten?>.</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_5_schiffe?>.</center></nobr></td>
                                            <td style="font-size:12px;"><nobr><b><center><?php echo $spieler_5_gesamt; ?>.</center></b></nobr></td>
                                        </tr>
                                        <?php 
                                    } else {
                                        ?>
                                        <tr>
                                            <td style="color:<?php echo $spielerfarbe[5]?>;font-size:12px;" width="100%"><nobr><?php echo $lang['rundeende']['slotnichtbelegt']?></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:12px;"><nobr><b><center>-</center></b></nobr></td>
                                        </tr>
                                        <?php 
                                    }
                                    if ($spieler_6>=1) {
                                        $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_6");
                                        $array_temp = @mysql_fetch_array($zeiger_temp);
                                        $username=$array_temp["nick"];
                                        if ($spieler_6_raus==1) { $username="<s>".$username."</s>"; }
                                        ?>
                                        <tr>
                                            <td style="color:<?php echo $spielerfarbe[6]?>;font-size:12px;" width="100%"><nobr><b><?php echo $username?></b></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_6_basen?>.</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_6_planeten?>.</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_6_schiffe?>.</center></nobr></td>
                                            <td style="font-size:12px;"><nobr><b><center><?php echo $spieler_6_gesamt; ?>.</center></b></nobr></td>
                                        </tr>
                                        <?php 
                                    } else {
                                        ?>
                                        <tr>
                                            <td style="color:<?php echo $spielerfarbe[6]?>;font-size:12px;" width="100%"><nobr><?php echo $lang['rundeende']['slotnichtbelegt']?></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:12px;"><nobr><b><center>-</center></b></nobr></td>
                                        </tr>
                                        <?php 
                                    }
                                    if ($spieler_7>=1) {
                                        $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_7");
                                        $array_temp = @mysql_fetch_array($zeiger_temp);
                                        $username=$array_temp["nick"];
                                        if ($spieler_7_raus==1) { $username="<s>".$username."</s>"; }
                                        ?>
                                        <tr>
                                            <td style="color:<?php echo $spielerfarbe[7]?>;font-size:12px;" width="100%"><nobr><b><?php echo $username?></b></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_7_basen?>.</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_7_planeten?>.</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_7_schiffe?>.</center></nobr></td>
                                            <td style="font-size:12px;"><nobr><b><center><?php echo $spieler_7_gesamt; ?>.</center></b></nobr></td>
                                        </tr>
                                        <?php 
                                    } else {
                                        ?>
                                        <tr>
                                            <td style="color:<?php echo $spielerfarbe[7]?>;font-size:12px;" width="100%"><nobr><?php echo $lang['rundeende']['slotnichtbelegt']?></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:12px;"><nobr><b><center>-</center></b></nobr></td>
                                        </tr>
                                        <?php 
                                    } 
                                    if ($spieler_8>=1) {
                                        $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_8");
                                        $array_temp = @mysql_fetch_array($zeiger_temp);
                                        $username=$array_temp["nick"];
                                        if ($spieler_8_raus==1) { $username="<s>".$username."</s>"; }
                                        ?>
                                        <tr>
                                            <td style="color:<?php echo $spielerfarbe[8]?>;font-size:12px;" width="100%"><nobr><b><?php echo $username?></b></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_8_basen?>.</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_8_planeten?>.</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_8_schiffe?>.</center></nobr></td>
                                            <td style="font-size:12px;"><nobr><b><center><?php echo $spieler_8_gesamt; ?>.</center></b></nobr></td>
                                        </tr>
                                        <?php 
                                    } else {
                                        ?>
                                        <tr>
                                            <td style="color:<?php echo $spielerfarbe[8]?>;font-size:12px;" width="100%"><nobr><?php echo $lang['rundeende']['slotnichtbelegt']?></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:12px;"><nobr><b><center>-</center></b></nobr></td>
                                        </tr>
                                        <?php 
                                    }
                                    if ($spieler_9>=1) {
                                        $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_9");
                                        $array_temp = @mysql_fetch_array($zeiger_temp);
                                        $username=$array_temp["nick"];
                                        if ($spieler_9_raus==1) { $username="<s>".$username."</s>"; }
                                        ?>
                                        <tr>
                                            <td style="color:<?php echo $spielerfarbe[9]?>;font-size:12px;" width="100%"><nobr><b><?php echo $username?></b></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_9_basen?>.</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_9_planeten?>.</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_9_schiffe?>.</center></nobr></td>
                                            <td style="font-size:12px;"><nobr><b><center><?php echo $spieler_9_gesamt; ?>.</center></b></nobr></td>
                                        </tr>
                                        <?php 
                                    } else {
                                        ?>
                                        <tr>
                                            <td style="color:<?php echo $spielerfarbe[9]?>;font-size:12px;" width="100%"><nobr><?php echo $lang['rundeende']['slotnichtbelegt']?></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:12px;"><nobr><b><center>-</center></b></nobr></td>
                                        </tr>
                                        <?php 
                                    }
                                     if ($spieler_10>=1) {
                                        $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_10");
                                        $array_temp = @mysql_fetch_array($zeiger_temp);
                                        $username=$array_temp["nick"];
                                        if ($spieler_10_raus==1) { $username="<s>".$username."</s>"; }
                                        ?>
                                        <tr>
                                            <td style="color:<?php echo $spielerfarbe[10]?>;font-size:12px;" width="100%"><nobr><b><?php echo $username?></b></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_10_basen?>.</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_10_planeten?>.</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center><?php echo $spieler_10_schiffe?>.</center></nobr></td>
                                            <td style="font-size:12px;"><nobr><b><center><?php echo $spieler_10_gesamt; ?>.</center></b></nobr></td>
                                        </tr>
                                        <?php 
                                    } else {
                                        ?>
                                        <tr>
                                            <td style="color:<?php echo $spielerfarbe[10]?>;font-size:12px;" width="100%"><nobr><?php echo $lang['rundeende']['slotnichtbelegt']?></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:11px;"><nobr><center>-</center></nobr></td>
                                            <td style="font-size:12px;"><nobr><b><center>-</center></b></nobr></td>
                                        </tr>
                                        <?php 
                                    }
                                    ?>
                                </table>
                            </center>
                        </td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td>
                            <?php 
                            $moviegif_verzeichnis = '../extend/moviegif';
                            if ((@file_exists($moviegif_verzeichnis)) and (@intval(substr($spiel_extend,0,1))==1)) {
                                ?>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td>
                                            <center>
                                                <table border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td colspan="3"><img src="<?php echo $bildpfad?>/aufbau/galaoben.gif" border="0" width="258" height="4"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><img src="<?php echo $bildpfad?>/aufbau/galalinks.gif" border="0" width="4" height="250"></td>
                                                        <td><iframe src="../extend/moviegif/movie.php?fu=1&spiel=<?php echo $spiel?>" width="250" height="250" name="map" scrolling="no" marginheight="0" marginwidth="0" frameborder="0"></iframe></td>
                                                        <td><img src="<?php echo $bildpfad?>/aufbau/galarechts.gif" border="0" width="4" height="250"></td>
                                                    <tr>
                                                        <td colspan="3"><img src="<?php echo $bildpfad?>/aufbau/galaunten.gif" border="0" width="258" height="4"></td>
                                                    </tr>
                                                </table>
                                            </center>
                                        </td>
                                    </tr>
                                </table>
                                <?php
                            } else {
                                ?>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td>
                                            <center>
                                                <table border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td colspan="3"><img src="<?php echo $bildpfad?>/aufbau/galaoben.gif" border="0" width="258" height="4"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><img src="<?php echo $bildpfad?>/aufbau/galalinks.gif" border="0" width="4" height="250"></td>
                                                        <td><iframe src="runde_ende.php?fu=3&spiel=<?php echo $spiel?>&bildpfad=<?php echo $bildpfad?>" width="250" height="250" name="map" scrolling="no" marginheight="0" marginwidth="0" frameborder="0"></iframe></td>
                                                        <td><img src="<?php echo $bildpfad?>/aufbau/galarechts.gif" border="0" width="4" height="250"></td>
                                                    <tr>
                                                        <td colspan="3"><img src="<?php echo $bildpfad?>/aufbau/galaunten.gif" border="0" width="258" height="4"></td>
                                                    </tr>
                                                </table>
                                            </center>
                                        </td>
                                    </tr>
                                </table>
                                <?php
                            }
                            ?>
                        </td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    </tr>
                </table>
            </body>
        </html>
        <?php 
    }
    @mysql_close();
}
if ($fuid==3) {
    $breite=250;
    $hoehe=250;
    $conn = @mysql_connect($server.':'.$port,"$login","$password");
    $db = @mysql_select_db("$database",$conn);
    compressed_output();
    $zeiger = @mysql_query("SELECT id,phase,umfang FROM $skrupel_spiele where phase=1 and id=".$spiel);
    $datensaetze = @mysql_num_rows($zeiger);
    if ($datensaetze==1) {
        $array_temp = @mysql_fetch_array($zeiger);
        $umfang=$array_temp["umfang"];
        ?>
        <html>
            <head>
                 <META NAME="Author" CONTENT="Bernd Kantoks bernd@kantoks.de">
                 <META HTTP-EQUIV="imagetoolbar" CONTENT="no">
                <style type="text/css">
                    BODY,P,TD{
                        font-family:    Verdana;
                        font-size:    10px;
                        color:        #ffffff;
                        scrollbar-DarkShadow-Color:#444444;
                        scrollbar-3dLight-Color:#444444;
                        scrollbar-Track-Color:#444444;
                        scrollbar-Face-Color:#555555;
                        scrollbar-Shadow-Color:#222222;
                        scrollbar-Highlight-Color:#888888;
                        scrollbar-Arrow-Color:#555555;
                    }
                    TD.weissklein{
                        font-family:    Verdana;
                        font-size:    10px;
                        color:        #ffffff;
                    }
                    TD.weissgross{
                        font-family:    Verdana;
                        font-size:    12px;
                        color:        #ffffff;
                    }
                    A{
                        color:            #aaaaaa;
                        font-weight:        normal;
                        text-decoration:    none;
                    }
                    A:Hover{
                        font-weight:        normal;
                        text-decoration:    underline;
                        color:            #ffffff;
                    }
                    INPUT,SELECT{
                        background-color:    #555555;
                        color:            #ffffff;
                        BORDER-BOTTOM-COLOR:     #222222;
                        BORDER-LEFT-COLOR:     #888888;
                        BORDER-RIGHT-COLOR:     #222222;
                        BORDER-TOP-COLOR:    #888888;
                        Border-Style:        solid;
                        Border-Width:        1px;
                        font-family:        Verdana;
                        font-size:        10px;
                    }
                    INPUT.nofunc{
                        background-color:        #555555;
                        color:        #777777;
                        BORDER-BOTTOM-COLOR: #222222;
                        BORDER-LEFT-COLOR: #888888;
                        BORDER-RIGHT-COLOR: #222222;
                        BORDER-TOP-COLOR: #888888;
                        Border-Style: solid;
                        Border-Width: 1px;
                        font-family:                Verdana;
                        font-size:                10px;
                    }
                    INPUT.eingabe{
                        background-color:        #555555;
                        color:        #ffffff;
                        BORDER-BOTTOM-COLOR: #888888;
                        BORDER-LEFT-COLOR: #222222;
                        BORDER-RIGHT-COLOR: #888888;
                        BORDER-TOP-COLOR: #222222;
                        Border-Style: solid;
                        Border-Width: 1px;
                        font-family:                Verdana;
                        font-size:                10px;
                    }
                    TEXTAREA{
                        background-color:        #555555;
                        color:        #ffffff;
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
            <?php 
            $sektoranzahl=$umfang/250;
            $breite=250;
            $hoehe=250;
            ?>
            <body text="#000000" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><img src="<?php echo $bildpfad?>/karte/mapklein.gif" width="<?php echo $breite?>" height="<?php echo $hoehe?>"></td>
                    </tr>
                </table>
                <?php 
                for ($n=1;$n<=$sektoranzahl;$n++) {
                    $x=(250*$n)/$umfang*$breite;
                    ?>
                    <div id="strich<?php echo $n?>" style="position: absolute; left:<?php echo $x?>px; top:0px; width:1px; height:<?php echo $hoehe?>px;visibility=visible;background-Color:#333333;"><img border="0" src="../bilder/empty.gif" width="1" height="<?php echo $hoehe?>"></div>
                    <?php 
                }
                for ($n=1;$n<=$sektoranzahl;$n++) {
                    $y=(250*$n)/$umfang*$hoehe;
                    ?>
                    <div id="strich<?php echo $n+5?>" style="position: absolute; left:0px; top:<?php echo $y?>px; width:<?php echo $breite?>px; height:1px;visibility=visible;background-Color:#333333;"><img border="0" src="../bilder/empty.gif" width="<?php echo $breite?>" height="1"></div>
                    <?php
                }
                $zeiger = @mysql_query("SELECT * FROM $skrupel_schiffe where spiel=$spiel order by id");
                $datensaetze = @mysql_num_rows($zeiger);
                if ($datensaetze>=1) {
                    for ($i=0; $i<$datensaetze;$i++) {
                        $ok = @mysql_data_seek($zeiger,$i);
                        $array = @mysql_fetch_array($zeiger);
                        $id=$array["id"];
                        $x_pos=$array["kox"];
                        $y_pos=$array["koy"];
                        $besitzer=$array["besitzer"];
                        $spezialmission=$array["spezialmission"];
                        $x_position=$x_pos/$umfang*$breite;
                        $y_position=$y_pos/$umfang*$hoehe;
                        if (($spezialmission>=41) and ($spezialmission<=50)) { $besitzer=$spezialmission-40; }
                        $farbe=$spielerfarbe["$besitzer"];
                        ?>
                        <div id="schiff_<?php echo $id?>_1" style="position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                        <?php 
                    }
                }
                $zeiger = @mysql_query("SELECT * FROM $skrupel_planeten where spiel=$spiel order by id");
                $datensaetze = @mysql_num_rows($zeiger);
                if ($datensaetze>=1) {
                    for ($i=0; $i<$datensaetze;$i++) {
                        $ok = @mysql_data_seek($zeiger,$i);
                        $array = @mysql_fetch_array($zeiger);
                        $id=$array["id"];
                        $name=$array["name"];
                        $x_pos=$array["x_pos"];
                        $y_pos=$array["y_pos"];
                        $besitzer=$array["besitzer"];
                        $klasse=$array["klasse"];
                        $x_position=$x_pos/$umfang*$breite;
                        $y_position=$y_pos/$umfang*$hoehe;
                        $farbe="#ffffff";
                        if ($besitzer==0) {
                            ?>
                            <div id="planet_<?php echo $id?>" style="position: absolute; left:<?php echo $x_position?>px; top:<?php echo $y_position?>px; width:1px; height:1px;visibility=visible;background-Color:#ffffff;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <?php
                        } else {
                            $farbe=$spielerfarbe["$besitzer"];
                            ?>
                            <div id="planet_<?php echo $id?>_1" style="position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <div id="planet_<?php echo $id?>_2" style="position: absolute; left:<?php echo $x_position+1; ?>px; top:<?php echo $y_position; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <div id="planet_<?php echo $id?>_3" style="position: absolute; left:<?php echo $x_position-1; ?>px; top:<?php echo $y_position; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <div id="planet_<?php echo $id?>_4" style="position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position+1; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <div id="planet_<?php echo $id?>_5" style="position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position-1; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <?php 
                        }
                    }
                }
                $zeiger = @mysql_query("SELECT * FROM $skrupel_anomalien where (art=1 or art=2) and spiel=$spiel order by id");
                $datensaetze = @mysql_num_rows($zeiger);
                if ($datensaetze>=1) {
                    for ($i=0; $i<$datensaetze;$i++) {
                        $ok = @mysql_data_seek($zeiger,$i);
                        $array = @mysql_fetch_array($zeiger);
                        $aid=$array["id"];
                        $art=$array["art"];
                        $x_pos=$array["x_pos"];
                        $y_pos=$array["y_pos"];
                        $x_position=$x_pos/$umfang*$breite;
                        $y_position=$y_pos/$umfang*$hoehe;
                        $nummer=rand(1,6);
                        ?>
                        <div id="anomalie_<?php echo $aid?>" style="position: absolute; left:<?php echo $x_position; ?>px; top:<?php echo $y_position; ?>px; width:1px; height:1px;visibility=visible;"><img border="0" src="../bilder/export/anomalie_<?php echo $nummer?>.gif" width="1" height="1"></div>
                        <?php 
                    }
                }
                ?>
            </body>
        </html>
        <?php
    }
    @mysql_close();
}
