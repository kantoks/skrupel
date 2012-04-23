<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'admin';
$fuid = int_get('fu');

if ($fuid==1) {
  include ("inc.header.php");
  if ($spieler==$spieler_admin) {
    ?>
<body text="#ffffff" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#ffffff" vlink="#ffffff" alink="#ffffff" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <center>
    <table border="0" cellspacing="0" cellpadding="3">
      <tr><td><img src="../bilder/empty.gif" border="0" width="1" height="3"></td></tr>
      <tr>
        <td>
          <table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><form name="formular"  method="post" action="admin.php?fu=11&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
              <td><input type="submit" name="bla" value="<?php echo $lang['admin']['zug']?>" style="width:120px;"></td>
              <td></form></td>
            </tr>
          </table>
        </td>
        <td>
          <table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><form name="formular"  method="post" action="admin.php?fu=7&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
              <td><input type="submit" name="bla" value="<?php echo $lang['admin']['autozug']?>" style="width:120px;"></td>
              <td></form></td>
            </tr>
          </table>
        </td>
    <?php
    if($ziel_id==0){
      ?>
        <td>
          <table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><form name="formular"  method="post" action="admin.php?fu=3&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
              <td><input type="submit" name="bla" value="<?php echo $lang['admin']['neuerspieler']?>" style="width:120px;"></td>
              <td></form></td>
            </tr>
          </table>
        </td>
      <?php
    }else{
      ?>
        <td><input type="button" class="nofunc" name="bla" value="<?php echo $lang['admin']['neuerspieler']?>" style="width:120px;"></td>
      <?php
    }
    ?>
      </tr>
      <tr>
        <td>
          <table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><form name="formular"  method="post" action="admin.php?fu=1&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
              <td><input type="submit" name="bla" value="" style="width:120px;"></td>
              <td></form></td>
            </tr>
          </table>
        </td>
        <td>
          <table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><form name="formular"  method="post" action="admin.php?fu=9&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
              <td><input type="submit" name="bla" value="<?php echo $lang['admin']['plasmasturm']?>" style="width:120px;"></td>
              <td></form></td>
            </tr>
          </table>
        </td>
    <?php
    if($ziel_id==0){
      ?>
        <td>
          <table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><form name="formular"  method="post" action="admin.php?fu=5&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
              <td><input type="submit" name="bla" value="<?php echo $lang['admin']['entfernespieler']?>" style="width:120px;"></td>
              <td></form></td>
            </tr>
          </table>
        </td>
      <?php
    }else{
      ?>
        <td><input type="button" class="nofunc" name="bla" value="<?php echo $lang['admin']['entfernespieler']?>" style="width:120px;"></td>
      <?php
    }
    ?>
        </tr>
        <tr>
          <td>
            <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><form name="formular"  method="post" action="admin.php?fu=1&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                <td><input type="submit" name="bla" value="" style="width:120px;"></td>
                <td></form></td>
              </tr>
            </table>
          </td>
          <td>
            <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><form name="formular"  method="post" action="admin.php?fu=12&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                <td><input type="submit" name="bla" value="<?php echo $lang['admin']['piraten']?>" style="width:120px;"></td>
                <td></form></td>
              </tr>
            </table>
          </td>
          <td>
            <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><form name="formular"  method="post" action="admin.php?fu=1&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                <td><input type="submit" name="bla" value="" style="width:120px;"></td>
                <td></form></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td>
            <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><form name="formular"  method="post" action="admin.php?fu=1&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                <td><input type="submit" name="bla" value="" style="width:120px;"></td>
                <td></form></td>
              </tr>
            </table>
        </td>
        <td>
          <table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><form name="formular"  method="post" action="admin.php?fu=14&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
              <td><input type="submit" name="bla" value="<?php echo $lang['admin']['otional']?>" style="width:120px;"></td>
              <td></form></td>
            </tr>
          </table>
        </td>
        <td>
          <table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><form name="formular"  method="post" action="admin.php?fu=1&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
              <td><input type="submit" name="bla" value="" style="width:120px;"></td>
              <td></form></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </center>
    <?php
    include ("inc.footer.php");
  }
}
if ($fuid==2) {
  include ("inc.header.php");
  if($spieler==$spieler_admin){
    $main_verzeichnis="../";
    include ("inc.host.php");
    $lasttick=time();
    $zeiger = mysql_query("UPDATE $skrupel_spiele set lasttick='$lasttick',spieler_1_zug=0,spieler_2_zug=0,spieler_3_zug=0,spieler_4_zug=0,spieler_5_zug=0,spieler_6_zug=0,spieler_7_zug=0,spieler_8_zug=0,spieler_9_zug=0,spieler_10_zug=0 where sid='$sid';");
    ?>
<script language=JavaScript>
  function link(url) {
    if (parent.mittelinksoben.document.globals.map.value==1) {
      parent.mittelinksoben.document.globals.map.value=0;
      parent.mittemitte.window.location='aufbau.php?fu=100&query='+url;
    }else{
      parent.mittemitte.rahmen12.window.location=url;
    }
  }
</script>
<body onLoad="window.location='uebersicht.php?fu=1&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>';" text="#ffffff" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#ffffff" vlink="#ffffff" alink="#ffffff" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <br><br><br><br>
  <center>
    <?php
    echo $lang['admin']['zugberechnet'];
    ?>
  </center>
    <?php
    $fuu=1;
    include ("inc.host_messenger.php");
    ?>
  <script language=JavaScript>
    link('uebersicht_uebersicht.php?fu=1&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');
    window.location='uebersicht.php?fu=1&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>');
  </script>
    <?php
    include ("inc.footer.php");
  }
}
if ($fuid==3) {
  include ("inc.header.php");
  if($spieler==$spieler_admin){
    if ($spieleranzahl==10) {
      ?>
  <body text="#ffffff" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#ffffff" vlink="#ffffff" alink="#ffffff" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <br><br><br><br>
  <center>
      <?php
      echo $lang['admin']['alleslots'];
      ?>
  </center>
      <?php
    }else{
      $verzeichnis="../daten/";
      $handle=opendir("$verzeichnis");
      $zaehler=0;
      while ($file=readdir($handle)) {
        if((substr($file,0,1)<>'.') and (substr($file,0,7)<>'bilder_') and (substr($file,strlen($file)-4,4)<>'.txt')){
          /*/ neuer code /*/ if($file == "unknown") { continue; }
          $datei='../daten/'.$file.'/daten.txt';
          $fp = @fopen("$datei","r");
          if ($fp) {
            $zaehler2=0;
            while (!feof ($fp)) {
              $buffer = @fgets($fp, 4096);
              $daten[$zaehler][$zaehler2]=$buffer;
              $zaehler2++;
            }
            @fclose($fp);
          }
          $filename[$zaehler]=$file;
          $zaehler++;
        }
      }
      closedir($handle);
      $zaehler4=0;
      for ($x=1;$x<=round($umfang/250);$x++) {
        for ($y=1;$y<=round($umfang/250);$y++) {
          $kox=$x*250-125;
          $koy=$y*250-125;
          $xname=chr($x+64);
          $reichweite=122;
          $rand_x_a=$kox-$reichweite;
          $rand_x_b=$kox+$reichweite;
          $rand_y_a=$koy-$reichweite;
          $rand_y_b=$koy+$reichweite;
          $total=0;
          $zeiger_temp = @mysql_query("SELECT count(*) as total FROM $skrupel_planeten where x_pos>=$rand_x_a and x_pos<=$rand_x_b and y_pos>=$rand_y_a and y_pos<=$rand_y_b and besitzer=0 and spiel=$spiel");
          $array_temp = @mysql_fetch_array($zeiger_temp);
          $total=$array_temp["total"];
          if ($total>=1) {
            $sektor[$zaehler4][0]=$x;
            $sektor[$zaehler4][1]=$y;
            $zaehler4++;
          }
        }
      }
      $zeiger = @mysql_query("SELECT * FROM $skrupel_user order by nick");
      $useranzahl = @mysql_num_rows($zeiger);
      ?>
            <body text="#ffffff" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#ffffff" vlink="#ffffff" alink="#ffffff" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
                <img src="../bilder/empty.gif" width="1" height="3"><br>
                <center>
                    <table border="0" cellspacing="0" cellpadding="4">
                        <tr>
                            <td colspan="8"><center><?php echo $lang['admin']['zusatzspieler']?></center></td>
                        </tr>
                        <tr>
                            <td><form name="formular" method="post" action="admin.php?fu=4&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                            <td><?php echo $lang['admin']['spieler']?></td>
                            <td>
                                <select name="spielerid" style="width:150px;">
                                    <?php for ($n=0;$n<$useranzahl;$n++) {
                                        $ok = @mysql_data_seek($zeiger,$n);
                                        $array = @mysql_fetch_array($zeiger);
                                        $uid=$array["id"];
                                        $nick=$array["nick"];
                                        if (($uid>1) and ($spieler_2<>$uid) and ($spieler_3<>$uid) and ($spieler_4<>$uid) and ($spieler_5<>$uid) and ($spieler_6<>$uid) and ($spieler_7<>$uid) and ($spieler_8<>$uid) and ($spieler_9<>$uid) and ($spieler_10<>$uid)) {
                                        ?>
                                        <option value="<?php echo $uid; ?>"><?php echo $nick; ?></option>
                                        <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><?php echo $lang['admin']['ausstattung']?></td>
                            <td>
                                <select name="ausstattung" style="width:150px;">
                                    <option value="1"><?php echo $lang['admin']['einplanet']?></option>
                                    <option value="2"><?php echo $lang['admin']['planet'][0]?></option>
                                    <option value="3"><?php echo $lang['admin']['planet'][1]?></option>
                                    <option value="4"><?php echo $lang['admin']['planet'][2]?></option>
                                    <option value="5"><?php echo $lang['admin']['planet'][3]?></option>
                                    <option value="6"><?php echo $lang['admin']['planet'][4]?></option>
                                    <option value="7"><?php echo $lang['admin']['planet'][5]?></option>
                                </select>
                            </td>
                            <td><center><?php echo $lang['admin']['sektor']?></center></td>
                        </tr>
                        <tr>
                            <td>
                            <td><?php echo $lang['admin']['volk']?></td>
                            <td>
                                <select name="rasse" style="width:150px;">
                                    <?php for ($n=0;$n<$zaehler;$n++) { ?>
                                        <option value="<?php echo $filename[$n]; ?>"><?php echo $daten[$n][0]?></option>
                                    <?php } ?>
                                </select></td>
                            <td><?php echo $lang['admin']['mineralien']?></td>
                            <td>
                                <select name="mineralienhome" style="width:150px;">
                                    <option value="1"><?php echo $lang['admin']['mindaheim'][1]?></option>
                                    <option value="2"><?php echo $lang['admin']['mindaheim'][2]?></option>
                                    <option value="3"><?php echo $lang['admin']['mindaheim'][3]?></option>
                                    <option value="4"><?php echo $lang['admin']['mindaheim'][4]?></option>
                                    <option value="5"><?php echo $lang['admin']['mindaheim'][5]?></option>
                                </select>
                            </td>
                            <td>
                                <center>
                                    <select name="koord" style="width:70px;">
                                        <?php for  ($n=0; $n<$zaehler4;$n++) {
                                            $sektorname=chr($sektor[$n][0]+64);
                                            ?>
                                            <option value="<?php echo $sektor[$n][0]."-".$sektor[$n][1]; ?>"><?php echo $sektorname.$sektor[$n][1]; ?></option>
                                        <?php } ?>
                                    </select>
                                </center>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><?php echo $lang['admin']['slot']?></td>
                            <td>
                                <select name="slot" style="width:150px;"><?php
                                    if ($spieler_1==0) { ?><option value="1" style="background-color:<?php echo $spielerfarbe[1]; ?>;width:100px;"><?php echo $lang['admin']['slot']?> 1</option><?php }
                                    if ($spieler_2==0) { ?><option value="2" style="background-color:<?php echo $spielerfarbe[2]; ?>;width:100px;"><?php echo $lang['admin']['slot']?> 2</option><?php }
                                    if ($spieler_3==0) { ?><option value="3" style="background-color:<?php echo $spielerfarbe[3]; ?>;width:100px;"><?php echo $lang['admin']['slot']?> 3</option><?php }
                                    if ($spieler_4==0) { ?><option value="4" style="background-color:<?php echo $spielerfarbe[4]; ?>;width:100px;"><?php echo $lang['admin']['slot']?> 4</option><?php }
                                    if ($spieler_5==0) { ?><option value="5" style="background-color:<?php echo $spielerfarbe[5]; ?>;width:100px;"><?php echo $lang['admin']['slot']?> 5</option><?php }
                                    if ($spieler_6==0) { ?><option value="6" style="background-color:<?php echo $spielerfarbe[6]; ?>;width:100px;"><?php echo $lang['admin']['slot']?> 6</option><?php }
                                    if ($spieler_7==0) { ?><option value="7" style="background-color:<?php echo $spielerfarbe[7]; ?>;width:100px;"><?php echo $lang['admin']['slot']?> 7</option><?php }
                                    if ($spieler_8==0) { ?><option value="8" style="background-color:<?php echo $spielerfarbe[8]; ?>;width:100px;"><?php echo $lang['admin']['slot']?> 8</option><?php }
                                    if ($spieler_9==0) { ?><option value="9" style="background-color:<?php echo $spielerfarbe[9]; ?>;width:100px;"><?php echo $lang['admin']['slot']?> 9</option><?php }
                                    if ($spieler_10==0) { ?><option value="10" style="background-color:<?php echo $spielerfarbe[10]; ?>;width:100px;"><?php echo $lang['admin']['slot']?> 10</option><?php }
                                    ?>
                                </select>
                            </td>
                            <td><?php echo $lang['admin']['finanzen']?></td>
                            <td>
                                <select name="geldmittel" style="width:150px;">
                                    <option value="1000">1000 <?php echo $lang['admin']['cantox']?></option>
                                    <option value="3500">3500 <?php echo $lang['admin']['cantox']?></option>
                                    <option value="5000">5000 <?php echo $lang['admin']['cantox']?></option>
                                    <option value="15000">15000 <?php echo $lang['admin']['cantox']?></option>
                                    <option value="25000">25000 <?php echo $lang['admin']['cantox']?></option>
                                </select>
                            </td>
                            <td><input type="submit" value="<?php echo $lang['admin']['insspiel']?>" style="width:150px;"></td>
                            <td></form></td>
                        </tr>
                    </table>
                </center>
                <?php
            }
        }
    include ("inc.footer.php");
}
if ($fuid==4) {
    include ("inc.header.php");
    if ($spieler==$spieler_admin) {
        $uid = int_post('spielerid');
        if (($uid>1) and ($spieler_1<>$uid) and ($spieler_2<>$uid) and ($spieler_3<>$uid) and ($spieler_4<>$uid) and ($spieler_5<>$uid) and ($spieler_6<>$uid) and ($spieler_7<>$uid) and ($spieler_8<>$uid) and ($spieler_9<>$uid) and ($spieler_10<>$uid)) {
            $kord=explode("-",str_post('koord','DEFAULT'));
            $i=int_post('slot');
            $ausstattung=int_post('ausstattung');
            $rasse=str_post('rasse','SHORTNAME');
///////////////////////////////////////////////////////////////////////////////////////////////RASSENEIGENSCHAFTEN ANFANG
            $daten_verzeichnis="../daten/";
            $handle=opendir("$daten_verzeichnis");
            while ($rasses=readdir($handle)) {
                if ((substr($rasses,0,1)<>'.') and (substr($rasses,0,7)<>'bilder_') and (substr($rasses,strlen($rasses)-4,4)<>'.txt')) {
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
                    $attribute=explode(":",$daten[3]);
                    $rassenname=$daten[0];
                    $r_eigenschaften[$rasse]['temperatur']=$attribute[0];
                    $r_eigenschaften[$rasse]['planet']=$attribute[1];
                }
            }
/////////////////////RASSENEIGENSCHAFTEN ENDE
            $kox=$kord[0]*250-125;
            $koy=$kord[1]*250-125;
            $xname=chr($x+64);
            $reichweite=122;
            $rand_x_a=$kox-$reichweite;
            $rand_x_b=$kox+$reichweite;
            $rand_y_a=$koy-$reichweite;
            $rand_y_b=$koy+$reichweite;
            $zeiger_temp = @mysql_query("SELECT * FROM $skrupel_planeten where x_pos>=$rand_x_a and x_pos<=$rand_x_b and y_pos>=$rand_y_a and y_pos<=$rand_y_b and besitzer=0 and spiel=$spiel");
            $array = @mysql_fetch_array($zeiger_temp);
            $pid=$array["id"];
            $x_pos=$array["x_pos"];
            $y_pos=$array["y_pos"];
            $kolonisten=rand(1,1000)+(rand(1,1000)*5)+50000;
            $vorrat=5;
            $minen=5;
            $abwehr=5;
            $fabriken=5;
            $cantox=int_post('geldmittel');
            $mineralienhome=int_post('mineralienhome');
            if ($mineralienhome==1) {
                $minrand=50;$maxrand=70;
            }elseif ($mineralienhome==2) {
                $minrand=150;$maxrand=250;
            }elseif ($mineralienhome==3) {
                $minrand=400;$maxrand=600;
            }elseif ($mineralienhome==4) {
                $minrand=700;$maxrand=1000;
            }elseif ($mineralienhome==5) {
                $minrand=1500;$maxrand=2000;
            }
            $lemin=rand($minrand,$maxrand);
            $min1=rand($minrand,$maxrand);
            $min2=rand($minrand,$maxrand);
            $min3=rand($minrand,$maxrand);
            $minrand=1250;$maxrand=2250;
            $planet_lemin=rand($minrand,$maxrand);
            $planet_min1=rand($minrand,$maxrand);
            $planet_min2=rand($minrand,$maxrand);
            $planet_min3=rand($minrand,$maxrand);
            $klasse=$r_eigenschaften[$rasse]['planet'];
            if ($klasse==0) { $klasse=rand(1,9); }
            if ($klasse==1) { $bild=rand(1,9);  //Klasse M wie Erde
            }elseif ($klasse==2) { $bild=rand(1,24);  //Klasse N Wasserwelt
            }elseif ($klasse==3) { $bild=rand(1,16);  //Klasse J wie Luna
            }elseif ($klasse==4) { $bild=rand(1,14);  //Klasse L warm nur wenig Wasseroberflaeche
            }elseif ($klasse==5) { $bild=rand(1,11);  //Klasse G Wuestenplanet
            }elseif ($klasse==6) { $bild=rand(1,22);  //Klasse I Heiss giftige Gase
            }elseif ($klasse==7) { $bild=rand(1,13);   //Klasse C Heiss wie Venus
            }elseif ($klasse==8) { $bild=rand(1,33);  //Klasse K wie Mars
            }elseif ($klasse==9) { $bild=rand(1,9);}    //Klasse F jung zerklueftet
            $temp=$r_eigenschaften[$rasse]['temperatur'];
            if ($temp==0) {
                if ($klasse==1) { $temp=rand(40,60);
                }elseif ($klasse==2) { $temp=rand(30,50);
                }elseif ($klasse==3) { $temp=rand(0,10);
                }elseif ($klasse==4) { $temp=rand(50,75);
                }elseif ($klasse==5) { $temp=rand(86,100);
                }elseif ($klasse==6) { $temp=rand(70,95);
                }elseif ($klasse==7) { $temp=rand(75,90);
                }elseif ($klasse==8) { $temp=rand(20,35);
                }elseif ($klasse==9) { $temp=rand(25,45);}
            }
            $zeiger = @mysql_query("UPDATE $skrupel_planeten set besitzer=$i,vorrat=$vorrat,cantox=$cantox,minen=$minen,abwehr=$abwehr,fabriken=$fabriken,kolonisten=$kolonisten,lemin=$lemin,min1=$min1,min2=$min2,min3=$min3,klasse=$klasse,bild=$bild,temp=$temp,planet_lemin=$planet_lemin,planet_min1=$planet_min1,planet_min2=$planet_min2,planet_min3=$planet_min3 where id=$pid");
            if ($ausstattung>=2) {
                $techlevel=0;
                if ($ausstattung==3) {$techlevel=1;
                }elseif ($ausstattung==4) {$techlevel=3;
                }elseif ($ausstattung==5) {$techlevel=5;
                }elseif ($ausstattung==6) {$techlevel=7;
                }elseif ($ausstattung==7) {$techlevel=9;}
                $namesb='Starbase I';
                $zeiger = @mysql_query("INSERT INTO $skrupel_sternenbasen (name,x_pos,y_pos,rasse,planetid,besitzer,status,t_huelle,t_antrieb,t_energie,t_explosiv,spiel) values ('$namesb',$x_pos,$y_pos,'$rasse',$pid,$i,1,$techlevel,$techlevel,$techlevel,$techlevel,$spiel)");
                $zeiger_temp = @mysql_query("SELECT * FROM $skrupel_sternenbasen where planetid=$pid");
                $array_temp = @mysql_fetch_array($zeiger_temp);
                $baid=$array_temp["id"];
                $zeiger_temp = @mysql_query("UPDATE $skrupel_planeten set sternenbasis=2,sternenbasis_name='$namesb',sternenbasis_id=$baid,sternenbasis_rasse='$rasse' where id=$pid");
            }
            $spalte_spieler="spieler_".$i;
            $spalte_spieler_rasse="spieler_".$i."_rasse";
            $spalte_spieler_planeten="spieler_".$i."_planeten";
            $spalte_spieler_basen="spieler_".$i."_basen";
            $spalte_spieler_schiffe="spieler_".$i."_schiffe";
            $spalte_spieler_rassenname="spieler_".$i."_rassename";
            $planetenwert=5;
            if ($ausstattung>=2) { $basenwert=10; } else { $basenwert=0; }
            $spielerid = int_post('spielerid');
            $zeiger_temp = @mysql_query("UPDATE $skrupel_spiele set $spalte_spieler=$spielerid,$spalte_spieler_rasse='$rasse',$spalte_spieler_planeten=$planetenwert,$spalte_spieler_basen=$basenwert,$spalte_spieler_schiffe=0,$spalte_spieler_rassenname='$rassenname',spieleranzahl=spieleranzahl+1 where id=$spiel");
            function allifinden($partei_a,$partei_b) {
                global $conn,$skrupel_politik,$spiel;
                $total=0;
                $zeiger2 = @mysql_query("SELECT count(*) as total FROM $skrupel_politik where ((partei_a=$partei_a and partei_b=$partei_b) or (partei_b=$partei_a and partei_a=$partei_b)) and status=2 and spiel=$spiel");
                $array2 = @mysql_fetch_array($zeiger2);
                $total=$array2["total"];
                if ($total>=1) { return true; } else { return false;}
            }
///////////////////////////////////////////////////////////////////////////////////////////////NEBELSEKTOREN ANFANG
    if ($nebel>=1) {
        $besitzer_recht[1]='1000000000';
        $besitzer_recht[2]='0100000000';
        $besitzer_recht[3]='0010000000';
        $besitzer_recht[4]='0001000000';
        $besitzer_recht[5]='0000100000';
        $besitzer_recht[6]='0000010000';
        $besitzer_recht[7]='0000001000';
        $besitzer_recht[8]='0000000100';
        $besitzer_recht[9]='0000000010';
        $besitzer_recht[10]='0000000001';
    $dateiinclude="inc.host_nebel.php";
    include ($dateiinclude);
    }
///////////////////////////////////////////////////////////////////////////////////////////////NEBELSEKTOREN ENDE
            ?>
            <body text="#ffffff" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#ffffff" vlink="#ffffff" alink="#ffffff" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
                <br><br><br><br>
                <center><?php echo $lang['admin']['neuvolk']?></center>
                <?php
        }else{
            ?>
            <body text="#ffffff" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#ffffff" vlink="#ffffff" alink="#ffffff" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
                <br><br><br><br>
                <center><?php echo $lang['admin']['schonda']?></center>
            <?php
        }
        include ("inc.footer.php");
    }
}
if ($fuid==5) {
    include ("inc.header.php");
    if ($spieler==$spieler_admin) {
        ?>
        <body text="#ffffff" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#ffffff" vlink="#ffffff" alink="#ffffff" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <?php
            $zahl=0;
            if (($spieler_1>=1) and (1<>$spieler)) {
                $zeiger = @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_1");
                $array = @mysql_fetch_array($zeiger);
                $nick=$array["nick"];
                $feind[$zahl][0]=$nick;
                $feind[$zahl][1]=$spielerfarbe[1];
                $feind[$zahl][2]=1;
                $zahl++;
            }
            if (($spieler_2>=1) and (2<>$spieler)) {
                $zeiger = @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_2");
                $array = @mysql_fetch_array($zeiger);
                $nick=$array["nick"];
                $feind[$zahl][0]=$nick;
                $feind[$zahl][1]=$spielerfarbe[2];
                $feind[$zahl][2]=2;
                $zahl++;
            }
            if (($spieler_3>=1) and (3<>$spieler)) {
                $zeiger = @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_3");
                $array = @mysql_fetch_array($zeiger);
                $nick=$array["nick"];
                $feind[$zahl][0]=$nick;
                $feind[$zahl][1]=$spielerfarbe[3];
                $feind[$zahl][2]=3;
                $zahl++;
            }
            if (($spieler_4>=1) and (4<>$spieler)) {
                $zeiger = @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_4");
                $array = @mysql_fetch_array($zeiger);
                $nick=$array["nick"];
                $feind[$zahl][0]=$nick;
                $feind[$zahl][1]=$spielerfarbe[4];
                $feind[$zahl][2]=4;
                $zahl++;
            }
            if (($spieler_5>=1) and (5<>$spieler)) {
                $zeiger = @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_5");
                $array = @mysql_fetch_array($zeiger);
                $nick=$array["nick"];
                $feind[$zahl][0]=$nick;
                $feind[$zahl][1]=$spielerfarbe[5];
                $feind[$zahl][2]=5;
                $zahl++;
            }
            if (($spieler_6>=1) and (6<>$spieler)) {
                $zeiger = @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_6");
                $array = @mysql_fetch_array($zeiger);
                $nick=$array["nick"];
                $feind[$zahl][0]=$nick;
                $feind[$zahl][1]=$spielerfarbe[6];
                $feind[$zahl][2]=6;
                $zahl++;
            }
            if (($spieler_7>=1) and (7<>$spieler)) {
                $zeiger = @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_7");
                $array = @mysql_fetch_array($zeiger);
                $nick=$array["nick"];
                $feind[$zahl][0]=$nick;
                $feind[$zahl][1]=$spielerfarbe[7];
                $feind[$zahl][2]=7;
                $zahl++;
            }
            if (($spieler_8>=1) and (8<>$spieler)) {
                $zeiger = @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_8");
                $array = @mysql_fetch_array($zeiger);
                $nick=$array["nick"];
                $feind[$zahl][0]=$nick;
                $feind[$zahl][1]=$spielerfarbe[8];
                $feind[$zahl][2]=8;
                $zahl++;
            }
            if (($spieler_9>=1) and (9<>$spieler)) {
                $zeiger = @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_9");
                $array = @mysql_fetch_array($zeiger);
                $nick=$array["nick"];
                $feind[$zahl][0]=$nick;
                $feind[$zahl][1]=$spielerfarbe[9];
                $feind[$zahl][2]=9;
                $zahl++;
            }
            if (($spieler_10>=1) and (10<>$spieler)) {
                $zeiger = @mysql_query("SELECT * FROM $skrupel_user where id=$spieler_10");
                $array = @mysql_fetch_array($zeiger);
                $nick=$array["nick"];
                $feind[$zahl][0]=$nick;
                $feind[$zahl][1]=$spielerfarbe[10];
                $feind[$zahl][2]=10;
                $zahl++;
            }
            if ($zahl>=1) {
                ?>
                <img src="../bilder/empty.gif" width="1" height="9"><br>
                <center>
                    <table border="0" cellspacing="0" cellpadding="7">
                        <tr>
                            <td colspan="3"><center><?php echo $lang['admin']['wersollraus']?></center></td></tr>
                        <tr>
                            <td><form name="formular" method="post" action="admin.php?fu=6&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                            <td>
                                <center>
                                    <select name="spielerid" style="width:250px;"><?php
                                        for ($n=0;$n<$zahl;$n++) {
                                            ?><option value="<?php echo $feind[$n][2]; ?>" style="background-color:<?php echo $feind[$n][1]; ?>;"><?php echo $feind[$n][0]; ?></option><?php
                                        }
                                        ?>
                                    </select>
                                </center>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><center><input type="submit" name="bla" value="<?php echo $lang['admin']['entfernespieler']?>" style="width:250px;"></center></td>
                            <td></form></td>
                        </tr>
                    </table>
                </center>
            <?php } else { ?>
                <center>
                    <table border="0" cellspacing="0" cellpadding="0" height="100%">
                        <tr><td><?php echo $lang['admin']['entfernennichtmgl']?></td></tr>
                    </table>
                </center>
            <?php } 
        include ("inc.footer.php");
    }
}
if ($fuid==6) {
    include ("inc.header.php");
    if ($spieler==$spieler_admin) {
        $raus=int_post('spielerid');
        $zeiger = @mysql_query("SELECT besitzer,id,spiel FROM $skrupel_sternenbasen where besitzer=$raus and spiel=$spiel order by id");
        $basenanzahl = @mysql_num_rows($zeiger);
        if ($basenanzahl>=1) {
            for  ($i=0; $i<$basenanzahl;$i++) {
                $ok = @mysql_data_seek($zeiger,$i);
                $array = @mysql_fetch_array($zeiger);
                $baid=$array["id"];
                $zeiger_temp = @mysql_query("DELETE FROM $skrupel_huellen where baid=$baid;");
            }
        }
        $zeiger = @mysql_query("DELETE FROM $skrupel_sternenbasen where besitzer=$raus and spiel=$spiel");
        $zeiger = @mysql_query("SELECT * FROM $skrupel_schiffe where besitzer=$raus and spiel=$spiel");
        $schiffanzahl = @mysql_num_rows($zeiger);
        if ($schiffanzahl>=1) {
            for  ($i=0; $i<$schiffanzahl;$i++) {
                $ok = @mysql_data_seek($zeiger,$i);
                $array = @mysql_fetch_array($zeiger);
                $shid=$array["id"];
                $zeiger_temp = @mysql_query("DELETE FROM $skrupel_anomalien where art=3 and extra like 's:$shid:%'");
                $zeiger_temp = @mysql_query("UPDATE $skrupel_schiffe set flug=0,warp=0,zielx=0,ziely=0,zielid=0 where flug=3 and zielid=$shid");
            }
        }
        $zeiger = @mysql_query("DELETE FROM $skrupel_schiffe where besitzer=$raus and spiel=$spiel");
        $zeiger = @mysql_query("DELETE FROM $skrupel_politik where spiel=$spiel and (partei_a=$raus or partei_b=$raus)");
        $zeiger = @mysql_query("UPDATE $skrupel_planeten set besitzer=0,kolonisten=0,lemin=0,min1=0,min2=0,min3=0,minen=0,vorrat=0,cantox=0,auto_minen=0,fabriken=0,auto_fabriken=0,abwehr=0,auto_abwehr=0,auto_vorrat=0,sternenbasis=0,sternenbasis_id=0,logbuch='' where besitzer=$raus and spiel=$spiel");
        $zeiger = @mysql_query("DELETE FROM $skrupel_neuigkeiten where spieler_id=$raus and spiel_id=$spiel");
        if ($raus==1) { $zeiger = @mysql_query("UPDATE $skrupel_spiele set spieler_1=0,spieleranzahl=spieleranzahl-1 where id=$spiel"); 
        }elseif ($raus==2) { $zeiger = @mysql_query("UPDATE $skrupel_spiele set spieler_2=0,spieleranzahl=spieleranzahl-1 where id=$spiel");
        }elseif ($raus==3) { $zeiger = @mysql_query("UPDATE $skrupel_spiele set spieler_3=0,spieleranzahl=spieleranzahl-1 where id=$spiel");
        }elseif ($raus==4) { $zeiger = @mysql_query("UPDATE $skrupel_spiele set spieler_4=0,spieleranzahl=spieleranzahl-1 where id=$spiel");
        }elseif ($raus==5) { $zeiger = @mysql_query("UPDATE $skrupel_spiele set spieler_5=0,spieleranzahl=spieleranzahl-1 where id=$spiel");
        }elseif ($raus==6) { $zeiger = @mysql_query("UPDATE $skrupel_spiele set spieler_6=0,spieleranzahl=spieleranzahl-1 where id=$spiel");
        }elseif ($raus==7) { $zeiger = @mysql_query("UPDATE $skrupel_spiele set spieler_7=0,spieleranzahl=spieleranzahl-1 where id=$spiel");
        }elseif ($raus==8) { $zeiger = @mysql_query("UPDATE $skrupel_spiele set spieler_8=0,spieleranzahl=spieleranzahl-1 where id=$spiel");
        }elseif ($raus==9) { $zeiger = @mysql_query("UPDATE $skrupel_spiele set spieler_9=0,spieleranzahl=spieleranzahl-1 where id=$spiel");
        }elseif ($raus==10) { $zeiger = @mysql_query("UPDATE $skrupel_spiele set spieler_10=0,spieleranzahl=spieleranzahl-1 where id=$spiel");}
        ?>
        <body text="#ffffff" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#ffffff" vlink="#ffffff" alink="#ffffff" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <br><br><br><br>
            <center><?php echo $lang['admin']['spielerentfernt']?></center>
            <?php
        include ("inc.footer.php");
    }
}
if ($fuid==7) {
    include ("inc.header.php");
    if ($spieler==$spieler_admin) {
        $zeiger_temp = @mysql_query("SELECT id,autozug FROM $skrupel_spiele where id=$spiel");
        $array = @mysql_fetch_array($zeiger_temp);
        $autozug=$array["autozug"];
        ?>
        <body text="#ffffff" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#ffffff" vlink="#ffffff" alink="#ffffff" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <center>
                <table border="0" cellspacing="0" cellpadding="1">
                    <tr>
                        <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="4"></td>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                        <td><center><?php echo $lang['admin']['automatischzug']?></center></td>
                        <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                    </tr>
                    <tr>
                        <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="12"></td>
                    </tr>
                </table>
            </center>
            <center>
                <table border="0" cellspacing="0" cellpadding="1">
                    <tr>
                    <td><form name="formular" method="post" action="admin.php?fu=8&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                    <td><?php echo $lang['admin']['zugauswertung']?> &nbsp;</td>
                        <td>
                            <select name="autozug">
                                <option value="0"<?php if ($autozug==0) { echo " selected"; }?>><?php echo $lang['admin']['nie']?></option>
                                <option value="6"<?php if ($autozug==6) { echo " selected"; }?>><?php echo $lang['admin']['nach'][0]?></option>
                                <option value="12"<?php if ($autozug==12) { echo " selected"; }?>><?php echo $lang['admin']['nach'][1]?></option>
                                <option value="18"<?php if ($autozug==18) { echo " selected"; }?>><?php echo $lang['admin']['nach'][2]?></option>
                                <option value="24"<?php if ($autozug==24) { echo " selected"; }?>><?php echo $lang['admin']['nach'][3]?></option>
                                <option value="48"<?php if ($autozug==48) { echo " selected"; }?>><?php echo $lang['admin']['nach'][4]?></option>
                        </select>
                    </td>
                    <td>&nbsp;<?php echo $lang['admin']['automatisch']?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="5"><img src="../bilder/empty.gif" border="0" width="1" height="8"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="3"><center><input type="submit" name="bla" value="<?php echo $lang['admin']['sichern']?>" style="width:250px;"></center></td>
                        <td></form></td>
                    </tr>
                </table>
            </center>
            <?php
        include ("inc.footer.php");
    }
}
if ($fuid==8) {
    include ("inc.header.php");
    if ($spieler==$spieler_admin) {
        $autozug=int_post('autozug');
        $zeiger_temp = @mysql_query("UPDATE $skrupel_spiele set autozug=$autozug where id=$spiel");
        ?>
        <body text="#ffffff" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#ffffff" vlink="#ffffff" alink="#ffffff" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <br><br><br><br>
            <?php if ($autozug==0) { ?>
                <center><?php echo $lang['admin']['autoaus']?></center>
            <?php } else { ?>
                <center><?php echo $lang['admin']['zugnach']?> <?php echo $autozug; ?> <?php echo $lang['admin']['stunden']?></center>
            <?php } 
        include ("inc.footer.php");
    }
}
if ($fuid==9) {
    include ("inc.header.php");
    if ($spieler==$spieler_admin) {
        ?>
        <body text="#ffffff" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#ffffff" vlink="#ffffff" alink="#ffffff" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <center>
                <table border="0" cellspacing="0" cellpadding="1">
                    <tr>
                        <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="4"></td>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                        <td><center><?php echo $lang['admin']['plasmastuerme']?></center></td>
                        <td><a href="javascript:hilfe(36);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                    </tr>
                </table>
            </center>
            <center>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><form name="formular" method="post" action="admin.php?fu=10&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                        <td><?php echo $lang['admin']['wievielplasmastuerme']?> &nbsp;</td>
                        <td>
                            <select name="max" style="width:100px;">
                                <option value="0"<?php if ($plasma_max==0) { echo " selected"; }?>>0</option>
                                <option value="1"<?php if ($plasma_max==1) { echo " selected"; }?>>1</option>
                                <option value="2"<?php if ($plasma_max==2) { echo " selected"; }?>>2</option>
                                <option value="3"<?php if ($plasma_max==3) { echo " selected"; }?>>3</option>
                                <option value="4"<?php if ($plasma_max==4) { echo " selected"; }?>>4</option>
                                <option value="5"<?php if ($plasma_max==5) { echo " selected"; }?>>5</option>
                                <option value="6"<?php if ($plasma_max==6) { echo " selected"; }?>>6</option>
                                <option value="7"<?php if ($plasma_max==7) { echo " selected"; }?>>7</option>
                                <option value="8"<?php if ($plasma_max==8) { echo " selected"; }?>>8</option>
                                <option value="9"<?php if ($plasma_max==9) { echo " selected"; }?>>9</option>
                                <option value="10"<?php if ($plasma_max==10) { echo " selected"; }?>>10</option>
                            </select>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><?php echo $lang['admin']['wahrscheinlichkeit']?> &nbsp;</td>
                        <td>
                            <select name="wahr" style="width:100px;">
                                <option value="1"<?php if ($plasma_wahr==1) { echo " selected"; }?>>1 %</option>
                                <option value="2"<?php if ($plasma_wahr==2) { echo " selected"; }?>>2 %</option>
                                <option value="3"<?php if ($plasma_wahr==3) { echo " selected"; }?>>3 %</option>
                                <option value="4"<?php if ($plasma_wahr==4) { echo " selected"; }?>>4 %</option>
                                <option value="5"<?php if ($plasma_wahr==5) { echo " selected"; }?>>5 %</option>
                                <option value="6"<?php if ($plasma_wahr==6) { echo " selected"; }?>>6 %</option>
                                <option value="7"<?php if ($plasma_wahr==7) { echo " selected"; }?>>7 %</option>
                                <option value="8"<?php if ($plasma_wahr==8) { echo " selected"; }?>>8 %</option>
                                <option value="9"<?php if ($plasma_wahr==9) { echo " selected"; }?>>9 %</option>
                                <option value="10"<?php if ($plasma_wahr==10) { echo " selected"; }?>>10 %</option>
                                <option value="15"<?php if ($plasma_wahr==15) { echo " selected"; }?>>15 %</option>
                                <option value="20"<?php if ($plasma_wahr==20) { echo " selected"; }?>>20 %</option>
                                <option value="30"<?php if ($plasma_wahr==30) { echo " selected"; }?>>30 %</option>
                                <option value="40"<?php if ($plasma_wahr==40) { echo " selected"; }?>>40 %</option>
                                <option value="50"<?php if ($plasma_wahr==50) { echo " selected"; }?>>50 %</option>
                                <option value="60"<?php if ($plasma_wahr==60) { echo " selected"; }?>>60 %</option>
                                <option value="70"<?php if ($plasma_wahr==70) { echo " selected"; }?>>70 %</option>
                                <option value="80"<?php if ($plasma_wahr==80) { echo " selected"; }?>>80 %</option>
                                <option value="90"<?php if ($plasma_wahr==90) { echo " selected"; }?>>90 %</option>
                                <option value="100"<?php if ($plasma_wahr==100) { echo " selected"; }?>>100 %</option>
                            </select>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><?php echo $lang['admin']['wvrunden']?> &nbsp;</td>
                        <td>
                            <select name="lang" style="width:100px;">
                                <option value="3"<?php if ($plasma_lang==3) { echo " selected"; }?>>3 <?php echo $lang['admin']['runden']?></option>
                                <option value="4"<?php if ($plasma_lang==4) { echo " selected"; }?>>4 <?php echo $lang['admin']['runden']?></option>
                                <option value="5"<?php if ($plasma_lang==5) { echo " selected"; }?>>5 <?php echo $lang['admin']['runden']?></option>
                                <option value="6"<?php if ($plasma_lang==6) { echo " selected"; }?>>6 <?php echo $lang['admin']['runden']?></option>
                                <option value="7"<?php if ($plasma_lang==7) { echo " selected"; }?>>7 <?php echo $lang['admin']['runden']?></option>
                                <option value="8"<?php if ($plasma_lang==8) { echo " selected"; }?>>8 <?php echo $lang['admin']['runden']?></option>
                                <option value="9"<?php if ($plasma_lang==9) { echo " selected"; }?>>9 <?php echo $lang['admin']['runden']?></option>
                                <option value="10"<?php if ($plasma_lang==10) { echo " selected"; }?>>10 <?php echo $lang['admin']['runden']?></option>
                                <option value="15"<?php if ($plasma_lang==15) { echo " selected"; }?>>15 <?php echo $lang['admin']['runden']?></option>
                                <option value="20"<?php if ($plasma_lang==20) { echo " selected"; }?>>20 <?php echo $lang['admin']['runden']?></option>
                            </select>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="4"><img src="../bilder/empty.gif" border="0" width="1" height="6"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2"><center><input type="submit" name="bla" value="<?php echo $lang['admin']['esichern']?>" style="width:250px;"></center></td>
                        <td></form></td>
                    </tr>
                </table>
            </center>
            <?php
        include ("inc.footer.php");
    }
}
if ($fuid==10) {
    include ("inc.header.php");
    if ($spieler==$spieler_admin) {
        $plasma_max=int_post('max');
        $plasma_wahr=int_post('wahr');
        $plasma_lang=int_post('lang');
        $zeiger_temp = @mysql_query("UPDATE $skrupel_spiele set plasma_max=$plasma_max,plasma_wahr=$plasma_wahr,plasma_lang=$plasma_lang where id=$spiel");
        ?>
        <body text="#ffffff" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#444444" link="#ffffff" vlink="#ffffff" alink="#ffffff" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <br><br><br><br>
            <?php if ($plasma_max==0) { ?>
                <center><?php echo $lang['admin']['plasmadeakt']?></center>
            <?php } else { ?>
                <center><?php echo $lang['admin']['plasmaueber']?></center>
            <?php } 
        include ("inc.footer.php");
    }
}
if ($fuid==11) {
    include ("inc.header.php");
    if ($spieler==$spieler_admin) {
        ?>
        <body text="#000000" bgcolor="#444444"  style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;"  link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <center>
                <table border="0" cellspacing="0" cellpadding="0" height="100%">
                    <tr>
                        <td>
                            <center><?php echo $lang['admin']['zugberechn']?></center>
                        </td>
                    </tr>
                </table>
            </center>
            <script language=JavaScript>
                window.location='admin.php?fu=2&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>';
            </script>
            <?php
        include ("inc.footer.php");
    }
}
if ($fuid==12) {
    include ("inc.header.php");
    if ($spieler==$spieler_admin) {
        ?>
        <body text="#ffffff" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#000000" link="#ffffff" vlink="#ffffff" alink="#ffffff" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <center>
                <table border="0" cellspacing="0" cellpadding="1">
                    <tr>
                        <td colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="4"></td>
                    </tr>
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                        <td><center><?php echo $lang['admin']['raumpiraten']?></center></td>
                        <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                    </tr>
                </table>
            </center>
            <center>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="8"><img src="../bilder/empty.gif" border="0" width="1" height="10"></td>
                    </tr>
                    <tr>
                        <td><form name="formular" method="post" action="admin.php?fu=13&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                        <td><?php echo $lang['admin']['wktzentrum']?></td>
                        <td>&nbsp;</td>
                        <td>
                            <select name="piraten_mitte" style="width:60px;">
                                <option value="0" selected>0 %</option>
                                <option value="1" <?php if ($piraten_mitte==1) { echo "selected"; }?>>1 %</option>
                                <option value="2" <?php if ($piraten_mitte==2) { echo "selected"; }?>>2 %</option>
                                <option value="3" <?php if ($piraten_mitte==3) { echo "selected"; }?>>3 %</option>
                                <option value="4" <?php if ($piraten_mitte==4) { echo "selected"; }?>>4 %</option>
                                <option value="5" <?php if ($piraten_mitte==5) { echo "selected"; }?>>5 %</option>
                                <option value="6" <?php if ($piraten_mitte==6) { echo "selected"; }?>>6 %</option>
                                <option value="7" <?php if ($piraten_mitte==7) { echo "selected"; }?>>7 %</option>
                                <option value="8" <?php if ($piraten_mitte==8) { echo "selected"; }?>>8 %</option>
                                <option value="9" <?php if ($piraten_mitte==9) { echo "selected"; }?>>9 %</option>
                                <option value="10" <?php if ($piraten_mitte==10) { echo "selected"; }?>>10 %</option>
                                <option value="15" <?php if ($piraten_mitte==15) { echo "selected"; }?>>15 %</option>
                                <option value="20" <?php if ($piraten_mitte==20) { echo "selected"; }?>>20 %</option>
                                <option value="25" <?php if ($piraten_mitte==25) { echo "selected"; }?>>25 %</option>
                                <option value="30" <?php if ($piraten_mitte==30) { echo "selected"; }?>>30 %</option>
                                <option value="35" <?php if ($piraten_mitte==35) { echo "selected"; }?>>35 %</option>
                                <option value="40" <?php if ($piraten_mitte==40) { echo "selected"; }?>>40 %</option>
                                <option value="45" <?php if ($piraten_mitte==45) { echo "selected"; }?>>45 %</option>
                                <option value="50" <?php if ($piraten_mitte==50) { echo "selected"; }?>>50 %</option>
                                <option value="55" <?php if ($piraten_mitte==55) { echo "selected"; }?>>55 %</option>
                                <option value="60" <?php if ($piraten_mitte==60) { echo "selected"; }?>>60 %</option>
                                <option value="65" <?php if ($piraten_mitte==65) { echo "selected"; }?>>65 %</option>
                                <option value="70" <?php if ($piraten_mitte==70) { echo "selected"; }?>>70 %</option>
                                <option value="75" <?php if ($piraten_mitte==75) { echo "selected"; }?>>75 %</option>
                                <option value="80" <?php if ($piraten_mitte==80) { echo "selected"; }?>>80 %</option>
                                <option value="85" <?php if ($piraten_mitte==85) { echo "selected"; }?>>85 %</option>
                                <option value="90" <?php if ($piraten_mitte==90) { echo "selected"; }?>>90 %</option>
                                <option value="95" <?php if ($piraten_mitte==95) { echo "selected"; }?>>95 %</option>
                                <option value="100" <?php if ($piraten_mitte==100) { echo "selected"; }?>>100 %</option>
                            </select>
                        </td>
                        <td>&nbsp;</td>
                        <td><?php echo $lang['admin']['frachtmin']?></td>
                        <td>&nbsp;</td>
                        <td>
                            <select name="piraten_min" style="width:60px;">
                                <option value="1" <?php if ($piraten_min==1) { echo "selected"; }?>>1 %</option>
                                <option value="2" <?php if ($piraten_min==2) { echo "selected"; }?>>2 %</option>
                                <option value="3" <?php if ($piraten_min==3) { echo "selected"; }?>>3 %</option>
                                <option value="4" <?php if ($piraten_min==4) { echo "selected"; }?>>4 %</option>
                                <option value="5" <?php if ($piraten_min==5) { echo "selected"; }?>>5 %</option>
                                <option value="6" <?php if ($piraten_min==6) { echo "selected"; }?>>6 %</option>
                                <option value="7" <?php if ($piraten_min==7) { echo "selected"; }?>>7 %</option>
                                <option value="8" <?php if ($piraten_min==8) { echo "selected"; }?>>8 %</option>
                                <option value="9" <?php if ($piraten_min==9) { echo "selected"; }?>>9 %</option>
                                <option value="10" <?php if ($piraten_min==10) { echo "selected"; }?>>10 %</option>
                                <option value="15" <?php if ($piraten_min==15) { echo "selected"; }?>>15 %</option>
                                <option value="20" <?php if ($piraten_min==20) { echo "selected"; }?>>20 %</option>
                                <option value="25" <?php if ($piraten_min==25) { echo "selected"; }?>>25 %</option>
                                <option value="30" <?php if ($piraten_min==30) { echo "selected"; }?>>30 %</option>
                                <option value="35" <?php if ($piraten_min==35) { echo "selected"; }?>>35 %</option>
                                <option value="40" <?php if ($piraten_min==40) { echo "selected"; }?>>40 %</option>
                                <option value="45" <?php if ($piraten_min==45) { echo "selected"; }?>>45 %</option>
                                <option value="50" <?php if ($piraten_min==50) { echo "selected"; }?>>50 %</option>
                                <option value="55" <?php if ($piraten_min==55) { echo "selected"; }?>>55 %</option>
                                <option value="60" <?php if ($piraten_min==60) { echo "selected"; }?>>60 %</option>
                                <option value="65" <?php if ($piraten_min==65) { echo "selected"; }?>>65 %</option>
                                <option value="70" <?php if ($piraten_min==70) { echo "selected"; }?>>70 %</option>
                                <option value="75" <?php if ($piraten_min==75) { echo "selected"; }?>>75 %</option>
                                <option value="80" <?php if ($piraten_min==80) { echo "selected"; }?>>80 %</option>
                                <option value="85" <?php if ($piraten_min==85) { echo "selected"; }?>>85 %</option>
                                <option value="90" <?php if ($piraten_min==90) { echo "selected"; }?>>90 %</option>
                                <option value="95" <?php if ($piraten_min==95) { echo "selected"; }?>>95 %</option>
                                <option value="100" <?php if ($piraten_min==100) { echo "selected"; }?>>100 %</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><?php echo $lang['admin']['wktrand']?></td>
                        <td>&nbsp;</td>
                        <td>
                            <select name="piraten_aussen" style="width:60px;">
                                <option value="0" <?php if ($piraten_aussen==0) { echo "selected"; }?>>0 %</option>
                                <option value="1" <?php if ($piraten_aussen==1) { echo "selected"; }?>>1 %</option>
                                <option value="2" <?php if ($piraten_aussen==2) { echo "selected"; }?>>2 %</option>
                                <option value="3" <?php if ($piraten_aussen==3) { echo "selected"; }?>>3 %</option>
                                <option value="4" <?php if ($piraten_aussen==4) { echo "selected"; }?>>4 %</option>
                                <option value="5" <?php if ($piraten_aussen==5) { echo "selected"; }?>>5 %</option>
                                <option value="6" <?php if ($piraten_aussen==6) { echo "selected"; }?>>6 %</option>
                                <option value="7" <?php if ($piraten_aussen==7) { echo "selected"; }?>>7 %</option>
                                <option value="8" <?php if ($piraten_aussen==8) { echo "selected"; }?>>8 %</option>
                                <option value="9" <?php if ($piraten_aussen==9) { echo "selected"; }?>>9 %</option>
                                <option value="10" <?php if ($piraten_aussen==10) { echo "selected"; }?>>10 %</option>
                                <option value="15" <?php if ($piraten_aussen==15) { echo "selected"; }?>>15 %</option>
                                <option value="20" <?php if ($piraten_aussen==20) { echo "selected"; }?>>20 %</option>
                                <option value="25" <?php if ($piraten_aussen==25) { echo "selected"; }?>>25 %</option>
                                <option value="30" <?php if ($piraten_aussen==30) { echo "selected"; }?>>30 %</option>
                                <option value="35" <?php if ($piraten_aussen==35) { echo "selected"; }?>>35 %</option>
                                <option value="40" <?php if ($piraten_aussen==40) { echo "selected"; }?>>40 %</option>
                                <option value="45" <?php if ($piraten_aussen==45) { echo "selected"; }?>>45 %</option>
                                <option value="50" <?php if ($piraten_aussen==50) { echo "selected"; }?>>50 %</option>
                                <option value="55" <?php if ($piraten_aussen==55) { echo "selected"; }?>>55 %</option>
                                <option value="60" <?php if ($piraten_aussen==60) { echo "selected"; }?>>60 %</option>
                                <option value="65" <?php if ($piraten_aussen==65) { echo "selected"; }?>>65 %</option>
                                <option value="70" <?php if ($piraten_aussen==70) { echo "selected"; }?>>70 %</option>
                                <option value="75" <?php if ($piraten_aussen==75) { echo "selected"; }?>>75 %</option>
                                <option value="80" <?php if ($piraten_aussen==80) { echo "selected"; }?>>80 %</option>
                                <option value="85" <?php if ($piraten_aussen==85) { echo "selected"; }?>>85 %</option>
                                <option value="90" <?php if ($piraten_aussen==90) { echo "selected"; }?>>90 %</option>
                                <option value="95" <?php if ($piraten_aussen==95) { echo "selected"; }?>>95 %</option>
                                <option value="100" <?php if ($piraten_aussen==100) { echo "selected"; }?>>100 %</option>
                            </select>
                        </td>
                        <td>&nbsp;</td>
                        <td><?php echo $lang['admin']['frachtmax']?></td>
                        <td>&nbsp;</td>
                        <td>
                            <select name="piraten_max" style="width:60px;">
                                <option value="1" <?php if ($piraten_max==1) { echo "selected"; }?>>1 %</option>
                                <option value="2" <?php if ($piraten_max==2) { echo "selected"; }?>>2 %</option>
                                <option value="3" <?php if ($piraten_max==3) { echo "selected"; }?>>3 %</option>
                                <option value="4" <?php if ($piraten_max==4) { echo "selected"; }?>>4 %</option>
                                <option value="5" <?php if ($piraten_max==5) { echo "selected"; }?>>5 %</option>
                                <option value="6" <?php if ($piraten_max==6) { echo "selected"; }?>>6 %</option>
                                <option value="7" <?php if ($piraten_max==7) { echo "selected"; }?>>7 %</option>
                                <option value="8" <?php if ($piraten_max==8) { echo "selected"; }?>>8 %</option>
                                <option value="9" <?php if ($piraten_max==9) { echo "selected"; }?>>9 %</option>
                                <option value="10" <?php if ($piraten_max==10) { echo "selected"; }?>>10 %</option>
                                <option value="15" <?php if ($piraten_max==15) { echo "selected"; }?>>15 %</option>
                                <option value="20" <?php if ($piraten_max==20) { echo "selected"; }?>>20 %</option>
                                <option value="25" <?php if ($piraten_max==25) { echo "selected"; }?>>25 %</option>
                                <option value="30" <?php if ($piraten_max==30) { echo "selected"; }?>>30 %</option>
                                <option value="35" <?php if ($piraten_max==35) { echo "selected"; }?>>35 %</option>
                                <option value="40" <?php if ($piraten_max==40) { echo "selected"; }?>>40 %</option>
                                <option value="45" <?php if ($piraten_max==45) { echo "selected"; }?>>45 %</option>
                                <option value="50" <?php if ($piraten_max==50) { echo "selected"; }?>>50 %</option>
                                <option value="55" <?php if ($piraten_max==55) { echo "selected"; }?>>55 %</option>
                                <option value="60" <?php if ($piraten_max==60) { echo "selected"; }?>>60 %</option>
                                <option value="65" <?php if ($piraten_max==65) { echo "selected"; }?>>65 %</option>
                                <option value="70" <?php if ($piraten_max==70) { echo "selected"; }?>>70 %</option>
                                <option value="75" <?php if ($piraten_max==75) { echo "selected"; }?>>75 %</option>
                                <option value="80" <?php if ($piraten_max==80) { echo "selected"; }?>>80 %</option>
                                <option value="85" <?php if ($piraten_max==85) { echo "selected"; }?>>85 %</option>
                                <option value="90" <?php if ($piraten_max==90) { echo "selected"; }?>>90 %</option>
                                <option value="95" <?php if ($piraten_max==95) { echo "selected"; }?>>95 %</option>
                                <option value="100" <?php if ($piraten_max==100) { echo "selected"; }?>>100 %</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8"><img src="../bilder/empty.gif" border="0" width="1" height="10"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="8"><center><input type="submit" name="bla" value="<?php echo $lang['admin']['esichern']?>" style="width:250px;"></center></td>
                        <td></form></td>
                    </tr>
                </table>
            </center>
            <?php
        include ("inc.footer.php");
    }
}
if ($fuid==13) {
    include ("inc.header.php");
    if ($spieler==$spieler_admin) {
        $piraten_aussen2=int_post('piraten_aussen');
        $piraten_mitte2=int_post('piraten_mitte');
        $piraten_max2=int_post('piraten_max');
        $piraten_min2=int_post('piraten_min');
        $zeiger_temp = @mysql_query("UPDATE $skrupel_spiele set piraten_mitte=$piraten_mitte2,piraten_aussen=$piraten_aussen2,piraten_max=$piraten_max2,piraten_min=$piraten_min2 where id=$spiel");
        ?>
        <body text="#ffffff" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#444444" link="#ffffff" vlink="#ffffff" alink="#ffffff" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <br><br><br><br>
            <?php if (($piraten_mitte2==0) and ($piraten_aussen2==0)) { ?>
                <center><?php echo $lang['admin']['piratendeakt']?></center>
            <?php } else { ?>
                <center><?php echo $lang['admin']['plasmaueber']?></center>
            <?php } 
        include ("inc.footer.php");
    }
}
if ($fuid==14) {
    include ("inc.header.php");
    if ($spieler==$spieler_admin) {
        $checked[0] = "";
        $checked[1] = " checked";
        ?>
        <body text="#ffffff" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#444444" link="#ffffff" vlink="#ffffff" alink="#ffffff" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <center>
                <table border="0" cellspacing="0" cellpadding="1">
                    <tr>
                        <td><img src="../bilder/empty.gif" border="0" width="17" height="17"></td>
                        <td><center><?php echo $lang['admin']['optionals']?></center></td>
                        <td><a href="javascript:hilfe();"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                    </tr>
                </table>
            </center>
            <center>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><form name="formular" method="post" action="admin.php?fu=15&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="modul_0" value="1"<?php echo $checked[$module[0]];?>></td><td><?php echo $lang['admin']['sus']?></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="modul_2" value="1"<?php echo $checked[$module[2]];?>></td><td><?php echo $lang['admin']['minenfeld']?></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="modul_3" value="1"<?php echo $checked[$module[3]];?>></td><td><?php echo $lang['admin']['takka']?></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="modul_4" value="1"<?php echo $checked[$module[4]];?>></td><td><?php echo $lang['admin']['wysiwyg']?></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="modul_5" value="1"<?php echo $checked[$module[5]];?>></td><td><?php echo $lang['admin']['forsch']?></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="modul_6" value="1"<?php echo $checked[$module[6]];?>></td><td><?php echo $lang['admin']['held']?></td>
                    </tr>                    
                    <tr>
                        <td colspan="2"><center><input type="submit" name="bla" value="<?php echo $lang['admin']['esichern']?>" style="width:250px;"></center></td>
                        <td></form></td>
                    </tr>
                </table>
            </center>
            <br>
            <?php
        include ("inc.footer.php");
    }
}
if ($fuid==15) {
    include ("inc.header.php");
    if ($spieler==$spieler_admin) {
        $module[0] = int_post('modul_0');
        $module[1] = 0;
        $module[2] = int_post('modul_2');
        $module[3] = int_post('modul_3');
        $module[4] = int_post('modul_4');
        $module[5] = int_post('modul_5');
        $module[6] = int_post('modul_6');
        $module_neu = @implode(":", $module);
        @mysql_query("UPDATE $skrupel_spiele SET module='$module_neu' WHERE id=$spiel");
        ?>
        <body text="#ffffff" style="background-image:url('<?php echo $bildpfad; ?>/aufbau/14.gif'); background-attachment:fixed;" bgcolor="#444444" link="#ffffff" vlink="#ffffff" alink="#ffffff" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <br><br><br><br>
            <center><?php echo $lang['admin']['elementueber']?></center>
            <?php
        include ("inc.footer.php");
    }
}
