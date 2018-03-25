<?php class Chat extends MY_Controller{
    public function __construct(){
        parent::__construct();
    }

    public function refresh(){
        $key = $this->input->post('key');
        if ($key == 'HAKR'){
            $messages = array();
            $this->session->messages = $messages;
            $where = array('system_yn' => '0');

            $sql = "
                SELECT * FROM messages
                WHERE system_yn = 0
                GROUP BY id DESC
                LIMIT 10;
            ";

            $query = $this->db->query($sql);

            $get = $query->result_array();

            //$get = $this->message_model->where($where)->get_all();
            

            if($get){
                $messages = array_reverse($get);
                $this->data['chat_messages'] = $messages;
                $this->load->view('menus/chat-messages', $this->data);
            }
        }
    }

    public function write(){
        $msg = $this->input->post('message');
        $color = $this->input->post('color');
        if(strpos($msg, '://') && !strpos($msg, '.gif') && !strpos($msg, '.jpg')){
            $html = '<a href ="' . $msg . '">' . $msg . '</a>';
            $message = array();
            $message['user_id']  = $this->session->id;
            $message['username'] = $this->session->username;
            $message['message'] = $html;
            $this->message_model->insert($message);
            echo "Your message was a link";
            die();
        }
        if(strpos($msg, '.gif') || strpos($msg, '.jpg')){
            $html = '<img src ="' . $msg . '" height="100px" alt="' . $msg . '"/>';
            $message = array();
            $message['user_id']  = $this->session->id;
            $message['username'] = $this->session->username;
            $message['message'] = $html;
            $this->message_model->insert($message);
            echo "Your message was an image";
            die();
        }
        if (strpos($msg, '<') == false && strpos($msg, '>') == false && $msg !== '') {
            $html = '<span class="' . $color . '">' . $msg . '</span>';
            $message = array();
            $message['user_id']  = $this->session->id;
            $message['username'] = $this->session->username;
            $message['message'] = $html;
            $this->message_model->insert($message);
            echo "Your message was text";
        } else if(strpos($msg, '<') == !false || strpos($msg, '>') == !false){
            echo "DIRTY";
        } else {
            echo 'You cannot send an empty chat message';
        }

    }

    public function clear_messages(){
        $this->message_model->where('system_yn', '1')->delete();
        $this->message_model->where('system_yn', '0')->delete();
    }

    public function clear_chat(){
        $this->message_model->where('system_yn', '0')->delete();
    }

    public function clear_graffiti(){
        $this->message_model->where('system_yn', '1')->delete();
    }

}
