<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class User_model extends Eloquent {
    public $timestamps = false;
    protected $table = "users";

    public function save_user($post) {

        if(empty($post)) {
            return false;
        }

        $password = $post['password'];
        $salt = random_salt();
        $pass = hash_password($password, $salt);

        $this->username = $post['username'];
        $this->password = $pass;
        $this->salt = $salt;
        $this->email = $post['email'];
        $this->lang = $post['lang'];
        $this->active = (int)isset($post['active']);

        $this->save();
        return $this->getKey();
    }
}