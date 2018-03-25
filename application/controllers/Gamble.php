<?php class Gamble extends MY_Controller {

    public function __construct(){
    parent::__construct();
        if ($this->session->id == false){
            redirect(site_url('menus/nav/welcome'));
        }
    }

    public function gamble($choice){
        $this->get_player();
        $player = $this->session->player;

        // if($this->session->dead == true){
        //     $this->system_message("You can't gamble while you're in jail.");
        //     redirect(site_url());
        // }

        if ($player['coins'] > 2 ){ // player has enough money to play
            $pool = array(
                1,2,3
            );
            $key = array_rand($pool,1);
            $jackpot = $pool[$key];

            $update = $player;
            if ($choice == $jackpot){
                // do the things
                $update['coins'] = ($player['coins'] + 10);
                $this->player_model->where('user_id', $this->session->id)->update($update);
                $this->system_message("You won 10 coins!");
                $msg = $this->session->username . " may have a gambling problem.";
                $this->system_graffiti($msg);
                redirect(site_url());
            } else {
                // take money and loser message
                $update['coins'] = ($player['coins'] - 2);
                $this->player_model->where('user_id', $this->session->id)->update($update);
                $this->system_message("You lost 2 coins, SUCKER!");
                redirect(site_url());
            }
        } else{
            $this->system_message("Not enough coins to play. Sorry.");
            redirect(site_url());
        }


    }


}
