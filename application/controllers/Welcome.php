<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{


	    $salt = bin2hex(openssl_random_pseudo_bytes(SALT_LENGTH/2));
	    var_dump($salt);

        $hash = hash_pbkdf2("sha256", "admin", $salt, HASH_ITERATIONS, HASH_LENGTH);
	    var_dump($hash); die;
		$this->load->view('welcome_message');
	}
}
