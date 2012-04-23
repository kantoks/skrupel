<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
open_db();

$fuid = int_get('fu');
if (!$fuid) $fuid=1;

if ($fuid==1) {

    $breite=int_get('width');
    $hoehe=int_get('height');
    $spiel=int_get('spiel');

    $zeiger_temp = @mysql_query("SELECT id,nebel FROM $skrupel_spiele where id=$spiel");
    $array = @mysql_fetch_array($zeiger_temp);
    $autozug=$array["autozug"];
    $nebel=$array["nebel"];

    ?>
    <html>
        <head>
            <META NAME="Author" CONTENT="Bernd Kantoks bernd@kantoks.de">
            <META HTTP-EQUIV="imagetoolbar" CONTENT="no">
        </head>
        <body text="#000000" bgcolor="#000000" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><img src="../bilder/karte/mapklein.gif" width="<?php echo $breite?>" height="<?php echo $hoehe?>"></td>
                </tr>
            </table>
            <?php 
            $x=250/2500*$breite;
            ?>
            <div id="strich1" style="position: absolute; left:<?php echo $x?>px; top:0px; width:1px; height:<?php echo $hoehe?>px;visibility=visible;background-Color:#333333;"><img border="0" src="../bilder/empty.gif" width="1" height="<?php echo $hoehe?>"></div>
            <?php 
            $x=500/2500*$breite;
            ?><div id="strich2" style="position: absolute; left:<?php echo $x?>px; top:0px; width:1px; height:<?php echo $hoehe?>px;visibility=visible;background-Color:#333333;"><img border="0" src="../bilder/empty.gif" width="1" height="<?php echo $hoehe?>"></div><?php 
            $x=750/2500*$breite;
            ?><div id="strich3" style="position: absolute; left:<?php echo $x?>px; top:0px; width:1px; height:<?php echo $hoehe?>px;visibility=visible;background-Color:#333333;"><img border="0" src="../bilder/empty.gif" width="1" height="<?php echo $hoehe?>"></div><?php 
            $x=1000/2500*$breite;
            ?><div id="strich4" style="position: absolute; left:<?php echo $x?>px; top:0px; width:1px; height:<?php echo $hoehe?>px;visibility=visible;background-Color:#333333;"><img border="0" src="../bilder/empty.gif" width="1" height="<?php echo $hoehe?>"></div><?php 
            $x=1250/2500*$breite;
            ?><div id="strich1" style="position: absolute; left:<?php echo $x?>px; top:0px; width:1px; height:<?php echo $hoehe?>px;visibility=visible;background-Color:#333333;"><img border="0" src="../bilder/empty.gif" width="1" height="<?php echo $hoehe?>"></div><?php 
            $x=1500/2500*$breite;
            ?><div id="strich2" style="position: absolute; left:<?php echo $x?>px; top:0px; width:1px; height:<?php echo $hoehe?>px;visibility=visible;background-Color:#333333;"><img border="0" src="../bilder/empty.gif" width="1" height="<?php echo $hoehe?>"></div><?php 
            $x=1750/2500*$breite;
            ?><div id="strich3" style="position: absolute; left:<?php echo $x?>px; top:0px; width:1px; height:<?php echo $hoehe?>px;visibility=visible;background-Color:#333333;"><img border="0" src="../bilder/empty.gif" width="1" height="<?php echo $hoehe?>"></div><?php 
            $x=2000/2500*$breite;
            ?><div id="strich4" style="position: absolute; left:<?php echo $x?>px; top:0px; width:1px; height:<?php echo $hoehe?>px;visibility=visible;background-Color:#333333;"><img border="0" src="../bilder/empty.gif" width="1" height="<?php echo $hoehe?>"></div><?php 
            $x=2250/2500*$breite;
            ?><div id="strich4" style="position: absolute; left:<?php echo $x?>px; top:0px; width:1px; height:<?php echo $hoehe?>px;visibility=visible;background-Color:#333333;"><img border="0" src="../bilder/empty.gif" width="1" height="<?php echo $hoehe?>"></div><?php 

            $y=250/2500*$hoehe;
            ?><div id="strich5" style="position: absolute; left:0px; top:<?php echo $y?>px; width:<?php echo $breite?>px; height:1px;visibility=visible;background-Color:#333333;"><img border="0" src="../bilder/empty.gif" width="<?php echo $breite?>" height="1"></div><?php 
            $y=500/2500*$hoehe;
            ?><div id="strich6" style="position: absolute; left:0px; top:<?php echo $y?>px; width:<?php echo $breite?>px; height:1px;visibility=visible;background-Color:#333333;"><img border="0" src="../bilder/empty.gif" width="<?php echo $breite?>" height="1"></div><?php 
            $y=750/2500*$hoehe;
            ?><div id="strich7" style="position: absolute; left:0px; top:<?php echo $y?>px; width:<?php echo $breite?>px; height:1px;visibility=visible;background-Color:#333333;"><img border="0" src="../bilder/empty.gif" width="<?php echo $breite?>" height="1"></div><?php 
            $y=1000/2500*$hoehe;
            ?><div id="strich8" style="position: absolute; left:0px; top:<?php echo $y?>px; width:<?php echo $breite?>px; height:1px;visibility=visible;background-Color:#333333;"><img border="0" src="../bilder/empty.gif" width="<?php echo $breite?>" height="1"></div><?php 
            $y=1250/2500*$hoehe;
            ?><div id="strich5" style="position: absolute; left:0px; top:<?php echo $y?>px; width:<?php echo $breite?>px; height:1px;visibility=visible;background-Color:#333333;"><img border="0" src="../bilder/empty.gif" width="<?php echo $breite?>" height="1"></div><?php 
            $y=1500/2500*$hoehe;
            ?><div id="strich6" style="position: absolute; left:0px; top:<?php echo $y?>px; width:<?php echo $breite?>px; height:1px;visibility=visible;background-Color:#333333;"><img border="0" src="../bilder/empty.gif" width="<?php echo $breite?>" height="1"></div><?php 
            $y=1750/2500*$hoehe;
            ?><div id="strich7" style="position: absolute; left:0px; top:<?php echo $y?>px; width:<?php echo $breite?>px; height:1px;visibility=visible;background-Color:#333333;"><img border="0" src="../bilder/empty.gif" width="<?php echo $breite?>" height="1"></div><?php 
            $y=2000/2500*$hoehe;
            ?><div id="strich8" style="position: absolute; left:0px; top:<?php echo $y?>px; width:<?php echo $breite?>px; height:1px;visibility=visible;background-Color:#333333;"><img border="0" src="../bilder/empty.gif" width="<?php echo $breite?>" height="1"></div><?php 
            $y=2250/2500*$hoehe;
            ?><div id="strich8" style="position: absolute; left:0px; top:<?php echo $y?>px; width:<?php echo $breite?>px; height:1px;visibility=visible;background-Color:#333333;"><img border="0" src="../bilder/empty.gif" width="<?php echo $breite?>" height="1"></div><?php 
            
            if ($nebel>=1) { ?>
                <div id="dark_1_1" style="filter:alpha(opacity=70);-moz-opacity:70%;position: absolute; left:0px; top:0px; width:<?php echo $breite?>px; height:<?php echo $hoehe?>px;visibility=visible;background-Color:#333333;"><img border="0" src="../bilder/empty.gif" width="25" height="25"></div>
                <div id="darkgame" style="position: absolute; left:0px; top:0px; width:<?php echo $breite?>px; height:<?php echo $hoehe?>px;visibility=visible;">
                    <center>
                        <table border="0" cellspacing="0" cellpadding="0" height="100%">
                            <tr>
                                <td><br><br><img src="../bilder/export/darkmatch.gif" width="163" height="17" alt="Darkmatch"><br><br><br></td>
                            </tr>
                        </table>
                    </center>
                    </div>
            <?php  } else {
                $zeiger = @mysql_query("SELECT * FROM $skrupel_schiffe where spezialmission<>9 and spiel=$spiel order by id");
                $datensaetze = @mysql_num_rows($zeiger);
                   
                if ($datensaetze>=1) {
                
                    for ($i=0; $i<$datensaetze;$i++) {
                        $ok = @mysql_data_seek($zeiger,$i);
                       
                        $array = @mysql_fetch_array($zeiger);
                        $id=$array["id"];
                        $x_pos=$array["kox"];
                        $y_pos=$array["koy"];
                        $besitzer=$array["besitzer"];
                
                        $x_position=$x_pos/2500*$breite;
                        $y_position=$y_pos/2500*$hoehe;
                       
                        $farbe=$spielerfarbe["$besitzer"];
                        ?>
                        <div id="schiff_<?php echo $id?>_1" style="position: absolute; left:<?php echo  $x_position; ?>px; top:<?php echo  $y_position; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                        <?php 
                    }
                }
                   
                $zeiger = @mysql_query("SELECT * FROM $skrupel_planeten where spiel=$spiel order by id");
                $datensaetze = @mysql_num_rows($zeiger);
                   
                if ($datensaetze>=1) {
                
                    for ($i=0; $i<$datensaetze;$i++) {
                        $ok = @mysql_data_seek($zeiger,$i);
                       
                        $array = @mysql_fetch_array($zeiger);
                        $id=$array["id"];
                        $name=$array["name"];
                        $x_pos=$array["x_pos"];
                        $y_pos=$array["y_pos"];
                        $besitzer=$array["besitzer"];
                        $klasse=$array["klasse"];
                
                        $x_position=$x_pos/2500*$breite;
                        $y_position=$y_pos/2500*$hoehe;
                
                        $farbe="#ffffff";
                
                        if ($besitzer==0) { ?><div id="planet_<?php echo $id?>" style="position: absolute; left:<?php echo $x_position?>px; top:<?php echo $y_position?>px; width:1px; height:1px;visibility=visible;background-Color:#ffffff;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div><?php  } else {
                           
                            $farbe=$spielerfarbe["$besitzer"];
                            ?>
                            <div id="planet_<?php echo $id?>_1" style="position: absolute; left:<?php echo  $x_position; ?>px; top:<?php echo  $y_position; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <div id="planet_<?php echo $id?>_2" style="position: absolute; left:<?php echo  $x_position+1; ?>px; top:<?php echo  $y_position; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <div id="planet_<?php echo $id?>_3" style="position: absolute; left:<?php echo  $x_position-1; ?>px; top:<?php echo  $y_position; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <div id="planet_<?php echo $id?>_4" style="position: absolute; left:<?php echo  $x_position; ?>px; top:<?php echo  $y_position+1; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <div id="planet_<?php echo $id?>_5" style="position: absolute; left:<?php echo  $x_position; ?>px; top:<?php echo  $y_position-1; ?>px; width:1px; height:1px;visibility=visible;background-Color:<?php echo $farbe?>;"><img border="0" src="../bilder/empty.gif" width="1" height="1"></div>
                            <?php 
                        }
                    }
                }
                $zeiger = @mysql_query("SELECT * FROM $skrupel_anomalien where art=1 or art=2 and spiel=$spiel order by id");
                $datensaetze = @mysql_num_rows($zeiger);
                if ($datensaetze>=1) {
                    for ($i=0; $i<$datensaetze;$i++) {
                        $ok = @mysql_data_seek($zeiger,$i);
                        $array = @mysql_fetch_array($zeiger);
                        $aid=$array["id"];
                        $art=$array["art"];
                        $x_pos=$array["x_pos"];
                        $y_pos=$array["y_pos"];
                    
                        $x_position=$x_pos/2500*$breite;
                        $y_position=$y_pos/2500*$hoehe;
                    
                        $nummer=rand(0,6);
                           
                        ?><div id="anomalie_<?php echo $aid?>" style="position: absolute; left:<?php echo  $x_position; ?>px; top:<?php echo  $y_position; ?>px; width:1px; height:1px;visibility=visible;"><img border="0" src="../bilder/export/anomalie_<?php echo $nummer?>.gif" width="1" height="1"></div><?php 
                    
                    }
                }
            }
            ?>
        </body>
    </html>
    <?php 
    }

if ($fuid==2) {
    $spiel=int_get('spiel');

    $zeiger_temp = @mysql_query("SELECT id,nebel FROM $skrupel_spiele where id=$spiel");
    $array = @mysql_fetch_array($zeiger_temp);
    $nebel=$array["nebel"];

    ?>
    <html>
        <head>
            <meta name="Author" content="Bernd Kantoks bernd@kantoks.de">
            <META HTTP-EQUIV="imagetoolbar" CONTENT="no">
            <style type="text/css">
                BODY,P,TD{
                    font-family:                Verdana;
                    font-size:                10px;
                    color:                    #d0d0d0;
                }
                
                BODY {
                    scrollbar-DarkShadow-Color:#222222;
                    scrollbar-3dLight-Color:#888888;
                    
                    scrollbar-Track-Color:#000000;
                    scrollbar-Face-Color:#555555;
                    
                    scrollbar-Shadow-Color:#000000;
                    scrollbar-Highlight-Color:#000000;
                    
                    scrollbar-Arrow-Color:#555555;
                }
            </style>
            <script language=JavaScript>
                function fensterbreit(){
                    if (window.innerWidth) return window.innerWidth;
                    else if (document.body && document.body.offsetWidth) return document.body.offsetWidth;
                    else return 0;
                }
                
                function fensterhoch(){
                    if (window.innerHeight) return window.innerHeight;
                    else if (document.body && document.body.offsetHeight) return document.body.offsetHeight;
                    else return 0;
                }

                function movemap(wertx,werty) {

                    breite=fensterbreit();
                    hoch=fensterhoch();
            
                    wertx=wertx-(breite/2);
                    werty=werty-(hoch/2);
                    window.scrollTo(wertx,werty);
                }
            </script>
        </head>
        <body style="background-color: #000000; border: 0;" style="background-image:url('../bilder/karte/hintergrund_c.gif'); background-attachment:fixed;" scroll="yes" TEXT="#ffffff" LINK="#000000" VLINK="#000000" ALINK="#000000" topmargin="0" leftmargin=0 marginwidth="0" marginheight="0">
            <?php  if ($nebel>=1) { ?>
                <center>
                    <table border="0" cellspacing="0" cellpadding="0" height="100%">
                        <tr>
                            <td><br><br><img src="../bilder/export/darkmatch.gif" width="163" height="17" alt="Darkmatch"><br><br><br></td>
                        </tr>
                    </table>
                </center>
            <?php  } else {
                for ($y=1; $y<=10;$y++) {
                    for ($x=1; $x<=10;$x++) {
                        $xpos=$x*250-125-5;
                        $ypos=$y*250-125-10;
                   
                        $xname=chr($x+64);
                   
                        ?><div id="bezeichnung_<?php echo $x?>_<?php echo $y?>" style="position: absolute; left:<?php echo $xpos?>px; top:<?php echo $ypos?>px;font-size:15px;color:#333333;"><b><?php echo $xname?><?php echo $y?></b></div><?php 
                   
                    }
                }
               
                $zeiger = @mysql_query("SELECT * FROM $skrupel_anomalien where spiel=$spiel order by id");
                $datensaetze = @mysql_num_rows($zeiger);
                if ($datensaetze>=1) {
                    for ($i=0; $i<$datensaetze;$i++) {
                        $ok = @mysql_data_seek($zeiger,$i);
                        $array = @mysql_fetch_array($zeiger);
                        $aid=$array["id"];
                        $art=$array["art"];
                        $x_pos=$array["x_pos"];
                        $y_pos=$array["y_pos"];
                        $extra=$array["extra"];
                    
                        if ($art==1) {
                            $xpos=$x_pos-20;
                            $ypos=$y_pos-20;
                            ?><div id="anomalie_<?php echo $aid?>" style="position: absolute; left:<?php echo $xpos?>px; top:<?php echo $ypos?>px; width:40px; height:40px;"><img border="0" src="../bilder/karte/wurmloch.gif" width="40" height="40"></div><?php 
                        }
                        if ($art==2) {
                            $xpos=$x_pos-10;
                            $ypos=$y_pos-10;
                            ?><div id="anomalie_<?php echo $aid?>" style="position: absolute; left:<?php echo $xpos?>px; top:<?php echo $ypos?>px; width:20px; height:20px;"><img border="0" src="../bilder/karte/sprungtor.gif" width="20" height="20"></div><?php 
                        }
                    }
                }
               
                $zeiger = @mysql_query("SELECT id,kox,koy,status,tarnfeld,scanner FROM $skrupel_schiffe where (status=1 or status=2) and tarnfeld=0 and spiel=$spiel");
                $datensaetze = @mysql_num_rows($zeiger);
               
                if ($datensaetze>=1) {
            
                    for ($i=0; $i<$datensaetze;$i++) {
                        $ok = @mysql_data_seek($zeiger,$i);
                   
                        $array = @mysql_fetch_array($zeiger);
                        $id=$array["id"];
                        $name=$array["name"];
                        $x_pos=$array["kox"];
                        $y_pos=$array["koy"];
                        $scanner=$array["scanner"];
                    
                        if ($scanner==0) {
                            $x_position=$x_pos-48;
                            $y_position=$y_pos-48;
                            ?><div id="scan_<?php echo $id?>" style="position: absolute; left:<?php echo $x_position?>px; top:<?php echo $y_position?>px; width:95px; height:95px;"><img border="0" src="../bilder/karte/scan_47.gif" width="95" height="95"></div><?php 
                        }elseif ($scanner==1) {
                            $x_position=$x_pos-85;
                            $y_position=$y_pos-85;
                            ?><div id="scan_<?php echo $id?>" style="position: absolute; left:<?php echo $x_position?>px; top:<?php echo $y_position?>px; width:170px; height:170px;"><img border="0" src="../bilder/karte/scan_1.gif" width="170" height="170"></div><?php 
                        }elseif ($scanner==2) {
                            $x_position=$x_pos-120;
                            $y_position=$y_pos-120;
                            ?><div id="scan_<?php echo $id?>" style="position: absolute; left:<?php echo $x_position?>px; top:<?php echo $y_position?>px; width:240px; height:240px;"><img border="0" src="../bilder/karte/scan_2.gif" width="240" height="240"></div><?php 
                        }
                    }
                }
                ?>

                <div id="logo" style="position: absolute; left:1146px; top:1145px; width:205px; height:205px;"><img border="0" src="../bilder/karte/logo.gif"></div>
                <div id="raum" style="position: absolute; left:0px; top:0px; width:2499px; height:2497px;">
                    <table border="0" cellspacing="0" cellpadding="0" background="../bilder/karte/hintergrund_b.gif">
                        <tr>
                            <td><img border="0" src="../bilder/empty.gif" width="2499" height="2497"></td>
                        </tr>
                    </table>
                </div>
                <script language=JavaScript>movemap(1250,1250);</script>
                <?php 
                $zeiger = @mysql_query("SELECT * FROM $skrupel_sternenbasen where status=1 and spiel=$spiel order by id");
                $basenanzahl = @mysql_num_rows($zeiger);
               
                if ($basenanzahl>=1) {
                
                    for ($i=0; $i<$basenanzahl;$i++) {
                        $ok = @mysql_data_seek($zeiger,$i);
                       
                        $array = @mysql_fetch_array($zeiger);
                        $bid=$array["id"];
                        $name=$array["name"];
                        $rasse=$array["rasse"];
                        $planetid=$array["planetid"];
                        $besitzer=$array["besitzer"];
                        $x_pos=$array["x_pos"];
                        $y_pos=$array["y_pos"];
                
                        $x_position=$x_pos-13;
                        $y_position=$y_pos-13;
                        ?><div id="basis_<?php echo $bid?>_<?php echo $besitzer?>" style="position: absolute; left:<?php echo $x_position?>px; top:<?php echo $y_position?>px; width:26px; height:26px;"><img border="0" src="../bilder/karte/farben/sternenbasis_<?php echo $besitzer?>.gif" width="26" height="26"></div><?php 
                    }
                }
               
                $zeiger = @mysql_query("SELECT besitzer,id,name,kox,koy,flug,zielx,ziely,zielid,techlevel,masse_gesamt,status,tarnfeld FROM $skrupel_schiffe where status>0 and tarnfeld=0 and spiel=$spiel");
                $datensaetze = @mysql_num_rows($zeiger);
               
                if ($datensaetze>=1) {
            
                    for ($i=0; $i<$datensaetze;$i++) {
                        $ok = @mysql_data_seek($zeiger,$i);
                       
                        $array = @mysql_fetch_array($zeiger);
                        $id=$array["id"];
                        $name=$array["name"];
                        $x_pos=$array["kox"];
                        $y_pos=$array["koy"];
                        $techlevel=$array["techlevel"];
                        $flug=$array["flug"];
                        $zielx=$array["zielx"];
                        $ziely=$array["ziely"];
                        $zielid=$array["zielid"];
                        $besitzer=$array["besitzer"];
                        $masse_gesamt=$array["masse_gesamt"];
                    
                        $status=$array["status"];
                   
                        $farbe=$spielerfarbe[$besitzer];
                    
                        if ($status==2) {
                            $x_position=$x_pos-9;
                            $y_position=$y_pos-9;
                    
                            ?><div id="schiff_<?php echo $id?>_<?php echo $spieler?>" style="position: absolute; left:<?php echo $x_position?>px; top:<?php echo $y_position?>px; width:18px; height:18px;"><img border="0" src="../bilder/karte/farben/umlaufbahn_<?php echo $besitzer?>.gif" width="18" height="18"></div><?php 
                        } else {
                            $x_position=$x_pos-round(($techlevel+2)/2);
                            $y_position=$y_pos-round(($techlevel+2)/2);
                           
                            ?><div id="schiff_<?php echo $id?>_<?php echo $spieler?>" style="position: absolute; left:<?php echo $x_position?>px; top:<?php echo $y_position?>px; width:<?php echo  $techlevel+2; ?>px; height:<?php echo  $techlevel+2; ?>px;"><img border="0" src="../bilder/karte/farben/schiff_<?php echo $techlevel?>_<?php echo $besitzer?>.gif" width="<?php echo  $techlevel+2; ?>" height="<?php echo  $techlevel+2; ?>"></div><?php 
                        }
                    }
                }
                ?>
                <div id="x_0_1" style="position: absolute; left:4px; top:4px;visibility:'visible';color:#a0a0a0;">0</div>
                <div id="x_500_1" style="position: absolute; left:489px; top:4px;visibility:'visible';color:#a0a0a0;">500</div>
                <div id="x_1000_1" style="position: absolute; left:985px; top:4px;visibility:'visible';color:#a0a0a0;">1000</div>
                <div id="x_1500_1" style="position: absolute; left:1485px; top:4px;visibility:'visible';color:#a0a0a0;">1500</div>
                <div id="x_2000_1" style="position: absolute; left:1985px; top:4px;visibility:'visible';color:#a0a0a0;">2000</div>
                <div id="x_2500_1" style="position: absolute; left:2467px; top:4px;visibility:'visible';color:#a0a0a0;">2500</div>
            
                <div id="x_0_2" style="position: absolute; left:4px; top:2484px;visibility:'visible';color:#a0a0a0;">0</div>
                <div id="x_500_2" style="position: absolute; left:489px; top:2484px;visibility:'visible';color:#a0a0a0;">500</div>
                <div id="x_1000_2" style="position: absolute; left:985px; top:2484px;visibility:'visible';color:#a0a0a0;">1000</div>
                <div id="x_1500_2" style="position: absolute; left:1485px; top:2484px;visibility:'visible';color:#a0a0a0;">1500</div>
                <div id="x_2000_2" style="position: absolute; left:1985px; top:2484px;visibility:'visible';color:#a0a0a0;">2000</div>
                <div id="x_2500_2" style="position: absolute; left:2467px; top:2484px;visibility:'visible';color:#a0a0a0;">2500</div>
            
                <div id="y_500_1" style="position: absolute; left:4px; top:502px;visibility:'visible';color:#a0a0a0;">500</div>
                <div id="y_1000_1" style="position: absolute; left:4px; top:1002px;visibility:'visible';color:#a0a0a0;">1000</div>
                <div id="y_1500_1" style="position: absolute; left:4px; top:1502px;visibility:'visible';color:#a0a0a0;">1500</div>
                <div id="y_2000_1" style="position: absolute; left:4px; top:2002px;visibility:'visible';color:#a0a0a0;">2000</div>
            
                <div id="y_500_2" style="position: absolute; left:2473px; top:502px;visibility:'visible';color:#a0a0a0;">500</div>
                <div id="y_1000_2" style="position: absolute; left:2467px; top:1002px;visibility:'visible';color:#a0a0a0;">1000</div>
                <div id="y_1500_2" style="position: absolute; left:2467px; top:1502px;visibility:'visible';color:#a0a0a0;">1500</div>
                <div id="y_2000_2" style="position: absolute; left:2467px; top:2002px;visibility:'visible';color:#a0a0a0;">2000</div>
                <?php 
                $zeiger = @mysql_query("SELECT * FROM $skrupel_planeten where spiel=$spiel order by id");
                $datensaetze = @mysql_num_rows($zeiger);
               
                if ($datensaetze>=1) {
                    for ($i=0; $i<$datensaetze;$i++) {
                        $ok = @mysql_data_seek($zeiger,$i);
                
                        $array = @mysql_fetch_array($zeiger);
                        $id=$array["id"];
                        $name=$array["name"];
                        $x_pos=$array["x_pos"];
                        $y_pos=$array["y_pos"];
                        $besitzer=$array["besitzer"];
                        $klasse=$array["klasse"];
                
                        if ($besitzer==$spieler) { $eigentum=1;}
                        if ($besitzer==0) { $eigentum=0;}
                        if (($besitzer>=1) and ($besitzer!=$spieler)) { $eigentum=0;}
            
                        $x_position=$x_pos-5;
                        $y_position=$y_pos-5;
                       
                        ?><div id="planet_<?php echo $id?>" style="position: absolute; left:<?php echo $x_position?>px; top:<?php echo $y_position?>px; width:10px; height:10px;visibility=visible;"><img border="0" src="../bilder/karte/planeten/<?php echo $klasse?>.gif" width="10" height="10"></div><?php 
                       
                        if ($besitzer>=1) {
                            ?><div id="planetbesetzt_<?php echo $id?>" style="position: absolute; left:<?php echo  $x_position-2; ?>px; top:<?php echo  $y_position-2; ?>px; width:14px; height:14px;visibility=visible;"><img border="0" src="../bilder/karte/farben/planetbesetzt_<?php echo $besitzer?>.gif" width="14" height="14"></div><?php 
                        }
                    }
                }
            }
            ?>
         </body>
    </html>
    <?php 
}

