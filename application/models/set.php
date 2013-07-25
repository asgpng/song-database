<?php
class Set extends CI_Model {

  var $date            = '';
  var $event           = '';
  var $theme           = '';

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }

  function get_id($date, $event, $theme) {
    $query = $this->db->query("SELECT id FROM sets WHERE date = '$date' AND event = '$event' AND theme = '$theme';");
    return $query->row()->id;
  }

  function get_set($id)
  {
    $query = $this->db->query("SELECT * FROM sets WHERE id = '$id';");
    $row = $query->row();
    return $row;
  }

  function delete_set($id)
  {
    $this->db->query("DELETE FROM sets WHERE id = '$id';");
  }

  function get_sets()
  {
    $query = $this->db->query("SELECT * FROM sets;");
    return $query;
  }

  function update_individual($id, $entry, $content) {
    $this->db->query("UPDATE sets SET $entry='$content' where id = '$id';");
  }

  function get_current_songs($set_id) {
    /* $query = $this->db->query("SELECT * from set_songs INNER JOIN songs ON songs.id = set_songs.song_id INNER JOIN sets ON sets.id = '$set_id ORDER BY set_songs.position ASC';"); */
    $this->db->select("*"); // false?
    $this->db->from('set_songs');
    $this->db->join('songs', 'songs.id = set_songs.song_id');
    $this->db->join('sets', 'sets.id = ' . (int) $set_id);
    $this->db->order_by('set_songs.position', 'asc');
    $query = $this->db->get();
    return $query;
  }

  function current_song_count($set_id) {
    $query = $this->set->get_current_songs($set_id);
    return $query->num_rows();
  }

  function last_set() {
    $query = $this->db->query("SELECT MAX(id) as id from sets;");
    return $query->row()->id;
  }

  function add_to_set($song_id, $set_id) {
    $this->load->model('set_songs');
    $position = $this->set->current_song_count($set_id) + 1;
    $this->set_songs->insert_entry($song_id, $set_id, $position);
  }

  function remove_from_set($song_id, $set_id) {
    $this->load->model('set_songs');
    /* $query = $this->db->query("SELECT  */
    /* $position = $this->set */
  }

  function insert_set($date, $event, $theme) {
    $this->date      = $date;
    $this->event     = $event;
    $this->theme     = $theme;
    $this->db->insert('sets', $this);
  }

}