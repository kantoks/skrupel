<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'gefecht';
$fuid = int_get('fu');

if ($fuid==1) {
    include ("inc.header.php");
    $schiff_id_1=int_get('sh1');
    $schiff_id_2=int_get('sh2');
    $datum=int_get('datum');
    $zeiger = @mysql_query("SELECT * FROM $skrupel_kampf where schiff_id_1=$schiff_id_1 and schiff_id_2=$schiff_id_2 and datum=$datum");
    $gefechteanzahl = @mysql_num_rows($zeiger);
    $array = @mysql_fetch_array($zeiger);
    $id=$array["id"];
    $schiff_id_1=$array["schiff_id_1"];
    $schiff_id_2=$array["schiff_id_2"];
    $name_1=$array["name_1"];
    $rasse_1=$array["rasse_1"];
    $bild_1=$array["bild_1"];
    $name_2=$array["name_2"];
    $rasse_2=$array["rasse_2"];
    $bild_2=$array["bild_2"];
    $energetik_1=$array["energetik_1"];
    $projektile_1=$array["projektile_1"];
    $hangar_1=$array["hangar_1"];
    $schild_1=$array["schild_1"];
    $schaden_1=$array["schaden_1"];
    $energetik_2=$array["energetik_2"];
    $projektile_2=$array["projektile_2"];
    $hangar_2=$array["hangar_2"];
    $schild_2=$array["schild_2"];
    $schaden_2=$array["schaden_2"];
    $art=$array["art"];
    $crew_1=$array["crew_1"];
    $crew_2=$array["crew_2"];
    $energetik_1=str_replace(":",",",$energetik_1);
    $energetik_2=str_replace(":",",",$energetik_2);
    $projektile_1=str_replace(":",",",$projektile_1);
    $projektile_2=str_replace(":",",",$projektile_2);
    $schild_1=str_replace(":",",",$schild_1);
    $schild_2=str_replace(":",",",$schild_2);
    $hangar_1=str_replace(":",",",$hangar_1);
    $hangar_2=str_replace(":",",",$hangar_2);
    $schaden_1=str_replace(":",",",$schaden_1);
    $schaden_2=str_replace(":",",",$schaden_2);
    $crew_1=str_replace(":",",",$crew_1);
    $crew_2=str_replace(":",",",$crew_2);
    $laenge=100;
    ?>
    <script language=Javascript>
        var energetik_1 = new Array(<?php echo substr($energetik_1,0,strlen($energetik_1)-1); ?>);
        var energetik_2 = new Array(<?php echo substr($energetik_2,0,strlen($energetik_2)-1); ?>);
        var projektile_1 = new Array(<?php echo substr($projektile_1,0,strlen($projektile_1)-1); ?>);
        var projektile_2 = new Array(<?php echo substr($projektile_2,0,strlen($projektile_2)-1); ?>);
        var hangar_1 = new Array(<?php echo substr($hangar_1,0,strlen($hangar_1)-1); ?>);
        var hangar_2 = new Array(<?php echo substr($hangar_2,0,strlen($hangar_2)-1); ?>);
        var schild_1 = new Array(<?php echo substr($schild_1,0,strlen($schild_1)-1); ?>);
        var schild_2 = new Array(<?php echo substr($schild_2,0,strlen($schild_2)-1); ?>);
        var schaden_1 = new Array(<?php echo substr($schaden_1,0,strlen($schaden_1)-1); ?>);
        var schaden_2 = new Array(<?php echo substr($schaden_2,0,strlen($schaden_2)-1); ?>);
        var crew_1 = new Array(<?php echo substr($crew_1,0,strlen($crew_1)-1); ?>);
        var crew_2 = new Array(<?php echo substr($crew_2,0,strlen($crew_2)-1); ?>);
        if(crew_1[0]==0){crew_1_d=1;}else{crew_1_d=crew_1[0];}
        if(crew_2[0]==0){crew_2_d=1;}else{crew_2_d=crew_2[0];}
        function laser_2_aus() {
            energetik_2_div.style.visibility = "hidden";
        }
        function laser_2_ein() {
            energetik_2_div.style.visibility = "visible";
        }
        function laser_1_aus() {
            energetik_1_div.style.visibility = "hidden";
        }
        function laser_1_ein() {
            energetik_1_div.style.visibility = "visible";
        }
        function explosion_2_aus() {
            explosion_2_div.style.visibility = "hidden";
        }
        function explosion_2_ein() {
            explosion_2_div.style.visibility = "visible";
        }
        function explosion_1_aus() {
            explosion_1_div.style.visibility = "hidden";
        }
        function explosion_1_ein() {
            explosion_1_div.style.visibility = "visible";
        }
        function projektile_1_set(links,oben) {
             projektile_1_div.style.left = links-8;
             projektile_1_div.style.top = oben-8;
        }
        function projektile_1_move() {
            tttimrID = setTimeout("projektile_1_set(50,40)", 20);
            tttimrID = setTimeout("projektile_1_set(65,50)", 40);
            tttimrID = setTimeout("projektile_1_set(80,60)", 60);
            tttimrID = setTimeout("projektile_1_set(95,70)", 80);
            tttimrID = setTimeout("projektile_1_set(110,80)", 100);
            tttimrID = setTimeout("projektile_1_set(125,90)", 120);
            tttimrID = setTimeout("projektile_1_set(140,100)", 140);
            tttimrID = setTimeout("projektile_1_set(155,110)", 160);
            tttimrID = setTimeout("projektile_1_set(170,120)", 180);
            tttimrID = setTimeout("projektile_1_set(185,130)", 200);
            tttimrID = setTimeout("projektile_1_set(200,140)", 220);
            tttimrID = setTimeout("projektile_1_set(215,150)", 240);
            tttimrID = setTimeout("projektile_1_set(230,160)", 260);
            tttimrID = setTimeout("projektile_1_set(245,170)", 280);
        }
        function projektile_1_move_weg() {
            tttimrID = setTimeout("projektile_1_set(50,40)", 20);
            tttimrID = setTimeout("projektile_1_set(63,51)", 40);
            tttimrID = setTimeout("projektile_1_set(76,62)", 60);
            tttimrID = setTimeout("projektile_1_set(81,73)", 80);
            tttimrID = setTimeout("projektile_1_set(102,84)", 100);
            tttimrID = setTimeout("projektile_1_set(115,95)", 120);
            tttimrID = setTimeout("projektile_1_set(128,106)", 140);
            tttimrID = setTimeout("projektile_1_set(141,117)", 160);
            tttimrID = setTimeout("projektile_1_set(154,128)", 180);
            tttimrID = setTimeout("projektile_1_set(163,139)", 200);
            tttimrID = setTimeout("projektile_1_set(180,150)", 220);
            tttimrID = setTimeout("projektile_1_set(183,161)", 240);
            tttimrID = setTimeout("projektile_1_set(206,172)", 260);
            tttimrID = setTimeout("projektile_1_set(218,183)", 280);
        }
        function projektile_1_aus() {
            projektile_1_div.style.visibility = "hidden";
        }
        function projektile_1_ein() {
            projektile_1_div.style.visibility = "visible";
        }
        function projektile_2_set(links,oben) {
             projektile_2_div.style.left = links-8;
             projektile_2_div.style.top = oben-8;
        }
        function projektile_2_move() {
            tttimrID = setTimeout("projektile_2_set(250,170)", 20);
            tttimrID = setTimeout("projektile_2_set(235,160)", 40);
            tttimrID = setTimeout("projektile_2_set(220,140)", 60);
            tttimrID = setTimeout("projektile_2_set(205,130)", 80);
            tttimrID = setTimeout("projektile_2_set(190,120)", 100);
            tttimrID = setTimeout("projektile_2_set(175,110)", 120);
            tttimrID = setTimeout("projektile_2_set(160,100)", 140);
            tttimrID = setTimeout("projektile_2_set(145,90)", 160);
            tttimrID = setTimeout("projektile_2_set(130,80)", 180);
            tttimrID = setTimeout("projektile_2_set(115,70)", 200);
            tttimrID = setTimeout("projektile_2_set(100,60)", 220);
            tttimrID = setTimeout("projektile_2_set(85,50)", 240);
            tttimrID = setTimeout("projektile_2_set(70,40)", 260);
            tttimrID = setTimeout("projektile_2_set(55,30)", 280);
        }
        function projektile_2_aus() {
            projektile_2_div.style.visibility = "hidden";
        }
        function projektile_2_ein() {
            projektile_2_div.style.visibility = "visible";
        }
        function aktion(schritt) {
            energetik_1_temp=energetik_1[schritt-1];
            energetik_2_temp=energetik_2[schritt-1];
            projektile_1_temp=projektile_1[schritt-1];
            projektile_2_temp=projektile_2[schritt-1];
            hangar_1_temp=hangar_1[schritt-1];
            hangar_2_temp=hangar_2[schritt-1];
            schild_1_temp=schild_1[schritt-1];
            schild_2_temp=schild_2[schritt-1];
            schaden_1_temp=schaden_1[schritt-1];
            schaden_2_temp=schaden_2[schritt-1];
            if (energetik_1_temp==1) {
                ttimrID = setTimeout("laser_1_ein()", 100);
                ttimrID = setTimeout("laser_1_aus()", 250);
            }
            if (energetik_2_temp==1) {
                ttimrID = setTimeout("laser_2_ein()", 400);
                ttimrID = setTimeout("laser_2_aus()", 550);
            }
            if (projektile_1_temp==1) {
                projektile_1_div.style.left = 50-8;
                projektile_1_div.style.top = 40-8;
                ttimrID = setTimeout("projektile_1_ein()", 500);
                ttimrID = setTimeout("projektile_1_move()", 520);
                ttimrID = setTimeout("projektile_1_aus()", 820);
                ttimrID = setTimeout("explosion_1_ein()", 820);
                ttimrID = setTimeout("explosion_1_aus()", 970);
            }
            if (projektile_1_temp==2) {
                projektile_1_div.style.left = 50-8;
                projektile_1_div.style.top = 40-8;
                ttimrID = setTimeout("projektile_1_ein()", 500);
                ttimrID = setTimeout("projektile_1_move_weg()", 520);
                ttimrID = setTimeout("projektile_1_aus()", 820);
            }
            if (projektile_2_temp==1) {
                projektile_1_div.style.left = 250-8;
                projektile_1_div.style.top = 170-8;
                ttimrID = setTimeout("projektile_2_ein()", 700);
                ttimrID = setTimeout("projektile_2_move()", 720);
                ttimrID = setTimeout("projektile_2_aus()", 1020);
                ttimrID = setTimeout("explosion_2_ein()", 1020);
                ttimrID = setTimeout("explosion_2_aus()", 1170);
            }
        }
        function tick(schritt) {
            aktion(schritt);
            schrittneu=schritt+1;
            if (schaden_1.length>schritt) {
            timrID = setTimeout("tick(schrittneu)", 2000);
            }
            gelb_1.style.width=<?php echo $laenge?>/100*schild_1[schritt-1];
            img_gelb_1.style.width=<?php echo $laenge?>/100*schild_1[schritt-1];
            text_gelb_1.innerHTML='<?php echo $lang['gefecht']['schild']?>'+schild_1[schritt-1];
            gruen_1.style.width=<?php echo $laenge?>/100*schaden_1[schritt-1];
            img_gruen_1.style.width=<?php echo $laenge?>/100*schaden_1[schritt-1];
            text_gruen_1.innerHTML='<?php echo $lang['gefecht']['rumpf']?>'+schaden_1[schritt-1];
            blau_1.style.width=<?php echo $laenge?>*crew_1[schritt]/crew_1_d;
            img_blau_1.style.width=<?php echo $laenge?>*crew_1[schritt]/crew_1_d;
            text_blau_1.innerHTML='<?php echo $lang['gefecht']['crew']?>'+crew_1[schritt]+"/"+crew_1[0];
            gelb_2.style.width=<?php echo $laenge?>/100*schild_2[schritt-1];
            img_gelb_2.style.width=<?php echo $laenge?>/100*schild_2[schritt-1];
            text_gelb_2.innerHTML='<?php echo $lang['gefecht']['schild']?>'+schild_2[schritt-1];
            gruen_2.style.width=<?php echo $laenge?>/100*schaden_2[schritt-1];
            img_gruen_2.style.width=<?php echo $laenge?>/100*schaden_2[schritt-1];
            text_gruen_2.innerHTML='<?php echo $lang['gefecht']['rumpf']?>'+schaden_2[schritt-1];
            blau_2.style.width=<?php echo $laenge?>*(crew_2[schritt]/crew_2_d);
            img_blau_2.style.width=<?php echo $laenge?>*(crew_2[schritt]/crew_2_d);
            text_blau_2.innerHTML="<?php echo $lang['gefecht']['crew']?>"+crew_2[schritt]+"/"+crew_2[0];
        }
        function nochmal() {
            front.style.visibility = "visible";
            tabelle_1_div.style.visibility="hidden";
            tabelle_2_div.style.visibility="hidden";
        }
        function gefecht() {
            front.style.visibility = "hidden";
            tabelle_1_div.style.visibility="visible";
            tabelle_2_div.style.visibility="visible";
            tick(1);
            dauer=(schaden_1.length)*2000;
            timrID = setTimeout("nochmal()", dauer+5000);
        }
    </script>
    <body text="#ffffff" bgcolor="#000000" style="background-image:url('../bilder/gefecht/hintergrund.gif'); background-attachment:fixed;" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <script language=JavaScript>document.title='<?php echo $lang['gefecht']['gefechtsaufzeichnung']?>';</script>
        <div id="tabelle_1_div" style="position: absolute; left:100px; top:15px; width:<?php echo $laenge?>px; height:50px; visibility:hidden">
            <table  border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td bgcolor="#990000"><div id="gelb_1" style="position: absolute; z-index:1; background-image:url(<?php echo $bildpfad; ?>/skalen/gold_1_r.gif); width:0;"><img id="img_gelb_1" src="../bilder/empty.gif" border="0" width="0" height="12"></div><div id="text_gelb_1" style="position: absolute; z-index:2; color:#151515;"></div></td>
                </tr>
                <tr>
                    <td bgcolor="#990000"><img src="../bilder/empty.gif" border="0" width="<?php echo $laenge?>" height="11"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="2"></td>
                </tr>
                <tr>
                    <td bgcolor="#990000"><div id="gruen_1" style="position: absolute; z-index:1; background-image:url(<?php echo $bildpfad; ?>/skalen/gruen_1_r.gif); width:0;"><img id="img_gruen_1" src="../bilder/empty.gif" border="0" width="0" height="12"></div><div id="text_gruen_1" style="position: absolute; z-index:2; color: #151515;"></div></td>
                </tr>
                <tr>
                    <td bgcolor="#990000"><img src="../bilder/empty.gif" border="0" width="<?php echo $laenge?>" height="11"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="2"></td>
                </tr>
                <tr>
                    <td bgcolor="#990000"><div id="blau_1" style="position: absolute; z-index:1; background-image:url(<?php echo $bildpfad; ?>/skalen/hellblau_1_r.gif); width:0;"><img id="img_blau_1" src="../bilder/empty.gif" border="0" width="0" height="12"></div><div id="text_blau_1" style="position: absolute; z-index:2; color:#151515;"></div></td>
                </tr>
                <tr>
                    <td bgcolor="#990000"><img src="../bilder/empty.gif" border="0" width="<?php echo $laenge?>" height="11"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="2"></td>
                </tr>
            </table>
        </div>        
        <div id="tabelle_2_div" style="position: absolute; left:100px; top:141px; width:<?php echo $laenge?>px; height:50px; visibility:hidden">
            <table  border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td bgcolor="#990000"><div id="gelb_2" style="position: absolute; z-index:1; background-image:url(<?php echo $bildpfad; ?>/skalen/gold_1_r.gif); width:0;"><img id="img_gelb_2" src="../bilder/empty.gif" border="0" width="0" height="12"></div><div id="text_gelb_2" style="position: absolute; z-index:2; color:#151515;"></div></td>
                </tr>
                <tr>
                    <td bgcolor="#990000"><img src="../bilder/empty.gif" border="0" width="<?php echo $laenge?>" height="11"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="2"></td>
                </tr>
                <tr>
                    <td bgcolor="#990000"><div id="gruen_2" style="position: absolute; z-index:1; background-image:url(<?php echo $bildpfad; ?>/skalen/gruen_1_r.gif); width:0;"><img id="img_gruen_2" src="../bilder/empty.gif" border="0" width="0" height="12"></div><div id="text_gruen_2" style="position: absolute; z-index:2; color: #151515;"></div></td>
                </tr>
                <tr>
                    <td bgcolor="#990000"><img src="../bilder/empty.gif" border="0" width="<?php echo $laenge?>" height="11"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="2"></td>
                </tr>
                <tr>
                    <td bgcolor="#990000"><div id="blau_2" style="position: absolute; z-index:1; background-image:url(<?php echo $bildpfad; ?>/skalen/hellblau_1_r.gif); width:0;"><img id="img_blau_2" src="../bilder/empty.gif" border="0" width="0" height="12"></div><div id="text_blau_2" style="position: absolute; z-index:2; color:#151515;"></div></td>
                </tr>
                <tr>
                    <td bgcolor="#990000"><img src="../bilder/empty.gif" border="0" width="<?php echo $laenge?>" height="11"></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="2"></td>
                </tr>
            </table>
        </div>
        <div id="schiff_1_div" style="position: absolute; left:15px; top:15px; width:75px; height:50px;"><img border="0" src="../daten/<?php echo $rasse_1; ?>/bilder_schiffe/<?php echo $bild_1; ?>"></div>
        <div id="schiff_2_div" style="position: absolute; left:210px; top:141px; width:75px; height:50px;"><img border="0" src="../daten/<?php echo $rasse_2; ?>/bilder_schiffe/<?php echo $bild_2; ?>"></div>
        <div id="explosion_1_div" style="position: absolute; left:0px; top:0px; width:300px; height:206px;visibility:hidden;"><img border="0" src="../bilder/gefecht/explosion_1.gif"></div>
        <div id="explosion_2_div" style="position: absolute; left:0px; top:0px; width:300px; height:206px;visibility:hidden;"><img border="0" src="../bilder/gefecht/explosion_2.gif"></div>
        <div id="energetik_1_div" style="position: absolute; left:0px; top:0px; width:300px; height:206px;visibility:hidden;"><img border="0" src="../bilder/gefecht/energetik_1.gif"></div>
        <div id="energetik_2_div" style="position: absolute; left:0px; top:0px; width:300px; height:206px;visibility:hidden;"><img border="0" src="../bilder/gefecht/energetik_2.gif"></div>
        <div id="projektile_1_div" style="position: absolute; left:0px; top:0px; width:17px; height:17px;visibility:hidden;"><img border="0" src="../bilder/gefecht/projektile_1.gif"></div>
        <div id="projektile_2_div" style="position: absolute; left:0px; top:0px; width:17px; height:17px;visibility:hidden;"><img border="0" src="../bilder/gefecht/projektile_2.gif"></div>
        <div id="front" style="position: absolute; left:0px; top:0px; width:300px; height:206px;">
            <center>
                <table border="0" cellspacing="0" cellpadding="0" height="206">
                    <tr>
                        <td>
                            <center>
                                <?php echo str_replace('{1}',$name_1,str_replace('{2}',$name_2,$lang['gefecht']['gegen']))?>
                                <input type="button" value="<?php echo $lang['gefecht']['aufzeichnungstarten']?>" onclick="gefecht();"
                            </center>
                        </td>
                    </tr>
                </table>
            </center>
        </div>
        <?php
    include ("inc.footer.php");
}
