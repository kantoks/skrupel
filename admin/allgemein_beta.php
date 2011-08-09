<?php
include ("../inc.conf.php");
include ("../lang/".$language."/lang.admin.allgemein_beta.php");
if ($_GET["fu"]==1) {
    include ("inc.header.php");
    if (($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)) {

        $zeiger = @mysql_query("SELECT * FROM $skrupel_info");
        $array = @mysql_fetch_array($zeiger);
        $spiel_chat=$array["chat"];
        $spiel_anleitung=$array["anleitung"];
        $spiel_forum=$array["forum"];
        $spiel_forum_url=$array["forum_url"];
        ?>
        <body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <center>
                <table border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)"><?php echo $lang['admin']['allgemein']['beta']['einstellungen']?></td>
                    </tr>
                </table>
            </center>
            <form name="formular" method="post" action="allgemein_beta.php?fu=2">
            <center>
                <table border="0" cellspacing="0" cellpadding="2">
                    <tr>
                        <td><?php echo $lang['admin']['allgemein']['beta']['srv_chat']?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><input type="radio" name="chat" value="0"  <?php if ($spiel_chat==0) { echo "checked"; }?>></td>
                                    <td>&nbsp;</td>
                                    <td style="color:#aaaaaa;"><?php echo $lang['admin']['allgemein']['beta']['aktiviert']?></td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="chat" value="1"  <?php if ($spiel_chat==1) { echo "checked"; }?>></td>
                                    <td>&nbsp;</td>
                                    <td style="color:#aaaaaa;"><?php echo $lang['admin']['allgemein']['beta']['deaktiviert']?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><?php echo $lang['admin']['allgemein']['beta']['link']?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><input type="radio" name="anleitung" value="0"  <?php if ($spiel_anleitung==0) { echo "checked"; }?>></td>
                                    <td>&nbsp;</td>
                                    <td style="color:#aaaaaa;"><?php echo $lang['admin']['allgemein']['beta']['aktiviert']?></td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="anleitung" value="1"  <?php if ($spiel_anleitung==1) { echo "checked"; }?>></td>
                                    <td>&nbsp;</td>
                                    <td style="color:#aaaaaa;"><?php echo $lang['admin']['allgemein']['beta']['deaktiviert']?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><?php echo $lang['admin']['allgemein']['beta']['forum']?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><input type="radio" name="forum" value="0" <?php if ($spiel_forum==0) { echo "checked"; }?>></td>
                                    <td>&nbsp;</td>
                                    <td style="color:#aaaaaa;"><?php echo $lang['admin']['allgemein']['beta']['aktiviert']?></td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="forum" value="1" <?php if ($spiel_forum==1) { echo "checked"; }?>></td>
                                    <td>&nbsp;</td>
                                    <td style="color:#aaaaaa;"><?php echo $lang['admin']['allgemein']['beta']['deaktiviert']?></td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="forum" value="2" <?php if ($spiel_forum==2) { echo "checked"; }?>></td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td style="color:#aaaaaa;"><?php echo $lang['admin']['allgemein']['beta']['extern']?></td>
                                                <td><input type="text" class="eingabe" name="forum_url" value="  <?php echo $spiel_forum_url; ?>" style="width:250px;" maxlength="255"></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </center>
            <br>
            <center>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><input type="submit" name="bla" value="<?php echo $lang['admin']['allgemein']['beta']['speichern']?>"></td>
                        <td></form></td>
                    </tr>
                </table>
            </center>
            <br><br>
            <?php
    }
    include ("inc.footer.php");
}

if ($_GET["fu"]==2) {
    include ("inc.header.php");
    if (($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)) {

        $chat=$_POST["chat"];
        $anleitung=$_POST["anleitung"];
        $forum=$_POST["forum"];
        $forum_url=$_POST["forum_url"];

        $zeiger = @mysql_query("update $skrupel_info set chat=$chat, anleitung=$anleitung, forum=$forum, forum_url='$forum_url'");

        ?>
        <body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" height="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
            <?php echo $lang['admin']['allgemein']['beta']['aktualisiert']?>
                        <br><br><br>
                        <center>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><form name="formular"  method="post" action="allgemein_beta.php?fu=1"></td>
                                    <td><input type="submit" name="bla" value="<?php echo $lang['admin']['allgemein']['beta']['zurueck']?>"></td>
                                    <td></form></td>
                                </tr>
                            </table>
                        </center>
                    </td>
                </tr>
            </table>
        </center>
    <?php } include ("inc.footer.php");
}
