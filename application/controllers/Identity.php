<?php class Identity extends MY_Controller {

    public function __construct(){
        parent::__construct();

        if ($this->session->id == false){
            redirect(site_url('menus/nav/welcome'));
        }
    }

    public function ident_list(){
        // get player that are alive
        unset($this->data['players']);
        $where = array();
        $where['dead_stamp'] = null;
        $players = $this->player_model->where($where)->get_all();
        if($players){
            $i = 0;
            foreach ($players as $player){
                if($player['user_id'] == $this->session->id){
                    unset($players[$i]);
                } else if ($player['user_id'] > 1){
                    $user = $this->user_model->where('id', $player['user_id'])->get();
                    $players[$i]['username'] = $user['username'];
                    $players[$i]['user_id'] = $user['id'];
                }
                $i++;
            }
            $this->data['players'] = $players;
        } else {
            $this->data['players'] = array();
        }

        $this->session->data = $this->data;
        redirect(site_url('identity/viewlist'));
    }

    public function viewlist(){
        $this->data = $this->session->data;
        $this->load->view('pvp/identity');
    }


    //CREATE

    public function create($player_id){
        $this->get_player();

        if($this->session->dead){
            redirect(site_url());
        }
        if($this->session->player['coins'] < 10){
            $this->system_message("You do not have enough coins to do that");
            redirect(site_url());
        }


        if($this->session->pvp_id){
            $where = array();
            $where['player_id'] = $this->session->player['id'];
            $where['id'] = $this->session->pvp_id;
            $this->event_model->where('id', $this->session->pvp_id)->delete();
            $this->session->unset_userdata('event');
            $this->session->unset_userdata('pvp_id');
            $this->system_message("You were able to escape.");
        }
        $this->session->unset_userdata('pvp');

        $diff               = ($this->session->player['coins'] -10);
        $update             = array();
        $update['coins']    = $diff;
        $this->player_model->where('user_id', $this->session->id)->update($update);
        $this->get_player();

        $enemy_user = $this->user_model->where('id', $player_id)->get();
        $enemy      = $this->player_model->where('user_id', $player_id)->get();
        $this->session->opponent = $enemy;
        $enemy['username'] = $enemy_user['username'];
        $enemy['user_id'] = $player_id;
        $enemy['id'] = $enemy_user['id'];

        $event = array();
        $event['player_id']     = $this->session->id;
        $event['power']         = ($enemy['power'] * 1.2);
        $event['enemy_info']    = $enemy['username'];
        $event['dollars']       = ($enemy['dollars'] * 0.3);
        $event['coins']         = 0 ;
        $event['xp']            = ($enemy['xp'] * 0.25);
        $event['hp']            = $enemy['hp'];
        $event['opponent']      = $player_id;

        $pvp_id = $this->event_model->insert($event);

        $this->session->pvp_id = $pvp_id;
        $this->session->event = $this->event_model->get($pvp_id);
        $this->load->view('pvp/battle');
    }

    public function hack(){
        if($this->session->dead){
            redirect(site_url());
        }
        // get event
        $event =  $this->event_model->get($this->session->pvp_id);
        $this->session->event = $event;
        // get opponent HP and sync with event hp
        $opponent = $this->player_model->where('user_id', $event['opponent'])->get();
        $enemy = array();
        $enemy['hp'] = $opponent['hp'];
        // get multipliers
        $hack_name = $this->hack_name();
        $hack_power = $this->hack_power();
        $enemy_hack = $this->enemy_hack();
        $enemy_power = $opponent['power'];
        //calculate powers
        $your_attack = $hack_power * $this->session->player['power'];
        $enemy_attack = $enemy_power;
        //subtract the damage
        $player = array();
        $enemy['hp'] = ($event['hp'] - $your_attack);
        $player_hp = $this->session->player['hp'];
        $new_hp = $player_hp - $enemy_attack;
        $player['hp'] = $new_hp;
        $player['user_id'] = $this->session->id;

        $opponent = array();
        $opponent['hp'] = $enemy['hp'];

        if($opponent['hp'] <= 0){
            // If opponent dies
            $opponent = $this->player_model->where('user_id', $event['opponent'])->get();
            $diff = ($opponent['xp'] * 0.75);
            $opponent['xp'] = $diff;
            $opponent['hp'] = 0;
            $opponent['dollars'] = ($opponent['dollars'] * 0.7);
            $opponent['dead_stamp'] = date("Y-m-d H:i:s");
            $opponent['message'] = 'Your XP was stoled by ' . $this->session->user['username'];
            $this->player_model->where('user_id', $event['opponent'])->update($opponent);
            // record the graffi wall message
            $string = $opponent['username'] . " XP was stolen by " . $this->session->username . " using " . $hack_name . ".";
            $this->record_pvp($string);
            // Load the success method that gives the rewards
            $this->success();
        } else {
            $opponent = $this->player_model->where('user_id', $event['opponent'])->get();
            $opponent['hp'] = $enemy['hp'];
            $opponent['message'] = 'You have been attacked by ' . $this->session->user['username'];
            $this->player_model->where('user_id', $event['opponent'])->update($opponent);
        }

        if($new_hp <=0 ){
            $player['hp'] = 0;
            $player['dead_stamp'] = date("Y-m-d H:i:s");
            $this->event_model->update($enemy, $this->session->pvp_id);
            $this->player_model->where('user_id', $this->session->id)->update($player);
            $this->system_message('You were defeated by ' . $this->session->event['enemy_info']);
            $string = $this->session->username . " was defeated by " . $opponent['username'] . " using " . $enemy_hack . ".";
            $this->record_pvp($string);
            $where = array();
            $where['player_id'] = $this->session->player['id'];
            $where['id'] = $this->session->pvp_id;
            $this->event_model->where($where)->delete($this->session->pvp_id);
            redirect(site_url('events/dead'));
        }
        // record the changes
        $this->event_model->update($enemy, $this->session->pvp_id);
        $this->player_model->where('user_id', $this->session->id)->update($player);
        $opponent = $this->session->opponent;
        $opponent['hp'] = $event['hp'];

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
            $this->load->view('pvp/ident_battle', $this->data);
        }


    }

    public function dead(){
        // add a condition here to catch if the person is actually not dead and redirect to the main menu instead

        $this->load->view('battle/dead');
    }

    public function abort(){
        $where = array();
        $where['player_id'] = $this->session->player['id'];
        $where['id'] = $this->session->pvp_id;
        $this->event_model->where($where)->delete($this->session->pvp_id);
        $this->session->unset_userdata('event');
        $this->session->unset_userdata('pvp_id');
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
        $update['karma']    = (1 + $player['karma']);

        $this->player_model->where('user_id', $this->session->id)->update($update);
        $this->get_state();
        $this->get_level(); // also reloads player stats from the db

        $this->data['reward'] = $event; // save event info to data
        $this->data['hack_name'] = $this->hack_name();
        // now delete the event from the session
        $where = array();
        $where['player_id'] = $this->session->player['id'];
        $where['id'] = $this->session->pvp_id;
        $this->event_model->delete($this->session->pvp_id);
        $this->session->unset_userdata('event');
        $this->session->unset_userdata('pvp_id');
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
        $this->load->view('pvp/success', $this->data);
    }

    public function load_battle(){
        $this->get_state();
        $this->data = $this->session->data;
        $this->load->view('pvp/battle', $this->data);
    }

}

