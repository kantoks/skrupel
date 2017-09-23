<?php
/*
:noTabs=false:indentSize=4:tabSize=4:folding=explicit:collapseFolds=1:
*/
function neuigkeit($art, $icon, $spieler_id, $inhalt) {
    global $db,$skrupel_neuigkeiten,$spiel;
    $datum=time();
    $zeiger_temp = @mysql_query("INSERT INTO $skrupel_neuigkeiten (datum,art,icon,inhalt,spieler_id,spiel_id,sicher) values ('$datum',$art,'$icon','$inhalt',$spieler_id,$spiel,1);");
}
function nick($userid) {
    global $db,$skrupel_user,$spiel;
    $zeiger3 = @mysql_query("SELECT nick,id FROM $skrupel_user WHERE id=$userid");
    $array3 = @mysql_fetch_array($zeiger3);
    return $array3['nick'];
}
function int_post($key) {
    if(isset($_POST[$key])) {
        if(is_numeric($_POST[$key])) {
            return intVal($_POST[$key]);
        }
    }
    return false;
}
function int_get($key) {
    if(isset($_GET[$key])) {
        if(is_numeric($_GET[$key])) {
            return intVal($_GET[$key]);
        }
    }
    return false;
}
function str_post($key,$mode) {
    if (isset($_POST[$key]) and !is_array($_POST[$key])) {
        switch ($mode){
            case 'NONE':
                return $_POST[$key];
            break;
            case 'SQLSAFE':
                $retvar = stripslashes($_POST[$key]);
                if ($key=='thema' || $key=='beitrag' || $key=='offenbarung') {
                    $retvar = nl2br($retvar);
                }
                //$retvar = strtr($retvar, array("\x00" => "\\x00", "\x1a" => "\\x1a", "\n" => "\\n", "\r" => "\\r", "\\" => "\\\\", "'" => "\'", "\"" => "\\\"")); // nur escapen
                $retvar = strtr($retvar, array("\x00" => "\\x00", "\x1a" => "\\x1a", "\n" => "\\n", "\r" => "\\r", "\\" => "", "'" => "", "\"" => "")); // entfernt: " ' \
                return $retvar;
            break;
            case 'SHORTNAME':
                if (!preg_match('/[^0-9A-Za-z_]/',$_POST[$key])) {
                    return $_POST[$key];
                }
            break;
            case 'PATHNAME':
                if (!preg_match('/[^0-9A-Za-z_\/\.:\-]/',$_POST[$key])) {
                    return $_POST[$key];
                }
            break;
            default:
                if (!preg_match('/[^0-9A-Za-z_&:;\-]/',$_POST[$key])) {
                    return $_POST[$key];
                }
        }
    }
    return false;
}
function str_get($key,$mode) {
    if (isset($_GET[$key]) and !is_array($_GET[$key])) {
        switch ($mode){
            case 'NONE':
                return $_GET[$key];
            break;
            case 'SQLSAFE':
                $retvar = stripslashes($_GET[$key]);
                if ($key=='thema' || $key=='beitrag' || $key=='offenbarung') {
                    $retvar = nl2br($retvar);
                }
                //$retvar = strtr($retvar, array("\x00" => "\\x00", "\x1a" => "\\x1a", "\n" => "\\n", "\r" => "\\r", "\\" => "\\\\", "'" => "\'", "\"" => "\\\"")); // nur escapen
                $retvar = strtr($retvar, array("\x00" => "\\x00", "\x1a" => "\\x1a", "\n" => "\\n", "\r" => "\\r", "\\" => "", "'" => "", "\"" => "")); // entfernt: " ' \
                return $retvar;
            break;
            case 'SHORTNAME':
                if (!preg_match('/[^0-9A-Za-z_]/',$_GET[$key])) {
                    return $_GET[$key];
                }
            break;
            case 'PATHNAME':
                if (!preg_match('/[^0-9A-Za-z_\/\.:\-]/',$_GET[$key])) {
                    return $_GET[$key];
                }
            break;
            default:
                if (!preg_match('/[^0-9A-Za-z_&:;\-]/',$_GET[$key])) {
                    return $_GET[$key];
                }
        }
    }
    return false;
}

if (!defined('ONLY_LETTERS')) { define('ONLY_LETTERS',0); }
if (!defined('WITH_NUMBERS')) { define('WITH_NUMBERS', 1); }
if (!defined('WITH_SPECIAL_CHARACTERS')) { define('WITH_SPECIAL_CHARACTERS', 2); }
/**
* Erzeugt einen Zufallsstring
* 
* Erzeugt aus Vorgaben einen Zufallsstring
*@autor finke
*@return string Zufalsstring
*/
function zufallstring($size = 20, $url = ONLY_LETTERS){
  mt_srand();
  $pool = 'abcdefghijklmnopqrstuvwxyz';
  $pool .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  if($url & WITH_SPECIAL_CHARACTERS){
    $pool .= ',.-;:_#+*~!§$%&/()=?';
  }
  if($url & WITH_NUMBERS){
    $pool .='0123456789';
  }
  $pool = str_shuffle($pool);
  $pool_size = strlen($pool);
  $salt ='';
  for($i = 0;$i<$size; $i++){
    $salt .= $pool[mt_rand(0, $pool_size - 1)];
  }
  return $salt; 
}

/**
* erzeugt einen Passworthash aus password + salt mit sha256
*
* Hasht ein Passwort, unter verwendung eines salts. Beim Erstellen eines Hash zur Speicherung leer lassen, beim abgleich muss der Salt aus der DB genommen werden, um identiche ergebnisse zu erhalten
*@autor finke 	
*@param string $passwd Zu hashendes Passwort
*@param string $salt der zum hashen verwendet werden soll
*@return string Passwort hash und salt durch ein : getrennt; Achtung: immer nur nach dem ersten : trennen. Im Hash selber kann keines vorkommen, im Salt schon. BSP: explode(':',cryptPasswd('Mein Passwort'), 2);
*/
function cryptPasswd($passwd, $salt = ''){
    if(strlen($salt) < 16)
        $salt = zufallstring(16, WITH_NUMBERS | WITH_SPECIAL_CHARACTERS);
    $passwd = hash('sha256',$passwd.$salt).':'.$salt;
    return $passwd;
}

function compressed_output() {
  $encoding = getEnv("HTTP_ACCEPT_ENCODING");
  $useragent = getEnv("HTTP_USER_AGENT");
  $method = trim(getEnv("REQUEST_METHOD"));
  $msie = preg_match("=msie=i", $useragent);
  $gzip = preg_match("=gzip=i", $encoding);
  if ($gzip && ($method != "POST" or !$msie)) {
    ob_start("ob_gzhandler");
  } else {
    ob_start();
  }
}

/**
* Oeffnet eine Datenbankverbindung
*
*@param bool new_link erzwingt das Oeffnen einer neuen Verbindung
*@param int client_flags Kombination aus MYSQL_CLIENT_SSL | MYSQL_CLIENT_COMPRESS |  MYSQL_CLIENT_IGNORE_SPACE | MYSQL_CLIENT_INTERACTIVE
*@return Gibt im Erfolgsfall eine MySQL Verbindungs-Kennung zurueck oder FALSE im Fehlerfall. 
*/
function open_db($new_link = FALSE, $client_flags = 0){
	global $db_server, $db_name, $db_port, $db_login, $db_password;

	if (empty($db_name) || empty($db_server) || empty($db_login)) return false;

	$conn = mysql_connect($db_server.':'.$db_port,$db_login,$db_password, $new_link, $client_flags);
	
	if($conn !== FALSE && mysql_select_db($db_name,$conn)){
		$GLOBALS['db'] = $conn;
		return $conn;
	}else return false;
}