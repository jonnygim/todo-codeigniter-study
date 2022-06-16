<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo_model extends CI_model {
	/* 생성자 */
	public function __construct() {
		parent::__construct(); /*부모 그대로 가져온다*/
		$this->load->database(); /*데이터베이스 호출 함수 database()*/
		$this->load->helper('file');
	}

	public function insert($post) {
		//print_r($post);
		$this->db->insert("todo", $post); /*DB에 저장 ('테이블명', $post) 쿼리*/
	}

	public function file_insert($post) {
		print_r($post);
		//$this->db->insert("todo_file", $post);
	}

	public function update($post) {

		// 다중 업로드가 안되기 때문에 소용 없음
		if($post['check'] == 0) {
			$rfname = $post['userfile'];
			$ext = pathinfo($rfname, PATHINFO_EXTENSION);
			$fname = md5(microtime()) . '.' . $ext;
			$data = [
				"title" => $post['title'],
				"set_date" => $post['set_date'],
				"memo" => $post['memo'],
				"done" => $post['done'],
				"fname" => $fname,
				"rfname" => $rfname
			];
		} else { // 체크 되어 있으면 기존의 파일 삭제하고 저장하도록
			print_r($post);
			exit;
			if(isset($_FILES["userfile"]["name"])) {
				$rfname = $_FILES['userfile']['name'];
				$ext = pathinfo($rfname, PATHINFO_EXTENSION);
				$fname = md5(microtime()) . '.' . $ext;
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
			$this->db->select('fname');
			$query = $this->db->get_where('todo', array('idx' => $post['no']));

			/*쿼리 실행으로 이름 가져오기*/
			foreach($query->result() as $row) {
				$save_name = $row->fname;
			}
			unlink("./uploads/".$save_name);

			$data = [
				"title" => $post['title'],
				"set_date" => $post['set_date'],
				"memo" => $post['memo'],
				"done" => $post['done'],
				"fname" => $fname,
				"rfname" => $rfname
			];
		}
			//print_r($data);
			$where = "idx = ".$post['no'];
			$this->db->update('todo', $data, $where);

	}

	public function download($table = 'todo_file') {
		$this->db->order_by('idx', 'DESC');
		$query = $this->db->get('todo_file'); /*(codeIgniter 는 query 에 select한 데이터를 객체 형태로 받아오게 되어 있음)*/
		$result = $query->result_array();
		return $result;
	}

	public function get_list($table = 'todo') {
		$this->db->order_by('idx', 'DESC');
		$query = $this->db->get('todo'); /*(codeIgniter 는 query 에 select한 데이터를 객체 형태로 받아오게 되어 있음)*/
		$result = $query->result_array();
		return $result;
	}
}