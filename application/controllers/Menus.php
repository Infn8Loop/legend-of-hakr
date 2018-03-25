<?php class Menus extends MY_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function nav($nav){
        $this->get_state();
        if($this->session->event_id){
            $where = array();
            $where['player_id'] = $this->session->player['id'];
            $where['id'] = $this->session->event_id;
            $this->event_model->delete($this->session->event_id);
        }
        if($this->session->pvp_id){
            $where = array();
            $where['player_id'] = $this->session->player['id'];
            $where['id'] = $this->session->event_id;
            $this->event_model->delete($this->session->pvp_id);
        }
        $this->load->view('menus/' . $nav);

    }

}
