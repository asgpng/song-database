<?php

class Defaults extends CI_Controller {

  /* Current implementation requires CAS.php to be in current directory */
  /* it would be nicer to use CAS as CI library, but this would require renameing */
  /* phpCAS to CAS, which might not work with the CAS server. */
  public function login() {
    $this->load->library('CAS');
    $next = $this->input->get('next');
    session_start();
    $this->session->set_userdata('next', $next);
    // session begin here , set next page in session
    $this->load->helper('url');
    $this->load->model('user');
    /* require('CAS.php'); */
    CAS::setDebug();

    // initialize CAS
    CAS::client(CAS_VERSION_2_0,'fed.princeton.edu',443,'cas');

    // no SSL validation for the CAS server
    CAS::setNoCasServerValidation();

    // force CAS authentication
    CAS::forceAuthentication();

    // at this step, the user has been authenticated by the CAS server
    // and the user's login name can be read with CAS::getUser().
    // logout if desired
    $netID = CAS::getUser();
    if ($this->user->exists($netID)) {
      $current_user = $this->user->get_user($netID);
      $userdata = array('netID' => $netID, 'user_type' => $current_user->user_type, 'is_logged_in' => true);
      $this->session->set_userdata($userdata);
      if ($this->session->userdata('next') != '') {
        $next = $this->session->userdata('next');
        $this->session->unset_userdata('next');
        redirect(site_url($next));
      }
      else {
        /* redirect('/', 'refresh'); */
        redirect('/music', 'refresh');
      }
    }
    else {
      redirect('invalid_login');
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
    $this->load->model('user');
    $this->form_validation->set_rules('netID', 'netID', 'trim|required|max_length[10]|xss_clean');

    if ($this->form_validation->run())
      {
        $data = array();
        $data['validation_errors'] = validation_errors();
        $netID = $this->input->post('netID');
        if ($this->user->exists($netID)) {
          $current_user = $this->user->get_user($netID);
          $userdata = array('netID' => $netID, 'user_type' => $current_user->user_type, 'is_logged_in' => true);
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
        else {
          redirect('invalid_login');
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

  public function invalid_login() {
    $data['title'] = 'Invalid Login';
    $this->load->view('templates/header-pre', $data);
    $this->load->view('invalid_login', $data);
    $this->load->view('templates/footer', $data);
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
    $this->load->library('CAS');
    CAS::client(CAS_VERSION_2_0,'fed.princeton.edu',443,'cas');
    CAS::logout();
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
