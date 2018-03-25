<?php $this->load->view("includes/header"); ?>
<?php $graffiti = $this->session->graffiti; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3>Graffiti Wall <a href="<?php echo site_url('messages/graffiti')?>">[<span class="fuschia">Refresh</span>]</a></h3>
                <?php if (isset($graffiti)){?>
                <?php foreach ($graffiti as $message){?>
                    <div class="col-sm-6 col-md-4">
                        <div class="col-xs-12">
                        <h4>
                            <span class="green"><?php echo $message['username']; ?> #! &nbsp;</span>
                        </h4>
                    </div>
                    <div class="col-xs-12">
                        <h4><span class="blue"><?php echo $message['message']; ?></span></h4>
                    </div>
                    <div class="col-xs-12">
                        <h6 class="text-right"><?php echo $message['created_at']; ?></h6>
                    </div>
                    </div> 
                <?php } // end foreach?>
                <?php } // end IF ?>
                <div class="bottom-pad"></div>
                <div class="options">
                    <h3><a href="<?php echo site_url();?>">[<span class="fuschia">Menu</span>]</a>
                    <a href="<?php echo site_url('menus/nav/write_graffiti');?>">[<span class="fuschia">Write</span>]</a>
                    </h3>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view("includes/footer"); ?>