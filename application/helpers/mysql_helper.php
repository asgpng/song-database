<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('safe')) {
  function safe($value) {
    return mysql_real_escape_string($value);
  }
}
