<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class user extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }


function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $kuliah = $this->db->get('user')->result();
        } else {
            $this->db->where('id', $id);
            $kuliah = $this->db->get('user')->result();
        }
        $this->response($kuliah, 200);
    }
//Masukan function selanjutnya disini
    //Mengirim atau menambah data kontak baru
    function index_post() {
        $data = array(
                    'id'           => $this->post('id'),
                    'username'          => $this->post('username'),
                    'password'    => $this->post('password'),
                    'email'    => $this->post('email'),
                    'level'    => $this->post('level'),
                    'blokir'    => $this->post('blokir'),
                    'id_session'    => $this->post('id_session')
                );
        $insert = $this->db->insert('user', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    
    //Masukan function selanjutnya disini

    function index_put() {
        $id = $this->put('id');
        $data = array(
                    'id'       => $this->put('id'),
                    'username'          => $this->put('username'),
                    'password'    => $this->put('password'),
                    'email'    => $this->put('email'),
                    'level'    => $this->put('level'),
                    'blokir'    => $this->put('blokir'),
                    'id_session'    => $this->put('id_session'));
        $this->db->where('id', $id);
        $update = $this->db->update('user', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    //Menghapus salah satu data kontak
    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('user');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}//Memperbarui data kontak yang telah ada

?>