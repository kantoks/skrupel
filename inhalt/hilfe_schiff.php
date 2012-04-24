<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'hilfe_schiff';
$fuid = int_get('fu');

if ($fuid>=1) {
    include ("inc.header.php");
    ?>
<body text="#000000" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php
    $volk=str_get('volk','SHORTNAME');
    $file='../daten/'.$volk.'/schiffe.txt';
    $fp = @fopen("$file","r");
    if($fp){
        $zaehler=0;
        while(!feof ($fp)){
            $buffer = @fgets($fp, 4096);
            $schiff[$zaehler]=$buffer;
            $zaehler++;
        }
        @fclose($fp);
    }
    for ($i=0;$i<$zaehler;$i++) {
        $schiffwert=explode(':',$schiff[$i]);
        if($schiffwert[1]==$fuid) { 
            $fertigkeiten=trim($schiffwert[17]);
            $subpartikel=@intval(substr($fertigkeiten,0,2));
            $terra_warm=@intval(substr($fertigkeiten,5,1));
            $terra_kalt=@intval(substr($fertigkeiten,6,1));
            $quark=@intval(substr($fertigkeiten,7,4));
            $sprungtriebwerk=@intval(substr($fertigkeiten,11,11));
            $tarnfeldgen=@intval(substr($fertigkeiten,22,1));
            $subraumver=@intval(substr($fertigkeiten,23,1));
            $scannerfert=@intval(substr($fertigkeiten,24,1));
            $sprungtorbau=@intval(substr($fertigkeiten,25,12));
            $fluchtmanoever=@intval(substr($fertigkeiten,38,2));
            $signaturmaske=@intval(substr($fertigkeiten,40,1));
            $viralmin=@intval(substr($fertigkeiten,41,2));
            $viralmax=@intval(substr($fertigkeiten,43,3));
            $erwtrans=@intval(substr($fertigkeiten,46,2));
            $cybern=@intval(substr($fertigkeiten,48,2));
            $destabil=@intval(substr($fertigkeiten,50,2));
            $overdrive_min=@intval(substr($fertigkeiten,53,1));
            $overdrive_max=@intval(substr($fertigkeiten,54,1));
            $luckyshot=@intval(substr($fertigkeiten,55,1));
            $orbitalschild=@intval(substr($fertigkeiten,56,1));
            $infanterie=@intval(substr($fertigkeiten,57,1));
            $hmatrix=@intval(substr($fertigkeiten,58,1));
            $fuehrung=@intval(substr($fertigkeiten,59,1));
            $fert_reperatur=@intval(substr($fertigkeiten,37,1));
            $strukturtaster=@intval(substr($fertigkeiten,52,1));
            $wellengenerator=@intval(substr($fertigkeiten,60,1));
            $daempfer=@intval(substr($fertigkeiten,61,1));
            $kamikaze_erfolg=@intval(substr($fertigkeiten,62,1))*10;
            $kamikaze_schaden=@intval(substr($fertigkeiten,63,1))*100;
            $fert_quark_vorrat=@intval(substr($fertigkeiten,7,1))*113;
            $fert_quark_min1=@intval(substr($fertigkeiten,8,1))*113;
            $fert_quark_min2=@intval(substr($fertigkeiten,9,1))*113;
            $fert_quark_min3=@intval(substr($fertigkeiten,10,1))*113;
            $fert_sub_vorrat=@intval(substr($fertigkeiten,0,2));
            $fert_sub_min1=@intval(substr($fertigkeiten,2,1));
            $fert_sub_min2=@intval(substr($fertigkeiten,3,1));
            $fert_sub_min3=@intval(substr($fertigkeiten,4,1));
            $fert_sprungtorbau_min1=@intval(substr($fertigkeiten,25,3));
            $fert_sprungtorbau_min2=@intval(substr($fertigkeiten,28,3));
            $fert_sprungtorbau_min3=@intval(substr($fertigkeiten,31,3));
            $fert_sprungtorbau_lemin=@intval(substr($fertigkeiten,34,3));
            $fert_sprung_kosten=@intval(substr($fertigkeiten,11,3));
            $fert_sprung_min=@intval(substr($fertigkeiten,14,4));
            $fert_sprung_max=@intval(substr($fertigkeiten,18,4));
            $spezial='';
            if ($cybern>=1){
                if (strlen($spezial)>=1){
                    $spezial.='<br>';
                }
                $wert=$cybern*220;
                $textneu=str_replace(array('{1}'),array($wert),$lang['hilfe_schiff']['cybernrittnikk']);
                $spezial.=$textneu;
            }
            if ($destabil>=1) {
                if (strlen($spezial)>=1) {
                    $spezial.='<br>';
                }
                $textneu=str_replace(array('{1}'),array($destabil),$lang['hilfe_schiff']['destabilisator']);
                $spezial.=$textneu;
            }
            if($erwtrans>=1) {
                if (strlen($spezial)>=1){
                    $spezial.='<br>';
                }
                $textneu=str_replace(array('{1}'),array($erwtrans),$lang['hilfe_schiff']['erweitertertransporter']);
                $spezial.=$textneu;
            }
            if($hmatrix==1){
                if(strlen($spezial)>=1){
                    $spezial.='<br>';
                }
                $spezial.=$lang['hilfe_schiff']['hmatrix'];
            }
            if ($infanterie==1) {
                if (strlen($spezial)>=1){
                    $spezial.='<br>';
                }
                $spezial.=$lang['hilfe_schiff']['infanterie'];
            }
            if ($fuehrung==1) {
                if (strlen($spezial)>=1) { $spezial.='<br>'; }
                $spezial.=$lang['hilfe_schiff']['fuehrung'];
            }
            if ($fluchtmanoever>=1) {
                if (strlen($spezial)>=1){
                    $spezial.='<br>';
                }
                if ($fluchtmanoever==1) {
                    $spezial.=$lang['hilfe_schiff']['lloydsfluchtmanoever'][0];
                }else{
                    $textneu=str_replace(array('{1}'),array($fluchtmanoever),$lang['hilfe_schiff']['lloydsfluchtmanoever'][1]);
                    $spezial.=$textneu;
                }
            }
            if($luckyshot>=1){
                if (strlen($spezial)>=1){
                    $spezial.='<br>';
                }
                $textneu=str_replace(array('{1}'),array($luckyshot),$lang['hilfe_schiff']['luckyshot']);
                $spezial.=$textneu;
            }
            if ($orbitalschild==1) {
                if (strlen($spezial)>=1) { $spezial.='<br>'; }
                $spezial.=$lang['hilfe_schiff']['orbitalschild'];
            }
            if (($overdrive_min>=1) or ($overdrive_max>=1)) {
                if (strlen($spezial)>=1) { $spezial.='<br>'; }
                $wert1=$overdrive_min*10;
                $wert2=$overdrive_max*10;
                $textneu=str_replace(array('{1}','{2}'),array($wert1,$wert2),$lang['hilfe_schiff']['overdrive']);
                $spezial.=$textneu;
            }
            if ($quark>=1) {
                if (strlen($spezial)>=1) { $spezial.='<br>'; }
                $textneu=str_replace(array('{1}','{2}','{3}','{4}'),array($fert_quark_vorrat,$fert_quark_min1,$fert_quark_min2,$fert_quark_min3),$lang['hilfe_schiff']['quarkreorganisator']);
                $spezial.=$textneu;
            }
            if ($fert_reperatur>=1) {
                if (strlen($spezial)>=1) { $spezial.='<br>'; }
                $textneu=str_replace(array('{1}'),array($fert_reperatur),$lang['hilfe_schiff']['reperaturunterstuetzung']);
                $spezial.=$textneu;
            }
            if ($scannerfert>=1) {
                if (strlen($spezial)>=1) { $spezial.='<br>'; }
                if ($scannerfert==1) {
                    $spezial.=$lang['hilfe_schiff']['scanner'][0];
                } else {
                    $spezial.=$lang['hilfe_schiff']['scanner'][1];
                }
            }
            if ($signaturmaske==1) {
                if (strlen($spezial)>=1) { $spezial.='<br>'; }
                $spezial.=$lang['hilfe_schiff']['signaturmaskierung'];
            }
            if ($sprungtorbau>=1) {
                if (strlen($spezial)>=1) { $spezial.='<br>'; }
                $textneu=str_replace(array('{1}','{2}','{3}','{4}'),array($fert_sprungtorbau_min1,$fert_sprungtorbau_min2,$fert_sprungtorbau_min3,$fert_sprungtorbau_lemin),$lang['hilfe_schiff']['sprungtorbau']);
                $spezial.=$textneu;
            }
            if ($sprungtriebwerk>=1) {
                if (strlen($spezial)>=1) { $spezial.='<br>'; }
                $textneu=str_replace(array('{1}','{2}','{3}'),array($fert_sprung_kosten,$fert_sprung_min,$fert_sprung_max),$lang['hilfe_schiff']['sprungtriebwerk']);
                $spezial.=$textneu;
            }
            if ($strukturtaster==1) {
                if (strlen($spezial)>=1) { $spezial.='<br>'; }
                $spezial.=$lang['hilfe_schiff']['strukturtaster'];
            }
            if ($subpartikel>=1) {
                if (strlen($spezial)>=1) { $spezial.='<br>'; }
                $textneu=str_replace(array('{1}','{2}','{3}','{4}'),array($fert_sub_vorrat,$fert_sub_min1,$fert_sub_min2,$fert_sub_min3),$lang['hilfe_schiff']['subpartikelcluster']);
                $spezial.=$textneu;
            }
            if ($subraumver>=1) {
                if (strlen($spezial)>=1) { $spezial.='<br>'; }
                $textneu=str_replace(array('{1}'),array($subraumver),$lang['hilfe_schiff']['subraumverzerrer']);
                $spezial.=$textneu;
            }
             if ($tarnfeldgen==1) {
                if (strlen($spezial)>=1) { $spezial.='<br>'; }
                $spezial.=$lang['hilfe_schiff']['tarnfeldgenerator1'];
            }
             if ($tarnfeldgen==2) {
                if (strlen($spezial)>=1) { $spezial.='<br>'; }
                $spezial.=$lang['hilfe_schiff']['tarnfeldgenerator2'];
            }
             if ($tarnfeldgen==3) {
                if (strlen($spezial)>=1) { $spezial.='<br>'; }
                $spezial.=$lang['hilfe_schiff']['tarnfeldgenerator3'];
            }
             if ($terra_warm==1) {
                if (strlen($spezial)>=1) { $spezial.='<br>'; }
                $spezial.=$lang['hilfe_schiff']['terraformer'][0];
            }
             if ($terra_kalt==1) {
                if (strlen($spezial)>=1) { $spezial.='<br>'; }
                $spezial.=$lang['hilfe_schiff']['terraformer'][1];
            }
            if (($viralmin>=1) or ($viralmax>=1)) {
                if (strlen($spezial)>=1) { $spezial.='<br>'; }
                $textneu=str_replace(array('{1}','{2}'),array($viralmin,$viralmax),$lang['hilfe_schiff']['viralerangriff']);
                $spezial.=$textneu;
            }
            if ($wellengenerator>=1) {
                if (strlen($spezial)>=1) { $spezial.='<br>'; }
                $textneu=str_replace(array('{1}'),array($wellengenerator),$lang['hilfe_schiff']['wellengenerator']);
                $spezial.=$textneu;
            }
            if ($daempfer>=1) {
                if (strlen($spezial)>=1) { $spezial.='<br>'; }
                $textneu=str_replace(array('{1}'),array($daempfer),$lang['hilfe_schiff']['schilddaempfer']);
                $spezial.=$textneu;
            }
            if ($kamikaze_erfolg>0 && $kamikaze_schaden>0) {
                if (strlen($spezial)>=1) { $spezial.='<br>'; }
                $textneu=str_replace(array('{1}','{2}'),array($kamikaze_erfolg, $kamikaze_schaden),$lang['hilfe_schiff']['kamikaze']);
                $spezial.=$textneu;
            }
            ?>
        <script language=JavaScript>parent.document.title='<?php echo $schiffwert[0]; ?>';</script>
            <center>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
                    </tr>
                    <tr>
                        <td style="font-size:12px;"><b><?php echo $schiffwert[0]; ?></b></td>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="1" height="7"></td>
                    </tr>
                </table>
            </center>
            <center>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="21"><img src="../bilder/empty.gif" border="0" width="1" height="8"></td>
                    </tr>
                    <tr>
                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="150" height="1"></td>
                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                        <td colspan="18"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                    </tr>
                    <tr>
                        <td bgcolor="#aaaaaa" rowspan="4"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                        <td rowspan="4"><img src="../daten/<?php echo $volk; ?>/bilder_schiffe/<?php echo $schiffwert[3]; ?>" width="150" height="100"></td>
                        <td bgcolor="#aaaaaa" rowspan="4"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad; ?>/icons/crew.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td style="color:#aaaaaa;"><?php echo $lang['hilfe_schiff']['crew']?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $schiffwert[15]; ?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad; ?>/icons/antrieb.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td style="color:#aaaaaa;"><?php echo $lang['hilfe_schiff']['antriebe']?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $schiffwert[14]; ?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad; ?>/icons/cantox.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td style="color:#aaaaaa;"><?php echo $lang['hilfe_schiff']['cantox']?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $schiffwert[5]; ?></td>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad; ?>/icons/masse.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td style="color:#aaaaaa;"><?php echo $lang['hilfe_schiff']['masse']?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $schiffwert[16]; ?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad; ?>/icons/laser.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td style="color:#aaaaaa;"><?php echo $lang['hilfe_schiff']['energetik']?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $schiffwert[9]; ?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad; ?>/icons/mineral_1.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td style="color:#aaaaaa;"><?php echo $lang['hilfe_schiff']['bax']?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><nobr><?php echo str_replace('{1}',$schiffwert[6],$lang['hilfe_schiff']['kt'])?></nobr></td>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad; ?>/icons/lemin.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td style="color:#aaaaaa;"><?php echo $lang['hilfe_schiff']['tank']?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><nobr><?php echo str_replace('{1}',$schiffwert[13],$lang['hilfe_schiff']['kt'])?></nobr></td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad; ?>/icons/projektil.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td style="color:#aaaaaa;"><?php echo $lang['hilfe_schiff']['projektile']?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $schiffwert[10]; ?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad; ?>/icons/mineral_2.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td style="color:#aaaaaa;"><?php echo $lang['hilfe_schiff']['ren']?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><nobr><?php echo str_replace('{1}',$schiffwert[7],$lang['hilfe_schiff']['kt'])?></nobr></td>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad; ?>/icons/vorrat.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td style="color:#aaaaaa;"><?php echo $lang['hilfe_schiff']['fracht']?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><nobr><?php echo str_replace('{1}',$schiffwert[12],$lang['hilfe_schiff']['kt'])?></nobr></td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad; ?>/icons/hangar.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td style="color:#aaaaaa;"><?php echo $lang['hilfe_schiff']['hangar']?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><?php echo $schiffwert[11]; ?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                        <td><img src="<?php echo $bildpfad; ?>/icons/mineral_3.gif" border="0" width="17" height="17"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td style="color:#aaaaaa;"><?php echo $lang['hilfe_schiff']['vorm']?></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td <?php if (strlen($schiffwert[18])>=5) { echo 'width="100%"'; } ?>><nobr><?php echo str_replace('{1}',$schiffwert[8],$lang['hilfe_schiff']['kt'])?></nobr></td>
                    </tr>
                    <tr>
                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="150" height="1"></td>
                        <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                        <td colspan="18"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                    </tr>
                    <?php
                    if (strlen($spezial)>=5) {
                        ?>
                        <tr>
                            <td colspan="20"><img src="../bilder/empty.gif" border="0" width="1" height="10"></td>
                        </tr>
                        <tr>
                            <td colspan="20" valign="top" style="color:#aaaaaa;"><?php echo $spezial?></td>
                        </tr>
                        <tr>
                            <td colspan="20"><img src="../bilder/empty.gif" border="0" width="1" height="10"></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </center>
            <?php
            }
        }
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
            <frame name="rahmen12" scrolling="auto" marginwidth="0" marginheight="0" noresize src="hilfe_schiff.php?fu=<?php echo int_get('fu2'); ?>&volk=<?php echo str_get('volk','SHORTNAME'); ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" target="_self">
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
