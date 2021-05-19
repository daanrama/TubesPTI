<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
        {
    parent::__construct();
    $this->load->model('M_transaksi', 'm_transaksi');
    }
    
    public function index()
    {
        isLogin();
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Login'
            ];
            $this->template->load('auth/template', 'auth/login', $data);
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->db->get_where('admin', ['username' => $username])->row_array();
            if ($user) {
            if($user['status']=='1'){ $hak_akses = 'superuser';
            }else if($user['status']=='0'){ $hak_akses = 'admin';
            }else{ $hak_akses = 'user';
            }
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'isLogin'   => true,
                        'username'  => $user['username'],
                        'nama_lengkap'      => $user['nama_lengkap'],
                        'instansi'      => $user['instansi'],
                        'hak_akses' => $hak_akses,
                    ];
                    $this->session->set_userdata($data);
                    redirect('/admin');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username belum terdaftar!</div>');
                redirect('auth');
            }
        }
    }
    public function ubahpassword()
    {   $id = $this->session->userdata('username');
        $data = [
            'title'    => 'Ubah Password',
            'admin' => $this->m_transaksi->getByUserPass($id)
        ];
        $this->template->load('admin/template', 'admin/ubahpassword/index', $data);
    }
    
    public function ubah($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('konfir_pass', 'Konfirmasi Password', 'required|matches[password]');
        if ($this->form_validation->run() == FALSE)
                { $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password yang dimasukan Tidak Sama! Silahkan coba lagi</div>');
                redirect('auth/ubahpassword');
        } else {
        if(isset($_POST['submit'])){    
            $data= [
                'username' => $this->input->post('username'),
            ];
            if( $this->input->post('password') !== '' ){
                $data['password'] =  password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }
            if($this->db->update('admin', $data, ['id'=>$id])){
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Berhasil diubah!</div>');
                redirect('auth/ubahpassword');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Gagal diubah! silahkan coba lagi</div>');
                redirect('auth/ubahpassword');
            }
        }else{
            redirect('admin/list');
        }
        }
    }
    

    public function logout()
    {
        $this->session->unset_userdata('nama_lengkap');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('isLogin');
        session_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
        redirect('/');
    }
    
        public function getdata($id)
    {
        $data = $this->db->get_where('admin', ['id'=>$id])->row_array();
        echo json_encode($data);
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
