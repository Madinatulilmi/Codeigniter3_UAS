<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Jadwal extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }


function index_get() {
        $kd_jadwal = $this->get('kd_jadwal');
        if ($kd_jadwal == '') {
            $kuliah = $this->db->get('jadwal')->result();
        } else {
            $this->db->where('kd_jadwal', $kd_jadwal);
            $kuliah = $this->db->get('jadwal')->result();
        }
        $this->response($kuliah, 200);
    }
//Masukan function selanjutnya disini
    //Mengirim atau menambah data kontak baru
    function index_post() {
        $data = array(
                    'kd_jadwal'     => $this->post('kd_jadwal'),
                    'nidn'          => $this->post('nidn'),
                    'kd_matkul'     => $this->post('kd_matkul'),
                    'waktu'         => $this->post('waktu'),
                    'ruang'         => $this->post('ruang'),
                    'kelas'         => $this->post('kelas'),
                    'hari'         => $this->post('hari'),
                    'ta'         => $this->post('ta'),
                    'sem'         => $this->post('sem'),
                    'user'         => $this->post('user')
                );
        $insert = $this->db->insert('jadwal', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    
    //Masukan function selanjutnya disini

    function index_put() {
        $kd_jadwal = $this->put('kd_jadwal');
        $data = array(
                    'kd_jadwal'       => $this->put('kd_jadwal'),
                    'kd_matkul'          => $this->put('kd_matkul'),
                    'waktu'    => $this->put('waktu'),
                    'ruang'    => $this->put('ruang'),
                    'kelas'         => $this->put('kelas'),
                    'hari'         => $this->put('hari'),
                    'ta'         => $this->put('ta'),
                    'sem'         => $this->put('sem'),
                    'user'         => $this->put('user'));
        $this->db->where('kd_jadwal', $kd_jadwal);
        $update = $this->db->update('jadwal', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    //Menghapus salah satu data kontak
    function index_delete() {
        $kd_jadwal = $this->delete('kd_jadwal');
        $this->db->where('kd_jadwal', $kd_jadwal);
        $delete = $this->db->delete('jadwal');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}//Memperbarui data kontak yang telah ada

?>