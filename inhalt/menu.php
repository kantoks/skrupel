<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'menu';
$fuid = int_get('fu');

if ($fuid==1) {
    include ("inc.header.php");
    ?>
    <script language=JavaScript>
        function link_fenster_beide(url,url2) {
            if (document.globals.kursmodus.value==1) {
                alert('<?php echo html_entity_decode($lang['menu']['kursmodus'])?>');
            } else {
                parent.untenmitte.window.location=url;
                if (document.globals.map.value==1) {
                    document.globals.map.value=0;
                    parent.mittemitte.window.location='aufbau.php?fu=100&query='+url2;
                }  else  {
                    parent.mittemitte.rahmen12.window.location=url2;
                }
            }
        }
        function link_all(url) {
            if (document.globals.kursmodus.value==1) {
                alert('<?php echo html_entity_decode($lang['menu']['kursmodus'])?>');
            } else {
                parent.untenmitte.window.location=url;
                if (document.globals.map.value==0) {
                    document.globals.map.value=1;
                    parent.mittemitte.window.location='galaxie.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>';
                } else {
                    parent.mittemitte.document.getElementById("aktuell").style.visibility='hidden';
                }
            }
        }
        function link_unten(url) {
            if (document.globals.kursmodus.value==1) {
                alert('<?php echo html_entity_decode($lang['menu']['kursmodus'])?>');
            } else {
                parent.untenmitte.window.location=url;
            }
        }
    </script>
    <body text="#000000" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <table border="0" cellspacing="0" cellpadding="0">
            <?php if ($spieler==$spieler_admin) { ?>
                <tr>
                    <td><a href="javascript:;" border="0" onclick="link_unten('admin.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>');self.focus();"><img src="<?php echo $bildpfad?>/aufbau/menu_admin_1.gif" border="0" width="57" height="43"></a></td>
                </tr>
            <?php } else { ?>
                <tr>
                    <td><img src="<?php echo $bildpfad?>/aufbau/menu_1.gif" border="0" width="57" height="43"></td>
                </tr>
            <?php } ?>
            <tr>
                <td><a href="javascript:;" border="0" onclick="link_fenster_beide('uebersicht.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>','uebersicht_uebersicht.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>');self.focus();"><img src="<?php echo $bildpfad?>/aufbau/menu_2.gif" border="0" width="57" height="43"  title="<?php echo $lang['menu']['reports']?>"></a></td>
            </tr>
            <tr>
                <td><a href="javascript:;" border="0" onclick="link_unten('kommunikation.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>');self.focus();"><img src="<?php echo $bildpfad?>/aufbau/menu_3.gif" border="0" width="57" height="46"  title="<?php echo $lang['menu']['kommunikation']?>"></a></td>
            </tr>
            <tr>
                <td><a href="javascript:;" border="0" onclick="link_unten('meta.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>');self.focus();"><img src="<?php echo $bildpfad?>/aufbau/menu_4.gif" border="0" width="57" height="45" title="<?php echo $lang['menu']['metainformationen']?>"></a></td>
            </tr>
            <tr>
                <td><img src="<?php echo $bildpfad?>/aufbau/menu_5.gif" border="0" width="57" height="23"></td>
            </tr>
            <tr>
                <td><a href="javascript:;" border="0" onclick="link_all('flotte.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>');self.focus();"><img src="<?php echo $bildpfad?>/aufbau/menu_6.gif" border="0" width="57" height="44"  title="<?php echo $lang['menu']['flotte']?>"></a></td>
            </tr>
            <tr>
                <td><a href="javascript:;" border="0" onclick="link_all('planeten.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>');self.focus();"><img src="<?php echo $bildpfad?>/aufbau/menu_7.gif" border="0" width="57" height="46" title="<?php echo $lang['menu']['kolonien']?>"></a></td>
            </tr>
            <tr>
                <td><a href="javascript:;" border="0" onclick="link_all('basen.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>');self.focus();"><img src="<?php echo $bildpfad?>/aufbau/menu_8.gif" border="0" width="57" height="49" title="<?php echo $lang['menu']['sternenbasen']?>"></a></td>
            </tr>
        </table>
        <form name="globals" id="globals">
            <input type="hidden" name="kursmodus" value="0">
            <input type="hidden" name="schiffid" value="0">
            <input type="hidden" name="schiffx" value="0">
            <input type="hidden" name="schiffy" value="0">
            <input type="hidden" name="verbrauch" value="0">
            <input type="hidden" name="masse" value="0">
            <input type="hidden" name="map" value="0">
        </form>
    <?php include ("inc.footer.php"); 
}
if ($fuid==2) {
    include ("inc.header.php");
    ?>
    <script language=JavaScript>
        function link_unten(url) {
            if (parent.mittelinksoben.document.getElementById("globals").kursmodus.value==1) {
                alert('<?php echo html_entity_decode($lang['menu']['kursmodus'])?>');
            } else {
                parent.untenmitte.window.location=url;
            }
        }
    </script>
    <body text="#000000" bgcolor="#000000" background="<?php echo $bildpfad?>/aufbau/13.gif" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td><img src="../bilder/empty.gif" border="0" width="1" height="77"></td>
            </tr>
            <tr>
                <td><a href="javascript:;" border="0" onclick="link_unten('zugende.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>');self.focus();"><img src="<?php echo $bildpfad?>/aufbau/knopp.gif" border="0" width="56" height="30" title="<?php echo $lang['menu']['zugende']; ?>"></a></td>
            </tr>
        </table>
    <?php include ("inc.footer.php");
}
