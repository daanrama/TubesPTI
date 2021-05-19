<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {

	public function getdata()
	{
		$this->db->select('admin.nama_lengkap, admin.username, surat.*');
		$this->db->from('surat');
		$this->db->join('admin', 'surat.username = admin.username');
		$this->db->order_by('id', 'desc');
		return $this->db->get()->result_array();
	}

	public function getById($id)
	{
		$this->db->select('admin.nama_lengkap, admin.username, surat.*');
		$this->db->from('surat');
		$this->db->join('admin', 'surat.username = admin.username');
		$this->db->where('admin.id', $id);
		return $this->db->get()->row_array();
	}

	public function getByIdSurat($id)
	{
		$this->db->select('admin.nama_lengkap, admin.username, surat.*');
		$this->db->from('surat');
		$this->db->join('admin', 'surat.username = admin.username');
		$this->db->where('surat.id', $id);
		return $this->db->get()->row_array();
	}

	public function getByUser($id)
	{
		$this->db->select('admin.nama_lengkap, admin.username, surat.*');
		$this->db->from('surat');
		$this->db->join('admin', 'surat.username = admin.username');
		$this->db->where('surat.username', $id);
		return $this->db->get()->result_array();
	}

	public function getByUserSurat($id)
	{
		$this->db->select('admin.nama_lengkap, admin.username, surat.*');
		$this->db->from('surat');
		$this->db->join('admin', 'surat.username = admin.username');
		$this->db->where('surat.username', $id);
		return $this->db->get()->result_array();
	}
	
	public function getByUserSuratKhusus($id, $keterangan)
	{
		$this->db->select('admin.nama_lengkap, admin.username, surat.*');
		$this->db->from('surat');
		$this->db->join('admin', 'surat.username = admin.username');
		$this->db->where('surat.username', $id);
		$this->db->where('surat.keterangan', $keterangan);
		return $this->db->get()->result_array();
	}
	
		public function getByUserPass($id)
	{
		$this->db->select('admin.*');
		$this->db->from('admin');
		$this->db->where('admin.username', $id);
		return $this->db->get()->result_array();
	}
	public function getVerifikasi()
	{
		$this->db->select('admin.nama_lengkap, admin.username, surat.*');
		$this->db->from('surat');
		$this->db->join('admin', 'surat.username = admin.username');
		$this->db->where('surat.keterangan', null);
		return $this->db->get()->result_array();
	}
	
	public function getlaporan($jenis='', $tgl_awal='', $tgl_akhir='')
	{
		$this->db->select('admin.nama_lengkap, admin.username, surat.judul_surat, surat.*');
		$this->db->from('surat');
		$this->db->join('admin', 'surat.username = admin.username');
		if($jenis=='verif'){
			$this->db->where('surat.keterangan', 'verif');
		}elseif($jenis=='tolak'){
			$this->db->where('surat.keterangan', 'tolak');
		}elseif($jenis=='tunggu'){
		    $this->db->where('surat.keterangan', null);
		}elseif($jenis=='semua'){
		}
        if($jenis=='verif' || $jenis=='tolak'){
        		if($tgl_awal){
        		    $this->db->where('surat.diverifikasi >=', $tgl_awal);
        		}
        		if($tgl_akhir){
        			$this->db->where('surat.diverifikasi <=', $tgl_akhir);
        		}
        }else{
        		if($tgl_awal){
        		    $this->db->where('surat.verifikasi >=', $tgl_awal);
        		}
        		if($tgl_akhir){
        			$this->db->where('surat.verifikasi <=', $tgl_akhir);
        		}
        }

		$this->db->order_by('id', 'desc');
		return $this->db->get()->result_array();
	}
	
}