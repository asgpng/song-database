<?php

class Set extends CI_Model {

  var $date            = '';
  var $event           = '';
  var $theme           = '';
  var $id_song1        = '';
  var $id_song2        = '';
  var $id_song3        = '';
  var $id_song4        = '';
  var $id_song5        = '';
  var $id_song6        = '';
  var $id_song7        = '';
  var $id_song8        = '';
  var $id_song9        = '';
  var $id_song10       = '';

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

  function get_first_empty($set_id) {
    $set = $this->set->get_set($set_id);
    $num = 0;
    $found = false;
    /* hacking way of getting first unassigned entry */
    while (!$found) {
      if ($set->id_song1 == 0) {
        $num = 1;
        break;
      }
      if ($set->id_song2 == 0) {
        $num = 2;
        break;
      }
      if ($set->id_song3 == 0) {
        $num = 3;
        break;
      }
      if ($set->id_song4 == 0) {
        $num = 4;
        break;
      }
      if ($set->id_song5 == 0) {
        $num = 5;
        break;
      }
      if ($set->id_song6 == 0) {
        $num = 6;
        break;
      }
      if ($set->id_song7 == 0) {
        $num = 7;
        break;
      }
      if ($set->id_song8 == 0) {
        $num = 8;
        break;
      }
      if ($set->id_song9 == 0) {
        $num = 9;
        break;
      }
      if ($set->id_song10 == 0) {
        $num = 10;
        break;
      }
    }
    return $num;
  }

  function get_current_songs($set_id) {
    $set = $this->set->get_set($set_id);
    $current_songs = array();
    if ($set->id_song1 != 0) {
      array_push($current_songs, $this->song->get_song($set->id_song1));
    }
    if ($set->id_song2 != 0) {
      array_push($current_songs, $this->song->get_song($set->id_song2));
    }
    if ($set->id_song3 != 0) {
      array_push($current_songs, $this->song->get_song($set->id_song3));
    }
    if ($set->id_song4 != 0) {
      array_push($current_songs, $this->song->get_song($set->id_song4));
    }
    if ($set->id_song5 != 0) {
      array_push($current_songs, $this->song->get_song($set->id_song5));
    }
    if ($set->id_song6 != 0) {
      array_push($current_songs, $this->song->get_song($set->id_song6));
    }
    if ($set->id_song7 != 0) {
      array_push($current_songs, $this->song->get_song($set->id_song7));
    }
    if ($set->id_song8 != 0) {
      array_push($current_songs, $this->song->get_song($set->id_song8));
    }
    if ($set->id_song9 != 0) {
      array_push($current_songs, $this->song->get_song($set->id_song9));
    }
    if ($set->id_song10 != 0) {
      array_push($current_songs, $this->song->get_song($set->id_song10));
    }
    return $current_songs;
  }

  function add_to_set($song_id, $set_id) {
    /* $num = $this->set->get_first_empty($set_id); */
    $set = $this->set->get_set($set_id);
    $num = $set->num_songs + 1;
    $this->db->query("UPDATE sets SET num_songs = '$num' where id = '$set_id';");
    $this->db->query("UPDATE sets SET id_song$num='$song_id' where id = '$set_id';");
  }

  function insert_set($date, $event, $theme) {
    $this->date      = $date;
    $this->event     = $event;
    $this->theme     = $theme;
    $this->db->insert('sets', $this);
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