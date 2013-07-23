<?php

class Sets extends CI_Controller {

  public function __construct() {
    parent::__construct();
    is_logged_in();
    $this->load->model('set');
    $this->load->model('song');
  }

  public function index() {
    /* $this->load->library('form_validation'); */
    $data['title'] = 'Sets';
    $data['query'] = $this->set->get_sets();
    $this->load->view('templates/header', $data);
    $this->load->view('sets/index', $data);
    $this->load->view('templates/footer', $data);
  }

  public function new_set() {
    $date = $this->input->post('date');
    $event = $this->input->post('event');
    $theme = $this->input->post('theme');
    $this->set->insert_set($date, $event, $theme);
    $id = $this->set->get_id($date, $event, $theme);
    redirect('sets/choose_songs/'.$id);
  }

  public function update_set() {
    $date = $this->input->post('date');
    $event = $this->input->post('event');
    $theme = $this->input->post('theme');
    $id = $this->input->post('id');
    $this->set->update_individual($id, 'date', $date);
    $this->set->update_individual($id, 'event', $event);
    $this->set->update_individual($id, 'theme', $theme);

    redirect('sets/choose_songs/'.$id);
  }

  public function add_to_set($song_id, $set_id) {
    $this->set->add_to_set($song_id, $set_id);
    /* echo 'test'; */
    redirect('sets/choose_songs/'.$set_id);
  }

  public function choose_songs($id) {
    $set = $this->set->get_set($id);
    $data['title'] = 'New Set';
    $data['set'] = $set;
    $data['songs'] = $this->song->get_songs();
    $data['current_songs'] = $this->set->get_current_songs($id);
    $this->load->view('templates/header', $data);
    $this->load->view('sets/choose_songs', $data);
    $this->load->view('templates/footer', $data);
  }

}