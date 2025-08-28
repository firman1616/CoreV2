<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Role',
            'conten' => 'role/index',
            'footer_js' => array('assets/js/role.js'),
            'get_akses' => $this->m_data->get_data('tbl_akses')->result()
        ];
        $this->load->view('template/conten', $data);
    }

    function tableRole()
    {
        $data['role'] = $this->m_data->get_data('tbl_role')->result();

        echo json_encode($this->load->view('role/role-table', $data, false));
    }

    function store()
    {
        $id = $this->input->post('id');
        if ($id != null) {
            $table = 'tbl_role';
            $dataupdate = [
                'nama_role' => $this->input->post('nama_role'),
            ];
            $where = array('id' => $id);
            $this->m_data->update_data($table, $dataupdate, $where);
        } else {
            $table = 'tbl_role';
            $data = [
                'nama_role' => $this->input->post('nama_role'),
            ];
            // $die(var_dump($data));
            $this->m_data->simpan_data($table, $data);
        }
    }

    function vedit($id)
    {
        $table = 'tbl_role';
        $where = array('id' => $id);
        $data = $this->m_data->get_data_by_id($table, $where)->row();
        echo json_encode($data);
    }

    public function get_akses($role_id)
    {
        $query = $this->db->get_where('tbl_role_akses', ['role_id' => $role_id]);
        $result = $query->result();

        $akses = [];

        foreach ($result as $row) {
            $akses[] = $row->akses;
        }

        echo json_encode($akses); // Contoh hasil: ["1", "2", "3"]
    }

    public function simpan_akses()
    {
        $role_id = $this->input->post('role_id');
        $akses = $this->input->post('akses'); // array

        if (!$role_id) {
            show_error('Role ID tidak ditemukan');
        }

        // Hapus akses lama
        $this->db->delete('tbl_role_akses', ['role_id' => $role_id]);

        // Simpan akses baru: satu baris per akses
        if (!empty($akses)) {
            foreach ($akses as $akses_item) {
                $this->db->insert('tbl_role_akses', [
                    'role_id' => $role_id,
                    'akses' => $akses_item
                ]);
            }
        }

        echo 'success';
    }
}
