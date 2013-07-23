<?php

class Music extends CI_Controller {

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

  public function codemirror($id) {
    $data['title'] = 'View Songs';
    $data['content'] = $this->song->get_text($id);
    $data['header'] = $this->song->get_header($id);
    $data['song'] = $this->song->get_song($id);
    if ($this->input->post('code') != '') {
      $code = $this->input->post('code');
      /* echo $code; */
      $data['content'] = $code;
      $this->song->update_individual($id, 'text', safe($code));
    }
    $this->load->view('templates/header', $data);
    $this->load->view('songs/cm_editor', $data);
    $this->load->view('templates/footer', $data);
  }

  public function update_metadata() {
    $id = $this->input->post('id');
    $this->song->update_individual($id, 'title', $this->input->post('title'));
    $this->song->update_individual($id, 'author', $this->input->post('author'));
    $this->song->update_individual($id, 'producer', $this->input->post('producer'));
    $this->song->update_individual($id, 'year', $this->input->post('year'));
    $this->song->update_individual($id, 'ccli', $this->input->post('ccli'));
    $this->song->update_individual($id, 'standard_key', $this->input->post('standard_key'));
    /* redirect(build_uri(array('id' => $id), '/music/codemirror')); */
    redirect('music/codemirror/' . $id);

  }

  public function file_read() {
    $myFile = "./upload/test.txt";
    $fh = fopen($myFile, 'r');
    $theData = fgets($fh);
    fclose($fh);
    echo $theData;
  }

  public function add_song() {
    $myFile = "./upload/test.txt";
    exec('./python/get_title.py ' . $myFile, $title);
    exec('./python/get_author.py ' . $myFile, $author);
    exec('./python/get_producer.py ' . $myFile, $producer);
    exec('./python/get_date.py ' . $myFile, $date);
    exec('./python/get_ccli.py ' . $myFile, $ccli);
    exec('./python/get_text.py ' . $myFile, $text);
    echo $title[0];
    echo $author[0];
    echo $producer[0];
    echo $date[0];
    echo $ccli[0];
    foreach ($text as $line) {
      echo $line;
      echo '<br>';
    }
    /* $this->song->insert_song($title[0], $author[0], $producer[0], $date[0], $ccli[0], $text); */
    echo 'success';
    /* redirect('music'); */
  }

  public function test() {
    $id = 1;
    $myFile = "./upload/test.txt";
    echo build_uri(array('id' => 1), '/music/codemirror');
    echo '<br>';
    echo base_url();
    echo '<br>';
    echo site_url();
    echo '<br>';
    /* echo exec("which python"); */
    exec('./python/get_title.py ' . $myFile, $title);
    exec('./python/get_author.py ' . $myFile, $author);
    exec('./python/get_producer.py ' . $myFile, $producer);
    exec('./python/get_date.py ' . $myFile, $date);
    exec('./python/get_ccli.py ' . $myFile, $ccli);
    exec('./python/get_text.py ' . $myFile, $text);
    echo $title[0];
    echo $author[0];
    echo $producer[0];
    echo $date[0];
    echo $ccli[0];
    foreach ($text as $line) {
      echo $line;
    }
  }
}
