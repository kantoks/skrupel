<?php

require_once ('../inc.conf.php');
require_once ('inc.hilfsfunktionen.php');

$langfile_1 = 'kommunikation_exch';
$fuid = int_get('fu');
$sid = (isset($_GET['sid']) && !preg_match('/[^0-9A-Za-z\/\.]/',$_GET['sid']))?$_GET['sid']:0;
$uid = (isset($_GET['uid']) && !preg_match('/[^0-9A-Za-z\/\.]/',$_GET['uid']))?$_GET['uid']:0;

if ($fuid==1) {
    //if(!$_POST["scroll_lock"]){$_POST["scroll_lock"]=0;}
    include ("inc.check.php");
    if (!empty($langfile_1)) include ('../lang/'.$spieler_sprache.'/lang.'.$langfile_1.'.php');
    if (!empty($langfile_2)) include ('../lang/'.$spieler_sprache.'/lang.'.$langfile_2.'.php');
?>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
            <title><?php echo $spieler_name; ?>@Skrupel</title>
            <META NAME="Author" CONTENT="Bernd Kantoks bernd@kantoks.de">
            <meta name="robots" content="index">
            <meta name="keywords" content=" ">
            <style type="text/css">
                body {margin: 0px; border: 0px;}
                #contentDiv {width: 100%; height: 100%;}
                #contentFrame {width: 100%; height: 100%;}
                body {
                    font: MessageBox;
                    font: Message-Box;
                    background: ThreeDFace;
                }
                body, html {
                 border: 1;
                }
                fieldset {
                    padding: 5px;
                    margin: 10px 5px;
                }
                td,input,select,textarea {
                    font: MessageBox;
                    font: Message-Box;
                }
            </style>
            <script type="text/javascript">
                function fixSize() {
                    contentDiv.style.height = document.body.offsetHeight - 26;
                }
                window.onload = fixSize;
                window.onresize = fixSize;
            </script>
        </head>
        <body scroll="no" style="background: buttonface;" topmargin="0" leftmargin="0" rightmargin="0" marginwidth="0" marginheight="0">
            <span class="menuBar" id="menuBar">
                <table border="0" cellspacing="3" cellpadding="0" width="100%">
                    <tr>
                        <td><img src="<?php echo $bildpfad; ?>/chat/logo.gif" width="86" height="20" alt="<?php echo $lang['kommunikationexch']['skrupelchat']?>"></td>
                        <td align="right">
                            <iframe src="kommunikation_exch.php?fu=5&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" scrolling="no" id="clockFrame" name="clockFrame" frameborder="0" style="width:20px;height:20px;"></iframe>
                        </td>
                    </tr>
                </table>
            </span>
            <div id="contentDiv">
                <iframe src="kommunikation_exch.php?fu=2&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" scrolling="yes" id="contentFrame" name="contentFrame" frameborder="0"></iframe>
            </div>
            <script>
                fixSize();
            </script>
        </body>
    </html>
    <?php
}
if ($fuid==2) {
    ?>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
            <title>Skrupel Chat</title>
            <META NAME="Author" CONTENT="Bernd Kantoks bernd@kantoks.de">
            <meta name="robots" content="index">
            <meta name="keywords" content=" ">
            <frameset framespacing="0" border="false" frameborder="0" rows="*,24,74">
                <frame name="chatinhalt" scrolling="yes" marginwidth="0" marginheight="0" noresize src="kommunikation_exch.php?fu=4&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" target="_self" style="border-color:#000000 buttonhighlight buttonhighlight #000000; border-style:solid;border-width:1;">
                <frame name="formatierung" scrolling="no" marginwidth="0" marginheight="0" noresize src="kommunikation_exch.php?fu=6&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" target="_self">
                <frame name="chatkonsole" scrolling="no" marginwidth="0" marginheight="0" noresize src="kommunikation_exch.php?fu=3&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" target="_self">
            <noframes>
        </head>
        <body>
        </body>
    </html>
    <?php
}
if ($fuid==3) {
    open_db();
    $zeiger = @mysql_query("SELECT chatfarbe, id From $skrupel_user where uid='$uid'");
    $array = @mysql_fetch_array($zeiger);
    $spieler_chatfarbe = $array["chatfarbe"];
    $spieler_id = $array["id"];
    include ("inc.check.php");
    ?>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
            <title>Skrupel Chat</title>
            <META NAME="Author" CONTENT="Bernd Kantoks bernd@kantoks.de">
            <meta name="robots" content="index">
            <meta name="keywords" content=" ">
            <style type="text/css">
                body    {margin: 0px; border: 0px;}
                #contentDiv {width: 100%; height: 100%;}
                #contentFrame    {width: 100%; height: 100%;}
                body {
                    background: ThreeDFace;
                    font-family:Verdana;
                    font-size:10px;
                }
                body, html {
                    border: 1;
                }
                fieldset {
                    padding:    5px;
                    margin:        10px 5px;
                }
                td,input,select {
                    font-family:Verdana;
                    font-size:10px;
                }
                textarea {
                    font-family:Verdana;
                    font-size:12px;
                }
            </style>
            <?php
            if (strlen(str_post('nachricht','SQLSAFE'))>=1) {
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
                //$nachricht=str_replace("\\", "",$nachricht);
                $nachricht=parsetext($nachricht);
                $jetzt=date("H:i",$aktuell);
                //$text="<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td valign=\"top\" style=\"color:$farbe;\"><nobr>$spieler_name&nbsp;</nobr></td><td valign=\"top\" style=\"color:#aaaaaa;\"><nobr>@ $jetzt&nbsp;</nobr></td><td valign=\"top\">$nachricht</td></tr></table>";
                $an=int_post('an');
                $zeiger = @mysql_query("INSERT INTO $skrupel_chat (spiel,datum,text,an,von,farbe) values (1,'$aktuell','$nachricht','$an','$spieler_name','$farbe');");
            }
            if (int_get('zeit')>=1) { } else { $neuzeit=time();$first=1;}
            ?>
            <script language="JavaScript">
                function senden(e) {
                    parent.chatkonsole.document.formular.an.value=parent.formatierung.document.formular.an.value;
                }
                var hotkey=13;
                if (document.layers) { document.captureEvents(Event.KEYPRESS); }
                function enter(e) {
                    if (document.layers){
                        if (e.which==hotkey) {
                            document.formular.nachricht.blur();
                            senden();
                            document.formular.submit();
                        }
                    } else {
                        if (document.all){
                            if (event.keyCode==hotkey) {
                                document.formular.nachricht.blur();
                                senden();
                                document.formular.submit();
                            }
                        }
                    }
                }
            </script>
        </head>
        <body scroll="no" style="background: buttonface;" onFocus="document.formular.nachricht.focus()" topmargin="0" leftmargin="0" rightmargin="0" marginwidth="0" marginheight="0">
            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                <tr>
                    <td>
                        <form name="formular" method="post" onsubmit="senden();" action="kommunikation_exch.php?fu=3&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&zeit=<?php echo $neuzeit; ?>">
                        <input type="hidden" name="akt" value="10">
                        <input type="hidden" name="neu" value="1">
                    </td>
                    <td width="100%">
                        <textarea style="width:100%;height:72px;" name="nachricht" onkeypress="enter()"></textarea>
                    </td>
                    <?php 
                    /* 
                        <td>&nbsp;</td>
                        <td><input type="submit" value="S" style="width:20px;height:70px;"></td>
                    */
                    ?>
                    <td><input type="hidden" name="an" value="0"></form></td>
                </tr>
            </table>
            <script language="Javascript">
                <?php
                if ($first==1) {
                    ?>
                    document.formular.nachricht.focus();
                    <?php
                }
                ?>
            </script>
        </body>
    </html>
    <?php
}
if ($fuid==4) {
    open_db();
    $zeiger = @mysql_query("SELECT chatfarbe, id From $skrupel_user where uid='$uid'");
    $array = @mysql_fetch_array($zeiger);
    $spieler_chatfarbe = $array["chatfarbe"];
    $spieler_id = $array["id"];
    include ("inc.check.php");
    if (!empty($langfile_1)) include ('../lang/'.$spieler_sprache.'/lang.'.$langfile_1.'.php');
    if (!empty($langfile_2)) include ('../lang/'.$spieler_sprache.'/lang.'.$langfile_2.'.php');
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
            if ($an==$spieler_id) {
                $textn="<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td><img src=\"../bilder/empty.gif\" width=\"1\" height=\"15\"></td><td valign=\"top\" style=\"color:#$vonfarbe;\"><nobr><b>[$von] ".$lang['kommunikationexch']['fluestert']."</b>&nbsp;</nobr></td><td valign=\"top\">$textn</td></tr></table>";
            } else {
                $textn="<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td><img src=\"../bilder/empty.gif\" width=\"1\" height=\"15\"></td><td valign=\"top\" style=\"color:#$vonfarbe;\"><nobr>[$von]&nbsp;</nobr></td><td valign=\"top\">$textn</td></tr></table>";
            }
            $neutext=$neutext.$textn;
        }
    }
    ?>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
            <title>Skrupel Chat</title>
            <META NAME="Author" CONTENT="Bernd Kantoks bernd@kantoks.de">
            <meta name="robots" content="index">
            <meta name="keywords" content=" ">
            <style type="text/css">
                body {
                    font-family:Verdana;
                    font-size:11px;
                    background: buttonhighlight;
                }
                body, html {
                    border: 1;
                }
                fieldset {
                    padding:    5px;
                    margin:        10px 5px;
                }
                td,input,select,textarea {
                    font-family:Verdana;
                    font-size:11px;
                }
            </style>
        </head>
        <body text="#000000" bgcolor="#ffffff" onLoad="window.scrollTo(0,5000);" link="#000000" vlink="#000000" alink="#000000" leftmargin="5" rightmargin="5" topmargin="4" marginwidth="4" marginheight="4">
            <script language=javascript>
                function scrollrunter(){
                    window.scrollBy(0,2);
                    setTimeout("scrollrunter()",20);
                }
                scrollrunter();
            </script>
            <div id="chattext"><?php echo $neutext; ?></div>
        </body>
    </html>
    <?php
    
}
if ($fuid==5) {
    open_db();
    $zeiger = @mysql_query("SELECT chatfarbe, id From $skrupel_user where uid='$uid'");
    $array = @mysql_fetch_array($zeiger);
    $spieler_chatfarbe = $array["chatfarbe"];
    $spieler_id = $array["id"];
    include ("inc.check.php");
    if (!empty($langfile_1)) include ('../lang/'.$spieler_sprache.'/lang.'.$langfile_1.'.php');
    if (!empty($langfile_2)) include ('../lang/'.$spieler_sprache.'/lang.'.$langfile_2.'.php');
    ?>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
            <title>Skrupel Chat</title>
            <META NAME="Author" CONTENT="Bernd Kantoks bernd@kantoks.de">
            <meta name="robots" content="index">
            <meta name="keywords" content=" ">
            <style type="text/css">
                body    {margin: 0px; border: 0px;}
                #contentDiv {width: 100%; height: 100%;}
                #contentFrame    {width: 100%; height: 100%;}
                body {
                    background: ThreeDFace;
                    font-family:Verdana;
                    font-size:10px;
                }
                body, html {
                    border: 1;
                }
                fieldset {
                    padding:    5px;
                    margin:        10px 5px;
                }
                td,input,select {
                    font-family:Verdana;
                    font-size:10px;
                }
                textarea {
                    font-family:Verdana;
                    font-size:12px;
                }
            </style>
            <?php
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
                        if ($an==$spieler_id) {
                            $textn="<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td><img src=\"../bilder/empty.gif\" width=\"1\" height=\"15\"></td><td valign=\"top\" style=\"color:#$vonfarbe;\"><nobr><b>[$von] ".$lang['kommunikationexch']['fluestert']."</b>&nbsp;</nobr></td><td valign=\"top\">$textn</td></tr></table>";
                        } else {
                            $textn="<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td><img src=\"../bilder/empty.gif\" width=\"1\" height=\"15\"></td><td valign=\"top\" style=\"color:#$vonfarbe;\"><nobr>[$von]&nbsp;</nobr></td><td valign=\"top\">$textn</td></tr></table>";
                        }
                        $neutext=$neutext.$textn;
                        $neuzeit=$datumn;
                    }
                } else { $neuzeit=int_get('zeit'); }
                ?>
                <script language=JavaScript>
                    var ant=parent.contentFrame.chatinhalt.document.getElementById('chattext');
                    ant.innerHTML=ant.innerHTML+'<?php echo $neutext; ?>';
                </script>
                <?php
            } else { $neuzeit=time();$first=1;}
            ?>
            <script language="JavaScript">
                function startClock2() {
                    Interv = Interv - 1;
                    var now = new Date();
                    var dummystr = parseInt(now.getTime() / 1000);
                    delete now;
                    if (0 > Interv) {
                        Interv=4;
                        document.formular.submit();
                    }
                    //document.formular.clock.value = Interv
                    timrID = setTimeout("startClock2()", 1000);
                }
            </script>
        </head>
        <body scroll="no" style="background: buttonface;" topmargin="0" leftmargin="0" rightmargin="0" marginwidth="0" marginheight="0">
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><img src="<?php echo $bildpfad; ?>/chat/clock.gif" width="20" height="20" alt="<?php echo $lang['kommunikationexch']['uhr']?>"></td>
                    <td>
                        <form name="formular" method="post" action="kommunikation_exch.php?fu=5&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&zeit=<?php echo $neuzeit; ?>">
                        <input type="hidden" name="akt" value="10">
                        <input type="hidden" name="neu" value="1">
                    </td>
                    <td></form></td>
                </tr>
            </table>
            <script language="Javascript">
                var Interv = 4;
                startClock2();
            </script>
        </body>
    </html>
    <?php
    
}
if ($fuid==6) {
    open_db();
    include ("inc.check.php");
    if (!empty($langfile_1)) include ('../lang/'.$spieler_sprache.'/lang.'.$langfile_1.'.php');
    if (!empty($langfile_2)) include ('../lang/'.$spieler_sprache.'/lang.'.$langfile_2.'.php');
    $zeiger = @mysql_query("SELECT * FROM $skrupel_user order by nick");
    $useranzahl = @mysql_num_rows($zeiger);
    ?>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
            <title>Skrupel Chat</title>
            <META NAME="Author" CONTENT="Bernd Kantoks bernd@kantoks.de">
            <meta name="robots" content="index">
            <meta name="keywords" content=" ">
            <style type="text/css">
                body    {margin: 0px; border: 0px;}
                #contentDiv {width: 100%; height: 100%;}
                #contentFrame    {width: 100%; height: 100%;}
                body {
                    background: ThreeDFace;
                    font-family:Verdana;
                    font-size:10px;
                }
                body, html {
                    border: 1;
                }
                fieldset {
                    padding:    5px;
                    margin:        10px 5px;
                }
                td,input,select {
                    font-family:Verdana;
                    font-size:10px;
                }
                textarea {
                    font-family:Verdana;
                    font-size:12px;
                }
            </style>
            <script language="JavaScript">
                tag_prompt = "<?php echo $lang['kommunikationexch']['texteingeben']; ?>";
                font_formatter_prompt = "<?php echo $lang['kommunikationexch']['texteingeben']; ?>";
                link_text_prompt = "<?php echo $lang['kommunikationexch']['linktext']; ?>";
                link_url_prompt = "<?php echo $lang['kommunikationexch']['linkurl']; ?>";
                link_email_prompt = "<?php echo $lang['kommunikationexch']['email']; ?>";
                tags = new Array();
                function code(theform,vbcode,prompttext) {
                    inserttext = prompt(tag_prompt+"\n["+vbcode+"]xxx[/"+vbcode+"]",prompttext);
                        if ((inserttext != null) && (inserttext != ""))
                        parent.chatkonsole.document.formular.nachricht.value += "["+vbcode+"]"+inserttext+"[/"+vbcode+"] ";
                        parent.chatkonsole.document.formular.nachricht.focus();
                }
                function namedlink(theform,thetype) {
                    linktext = prompt(link_text_prompt,"");
                        var prompttext;
                        if (thetype == "URL") {
                            prompt_text = link_url_prompt;
                            prompt_contents = "http://";
                            }
                        else {
                            prompt_text = link_email_prompt;
                            prompt_contents = "";
                            }
                    linkurl = prompt(prompt_text,prompt_contents);
                    if ((linkurl != null) && (linkurl != "")) {
                        if ((linktext != null) && (linktext != ""))
                        parent.chatkonsole.document.formular.nachricht.value += "["+thetype+"="+linkurl+"]"+linktext+"[/"+thetype+"] ";
                        else
                        parent.chatkonsole.document.formular.nachricht.value += "["+thetype+"]"+linkurl+"[/"+thetype+"] ";
                        }
                    parent.chatkonsole.document.formular.nachricht.focus();
                }
                function smilie(thesmilie) {
                    parent.chatkonsole.document.formular.nachricht.value += thesmilie;
                    parent.chatkonsole.document.formular.nachricht.focus();
                }
            </script>
        </head>
        <body scroll="no" style="background: buttonface;" topmargin="0" leftmargin="0" rightmargin="0" marginwidth="0" marginheight="0">
            <table border="0" cellspacing="2" cellpadding="0" width="100%">
                 <tr>
                    <td><form name="formular"></td>
                    <td><nobr><?php echo $lang['kommunikationexch']['an']?>&nbsp;</nobr></td>
                    <td>
                        <select name="an">
                            <option value="0"><?php echo $lang['kommunikationexch']['allemitspieler']; ?></option>
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
                                <option value="<?php echo $user_id; ?>" style="background-color:#<?php echo $spielerchatfarbe?>;color:#000000" <?php if(int_post('an')==$user_id) echo "selected";?> ><?php echo $nick?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                    <td width="100%">&nbsp;</td>
                    <td style="border-color:ThreeDFace; border-style:solid;border-width:1;" onmouseover="this.style.borderColor='buttonhighlight buttonshadow buttonshadow buttonhighlight';" onmouseout="this.style.borderColor='ThreeDFace';">
                        <img src="<?php echo $bildpfad?>/chat/b.gif" width="19" height="19" onclick="code(this.form,'B','')" title="<?php echo $lang['kommunikationexch']['b']?>">
                    </td>
                    <td style="border-color:ThreeDFace; border-style:solid;border-width:1;" onmouseover="this.style.borderColor='buttonhighlight buttonshadow buttonshadow buttonhighlight';" onmouseout="this.style.borderColor='ThreeDFace';">
                        <img src="<?php echo $bildpfad?>/chat/i.gif" width="19" height="19" onclick="code(this.form,'I','')" title="<?php echo $lang['kommunikationexch']['i']?>">
                    </td>
                    <td style="border-color:ThreeDFace; border-style:solid;border-width:1;" onmouseover="this.style.borderColor='buttonhighlight buttonshadow buttonshadow buttonhighlight';" onmouseout="this.style.borderColor='ThreeDFace';">
                        <img src="<?php echo $bildpfad?>/chat/u.gif" width="19" height="19" onclick="code(this.form,'U','')" title="<?php echo $lang['kommunikationexch']['u']?>">
                    </td>
                    <td style="border-color:ThreeDFace; border-style:solid;border-width:1;" onmouseover="this.style.borderColor='buttonhighlight buttonshadow buttonshadow buttonhighlight';" onmouseout="this.style.borderColor='ThreeDFace';">
                        <img src="<?php echo $bildpfad?>/chat/img.gif" width="19" height="19" onclick="code(this.form,'IMG','http://')" title="<?php echo $lang['kommunikationexch']['img']?>">
                    </td>
                    <td style="border-color:ThreeDFace; border-style:solid;border-width:1;" onmouseover="this.style.borderColor='buttonhighlight buttonshadow buttonshadow buttonhighlight';" onmouseout="this.style.borderColor='ThreeDFace';">
                        <img src="<?php echo $bildpfad?>/chat/url.gif" width="19" height="19" onclick="namedlink(this.form,'URL')" title="<?php echo $lang['kommunikationexch']['lnk']?>">
                    </td>
                    <td><img src="../bilder/empty.gif" width="5" height="1"></td>
                </tr>
            </table>
            </form>
        </body>
    </html>
    <?php 
}
if ($fuid==7) {
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Skrupel Chat</title>
<META NAME="Author" CONTENT="Bernd Kantoks bernd@kantoks.de">
<meta name="robots" content="index">
<meta name="keywords" content=" ">
<style type="text/css">
body    {margin: 0px; border: 0px;}
#contentDiv {width: 100%; height: 100%;}
#contentFrame    {width: 100%; height: 100%;}
body {
 background: ThreeDFace;
 font-family:Verdana;
 font-size:10px;
}
body, html {
 border: 1;
}
fieldset {
    padding:    5px;
    margin:        10px 5px;
}
td,input,select {
 font-family:Verdana;
 font-size:10px;
}
textarea {
 font-family:Verdana;
 font-size:12px;
}
</style>
</head>
<body scroll="no" style="background: buttonface;" topmargin="0" leftmargin="0" rightmargin="0" marginwidth="0" marginheight="0">
<script language="Javascript">
    top.window.close();
</script>
</body>
</html>
<?php
}
