<?php

class Songs extends CI_Controller {

  public function __construct() {
    parent::__construct();
    is_logged_in();
    $this->load->model('song');
  }

  public function index() {
    $data['title'] = 'View Songs';
    $data['query'] = $this->song->get_songs();
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
    if ($this->input->post('content') != '') {
      $content = $this->input->post('content');
      echo 'post successful';
    }
    $this->load->view('templates/header', $data);
    $this->load->view('songs/editor', $data);
    $this->load->view('templates/footer', $data);
  }

  public function codemirror() {
    $id = 1;
    $data['title'] = 'View Songs';
    $data['content'] = $this->song->get_text($id);
    $data['header'] = $this->song->get_header($id);
    $data['song'] = $this->song->get_song($id);
    if ($this->input->post('code') != '') {
      $content = $this->input->post('code');
      echo 'post successful';
    }
    if ($this->input->get('code') != '') {
      /* would be nice to eventually have this be a POST method */
      $code = $this->input->get('code');
      echo $code;
      $data['content'] = $code;
      $this->song->update_individual($id, 'text', safe($code));
    }
    $this->load->view('templates/header', $data);
    $this->load->view('songs/cm_editor', $data);
    $this->load->view('templates/footer', $data);
  }

  public function test() {
    echo site_url('songs/edit');
  }
}
