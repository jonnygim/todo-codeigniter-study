<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todologin_model extends CI_Model {
    /* 생성자 */
    public function __construct() {
		parent::__construct();
		$this->load->database(); /*데이터베이스 호출 함수 database()*/
	}

    public function member_insert($post) {
        print_r($post);
        $this->db->insert("todo_member", $post);
    }

    public function member_login($post) {
        if($post == "") {
        } else {
            $password = $post['loginpw'];

            $this->db->select('userid, userpw');
            $query = $this->db->get_where('todo_member', array('userid' => $post['loginid']));

            /*쿼리 실행으로 이름 가져오기*/
            foreach($query->result() as $row) {
                $userid = $row->userid;
                $hash_password = $row->userpw;
            }
            print_r($userid);
            print_r($hash_password);
            
            // if(password_verify($password, $hash_password)) {
            //     $this->load->library('session');
            //     $user = array(
            //         'userid'  => $userid,
            //         'logged_in' => TRUE
            //     );
            //     //$this->session->set_userdata($user);
                
            //     //$data = $this->session->all_userdata(); //세션 데이터 추출
                
            // }
        }
    }
}