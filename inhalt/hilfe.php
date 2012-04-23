<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'hilfe';
$fuid = int_get('fu');

if ($fuid>=1) {
    include ("inc.header.php");
    
    function tlquad($tl){
        return $tl*$tl*100;
    }
    
    ?>
    <body text="#000000" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <script language=JavaScript>parent.document.title='<?php echo $lang['hilfe']['ueberschrift'][$fuid]?>';</script>
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
                </tr>
                <tr>
                    <td style="font-size:12px;"><b><?php echo $lang['hilfe']['ueberschrift'][$fuid]?></b></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="7"></td>
                </tr>
            </table>
        </center>
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td style="color:#aaaaaa;">
                    <?php 
                    echo $lang['hilfe']['text'][$fuid];


                    //////////////////////////////////////////////////////////////////////////
            
                    if ($fuid==1) {
                        echo $lang['hilfe'][$von]['ueberschrift']
                        ?>
                        <table border="0" cellspacing="0" cellpadding="2" width="100%">
                            <?php
                            $cantox = array(100,200,300,800,1000,1200,2500,5000,7500,10000);
                            for($i=1;$i<6;$i++){
                                ?>
                                <tr>
                                    <td><?php echo str_replace('{1}',$i, $lang['hilfe']['stufe']);?></td>
                                    <td style="color:#aaaaaa;"><?php echo str_replace('{1}',$cantox[$i-1], $lang['hilfe']['cx'])?></td>
                                    <td><?php echo str_replace('{1}',$i+5, $lang['hilfe']['stufe'])?></td>
                                    <td style="color:#aaaaaa;"><?php echo str_replace('{1}',$cantox[$i+4], $lang['hilfe']['cx'])?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <?php
                    } elseif ($fuid==2) { 
                        ?>
                        <table border="0" cellspacing="0" cellpadding="2" width="100%">
                            <?php
                            $cantox = array(100,200,300,400,500,600,700,4000,7000,10000);
                            for($i=1;$i<6;$i++){
                                ?>
                                <tr>
                                    <td><?php echo str_replace('{1}',$i, $lang['hilfe']['stufe']);?></td>
                                    <td style="color:#aaaaaa;"><?php echo str_replace('{1}',$cantox[$i-1], $lang['hilfe']['cx'])?></td>
                                    <td><?php echo str_replace('{1}',$i+5, $lang['hilfe']['stufe'])?></td>
                                    <td style="color:#aaaaaa;"><?php echo str_replace('{1}',$cantox[$i+4], $lang['hilfe']['cx'])?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <?php
                    }elseif ($fuid==3) {
                        ?>
                        <table border="0" cellspacing="0" cellpadding="2" width="100%">
                            <?php
                            for($i=1;$i<6;$i++){
                                ?>
                                <tr>
                                    <td><?php echo str_replace('{1}',$i, $lang['hilfe']['stufe']);?></td>
                                    <td style="color:#aaaaaa;"><?php echo str_replace('{1}',tlquad($i), $lang['hilfe']['cx'])?></td>
                                    <td><?php echo str_replace('{1}',$i+5, $lang['hilfe']['stufe'])?></td>
                                    <td style="color:#aaaaaa;"><?php echo str_replace('{1}',tlquad($i+5), $lang['hilfe']['cx'])?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <?php
                    }elseif ($fuid==4) {
                        ?>
                        <table border="0" cellspacing="0" cellpadding="2" width="100%">
                            <?php
                            for($i=1;$i<6;$i++){
                                ?>
                                <tr>
                                    <td><?php echo str_replace('{1}',$i, $lang['hilfe']['stufe']);?></td>
                                    <td style="color:#aaaaaa;"><?php echo str_replace('{1}',tlquad($i), $lang['hilfe']['cx'])?></td>
                                    <td><?php echo str_replace('{1}',$i+5, $lang['hilfe']['stufe'])?></td>
                                    <td style="color:#aaaaaa;"><?php echo str_replace('{1}',tlquad($i+5), $lang['hilfe']['cx'])?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <?php
                    }elseif ($fuid==5) {
                        ?>
                        <center>
                            <table border="0" cellspacing="0" cellpadding="2">
                                <tr>
                                    <td><?php echo $lang['hilfe'][5][0]?></td>
                                </tr>
                            </table>
                            <table border="0" cellspacing="0" cellpadding="2">
                                <tr>
                                    <td><img src="<?php echo $bildpfad; ?>/icons/cantox.gif" border="0" width="17" height="17"></td>
                                    <td>10</td>
                                </tr>
                                <tr>
                                    <td><img src="<?php echo $bildpfad; ?>/icons/vorrat.gif" border="0" width="17" height="17"></td>
                                    <td>1</td>
                                </tr>
                            </table>
                        </center>
                        <?php echo $lang['hilfe'][5][1];
                    }elseif ($fuid==6) {
                        ?>
                        <center>
                            <table border="0" cellspacing="0" cellpadding="2">
                                <tr>
                                    <td><?php echo $lang['hilfe'][6][0]?></td>
                                </tr>
                            </table>
                            <table border="0" cellspacing="0" cellpadding="2">
                                <tr>
                                    <td><img src="<?php echo $bildpfad; ?>/icons/cantox.gif" border="0" width="17" height="17"></td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td><img src="<?php echo $bildpfad; ?>/icons/vorrat.gif" border="0" width="17" height="17"></td>
                                    <td>1</td>
                                </tr>
                            </table>
                        </center>
                        <?php echo $lang['hilfe'][6][1];
                    //}elseif ($fuid==7) { da unnoetig, nur kopf
                    }elseif ($fuid==8) {
                        ?>
                        <center>
                            <table border="0" cellspacing="0" cellpadding="2">
                                <tr>
                                    <td><?php echo $lang['hilfe'][8][0]?></td>
                                    <td style="color:#aaaaaa;"><?php echo str_replace('{1}',1,$lang['hilfe'][8][5])?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $lang['hilfe'][8][1]?></td>
                                    <td style="color:#aaaaaa;"><?php echo str_replace('{1}',2,$lang['hilfe'][8][6])?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $lang['hilfe'][8][2]?></td>
                                    <td style="color:#aaaaaa;"><?php echo str_replace('{1}',4,$lang['hilfe'][8][6])?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $lang['hilfe'][8][3]?></td>
                                    <td style="color:#aaaaaa;"><?php echo str_replace('{1}',6,$lang['hilfe'][8][6])?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $lang['hilfe'][8][4]?></td>
                                    <td style="color:#aaaaaa;"><?php echo str_replace('{1}',10,$lang['hilfe'][8][6])?></td>
                                </tr>
                            </table>
                        </center>
                        <?php echo $lang['hilfe'][8][7];?>
                        <center>
                            <table border="0" cellspacing="0" cellpadding="2">
                                <tr>
                                    <td><?php echo $lang['hilfe'][8][8];?></td>
                                </tr>
                            </table>
                            <table border="0" cellspacing="0" cellpadding="2">
                                <tr>
                                    <td><img src="../bilder/icons/cantox.gif" border="0" width="17" height="17"></td>
                                    <td>4</td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/icons/vorrat.gif" border="0" width="17" height="17"></td>
                                    <td>1</td>
                                </tr>
                            </table>
                        </center>
                        <?php 
                        echo $lang['hilfe'][8][9];
                    //}elseif ($fuid==9) { da unnoetig, nur kopf
                    }elseif ($fuid==10) {
                        ?>
                        <center>
                            <table border="0" cellspacing="0" cellpadding="2">
                                <tr>
                                    <td><?php echo $lang['hilfe'][10][0];?></td>
                                </tr>
                            </table>
                            <table border="0" cellspacing="0" cellpadding="2">
                                <tr>
                                    <td><img src="<?php echo $bildpfad; ?>/icons/cantox.gif" border="0" width="17" height="17"></td>
                                    <td>10</td>
                                </tr>
                                <tr>
                                    <td><img src="<?php echo $bildpfad; ?>/icons/mineral_2.gif" border="0" width="17" height="17"></td>
                                    <td>1</td>
                                </tr>
                            </table>
                        </center>
                        <?php
                    //}elseif ($fuid==11) { da unnoetig, nur kopf
                    }elseif ($fuid==12) {
                        ?>
                        <center>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><b><?php echo $lang['hilfe'][12][0];?></b></td>
                                </tr>
                            </table>
                        </center>
                        <center>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="color:#aaaaaa;"><b><?php echo $lang['hilfe'][12][7];?></b></td>
                                    <td>&nbsp;</td>
                                    <td style="color:#aaaaaa;"><b><?php echo $lang['hilfe'][12][8];?></b></td>
                                </tr>
                            </table>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="color:#aaaaaa;"><b><?php echo $lang['hilfe'][12][2];?></b></td>
                                    <td>&nbsp;&nbsp;</td>
                                    <td style="color:#aaaaaa;"><b><?php echo $lang['hilfe'][12][3];?>&nbsp;</b></td>
                                    <td></td>
                                    <td style="color:#aaaaaa;"><b>&nbsp;<?php echo $lang['hilfe'][12][2];?></b></td>
                                    <td>&nbsp;&nbsp;</td>
                                    <td style="color:#aaaaaa;"><b><?php echo $lang['hilfe'][12][3];?></b></td>
                                </tr>
                                <?php
                                $schaden=array(array(3,1,2,1),array(7,2,4,3),array(10,2,5,3),array(15,4,8,5),array(12,16,6,20),array(29,7,15,9),array(35,8,18,10),array(37,9,19,11),array(18,33,9,41),array(45,11,23,14));                                
                                for($i=0;$i<10;$i++){
                                    ?>
                                    <tr>
                                        <td><center><?php echo $schaden[$i][0];?></center></td>
                                        <td></td>
                                        <td><center><?php echo $schaden[$i][1];?></center></td>
                                        <td style="color:#aaaaaa;"><center><?php echo $lang['hilfe'][12][5][$i];?></center></td>
                                        <td><center><?php echo $schaden[$i][2];?></center></td>
                                        <td></td>
                                        <td><center><?php echo $schaden[$i][3];?></center></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </center>
                        <center><?php echo $lang['hilfe'][12][4];?></center>
                        <center>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><b><?php echo $lang['hilfe'][12][1];?></b></td>
                                </tr>
                            </table>
                        </center>
                        <center>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="color:#aaaaaa;"><b><?php echo $lang['hilfe'][12][7];?></b></td>
                                    <td>&nbsp;</td>
                                    <td style="color:#aaaaaa;"><b><?php echo $lang['hilfe'][12][8];?></b></td>
                                </tr>
                            </table>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="color:#aaaaaa;"><b><?php echo $lang['hilfe'][12][2];?></b></td>
                                    <td>&nbsp;&nbsp;</td>
                                    <td style="color:#aaaaaa;"><b><?php echo $lang['hilfe'][12][3];?>&nbsp;</b></td>
                                    <td></td>
                                    <td style="color:#aaaaaa;"><b>&nbsp;<?php echo $lang['hilfe'][12][2];?></b></td>
                                    <td>&nbsp;&nbsp;</td>
                                    <td style="color:#aaaaaa;"><b><?php echo $lang['hilfe'][12][3];?></b></td>
                                </tr>
                                <?php
                                $schaden=array(array(5,1,3,1),array(8,2,4,3),array(10,2,5,3),array(6,13,3,16),array(15,6,8,8),array(30,7,15,9),array(35,8,18,10),array(12,36,6,45),array(48,12,24,15),array(55,14,28,18));                                
                                for($i=0;$i<10;$i++){
                                    ?>
                                    <tr>
                                        <td><center><?php echo $schaden[$i][0];?></center></td>
                                        <td></td>
                                        <td><center><?php echo $schaden[$i][1];?></center></td>
                                        <td style="color:#aaaaaa;"><center><?php echo $lang['hilfe'][12][6][$i];?></center></td>
                                        <td><center><?php echo $schaden[$i][2];?></center></td>
                                        <td></td>
                                        <td><center><?php echo $schaden[$i][3];?></center></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </center>
                        <center><?php echo $lang['hilfe'][12][9];?></center>
                        <?php
                    //}elseif ($fuid==13 bis 15 ) { unnoetig, nur kopf
                    }elseif ($fuid==16) {
                        ?>
                        <ul>
                            <?php
                            for($i=0;$i<6;$i++){
                                ?>
                                <li><b><?php echo $lang['hilfe'][16][0][$i];?></b><br><br>
                                <?php echo $lang['hilfe'][16][1][$i];?><br><br>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                        echo $lang['hilfe'][16][2];
                    //}elseif ($fuid==17 bis 32) { unnoetig, nur kopf
                    }elseif ($fuid==33) {
                        ?>
                        <center>
                            <table border="0" cellspacing="0" cellpadding="2">
                                <tr>
                                    <td>1</td>
                                    <td><img src="../bilder/icons/cantox.gif" border="0" width="17" height="17"></td>
                                    <td><nobr>&nbsp;:&nbsp;</nobr></td>
                                    <td>0</td>
                                    <td><img src="../bilder/icons/cantox.gif" border="0" width="17" height="17"></td>
                                </tr>
                                <tr>
                                    <td><?php echo str_replace('{1}',1,$lang['hilfe']['kt']);?></td>
                                    <td><img src="../bilder/icons/lemin.gif" border="0" width="17" height="17"></td>
                                    <td><nobr>&nbsp;:&nbsp;</nobr></td>
                                    <td>8</td>
                                    <td><img src="../bilder/icons/cantox.gif" border="0" width="17" height="17"></td>
                                </tr>
                                <tr>
                                    <td><?php echo str_replace('{1}',1,$lang['hilfe']['kt']);?></td>
                                    <td><img src="../bilder/icons/vorrat.gif" border="0" width="17" height="17"></td>
                                    <td><nobr>&nbsp;:&nbsp;</nobr></td>
                                    <td>8</td>
                                    <td><img src="../bilder/icons/cantox.gif" border="0" width="17" height="17"></td>
                                </tr>
                                <tr>
                                    <td><?php echo str_replace('{1}',1,$lang['hilfe']['kt']);?></td>
                                    <td><img src="../bilder/icons/mineral_1.gif" border="0" width="17" height="17"></td>
                                    <td><nobr>&nbsp;:&nbsp;</nobr></td>
                                    <td>8</td>
                                    <td><img src="../bilder/icons/cantox.gif" border="0" width="17" height="17"></td>
                                </tr>
                                <tr>
                                    <td><?php echo str_replace('{1}',1,$lang['hilfe']['kt']);?></td>
                                    <td><img src="../bilder/icons/mineral_2.gif" border="0" width="17" height="17"></td>
                                    <td><nobr>&nbsp;:&nbsp;</nobr></td>
                                    <td>8</td>
                                    <td><img src="../bilder/icons/cantox.gif" border="0" width="17" height="17"></td>
                                </tr>
                                <tr>
                                    <td><?php echo str_replace('{1}',1,$lang['hilfe']['kt']);?></td>
                                    <td><img src="../bilder/icons/mineral_3.gif" border="0" width="17" height="17"></td>
                                    <td><nobr>&nbsp;:&nbsp;</nobr></td>
                                    <td>8</td>
                                    <td><img src="../bilder/icons/cantox.gif" border="0" width="17" height="17"></td>
                                </tr>
                            </table>
                        </center>
                        <?php echo $lang['hilfe'][33][0];
                    }//elseif ($fuid==34-47) {}
                    elseif ($fuid==9999) {
                        echo 'Sorry, no help found.';
                    }
                    ?>
                </td>
            </tr>
        </table>
        <?php
        //////////////////////////////////////////////////////////////////////////
    include ("inc.footer.php");
} else {
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

            <frame name="rahmen12" scrolling="auto" marginwidth="0" marginheight="0" noresize src="hilfe.php?fu=<?php if (int_get('fu2')>=1) {echo int_get('fu2');} else {echo "9999";} ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" target="_self">

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
