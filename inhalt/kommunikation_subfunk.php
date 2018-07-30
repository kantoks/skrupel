<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'kommunikation_subfunk';
$fuid = int_get('fu');

if ($fuid==1) {
    include ("inc.header.php");
    ?>
    <body text="#000000" scroll="no" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <table height="100%" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td></td>
                <td><center><img src="../lang/<?php echo $spieler_sprache; ?>/topics/subfunk.gif" width="137" height="40"></center></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td><img src="../bilder/empty.gif" width="1" height="2"></td>
                <td></td>
            </tr>
            <?php 
            $verhandlung = false;
            $begegnung = array();
            if ($module[4]==1) {
                $zeiger = @mysql_query("SELECT partei_b FROM $skrupel_begegnung where spiel=$spiel and partei_a=$spieler");
                $polanzahl = @mysql_num_rows($zeiger);
                if ($polanzahl>=1) {
                    for ($i=0; $i<$polanzahl;$i++) {
                        $ok = @mysql_data_seek($zeiger,$i);
                        $array = @mysql_fetch_array($zeiger);
                        $partei_b=$array["partei_b"];
                        $begegnung[$partei_b]=1;
                        $verhandlung = true;
                    }
                }
            }
            if (($verhandlung == true) or ($module[4]==0)) {
                ?> 
                <tr>
                    <td><form name="formular" method="post" action="kommunikation_subfunk.php?fu=2&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                    <td>
                        <center>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><nobr><?php echo $lang['kommunikationsubfunk']['empfaenger']; ?>&nbsp;&nbsp;</nobr></td>
                                    <td>
                                        <select name="empfang">
                                            <option value="0" style="background-color:#444444;"><?php echo $lang['kommunikationsubfunk']['bitteauswaehlen']; ?></option>
                                            <?php
                                            $zahl=0;
                                            $array_spieler=array('',$spieler_1,$spieler_2,$spieler_3,$spieler_4,$spieler_5,$spieler_6,$spieler_7,$spieler_8,$spieler_9,$spieler_10);
                                            for($i=1;$i<11;$i++){
                                                if (($module[4]==0) or (isset($begegnung[$i]))) {
                                                    if (($array_spieler[$i]>=1) and ($i<>$spieler)) {
                                                        $zeiger = @mysql_query("SELECT * FROM $skrupel_user where id=$array_spieler[$i]");
                                                        $array = @mysql_fetch_array($zeiger);
                                                        $nick=$array["nick"];
                                                        $feind[$zahl][0]=$nick;
                                                        $feind[$zahl][1]=$spielerfarbe[$i];
                                                        $feind[$zahl][2]=$i;
                                                        $zahl++;
                                                    }
                                                }
                                            }
                                            if ($zahl>=1) {
                                                for ($n=0;$n<$zahl;$n++) {
                                                    ?>
                                                    <option value="<?php echo $feind[$n][2]; ?>" style="background-color:<?php echo $feind[$n][1]; ?>;" <?php if (int_get('an')==$feind[$n][2]) { echo "selected"; } ?>><?php echo $feind[$n][0]; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </center>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><img src="../bilder/empty.gif" width="1" height="5"></td>
                    <td></td>
                </tr>
                <tr height="100%">
                    <td></td>
                    <td><textarea name="nachricht" style="width:100%;height:100%;"><?php echo str_post('nachricht','SQLSAFE')?></textarea></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><img src="../bilder/empty.gif" width="1" height="7"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="button" value="<?php echo $lang['kommunikationsubfunk']['abschicken']; ?>" style="width:100%;height:20;"></td>
                    <td></form></td>
                </tr>
                <?php
            } else {
                ?>
                <tr height="100%">
                    <td></td>
                    <td><center><?php echo $lang['kommunikationsubfunk']['allein']?></center></td>
                    <td></td>
                </tr>
                <?php
            }
            ?> 
        </table>
        <?php
    include ("inc.footer.php");
    
}
if ($fuid==2) {
    include ("inc.header.php");
    $spielernummer = int_post('empfang');
    $spielertemp = $spieler_id_c[$spielernummer];
    $zeiger = @mysql_query("SELECT sprache FROM $skrupel_user where id=$spielertemp");
    $array = @mysql_fetch_array($zeiger);
    $spieler2sprache = ($array['sprache']=='')?$language:$array['sprache'];
    include('../lang/'.$spieler2sprache.'/lang.kommunikation_subfunk_b.php');
    ?>
    <body text="#000000" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <?php
    $nachricht=str_post('nachricht','SQLSAFE');
    function iif ($expression,$returntrue,$returnfalse) {
        if ($expression==0) {
            return $returnfalse;
        } else {
            return $returntrue;
        }
    }
    function checkurl($url, $hyperlink="") {
        $righturl = $url;
        if(!preg_match("![a-z]://!si", $url)) {
            $righturl = "http://$righturl";
        }
        $righturl = preg_replace("/javascript:/si", "java script:", $righturl);
        $righturl = preg_replace("/about:/si", "about :", $righturl);
        $hyperlink = iif(trim($hyperlink)=="" or $hyperlink==$url, iif(strlen($url)>50,substr($url,0,35)."...".substr($url,-15),$url) ,$hyperlink);
        return "<a href=\"$righturl\" target=\"_blank\">$hyperlink</a>";
    }
    function checkmail($url, $hyperlink="") {
        $righturl = $url;
        if(!preg_match("!mailto:!si", $url)) {
            $righturl = "mailto:$righturl";
        }
        if($hyperlink=="") $hyperlink=$url;
        // remove threat of users including javascript in url
        return "<a href=\"$righturl\">$hyperlink</a>";
    }
    function checkfont($url, $hyperlink="") {
        $righturl = $url;
        return "<font face=\"$righturl\">$hyperlink</font>";
    }
    function checkcolor($url, $hyperlink="") {
        $righturl = $url;
        return "<font color=\"$righturl\">$hyperlink</font>";
    }
    function checksize($url, $hyperlink="") {
        $righturl = $url;
        return "<font size=\"$righturl\">$hyperlink</font>";
    }
    function parsetext($bbcode) {
        // kill any rogue html code
        $bbcode=str_replace("&","&amp;",$bbcode);
        $bbcode=str_replace("<","&lt;",$bbcode);
        $bbcode=str_replace(">","&gt;",$bbcode);
        $bbcode=str_replace("ä","&auml;",$bbcode);
        $bbcode=str_replace("ö","&ouml;",$bbcode);
        $bbcode=str_replace("ü","&uuml;",$bbcode);
        $bbcode=str_replace("Ä","&Auml;",$bbcode);
        $bbcode=str_replace("Ö","&Ouml;",$bbcode);
        $bbcode=str_replace("Ü","&Uuml;",$bbcode);
        //$bbcode=nl2br($bbcode);
        $bbcode=strtr($bbcode, array("\\r\\n" => "<br />\\r\\n", "\\r" => "<br />\\r", "\\n" => "<br />\\n"));
        $bbcode=preg_replace("/\[b\]/i","<b>",$bbcode);
        $bbcode=preg_replace("/\[\/b\]/i","</b>",$bbcode);
        $bbcode=preg_replace("/\[i\]/i","<i>",$bbcode);
        $bbcode=preg_replace("/\[\/i\]/i","</i>",$bbcode);
        $bbcode=preg_replace("/\[u\]/i","<u>",$bbcode);
        $bbcode=preg_replace("/\[\/u\]/i","</u>",$bbcode);

        $bbcode=preg_replace_callback("/(\[)(url)(=)(['\"]?)([^\"']*)(\\4])(.*)(\[\/url\])/siU",		function($m) { return checkurl($m[5], $m[7]); }, $bbcode);
        $bbcode=preg_replace_callback("/(\[)(url)(])(.*)(\[\/url\])/siU",								function($m) { return checkurl($m[4]); }, $bbcode);
        $bbcode=preg_replace_callback("/(\[)(email)(=)(['\"]?)([^\"']*)(\\4])(.*)(\[\/email\])/siU",	function($m) { return checkmail($m[5], $m[7]); }, $bbcode);
        $bbcode=preg_replace_callback("/(\[)(email)(])(.*)(\[\/email\])/siU",							function($m) { return checkmail($m[4]); }, $bbcode);

        $bbcode=preg_replace_callback("/(\[)(font)(=)(['\"]?)([^\"']*)(\\4])(.*)(\[\/font\])/siU",		function($m) { return checkfont($m[5], $m[7]); }, $bbcode);
        $bbcode=preg_replace_callback("/(\[)(font)(])(.*)(\[\/font\])/siU",								function($m) { return checkfont($m[4]); }, $bbcode);
        $bbcode=preg_replace_callback("/(\[)(color)(=)(['\"]?)([^\"']*)(\\4])(.*)(\[\/color\])/siU",	function($m) { return checkcolor($m[5], $m[7]); }, $bbcode);
        $bbcode=preg_replace_callback("/(\[)(color)(])(.*)(\[\/color\])/siU",							function($m) { return checkcolor($m[4]); }, $bbcode);

        $bbcode=preg_replace_callback("/(\[)(size)(=)(['\"]?)([^\"']*)(\\4])(.*)(\[\/size\])/siU",		function($m) { return checksize($m[5], $m[7]); }, $bbcode);
        $bbcode=preg_replace_callback("/(\[)(size)(])(.*)(\[\/size\])/siU",								function($m) { return checksize($m[4]); }, $bbcode);

        $bbcode=preg_replace("/\\[img\\]([^\\[]*)\\[\/img\\]/i","<img src=\"\\1\" border=0>",$bbcode);
        $bbcode2=$bbcode;
        return $bbcode2;
    }
    //$nachricht=str_replace("'", "",$nachricht);
    //$nachricht=str_replace("\\", "",$nachricht);
    $nachricht=str_replace("::::::", ":::::",$nachricht);
    $nachricht=parsetext($nachricht);
    $nachricht_org=$nachricht;
    if (int_post('empfang')>=1) {
        $nachricht=str_replace(array('{1}','{2}','{3}'),array($spielerfarbe[$spieler], $spieler_name, $nachricht),$spieler."::::::".$lang['kommunikationsubfunk_b']['nachricht']);
        $datum=time();
        $zeiger_temp = @mysql_query("insert into $skrupel_neuigkeiten (datum,art,icon,inhalt,spieler_id,spiel_id,sicher) values ('$datum',7,'../bilder/news/subfunk.jpg','$nachricht',".int_post('empfang').",$spiel,1);");
        ?>
        <center>
            <table border="0" cellspacing="0" cellpadding="0" height="100%">
                <tr>
                    <td>
                        <center>
                            <?php echo $lang['kommunikationsubfunk']['wurdeabgeschickt']; ?>
                            <br><br>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><form name="formular" method="post" action="kommunikation_subfunk.php?fu=1&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                                    <td><input type="submit" name="bla" value="<?php echo $lang['kommunikationsubfunk']['zurueck']; ?>" style="width:120px;"></td>
                                    <td></form></td>
                                </tr>
                            </table>
                        </center>
                    </td>
                </tr>
            </table>
        </center>
        <?php
        } else {
            ?>
            <center>
                <table border="0" cellspacing="0" cellpadding="0" height="100%">
                    <tr>
                        <td>
                            <center>
                                <?php echo $lang['kommunikationsubfunk']['waehle']; ?>
                                <br><br>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td><form name="formular" method="post" action="kommunikation_subfunk.php?fu=1&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                                        <td>
                                            <input type="hidden" name="nachricht" value="<?php echo $nachricht_org; ?>">
                                            <input type="submit" name="bla" value="<?php echo $lang['kommunikationsubfunk']['zurueck']; ?>" style="width:120px;">
                                        </td>
                                        <td></form></td>
                                    </tr>
                                </table>
                            </center>
                        </td>
                     </tr>
                </table>
            </center>
            <?php
        }
    include ("inc.footer.php");
}
if ($fuid==3) {
    include ("inc.header.php");
    ?>
    <frameset framespacing="0" border="false" frameborder="0" rows="18,*,16">
        <frameset framespacing="0" border="false" frameborder="0" cols="114,*,114">
            <frame name="rahmen1" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=34&bildpfad=<?php echo $bildpfad; ?>" target="_self">
            <frame name="rahmen2" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=20&bildpfad=<?php echo $bildpfad; ?>" target="_self">
            <frame name="rahmen3" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=35&bildpfad=<?php echo $bildpfad; ?>" target="_self">
        </frameset>
        <frameset framespacing="0" border="false" frameborder="0" cols="18,*,18">
            <frameset framespacing="0" border="false" frameborder="0" rows="80,*,92">
                <frame name="rahmen15" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=25&bildpfad=<?php echo $bildpfad; ?>" target="_self">
                <frame name="rahmen16" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=26&bildpfad=<?php echo $bildpfad; ?>" target="_self">
                <frame name="rahmen17" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=27&bildpfad=<?php echo $bildpfad; ?>" target="_self">
            </frameset>
            <frame name="rahmen12" scrolling="auto" marginwidth="0" marginheight="0" noresize src="kommunikation_subfunk.php?fu=4&emp=<?php echo int_get('emp'); ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" target="_self">
            <frameset framespacing="0" border="false" frameborder="0" rows="80,*,92">
                <frame name="rahmen18" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=28&bildpfad=<?php echo $bildpfad; ?>" target="_self">
                <frame name="rahmen19" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=29&bildpfad=<?php echo $bildpfad; ?>" target="_self">
                <frame name="rahmen20" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=30&bildpfad=<?php echo $bildpfad; ?>" target="_self">
            </frameset>
        </frameset>
        <frameset framespacing="0" border="false" frameborder="0" cols="114,*,114">
            <frame name="rahmen6" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=36&bildpfad=<?php echo $bildpfad; ?>" target="_self">
            <frame name="rahmen7" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=23&bildpfad=<?php echo $bildpfad; ?>" target="_self">
            <frame name="rahmen8" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=37&bildpfad=<?php echo $bildpfad; ?>" target="_self">
        </frameset>
    </frameset>
    <noframes>
    <body>
        <?php
    include ("inc.footer.php");
}
if ($fuid==4) {
    include ("inc.header.php");
    ?>
    <body text="#000000" bgcolor="#444444" scroll="no" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <script language=JavaScript>parent.document.title='<?php echo $lang['kommunikationsubfunk']['subfunkkommunikation']; ?>';</script>
        <table height="100%" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td></td>
                <td><center><img src="../lang/<?php echo $language; ?>/topics/subfunk.gif" width="137" height="40"></center></td>
                <td></td>
            </tr>
            <tr>
                <td><form name="formular" method="post" action="kommunikation_subfunk.php?fu=5&emp=<?php echo int_get('emp'); ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                <td><img src="../bilder/empty.gif" width="1" height="2"></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td><img src="../bilder/empty.gif" width="1" height="2"></td>
                <td></td>
            </tr>
            <tr height="100%">
                <td></td>
                <td><textarea name="nachricht" style="width:100%;height:100%;"></textarea></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td><img src="../bilder/empty.gif" width="1" height="7"></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="button" value="<?php echo $lang['kommunikationsubfunk']['abschicken']; ?>" style="width:100%;height:20;"></td>
                <td></form></td>
            </tr>
        </table>
        <?php
    include ("inc.footer.php");
}
if ($fuid==5) {
    include ("inc.header.php");
    $spielernummer = int_post('empfang');
    $spielertemp = $spieler_id_c[$spielernummer];
    $zeiger = @mysql_query("SELECT sprache FROM $skrupel_user where id=$spielertemp");
    $array = @mysql_fetch_array($zeiger);
    $spieler2sprache = ($array['sprache']=='')?$language:$array['sprache'];
    include('../lang/'.$spieler2sprache.'/lang.kommunikation_subfunk_b.php');
    ?>
    <body text="#000000" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php
        $nachricht=str_post('nachricht','SQLSAFE');
        function iif ($expression,$returntrue,$returnfalse) {
            if ($expression==0) {
                return $returnfalse;
            } else {
                return $returntrue;
            }
        }
        function checkurl($url, $hyperlink="") {
            $righturl = $url;
            if(!preg_match("![a-z]://!si", $url)) {
                $righturl = "http://$righturl";
            }
            $righturl = preg_replace("/javascript:/si", "java script:", $righturl);
            $righturl = preg_replace("/about:/si", "about :", $righturl);
            $hyperlink = iif(trim($hyperlink)=="" or $hyperlink==$url, iif(strlen($url)>50,substr($url,0,35)."...".substr($url,-15),$url) ,$hyperlink);
            return "<a href=\"$righturl\" target=\"_blank\">$hyperlink</a>";
        }
        function checkmail($url, $hyperlink="") {
            $righturl = $url;
            if(!preg_match("!mailto:!si", $url)) {
                $righturl = "mailto:$righturl";
            }
            if($hyperlink=="") $hyperlink=$url;
            // remove threat of users including javascript in url
            return "<a href=\"$righturl\">$hyperlink</a>";
        }
        function checkfont($url, $hyperlink="") {
            $righturl = $url;
            return "<font face=\"$righturl\">$hyperlink</font>";
        }
        function checkcolor($url, $hyperlink="") {
            $righturl = $url;
            return "<font color=\"$righturl\">$hyperlink</font>";
        }
        function checksize($url, $hyperlink="") {
            $righturl = $url;
            return "<font size=\"$righturl\">$hyperlink</font>";
        }
        function parsetext($bbcode) {
            // kill any rogue html code
            $bbcode=str_replace("&","&amp;",$bbcode);
            $bbcode=str_replace("<","&lt;",$bbcode);
            $bbcode=str_replace(">","&gt;",$bbcode);
            $bbcode=str_replace("ä","&auml;",$bbcode);
            $bbcode=str_replace("ö","&ouml;",$bbcode);
            $bbcode=str_replace("ü","&uuml;",$bbcode);
            $bbcode=str_replace("Ä","&Auml;",$bbcode);
            $bbcode=str_replace("Ö","&Ouml;",$bbcode);
            $bbcode=str_replace("Ü","&Uuml;",$bbcode);
            //$bbcode=nl2br($bbcode);
            $bbcode=strtr($bbcode, array("\\r\\n" => "<br />\\r\\n", "\\r" => "<br />\\r", "\\n" => "<br />\\n"));
            $bbcode=preg_replace("/\[b\]/i","<b>",$bbcode);
            $bbcode=preg_replace("/\[\/b\]/i","</b>",$bbcode);
            $bbcode=preg_replace("/\[i\]/i","<i>",$bbcode);
            $bbcode=preg_replace("/\[\/i\]/i","</i>",$bbcode);
            $bbcode=preg_replace("/\[u\]/i","<u>",$bbcode);
            $bbcode=preg_replace("/\[\/u\]/i","</u>",$bbcode);
            $searcharray = array(
                "/(\[)(url)(=)(['\"]?)([^\"']*)(\\4])(.*)(\[\/url\])/esiU",
                "/(\[)(url)(])(.*)(\[\/url\])/esiU",
                "/(\[)(email)(=)(['\"]?)([^\"']*)(\\4])(.*)(\[\/email\])/esiU",
                "/(\[)(email)(])(.*)(\[\/email\])/esiU"
            );
            $replacearray = array(
                "checkurl('\\5', '\\7')",
                "checkurl('\\4')",
                "checkmail('\\5', '\\7')",
                "checkmail('\\4')"
            );
            $bbcode=preg_replace($searcharray, $replacearray, $bbcode);
            $searcharray = array(
                "/(\[)(font)(=)(['\"]?)([^\"']*)(\\4])(.*)(\[\/font\])/esiU",
                "/(\[)(font)(])(.*)(\[\/font\])/esiU",
                "/(\[)(color)(=)(['\"]?)([^\"']*)(\\4])(.*)(\[\/color\])/esiU",
                "/(\[)(color)(])(.*)(\[\/color\])/esiU"
            );
            $replacearray = array(
                "checkfont('\\5', '\\7')",
                "checkfont('\\4')",
                "checkcolor('\\5', '\\7')",
                "checkcolor('\\4')"
            );
            $bbcode=preg_replace($searcharray, $replacearray, $bbcode);
            $searcharray = array(
                "/(\[)(size)(=)(['\"]?)([^\"']*)(\\4])(.*)(\[\/size\])/esiU",
                "/(\[)(size)(])(.*)(\[\/size\])/esiU" );
            $replacearray = array(
                "checksize('\\5', '\\7')",
                "checksize('\\4')"
            );
            $bbcode=preg_replace($searcharray, $replacearray, $bbcode);
            $bbcode=preg_replace("/\\[img\\]([^\\[]*)\\[\/img\\]/i","<img src=\"\\1\" border=0>",$bbcode);
            $bbcode2=$bbcode;
            return $bbcode2;
        }
        //$nachricht=str_replace("'", "",$nachricht);
        //$nachricht=str_replace("\\", "",$nachricht);
        $nachricht=str_replace("::::::", ":::::",$nachricht);
        $nachricht=parsetext($nachricht);
        $nachricht=str_replace(array('{1}','{2}','{3}'),array($spielerfarbe[$spieler], $spieler_name, $nachricht),$spieler."::::::".$lang['kommunikationsubfunk_b']['nachricht']);
        $datum=time();
        $zeiger_temp = @mysql_query("insert into $skrupel_neuigkeiten (datum,art,icon,inhalt,spieler_id,spiel_id,sicher) values ('$datum',7,'../bilder/news/subfunk.jpg','$nachricht',".int_get('emp').",$spiel,1);");
        ?>
        <center>
            <table border="0" cellspacing="0" cellpadding="0" height="100%">
                <tr>
                    <td><center><?php echo $lang['kommunikationsubfunk']['wurdeabgeschickt']; ?></td>
                </tr>
            </table>
        </center>
        <script language="Javascript">
            parent.window.close();
        </script>
        <?php
    include ("inc.footer.php");
}
