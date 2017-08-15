<?php
class Test extends MY_Controller {

    public function index() {
        $this->load->model('user');
        $this->load->view('test');
    }

    public function hello() {
        echo "This is hello function.";
    }
}
?>