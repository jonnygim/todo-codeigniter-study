<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Todologin extends CI_Controller {
    /* 생성자 */
    public function __construct() {
		parent::__construct();
		$this->load->model("Todologin_model");
		/*todo 실행시 계속 쓰니, 생성자에서 구현*/
        
	}

    public function member() {
        $this->load->view('member_v');
    }

    public function member_insert() {
		$post = $this->input->post(null, true); // 폼데이터 접근 헬퍼함수

        //$this->Todologin_model->member_insert($post); // post name 이랑 컬럼명이랑 같으면 $data 안해도 됨
        $data = [
            "userid" => $post['userid'],
            "userpw" => password_hash($post['userpw'], PASSWORD_DEFAULT),
            "email" => $post['email'],
            "reg_date" => date("Y-m-d H:i:s") /*날짜 세미콜론 쓰면 안됨 오류 뜸*/
        ];
        $this->Todologin_model->member_insert($data);

        //require_once(APPPATH.'/controllers/Todo.php');
        //$todo2 = new Todo();
        //$todo2->plist();
    }

    public function member_login() {
        $post = $this->input->post(null, true); // 폼데이터 접근 헬퍼함수
        //print_r($post);
        $this->Todologin_model->member_login($post);
        
    }

}