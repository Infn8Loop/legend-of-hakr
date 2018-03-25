<?php class Bank extends MY_Controller {

    public function __construct(){
        parent::__construct();

        if ($this->session->id == false){
            redirect(site_url('menus/nav/welcome'));
        }
    }

    public function index(){
        $this->get_state();
        $player             = $this->session->player;
        $coins              = $this->input->post('coins');
        $cost               = $player['level'] * 100;
        $total              = ($coins * $cost);
        $diff               = ($player['dollars'] - $total);
        if($diff >= 0){
        $update             = array();
        $update['dollars']  = ($player['dollars'] - $total);
        $update['coins']    = ($player['coins'] + $coins);
        $update['message']  = "You successfully bought " . $coins . " E-coins.";
        $this->player_model->where('user_id', $this->session->id)->update($update);
        redirect(site_url());
        }else {
            $message = "You don't have enough money to do that.";
            $this->system_message($message);
            redirect((site_url()));
        }
    }

}
