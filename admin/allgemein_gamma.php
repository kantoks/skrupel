<?php 
require_once ('../inc.conf.php'); 
require_once (../inhalt/'inc.hilfsfunktionen.php');
include ("../lang/".$language."/lang.admin.allgemein_gamma.php");
$fuid = int_get('fu');

$erweiterung[0]['name']='Movie-GIF';
$erweiterung[0]['ordner']='moviegif';
$erweiterung[0]['autor']='Skrupel.de';
$erweiterung[0]['activate']=1;
$erweiterung[0]['activatepos']=0;
$erweiterung[1]['name']='RSS';
$erweiterung[1]['ordner']='rss';
$erweiterung[1]['autor']='JANNiS und bansa.de';
$erweiterung[1]['activate']=0;
$erweiterung[1]['activatepos']=0;
$erweiterung[2]['name']='KI';
$erweiterung[2]['ordner']='ki';
$erweiterung[2]['autor']='Wasserleiche';
$erweiterung[2]['activate']=1;
$erweiterung[2]['activatepos']=1;
$erweiterung[3]['name']='XStats';
$erweiterung[3]['ordner']='xstats';
$erweiterung[3]['autor']='Stefan Heller';
$erweiterung[3]['activate']=1;
$erweiterung[3]['activatepos']=2;

if ($fuid==1) {
    include ("inc.header.php");
    if (($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)) {
        $zeiger = @mysql_query("SELECT extend FROM $skrupel_info");
        $array = @mysql_fetch_array($zeiger);
        $spiel_extend=$array["extend"];
        ?>
        <body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <center>
                <table border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)"><?php echo $lang['admin']['allgemein']['gamma']['erweiterung']?></td>
                    </tr>
                </table>
            </center>
            <table border="0" cellspacing="0" cellpadding="5">
                <tr>
                    <td style="color:#aaaaaa;"><?php echo $lang['admin']['allgemein']['gamma']['name']?></td>
                    <td style="color:#aaaaaa;"><center><?php echo $lang['admin']['allgemein']['gamma']['ordner']?></center></td>
                    <td style="color:#aaaaaa;"><center><nobr><?php echo $lang['admin']['allgemein']['gamma']['autor']?></nobr></center></td>
                    <td style="color:#aaaaaa;"><?php echo $lang['admin']['allgemein']['gamma']['beschreibung']?></td>
                    <td><img src="../bilder/empty.gif" height="22" width="1"></td>
                </tr>
                <?php foreach($erweiterung as $ext) { ?>
                    <tr>
                        <td valign="top"><nobr> <?php echo $ext['name']; ?></nobr></td>
                        <td valign="top" style="color:#c9c9c9;"> <?php echo $ext['ordner']; ?></td>
                        <td valign="top" style="color:#c9c9c9;"><nobr> <?php echo $ext['autor']; ?></nobr></td>
                        <td valign="top" style="color:#c9c9c9;" width="100%"> <?php echo $ext['beschreibung']; ?></td>
                        <td valign="top"><nobr> <?php
                            if (@file_exists('../extend/'.$ext['ordner'])) {
                                if ($ext['activate']==1) {
                                    if (@intval(substr($spiel_extend,$ext['activatepos'],1))==1) {
                                        echo $lang['admin']['allgemein']['gamma']['aktiviert']; 
                                        ?>
                                            <br><br><form name="formular" method="post" action="allgemein_gamma.php?fu=2&pos=<?php echo $ext['activatepos']; ?>&value=0"><input type='submit' value='<?php echo $lang['admin']['allgemein']['gamma']['deaktivieren']?>' class='button'></form>
                                        <?php
                                    } else {
                                        echo $lang['admin']['allgemein']['gamma']['n_aktiviert'];
                                        ?>
                                            <br><br><form name="formular" method="post" action="allgemein_gamma.php?fu=2&pos=<?php echo $ext['activatepos']; ?>&value=1"><input type='submit' value='<?php echo $lang['admin']['allgemein']['gamma']['aktivieren']?>' class='button'></form>
                                        <?php
                                    }
                                } else {  echo $lang['admin']['allgemein']['gamma']['vorhanden'];  }
                            } else { echo $lang['admin']['allgemein']['gamma']['n_vorhanden']; }
                            ?>
                        </nobr></td>
                    </tr>
                <?php } ?>
            </table>
            <?php
    }
    include ("inc.footer.php");
}
if ($fuid==2) {
    include ("inc.header.php");
    if (($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)) {
        $value=int_get('value');
        $pos=int_get('pos');
        $zeiger = @mysql_query("SELECT extend FROM $skrupel_info");
        $array = @mysql_fetch_array($zeiger);
        $spiel_extend=$array["extend"];
        $extend='';
        for ($n=0;$n<50;$n++) {
            if ($pos==$n) {
                if ($value=='1') {
                    $extend.='1';
                } else {
                    $extend.='0';
                }
            } else {
                if (@intval(substr($spiel_extend,$n,1))==1) {
                    $extend.='1';
                } else {
                    $extend.='0';
                }
            }
        }
        $zeiger = @mysql_query("update $skrupel_info set extend='$extend'");
        ?>
        <body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <center>
                <table border="0" height="100%" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <?php echo $lang['admin']['allgemein']['gamma']['aktualisiert']?>
                            <br><br><br>
                            <center>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td><form name="formular"  method="post" action="allgemein_gamma.php?fu=1"></td>
                                        <td><input type="submit" name="bla" value="<?php echo $lang['admin']['allgemein']['gamma']['zurueck']?>"></td>
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
