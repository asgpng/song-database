<?php

class Songs extends CI_Controller {

  public function __construct() {
    parent::__construct();
    is_logged_in();
    $this->load->model('song');
    $this->load->model('set_songs');
    $this->load->model('song_tag');
  }

  public function index() {
    $data['title'] = 'View Songs';
    $data['query'] = $this->song->get_songs();
    $data['number_songs'] = $this->song->get_number_songs();
    $this->load->view('templates/header', $data);
    $this->load->view('songs/index', $data);
    $this->load->view('templates/footer', $data);
  }

  public function view($song) {
    $data['title'] = 'View Songs';
    $this->load->view('templates/header', $data);
    $this->load->view('songs/index', $data);
    $this->load->view('templates/footer', $data);
  }

  public function edit() {
    $data['title'] = 'View Songs';
    $this->load->view('templates/header', $data);
    $this->load->view('songs/editor', $data);
    $this->load->view('templates/footer', $data);
  }

  // Not quite working, because it's tricky to have a massive table
  // To be fully functional, it would have to be hacked together with Javascript
  // or something. Also, it takes a while to load a form with 350+ rows, so
  // it would also need to be split up into multiple pages in groups of 20 or so.
  // I leave the code here for future reference, but for now, tagging will
  // have to happen from the main editor.
  public function tag_songs() {
    $data['title'] = 'Tag Songs';
    $data['query'] = $this->song->get_songs();
    $data['number_songs'] = $this->song->get_number_songs();
    $this->load->view('templates/header', $data);
    $this->load->view('songs/tag_songs', $data);
    $this->load->view('templates/footer', $data);
  }

  public function insert_tag() {
    // obtain POST parameters
    $tag_content = $this->input->post('tag');
    $song_id = $this->input->post('song_id');

    // query for tag id from database
    $tag_id = $this->tag->get_tag_id($tag_content);

    // insert link between song and tag
    $this->song_tag->insert_entry($song_id, $tag_id);

    redirect('songs/tag_songs');
  }

}
