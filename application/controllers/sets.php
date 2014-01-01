<?php

class Sets extends CI_Controller {

  public function __construct() {
    parent::__construct();
    is_logged_in();
    $this->load->model('set');
    $this->load->model('song');
    $this->load->model('set_songs');
    $this->load->model('song_tag');
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

    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('date', 'Date', 'required');

    $date = $this->input->post('date');
    $event = $this->input->post('event');
    $theme = $this->input->post('theme');
    $leader = $this->session->userdata('netID');
    $members = '';
    //    if ($date == '') {
    //      $this->set->insert_set(0, 0, 0, 0);
    //    }
    if ($this->form_validation->run() == FALSE)
      {
        $data['title'] = 'Sets';
        $data['query'] = $this->set->get_sets();
        $this->load->view('templates/header', $data);
        $this->load->view('sets/index', $data);
        $this->load->view('templates/footer', $data);
      }
    else
      {
        $this->set->insert_set($date, $event, $theme, $leader, $members);
        $id = $this->set->last_set();
        redirect('sets/choose_songs/'.$id);
      }
  }

  public function current_set() {
    $id = $this->set->last_date();
    redirect('sets/choose_songs/'.$id);
  }

  public function update_set() {
    $date = $this->input->post('date');
    $event = $this->input->post('event');
    $theme = $this->input->post('theme');
    $leader = $this->input->post('leader');
    $members = $this->input->post('members');
    $id = $this->input->post('id');
    $this->set->update_individual($id, 'date', $date);
    $this->set->update_individual($id, 'event', $event);
    $this->set->update_individual($id, 'theme', $theme);
    $this->set->update_individual($id, 'leader', $leader);
    $this->set->update_individual($id, 'members', $members);
    redirect('sets/choose_songs/'.$id);
  }

  public function update_order() {
    /* var_dump($_POST); */
    $set_id = $this->input->post('set_id');
    $song_count = $this->set->current_song_count($set_id);

    /* echo $song_count; */
    for ($position = 0; $position < $song_count; $position++) {
      $song_id = $this->input->post($position);
      $this->set_songs->set_position($set_id, $song_id, $position + 1);
    }
    redirect('sets/ajax_current_set/' . $set_id);
  }

  public function add_to_set() {
    $set_id  = $this->input->post('set_id');
    $song_id = $this->input->post('song_id');
    $this->set->add_to_set($song_id, $set_id);

    /* $data['set'] = $this->set->get_set($set_id);
    $data['current_songs'] = $this->set->get_current_songs($set_id);

    $this->load->view('sets/ajax_current_set', $data); */
    redirect('sets/ajax_current_set/' . $set_id);
  }

  /* a private function to display html for ajax update on current set */
  public function ajax_current_set($set_id) {
    $data['set'] = $this->set->get_set($set_id);
    $data['current_songs'] = $this->set->get_current_songs($set_id);
    $this->load->view('sets/ajax_current_set', $data);
  }


  /* public function add_to_set($song_id, $set_id) {
  $this->set->add_to_set($song_id, $set_id);
  redirect('sets/choose_songs/'.$set_id);
  } */

  /* public function remove_from_set($set_id, $position) {
  $this->set_songs->remove_from_set($set_id, $position);
  echo 'success';
  redirect('sets/choose_songs/'.$set_id);
  } */

  public function remove_from_set() {
    $set_id = $this->input->post('set_id');
    $position = $this->input->post('position');
    $this->set_songs->remove_from_set($set_id, $position);
     echo 'success';
    redirect('sets/ajax_current_set/'.$set_id);
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

    $order_by = $this->input->get('order_by');
    if ($order_by != '') {
      $data['songs'] = $this->song->get_songs($order_by);
    }
    else {
      $search = $this->input->get('search');
      if ($search == 1) {
        $data['songs'] = $this->song->get_songs_search($this->input->post('search_query'));
      }
      else {
        $data['songs'] = $this->song->get_songs();
      }
    }
    $set = $this->set->get_set($set_id);
    $data['search_action'] = site_url('/sets/choose_songs/'.$set->id.'?search=1');
    $data['title'] = 'New Set';
    $data['set'] = $set;
    $data['current_songs'] = $this->set->get_current_songs($set_id);
    $data['number_songs'] = $this->song->get_number_songs();
    $this->load->view('templates/header', $data);
    $this->load->view('sets/choose_songs', $data);
    $this->load->view('templates/footer', $data);
  }

  public function test() {
    $set_id = 1;
    $format = 'sets.id = %d';
    echo sprintf($format, $set_id);
    echo '<br>';
    echo $this->set->last_set();
    echo $this->session->userdata('netID');
  }
}
