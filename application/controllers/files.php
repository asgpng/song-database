<?php

class Files extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //function inside autoloaded helper, check if user is logged in, if not redirects to login page
    is_logged_in();
    $this->load->helper(array('form', 'url', 'file'));
  }

  public function upload() {
    $data['title'] = 'Upload';
    $data['error'] = ' ';
    $this->load->view('templates/header', $data);
    $this->load->view('files/upload', $data);
    $this->load->view('templates/footer', $data);
  }

  function do_upload()
  {
    $config['upload_path'] = './upload/';
    $config['allowed_types'] = 'gif|jpg|png|txt';
    $config['max_size']= '100';
    $config['max_width']  = '1024';
    $config['max_height']  = '768';
    $data['title'] = 'Upload';

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload())
      {
        $error = array('error' => $this->upload->display_errors());
        $this->load->view('templates/header', $data);
        $this->load->view('files/upload', $error);
        $this->load->view('templates/footer', $data);
      }
    else
      {
        $data = array('upload_data' => $this->upload->data());
        redirect('music/add_song/'.$this->upload->data()['file_name']);
        /* $this->load->view('templates/header', $data); */
        /* $this->load->view('files/upload_success', $data); */
        /* $this->load->view('templates/footer', $data); */
      }
  }

  public function view_files() {

    /* $this->twiggy->title('View Files')->display('files/view/list'); */
    $data['title'] = 'View Files';
    $data['files'] = get_filenames('./upload');
    $this->load->view('templates/header', $data);
    $this->load->view('files/view/list', $data);
    $this->load->view('templates/footer', $data);
  }

  public function view($file) {
    $data['file'] = read_file('./upload/' . $file);
    $this->load->view('templates/header', $data);
    $this->load->view('files/view/single', $data);
    $this->load->view('templates/footer', $data);
  }

  public function test() {
    echo base_url('upload');
  }
}
