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

    public function save_profile()
    {
        $this->Cv_model->save_profile();
        redirect('/');
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

    public function preview($template = 'simple')
    {
        $data['profile'] = $this->Cv_model->get_profile();
        $data['edu'] = $this->Cv_model->get_education();
        $data['exp'] = $this->Cv_model->get_experience();
        $data['skills'] = $this->Cv_model->get_skills();

        $this->load->view('templates/' . $template, $data);
    }
}
