<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Kuliah extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }


function index_get() {
        $nidn = $this->get('nidn');
        if ($nidn == '') {
            $kuliah = $this->db->get('dosen')->result();
        } else {
            $this->db->where('nidn', $nidn);
            $kuliah = $this->db->get('dosen')->result();
        }
        $this->response($kuliah, 200);
    }


    //Masukan function selanjutnya disini
    //Mengirim atau menambah data kontak baru
    function index_post() {
        $data = array(
                    'nidn'           => $this->post('nidn'),
                    'nm_dos'          => $this->post('nm_dos'),
                    'alm_dos'    => $this->post('alm_dos'));
        $insert = $this->db->insert('dosen', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    
    //Masukan function selanjutnya disini

    function index_put() {
        $nidn = $this->put('nidn');
        $data = array(
                    'nidn'       => $this->put('nidn'),
                    'nm_dos'          => $this->put('nm_dos'),
                    'alm_dos'    => $this->put('alm_dos'));
        $this->db->where('nidn', $nidn);
        $update = $this->db->update('dosen', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    //Menghapus salah satu data kontak
    function index_delete() {
        $nidn = $this->delete('nidn');
        $this->db->where('nidn', $nidn);
        $delete = $this->db->delete('dosen');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}//Memperbarui data kontak yang telah ada


//Masukan function selanjutnya disini
?>