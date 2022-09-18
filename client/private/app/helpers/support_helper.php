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
