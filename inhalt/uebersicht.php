<?php
require_once ('../inc.conf.php'); 
require_once ('inc.hilfsfunktionen.php');
 
$langfile_1 = 'uebersicht';
$fuid = int_get('fu');

if ($fuid==1) {
    include ("inc.header.php");
    ?>
    <body text="#000000" bgcolor="#444444" style="background-image:url('<?php echo $bildpfad?>/aufbau/14.gif'); background-attachment:fixed;" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" height="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td><center><a href="uebersicht_uebersicht.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>" target="rahmen12" onclick="self.focus();"><img src="<?php echo $bildpfad?>/menu/uebersicht.gif" width="75" height="75" border="0"><br><nobr><?php echo $lang['uebersicht']['uebersicht']?></nobr></a></center></td>
                    <td><center><a href="uebersicht_imperien.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>" target="rahmen12" onclick="self.focus();"><img src="<?php echo $bildpfad?>/menu/imperien.gif" width="75" height="75" border="0"><br><nobr><?php echo $lang['uebersicht']['imperien']?></nobr></a></center></td>
                    <?php if ($spieler_raus==0) { ?>
                        <td><center><a href="uebersicht_neuigkeiten.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>" target="rahmen12" onclick="self.focus();"><img src="<?php echo $bildpfad?>/menu/neuigkeiten.gif" width="75" height="75" border="0"><br><nobr><?php echo $lang['uebersicht']['neuigkeiten']?></nobr></a></center></td>
                        <td><center><a href="uebersicht_kolonien.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>" target="rahmen12" onclick="self.focus();"><img src="<?php echo $bildpfad?>/menu/planeten.gif" width="75" height="75" border="0"><br><nobr><?php echo $lang['uebersicht']['kolonien']?></nobr></a></center></td>
                    <?php }
                    /* 
                    <td><center><a href="uebersicht_konplaene.php?fu=1&uid=<?=$uid?>&sid=<?=$sid?>" target="rahmen12" onclick="self.focus();"><img src="<?=$bildpfad?>/empty.gif" width="75" height="75" border="0"><br><nobr>KonPl&auml;ne</nobr></a></center></td>
                    <td><center><a href="neuigkeiten.php?fu=3&art=2&uid=<?=$uid?>&sid=<?=$sid?>" target="rahmen12" onclick="self.focus();"><img src="<?=$bildpfad?>/menu/flotte.gif" width="75" height="75" border="0"><br><nobr>Raumflotte</nobr></a></center></td>
                    <td><center><a href="neuigkeiten.php?fu=3&art=3&uid=<?=$uid?>&sid=<?=$sid?>" target="rahmen12" onclick="self.focus();"><img src="<?=$bildpfad?>/menu/basen.gif" width="75" height="75" border="0"><br><nobr>Sternenbasen</nobr></a></center></td>
                    */ ?>
                </tr>
            </table>
        </center>
        <?php
    include ("inc.footer.php");
}
