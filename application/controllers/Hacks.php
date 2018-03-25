<?php class Hacks extends MY_Controller {

    public function __construct(){
        parent::__construct();

        if ($this->session->id == false){
            redirect(site_url('menus/nav/welcome'));
        }
    }

    public function hack_name(){
        $hacks = array(
            "TuneUpMyPc Trojan",
            "Michaelangelo Virus",
            "FBI Virus",
            "CryptoWall",
            "Porn E-bomb",
            "WannaCallMomma NCryp7",
            "Funtime H4X0R5 XPL017"
        );
        $rand = array_rand($hacks, 1);
        return $hacks[$rand];
    }

    public function hack_power(){
        $hack_power = array(
            0.5,
            0.6,
            0.7,
            0.75,
            0.8,
            0.85,
            0.9,
            0.95,
            1.0,
            0.0,
            0.25,
            1.25,
        );
        $rand = array_rand($hack_power, 1);
        return $hack_power[$rand];
    }


}
