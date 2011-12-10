<?php
require_once ('inc.conf.php');
require_once ('inhalt/inc.hilfsfunktionen.php');		
$sprache = str_get('sprache','SHORTNAME');
if (empty($sprache) || !preg_match('/^[a-z]{2}$/', $sprache) || !is_dir('lang/'.$sprache)) {
  $sprache = $language;
}
include ('lang/'.$sprache.'/lang.index.php');

$conn = @mysql_connect($server.':'.$port,$login,$password);
$db = @mysql_select_db($database,$conn);

if ($db) {
  compressed_output();
  $zeiger = @mysql_query("SELECT version, extend, serial FROM $skrupel_info");
  $array = @mysql_fetch_array($zeiger);
  $spiel_version = $array['version'];
  $spiel_extend  = $array['extend'];
  $spiel_serial  = $array['serial'];
  $spieler=0;
  //$_POST  = @array_map('mysql_real_escape_string', $_POST);
  //$_GET   = @array_map('mysql_real_escape_string', $_GET);
  if( ($tmp = str_get('pic_path','PATHNAME')) !== false) {
    $bildpfad = $tmp;
  } elseif( ($tmp = str_post('pic_path','PATHNAME')) !== false) {
    $bildpfad = $tmp;
  }
  if(empty($bildpfad)){
         $bildpfad = 'bilder';
  }
  $login_f  = str_post('login_f','SQLSAFE');
  $pass_f    = str_post('passwort_f','NONE');
  $spiel_slot = int_post('spiel_slot');
///////////////////////////////login ueber link
  if (($hash_f = str_get('hash','SQLSAFE')) !== false) {
    $zeiger = @mysql_query("SELECT 
	`id`,
	`spieler_1`, `spieler_2`, `spieler_3`, `spieler_4`, `spieler_5`, `spieler_6`, `spieler_7`, `spieler_8`, `spieler_9`, `spieler_10`,
	`spieler_1_hash`, `spieler_2_hash`, `spieler_3_hash`, `spieler_4_hash`, `spieler_5_hash`, `spieler_6_hash`, `spieler_7_hash`, `spieler_8_hash`, `spieler_9_hash`, `spieler_10_hash`
	FROM $skrupel_spiele WHERE
      spieler_1_hash = '$hash_f' or
      spieler_2_hash = '$hash_f' or
      spieler_3_hash = '$hash_f' or
      spieler_4_hash = '$hash_f' or
      spieler_5_hash = '$hash_f' or
      spieler_6_hash = '$hash_f' or
      spieler_7_hash = '$hash_f' or
      spieler_8_hash = '$hash_f' or
      spieler_9_hash = '$hash_f' or
      spieler_10_hash = '$hash_f'");
    if (@mysql_num_rows($zeiger)==1) {
      $array = @mysql_fetch_array($zeiger);
      $spiel_slot = $array['id'];
      for ($m=1; $m<=10; $m++) {
        $tmpstr = 'spieler_'.$m;
        if ($array[$tmpstr.'_hash']==$hash_f) {
          $benutzer_id = $array[$tmpstr];
          $zeiger = @mysql_query("SELECT nick,passwort FROM $skrupel_user where id=$benutzer_id");
          $array = @mysql_fetch_array($zeiger);
          $login_f = $array['nick'];
          $pass = $array['passwort'];
          break;
        }
      }
    }
  }
///////////////////////////////login
  $fehler = "";
  if (!(empty($login_f) || (empty($pass_f) && empty($pass)))) {
	if(empty($pass)){
		$zeiger = @mysql_query("SELECT `salt` FROM $skrupel_user WHERE nick='$login_f'");
		if($zeiger = mysql_fetch_array($zeiger)){
			
		  $salt = $zeiger['salt'];
		  $pass_f = cryptPasswd($pass_f, $salt);
		  $pass_f = explode(':',$pass_f, 2);
		  $pass = $pass_f[0];
		} else {
          $fehler = $lang['index']['falscheZugangsdaten'];
        }
	}
    $zeiger = @mysql_query("SELECT * FROM $skrupel_user WHERE nick='$login_f' and passwort='$pass'");
    if (@mysql_num_rows($zeiger)==1) {
      $array = @mysql_fetch_array($zeiger);
      $spieler_id = $array['id'];
      $spieler_name = $array['nick'];
      $spieler_sprache = $array['sprache'];
	  
	  if(!empty($array['bildpfad']) && preg_match('|^[a-z]{3,5}://|', trim($array['bildpfad'])) && !preg_match('|^[a-z]{3,5}://$|', trim($array['bildpfad']))){
		$bildpfad = $array['bildpfad'];
	  }
	  
      if ($spieler_sprache=='') {
        $spieler_sprache=$language;
      }
      $zeiger2 = @mysql_query("SELECT * FROM $skrupel_spiele WHERE (spieler_1=$spieler_id or spieler_2=$spieler_id or spieler_3=$spieler_id or spieler_4=$spieler_id or spieler_5=$spieler_id or spieler_6=$spieler_id or spieler_7=$spieler_id or spieler_8=$spieler_id or spieler_9=$spieler_id or spieler_10=$spieler_id) and id=$spiel_slot");
      if (@mysql_num_rows($zeiger2)==1) {
        $array2 = @mysql_fetch_array($zeiger2);
        $sid   = $array2['sid'];
        $phase = $array2['phase'];
        $spiel = $array2['id'];
        for ($sp=1; $sp<=10; $sp++) {
          if($spieler_id == $array2['spieler_'.$sp]) {
            $spieler = $sp;
          }
        }
        $uid = zufallstring();
        @mysql_query("UPDATE $skrupel_user SET uid='$uid' WHERE id=$spieler_id;");
      } else {
        $fehler = $lang['index']['spielnichtfuerdich'];
      }
    } else {
      $fehler = $lang['index']['falscheZugangsdaten'];
    }
	
  }
  if ($spieler>0)  {
    if ($phase==1) {
      header("Location: inhalt/runde_ende.php?fu=1&spiel=$spiel&bildpfad=$bildpfad&sprache=".$spieler_sprache);
      exit;
    }
///////////////////////////////////////////////////////////////////////////////////////////////
    $zeiger_temp = @mysql_query("SELECT * FROM $skrupel_spiele WHERE phase=0 AND id=$spiel_slot ORDER BY id;");
    $array22 = @mysql_fetch_array($zeiger_temp);
    $autozug  = $array22['autozug'];
    $nebel    = $array22['nebel'];
    $spiel    = $array22['id'];
    $module   = @explode(':', $array22['module']);
    $lasttick = $array22['lasttick'];
    $spieleranzahl = $array22['spieleranzahl'];
    $ziel_id   = $array22['ziel_id'];
    $ziel_info = $array22['ziel_info'];
    $aktuell = time();
    $spieler_1=$array22["spieler_1"];
    $spieler_2=$array22["spieler_2"];
    $spieler_3=$array22["spieler_3"];
    $spieler_4=$array22["spieler_4"];
    $spieler_5=$array22["spieler_5"];
    $spieler_6=$array22["spieler_6"];
    $spieler_7=$array22["spieler_7"];
    $spieler_8=$array22["spieler_8"];
    $spieler_9=$array22["spieler_9"];
    $spieler_10=$array22["spieler_10"];
    for($sp=1; $sp<=10; $sp++) {
      $tmpstr = 'spieler_'.$sp;
      $spieler_id_c[$sp]    = $array22[$tmpstr];
      $spieler_ziel_c[$sp]  = $array22[$tmpstr.'_ziel'];
      $spieler_rasse_c[$sp] = $array22[$tmpstr.'_rasse'];
      $spieler_raus_c[$sp]  = $array22[$tmpstr.'_raus'];
    }
    $plasma_wahr = $array22['plasma_wahr'];
    $plasma_max = $array22['plasma_max'];
    $plasma_lang = $array22['plasma_lang'];
    $piraten_mitte = $array22['piraten_mitte'];
    $piraten_aussen = $array22['piraten_aussen'];
    $piraten_min = $array22['piraten_min'];
    $piraten_max = $array22['piraten_max'];
    $spiel_name = $array22['name'];
    $nebel = $array22['nebel'];
    $runde = $array22['runde'];
    $spieleranzahl = $array22['spieleranzahl'];
    $umfang = $array22['umfang'];
    $aufloesung = $array22['aufloesung'];
    $spiel_out = $array22['oput'];
    if (($autozug>0) and ($runde>1)) {
      $interval = 3600*$autozug;
      if ($aktuell>=$lasttick+$interval) {
        $lasttick=time();
        $zeiger = mysql_query("UPDATE $skrupel_spiele SET lasttick='$lasttick' WHERE id=$spiel;");
        $main_verzeichnis = '';
        include ('inhalt/inc.host.php');
        $zeiger = mysql_query("UPDATE $skrupel_spiele set spieler_1_zug=0,spieler_2_zug=0,spieler_3_zug=0,spieler_4_zug=0,spieler_5_zug=0,spieler_6_zug=0,spieler_7_zug=0,spieler_8_zug=0,spieler_9_zug=0,spieler_10_zug=0 where id=$spiel;");
      }
    }
///////////////////////////////////////////////////////////////////////////////////////////////
    $nachricht = "$spieler_name hat das Spiel betreten.";
    $aktuell=time();
    $zeiger = @mysql_query("INSERT INTO $skrupel_chat (spiel,datum,text,an,von,farbe) values ($spiel_slot,'$aktuell','$nachricht',0,'System','000000');");
    if ($bildpfad=='bilder') {
      $bildpfad='../bilder';
    }
    $zeiger = @mysql_query("UPDATE $skrupel_user set bildpfad='$bildpfad' where id=$spieler_id;");
    ?>
    <html>
      <head>
        <title>Skrupel - Tribute Compilation V<?php echo $spiel_version?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <meta name="Author" content="Bernd Kantoks bernd@kantoks.de">
        <meta name="robots" content="index">
        <meta name="keywords" content=" ">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> 
        <link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon">
      </head>
      <frameset framespacing="0" border="false" frameborder="0" rows="41,*,13,107,10">
        <frameset framespacing="0" border="false" frameborder="0" cols="348,*,402">
          <frame name="obenlinks" scrolling="no" marginwidth="0" marginheight="0" noresize src="inhalt/aufbau.php?fu=1&bildpfad=<?php echo $bildpfad?>" target="_self">
          <frame name="obenmitte" scrolling="no" marginwidth="0" marginheight="0" noresize src="inhalt/aufbau.php?fu=2&bildpfad=<?php echo $bildpfad?>" target="_self">
          <frame name="obenrechts" scrolling="no" marginwidth="0" marginheight="0" noresize src="inhalt/aufbau.php?fu=3&bildpfad=<?php echo $bildpfad?>" target="_self">
        </frameset>
        <frameset framespacing="0" border="false" frameborder="0" cols="57,*,7">
          <frameset framespacing="0" border="false" frameborder="0" rows="339,*,40">
            <frame name="mittelinksoben" scrolling="no" marginwidth="0" marginheight="0" noresize src="inhalt/menu.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>" target="_self">
            <frame name="mittelinksmitte" scrolling="no" marginwidth="0" marginheight="0" noresize src="inhalt/aufbau.php?fu=4&bildpfad=<?php echo $bildpfad?>" target="_self">
            <frame name="mittelinksunten" scrolling="no" marginwidth="0" marginheight="0" noresize src="inhalt/aufbau.php?fu=5&bildpfad=<?php echo $bildpfad?>" target="_self">
          </frameset>
          <frame name="mittemitte" scrolling="auto" marginwidth="0" marginheight="0" noresize src="inhalt/aufbau.php?fu=100&query=uebersicht_uebersicht.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>&bildpfad=<?php echo $bildpfad?>" target="_self">
          <frameset framespacing="0" border="false" frameborder="0" rows="233,*,146">
            <frame name="mitterechtsoben" scrolling="no" marginwidth="0" marginheight="0" noresize src="inhalt/aufbau.php?fu=7&bildpfad=<?php echo $bildpfad?>" target="_self">
            <frame name="mitterechtssmitte" scrolling="no" marginwidth="0" marginheight="0" noresize src="inhalt/aufbau.php?fu=8&bildpfad=<?php echo $bildpfad?>" target="_self">
            <frame name="mitterechtsunten" scrolling="no" marginwidth="0" marginheight="0" noresize src="inhalt/aufbau.php?fu=9&bildpfad=<?php echo $bildpfad?>" target="_self">
          </frameset>
        </frameset>
        <frameset framespacing="0" border="false" frameborder="0" cols="387,*,364">
          <frame name="mitte2links" scrolling="no" marginwidth="0" marginheight="0" noresize src="inhalt/aufbau.php?fu=10&bildpfad=<?php echo $bildpfad?>" target="_self">
          <frame name="mitte2mitte" scrolling="no" marginwidth="0" marginheight="0" noresize src="inhalt/aufbau.php?fu=11&bildpfad=<?php echo $bildpfad?>" target="_self">
          <frame name="mitte2mitte" scrolling="no" marginwidth="0" marginheight="0" noresize src="inhalt/aufbau.php?fu=12&bildpfad=<?php echo $bildpfad?>" target="_self">
        </frameset>
        <frameset framespacing="0" border="false" frameborder="0" cols="56,*,19">
          <frame name="untenlinks" scrolling="no" marginwidth="0" marginheight="0" noresize src="inhalt/menu.php?fu=2&uid=<?php echo $uid?>&sid=<?php echo $sid?>" target="_self">
          <frame name="untenmitte" scrolling="auto" marginwidth="0" marginheight="0" noresize src="inhalt/uebersicht.php?fu=1&uid=<?php echo $uid?>&sid=<?php echo $sid?>" target="_self">
          <frame name="untenrechts" scrolling="no" marginwidth="0" marginheight="0" noresize src="inhalt/aufbau.php?fu=15&bildpfad=<?php echo $bildpfad?>" target="_self">
        </frameset>
        <frameset framespacing="0" border="false" frameborder="0" cols="389,*,361">
          <frame name="unten2links" scrolling="no" marginwidth="0" marginheight="0" noresize src="inhalt/aufbau.php?fu=16&bildpfad=<?php echo $bildpfad?>" target="_self">
          <frame name="unten2mitte" scrolling="no" marginwidth="0" marginheight="0" noresize src="inhalt/aufbau.php?fu=17&bildpfad=<?php echo $bildpfad?>" target="_self">
          <frame name="unten2rechts" scrolling="no" marginwidth="0" marginheight="0" noresize src="inhalt/aufbau.php?fu=18&bildpfad=<?php echo $bildpfad?>" target="_self">
        </frameset>
      </frameset>
      <body>
      </body>
    </html>
    <?php
  } else {
    ?>
    <html>
      <head>
        <title>Skrupel - Tribute Compilation V<?php echo $spiel_version?></title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> 
        <link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon">
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <meta name="Author" content="Bernd Kantoks bernd@kantoks.de">
        <meta name="robots" content="index">
        <meta name="keywords" content=" ">
        <meta http-equiv="imagetoolbar" content="no">
        <style type="text/css">
          body,p,td {
            font-family: Verdana;
            font-size: 10px;
            color: #ffffff;
            scrollbar-darkshadow-color: #444444;
            scrollbar-3dlight-color: #444444;
            scrollbar-track-color: #444444;
            scrollbar-face-color: #555555;
            scrollbar-shadow-color: #222222;
            scrollbar-highlight-color: #888888;
            scrollbar-arrow-color: #555555;
          }
          a {
            color: #aaaaaa;
            font-weight: bold;
            text-decoration: underline;
          }
          a:hover {
            font-weight: bold;
            text-decoration: underline;
            color: #ffffff;
          }
          input,select {
            background-color: #555555;
            color: #ffffff;
            border-bottom-color: #222222;
            border-left-color: #888888;
            border-right-color: #222222;
            border-top-color: #888888;
            border-style: solid;
            border-width: 1px;
            font-family: Verdana;
            font-size: 10px;
          }
          input.eingabe {
            background-color: #555555;
            color: #ffffff;
            border-bottom-color: #888888;
            border-left-color: #222222;
            border-right-color: #888888;
            border-top-color: #222222;
            border-style: solid;
            border-width: 1px;
            font-family: Verdana;
            font-size: 10px;
          }
          textarea {
            background-color: #555555;
            color: #ffffff;
            border-bottom-color: #888888;
            border-left-color: #222222;
            border-right-color: #888888;
            border-top-color: #222222;
            border-style: solid;
            border-width: 1px;
            font-family: Verdana;
            font-size: 10px;
          }
        </style>
        <script language=JavaScript>
          if(parent.frames.length>0) {
            window.top.location.href = "index.php<?php if (!empty($_GET['sprache'])) echo '?sprache='.$_GET['sprache']; ?>";
          }
          function check() {
            if(document.formular.login_f.value == "") {
              alert("<?php echo html_entity_decode($lang['index']['bitteName']);?>");
              document.formular.login_f.focus();
              return false;
            }
            if(document.formular.passwort_f.value == "") {
              alert("<?php echo html_entity_decode($lang['index']['bittePasswort']);?>");
              document.formular.passwort_f.focus();
              return false;
            }
            if(document.formular.spiel_slot.value == 0) {
              alert("<?php echo html_entity_decode($lang['index']['bittespiel']);?>");
              return false;
            }
            return true;
          }
          function infoanzeigen() {
            if (document.formular.spiel_slot.value == 0) {
              alert(document.formular.info_0.value);
            }
            <?php
            $zeiger = @mysql_query("SELECT * FROM $skrupel_spiele order by name");
            if (@mysql_num_rows($zeiger)>0) {
              while ($array = @mysql_fetch_array($zeiger)) {
                $slot_id = $array['id'];
                ?>
                if (document.formular.spiel_slot.value == <?php echo $slot_id?>) {
                  alert(document.formular.info_<?php echo $slot_id?>.value);
                }
                <?php
              }
            }
            ?>
            return true;
          }
        </script>
      </head>
      <body text="#000000" bgcolor="#000000" scroll="no" background="<?php echo $bildpfad?>/hintergrund.gif" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
          <table border="0" height="100%" cellspacing="0" cellpadding="0">
              <tr>
              <td>
                <table border="0" cellspacing="0" cellpadding="0" background="<?php echo $bildpfad?>/login.gif">
                  <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="628" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                  </tr>
                  <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="347"></td>
                    <td valign="top">
                      <center>
                        <img src="../bilder/empty.gif" border="0" width="1" height="30">
                        <br>
                        <img src="<?php echo $bildpfad?>/logo_login.gif" width="329" height="208">
                        <br>
                        <?php
                        $aktuell = time();
                        $zeiger2 = @mysql_query("SELECT * FROM $skrupel_spiele order by name");
                        if (@mysql_num_rows($zeiger2)>0) {
                          $ar_spiele = array(); //kleiner speicher fuer spieldaten, spart 1 query
                          ?>
                                 <table border="0" cellspacing="0" cellpadding="4">
                            <tr>
                                 <td><form action="index.php<?php if (!empty($_GET['sprache'])) echo '?sprache='.$_GET['sprache']; ?>" method="post" name="formular" onSubmit="return check();"><input type="hidden" name="pic_path" value="<?php echo $bildpfad?>"></td>
                               <td align="right"><?php echo $lang['index']['benutzername']?>&nbsp;</td>
                               <td><input type="text" name="login_f" class="eingabe" maxlength="50" style="width:350px;" value=""></td>
                              <td>
                                <input type="hidden" name="info_0" value="<?php echo $lang['index']['bittespiel']?>">
                                <?php
                                while($array2 = @mysql_fetch_array($zeiger2)) {
                                  $str_spielinfo = "";
                                  $slot_id = $array2['id'];
                                  $ar_spiele[] = array(
                                    'id'=>$slot_id,
                                    'name'=>$array2['name'],
                                    'runde'=>$array2['runde'],
                                    'phase'=>$array2['phase']
                                  );
                                  $letztermonat = $array2['letztermonat'];
                                  $lasttick = $array2['lasttick'];
                                  $autozug = $array2['autozug'];
                                  if (strlen($lasttick)==10) { //todo
                                    $datum = date('d.m.y G:i', $lasttick);
                                    $str_spielinfo .= str_replace('{1}',$datum,$lang['index']['letzteauswertung']);
                                    if ($autozug>0) {
                                      $datum_auto = $lasttick+(3600*$autozug);
                                      $datum_auto = date('d.m.y G:i',$datum_auto);
                                      if ($aktuell>=(3600*$autozug)+$lasttick) {
                                        $datum_auto = $lang['index']['nlogin'];
                                      }
                                      $str_spielinfo .= str_replace('{1}',$datum_auto,$lang['index']['autotick']);
                                    }
                                    $str_spielinfo .= "\n";
                                  }
                                  $ar_fehlende = array();
                                  for ($n=1; $n<=10; $n++) {
                                    $tmpstr = 'spieler_'.$n;
                                    if($array2[$tmpstr]>0 && $array2[$tmpstr.'_zug']==0 && $array2[$tmpstr.'_raus']==0) {
                                      $ar_fehlende[] = $array2[$tmpstr];
                                    }
                                  }
                                  if(count($ar_fehlende)>0) {
                                    $str_spielinfo .= $lang['index']['fehlendezuege'];
                                    $qrystr = "SELECT nick FROM $skrupel_user WHERE";
                                    $first = true;
                                    foreach($ar_fehlende as $userid) {
                                      if($first) {
                                        $first = false;
                                        $qrystr .= " id=$userid";
                                      } else {
                                        $qrystr .= " or id=$userid";
                                      }
                                    }
                                    $query_spieler = @mysql_query($qrystr);
                                    if(@mysql_num_rows($query_spieler)>0) {
                                      while($result_spieler = @mysql_fetch_array($query_spieler)) {
                                        $str_spielinfo .= $result_spieler['nick']."\n";
                                      }
                                    }
                                  }
                                  ?>
                                  <input type="hidden" name="info_<?php echo $slot_id?>" value="<?php echo $str_spielinfo?>">
                                  <?php
                                }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td></td>
                              <td align="right"><?php echo $lang['index']['passwort']?>&nbsp;</td>
                              <td><input type="password" name="passwort_f" class="eingabe" maxlength="50" style="width:350px;" value=""></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td align="right"><?php echo $lang['index']['spiel']?>&nbsp;</td>
                              <td>
                                <table border="0" cellspacing="0" cellpadding="0">
                                  <td>
                                    <select name="spiel_slot" style="width:250px;">
                                      <option value="0" style="background-color:#444444;"><?php echo $lang['index']['spielwaehlen']?></option>
                                      <?php
                                      foreach($ar_spiele as $spieldaten) {
                                        if ($spieldaten['phase']==0) {
                                          ?>
                                          <option value="<?php echo $spieldaten['id']?>" style="background-color:#444444;"><?php echo $spieldaten['name']?> <?php echo str_replace('{1}',$spieldaten['runde'],$lang['index']['runde']);?></option>
                                          <?php
                                        } else {
                                          ?>
                                          <option value="<?php echo $spieldaten['id']?>" style="background-color:#444444;"><?php echo $spieldaten['name']?> <?php echo $lang['index']['beendet']?></option>
                                          <?php
                                        }
                                      }
                                      ?>
                                    </select>
                                  </td>
                                  <td><img src="../bilder/empty.gif" border="0" width="8" height="1"></td>
                                  <td align="right"><input type="button" name="aktuellesspiel" value="?" onclick="infoanzeigen();" style="width:20px;"></td>
                                  <td><img src="../bilder/empty.gif" border="0" width="7" height="1"></td>
                                      <td><input type="submit" name="submit" value="<?php echo $lang['index']['login']?>" style="width:65px;"></td>
                                </table>
                              </td>
                              <td></form></td>
                            </tr>
                          </table>
                          <?php
                        } else {
                          ?>
                          <br><br><br>
                          <?php
                          echo $lang['index']['keinspiel'];
                        }
                        ?>
                      </center>
                    </td>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="347"></td>
                  </tr>
                  <tr>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="628" height="1"></td>
                    <td><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </center>
        <?php
        if (strlen($fehler)>0) {
          ?>
          <script language="JavaScript">
            alert('<?php echo html_entity_decode($fehler) ?>');
          </script>
          <?php
        }
        ?>
      </body>
    </html>
    <?php
  }
  @mysql_close();
} else {
  ?>
  <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
  <html>
    <head>
      <title>Skrupel - Tribute Compilation</title>
      <meta name="Author" content="Bernd Kantoks bernd@kantoks.de">
      <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> 
      <link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon">
      <meta name="robots" content="index">
      <meta name="keywords" content=" ">
      <meta http-equiv="imagetoolbar" content="no">
    </head>
    <body text="#000000" scroll="no" bgcolor="#000000" background="<?php echo $bildpfad?>/hintergrund.gif" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
      <center>
        <table border="0" height="100%" cellspacing="0" cellpadding="0">
          <tr><td style="font-family:Verdana;font-size:10px;color:#ffffff;"><nobr><?php echo $lang['index']['fehler']?></nobr></td></tr>
        </table>
      </center>
    </body>
  </html>
  <?php
}
