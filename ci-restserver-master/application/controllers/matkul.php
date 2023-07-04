<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Matkul extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }


function index_get() {
        $kd_matkul = $this->get('kd_matkul');
        if ($kd_matkul == '') {
            $kuliah = $this->db->get('matkul')->result();
        } else {
            $this->db->where('kd_matkul', $kd_matkul);
            $kuliah = $this->db->get('matkul')->result();
        }
        $this->response($kuliah, 200);
    }


    //Masukan function selanjutnya disini
    //Mengirim atau menambah data kontak baru
    function index_post() {
        $data = array(
                    'kd_matkul'           => $this->post('kd_matkul'),
                    'nm_matkul'          => $this->post('nm_matkul'),
                    'sks'    => $this->post('sks'));
        $insert = $this->db->insert('matkul', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    
    //Masukan function selanjutnya disini

    function index_put() {
        $kd_matkul = $this->put('kd_matkul');
        $data = array(
                    'kd_matkul'       => $this->put('kd_matkul'),
                    'nm_matkul'          => $this->put('nm_matkul'),
                    'sks'    => $this->put('sks'));
        $this->db->where('kd_matkul', $kd_matkul);
        $update = $this->db->update('matkul', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    //Menghapus salah satu data kontak
    function index_delete() {
        $kd_matkul = $this->delete('kd_matkul');
        $this->db->where('kd_matkul', $kd_matkul);
        $delete = $this->db->delete('matkul');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}//Memperbarui data kontak yang telah ada


//Masukan function selanjutnya disini
?>