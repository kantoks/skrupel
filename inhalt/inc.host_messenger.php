<?php
if(count($sprachen) == 0) {
    include(LANGUAGEDIR.$language.'/lang.inc.host_messenger.php');
} else {
    foreach($sprachen as $sprache) {
        include(LANGUAGEDIR.$sprache.'/lang.inc.host_messenger.php');
    }
}
if ($fuu==1) {
    for ($k=1;$k<11;$k++) {
        if (($spieler_id_c[$k]>=1) and ($spieler_raus_c[$k]==0)) {
            $zeiger = mysql_query("SELECT jabber,optionen FROM $skrupel_user where id=$spieler_id_c[$k]");
            $array = mysql_fetch_array($zeiger);
            $jabberr=$array["jabber"];
            $optionen=$array["optionen"];
            if ((substr($optionen,1,1)=='1') and (strlen($jabberr)>=3)) {
                $hash=$spieler_hash[$k];
                ?>
                <iframe src="inc.host_messenger.php?fu=2&jab=<?php echo $jabberr?>&sname=<?php echo $spiel_name?>&hash=<?php echo $hash?>&k=<?php echo $k?>&sprache=<?php echo $_GET["sprache"]?>" style="border:0px;width:0px;height:0px;" scrolling="no" marginheight="0" marginwidth="0" frameborder="0"></iframe>
                <?php
            }
        }
    }
}
if ($_GET["fu"]==2) {
    include ("../inc.conf.php");
    $sname=$_GET["sname"];
    $jab=$_GET["jab"];
    $hash=$_GET["hash"];
    $msg=str_replace('{1}',$sname,$lang['hostmessenger'][$spielersprache[$_GET["k"]]][0]);
    ignore_user_abort(true);
    $url="http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'];
    $url=substr($url,0,strlen($url)-30);
    $msg.="\n\n".$url.'/index.php?hash='.$hash;
    // class.jabber.php einbinden
    require_once "classes/class.jabber.php";
    // Ein neues JABBER Objekt erstellen, mit den gewuenschten Zugangsdaten.
    $jabber = new Jabber();
    // Servername fuer den Account
    $jabber->server = $jabber_server;
    // Username fuer den Account
    $jabber->username = $jabber_botname;
    // Klartext-Passwort fuer den Account
    $jabber->password = $jabber_passwort;
    // Die Ressource klassifiziert lediglich einen Account, ist also nur ein Hilfsmerkmal
    $jabber->resource = 'skrupelNotificationBot';
    // Logging fuer Problelaeufe
    $jabber->enable_logging = true;
    // Der Empfaenger fuer meine Nachrichten
    $jabber->to = $jab;
    // Jabber-Verbindung herstellen
    $jabber->Connect();
    $jabber->SendAuth();
    $jabber->SendMessage($jabber->to, "normal", NULL, array("body" => $msg));
}
