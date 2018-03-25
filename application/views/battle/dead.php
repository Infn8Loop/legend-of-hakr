<?php $this->load->view("includes/header"); ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="terminal">
                    <div class="screen">
                        REMOTE SESSION TERMINATED.<br/>
                        #!
                    </div>
                </div>
                <p> You are now in jail. Pay coins to get out. While jailed you cannot hack anything. </p>
                <div class="options">
                    <h4 class="text-center">
                        <a href="<?php echo site_url();?>">[<span class="fuschia">Menu</span>]</a>
                        <a href="<?php echo site_url('menus/nav/revive');?>">[<span class="fuschia">Pay</span>]</a>
                    </h4>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view("includes/footer"); ?>