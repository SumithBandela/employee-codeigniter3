<?php 


class Auth extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function login()
    {
        $this->load->view('login');
    }

    public function login_action()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $result = $this->User_model->login($username,$password);
        if($result['status']){
            $this->session->set_userdata('user', $result['user']);
            redirect('auth/dashboard');
        }else
        {
            $this->session->set_flashdata('error',$result['message']);
            redirect('auth/login');
        }
    }
    
    public function register()
    {
        $this->load->view('register');
    }
    
    public function register_action()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $result = $this->User_model->register($username,$password);
        if($result['status']){
            $this->session->set_flashdata('success','registration successful');
            redirect('auth/login');
        }else{
            $this->session->set_flashdata('error',$result['message']);
            redirect('auth/register');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user');
        $this->session->sess_destroy();
        redirect('auth/login');
    }

    public function dashboard()
    {
      
        $this->load->view('dashboard');
    }
}