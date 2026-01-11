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
            'photo' => $photo
        ];

        $this->db->insert('profile', $data);
        redirect('template');
    }


    public function preview()
    {
        $data['profile'] = $this->Cv_model->get_profile();
        $data['edu'] = $this->Cv_model->get_education();
        $data['exp'] = $this->Cv_model->get_experience();
        $data['skills'] = $this->Cv_model->get_skills();
        $this->load->view('cv_preview', $data);
    }

    public function pdf()
    {
        $this->load->library('dompdf_gen');

        $data['profile'] = $this->Cv_model->get_profile();
        $this->load->view('cv_preview', $data);

        $html = $this->output->get_output();
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("cv.pdf");
    }

    public function education()
    {
        $data['edu'] = $this->Cv_model->get_education();
        $this->load->view('education_list', $data);
    }

    public function add_education()
    {
        if ($_POST) {
            $data = [
                'school' => $this->input->post('school'),
                'major' => $this->input->post('major'),
                'year' => $this->input->post('year'),
            ];
            $this->Cv_model->insert_education($data);
            redirect('education');
        }
        $this->load->view('education_form');
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

    public function delete_education($id)
    {
        $this->Cv_model->delete_education($id);
        redirect('education');
    }

    public function templates()
    {
        $this->load->view('template_select');
    }

    // public function preview($template = 'simple')
    // {
    //     $data['profile'] = $this->Cv_model->get_profile();
    //     $data['edu'] = $this->Cv_model->get_education();
    //     $data['exp'] = $this->Cv_model->get_experience();
    //     $data['skills'] = $this->Cv_model->get_skills();

    //     $this->load->view('templates/' . $template, $data);
    // }

    public function preview($template='simple'){
        $id = $this->input->get('id');

        $data['profile'] = $this->db->get_where('profile',[
            'id'=>$id,
            'user_id'=>$this->session->userdata('user_id')
        ])->row();

        $data['edu'] = $this->Cv_model->get_education();
        ...
        $this->load->view('templates/'.$template,$data);
    }

}
