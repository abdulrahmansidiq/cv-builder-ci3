<?php

class Cv_model extends CI_Model
{

    // public function save_profile()
    // {
    //     $data = [
    //         'full_name' => $this->input->post('full_name'),
    //         'job_title' => $this->input->post('job_title'),
    //         'email' => $this->input->post('email'),
    //         'phone' => $this->input->post('phone'),
    //         'address' => $this->input->post('address'),
    //         'about' => $this->input->post('about'),
    //     ];
    //     $this->db->insert('profile', $data);
    // }

    public function get_profile()
    {
        return $this->db->get('profile')->row();
    }

    public function get_experience($profile_id)
    {
        return $this->db->where('profile_id', $profile_id)->get('experience')->result();
    }


    public function get_skills($profile_id)
    {
        return $this->db->where('profile_id', $profile_id)->get('skills')->result();
    }


    public function get_education($profile_id)
    {
        return $this->db->where('profile_id', $profile_id)->get('education')->result();
    }

    public function insert_education($data)
    {
        $this->db->insert('education', $data);
    }


    public function get_education_by_id($id)
    {
        return $this->db->get_where('education', ['id' => $id])->row();
    }

    public function update_education($id, $data)
    {
        $this->db->where('id', $id)->update('education', $data);
    }

    public function delete_education($id)
    {
        $this->db->where('id', $id)->delete('education');
    }
}
