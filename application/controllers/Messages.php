<?php class Messages extends MY_Controller {

    public function __construct(){
        parent::__construct();

        if ($this->session->id == false){
            redirect(site_url('menus/nav/welcome'));
        }
    }

    public function delete(){
//      This deletes system messages that display at the top of the app
        $update = array();
        $update['message'] = false;
        $this->player_model->where('user_id', $this->session->id)->update($update);
        $this->session->message = 0;
        $this->get_state();
        redirect(site_url());
    }

    public function graffiti(){
        $graffiti = array();
        $this->session->graffiti = $graffiti;
        $get = $this->message_model->where('system_yn', '1')->get_all();
        if($get){
            $reverse = array_reverse($get);
            $graffiti = array();
            $i = 0;
            for ($i = 0; $i < 200; $i++){
                if (isset($reverse[$i])){
                    array_push($graffiti, $reverse[$i]);
                }

            }
            $graffiti = array_reverse($graffiti);
            $this->session->graffiti = $graffiti;
        }

        $this->load->view('menus/graffiti');
    }

    public function write_graffiti(){
        $msg = $this->input->post('message');
        if (strpos($msg, '<') == false && strpos($msg, '>') == false && $msg !== ''){
            $message = array();
            $message['user_id']  = $this->session->id;
            $message['username'] = $this->session->username;
            $message['message'] = $msg;
            $message['system_yn'] = '0';
            $this->message_model->insert($message);

            redirect(site_url('messages/graffiti'));
        } else {
            $this->system_message("You message cannot be empty or contain code.");
            $this->get_player();
            redirect(site_url('messages/graffiti'));
        }

    }

}
