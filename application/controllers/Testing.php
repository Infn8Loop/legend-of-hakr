<?php class Testing extends MY_Controller {

    public function __construct(){
        parent::__construct();

        if ($this->session->id == false){
            redirect(site_url('menus/nav/welcome'));
        }
    }

    public function revive(){
        $player = array();
        $player['user_id'] = $this->session->id;
        $player['dead_stamp'] = null;
        $player['message'] = null;
        $player['hp'] = $this->session->player['max_hp'];
        $this->player_model->where('user_id', $this->session->id)->update($player);
        $this->session->message = false;
        $this->get_state();
        $this->load->view('menus/main');
    }

    public function revive_all(){
        $players = $this->player_model->get_all();

        foreach ($players as $person){
            $player['user_id'] = $person['user_id'];
            $player['dead_stamp'] = null;
            $player['message'] = null;
            $this->session->message = false;
            $player['hp'] = $person['max_hp'];
            $this->player_model->where('user_id', $person['user_id'])->update($player);
            $this->get_state();
        }

        $this->load->view('menus/main');

    }

    public function give_dollars(){
        $players = $this->player_model->get_all();

        foreach ($players as $person){
            $player['user_id'] = $person['user_id'];
            $player['dollars'] = ($person['dollars'] + 1000);
            $player['message'] = "Free money! You received $1000";
            $this->player_model->where('user_id', $person['user_id'])->update($player);
            $this->get_state();
        }
        $this->system_graffiti("Sysadmin gave everyone $1000, and there was much rejoicing.");

        $this->load->view('menus/main');

    }

    public function give_coins(){
        $players = $this->player_model->get_all();

        foreach ($players as $person){
            $player['user_id'] = $person['user_id'];
            $player['coins'] = ($person['coins'] + 10);
            $player['message'] = "Free money! You received 10 E-coins!";
            $this->player_model->where('user_id', $person['user_id'])->update($player);
            $this->get_state();
        }

        $this->system_graffiti("Sysadmin gave everyone 10 E-coins, and there was much rejoicing.");
        $this->load->view('menus/main');

    }

    public function clear_events(){
        $events = $this->event_model->get_all();

        if (!empty($events)){
            foreach ($events as $event){
                $this->event_model->delete($event['id']);
            }
        }
    }

}
