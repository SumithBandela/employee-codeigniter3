<?php

class User_model extends CI_Model{

    public function register($username,$password){
        $existing_user = $this->db->get_where('users',['username'=>$username])->row();
        if($existing_user)
        {
            log_message('error',"registration failed username : '{$username}' already existed");
            return ['status'=>false,'message'=>'username already exists'];
        }
        $hashed_password = password_hash($password,PASSWORD_BCRYPT);
        $insert = $this->db->insert('users',[
            'username'=>$username,
            'password' => $hashed_password
        ]);

        if($insert)
        {
            log_message('info','user registered successfully');
            return ['status'=>true,'message'=>'user registered'];
        }

    }

    public function login($username,$password)
    {
        $user =  $this->db->get_where('users',['username'=>$username])->row();
        if($user && password_verify($password,$user->password))
        {
            log_message('info','user logged in successfully');
            return ['status'=>true,'message'=>'login successful','user'=>$user];
        }
        log_message('error','login failed');
        return ['status'=>false,'message'=>'invalid credentials'];
    }
 
}