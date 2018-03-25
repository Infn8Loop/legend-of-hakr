<?php $this->load->view("includes/header"); ?>
<?php $this->session->unset_userdata('success');?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="terminal">
                    <div class="screen">
                        You attack with <?php echo $hack_name; ?><br/>
                        ACCESS GRANTED! <br/>Rewards: <br/>
                        $<?php echo $reward['dollars'];?> dollars<br/>
                        <?php echo $reward['xp'] . ' XP';?>
                        <?php if($reward['coins'] > 0){?><br/>
                            <?php echo $reward['coins']; ?> E-coins.
                        <?php }?>
                    </div>
                </div>
                <div class="options">
                    <h2><a href="<?php echo site_url('events/create');?>">[Continue]</a> <a href="<?php echo site_url();?>">[Menu]</a>  </h2>
                </div>

            </div>
        </div>
    </div>
<?php $this->load->view("includes/footer"); ?>