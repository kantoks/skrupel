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
function str_post($key) {
    //todo, optionales escapen?
    if(isset($_POST[$key])) {
        if(strlen($_POST[$key]) > 0) {
            return $_POST[$key];
        }
    }
    return false;
}
function str_get($key) {
    //todo, optionales escapen?
    if(isset($_GET[$key])) {
        if(strlen($_GET[$key]) > 0) {
            return $_GET[$key];
        }
    }
    return false;
}
/*function rrannum() {
    mt_srand((double)microtime()*1000000);
    $num = mt_rand(48,122);
    return $num;
}
function rgenchr() {
    do {
        $num = rrannum();
    } while ( ( $num > 57 && $num < 65 ) || ( $num > 90 && $num < 97 ) );
    return chr($num);
}
function rzufallstring() {
    $a = rgenchr();$e = rgenchr();$i = rgenchr();$m = rgenchr();$q = rgenchr();
    $b = rgenchr();$f = rgenchr();$j = rgenchr();$n = rgenchr();$r = rgenchr();
    $c = rgenchr();$g = rgenchr();$k = rgenchr();$o = rgenchr();$s = rgenchr();
    $d = rgenchr();$h = rgenchr();$l = rgenchr();$p = rgenchr();$t = rgenchr();
    $salt = "$a$b$c$d$e$f$g$h$i$j$k$l$m$n$o$p$q$r$s$t";
    return $salt;
}
*/
define('ONLY_LETTERS',0);
define('WITH_NUMBERS', 1);
define('WITH_SPECIAL_CHARACTERS', 2);
function rzufallstring($size = 20, $url = ONLY_LETTERS){
  mt_srand();
  $pool = 'abcdefghijklmnopqrstuvwxyz';
  $pool .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  if($url & WITH_SPECIAL_CHARACTERS){
    $pool .= ',.-;:_#+*~!§$%&/()=?';
  }
  if($url & WITH_NUMBERS){
    $pool .='0123456789';
  }
  $pool_size = strlen($pool);
  $salt ='';
  for($i = 0;$i<$size; $i++){
    $salt .= $pool[mt_rand(0, $pool_size - 1)];
  }
  return $salt; 
} 
