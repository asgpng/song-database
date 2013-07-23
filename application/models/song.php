<?php

class Song extends CI_Model {

  var $title           = '';
  var $author          = '';
  var $producer        = '';
  var $year            = '';
  var $ccli            = '';
  var $standard_key    = '';
  var $text            = '';

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }

  function get_song($id)
  {
    $query = $this->db->query("SELECT * FROM songs WHERE id = '$id';");
    if ($query->num_rows() == 0) {
      return -1;
    }
    else {
      $row = $query->row();
      return $row;
    }
  }

  function get_header($id) {
    $song = $this->song->get_song($id);
    return '<i>' . $song->title . '</i> by ' . $song->author . ', ' . ' &copy; ' . $song->year . ' ' . $song->producer . ' CCLI # ' . $song->ccli;
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

  function insert_song($title, $author, $producer, $date, $ccli, $text) {
    $this->title     = $title;
    $this->author    = $author;
    $this->producer  = $producer;
    $this->year      = $date;
    $this->ccli      = $ccli;
    $this->text      = $text;
    $this->db->insert('songs', $this);
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