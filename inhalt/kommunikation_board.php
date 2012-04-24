<?php

require_once ('../inc.conf.php');
require_once ('inc.hilfsfunktionen.php');

open_db();

$langfile_1 = 'kommunikation_board';
$fuid = int_get('fu');

if ($fuid==1) {
    include ("inc.header.php");
    ?>
    <style type="text/css">
        td.forumdunkel {
            background-color:#404040;
            border-color:#595959 #272727 #272727 #595959;
            border-style:solid;
            border-width:2 2 2 2;
        }
        td.forummittel {
            background-color:#606060;
            border-color:#797979 #474747 #474747 #797979;
            border-style:solid;
            border-width:2 2 2 2;
        }
        td.forumhell{
            background-color:#808080;
            border-color:#999999 #676767 #676767 #999999;
            border-style:solid;
            border-width:2 2 2 2;
        }
    </style>
    <body text="#000000" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
                <td class="forumdunkel" width="100%" colspan="2"><img src="../bilder/empty.gif" border="0" width="25" height="20"></td>
                <td class="forumdunkel"><nobr>&nbsp;<?php echo $lang['kommunikationboard']['themen']; ?>&nbsp;</nobr></td>
                <td class="forumdunkel"><nobr>&nbsp;<?php echo $lang['kommunikationboard']['beitraege']; ?>&nbsp;</nobr></td>
                <td class="forumdunkel"><nobr>&nbsp;<?php echo $lang['kommunikationboard']['letzterbeitrag']; ?>&nbsp;</nobr></td>
            </tr>
            <tr>
                <td colspan="5" class="forumdunkel">
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td style="font-size:14px;"><b><?php echo $lang['kommunikationboard']['gotteswort']; ?></b></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="forummittel"><img src="../bilder/empty.gif" border="0" width="25" height="20"></td>
                <td class="forumhell" width="100%">
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td>
                                <a href="kommunikation_board.php?fu=2&fo=1&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" style="color:#ffffff;font-size:12px;text-decoration:underline;">
                                    <b><?php echo $lang['kommunikationboard']['offenbarungen']; ?></b>
                                </a>
                            </td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><?php echo $lang['kommunikationboard']['kommentiertoff']; ?></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                    </table>
                    <?php
                    $themaanzahl=0;
                    $zeiger = @mysql_query("SELECT count(*) as anzahl FROM $skrupel_forum_thema where forum=1");
                    $array = @mysql_fetch_array($zeiger);
                    $themaanzahl=$array["anzahl"];
                    $beitraganzahl=0;
                    $zeiger = @mysql_query("SELECT count(*) as anzahl FROM $skrupel_forum_beitrag where forum=1");
                    $array = @mysql_fetch_array($zeiger);
                    $beitraganzahl=$array["anzahl"];
                    $zeiger = @mysql_query("SELECT * FROM $skrupel_forum_beitrag where forum=1 order by datum desc limit 0,1");
                    $array = @mysql_fetch_array($zeiger);
                    $letzter=$array["datum"];
                    if ($letzter>=1) { $letzter=date('d.m.y G:i',$letzter); } else { $letzter=""; }
                    ?>
                </td>
                <td class="forummittel"><center><nobr>&nbsp;<?php echo $themaanzahl; ?>&nbsp;</nobr></center></td>
                <td class="forumhell"><center><nobr>&nbsp;<?php echo $beitraganzahl; ?>&nbsp;</nobr></center></td>
                <td class="forummittel"><nobr>&nbsp;<?php echo $letzter; ?>&nbsp;</nobr></td>
            </tr>
            <tr>
                <td colspan="5" class="forumdunkel">
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td style="font-size:14px;"><b><?php echo $lang['kommunikationboard']['hastduskrupel']; ?></b></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="forummittel"><img src="../bilder/empty.gif" border="0" width="25" height="20"></td>
                <td class="forumhell" width="100%">
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td>
                                <a href="kommunikation_board.php?fu=2&fo=2&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" style="color:#ffffff;font-size:12px;text-decoration:underline;">
                                    <b><?php echo $lang['kommunikationboard']['smalltalk']; ?></b>
                                </a>
                            </td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><?php echo $lang['kommunikationboard']['hallo']; ?></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                    </table>
                    <?php
                    $themaanzahl=0;
                    $zeiger = @mysql_query("SELECT count(*) as anzahl FROM $skrupel_forum_thema where forum=2");
                    $array = @mysql_fetch_array($zeiger);
                    $themaanzahl=$array["anzahl"];
                    $beitraganzahl=0;
                    $zeiger = @mysql_query("SELECT count(*) as anzahl FROM $skrupel_forum_beitrag where forum=2");
                    $array = @mysql_fetch_array($zeiger);
                    $beitraganzahl=$array["anzahl"];
                    $zeiger = @mysql_query("SELECT * FROM $skrupel_forum_beitrag where forum=2 order by datum desc limit 0,1");
                    $array = @mysql_fetch_array($zeiger);
                    $letzter=$array["datum"];
                    if ($letzter>=1) { $letzter=date('d.m.y G:i',$letzter); } else { $letzter=""; }
                    ?>
                </td>
                <td class="forummittel"><center><nobr>&nbsp;<?php echo $themaanzahl; ?>&nbsp;</nobr></center></td>
                <td class="forumhell"><center><nobr>&nbsp;<?php echo $beitraganzahl; ?>&nbsp;</nobr></center></td>
                <td class="forummittel"><nobr>&nbsp;<?php echo $letzter; ?>&nbsp;</nobr></td>
            </tr>
            <tr>
                <td class="forummittel"><img src="../bilder/empty.gif" border="0" width="25" height="20"></td>
                <td class="forumhell" width="100%">
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td>
                                <a href="kommunikation_board.php?fu=2&fo=3&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" style="color:#ffffff;font-size:12px;text-decoration:underline;">
                                    <b><?php echo $lang['kommunikationboard']['handel']; ?></b>
                                </a>
                            </td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><?php echo $lang['kommunikationboard']['handeltext']; ?></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                    </table>
                    <?php
                    $themaanzahl=0;
                    $zeiger = @mysql_query("SELECT count(*) as anzahl FROM $skrupel_forum_thema where forum=3");
                    $array = @mysql_fetch_array($zeiger);
                    $themaanzahl=$array["anzahl"];
                    $beitraganzahl=0;
                    $zeiger = @mysql_query("SELECT count(*) as anzahl FROM $skrupel_forum_beitrag where forum=3");
                    $array = @mysql_fetch_array($zeiger);
                    $beitraganzahl=$array["anzahl"];
                    $zeiger = @mysql_query("SELECT * FROM $skrupel_forum_beitrag where forum=3 order by datum desc limit 0,1");
                    $array = @mysql_fetch_array($zeiger);
                    $letzter=$array["datum"];
                    if ($letzter>=1) { $letzter=date('d.m.y G:i',$letzter); } else { $letzter=""; }
                    ?>
                </td>
                <td class="forummittel"><center><nobr>&nbsp;<?php echo $themaanzahl; ?>&nbsp;</nobr></center></td>
                <td class="forumhell"><center><nobr>&nbsp;<?php echo $beitraganzahl; ?>&nbsp;</nobr></center></td>
                <td class="forummittel"><nobr>&nbsp;<?php echo $letzter; ?>&nbsp;</nobr></td>
            </tr>
            <tr>
                <td class="forummittel"><img src="../bilder/empty.gif" border="0" width="25" height="20"></td>
                <td class="forumhell" width="100%">
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td>
                                <a href="kommunikation_board.php?fu=2&fo=4&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" style="color:#ffffff;font-size:12px;text-decoration:underline;">
                                    <b><?php echo $lang['kommunikationboard']['strategie']; ?></b>
                                </a>
                            </td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><?php echo $lang['kommunikationboard']['strategietext']; ?></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                    </table>
                    <?php
                    $themaanzahl=0;
                    $zeiger = @mysql_query("SELECT count(*) as anzahl FROM $skrupel_forum_thema where forum=4");
                    $array = @mysql_fetch_array($zeiger);
                    $themaanzahl=$array["anzahl"];
                    $beitraganzahl=0;
                    $zeiger = @mysql_query("SELECT count(*) as anzahl FROM $skrupel_forum_beitrag where forum=4");
                    $array = @mysql_fetch_array($zeiger);
                    $beitraganzahl=$array["anzahl"];
                    $zeiger = @mysql_query("SELECT * FROM $skrupel_forum_beitrag where forum=4 order by datum desc limit 0,1");
                    $array = @mysql_fetch_array($zeiger);
                    $letzter=$array["datum"];
                    if ($letzter>=1) { $letzter=date('d.m.y G:i',$letzter); } else { $letzter=""; }
                    ?>
                </td>
                <td class="forummittel"><center><nobr>&nbsp;<?php echo $themaanzahl; ?>&nbsp;</nobr></center></td>
                <td class="forumhell"><center><nobr>&nbsp;<?php echo $beitraganzahl; ?>&nbsp;</nobr></center></td>
                <td class="forummittel"><nobr>&nbsp;<?php echo $letzter; ?>&nbsp;</nobr></td>
            </tr>
            <tr>
                <td colspan="5" class="forumdunkel">
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td style="font-size:14px;"><b><?php echo $lang['kommunikationboard']['interfacebezogenes']; ?></b></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="forummittel"><img src="../bilder/empty.gif" border="0" width="25" height="20"></td>
                <td class="forumhell" width="100%">
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td>
                                <a href="kommunikation_board.php?fu=2&fo=5&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" style="color:#ffffff;font-size:12px;text-decoration:underline;">
                                    <b><?php echo $lang['kommunikationboard']['howtos']; ?></b>
                                </a>
                            </td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><?php echo $lang['kommunikationboard']['howtostext']; ?></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                    </table>
                    <?php
                    $themaanzahl=0;
                    $zeiger = @mysql_query("SELECT count(*) as anzahl FROM $skrupel_forum_thema where forum=5");
                    $array = @mysql_fetch_array($zeiger);
                    $themaanzahl=$array["anzahl"];
                    $beitraganzahl=0;
                    $zeiger = @mysql_query("SELECT count(*) as anzahl FROM $skrupel_forum_beitrag where forum=5");
                    $array = @mysql_fetch_array($zeiger);
                    $beitraganzahl=$array["anzahl"];
                    $zeiger = @mysql_query("SELECT * FROM $skrupel_forum_beitrag where forum=5 order by datum desc limit 0,1");
                    $array = @mysql_fetch_array($zeiger);
                    $letzter=$array["datum"];
                    if ($letzter>=1) { $letzter=date('d.m.y G:i',$letzter); } else { $letzter=""; }
                    ?>
                </td>
                <td class="forummittel"><center><nobr>&nbsp;<?php echo $themaanzahl; ?>&nbsp;</nobr></center></td>
                <td class="forumhell"><center><nobr>&nbsp;<?php echo $beitraganzahl; ?>&nbsp;</nobr></center></td>
                <td class="forummittel"><nobr>&nbsp;<?php echo $letzterv; ?>&nbsp;</nobr></td>
            </tr>
            <tr>
                <td class="forummittel"><img src="../bilder/empty.gif" border="0" width="25" height="20"></td>
                <td class="forumhell" width="100%">
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td>
                                <a href="kommunikation_board.php?fu=2&fo=6&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" style="color:#ffffff;font-size:12px;text-decoration:underline;">
                                    <b><?php echo $lang['kommunikationboard']['zahlentechnisches']; ?></b>
                                </a>
                            </td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><?php echo $lang['kommunikationboard']['zahlentext']; ?></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                    </table>
                    <?php
                    $themaanzahl=0;
                    $zeiger = @mysql_query("SELECT count(*) as anzahl FROM $skrupel_forum_thema where forum=6");
                    $array = @mysql_fetch_array($zeiger);
                    $themaanzahl=$array["anzahl"];
                    $beitraganzahl=0;
                    $zeiger = @mysql_query("SELECT count(*) as anzahl FROM $skrupel_forum_beitrag where forum=6");
                    $array = @mysql_fetch_array($zeiger);
                    $beitraganzahl=$array["anzahl"];
                    $zeiger = @mysql_query("SELECT * FROM $skrupel_forum_beitrag where forum=6 order by datum desc limit 0,1");
                    $array = @mysql_fetch_array($zeiger);
                    $letzter=$array["datum"];
                    if ($letzter>=1) { $letzter=date('d.m.y G:i',$letzter); } else { $letzter=""; }
                    ?>
                </td>
                <td class="forummittel"><center><nobr>&nbsp;<?php echo $themaanzahl; ?>&nbsp;</nobr></center></td>
                <td class="forumhell"><center><nobr>&nbsp;<?php echo $beitraganzahl; ?>&nbsp;</nobr></center></td>
                <td class="forummittel"><nobr>&nbsp;<?php echo $letzter; ?>&nbsp;</nobr></td>
            </tr>
        </table>
        </div>
        <?php
    include ("inc.footer.php");
}
if ($fuid==2) {
    include ("inc.header.php");
    $forum=int_get('fo');
    ?>
    <style type="text/css">
        td.forumdunkel {
            background-color:#404040;
            border-color:#595959 #272727 #272727 #595959;
            border-style:solid;
            border-width:2 2 2 2;
        }
        td.forummittel {
            background-color:#606060;
            border-color:#797979 #474747 #474747 #797979;
            border-style:solid;
            border-width:2 2 2 2;
        }
        td.forumhell {
            background-color:#808080;
            border-color:#999999 #676767 #676767 #999999;
            border-style:solid;
            border-width:2 2 2 2;
        }
    </style>
    <body text="#000000" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <script language=JavaScript>
            function checkeingabe(e) {
                if (document.formular.thema.value=="") { alert('<?php echo html_entity_decode($lang['kommunikationboard']['themaeingeben']); ?>'); return false;}
                if (document.formular.beitrag.value=="") { alert('<?php echo html_entity_decode($lang['kommunikationboard']['beitrageingeben']); ?>'); return false;}
                return true;
            }
        </script>
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
                <td class="forumdunkel" width="100%" colspan="5">
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td>
                                <a href="kommunikation_board.php?fu=1&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" style="color:#ffffff;font-size:10px;text-decoration:underline;">
                                    &lt&lt&lt <?php echo $lang['kommunikationboard']['uebersicht']; ?>
                                </a>
                            </td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="forumdunkel"><img src="../bilder/empty.gif" border="0" width="25" height="20"></td>
                <td class="forumdunkel" width="100%"><center><nobr>&nbsp;<?php echo $lang['kommunikationboard']['themen']; ?>&nbsp;</nobr></center></td>
                <td class="forumdunkel"><center><nobr>&nbsp;<?php echo $lang['kommunikationboard']['begonnenvon']; ?>&nbsp;</nobr></center></td>
                <td class="forumdunkel"><center><nobr>&nbsp;<?php echo $lang['kommunikationboard']['antworten']; ?>&nbsp;</nobr></center></td>
                <td class="forumdunkel"><center><nobr>&nbsp;<?php echo $lang['kommunikationboard']['letzterbeitrag']; ?>&nbsp;</nobr></center></td>
            </tr>
            <?php
            $zeiger = @mysql_query("SELECT * FROM $skrupel_forum_thema where forum=$forum order by letzter desc limit 0,20");
            $themaanzahl = @mysql_num_rows($zeiger);
            if ($themaanzahl>=1) {
                for ($i=0; $i<$themaanzahl;$i++) {
                    $ok = @mysql_data_seek($zeiger,$i);
                    $array = @mysql_fetch_array($zeiger);
                    $id=$array["id"];
                    $icon=$array["icon"];
                    $thema=$array["thema"];
                    $beginner=$array["beginner"];
                    $antworten=$array["antworten"];
                    $letzter=$array["letzter"];
                    $letzter=date('d.m.y G:i',$letzter);
                    ?>
                    <tr>
                        <td class="forummittel"><center><img src="../bilder/forum_icons/<?php echo $icon; ?>.gif" border="0" width="15" height="15"></center></td>
                        <td class="forumhell" width="100%">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><a href="kommunikation_board.php?fu=3&fo=<?php echo $forum; ?>&thema=<?php echo $id; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" style="color:#ffffff;font-size:10px;text-decoration:underline;"><?php echo $thema; ?></a></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                            </table>
                        </td>
                        <td class="forummittel">
                            <center>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                        <td><nobr><?php echo $beginner; ?></nobr></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                        <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    </tr>
                                </table>
                            </center>
                        </td>
                        <td class="forumhell"><center><nobr>&nbsp;<?php echo $antworten; ?>&nbsp;</nobr></center></td>
                        <td class="forummittel">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><nobr><?php echo $letzter; ?></nobr></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td class="forummittel" colspan="5">
                        <center>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><?php echo $lang['kommunikationboard']['keinebeitraegevorhanden']; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                            </table>
                        </center>
                    </td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td class="forumdunkel" colspan="5"><img src="../bilder/empty.gif" border="0" width="25" height="20"></td>
            </tr>
            <?php
            if ($forum>1) {
                ?>
                <tr>
                    <td class="forumdunkel"><img src="../bilder/empty.gif" border="0" width="25" height="20"></td>
                    <td class="forummittel" colspan="4">
                        <center>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><form name="formular" method="post" action="kommunikation_board.php?fu=4&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&forum=<?php echo $forum; ?>" onSubmit="return checkeingabe();"></td>
                                    <td><center><?php echo $lang['kommunikationboard']['neuesthema']?></center></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td align="right"><nobr><?php echo $lang['kommunikationboard']['thema']; ?>&nbsp;&nbsp;</nobr></td>
                                    <td><input type="text" name="thema" class="eingabe" maxlength="100" style="width:220px;" autocomplete="off"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                <td align="right"><nobr><?php echo $lang['kommunikationboard']['icon']; ?>&nbsp;&nbsp;</nobr></td>
                                    <td><table border="0" cellspacing="0" cellpadding="0"><tr>
                                    <td><input type="radio" name="icon" value="1" style="background-color:#606060;border-color:#606060;"; checked></td>
                                    <td><img src="<?php echo $bildpfad; ?>/forum_icons/1.gif" border="0" width="15" height="15"></td>
                                    <td><input type="radio" name="icon" value="2" style="background-color:#606060;border-color:#606060;";></td>
                                    <td><img src="<?php echo $bildpfad; ?>/forum_icons/2.gif" border="0" width="15" height="15"></td>
                                    <td><input type="radio" name="icon" value="3" style="background-color:#606060;border-color:#606060;";></td>
                                    <td><img src="<?php echo $bildpfad; ?>/forum_icons/3.gif" border="0" width="15" height="15"></td>
                                    <td><input type="radio" name="icon" value="4" style="background-color:#606060;border-color:#606060;";></td>
                                    <td><img src="<?php echo $bildpfad; ?>/forum_icons/4.gif" border="0" width="15" height="15"></td>
                                    <td><input type="radio" name="icon" value="5" style="background-color:#606060;border-color:#606060;";></td>
                                    <td><img src="<?php echo $bildpfad; ?>/forum_icons/5.gif" border="0" width="15" height="15"></td>
                                    <td><input type="radio" name="icon" value="6" style="background-color:#606060;border-color:#606060;";></td>
                                    <td><img src="<?php echo $bildpfad; ?>/forum_icons/6.gif" border="0" width="15" height="15"></td>
                                    </tr></table></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td align="right"><nobr><?php echo $lang['kommunikationboard']['beitrag']; ?>&nbsp;&nbsp;</nobr></td>
                                    <td><textarea name="beitrag" wrap="soft" style="width:220px;height:100px;"></textarea></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td></td>
                                    <td><input type="submit" name="submit" value="<?php echo $lang['kommunikationboard']['abschicken']; ?>" style="width:220px;"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td></form></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                            </table>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td class="forumdunkel" colspan="5"><img src="../bilder/empty.gif" border="0" width="25" height="20"></td>
                </tr>
                <?php
            }
            ?>
        </table>
        </div>
        <?php
    include ("inc.footer.php");
}
if ($fuid==4) {    
		
    $forum=int_get('forum');
    $icon=int_post('icon');
    include ("inc.check.php");
    $beginner=$spieler_name;
    $letzter=time();
    $thema=str_post('thema','SQLSAFE');
    $beitrag=str_post('beitrag','SQLSAFE');
    //$beitrag=nl2br(stripslashes($beitrag));
    //$beitrag=str_replace("'", "",$beitrag);
    //$beitrag=str_replace("\"", "",$beitrag);
    //$beitrag=str_replace("\\", "",$beitrag);
    //$thema=nl2br(stripslashes($thema));
    //$thema=str_replace("'", "",$thema);
    //$thema=str_replace("\"", "",$thema);
    //$thema=str_replace("\\", "",$thema);
    $zeiger = @mysql_query("INSERT INTO $skrupel_forum_thema (forum,icon,thema,beginner,antworten,letzter) values ($forum,$icon,'$thema','$beginner',0,'$letzter');");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_forum_thema where forum=$forum and icon=$icon and beginner='$beginner' and thema='$thema' and letzter='$letzter' and antworten=0;");
    $array = @mysql_fetch_array($zeiger);
    $idthema=$array["id"];
    $zeiger = mysql_query("INSERT INTO $skrupel_forum_beitrag (thema,forum,datum,beitrag,verfasser,spielerid) values ($idthema,$forum,'$letzter','$beitrag','$beginner',$spieler);");
    
    $backlink="kommunikation_board.php?fu=2&uid=$uid&sid=$sid&fo=$forum";
    header ("Location: $backlink");
}
if ($fuid==3) {
    include ("inc.header.php");
    $forum=int_get('fo');
    $thema=int_get('thema');
    if ($forum==1) { $formname=$lang['kommunikationboard']['offenbarungen'];}
    if ($forum==2) { $formname=$lang['kommunikationboard']['smalltalk'];}
    if ($forum==3) { $formname=$lang['kommunikationboard']['handel'];}
    if ($forum==4) { $formname=$lang['kommunikationboard']['strategie'];}
    if ($forum==5) { $formname=$lang['kommunikationboard']['howtos'];}
    if ($forum==6) { $formname=$lang['kommunikationboard']['zahlentechnisches'];}
    ?>
    <style type="text/css">
        td.forumdunkel {
            background-color:#404040;
            border-color:#595959 #272727 #272727 #595959;
            border-style:solid;
            border-width:2 2 2 2;
        }
        td.forummittel {
            background-color:#606060;
            border-color:#797979 #474747 #474747 #797979;
            border-style:solid;
            border-width:2 2 2 2;
        }
        td.forumhell {
            background-color:#808080;
            border-color:#999999 #676767 #676767 #999999;
            border-style:solid;
            border-width:2 2 2 2;
        }
    </style>
    <body text="#000000" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <script language=JavaScript>
            function checkeingabe(e) {
                if (document.formular.beitrag.value=="") { alert('<?php echo html_entity_decode($lang['kommunikationboard']['beitrageingeben']); ?>'); return false;}
                return true;
            }
        </script>
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
                <td class="forumdunkel" width="100%" colspan="2">
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td>
                                <a href="kommunikation_board.php?fu=1&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" style="color:#ffffff;font-size:10px;text-decoration:underline;">
                                    &lt&lt&lt <?php echo $lang['kommunikationboard']['uebersicht']?></a>
                                <a href="kommunikation_board.php?fu=2&fo=<?php echo $forum; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" style="color:#ffffff;font-size:10px;text-decoration:underline;">
                                    &lt&lt&lt <?php echo $formname; ?>
                                </a>
                            </td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="forumdunkel">
                    <center>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="1" height="20"></td>
                                <td><nobr>&nbsp;<?php echo $lang['kommunikationboard']['verfasser']?>&nbsp;</nobr></td>
                                <td><img src="../bilder/empty.gif" border="0" width="1" height="20"></td>
                            </tr>
                        </table>
                    </center>
                </td>
                <td class="forumdunkel" width="100%">
                    <center><nobr>&nbsp;<?php echo $lang['kommunikationboard']['beitrag']; ?>&nbsp;</nobr></center>
                </td>
            </tr>
            <?php
            $klasse="forumhell";
            $zeiger = @mysql_query("SELECT * FROM $skrupel_forum_beitrag where thema=$thema order by datum");
            $beitraganzahl = @mysql_num_rows($zeiger);
            if ($beitraganzahl>=1) {
                for ($i=0; $i<$beitraganzahl;$i++) {
                    $ok = @mysql_data_seek($zeiger,$i);
                    $array = @mysql_fetch_array($zeiger);
                    $id=$array["id"];
                    $beitrag=$array["beitrag"];
                    $verfasser=$array["verfasser"];
                    $spielerid=$array["spielerid"];
                    $datum=$array["datum"];
                    $datum=date('d.m.y G:i',$datum);
                    if ($klasse=='forumhell') { $klasse="forummittel"; } else { $klasse="forumhell"; }
                    ?>
                    <tr>
                        <td class="<?php echo $klasse; ?>" valign="top">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td style="color:<?php echo $spielerfarbe[$spielerid]; ?>;"><?php echo $verfasser; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><nobr><?php echo $datum; ?></nobr></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                            </table>
                        </td>
                        <td class="<?php echo $klasse; ?>" width="100%" valign="top">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><?php echo $beitrag; ?></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
            <tr>
                <td class="forumdunkel" colspan="5"><img src="../bilder/empty.gif" border="0" width="25" height="20"></td>
            </tr>
            <tr>
                <td class="forumdunkel"><img src="../bilder/empty.gif" border="0" width="25" height="20"></td>
                <td class="forummittel" colspan="4">
                    <center>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                <td><form name="formular" method="post" action="kommunikation_board.php?fu=5&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&forum=<?php echo $forum; ?>&thema=<?php echo $thema; ?>" onSubmit="return checkeingabe();"></td>
                                <td><center><?php echo $lang['kommunikationboard']['antworten']; ?></center></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            </tr>
                                <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                <td align="right"><nobr><?php echo $lang['kommunikationboard']['beitrag']; ?>&nbsp;&nbsp;</nobr></td>
                                <td><textarea name="beitrag" wrap="soft" style="width:220px;height:100px;"></textarea></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                <td></td>
                                <td><input type="submit" name="submit" value="<?php echo $lang['kommunikationboard']['abschicken']; ?>" style="width:220px;"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                <td></form></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
            <tr>
                <td class="forumdunkel" colspan="5"><img src="../bilder/empty.gif" border="0" width="25" height="20"></td>
            </tr>
        </table>
        </div>
        <?php
    include ("inc.footer.php");
}
if ($fuid==5) {
    
	;
	
    $forum=int_get('forum');
    $thema=int_get('thema');
    $icon=int_post('icon');
    include ("inc.check.php");
    $beginner=$spieler_name;
    $letzter=time();
    $beitrag=str_post('beitrag','SQLSAFE');
    //$beitrag=nl2br(stripslashes($beitrag));
    //$beitrag=str_replace("'", "",$beitrag);
    //$beitrag=str_replace("\"", "",$beitrag);
    //$beitrag=str_replace("\\", "",$beitrag);
    $zeiger = mysql_query("INSERT INTO $skrupel_forum_beitrag (thema,forum,datum,beitrag,verfasser,spielerid) values ($thema,$forum,'$letzter','$beitrag','$beginner',$spieler);");
    $zeiger = mysql_query("UPDATE $skrupel_forum_thema set antworten=antworten+1,letzter='$letzter' where id=$thema;");
    
    $backlink="kommunikation_board.php?fu=3&uid=$uid&sid=$sid&fo=$forum&thema=$thema";
    header ("Location: $backlink");
}
