<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_transaksi', 'm_transaksi');
    }
    public function index()
    {
        if (!$this->session->userdata('isLogin') && $this->session->userdata('hak_akses') != 'admin') {
            redirect(base_url());
        }
        $username = $this->session->userdata('username');
        if ($this->session->userdata('hak_akses') == 'admin' || $this->session->userdata('hak_akses') == 'superuser'){
            $tolak = $this->db->get_where('surat', ['keterangan'=>"tolak"])->num_rows();
            $verif = $this->db->get_where('surat', ['keterangan'=>"verif"])->num_rows();
        }else{
            $tolak = $this->db->get_where('surat', ['keterangan'=>"tolak", 'username'=>$username])->num_rows();
            $verif = $this->db->get_where('surat', ['keterangan'=>"verif", 'username'=>$username])->num_rows();
        }
        $data = [
            'title'     => 'Dashboard',
            'instansi' => $this->session->userdata('status'),
            'transaksi' => $this->m_transaksi->getData(),
            'jml_surat' => $this->db->get_where('surat', ['username'=>$username])->num_rows(),
            'tolak' => $tolak,
            'verif' => $verif,
            'masuk' => $this->db->get_where('surat', ['keterangan'=>null])->num_rows(),
            'jumlah' => $this->db->get('admin')->num_rows()
        ];
        // var_dump($data); die;
        $this->template->load('admin/template', 'admin/home', $data);
    }

    public function list()
    {   
        $data['title'] = 'Kelola Pengguna';
        $data['admin'] = $this->db->order_by('id', 'desc')->get('admin')->result_array();
        $this->template->load('admin/template', 'admin/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('konfir_pass', 'Konfirmasi Password', 'required|matches[password]');
        if ($this->form_validation->run() == FALSE)
                { $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Tidak Benar!</div>');
                redirect('admin/list');
        } else {
        if(isset($_POST['submit'])){
            $data= [
                'username' => $this->input->post('username'),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'instansi' => $this->input->post('instansi'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'status' => $this->input->post('status'),
            ];
            $username = $this->input->post('username');
            $sql = $this->db->query("SELECT username FROM admin where username='$username'");
            $cekdata = $sql->num_rows();
            if ($cekdata > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username Telah Digunakan!</div>');
                redirect(site_url('admin/list'));
            }else{
            if($this->db->insert('admin', $data)){
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Tambah Data!</div>');
                redirect('admin/list');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Tambah Data!</div>');
                redirect('admin/list');
            }
         }
        }else{  
            redirect('admin/list');
        }
        }
    }

    public function update($id)
    {
        if(isset($_POST['submit'])){    
            $data= [
                'username' => $this->input->post('username'),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'instansi' => $this->input->post('instansi'),
                'status' => $this->input->post('status'),
            ];
            if( $this->input->post('password') !== '' ){
                $this->load->library('form_validation');
                $this->form_validation->set_rules('password', 'Password', 'required');
                $this->form_validation->set_rules('konfir_pass', 'Konfirmasi Password', 'required|matches[password]');
                if ($this->form_validation->run() == FALSE)
                        { $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password yang dimasukan Tidak Sama! Silahkan coba lagi!</div>');
                        redirect('admin/list');
                } else {
                $data['password'] =  password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                }
            }
            if($this->db->update('admin', $data, ['id'=>$id])){
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Ubah Data!</div>');
                redirect('admin/list');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Ubah Data!</div>');
                redirect('admin/list');
            }
        }else{
            redirect('admin/list');
        }
    }

    public function delete($id='')
    {
        if($id !==''){
            if($this->db->delete('admin', ['id'=>$id])){
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Hapus Data!</div>');
                redirect('admin/list');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Hapus Data!</div>');
                redirect('admin/list');
            }
        }else{
            redirect('admin/list');
        }
    }

    public function getdata($id)
    {
        $data = $this->db->get_where('admin', ['id'=>$id])->row_array();
        echo json_encode($data);
    }
}
