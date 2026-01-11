<?php

class Cv_model extends CI_Model
{

    public function save_profile()
    {
        $data = [
            'full_name' => $this->input->post('full_name'),
            'job_title' => $this->input->post('job_title'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'about' => $this->input->post('about'),
        ];
        $this->db->insert('profile', $data);
    }

    public function get_profile()
    {
        return $this->db->get('profile')->row();
    }

    public function get_education()
    {
        return $this->db->get('education')->result();
    }

    public function get_experience()
    {
        return $this->db->get('experience')->result();
    }

    public function get_skills()
    {
        return $this->db->get('skills')->result();
    }
}
