<?php

class Auth extends CI_Controller
{

    public function login()
    {
        if ($_POST) {
            $email = $this->input->post('email');
            $pass = md5($this->input->post('password'));

            $user = $this->db->get_where('users', [
                'email' => $email,
                'password' => $pass
            ])->row();

            if ($user) {
                $this->session->set_userdata('user_id', $user->id);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('err', 'Login gagal');
            }
        }
        $this->load->view('auth/login');
    }

    public function register()
    {
        if ($_POST) {
            $this->db->insert('users', [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password'))
            ]);
            redirect('login');
        }
        $this->load->view('auth/register');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
