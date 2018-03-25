<?php class Market_model extends MY_Model {

    public $table = "Market";
    public $primary_key = "id";

    public function __construct()
    {
        parent::__construct();
        $this->return_as = "array";
    }

}
