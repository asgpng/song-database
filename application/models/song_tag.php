<?php

class Song_Tag extends CI_Model {

  var $tag_id = '';
  var $song_id = '';

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
    $this->load->model('tag');
  }

  function insert_entry_by_tag_string($song_id, $tag_string) {
    $tag_id = $this->tag->get_tag_id($tag_string);

    // avoid empty entries and those for which links exist
    if ($tag_string != "" && !$this->song_tag->link_exists($song_id, $tag_id)) {
      // if tag doesn't exist yet, create one and retrieve tag id
      if ($tag_id == "-1") {
        $this->tag->insert_entry($tag_string);
        $tag_id = $this->tag->get_tag_id($tag_string);
      }
      // Now, tag_id should exist and be correct, so, add to song_tag table
      $this->song_tag->insert_entry_by_tag_id($song_id, $tag_id);
    }
  }

  function link_exists($song_id, $tag_id) {
    $query = $this->db->query("SELECT * FROM song_tags WHERE song_id = '$song_id' AND tag_id = '$tag_id';");
    if ($query->num_rows() == 0) {
      return false;
    }
    else {
      return true;
    }
  }

  function insert_entry_by_tag_id($song_id, $tag_id) {
    $this->song_id = $song_id;
    $this->tag_id  = $tag_id;
    $this->db->insert('song_tags', $this);
  }

  function get_all_songs_with_tag($tag_id) {
    $this->db->select("*");
    $this->db->from('songs');
    $this->db->join('song_tags', 'songs.id = song_tags.song_id');
    $this->db->join('tags', 'tag.id = song_tags.tag_id');
    $this->db->where('song_tags.id', $tag_id);
    $this->db->order_by('songs.title', 'asc');
    $query = $this->db->get();
    return $query;
  }

  function get_all_tags_of_song($song_id) {
    $this->db->select("content");
    $this->db->from('tags');
    $this->db->join('song_tags', 'song_tags.tag_id = tags.id');
    $this->db->join('songs', 'songs.id = song_tags.song_id');
    $this->db->where('song_tags.song_id', $song_id);
    $this->db->order_by('tags.content', 'asc');
    $query = $this->db->get();
    return $query;
  }

  function string_tags_of_song($song_id) {
    $query = $this->song_tag->get_all_tags_of_song($song_id);
    $tag_count = $this->song_tag->get_tag_count($song_id);
    $output = '';
    if ($tag_count != 0) {
      $c = 1;
      foreach ($query->result() as $tag) {
        $output .= strval($tag->content);
        if ($c != $tag_count) {
          $output = $output . ", ";
        }
        $c++;
      }
    }
    return $output;
  }

  function get_tag_count($song_id) {
    $query = $this->song_tag->get_all_tags_of_song($song_id);
    return $query->num_rows();
  }
}
