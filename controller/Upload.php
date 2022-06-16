<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php

class Upload extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
        }

        public function index()
        {
                $this->load->view('upload_v', array('error' => ' ' ));
        }

		public function ajax_upload() {
			 if(isset($_FILES["userfile"]["name"])) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|txt';
                $this->load->library('upload', $config);

                if(!$this->upload->do_upload('userfile')) {
                     echo $this->upload->display_errors();
                } else {
                     $data = $this->upload->data();
                     print_r($_FILES);
                }
           }
		}
}
?>