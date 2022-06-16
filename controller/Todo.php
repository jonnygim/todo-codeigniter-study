<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo extends CI_Controller {
	/* 생성자 */
    public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('download');
		$this->load->model("Todo_model");
		/*todo 실행시 계속 쓰니, 생성자에서 구현*/
	}

	/* 기본  */
	public function writeNew() {
		$this->load->view('write_v');
	}

	/* write & update */
	public function write() {
		print_r($_GET);
		$idx = $_GET['idx'];
		$query = $this->db->get_where('todo', array('idx' => $idx));
		$data = [];
		$data["aa"] = $query->result_array($data);
		$this->load->view('write_v', $data); /*변수를 넘겨 받아서 update 할때 값을 넘겨줘야 함 무조건 배열로. 키["aa"]로 조회*/
	}

	/* insert (+file)*/
	public function insert() {
        //print_r($fname);
		if(isset($_FILES["userfile"]["name"])) {
				$rfname = $_FILES['userfile']['name'];
				$ext = pathinfo($rfname, PATHINFO_EXTENSION);
				$fname = md5(microtime()).'.'.$ext;
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|txt|docx';
				$config['file_name'] = $fname;
                $this->load->library('upload', $config);

                if(!$this->upload->do_upload('userfile')) {
                     echo $this->upload->display_errors();
                } else {
                     $data = $this->upload->data();
                }
          }
		// 폼데이터 접근 헬퍼함수
		$post = $this->input->post(null, true);
		//print_r($post);

		if(isset($post['no'])) {
			/* 업데이트 */
			$this->Todo_model->update($post);
		} else {
			//print_r($post);
			/*new*/
			$data = [
				/*view에서 post로 넘어온 값들*/
				"title" => $post['title'],
				"memo" => $post['memo'],
				"set_date" => $post['set_date'],
				"done" => $post['done'],
				"fname" => $fname,
				"rfname" => $rfname,
				"reg_date" => date("Y-m-d H:i:s") /*날짜 세미콜론 쓰면 안됨 오류 뜸*/
			];
			$this->Todo_model->insert($data);
			/*컬럼명이 다를 때 데이터 가공하고 $data로 받을 수 있음*/
		}
		$this->plist();
	}

	/* download file */
	public function download() {
		/*idx 로 파일 이름(기존파일명, 암호파일명)을 가져옴*/
		$idx = $_GET['idx'];
		$this->db->select('rfname, fname');
		$query = $this->db->get_where('todo', array('idx' => $idx));

		/*쿼리 실행으로 이름 가져오기*/
		foreach($query->result() as $row) {
			$save_name = $row->fname;
			$real_name = $row->rfname;
		}
		/*저장된 암호화된 이름을 기존의 이름으로 변경해서 다운로드*/
		$data = file_get_contents("./uploads/".$save_name);

		force_download($real_name, $data);
	}

	/* list */
	public function plist() {
		/*// 데이터 가져올 때
		// 모델에서 정의한 함수 get_list() 를 $data['list'] 에 저장 함*/
		//$this->load->view('upload_v', array('error' => ' ' ));
		$data = [];
		$data["list"] = $this->Todo_model->get_list();
		//print_r($data['list']);
		$query  =  $this->db->get('todo');
		$this->load->view('list_v', $data);
		/*뷰 파일에서 $data 변수를 사용할 수 있게 전달*/
	}

	/* delete list */
	public function dellist() {
		$idx = $_GET['idx'];
		//print_r($idx);
		$this->db->where('idx', $idx);
		$query = $this->db->delete('todo');
		$this->plist();

	}

/*
		public function ajax_upload() {
			 if(isset($_FILES["userfile"]["name"])) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|txt';
                $this->load->library('upload', $config);

                if(!$this->upload->do_upload('userfile')) {
                     echo $this->upload->display_errors();
                } else {
                     $data = $this->upload->data();
                     echo "success";
                }
           }
		}*/
}
// 보안도 다 해줌
// 삭제도 update select  write 페이지 에서 idx