<?php

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
    $pool .= ',.-;:_#+*~!$%&/()=?';
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
