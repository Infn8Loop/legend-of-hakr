<?php $this->load->view("includes/header"); ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <img src="<?php echo site_url('assets/images/coffee.png');?>" class="img img-responsive" id="logo">
                <h4>The shop smells like heaven, you walk up to the counter and say hello. The coffee prices here seem REALLY expensive. </h4>
                Coffee: $<?php echo ($this->session->player['level'] * 100);?>
                Donut: 1 Coin.
                <h3><a href="<?php echo site_url('coffee/coffee')?>">[<span class="fuschia">Coffee</span>]</a><a href="<?php echo site_url('coffee/donut')?>">[<span class="fuschia">Donut</span>]</a></h3>
                <div class="options">
                    <h3><a href="<?php echo site_url();?>">[<span class="fuschia">Menu</span>]</a></h3>
                </div>
            </div>
        </div>
    <div class="bottom-pad"></div>
    </div>
<?php $this->load->view("includes/footer"); ?>