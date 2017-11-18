<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {
    public $timestamps = false;
    protected $table = "users";

    public $fields = [
        'username' => ['field_name' => 'Nazwa użytkownika'],
        'email' => ['field_name' => 'Email'],
        'last_login' => ['field_name' => 'Ostatnie logowanie'],
        'active' => ['field_name' => 'Aktywny'],
        'lang' => ['field_name' => 'Język'],
        'admin' => ['field_name' => 'Administrator'],
        'type' => [
            'field_name' => 'Typ urządzenia',
            'field_type' => [
                1 => 'Wielowirnikowiec',
                2 => 'Płatowiec'
            ]
        ]
    ];

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