<?php class Market extends MY_Controller {

    public function __construct(){
        parent::__construct();

        if ($this->session->id == false){
            redirect(site_url('menus/nav/welcome'));
        }
    }

    public function index(){
        $this->get_state();
        $market = $this->session->market;

        $player             = $this->session->player;
        $shares             = $this->input->post('shares');
        $cost               = $market['value'] / 100;
        $total              = ($shares * $cost);
        $diff               = ($player['dollars'] - $total);
        if($diff >= 0){
            $update             = array();
            $update['dollars']  = ($player['dollars'] - $total);
            $update['shares']    = ($player['shares'] + $shares);
            $update['message']  = "You successfully bought " . $shares . " Shares.";
            $this->player_model->where('user_id', $this->session->id)->update($update);
            redirect(site_url());
        }else {
            $message = "You don't have enough money to do that.";
            $this->system_message($message);
            redirect((site_url()));
        }
    }

}
