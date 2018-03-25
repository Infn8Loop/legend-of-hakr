<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

    public function __construct(){
        parent::__construct();

        $this->load->model('player_model');
        $this->load->model('event_model');
        $this->load->model('user_model');
        $this->load->model('message_model');
        $this->load->model('market_model');
        $this->get_state();  

    }

    // game state

    public function get_state(){
        $this->session->messages = array();
        $this->daily();
        $this->get_market();
        $this->get_player();
//        $this->clear_messages();

        if($this->session->id){
            $this->get_event();
            $this->get_pvp();
            $this->get_status();
            $this->get_level();
            $this->load_game();
        }

    }

    public function get_player(){
        if($this->session->id){
            $where = array();
            $where['user_id'] = $this->session->id;
            $player = $this->player_model->where($where)->get();
            $this->session->player = $player;
            $user = $this->user_model->where('id', $this->session->id)->get();
            unset($user['password']);
            $this->session->user = $user;
            $this->session->username = $player['username'];
        }
    }

    public function get_market(){
        $this->session->market = $this->market_model->get(1);
        $market = $this->session->market;
        $nowstamp = date("Y-m-d H:i:s");
        $nowtime = strtotime($nowstamp);
        $marketstamp = $market['time'];
        $lasttime = strtotime($marketstamp);
        $payouttime = $lasttime + 86400; // time to elapse in seconds 86400 is a day
        $updatetime = $payouttime - $nowtime;
        $this->session->updatetime = $updatetime;

    }

    // Routing

    public function load_game(){
        $this->data = $this->session->data;
    }

    public function get_status(){
        if($this->session->id){
            $player = $this->session->player;
            if ($player['dead_stamp']){
                $nowstamp = date("Y-m-d H:i:s");
                $nowtime = strtotime($nowstamp);
                $deadstamp = $player['dead_stamp'];
                $deadtime = strtotime($deadstamp);
                $revivetime = $deadtime + 300; // time to revive in seconds
                $diff = $revivetime - $nowtime;
                if($diff <0 ){
                    // you can be revived
                    $this->session->dead = false;
                    $message = "You got busted, but you have been released!";
                    $update = array();
                    $update['user_id'] = $this->session->id;
                    $update['message'] = $message;
                    $this->session->message = 1;
                    $update['hp']      = $this->session->player['max_hp'];
                    $update['dead_stamp'] = null;
                    $this->player_model->where('user_id', $update['user_id'])->update($update);

                } else {
                    $this->session->dead = 1;
                    $message = "Your player is in jail for " . number_format($diff / 60) . " Minutes. You may chat or gamble while in jail.";
                    $insert = array();
                    $insert['user_id'] = $this->session->id;
                    $this->session->message = 1;
                    $insert['message'] = $message;
                    $this->player_model->where('user_id', $insert['user_id'])->update($insert);
                }


            } else {
                $this->session->dead = false;
                $update = array();
                $update['user_id'] = $this->session->id;
                $update['message'] = null;
                $this->session->message = false;
                $update['dead_stamp'] = null;
                $this->player_model->where('user_id', $update['user_id'])->update($update);
            }
        }
    }


    public function get_pvp(){
        if($this->session->event >0){
            if($this->session->pvp_id){
                $this->session->event = $this->event_model->where('id', $this->session->pvp_id)->get();
            }
        }
    }

    public function get_level(){
        if($this->session->id){
            $player = $this->session->player;
            if($player['xp'] >= $player['next_level'] && $player['level'] < 121){
                $new = array();
                $new['user_id']     =  $player['user_id'];
                $new['max_hp']      =  $player['max_hp'] * 1.10;
                $new['next_level']  =  $player['next_level'] * 1.30;
                $new['power']       =  $player['power'] * 1.10;
                $new['level']       =  $player['level'] + 1;
                $message            = "You have leveled up! You are now level " . $new['level'];
                $this->system_message($message);
                $msg = $this->session->username . " has reached level " . $new['level'] . "!";
                $this->system_graffiti($msg);
                $this->player_model->where('user_id', $new['user_id'])->update($new);
                $this->get_player();
            }
        }
    }

    public function get_event(){
        if ($this->session->event_id){
            $event = $this->event_model->where('id', $this->session->event_id)->get();
            $this->session->event = $event;
        }

    }

    public function system_message($message){
        $insert['user_id'] = $this->session->id;
        $insert['message'] = $message;
        $this->session->message =1;
        $this->player_model->where('user_id', $insert['user_id'])->update($insert);
    }

    public function clear_event(){
        $where = array();
        $where['player_id'] = $this->session->player['id'];
        $where['id'] = $this->session->event_id;
        $this->event_model->delete($this->session->event_id);
    }

    // HACKS  and Events

    public function hack_name(){
        $hacks = array(
            "TuneUpMyPc Trojan",
            "Michaelangelo Virus",
            "FBI Virus",
            "CryptoWall",
            "Porn E-bomb",
            "WannaDie NCryptR",
            "Funtime XPL017",
            "Gibson Hack",
            "AC1DBURN",
            "DD0S",
            "BOTNET",
            "Mutating Algorithm",
            "FireAlarm",
            "SprinklerSystem",
            "SecurityAlarm",
            "Missle-Drones",
            "TH3 W4RL0CK",
            "CB Radio",
            "Hired-Goons",
            "Sat-Comm",
            "Mechanical-Keyboard",
            "NodeJS",
            "Angular",
            "Python",
            "Fortran",
            "Cobal",
            "SXE-Singles-Ebomb",
            "BlackHawk-Helicopter",
            "F-35 Fighter-Jet",
            "0trace",
            "aircrack-ng",
            "amoeba",
            "B1S0N",
            "BlindElephant",
            "cmatrix",
            "cowpatty",
            "dsniff",
            "wireshark",
            "reaver",
            "emacs",
            "ferret-sidejack",
            "gparted",
            "hexinject",
            "intrace",
            "iproute",
            "inviteflood",
            "john-the-ripper",
            "truecrypt",
            "maltego",
            "metasploit",
            "nano",
            "perl",
            "IRC-Bot",
            "pyrit",
            "Ruby",
            "SMB-rooter",
            "sfuzz",
            "sipcrack",
            "sipvicious",
            "siparmyknife",
            "sniffjoke",
            "sqlninja",
            "SUDO",
            "telnet",
            "terminator",
            "latex",
            "thunar",
            "tilda",
            "tor",
            "truecrack",
            "tshark",
            "tumbler",
            "VIM",
            "VI",
            "whiptail",
            "whois",
            "wifitap",
            "wifite",
            "figlet",
            "cowsay",
            "galaga",
            "K3YL0GG3R",
            "G0DM0D3",
            "R3V3NG3 V1RU5",
            "Rick-Roll",
            "Stingray",
            "Crash Override",
            "Security Override",
            "CryptoLocker",
            "ILOVEYOU",
            "Rockyou-pw-list",
            "MyDoom",
            "Storm Worm",
            "Anna Kournikova",
            "Slammer",
            "Stuxnet",
            "codered",
            "mellisa-virus",
            "sasser",
            "ZEUS",
            "conficker",
            "flashback",
            "skywiper",
            "G4M30V3R",
            "bashlite",
            "shellshock",
            "honeypot",
            "man-in-middle"
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


    // event stuff

    public function enemy_hack(){
        $hacks = array(
            "Crummy Firewall",
            "NordAntiVirus",
            "Annoying IT Guy",
            "Stubborn Employee",
            "Legacy Software",
            "Custom firmware",
            "CyberSec Guy",
            "Custom Firewall",
            "PF Sense",
            "Local Police",
            "Armed Guards",
            "Helicopter",
            "EMP",
            "magicrescue",
            "Missle-Drones",
            "SQL",
            "Postgresql",
            "Regex",
            "Java",
            "C++",
            "Bubble-Sort",
            "Binary-Tree",
            "Linked-List",
            "Virus Definitions",
            "Cyberspoof",
            "Cruise Missle",
            "DDrescue",
            "Sharknado",
            "Oregon Trail",
            "only a flesh wound",
            "unladen swallow",
            "Clam-AV",
            "bitlocker",
            "Federal Agents",
            "truecrypt",
            "dead parrot",
            "particle accelerator",
            "turn it off and on again",
            "B-tree index"
        );
        $rand = array_rand($hacks, 1);
        return $hacks[$rand];
    }

    public function enemy_power(){
        $hack_power = array(
            0.6, 0.5, 0.4, 0.7, 0.4, 0.5, 0.6, 0.7, 0.5
        );
        $rand = array_rand($hack_power, 1);
        // multiply this by the players power
        return $hack_power[$rand];
    }

    // Jobs

    public function get_job(){
        $jobs = array(
            'root@UniBankServer',
            'root@CCstockExchange',
            'root@nsaServers',
            'root@piedpiper',
            'root@hooli',
            'root@centimart',
            'root@ecomart',
            'root@electromart',
            'root@multimart',
            'root@yomart',
            'root@retrobank',
            'root@geobank',
            'root@hemibank',
            'root@hydrobank',
            'root@dynabank',
            'root@midair',
            'root@kayair',
            'root@superair',
            'root@socihotel',
            'root@paleohotel',
            'root@dynahotel',
            'root@superhotel',
            'root@retrohotel',
            'root@epirental',
            'root@ultrarental',
            'root@autorental',
            'root@rentality',
            'root@zoorental',
            'root@truclowns',
            'root@intraclowns',
            'root@multiclowns',
            'root@instaclowns',
            'root@instajizz',
            'root@XXXhairyapebananas',
            'root@astroclowns',
            'root@XXXoid',
            'root@superantivirus',
            'root@sumantivirus',
            'root@movantivirus'
        );
        $job = array_rand($jobs, 1);
        return $jobs[$job];

    }

    public function get_dollars(){
        $dollars = array(
            0.2, 3, 0.4, 0.5, 0.8, 1.5, 2, 0.4
        );
        $rand = array_rand($dollars, 1);
        $dollar_reward = $dollars[$rand];
        return ($dollar_reward * (80 * $this->session->player['level']));
    }

    public function get_coins(){
        // multiply this by player level
        $coins = array(
            0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0
        );
        $rand = array_rand($coins, 1);
        $coin_reward = $coins[$rand];
        return ($coin_reward * $this->session->player['level']);
    }

    public function get_hp(){
        $hps = array(
            0.3, 0.60, 0.5, 0.7, 0.65, 0.75, 0.6, 0.7, 0.5, 0.3, 0.85
        );
        $rand = array_rand($hps, 1);
        return ($hps[$rand] * $this->session->player['max_hp']);
    }

    public function get_xp(){
        $xps = array(
            0.05, 0.04, 0.06, 0.08, 0.11,
        );
        $rand = array_rand($xps, 1);
        return ($xps[$rand] * $this->session->player['next_level']);
    }

    public function kill_player(){
        $player['hp'] = 0;
        $player['dead_stamp'] = date("Y-m-d H:i:s");
        $this->event_model->update($enemy, $this->session->event_id);
        $this->player_model->where('user_id', $this->session->id)->update($player);
        $this->system_graffiti($player['username'] . " got busted and went to");
        redirect(site_url('events/dead'));
    }

    public function revive(){
        $player = array();
        $player['user_id'] = $this->session->id;
        $player['dead_stamp'] = null;
        $player['hp'] = $this->session->player['max_hp'];
        $this->player_model->where('user_id', $this->session->id)->update($player);
        $this->get_state();
        $this->load->view('menus/main');
    }

    public function record_pvp($string){
        $message = array();
        $message['user_id']  = $this->session->id;
        $message['username'] = $this->session->username;
        $message['message'] = $string;
        $message['system_yn'] = '0';
        $this->message_model->insert($message);
    }

    public function system_graffiti($msg){
        $message = array();
        $message['user_id']  = $this->session->id;
        $message['username'] = "News";
        $message['message'] = $msg;
        $message['system_yn'] = 0;
        $this->message_model->insert($message);
    }

    public function news(){
        $news = array(
            "The mayor is a crook!",
            "Corruption is building in the senate.",
            "Evil corporations are taking over.",
            "Now go away or I shall taunt you a second time.",
            "I've got a bad feeling about this",
            "Hackers are our only defense against the oligarchy.",
            "RESIST the oligarchy. Crush the system.",
            "This city needs a vigilante.",
            "E-coin prices seem to be going up.",
            "Why is this coffee so damn expensive?",
            "A whole E-coin for a donut? U gotta be kidding me.",
            "Defeat other players to gain extra dollars and karma",
            "Wherever you go, there you are.",
            "The shortest distance between two points is always a pile of money.",
            "Identity theft will steal 25% of another players XP",
            "NodeJS NodeJS NodeJS",
            "Spaces are better! No! TABS are BETTER!",
            "Have you tried turning it off and on again?"
        );
        $key = array_rand($news, 1);
        $this->system_message($news[$key]);
    }

    public function daily(){
        $market = $this->market_model->get(1);

        $nowstamp = date("Y-m-d H:i:s");
        $nowtime = strtotime($nowstamp);
        $marketstamp = $market['time'];
        $lasttime = strtotime($marketstamp);
        $payouttime = $lasttime + 86400; // time to elapse in seconds 86400 is a day
        $diff = $payouttime - $nowtime;


        if($diff <0 ) {
            $this->revive_all();
//            $this->clear_events();
//            $this->clear_messages();
            $update = $market;
            $update['time'] = date("Y-m-d H:i:s");
            $update['value'] = (1.05 * $market['value']);
            $this->market_model->where('id', 1)->update($update);
            $market = $this->market_model->get(1);
            $msg = "The stock market value today is $" . $market['value'];
            $this->system_graffiti($msg);

            $players = $this->player_model->get_all();

            foreach ($players as $player){
                $shares             = $player['shares'];
                $player_share       = ($market['value'] / 100);
                $payout             = ($player_share * $shares);
                $message            = "Your shares earned $" . number_format($payout) . " in dividends.";
                $update_dollars     = $payout + $player['dollars'];
                $user_id            = $player['user_id'];
                $update             = array();
                $update['dollars'] = $update_dollars;
                $update['message'] = $message;
                $this->player_model->where('user_id', $user_id)->update($update);
            }
            // once daily there's a chance to crash
            $this->random_crash();

        }

    }


    public function random_crash(){
        $values = array(
            250000, 275000, 290000, 300000, 310000, 320000, 330000, 340000, 350000, 360000
        );

        $key = array_rand($values, 1);
        $random = $values[$key];

        $market = $this->market_model->get(1);

        if($market['value'] > $random){
            $this->system_graffiti("THE STOCK MARKET HAS CRASHED! All players have lost their shares.");
            $update = array();
            $update['value'] = 50000;
            $update['time'] = date("Y-m-d H:i:s");
            $this->market_model->where('id', 1)->update($update);

            $players = $this->player_model->get_all();
            foreach ($players as $player){
                $message            = "Your shares were lost in the market crash!";
                $user_id            = $player['user_id'];
                $update             = array();
                $update['shares']   = 1;
                $update['message']  = $message;
                $this->player_model->where('user_id', $user_id)->update($update);
            }

        }
    }

    public function revive_all(){
        $players = $this->player_model->get_all();

        foreach ($players as $person){
            $player['user_id'] = $person['user_id'];
            $player['dead_stamp'] = null;
            $player['message'] = null;
            $this->session->message = false;
            $player['hp'] = $person['max_hp'];
            $this->player_model->where('user_id', $person['user_id'])->update($player);
        }
    }

    public function clear_events(){
        $events = $this->event_model->get_all();
        if (count((array)$events > 0)){
            foreach ($events as $event){
                $this->event_model->delete($event['id']);
            }
        }
    }
}