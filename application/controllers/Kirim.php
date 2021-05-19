<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kirim extends CI_Controller
{
    public function index()
    {
        if (!$this->session->userdata('isLogin') || $this->session->userdata('hak_akses') !== 'user') {
            redirect(base_url());
        }
        $username = $this->session->userdata('username');
        $data = [
            'title'    => 'Kirim',
            'kirim' => $this->m_transaksi->getByUserSurat($username)
        ];
        $this->template->load('admin/template', 'admin/kirim/index', $data);
    }

        public function __construct()
        {
            parent::__construct();
            $this->load->model('M_transaksi', 'm_transaksi');
        }
    
        public function getdata($id)
        {
            $data = $this->m_transaksi->getByIdSurat($id);
            echo json_encode($data);
        }
    
        public function verif()
        {
            if (!$this->session->userdata('isLogin') || $this->session->userdata('hak_akses') != 'superuser') {
                redirect(base_url());
            }
    
            $data['title']  = 'Verifikasi';
            $data['verifikasi'] = $this->m_transaksi->getVerifikasi();
            $this->template->load('admin/template', 'admin/verif/index', $data);
        }
    
        public function verifikasi($id)
        {
            if (!$this->session->userdata('isLogin') || $this->session->userdata('hak_akses') != 'superuser') {
                redirect(base_url());
            }
            $this->load->library('form_validation');
            $this->form_validation->set_rules('keterangan', 'keterangan', 'required');
            if ($this->form_validation->run() == FALSE)
                    { $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Keterangan Verifikasi tidak dipilih, silahkan coba lagi!</div>');
                    redirect('kirim/verif');
            } else {
            $data = [
                'keterangan' => $this->input->post('keterangan'),
                'diverifikasi' => $this->input->post('diverifikasi'),
                'note' => $this->input->post('note')
            ];
    
            if($this->db->update('surat', $data, ['id'=>$id])){
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Surat Berhasil diproses</div>');
                redirect('/kirim/verif');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf, Gagal silahkan coba lagi!</div>');
                redirect('/kirim/verif');
            }
            }
        }
    
        public function kirimsurat()
        {
            if (!$this->session->userdata('isLogin')) {
                redirect(base_url());
            }
    
            $username = $this->session->userdata('username');
            $nama_pengirim = $this->session->userdata('nama_lengkap');
    
            $data = [
                'judul_surat'=>$this->input->post('judul_surat'),
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
        
    public function update($id)
    {
        if(isset($_POST['submit'])){    
            $data= [
                'no_surat' => $this->input->post('no_surat'),
                'judul_surat' => $this->input->post('judul_surat'),
                'nama_penerima' => $this->input->post('nama_penerima'),
            ];
            
            $config['upload_path']          = 'assets/surat/';
            $config['allowed_types']        = 'docx|pdf|ppt|jpg';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')){
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"Maaf, gagal kirim surat: '.$this->upload->display_errors().'!</div>');
                redirect('kirim');
            } else {
            $data['file'] = $this->upload->data('file_name'); 
            if($this->db->update('surat', $data, ['id'=>$id])){
                
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Ubah Data!</div>');
                redirect('kirim');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Ubah Data!</div>');
                redirect('kirim');
            }
            }
        }else{
            redirect('kirim');
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
    