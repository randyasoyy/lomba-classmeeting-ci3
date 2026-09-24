<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_lomba()
    {
        return $this->db->get('lomba')->result_array();
    }

    public function insert_pendaftaran($data)
    {
        return $this->db->insert('pendaftaran', $data);
    }

    public function get_all_pendaftaran()
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get('pendaftaran')->result_array();
    }

    public function update_pendaftar($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('pendaftaran', $data);
    }

    public function delete_pendaftar($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('pendaftaran');
    }

    public function get_pendaftar_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('pendaftaran')->row_array();
    }

    public function get_lomba_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('lomba')->row_array();
    }

    public function update_lomba_pendaftar($id, $nama_lomba)
    {
        $this->db->where('id', $id);
        return $this->db->update('pendaftaran', array('lomba' => $nama_lomba));
    }
    public function insert_lomba($nama_lomba)
    {
        return $this->db->insert('lomba', array('nama_lomba' => $nama_lomba));
    }

    public function cek_lomba($nama_lomba)
    {
        $this->db->where('nama_lomba', $nama_lomba);
        return $this->db->get('lomba')->row_array();
    }
}
