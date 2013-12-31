<?php

class Music extends CI_Controller {

  public function __construct() {
    parent::__construct();
    is_logged_in();
    $this->load->model('song');
    $this->load->model('set_songs');
    $this->load->model('song_tag');
  }

  // View list of songs
  public function index() {
    $order_by = $this->input->get('order_by');
    $data['title'] = 'View Songs';
    $data['search_action'] = site_url('/music?search=1');
    if ($order_by != '') {
      $data['query'] = $this->song->get_songs($order_by);
    }
    else {
      $search = $this->input->get('search');
      if ($search == 1) {
        $data['query'] = $this->song->get_songs_search($this->input->post('search_query'));
      }
      else {
        $data['query'] = $this->song->get_songs();
      }
    }
    $data['number_songs'] = $this->song->get_number_songs();
    $this->load->view('templates/header', $data);
    $this->load->view('songs/index', $data);
    $this->load->view('templates/footer', $data);
  }

  // open page to edit metadata and text and add tags
  public function edit_song($song_id) {
    if (!$this->song->song_exist_id($song_id)) {
      redirect ('music/invalid_song');
    }
    $data['content'] = $this->song->get_text($song_id);
    $data['header'] = $this->song->get_header($song_id);
    $data['song'] = $this->song->get_song($song_id);
    $data['title'] = $data['song']->title;

    if ($this->input->post('code') != '') {
      $code = trim($this->input->post('code'), "\xef\xbb\xbf\t\n\0\x0B ");
      $code = trim($this->input->post('code'));
      $data['content'] = $code;
      $this->song->update_individual($song_id, 'text', safe($code), false);
    }
    $this->load->view('templates/header', $data);
    $this->load->view('songs/cm_editor', $data);
    $this->load->view('templates/footer', $data);
  }

  // Redirect here if user tries to access a song not in the database
  // (This would happen if they use a url with a song_id that doesn't exist)
  public function invalid_song() {
    $data['title'] = 'Invalid Song';
    $this->load->view('templates/header', $data);
    $this->load->view('songs/invalid', $data);
    $this->load->view('templates/footer', $data);
  }

  // transpose a song, write changes to database, and reflect using ajax
  public function transpose() {
    $song_id = $this->input->post('song_id');
    $steps = $this->input->post('steps');
    $my_file = './tmp/tmp.txt';
    $this->load->helper('file');
    $song = $this->song->get_song($song_id);
    write_file($my_file, $song->text);
    exec('./python/transpose.py ' . $my_file . ' ' . $steps, $text);
    write_file($my_file, implode(PHP_EOL,$text));
    $new_text = read_file($my_file);
    $this->song->update_individual($song_id, 'text', $new_text);
    /* delete_files('./tmp/'); */
    redirect('music/ajax_editor_view/'.$song_id);
  }

  // redirect to editor view
  public function update_code() {
    $code = trim($this->input->post('code'));
    $song_id = $this->input->post('song_id');
    $this->song->update_individual($song_id, 'text', safe($code), false);
    redirect('music/ajax_editor_view/'.$song_id);
  }

  // print preview
  public function view_html($id) {
    $my_file = './tmp/tmp.txt';
    $this->load->helper('file');
    $song = $this->song->get_song($id);
    write_file($my_file, $song->text);
    exec('./python/get_html.py ' . $my_file, $html);
    /* $this->song->update_individual($id, 'html', implode($html)); */
    foreach ($html as $line) {
      echo $line;
    }
    delete_files('./tmp/');
  }

  public function update_metadata() {
    $song_id = $this->input->post('song_id');
    $this->song->update_individual($song_id, 'title',
                                   $this->input->post('title'));
    $this->song->update_individual($song_id, 'author',
                                   $this->input->post('author'));
    $this->song->update_individual($song_id, 'producer',
                                   $this->input->post('producer'));
    $this->song->update_individual($song_id, 'year',
                                   $this->input->post('year'));
    $this->song->update_individual($song_id, 'ccli',
                                   $this->input->post('ccli'));
    $this->song->update_individual($song_id, 'standard_key',
                                   $this->input->post('standard_key'));
    redirect('music/ajax_header_view/' . $song_id);
  }

  public function update_tags() {
    $song_id = $this->input->post('song_id');
    $this->song_tag->insert_entry_by_tag_string($song_id,
                                                $this->input->post('tag'));
    redirect('music/ajax_tag_view/' . $song_id);
  }

  public function ajax_header_view($song_id) {
    $data['header'] = $this->song->get_header($song_id);
    $this->load->view('songs/ajax/song_data_header.php', $data);
  }

  public function ajax_tag_view($song_id) {
    $data['song'] = $this->song->get_song($song_id);
    $this->load->view('songs/ajax/tag.php', $data);
  }

  public function ajax_text_view($song_id) {
    $data['content'] = $this->song->get_text($song_id);
    $this->load->view('songs/ajax/text', $data);
  }

  public function ajax_editor_view($song_id) {
    $data['content'] = $this->song->get_text($song_id);
    $data['song'] = $this->song->get_song($song_id);
    $this->load->view('songs/editor_view', $data);
  }

  public function file_read() {
    $myFile = "./upload/test.txt";
    $fh = fopen($myFile, 'r');
    $theData = fgets($fh);
    fclose($fh);
    echo $theData;
  }

  public function insert_song() {
    $title = $this->input->post('title');
    $author = $this->input->post('author');
    $producer = $this->input->post('producer');
    $year = $this->input->post('year');
    $ccli = $this->input->post('ccli');
    $standard_key = $this->input->post('standard_key');
    $text = '';
    $this->song->insert_song($title, $author, $producer, $year, $ccli, $text, $standard_key);
    /* redirect('music', 'refresh'); */
    $id = $this->song->get_id($title, $author);
    redirect('music/edit_song/'.$id);
  }

  public function delete_songs() {
    $order_by = $this->input->get('order_by');
    $data['title'] = 'Delete Songs';
    if ($order_by != '') {
      $data['query'] = $this->song->get_songs($order_by);
    }
    else {
      $data['query'] = $this->song->get_songs();
    }
    $this->load->view('templates/header', $data);
    $this->load->view('songs/delete', $data);
    $this->load->view('templates/footer', $data);
  }

  public function delete($song_id) {
    $this->song->delete_song($song_id);
    redirect('music/delete_songs');
  }

  public function add_song($myFile) {
    $this->load->helper('file');
    $myFile = './upload/' . $myFile;
    exec('./python/get_title.py ' . $myFile, $title);
    exec('./python/get_author.py ' . $myFile, $author);
    exec('./python/get_producer.py ' . $myFile, $producer);
    exec('./python/get_date.py ' . $myFile, $date);
    exec('./python/get_ccli.py ' . $myFile, $ccli);
    /* exec('./python/get_text.py ' . $myFile, $text); */
    $text = read_file($myFile);
    echo $title[0];
    echo $author[0];
    echo $producer[0];
    echo $date[0];
    echo $ccli[0];
    if (!$this->song->song_exists(safe($title[0]), safe($author[0]))) {
      $this->song->insert_song($title[0], $author[0], $producer[0], $date[0], $ccli[0], $text, '');
    }
    redirect('music');
    /* die(); */
  }

  public function add_songs() {
    $this->load->helper('file');
    $file_names = get_filenames('./upload/');
    foreach ($file_names as $myFile) {
      $myFile = './upload/' . $myFile;
      /* echo $myFile; */
      /* echo '<br>'; */
      exec('./python/get_title.sh ' . $myFile, $title);
      /* exec('./python/get_author.py ' . $myFile, $author); */
      /* exec('./python/get_producer.py ' . $myFile, $producer); */
      /* exec('./python/get_date.py ' . $myFile, $date); */
      /* exec('./python/get_ccli.py ' . $myFile, $ccli); */
      /* /\* /\\* exec('./python/get_text.py ' . $myFile, $text); *\\/ *\/ */
      /* $text = read_file($myFile); */
      echo $title[0];
      /* echo $author[0]; */
      /* echo $producer[0]; */
      /* echo $date[0]; */
      /* echo $ccli[0]; */
      /* if (!$this->song->song_exists($title[0], $author[0])) { */
      /*   $this->song->insert_song($title[0], $author[0], $producer[0], $date[0], $ccli[0], $text, ''); */
      /* } */
    }
  }

  public function test() {
    $id = 1;
    $myFile = "./upload/test.txt";
    echo build_uri(array('id' => 1), '/music/edit_song');
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
