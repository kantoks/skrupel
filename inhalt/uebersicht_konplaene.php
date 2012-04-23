<?php 
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'uebersicht_konplaene';
$fuid = int_get('fu');

if ($fuid==1) {
    
    include ("inc.header.php");
    ?>
    <body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
        <?php 
        $file='../daten/'.$spieler_rasse.'/schiffe.txt';
        $fp = @fopen("$file","r");
        if ($fp) {
            $zaehler=0;
            while (!feof ($fp)) {
                $buffer = @fgets($fp, 4096);
                $schiff[$zaehler]=$buffer;
                $zaehler++;
            }
            @fclose($fp);
        }
        ?>

        <table border="0" cellspacing="0" cellpadding="0">
            <?php 

            for ($i=0;$i<$zaehler;$i++) {
                $schiffwert=explode(':',$schiff[$i]);
                ?>
                <tr>
                    <td colspan="20">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="font-size:11px;"><?php echo $schiffwert[0]?></td>
                                <td style="color:#aaaaaa;" valign="bottom"><?php echo str_replace('{1}',$schiffwert[2],$lang['uebersicht']['konplaene']['techlevel'])?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="20"><img src="../bilder/empty.gif" border="0" width="1" height="10"></td>
                </tr>
                <tr>
                    <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                    <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="150" height="1"></td>
                    <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                    <td colspan="17"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                </tr>
                <tr>
                    <td bgcolor="#aaaaaa" rowspan="4"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                    <td rowspan="4"><img src="../daten/<?php echo $spieler_rasse?>/bilder_schiffe/<?php echo $schiffwert[3]?>" width="150" height="100"></td>
                    <td bgcolor="#aaaaaa" rowspan="4"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><img src="<?php echo $bildpfad?>/icons/crew.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['uebersicht']['konplaene']['crew']?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><?php echo $schiffwert[15]?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><img src="<?php echo $bildpfad?>/icons/antrieb.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['uebersicht']['konplaene']['antriebe']?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><?php echo $schiffwert[14]?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><img src="<?php echo $bildpfad?>/icons/cantox.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['uebersicht']['konplaene']['cantox']?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><?php echo $schiffwert[5]?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td rowspan="4" valign="top" style="color:#aaaaaa;"><?php echo $schiffwert[18]?></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><img src="<?php echo $bildpfad?>/icons/masse.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['uebersicht']['konplaene']['masse']?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><?php echo $schiffwert[16]?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><img src="<?php echo $bildpfad?>/icons/laser.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['uebersicht']['konplaene']['energetik']?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><?php echo $schiffwert[9]?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><img src="<?php echo $bildpfad?>/icons/mineral_1.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['uebersicht']['konplaene']['baxterium']?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><nobr><?php echo str_replace('{1}',$schiffwert[6],$lang['uebersicht']['konplaene']['kt'])?></nobr></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><img src="<?php echo $bildpfad?>/icons/lemin.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['uebersicht']['konplaene']['tank']?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><nobr><?php echo str_replace('{1}',$schiffwert[13],$lang['uebersicht']['konplaene']['kt'])?></nobr></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><img src="<?php echo $bildpfad?>/icons/projektil.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['uebersicht']['konplaene']['projektile']?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><?php echo $schiffwert[10]?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><img src="<?php echo $bildpfad?>/icons/mineral_2.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['uebersicht']['konplaene']['rennurbin']?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><nobr><?php echo str_replace('{1}',$schiffwert[7],$lang['uebersicht']['konplaene']['kt'])?></nobr></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><img src="<?php echo $bildpfad?>/icons/vorrat.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['uebersicht']['konplaene']['fracht']?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><nobr><?php echo str_replace('{1}',$schiffwert[12],$lang['uebersicht']['konplaene']['kt'])?></nobr></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><img src="<?php echo $bildpfad?>/icons/hangar.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['uebersicht']['konplaene']['hangar']?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><?php echo $schiffwert[11]?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><img src="<?php echo $bildpfad?>/icons/mineral_3.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['uebersicht']['konplaene']['vormissan']?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><nobr><?php echo str_replace('{1}',$schiffwert[8],$lang['uebersicht']['konplaene']['kt'])?></nobr></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                </tr>
                <tr>
                    <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                    <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="150" height="1"></td>
                    <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                    <td colspan="17"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                </tr>
                <tr>
                    <td colspan="20"><img src="../bilder/empty.gif" border="0" width="1" height="20"></td>
                </tr>
                <?php 
            }
          
            $zeiger = @mysql_query("SELECT * FROM $skrupel_konplaene where besitzer=$spieler and spiel=$spiel order by rasse,techlevel,klasse");
            $plananzahl = @mysql_num_rows($zeiger);
            if ($plananzahl>=1) {
                
                for  ($i=0; $i<$plananzahl;$i++) {
                    $ok = @mysql_data_seek($zeiger,$i);
                    
                    $array = @mysql_fetch_array($zeiger);
                    $plan_rasse=$array["rasse"];
                    $plan_klasse=$array["klasse"];
                    $plan_klasse_id=$array["klasse_id"];
                    $plan_techlevel=$array["techlevel"];
                    $plan_sonstiges=$array["sonstiges"];
                    
                    $schiffwert=explode(':',$plan_sonstiges);
                    ?>
                        <tr>
                        <td colspan="20">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="font-size:11px;"><?php echo $plan_klasse?></td>
                                    <td style="color:#aaaaaa;" valign="bottom"><?php echo str_replace('{1}',$plan_techlevel,$lang['uebersicht']['konplaene']['techlevel'])?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="20"><img src="../bilder/empty.gif" border="0" width="1" height="10"></td>
                    </tr>
                    <tr>
                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="150" height="1"></td>
                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                        <td colspan="17"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                    </tr>
                    <tr>
                        <td bgcolor="#aaaaaa" rowspan="4"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                        <td rowspan="4"><img src="../daten/<?php echo $plan_rasse?>/bilder_schiffe/<?php echo $schiffwert[0]?>" width="150" height="100"></td>
                        <td bgcolor="#aaaaaa" rowspan="4"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad?>/icons/crew.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td style="color:#aaaaaa;"><?php echo $lang['uebersicht']['konplaene']['crew']?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $schiffwert[12]?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad?>/icons/antrieb.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td style="color:#aaaaaa;"><?php echo $lang['uebersicht']['konplaene']['antriebe']?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $schiffwert[11]?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad?>/icons/cantox.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td style="color:#aaaaaa;"><?php echo $lang['uebersicht']['konplaene']['cantox']?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $schiffwert[2]?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td rowspan="4" valign="top" style="color:#aaaaaa;"><?php echo $schiffwert[15]?></td>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad?>/icons/masse.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td style="color:#aaaaaa;"><?php echo $lang['uebersicht']['konplaene']['masse']?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $schiffwert[13]?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad?>/icons/laser.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td style="color:#aaaaaa;"><?php echo $lang['uebersicht']['konplaene']['energetik']?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $schiffwert[6]?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad?>/icons/mineral_1.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td style="color:#aaaaaa;"><?php echo $lang['uebersicht']['konplaene']['baxterium']?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><nobr><?php echo str_replace('{1}',$schiffwert[3],$lang['uebersicht']['konplaene']['kt'])?></nobr></td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad?>/icons/lemin.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td style="color:#aaaaaa;"><?php echo $lang['uebersicht']['konplaene']['tank']?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><nobr><?php echo str_replace('{1}',$schiffwert[10],$lang['uebersicht']['konplaene']['kt'])?></nobr></td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad?>/icons/projektil.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td style="color:#aaaaaa;"><?php echo $lang['uebersicht']['konplaene']['projektile']?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $schiffwert[7]?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad?>/icons/mineral_2.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td style="color:#aaaaaa;"><?php echo $lang['uebersicht']['konplaene']['rennurbin']?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><nobr><?php echo str_replace('{1}',$schiffwert[4],$lang['uebersicht']['konplaene']['kt'])?></nobr></td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad?>/icons/vorrat.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td style="color:#aaaaaa;"><?php echo $lang['uebersicht']['konplaene']['fracht']?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><nobr><?php echo str_replace('{1}',$schiffwert[9],$lang['uebersicht']['konplaene']['kt'])?></nobr></td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad?>/icons/hangar.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td style="color:#aaaaaa;"><?php echo $lang['uebersicht']['konplaene']['hangar']?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $schiffwert[8]?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad?>/icons/mineral_3.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td style="color:#aaaaaa;"><?php echo $lang['uebersicht']['konplaene']['vormissan']?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><nobr><?php echo str_replace('{1}',$schiffwert[5],$lang['uebersicht']['konplaene']['kt'])?></nobr></td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    </tr>
                    <tr>
                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="150" height="1"></td>
                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                        <td colspan="17"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                    </tr>
                    <tr>
                        <td colspan="20"><img src="../bilder/empty.gif" border="0" width="1" height="20"></td>
                    </tr>
                    <?php 
                }
            }
            ?>
        </table>
        </div>
        <?php 
    include ("inc.footer.php");
}
