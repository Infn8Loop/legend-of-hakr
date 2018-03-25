<?php class Coffee extends MY_Controller {

    public function __construct(){
        parent::__construct();

        if ($this->session->id == false){
            redirect(site_url('menus/nav/welcome'));
        }
    }

    public function index(){
        if($this->session->dead ==1){
            redirect(site_url());
        }
        $this->data = $this->session->data;
        $this->load->view('menus/coffee', $this->data);
    }

    public function coffee(){
        if($this->session->dead ==1){
            redirect(site_url());
        }
        $cost = ($this->session->player['level'] * 100);
        if($this->session->player['dollars']>= $cost){
            $player = array();
            $player['hp'] = $this->session->player['max_hp'];
            $player['dollars'] = ($this->session->player['dollars'] - $cost);
            $this->player_model->where('user_id', $this->session->id)->update($player);
            $this->news();
            redirect(site_url());
        } else {
            $message = "You don't even have enough money for a cup of coffee, loser.";
            $this->system_message($message);
            $msg = $this->session->username . " didn't even have enough money for a cup of coffee.";
            $this->system_graffiti($msg);
            redirect(site_url());
        }


    }

    public function donut(){
        if($this->session->dead ==1){
            redirect(site_url());
        }
        $cost = 1;
        if($this->session->player['coins']>= $cost){
            $player = array();
            $player['hp'] = ($this->session->player['max_hp'] * 1.35);
            $player['coins'] = ($this->session->player['coins'] - $cost);
            $this->player_model->where('user_id', $this->session->id)->update($player);
            $this->news();
            redirect(site_url());
        } else {
            $message = "You don't even have enough money for a donut, loser.";
            $this->system_message($message);
            redirect(site_url());
        }


    }


}
