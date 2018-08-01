<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'kommunikation_ch';
$fuid = int_get('fu');

if ($fuid==1) {
    include ("inc.header.php");
    ?>
    <frameset framespacing="0" border="false" frameborder="0" cols="*,360,*">
        <frame name="randlinks" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=14&bildpfad=<?php echo $bildpfad; ?>" target="_self">
        <frame name="chatkonsole" scrolling="no" marginwidth="0" marginheight="0" noresize src="kommunikation_ch.php?fu=2&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" target="_self">
        <frame name="randrechts" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=14&bildpfad=<?php echo $bildpfad; ?>" target="_self">
    </frameset>
    <noframes>
    <body>
        <?php
    include ("inc.footer.php");
}
if ($fuid==2) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT chatfarbe, id From $skrupel_user where uid='$uid'");
    $array = @mysql_fetch_array($zeiger);
    $spieler_chatfarbe = $array["chatfarbe"];
    $spieler_id = $array["id"];
    $first = 0;
    if (strlen(str_post('nachricht','SQLSAFE'))>=1) {
        $aktuell=time();
        $farbe=$spieler_chatfarbe;
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
        $aktuell=time();
        $farbe=$spieler_chatfarbe;
        $nachricht=str_post('nachricht','SQLSAFE');
        //$nachricht=nl2br(stripslashes($nachricht));
        //$nachricht=str_replace("'", "",$nachricht);
        //$nachricht=str_replace("\"", "",$nachricht);
        //$nachricht=str_replace("\\", "",$nachricht);
        //$nachricht=str_replace("\;", "",$nachricht);
        //$nachricht=str_replace("\n", "",$nachricht);
        $nachricht=parsetext($nachricht);
        $jetzt=date("H:i",$aktuell);
         //$text="<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td valign=\"top\" style=\"color:$farbe;\"><nobr>$spieler_name&nbsp;</nobr></td><td valign=\"top\" style=\"color:#aaaaaa;\"><nobr>@ $jetzt&nbsp;</nobr></td><td valign=\"top\">$nachricht</td></tr></table>";
        $an=int_post('an');
        $zeiger = @mysql_query("INSERT INTO $skrupel_chat (spiel,datum,text,an,von,farbe) values ($spiel,'$aktuell','$nachricht','$an','$spieler_name','$farbe');");
    }
    if (int_get('zeit')>=1) {
        $neutext="";
        $textn="";
        $datumzeit=int_get('zeit');
        $zeiger = @mysql_query("SELECT * FROM $skrupel_chat where datum>$datumzeit and (an=0 or an=$spieler_id) order by datum");
        $chatanzahl = @mysql_num_rows($zeiger);
        if ($chatanzahl>=1) {
            for ($i=0; $i<$chatanzahl;$i++) {
                $ok = @mysql_data_seek($zeiger,$i);
                $array = @mysql_fetch_array($zeiger);
                $textn=$array["text"];
                $datumn=$array["datum"];
                $von=$array["von"];
                $vonfarbe=$array["farbe"];
                $an=$array["an"];
                $jetzt=date("H:i",$datumn);
                if ($an==$spieler_id) {
                    $textn="<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td valign=\"top\" style=\"color:$vonfarbe;\"><nobr><b>[$von] ".$lang['kommunikationch']['fluestert']."</b>&nbsp;</nobr></td><td valign=\"top\" style=\"color:#aaaaaa;\"><nobr>@ $jetzt&nbsp;</nobr></td><td valign=\"top\">$textn</td></tr></table>";
                } else {
                    $textn="<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td valign=\"top\" style=\"color:$vonfarbe;\"><nobr>[$von]&nbsp;</nobr></td><td valign=\"top\" style=\"color:#aaaaaa;\"><nobr>@ $jetzt&nbsp;</nobr></td><td valign=\"top\">$textn</td></tr></table>";
                }
                $neutext=$neutext.$textn;
                $neuzeit=$datumn;
            }
        } else { 
            $neuzeit=int_get('zeit');
        }
        ?>
        <script language=JavaScript>
            var ant=parent.parent.mittemitte.rahmen12.document.getElementById('chattext');
            ant.innerHTML=ant.innerHTML+'<?php echo $neutext; ?>';
        </script>
        <?php
    } else { 
        $neuzeit=time();$first=1;
    }
    $akt=int_post('akt');
    if (!$akt) {$akt=10;}
    ?>
    <script language="Javascript">
        function startClock2() {
            Interv = Interv - 1;
            var now = new Date();
            var dummystr = parseInt(now.getTime() / 1000);
            delete now;
            if (0 > Interv ) {
                if (document.formular.nachricht.value=="") {
                    if (document.formular.akt[0].checked) {Interv=10};
                    if (document.formular.akt[1].checked) {Interv=30};
                    if (document.formular.akt[2].checked) {Interv=20};
                    if (document.formular.akt[3].checked) {Interv=60};
                    document.formular.submit();
                } else {
                    if (document.formular.akt[0].checked) {Interv=10};
                    if (document.formular.akt[1].checked) {Interv=30};
                    if (document.formular.akt[2].checked) {Interv=20};
                    if (document.formular.akt[3].checked) {Interv=60};
                }
            }
            //document.formular.subben.value = Interv
            timrID = setTimeout("startClock2()", 1000);
        }
    </script>
    <body text="#000000" bgcolor="#444444" onFocus="document.formular.nachricht.focus()" style="background-image:url('../bilder/aufbau/14.gif'); background-attachment:fixed;" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="9"></td>
                    <td><form name="formular" method="post" action="kommunikation_ch.php?fu=2&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&zeit=<?php echo $neuzeit; ?>"></td>
                    <td><input type="hidden" name="neu" value="1"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td></td>
                                <td>
                                    <select name="an" style="width:75px;">
                                        <option value="0"><?php echo str_replace('{1}',$lang['kommunikationch']['alle'],$lang['kommunikationch']['an'])?></option>
                                        <?php
                                        $zeiger = @mysql_query("SELECT * FROM $skrupel_user WHERE uid<>'".$uid."' order by nick");
                                        $user_anzahl = @mysql_num_rows($zeiger);
                                        for  ($i=0; $i<$user_anzahl;$i++) {
                                            $ok = @mysql_data_seek($zeiger,$i);
                                            $array = @mysql_fetch_array($zeiger);
                                            $nick=$array["nick"];
                                            $user_id=$array["id"];
                                            $spielerchatfarbe=$array["chatfarbe"];
                                            ?>
                                            <option value="<?php echo $user_id; ?>" style="color:#<?php echo $spielerchatfarbe?>;" <?php if(int_post('an')==$user_id) echo "selected";?> ><?php echo str_replace('{1}',$nick,$lang['kommunikationch']['an'])?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><center><input type="text" name="nachricht" maxlength="1000" style="width:275px;" class="eingabe" autocomplete="off"></center></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="7"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><center><input type="submit" name="subben" value="<?php echo $lang['kommunikationch']['aktualisieren']; ?>" style="width:350px;"></center></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="7"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0" width="100%">
                            <tr>
                                <td><input type="radio" name="akt" value="10" <?php if ($akt==10) { echo "checked"; } ?>></td>
                                <td style="color:#aaaaaa;"><nobr>&nbsp;<?php echo $lang['kommunikationch']['sek10']; ?></nobr></td>
                                <td width="100%">&nbsp;</td>
                                <td style="color:#aaaaaa;"><nobr><?php echo $lang['kommunikationch']['sek30']; ?>&nbsp;</nobr></td>
                                <td><input type="radio" name="akt" value="30" <?php if ($akt==30) { echo "checked"; } ?>></td>
                            </tr>
                            <tr>
                                <td><input type="radio" name="akt" value="20" <?php if ($akt==20) { echo "checked"; } ?>></td>
                                <td style="color:#aaaaaa;"><nobr>&nbsp;<?php echo $lang['kommunikationch']['sek20']; ?></nobr></td>
                                <td width="100%">&nbsp;</td>
                                <td style="color:#aaaaaa;"><nobr><?php echo $lang['kommunikationch']['sek60']; ?>&nbsp;</nobr></td>
                                <td><input type="radio" name="akt" value="60" <?php if ($akt==60) { echo "checked"; } ?>></td>
                            </tr>
                        </table>
                    </td>
                    <td></form></td>
                </tr>
            </table>
        </center>
        <script language="Javascript">
            <?php
            if ($first==1) { 
                ?>
                document.formular.nachricht.focus();
                <?php
            }
            ?>
            var Interv = 10;
            if (document.formular.akt[0].checked) {Interv=10};
            if (document.formular.akt[1].checked) {Interv=30};
            if (document.formular.akt[2].checked) {Interv=20};
            if (document.formular.akt[3].checked) {Interv=60};
            startClock2();
        </script>
        <?php
    include ("inc.footer.php");
}
if ($fuid==3) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT chatfarbe, id From $skrupel_user where uid='$uid'");
    $array = @mysql_fetch_array($zeiger);
    $spieler_chatfarbe = $array["chatfarbe"];
    $spieler_id = $array["id"];
    $aktuell=time();
    $aktuell=$aktuell-86400;
    $zeiger = @mysql_query("DELETE FROM $skrupel_chat where datum<$aktuell");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_chat where an=0 or an=$spieler_id order by datum desc ");
    $chatanzahl = @mysql_num_rows($zeiger);
	$neutext = "";
    if ($chatanzahl>=1) {
        for ($i=$chatanzahl-1; $i>=0;$i--) {
            $ok = @mysql_data_seek($zeiger,$i);
            $array = @mysql_fetch_array($zeiger);
            $textn=$array["text"];
            $von=$array["von"];
            $vonfarbe=$array["farbe"];
            $an=$array["an"];
            $datum=$array["datum"];
            $jetzt=date("H:i",$datum);
            if ($an==$spieler_id) {
                $textn="<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td valign=\"top\" style=\"color:$vonfarbe;\"><nobr><b>[$von] ".$lang['kommunikationch']['fluestert']."</b>&nbsp;</nobr></td><td valign=\"top\" style=\"color:#aaaaaa;\"><nobr>@ $jetzt&nbsp;</nobr></td><td valign=\"top\">$textn</td></tr></table>";
            } else {
                $textn="<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td valign=\"top\" style=\"color:$vonfarbe;\"><nobr>[$von]&nbsp;</nobr></td><td valign=\"top\" style=\"color:#aaaaaa;\"><nobr>@ $jetzt&nbsp;</nobr></td><td valign=\"top\">$textn</td></tr></table>";
            }
            $neutext=$neutext.$textn;
        }
    }
    ?>
    <body text="#000000" bgcolor="#444444" onLoad="window.scrollTo(0,5000);" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <script language=javascript>
            function scrollrunter(){
                window.scrollBy(0,2);
                setTimeout("scrollrunter()",20);
            }
            scrollrunter();
        </script>
        <div id="chattext"><?php echo $neutext; ?></div>
        <?php
    include ("inc.footer.php");
}
