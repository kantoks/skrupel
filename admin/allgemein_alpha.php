<?php
require_once ('../inc.conf.php'); 
require_once (../inhalt/'inc.hilfsfunktionen.php');
include ("../lang/".$language."/lang.admin.allgemein_alpha.php");
$fuid = int_get('fu');

if ($fuid==1) {
    include ("inc.header.php");
    if (($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)) {
        ?>
        <body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <center>
                <table border="0" cellspacing="0" cellpadding="0" height="100%">
                    <tr>
                        <td>
                            <center>
                                <table border="0" cellspacing="0" cellpadding="4">
                                    <tr>
                                        <td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)"><?php echo $lang['admin']['allgemein']['alpha']['offenbarung']?></td>
                                    </tr>
                                </table>
                            </center>
                            <br>
                            <center><?php echo $lang['admin']['allgemein']['alpha']['offenbarung_text']?></center>
                            <form name="formular" method="post" action="allgemein_alpha.php?fu=2">
                            <textarea name="offenbarung" style="width:100%;height:255px;"></textarea>
                            <br><br>
                            <center>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td><input type="submit" name="dumdidum" value="Offenbarung verk&uuml;nden" style="width:250px;"></td>
                                        <td></form></td>
                                    </tr>
                                </table>
                            </center>
                            <br>
                        </td>
                    </tr>
                </table>
            </center>
            <?php
    } 
    include ("inc.footer.php");
 }

if ($fuid==2) {
    include ("inc.header.php");
    if (($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)) {
        $forum=1;
        $icon=1;

        $beginner=$lang['admin']['allgemein']['alpha']['gott'];

        $letzter=time();

        $beitrag=str_post('offenbarung','SQLSAFE');

        $thema=substr($beitrag,0,30)."...";

        //$thema=str_replace("&","&amp;",$thema);
        //$thema=str_replace("<","&lt;",$thema);
        //$thema=str_replace(">","&gt;",$thema);

        //$beitrag=str_replace("&","&amp;",$beitrag);
        //$beitrag=str_replace("<","&lt;",$beitrag);
        //$beitrag=str_replace(">","&gt;",$beitrag);

        //$beitrag=nl2br(stripslashes($beitrag));
        //$beitrag=str_replace("'", "",$beitrag);
        //$beitrag=str_replace("\"", "",$beitrag);
        //$beitrag=str_replace("\\", "",$beitrag);

        $zeiger = @mysql_query("INSERT INTO $skrupel_forum_thema (forum,icon,thema,beginner,antworten,letzter) values ($forum,$icon,'$thema','$beginner',0,'$letzter');");

        $zeiger = @mysql_query("SELECT * FROM $skrupel_forum_thema where forum=$forum and icon=$icon and beginner='$beginner' and thema='$thema' and letzter='$letzter' and antworten=0;");
        $array = @mysql_fetch_array($zeiger);
        $idthema=$array["id"];

        $zeiger = @mysql_query("INSERT INTO $skrupel_forum_beitrag (thema,forum,datum,beitrag,verfasser,spielerid) values ($idthema,$forum,'$letzter','$beitrag','$beginner',0);");

        $nachricht=$idthema.$lang['admin']['allgemein']['alpha']['lauschegott'].$beitrag;
        $datum=time();

        $zeiger_temp = @mysql_query("SELECT * FROM $skrupel_spiele where phase=0 order by id");
        $spielanzahl = @mysql_num_rows($zeiger_temp);
        if ($spielanzahl>=1) {
            for  ($iii=0; $iii<$spielanzahl;$iii++) {
                $ok_temp = @mysql_data_seek($zeiger_temp,$iii);
                $array22 = @mysql_fetch_array($zeiger_temp);

                $spiel=$array22["id"];

                $spieler_1=$array22["spieler_1"];
                $spieler_2=$array22["spieler_2"];
                $spieler_3=$array22["spieler_3"];
                $spieler_4=$array22["spieler_4"];
                $spieler_5=$array22["spieler_5"];
                $spieler_6=$array22["spieler_6"];
                $spieler_7=$array22["spieler_7"];
                $spieler_8=$array22["spieler_8"];
                $spieler_9=$array22["spieler_9"];
                $spieler_10=$array22["spieler_10"];

                if ($spieler_1>=1) { $zeiger = @mysql_query("insert into $skrupel_neuigkeiten (datum,art,icon,inhalt,spieler_id,spiel_id,sicher) values ('$datum',8,'../bilder/news/admin.jpg','$nachricht',1,$spiel,1);"); }
                if ($spieler_2>=1) { $zeiger = @mysql_query("insert into $skrupel_neuigkeiten (datum,art,icon,inhalt,spieler_id,spiel_id,sicher) values ('$datum',8,'../bilder/news/admin.jpg','$nachricht',2,$spiel,1);"); }
                if ($spieler_3>=1) { $zeiger = @mysql_query("insert into $skrupel_neuigkeiten (datum,art,icon,inhalt,spieler_id,spiel_id,sicher) values ('$datum',8,'../bilder/news/admin.jpg','$nachricht',3,$spiel,1);"); }
                if ($spieler_4>=1) { $zeiger = @mysql_query("insert into $skrupel_neuigkeiten (datum,art,icon,inhalt,spieler_id,spiel_id,sicher) values ('$datum',8,'../bilder/news/admin.jpg','$nachricht',4,$spiel,1);"); }
                if ($spieler_5>=1) { $zeiger = @mysql_query("insert into $skrupel_neuigkeiten (datum,art,icon,inhalt,spieler_id,spiel_id,sicher) values ('$datum',8,'../bilder/news/admin.jpg','$nachricht',5,$spiel,1);"); }
                if ($spieler_6>=1) { $zeiger = @mysql_query("insert into $skrupel_neuigkeiten (datum,art,icon,inhalt,spieler_id,spiel_id,sicher) values ('$datum',8,'../bilder/news/admin.jpg','$nachricht',6,$spiel,1);"); }
                if ($spieler_7>=1) { $zeiger = @mysql_query("insert into $skrupel_neuigkeiten (datum,art,icon,inhalt,spieler_id,spiel_id,sicher) values ('$datum',8,'../bilder/news/admin.jpg','$nachricht',7,$spiel,1);"); }
                if ($spieler_8>=1) { $zeiger = @mysql_query("insert into $skrupel_neuigkeiten (datum,art,icon,inhalt,spieler_id,spiel_id,sicher) values ('$datum',8,'../bilder/news/admin.jpg','$nachricht',8,$spiel,1);"); }
                if ($spieler_9>=1) { $zeiger = @mysql_query("insert into $skrupel_neuigkeiten (datum,art,icon,inhalt,spieler_id,spiel_id,sicher) values ('$datum',8,'../bilder/news/admin.jpg','$nachricht',9,$spiel,1);"); }
                if ($spieler_10>=1) { $zeiger = @mysql_query("insert into $skrupel_neuigkeiten (datum,art,icon,inhalt,spieler_id,spiel_id,sicher) values ('$datum',8,'../bilder/news/admin.jpg','$nachricht',10,$spiel,1);"); }
            }
        }
        ?>
        <body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <center>
                <table border="0" cellspacing="0" cellpadding="0" height="100%">
                    <tr>
                        <td>
                            <?php echo $lang['admin']['allgemein']['alpha']['verkuendung']?>
                        </td>
                    </tr>
                </table>
            </center>
            <?php
    }
    include ("inc.footer.php");
}
