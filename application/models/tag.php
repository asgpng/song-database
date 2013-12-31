<?php

class Tag extends CI_Model {

  var $content ='';

  function __construct() {
    // Call the Model constructor
    parent::__construct();
  }

  function insert_entry($content) {
    $this->content = $content;
    $this->db->insert('tags', $this);
  }

  function get_tag($id) {
    $query = $this->db->query("SELECT * FROM tags WHERE id = '$id';");
    if ($query->num_rows() == 0) {
      return -1;
    }
    else {
      $row = $query->row();
      return $row;
    }
  }

  function get_tag_id($content) {
    $query = $this->db->query("SELECT id from tags WHERE content = '$content';");
    if ($query->num_rows() == 0) {
      return -1;
    }
    else {
      $row = $query->row();
      return $row->id;
    }
  }

}
