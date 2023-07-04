<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Mhs extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }


function index_get() {
        $npm = $this->get('npm');
        if ($npm == '') {
            $kuliah = $this->db->get('mhs')->result();
        } else {
            $this->db->where('npm', $npm);
            $kuliah = $this->db->get('mhs')->result();
        }
        $this->response($kuliah, 200);
    }
//Masukan function selanjutnya disini
    //Mengirim atau menambah data kontak baru
    function index_post() {
        $data = array(
                    'npm'           => $this->post('npm'),
                    'nm_mhs'          => $this->post('nm_mhs'),
                    'alamat'    => $this->post('alamat'),
                    'prodi'    => $this->post('prodi'));
        $insert = $this->db->insert('mhs', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    
    //Masukan function selanjutnya disini

    function index_put() {
        $npm = $this->put('npm');
        $data = array(
                    'npm'       => $this->put('npm'),
                    'nm_mhs'          => $this->put('nm_mhs'),
                    'alamat'    => $this->put('alamat'),
                    'prodi'    => $this->put('prodi'));
        $this->db->where('npm', $npm);
        $update = $this->db->update('mhs', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    //Menghapus salah satu data kontak
    function index_delete() {
        $npm = $this->delete('npm');
        $this->db->where('npm', $npm);
        $delete = $this->db->delete('mhs');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}//Memperbarui data kontak yang telah ada

?>