<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Classmeeting extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pendaftaran_model');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['lomba'] = $this->Pendaftaran_model->get_all_lomba();
        $this->load->view('form_pendaftaran', $data);
    }

    public function view()
    {
        $this->load->view('view_output');
        if ($this->input->post()) {
            $data = array(
                'nama'       => $this->input->post('nama', TRUE),
                'kelas'      => $this->input->post('kelas', TRUE),
                'no_telepon' => $this->input->post('no_telepon', TRUE),
                'lomba'      => $this->input->post('lomba', TRUE),
                'anggota'    => $this->input->post('anggota', TRUE)
            );
        }
    }

    public function proses()
    {
        $this->load->view('output_pendaftaran');
        if ($this->input->post()) {
            $data = array(
                'nama'       => $this->input->post('nama', TRUE),
                'kelas'      => $this->input->post('kelas', TRUE),
                'no_telepon' => $this->input->post('no_telepon', TRUE),
                'lomba'      => $this->input->post('lomba', TRUE),
                'anggota'    => $this->input->post('anggota', TRUE)
            );

            if ($this->Pendaftaran_model->insert_pendaftaran($data)) {
                redirect('classmeeting/output');
            } else {
                $this->session->set_flashdata('pesan', 'Gagal menyimpan data.');
                redirect('classmeeting');
            }
        } else {
            redirect('classmeeting');
        }
    }


    public function output()
    {
        $data['pendaftar'] = $this->Pendaftaran_model->get_all_pendaftaran();
        $this->load->view('output_pendaftaran', $data);
    }

    public function proses_edit()
    {
        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('kelas', 'Kelas', 'required');
            $this->form_validation->set_rules('lomba_id', 'Lomba', 'required');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'nama'     => $this->input->post('nama'),
                    'kelas'    => $this->input->post('kelas'),
                    'lomba_id' => $this->input->post('lomba_id')
                );

                $this->Pendaftaran_model->insert_pendaftar($data);
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan!');
                redirect('classmeeting/output');
            } else {
                $data['lomba'] = $this->Pendaftaran_model->get_all_lomba();
                $this->load->view('form_pendaftaran', $data);
            }
        }
    }

    public function edit($id)
    {
        $pendaftar = $this->Pendaftaran_model->get_all_pendaftaran($id);

        if (empty($pendaftar)) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan!');
            redirect('classmeeting/output');
        }

        $data['pendaftar'] = $pendaftar;
        $data['lomba'] = $this->Pendaftaran_model->get_all_lomba();
        $this->load->view('edit_lomba', $data);
    }


    public function update()
    {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('lomba_id', 'Lomba', 'required');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'lomba' => $this->input->post('lomba')
            );

            $this->Pendaftaran_model->update_pendaftar($id, $data);
            $this->session->set_flashdata('success', 'Lomba berhasil diupdate!');
            redirect('classmeeting/output');
        } else {
            $pendaftar = $this->Pendaftaran_model->get_all_pendaftaran($id);
            $data['pendaftar'] = $pendaftar;
            $data['lomba'] = $this->Pendaftaran_model->get_all_lomba();
            $this->load->view('edit_lomba', $data);
        }
    }

    public function update_pendaftar($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('pendaftaran', $data);

        echo $this->db->last_query();
        die();
    }

    public function delete($id)
    {
        $pendaftar = $this->Pendaftaran_model->get_all_pendaftaran($id);
        if (empty($pendaftar)) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan!');
            redirect('classmeeting/output');
        }

        $this->Pendaftaran_model->delete_pendaftar($id);
        $this->session->set_flashdata('success', 'Data berhasil dihapus!');
        redirect('classmeeting/output');
    }

    public function edit_lomba($id)
    {
        $pendaftar = $this->Pendaftaran_model->get_pendaftar_by_id($id);

        if (empty($pendaftar)) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan!');
            redirect('classmeeting/output');
        }

        $data['pendaftar'] = $pendaftar;
        $data['lomba'] = $this->Pendaftaran_model->get_all_lomba();
        $this->load->view('edit_lomba', $data);
    }

    public function update_lomba()
    {
        $id = $this->input->post('id');
        $nama_lomba = $this->input->post('nama_lomba');

        if (empty($id) || empty($nama_lomba)) {
            $this->session->set_flashdata('error', 'Data tidak lengkap!');
            redirect('classmeeting/output');
        }

        $this->Pendaftaran_model->update_lomba_pendaftar($id, $nama_lomba);
        $this->session->set_flashdata('success', 'Lomba berhasil diupdate!');
        redirect('classmeeting/output');
    }

    public function tambah_lomba()
    {
        $this->load->view('tambah_lomba');
    }

    public function simpan_lomba()
    {
        $nama_lomba = $this->input->post('nama_lomba');

        if (empty($nama_lomba)) {
            $this->session->set_flashdata('error', 'Nama lomba wajib diisi!');
            redirect('classmeeting/tambah_lomba');
            return;
        }

        $cek = $this->Pendaftaran_model->cek_lomba($nama_lomba);
        if ($cek) {
            $this->session->set_flashdata('error', 'Lomba "' . $nama_lomba . '" sudah ada!');
            redirect('classmeeting/tambah_lomba');
            return;
        }

        $this->Pendaftaran_model->insert_lomba($nama_lomba);
        $new_id = $this->db->insert_id();

        $this->session->set_flashdata('success', 'Lomba berhasil ditambahkan!');
        $this->session->set_flashdata('lomba_baru_id', $new_id);
        redirect('classmeeting');
    }
}
