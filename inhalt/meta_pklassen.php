<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'meta_pklassen';
$fuid = int_get('fu');

if ($fuid==1) {
    include ("inc.header.php");
    ?>
    <body text="#000000" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
        <center><img src="../lang/<?php echo $spieler_sprache?>/topics/planetenklassen.gif" border="0" width="290" height="52"></center>
        <center>
            <table border="0" cellspacing="0" cellpadding="4">
                <tr>
                    <td colspan="2"><?php echo str_replace('{1}','C',$lang['metapklassen']['klasse'])?></td>
                    <td colspan="2"><?php echo str_replace('{1}','F',$lang['metapklassen']['klasse'])?></td>
                </tr>
                <tr>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="100" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#000000"><img src="<?php echo $bildpfad?>/planeten/7_2.jpg" border="0" width="113" height="97"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="100" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="2">
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['oberflaeche']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo $lang['metapklassen']['eisensilikat']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['atmosphaere']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo $lang['metapklassen']['einfachundurchdringlich']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['temperatur']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo str_replace(array('{1}','{2}'),array('40','55'),$lang['metapklassen']['grad'])?></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="100" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#000000"><img src="<?php echo $bildpfad?>/planeten/9_1.jpg" border="0" width="113" height="97"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="100" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="2">
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['oberflaeche']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo $lang['metapklassen']['silikatmetalle']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['atmosphaere']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo $lang['metapklassen']['sauerstoffreich']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['temperatur']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo str_replace(array('{1}','{2}'),array('-10','10'),$lang['metapklassen']['grad'])?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><?php echo str_replace('{1}','G',$lang['metapklassen']['klasse'])?></td>
                    <td colspan="2"><?php echo str_replace('{1}','I',$lang['metapklassen']['klasse'])?></td>
                </tr>
                <tr>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="100" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#000000"><img src="<?php echo $bildpfad?>/planeten/5_6.jpg" border="0" width="113" height="97"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="100" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="2">
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['oberflaeche']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo $lang['metapklassen']['wuestenplanet']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['atmosphaere']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo $lang['metapklassen']['sauerstoffhaltig']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['temperatur']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo str_replace(array('{1}','{2}'),array('51','65'),$lang['metapklassen']['grad'])?></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="100" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#000000"><img src="<?php echo $bildpfad?>/planeten/6_8.jpg" border="0" width="113" height="97"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="100" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="2">
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['oberflaeche']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo $lang['metapklassen']['silikatmetallefluessig']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['atmosphaere']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo $lang['metapklassen']['edelgashaltig']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['temperatur']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo str_replace(array('{1}','{2}'),array('35','60'),$lang['metapklassen']['grad'])?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><?php echo str_replace('{1}','J',$lang['metapklassen']['klasse'])?></td>
                    <td colspan="2"><?php echo str_replace('{1}','K',$lang['metapklassen']['klasse'])?></td>
                </tr>
                <tr>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="100" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#000000"><img src="<?php echo $bildpfad?>/planeten/3_5.jpg" border="0" width="113" height="97"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="100" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="2">
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['oberflaeche']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo $lang['metapklassen']['silikat']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['atmosphaere']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo $lang['metapklassen']['spaerlichedelgashaltig']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['temperatur']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo str_replace(array('{1}','{2}'),array('-35','-25'),$lang['metapklassen']['grad'])?></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="100" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#000000"><img src="<?php echo $bildpfad?>/planeten/8_7.jpg" border="0" width="113" height="97"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="100" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="2">
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['oberflaeche']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo $lang['metapklassen']['silikatwenigbiskeinwasser']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['atmosphaere']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo $lang['metapklassen']['spaerlich']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['temperatur']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo str_replace(array('{1}','{2}'),array('-15','0'),$lang['metapklassen']['grad'])?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><?php echo str_replace('{1}','L',$lang['metapklassen']['klasse'])?></td>
                    <td colspan="2"><?php echo str_replace('{1}','M',$lang['metapklassen']['klasse'])?></td>
                </tr>
                <tr>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="100" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#000000"><img src="<?php echo $bildpfad?>/planeten/4_1.jpg" border="0" width="113" height="97"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="100" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="2">
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['oberflaeche']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo $lang['metapklassen']['silikatteilweisewasserbedeckt']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['atmosphaere']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo $lang['metapklassen']['stickstoffsauerstoffargon']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['temperatur']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo str_replace(array('{1}','{2}'),array('15','40'),$lang['metapklassen']['grad'])?></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="100" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#000000"><img src="<?php echo $bildpfad?>/planeten/1_4.jpg" border="0" width="113" height="97"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="100" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="2">
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['oberflaeche']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo $lang['metapklassen']['silikatteilweisewasserbedeckt']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['atmosphaere']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo $lang['metapklassen']['stickstoffsauerstoff']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['temperatur']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo str_replace(array('{1}','{2}'),array('5','25'),$lang['metapklassen']['grad'])?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><?php echo str_replace('{1}','N',$lang['metapklassen']['klasse'])?></td>
                    <td colspan="2"><?php echo str_replace('{1}','X',$lang['metapklassen']['klasse'])?></td>
                </tr>
                <tr>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="100" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#000000"><img src="<?php echo $bildpfad?>/planeten/2_4.jpg" border="0" width="113" height="97"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="100" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="2">
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['oberflaeche']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo $lang['metapklassen']['vollstaendigwasserbedeckt']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['atmosphaere']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo $lang['metapklassen']['stickstoffsauerstoff']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['temperatur']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo str_replace(array('{1}','{2}'),array('-5','15'),$lang['metapklassen']['grad'])?></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="100" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#000000"><img src="<?php echo $bildpfad?>/planeten/10_3.jpg" border="0" width="113" height="97"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="100" height="1"></td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="2">
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['oberflaeche']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo $lang['metapklassen']['unbekannt']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['atmosphaere']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo $lang['metapklassen']['unbekannt']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['metapklassen']['temperatur']?></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                                <td><?php echo $lang['metapklassen']['unbekannt']?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </center>
        </div>
        <?php
    include ("inc.footer.php");
}
