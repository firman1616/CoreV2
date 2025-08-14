<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        // $this->load->library('Pdf');
        // $this->load->model('M_dashboard', 'dash');
    }
	
	public function index()
	{
		$data = [
			'title' => 'Dashboard',
			'conten' => 'conten/dashboard',
			// 'footer_js' => array('assets/js/dashboard.js')
		];
		// echo "dashboard";
		$this->load->view('template/conten',$data);
	}
}
