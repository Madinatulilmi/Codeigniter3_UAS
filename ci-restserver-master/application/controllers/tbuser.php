<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class tbuser extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }


function index_get() {
        $password = $this->get('password');
        if ($password == '') {
            $kuliah = $this->db->get('tbuser')->result();
        } else {
            $this->db->where('password', $password);
            $kuliah = $this->db->get('tbuser')->result();
        }
        $this->response($kuliah, 200);
    }


    //Masukan function selanjutnya disini
    //Mengirim atau menambah data kontak baru
    function index_post() {
        $data = array(
                    'password'           => $this->post('password'),
                    'user'          => $this->post('user'),
                    'state'    => $this->post('state'));
        $insert = $this->db->insert('tbuser', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    
    //Masukan function selanjutnya disini

    function index_put() {
        $password = $this->put('password');
        $data = array(
                    'password'       => $this->put('password'),
                    'user'          => $this->put('user'),
                    'state'    => $this->put('state'));
        $this->db->where('password', $password);
        $update = $this->db->update('tbuser', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    //Menghapus salah satu data kontak
    function index_delete() {
        $password = $this->delete('password');
        $this->db->where('password', $password);
        $delete = $this->db->delete('tbuser');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}//Memperbarui data kontak yang telah ada


//Masukan function selanjutnya disini
?>