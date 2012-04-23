<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'meta_simulation';
$fuid = int_get('fu');

if ($fuid==1) {
    include ("inc.header.php");
    ///////////////////////////////////////////////////////////////////////////////////////////////RASSENEIGENSCHAFTEN ANFANG
    $daten_verzeichnis=$main_verzeichnis."../daten/";
    $handle=opendir("$daten_verzeichnis");
    $zaehler=0;
    while ($rasse=readdir($handle)) {
        if ((substr($rasse,0,1)<>'.') and (substr($rasse,0,7)<>'bilder_') and (substr($rasse,strlen($rasse)-4,4)<>'.txt')) {
            if($rasse == "unknown" or $rasse == "CVS") { continue; }
            $daten="";
            $attribute="";
            $file=$daten_verzeichnis.$rasse.'/daten.txt';
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
            $attribute=explode(":",$daten[2]);
            $name_rasse[$zaehler]=$daten[0];
            $r_eigenschaften[$zaehler]['bodenangriff']=$attribute[3];
            $r_eigenschaften[$zaehler]['bodenverteidigung']=$attribute[4];
            $zaehler++;
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////RASSENEIGENSCHAFTEN ENDE
    ?>
    <script language=JavaScript>
        function test(opj){
            opj=(!opj)?0:(isNaN(opj)?0:opj);
            return opj;
        }
        function kampf(i1,i2){
            if(a[i1] && v[i2]){
                z=a[i1]*aa[i1]-v[i2]*vv[i2];
                if(z>0){
                    a[i1]=Math.round(z/aa[i1]);
                    v[i2]=0;
                }else{
                    a[i1]=0;
                    v[i2]=Math.round(-z/vv[i2]);;
                }
            }
        }
        function rechnen(e) {
            a = new Array(0,0,0);
            v = new Array(0,0,0);
            aa = new Array(1,1,1);
            vv = new Array(1,1,1);
            formular.angreifer_kraft.value=test(eval(formular.angreifer_kraft.value));
            a_s=formular.angreifer_kraft.value;
            formular.verteidiger_kraft.value=test(eval(formular.verteidiger_kraft.value));
            v_s=test(formular.verteidiger_kraft.value);
            formular.angreifer_anzahl.value=test(eval(formular.angreifer_anzahl.value));
            a[0]=formular.angreifer_anzahl.value;
            formular.verteidiger_anzahl.value=test(eval(formular.verteidiger_anzahl.value));
            v[0]=test(formular.verteidiger_anzahl.value);
            formular.angreifer_leichtebt.value=test(eval(formular.angreifer_leichtebt.value));
            a[1]=test(formular.angreifer_leichtebt.value);
            formular.verteidiger_leichtebt.value=test(eval(formular.verteidiger_leichtebt.value));
            v[1]=test(formular.verteidiger_leichtebt.value);
            formular.angreifer_schwerebt.value=test(eval(formular.angreifer_schwerebt.value));
            formular.verteidiger_schwerebt.value=test(eval(formular.verteidiger_schwerebt.value));
            a[2]=test(formular.angreifer_schwerebt.value);
            v[2]=test(formular.verteidiger_schwerebt.value);
            aa[0]=a_s;
            aa[1]=16*a_s;
            aa[2]=100*a_s;
            vv[0]=v_s;
            vv[1]=16*v_s;
            vv[2]=80*v_s;
            kampf(2,2);
            kampf(1,1);
            kampf(2,1);
            kampf(1,2);
            kampf(2,0);
            kampf(0,2);
            kampf(1,0);
            kampf(0,1);
            kampf(0,0);
            a_k_text.innerHTML=a[0];
            v_k_text.innerHTML=v[0];
            a_l_text.innerHTML=a[1];
            v_l_text.innerHTML=v[1];
            a_s_text.innerHTML=a[2];
            v_s_text.innerHTML=v[2];
            if(a[0]||a[1]||a[2]){
                end_text.innerHTML='<?php echo $lang['metasimulation']['angreifergewinntbk']?>';
            }else if(v[0]||v[1]||v[2]){
                end_text.innerHTML='<?php echo $lang['metasimulation']['verteidigergewinntbk']?>';
            }else{
                end_text.innerHTML='<?php echo $lang['metasimulation']['keinergewinntbk']?>';
            }
        }
    </script>
    <body text="#000000" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
        <center>
            <table border="0" cellspacing="0" cellpadding="0" height="100%">
                <tr>
                    <td>
                        <center>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="10" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><center><img src="../lang/<?php echo $spieler_sprache?>/topics/simbb.gif" width="391" height="26" border="0"></center></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="15" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td align="right"><?php echo $lang['metasimulation']['angreifer']?></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><?php echo $lang['metasimulation']['verteidiger']?></td>
                                </tr>
                                <tr>
                                    <td><form name="formular"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="10" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="angreifer_kraft" style="width:270px;">
                                            <?php
                                            for ($n=0;$n<$zaehler;$n++) {
                                                ?>
                                                <option value="<?php echo $r_eigenschaften[$n]['bodenangriff']?>" style="background-color:#444444;"><?php echo $name_rasse[$n].str_replace('{1}',$r_eigenschaften[$n]['bodenangriff']*100,$lang['metasimulation']['vh']);?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><center>&lt;&lt;&lt; <?php echo $lang['metasimulation']['volk']?> &gt;&gt;&gt;</center></td>
                                    <td>
                                        <select name="verteidiger_kraft" style="width:270px;">
                                            <?php
                                            for ($n=0;$n<$zaehler;$n++) {
                                                ?>
                                                <option value="<?php echo $r_eigenschaften[$n]['bodenverteidigung']?>" style="background-color:#444444;"><?php echo $name_rasse[$n].str_replace('{1}',$r_eigenschaften[$n]['bodenverteidigung']*100,$lang['metasimulation']['vh']);?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="170" height="5" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td align="right"><input type="text" name="angreifer_anzahl" class="eingabe" style="width:135px;"></td>
                                    <td>
                                        <center>
                                            <table cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                    <td>&lt;&lt;&lt;</td>
                                                    <td><img src="<?php echo $bildpfad?>/icons/crew.gif" border="0" width="17" height="17"></td>
                                                    <td><?php echo $lang['metasimulation']['kolonisten']?></td>
                                                    <td><img src="<?php echo $bildpfad?>/icons/crew.gif" border="0" width="17" height="17"></td>
                                                    <td>&gt;&gt;&gt;</td>
                                                </tr>
                                            </table>
                                        </center>
                                    </td>
                                    <td><input type="text" name="verteidiger_anzahl" class="eingabe" style="width:135px;"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="5" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td align="right"><input type="text" name="angreifer_leichtebt" class="eingabe" style="width:135px;"></td>
                                    <td>
                                        <center>
                                            <table cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                    <td>&lt;&lt;&lt;</td>
                                                    <td><img src="<?php echo $bildpfad?>/icons/leichtebt.gif" border="0" width="17" height="17"></td>
                                                    <td><?php echo $lang['metasimulation']['leichtebt']?></td>
                                                    <td><img src="<?php echo $bildpfad?>/icons/leichtebt.gif" border="0" width="17" height="17"></td>
                                                    <td>&gt;&gt;&gt;</td>
                                                </tr>
                                            </table>
                                        </center>
                                    </td>
                                    <td><input type="text" name="verteidiger_leichtebt" class="eingabe" style="width:135px;"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="5" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td align="right"><input type="text" name="angreifer_schwerebt" class="eingabe" style="width:135px;"></td>
                                    <td>
                                        <center>
                                            <table cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                    <td>&lt;&lt;&lt;</td>
                                                    <td><img src="<?php echo $bildpfad?>/icons/schwerebt.gif" border="0" width="17" height="17"></td>
                                                    <td><?php echo $lang['metasimulation']['schwerebt']?></td>
                                                    <td><img src="<?php echo $bildpfad?>/icons/schwerebt.gif" border="0" width="17" height="17"></td>
                                                    <td>&gt;&gt;&gt;</td>
                                                </tr>
                                            </table>
                                        </center>
                                    </td>
                                    <td><input type="text" name="verteidiger_schwerebt" class="eingabe" style="width:135px;"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="5" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><input type="button" value="<?php echo $lang['metasimulation']['simulationstarten']?>" onclick="rechnen();" name="subbutton" style="width:170px;"></td>
                                    <td></form></td>
                                </tr>
                            </table>
                        </center>
                        <center>
                            <table  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="200" height="1" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="100" height="10" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="200" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><center><?php echo $lang['metasimulation']['ueberlebende']?></center></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="100" height="10" border="0"></td>
                                </tr>
                                <tr>
                                    <td><center><img src="<?php echo $bildpfad?>/icons/crew.gif" border="0" width="17" height="17"></center></td>
                                    <td><center>&lt;&lt;&lt; <?php echo $lang['metasimulation']['kolonisten']?> &gt;&gt;&gt;</center></td>
                                    <td><center><img src="<?php echo $bildpfad?>/icons/crew.gif" border="0" width="17" height="17"></center></td>
                                </tr>
                                <tr>
                                    <td><center><div id="a_k_text">0</div></center></td>
                                    <td></td>
                                    <td><center><div id="v_k_text">0</div></center></td>
                                </tr>
                                <tr>
                                    <td><center><img src="<?php echo $bildpfad?>/icons/leichtebt.gif" border="0" width="17" height="17"></center></td>
                                    <td><center>&lt;&lt;&lt; <?php echo $lang['metasimulation']['leichtebt']?> &gt;&gt;&gt;</center></td>
                                    <td><center><img src="<?php echo $bildpfad?>/icons/leichtebt.gif" border="0" width="17" height="17"></center></td>
                                </tr>
                                <tr>
                                    <td><center><div id="a_l_text">0</div></center></td>
                                    <td></td>
                                    <td><center><div id="v_l_text">0</div></center></td>
                                </tr>
                                <tr>
                                    <td><center><img src="<?php echo $bildpfad?>/icons/schwerebt.gif" border="0" width="17" height="17"></center></td>
                                    <td><center>&lt;&lt;&lt; <?php echo $lang['metasimulation']['schwerebt']?> &gt;&gt;&gt;</center></td>
                                    <td><center><img src="<?php echo $bildpfad?>/icons/schwerebt.gif" border="0" width="17" height="17"></center></td>
                                </tr>
                                <tr>
                                    <td><center><div id="a_s_text">0</div></center></td>
                                    <td></td>
                                    <td><center><div id="v_s_text">0</div></center></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="1" height="25" border="0"></td>
                                </tr>
                            </table>
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td><div id="end_text"></div></td>
                                </tr>
                            </table>
                        </center>
                    </td>
                </tr>
            </table>
        </center>
        </div>
        <?php
    include ("inc.footer.php");
}
if ($fuid==2) {
    include ("inc.header.php");
    ///////////////////////////////////////////////////////////////////////////////////////////////SCHIFFE ANFANG
    $daten_verzeichnis=$main_verzeichnis."../daten/";
    $handle=opendir("$daten_verzeichnis");
    $zaehler=0;
    $schiffe="";
    while ($rasse=readdir($handle)) {
        if ((substr($rasse,0,1)<>'.') and (substr($rasse,0,7)<>'bilder_') and (substr($rasse,strlen($rasse)-4,4)<>'.txt')) {
            if($rasse == "unknown" or $rasse == "CVS") { continue; }
            $daten="";
            $file=$daten_verzeichnis.$rasse.'/daten.txt';
            $fp = @fopen("$file","r");
            if ($fp) {
                $zaehler5=0;
                while (!feof ($fp)) {
                    $buffer = @fgets($fp, 4096);
                    $daten[$zaehler5]=$buffer;
                    $zaehler5++;
                }
                @fclose($fp);
            }
            $name_rasse[$zaehler]=$daten[0];
            $file=$daten_verzeichnis.$rasse.'/schiffe.txt';
            $fp = @fopen("$file","r");
            if ($fp) {
                $zaehler3[$zaehler]=0;
                $zaehler2=0;
                while (!feof ($fp)) {
                    $buffer = @fgets($fp, 4096);
                    $daten[$zaehler][$zaehler2]=$buffer;
                    $temp=explode(":",$buffer);
                    $schiffe[$zaehler][$zaehler2][0]=$temp[0];
                    $masse=$temp[16];
                    $anzahl_energie=$temp[9];
                    $anzahl_projektil=$temp[10];
                    $anzahl_hangar=$temp[11];
                    $crewmax=$temp[15];
                    $frachtraum=$temp[12];
                    $fertigkeiten=$temp[17];
                    $luckyshot=@intval(substr($fertigkeiten,55,1));
                    $daempfer_fert=@intval(substr($fertigkeiten,61,1));
                    $kamikaze_erfolg=@intval(substr($fertigkeiten,62,1))*10;
                    $kamikaze_schaden=@intval(substr($fertigkeiten,63,1))*100;
                    $schiffe[$zaehler][$zaehler2][1]=$masse.":".$anzahl_energie.":".$anzahl_projektil.":".$anzahl_hangar.":".$crewmax.":".$luckyshot.":".$daempfer_fert.":".$kamikaze_erfolg.":".$kamikaze_schaden.":".$frachtraum;
                    $zaehler3[$zaehler]++;
                    $zaehler2++;
                }
                @fclose($fp);
            }
            $zaehler++;
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////RASSENEIGENSCHAFTEN ENDE
    ?>
    <script language=JavaScript>
        strahlenschaden = new Array(3,7,10,15,12,29,35,37,18,45);
        strahlenschadencrew = new Array(1,2,2,4,16,7,8,9,35,11);
        torpedoschaden = new Array(5,8,10,6,15,30,35,12,48,55);
        torpedoschadencrew = new Array(1,2,2,13,6,7,8,36,12,14);
        schiff_masse=new Array();
        schiff_anz_e=new Array();
        schiff_anz_p=new Array();
        schiff_anz_h=new Array();
        schiff_crew=new Array();
        schiff_lucky=new Array();
        schiff_daempfer=new Array();
        schiff_kk_e=new Array();
        schiff_kk_s=new Array();
        schiff_fracht=new Array();
        kampf_schild1=new Array();
        kampf_schild2=new Array();
        kampf_schaden1=new Array();
        kampf_schaden2=new Array();
        kampf_crew1=new Array();
        kampf_crew2=new Array();
        kampf_sonstiges1=new Array();
        kampf_sonstiges2=new Array();
        kampf_ausweichen1=new Array();
        kampf_ausweichen2=new Array();
        angreifer_erfahrung=0;
        verteidiger_erfahrung=0;
        crew_shid1=0;
        crew_bol_max1=1;
        crew_shid2=0;
        crew_bol_max2=1;
        superzeit=0;
        <?php
        for($i1=0;$i1<$zaehler;$i1++){
            echo "schiff_masse[$i1]=new Array();\n";
            echo "schiff_anz_e[$i1]=new Array();\n";
            echo "schiff_anz_p[$i1]=new Array();\n";
            echo "schiff_anz_h[$i1]=new Array();\n";
            echo "schiff_crew[$i1]=new Array();\n";
            echo "schiff_lucky[$i1]=new Array();\n";
            echo "schiff_daempfer[$i1]=new Array();\n";
            echo "schiff_kk_e[$i1]=new Array();\n";
            echo "schiff_kk_s[$i1]=new Array();\n";
            echo "schiff_fracht[$i1]=new Array();\n";
        }
        for($i1=0;$i1<$zaehler;$i1++){
            for($i2=0;$i2<$zaehler3[$i1];$i2++){
                $temp=explode(":",$schiffe[$i1][$i2][1]);
                echo "schiff_masse[$i1][$i2]=$temp[0];\n";
                echo "schiff_anz_e[$i1][$i2]=$temp[1];\n";
                echo "schiff_anz_p[$i1][$i2]=$temp[2];\n";
                echo "schiff_anz_h[$i1][$i2]=$temp[3];\n";
                echo "schiff_crew[$i1][$i2]=$temp[4];\n";
                echo "schiff_lucky[$i1][$i2]=$temp[5];\n";
                echo "schiff_daempfer[$i1][$i2]=$temp[6];\n";
                echo "schiff_kk_e[$i1][$i2]=$temp[7];\n";
                echo "schiff_kk_s[$i1][$i2]=$temp[8];\n";
                echo "schiff_fracht[$i1][$i2]=$temp[9];\n";
            }
        }
        ?>
        function schalter1(a) {
            angreifer_erfahrung=a;
            if(a==1){
                erf10.style.visibility="hidden";
                erf11.style.visibility="visible";
            }else if(a==2){
                erf11.style.visibility="hidden";
                erf12.style.visibility="visible";
            }else if(a==3){
                erf12.style.visibility="hidden";
                erf13.style.visibility="visible";
            }else if(a==4){
                erf13.style.visibility="hidden";
                erf14.style.visibility="visible";
            }else if(a==5){
                erf14.style.visibility="hidden";
                erf15.style.visibility="visible";
            }else if(a==0){
                erf15.style.visibility="hidden";
                erf10.style.visibility="visible";
            }
        }
        function schalter2(a) {
            verteidiger_erfahrung=a;
            if(a==1){
                erf20.style.visibility="hidden";
                erf21.style.visibility="visible";
            }else if(a==2){
                erf21.style.visibility="hidden";
                erf22.style.visibility="visible";
            }else if(a==3){
                erf22.style.visibility="hidden";
                erf23.style.visibility="visible";
            }else if(a==4){
                erf23.style.visibility="hidden";
                erf24.style.visibility="visible";
            }else if(a==5){
                erf24.style.visibility="hidden";
                erf25.style.visibility="visible";
            }else if(a==0){
                erf25.style.visibility="hidden";
                erf20.style.visibility="visible";
            }
        };
        function anz_r1() {
            i=formular.angreifer_schiff.value;
            faktor=(formular.angreifer_zusatzmodul.value==3)?1.19:1;
            max2.innerHTML=' ';
            if(i>0){
                i2=i%1000-1;
                i1=(i-i2-1)/1000;
                if(schiff_daempfer[i1][i2]){
                    faktor=Math.round(schiff_fracht[i1][i2]*faktor);
                    max2.innerHTML='&nbsp;&lt;= ' + faktor;
                    ren=(isNaN(formular.angreifer_anz_ren.value))?0:eval(formular.angreifer_anz_ren.value+'+0');
                    if(ren>faktor){ren=faktor;}
                    if(0>ren){ren=0;}
                    formular.angreifer_anz_ren.value=eval(ren+'+0');
                }
            }
            return true;
        };
        function anz_r2() {
            i=formular.verteidiger_schiff.value;
            faktor=(formular.verteidiger_zusatzmodul.value==3)?1.19:1;
            max4.innerHTML=' ';
            if(i>0){
                i2=i%1000-1;
                i1=(i-i2-1)/1000;
                if(schiff_daempfer[i1][i2]){
                    faktor=Math.round(schiff_fracht[i1][i2]*faktor);
                    max4.innerHTML='&nbsp;&lt;= ' + faktor;
                    ren=(isNaN(formular.verteidiger_anz_ren.value))?0:eval(formular.verteidiger_anz_ren.value+'+0');
                    if(ren>faktor){ren=faktor;}
                    if(0>ren){ren=0;}
                    formular.verteidiger_anz_ren.value=eval(ren+'+0');
                }
            }
            return true;
        };
        function anz_p1() {
            i=formular.angreifer_schiff.value;
            faktor=(formular.angreifer_zusatzmodul.value==2)?1.5:1;
            max1.innerHTML=' ';
            if(i>0){
                i2=i%1000-1;
                i1=(i-i2-1)/1000;
                if(schiff_anz_p[i1][i2]){
                    faktor=Math.round((schiff_anz_p[i1][i2])*5*faktor);
                    max1.innerHTML='&nbsp;&lt;= ' + faktor;
                    torpedo=(isNaN(formular.angreifer_anz_torpedo.value))?0:eval(formular.angreifer_anz_torpedo.value+'+0');
                    if(torpedo>faktor){torpedo=faktor;}
                    if(0>torpedo){torpedo=0;}
                    formular.angreifer_anz_torpedo.value=eval(torpedo+'+0');
                }
            }
            return true;
        };
        function anz_p2() {
            i=formular.verteidiger_schiff.value;
            faktor=(formular.verteidiger_zusatzmodul.value==2)?1.5:1;
            max3.innerHTML=' ';
            if(i>0){
                i2=i%1000-1;
                i1=(i-i2-1)/1000;
                if(schiff_anz_p[i1][i2]){
                    faktor=Math.round((schiff_anz_p[i1][i2])*5*faktor);
                    max3.innerHTML='&nbsp;&lt;= ' + faktor;
                    torpedo=(isNaN(formular.verteidiger_anz_torpedo.value))?0:eval(formular.verteidiger_anz_torpedo.value+'+0');
                    if(torpedo>faktor){torpedo=faktor;}
                    if(0>torpedo){torpedo=0;}
                    formular.verteidiger_anz_torpedo.value=eval(torpedo+'+0');
                }
            }
            return true;
        };
        function anz_c1() {
            i=formular.angreifer_schiff.value;
            maxcrew1.innerHTML=' ';
            if(i>0){
                i2=i%1000-1;
                i1=(i-i2-1)/1000;
                if(schiff_crew[i1][i2]){
                    faktor=schiff_crew[i1][i2];
                    maxcrew1.innerHTML='&nbsp;&lt;= ' + faktor;
                    crew=(isNaN(formular.angreifer_crew.value))?0:eval(formular.angreifer_crew.value+'+0');
                    if(crew_shid1==i){
                        if(crew>=faktor){
                            crew=faktor;
                            crew_bol_max1=1;
                        }else{
                            crew_bol_max1=0;
                        }
                    }else{
                        if(crew_bol_max1==1){
                            crew=faktor;
                        }else{
                            if(crew>=faktor){
                                crew_bol_max1=1;
                                crew=faktor;
                            }else{
                                crew_bol_max1=0;
                            }
                        }
                    }
                    if(0>crew){crew=0;}
                    formular.angreifer_crew.value=eval(crew+'+0');
                }
            }
            crew_shid1=i;
            return true;
        };
        function anz_c2() {
            i=formular.verteidiger_schiff.value;
            maxcrew2.innerHTML=' ';
            if(i>0){
                i2=i%1000-1;
                i1=(i-i2-1)/1000;
                if(schiff_crew[i1][i2]){
                    faktor=schiff_crew[i1][i2];
                    maxcrew2.innerHTML=faktor+' =&gt;&nbsp;';
                    crew=(isNaN(formular.verteidiger_crew.value))?0:eval(formular.verteidiger_crew.value+'+0');
                    if(crew_shid2==i){
                        if(crew>=faktor){
                            crew=faktor;
                            crew_bol_max2=1;
                        }else{
                            crew_bol_max2=0;
                        }
                    }else{
                        if(crew_bol_max2==1){
                            crew=faktor;
                        }else{
                            if(crew>=faktor){
                                crew_bol_max2=1;
                                crew=faktor;
                            }else{
                                crew_bol_max2=0;
                            }
                        }
                    }
                    if(0>crew){crew=0;}
                    formular.verteidiger_crew.value=eval(crew+'+0');
                }
            }
            crew_shid2=i;
            return true;
        };
        function schiff1(){
            i=formular.angreifer_schiff.value;
            j=formular.verteidiger_schiff.value;
            formular.subbutton.style.visibility="hidden";
            formular.angreifer_energetik.style.visibility="hidden";
            formular.angreifer_projektile.style.visibility="hidden";
            formular.angreifer_kapern.style.visibility="hidden";
            formular.angreifer_stark.style.visibility="hidden";
            formular.angreifer_zusatzmodul.style.visibility="hidden";
            formular.angreifer_schaden.style.visibility="hidden";
            formular.angreifer_schild.style.visibility="hidden";
            formular.angreifer_aggro.style.visibility="hidden";
            anz_torpedo1.style.visibility="hidden";
            anz_ren1.style.visibility="hidden";
            anz_crew1.style.visibility="hidden";
            erf10.style.visibility="hidden";
            erf11.style.visibility="hidden";
            erf12.style.visibility="hidden";
            erf13.style.visibility="hidden";
            erf14.style.visibility="hidden";
            erf15.style.visibility="hidden";
            t_1_1_1.style.visibility="hidden";
            t_1_1_2.style.visibility="hidden";
            t_1_3_1.style.visibility="hidden";
            t_1_3_2.style.visibility="hidden";
            t_1_5_1.style.visibility="hidden";
            t_1_5_2.style.visibility="hidden";
            t_1_7_1.style.visibility="hidden";
            t_1_7_2.style.visibility="hidden";
            t_1_9_1.style.visibility="hidden";
            t_1_9_2.style.visibility="hidden";
            t_1_11_1.style.visibility="hidden";
            t_1_11_2.style.visibility="hidden";
            t_1_12_1.style.visibility="hidden";
            t_1_13_1.style.visibility="hidden";
            if(i>0){
                formular.angreifer_zusatzmodul.style.visibility="visible";
                formular.angreifer_aggro.style.visibility="visible";
                anz_crew1.style.visibility="visible";
                t_1_3_1.style.visibility="visible";
                t_1_11_2.style.visibility="visible";
                t_1_13_1.style.visibility="visible";
                i2=i%1000-1;
                i1=(i-i2-1)/1000;
                anz_c1();
                if(schiff_anz_e[i1][i2]){
                    formular.angreifer_energetik.style.visibility="visible";
                    t_1_1_1.style.visibility="visible";
                }
                if((formular.angreifer_zusatzmodul.value==4)||(schiff_anz_h[i1][i2])||(schiff_anz_e[i1][i2])||(schiff_anz_p[i1][i2])){
                    formular.angreifer_kapern.style.visibility="visible";
                    formular.angreifer_stark.style.visibility="visible";
                    formular.angreifer_schaden.style.visibility="visible";
                    formular.angreifer_schild.style.visibility="visible";
                    t_1_5_1.style.visibility="visible";
                    t_1_7_1.style.visibility="visible";
                    t_1_7_2.style.visibility="visible";
                    t_1_9_1.style.visibility="visible";
                    t_1_9_2.style.visibility="visible";
                    schalter1(angreifer_erfahrung);
                }
                if(schiff_anz_p[i1][i2]){
                    formular.angreifer_projektile.style.visibility="visible";
                    anz_torpedo1.style.visibility="visible";
                    t_1_1_2.style.visibility="visible";
                    t_1_3_2.style.visibility="visible";
                }
                anz_p1();
                if(schiff_daempfer[i1][i2]){
                    t_1_5_2.style.visibility="visible";
                    anz_ren1.style.visibility="visible";
                    t_1_12_1.style.visibility="visible";
                    t_1_11_1.style.visibility="visible";
                }
                anz_r1();
                if(j>0){
                    formular.subbutton.style.visibility="visible";
                }
            }
        }
        function schiff2(){
            i=formular.verteidiger_schiff.value;
            j=formular.angreifer_schiff.value;
            formular.subbutton.style.visibility="hidden";
            formular.verteidiger_energetik.style.visibility="hidden";
            formular.verteidiger_projektile.style.visibility="hidden";
            formular.verteidiger_kapern.style.visibility="hidden";
            formular.verteidiger_stark.style.visibility="hidden";
            formular.verteidiger_zusatzmodul.style.visibility="hidden";
            formular.verteidiger_schaden.style.visibility="hidden";
            formular.verteidiger_schild.style.visibility="hidden";
            formular.verteidiger_aggro.style.visibility="hidden";
            anz_torpedo2.style.visibility="hidden";
            anz_ren2.style.visibility="hidden";
            anz_crew2.style.visibility="hidden";
            erf20.style.visibility="hidden";
            erf21.style.visibility="hidden";
            erf22.style.visibility="hidden";
            erf23.style.visibility="hidden";
            erf24.style.visibility="hidden";
            erf25.style.visibility="hidden";
            t_2_1_1.style.visibility="hidden";
            t_2_1_2.style.visibility="hidden";
            t_2_3_1.style.visibility="hidden";
            t_2_3_2.style.visibility="hidden";
            t_2_5_1.style.visibility="hidden";
            t_2_5_2.style.visibility="hidden";
            t_2_7_1.style.visibility="hidden";
            t_2_7_2.style.visibility="hidden";
            t_2_9_1.style.visibility="hidden";
            t_2_9_2.style.visibility="hidden";
            t_2_11_1.style.visibility="hidden";
            t_2_11_2.style.visibility="hidden";
            t_2_12_2.style.visibility="hidden";
            t_2_13_2.style.visibility="hidden";
            if(i>0){
                formular.verteidiger_zusatzmodul.style.visibility="visible";
                formular.verteidiger_aggro.style.visibility="visible";
                anz_crew2.style.visibility="visible";
                t_2_3_2.style.visibility="visible";
                t_2_11_1.style.visibility="visible";
                t_2_13_2.style.visibility="visible";
                anz_c2();
                i2=i%1000-1;
                i1=(i-i2-1)/1000;
                if(schiff_anz_e[i1][i2]){
                    formular.verteidiger_energetik.style.visibility="visible";
                    t_2_1_2.style.visibility="visible";
                }
                if((formular.verteidiger_zusatzmodul.value==4)||(schiff_anz_h[i1][i2])||(schiff_anz_e[i1][i2])||(schiff_anz_p[i1][i2])){
                    formular.verteidiger_kapern.style.visibility="visible";
                    formular.verteidiger_stark.style.visibility="visible";
                    formular.verteidiger_schaden.style.visibility="visible";
                    formular.verteidiger_schild.style.visibility="visible";
                    t_2_5_2.style.visibility="visible";
                    t_2_7_2.style.visibility="visible";
                    t_2_7_1.style.visibility="visible";
                    t_2_9_2.style.visibility="visible";
                    t_2_9_1.style.visibility="visible";
                    schalter2(verteidiger_erfahrung);
                }
                if(schiff_anz_p[i1][i2]){
                    formular.verteidiger_projektile.style.visibility="visible";
                    anz_torpedo2.style.visibility="visible";
                    t_2_1_1.style.visibility="visible";
                    t_2_3_1.style.visibility="visible";
                }
                anz_p2();
                if(schiff_daempfer[i1][i2]){
                    t_2_5_1.style.visibility="visible";
                    anz_ren2.style.visibility="visible";
                    t_2_11_2.style.visibility="visible";
                    t_2_12_2.style.visibility="visible";
                }
                anz_r2();
                if(j>0){
                    formular.subbutton.style.visibility="visible";
                }
            }
        }
        function zufall(a,b){
            i=0;
            e=1;
            z=0;
            for(i=0;32>i;i++){
                z=z+Math.random()*e;
                e=e*2;
            }
            z=a+(z*(b-a+1)/4294967296);
            return z;
        }
        function verstecke(){
            formular.subbutton.style.visibility="hidden";
            schiffauswahl.style.visibility="hidden";
            formular.subbutton.style.visibility="hidden";
            formular.verteidiger_energetik.style.visibility="hidden";
            formular.verteidiger_projektile.style.visibility="hidden";
            formular.verteidiger_kapern.style.visibility="hidden";
            formular.verteidiger_stark.style.visibility="hidden";
            formular.verteidiger_zusatzmodul.style.visibility="hidden";
            formular.verteidiger_schaden.style.visibility="hidden";
            formular.verteidiger_schild.style.visibility="hidden";
            formular.verteidiger_aggro.style.visibility="hidden";
            anz_torpedo2.style.visibility="hidden";
            anz_ren2.style.visibility="hidden";
            anz_crew2.style.visibility="hidden";
            erf20.style.visibility="hidden";
            erf21.style.visibility="hidden";
            erf22.style.visibility="hidden";
            erf23.style.visibility="hidden";
            erf24.style.visibility="hidden";
            erf25.style.visibility="hidden";
            t_2_1_1.style.visibility="hidden";
            t_2_1_2.style.visibility="hidden";
            t_2_3_1.style.visibility="hidden";
            t_2_3_2.style.visibility="hidden";
            t_2_5_1.style.visibility="hidden";
            t_2_5_2.style.visibility="hidden";
            t_2_7_1.style.visibility="hidden";
            t_2_7_2.style.visibility="hidden";
            t_2_9_1.style.visibility="hidden";
            t_2_9_2.style.visibility="hidden";
            t_2_11_1.style.visibility="hidden";
            t_2_11_2.style.visibility="hidden";
            t_2_12_2.style.visibility="hidden";
            t_2_13_2.style.visibility="hidden";
            formular.angreifer_energetik.style.visibility="hidden";
            formular.angreifer_projektile.style.visibility="hidden";
            formular.angreifer_kapern.style.visibility="hidden";
            formular.angreifer_stark.style.visibility="hidden";
            formular.angreifer_zusatzmodul.style.visibility="hidden";
            formular.angreifer_schaden.style.visibility="hidden";
            formular.angreifer_schild.style.visibility="hidden";
            formular.angreifer_aggro.style.visibility="hidden";
            anz_torpedo1.style.visibility="hidden";
            anz_ren1.style.visibility="hidden";
            anz_crew1.style.visibility="hidden";
            erf10.style.visibility="hidden";
            erf11.style.visibility="hidden";
            erf12.style.visibility="hidden";
            erf13.style.visibility="hidden";
            erf14.style.visibility="hidden";
            erf15.style.visibility="hidden";
            t_1_1_1.style.visibility="hidden";
            t_1_1_2.style.visibility="hidden";
            t_1_3_1.style.visibility="hidden";
            t_1_3_2.style.visibility="hidden";
            t_1_5_1.style.visibility="hidden";
            t_1_5_2.style.visibility="hidden";
            t_1_7_1.style.visibility="hidden";
            t_1_7_2.style.visibility="hidden";
            t_1_9_1.style.visibility="hidden";
            t_1_9_2.style.visibility="hidden";
            t_1_11_1.style.visibility="hidden";
            t_1_11_2.style.visibility="hidden";
            t_1_12_1.style.visibility="hidden";
            t_1_13_1.style.visibility="hidden";
        }
        function zeige(){
            Kampftabelle.style.visibility="hidden";
            k_1_1.style.visibility="hidden";
            k_1_2.style.visibility="hidden";
            k_2_1.style.visibility="hidden";
            k_2_2.style.visibility="hidden";
            k_3_1.style.visibility="hidden";
            k_3_2.style.visibility="hidden";
            schiffauswahl.style.visibility="visible";
            schiff1();
            schiff2();
        }
        function ausgabe1(a,b){
            sonstiges1.innerHTML=a;
            setTimeout("sonstiges1.innerHTML='&nbsp;';", b)
        }
        function ausgabe2(a,b){
            sonstiges4.innerHTML=a;
            setTimeout("sonstiges4.innerHTML='&nbsp;';", b)
        }
        function ausgabe3(a,b){
            sonstiges3.innerHTML=a;
            setTimeout("sonstiges3.innerHTML='&nbsp;';", b)
        }
        function blink2(a,b){
            if(b>0){
                sonstiges2.innerHTML=a;
                setTimeout("sonstiges2.innerHTML='&nbsp;';", 400);
                b--;
                setTimeout("blink2('"+a+"',"+b+')', 500);
            }
        }
        function kampfausgabe2(j,i){
            sonstiges2.innerHTML='<center><?php echo str_replace('{1}',"'+((i-1-((i-1)%60))/60+1)+'",$lang['metasimulation']['vorbereitung']['runde']);?></center>';
            sonstiges4.innerHTML='<center><?php echo str_replace('{1}',"'+(((i-1-((i-1)%6))/6)%10+1)+'",$lang['metasimulation']['vorbereitung']['phase']);?></center>';
            if(j>=i){
                sonstiges1.innerHTML=''+kampf_sonstiges1[i];
                sonstiges3.innerHTML=''+kampf_sonstiges2[i];
                ok=0;
                if(!(kampf_schild1[i]==kampf_schild1[i-1])){
                    schild1.innerHTML='<font color=#ff0000><?php echo str_replace('{1}',"'+kampf_schild1[i]+'",$lang['metasimulation']['vh_ok'])?>&nbsp;</font>';
                    setTimeout("schild1.innerHTML='<font color=#ffffff><?php echo str_replace('{1}',"'+kampf_schild1[\"+i+\"]+'",$lang['metasimulation']['vh_ok'])?>&nbsp;</font>';",500);
                    ok=1;
                }
                if(!(kampf_schild2[i]==kampf_schild2[i-1])){
                    schild2.innerHTML='<font color=#ff0000><?php echo str_replace('{1}',"'+kampf_schild2[i]+'",$lang['metasimulation']['vh_ok'])?>&nbsp;</font>';
                    setTimeout("schild2.innerHTML='<font color=#ffffff><?php echo str_replace('{1}',"'+kampf_schild2[\"+i+\"]+'",$lang['metasimulation']['vh_ok'])?>&nbsp;</font>';",500);
                    ok=1;
                }
                if(!(kampf_schaden1[i]==kampf_schaden1[i-1])){
                    schaden1.innerHTML='<font color=#ff0000><?php echo str_replace('{1}',"'+kampf_schaden1[i]+'",$lang['metasimulation']['vh_ok'])?>&nbsp;</font>';
                    setTimeout("schaden1.innerHTML='<font color=#ffffff><?php echo str_replace('{1}',"'+kampf_schaden1[\"+i+\"]+'",$lang['metasimulation']['vh_ok'])?>&nbsp;</font>';",500);
                    ok=1;
                }
                if(!(kampf_schaden2[i]==kampf_schaden2[i-1])){
                    schaden2.innerHTML='<font color=#ff0000><?php echo str_replace('{1}',"'+kampf_schaden2[i]+'",$lang['metasimulation']['vh_ok'])?>&nbsp;</font>';
                    setTimeout("schaden2.innerHTML='<font color=#ffffff><?php echo str_replace('{1}',"'+kampf_schaden2[\"+i+\"]+'",$lang['metasimulation']['vh_ok'])?>&nbsp;</font>';",500);
                    ok=1;
                }
                if(!(kampf_crew1[i]==kampf_crew1[i-1])){
                    crew1.innerHTML='<font color=#ff0000>'+kampf_crew1[i]+'&nbsp;</font>';
                    setTimeout("crew1.innerHTML='<font color=#ffffff>'+kampf_crew1["+i+"]+'&nbsp;</font>';",500);
                    ok=1;
                }
                if(!(kampf_crew2[i]==kampf_crew2[i-1])){
                    crew2.innerHTML='<font color=#ff0000>'+kampf_crew2[i]+'&nbsp;</font>';
                    setTimeout("crew2.innerHTML='<font color=#ffffff>'+kampf_crew2["+i+"]+'&nbsp;</font>';",500);
                    ok=1;
                }
                i++;
                if(ok==1){
                    setTimeout("kampfausgabe2("+j+","+i+")",1000);
                }else{
                    kampfausgabe2(j,i);
                }
            }
        }
        function kampfausgabe1(j){
            k_1_1.style.visibility="visible";
            k_1_2.style.visibility="visible";
            k_2_1.style.visibility="visible";
            k_2_2.style.visibility="visible";
            k_3_1.style.visibility="visible";
            k_3_2.style.visibility="visible";
            sonstiges1.innerHTML=''+kampf_sonstiges1[0];
            sonstiges3.innerHTML=''+kampf_sonstiges2[0];
            schild1.innerHTML='<font color=#ffffff><?php echo str_replace('{1}',"'+kampf_schild1[0]+'",$lang['metasimulation']['vh_ok'])?>&nbsp;</font>';
            schild2.innerHTML='<font color=#ffffff><?php echo str_replace('{1}',"'+kampf_schild2[0]+'",$lang['metasimulation']['vh_ok'])?>&nbsp;</font>';
            schaden1.innerHTML='<font color=#ffffff><?php echo str_replace('{1}',"'+kampf_schaden1[0]+'",$lang['metasimulation']['vh_ok'])?>&nbsp;</font>';
            schaden2.innerHTML='<font color=#ffffff><?php echo str_replace('{1}',"'+kampf_schaden2[0]+'",$lang['metasimulation']['vh_ok'])?>&nbsp;</font>';
            crew1.innerHTML='<font color=#ffffff>'+kampf_crew1[0]+'&nbsp;</font>';
            crew2.innerHTML='<font color=#ffffff>'+kampf_crew2[0]+'&nbsp;</font>';
            setTimeout("kampfausgabe2("+j+",1)",1000);
        }
        function vorbereitung(){
            Kampftabelle.style.visibility="visible";
            zeit=0;
            weite=500;
            feld=0;
            a=formular.angreifer_schiff.value;
            v=formular.verteidiger_schiff.value;
            verstecke();
            a2=a%1000-1;
            a1=(a-a2-1)/1000;
            v2=v%1000-1;
            v1=(v-v2-1)/1000;
            s1_anz_e=schiff_anz_e[a1][a2];
            s2_anz_e=schiff_anz_e[v1][v2];
            s1_anz_p=schiff_anz_p[a1][a2];
            s2_anz_p=schiff_anz_p[v1][v2];
            s1_anz_t=formular.angreifer_anz_torpedo.value;
            s2_anz_t=formular.verteidiger_anz_torpedo.value;
            s1_anz_h=schiff_anz_h[a1][a2];
            s2_anz_h=schiff_anz_h[v1][v2];
            s1_masse=schiff_masse[a1][a2];
            s2_masse=schiff_masse[v1][v2];
            s1_crewmax=schiff_crew[a1][a2];
            s2_crewmax=schiff_crew[v1][v2];
            s1_lucky=schiff_lucky[a1][a2];
            s2_lucky=schiff_lucky[v1][v2];
            s1_daempfer=schiff_daempfer[a1][a2];
            s2_daempfer=schiff_daempfer[v1][v2];
            s1_kk_e=schiff_kk_e[a1][a2];
            s2_kk_e=schiff_kk_e[v1][v2];
            s1_kk_s=schiff_kk_s[a1][a2];
            s2_kk_s=schiff_kk_s[v1][v2];
            s1_schaden=eval(formular.angreifer_schaden.value);
            s2_schaden=eval(formular.verteidiger_schaden.value);
            s1_schild=eval(formular.angreifer_schild.value);
            s2_schild=eval(formular.verteidiger_schild.value);
            s1_crew=formular.angreifer_crew.value;
            s2_crew=formular.verteidiger_crew.value;
            s1_erfahrung=angreifer_erfahrung;
            s2_erfahrung=verteidiger_erfahrung;
            if (s1_schaden>50) {
                prozent = (s1_schaden-50)*2;
                test=Math.floor(zufall(1,3));
                if(test==1 && s1_anz_e>0){
                    schaden_schaden=Math.round(s1_anz_e/100*prozent);
                    s1_anz_e -= schaden_schaden;
                    ausgabe1('<?php echo str_replace('{1}',"'+schaden_schaden+'",$lang['metasimulation']['vorbereitung']['energetikschaden'])?>',4000);
                }else if(test==2 && s1_anz_p>0){ 
                    schaden_schaden=Math.round(s1_anz_p/100*prozent);
                    s1_anz_p -= schaden_schaden;
                    ausgabe1('<?php echo str_replace('{1}',"'+schaden_schaden+'",$lang['metasimulation']['vorbereitung']['projektileschaden'])?>',4000);
                }else if(test==3 && s1_anz_h>0){
                    schaden_schaden=Math.round(s1_anz_h/100*prozent);
                    s1_anz_h -= schaden_schaden;
                    ausgabe1('<?php echo str_replace('{1}',"'+schaden_schaden+'",$lang['metasimulation']['vorbereitung']['hangarschaden'])?>',4000);
                }else{
                    ausgabe1('<?php echo $lang['metasimulation']['vorbereitung']['keinschaden']?>',4000);
                }
                zeit=5000;
            }
            if (s2_schaden>50) {
                prozent = (s2_schaden-50)*2;
                test=Math.floor(zufall(1,3));
                if(test==1 && s2_anz_e>0){
                    schaden_schaden=Math.round(s2_anz_e/100*prozent);
                    s2_anz_e -= schaden_schaden;
                    ausgabe3('<?php echo str_replace('{1}',"'+schaden_schaden+'",$lang['metasimulation']['vorbereitung']['energetikschaden'])?>',4000);
                }else if(test==2 && s2_anz_p>0){ 
                    schaden_schaden=Math.round(s2_anz_p/100*prozent);
                    s2_anz_p -= schaden_schaden;
                    ausgabe3('<?php echo str_replace('{1}',"'+schaden_schaden+'",$lang['metasimulation']['vorbereitung']['projektileschaden'])?>',4000);
                }else if(test==3 && s2_anz_h>0){
                    schaden_schaden=Math.round(s2_anz_h/100*prozent);
                    s2_anz_h -= schaden_schaden;
                    ausgabe3('<?php echo str_replace('{1}',"'+schaden_schaden+'",$lang['metasimulation']['vorbereitung']['hangarschaden'])?>',4000);
                }else{
                    ausgabe3('<?php echo $lang['metasimulation']['vorbereitung']['keinschaden']?>',4000);
                }
                zeit=5000;
            }
            zeit_temp=zeit;
            if((5>s1_erfahrung) && (formular.angreifer_zusatzmodul.value==1)){
                s1_erfahrung++;
                setTimeout("ausgabe1('<?php echo str_replace('{1}',"'+s1_erfahrung+'",$lang['metasimulation']['vorbereitung']['erfahrung_erhoeht'])?>',4000)",zeit);
                zeit+=5000;
            }
            if((10>s1_anz_e) && (formular.angreifer_zusatzmodul.value==4)){
                s1_anz_e++;
                s1_anz_e_t=s1_anz_e;
                if(s1_anz_e==1){
                    formular.angreifer_energetik.value=0;
                }
                setTimeout("ausgabe1('<?php echo str_replace('{1}',"'+s1_anz_e_t+'",$lang['metasimulation']['vorbereitung']['energetik_erhoeht'])?>',4000)",zeit);
                zeit+=5000;
            }
            if((5>s2_erfahrung) && (formular.verteidiger_zusatzmodul.value==1)){
                s2_erfahrung++;
                setTimeout("ausgabe3('<?php echo str_replace('{1}',"'+s2_erfahrung+'",$lang['metasimulation']['vorbereitung']['erfahrung_erhoeht'])?>',4000)",zeit_temp);
                zeit_temp+=+5000;
            }
            if((10>s2_anz_e) && (formular.verteidiger_zusatzmodul.value==4)){
                s2_anz_e++;
                s2_anz_e_t=s2_anz_e;
                if(s2_anz_e==1){
                    formular.verteidiger_energetik.value=0;
                }
                setTimeout("ausgabe3('<?php echo str_replace('{1}',"'+s2_anz_e_t+'",$lang['metasimulation']['vorbereitung']['energetik_erhoeht'])?>',4000)",zeit_temp);
                zeit_temp+=5000;
            }
            zeit=Math.max(zeit,zeit_temp);
            zeit_temp=zeit;
            if(formular.angreifer_aggro.value==0 && formular.verteidiger_aggro.value==0){
                setTimeout("ausgabe1('<?php echo $lang['metasimulation']['vorbereitung']['ausweichen']?>',4000)",zeit);
                setTimeout("ausgabe3('<?php echo $lang['metasimulation']['vorbereitung']['ausweichen']?>',4000)",zeit);
                zeit+=5000;
                ticks=zeit/500;
                blink2("<center><?php echo $lang['metasimulation']['vorbereitung']['vorbereitung']?></center>", ticks);
            } else {
                if(formular.angreifer_kapern.checked){
                    setTimeout("ausgabe1('<?php echo $lang['metasimulation']['vorbereitung']['auf_kapern']?>',4000)",zeit);
                    zeit+=5000;
                    s1_kraft_eh=Math.round(strahlenschaden[formular.angreifer_energetik.value]*0.5);
                    s1_kraft_ec=Math.round(strahlenschadencrew[formular.angreifer_energetik.value]*1.25);
                    s1_kraft_th=Math.round(torpedoschaden[formular.angreifer_projektile.value]*0.5);
                    s1_kraft_tc=Math.round(torpedoschadencrew[formular.angreifer_projektile.value]*1.25);
                }else{
                    s1_kraft_eh=strahlenschaden[formular.angreifer_energetik.value];
                    s1_kraft_ec=strahlenschadencrew[formular.angreifer_energetik.value];
                    s1_kraft_th=torpedoschaden[formular.angreifer_projektile.value];
                    s1_kraft_tc=torpedoschadencrew[formular.angreifer_projektile.value];
                }
                if(formular.verteidiger_kapern.checked){
                    setTimeout("ausgabe3('<?php echo $lang['metasimulation']['vorbereitung']['auf_kapern']?>',4000)",zeit_temp);
                    zeit=zeit_temp+5000;
                    s2_kraft_eh=Math.round(strahlenschaden[formular.verteidiger_energetik.value]*0.5);
                    s2_kraft_ec=Math.round(strahlenschadencrew[formular.verteidiger_energetik.value]*1.25);
                    s2_kraft_th=Math.round(torpedoschaden[formular.verteidiger_projektile.value]*0.5);
                    s2_kraft_tc=Math.round(torpedoschadencrew[formular.verteidiger_projektile.value]*1.25);
                }else{
                    s2_kraft_eh=strahlenschaden[formular.verteidiger_energetik.value];
                    s2_kraft_ec=strahlenschadencrew[formular.verteidiger_energetik.value];
                    s2_kraft_th=torpedoschaden[formular.verteidiger_projektile.value];
                    s2_kraft_tc=torpedoschadencrew[formular.verteidiger_projektile.value];
                }
                if((formular.angreifer_aggro.value==2)&&(formular.verteidiger_aggro.value==1)){
                    s1_kraft_eh*=0.85;
                    s1_kraft_ec*=0.85;
                    s1_kraft_th*=0.85;
                    s1_kraft_tc*=0.85;
                    setTimeout("ausgabe1('<?php echo $lang['metasimulation']['vorbereitung']['kraftrunter']?>',4000)",zeit);
                    zeit+=5000;
                }else if((formular.angreifer_aggro.value==2)&&(formular.verteidiger_aggro.value==0)){
                    s1_kraft_eh*=1.1;
                    s1_kraft_ec*=1.1;
                    s1_kraft_th*=1.1;
                    s1_kraft_tc*=1.1;
                    setTimeout("ausgabe1('<?php echo $lang['metasimulation']['vorbereitung']['krafthoch']?>',4000)",zeit);
                    zeit+=5000;
                }else if((formular.angreifer_aggro.value==1)&&(formular.verteidiger_aggro.value==2)){
                    s2_kraft_eh*=0.85;
                    s2_kraft_ec*=0.85;
                    s2_kraft_th*=0.85;
                    s2_kraft_tc*=0.85;
                    setTimeout("ausgabe3('<?php echo $lang['metasimulation']['vorbereitung']['kraftrunter']?>',4000)",zeit);
                    zeit+=5000;
                }else if((formular.angreifer_aggro.value==0)&&(formular.verteidiger_aggro.value==2)){
                    s2_kraft_eh*=1.1;
                    s2_kraft_ec*=1.1;
                    s2_kraft_th*=1.1;
                    s2_kraft_tc*=1.1;
                    setTimeout("ausgabe3('<?php echo $lang['metasimulation']['vorbereitung']['krafthoch']?>',4000)",zeit);
                    zeit+=5000;
                }
                zeit_temp=zeit;
                weiter=1;
                if((s1_lucky>0)||(s2_lucky>0)){
                    if(s1_lucky>0){
                        luck1=Math.floor(zufall(1,100));
                        if((s1_lucky+1+s1_erfahrung)>luck1){
                            setTimeout("ausgabe3('<?php echo $lang['metasimulation']['vorbereitung']['luckyja']?> ',4000)",zeit);
                            weiter=0;
                        }else{
                            setTimeout("ausgabe1('<?php echo $lang['metasimulation']['vorbereitung']['luckynein']?> ',4000)",zeit);
                        }
                        zeit+=5000;
                    }
                    if(s2_lucky>0){
                        luck2=Math.floor(zufall(1,100));
                        if((s2_lucky+1+s2_erfahrung)>luck2){
                            setTimeout("ausgabe1('<?php echo $lang['metasimulation']['vorbereitung']['luckyja']?>',4000)",zeit);
                            weiter=0;
                        }else{
                            setTimeout("ausgabe3('<?php echo $lang['metasimulation']['vorbereitung']['luckynein']?> ',4000)",zeit);
                        }
                        zeit+=5000;
                    }
                }
                zeit_temp=zeit;
                if(weiter==1){
                    if((s1_anz_e==0)&&(s1_anz_p==0)&&(s1_anz_h==0)&&(s2_anz_e==0)&&(s2_anz_p==0)&&(s2_anz_h==0)){
                        if(s2_masse>s1_masse){
                            setTimeout("ausgabe1('<?php echo $lang['metasimulation']['vorbereitung']['waffenlos']?>',4000)",zeit);
                        }else if(s1_masse>s2_masse){
                            setTimeout("ausgabe3('<?php echo $lang['metasimulation']['vorbereitung']['waffenlos']?>',4000)",zeit);
                        }else{
                            setTimeout("ausgabe1('<?php echo $lang['metasimulation']['vorbereitung']['waffenlos']?>',4000)",zeit);
                            setTimeout("ausgabe3('<?php echo $lang['metasimulation']['vorbereitung']['waffenlos']?>',4000)",zeit);
                        }
                        zeit+=5000;
                        ticks=zeit/500;
                        blink2("<center><?php echo $lang['metasimulation']['vorbereitung']['vorbereitung']?></center>", ticks);
                    }else{
                        zeit_temp=zeit;
                        if((s1_daempfer>0) && (s2_schild>0) && formular.angreifer_daempfer.checked && (formular.angreifer_anz_ren.value>=Math.round(s2_masse/100*s1_daempfer))){
                            s1_daempfer=1;
                            setTimeout("ausgabe1('<?php echo $lang['metasimulation']['vorbereitung']['daempfer']?>',4000)",zeit);
                            zeit+=5000;
                        }else{
                            s1_daempfer=0;
                        }
                        if((s2_daempfer>0) && (s1_schild>0) && formular.verteidiger_daempfer.checked && (formular.verteidiger_anz_ren.value>=Math.round(s1_masse/100*s2_daempfer))){
                            s2_daempfer=1;
                            setTimeout("ausgabe3('<?php echo $lang['metasimulation']['vorbereitung']['daempfer']?>',4000)",zeit_temp);
                            zeit_temp+=5000;
                        }else{
                            s2_daempfer=0;
                        }
                        zeit=Math.max(zeit,zeit_temp);
                        unterstuetzung=Math.min(formular.angreifer_stark.value,Math.max(s1_anz_e,Math.max(s1_anz_p,s1_anz_h)))+s1_erfahrung-Math.min(formular.verteidiger_stark.value,Math.max(s2_anz_e,Math.max(s2_anz_p,s2_anz_h)))-s2_erfahrung;
                        if(unterstuetzung>0){
                            dazu_e=Math.min(unterstuetzung,10-s1_anz_e);
                            s1_anz_e+=dazu_e;
                            if(dazu_e>0){
                                setTimeout("ausgabe1('<?php echo str_replace('{1}',"'+s1_anz_e+'",$lang['metasimulation']['vorbereitung']['energetik_erhoeht'])?>',4000)",zeit);
                                zeit+=5000;
                            }
                            dazu_h=Math.min(unterstuetzung-dazu_e,10-s1_anz_h);
                            s1_anz_h+=dazu_h;
                            if(dazu_h>0){
                                setTimeout("ausgabe1('<?php echo str_replace('{1}',"'+s1_anz_h+'",$lang['metasimulation']['vorbereitung']['hangar_erhoeht'])?>',4000)",zeit);
                                zeit+=5000;
                            }
                            dazu_m=Math.min(unterstuetzung-dazu_e-dazu_h,Math.floor((1000-s1_masse)/100));
                            s1_masse=Math.min((dazu_m*100)+s1_masse,1000);
                            if(dazu_m>0){
                                setTimeout("ausgabe1('<?php echo str_replace('{1}',"'+s1_masse+'",$lang['metasimulation']['vorbereitung']['masse_erhoeht'])?>',4000)",zeit);
                                zeit+=5000;
                            }
                        }else if(0>unterstuetzung){
                            unterstuetzung*=-1;
                            dazu_e=Math.min(unterstuetzung,10-s2_anz_e);
                            s2_anz_e+=dazu_e;
                            if(dazu_e>0){
                                setTimeout("ausgabe3('<?php echo str_replace('{1}',"'+s2_anz_e+'",$lang['metasimulation']['vorbereitung']['energetik_erhoeht'])?>',4000)",zeit);
                                zeit+=5000;
                            }
                            dazu_h=Math.min(unterstuetzung-dazu_e,10-s2_anz_h);
                            s2_anz_h+=dazu_h;
                            if(dazu_h>0){
                                setTimeout("ausgabe3('<?php echo str_replace('{1}',"'+s2_anz_h+'",$lang['metasimulation']['vorbereitung']['hangar_erhoeht'])?>',4000)",zeit);
                                zeit+=5000;
                            }
                            dazu_m=Math.min(unterstuetzung-dazu_e-dazu_h,Math.floor((1000-s2_masse)/100));
                            s2_masse=Math.min((dazu_m*100)+s1_masse,1000);
                            if(dazu_m>0){
                                setTimeout("ausgabe3('<?php echo str_replace('{1}',"'+s2_masse+'",$lang['metasimulation']['vorbereitung']['masse_erhoeht'])?>',4000)",zeit);
                                zeit+=5000;
                            }
                        }
                        ticks=zeit/500;
                        blink2("<center><?php echo $lang['metasimulation']['vorbereitung']['vorbereitung']?></center>", ticks);
                        runde=0;
                        kampf_schild1[0]=s1_schild;
                        kampf_schild2[0]=s2_schild;
                        kampf_schaden1[0]=s1_schaden;
                        kampf_schaden2[0]=s2_schaden;
                        kampf_crew1[0]=s1_crew;
                        kampf_crew2[0]=s2_crew;
                        kampf_sonstiges1[0]='';
                        kampf_sonstiges2[0]='';
                        feld=0;
                        weiter=1;
                        superzeit=0;
                        while((100>s1_schaden) && (100>s2_schaden) && (s1_crew>0) && (s2_crew>0)&&(weiter==1)){
                            phase=0;
                            if((s1_kk_e>0)&&(s1_kk_s>0)&&(s2_kk_e==0)){
                                kgluck1=zufall(1,100);
                                if(s1_kk_e>kgluck1){
                                    s1_schaden=100;
                                    s2_schild=0;
                                    s2_schaden=(s1_kk_s*(6400/((s2_masse*s2_masse)+(2*s2_masse)+1)))+2;
                                    kampf_sonstiges1[feld]='<?php echo $lang['metasimulation']['vorbereitung']['kamikaze']?>';
                                    s2_schaden=(0>s2_schaden)?0:s2_schaden;
                                    kampf_schild1[feld]=0;
                                    kampf_schild2[feld]=s2_schild;
                                    kampf_schaden1[feld]=s1_schaden;
                                    kampf_schaden2[feld]=s2_schaden;
                                }
                            }else if((s2_kk_e>0)&&(s2_kk_s>0)&&(s1_kk_e==0)){
                                kgluck2=zufall(1,100);
                                if(s2_kk_e>kgluck2){
                                    s2_schaden=100;
                                    s1_schild=0;
                                    s1_schaden=(s2_kk_s*(6400/((s1_masse*s1_masse)+(2*s1_masse)+1)))+2;
                                    kampf_sonstiges2[feld]='<?php echo $lang['metasimulation']['vorbereitung']['kamikaze']?>';
                                    s1_schaden=(0>s1_schaden)?0:s1_schaden;
                                    kampf_schild1[feld]=s1_schild;
                                    kampf_schild2[feld]=0;
                                    kampf_schaden1[feld]=s1_schaden;
                                    kampf_schaden2[feld]=s2_schaden;
                                }
                            }else if((s1_kk_e>0)&&(s1_kk_s>0)&&(s2_kk_e>0)&&(s2_kk_s>0)){
                                s1_schaden=100;
                                s2_schaden=100;
                                kampf_sonstiges1[feld]='<?php echo $lang['metasimulation']['vorbereitung']['kamikaze']?>';
                                kampf_sonstiges2[feld]='<?php echo $lang['metasimulation']['vorbereitung']['kamikaze']?>';
                                kampf_schild1[feld]=0;
                                kampf_schild2[feld]=0;
                                kampf_schaden1[feld]=s1_schaden;
                                kampf_schaden2[feld]=s2_schaden;
                            }
                            while((10>phase)&&(100>s1_schaden) && (100>s2_schaden) && (s1_crew>0) && (s2_crew>0)){
                                feld=(60*runde)+(6*phase)+1;
                                kampf_sonstiges1[feld]='';
                                kampf_sonstiges2[feld]='';
                                if(s1_anz_e>phase){
                                    superzeit+=1000;
                                    kampf_sonstiges1[feld]='<?php echo str_replace('{1}',"'+(phase+1)+'",$lang['metasimulation']['vorbereitung']['energetik'])?>';
                                    if((s2_schild>0)&&(s1_daempfer==0)){
                                        s2_schild=(Math.round((s2_schild-s1_kraft_eh*((80/s2_masse)+1))*1000)/1000);
                                    }else{
                                        s2_schaden=(Math.round((s2_schaden+(s1_kraft_eh*(6400/((s2_masse*s2_masse)+(2*s2_masse)+1)))+2)*1000)/1000);
                                        s2_crew-=Math.floor(s2_crewmax*((s1_kraft_ec*(64/((s2_masse*s2_masse)+(2*s2_masse)+1)))+0.02));
                                    }
                                }
                                s1_schild=(0>s1_schild)?0:s1_schild;
                                s2_schild=(0>s2_schild)?0:s2_schild;
                                s1_schaden=(0>s1_schaden)?0:s1_schaden;
                                s2_schaden=(0>s2_schaden)?0:s2_schaden;
                                s1_crew=(0>s1_crew)?0:s1_crew;
                                s2_crew=(0>s2_crew)?0:s2_crew;
                                kampf_sonstiges1[feld+1]='';
                                kampf_sonstiges2[feld+1]='';
                                kampf_schild1[feld]=s1_schild;
                                kampf_schild2[feld]=s2_schild;
                                kampf_schaden1[feld]=s1_schaden;
                                kampf_schaden2[feld]=s2_schaden;
                                kampf_crew1[feld]=s1_crew;
                                kampf_crew2[feld]=s2_crew;
                                if(s2_anz_e>phase){
                                    superzeit+=1000;
                                    kampf_sonstiges2[feld+1]='<?php echo str_replace('{1}',"'+(phase+1)+'",$lang['metasimulation']['vorbereitung']['energetik'])?>';
                                    if((s1_schild>0)&&(s2_daempfer==0)){
                                        s1_schild=(Math.round((s1_schild-s2_kraft_eh*((80/s1_masse)+1))*1000)/1000);
                                    }else{
                                        s1_schaden=(Math.round((s1_schaden+(s2_kraft_eh*(6400/((s1_masse*s1_masse)+(2*s1_masse)+1)))+2)*1000)/1000);
                                        s1_crew-=Math.floor(s1_crewmax*((s2_kraft_ec*(64/((s1_masse*s1_masse)+(2*s1_masse)+1)))+0.02));
                                    }
                                }
                                s1_schild=(0>s1_schild)?0:s1_schild;
                                s2_schild=(0>s2_schild)?0:s2_schild;
                                s1_schaden=(0>s1_schaden)?0:s1_schaden;
                                s2_schaden=(0>s2_schaden)?0:s2_schaden;
                                s1_crew=(0>s1_crew)?0:s1_crew;
                                s2_crew=(0>s2_crew)?0:s2_crew;
                                feld++;
                                kampf_sonstiges1[feld+1]='';
                                kampf_sonstiges2[feld+1]='';
                                kampf_schild1[feld]=s1_schild;
                                kampf_schild2[feld]=s2_schild;
                                kampf_schaden1[feld]=s1_schaden;
                                kampf_schaden2[feld]=s2_schaden;
                                kampf_crew1[feld]=s1_crew;
                                kampf_crew2[feld]=s2_crew;
                                if((s1_anz_p>phase)&&(s1_anz_t>0)){
                                    s1_anz_t--;
                                    kampf_sonstiges1[feld+1]='<?php echo str_replace('{1}',"'+(phase+1)+'",$lang['metasimulation']['vorbereitung']['projektile'])?>';
                                    gluck1=zufall(1,100);
                                    if((s2_schild>0)&&(s1_daempfer==0)&&((66+(6*s1_erfahrung))>gluck1)){
                                        superzeit+=1000;
                                        s2_schild=(Math.round((s2_schild-s1_kraft_th*((80/s2_masse)+1))*1000)/1000);
                                    }else if(((s2_schild<=0)||(s1_daempfer==1))&&((66+(6*s1_erfahrung))>gluck1)){
                                        superzeit+=1000;
                                        s2_schaden=(Math.round((s2_schaden+(s1_kraft_th*(6400/((s2_masse*s2_masse)+(2*s2_masse)+1)))+2)*1000)/1000);
                                        s2_crew-=Math.floor(s2_crewmax*((s1_kraft_tc*(64/((s2_masse*s2_masse)+(2*s2_masse)+1)))+0.02));
                                    }else{
                                        //projektil p1 vorbei
                                    }
                                }
                                s1_schild=(0>s1_schild)?0:s1_schild;
                                s2_schild=(0>s2_schild)?0:s2_schild;
                                s1_schaden=(0>s1_schaden)?0:s1_schaden;
                                s2_schaden=(0>s2_schaden)?0:s2_schaden;
                                s1_crew=(0>s1_crew)?0:s1_crew;
                                s2_crew=(0>s2_crew)?0:s2_crew;
                                feld++;
                                kampf_sonstiges1[feld+1]='';
                                kampf_sonstiges2[feld+1]='';
                                kampf_schild1[feld]=s1_schild;
                                kampf_schild2[feld]=s2_schild;
                                kampf_schaden1[feld]=s1_schaden;
                                kampf_schaden2[feld]=s2_schaden;
                                kampf_crew1[feld]=s1_crew;
                                kampf_crew2[feld]=s2_crew;
                                if((s2_anz_p>phase)&&(s2_anz_t>0)){
                                    kampf_sonstiges2[feld+1]='<?php echo str_replace('{1}',"'+(phase+1)+'",$lang['metasimulation']['vorbereitung']['projektile'])?>';
                                    s2_anz_t--;
                                    gluck2=zufall(1,100);
                                    if((s1_schild>0)&&(s2_daempfer==0)&&((66+(6*s2_erfahrung))>gluck2)){
                                        superzeit+=1000;
                                        s1_schild=(Math.round((s1_schild-s2_kraft_th*((80/s1_masse)+1))*1000)/1000);
                                    }else if(((s1_schild<=0)||(s2_daempfer==1))&&((66+(6*s2_erfahrung))>gluck2)){
                                        superzeit+=1000;
                                        s1_schaden=(Math.round((s1_schaden+(s2_kraft_th*(6400/((s1_masse*s1_masse)+(2*s1_masse)+1)))+2)*1000)/1000);
                                        s1_crew-=Math.floor(s1_crewmax*((s2_kraft_tc*(64/((s1_masse*s1_masse)+(2*s1_masse)+1)))+0.02));
                                    }else{
                                        //projektil p2 vorbei
                                    }
                                }
                                s1_schild=(0>s1_schild)?0:s1_schild;
                                s2_schild=(0>s2_schild)?0:s2_schild;
                                s1_schaden=(0>s1_schaden)?0:s1_schaden;
                                s2_schaden=(0>s2_schaden)?0:s2_schaden;
                                s1_crew=(0>s1_crew)?0:s1_crew;
                                s2_crew=(0>s2_crew)?0:s2_crew;
                                feld++;
                                kampf_sonstiges1[feld+1]='';
                                kampf_sonstiges2[feld+1]='';
                                kampf_schild1[feld]=s1_schild;
                                kampf_schild2[feld]=s2_schild;
                                kampf_schaden1[feld]=s1_schaden;
                                kampf_schaden2[feld]=s2_schaden;
                                kampf_crew1[feld]=s1_crew;
                                kampf_crew2[feld]=s2_crew;
                                if(s1_anz_h>phase){
                                    superzeit+=1000;
                                    kampf_sonstiges1[feld+1]='<?php echo str_replace('{1}',"'+(phase+1)+'",$lang['metasimulation']['vorbereitung']['hangar'])?>';
                                    if((s2_schild>0)&&(s1_daempfer==0)){
                                        s2_schild=Math.round((s2_schild-4)*1000)/1000;
                                    }else{
                                        s2_schaden=Math.round((s2_schaden+4)*1000)/1000;
                                        s2_crew-=Math.floor(s2_crewmax*0.015);
                                    }
                                }
                                s1_schild=(0>s1_schild)?0:s1_schild;
                                s2_schild=(0>s2_schild)?0:s2_schild;
                                s1_schaden=(0>s1_schaden)?0:s1_schaden;
                                s2_schaden=(0>s2_schaden)?0:s2_schaden;
                                s1_crew=(0>s1_crew)?0:s1_crew;
                                s2_crew=(0>s2_crew)?0:s2_crew;
                                feld++;
                                kampf_sonstiges1[feld+1]='';
                                kampf_sonstiges2[feld+1]='';
                                kampf_schild1[feld]=s1_schild;
                                kampf_schild2[feld]=s2_schild;
                                kampf_schaden1[feld]=s1_schaden;
                                kampf_schaden2[feld]=s2_schaden;
                                kampf_crew1[feld]=s1_crew;
                                kampf_crew2[feld]=s2_crew;
                                if(s2_anz_h>phase){
                                    superzeit+=1000;
                                    kampf_sonstiges2[feld+1]='<?php echo str_replace('{1}',"'+(phase+1)+'",$lang['metasimulation']['vorbereitung']['hangar'])?>';
                                    if((s1_schild>0)&&(s2_daempfer==0)){
                                        s1_schild=Math.round((s1_schild-4)*1000)/1000;
                                    }else{
                                        s1_schaden=Math.round((s1_schaden+4)*1000)/1000;
                                        s1_crew=s1_crew-Math.floor(s1_crewmax*0.015);
                                    }
                                }
                                s1_schild=(0>s1_schild)?0:s1_schild;
                                s2_schild=(0>s2_schild)?0:s2_schild;
                                s1_schaden=(0>s1_schaden)?0:s1_schaden;
                                s2_schaden=(0>s2_schaden)?0:s2_schaden;
                                s1_crew=(0>s1_crew)?0:s1_crew;
                                s2_crew=(0>s2_crew)?0:s2_crew;
                                feld++;
                                phase++;
                                kampf_schild1[feld]=s1_schild;
                                kampf_schild2[feld]=s2_schild;
                                kampf_schaden1[feld]=s1_schaden;
                                kampf_schaden2[feld]=s2_schaden;
                                kampf_crew1[feld]=s1_crew;
                                kampf_crew2[feld]=s2_crew;
                            }
                            runde++;
                            if(formular.angreifer_aggro.value==0 && formular.verteidiger_aggro.value==1){
                                kampf_sonstiges1[feld]='<?php echo $lang['metasimulation']['vorbereitung']['ausweichen']?>';
                                weiter=0;
                            }
                            if(formular.angreifer_aggro.value==1 && formular.verteidiger_aggro.value==0){
                                kampf_sonstiges2[feld]='<?php echo $lang['metasimulation']['vorbereitung']['ausweichen']?>';
                                weiter=0;
                            }
                        }
                        setTimeout("kampfausgabe1(feld)",zeit);
                    }
                    temp=0;
                    if((s1_schaden<100)&&(s2_schaden<100)&&(s1_crew<=0)&&(formular.angreifer_zusatzmodul.value==5)){
                        sz1=Math.floor(zufall(1,4));
                        if(sz1==2){
                            setTimeout("ausgabe1('<?php echo $lang['metasimulation']['vorbereitung']['selbstzerstoerung']?>',4000)",superzeit+zeit);
                            temp=5000;
                        }
                    }
                    if((s1_schaden<100)&&(s2_schaden<100)&&(s2_crew<=0)&&(formular.verteidiger_zusatzmodul.value==5)){
                        sz2=Math.floor(zufall(1,4));
                        if(sz2==2){
                            setTimeout("ausgabe3('<?php echo $lang['metasimulation']['vorbereitung']['selbstzerstoerung']?>',4000)",superzeit+zeit);
                            temp=5000;
                        }
                    }
                    superzeit+=temp+5000;
                }else{
                    ticks=zeit/500;
                    blink2("<center><?php echo $lang['metasimulation']['vorbereitung']['vorbereitung']?></center>", ticks);
                }
            }
            setTimeout("zeige()",superzeit+zeit);
        }
    </script>
    <body text="#000000" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="schiff1();schiff2();">
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
        <center>
            <table border="0" cellspacing="0" cellpadding="0" id="tabelle1">
                <tr>
                    <td><img src="../bilder/empty.gif" width="1" height="5" border="0"></td>
                </tr>
                <tr>
                    <td colspan="3"><center><img src="../lang/<?php echo $spieler_sprache?>/topics/simss.gif" width="374" height="25" border="0"></center></td>
                </tr>
                <tr>
                    <td><img src="../bilder/empty.gif" width="1" height="10" border="0"></td>
                    <td><img src="../bilder/empty.gif" width="1" height="10" border="0"></td>
                </tr>
                <tr>
                    <td><center><?php echo $lang['metasimulation']['angreifer']?></center></td>
                    <td><center><?php echo $lang['metasimulation']['verteidiger']?></center></td>
                </tr>
                <tr>
                    <td><form name="formular"></td>
                    <td><img src="../bilder/empty.gif" width="1" height="10" border="0"></td>
                </tr>
                <tr id="schiffauswahl">
                    <td>
                        <?php echo $lang['metasimulation']['schiff']?> &gt;&gt;&gt;
                        <select name="angreifer_schiff" style="width:270px;" onchange="schiff1();">
                            <option value="0" style="background-color:#444444;"></option>
                            <?php
                            for ($n=0;$n<$zaehler;$n++) {
                                ?>
                                <optgroup style="background-color:#444444;" label="<?php echo $name_rasse[$n]?>"></option>
                                <?php
                                $zaehler2=$zaehler3[$n];
                                for ($nm=0;$nm<$zaehler2;$nm++) {
                                    ?>
                                    <option value="<?php echo $n*1000+$nm+1;?>" label="<?php echo $schiffe[$n][$nm][0]?>" style="background-color:#444444;"><?php echo $schiffe[$n][$nm][0]?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <img src="../bilder/empty.gif" width="10" height="1" border="0">
                    </td>
                    <td>
                        <img src="../bilder/empty.gif" width="10" height="1" border="0">
                        <select name="verteidiger_schiff" style="width:270px;" onchange="schiff2();">
                            <option value="0" style="background-color:#444444;"></option>
                            <?php
                            for ($n=0;$n<$zaehler;$n++) {
                                ?>
                                <optgroup style="background-color:#444444;" label="<?php echo $name_rasse[$n]?>"></option>
                                <?php
                                $zaehler2=$zaehler3[$n];
                                for ($nm=0;$nm<$zaehler2;$nm++) {
                                    ?>
                                    <option value="<?php echo $n*1000+$nm+1;?>" label="<?php echo $schiffe[$n][$nm][0]?>" style="background-color:#444444;"><?php echo $schiffe[$n][$nm][0]?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        &lt;&lt;&lt; <?php echo $lang['metasimulation']['schiff']?>
                    </td>
                </tr>
            </table>
        </center>
        <center>
            <table border="0" cellspacing="10" cellpadding="0">
                <tr>
                    <td><img src="../bilder/empty.gif" width="1" height="10" border="0"></td>
                </tr>
                <tr>
                    <td>
                        <center>
                            <table border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                    <td id="t_1_1_1" style="visibility:hidden"><center><?php echo $lang['metasimulation']['energetik']?></center></td>
                                    <td id="t_1_1_2" style="visibility:hidden"><center><?php echo $lang['metasimulation']['projektile']?></center></td>
                                </tr>
                                <tr>
                                    <td>
                                        <center>
                                            <select name="angreifer_energetik" style="width:135px;visibility:hidden;">
                                                <option value="0" style="background-color:#444444;"><?php echo $lang['metasimulation']['laser']?></option>
                                                <option value="1" style="background-color:#444444;"><?php echo $lang['metasimulation']['phaser']?></option>
                                                <option value="2" style="background-color:#444444;"><?php echo $lang['metasimulation']['plasmablaster']?></option>
                                                <option value="3" style="background-color:#444444;"><?php echo $lang['metasimulation']['disruptor']?></option>
                                                <option value="4" style="background-color:#444444;"><?php echo $lang['metasimulation']['tachionenstrahler']?></option>
                                                <option value="5" style="background-color:#444444;"><?php echo $lang['metasimulation']['desintegrator']?></option>
                                                <option value="6" style="background-color:#444444;"><?php echo $lang['metasimulation']['gravitraktor']?></option>
                                                <option value="7" style="background-color:#444444;"><?php echo $lang['metasimulation']['potentialverdichter']?></option>
                                                <option value="8" style="background-color:#444444;"><?php echo $lang['metasimulation']['tryxoker']?></option>
                                                <option value="9" style="background-color:#444444;"><?php echo $lang['metasimulation']['partikelvortex']?></option>
                                            </select>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <select name="angreifer_projektile" style="width:135px;visibility:hidden;">
                                                <option value="0" style="background-color:#444444;"><?php echo $lang['metasimulation']['fusionsraketen']?></option>
                                                <option value="1" style="background-color:#444444;"><?php echo $lang['metasimulation']['photonentorpedos']?></option>
                                                <option value="2" style="background-color:#444444;"><?php echo $lang['metasimulation']['transformkanone']?></option>
                                                <option value="3" style="background-color:#444444;"><?php echo $lang['metasimulation']['gammabomben']?></option>
                                                <option value="4" style="background-color:#444444;"><?php echo $lang['metasimulation']['fissionstorpedos']?></option>
                                                <option value="5" style="background-color:#444444;"><?php echo $lang['metasimulation']['munkatapult']?></option>
                                                <option value="6" style="background-color:#444444;"><?php echo $lang['metasimulation']['quantentorpedos']?></option>
                                                <option value="7" style="background-color:#444444;"><?php echo $lang['metasimulation']['micromitgeschuetz']?></option>
                                                <option value="8" style="background-color:#444444;"><?php echo $lang['metasimulation']['singularitaetswerfer']?></option>
                                                <option value="9" style="background-color:#444444;"><?php echo $lang['metasimulation']['novabomben']?></option>
                                            </select>
                                        <center>
                                    </td>
                                </tr>
                                <tr>
                                    <td id="t_1_3_1" style="visibility:hidden"><center><?php echo $lang['metasimulation']['zusatzmodul']?></center></td>
                                    <td id="t_1_3_2" style="visibility:hidden"><center><?php echo $lang['metasimulation']['anz_projektile']?></center></td>
                                </tr>
                                <tr>
                                    <td>
                                        <center>
                                            <select name="angreifer_zusatzmodul" style="width:135px;visibility:hidden;" onchange="schiff1();">
                                                <option value="0" style="background-color:#444444;"><?php echo $lang['metasimulation']['zusatzm'][0]?></option>
                                                <option value="1" style="background-color:#444444;"><?php echo $lang['metasimulation']['zusatzm'][1]?></option>
                                                <option value="2" style="background-color:#444444;"><?php echo $lang['metasimulation']['zusatzm'][2]?></option>
                                                <option value="3" style="background-color:#444444;"><?php echo $lang['metasimulation']['zusatzm'][3]?></option>
                                                <option value="4" style="background-color:#444444;"><?php echo $lang['metasimulation']['zusatzm'][4]?></option>
                                                <option value="5" style="background-color:#444444;"><?php echo $lang['metasimulation']['zusatzm'][5]?></option>
                                            </select>
                                        <center>
                                    </td>
                                    <td>
                                        <center >
                                            <table border="0" cellspacing="1" cellpadding="0" id="anz_torpedo1" style="visibility:hidden">
                                                <tr>
                                                    <td>
                                                        <input type="text" value="0" class="eingabe" name="angreifer_anz_torpedo" onchange="anz_p1()" maxlength="3" style="width:27px">
                                                    </td>
                                                    <td id="max1"></td>
                                                </tr>
                                            </table> 
                                        </center>
                                    </td>
                                </tr>
                                <tr>
                                    <td id="t_1_5_1" style="visibility:hidden"><center><?php echo $lang['metasimulation']['kaperangriff']?></center></td>
                                    <td id="t_1_5_2" style="visibility:hidden"><center><?php echo $lang['metasimulation']['anz_rennurbin']?></center></td>
                                </tr>
                                <tr>
                                    <td><center><input type="checkbox" value="1" name="angreifer_kapern" style="visibility:hidden"></center></td>
                                    <td>
                                        <center >
                                            <table border="0" cellspacing="1" cellpadding="0" id="anz_ren1" style="visibility:hidden">
                                                <tr>
                                                    <td>
                                                        <input type="text" value="0" class="eingabe" name="angreifer_anz_ren" onchange="anz_r1()" maxlength="4" style="width:36px">
                                                    </td>
                                                    <td id="max2"></td>
                                                </tr>
                                            </table> 
                                        </center>
                                    </td>
                                </tr>
                                <tr>
                                    <td id="t_1_7_1" style="visibility:hidden">
                                        <center>
                                            <img src="../bilder/empty.gif" width="1" height="15" >
                                            <?php echo $lang['metasimulation']['erfahrung']?>
                                            <div id="erf10" style="position:absolute;visibility:hidden;"><img src="../bilder/icons/erf_0.gif" width="22" height="22" border="1" style="border-color:#7f7f7f"onclick="schalter1(1);"></div>
                                            <div id="erf11" style="position:absolute;visibility:hidden;"><img src="../bilder/icons/erf_1.gif" width="22" height="22" border="1" style="border-color:#7f7f7f" onclick="schalter1(2);"></div>
                                            <div id="erf12" style="position:absolute;visibility:hidden;"><img src="../bilder/icons/erf_2.gif" width="22" height="22" border="1" style="border-color:#7f7f7f" onclick="schalter1(3);"></div>
                                            <div id="erf13" style="position:absolute;visibility:hidden;"><img src="../bilder/icons/erf_3.gif" width="22" height="22" border="1" style="border-color:#7f7f7f" onclick="schalter1(4);"></div>
                                            <div id="erf14" style="position:absolute;visibility:hidden;"><img src="../bilder/icons/erf_4.gif" width="22" height="22" border="1" style="border-color:#7f7f7f" onclick="schalter1(5);"></div>
                                            <div id="erf15" style="position:absolute;visibility:hidden;"><img src="../bilder/icons/erf_5.gif" width="22" height="22" border="1" style="border-color:#7f7f7f" onclick="schalter1(0);"></div>
                                        </center>
                                    </td>
                                    <td id="t_1_7_2" style="visibility:hidden"><center><?php echo $lang['metasimulation']['verstaerkung']?></center></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <center>
                                            <select name="angreifer_stark" style="width:67px;" style="visibility:hidden">
                                                <?php
                                                for ($n=0;$n<11;$n++) {
                                                    ?>
                                                    <option value="<?php echo $n?>" style="background-color:#444444;"><?php echo $n?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </center>
                                    </td>
                                </tr>
                                <tr>
                                    <td id="t_1_9_1" style="visibility:hidden"><center><?php echo $lang['metasimulation']['schaden']?></center></td>
                                    <td id="t_1_9_2" style="visibility:hidden"><center><?php echo $lang['metasimulation']['schild']?></center></td>
                                </tr>
                                    <td>
                                        <center>
                                            <select name="angreifer_schaden" style="width:67px;" style="visibility:hidden">
                                                <?php
                                                for ($n=0;$n<101;$n++) {
                                                    ?>
                                                    <option value="<?php echo $n?>" style="background-color:#444444;"><?php echo str_replace('{1}',$n,$lang['metasimulation']['vh_ok'])?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <select name="angreifer_schild" style="width:67px;" style="visibility:hidden">
                                                <?php
                                                for ($n=100;$n>-1;$n--) {
                                                    ?>
                                                    <option value="<?php echo $n?>" style="background-color:#444444;"><?php echo str_replace('{1}',$n,$lang['metasimulation']['vh_ok'])?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </center>
                                    </td>
                                <tr>
                                </tr>
                                <tr>
                                    <td id="t_1_11_1" style="visibility:hidden"><center><?php echo $lang['metasimulation']['daempfer']?></center></td>
                                    <td id="t_1_11_2" style="visibility:hidden"><center><?php echo $lang['metasimulation']['aggro']?></center></td>
                                </tr>
                                <tr>
                                    <td id="t_1_12_1" style="visibility:hidden"><center><input type="checkbox" value="1" name="angreifer_daempfer"></center></td>
                                    <td>
                                        <center>
                                            <select name="angreifer_aggro" style="width:135px;" style="visibility:hidden">
                                                <option value="0" style="background-color:#444444;"><?php echo $lang['metasimulation']['defensiv']?></option>
                                                <option value="1" style="background-color:#444444;" selected><?php echo $lang['metasimulation']['ueberlegt']?></option>
                                                <option value="2" style="background-color:#444444;"><?php echo $lang['metasimulation']['aggressiv']?></option>
                                            </select>
                                        </center>
                                    </td>
                                </tr>
                                <tr>
                                    <td id="t_1_13_1" style="visibility:hidden" align="right"><?php echo $lang['metasimulation']['crew']?></td>
                                    <td align="left">
                                        <table border="0" cellspacing="1" cellpadding="0" id="anz_crew1" style="visibility:hidden">
                                            <tr>
                                                <td>
                                                    <input type="text" value="0" class="eingabe" name="angreifer_crew" onchange="anz_c1()" maxlength="5" style="width:45px">
                                                </td>
                                                <td id="maxcrew1"></td>
                                            </tr>
                                        </table> 
                                    </td>
                                </tr>
                            </table>
                        </center>
                    </td>
                    <td>
                        <center>
                            <table border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                    <td id="t_2_1_1" style="visibility:hidden"><center><?php echo $lang['metasimulation']['projektile']?></center></td>
                                    <td id="t_2_1_2" style="visibility:hidden"><center><?php echo $lang['metasimulation']['energetik']?></center></td>
                                </tr>
                                <tr>
                                    <td>
                                        <center>
                                            <select name="verteidiger_projektile" style="width:135px;visibility:hidden;">
                                                <option value="0" style="background-color:#444444;"><?php echo $lang['metasimulation']['fusionsraketen']?></option>
                                                <option value="1" style="background-color:#444444;"><?php echo $lang['metasimulation']['photonentorpedos']?></option>
                                                <option value="2" style="background-color:#444444;"><?php echo $lang['metasimulation']['transformkanone']?></option>
                                                <option value="3" style="background-color:#444444;"><?php echo $lang['metasimulation']['gammabomben']?></option>
                                                <option value="4" style="background-color:#444444;"><?php echo $lang['metasimulation']['fissionstorpedos']?></option>
                                                <option value="5" style="background-color:#444444;"><?php echo $lang['metasimulation']['munkatapult']?></option>
                                                <option value="6" style="background-color:#444444;"><?php echo $lang['metasimulation']['quantentorpedos']?></option>
                                                <option value="7" style="background-color:#444444;"><?php echo $lang['metasimulation']['micromitgeschuetz']?></option>
                                                <option value="8" style="background-color:#444444;"><?php echo $lang['metasimulation']['singularitaetswerfer']?></option>
                                                <option value="9" style="background-color:#444444;"><?php echo $lang['metasimulation']['novabomben']?></option>
                                            </select>
                                        <center>
                                    </td>
                                    <td>
                                        <center>
                                            <select name="verteidiger_energetik" style="width:135px;visibility:hidden;">
                                                <option value="0" style="background-color:#444444;"><?php echo $lang['metasimulation']['laser']?></option>
                                                <option value="1" style="background-color:#444444;"><?php echo $lang['metasimulation']['phaser']?></option>
                                                <option value="2" style="background-color:#444444;"><?php echo $lang['metasimulation']['plasmablaster']?></option>
                                                <option value="3" style="background-color:#444444;"><?php echo $lang['metasimulation']['disruptor']?></option>
                                                <option value="4" style="background-color:#444444;"><?php echo $lang['metasimulation']['tachionenstrahler']?></option>
                                                <option value="5" style="background-color:#444444;"><?php echo $lang['metasimulation']['desintegrator']?></option>
                                                <option value="6" style="background-color:#444444;"><?php echo $lang['metasimulation']['gravitraktor']?></option>
                                                <option value="7" style="background-color:#444444;"><?php echo $lang['metasimulation']['potentialverdichter']?></option>
                                                <option value="8" style="background-color:#444444;"><?php echo $lang['metasimulation']['tryxoker']?></option>
                                                <option value="9" style="background-color:#444444;"><?php echo $lang['metasimulation']['partikelvortex']?></option>
                                            </select>
                                        </center>
                                    </td>
                                </tr>
                                <tr>
                                    <td id="t_2_3_1" style="visibility:hidden"><center><?php echo $lang['metasimulation']['anz_projektile']?></center></td>
                                    <td id="t_2_3_2" style="visibility:hidden"><center><?php echo $lang['metasimulation']['zusatzmodul']?></center></td>
                                </tr>
                                <tr>
                                    <td>
                                        <center >
                                            <table border="0" cellspacing="1" cellpadding="0" id="anz_torpedo2" style="visibility:hidden">
                                                <tr>
                                                    <td>
                                                        <input type="text" value="0" class="eingabe" name="verteidiger_anz_torpedo" onchange="anz_p2()" maxlength="3" style="width:27px">
                                                    </td>
                                                    <td id="max3"></td>
                                                </tr>
                                            </table> 
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <select name="verteidiger_zusatzmodul" style="width:135px;visibility:hidden;" onchange="schiff2();">
                                                <option value="0" style="background-color:#444444;"><?php echo $lang['metasimulation']['zusatzm'][0]?></option>
                                                <option value="1" style="background-color:#444444;"><?php echo $lang['metasimulation']['zusatzm'][1]?></option>
                                                <option value="2" style="background-color:#444444;"><?php echo $lang['metasimulation']['zusatzm'][2]?></option>
                                                <option value="3" style="background-color:#444444;"><?php echo $lang['metasimulation']['zusatzm'][3]?></option>
                                                <option value="4" style="background-color:#444444;"><?php echo $lang['metasimulation']['zusatzm'][4]?></option>
                                                <option value="5" style="background-color:#444444;"><?php echo $lang['metasimulation']['zusatzm'][5]?></option>
                                            </select>
                                        <center>
                                    </td>
                                </tr>
                                <tr>
                                    <td id="t_2_5_1" style="visibility:hidden"><center><?php echo $lang['metasimulation']['anz_rennurbin']?></center></td>
                                    <td id="t_2_5_2" style="visibility:hidden"><center><?php echo $lang['metasimulation']['kaperangriff']?></center></td>
                                </tr>
                                <tr>
                                    <td>
                                        <center >
                                            <table border="0" cellspacing="1" cellpadding="0" id="anz_ren2" style="visibility:hidden">
                                                <tr>
                                                    <td>
                                                        <input type="text" value="0" class="eingabe" name="verteidiger_anz_ren" onchange="anz_r2()" maxlength="4" style="width:36px">
                                                    </td>
                                                    <td id="max4"></td>
                                                </tr>
                                            </table> 
                                        </center>
                                    </td>
                                    <td><center><input type="checkbox" value="1" name="verteidiger_kapern" style="visibility:hidden"></center></td>
                                </tr>
                                <tr>
                                    <td  id="t_2_7_1" style="visibility:hidden"><center><?php echo $lang['metasimulation']['verstaerkung']?></center></td>
                                    <td  id="t_2_7_2" style="visibility:hidden">
                                        <center>
                                            <img src="../bilder/empty.gif" width="1" height="15" >
                                            <?php echo $lang['metasimulation']['erfahrung']?>
                                            <div id="erf20" style="position:absolute;visibility:hidden;"><img src="../bilder/icons/erf_0.gif" width="22" height="22" border="1" style="border-color:#7f7f7f"onclick="schalter2(1);"></div>
                                            <div id="erf21" style="position:absolute;visibility:hidden;"><img src="../bilder/icons/erf_1.gif" width="22" height="22" border="1" style="border-color:#7f7f7f" onclick="schalter2(2);"></div>
                                            <div id="erf22" style="position:absolute;visibility:hidden;"><img src="../bilder/icons/erf_2.gif" width="22" height="22" border="1" style="border-color:#7f7f7f" onclick="schalter2(3);"></div>
                                            <div id="erf23" style="position:absolute;visibility:hidden;"><img src="../bilder/icons/erf_3.gif" width="22" height="22" border="1" style="border-color:#7f7f7f" onclick="schalter2(4);"></div>
                                            <div id="erf24" style="position:absolute;visibility:hidden;"><img src="../bilder/icons/erf_4.gif" width="22" height="22" border="1" style="border-color:#7f7f7f" onclick="schalter2(5);"></div>
                                            <div id="erf25" style="position:absolute;visibility:hidden;"><img src="../bilder/icons/erf_5.gif" width="22" height="22" border="1" style="border-color:#7f7f7f" onclick="schalter2(0);"></div>
                                        </center>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <center>
                                            <select name="verteidiger_stark" style="width:67px;" style="visibility:hidden">
                                                <?php
                                                for ($n=0;$n<11;$n++) {
                                                    ?>
                                                    <option value="<?php echo $n?>" style="background-color:#444444;"><?php echo $n?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </center>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td id="t_2_9_2" style="visibility:hidden"><center><?php echo $lang['metasimulation']['schild']?></center></td>
                                    <td id="t_2_9_1" style="visibility:hidden"><center><?php echo $lang['metasimulation']['schaden']?></center></td>
                                </tr>
                                    <td>
                                        <center>
                                            <select name="verteidiger_schild" style="width:67px;" style="visibility:hidden">
                                                <?php
                                                for ($n=100;$n>-1;$n--) {
                                                    ?>
                                                    <option value="<?php echo $n?>" style="background-color:#444444;"><?php echo str_replace('{1}',$n,$lang['metasimulation']['vh_ok'])?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <select name="verteidiger_schaden" style="width:67px;" style="visibility:hidden">
                                                <?php
                                                for ($n=0;$n<101;$n++) {
                                                    ?>
                                                    <option value="<?php echo $n?>" style="background-color:#444444;"><?php echo str_replace('{1}',$n,$lang['metasimulation']['vh_ok'])?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </center>
                                    </td>
                                <tr>
                                </tr>
                                <tr>
                                    <td id="t_2_11_1" style="visibility:hidden"><center><?php echo $lang['metasimulation']['aggro']?></center></td>
                                    <td id="t_2_11_2" style="visibility:hidden"><center><?php echo $lang['metasimulation']['daempfer']?></center></td>
                                </tr>
                                <tr>
                                    <td>
                                        <center>
                                            <select name="verteidiger_aggro" style="width:135px;" style="visibility:hidden">
                                                <option value="0" style="background-color:#444444;"><?php echo $lang['metasimulation']['defensiv']?></option>
                                                <option value="1" style="background-color:#444444;" selected><?php echo $lang['metasimulation']['ueberlegt']?></option>
                                                <option value="2" style="background-color:#444444;"><?php echo $lang['metasimulation']['aggressiv']?></option>
                                            </select>
                                        </center>
                                    </td>
                                    <td id="t_2_12_2" style="visibility:hidden"><center><input type="checkbox" value="1" name="verteidiger_daempfer"></center></td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <table border="0" cellspacing="1" cellpadding="0" id="anz_crew2" style="visibility:hidden">
                                            <tr>
                                                <td id="maxcrew2"></td>
                                                <td>
                                                    <input type="text" value="0" class="eingabe" name="verteidiger_crew" onchange="anz_c2()" maxlength="5" style="width:45px">
                                                </td>
                                            </tr>
                                        </table> 
                                    </td>
                                    <td id="t_2_13_2" style="visibility:hidden" align="left"><?php echo $lang['metasimulation']['crew']?></td>
                                </tr>
                            </table>
                        </center>
                    </td>
                </tr>
            </table>
        </center>
        <center>
            <input type="button" value="<?php echo $lang['metasimulation']['simulationstarten']?>" onclick="vorbereitung();" name="subbutton" style="width:170px;visibility:hidden"></td>
            </form>
        </center>
        <center>
            <table border="0" cellspacing="1" cellpadding="0" id="Kampftabelle" style="visibility:visible" >
                <tr>
                    <td><img src="../bilder/empty.gif" width="250" height="1" border="0"></td>
                    <td><img src="../bilder/empty.gif" width="100" height="1" border="0"></td>
                    <td><img src="../bilder/empty.gif" width="250" height="1" border="0"></td>
                <tr>
                <tr>
                    <td id="sonstiges1" align="right">&nbsp;</td>
                    <td id="sonstiges2">&nbsp;</td>
                    <td id="sonstiges3" align="left">&nbsp;</td>
                <tr>
                <tr>
                    <td id="k_1_1" align="right" style="visibility:hidden"><?php echo $lang['metasimulation']['schild']?></td>
                    <td></td>
                    <td id="k_1_2" align="left" style="visibility:hidden"><?php echo $lang['metasimulation']['schild']?></td>
                <tr>
                <tr>
                    <td id="schild1" align="right"></td>
                    <td id="sonstiges4">&nbsp;</td>
                    <td id="schild2" align="left"></td>
                <tr>
                <tr>
                    <td id="k_2_1" align="right" style="visibility:hidden"><?php echo $lang['metasimulation']['schaden']?></td>
                    <td>&nbsp;</td>
                    <td id="k_2_2" align="left" style="visibility:hidden"><?php echo $lang['metasimulation']['schaden']?></td>
                <tr>
                <tr>
                    <td  id="schaden1" align="right"></td>
                    <td>&nbsp;</td>
                    <td id="schaden2" align="left"></td>
                <tr>
                <tr>
                    <td id="k_3_1" align="right" style="visibility:hidden"><?php echo $lang['metasimulation']['crew']?></td>
                    <td>&nbsp;</td>
                    <td id="k_3_2" align="left" style="visibility:hidden"><?php echo $lang['metasimulation']['crew']?></td>
                <tr>
                <tr>
                    <td id="crew1" align="right"></td>
                    <td>&nbsp;</td>
                    <td id="crew2" align="left"></td>
                <tr>
            </table>
        </center>
        </div>
        <?php
    include ("inc.footer.php");
}
if ($fuid==3) {
    include ("inc.header.php");
    ///////////////////////////////////////////////////////////////////////////////////////////////SCHIFFE ANFANG
    $daten_verzeichnis=$main_verzeichnis."../daten/";
    $handle=opendir("$daten_verzeichnis");
    $zaehler=0;
    $schiffe="";
    while ($rasse=readdir($handle)) {
        if ((substr($rasse,0,1)<>'.') and (substr($rasse,0,7)<>'bilder_') and (substr($rasse,strlen($rasse)-4,4)<>'.txt')) {
            if($rasse == "unknown") { continue; }
            $daten="";
            $file=$daten_verzeichnis.$rasse.'/daten.txt';
            $fp = @fopen("$file","r");
            if ($fp) {
                $zaehler5=0;
                while (!feof ($fp)) {
                    $buffer = @fgets($fp, 4096);
                    $daten[$zaehler5]=$buffer;
                    $zaehler5++;
                }
                @fclose($fp);
            }
            $name_rasse[$zaehler]=$daten[0];
            $file=$daten_verzeichnis.$rasse.'/schiffe.txt';
            $fp = @fopen("$file","r");
            if ($fp) {
                $zaehler3[$zaehler]=0;
                $zaehler2=0;
                while (!feof ($fp)) {
                    $buffer = @fgets($fp, 4096);
                    $daten[$zaehler][$zaehler2]=$buffer;
                    $temp=explode(":",$buffer);
                    $schiffe[$zaehler][$zaehler2][0]=$temp[0];
                    $masse=$temp[16];
                    $anzahl_energie=$temp[9];
                    $anzahl_projektil=$temp[10];
                    $anzahl_hangar=$temp[11];
                    $fertigkeiten=$temp[17];
                    $orbitalschild=@intval(substr($fertigkeiten,56,1));
                    $schiffe[$zaehler][$zaehler2][1]=$masse.":".$anzahl_energie.":".$anzahl_projektil.":".$anzahl_hangar.":".$orbitalschild;
                    $zaehler3[$zaehler]++;
                    $zaehler2++;
                }
                @fclose($fp);
            }
            $zaehler++;
        }
    }
    $file=$main_verzeichnis.'../daten/dom_spezien.txt';
    $fp = @fopen("$file","r");
    $anz_osds=0;
    if ($fp) {
        while (!feof ($fp)) {
            $buffer = @fgets($fp, 4096);
            $temp=explode(":",$buffer);
            $orbitalschild=(int)@intval(substr($temp[5],6,3));
            if($orbitalschild>0){
                $osds[0][$anz_osds]=$orbitalschild;
                $osds[1][$anz_osds]=$temp[0];
                $anz_osds++;
            }
        }
        @fclose($fp);
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////RASSENEIGENSCHAFTEN ENDE
    ?>
    <script language=JavaScript>
        strahlenschaden = new Array(3,7,10,15,12,29,35,37,18,45);
        torpedoschaden = new Array(5,8,10,6,15,30,35,12,48,55);
        schiff_masse=new Array();
        schiff_anz_e=new Array();
        schiff_anz_p=new Array();
        schiff_anz_h=new Array();
        schiff_oschild=new Array();
        kampf_schild1=new Array();
        kampf_schild2=new Array();
        kampf_schaden1=new Array();
        kampf_schaden2=new Array();
        kampf_crew1=new Array();
        kampf_crew2=new Array();
        kampf_sonstiges1=new Array();
        kampf_sonstiges2=new Array();
        kampf_ausweichen1=new Array();
        kampf_ausweichen2=new Array();
        <?php
        for($i1=0;$i1<$zaehler;$i1++){
            echo "schiff_masse[$i1]=new Array();\n";
            echo "schiff_anz_e[$i1]=new Array();\n";
            echo "schiff_anz_p[$i1]=new Array();\n";
            echo "schiff_anz_h[$i1]=new Array();\n";
            echo "schiff_oschild[$i1]=new Array();\n";
        }
        for($i1=0;$i1<$zaehler;$i1++){
            for($i2=0;$i2<$zaehler3[$i1];$i2++){
                $temp=explode(":",$schiffe[$i1][$i2][1]);
                echo "schiff_masse[$i1][$i2]=$temp[0];\n";
                echo "schiff_anz_e[$i1][$i2]=$temp[1];\n";
                echo "schiff_anz_p[$i1][$i2]=$temp[2];\n";
                echo "schiff_anz_h[$i1][$i2]=$temp[3];\n";
                echo "schiff_oschild[$i1][$i2]=$temp[4];\n";
            }
        }
        ?>
        function anz_s() {
            maxschild.innerHTML='';
            faktor=eval(formular.verteidiger_stark.value)+eval(formular.verteidiger_stark2.value)+100;
            maxschild.innerHTML='&nbsp;&lt;= ' + faktor;
            shld=(isNaN(formular.verteidiger_schild.value))?0:eval(formular.verteidiger_schild.value+'+0');
            if(shld>faktor){shld=faktor;}
            if(0>shld){shld=0;}
            formular.verteidiger_schild.value=eval(shld+'+0');
            return true;
        }
        function anz_p() {
            i=formular.angreifer_schiff.value;
            faktor=(formular.angreifer_zusatzmodul.value==2)?1.5:1;
            maxtorpedo.innerHTML=' ';
            if(i>0){
                i2=i%1000-1;
                i1=(i-i2-1)/1000;
                if(schiff_anz_p[i1][i2]){
                    faktor=Math.round((schiff_anz_p[i1][i2])*5*faktor);
                    maxtorpedo.innerHTML='&nbsp;&lt;= ' + faktor;
                    torpedo=(isNaN(formular.angreifer_anz_torpedo.value))?0:eval(formular.angreifer_anz_torpedo.value+'+0');
                    if(torpedo>faktor){torpedo=faktor;}
                    if(0>torpedo){torpedo=0;}
                    formular.angreifer_anz_torpedo.value=eval(torpedo+'+0');
                }
            }
            return true;
        };
        function anz_v2() {
            i=formular.verteidiger_basis.value;
            maxstark2.innerHTML='';
            faktor=(3>i)?((i==2)?50:0):((i==3)?110:130);
            maxstark2.innerHTML='&nbsp;&lt;= ' + faktor;
            pds=(isNaN(formular.verteidiger_stark2.value))?0:eval(formular.verteidiger_stark2.value+'+0');
            if(pds>faktor){pds=faktor;}
            if(0>pds){pds=0;}
            formular.verteidiger_stark2.value=eval(pds+'+0');
            anz_s();
            return true;
        }
        function zufall(a,b){
            i=0;
            e=1;
            z=0;
            for(i=0;32>i;i++){
                z=z+Math.random()*e;
                e=e*2;
            }
            z=a+(z*(b-a+1)/e);
            return z;
        }
        function rechnen(e) {
            i=formular.angreifer_schiff.value;
            i2=i%1000-1;
            i1=(i-i2-1)/1000;
            s_masse=schiff_masse[i1][i2];
            s_anz_e=schiff_anz_e[i1][i2];
            s_anz_p=schiff_anz_p[i1][i2];
            s_anz_h=schiff_anz_h[i1][i2];
            s_anz_t=eval(formular.angreifer_anz_torpedo.value);
            s_schild=100;
            s_schaden=eval(formular.angreifer_schaden.value);
            s_erfahrung=eval(formular.angreifer_erfahrung.value);
            s_e_schaden=eval(strahlenschaden[(s_anz_e==0)?1:formular.angreifer_energetik.value]);
            s_p_schaden=eval(torpedoschaden[formular.angreifer_projektile.value]);
            /////////beschaedigung der waffensysteme anfang   
            if((formular.angreifer_zusatzmodul.value==1)&&(0==s_anz_e)){
                s_e_schaden=strahlenschaden[0];
            }
            if (s_schaden>50) {
                prozent = (s_schaden-50)*2;
                test=Math.floor(zufall(1,3));
                if(test==1 && s_anz_e>0){
                    schaden_schaden=Math.round(s_anz_e/100*prozent);
                    s_anz_e -= schaden_schaden;
                }else if(test==2 && s_anz_p>0){ 
                    schaden_schaden=Math.round(s_anz_p/100*prozent);
                    s_anz_p -= schaden_schaden;
                }else if(test==3 && s_anz_h>0){
                    schaden_schaden=Math.round(s_anz_h/100*prozent);
                    s_anz_h -= schaden_schaden;
                }
            }
            /////////beschaedigung der waffensysteme ende 
            if((formular.angreifer_zusatzmodul.value==1)&&(10>s_anz_e)){
                s_anz_e++;
            }
            if((formular.angreifer_zusatzmodul.value==3)&&(5>s_erfahrung)){
                s_erfahrung++;
            }
            p_p_pds=eval(formular.verteidiger_stark.value);
            if(!(formular.verteidiger_ds.value==100)){
                p_p_pds=Math.round((p_p_pds*formular.verteidiger_ds.value/100)+0.5);
            }
            p_s_pds=eval(formular.verteidiger_stark2.value);
            p_schaden=eval(formular.verteidiger_schild.value);
            p_anz_e=Math.min(10,Math.round(Math.sqrt((p_p_pds+p_s_pds)/3)));
            p_anz_h=Math.min(10,Math.round(Math.sqrt(p_p_pds)));
            if (formular.verteidiger_basis.value>0) {p_anz_h=Math.min(10,p_anz_h+5);}
            p_e_schaden=strahlenschaden[Math.max(0,Math.min(9,Math.round(Math.sqrt(p_p_pds/2))))];
            p_s_schaden=eval(p_e_schaden*((80/s_masse)+1));
            p_h_schaden=eval((p_e_schaden*(6400/((s_masse*s_masse)+(2*s_masse)+1)))+1);
            while((p_schaden>0)&&(100>s_schaden)&&((p_p_pds>0)||(formular.verteidiger_basis.value>0))){
                for(i=0;i<10;i++){
                    if((p_schaden>0)&&(100>s_schaden)){
                        if(s_anz_e>i){
                            p_schaden=eval(p_schaden-s_e_schaden);
                        }
                        if(p_anz_e>i){
                            if(s_schild>0){
                                s_schild=eval(s_schild-p_s_schaden);
                            }else{
                                s_schaden=eval(s_schaden+p_h_schaden);
                            }
                        }
                        if((s_anz_p>i)&&(s_anz_t>0)){
                            s_anz_t--;
                            ptest=Math.floor(zufall(1,100));
                            if(ptest<(66+(6*s_erfahrung))){
                                p_schaden=eval(p_schaden-s_p_schaden);
                            }
                        }
                        if(s_anz_h>i){
                            p_schaden=eval(p_schaden-4);
                        }
                        if(p_anz_h>i){
                            if(s_schild>0){
                                s_schild=eval(s_schaden-4);
                            }else{
                                s_schaden=eval(s_schaden+4);
                            }
                        }
                    }
                }
            }
            p_schaden=Math.max(0,Math.round(p_schaden));
            s_schaden=Math.min(100,Math.round(s_schaden));
            s_schild=Math.max(0,Math.round(s_schild));
            if(s_schaden==100){
                ausgabe.innerHTML="<?php echo str_replace('{1}','"+p_schaden+"',$lang['metasimulation']['verteidigergewinntpk']);?>";
            }else{
                ausgabe.innerHTML="<?php echo str_replace(array('{1}','{2}'),array('"+s_schild+"','"+s_schaden+"'),$lang['metasimulation']['angreifergewinntpk']);?>";
            }
        }
        function schiff(){
            i=formular.angreifer_schiff.value;
            formular.subbutton.style.visibility="hidden";
            formular.angreifer_erfahrung.style.visibility="hidden";
            formular.angreifer_energetik.style.visibility="hidden";
            formular.angreifer_projektile.style.visibility="hidden";
            formular.angreifer_zusatzmodul.style.visibility="hidden";
            formular.angreifer_schaden.style.visibility="hidden";
            formular.verteidiger_ds.style.visibility="visible";
            schild.style.visibility="visible";
            basis.style.visibility="visible";
            orbit.style.visibility="visible";
            planet.style.visibility="visible";
            orbitalschild.style.visibility="hidden";
            anz_torpedo.style.visibility="hidden";
            if(i>0){
                i2=i%1000-1;
                i1=(i-i2-1)/1000;
                if(schiff_oschild[i1][i2]==0){
                    formular.angreifer_zusatzmodul.style.visibility="visible";
                    if(schiff_anz_e[i1][i2]){
                        formular.angreifer_energetik.style.visibility="visible";
                    }
                    if((formular.angreifer_zusatzmodul.value==1)||(schiff_anz_h[i1][i2])||(schiff_anz_e[i1][i2])||(schiff_anz_p[i1][i2])){
                        formular.angreifer_erfahrung.style.visibility="visible";
                        formular.angreifer_schaden.style.visibility="visible";
                    }
                    if(schiff_anz_p[i1][i2]){
                        formular.angreifer_projektile.style.visibility="visible";
                        anz_torpedo.style.visibility="visible";
                        anz_p();
                    }
                    formular.subbutton.style.visibility="visible";
                }else{
                    schild.style.visibility="hidden";
                    basis.style.visibility="hidden";
                    orbit.style.visibility="hidden";
                    planet.style.visibility="hidden";
                    orbitalschild.style.visibility="visible";
                    formular.verteidiger_ds.style.visibility="hidden";
                }
            }
        }
    </script>
    <body text="#000000" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="schiff();anz_v2()";>
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
        <center>
            <table border="0" cellspacing="0" cellpadding="0" height="100%">
                <tr>
                    <td>
                        <center>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="5" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <center><img src="../lang/<?php echo $spieler_sprache?>/topics/simsp.gif" width="418" height="25" border="0"></center>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="10" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td align="right"><?php echo $lang['metasimulation']['schiff']?></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><?php echo $lang['metasimulation']['planet']?></td>
                                </tr>
                                <tr>
                                    <td><form name="formular"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="10" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="angreifer_schiff" style="width:270px;" onchange="schiff();">
                                            <option value="0" style="background-color:#444444;"></option>
                                            <?php
                                            for ($n=0;$n<$zaehler;$n++) {
                                                ?>
                                                <optgroup style="background-color:#444444;" label="<?php echo $name_rasse[$n]?>"></option>
                                                <?php
                                                $zaehler2=$zaehler3[$n];
                                                for ($nm=0;$nm<$zaehler2;$nm++) {
                                                    ?>
                                                    <option value="<?php echo $n*1000+$nm+1;?>" label="<?php echo $schiffe[$n][$nm][0]?>" style="background-color:#444444;"><?php echo $schiffe[$n][$nm][0]?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><center>&lt;&lt;&lt; <?php echo $lang['metasimulation']['schiff']?></center></td>
                                    <td><img src="../bilder/empty.gif" width="270" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="170" height="10" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <select name="angreifer_erfahrung" style="width:67px;">
                                            <option value="0" style="background-color:#444444;" selected></option>
                                            <option value="1" style="background-color:#444444;">1</option>
                                            <option value="2" style="background-color:#444444;">2</option>
                                            <option value="3" style="background-color:#444444;">3</option>
                                            <option value="4" style="background-color:#444444;">4</option>
                                            <option value="5" style="background-color:#444444;">5</option>
                                        </select>
                                    </td>
                                    <td><center>&lt;&lt;&lt; <?php echo $lang['metasimulation']['erfahrung']?></center></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="170" height="10" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <select name="angreifer_energetik" style="width:135px;">
                                            <option value="0" style="background-color:#444444;" selected><?php echo $lang['metasimulation']['laser']?></option>
                                            <option value="1" style="background-color:#444444;"><?php echo $lang['metasimulation']['phaser']?></option>
                                            <option value="2" style="background-color:#444444;"><?php echo $lang['metasimulation']['plasmablaster']?></option>
                                            <option value="3" style="background-color:#444444;"><?php echo $lang['metasimulation']['disruptor']?></option>
                                            <option value="4" style="background-color:#444444;"><?php echo $lang['metasimulation']['tachionenstrahler']?></option>
                                            <option value="5" style="background-color:#444444;"><?php echo $lang['metasimulation']['desintegrator']?></option>
                                            <option value="6" style="background-color:#444444;"><?php echo $lang['metasimulation']['gravitraktor']?></option>
                                            <option value="7" style="background-color:#444444;"><?php echo $lang['metasimulation']['potentialverdichter']?></option>
                                            <option value="8" style="background-color:#444444;"><?php echo $lang['metasimulation']['tryxoker']?></option>
                                            <option value="9" style="background-color:#444444;"><?php echo $lang['metasimulation']['partikelvortex']?></option>
                                        </select>
                                    </td>
                                    <td><center>&lt;&lt;&lt; <?php echo $lang['metasimulation']['energetik']?></center></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="170" height="10" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <select name="angreifer_projektile" style="width:135px;">
                                            <option value="0" style="background-color:#444444;" selected><?php echo $lang['metasimulation']['fusionsraketen']?></option>
                                            <option value="1" style="background-color:#444444;"><?php echo $lang['metasimulation']['photonentorpedos']?></option>
                                            <option value="2" style="background-color:#444444;"><?php echo $lang['metasimulation']['transformkanone']?></option>
                                            <option value="3" style="background-color:#444444;"><?php echo $lang['metasimulation']['gammabomben']?></option>
                                            <option value="4" style="background-color:#444444;"><?php echo $lang['metasimulation']['fissionstorpedos']?></option>
                                            <option value="5" style="background-color:#444444;"><?php echo $lang['metasimulation']['munkatapult']?></option>
                                            <option value="6" style="background-color:#444444;"><?php echo $lang['metasimulation']['quantentorpedos']?></option>
                                            <option value="7" style="background-color:#444444;"><?php echo $lang['metasimulation']['micromitgeschuetz']?></option>
                                            <option value="8" style="background-color:#444444;"><?php echo $lang['metasimulation']['singularitaetswerfer']?></option>
                                            <option value="9" style="background-color:#444444;"><?php echo $lang['metasimulation']['novabomben']?></option>
                                        </select>
                                    </td>
                                    <td><center>&lt;&lt;&lt; <?php echo $lang['metasimulation']['projektile']?></center></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="170" height="10" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <table border="0" cellspacing="1" cellpadding="0" id="anz_torpedo" style="visibility:hidden">
                                            <tr>
                                                <td>
                                                    <input type="text" value="0" class="eingabe" name="angreifer_anz_torpedo" onchange="anz_p()" maxlength="3" style="width:27px">
                                                </td>
                                                <td id="maxtorpedo"></td>
                                            </tr>
                                        </table> 
                                    </td>
                                    <td><center>&lt;&lt;&lt; <?php echo $lang['metasimulation']['anz_projektile']?></center></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="170" height="10" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <select name="angreifer_zusatzmodul" style="width:135px;visibility:visible;" onchange="schiff();">
                                            <option value="0" style="background-color:#444444;" selected><?php echo $lang['metasimulation']['zusatzm'][0]?></option>
                                            <option value="1" style="background-color:#444444;"><?php echo $lang['metasimulation']['zusatzm'][4]?></option>
                                            <option value="2" style="background-color:#444444;"><?php echo $lang['metasimulation']['zusatzm'][2]?></option>
                                            <option value="3" style="background-color:#444444;"><?php echo $lang['metasimulation']['zusatzm'][1]?></option>
                                        </select>
                                    <td><center>&lt;&lt;&lt; <?php echo $lang['metasimulation']['zusatzmodul']?></center></td>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="170" height="10" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <select name="angreifer_schaden" style="width:67px;" style="visibility:hidden">
                                            <?php
                                            for ($n=0;$n<101;$n++) {
                                                ?>
                                                <option value="<?php echo $n?>" style="background-color:#444444;"><?php echo str_replace('{1}',$n,$lang['metasimulation']['vh_ok'])?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><center>&lt;&lt;&lt; <?php echo $lang['metasimulation']['schaden']?></center></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="170" height="10" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><center><?php echo $lang['metasimulation']['schild']?> &gt;&gt;&gt;</center></td>
                                    <td id="schild">
                                        <table border="0" cellspacing="1" cellpadding="0">
                                            <tr>
                                                <td>
                                                    <input type="text" value="0" class="eingabe" name="verteidiger_schild" onchange="anz_s()" maxlength="3" style="width:27px">
                                                </td>
                                                <td id="maxschild"></td>
                                            </tr>
                                        </table> 
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="170" height="10" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td id="orbitalschild" style="visibility:hidden"><center><?php echo $lang['metasimulation']['oschild']?></center></td>
                                    <td><center><?php echo $lang['metasimulation']['sternenbasis']?> &gt;&gt;&gt;</center></td>
                                    <td id="basis">
                                        <select name="verteidiger_basis" style="width:135px;" onchange="anz_v2()">
                                            <option value="0" style="background-color:#444444;" selected></option>
                                            <option value="1" style="background-color:#444444;"><?php echo $lang['metasimulation']['raumwerft']?></option>
                                            <option value="2" style="background-color:#444444;"><?php echo $lang['metasimulation']['sternenbasis']?></option>
                                            <option value="3" style="background-color:#444444;"><?php echo $lang['metasimulation']['kampfstation']?></option>
                                            <option value="4" style="background-color:#444444;"><?php echo $lang['metasimulation']['kriegsbasis']?></option>
                                        </select>
                                        </td>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="170" height="10" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><center><?php echo $lang['metasimulation']['pds_orbit']?> &gt;&gt;&gt;</center></td>
                                    <td id="orbit">
                                        <table border="0" cellspacing="1" cellpadding="0">
                                            <tr>
                                                <td>
                                                    <input type="text" value="0" class="eingabe" name="verteidiger_stark2" onchange="anz_v2()" maxlength="3" style="width:27px">
                                                </td>
                                                <td id="maxstark2"></td>
                                            </tr>
                                        </table> 
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="10" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><center><?php echo $lang['metasimulation']['pds_planet']?> &gt;&gt;&gt;</center></td>
                                    <td id="planet">
                                        <select name="verteidiger_stark" style="width:67px;" onchange="anz_s()">
                                            <option value="0" style="background-color:#444444;" selected></option>
                                            <?php
                                            for ($n=1;$n<301;$n++) {
                                                ?>
                                                <option value="<?php echo $n?>" style="background-color:#444444;"><?php echo $n?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        </td>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="10" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><center><?php echo $lang['metasimulation']['ds']?> &gt;&gt;&gt;</center></td>
                                    <td>
                                        <select name="verteidiger_ds" style="width:135px;">
                                            <option value="100" style="background-color:#444444;" selected></option>
                                            <?php
                                            for ($n=0;$n<$anz_osds;$n++) {
                                                ?>
                                                <option value="<?php echo $osds[0][$n]?>" style="background-color:#444444;"><?php echo $osds[1][$n]?></option>
                                                <?php
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="10" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><input type="button" value="<?php echo $lang['metasimulation']['simulationstarten']?>" onclick="rechnen();" name="subbutton" style="width:170px;"></td>
                                    <td></form></td>
                                </tr>
                                <tr>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="25" border="0"></td>
                                    <td><img src="../bilder/empty.gif" width="1" height="1" border="0"></td>
                                </tr>
                                <tr>
                                    <td id="ausgabe" colspan="3">&nbsp;<br>&nbsp;<td>
                                </tr>
                            </table>
                        </center>
                    </td>
                </tr>
            </table>
        </center>
        </div>
        <?php
    include ("inc.footer.php");
}
