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
}
