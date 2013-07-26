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

  function get_id($title, $author) {
    $query = $this->db->query("SELECT * FROM songs WHERE title = '$title' AND author = '$author';");
    return $query->row()->id;
  }

  function song_exists($title, $author) {
    $query = $this->db->query("SELECT * FROM songs WHERE title = '$title' AND author = '$author';");
    if ($query->num_rows() == 0) {
      return false;
    }
    else {
      return true;
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

  function get_songs($order_by = 'title')
  {
    $query = $this->db->query("SELECT * FROM songs ORDER BY $order_by;");
    return $query;
  }

  function get_songs_search($search_query)
  {
    $query = $this->db->query("SELECT * FROM songs WHERE MATCH(title, author, producer, text) AGAINST ('$search_query*');");
    return $query;
  }

  function get_number_songs() {
    $query = $this->db->query("SELECT * FROM songs;");
    return $query->num_rows();
  }

  function get_text($id) {
    $query = $this->db->query("SELECT text FROM songs WHERE id = '$id';");
    return $query->row()->text;
  }

  function update_individual($id, $entry, $content, $escape = true) {
    if ($escape) {
      $this->db->where('id', $id);
      $this->db->update('songs', array($entry => $content));
    }
    else {
      $this->db->query("UPDATE songs SET $entry='$content' where id = '$id';");
    }
  }

  function insert_song($title, $author, $producer, $year, $ccli, $text, $standard_key) {
    $this->title     = $title;
    $this->author    = $author;
    $this->producer  = $producer;
    $this->year      = $year;
    $this->ccli      = $ccli;
    $this->standard_key = $standard_key;
    $this->text      = trim($text, "\xef\xbb\xbf\t\n\0\x0B");
    $this->db->insert('songs', $this);

    /* $id = $this->song->get_id($$title, $author); */
    /* $this->song->update_individual($id, 'text', $text, false); */
  }
}