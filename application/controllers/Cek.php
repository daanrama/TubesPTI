<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cek extends CI_Controller
{
    public function index()
    {
        if (!$this->session->userdata('isLogin') || $this->session->userdata('hak_akses') !== 'user') {
            redirect(base_url());
        }
        $username = $this->session->userdata('username');
        $data = [
            'title'    => 'Cek',
            'kirim' => $this->m_transaksi->getByUserSurat($username)
        ];
        $this->template->load('admin/template', 'admin/cek/index', $data);
    }
        public function __construct()
        {
            parent::__construct();
            $this->load->model('M_transaksi', 'm_transaksi');
        }
    
        public function verif()
        {
            if (!$this->session->userdata('isLogin') || $this->session->userdata('hak_akses') != 'admin') {
                redirect(base_url());
            }
    
            $data['title']  = 'Verifikasi';
            $data['verifikasi'] = $this->m_transaksi->getVerifikasi();
            $this->template->load('admin/template', 'admin/kartu/verif', $data);
        }

        public function userverif()
        {
            if (!$this->session->userdata('isLogin')) {
                redirect(base_url());
            }
    
            $username = $this->session->userdata('username');
            $nama_pengirim = $this->session->userdata('nama_lengkap');
    
            $data = [
                'no_surat'=>$this->input->post('no_surat'),
                'username'=>$username,
                'nama_pengirim'=>$nama_pengirim,
                'nama_penerima'=>$this->input->post('nama_penerima'),
                'verifikasi'=>$this->input->post('verifikasi'),
            ];
    
                $config['upload_path']          = 'assets/surat/';
                $config['allowed_types']        = 'docx|pdf|ppt|jpg';
    
                $this->load->library('upload', $config);
    
                if (!$this->upload->do_upload('file')){
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"Maaf, gagal kirim surat: '.$this->upload->display_errors().'!</div>');
                    redirect('kirim');
                }
                else{
                    $data['file'] = $this->upload->data('file_name'); 
                    if($this->db->insert('surat', $data)){
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mengirim surat</div>');
                        redirect('kirim');
                    }else{
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"Maaf, Proses Gagal</div>');
                        redirect('kirim');
                    }
                }
    
        }
    
        public function hapus($id)
        {
            if (!$this->session->userdata('isLogin') || $this->session->userdata('hak_akses') != 'user') {
                redirect(base_url());
            }
            
            $trx = $this->db->get_where('surat', ['id'=>$id])->row_array();
    
            if($this->db->delete('surat', ['id'=> $id])){
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Hapus Data!</div>');
                redirect('kirim');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Gagal Hapus Data!</div>');
                redirect('kirim');
            }
        }
    }
    