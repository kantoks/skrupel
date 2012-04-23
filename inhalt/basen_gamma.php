<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'basen_gamma';
$fuid = int_get('fu');
$baid = int_get('baid');

if ($fuid==1) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_sternenbasen where besitzer=$spieler and status=1 and id=$baid");
    $array = @mysql_fetch_array($zeiger);
    $schiffbau_status=$array["schiffbau_status"];
    $art=$array["art"];
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" scroll="auto" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" cellspacing="0" cellpadding="0" height="100%">
                <tr>
                    <td>
                        <?php
                        if ($schiffbau_status==0) {
                            $zeiger = @mysql_query("SELECT * FROM $skrupel_huellen where baid=$baid order by klasse_name");
                            $huellenanzahl = @mysql_num_rows($zeiger);
                            if ($huellenanzahl>=1) {
                                ?>
                                <center>
                                    <form name="formular" method="post" action="basen_gamma.php?fu=<?php if ($art==3) { echo '6'; } else { echo '2'; } ?>&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>">
                                        <br>
                                        <?php echo $lang['basengamma']['ruempfeimlager']; ?>
                                        <br><br>
                                        <?php 
                                        if ($art!=3) { 
                                            ?>
                                            <input type="hidden" name="zusatz" value="0">
                                            <?php
                                        }
                                        ?>
                                        <select name="rumpf" style="width:230px;">
                                            <?php
                                            for  ($i=0; $i<$huellenanzahl;$i++) {
                                                $ok = @mysql_data_seek($zeiger,$i);
                                                $array = @mysql_fetch_array($zeiger);
                                                $id=$array["id"];
                                                $klasse_name=$array["klasse_name"];
                                                echo "<option value='$id'>$klasse_name</option>";
                                            }
                                            ?>
                                        </select>
                                        <br><br>
                                        <input type='submit' name='los' value="<?php if ($art==3) {
                                                echo $lang['basengamma']['weiterzurzusatzmodulauswahl'];
                                            } else {
                                                echo $lang['basengamma']['weiterzurkomponentenauswahl'];
                                            }?>" style='width:230px;'>
                                        <br>
                                    </form>
                                </center>
                                <?php
                            } else { echo "<center>".$lang['basengamma']['keineruempfe']."</center>"; }
                        } else { echo "<center>".$lang['basengamma']['schiffinwerft']."</center>"; }
                        ?>
                    </td>
                </tr>
            </table>
        </center>
        <?php
    include ("inc.footer.php");
}
if ($fuid==2) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_sternenbasen where besitzer=$spieler and status=1 and id=$baid");
    $array = @mysql_fetch_array($zeiger);
    $baid=$array["id"];
    $name=$array["name"];
    $x_pos=$array["x_pos"];
    $y_pos=$array["y_pos"];
    $rasse=$array["rasse"];
    $planetid=$array["planetid"];
    $schaden=$array["schaden"];
    $t_huelle=$array["t_huelle"];
    $t_antrieb=$array["t_antrieb"];
    $t_energie=$array["t_energie"];
    $t_explosiv=$array["t_explosiv"];
    $defense=$array["defense"];
    $jaeger=$array["jaeger"];
    $art=$array["art"];
    $zusatz=int_post('zusatz');
    if ($art!=3) { $zusatz=0; }
    $vorrat_projektile_1=$array["vorrat_projektile_1"];
    $vorrat_projektile_2=$array["vorrat_projektile_2"];
    $vorrat_projektile_3=$array["vorrat_projektile_3"];
    $vorrat_projektile_4=$array["vorrat_projektile_4"];
    $vorrat_projektile_5=$array["vorrat_projektile_5"];
    $vorrat_projektile_6=$array["vorrat_projektile_6"];
    $vorrat_projektile_7=$array["vorrat_projektile_7"];
    $vorrat_projektile_8=$array["vorrat_projektile_8"];
    $vorrat_projektile_9=$array["vorrat_projektile_9"];
    $vorrat_projektile_10=$array["vorrat_projektile_10"];
    $vorrat_energetik_1=$array["vorrat_energetik_1"];
    $vorrat_energetik_2=$array["vorrat_energetik_2"];
    $vorrat_energetik_3=$array["vorrat_energetik_3"];
    $vorrat_energetik_4=$array["vorrat_energetik_4"];
    $vorrat_energetik_5=$array["vorrat_energetik_5"];
    $vorrat_energetik_6=$array["vorrat_energetik_6"];
    $vorrat_energetik_7=$array["vorrat_energetik_7"];
    $vorrat_energetik_8=$array["vorrat_energetik_8"];
    $vorrat_energetik_9=$array["vorrat_energetik_9"];
    $vorrat_energetik_10=$array["vorrat_energetik_10"];
    $vorrat_antrieb_1=$array["vorrat_antrieb_1"];
    $vorrat_antrieb_2=$array["vorrat_antrieb_2"];
    $vorrat_antrieb_3=$array["vorrat_antrieb_3"];
    $vorrat_antrieb_4=$array["vorrat_antrieb_4"];
    $vorrat_antrieb_5=$array["vorrat_antrieb_5"];
    $vorrat_antrieb_6=$array["vorrat_antrieb_6"];
    $vorrat_antrieb_7=$array["vorrat_antrieb_7"];
    $vorrat_antrieb_8=$array["vorrat_antrieb_8"];
    $vorrat_antrieb_9=$array["vorrat_antrieb_9"];
    $huellenid=int_post('rumpf');
    $zeiger2 = @mysql_query("SELECT * FROM $skrupel_huellen where id=$huellenid");
    $array2 = @mysql_fetch_array($zeiger2);
    $hid=$array2["id"];
    $noetig_antriebe=$array2["antriebe"];
    $noetig_energetik=$array2["energetik"];
    $noetig_projektile=$array2["projektile"];
    $ok=1;
    //natives liefern baumaterial anfang
    $zeiger2 = @mysql_query("SELECT native_fert,native_kol FROM $skrupel_planeten where besitzer=$spieler and id=$planetid");
    $array2 = @mysql_fetch_array($zeiger2);
    $native_fert=$array2["native_fert"];
    $native_kol=$array2["native_kol"];
    if ($native_kol>0){
      $native_fert_material=@intval(substr($native_fert,28,1));
    }else{
      $native_fert_material=0;
    }
    switch($native_fert_material) {
    case 1:
        $vorrat_antrieb_1=10;
        break;
    case 2:
        $vorrat_energetik_1=10;
        break;
    case 3:
        $vorrat_projektile_1=10;
        break;
    case 4:
        $vorrat_antrieb_2=10;
        break;
    case 5:
        $vorrat_energetik_2=10;
        break;
    case 6:
        $vorrat_projektile_2=10;
        break;
    case 7:
        $vorrat_antrieb_3=10;
        break;
    case 8:
        $vorrat_energetik_3=10;
        break;
    case 9:
        $vorrat_projektile_3=10;
        break;
    }
    //natives liefern baumaterial ende
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" scroll="auto" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <script language="JavaScript">
            function check() {
                if(document.formular.schiffsname.value == "")  {
                    alert("<?php echo html_entity_decode($lang['basengamma']['nameneingeben']); ?>");
                    document.formular.schiffsname.focus();
                    return false;
                }
                return true;
            }
        </script>
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td colspan="9"><img src="../bilder/empty.gif" border="0" width="10" height="7"></td>
                </tr>
                <tr>
                    <td><form name="formular"  method="post" action="basen_gamma.php?fu=3&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" onSubmit="return check();"></td>
                    <td colspan="7">
                        <center><?php echo $lang['basengamma']['komponentenfestlegen']; ?></center>
                        <input type="hidden" name="zusatz" value="<?php echo $zusatz; ?>"></td>
                    <td></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="17" height="5"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="5"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="150" height="5"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="5"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="17" height="5"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="5"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="150" height="5"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
                </tr>
                <tr>
                    <td colspan="9">
                        <table border="0" cellspacing="0" cellpadding="0" width="100%">
                            <tr>
                                <td><?php echo $lang['basengamma']['schiffsname']?></td>
                                <td align=right><input type="text" name="schiffsname" class="eingabe" style="width:285px;" autocomplete="off"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="9"><img src="../bilder/empty.gif" border="0" width="10" height="8"></td>
                </tr>
                <tr>
                    <td><input type="hidden" name="rumpf" value="<?php echo $huellenid; ?>"></td>
                    <td><img src="<?php echo $bildpfad; ?>/icons/laser.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="20"></td>
                    <?php
                    if ($noetig_energetik>=1) {
                        if (($vorrat_energetik_1>=$noetig_energetik) or
                            ($vorrat_energetik_2>=$noetig_energetik) or
                            ($vorrat_energetik_3>=$noetig_energetik) or
                            ($vorrat_energetik_4>=$noetig_energetik) or
                            ($vorrat_energetik_5>=$noetig_energetik) or
                            ($vorrat_energetik_6>=$noetig_energetik) or
                            ($vorrat_energetik_7>=$noetig_energetik) or
                            ($vorrat_energetik_8>=$noetig_energetik) or
                            ($vorrat_energetik_9>=$noetig_energetik) or
                            ($vorrat_energetik_10>=$noetig_energetik)
                        ){
                            ?>
                            <td>
                                <select name="energetik" style="width:150px">
                                    <?php
                                    if ($vorrat_energetik_1>=$noetig_energetik) { echo "<option value='1'>".$lang['basengamma']['waffen'][0]."</option>"; }
                                    if ($vorrat_energetik_2>=$noetig_energetik) { echo "<option value='2'>".$lang['basengamma']['waffen'][1]."</option>"; }
                                    if ($vorrat_energetik_3>=$noetig_energetik) { echo "<option value='3'>".$lang['basengamma']['waffen'][2]."</option>"; }
                                    if ($vorrat_energetik_4>=$noetig_energetik) { echo "<option value='4'>".$lang['basengamma']['waffen'][3]."</option>"; }
                                    if ($vorrat_energetik_5>=$noetig_energetik) { echo "<option value='5'>".$lang['basengamma']['waffen'][4]."</option>"; }
                                    if ($vorrat_energetik_6>=$noetig_energetik) { echo "<option value='6'>".$lang['basengamma']['waffen'][5]."</option>"; }
                                    if ($vorrat_energetik_7>=$noetig_energetik) { echo "<option value='7'>".$lang['basengamma']['waffen'][6]."</option>"; }
                                    if ($vorrat_energetik_8>=$noetig_energetik) { echo "<option value='8'>".$lang['basengamma']['waffen'][7]."</option>"; }
                                    if ($vorrat_energetik_9>=$noetig_energetik) { echo "<option value='9'>".$lang['basengamma']['waffen'][8]."</option>"; }
                                    if ($vorrat_energetik_10>=$noetig_energetik) { echo "<option value='10'>".$lang['basengamma']['waffen'][9]."</option>"; }
                                    ?>
                                </select>
                            </td>
                            <?php
                        } else { 
                            $ok=0;
                            ?>
                            <td style='color:#990000;'><nobr><?php echo $noetig_energetik; ?> <?php echo $lang['basengamma']['werdenbenoetigt']; ?></nobr></td>
                            <?php
                        }
                    } else {
                        ?>
                        <td><nobr><?php echo $lang['basengamma']['wirdnichtbenoetigt']; ?></nobr></td>
                        <?php
                    }
                    ?>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="20"></td>
                    <td><img src="<?php echo $bildpfad; ?>/icons/antrieb.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="20"></td>
                    <?php
                    if ($noetig_antriebe>=1) {
                        if (($vorrat_antrieb_1>=$noetig_antriebe) or
                            ($vorrat_antrieb_2>=$noetig_antriebe) or
                            ($vorrat_antrieb_3>=$noetig_antriebe) or
                            ($vorrat_antrieb_4>=$noetig_antriebe) or
                            ($vorrat_antrieb_5>=$noetig_antriebe) or
                            ($vorrat_antrieb_6>=$noetig_antriebe) or
                            ($vorrat_antrieb_7>=$noetig_antriebe) or
                            ($vorrat_antrieb_8>=$noetig_antriebe) or
                            ($vorrat_antrieb_9>=$noetig_antriebe)
                        ){
                            ?>
                            <td>
                                <select name="antriebe" style="width:150px">
                                    <?php
                                    if ($vorrat_antrieb_1>=$noetig_antriebe) { echo "<option value='1'>".$lang['basengamma']['antriebe'][0]."</option>"; }
                                    if ($vorrat_antrieb_2>=$noetig_antriebe) { echo "<option value='2'>".$lang['basengamma']['antriebe'][1]."</option>"; }
                                    if ($vorrat_antrieb_3>=$noetig_antriebe) { echo "<option value='3'>".$lang['basengamma']['antriebe'][2]."</option>"; }
                                    if ($vorrat_antrieb_4>=$noetig_antriebe) { echo "<option value='4'>".$lang['basengamma']['antriebe'][3]."</option>"; }
                                    if ($vorrat_antrieb_5>=$noetig_antriebe) { echo "<option value='5'>".$lang['basengamma']['antriebe'][4]."</option>"; }
                                    if ($vorrat_antrieb_6>=$noetig_antriebe) { echo "<option value='6'>".$lang['basengamma']['antriebe'][5]."</option>"; }
                                    if ($vorrat_antrieb_7>=$noetig_antriebe) { echo "<option value='7'>".$lang['basengamma']['antriebe'][6]."</option>"; }
                                    if ($vorrat_antrieb_8>=$noetig_antriebe) { echo "<option value='8'>".$lang['basengamma']['antriebe'][7]."</option>"; }
                                    if ($vorrat_antrieb_9>=$noetig_antriebe) { echo "<option value='9'>".$lang['basengamma']['antriebe'][8]."</option>"; }
                                    ?>
                                </select>
                            </td>
                            <?php
                        } else {
                            $ok=0;
                            ?>
                            <td style='color:#990000;'><nobr><?php echo $noetig_antriebe; ?> <?php echo $lang['basengamma']['werdenbenoetigt']; ?></nobr></td>
                            <?php
                        }
                    } else {
                        ?>
                        <td><nobr><?php echo $lang['basengamma']['wirdnichtbenoetigt']; ?></nobr></td>
                        <?php
                    }
                    ?>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="9"><img src="../bilder/empty.gif" border="0" width="10" height="8"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><img src="<?php echo $bildpfad; ?>/icons/projektil.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="20"></td>
                    <?php
                    if ($noetig_projektile>=1) {
                        if (($vorrat_projektile_1>=$noetig_projektile) or
                            ($vorrat_projektile_2>=$noetig_projektile) or
                            ($vorrat_projektile_3>=$noetig_projektile) or
                            ($vorrat_projektile_4>=$noetig_projektile) or
                            ($vorrat_projektile_5>=$noetig_projektile) or
                            ($vorrat_projektile_6>=$noetig_projektile) or
                            ($vorrat_projektile_7>=$noetig_projektile) or
                            ($vorrat_projektile_8>=$noetig_projektile) or
                            ($vorrat_projektile_9>=$noetig_projektile) or
                            ($vorrat_projektile_10>=$noetig_projektile)
                        ){
                            ?>
                            <td>
                                <select name="projektile" style="width:150px">
                                    <?php
                                    if ($vorrat_projektile_1>=$noetig_projektile) { echo "<option value='1'>".$lang['basengamma']['waffen'][10]."</option>"; }
                                    if ($vorrat_projektile_2>=$noetig_projektile) { echo "<option value='2'>".$lang['basengamma']['waffen'][11]."</option>"; }
                                    if ($vorrat_projektile_3>=$noetig_projektile) { echo "<option value='3'>".$lang['basengamma']['waffen'][12]."</option>"; }
                                    if ($vorrat_projektile_4>=$noetig_projektile) { echo "<option value='4'>".$lang['basengamma']['waffen'][13]."</option>"; }
                                    if ($vorrat_projektile_5>=$noetig_projektile) { echo "<option value='5'>".$lang['basengamma']['waffen'][14]."</option>"; }
                                    if ($vorrat_projektile_6>=$noetig_projektile) { echo "<option value='6'>".$lang['basengamma']['waffen'][15]."</option>"; }
                                    if ($vorrat_projektile_7>=$noetig_projektile) { echo "<option value='7'>".$lang['basengamma']['waffen'][16]."</option>"; }
                                    if ($vorrat_projektile_8>=$noetig_projektile) { echo "<option value='8'>".$lang['basengamma']['waffen'][17]."</option>"; }
                                    if ($vorrat_projektile_9>=$noetig_projektile) { echo "<option value='9'>".$lang['basengamma']['waffen'][18]."</option>"; }
                                    if ($vorrat_projektile_10>=$noetig_projektile) { echo "<option value='10'>".$lang['basengamma']['waffen'][19]."</option>"; }
                                    ?>
                                </select>
                            </td>
                            <?php
                        } else {
                            $ok=0;
                            ?>
                            <td style='color:#990000;'><nobr><?php echo $noetig_projektile; ?> <?php echo $lang['basengamma']['werdenbenoetigt']; ?></nobr></td>
                            <?php
                        }
                    } else {
                        ?>
                        <td><nobr><?php echo $lang['basengamma']['wirdnichtbenoetigt']; ?></nobr></td>
                        <?php
                    }
                    ?>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="20"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="10" height="20"></td>
                    <?php
                    if ($ok==1) {
                        ?>
                        <td><input type="submit" value="<?php echo $lang['basengamma']['schiffbauen']; ?>" name="bla" style="width:150px"></td>
                        <?php
                    } else {
                        ?>
                        <td><input type="button" value="<?php echo $lang['basengamma']['baunichtmoeglich']; ?>" class="nofunc" name="bla" style="width:150px"></td>
                        <?php
                    }
                    ?>
                    <td></form></td>
                </tr>
            </table>
        </center>
        <?php
    include ("inc.footer.php");
}
if ($fuid==3) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_sternenbasen where besitzer=$spieler and status=1 and id=$baid");
    $array = @mysql_fetch_array($zeiger);
    $baid=$array["id"];
    $name=$array["name"];
    $x_pos=$array["x_pos"];
    $y_pos=$array["y_pos"];
    $rasse=$array["rasse"];
    $planetid=$array["planetid"];
    $schaden=$array["schaden"];
    $t_huelle=$array["t_huelle"];
    $t_antrieb=$array["t_antrieb"];
    $t_energie=$array["t_energie"];
    $t_explosiv=$array["t_explosiv"];
    $defense=$array["defense"];
    $jaeger=$array["jaeger"];
    $art=$array["art"];
    //natives liefern baumaterial anfang   
    $zeiger2 = @mysql_query("SELECT native_fert,native_kol FROM $skrupel_planeten where besitzer=$spieler and id=$planetid");
    $array2 = @mysql_fetch_array($zeiger2);
    $native_fert=$array2["native_fert"];
    $native_kol=$array2["native_kol"];
    if ($native_kol>0){
      $native_fert_material=@intval(substr($native_fert,28,1));
    }else{
      $native_fert_material=0;
    }
    //natives liefern baumaterial ende
    $antriebestufe=int_post('antriebe');
    $projektilestufe=int_post('projektile');
    $energetikstufe=int_post('energetik');
    $schiffsname=str_post('schiffsname','SQLSAFE');
    $zusatz=int_post('zusatz');
    //$schiffsname=str_replace("'"," ",$schiffsname);
    //$schiffsname=str_replace('"'," ",$schiffsname);
    if ($art!=3) { $zusatz=0; }
    if ($projektilestufe>=1) {} else {$projektilestufe=0;}
    if ($energetikstufe>=1) {} else {$energetikstufe=0;}
    if ($antriebestufe>=1) {} else {$antriebestufe=0;}
    $huellenid=int_post('rumpf');
    $zeiger2 = @mysql_query("SELECT * FROM $skrupel_huellen where id=$huellenid");
    $array2 = @mysql_fetch_array($zeiger2);
    $hid=$array2["id"];
    $noetig_antriebe=$array2["antriebe"];
    $noetig_energetik=$array2["energetik"];
    $noetig_projektile=$array2["projektile"];
    $klasse=$array2["klasse"];
    $bild_gross=$array2["bild_gross"];
    $bild_klein=$array2["bild_klein"];
    $crew=$array2["crew"];
    $masse=$array2["masse"];
    $tank=$array2["tank"];
    $fracht=$array2["fracht"];
    $hangar=$array2["hangar"];
    $klasse_name=$array2["klasse_name"];
    $rasse=$array2["rasse"];
    $fertigkeiten=$array2["fertigkeiten"];
    $techlevel=$array2["techlevel"];
    if ($antriebestufe==9) {$fracht=floor($fracht/2);}
    if ($zusatz==4) {$fracht=floor($fracht*1.19);}
    $zeiger_temp = @mysql_query("Update $skrupel_sternenbasen set schiffbau_zusatz=$zusatz,schiffbau_status=1,schiffbau_klasse=$klasse,schiffbau_bild_gross='$bild_gross',schiffbau_bild_klein='$bild_klein',schiffbau_crew=$crew,schiffbau_masse=$masse,schiffbau_tank=$tank, schiffbau_fracht=$fracht,schiffbau_antriebe=$noetig_antriebe,schiffbau_energetik=$noetig_energetik,schiffbau_projektile=$noetig_projektile,schiffbau_hangar=$hangar,schiffbau_klasse_name='$klasse_name',schiffbau_rasse='$rasse',schiffbau_fertigkeiten='$fertigkeiten',schiffbau_energetik_stufe=$energetikstufe,schiffbau_projektile_stufe=$projektilestufe,schiffbau_techlevel=$techlevel,schiffbau_antriebe_stufe=$antriebestufe,schiffbau_name='$schiffsname' where besitzer=$spieler and status=1 and id=$baid");
    if ($projektilestufe>=1) {} else {$projektilestufe=1;}
    if ($energetikstufe>=1) {} else {$energetikstufe=1;}
    if ($antriebestufe>=1) {} else {$antriebestufe=1;}
    //natives liefern baumaterial anfang
    switch($native_fert_material) {
      case 1:
        if ($antriebestufe==1) {$noetig_antriebe=0;}
      break;
      case 2:
        if ($energetikstufe==1) {$noetig_energetik=0;}
      break;
      case 3:
        if ($projektilstufe==1) {$noetig_projektile=0;}
      break;
      case 4:
        if ($antriebestufe==2) {$noetig_antriebe=0;}
      break;
      case 5:
        if ($energetikstufe==2) {$noetig_energetik=0;}
      break;
      case 6:
        if ($projektilstufe==2) {$noetig_projektile=0;}
      break;
      case 7:
        if ($antriebestufe==3) {$noetig_antriebe=0;}
      break;
      case 8:
        if ($energetikstufe==3) {$noetig_energetik=0;}
      break;
      case 9:
        if ($projektilstufe==3) {$noetig_projektile=0;}
      break;
    }
    //natives liefern baumaterial ende
    $spalte1="vorrat_antrieb_".$antriebestufe;
    $spalte2="vorrat_projektile_".$projektilestufe;
    $spalte3="vorrat_energetik_".$energetikstufe;
    $zeiger_temp = mysql_query("Update $skrupel_sternenbasen set $spalte1=$spalte1-$noetig_antriebe,$spalte2=$spalte2-$noetig_projektile,$spalte3=$spalte3-$noetig_energetik where besitzer=$spieler and status=1 and id=$baid");
    $zeiger_temp = mysql_query("DELETE FROM $skrupel_huellen where id=$huellenid");
    $message="<center>".$lang['basengamma']['auftragerflogreich']."</center>";
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" scroll="auto" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <br><br><br>
        <?php echo $message;
    include ("inc.footer.php");
}
if ($fuid==4) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT id,logbuch FROM $skrupel_sternenbasen where id=$baid");
    $array = @mysql_fetch_array($zeiger);
    $logbuch=$array["logbuch"];
    //$logbuch=str_replace("\\", "",$logbuch);
    ?>
    <body text="#000000" background="<?php echo $bildpfad; ?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0"">
        <center>
            <table border="0" cellspacing="0" cellpadding="1">
                <tr>
                    <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="2"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                    <td><center><?php echo $lang['basengamma']['logbuch']; ?></center></td>
                    <td><a href="javascript:hilfe(32);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                </tr>
            </table>
        </center>
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><form name="formular"  method="post" action="basen_gamma.php?fu=5&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                    <td><textarea style="width:390px;height:59px;" name="logbuchdaten"><?php echo $logbuch; ?></textarea></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="<?php echo $lang['basengamma']['eintragsichern']; ?>" style="width:390px;" name="submitbutton"></td>
                    <td></form></td>
                </tr>
            </table>
        </center>
        <?php
    include ("inc.footer.php");
}
if ($fuid==5) {
    include ("inc.header.php");
    $eintrag=str_post('logbuchdaten','SQLSAFE');
    //$eintrag=str_replace("\"", "\'",$eintrag);
    //$eintrag=str_replace("\\", "",$eintrag);
    $zeiger = @mysql_query("UPDATE $skrupel_sternenbasen set logbuch=\"$eintrag\" where id=$baid");
    ?>
    <body text="#000000" background="<?php echo $bildpfad; ?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0"">
        <br><br><br><br>
            <center><?php echo $lang['basengamma']['logbucherfolgreich']; ?></center>
        <?php
    include ("inc.footer.php");
}
if ($fuid==6) {
    include ("inc.header.php");
    $zeiger = @mysql_query("SELECT * FROM $skrupel_sternenbasen where besitzer=$spieler and status=1 and id=$baid");
    $array = @mysql_fetch_array($zeiger);
    $art=$array["art"];
    $huellenid=int_post('rumpf');
    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" scroll="auto" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" cellspacing="0" cellpadding="0" height="100%">
                <tr>
                    <td>
                        <center><form name="formular" method="post" action="basen_gamma.php?fu=2&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>">
                            <br>
                            <?php echo $lang['basengamma']['zusatzmodule']; ?>
                            <br><br>
                            <input type="hidden" name="rumpf" value="<?php echo $huellenid; ?>">
                            <select name="zusatz" style="width:230px;">
                                <?php
                                for ($n=0;$n<10;$n++) {
                                    ?>
                                    <option value='<?php echo $n; ?>'><?php echo $lang['basengamma']['zusatzm'][$n]; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <br>
                            <input type='submit' name='los' value='<?php echo $lang['basengamma']['weiterzurkomponentenauswahl']; ?>' style='width:230px;'>
                            <br>
                            </form>
                        </center>
                    </td>
                </tr>
            </table>
        </center>
        <?php
    include ("inc.footer.php");
}
