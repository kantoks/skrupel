<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'meta_fordner';
$fuid = int_get('fu');

if ($fuid==1) {
    include ("inc.header.php");
    ?>
    <body text="#000000" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
            <center><img src="../lang/<?php echo $spieler_sprache?>/topics/flottenordner.gif" border="0" width="242" height="52"></center>
            <center>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="30" height="1"></td>
                        <td style="color:#aaaaaa;"><center><?php echo $lang['metafordner']['erklaerung']?></center></td>
                        <td><img src="../bilder/empty.gif" border="0" width="30" height="1"></td>
                    </tr>
                </table>
            </center>
            <br><br>
            <center>
                <table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                        <td><form name="formular" method="post" action="meta_fordner.php?fu=2&uid=<?php echo $uid?>&sid=<?php echo $sid?>"></td>
                        <td colspan="2"><?php echo $lang['metafordner']['ordneranlegen']?></td>
                        <td></td>
                    </tr>
                     <tr>
                        <td></td>
                        <td><input type="text" name="ordnerneu" maxlength="10" style="width:90px;" class="eingabe"></td>
                        <td align="right"><input type="submit" value="<?php echo $lang['metafordner']['ok']?>" style="width:30px;" class="button"></td>
                        <td></form></td>
                    </tr>
                </table>
            </center>
            <br><br>
            <center>
                <table border="0" cellspacing="0" cellpadding="3">
                    <?php
                    $total=0;
                    $zeiger5 = @mysql_query("SELECT count(*) as total FROM $skrupel_schiffe where besitzer=$spieler and spiel=$spiel and ordner=0");
                    $array5 = @mysql_fetch_array($zeiger5);
                    $total=$array5["total"];
                    ?>
                    <tr>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0" background="<?php echo $bildpfad?>/menu/flotte_ordner.gif">
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="1" height="15"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="98" height="1"></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="1" height="15"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" border="0" width="1" height="58"></td>
                                    <td style="filter:glow(color=#000000, strenght=#1);" valign="top"><center><?php echo $lang['metafordner']['rootordner']?><br><?php echo $total?></center></td>
                                    <td><img src="../bilder/empty.gif" border="0" width="1" height="58"></td>
                                </tr>
                            </table>
                        </td>
                        <td colspan="2" style="color:#aaaaaa;"><center><?php echo $lang['metafordner']['rootnicht']?></center></td>
                    </tr>
                    <?php
                    $zeiger2 = @mysql_query("SELECT * FROM $skrupel_ordner where besitzer=$spieler and spiel=$spiel order by name");
                    $ordneranzahl = @mysql_num_rows($zeiger2);
                    if ($ordneranzahl>=1) {
                        for ($i2=0; $i2<$ordneranzahl;$i2++) {
                            $ok2 = @mysql_data_seek($zeiger2,$i2);
                            $array2 = @mysql_fetch_array($zeiger2);
                            $ooid=$array2["id"];
                            $name=$array2["name"];
                            $name=stripslashes($name);
                            $icon=$array2["icon"];
                            $total=0;
                            $zeiger5 = @mysql_query("SELECT count(*) as total FROM $skrupel_schiffe where besitzer=$spieler and spiel=$spiel and ordner=$ooid");
                            $array5 = @mysql_fetch_array($zeiger5);
                            $total=$array5["total"];
                            ?>
                            <tr>
                                <td>
                                    <table border="0" cellspacing="0" cellpadding="0" background="<?php echo $bildpfad?>/menu/flotte_ordner.gif">
                                        <tr>
                                            <td><img src="../bilder/empty.gif" border="0" width="1" height="15"></td>
                                            <td><img src="../bilder/empty.gif" border="0" width="98" height="1"></td>
                                            <td><img src="../bilder/empty.gif" border="0" width="1" height="15"></td>
                                        </tr>
                                        <tr>
                                            <td><img src="../bilder/empty.gif" border="0" width="1" height="58"></td>
                                            <td style="filter:glow(color=#000000, strenght=#1);" valign="top"><center><?php echo $name?><br><?php echo $total?></center></td>
                                            <td><img src="../bilder/empty.gif" border="0" width="1" height="58"></td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table border="0" cellspacing="0" cellpadding="3">
                                        <tr>
                                            <td><form name="formular" method="post" action="meta_fordner.php?fu=3&ooid=<?php echo $ooid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"></td>
                                            <td colspan="2"><?php echo $lang['metafordner']['ordnerumbenennen']?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><input type="text" name="ordnerneu" maxlength="10" style="width:80px;" class="eingabe"></td>
                                            <td align="right"><input type="submit" value="<?php echo $lang['metafordner']['ok']?>" style="width:30px;" class="button"></td>
                                            <td></form></td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table border="0" cellspacing="0" cellpadding="3">
                                        <tr>
                                            <td><form name="formular" method="post" action="meta_fordner.php?fu=5&ooid=<?php echo $ooid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"></td>
                                            <td colspan="2"><?php echo $lang['metafordner']['iconaendern']?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><select name="icon" style="width:80px;">
                                                <option value="0" <?php if ($icon==0) { echo 'selected'; } ?>><?php echo $lang['metafordner']['icon0']?></option>
                                                <option value="1" <?php if ($icon==1) { echo 'selected'; } ?>><?php echo $lang['metafordner']['icon1']?></option>
                                                <option value="2" <?php if ($icon==2) { echo 'selected'; } ?>><?php echo $lang['metafordner']['icon2']?></option>
                                                <option value="3" <?php if ($icon==3) { echo 'selected'; } ?>><?php echo $lang['metafordner']['icon3']?></option>
                                                <option value="4" <?php if ($icon==4) { echo 'selected'; } ?>><?php echo $lang['metafordner']['icon4']?></option>
                                                <option value="5" <?php if ($icon==5) { echo 'selected'; } ?>><?php echo $lang['metafordner']['icon5']?></option>
                                                <option value="6" <?php if ($icon==6) { echo 'selected'; } ?>><?php echo $lang['metafordner']['icon6']?></option>
                                            </select></td>
                                            <td align="right"><input type="submit" value="<?php echo $lang['metafordner']['ok']?>" style="width:30px;" class="button"></td>
                                            <td></form></td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table border="0" cellspacing="0" cellpadding="3">
                                        <tr>
                                            <td><form name="formular" method="post" action="meta_fordner.php?fu=4&ooid=<?php echo $ooid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>" onSubmit="return confirm('<?php echo $lang['metafordner']['ordnerwirklichloeschen']?>');"></td>
                                            <td><?php echo $lang['metafordner']['ordnerloeschen']?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td align="right"><input type="submit" value="<?php echo $lang['metafordner']['ok']?>" style="width:30px;" class="button"></td>
                                            <td></form></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </center>
        </div>
        <?php
    include ("inc.footer.php");
}
if ($fuid==2) {
    include ("inc.header.php");
    ?>
    <body text="#000000" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php
        $ordnerneu=str_post('ordnerneu','SQLSAFE');
        //$ordnerneu=addslashes($ordnerneu);
        $zeiger_temp = @mysql_query("INSERT INTO $skrupel_ordner (name,besitzer,spiel) values ('$ordnerneu',$spieler,$spiel)");
        ?>
        <script language=JavaScript>
            window.location='meta_fordner.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>';
        </script>
        <?php
    include ("inc.footer.php");
}
if ($fuid==3) {
    include ("inc.header.php");
    ?>
    <body text="#000000" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php
        $ooid=int_get('ooid');
        $ordnerneu=str_post('ordnerneu','SQLSAFE');
        //$ordnerneu=addslashes($ordnerneu);
        $zeiger_temp = @mysql_query("UPDATE $skrupel_ordner set name='$ordnerneu' where id =$ooid");
        ?>
        <script language=JavaScript>
            window.location='meta_fordner.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>';
        </script>
        <?php
    include ("inc.footer.php");
}
if ($fuid==4) {
    include ("inc.header.php");
    ?>
    <body text="#000000" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php
        $ooid=int_get('ooid');
        $zeiger_temp = @mysql_query("DELETE FROM $skrupel_ordner where id =$ooid");
        $zeiger_temp = @mysql_query("UPDATE $skrupel_schiffe set ordner=0 where ordner=$ooid");
        ?>
        <script language=JavaScript>
            window.location='meta_fordner.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>';
        </script>
        <?php
    include ("inc.footer.php");
}
if ($fuid==5) {
    include ("inc.header.php");
    ?>
    <body text="#000000" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php
        $ooid=int_get('ooid');
        $icon=int_post('icon');
        $zeiger_temp = @mysql_query("UPDATE $skrupel_ordner set icon='$icon' where id =$ooid");
        ?>
        <script language=JavaScript>
            window.location='meta_fordner.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>';
        </script>
        <?php
    include ("inc.footer.php");
}
