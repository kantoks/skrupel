<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'meta_rassen';
$langfile_2 = 'orbitale_systeme';
$fuid = int_get('fu');

if ($fuid==1) {
    include ("inc.header.php");
    ?>
    <script type="text/javascript">
        function link(url) {
                if (parent.mittelinksoben.document.globals.map.value==1) {
                     parent.mittelinksoben.document.globals.map.value=0;
                     parent.mittemitte.window.location='aufbau.php?fu=100&query='+url;
                }  else  {
                     parent.mittemitte.rahmen12.window.location=url;
                }
        }
    </script>      
    <body text="#000000" bgcolor="#444444" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;"  link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
            <?php
            $raceshtml = '';
            $racecount=0;
            $verzeichnis="../daten/";
            $handle=opendir("$verzeichnis");
            while ($file=readdir($handle)) {
                if ((substr($file,0,1)<>'.') and (substr($file,0,7)<>'bilder_') and (substr($file,strlen($file)-4,4)<>'.txt')) {
                    if(($file == "unknown") or($file == "CVS")) { continue; }
                    $raceshtml .= '<td><img src="'.$bildpfad.'/empty.gif" border="0" width="5" height="1"></td><td><a href="javascript:;" border="0" onclick="link(\'meta_rassen.php?fu=2&uid='.$uid.'&sid='.$sid.'&rasse='.$file.'\');body.focus();"><img src="../daten/'.$file.'/bilder_allgemein/menu.png" border="0" width="186" height="75"></a></td>';
                    $racecount++;
                }
            }
            closedir($handle);
            ?>
            <div style="width:<?php echo 191*$racecount; ?>px;">
                <center>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="1" height="9"></td>
                        </tr>
                        <tr>
                        <?php echo $raceshtml; ?>
                        </tr>
                    </table>
                </center>
            </div>
        </div>
        <?php
    include ("inc.footer.php");
}
if ($fuid==2) {
    include ("inc.header.php");
    $rasse = str_get('rasse','SHORTNAME');
    //if ((!strstr($rasse, '.')) and (!strstr($rasse, '/'))) {
    if ($rasse!='') {
    ?>
    <script type="text/javascript" src="js/helpers/swfobject.js"></script>
    <body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
        <?php
        $file='../daten/'.$rasse.'/schiffe.txt';
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
        $file='../daten/'.$rasse.'/daten.txt';
        $fp = @fopen("$file","r");
        if ($fp) {
            $zaehler2=0;
            while (!feof ($fp)) {
                $buffer = @fgets($fp, 4096);
                $daten[$zaehler2]=$buffer;
                $zaehler2++;
            }
            @fclose($fp);
        }
        $copyright=$daten[1];
        $attribute=explode(":",$daten[2]);
        $attribute2=explode(":",$daten[4]);
        $verbieten=explode(":",trim($daten[6]));
        $erlauben=explode(":",trim($daten[7]));
        if (0 < (intval($verbieten[0]))) {} else { $verbieten = array(); }
        if (0 < (intval($erlauben[0]))) {} else { $erlauben = array(); }
        $beschreibung="";
        $file='../daten/'.$rasse.'/beschreibung_'.$language.'.txt';
        if (!file_exists($file)) { $file='../daten/'.$rasse.'/beschreibung.txt'; }
        $fp = @fopen("$file","r");
        if ($fp) {
            while (!feof ($fp)) {
                $buffer = @fgets($fp, 4096);
                $beschreibung=$beschreibung.$buffer;
            }
            @fclose($fp);
        }
        if ($attribute2[0]>=1) {
            if ($attribute2[1]==0) {
                $assrasse=$lang['metarassen']['alle'];
            } else {
                $assrasse=$lang['metarassen']['art'][(int)$attribute2[1]];
            }
        } else {
            $assrasse=$lang['metarassen']['keine'];
        }
        $assgrad=$attribute2[0];
        ?>
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="10"></td>
            </tr>
            <tr>
                <td valign="top" width="100%">
                    <table border="0" cellspacing="0" cellpadding="0" width="100%">
                        <tr>
                            <td><center><img src="../daten/<?php echo $rasse?>/bilder_allgemein/<?php
                                if (@file_exists("../daten/$rasse/bilder_allgemein/topic.png")) { echo "topic.png"; 
                                }elseif (@file_exists("../daten/$rasse/bilder_allgemein/topic.gif")) { echo "topic.gif"; }
                                ?>" border="0" height="135"></center>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="1" height="10"></td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;"><b><center><?php echo $daten[0]?></center></b></td>
                        </tr>
                    <?php 
                        $file='../daten/'.$rasse.'/theme.mp3';
                        if (@file_exists($file)) { ?>
                        <tr>
                            <td><center>
                                <div id="theme" style="padding-top:10px;"></div>
                                <script type="text/javascript">
                                    // <![CDATA[
                                    var so = new SWFObject("flash/mp3/mp3play.swf", "sotester", "20", "20", "9", "#000000");
                                    so.addVariable("filePath", "<?php echo $file; ?>");
                                    so.addParam("scale", "noscale");
                                    so.addParam("wmode", "transparent");
                                    so.write("theme");
                                    // ]]>
                                </script>                            
                            </center></td>
                        </tr>                    
                    <?php } ?>                        
                    </table>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="1" height="20"></td>
                        </tr>
                        <tr>
                            <td width="100%" style="color:#aaaaaa;" valign="top"><?php echo $beschreibung?></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="1" height="30"></td>
                        </tr>
                        <?php
                        if (strlen($copyright)>=5) {
                            ?>
                            <tr>
                                <td><center><i><?php echo $copyright?></i></center></td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" border="0" width="1" height="30"></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </td>
                <td align="right"><img src="../bilder/empty.gif" border="0" width="20" height="20"></td>
                <td align="right">
                    <table border="0" cellspacing="0" cellpadding="0">
                        <?php
                        $file='../daten/'.$rasse.'/bilder_basen/2.jpg';
                        if (@file_exists($file)) { ?><tr><td style="border-style:solid;border-color:#cccccc;border-width:1px;"><img src="<?php echo $file?>" border="0" width="150" height="100"></td></tr><?php }
                        $file='../daten/'.$rasse.'/bilder_basen/3.jpg';
                        if (@file_exists($file)) { ?><tr><td style="border-style:solid;border-color:#cccccc;border-width:1px;"><img src="<?php echo $file?>" border="0" width="150" height="100"></td></tr><?php }
                        $file='../daten/'.$rasse.'/bilder_basen/1.jpg';
                        if (@file_exists($file)) { ?><tr><td style="border-style:solid;border-color:#cccccc;border-width:1px;"><img src="<?php echo $file?>" border="0" width="150" height="100"></td></tr><?php }
                        $file='../daten/'.$rasse.'/bilder_basen/4.jpg';
                        if (@file_exists($file)) { ?><tr><td style="border-style:solid;border-color:#cccccc;border-width:1px;"><img src="<?php echo $file?>" border="0" width="150" height="100"></td></tr><?php }
                        ?>
                    </table>
                </td>
            </tr>
        </table>
        <?php
        if ($attribute[6]>=1) {
            if ($attribute[6]==1) { $klassename="M"; }
            if ($attribute[6]==2) { $klassename="N"; }
            if ($attribute[6]==3) { $klassename="J"; }
            if ($attribute[6]==4) { $klassename="L"; }
            if ($attribute[6]==5) { $klassename="G"; }
            if ($attribute[6]==6) { $klassename="I"; }
            if ($attribute[6]==7) { $klassename="C"; }
            if ($attribute[6]==8) { $klassename="K"; }
            if ($attribute[6]==9) { $klassename="F"; }
            ?>
            <center>
                <table border="0" cellspacing="0" cellpadding="3">
                    <td style="color:#aaaaaa;"><?php echo $lang['metarassen']['planetenklasse']?></td>
                    <td><?php echo $klassename?></td>
                    <td><img border="0" src="<?php echo $bildpfad?>/karte/planeten/<?php echo $attribute[6]?>.gif" width="10" height="10"></td>
                </table>
            </center>
            <br>
            <?php
        }
        ?>
        <center>
            <table border="0" cellspacing="0" cellpadding="3">
                <tr>
                    <td style="color:#aaaaaa;"><?php echo $lang['metarassen']['temperatur']?></td>
                    <td><?php if ($attribute[0]>=1) { echo str_replace('{1}',$attribute[0]-35,$lang['metarassen']['grad']); } else { echo $lang['metarassen']['keine']; } ?></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['metarassen']['minenproduktion']?></td>
                    <td><?php echo str_replace('{1}',$attribute[2]*100,$lang['metarassen']['vh'])?></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['metarassen']['bodenkampfangriff']?></td>
                    <td><?php echo str_replace('{1}',$attribute[3]*100,$lang['metarassen']['vh'])?></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['metarassen']['assimilation']?></td>
                    <td><?php echo $assrasse; ?></td>
                </tr>
                <tr>
                    <td style="color:#aaaaaa;"><?php echo $lang['metarassen']['steuereinahmen']?></td>
                    <td><?php echo str_replace('{1}',$attribute[1]*100,$lang['metarassen']['vh'])?></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['metarassen']['fabrikproduktion']?></td>
                    <td><?php echo str_replace('{1}',$attribute[5]*100,$lang['metarassen']['vh'])?></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['metarassen']['bodenkampfverteidigung']?></td>
                    <td><?php echo str_replace('{1}',$attribute[4]*100,$lang['metarassen']['vh'])?></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['metarassen']['aeffizienz']?></td>
                    <td><?php echo str_replace('{1}',$assgrad,$lang['metarassen']['vh'])?></td>
                </tr>
            </table>
        </center>
        <?php if ((0 < count ($verbieten)) or (0 < count ($erlauben))) { ?>
            <center>
                <table border="0" cellspacing="0" cellpadding="5" style="margin-top:25px;">
                    <?php if (0 < count ($erlauben)) { ?>
                    <td valign="top"><?php echo $lang['metarassen']['orbs'][0]; ?><br /><table border="0" cellspacing="0" cellpadding="5">
                        <?php foreach ($erlauben as $item) { ?>
                        <tr>
                            <td valign="top"><img src="../bilder/osysteme/<?php echo $item; ?>.gif" border="0" width="61" height="64" title="<?php echo $lang['orbitalesysteme']['name'][$item]; ?>"></td>
                            <td valign="top" style="color:#aaaaaa;"><br /><?php echo $lang['orbitalesysteme']['name'][$item]; ?><br /><br /><?php echo $lang['orbitalesysteme']['kurz'][$item]; ?><?php if (0 < strlen($lang['orbitalesysteme']['lang'][$item])) { echo '<br /><br />' . $lang['orbitalesysteme']['lang'][$item]; } ?></td>
                        </tr>
                        <?php } ?>
                    </table></td>
                    <?php } ?>
                    <?php if (0 < count ($verbieten)) { ?>
                    <td valign="top"><?php echo $lang['metarassen']['orbs'][1]; ?><br /><table border="0" cellspacing="0" cellpadding="5">
                        <?php foreach ($verbieten as $item) { ?>
                        <tr>
                            <td valign="top"><img src="../bilder/osysteme/<?php echo $item; ?>.gif" border="0" width="61" height="64" title="<?php echo $lang['orbitalesysteme']['name'][$item]; ?>"></td>
                            <td valign="top" style="color:#aaaaaa;"><br /><?php echo $lang['orbitalesysteme']['name'][$item]; ?><br /><br /><?php echo $lang['orbitalesysteme']['kurz'][$item]; ?><?php if (0 < strlen($lang['orbitalesysteme']['lang'][$item])) { echo '<br /><br />' . $lang['orbitalesysteme']['lang'][$item]; } ?></td>
                        </tr>
                        <?php } ?>
                    </table></td>
                    <?php } ?>                    
                </table>
            </center>
        <?php } ?>
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td colspan="20"><img src="../bilder/empty.gif" border="0" width="1" height="20"></td>
            </tr>
            <?php
            for ($i=0;$i<$zaehler;$i++) {
                $schiffwert=explode(':',$schiff[$i]);
                $fertigkeiten=trim($schiffwert[17]);
                $spezial='';
                $cybern=@intval(substr($fertigkeiten,48,2));
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
                if ($cybern>=1) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $wert=$cybern*220;
                    $textneu=str_replace(array('{1}'),array($wert),$lang['metarassen']['cybernrittnikk']);
                    $spezial.=$textneu;
                }
                if ($destabil>=1) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $textneu=str_replace(array('{1}'),array($destabil),$lang['metarassen']['destabilisator']);
                    $spezial.=$textneu;
                }
                if ($erwtrans>=1) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $textneu=str_replace(array('{1}'),array($erwtrans),$lang['metarassen']['erweitertertransporter']);
                    $spezial.=$textneu;
                }
                if ($hmatrix==1) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $spezial.=$lang['metarassen']['hmatrix'];
                }
                if ($infanterie==1) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $spezial.=$lang['metarassen']['infanterie'];
                }
                if ($fuehrung==1) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $spezial.=$lang['metarassen']['fuehrung'];
                }
                if ($fluchtmanoever>=1) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    if ($fluchtmanoever==1) {
                        $spezial.=$lang['metarassen']['lloydsfluchtmanoever'][0];
                    } else {
                        $textneu=str_replace(array('{1}'),array($fluchtmanoever),$lang['metarassen']['lloydsfluchtmanoever'][1]);
                        $spezial.=$textneu;
                    }
                }
                if ($luckyshot>=1) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $textneu=str_replace(array('{1}'),array($luckyshot),$lang['metarassen']['luckyshot']);
                    $spezial.=$textneu;
                }
                if ($orbitalschild==1) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $spezial.=$lang['metarassen']['orbitalschild'];
                }
                if (($overdrive_min>=1) or ($overdrive_max>=1)) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $wert1=$overdrive_min*10;
                    $wert2=$overdrive_max*10;
                    $textneu=str_replace(array('{1}','{2}'),array($wert1,$wert2),$lang['metarassen']['overdrive']);
                    $spezial.=$textneu;
                }
                if ($quark>=1) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $textneu=str_replace(array('{1}','{2}','{3}','{4}'),array($fert_quark_vorrat,$fert_quark_min1,$fert_quark_min2,$fert_quark_min3),$lang['metarassen']['quarkreorganisator']);
                    $spezial.=$textneu;
                }
                if ($fert_reperatur>=1) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $textneu=str_replace(array('{1}'),array($fert_reperatur),$lang['metarassen']['reperaturunterstuetzung']);
                    $spezial.=$textneu;
                }
                if ($scannerfert>=1) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    if ($scannerfert==1) {
                        $spezial.=$lang['metarassen']['scanner'][0];
                    } else {
                        $spezial.=$lang['metarassen']['scanner'][1];
                    }
                }
                if ($signaturmaske==1) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $spezial.=$lang['metarassen']['signaturmaskierung'];
                }
                if ($sprungtorbau>=1) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $textneu=str_replace(array('{1}','{2}','{3}','{4}'),array($fert_sprungtorbau_min1,$fert_sprungtorbau_min2,$fert_sprungtorbau_min3,$fert_sprungtorbau_lemin),$lang['metarassen']['sprungtorbau']);
                    $spezial.=$textneu;
                }
                if ($sprungtriebwerk>=1) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $textneu=str_replace(array('{1}','{2}','{3}'),array($fert_sprung_kosten,$fert_sprung_min,$fert_sprung_max),$lang['metarassen']['sprungtriebwerk']);
                    $spezial.=$textneu;
                }
                if ($strukturtaster==1) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $spezial.=$lang['metarassen']['strukturtaster'];
                }
                if ($subpartikel>=1) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $textneu=str_replace(array('{1}','{2}','{3}','{4}'),array($fert_sub_vorrat,$fert_sub_min1,$fert_sub_min2,$fert_sub_min3),$lang['metarassen']['subpartikelcluster']);
                    $spezial.=$textneu;
                }
                if ($subraumver>=1) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $textneu=str_replace(array('{1}'),array($subraumver),$lang['metarassen']['subraumverzerrer']);
                    $spezial.=$textneu;
                }
                if ($tarnfeldgen==1) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $spezial.=$lang['metarassen']['tarnfeldgenerator1'];
                }
                if ($tarnfeldgen==2) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $spezial.=$lang['metarassen']['tarnfeldgenerator2'];
                }
                if ($tarnfeldgen==3) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $spezial.=$lang['metarassen']['tarnfeldgenerator3'];
                }
                if ($terra_warm==1) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $spezial.=$lang['metarassen']['terraformer'][0];
                }
                if ($terra_kalt==1) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $spezial.=$lang['metarassen']['terraformer'][1];
                }
                if (($viralmin>=1) or ($viralmax>=1)) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $textneu=str_replace(array('{1}','{2}'),array($viralmin,$viralmax),$lang['metarassen']['viralerangriff']);
                    $spezial.=$textneu;
                }
                if ($wellengenerator>=1) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $textneu=str_replace(array('{1}'),array($wellengenerator),$lang['metarassen']['wellengenerator']);
                    $spezial.=$textneu;
                }
                if ($daempfer>=1) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $textneu=str_replace(array('{1}'),array($daempfer),$lang['metarassen']['daempfer']);
                    $spezial.=$textneu;
                }
                if ($kamikaze_erfolg>0 && $kamikaze_schaden>0) {
                    if (strlen($spezial)>=1) { $spezial.='<br>'; }
                    $textneu=str_replace(array('{1}','{2}'),array($kamikaze_erfolg, $kamikaze_schaden),$lang['metarassen']['kamikaze']);
                    $spezial.=$textneu;
                }
                ?>
                <tr>
                    <td colspan="20">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="font-size:11px;"><?php echo $schiffwert[0]?></td>
                                <td style="color:#aaaaaa;" valign="bottom">&nbsp;<?php echo str_replace('{1}',$schiffwert[2],$lang['metarassen']['tl']);?></td>
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
                    <td rowspan="4" bgcolor="#000000"><img src="../daten/<?php echo $rasse?>/bilder_schiffe/<?php echo $schiffwert[3]?>" width="150" height="100"></td>
                    <td bgcolor="#aaaaaa" rowspan="4"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><img src="<?php echo $bildpfad?>/icons/crew.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['metarassen']['crew']?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><?php echo $schiffwert[15]?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><img src="<?php echo $bildpfad?>/icons/antrieb.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['metarassen']['antriebe']?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><?php echo $schiffwert[14]?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><img src="<?php echo $bildpfad?>/icons/cantox.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['metarassen']['cantox']?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><?php echo $schiffwert[5]?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td rowspan="4" valign="top" style="color:#aaaaaa;"><?php echo $spezial?></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><img src="<?php echo $bildpfad?>/icons/masse.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['metarassen']['masse']?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><?php echo $schiffwert[16]?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><img src="<?php echo $bildpfad?>/icons/laser.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['metarassen']['energetik']?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><?php echo $schiffwert[9]?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><img src="<?php echo $bildpfad?>/icons/mineral_1.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['metarassen']['baxterium']?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><nobr><?php echo str_replace('{1}',$schiffwert[6],$lang['metarassen']['kt'])?></nobr></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><img src="<?php echo $bildpfad?>/icons/lemin.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['metarassen']['tank']?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><nobr><?php echo str_replace('{1}',$schiffwert[13],$lang['metarassen']['kt'])?></nobr></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><img src="<?php echo $bildpfad?>/icons/projektil.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['metarassen']['projektile']?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><?php echo $schiffwert[10]?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><img src="<?php echo $bildpfad?>/icons/mineral_2.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['metarassen']['rennurbin']?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><nobr><?php echo str_replace('{1}',$schiffwert[7],$lang['metarassen']['kt'])?></nobr></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><img src="<?php echo $bildpfad?>/icons/vorrat.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['metarassen']['fracht']?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><nobr><?php echo str_replace('{1}',$schiffwert[12],$lang['metarassen']['kt'])?></nobr></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><img src="<?php echo $bildpfad?>/icons/hangar.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['metarassen']['hangar']?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><?php echo $schiffwert[11]?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="1"></td>
                    <td><img src="<?php echo $bildpfad?>/icons/mineral_3.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['metarassen']['vomisaan']?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><nobr><?php echo str_replace('{1}',$schiffwert[8],$lang['metarassen']['kt'])?></nobr></td>
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
            ?>
        </table>
        </div>
        <?php
    }
    include ("inc.footer.php");
}
