<?php $this->load->view("includes/header");
$all_players = $this->player_model->get_all();
$all_users = $this->user_model->get_all();
foreach($all_players as $player){

}

$karma = $all_players;
$xp = $all_players;

function sortByKarma($x, $y) {
    return $y['karma'] - $x['karma'];
}

function sortByXp($x, $y) {
    return $y['xp'] - $x['xp'];
}

usort($karma, 'sortByKarma');
usort($xp, 'sortByXp');

?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3><?php echo $this->session->username;?></h3>
                    </div>
                    <div class="panel-body full-stats">
                        <div class="row">
                            <!-- title row -->
                            <div class="col-xs-3">
                                 <h5>Max HP:</h5>
                                 <h6><?php echo $this->session->player['max_hp'];?></h6>
                            </div>
                            <div class="col-xs-3">
                                <h5>HP:</h5>
                                <h6><?php echo $this->session->player['hp'];?></h6>
                            </div>
                            <div class="col-xs-3">
                                <h5>XP:</h5>
                                <h6><?php echo $this->session->player['xp'];?></h6>
                            </div>
                            <div class="col-xs-3">
                                <h5>Karma:</h5>
                                <h6><?php echo $this->session->player['karma'];?></h6>
                            </div>
                        </div>
                        <div class="row">
                            <!-- title row -->
                            <div class="col-xs-3">
                                 <h5>Dollars:</h5>
                                 <h6><?php echo $this->session->player['dollars'];?></h6>
                            </div>
                            <div class="col-xs-3">
                                <h5>Coins:</h5>
                                <h6><?php echo $this->session->player['coins'];?></h6>
                            </div>
                            <div class="col-xs-3">
                                <h5>Shares:</h5>
                                <h6><?php echo $this->session->player['shares'];?></h6>
                            </div>
                            <div class="col-xs-3">
                                <h5>Level:</h5>
                                <h6><?php echo $this->session->player['level'];?></h6>
                            </div>
                        </div>
                        <div class="row">
                            <!-- title row -->
                            <div class="col-xs-3">
                                 <h5>Nxt Lvl:</h5>
                                 <h6><?php echo $this->session->player['next_level'];?></h6>
                            </div>
                            <div class="col-xs-3">
                                <h5>Power</h5>
                                <h6><?php echo $this->session->player['power'];?></h6>
                            </div>
                            <div class="col-xs-3">
                                <h5>Status</h5>
                                <h6><?php if($this->session->player['dead_stamp']){?>Jail<?php } else {?>Good<?php }?></h6>
                            </div>
                            <div class="col-xs-3">
                                <h5>&nbsp;</h5>
                                <h6>&nbsp;</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <h3>PVP Leaders</h3>

                <?php $i= 1; foreach ($karma as $player){ 
                    if ($i <= 20){?>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="text-center"><?php echo "#" . $i . " " . $player['username'];?></h3>
                        </div>
                        <div class="panel-body">
                            <h4 class="text-center yellow">PVP Kills: <?php echo $player['karma'];?></h5>    
                        </div>
                    </div>
                
                <?php } $i++;} // end foreach?>

                <div class="bottom-pad"></div>
                <div class="options">
                    <h3><a href="<?php echo site_url();?>">[<span class="fuschia">Menu</span>]</a></h3>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view("includes/footer"); ?>