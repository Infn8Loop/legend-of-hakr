<?php class Darkweb extends MY_Controller {

    public function __construct(){
        parent::__construct();

        if ($this->session->id == false){
            redirect(site_url('menus/nav/welcome'));
        }

    }

    public function create(){
        if($this->session->dead){
            redirect(site_url());
        }

        if($this->session->event_id){
            $where = array();
            $where['player_id'] = $this->session->player['id'];
            $where['id'] = $this->session->event_id;
            $this->event_model->where('id', $this->session->event_id)->delete();
        }
        $this->session->unset_userdata('event');
        $enemy = array();

        $enemy['player_id']     = $this->session->id;
        $enemy['power']         = ($this->enemy_power() * 1.4);
        $enemy['enemy_info']    = $this->get_job();
        $enemy['dollars']       = 0; //  $this->get_dollars();
        $enemy['coins']         = $this->darkcoins();
        $enemy['xp']            = $this->get_xp();
        $enemy['hp']            = ($this->get_hp() * 1.5);

        $event_id = $this->event_model->insert($enemy);

        $this->session->event_id = $event_id;
        $this->session->event = $this->event_model->get($event_id);
        $this->load->view('battle/battle');
    }

    public function hack(){
        // get event
        $event = $this->session->event;
        // get multipliers
        $hack_name = $this->hack_name();
        $hack_power = $this->hack_power();
        $enemy_hack = $this->enemy_hack();
        $enemy_power = $this->enemy_power();
        //calculate powers
        $your_attack = $hack_power * $this->session->player['power'];
        $enemy_attack = $enemy_power * $this->session->player['power'];
        //subtract the damage
        $enemy = array();
        $player = array();
        $enemy['hp'] = ($event['hp'] - $your_attack);
        $player_hp = $this->session->player['hp'];
        $new_hp = $player_hp - $enemy_attack;
        $player['hp'] = $new_hp;
        $player['user_id'] = $this->session->id;

        if($new_hp <=0 ){
            $player['hp'] = 0;
            $player['dead_stamp'] = date("Y-m-d H:i:s");
            $this->event_model->update($enemy, $this->session->event_id);
            $this->player_model->where('user_id', $this->session->id)->update($player);
            $where = array();
            $where['player_id'] = $this->session->player['id'];
            $where['id'] = $this->session->event_id;
            $this->event_model->where($where)->delete($this->session->event_id);
            redirect(site_url('events/dead'));
        } else if ($enemy['hp'] <=0 ) {
            $this->success();
        }
        // record the changes
        $this->event_model->update($enemy, $this->session->event_id);
        $this->player_model->where('user_id', $this->session->id)->update($player);

        $this->data['your_hack'] = $hack_name;
        $this->data['your_attack'] = $your_attack;

        $this->data['enemy_hack'] = $enemy_hack;
        $this->data['enemy_attack'] = $enemy_attack;

        // reload the data and display the view output
        $this->get_player();
        $this->get_event();

        if($this->session->dead){
            redirect(site_url());
        } else{
            $this->session->data = $this->data;
            $this->load->view('battle/battle', $this->data);
        }




    }

    public function dead(){
        // add a condition here to catch if the person is actually not dead and redirect to the main menu instead

        $this->load->view('battle/dead');
    }

    public function abort(){
        $where = array();
        $where['player_id'] = $this->session->player['id'];
        $where['id'] = $this->session->event_id;
        $this->event_model->where($where)->delete($this->session->event_id);
        $this->session->unset_userdata('event');
        $this->session->unset_userdata('event_id');
        $this->system_message("You were able to escape.");
        redirect(site_url());
    }

    public function success(){
        $event              = $this->session->event;
        $player             = $this->session->player;
        $update             = array();
        $update['xp']       = ($event['xp'] + $this->session->player['xp']);
        $update['user_id']  = $this->session->id;
        $update['dollars']  = ($event['dollars'] + $player['dollars']);
        $update['coins']    = ($event['coins'] + $player['coins']);

        $this->player_model->where('user_id', $this->session->id)->update($update);
        $this->get_state();
        $this->get_level(); // also reloads player stats from the db

        $this->data['reward'] = $event; // save event info to data
        $this->data['hack_name'] = $this->hack_name();
        // now delete the event from the session
        $where = array();
        $where['player_id'] = $this->session->player['id'];
        $where['id'] = $this->session->event_id;
        $this->event_model->delete($this->session->event_id);
        $this->session->unset_userdata('event');
        $this->session->unset_userdata('event_id');
        $this->session->data = $this->data;
        $message = 'You Succeed! Received: $' . $event['dollars'] . ' and ' . $event['xp'] . ' XP';
        if($event['coins']>0){
            $message += 'and ' . $event['coins'] . 'E-Coins';
        }
        $this->system_message($message);
        redirect(site_url('events/load_success'));
    }

    public function load_success(){
        $this->get_state();
        $this->data = $this->session->data;
        $this->load->view('battle/success', $this->data);
    }

    public function load_battle(){
        $this->get_state();
        $this->data = $this->session->data;
        $this->load->view('battle/battle', $this->data);
    }

    public function darkcoins(){
        // multiply this by player level
        $coins = array(
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10
        );
        $rand = array_rand($coins, 1);
        $coin_reward = $coins[$rand];
        return ($coin_reward);
    }


}
