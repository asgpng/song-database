<?php

class Sets extends CI_Controller {

  public function __construct() {
    parent::__construct();
    is_logged_in();
    $this->load->model('set');
    $this->load->model('song');
    $this->load->model('set_songs');
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
    redirect('sets/choose_songs/'.$set_id);
  }

  public function remove_from_set($song_id, $set_id, $song_num) {
    $this->set_songs->remove_from_set($set_id, $song_num);
    /* echo 'success'; */
    redirect('sets/choose_songs/'.$set_id);
  }

  public function switch_songs($song_num, $direction, $set_id) {
    $song_count = $this->set->current_song_count($set_id);
    if ($direction == 'up') {
      if ($song_num != 1) {
        $this->set_songs->switch_songs($set_id, $song_num, $song_num-1);
      }
    }
    else {
      if ($song_num != $song_count) {
        $this->set_songs->switch_songs($set_id, $song_num, $song_num+1);
      }
    }
    redirect('sets/choose_songs/'.$set_id);
  }

  public function choose_songs($set_id) {
    $set = $this->set->get_set($set_id);
    $data['title'] = 'New Set';
    $data['set'] = $set;
    $data['songs'] = $this->song->get_songs();
    $data['current_songs'] = $this->set->get_current_songs($set_id);
    $this->load->view('templates/header', $data);
    $this->load->view('sets/choose_songs', $data);
    $this->load->view('templates/footer', $data);
  }

  public function test() {
    $set_id = 1;
    $format = 'sets.id = %d';
    echo sprintf($format, $set_id);
  }
}