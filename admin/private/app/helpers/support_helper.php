<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('debug'))
{
 function debug($_data, $_die = TRUE){
   echo '<pre>';
   print_r($_data);
   echo '</pre>';
   if($_die)die();
 }
}

if(! function_exists('id_encrypt_decrypt')){
  function id_encrypt_decrypt($_string, $_action = 'encrypt', $_item_type = 'employee')
  {
      /*encrypt method*/
      $_item_types = array(
        'employee' => array(628, 874),
      );
      $_prefix = $_item_types[$_item_type][0];$_multiply_value = 7;$_sufix = $_item_types[$_item_type][1];
      $_encrypt_trans = array("0" => "m","1" => "a","2" => "c","3" => "b","4" => "v","5" => "o","6" => "k","7" => "r","8" => "h","9" => "z");
      $_decrypt_trans = array("m" => "0","a" => "1","c" => "2","b" => "3","v" => "4","o" => "5","k" => "6","r" => "7","h" => "8","z" => "9");
      if($_action == 'encrypt'){
        $_string = strval($_string);
        $_string = $_prefix.$_string.$_sufix;
        $_string = $_string*$_multiply_value;
        $_string = trim(strtr($_string, $_encrypt_trans));
      }
      if($_action == 'decrypt'){
        $_string = trim(strtr($_string, $_decrypt_trans));
        $_string = $_string/$_multiply_value;
        $_string = substr($_string, strlen($_prefix));
        $_string = substr($_string, 0, (-1 * strlen($_sufix)));
      }return $_string;
  }
}
