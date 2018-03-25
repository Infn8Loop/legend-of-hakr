<?php class User_model extends MY_Model {

    public $table = "Users";
    public $primary_key = "id";

    public function __construct()
    {
        parent::__construct();
        $this->return_as = "array";
    }

}
