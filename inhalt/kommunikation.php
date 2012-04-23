<?php
/*
:noTabs=false:indentSize=4:tabSize=4:folding=explicit:collapseFolds=1:
*/
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'kommunikation';
$fuid = int_get('fu');

if ($fuid==1) {
    include ('inc.header.php');
    ?>
    <script language=javascript>
        function link(url) {
            if (parent.mittelinksoben.document.globals.map.value==1) {
                parent.mittelinksoben.document.globals.map.value=0;
                parent.mittemitte.window.location='aufbau.php?fu=100&query='+url;
            } else {
                parent.mittemitte.rahmen12.window.location=url;
            }
        }
        function chat() {
            oben=100;
            links=screen.width-450;
            window.open('kommunikation_exch.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>','SKRUPELChat','resizable=yes,scrollbars=no,width=350,height=300,top='+oben+',left='+links);
        }
    </script>
    <body text="#000000" bgcolor="#444444" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" height="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <?php
                    if ($spieleranzahl>=2 and $spieler_raus==0) {
                        ?>
                        <td>
                            <center>
                                <a href="Javascript:;" onclick="link('kommunikation_politik.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>');">
                                    <img src="<?php echo $bildpfad?>/menu/politik.gif" width="75" height="75" border="0">
                                    <br>
                                    <nobr><?php echo $lang['kommunikation']['politik']?></nobr>
                                </a>
                            </center>
                        </td>
                        <td>
                            <center>
                                <a href="Javascript:;" onclick="link('kommunikation_subfunk.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>');">
                                    <img src="<?php echo $bildpfad?>/menu/subfunk.gif" width="75" height="75" border="0">
                                    <br>
                                    <nobr><?php echo $lang['kommunikation']['subfunk']?></nobr>
                                </a>
                            </center>
                        </td>
                        <?php
                    }
                    if ($spiel_forum==0) {
                        ?>
                        <td>
                            <center>
                                <a href="Javascript:;" onclick="link('kommunikation_board.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>');">
                                    <img src="<?php echo $bildpfad?>/menu/forum.gif" width="75" height="75" border="0">
                                    <br>
                                    <nobr><?php echo $lang['kommunikation']['board']?></nobr>
                                </a>
                            </center>
                        </td>
                        <?php
                    } elseif ($spiel_forum==2) {
                        ?>
                        <td>
                            <center>
                                <a href="<?php echo $spiel_forum_url?>" target="_blank">
                                    <img src="<?php echo $bildpfad?>/menu/forum.gif" width="75" height="75" border="0">
                                    <br>
                                    <nobr><?php echo $lang['kommunikation']['board']?></nobr>
                                </a>
                            </center>
                        </td>
                        <?php
                    }
                    if ($spiel_chat==0) {
                        ?>
                        <td>
                            <center>
                                <a href="kommunikation_ch.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>" target="_self" onclick="link('kommunikation_ch.php?fu=3&uid=<?php echo $uid?>&sid=<?php echo $sid?>');">
                                    <img src="<?php echo $bildpfad?>/menu/chat.gif" width="75" height="75" border="0">
                                    <br>
                                    <nobr><?php echo $lang['kommunikation']['chat']?></nobr>
                                </a>
                            </center>
                        </td>
                        <td>
                            <center>
                                <a href="Javascript:;" onclick="chat();">
                                    <img src="<?php echo $bildpfad?>/menu/exchat.gif" width="75" height="75" border="0">
                                    <br>
                                    <nobr><?php echo $lang['kommunikation']['exchat']?></nobr>
                                </a>
                            </center>
                        </td>
                        <?php
                    }
                    ?>
                </tr>
            </table>
        </center>
        <?php
include ('inc.footer.php');
}
