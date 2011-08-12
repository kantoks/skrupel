<?php
include ("../inc.conf.php");
if(empty($_GET["sprache"])){$_GET["sprache"]=$language;}
$file="../lang/".$_GET["sprache"]."/lang.basen.php";
include ($file);

$baid=$_GET["baid"];
if ($_GET["fu"]==1) {
    include ("inc.header.php");
    ?>
    <script language=JavaScript>
        function fensterbreit(){
            if (parent.parent.mittemitte.window.innerWidth) return parent.parent.mittemitte.window.innerWidth;
            else if (parent.parent.mittemitte.document.body && parent.parent.mittemitte.document.body.offsetWidth) return parent.parent.mittemitte.document.body.offsetWidth;
            else return 0;
        }

        function fensterhoch(){
            if (parent.parent.mittemitte.window.innerHeight) return parent.parent.mittemitte.window.innerHeight;
            else if (parent.parent.mittemitte.document.body && parent.parent.mittemitte.document.body.offsetHeight) return parent.parent.mittemitte.document.body.offsetHeight;
            else return 0;
        }

        function movemap(wertx,werty) {
            breite=fensterbreit();
            hoch=fensterhoch();

            aktuellx=wertx-15;
            aktuelly=werty-15;

            wertx=wertx-(breite/2);
            werty=werty-(hoch/2);
            <?php if (@intval(substr($spieler_optionen,17,1))!=1) { ?>
                var scrollDiv = parent.parent.mittemitte.document.getElementById("complete");
                if(scrollDiv.contentScroll) scrollDiv.contentScroll(wertx,werty,false);
            <?php } else { ?>
                parent.parent.mittemitte.document.getElementById("complete").scrollLeft = wertx;
                parent.parent.mittemitte.document.getElementById("complete").scrollTop = werty; 
            <?php } ?>

            parent.parent.mittemitte.document.getElementById("aktuell").style.visibility='visible';
            parent.parent.mittemitte.document.getElementById("aktuell").style.left=aktuellx;
            parent.parent.mittemitte.document.getElementById("aktuell").style.top=aktuelly;
        }
    </script>
    <body text="#000000" <?php if (@intval(substr($spieler_optionen,17,1))!=1) { ?>onload="document.getElementById('bodycontent').style.width = (document.getElementById('bodytable').offsetWidth) + 'px';CSBfleXcroll('bodybody');"<?php } ?> style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <div id="bodybody" class="flexcrollafter" onfocus="this.blur()">
        <div id="bodycontent" style="margin:0 auto;">
        <?php
        $zeiger = @mysql_query("SELECT * FROM $skrupel_sternenbasen where besitzer=$spieler and status=1 and spiel=$spiel order by name");
        $basenanzahl = @mysql_num_rows($zeiger);

        if ($basenanzahl>=1) {
            ?>
            <center>
                <table border="0" cellspacing="0" cellpadding="0" id="bodytable">
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr><?php
                                    for  ($i=0; $i<$basenanzahl;$i++) {
                                        $ok = @mysql_data_seek($zeiger,$i);
                                        $array = @mysql_fetch_array($zeiger);
                                        $baid=$array["id"];
                                        $name=$array["name"];
                                        $x_pos=$array["x_pos"];
                                        $y_pos=$array["y_pos"];
                                        $rasse=$array["rasse"];
                                        $planetid=$array["planetid"];
                                        $schaden=$array["schaden"];
                                        $logbuch=$array["logbuch"];
                                        $art=$array["art"];

                                        if ($art==1) { $basisbild='2.jpg'; $icon='erf_1.gif'; $artname=$lang['basen']['raumwerft']; 
                                        }elseif ($art==2) { $basisbild='3.jpg'; $icon='erf_2.gif'; $artname=$lang['basen']['kampfstation']; 
                                        }elseif ($art==0) { $basisbild='1.jpg'; $icon='erf_3.gif'; $artname=$lang['basen']['sternenbasis']; 
                                        }elseif ($art==3) { $basisbild='4.jpg'; $icon='erf_5.gif'; $artname=$lang['basen']['kriegsbasis']; }

                                        $tip=$artname." [$name]";
                                        if (strlen($logbuch)>=1) {
                                            $tip=$tip."$logbuch";
                                        }
                                        ?>
                                        <td>
                                            <table border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                </tr>
                                                <tr>
                                                    <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                    <td>
                                                        <a href="basen.php?fu=2&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&sprache=<?php echo $_GET["sprache"]?>"><img src="<?php
                                                        $file='../daten/'.$rasse.'/bilder_basen/'.$basisbild;
                                                        if (@file_exists($file)) { echo $file; } else { echo '../daten/'.$rasse.'/bilder_basen/1.jpg'; }?>" border="0"  height="80" title="<?php echo $tip; ?>"></a>
                                                    </td>
                                                    <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                </tr>
                                                <tr>
                                                    <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <?php /*  ?>
                                                    <td><img src="../bilder/empty.gif" border="0" width="1" height="82"></td>
                                                    <td bgcolor="#990000" valign="bottom"><img src="<?php echo $bildpfad?>/skalen/gruen_1.gif" border="0" width="10" height="<?php echo ((100-$schaden)*0.82); ?>"></td>
                                                    <?php */ ?>
                                                    <td><img src="../bilder/empty.gif" border="0" width="6" height="82"></td>
                                                    <td>
                                                        <table border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td><center><a href="javascript:;" onclick="movemap(<?php echo $x_pos.",".$y_pos;  ?>);"><img src="<?php echo $bildpfad; ?>/icons/<?php echo $icon; ?>" border="0"></a></center></td>
                                                            </tr>
                                                            <tr>
                                                                <td><img src="../bilder/empty.gif" border="0" width="10" height="5"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><nobr><center><?php echo $name; ?></center></nobr></td>
                                                            </tr>
                                                            <tr>
                                                                <td><img src="../bilder/empty.gif" border="0" width="10" height="5"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="color:#aaaaaa;"><nobr><center><?php echo $x_pos; ?> / <?php echo $y_pos; ?></center></nobr></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td><img src="../bilder/empty.gif" border="0" width="6" height="80"></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <?php
                                    }?>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </center>
            </div></div>
            <?php
        }
    include ("inc.footer.php");
}

if ($_GET["fu"]==2) {
    include ("inc.header.php");
    ?>
    <frameset framespacing="0" border="false" frameborder="0" cols="*,26,290,167,420,26,*">
        <frame name="randlinks" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=14&bildpfad=<?php echo $bildpfad; ?>&sprache=<?php echo $_GET["sprache"]?>" target="_self">
        <frame name="pfeillinks" scrolling="no" marginwidth="0" marginheight="0" noresize src="basen.php?fu=7&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&sprache=<?php echo $_GET["sprache"]?>" target="_self">
        <frame name="planeten" scrolling="no" marginwidth="0" marginheight="0" noresize src="basen.php?fu=3&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&sprache=<?php echo $_GET["sprache"]?>" target="_self">
        <?php if ($zug_abgeschlossen==0) { ?>
            <frame name="planetenmenu" scrolling="no" marginwidth="0" marginheight="0" noresize src="basen.php?fu=4&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&sprache=<?php echo $_GET["sprache"]?>" target="_self">
        <?php } else { ?>
            <frame name="planetenmenu" scrolling="no" marginwidth="0" marginheight="0" noresize src="basen.php?fu=5&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&sprache=<?php echo $_GET["sprache"]?>" target="_self">
        <?php } ?>
        <frame name="planetendetails" scrolling="auto" marginwidth="0" marginheight="0" noresize src="basen.php?fu=6&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&sprache=<?php echo $_GET["sprache"]?>" target="_self">
        <frame name="pfeilrechts" scrolling="no" marginwidth="0" marginheight="0" noresize src="basen.php?fu=8&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&sprache=<?php echo $_GET["sprache"]?>" target="_self">
        <frame name="randrechts" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=14&bildpfad=<?php echo $bildpfad; ?>&sprache=<?php echo $_GET["sprache"]?>" target="_self">
    </frameset>
    <noframes>
    <body>
        <?php
    include ("inc.footer.php");
}

if ($_GET["fu"]==3) {
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

    $zeiger = @mysql_query("SELECT id,cantox,besitzer,min1,min2,min3 FROM $skrupel_planeten where besitzer=$spieler and id=$planetid");

    $array = @mysql_fetch_array($zeiger);
    $pid=$array["id"];
    $cantox=$array["cantox"];
    $min1=$array["min1"];
    $min2=$array["min2"];
    $min3=$array["min3"];

    ?>
    <script language=JavaScript>
        function fensterbreit(){
            if (parent.parent.mittemitte.window.innerWidth) return parent.parent.mittemitte.window.innerWidth;
            else if (parent.parent.mittemitte.document.body && parent.parent.mittemitte.document.body.offsetWidth) return parent.parent.mittemitte.document.body.offsetWidth;
            else return 0;
        }

        function fensterhoch(){
            if (parent.parent.mittemitte.window.innerHeight) return parent.parent.mittemitte.window.innerHeight;
            else if (parent.parent.mittemitte.document.body && parent.parent.mittemitte.document.body.offsetHeight) return parent.parent.mittemitte.document.body.offsetHeight;
            else return 0;
        }

        function movemap(wertx,werty) {
            if (parent.parent.mittelinksoben.document.globals.map.value==1) {
                breite=fensterbreit();
                hoch=fensterhoch();

                aktuellx=wertx-15;
                aktuelly=werty-15;

                wertx=wertx-(breite/2);
                werty=werty-(hoch/2);
                <?php if (@intval(substr($spieler_optionen,17,1))!=1) { ?>
                    var scrollDiv = parent.parent.mittemitte.document.getElementById("complete");
                    if(scrollDiv.contentScroll) scrollDiv.contentScroll(wertx,werty,false);
                <?php } else { ?>
                    parent.parent.mittemitte.document.getElementById("complete").scrollLeft = wertx;
                    parent.parent.mittemitte.document.getElementById("complete").scrollTop = werty; 
                <?php } ?>

                parent.parent.mittemitte.document.getElementById("aktuell").style.visibility='visible';
                parent.parent.mittemitte.document.getElementById("aktuell").style.left=aktuellx;
                parent.parent.mittemitte.document.getElementById("aktuell").style.top=aktuelly;
            }
        }

        function linksub(url) {
            parent.planetendetails.window.location=url;
        }
    
    </script>

    <body text="#000000" background="<?php echo $bildpfad; ?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="movemap(<?php echo $x_pos.",".$y_pos;  ?>);">
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td colspan="20"><img src="../bilder/empty.gif" border="0" width="1" height="5"></td>
            </tr>
            <tr>
                <td colspan="10"><?php echo $name; ?></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td rowspan="2"><?php if (($art==0) or ($art==3)) { ?><img src="<?php echo $bildpfad; ?>/icons/huelle.gif" border="0" width="17" height="17"><?php } ?></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td colspan="2" style="color:#aaaaaa;"><?php if (($art==0) or ($art==3)) { ?><?php echo $lang['basen']['trumpf']; ?><?php } ?></td>
            </tr>
            <tr>
                <td colspan="10" style="color:#aaaaaa;"><?php echo $lang['basen']['koordinaten']; ?>: <?php echo $x_pos; ?> / <?php echo $y_pos; ?></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                <td>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><?php if (($art==0) or ($art==3)) { ?><?php echo $lang['basen']['stufe']; ?><?php } ?>&nbsp;</td>
                            <td><div id="huelle"><?php if (($art==0) or ($art==3)) { ?><?php echo $t_huelle; ?><?php } ?></div></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/cantox.gif" border="0" width="17" height="17"></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['basen']['cantox']?></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/mineral_1.gif" border="0" width="17" height="17"></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['basen']['bax']?></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td rowspan="2"><?php if (($art==0) or ($art==3)) { ?><img src="<?php echo $bildpfad; ?>/icons/antrieb.gif" border="0" width="17" height="17"><?php } ?></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td colspan="2" style="color:#aaaaaa;"><?php if (($art==0) or ($art==3)) { ?><?php echo $lang['basen']['tantrieb']; ?><?php } ?></td>
            </tr>
            <tr>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                <td><div id="cantox"><?php echo $cantox; ?></div></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                <td>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <div id="min1"><?php echo $min1; ?></div>
                            </td>
                            <td>&nbsp;<?php echo $lang['basen']['kt']?></td>
                        </tr>
                    </table>
                </td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                <td>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><?php if (($art==0) or ($art==3)) { ?><?php echo $lang['basen']['stufe']; ?><?php } ?>&nbsp;</td>
                            <td><div id="antrieb"><?php if (($art==0) or ($art==3)) { ?><?php echo $t_antrieb; ?><?php } ?></div></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/mineral_2.gif" border="0" width="17" height="17"></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['basen']['ren']?></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td rowspan="2"><img src="<?php echo $bildpfad; ?>/icons/mineral_3.gif" border="0" width="17" height="17"></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td colspan="2" style="color:#aaaaaa;"><?php echo $lang['basen']['vorm']?></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td rowspan="2"><?php if (($art==0) or ($art==3)) { ?><img src="<?php echo $bildpfad; ?>/icons/laser.gif" border="0" width="17" height="17"><?php } ?></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td colspan="2" style="color:#aaaaaa;"><?php if (($art==0) or ($art==3)) { ?><?php echo $lang['basen']['tenergetik']; ?><?php } ?></td>
            </tr>
            <tr>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                <td>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><div id="min2"><?php echo $min2; ?></div>
                            </td><td>&nbsp;<?php echo $lang['basen']['kt']?></td>
                        </tr>
                    </table>
                </td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                <td>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><div id="min3"><?php echo $min3; ?></div></td>
                            <td>&nbsp;<?php echo $lang['basen']['kt']?></td>
                        </tr>
                    </table>
                </td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                <td>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><?php if (($art==0) or ($art==3)) { ?><?php echo $lang['basen']['stufe']; ?><?php } ?>&nbsp;</td>
                            <td><div id="energie"><?php if (($art==0) or ($art==3)) { ?><?php echo $t_energie; ?><?php } ?></div></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td rowspan="2"><?php if (($art==0) or ($art==2) or ($art==3)) { ?><img src="<?php echo $bildpfad; ?>/icons/abwehr.gif" border="0" width="17" height="17"><?php } ?></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td colspan="2" style="color:#aaaaaa;"><?php if (($art==0) or ($art==2) or ($art==3)) { ?><?php echo $lang['basen']['abwehr']; ?><?php } ?></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td rowspan="2"><?php if (($art==0) or ($art==2) or ($art==3)) { ?><img src="<?php echo $bildpfad; ?>/icons/hangar.gif" border="0" width="17" height="17"><?php } ?></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td colspan="2" style="color:#aaaaaa;"><?php if (($art==0) or ($art==2) or ($art==3)) { ?><?php echo $lang['basen']['jaeger']; ?><?php } ?></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td rowspan="2"><?php if (($art==0) or ($art==3)) { ?><img src="<?php echo $bildpfad; ?>/icons/projektil.gif" border="0" width="17" height="17"><?php } ?></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td colspan="2" style="color:#aaaaaa;"><?php if (($art==0) or ($art==3)) { ?><?php echo $lang['basen']['tprojektile']; ?><?php } ?></td>
            </tr>
            <tr>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                <td><div id="defense"><?php if (($art==0) or ($art==2) or ($art==3)) { ?><?php echo $defense; ?><?php } ?></div></td>

                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                <td><div id="jaeger"><?php if (($art==0) or ($art==2) or ($art==3)) { ?><?php echo $jaeger; ?><?php } ?></div></td>

                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="5" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="15" height="1"></td>
                <td>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><?php if (($art==0) or ($art==3)) { ?><?php echo $lang['basen']['stufe']; ?><?php } ?>&nbsp;</td>
                            <td><div id="explosiv"><?php if (($art==0) or ($art==3)) { ?><?php echo $t_explosiv; ?><?php } ?></div></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <?php
    include ("inc.footer.php");
}

if ($_GET["fu"]==4) {
    include ("inc.header.php");

    $zeiger = @mysql_query("SELECT * FROM $skrupel_sternenbasen where besitzer=$spieler and status=1 and id=$baid");

    $array = @mysql_fetch_array($zeiger);
    $art=$array["art"];

    ?>
    <script language=JavaScript>
        function linksub(url) {
            parent.planetendetails.window.location=url;
        }
    </script>
    <body text="#000000" background="<?php echo $bildpfad; ?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td><img src="../bilder/empty.gif" border="0" width="167" height="6"></td>
            </tr>
            <tr>
                <td><img src="<?php echo $bildpfad; ?>/konsole/basis_<?php echo $art; ?>.gif" border="0" width="167" height="95" usemap="#konsole"></td>
            </tr>
        </table>
        <?php if (($art==0) or ($art==3)) { ?>
            <map name="konsole">
                <area shape=rect coords="24,14,50,40" href="javascript:linksub('basen_alpha.php?fu=1&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&sprache=<?php echo $_GET["sprache"]?>');self.focus();" title="<?php echo $lang['basen']['techlevel']; ?>">
                <area shape=rect coords="71,11,97,39" href="javascript:linksub('basen_alpha.php?fu=3&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&sprache=<?php echo $_GET["sprache"]?>');self.focus();" title="<?php echo $lang['basen']['abwehrsysteme']; ?>">
                <area shape=rect coords="112,12,144,42" href="javascript:linksub('basen_alpha.php?fu=5&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&sprache=<?php echo $_GET["sprache"]?>');self.focus();" title="<?php echo $lang['basen']['raumfaltentechnologie']; ?>">

                <area shape=rect coords="16,54,33,66" href="javascript:linksub('basen_beta.php?fu=1&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&sprache=<?php echo $_GET["sprache"]?>');self.focus();" title="<?php echo $lang['basen']['ruempfe']; ?>">
                <area shape=rect coords="40,54,56,67" href="javascript:linksub('basen_beta.php?fu=3&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&sprache=<?php echo $_GET["sprache"]?>');self.focus();" title="<?php echo $lang['basen']['antriebssysteme']; ?>">
                <area shape=rect coords="17,73,33,89" href="javascript:linksub('basen_beta.php?fu=5&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&sprache=<?php echo $_GET["sprache"]?>');self.focus();" title="<?php echo $lang['basen']['energetischewaffen']; ?>">
                <area shape=rect coords="39,75,56,86" href="javascript:linksub('basen_beta.php?fu=7&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&sprache=<?php echo $_GET["sprache"]?>');self.focus();" title="<?php echo $lang['basen']['projektilbasierendewaffen']; ?>">

                <area shape=rect coords="72,59,98,83" href="javascript:linksub('basen_gamma.php?fu=1&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&sprache=<?php echo $_GET["sprache"]?>');self.focus();" title="<?php echo $lang['basen']['schiffproduzieren']; ?>">
                <area shape=rect coords="114,62,144,84" href="javascript:linksub('basen_gamma.php?fu=4&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&sprache=<?php echo $_GET["sprache"]?>');self.focus();" title="<?php echo $lang['basen']['logbuch']; ?>">
            </map>
        <?php }elseif ($art==1) { ?>
            <map name="konsole">
                <area shape=rect coords="114,62,144,84" href="javascript:linksub('basen_gamma.php?fu=4&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&sprache=<?php echo $_GET["sprache"]?>');self.focus();" title="<?php echo $lang['basen']['logbuch']; ?>">
            </map>
        <?php }elseif ($art==2) { ?>
            <map name="konsole">
                <area shape=rect coords="71,11,97,39" href="javascript:linksub('basen_alpha.php?fu=3&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&sprache=<?php echo $_GET["sprache"]?>');self.focus();" title="<?php echo $lang['basen']['abwehrsysteme']; ?>">
                <area shape=rect coords="114,62,144,84" href="javascript:linksub('basen_gamma.php?fu=4&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&sprache=<?php echo $_GET["sprache"]?>');self.focus();" title="<?php echo $lang['basen']['logbuch']; ?>">
            </map>
        <?php }
    include ("inc.footer.php");
}

if ($_GET["fu"]==5) {
    include ("inc.header.php");
    ?>
    <script language=JavaScript>
        function linksub(url) {
            parent.planetendetails.window.location=url;
        }
    </script>
    <body text="#000000" background="<?php echo $bildpfad; ?>/aufbau/14.gif" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td><img src="../bilder/empty.gif" border="0" width="167" height="6"></td>
            </tr>
            <tr>
                <td><img src="<?php echo $bildpfad; ?>/konsole/sternenbasis_no.gif" border="0" width="167" height="95" usemap="#konsole"></td>
            </tr>
        </table>
        <map name="konsole">
            <area shape=rect coords="114,62,144,84" href="javascript:linksub('basen_gamma.php?fu=4&baid=<?php echo $baid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&sprache=<?php echo $_GET["sprache"]?>');self.focus();" title="<?php echo $lang['basen']['logbuch']; ?>">
        </map>
        <?php
    include ("inc.footer.php");
}

if ($_GET["fu"]==6) {
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

    if ($art==1) { $basisbild='2.jpg'; $icon='erf_1.gif'; $artname=$lang['basen']['raumwerft']; 
    }elseif ($art==2) { $basisbild='3.jpg'; $icon='erf_2.gif'; $artname=$lang['basen']['kampfstation']; 
    }elseif ($art==0) { $basisbild='1.jpg'; $icon='erf_3.gif'; $artname=$lang['basen']['sternenbasis']; 
    }elseif ($art==3) { $basisbild='4.jpg'; $icon='erf_5.gif'; $artname=$lang['basen']['kriegsbasis']; }

    ?>
    <body text="#000000" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" scroll="auto" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><img src="<?php echo $bildpfad; ?>/icons/<?php echo $icon; ?>" border="0" title="<?php echo $artname; ?>"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="25" height="1"></td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="6"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                <td>
                                    <img src="<?php
                                    $file='../daten/'.$rasse.'/bilder_basen/'.$basisbild;
                                    if (@file_exists($file)) { echo $file; } else { echo '../daten/'.$rasse.'/bilder_basen/1.jpg'; }?>" border="0"  height="94" title="<?php echo $artname; ?>" width="141">
                                </td>
                                <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                            </tr>
                        </table>
                    </td>
                    <td><img src="../bilder/empty.gif" border="0" width="25" height="1"></td>
                    <td><img src="<?php echo $bildpfad; ?>/icons/<?php echo $icon; ?>" border="0" title="<?php echo $artname; ?>"></td>
                </tr>
            </table>
        </center>
        <?php
    include ("inc.footer.php");
}

if ($_GET["fu"]==7) {
    include ("inc.header.php");
    $pid=$_GET["pid"];
    ?>
    <script language=JavaScript>
        function linksub(url) {
            parent.window.location=url;
        }
    </script>
    <body text="#000000" scroll="no" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php
        $zeiger = @mysql_query("SELECT id FROM $skrupel_sternenbasen where besitzer=$spieler and status=1 and spiel=$spiel order by name");
        $planetenanzahl = @mysql_num_rows($zeiger);

        if ($planetenanzahl>=1) {

            for  ($i=0; $i<$planetenanzahl;$i++) {
                $ok = @mysql_data_seek($zeiger,$i);
                $array = @mysql_fetch_array($zeiger);
                $pid_t=$array["id"];

                if (($baid==$pid_t) and ($i>=1)) { ?>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="26" height="8"></td>
                        </tr>
                        <tr>
                            <td><a href="javascript:linksub('basen.php?fu=2&baid=<?php echo $pid_back; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&sprache=<?php echo $_GET["sprache"]?>');self.focus();"><img src="<?php echo $bildpfad; ?>/konsole/pfeil_links.gif" border="0" width="26" height="90"></a></td>
                        </tr>
                    </table>
                    <?php
                }
                $pid_back=$pid_t;
            }
        }
    include ("inc.footer.php");
}

if ($_GET["fu"]==8) {
    include ("inc.header.php");
    $pid=$_GET["pid"];
    ?>
    <script language=JavaScript>
        function linksub(url) {
            parent.window.location=url;
        }
    </script>
    <body text="#000000" scroll="no" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php
        $zeiger = @mysql_query("SELECT id FROM $skrupel_sternenbasen where besitzer=$spieler and status=1 and spiel=$spiel order by name");
        $planetenanzahl = @mysql_num_rows($zeiger);

        if ($planetenanzahl>=1) {

            for  ($i=0; $i<$planetenanzahl;$i++) {
                $ok = @mysql_data_seek($zeiger,$i);
                $array = @mysql_fetch_array($zeiger);
                $pid_t=$array["id"];

                if ($baid==$pid_back) { ?>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><img src="../bilder/empty.gif" border="0" width="26" height="8"></td>
                        </tr>
                        <tr>
                            <td><a href="javascript:linksub('basen.php?fu=2&baid=<?php echo $pid_t; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>&sprache=<?php echo $_GET["sprache"]?>');self.focus();"><img src="<?php echo $bildpfad; ?>/konsole/pfeil_rechts.gif" border="0" width="26" height="90"></a></td>
                        </tr>
                    </table>
                    <?php
                }
                $pid_back=$pid_t;
            }
        }
    include ("inc.footer.php");
}
