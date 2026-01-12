<?php

class Cv extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cv_model');
    }

    public function index()
    {
        $this->load->view('cv_form');
    }

    public function dashboard()
    {
        $this->auth_check();
        $uid = $this->session->userdata('user_id');

        $data['cv'] = $this->db
            ->where('user_id', $uid)
            ->get('profile')->result();

        $this->load->view('dashboard', $data);
    }

    public function edit($id)
    {
        $this->auth_check();

        $data['profile'] = $this->db->get_where('profile', [
            'id' => $id,
            'user_id' => $this->session->userdata('user_id')
        ])->row();

        $data['edu'] = $this->Cv_model->get_education($id);
        $data['exp'] = $this->Cv_model->get_experience($id);
        $data['skills'] = $this->Cv_model->get_skills($id);

        $this->load->view('cv_edit', $data);
    }


    private function auth_check()
    {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
    }

    public function save_profile()
    {

        $photo = '';

        if (!empty($_FILES['photo']['name'])) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('photo')) {
                $photo = $this->upload->data('file_name');
            }
        }

        $data = [
            'user_id' => $this->session->userdata('user_id'),
            'full_name' => $this->input->post('full_name'),
            'job_title' => $this->input->post('job_title'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'about' => $this->input->post('about'),
            'template' => $this->input->post('template'),
            'share_token' => bin2hex(random_bytes(16)),
            'photo' => $photo

        ];

        $this->db->insert('profile', $data);
        redirect('template');
    }


    public function education()
    {
        $data['edu'] = $this->Cv_model->get_education();
        $this->load->view('education_list', $data);
    }

    public function add_education()
    {
        $cv = $this->input->get('cv');

        if ($_POST) {
            $data = [
                'profile_id' => $cv,
                'school' => $this->input->post('school'),
                'major' => $this->input->post('major'),
                'year' => $this->input->post('year')
            ];
            $this->Cv_model->insert_education($data);
            redirect('cv/edit/' . $cv);
        }

        $data['cv'] = $cv;
        $this->load->view('education_form', $data);
    }

    public function delete_education($id)
    {
        $cv = $this->input->get('cv');
        $this->db->delete('education', ['id' => $id]);
        redirect('cv/edit/' . $cv);
    }

    public function edit_education($id)
    {
        if ($_POST) {
            $data = [
                'school' => $this->input->post('school'),
                'major' => $this->input->post('major'),
                'year' => $this->input->post('year'),
            ];
            $this->Cv_model->update_education($id, $data);
            redirect('education');
        }
        $data['row'] = $this->Cv_model->get_education_by_id($id);
        $this->load->view('education_form', $data);
    }

    public function templates()
    {
        $this->load->view('template_select');
    }

    public function preview($id)
    {

        $profile = $this->Cv_model->get_profile($id);
        if (!$profile) show_404();

        $data['profile'] = $profile;
        $data['edu'] = $this->Cv_model->get_education($id);
        $data['exp'] = $this->Cv_model->get_experience($id);
        $data['skills'] = $this->Cv_model->get_skills($id);

        $template = $profile->template ?? 'simple';

        $this->load->view('templates/' . $template, $data);
    }



    public function pdf($template = 'simple')
    {
        $this->auth_check();

        $id = $this->input->get('id');

        $data['profile'] = $this->db->get_where('profile', [
            'id' => $id,
            'user_id' => $this->session->userdata('user_id')
        ])->row();

        $profile = $this->Cv_model->get_profile($id);

        $data['profile'] = $profile;
        $data['edu'] = $this->Cv_model->get_education($profile->id);
        $data['exp'] = $this->Cv_model->get_experience($profile->id);
        $data['skills'] = $this->Cv_model->get_skills($profile->id);

        $template = $data['profile']->template ?? 'simple';

        $html = $this->load->view('templates/' . $template, $data, true);

        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->loadHtml($html);
        $this->pdf->render();

        $filename = 'CV-' . $data['profile']->full_name . '.pdf';
        $this->pdf->stream($filename, ['Attachment' => 1]);
    }

    public function duplicate($id)
    {
        $this->auth_check();

        // Ambil CV lama
        $old = $this->db->get_where('profile', [
            'id' => $id,
            'user_id' => $this->session->userdata('user_id')
        ])->row();

        if (!$old) show_404();

        // Copy profile (tanpa id)
        $newProfile = [
            'user_id'   => $old->user_id,
            'full_name' => $old->full_name . ' (Copy)',
            'job_title' => $old->job_title,
            'email'     => $old->email,
            'phone'     => $old->phone,
            'address'   => $old->address,
            'about'     => $old->about,
            'photo'     => $old->photo,
            'template'  => $old->template
        ];

        $this->db->insert('profile', $newProfile);
        $new_id = $this->db->insert_id();

        // Copy education
        $edu = $this->db->get_where('education', ['profile_id' => $id])->result();
        foreach ($edu as $e) {
            $this->db->insert('education', [
                'profile_id' => $new_id,
                'school' => $e->school,
                'major' => $e->major,
                'year' => $e->year
            ]);
        }

        // Copy experience
        $exp = $this->db->get_where('experience', ['profile_id' => $id])->result();
        foreach ($exp as $x) {
            $this->db->insert('experience', [
                'profile_id' => $new_id,
                'company' => $x->company,
                'position' => $x->position,
                'year' => $x->year,
                'description' => $x->description
            ]);
        }

        // Copy skills
        $skills = $this->db->get_where('skills', ['profile_id' => $id])->result();
        foreach ($skills as $s) {
            $this->db->insert('skills', [
                'profile_id' => $new_id,
                'skill_name' => $s->skill_name,
                'level' => $s->level
            ]);
        }

        redirect('cv/edit/' . $new_id);
    }

    public function public_view($token)
    {

        $profile = $this->db->get_where('profile', [
            'share_token' => $token
        ])->row();

        if (!$profile) show_404();

        $data['profile'] = $profile;
        $data['edu'] = $this->Cv_model->get_education($profile->id);
        $data['exp'] = $this->Cv_model->get_experience($profile->id);
        $data['skills'] = $this->Cv_model->get_skills($profile->id);

        $template = $profile->template ?? 'simple';

        $this->load->view('templates/' . $template, $data);
    }

    public function regenerate_link($id)
    {
        $token = bin2hex(random_bytes(16));
        $this->db->update('profile', ['share_token' => $token], ['id' => $id]);
        redirect('dashboard');
    }
}
