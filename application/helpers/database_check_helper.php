<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('check_song_existence')) {
  function check_song_existence($song_id) {
    $CI =& get_instance();

    if(!$CI->song->song_exist_id($song_id)) {
      redirect ('music/invalid_song');
    }
    die();
  }
}
