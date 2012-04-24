<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'hilfe_native';
$fuid = int_get('fu');

if ($fuid>=1) {
    include ("inc.header.php");
    
    ?>
    <body text="#000000" bgcolor="#444444"  link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <?php
    $file='../daten/dom_spezien.txt';
    $fp = @fopen("$file","r");
    if ($fp) {
        $zaehler=0;
        while (!feof ($fp)) {
            $buffer = @fgets($fp, 4096);
            $ur[$zaehler]=explode(":",$buffer);
            $zaehler++;
        }
        @fclose($fp);
    }

    for ($i=0;$i<$zaehler;$i++) {

        if ($ur[$i][1]==$fuid) {
        ?>
        <script language=JavaScript>parent.document.title='<?php echo $lang['hilfe_native'][$fuid]['name']?>';</script>
        <table border="0" cellspacing="0" cellpadding="4">
            <tr>
                <td colspan="5" style="font-size:18px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)">
                    <center><?php echo $lang['hilfe_native'][$fuid]['name']?></center>
                </td>
            <tr>
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
                            <td bgcolor="#000000"><img src="../daten/bilder_spezien/<?php echo $ur[$i][2]; ?>" border="0" width="100" height="100"></td>
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
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/native_2.gif" border="0" width="17" height="17"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                            <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['hilfe_native']['gestalt']; ?></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                            <td><nobr><?php echo $lang['hilfe_native']['art'][$ur[$i][3]]; ?></nobr></td>
                        </tr>
                        <tr>
                            <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/cantox.gif" border="0" width="17" height="17"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                            <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['hilfe_native']['abgaben']; ?></td>
                        </tr>
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                            <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                            <td><nobr><?php echo str_replace('{1}',$ur[$i][4]*100,$lang['hilfe_native']['vh']); ?></nobr></td>
                        </tr>
                     </table>
                    </td>
                    <td valign="top" width="100%">
                        <table border="0" cellspacing="0" cellpadding="0" width="100%">
                            <tr>
                                <td style="color:#aaaaaa;"><?php echo $lang['hilfe_native'][$fuid]['beschreibung']; ?></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td><center><?php echo $lang['hilfe_native'][$fuid]['effekt']; ?></center></td>
                            </tr>
                         </table>
                        </td>
                    </tr>
                </table>
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

            <frame name="rahmen12" scrolling="auto" marginwidth="0" marginheight="0" noresize src="hilfe_native.php?fu=<?php echo int_get('fu2'); ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" target="_self">

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
