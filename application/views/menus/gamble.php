<?php $this->load->view("includes/header"); ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <img src="<?php echo site_url('assets/images/gamble.png');?>" class="img img-responsive" id="logo"><br/>
                <h4>Care to play a little follow the shell? In this classic shell game we shuffle 3 shells and you must guess which shell the coins are under.</h4>
                <h5>The wager is 2 coins, if you win you earn 4 coins.</h5>
                <img src="http://www.gifbin.com/bin/082012/1343849002_mechanical_shell_game_player.gif"/>
            </div>
            <div class="options">
                <div class="options">
                    <h3>
                        <a href="<?php echo site_url('gamble/gamble/1');?>">[<span class="fuschia">ONE</span>]</a>
                        <a href="<?php echo site_url('gamble/gamble/2');?>">[<span class="fuschia">TWO</span>]</a>
                        <a href="<?php echo site_url('gamble/gamble/3');?>">[<span class="fuschia">THREE</span>]</a>
                        <a href="<?php echo site_url();?>">[<span class="fuschia">ABORT</span>]</a>
                    </h3>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view("includes/footer");?>