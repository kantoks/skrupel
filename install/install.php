<!doctype html>
<html>
<head>
<title>Skrupel</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
body{
color:#000;
background: transparent url(../bilder/hintergrund.gif) repeat;
font-family: Verdana;
font-size: 11px;
color: #ffffff;
}
.mainWindow{
background: transparent url(../bilder/login.gif) no-repeat;
vertical-align:middle;
text-align:center;
width:600px;
height:319px;
margin:15% auto 0;
padding:15px;
} 
//-->
</style>
</head>
<body>
  <div class="mainWindow">
  <?php
  $version = "0.974_nightly";
  function rmr($file){
    if(!file_exists ($file)) return false;
    if (is_dir($file)) {
      $objects = scandir($file);
      foreach ($objects as $object) {
        if ($object != "." && $object != "..") {
          rmr($file.'/'.$object);
        }
      }
      return rmdir($file);
    }else{
      return unlink($file);
    }
  }
  require_once ("../inc.conf.php");
  // empfehle das ueberhaupt als array einzufuehren
  $skrupel_db = array(
'planeten'=>$skrupel_planeten,
'spiele'=>$skrupel_spiele,
'schiffe'=>$skrupel_schiffe,
'kampf'=>$skrupel_kampf,
'user'=>$skrupel_user,
'sternenbasen'=>$skrupel_sternenbasen,
'neuigkeiten'=>$skrupel_neuigkeiten,
'chat'=>$skrupel_chat,
'forum_thema'=>$skrupel_forum_thema,
'forum_beitrag'=>$skrupel_forum_beitrag,
'huellen'=>$skrupel_huellen,
'anomalien'=>$skrupel_anomalien,
'nebel'=>$skrupel_nebel,
'politik'=>$skrupel_politik,
'politik_anfrage'=>$skrupel_politik_anfrage,
'konplaene'=>$skrupel_konplaene,
'info'=>$skrupel_info,
'ordner'=>$skrupel_ordner,
'scan'=>$skrupel_scan,
'begegnung'=>$skrupel_begegnung
);
  require_once ('../inhalt/inc.hilfsfunktionen.php');
  $installed = false;
  $conn = mysql_connect($server.':'.$port,"$login","$password");
  if ($conn) {
    $db = mysql_select_db("$database",$conn);
    if ($db) {
      $zeiger = @mysql_query("SELECT version FROM {$skrupel_db['info']}");
       $array = @mysql_fetch_array($zeiger);
       if( $array["version"] == $version){$installed = true;}
    }
  }
  ?>
    <h1>Willkommen bei der Skrupel-Installation.</h1>
    <?php
    if ($installed) {
      echo "Skrupel wurde erfolgreich installiert.";
    } elseif (!$database || !$server || !$login || !$db) {
      ?>
    Bitte &ouml;ffne als erstes die Datei "inc.conf.php"<br>auf deinem
    Computer mit einem Text-Editor (z.B. Notepad).<br> <br> Suche dir
    deine Zugangsdaten für die Datenbank raus<br>und f&uuml;lle die
    Datenbankzugangsdaten-Felder in der "inc.conf.php" aus.<br> <br> Aus
    Sicherheitsgründen solltest du die Adminszugangsdaten &auml;ndern.<br>Diese
    werden benötigt, wenn du z.B. neue Spiele erstellen willst.<br> <br>
    Am besten änderst du die Absenderemail des Servers.<br>Von dieser
    werden Anmeldebestätigungen und andere E-Mails verschickt.<br> <br>
    Wenn du das gemacht hast, lade die "inc.conf.php" wieder auf deinen
    Server<br>und überschreibe die alte, unausgefüllte Version.<br> <br>
    Danach kannst du diese Seite neu laden. Solltest du das alles bereits
    ausgefüllt haben<br>und wieder auf dieser Seite landen, heisst das,
    dass die Daten falsch sind.
    <?php
    }else{
      $serial = zufallstring(20, WITH_SPECIAL_CHARACTERS & WITH_NUMBERS);
      $vars = array(
      'serial' => $serial,
      'version' => $version,
      'skrupel_db' => $skrupel_db      
      );
      $sql = fopen('install.sql', 'r');
      if($sql){
      $puffer = '';
      while (!feof($sql)) {
        $puffer .= fgets($sql, 4096);
        while($pos = strpos($puffer,';')){
          $query = trim(substr($puffer, 0, $pos));
          if(preg_match_all('/{[^}]+}/', $query,$matches )){
           foreach($matches[0] as $v){
             $v2 = substr($v,1,-1);
             $v2 = explode('.', $v2);
             $tmp = $vars;
             foreach($v2 as $value){
               if(isset($tmp[$value])) $tmp = $tmp[$value];                              
             }
             $query = str_replace($v, $tmp, $query);
           }
          }
          //echo "<p>query:$query</p>\n";
          //absenden des Querys
          mysql_query($query, $conn);
          echo mysql_error();
          $puffer = substr($puffer, $pos + 1);
        }
      }
      fclose ($sql);
      }else{
       echo 'Install.sql nicht gefunden';
      }
      $zeiger = mysql_query("SELECT version FROM {$skrupel_db['info']}");
      echo mysql_error();
      $array = mysql_fetch_array($zeiger);
       if($array["version"] == $version){
        $installed = true;
      }else {
        $installed = false;
      }
    if ($installed) {
      rmr('../install');
      ?>
    Skrupel wurde installiert. Du kannst dich jetzt unter
    http://{DEIN-SKRUPEL-SERVER}/admin/ mit deinem<br> gew&auml;hlten
    Adminnamen und Passwort einloggen, einen User erstellen und dein
    erstes Spiel starten.<br> <br> Viel Spass, und danke, dass du Skrupel
    installiert hast!<br> <br> Bitte l&ouml;sche den install Ordner jetzt,
    wenn das noch nicht automatich geschehen ist.
    <?php
    } else {
     echo mysql_error();
      echo "Installation aus unbekannten Gr&uuml;nden fehlgeschlagen.<br>Bitte versuche es erneut (inc.conf.php &uuml;berpr&uuml;fen und Seite neuladen).<br>Sollte es weiterhin nicht gehen, melde dich bitte im Forum.";
    }
    }
    mysql_close();
    ?>
  </div>
</body>
</html>
