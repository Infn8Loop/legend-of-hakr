<?php $this->load->view("includes/header");?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class='terminal'>
                    <div class='screen'>
    <?php if(isset($battle_message)){echo $battle_message . '<br/';} ?>
    <?php echo $this->session->event['enemy_info'];?> #! <br/>
   <?php if(isset($your_hack)){?>You attack with <?php echo $your_hack; ?> for <?php echo number_format($your_attack);?> damage.<?php }?><br/>
    <?php if(isset($enemy_hack)){?>Opponent attacks with <?php echo $enemy_hack; ?> for <?php echo number_format($enemy_attack);?> damage.<?php }?><br/>
                    </div>
                </div>
                <img src="<?php echo site_url('assets/images/keyboard.png');?>" id="keyboard" class="animated slideInDown">
                <img src="<?php echo site_url('assets/images/mouse.png');?>" id="mouse" class="animated slideInDown">

                    <div class="options">
                        <h2 class="text-center">
                            <a href="<?php if ($this->session->event['opponent'] >= 1){echo site_url('pvp/hack');} else {echo site_url('events/hack');} ?>">[<span class="fuschia">HACK</span>]</a>  <a href="<?php echo site_url('events/abort');?>">[<span class="fuschia">ABORT</span>]</a>
                        </h2>
                    </div>
            </div>
        </div>
    </div>
<?php $this->load->view("includes/footer"); ?>