<?php class Revive extends MY_Controller {

    public function __construct(){
        parent::__construct();

        if ($this->session->id == false){
            redirect(site_url('menus/nav/welcome'));
        }
    }

    public function index(){
        $this->get_player();
        $player = $this->session->player;
        $cost = $player['level'];
        if($player['coins'] >= $cost){
            $player = array();
            $player['hp'] = $this->session->player['max_hp'];
            $player['coins'] = ($this->session->player['coins'] - $cost);
            $this->player_model->where('user_id', $this->session->id)->update($player);
            $message = "You pay the fine and are released.";
            $this->system_message($message);
            $this->revive();
            redirect(site_url());
        } else {
            $message = "You do not have enough coins.";
            $this->system_message($message);
            redirect(site_url());
        }
    }

}
