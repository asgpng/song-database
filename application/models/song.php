<?php

class Song extends CI_Model {

  var $title              = '';
  var $author_lyrics      = '';
  var $author_music       = '';
  var $copyright_producer = '';
  var $copyright_year     = '';
  var $ccli               = '';
  var $standard_key       = '';
  var $text               = '';

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }

  function get_song($id)
  {
    $query = $this->db->query("SELECT * FROM songs WHERE id = '$id';");
    $row = $query->row();
    return $row;
  }

  function get_header($id) {
    $song = $this->song->get_song($id);
    return $song->title . ' by ' . $song->author_lyrics . ', ' . $song->copyright_producer . ' &copy; ' . $song->copyright_year . ' CCLI # ' . $song->ccli;
  }

  function delete_song($id)
  {
    $this->db->query("DELETE FROM songs WHERE id = '$id';");
  }

  function get_songs()
  {
    $query = $this->db->query("SELECT * FROM songs;");
    return $query;
  }

  function get_text($id) {
    $query = $this->db->query("SELECT text FROM songs WHERE id = '$id';");
    return $query->row()->text;
  }

  function update_individual($id, $entry, $content) {
    $this->db->query("UPDATE songs SET $entry='$content' where id = '$id';");
  }

  function insert_user($netID, $user_type) {
    $this->netID     = $netID;
    $this->user_type = $user_type;
  }

  function insert_entry()
  {
    $this->netID     = $_POST['netID'];
    $this->user_type = $_POST['user_type'];
    $this->name      = $_POST['name'];

    $this->db->insert('user', $this);
  }

  function update_entry()
  {
    $this->netID     = $_POST['netID'];
    $this->user_type = $_POST['user_type'];
    $this->name      = $_POST['name'];

    $this->db->update('user', $this, array('netID' => $_POST['netID']));
  }
}