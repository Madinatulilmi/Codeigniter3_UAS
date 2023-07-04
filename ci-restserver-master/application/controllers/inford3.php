<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class inford3 extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }


function index_get() {
        $npm = $this->get('npm');
        if ($npm == '') {
            $kuliah = $this->db->get('teknik_informatika_d3')->result();
        } else {
            $this->db->where('npm', $npm);
            $kuliah = $this->db->get('teknik_informatika_d3')->result();
        }
        $this->response($kuliah, 200);
    }
//Masukan function selanjutnya disini
    //Mengirim atau menambah data kontak baru
    function index_post() {
        $data = array(
                    'npm'           => $this->post('npm'),
                    'nm_teknik_informatika_d3'          => $this->post('nm_teknik_informatika_d3'),
                    'alamat'    => $this->post('alamat'),
                    'prodi'    => $this->post('prodi'));
        $insert = $this->db->insert('teknik_informatika_d3', $data);
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
                    'nm_teknik_informatika_d3'          => $this->put('nm_teknik_informatika_d3'),
                    'alamat'    => $this->put('alamat'),
                    'prodi'    => $this->put('prodi'));
        $this->db->where('npm', $npm);
        $update = $this->db->update('teknik_informatika_d3', $data);
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
        $delete = $this->db->delete('teknik_informatika_d3');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}//Memperbarui data kontak yang telah ada

?>