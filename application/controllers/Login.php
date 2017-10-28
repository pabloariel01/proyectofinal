<?php

class Login extends CI_Controller {

    function index() {
      if( $this->session->userdata('isLoggedIn') ) {
          redirect('vistas/');
      } else {
          $this->show_login(false);
      }
     }

    function login_user() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Usuario');
        $this->load->helper('security');
        $this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
// ///////////////////////////

        if ($this->form_validation->run() == FALSE) {

          $this->show_login(true);
        // print('falla');
        } else {

        // print_r('anda');
/////////////////////////////////////

        // Grab the email and password from the form POST
          $user = $this->input->post('usuario');
          $pass  = $this->input->post('password');
          //este para testing
          // print_r($user);
          //Ensure values exist for email and pass, and validate the user's credentials
          if( $user && $pass && $this->Usuario->validate_user($user,$pass)) {
              // If the user is valid, redirect to the main view
              redirect('vistas');
            } else {
            // Otherwise show the login screen with an error message.
            $this->show_login(true);
            }
      }
}




    function show_login( $show_error = false ) {

        $this->load->helper('form');

        $data['error'] = $show_error;


        $this->load->view('login',$data);
    }

    function logout_user() {
      $this->session->sess_destroy();
      // $this->index();
      redirect('/');
    }

    // function showphpinfo() {
    //     echo phpinfo();
    // }


}
