<?php class Users extends MY_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function register(){
        $this->session->id = false;
        $this->load->model('user_model');
        $this->load->model('player_model');
        $username       = $this->input->post('username');
        $email          = $this->input->post('email');
        $password       = $this->input->post('password');
        $password2      = $this->input->post('password_confirm');

        $users      = $this->user_model->get_all();
        $usernames  = array();
        foreach ($users as $user){
            array_push($usernames, (string) $user['username']);
        }
        if (array_search($username, $usernames)){
            echo "I'm sorry that username is already in use. Go back and try again.";
            die();
        };

        if($username && $password && $password2 && $password == $password2){
            $user      = array();
            $user['username'] = $username;
            $user['email']    = $email;
            $user['password'] = md5($password);

            $id = $this->user_model->insert($user);

        }

        if(!$id){
            $this->load->view('errors/error');
        } else {
            $this->session->id      = $id;
            $new = array();
            $new['user_id']         = $id;
            $new['username']        = $username;
            $player                 = $this->player_model->insert($new);
            $this->session->player  = $this->player_model->where($player)->get();
            $username               = $this->session->player['username'];
            $this->system_graffiti($username . " has joined the game. ");
            $this->system_message("Welcome to the Legend of Hak_R");
            $this->get_state();
            redirect(site_url('menus/nav/main'));
        }


    }

    public function logout(){
        $this->session->id = false;
        $this->session->sess_destroy();

        redirect(site_url());
    }

    public function login(){
        $this->load->model('user_model');
        $this->load->model('player_model');

        $username   = $this->input->post('username');
        $password   = $this->input->post('password');

        $where              = array();
        $where['username']  = $username;
        $where['password']  = md5($password);

        $login = $this->user_model->where($where)->get();

        if(!$login){
            echo "Sorry, Incorrect username or password! Try again. ";
            die();
        } else {
            $login['password'] = false;
            $this->session->id = $login['id'];
            $this->session->username = $login['username'];
            $this->session->player = $this->player_model->where('user_id', $login['id'])->get();

            $new['user_id'] = $this->session->id;
            $this->player_model->where('user_id', $new['user_id'])->update($new);

            redirect(site_url());
        }
    }


}
