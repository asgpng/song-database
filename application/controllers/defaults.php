<?php

class Defaults extends CI_Controller {

  /* Current implementation requires CAS.php to be in current directory */
  /* it would be nicer to use CAS as CI library, but this would require renameing */
  /* phpCAS to CAS, which might not work with the CAS server. */
  public function login() {
    $next = $_GET['next'];
    session_start();
    $this->session->set_userdata('next', $next);
    // session begin here , set next page in session
    $this->load->helper('url');
    /* $this->load->model('user'); */
    /* require('CAS.php'); */
    phpCAS::setDebug();

    // initialize phpCAS
    phpCAS::client(CAS_VERSION_2_0,'fed.princeton.edu',443,'cas');

    // no SSL validation for the CAS server
    phpCAS::setNoCasServerValidation();

    // force CAS authentication
    phpCAS::forceAuthentication();

    // at this step, the user has been authenticated by the CAS server
    // and the user's login name can be read with phpCAS::getUser().
    // logout if desired
    $netID = phpCAS::getUser();
    $current_user = $this->user->get_user($netID);
    $userdata = array('netID' => $netID, 'user_type' => $current_user->user_type, 'is_logged_in' => true);
    $this->session->set_userdata($userdata);
    if ($this->session->userdata('next') != '') {
      redirect ($this->session->userdata('next'));
    }
    else {
      redirect('/', 'refresh');
    }
  }

  /* backup login for testing */
  public function test_login() {
    $next = $this->input->get('next');
    if ($next != '') {
      $this->session->set_userdata('next', $next);
    }
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('netID', 'netID', 'trim|required|max_length[10]|xss_clean');

    if ($this->form_validation->run())
      {
        $data = array();
        $data['validation_errors'] = validation_errors();
        $netID = $this->input->post('netID');
        /* $current_user = $this->user->get_user($netID); */
        $semester = 'F13';
        /* $userdata = array('netID' => $netID, 'user_type' => $current_user->user_type, 'is_logged_in' => true); */
        $userdata = array('netID' => $netID, 'user_type' => 'default', 'is_logged_in' => true);
        $this->session->set_userdata($userdata);
        if ($this->session->userdata('next') != '') {
          $next = $this->session->userdata('next');
          $this->session->unset_userdata('next');
          redirect(site_url($next));

        }
        else {
          redirect('/', 'refresh');
        }
      }
    $data['title'] = 'Test Login';
    $this->load->view('templates/header-pre', $data);
    $this->load->view('login', $data);
    $this->load->view('templates/footer', $data);
  }

  public function view_session() {
    $this->load->helper('userdata');
    print_userdata();
  }

  public function test_logout() {
    $this->session->sess_destroy();
    $data['title'] = 'Test Logout';
    $this->load->view('templates/header-post', $data);
    $this->load->view('logout', $data);
    $this->load->view('templates/footer', $data);
  }

  public function logout() {
    $this->session->sess_destroy();
    require('CAS.php');
    phpCAS::client(CAS_VERSION_2_0,'fed.princeton.edu',443,'cas');
    phpCAS::logout();
    $data['title'] = 'Contact';
    $this->load->view('templates/header-post', $data);
    $this->load->view('logout', $data);
    $this->load->view('templates/footer', $data);
  }

  public function test() {
    echo site_url();
    echo '<br>';
    echo base_url('application/static/stylesheets/bootstrap.css');
  }
}
