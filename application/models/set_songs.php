<?php

class Set_Songs extends CI_Model {

  var $song_id         = '';
  var $set_id          = '';
  var $position        = '';

  function __construct() {
    // Call the Model constructor
    parent::__construct();
  }

  function get_set_song($id) {
    $query = $this->db->query("SELECT * FROM set_songs WHERE id = '$id';");
    $row = $query->row();
    return $row;
  }

  function delete_song($id) {
    $this->db->query("DELETE FROM set_songs WHERE id = '$id';");
  }

  function update_individual($id, $entry, $content) {
    $this->db->query("UPDATE sets SET $entry='$content' where id = '$id';");
  }

  function remove_from_set($set_id, $position) {
    $this->db->query("DELETE FROM set_songs WHERE set_id = '$set_id' AND position = '$position';");
    $this->set_songs->update_all_positions($set_id);
    /* update old positions (if after original) */
    /* $this->db->query("UPDATE set_songs SET position = position - 1 where set_id = '$set_id' AND position >= '$position';"); */
  }

  function update_position($set_id, $old_position, $new_position) {
    $this->db->query("UPDATE set_songs SET position='$new_position' where set_id = '$set_id' and position = '$old_position';");
  }

  function update_all_positions($set_id) {
    $current_songs = $this->set->get_current_songs($set_id);
    $count = 1;
    foreach ($current_songs->result() as $song) {
      $this->set_songs->set_position($set_id, $song->song_id, $count);
      $count++;
    }
  }

  function set_position($set_id, $song_id, $position) {
    $this->db->query("UPDATE set_songs SET position='$position' where set_id = '$set_id' and song_id = '$song_id';");
  }

  function switch_songs($set_id, $position_1, $position_2) {
    $temp = -1;
    $this->set_songs->update_position($set_id, $position_1, $temp);
    $this->set_songs->update_position($set_id, $position_2, $position_1);
    $this->set_songs->update_position($set_id, $temp, $position_2);
  }

  function song_count($song_id) {
    $query = $this->db->query("SELECT * from set_songs WHERE song_id = '$song_id';");
    return $query->num_rows();
  }

  function last_done($song_id) {
    if ($this->set_songs->song_count($song_id) == 0) {
      return "";
    }
    else {
      $query = $this->db->query("SELECT MAX(date) as date from sets JOIN set_songs ON set_songs.set_id = sets.id WHERE set_songs.song_id = '$song_id';");
      return $query->row()->date;
    }
  }

  function insert_entry($song_id, $set_id, $position) {
    $this->song_id   = $song_id;
    $this->set_id    = $set_id;
    $this->position  = $position;
    $this->db->insert('set_songs', $this);
  }

}
