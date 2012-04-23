<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'flotte_delta';
$fuid = int_get('fu');
$shid = int_get('shid');

if ($fuid==1) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_schiffe where id=$shid");
    $array = @mysql_fetch_array($zeiger);
    $projektile=$array["projektile"];
    $projektile_auto=$array["projektile_auto"];
    $projektile_stufe=$array["projektile_stufe"];
    $projektile_anzahl=$array["projektile_anzahl"];
    $fracht_cantox=$array["fracht_cantox"];
    $fracht_min1=$array["fracht_min1"];
    $fracht_min2=$array["fracht_min2"];
    $zusatzmodul=$array["zusatzmodul"];
    $max=$projektile_anzahl*5;
    if ($zusatzmodul==3) { $max=round($max*1.5); }
    $max_bau=$max-$projektile;
    $max_cantox=floor($fracht_cantox/35);
    if ($max_cantox<$max_bau) {$max_bau=$max_cantox;}
    $max_min1=floor($fracht_min1/2);
    if ($max_min1<$max_bau) {$max_bau=$max_min1;}
    if ($fracht_min2<$max_bau) {$max_bau=$fracht_min2;}
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" cellspacing="0" cellpadding="1">
                <tr>
                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="7"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                    <td><center><?php echo $lang['flottedelta']['projektile']; ?></center></td>
                    <td><a href="javascript:hilfe(35);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                </tr>
                <tr>
                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="3"></td>
                </tr>
            </table>
        </center>
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/projektil.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottedelta']['vorhanden']; ?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['flottedelta']['maximal']; ?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="3" height="1"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                    <td><?php echo $projektile; ?></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                    <td><?php echo $max; ?></td>
                </tr>
                <tr>
                    <td colspan="7"><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                </tr>
            </table>
        </center>
        <?php
        if ($max_bau>=1) {
            ?>
            <center>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><form name="formular"  method="post" action="flotte_delta.php?fu=2&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td>
                            <select name="bau_auftrag" style="font-family:Verdana;font-size:9px;width:50px;">
                                <?php
                                for ($i=1;$i<=$max_bau;$i++) {
                                    ?>
                                    <option value=<?php echo $i; ?> <?php if ($i==$max_bau) echo "selected"; ?>><?php echo $i; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td><input type="submit" value="<?php echo $lang['flottedelta']['projektilebauen']; ?>" style="width:110px;"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                        <td></form></td>
                    </tr>
                    <tr>
                        <td colspan="7"><img src="../bilder/empty.gif" border="0" width="5" height="5"></td>
                    </tr>
                </table>
            </center>
            <?php
        }
        ?>
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><form name="formular"  method="post" action="flotte_delta.php?fu=3&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><input type="checkbox" name="auto" value="1" style="width:25px;" <?php if ($projektile_auto==1) { echo "checked"; }?>></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td><input type="submit" value="<?php echo $lang['flottedelta']['bauautomatisiert']; ?>" style="width:135px;"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                    <td></form></td>
                </tr>
            </table>
        </center>
        <?php
    include ("inc.footer.php");
}
if ($fuid==2) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_schiffe where id=$shid");
    $array = @mysql_fetch_array($zeiger);
    $projektile=$array["projektile"];
    $projektile_auto=$array["projektile_auto"];
    $projektile_stufe=$array["projektile_stufe"];
    $projektile_anzahl=$array["projektile_anzahl"];
    $zusatzmodul=$array["zusatzmodul"];
    $fracht_cantox=$array["fracht_cantox"];
    $fracht_min1=$array["fracht_min1"];
    $fracht_min2=$array["fracht_min2"];
    $max=$projektile_anzahl*5;
    if ($zusatzmodul==3) { $max=round($max*1.5); }
    $max_bau=$max-$projektile;
    $max_cantox=floor($fracht_cantox/35);
    if ($max_cantox<$max_bau) {$max_bau=$max_cantox;}
    $max_min1=floor($fracht_min1/2);
    if ($max_min1<$max_bau) {$max_bau=$max_min1;}
    if ($fracht_min2<$max_bau) {$max_bau=$fracht_min2;}
    $bau=int_post('bau_auftrag');
    if ($max_bau<$bau) {$bau=$max_bau;}
    $projektile=$projektile+$bau;
    $fracht_cantox=$fracht_cantox-($bau*35);
    $fracht_min1=$fracht_min1-($bau*2);
    $fracht_min2=$fracht_min2-$bau;
    $zeiger_temp = @mysql_query("UPDATE $skrupel_schiffe set projektile=$projektile,fracht_cantox=$fracht_cantox,fracht_min1=$fracht_min1,fracht_min2=$fracht_min2 where id=$shid");
    ?>
    <body text="#000000" background="<?php echo $bildpfad; ?>/aufbau/14.gif" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <script language=JavaScript>
            parent.ship.window.location='flotte.php?fu=3&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>';
        </script>
        <br><br><br><br>
        <center><?php echo $lang['flottedelta']['projektileerfolgreich']; ?></center>
        <?php
    include ("inc.footer.php");
}
if ($fuid==3) {
    include ("inc.header.php");
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" scroll="no" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php
        if (int_post('auto')==1) { 
            $auto_projektile=1;$message="<center>".$lang['flottedelta']['autoaktiviert']."</center>";
        } else {
            $auto_projektile=0;$message="<center>".$lang['flottedelta']['autodeaktiviert']."</center>";
        }
        $zeiger = @mysql_query("update $skrupel_schiffe set projektile_auto=$auto_projektile where id=$shid and besitzer=$spieler");
        ?>
        <br><br><br><br>
        <?php 
        echo $message;
    include ("inc.footer.php");
}
if ($fuid==4) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_schiffe where id=$shid");
    $array = @mysql_fetch_array($zeiger);
    $antrieb=$array["antrieb"];
    $antrieb_anzahl=$array["antrieb_anzahl"];
    $zusatzmodul=$array["zusatzmodul"];
    $antrieb_name=$lang['flottedelta']['antriebe'][$antrieb-1];
    ?>
    <body text="#000000" background="<?php echo $bildpfad; ?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" cellspacing="0" cellpadding="1">
                <tr>
                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="8"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                    <td><center><?php echo $lang['flottedelta']['antriebssysteme']; ?></center></td>
                    <td><a href="javascript:hilfe(11);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                </tr>
                <tr>
                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="7"></td>
                </tr>
            </table>
        </center>
        <center>
            <table border="0" cellspacing="0" cellpadding="2">
                <tr>
                    <td style="color:#aaaaaa;"><?php echo $lang['flottedelta']['antriebsart']; ?></td>
                    <td><?php echo $antrieb_name; ?></td>
                </tr>
                <tr>
                    <td style="color:#aaaaaa;"><?php echo $lang['flottedelta']['anzahltriebwerke']; ?></td>
                    <td><?php echo $antrieb_anzahl; ?></td>
                </tr>
                <tr>
                    <td style="color:#aaaaaa;"><?php echo $lang['flottedelta']['maximalegeschwindigkeit']; ?></td>
                    <td><?php echo str_replace('{1}',$antrieb,$lang['flottedelta']['warp']);?></td>
                </tr>
                <?php
                if ($zusatzmodul>=1) {
                    ?>
                    <tr>
                        <td style="color:#aaaaaa;"><?php echo $lang['flottedelta']['zusatzmodul']; ?></td>
                        <td><?php echo $lang['flottedelta']['zusatzm'][$zusatzmodul]; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </center>
        <?php
    include ("inc.footer.php");
}
if ($fuid==5) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT id,name,ordner FROM $skrupel_schiffe where id=$shid");
    $array = @mysql_fetch_array($zeiger);
    $name=$array["name"];
    $ordner=$array["ordner"];
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" cellspacing="0" cellpadding="1">
                <tr>
                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="7"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                    <td><center><?php echo $lang['flottedelta']['optionen']; ?></center></td>
                    <td><a href="javascript:hilfe(37);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                </tr>
            </table>
        </center>
        <center>
            <table border="0" cellspacing="0" cellpadding="1">
                <tr>
                    <td><form name="formular" method="post" action="flotte_delta.php?fu=6&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                    <td><?php echo $lang['flottedelta']['schiffsname']; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="text" class="eingabe" name="schiffname" style="width:250px;" maxlength="25" value="<?php echo $name; ?>"></td>
                    <td>&nbsp;<input type="submit" style="width:90px;" value="<?php echo $lang['flottedelta']['aendern']; ?>"></td>
                    <td></form></td>
                </tr>
                <tr>
                    <td><form name="formular" method="post" action="flotte_delta.php?fu=7&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                    <td><?php echo $lang['flottedelta']['flottenordner']; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <select name="oid" style="width:250px;">
                            <option value="0"><?php echo $lang['flottedelta']['rootordner']; ?></option>
                            <?php
                            $zeiger2 = @mysql_query("SELECT * FROM $skrupel_ordner where besitzer=$spieler and spiel=$spiel order by name");
                            $ordneranzahl = @mysql_num_rows($zeiger2);
                            if ($ordneranzahl>=1) {
                                for  ($i2=0; $i2<$ordneranzahl;$i2++) {
                                    $ok2 = @mysql_data_seek($zeiger2,$i2);
                                    $array2 = @mysql_fetch_array($zeiger2);
                                    $ooid=$array2["id"];
                                    $oname=$array2["name"];
                                    $oname=stripslashes($oname);
                                    ?>
                                    <option value="<?php echo $ooid?>" <?php if ($ordner==$ooid) { echo "selected";}?>><?php echo$oname ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td>&nbsp;<input type="submit" style="width:90px;" value="<?php echo $lang['flottedelta']['verschieben']; ?>"></td>
                    <td></form></td>
                </tr>
            </table>
        </center>
        <?php
    include ("inc.footer.php");
}
if ($fuid==6) {
    include ("inc.header.php");
    $zeiger = @mysql_query("UPDATE $skrupel_schiffe set name=\"".str_post('schiffname','SQLSAFE')."\" where id=$shid and besitzer=$spieler");
    ?>
    <body text="#000000" background="<?php echo $bildpfad; ?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <br><br><br><br>
        <center><?php echo $lang['flottedelta']['uebernommen']?></center>
        <script language=JavaScript>
            parent.ship.window.location='flotte.php?fu=3&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>';
        </script>
        <?php
    include ("inc.footer.php");
}
if ($fuid==7) {
    include ("inc.header.php");
    $zeiger = @mysql_query("UPDATE $skrupel_schiffe set ordner=\"".int_post('oid')."\" where ((id=$shid) or ((zielid=$shid) and (flug=4))) and besitzer=$spieler");
    ?>
    <body text="#000000" background="<?php echo $bildpfad; ?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <br><br><br><br>
        <center><?php echo $lang['flottedelta']['uebernommen']?></center>
        <script language=JavaScript>
            parent.pfeillinks.window.location='flotte.php?fu=7&oid=<?php echo int_post('oid'); ?>&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>';
            parent.pfeilrechts.window.location='flotte.php?fu=8&oid=<?php echo int_post('oid'); ?>&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>';
            parent.ship.window.location='flotte.php?fu=3&shid=<?php echo $shid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>';
        </script>
        <?php
    include ("inc.footer.php");
}
